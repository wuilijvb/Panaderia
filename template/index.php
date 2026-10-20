<?php
$menu = [
 ['course'=>'Small plates','name'=>'Coal-roasted beet','desc'=>'smoked yoghurt · blackberry · toasted seed','price'=>'210'],
 ['course'=>'Small plates','name'=>'Scallop crudo','desc'=>'green tomato · hoja santa · chile oil','price'=>'320'],
 ['course'=>'Mains','name'=>'Fire-grilled sea bass','desc'=>'white bean · fennel · preserved citrus','price'=>'480'],
 ['course'=>'Mains','name'=>'Dry-aged short rib','desc'=>'burnt onion · mole jus · sourdough','price'=>'590'],
 ['course'=>'Mains','name'=>'Woodland rice','desc'=>'mushroom · epazote · aged cheese','price'=>'390'],
 ['course'=>'Dessert','name'=>'Dark cacao','desc'=>'piloncillo · sesame · sea salt','price'=>'190'],
 ['course'=>'Dessert','name'=>'Burnt milk','desc'=>'pear · bay leaf · olive oil','price'=>'180'],
];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Ember Table — Contemporary Fire Kitchen</title>
<meta name="description" content="Premium restaurant template for a contemporary fire-led kitchen, seasonal menu and reservations.">
<link rel="canonical" href="https://example.com/ember-table/">
<meta property="og:title" content="Ember Table — Contemporary Fire Kitchen">
<meta property="og:description" content="A seasonal kitchen shaped by flame, fermentation and local produce.">
<meta property="og:type" content="restaurant.restaurant">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:image" content="https://example.com/template-collection/shared/previews/11-restaurant.webp">
<meta property="og:image:width" content="720">
<meta property="og:image:height" content="450">
<meta property="og:image:alt" content="Preview of Ember Table — Contemporary Fire Kitchen">
<meta name="twitter:image" content="https://example.com/template-collection/shared/previews/11-restaurant.webp">
<link rel="stylesheet" href="css/style.css">
<script type="application/ld+json">{"@context":"https://schema.org","@type":"Restaurant","name":"Ember Table","servesCuisine":"Contemporary","priceRange":"$$$","url":"https://example.com/ember-table/"}</script>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<header class="site-header" data-header>
  <a class="wordmark" href="#top" aria-label="Ember Table home"><span>EMBER</span><i></i><span>TABLE</span></a>
  <nav class="main-nav" id="main-nav" aria-label="Primary navigation"><a href="#menu">Menu</a><a href="#story">Story</a><a href="#experience">Experience</a><a href="#visit">Visit</a></nav>
  <button class="reserve-mini" data-reserve>Reserve a table</button>
  <button class="menu-toggle" aria-expanded="false" aria-controls="main-nav"><span></span><span></span><span class="sr-only">Toggle menu</span></button>
</header>
<main id="main">
<section class="hero" id="top">
  <div class="hero-image"><img src="images/hero-ember.svg" alt="Abstract still life inspired by a fire-led dining room" width="1200" height="1300" decoding="async"></div>
  <div class="hero-copy">
    <div class="hero-kicker"><span>Season 08</span><span>Bajío · MX</span></div>
    <h1>Cooked by<br><em>fire.</em><br>Led by season.</h1>
    <div class="hero-bottom"><p>A contemporary kitchen where smoke, fermentation and local produce become a concise evening menu.</p><button class="round-button" data-reserve aria-label="Reserve a table"><span>Reserve</span><b>↗</b></button></div>
  </div>
  <div class="hero-note" aria-hidden="true">Dinner / Tue—Sun / 18:00—23:30</div>
</section>

<section class="marquee" aria-hidden="true"><div>OPEN FIRE · FERMENTATION · SEASONAL PRODUCE · SMALL GROWERS · OPEN FIRE · FERMENTATION · SEASONAL PRODUCE · SMALL GROWERS ·</div></section>

<section class="intro section" id="story">
  <div class="intro-index reveal">01 / Philosophy</div>
  <div class="intro-copy reveal"><p class="label">Our kitchen</p><h2>Nothing on the plate is there by accident.</h2><p class="lead">Ember Table is built around direct heat and patient preparation. We source close to home, preserve what the season gives us and let ingredients retain their edges.</p></div>
  <div class="intro-aside reveal"><p>We do not chase novelty for its own sake. The menu changes because farms, weather and fire do.</p><span>— Kitchen note, Season 08</span></div>
</section>

<section class="dish-feature reveal">
  <figure><img src="images/dish-seabass.svg" alt="Abstract illustration of a plated sea bass dish" loading="lazy" width="1100" height="760" decoding="async"><figcaption><span>Current menu / 04</span><strong>Sea bass · white bean · preserved citrus</strong></figcaption></figure>
  <div class="dish-stamp" aria-hidden="true"><span>EMBER</span><span>08</span><span>TABLE</span></div>
</section>

