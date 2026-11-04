const puppeteer = require('puppeteer-core');
let chromium = require('@sparticuz/chromium');
if (chromium.default) chromium = chromium.default;
const BASE = 'http://127.0.0.1:8080/preview/';
const OUT = '/home/user/UNMUET/preview/shots';
const shots = (process.argv[2] || 'index').split(',');
(async () => {
  const execPath = await chromium.executablePath();
  const inflate = require('@sparticuz/chromium').inflate || (require('@sparticuz/chromium').default && require('@sparticuz/chromium').default.inflate);
  await inflate(require('path').join(__dirname, 'node_modules/@sparticuz/chromium/bin/al2023.tar.br'));
  const browser = await puppeteer.launch({args:[...chromium.args,'--no-sandbox','--disable-gpu','--force-color-profile=srgb'],executablePath:execPath,headless:true,
    env:{...process.env, LD_LIBRARY_PATH:`/tmp/al2023/lib:${process.env.LD_LIBRARY_PATH||''}`}});
  for (const spec of shots) {
    const [name, w, full] = spec.split(':');
    const width = parseInt(w || '1440', 10);
    const page = await browser.newPage();
    await page.setViewport({ width, height: 900, deviceScaleFactor: 1 });
    await page.goto(BASE + name + '.html', { waitUntil: 'networkidle0', timeout: 60000 });
    await page.addStyleTag({content:'.unmute-reveal{opacity:1!important;transform:none!important;transition:none!important}'});
    await page.evaluate(() => document.fonts ? document.fonts.ready : true);
    await new Promise(r => setTimeout(r, 600));
    const outDir = require('fs').existsSync(OUT) ? OUT : '/tmp/shots';
    await page.screenshot({ path: `${outDir}/${name}-${width}.jpg`, type: 'jpeg', quality: 80, fullPage: full === 'full' });
    console.log('captured', name, width);
    await page.close();
  }
  await browser.close();
  console.log('DONE');
})().catch(e => { console.error('FAIL', e.message); process.exit(1); });
