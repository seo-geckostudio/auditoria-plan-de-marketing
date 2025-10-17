/**
 * Panel de administración para gestionar imágenes faltantes
 * Muestra una pantalla única con todas las instrucciones de captura
 */

class AdminPanel {
  constructor(imageChecker) {
    this.imageChecker = imageChecker;
    this.panelElement = null;
  }

  /**
   * Muestra el panel de administración
   */
  async show() {
    // Primero escanear todas las imágenes
    const results = await this.imageChecker.scanAllSections();

    if (!results) {
      console.error('No se pudieron obtener los resultados del escaneo');
      return;
    }

    // Crear el panel
    this.createPanel(results);

    // Mostrar el panel
    document.body.appendChild(this.panelElement);
  }

  /**
   * Crea el HTML del panel
   */
  createPanel(results) {
    const panel = document.createElement('div');
    panel.className = 'admin-panel-overlay';
    panel.innerHTML = `
      <div class="admin-panel">
        <div class="admin-panel-header">
          <h2>🖼️ Gestión de Imágenes - Auditoría SEO</h2>
          <button class="admin-panel-close" onclick="adminPanel.hide()">✕</button>
        </div>

        <div class="admin-panel-stats">
          <div class="stat-card stat-total">
            <span class="stat-value">${results.total}</span>
            <span class="stat-label">Total referencias</span>
          </div>
          <div class="stat-card stat-success">
            <span class="stat-value">${results.existing.length}</span>
            <span class="stat-label">Imágenes OK</span>
          </div>
          <div class="stat-card stat-warning">
            <span class="stat-value">${results.missing.length}</span>
            <span class="stat-label">Faltantes</span>
          </div>
        </div>

        ${this.renderMissingImages(results.missing)}
        ${this.renderExistingImages(results.existing)}
        ${this.renderCaptureInstructions(results.missing)}
      </div>
    `;

    this.panelElement = panel;
  }

