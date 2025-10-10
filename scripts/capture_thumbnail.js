// Captura una miniatura (screenshot) de la home indicada y la guarda como PNG
// Uso:
//   node scripts/capture_thumbnail.js --url "https://ejemplo.com" \
//        --out "ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/assets/home_thumbnail.png" \
//        --width 1280 --height 800 --wait 3000

const fs = require('fs');
const path = require('path');

function parseArgs() {
  const args = process.argv.slice(2);
  const opts = { url: null, out: null, width: 1280, height: 800, wait: 3000 };
  for (let i = 0; i < args.length; i++) {
    const a = args[i];
    if (a === '--url') opts.url = args[++i];
    else if (a === '--out') opts.out = args[++i];
    else if (a === '--width') opts.width = parseInt(args[++i], 10);
    else if (a === '--height') opts.height = parseInt(args[++i], 10);
    else if (a === '--wait') opts.wait = parseInt(args[++i], 10);
  }
  return opts;
}

async function main() {
  const { url, out, width, height, wait } = parseArgs();
  if (!url || !out) {
    console.error('Error: debes indicar --url y --out');
    console.error('Ejemplo: node scripts/capture_thumbnail.js --url "https://barnerbrand.com/" --out "ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/assets/home_thumbnail.png"');
    process.exit(1);
  }

  const puppeteer = require('puppeteer');
  const dir = path.dirname(out);
  fs.mkdirSync(dir, { recursive: true });

  const browser = await puppeteer.launch({ headless: 'new' });
  const page = await browser.newPage();
  await page.setViewport({ width, height, deviceScaleFactor: 1 });

  try {
    await page.goto(url, { waitUntil: ['domcontentloaded', 'networkidle2'] });
  } catch (e) {
    console.warn('Advertencia: problemas cargando la URL, se intentará capturar igualmente.', e.message);
  }

  if (wait && wait > 0) {
    await page.waitForTimeout(wait);
  }

  await page.screenshot({ path: out, fullPage: false });

  // Guardar metadatos de la captura
  const metaPath = path.join(dir, 'home_thumbnail.meta.json');
  const meta = { url, captured_at: new Date().toISOString(), width, height, file: path.basename(out) };
  fs.writeFileSync(metaPath, JSON.stringify(meta, null, 2), 'utf8');

  console.log(`Miniatura guardada en: ${out}`);
  console.log(`Metadatos: ${metaPath}`);

  await browser.close();
}

main().catch(err => {
  console.error('Fallo al capturar la miniatura:', err);
  process.exit(1);
});