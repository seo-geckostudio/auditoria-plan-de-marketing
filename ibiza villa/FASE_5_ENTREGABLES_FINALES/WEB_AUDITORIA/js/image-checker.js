/**
 * Sistema de detección automática de imágenes faltantes
 * Escanea todos los JSON de datos y verifica qué screenshots existen
 */

class ImageChecker {
  constructor() {
    this.missingImages = [];
    this.existingImages = [];
    this.checkedPaths = new Set();
  }

  /**
   * Escanea todas las secciones de datos buscando referencias a imágenes
   */
  async scanAllSections() {
    console.log('🔍 Escaneando secciones en busca de imágenes...');

    // Cargar configuración principal
    const config = await this.loadJSON('data/auditoria_config.json');

    if (!config || !config.secciones) {
      console.error('❌ No se pudo cargar la configuración');
      return;
    }

    // Escanear cada sección
    for (const seccion of config.secciones) {
      await this.scanSection(seccion);
    }

    console.log(`✓ Escaneo completado`);
    console.log(`  - Imágenes encontradas: ${this.existingImages.length}`);
    console.log(`  - Imágenes faltantes: ${this.missingImages.length}`);

    return {
      missing: this.missingImages,
      existing: this.existingImages,
      total: this.checkedPaths.size
    };
  }

  /**
   * Escanea una sección específica
   */
  async scanSection(seccion) {
    const dataFile = `data/${seccion.archivo_datos}`;
    const sectionData = await this.loadJSON(dataFile);

    if (!sectionData || !sectionData.paginas) {
      console.warn(`⚠️  No se pudo cargar ${dataFile}`);
      return;
    }

    // Escanear cada página de la sección
    for (const pagina of sectionData.paginas) {
      this.scanPageForImages(pagina, seccion.titulo);
    }
  }

  /**
   * Escanea una página buscando referencias a imágenes
   */
  scanPageForImages(pagina, seccionTitulo) {
    const imagePaths = [];

    // Buscar en contenido.screenshot
    if (pagina.contenido?.screenshot) {
      imagePaths.push(pagina.contenido.screenshot);
    }

    // Buscar en contenido.datos.screenshot
    if (pagina.contenido?.datos?.screenshot) {
      imagePaths.push(pagina.contenido.datos.screenshot);
    }

    // Buscar en contenido.datos.imagen
    if (pagina.contenido?.datos?.imagen) {
      imagePaths.push(pagina.contenido.datos.imagen);
    }

    // Buscar en arrays de imágenes
    if (pagina.contenido?.datos?.imagenes && Array.isArray(pagina.contenido.datos.imagenes)) {
      imagePaths.push(...pagina.contenido.datos.imagenes);
    }

    // Buscar en gráficas (pueden tener capturas de pantalla)
    if (pagina.contenido?.datos?.grafica?.screenshot) {
      imagePaths.push(pagina.contenido.datos.grafica.screenshot);
    }

    // Verificar cada path encontrado
    imagePaths.forEach(path => {
      if (path && !this.checkedPaths.has(path)) {
        this.checkedPaths.add(path);
        this.checkImageExists(path, pagina.id, seccionTitulo);
      }
    });
  }

  /**
   * Verifica si una imagen existe (simulado - en producción haría fetch real)
   */
  checkImageExists(imagePath, pageId, seccionTitulo) {
    // En el navegador, intentamos verificar si el archivo existe
    const img = new Image();

    img.onload = () => {
      this.existingImages.push({
        path: imagePath,
        pageId: pageId,
        section: seccionTitulo,
        status: 'exists'
      });
    };

    img.onerror = () => {
      this.missingImages.push({
        path: imagePath,
        pageId: pageId,
        section: seccionTitulo,
        status: 'missing',
        url: this.extractUrlFromPath(imagePath)
      });
    };

    img.src = imagePath;
  }

  /**
   * Intenta extraer la URL del sitio desde el nombre del archivo
   */
  extractUrlFromPath(imagePath) {
    const filename = imagePath.split('/').pop().replace('.jpg', '').replace('.png', '');

    // Patrones comunes: ibizavilla_home.jpg → https://ibizavilla.com
    if (filename.includes('_home')) {
      return filename.split('_')[0] ? `https://${filename.split('_')[0]}.com` : '';
    }

    if (filename.includes('_')) {
      const parts = filename.split('_');
      const domain = parts[0];
      const page = parts.slice(1).join('/');
      return `https://${domain}.com/${page}`;
    }

    return '';
  }

  /**
   * Carga un archivo JSON
   */
  async loadJSON(path) {
    try {
      const response = await fetch(path);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      return await response.json();
    } catch (error) {
      console.error(`Error cargando ${path}:`, error);
      return null;
    }
  }

  /**
   * Genera comandos para capturar las imágenes faltantes
   */
  generateCaptureCommands() {
    if (this.missingImages.length === 0) {
      return [];
    }

    return this.missingImages.map(img => {
      const filename = img.path.split('/').pop();
      const url = img.url || 'https://ibizavilla.com';

      return {
        filename: filename,
        url: url,
        path: img.path,
        pageId: img.pageId,
        section: img.section,
        playwrightCommand: `await page.goto('${url}'); await page.screenshot({ path: '${img.path}' });`,
        nodeCommand: `node capture_screenshots_playwright.js # Agregar: { url: '${url}', filename: '${filename}', viewport: { width: 1440, height: 900 } }`
      };
    });
  }
}

// Exportar para uso global
window.ImageChecker = ImageChecker;
