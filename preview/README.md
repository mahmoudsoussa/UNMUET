# UNMUTE theme — visual preview harness

Static HTML pages that mirror the theme's real markup and load the theme's
**actual** stylesheet (`../unmute/assets/css/main.css`) and script, so what you
see here is exactly what the WordPress theme renders (minus PHP/WooCommerce
data, which is replaced by representative demo content).

## Pages
- `index.html` — front page (hero, features, pills + featured grid, collections, story, newsletter, footer)
- `shop.html` — WooCommerce shop archive (breadcrumbs, toolbar, grid, pagination)
- `product.html` — single product (gallery + thumbs, variable size/colour, qty, add-to-cart, meta, shipping/returns blocks, tabs, related)

## Captured screenshots (real Chromium renders of the pages above)
- `shots/home-desktop.jpg` — front page, 1440px, full height
- `shots/home-mobile.jpg` — front page, 390px, full height
- `shots/shop-desktop.jpg` — shop archive, 1440px
- `shots/product-desktop.jpg` — single product, 1440px

## Regenerating screenshots
```bash
cd preview/tools
npm install            # puppeteer-core + @sparticuz/chromium + fontsource packs
python3 -m http.server 8080 --bind 0.0.0.0   # from the repo root, in another terminal
node screenshot.js     # writes ../shots/*.jpg
```
Fonts are self-hosted in `preview/fonts/` (SIL OFL, via @fontsource) so renders
are identical offline. Demo product photography in `preview/img/products/` is
original AI-generated placeholder art — replace with real campaign shots.