<section class="menu-section section" id="menu">
  <div class="menu-heading reveal"><p class="label">À la carte / Season 08</p><h2>A short menu,<br>meant to move.</h2><p>Menu shown for template demonstration. Ingredients, prices and availability are placeholders.</p></div>
  <div class="menu-controls reveal" role="group" aria-label="Filter menu courses"><button class="active" data-course="all" aria-pressed="true">Full menu</button><button data-course="Small plates" aria-pressed="false">Small plates</button><button data-course="Mains" aria-pressed="false">Mains</button><button data-course="Dessert" aria-pressed="false">Dessert</button></div>
  <div class="menu-list">
    <?php foreach($menu as $i=>$item): ?>
      <article class="menu-item reveal" data-menu-course="<?= htmlspecialchars($item['course']) ?>"><span class="menu-no"><?= str_pad((string)($i+1),2,'0',STR_PAD_LEFT) ?></span><div><small><?= htmlspecialchars($item['course']) ?></small><h3><?= htmlspecialchars($item['name']) ?></h3><p><?= htmlspecialchars($item['desc']) ?></p></div><strong>$<?= htmlspecialchars($item['price']) ?></strong></article>
    <?php endforeach; ?>
  </div>
  <div class="menu-note reveal"><span>*</span><p>Please tell us about allergies and dietary requirements when booking. A vegetarian route can be prepared with advance notice.</p><button data-reserve>Book for dinner ↗</button></div>
</section>

<section class="experience" id="experience">
  <div class="experience-image reveal"><img src="images/table-room.svg" alt="Abstract illustration of the Ember Table dining room" loading="lazy" width="1000" height="900" decoding="async"></div>
  <div class="experience-copy reveal"><p class="label">At the pass</p><h2>Eight seats.<br>No distance from the fire.</h2><p>The counter menu puts guests beside the kitchen for a paced sequence of off-menu plates, direct conversation and a closer view of the craft.</p><dl><div><dt>Seats</dt><dd>8</dd></div><div><dt>Courses</dt><dd>10–12</dd></div><div><dt>Duration</dt><dd>2.5 h</dd></div></dl><button class="outline-button" data-reserve>Request counter seats</button></div>
</section>

<section class="pairing section">
  <div class="pairing-title reveal"><p class="label">Pairing / optional</p><h2>Glass, grain<br>& garden.</h2></div>
  <div class="pairing-grid">
    <article class="pair-card reveal"><span>01</span><h3>Wine</h3><p>Low-intervention bottles selected for acidity, texture and restraint.</p><small>6 pours / placeholder $</small></article>
    <article class="pair-card reveal"><span>02</span><h3>Zero-proof</h3><p>Ferments, teas, verjus and botanicals built with the same pacing as wine.</p><small>6 pours / placeholder $</small></article>
    <article class="pair-card visual reveal"><img src="images/pairing-glass.svg" alt="Abstract glass and botanical composition" loading="lazy" width="700" height="700" decoding="async"></article>
  </div>
</section>

<section class="chef section">
  <div class="chef-mark reveal"><span>E</span><span>T</span></div>
  <div class="chef-copy reveal"><p class="label">The people behind dinner</p><h2>A small team,<br>one point of view.</h2><p>Our fictional demo chef profile keeps the template realistic without representing a real restaurant. Replace this copy, portrait and credentials with your own material before publication.</p><blockquote>“The best technique should make the ingredient feel more itself, not less.”</blockquote><span>Chef profile · placeholder</span></div>
</section>

<section class="visit section" id="visit">
  <div class="visit-top reveal"><p class="label">Visit</p><h2>Come hungry.<br>Stay unhurried.</h2></div>
  <div class="visit-grid">
    <div class="visit-card reveal"><span>Hours</span><p>Tuesday — Thursday<br>18:00 — 23:00</p><p>Friday — Sunday<br>18:00 — 23:30</p><p>Monday<br>Closed</p></div>
    <div class="visit-card reveal"><span>Address</span><p>Demo address<br>Centro, Guanajuato<br>México</p><a href="#" aria-label="Placeholder directions link">Directions ↗</a></div>
    <div class="visit-card reveal"><span>Good to know</span><p>Smart casual<br>18+ counter seating<br>Accessible entrance<br>Dietary notes on booking</p></div>
    <div class="visit-card action reveal"><span>Reservations</span><p>Tables open 30 days ahead. For groups above six, send a private dining request.</p><button data-reserve>Find a table ↗</button></div>
  </div>
</section>
</main>
<footer class="footer"><a class="wordmark" href="#top"><span>EMBER</span><i></i><span>TABLE</span></a><p>Contemporary restaurant template.<br>All venue details are demo placeholders.</p><div><a href="#menu">Menu</a><a href="#story">Story</a><a href="#visit">Visit</a></div><span>© <?= date('Y') ?> Ember Table</span></footer>

<dialog class="reserve-dialog" data-reserve-dialog aria-labelledby="reserve-title"><button class="dialog-close" data-close aria-label="Close reservation form">×</button><div class="dialog-heading"><p class="label">Reservation request</p><h2 id="reserve-title">Your table,<br>your evening.</h2><p>This demo sends a reservation enquiry to the configured restaurant email. It does not connect to a live booking inventory.</p></div><form action="php/contact.php" method="post" data-form><div class="form-grid"><label>Name<input name="name" type="text" maxlength="100" autocomplete="name" required></label><label>Email<input name="email" type="email" maxlength="160" autocomplete="email" required></label><label>Date<input name="date" type="date" required></label><label>Guests<select name="guests" required><option value="2">2 guests</option><option value="3">3 guests</option><option value="4">4 guests</option><option value="5">5 guests</option><option value="6">6 guests</option><option value="7+">7+ / private dining</option></select></label><label class="full">Notes<textarea name="message" rows="4" maxlength="2000" placeholder="Allergies, celebration, counter preference or accessibility notes."></textarea></label><label class="honeypot" aria-hidden="true">Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div><button class="submit-button" type="submit">Request reservation <span>→</span></button><p class="form-status" aria-live="polite"></p></form></dialog>
<script src="js/main.js" defer></script>
</body>
</html>
