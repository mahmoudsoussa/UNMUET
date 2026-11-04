const puppeteer = require('puppeteer-core');
let chromium = require('@sparticuz/chromium'); if (chromium.default) chromium = chromium.default;
(async () => {
  const inflate = require('@sparticuz/chromium').inflate || require('@sparticuz/chromium').default.inflate;
  await inflate(require('path').join(__dirname,'node_modules/@sparticuz/chromium/bin/al2023.tar.br'));
  const browser = await puppeteer.launch({args:[...chromium.args,'--no-sandbox'],executablePath:await chromium.executablePath(),headless:true,env:{...process.env,LD_LIBRARY_PATH:`/tmp/al2023/lib:${process.env.LD_LIBRARY_PATH||''}`}});
  const page = await browser.newPage(); await page.setViewport({width:1440,height:900});
  await page.goto('http://127.0.0.1:8080/preview/index.html',{waitUntil:'networkidle0'});
  const info = await page.evaluate(() => {
    const out = [];
    document.querySelectorAll('.featured .sec-head, .featured .pills, .featured__head, .featured .unmute-products, .featured .unmute-products > li').forEach(el => {
      const r = el.getBoundingClientRect();
      out.push({ cls: el.className.toString().slice(0,60), top: Math.round(r.top+window.scrollY), h: Math.round(r.height), w: Math.round(r.width) });
    });
    return { out, h1: document.querySelector('.hero__title').getBoundingClientRect().height, heroH: document.querySelector('.hero').getBoundingClientRect().height, overflow: document.documentElement.scrollWidth };
  });
  console.log(JSON.stringify(info, null, 1));
  await browser.close();
})();