  /**
   * Renderiza la lista de imágenes faltantes
   */
  renderMissingImages(missingImages) {
    if (missingImages.length === 0) {
      return `
        <div class="admin-section">
          <h3>✅ Todas las imágenes están disponibles</h3>
          <p>No hay imágenes faltantes en la auditoría.</p>
        </div>
      `;
    }

    const commands = this.imageChecker.generateCaptureCommands();

    return `
      <div class="admin-section admin-missing">
        <h3>⚠️ Imágenes Faltantes (${missingImages.length})</h3>
        <div class="images-table">
          <table>
            <thead>
              <tr>
                <th>Archivo</th>
                <th>Sección</th>
                <th>Página</th>
                <th>URL Sugerida</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              ${missingImages.map((img, index) => `
                <tr>
                  <td><code>${img.path.split('/').pop()}</code></td>
                  <td>${img.section}</td>
                  <td><code>${img.pageId}</code></td>
                  <td><a href="${img.url}" target="_blank">${img.url}</a></td>
                  <td>
                    <button class="btn-copy" onclick="adminPanel.copyCommand(${index})">
                      📋 Copiar comando
                    </button>
                  </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      </div>
    `;
  }

  /**
   * Renderiza la lista de imágenes existentes
   */
  renderExistingImages(existingImages) {
    if (existingImages.length === 0) return '';

    return `
      <div class="admin-section admin-existing">
        <details>
          <summary>✅ Imágenes Existentes (${existingImages.length})</summary>
          <div class="images-grid">
            ${existingImages.map(img => `
              <div class="image-card">
                <img src="${img.path}" alt="${img.pageId}" loading="lazy" />
                <div class="image-info">
                  <code>${img.path.split('/').pop()}</code>
                  <small>${img.section}</small>
                </div>
              </div>
            `).join('')}
          </div>
        </details>
      </div>
    `;
  }

  /**
   * Renderiza las instrucciones de captura
   */
  renderCaptureInstructions(missingImages) {
    if (missingImages.length === 0) return '';

    const commands = this.imageChecker.generateCaptureCommands();
    const playwrightConfig = this.generatePlaywrightConfig(commands);

    return `
      <div class="admin-section admin-instructions">
        <h3>📝 Instrucciones de Captura</h3>

        <div class="instruction-block">
          <h4>Opción 1: Actualizar script Playwright</h4>
          <p>Añade estas configuraciones al archivo <code>capture_screenshots_playwright.js</code>:</p>
          <pre><code>${playwrightConfig}</code></pre>
          <button class="btn-copy-all" onclick="adminPanel.copyPlaywrightConfig()">
            📋 Copiar configuración
          </button>
        </div>

        <div class="instruction-block">
          <h4>Opción 2: Ejecutar comando</h4>
          <p>Ejecuta este comando en tu terminal:</p>
          <pre><code>node capture_screenshots_playwright.js</code></pre>
          <button class="btn-copy-all" onclick="adminPanel.copyToClipboard('node capture_screenshots_playwright.js')">
            📋 Copiar comando
          </button>
        </div>

        <div class="instruction-block">
          <h4>Opción 3: Captura manual</h4>
          <p>Para cada imagen faltante:</p>
          <ol>
            <li>Abre la URL en tu navegador</li>
            <li>Ajusta el viewport a 1440x900</li>
            <li>Captura la pantalla y guarda con el nombre indicado</li>
            <li>Coloca el archivo en <code>images/screenshots/</code></li>
          </ol>
        </div>
      </div>
    `;
  }

  /**
   * Genera la configuración para Playwright
   */
  generatePlaywrightConfig(commands) {
    const captures = commands.map(cmd => `  {
    url: '${cmd.url}',
    filename: '${cmd.filename}',
    viewport: { width: 1440, height: 900 },
    description: '${cmd.section} - ${cmd.pageId}'
  }`).join(',\n');

    return `const captures = [\n${captures}\n];`;
  }

  /**
   * Copia un comando específico al portapapeles
   */
  async copyCommand(index) {
    const commands = this.imageChecker.generateCaptureCommands();
    const cmd = commands[index];

    if (cmd) {
      await this.copyToClipboard(cmd.nodeCommand);
      this.showNotification('✅ Comando copiado al portapapeles');
    }
  }

  /**
   * Copia la configuración completa de Playwright
   */
  async copyPlaywrightConfig() {
    const commands = this.imageChecker.generateCaptureCommands();
    const config = this.generatePlaywrightConfig(commands);

    await this.copyToClipboard(config);
    this.showNotification('✅ Configuración copiada al portapapeles');
  }

  /**
   * Copia texto al portapapeles
   */
  async copyToClipboard(text) {
    try {
      await navigator.clipboard.writeText(text);
      return true;
    } catch (error) {
      console.error('Error copiando:', error);
      // Fallback para navegadores antiguos
      const textarea = document.createElement('textarea');
      textarea.value = text;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
      return true;
    }
  }

  /**
   * Muestra una notificación temporal
   */
  showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'admin-notification';
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
      notification.classList.add('fade-out');
      setTimeout(() => notification.remove(), 300);
    }, 2000);
  }

  /**
   * Oculta el panel
   */
  hide() {
    if (this.panelElement) {
      this.panelElement.remove();
      this.panelElement = null;
    }
  }
}

// Variable global para acceso desde HTML
let adminPanel = null;

// Inicialización automática al cargar
document.addEventListener('DOMContentLoaded', () => {
  // Crear atajo de teclado: Ctrl+Shift+I para abrir panel
  document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.shiftKey && e.key === 'I') {
      e.preventDefault();
      if (!adminPanel) {
        const checker = new ImageChecker();
        adminPanel = new AdminPanel(checker);
      }
      adminPanel.show();
    }
  });

  console.log('💡 Panel de administración listo. Presiona Ctrl+Shift+I para abrir');
});
