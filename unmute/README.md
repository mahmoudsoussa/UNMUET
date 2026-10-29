# UNMUTE — WordPress + WooCommerce Theme

A custom-built, installable WordPress theme for the **UNMUTE** alternative-fashion
brand ("Wear What You Feel."). Dark, gallery-like storefront with lavender
accents, brush-display typography, collection-based merchandising and
print-on-demand-friendly product pages.

- **Version:** 1.0.0
- **Requires:** WordPress 6.0+, PHP 7.4+, WooCommerce 7.0+ (recommended 8.x/9.x)
- **License:** GPL-2.0-or-later
- **Text domain:** `unmute` (English strings; ships LTR + RTL stylesheets)

---

## 1. Installation

1. In `wp-admin`, go to **Appearance → Themes → Add New Theme → Upload Theme**.
2. Choose `unmute.zip` and click **Install Now**, then **Activate**.
3. Install & activate **WooCommerce** (Plugins → Add New → "WooCommerce").
   The theme declares full WooCommerce support; no extra theme plugins are required.
4. Run the WooCommerce setup wizard (currency, pages: Shop / Cart / Checkout / My Account).
5. Go to **Appearance → Customize → UNMUTE Brand & Store** and configure the brand
   (see §4).

> The theme works without WooCommerce too (blog + brand landing), but the shop
> sections appear only when WooCommerce is active.

---

## 2. File structure

```
unmute/
├── style.css                  Theme header + pre-paint base
├── functions.php              Setup, enqueues, CSS variables from Customizer
├── header.php / footer.php    Dark sticky header, drawer, search, footer
├── front-page.php             Brand landing (section order fixed, each toggleable)
├── index.php / archive.php / single.php / page.php / search.php / 404.php
├── comments.php / searchform.php
├── screenshot.png
├── inc/
│   ├── template-tags.php      Icons, defaults, product card, helpers
│   ├── customizer.php         All Customizer settings (schema-driven)
│   ├── woocommerce.php        Hook-based WooCommerce integration
│   └── ajax.php               Local newsletter storage
├── template-parts/
│   ├── section-hero.php       Hero (Customizer image + headline + CTAs)
│   ├── section-features.php   4 editable feature items
│   ├── section-featured.php   Category pills + featured product grid
│   ├── section-collections.php Collections = WooCommerce product categories
│   ├── section-story.php      Brand philosophy ("Your feelings deserve a voice.")
│   ├── section-newsletter.php "Join the Signal" signup
│   ├── content-card.php / content-none.php
└── assets/
    ├── css/main.css           Full design system (mobile-first)
    ├── css/rtl.css            RTL flips (auto-loaded when site language is RTL)
    ├── css/editor.css         Gutenberg dark canvas
    ├── js/main.js             Vanilla JS: header, drawer, search, newsletter, Customizer preview
    └── img/                   hero-placeholder.jpg, story-placeholder.jpg, product-placeholder.svg
```

**No WooCommerce core templates are overridden.** The shop loop is rebuilt with
WooCommerce's own hooks (`woocommerce_before_shop_loop_item`, etc.) rendering one
shared card function (`unmute_product_card()`), so WooCommerce updates cannot
break the theme and "outdated template" warnings never appear.

---

## 3. WooCommerce setup guide

### 3.1 Products, sizes & colours (variations)

1. **Products → Add New** → product data: **Variable product**.
2. **Attributes** tab → add e.g. `Size` with values `S | M | L | XL | XXL`
   (and `Colour` with `Black | Washed Black | Bone`), tick
   *Visible on the product page* and *Used for variations*.
3. **Variations** tab → *Create variations from all attributes* → set price,
   stock and SKU per variation. The theme's single-product page renders the
   attribute dropdowns, quantity stepper and Add-to-Cart button automatically.
4. Set a **product image** + gallery (the gallery gets zoom/lightbox/slider).
5. Tick **Featured** to curate the front-page "Featured Pieces" grid
   (or switch the source in Customizer → Featured products).

### 3.2 Collections

Collections on the homepage **are WooCommerce product categories**
(Products → Categories). Create e.g. *The Unsaid*, *Dark Butterflies*,
*Lunar Thoughts*, *Silent Rebellion*, *Fragmented Mind*, assign products, and
optionally set a category image (used as the card background). Add/remove/rename
freely — the section follows.

### 3.3 Print-on-Demand connection

The theme is POD-neutral. Install your provider's official plugin and it prints
the orders WooCommerce receives:

- **Printful** → plugin "Printful Integration for WooCommerce"
- **Printify** → plugin "Printify for WooCommerce"
- **Gelato** → Gelato WooCommerce app (recommended for EU-local fulfilment)

Connect products to provider templates inside the provider plugin; the theme
needs no changes. The single-product page shows editable *made-to-order*
shipping & returns blocks (Customizer → Shop behaviour) so delivery expectations
are honest before checkout.

### 3.4 Wishlist (optional)

