# 11 — Ember Table / Restaurant

Original premium restaurant template built with HTML5, CSS3, Vanilla JavaScript and PHP.

## Direction

A cinematic, type-led restaurant experience centered on open-fire cooking, seasonal menus and a high-touch reservation journey. The layout is intentionally very different from the property, corporate and technology templates in the collection.

## Components

- Full-height image/text split hero.
- Moving kitchen-principles marquee.
- Editorial philosophy section.
- Large featured-dish composition.
- Filterable à-la-carte menu.
- Chef-counter experience panel.
- Beverage / zero-proof pairing section.
- Chef narrative / placeholder profile.
- Hours, address, practical visit information.
- Native `<dialog>` reservation request form.
- Fetch API → PHP JSON submission.
- Restaurant Schema.org starter markup.
- Reduced-motion and keyboard-focus support.

## Important demo note

Restaurant name, address, prices, chef profile, menu items and service information are fictional placeholders. Replace them before publishing a real venue.

## Run

From the collection root:

```bash
php -S localhost:8080
```

Open `http://localhost:8080/11-restaurant/`.

## Contact configuration

Set `CONTACT_TO_EMAIL` in the server environment. The endpoint validates name, email, ISO-style date, party-size allowlist, note length, honeypot field and header injection. It is an enquiry endpoint, not a real-time booking engine.

## Customization

- Colors/type: CSS variables in `css/style.css`.
- Menu content: `$menu` array in `index.php`.
- Images: replace the original demo SVGs in `images/` with optimized WebP/AVIF photography as required.
- No external runtime dependencies are used.
