import puppeteer from 'puppeteer';

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.setViewport({ width: 1512, height: 950, deviceScaleFactor: 1 });

  page.on('pageerror', error => console.log('PAGE ERROR:', error.message));

  await page.goto('file://' + process.cwd() + '/index.html', { waitUntil: 'networkidle0' });

  // reveal-on-scroll elements start hidden; force them visible for the shot
  await page.evaluate(() => {
    document.querySelectorAll('.reveal').forEach(e => e.classList.add('active'));
  });

  await page.screenshot({ path: 'shot-hero.png' });

  // scroll to first project tile
  await page.evaluate(() => {
    const el = document.querySelector('.web_applications .project-item');
    if (el) el.scrollIntoView({ block: 'start' });
  });
  await new Promise(r => setTimeout(r, 400));
  await page.screenshot({ path: 'shot-project.png' });

  // content-width check at hero
  const metrics = await page.evaluate(() => {
    const vw = window.innerWidth;
    const intro = document.querySelector('.intro')?.getBoundingClientRect().width;
    const proj = document.querySelector('.project-grid')?.getBoundingClientRect().width;
    return { vw, introPct: intro ? Math.round(intro / vw * 100) : null, projPct: proj ? Math.round(proj / vw * 100) : null };
  });
  console.log('Width %:', metrics);

  const overflow = await page.evaluate(() => {
    let issues = [];
    document.querySelectorAll('*').forEach(el => {
      const r = el.getBoundingClientRect();
      if (r.width > document.documentElement.clientWidth + 2) {
        issues.push(`${el.tagName}.${el.className} = ${Math.round(r.width)}`);
      }
    });
    return issues.slice(0, 10);
  });
  console.log('Overflow:', overflow);

  await browser.close();
})();
