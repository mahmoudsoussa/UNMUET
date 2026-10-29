/* Capture real renders of the UNMUTE theme preview pages. */
const puppeteer = require('puppeteer-core');
let chromium = require('@sparticuz/chromium');
if (chromium.default) chromium = chromium.default;

const BASE = 'http://127.0.0.1:8080/preview/';

(async () => {
  const execPath = await chromium.executablePath();
  // Outside AWS Lambda the shared-lib pack is not auto-extracted: do it manually.
  const inflate = require('@sparticuz/chromium').inflate || (require('@sparticuz/chromium').default && require('@sparticuz/chromium').default.inflate);
  await inflate(require('path').join(__dirname, 'node_modules/@sparticuz/chromium/bin/al2023.tar.br'));
  const browser = await puppeteer.launch({
    args: [...chromium.args, '--no-sandbox', '--disable-gpu', '--force-color-profile=srgb'],
    executablePath: execPath,
    headless: true,
    env: { ...process.env, LD_LIBRARY_PATH: `/tmp/al2023/lib:${process.env.LD_LIBRARY_PATH || ''}` },
    defaultViewport: { width: 1440, height: 900 },
  });

  const shots = [
    { url: BASE + 'index.html',   out: '../shots/home-desktop.jpg',   width: 1440, full: true  },
    { url: BASE + 'index.html',   out: '../shots/home-mobile.jpg',    width: 390,  full: true  },
    { url: BASE + 'shop.html',    out: '../shots/shop-desktop.jpg',   width: 1440, full: true  },
    { url: BASE + 'product.html', out: '../shots/product-desktop.jpg', width: 1440, full: true },
  ];

  for (const s of shots) {
    const page = await browser.newPage();
    await page.setViewport({ width: s.width, height: 900, deviceScaleFactor: 1 });
    await page.goto(s.url, { waitUntil: 'networkidle0', timeout: 60000 });
    // Make reveal-on-scroll sections visible for full-page capture.
    await page.addStyleTag({ content: '.unmute-reveal{opacity:1!important;transform:none!important;transition:none!important}' });
    await page.evaluate(() => document.fonts ? document.fonts.ready : true);
    await new Promise(r => setTimeout(r, 700));
    await page.screenshot({ path: s.out, type: 'jpeg', quality: 82, fullPage: s.full });
    console.log('captured', s.out);
    await page.close();
  }

  await browser.close();
  console.log('DONE');
})().catch(e => { console.error('FAIL', e.message); process.exit(1); });
