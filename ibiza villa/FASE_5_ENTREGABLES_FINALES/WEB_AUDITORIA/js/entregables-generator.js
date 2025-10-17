/**
 * Generador Automático de Entregables CSV (Cliente)
 *
 * Este script se encarga de:
 * 1. Detectar qué CSVs necesita el módulo actual
 * 2. Verificar si ya existen (caché)
 * 3. Generarlos automáticamente si no existen
 * 4. Actualizar los botones de descarga con las URLs correctas
 * 5. Mostrar indicadores de carga/éxito
 *
 * @author Sistema de Auditoría SEO
 * @version 1.0
 */

class EntregablesGenerator {

    constructor(auditoriaId, categoria) {
        this.auditoriaId = auditoriaId;
        this.categoria = categoria;
        this.apiUrl = '/api/generar_entregable.php';
        this.generatingQueue = [];
        this.results = {};
    }

    /**
     * Inicializa la generación automática al cargar la página
     */
    init() {
        // Buscar todos los botones de descarga en la página
        const downloadButtons = document.querySelectorAll('[data-entregable-tipo]');

        if (downloadButtons.length === 0) {
            console.log('No se encontraron botones de entregables en esta página');
            return;
        }

        console.log(`Encontrados ${downloadButtons.length} entregables a generar`);

        // Generar cada CSV automáticamente
        downloadButtons.forEach(button => {
            const tipo = button.dataset.entregableTipo;
            const categoria = button.dataset.entregableCategoria || this.categoria;

            this.generarCSV(tipo, categoria, button);
        });
    }

    /**
     * Genera un CSV específico
     *
     * @param {string} tipo - Tipo de entregable (urls_huerfanas, etc)
     * @param {string} categoria - Categoría (arquitectura, keywords, etc)
     * @param {HTMLElement} button - Botón de descarga asociado
     */
    async generarCSV(tipo, categoria, button) {
        try {
            // Mostrar indicador de carga
            this.showLoading(button);

            // Llamar a la API
            const params = new URLSearchParams({
                auditoria_id: this.auditoriaId,
                tipo: tipo,
                categoria: categoria
            });

            const response = await fetch(`${this.apiUrl}?${params}`);
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Error al generar CSV');
            }

            // Actualizar botón con URL correcta
            this.updateButton(button, data);

            // Guardar resultado
            this.results[tipo] = data;

            console.log(`✓ CSV generado: ${tipo} (${data.count} items) ${data.cached ? '[CACHED]' : '[NEW]'}`);

        } catch (error) {
            console.error(`✗ Error generando ${tipo}:`, error);
            this.showError(button, error.message);
        }
    }

    /**
     * Muestra indicador de carga en el botón
     */
    showLoading(button) {
        const originalContent = button.innerHTML;
        button.dataset.originalContent = originalContent;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando...';
        button.classList.add('btn-loading');
    }

    /**
     * Actualiza el botón con la URL del CSV generado
     */
    updateButton(button, data) {
        button.disabled = false;
        button.classList.remove('btn-loading');
        button.classList.add('btn-ready');

        // Actualizar href con la URL correcta
        button.href = data.file_url;
        button.download = data.file_name;

        // Restaurar contenido original
        const icon = button.querySelector('i');
        if (icon) {
            icon.className = 'fas fa-download';
        }

        button.innerHTML = button.dataset.originalContent || `<i class="fas fa-download"></i> Descargar CSV`;

        // Añadir tooltip con info
        button.title = `${data.count} elementos | ${data.cached ? 'Caché' : 'Generado ahora'}`;

        // Actualizar badge de cantidad si existe
        const badge = button.closest('.entregable-card')?.querySelector('.entregable-count');
        if (badge) {
            badge.textContent = `${data.count} elementos`;
        }

        // Añadir indicador visual de éxito
        const successIndicator = document.createElement('span');
        successIndicator.className = 'csv-ready-indicator';
        successIndicator.innerHTML = data.cached ? '✓ Listo (caché)' : '✓ Generado';
        successIndicator.style.cssText = 'color: #2e7d32; font-size: 12px; margin-left: 10px;';

        if (!button.querySelector('.csv-ready-indicator')) {
            button.parentElement.appendChild(successIndicator);
        }
    }

    /**
     * Muestra error en el botón
     */
    showError(button, message) {
        button.disabled = true;
        button.classList.remove('btn-loading');
        button.classList.add('btn-error');
        button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Error';
        button.title = message;

        // Mostrar mensaje de error debajo del botón
        const errorMsg = document.createElement('div');
        errorMsg.className = 'csv-error-message';
        errorMsg.textContent = `Error: ${message}`;
        errorMsg.style.cssText = 'color: #c62828; font-size: 12px; margin-top: 8px;';

        button.parentElement.appendChild(errorMsg);
    }

    /**
     * Genera todos los CSVs de una categoría de una vez
     *
     * @param {string} categoria - Categoría (arquitectura, keywords, etc)
     */
    async generarTodos(categoria) {
        try {
            const params = new URLSearchParams({
                auditoria_id: this.auditoriaId,
                tipo: `todos_${categoria}`,
                categoria: categoria
            });

            const response = await fetch(`${this.apiUrl}?${params}`);
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Error al generar CSVs');
            }

            console.log(`✓ Todos los CSVs de ${categoria} generados:`, data.resultados);
            return data.resultados;

        } catch (error) {
            console.error(`✗ Error generando CSVs de ${categoria}:`, error);
            throw error;
        }
    }
}

/**
 * Auto-inicialización cuando el DOM está listo
 */
document.addEventListener('DOMContentLoaded', function() {
    // Detectar auditoriaId desde el contexto de la página
    const auditoriaId = document.body.dataset.auditoriaId
        || new URLSearchParams(window.location.search).get('auditoria_id')
        || document.querySelector('[data-auditoria-id]')?.dataset.auditoriaId;

    // Detectar categoría desde el módulo actual
    const moduloActual = document.body.dataset.modulo
        || new URLSearchParams(window.location.search).get('modulo')
        || 'arquitectura';

    const categoriaMap = {
        'fase3_arquitectura': 'arquitectura',
        'fase2_keywords': 'keywords',
        'fase4_onpage': 'on_page',
        'fase4_contenido': 'contenido',
        'fase4_enlaces': 'enlaces',
        'fase4_tecnico': 'tecnico'
    };

    const categoria = categoriaMap[moduloActual] || 'arquitectura';

    if (auditoriaId) {
        console.log(`Inicializando generador de entregables para auditoría ${auditoriaId} (${categoria})`);

        const generator = new EntregablesGenerator(auditoriaId, categoria);
        generator.init();

        // Exponer globalmente para debugging
        window.entregablesGenerator = generator;
    } else {
        console.warn('No se pudo detectar auditoriaId, generación automática deshabilitada');
    }
});
