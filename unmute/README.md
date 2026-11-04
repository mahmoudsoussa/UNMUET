# UNMUTE — WordPress + WooCommerce Theme

A custom-built, installable WordPress theme for the **UNMUTE** art-fashion label
(**EXPRESS WITHOUT LIMITS.**). The 2.0 “Aurora” release is a full brand
evolution: midnight surfaces, aurora light used as a signature instead of a
wash, editorial brush typography over Arabic-first RTL layouts, and a storefront
that stays visually identical from homepage through shop, product, cart,
checkout and account.

- **Version:** 2.0.0 (Aurora)
- **Requires:** WordPress 6.0+, PHP 7.4+, WooCommerce 7.0+ (recommended 8.x/9.x)
- **License:** GPL-2.0-or-later
- **Text domain:** `unmute` (UI strings ship in Arabic for RTL sites; the
  stylesheet is direction-agnostic and `assets/css/rtl.css` handles RTL)

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
├── style.css                  Theme header (2.0.0) + pre-paint base
├── theme.json                 Block-editor tokens (aurora palette, gradients, type)
├── functions.php              Setup, enqueues, CSS variables from Customizer
├── header.php / footer.php    Dark sticky header, drawer, search, footer
├── front-page.php             Brand landing (section order fixed, each toggleable)
├── index.php / archive.php / single.php / page.php / search.php / 404.php
├── comments.php / searchform.php
├── screenshot.jpg             1200×900 visual of the Aurora homepage
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
    ├── css/main.css           Full design system (mobile-first, ~4.6k lines)
    ├── css/rtl.css            RTL + Arabic typography layer (auto-loaded when RTL)
    ├── css/editor.css         Gutenberg dark canvas matching the front end
    ├── css/fonts.css          Self-hosted @font-face declarations
    ├── fonts/                 Bricolage Grotesque, Manrope, Cairo, Permanent Marker (woff2)
    ├── js/main.js             Vanilla JS: header, drawer, search, newsletter, Customizer preview
    └── img/                   hero-aurora.jpg, collection-aurora.jpg, story-aurora.jpg, placeholders
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
CSS custom properties (`--unmute-*`) so child themes can reuse them, and the same
palette is registered for the block editor in `theme.json` (Gutenberg blocks
inherit the aurora look instead of default WordPress blue).

### Newsletter storage

With no external action URL, subscribers are stored in the `unmute_subscribers`
option (read it from the database or hook `unmute_newsletter_subscribed` to push
to your ESP). Set an action URL to post straight to Mailchimp/Klaviyo/etc.

---

## 5. Design system notes

### 5.1 Aurora tokens

| Token | Value | Role |
|---|---|---|
| Midnight | `#0F1226` | page background |
| Midnight deep | `#171B35` | recessed bands |
| Surface / Surface 2 | `#1A1F3D` / `#232A4D` | cards, panels, inputs |
| Violet | `#7956B9` | primary accent |
| Teal | `#37BDB0` | secondary accent, links |
| Nebula Pink | `#C47BCB` | tertiary accent, sale, wishlist |
| Aurora Green | `#6FE3B4` | in-stock, confirmations |
| Cloud White | `#E8E8F0` | primary text |
| Muted | `#9BA2C7` | secondary text |

- **Aurora gradient** (`--grad-aurora`, 102° violet → nebula pink → teal) is used
  deliberately and rarely: primary buttons, the active nav pill, the current
  pagination page, the THE AURORA promo card, and one thin seam under the hero.
  Everything else is flat midnight/surface colour — no neon glows on text.
- Type: **Bricolage Grotesque** (display), **Manrope** (Latin body), **Cairo**
  (Arabic body + display), **Permanent Marker** (brush hero only). All four are
  self-hosted in `assets/fonts/` — no Google Fonts request.
- Motifs: four-point sparkle mark, brush headline, pill nav, numbered rules,
  thin aurora seam, editorial section headers with a hairline rule.