The heart button on product cards appears **only** when a supported wishlist
plugin is active: **YITH WooCommerce Wishlist** or **TI WooCommerce Wishlist**.
The theme prints their button inside the card and removes the plugin's default
loop position to avoid duplicates. Without a plugin, no heart is shown.

### 3.5 Payments & shipping

Configure in WooCommerce → Settings (gateways, zones, taxes). The header cart
count updates live via WooCommerce fragments.

---

## 4. Customizer map (Appearance → Customize → UNMUTE Brand & Store)

| Section | Controls |
|---|---|
| Announcement bar | Show/hide + text (default: made-to-order production notice) |
| Hero | Show/hide, artwork upload, eyebrow, headline, accent word, description, 2 CTA labels + links |
| Features strip | Show/hide + 4 × (icon, title, text) |
| Featured products | Show/hide, title, source (featured/newest/best-sellers/random), count |
| Collections | Show/hide, title, count |
| Brand story | Show/hide, image, quote, body, CTA |
| Newsletter | Show/hide, heading, text, external form action URL (Mailchimp/Klaviyo…) or local storage, privacy note |
| Brand colours & type | Background, surfaces, accent, accent-deep, text, muted + display font (3 brush faces) — live preview |
| Shop behaviour | Desktop columns (2–4), products per page, "New" days, "Bestseller" threshold, shipping & returns blocks |
| Footer, contact & social | Blurb, email, phone, address, copyright, 6 social URLs |

Every homepage section can be switched off without code. Colours are exposed as
CSS custom properties (`--unmute-*`) so child themes can reuse them.

### Newsletter storage

With no external action URL, subscribers are stored in the `unmute_subscribers`
option (read it from the database or hook `unmute_newsletter_subscribed` to push
to your ESP). Set an action URL to post straight to Mailchimp/Klaviyo/etc.

---

## 5. Design system notes

- Palette tokens: near-black `#0B0A0E`, surfaces `#141218/#1B1824`, lavender
  accent `#B7A4F0`, deep accent `#8B6FE8` (all editable).
- Type: **Manrope** (body), **Cormorant Garamond** (serif accents/collections),
  brush display face for the hero (Permanent Marker default; switchable).
- Motifs: four-point sparkle mark, scratchy display caps, pills, numbered rules.
- Mobile-first grid: 2 → 3 → 4 product columns (desktop count from Customizer).
- Accessibility: skip link, focus-visible rings, `aria` labels on icon buttons,
  live regions for forms, `prefers-reduced-motion` respected, WCAG-friendly
  contrast on text colours.
- Performance: no CSS/JS frameworks, one stylesheet + one small vanilla script,
  system font fallbacks, `fetchpriority` on hero, lazy loading below the fold.
- RTL: logical properties throughout + `assets/css/rtl.css` auto-enqueued when
  the site language is RTL (e.g. Arabic). Default content is English.

---

## 6. Placeholders & licences

- `assets/img/hero-placeholder.jpg`, `story-placeholder.jpg` and `screenshot.png`
  are **AI-generated placeholder artworks** owned by this project — replace them
  in the Customizer (Hero / Brand story) and with your own campaign photography
  before launch. They contain no third-party IP.
- Fonts are served from Google Fonts (SIL OFL). Replace with self-hosted files by
  filtering `unmute_google_fonts_url` to return `''` and enqueuing your own.
- Icons are hand-drawn inline SVG inside the theme.

---

## 7. Extending / child theme

```php
/* Child theme functions.php example: swap fonts + add a section after the hero */
add_filter( 'unmute_google_fonts_url', '__return_empty_string' );
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'child-fonts', get_stylesheet_directory_uri() . '/fonts.css' );
}, 20 );
```

Useful hooks: `unmute_wishlist_markup` (inject a wishlist button),
`unmute_newsletter_subscribed` (sync an ESP), `unmute_google_fonts_url`.

---

## 8. Verification performed on this build

- PHP files parsed with a full PHP parser (glayzzle/php-parser) — **no syntax
  errors** in any `.php` file.
- CSS/JS reviewed for balanced blocks; JS is plain ES5-compatible vanilla.
- ZIP structure verified (`unmute/` folder at archive root, `style.css` header
  present, `screenshot.png` included).
- **Not tested in a live WordPress install** (no WP/PHP runtime in the authoring
  environment). After installing, please verify: WooCommerce pages, a variable
  product with Size/Colour, cart/checkout flow, and the Customizer live preview.

---

## 9. Recommended launch checklist

1. Replace hero/story placeholders with licensed or owned artwork.
2. Create 3 collections (categories) + 12–18 products with real measurements in
   the description (oversized fits need a size guide page).
3. Set up: Shipping zones, Taxes, Privacy policy page, Returns page (link it in
   Footer → Help menu), Terms page.
4. Menus: assign *Primary*, *Footer — company*, *Footer — help & policies*.
5. Install a caching/optimization plugin and serve WebP images.
6. Add Google Analytics 4 / Meta Pixel via a plugin (not theme edits).

**— Wear What You Feel.**
