PRAGMA foreign_keys = ON;
CREATE TABLE IF NOT EXISTS roles (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 name TEXT NOT NULL UNIQUE CHECK(name IN ('Administrador','Cajero')),
 description TEXT NOT NULL DEFAULT ''
);
CREATE TABLE IF NOT EXISTS categories (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 name TEXT NOT NULL UNIQUE COLLATE NOCASE,
 active INTEGER NOT NULL DEFAULT 1 CHECK(active IN (0,1))
);
CREATE TABLE IF NOT EXISTS users (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 username TEXT NOT NULL UNIQUE COLLATE NOCASE,
 name TEXT NOT NULL,
 password_hash TEXT NOT NULL,
 role_id INTEGER NOT NULL REFERENCES roles(id),
 active INTEGER NOT NULL DEFAULT 1 CHECK(active IN (0,1)),
 created_at TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS customers (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 name TEXT NOT NULL,
 email TEXT,
 phone TEXT NOT NULL DEFAULT '',
 points INTEGER NOT NULL DEFAULT 0 CHECK(points >= 0),
 active INTEGER NOT NULL DEFAULT 1 CHECK(active IN (0,1)),
 created_at TEXT NOT NULL
);
CREATE UNIQUE INDEX IF NOT EXISTS idx_customers_email ON customers(email COLLATE NOCASE) WHERE email IS NOT NULL AND email <> '';
CREATE TABLE IF NOT EXISTS products (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 name TEXT NOT NULL,
 category TEXT NOT NULL,
 category_id INTEGER REFERENCES categories(id),
 code TEXT NOT NULL UNIQUE COLLATE NOCASE,
 price_cents INTEGER NOT NULL CHECK(price_cents > 0),
 stock INTEGER NOT NULL CHECK(stock >= 0),
 minimum_stock INTEGER NOT NULL DEFAULT 5 CHECK(minimum_stock >= 0),
 active INTEGER NOT NULL DEFAULT 1 CHECK(active IN (0,1)),
 icon TEXT NOT NULL DEFAULT '🥐'
);
CREATE TABLE IF NOT EXISTS sales (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 request_key TEXT NOT NULL UNIQUE,
 request_hash TEXT NOT NULL DEFAULT '',
 created_at TEXT NOT NULL,
 user_id INTEGER REFERENCES users(id),
 customer_id INTEGER REFERENCES customers(id),
 subtotal_cents INTEGER NOT NULL DEFAULT 0,
 tax_cents INTEGER NOT NULL DEFAULT 0,
 tax_rate_bps INTEGER NOT NULL DEFAULT 1600,
 discount_cents INTEGER NOT NULL DEFAULT 0 CHECK(discount_cents >= 0),
 points_redeemed INTEGER NOT NULL DEFAULT 0 CHECK(points_redeemed >= 0),
 total_cents INTEGER NOT NULL,
 paid_cents INTEGER NOT NULL,
 change_cents INTEGER NOT NULL,
 payment TEXT NOT NULL CHECK(payment IN ('Efectivo','Tarjeta')),
 status TEXT NOT NULL DEFAULT 'completed' CHECK(status IN ('completed','cancelled')),
 cancelled_at TEXT,
 cancelled_by INTEGER REFERENCES users(id),
 cancel_reason TEXT NOT NULL DEFAULT '',
 points_awarded INTEGER NOT NULL DEFAULT 0 CHECK(points_awarded >= 0)
);
CREATE TABLE IF NOT EXISTS sale_items (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 sale_id INTEGER NOT NULL REFERENCES sales(id),
 product_id INTEGER NOT NULL REFERENCES products(id),
 name TEXT NOT NULL,
 quantity INTEGER NOT NULL CHECK(quantity > 0),
 price_cents INTEGER NOT NULL CHECK(price_cents > 0)
);
CREATE TABLE IF NOT EXISTS inventory_movements (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 product_id INTEGER NOT NULL REFERENCES products(id),
 user_id INTEGER REFERENCES users(id),
 sale_id INTEGER REFERENCES sales(id),
 type TEXT NOT NULL CHECK(type IN ('entrada','venta','ajuste','cancelacion')),
 quantity INTEGER NOT NULL CHECK(quantity <> 0),
 reason TEXT NOT NULL DEFAULT '',
 created_at TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS audit_log (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 user_id INTEGER REFERENCES users(id),
 action TEXT NOT NULL,
 entity TEXT NOT NULL,
 entity_id INTEGER,
 details TEXT NOT NULL DEFAULT '{}',
 created_at TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS login_attempts (
 id INTEGER PRIMARY KEY AUTOINCREMENT,
 username TEXT NOT NULL,
 ip TEXT NOT NULL,
 success INTEGER NOT NULL DEFAULT 0 CHECK(success IN (0,1)),
 created_at TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS app_settings (
 name TEXT PRIMARY KEY,
 value TEXT NOT NULL
);
INSERT OR IGNORE INTO app_settings(name,value) VALUES ('tax_rate_bps','0');