- Mobile-first grid: 2 → 3 → 4 product columns (desktop count from Customizer);
  the homepage featured grid runs 2 → 3 with the promo cell filling the last slot.
- Page-level layouts use one rhythm: 1240px container, 22–34px section gutters,
  `max-content` header rows so panels never get vertically centred by accident.
- Accessibility: skip link, focus-visible rings, `aria` labels on icon buttons,
  live regions for forms, `prefers-reduced-motion` respected, WCAG-friendly
  contrast on text colours.
- Performance: no CSS/JS frameworks, one stylesheet + one small vanilla script,
  system font fallbacks, `fetchpriority` on hero, lazy loading below the fold.
- RTL: logical properties throughout + `assets/css/rtl.css` auto-enqueued when
  the site language is RTL. The Arabic layer mirrors the hero artwork so the
  headline always lands on the open side, removes uppercase tracking from
  Arabic strings, swaps display type to Cairo, and mirrors directional icons.

---

## 6. Placeholders & licences

- `assets/img/hero-aurora.jpg`, `collection-aurora.jpg`, `story-aurora.jpg` and
  `screenshot.jpg` are **AI-generated placeholder artworks** owned by this
  project — replace them in the Customizer (Hero / Brand story) and with your own
  campaign photography before launch. They contain no third-party IP.
- Fonts are **self-hosted** in `assets/fonts/` (woff2, SIL OFL): Bricolage
  Grotesque, Manrope, Cairo and Permanent Marker. No third-party font request is
  made. To use a different family, add the woff2 files and declare them in
  `assets/css/fonts.css`.
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
  errors** in any `.php` file (24 files checked).
- CSS reviewed for balanced blocks (638/638); `main.js` passes `node --check`.
- Every template was rendered against the real theme CSS/JS in a headless
  browser at 1440px and 390px, through a static preview harness that reproduces
  WooCommerce's markup. Screenshots: `preview/shots/` (home, shop, product,
  cart, checkout, account, 404 — desktop + mobile).
- Fixed during this pass: a fatal call to a non-existent
  `the_post_pagination()`; a duplicated `<li>` in the shop loop; WooCommerce's
  legacy float grid winning over the theme grid; the star-rating webfont leaking
  `S`/`s` glyphs; cart totals and checkout review column not sitting beside
  their forms.
- **Not tested in a live WordPress install** (no WP/PHP runtime in the authoring
  environment). After installing, please verify: WooCommerce pages, a variable
  product with Size/Colour, cart/checkout flow, and the Customizer live preview.

---

## 9. Preview harness (no WordPress required)

`preview/` contains a static reproduction of every key page, rendered with the
**real** theme stylesheet and script:

```
preview/
├── index.html      Homepage (hero → features → pills → featured + THE AURORA → collections → story → newsletter)
├── shop.html       Shop archive (toolbar, pills, 4-up grid, badges, pagination)
├── product.html    Single product (gallery + thumbs, variations, tabs, shipping/returns, related)
├── cart.html       Cart (line items, coupon, totals column)
├── checkout.html   Checkout (billing fields + sticky order review)
├── account.html    My account (nav + orders table)
├── 404.html        Not found
├── assets fonts    fonts.css + self-hosted woff2 copies
└── tools/          shoot.js (screenshots) and inspect.js (layout metrics)
```

Serve the repository root (`python3 -m http.server 8080`) and open
`/preview/index.html`. `preview/shots/` holds the verified screenshots.

---

## 10. Recommended launch checklist

1. Replace hero/story placeholders with licensed or owned artwork.
2. Create 3 collections (categories) + 12–18 products with real measurements in
   the description (oversized fits need a size guide page).
3. Set up: Shipping zones, Taxes, Privacy policy page, Returns page (link it in
   Footer → Help menu), Terms page.
4. Menus: assign *Primary*, *Footer — company*, *Footer — help & policies*.
5. Install a caching/optimization plugin and serve WebP images.
6. Add Google Analytics 4 / Meta Pixel via a plugin (not theme edits).

**— Wear What You Feel.**
