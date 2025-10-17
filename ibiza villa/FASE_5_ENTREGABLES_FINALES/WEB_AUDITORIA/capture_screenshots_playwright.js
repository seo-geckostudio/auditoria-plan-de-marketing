/**
 * Script para capturar screenshots automáticamente usando Playwright
 * Uso: node capture_screenshots_playwright.js
 */

const { chromium } = require('playwright');
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
    url: 'https://ibizavilla.com/about',
    filename: 'ibizavilla_about.jpg',
    viewport: { width: 1440, height: 900 },
    description: 'Página Sobre Nosotros'
  },
  {
    url: 'https://ibizavilla.com/villas',
    filename: 'ibizavilla_villas.jpg',
    viewport: { width: 1440, height: 900 },
    description: 'Listado de Villas'
  }
];

async function captureScreenshot(page, capture) {
  console.log(`📸 Capturando: ${capture.description}`);
  console.log(`   URL: ${capture.url}`);

  try {
    // Configurar viewport
    await page.setViewportSize(capture.viewport);

    // Navegar a la URL
    await page.goto(capture.url, {
      waitUntil: 'networkidle',
      timeout: 30000
    });

    // Esperar un poco más para asegurar que todo cargó
    await page.waitForTimeout(2000);

    // Capturar screenshot
    const outputPath = path.join(SCREENSHOTS_DIR, capture.filename);
    await page.screenshot({
      path: outputPath,
      type: 'jpeg',
      quality: 90
    });

    console.log(`   ✓ Guardado: ${capture.filename}`);
    return { success: true, file: capture.filename, url: capture.url };

  } catch (error) {
    console.error(`   ✗ Error: ${error.message}`);
    return { success: false, file: capture.filename, url: capture.url, error: error.message };
  }
}

async function main() {
  console.log('🚀 Iniciando captura de screenshots con Playwright...\n');

  // Crear directorio si no existe
  try {
    await fs.mkdir(SCREENSHOTS_DIR, { recursive: true });
    console.log(`✓ Directorio creado: ${SCREENSHOTS_DIR}\n`);
  } catch (error) {
    console.log(`→ Directorio ya existe\n`);
  }

  // Iniciar navegador
  const browser = await chromium.launch({
    headless: true
  });

  const context = await browser.newContext({
    userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
  });

  const page = await context.newPage();
  console.log('✓ Navegador iniciado\n');

  // Capturar todas las URLs
  const results = [];
  for (const capture of captures) {
    const result = await captureScreenshot(page, capture);
    results.push(result);
  }

  await browser.close();
  console.log('\n✓ Navegador cerrado');

  // Resumen
  console.log('\n' + '='.repeat(50));
  console.log('RESUMEN DE CAPTURAS');
  console.log('='.repeat(50));

  const successful = results.filter(r => r.success).length;
  const failed = results.filter(r => !r.success).length;

  console.log(`✓ Exitosas: ${successful}`);
  console.log(`✗ Fallidas: ${failed}`);

  if (successful > 0) {
    console.log('\n📁 Archivos capturados:');
    results.filter(r => r.success).forEach(r => {
      console.log(`  ✓ ${r.file} (${r.url})`);
    });
  }

  if (failed > 0) {
    console.log('\n❌ Archivos con error:');
    results.filter(r => !r.success).forEach(r => {
      console.log(`  ✗ ${r.file}: ${r.error}`);
    });
  }

  console.log('\n✅ Proceso completado');
  console.log(`📂 Screenshots guardados en: ${SCREENSHOTS_DIR}`);
}

// Ejecutar
if (require.main === module) {
  main().catch(error => {
    console.error('❌ Error fatal:', error);
    process.exit(1);
  });
}

module.exports = { captureScreenshot, captures };
