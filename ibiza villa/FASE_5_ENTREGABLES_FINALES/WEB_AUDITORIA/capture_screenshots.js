/**
 * Script para capturar screenshots automáticamente usando Puppeteer
 * Uso: node capture_screenshots.js
 */

const puppeteer = require('puppeteer');
const fs = require('fs').promises;
const path = require('path');

const SCREENSHOTS_DIR = path.join(__dirname, 'images', 'screenshots');

// URLs a capturar
const captures = [
  {
    url: 'https://ibizavilla.com',
    filename: 'ibizavilla_home.jpg',
    viewport: { width: 1440, height: 900 },
    description: 'Página principal IbizaVilla.com'
  },
  {
    url: 'https://ibizavilla.com/property/villa-example',
    filename: 'ibizavilla_property.jpg',
    viewport: { width: 1440, height: 900 },
    description: 'Página de propiedad (ejemplo)'
  }
];

async function captureScreenshot(browser, capture) {
  console.log(`📸 Capturando: ${capture.description}`);
  console.log(`   URL: ${capture.url}`);

  const page = await browser.newPage();

  try {
    // Configurar viewport
    await page.setViewport(capture.viewport);

    // Navegar a la URL
    await page.goto(capture.url, {
      waitUntil: 'networkidle2',
      timeout: 30000
    });

    // Esperar un poco más para asegurar que todo cargó
    await page.waitForTimeout(2000);

    // Capturar screenshot
    const outputPath = path.join(SCREENSHOTS_DIR, capture.filename);
    await page.screenshot({
      path: outputPath,
      type: 'jpeg',
      quality: 90,
      fullPage: false
    });

    console.log(`   ✓ Guardado: ${capture.filename}`);
    return { success: true, file: capture.filename };

  } catch (error) {
    console.error(`   ✗ Error: ${error.message}`);
    return { success: false, file: capture.filename, error: error.message };

  } finally {
    await page.close();
  }
}

async function main() {
  console.log('🚀 Iniciando captura de screenshots...\n');

  // Crear directorio si no existe
  try {
    await fs.mkdir(SCREENSHOTS_DIR, { recursive: true });
    console.log(`✓ Directorio creado: ${SCREENSHOTS_DIR}\n`);
  } catch (error) {
    console.log(`→ Directorio ya existe\n`);
  }

  // Iniciar navegador
  const browser = await puppeteer.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  console.log('✓ Navegador iniciado\n');

  // Capturar todas las URLs
  const results = [];
  for (const capture of captures) {
    const result = await captureScreenshot(browser, capture);
    results.push(result);
  }

  await browser.close();
  console.log('\n✓ Navegador cerrado');

  // Resumen
  console.log('\n' + '='.repeat(50));
  console.log('RESUMEN');
  console.log('='.repeat(50));

  const successful = results.filter(r => r.success).length;
  const failed = results.filter(r => !r.success).length;

  console.log(`✓ Exitosas: ${successful}`);
  console.log(`✗ Fallidas: ${failed}`);

  if (failed > 0) {
    console.log('\nArchivos con error:');
    results.filter(r => !r.success).forEach(r => {
      console.log(`  - ${r.file}: ${r.error}`);
    });
  }

  console.log('\n✅ Proceso completado');
}

// Ejecutar
if (require.main === module) {
  main().catch(error => {
    console.error('Error fatal:', error);
    process.exit(1);
  });
}

module.exports = { captureScreenshot, captures };
