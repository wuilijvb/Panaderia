<?php
declare(strict_types=1);
date_default_timezone_set('America/Mexico_City');

function db(): PDO {
    $path = getenv('BAKERY_DB') ?: __DIR__ . '/data/panaderia.sqlite';
    if (!is_dir(dirname($path))) mkdir(dirname($path), 0770, true);
    $pdo = new PDO('sqlite:' . $path, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec('PRAGMA foreign_keys=ON; PRAGMA busy_timeout=5000;');
    $pdo->exec('BEGIN IMMEDIATE');
    try {
        $pdo->exec(file_get_contents(__DIR__ . '/schema.sql'));
        $columns = static function (string $table) use ($pdo): array {
            return array_column($pdo->query("PRAGMA table_info($table)")->fetchAll(), 'name');
        };
        $add = static function (string $table, string $column, string $definition) use ($pdo, $columns): void {
            if (!in_array($column, $columns($table), true)) $pdo->exec("ALTER TABLE $table ADD COLUMN $column $definition");
        };
        $migrations = [
            ['products','code','TEXT'],
            ['products','category_id','INTEGER REFERENCES categories(id)'],
            ['products','minimum_stock','INTEGER NOT NULL DEFAULT 5 CHECK(minimum_stock>=0)'],
            ['products','active','INTEGER NOT NULL DEFAULT 1 CHECK(active IN (0,1))'],
            ['sales','user_id','INTEGER REFERENCES users(id)'],
            ['sales','customer_id','INTEGER REFERENCES customers(id)'],
            ['sales','status',"TEXT NOT NULL DEFAULT 'completed'"],
            ['sales','subtotal_cents','INTEGER NOT NULL DEFAULT 0'],
            ['sales','tax_cents','INTEGER NOT NULL DEFAULT 0'],
            ['sales','tax_rate_bps','INTEGER NOT NULL DEFAULT 1600'],
            ['sales','discount_cents','INTEGER NOT NULL DEFAULT 0'],
            ['sales','points_redeemed','INTEGER NOT NULL DEFAULT 0'],
            ['sales','request_hash',"TEXT NOT NULL DEFAULT ''"],
            ['sales','cancelled_at','TEXT'],
            ['sales','cancelled_by','INTEGER REFERENCES users(id)'],
            ['sales','cancel_reason',"TEXT NOT NULL DEFAULT ''"],
            ['sales','points_awarded','INTEGER NOT NULL DEFAULT 0'],
        ];
        foreach ($migrations as [$table,$column,$definition]) $add($table,$column,$definition);
        $pdo->exec("INSERT OR IGNORE INTO roles(name,description) VALUES ('Administrador','Administra usuarios, catálogo, inventario, ventas y reportes'),('Cajero','Registra ventas y consulta el catálogo')");
        $categorySeed = $pdo->prepare('INSERT OR IGNORE INTO categories(name) VALUES(?)');
        foreach (['Pan dulce','Pan salado','Especialidades','Galletas'] as $name) $categorySeed->execute([$name]);
        $legacyCategories = $pdo->query('SELECT DISTINCT category FROM products')->fetchAll(PDO::FETCH_COLUMN);
        foreach ($legacyCategories as $name) if (is_string($name) && trim($name) !== '') $categorySeed->execute([trim($name)]);
        $pdo->exec("UPDATE products SET category_id=(SELECT id FROM categories WHERE categories.name=products.category COLLATE NOCASE) WHERE category_id IS NULL");
        $pdo->exec("UPDATE products SET code='PAN-' || printf('%04d',id) WHERE code IS NULL OR code=''");
        $pdo->exec('UPDATE sales SET subtotal_cents=total_cents,tax_rate_bps=0 WHERE subtotal_cents=0');
        $pdo->exec("INSERT OR IGNORE INTO app_settings(name,value) VALUES ('tax_rate_bps','0')");
        $pdo->exec('CREATE UNIQUE INDEX IF NOT EXISTS idx_products_code ON products(code COLLATE NOCASE)');
        $pdo->exec('CREATE INDEX IF NOT EXISTS idx_sales_created_status ON sales(created_at,status)');
        $pdo->exec('CREATE INDEX IF NOT EXISTS idx_movements_product_date ON inventory_movements(product_id,created_at)');
        $pdo->exec('CREATE INDEX IF NOT EXISTS idx_audit_created ON audit_log(created_at)');
        if (!(int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn()) {
            $categoryId = $pdo->prepare('SELECT id FROM categories WHERE name=?');
            $insert = $pdo->prepare('INSERT INTO products(name,category,category_id,code,price_cents,stock,minimum_stock,icon) VALUES(?,?,?,?,?,?,?,?)');
            $seed = [
                ['Concha de vainilla','Pan dulce',1400,36,5,'🌼'],
                ['Concha de chocolate','Pan dulce',1500,28,5,'🍫'],
                ['Croissant de mantequilla','Especialidades',2800,18,4,'🥐'],
                ['Bolillo tradicional','Pan salado',600,65,10,'🥖'],
                ['Dona de chocolate','Pan dulce',1800,24,5,'🍩'],
                ['Rol de canela','Especialidades',3200,16,4,'🌀'],
                ['Galleta de mantequilla','Galletas',1200,40,8,'🍪'],
                ['Baguette artesanal','Pan salado',3500,12,3,'🥖'],
            ];
            foreach ($seed as $index=>$product) {
                $categoryId->execute([$product[1]]);
                $insert->execute([$product[0],$product[1],$categoryId->fetchColumn(),'PAN-'.str_pad((string)($index+1),4,'0',STR_PAD_LEFT),$product[2],$product[3],$product[4],$product[5]]);
            }
        }
        $pdo->exec('COMMIT');
    } catch (Throwable $error) {
        if ($pdo->inTransaction()) $pdo->exec('ROLLBACK');
        throw $error;
    }
    return $pdo;
}
