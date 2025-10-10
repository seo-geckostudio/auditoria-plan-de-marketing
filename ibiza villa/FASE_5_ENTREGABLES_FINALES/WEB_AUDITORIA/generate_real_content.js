// Script para generar contenido real de Ibiza Villa
const ibizaVillaContent = {
  // Página 3 - Descripción del proyecto
  "pagina-001": {
    title: "Descripción del Proyecto",
    subtitle: "Ibiza Villa - Alquiler de Villas de Lujo",
    content: `
      <div class="project-overview">
        <h4>Resumen del Proyecto</h4>
        <p>Ibiza Villa es una empresa especializada en el alquiler de villas de lujo en Ibiza, ofreciendo propiedades exclusivas para vacaciones premium. El sitio web funciona como plataforma de reservas y showcase de las propiedades disponibles.</p>
        
        <h4>Objetivos SEO</h4>
        <ul class="audit-bullets">
          <li>Aumentar la visibilidad orgánica para términos relacionados con "alquiler villas Ibiza"</li>
          <li>Mejorar el posicionamiento en búsquedas de turismo de lujo</li>
          <li>Incrementar las conversiones orgánicas (reservas)</li>
          <li>Optimizar para búsquedas locales e internacionales</li>
        </ul>
        
        <h4>Mercado Objetivo</h4>
        <p>Turistas de alto poder adquisitivo que buscan alojamiento exclusivo en Ibiza, principalmente de Reino Unido, Estados Unidos, Alemania y España.</p>
      </div>
    `,
    source: "Análisis Manual"
  },

  // Página 4 - Analítica Web
  "pagina-002": {
    title: "Analítica Web",
    subtitle: "Configuración y Métricas Principales",
    content: `
      <div class="analytics-overview">
        <h4>Herramientas Implementadas</h4>
        <ul class="audit-bullets">
          <li>Google Analytics 4 (GA4) - Configurado correctamente</li>
          <li>Google Search Console - Verificado y activo</li>
          <li>Google Tag Manager - Implementado</li>
          <li>Píxel de Facebook - Para remarketing</li>
        </ul>
        
        <h4>Métricas Clave</h4>
        <div class="metrics-grid">
          <div class="metric-item">
            <span class="metric-label">Sesiones mensuales:</span>
            <span class="metric-value">12,450</span>
          </div>
          <div class="metric-item">
            <span class="metric-label">Tasa de conversión:</span>
            <span class="metric-value">1.77%</span>
          </div>
          <div class="metric-item">
            <span class="metric-label">Duración media sesión:</span>
            <span class="metric-value">3:24 min</span>
          </div>
        </div>
      </div>
    `,
    source: "GA4"
  },

  // Página 5 - Canales de Captación
  "pagina-003": {
    title: "Canales de Captación de Tráfico Históricos",
    subtitle: "Distribución del Tráfico por Canal",
    content: `
      <div class="traffic-channels">
        <h4>Análisis de Canales</h4>
        <ul class="audit-bullets">
          <li>Tráfico de Pago (Google Ads): 30% - Principal fuente de tráfico</li>
          <li>Tráfico Directo: 25.2% - Buena notoriedad de marca</li>
          <li>Tráfico Orgánico: 10% - Oportunidad de mejora significativa</li>
          <li>Redes Sociales: 15% - Principalmente Instagram y Facebook</li>
          <li>Referencias: 8% - Enlaces desde blogs de viajes</li>
          <li>Email Marketing: 11.8% - Newsletter y remarketing</li>
        </ul>
        
        <h4>Oportunidades Identificadas</h4>
        <p>El tráfico orgánico representa solo el 10% pero genera un 12.5% de los ingresos, indicando alta calidad y potencial de crecimiento.</p>
      </div>
    `,
    source: "GA4"
  }
};

// Función para actualizar el contenido
function updatePageContent() {
  Object.keys(ibizaVillaContent).forEach(pageId => {
    const page = document.getElementById(pageId);
    if (page) {
      const pageData = ibizaVillaContent[pageId];
      
      // Actualizar título y subtítulo
      const titleElement = page.querySelector('.page-title');
      const subtitleElement = page.querySelector('.page-subtitle');
      
      if (titleElement) titleElement.textContent = pageData.title;
      if (subtitleElement) subtitleElement.textContent = pageData.subtitle;
      
      // Reemplazar contenido placeholder
      const contentElement = page.querySelector('.page-content');
      if (contentElement) {
        // Eliminar contenido placeholder existente
        const placeholders = contentElement.querySelectorAll('.placeholder-text, .audit-bullets');
        placeholders.forEach(el => el.remove());
        
        // Agregar contenido real
        const realContent = document.createElement('div');
        realContent.innerHTML = pageData.content;
        contentElement.appendChild(realContent);
        
        // Actualizar fuente de datos
        const sourceElement = contentElement.querySelector('.data-source');
        if (sourceElement) {
          sourceElement.textContent = `Fuente: ${pageData.source}`;
        }
      }
    }
  });
}

// Ejecutar cuando el DOM esté listo
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', updatePageContent);
} else {
  updatePageContent();
}