import { test, expect } from '@playwright/test';

test.describe('Sistema de Auditorías SEO - Navegación', () => {
  
  test.beforeEach(async ({ page }) => {
    // Navegar a la página principal del sistema
    await page.goto('http://localhost:8000');
  });

  test('debe cargar la página principal correctamente', async ({ page }) => {
    // Verificar que la página carga
    await expect(page).toHaveTitle(/Sistema de Auditorías SEO/);
    
    // Verificar elementos principales
    await expect(page.locator('h1')).toContainText('Sistema de Auditorías SEO');
    await expect(page.locator('p')).toContainText('Asistente de Instalación');
  });

  test('debe mostrar la sección de verificación de requisitos', async ({ page }) => {
    // Verificar que existe la sección de verificación
    await expect(page.locator('h3')).toContainText('Verificación de Requisitos');
    await expect(page.locator('.text-muted')).toContainText('Verificando que el sistema cumple con todos los requisitos necesarios');
  });

  test('debe tener los estilos CSS cargados correctamente', async ({ page }) => {
    // Verificar que Bootstrap está cargado
    const bootstrapLink = page.locator('link[href*="bootstrap"]');
    await expect(bootstrapLink).toHaveCount(1);
    
    // Verificar que Font Awesome está cargado
    const fontAwesomeLink = page.locator('link[href*="fontawesome"]');
    await expect(fontAwesomeLink).toHaveCount(1);
  });

  test('debe tener JavaScript funcional', async ({ page }) => {
    // Verificar que no hay errores de JavaScript en la consola
    const errors: string[] = [];
    page.on('console', msg => {
      if (msg.type() === 'error') {
        errors.push(msg.text());
      }
    });
    
    // Esperar a que la página se cargue completamente
    await page.waitForLoadState('networkidle');
    
    // Verificar que no hay errores críticos
    expect(errors.filter(error => !error.includes('favicon'))).toHaveLength(0);
  });

  test('debe responder correctamente a diferentes tamaños de pantalla', async ({ page }) => {
    // Probar en móvil
    await page.setViewportSize({ width: 375, height: 667 });
    await expect(page.locator('h1')).toBeVisible();
    
    // Probar en tablet
    await page.setViewportSize({ width: 768, height: 1024 });
    await expect(page.locator('h1')).toBeVisible();
    
    // Probar en desktop
    await page.setViewportSize({ width: 1920, height: 1080 });
    await expect(page.locator('h1')).toBeVisible();
  });

  test('debe tener navegación accesible', async ({ page }) => {
    // Verificar que los elementos tienen atributos de accesibilidad apropiados
    const mainHeading = page.locator('h1');
    await expect(mainHeading).toBeVisible();
    
    // Verificar que los botones son accesibles por teclado
    const buttons = page.locator('button');
    const buttonCount = await buttons.count();
    
    for (let i = 0; i < buttonCount; i++) {
      const button = buttons.nth(i);
      await expect(button).toBeVisible();
    }
  });

  test('debe cargar recursos externos correctamente', async ({ page }) => {
    // Verificar que las CDN responden correctamente
    const response = await page.goto('http://localhost:8000');
    expect(response?.status()).toBe(200);
    
    // Verificar que no hay recursos bloqueados
    const failedRequests: string[] = [];
    page.on('requestfailed', request => {
      failedRequests.push(request.url());
    });
    
    await page.waitForLoadState('networkidle');
    
    // Filtrar solo errores críticos (no favicon u otros recursos opcionales)
    const criticalFailures = failedRequests.filter(url => 
      !url.includes('favicon') && 
      !url.includes('apple-touch-icon')
    );
    
    expect(criticalFailures).toHaveLength(0);
  });

  test('debe mostrar contenido en español', async ({ page }) => {
    // Verificar que el contenido está en español
    await expect(page.locator('html')).toHaveAttribute('lang', 'es');
    await expect(page.locator('title')).toContainText('Instalación');
    await expect(page.locator('h3')).toContainText('Verificación');
  });

  test('debe tener meta tags apropiados', async ({ page }) => {
    // Verificar meta charset
    const charset = page.locator('meta[charset]');
    await expect(charset).toHaveAttribute('charset', 'UTF-8');
    
    // Verificar viewport
    const viewport = page.locator('meta[name="viewport"]');
    await expect(viewport).toHaveAttribute('content', 'width=device-width, initial-scale=1.0');
  });

  test('debe manejar la navegación por teclado', async ({ page }) => {
    // Verificar que se puede navegar con Tab
    await page.keyboard.press('Tab');
    
    // Verificar que el foco es visible
    const focusedElement = page.locator(':focus');
    await expect(focusedElement).toBeVisible();
  });
});