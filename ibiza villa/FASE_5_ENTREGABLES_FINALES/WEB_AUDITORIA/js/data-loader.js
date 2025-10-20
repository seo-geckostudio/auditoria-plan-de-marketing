/**
 * Data Loader - Sistema de carga de datos desde JSON
 * Separa presentación de datos para facilitar actualizaciones
 */

class AuditoriaDataLoader {
  constructor() {
    this.config = null;
    this.secciones = new Map();
    this.charts = new Map();
  }

  /**
   * Inicializa el sistema cargando la configuración
   */
  async init() {
    try {
      // Cargar configuración principal
      const configResponse = await fetch('data/auditoria_config.json');
      if (!configResponse.ok) throw new Error('No se pudo cargar la configuración');

      this.config = await configResponse.json();
      // Configuración cargada correctamente

      // Actualizar información de portada
      this.updatePortada();

      // Cargar datos de cada sección
      await this.loadAllSections();

      return true;
    } catch (error) {
      // No se pudieron cargar datos externos
      // Usando datos embebidos en HTML
      return false;
    }
  }

  /**
   * Actualiza la portada con datos de configuración
   */
  updatePortada() {
    const dateElement = document.getElementById('system-date');
    if (dateElement) {
      dateElement.textContent = this.config.auditoria.fecha;
    }

    const herramientasElement = document.querySelector('.cover-details .detail-value:last-child');
    if (herramientasElement) {
      herramientasElement.textContent = this.config.auditoria.herramientas.slice(0, 3).join(', ');
    }
  }

  /**
   * Carga datos de todas las secciones
   */
  async loadAllSections() {
    const promises = this.config.secciones.map(seccion =>
      this.loadSection(seccion)
    );

    await Promise.all(promises);
    // Todas las secciones cargadas
  }

  /**
   * Carga una sección específica
   */
  async loadSection(seccionConfig) {
    try {
      const response = await fetch(`data/${seccionConfig.archivo_datos}`);
      if (!response.ok) {
        // Archivo no cargado (silenciado)
        return;
      }

      const data = await response.json();
      this.secciones.set(seccionConfig.id, data);

      // Procesar páginas de la sección
      if (data.paginas && Array.isArray(data.paginas)) {
        data.paginas.forEach(pagina => this.renderPage(pagina));
      }

      // Sección cargada
    } catch (error) {
      // Error de carga (silenciado)
    }
  }

  /**
   * Renderiza una página con sus datos
   */
  renderPage(paginaData) {
    const pageElement = document.getElementById(paginaData.id);
    if (!pageElement) {
      // Elemento no encontrado (silenciado)
      return;
    }

    // Actualizar título y subtítulo
    const h1 = pageElement.querySelector('.page-header h1') || pageElement.querySelector('h1');
    const subtitle = pageElement.querySelector('.page-header .subtitle') || pageElement.querySelector('.subtitle');

    if (h1 && paginaData.titulo) {
      h1.textContent = paginaData.titulo;
    }

    if (subtitle && paginaData.subtitulo) {
      subtitle.textContent = paginaData.subtitulo;
    }

    // Renderizar contenido según tipo
    const body = pageElement.querySelector('.page-body') || pageElement.querySelector('.page-content');
    if (!body || !paginaData.contenido) return;

    switch (paginaData.contenido.tipo) {
      case 'metricas':
        this.renderMetricas(body, paginaData);
        break;
      case 'keywords':
        this.renderKeywords(body, paginaData);
        break;
      case 'canales':
        this.renderCanales(body, paginaData);
        break;
      case 'conclusiones':
        this.renderConclusiones(body, paginaData);
        break;
      case 'descripcion':
        this.renderDescripcion(body, paginaData);
        break;
      case 'keywords_pais':
        this.renderKeywordsPais(body, paginaData);
        break;
    }

    // Renderizar gráfica si existe
    if (paginaData.contenido.grafica) {
      this.renderChart(body, paginaData.id, paginaData.contenido.grafica);
    }
  }

  /**
   * Renderiza métricas
   */
  renderMetricas(container, paginaData) {
    const datos = paginaData.contenido.datos;

    // Crear grid de métricas
    const metricsGrid = document.createElement('div');
    metricsGrid.className = 'metrics-grid';
    metricsGrid.style.cssText = `
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 24px 0;
    `;

    // Métricas principales
    const metricas = [
      { label: 'Usuarios/mes', value: datos.usuarios_mes?.toLocaleString() || 'N/D' },
      { label: 'Sesiones', value: datos.sesiones_mes?.toLocaleString() || 'N/D' },
      { label: 'Páginas vistas', value: datos.paginas_vistas?.toLocaleString() || 'N/D' },
      { label: 'Duración sesión', value: datos.duracion_sesion_promedio || 'N/D' },
      { label: 'Tasa de rebote', value: datos.tasa_rebote || 'N/D' }
    ];

    metricas.forEach(metrica => {
      const card = this.createMetricCard(metrica.label, metrica.value);
      metricsGrid.appendChild(card);
    });

    // Limpiar contenido existente (excepto header)
    const existingContent = container.querySelector('.metrics-grid');
    if (existingContent) {
      existingContent.replaceWith(metricsGrid);
    } else {
      container.appendChild(metricsGrid);
    }
  }

  /**
   * Renderiza tabla de keywords
   */
  renderKeywords(container, paginaData) {
    const datos = paginaData.contenido.datos;

    if (!datos.top_keywords || datos.top_keywords.length === 0) return;

    // Crear tabla
    const table = document.createElement('table');
    table.className = 'data-table';
    table.style.cssText = `
      width: 100%;
      border-collapse: collapse;
      margin: 24px 0;
      font-size: 14px;
    `;

    // Header
    const thead = document.createElement('thead');
    thead.innerHTML = `
      <tr style="background: #f8f9fa; border-bottom: 2px solid #88B04B;">
        <th style="padding: 12px; text-align: left;">Keyword</th>
        <th style="padding: 12px; text-align: center;">Clics</th>
        <th style="padding: 12px; text-align: center;">Impresiones</th>
        <th style="padding: 12px; text-align: center;">CTR</th>
        <th style="padding: 12px; text-align: center;">Posición</th>
      </tr>
    `;
    table.appendChild(thead);

    // Body
    const tbody = document.createElement('tbody');
    datos.top_keywords.forEach((kw, index) => {
      const row = document.createElement('tr');
      row.style.borderBottom = '1px solid #e2e8f0';
      row.innerHTML = `
        <td style="padding: 12px; font-weight: 500;">${kw.keyword}</td>
        <td style="padding: 12px; text-align: center;">${kw.clics}</td>
        <td style="padding: 12px; text-align: center;">${kw.impresiones}</td>
        <td style="padding: 12px; text-align: center;">${kw.ctr}%</td>
        <td style="padding: 12px; text-align: center; color: ${kw.posicion <= 10 ? '#88B04B' : '#666'};">
          ${kw.posicion}
        </td>
      `;
      tbody.appendChild(row);
    });
    table.appendChild(tbody);

    container.appendChild(table);
  }

  /**
   * Renderiza análisis de canales
   */
  renderCanales(container, paginaData) {
    const datos = paginaData.contenido.datos;

    const grid = document.createElement('div');
    grid.className = 'channels-grid';
    grid.style.cssText = `
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin: 24px 0;
    `;

    Object.entries(datos).forEach(([canal, info]) => {
      const card = document.createElement('div');
      card.style.cssText = `
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
        border-top: 4px solid #88B04B;
      `;

      card.innerHTML = `
        <h4 style="margin: 0 0 16px 0; text-transform: capitalize; color: #1a1a1a;">
          ${canal}
        </h4>
        <div style="display: grid; gap: 8px;">
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Sesiones:</span>
            <strong>${info.sesiones.toLocaleString()}</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Porcentaje:</span>
            <strong style="color: #88B04B;">${info.porcentaje}%</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Conversiones:</span>
            <strong>${info.conversiones}</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Tasa conv.:</span>
            <strong style="color: #88B04B;">${info.tasa_conversion}%</strong>
          </div>
        </div>
      `;

      grid.appendChild(card);
    });

    container.appendChild(grid);
  }

  /**
   * Renderiza conclusiones
   */
  renderConclusiones(container, paginaData) {
    const datos = paginaData.contenido.datos;

    const sections = [
      { title: '✓ Fortalezas', items: datos.fortalezas, color: '#88B04B' },
      { title: '⚠ Debilidades', items: datos.debilidades, color: '#e53e3e' },
      { title: '⭐ Oportunidades', items: datos.oportunidades, color: '#3182ce' },
      { title: '🎯 Prioridades', items: datos.prioridades, color: '#805ad5' }
    ];

    sections.forEach(section => {
      const div = document.createElement('div');
      div.style.marginBottom = '32px';

      const h3 = document.createElement('h3');
      h3.textContent = section.title;
      h3.style.cssText = `
        color: ${section.color};
        margin: 0 0 16px 0;
        font-size: 18px;
        font-weight: 600;
      `;
      div.appendChild(h3);

      const ul = document.createElement('ul');
      ul.className = 'bullets';
      ul.style.cssText = `
        list-style: none;
        padding: 0;
        margin: 0;
      `;

      section.items.forEach(item => {
        const li = document.createElement('li');
        li.style.cssText = `
          padding: 8px 0 8px 24px;
          position: relative;
          line-height: 1.6;
        `;
        li.innerHTML = `
          <span style="position: absolute; left: 0; color: ${section.color};">•</span>
          ${item}
        `;
        ul.appendChild(li);
      });

      div.appendChild(ul);
      container.appendChild(div);
    });
  }

  /**
   * Renderiza descripción del proyecto
   */
  renderDescripcion(container, paginaData) {
    const datos = paginaData.contenido.datos;

    // Limpiar contenedor
    container.innerHTML = '';

    // Crear estructura de dos columnas
    const leftColumn = document.createElement('div');
    leftColumn.className = 'project-info';

    // Información del proyecto
    leftColumn.innerHTML = `
      <h3>Información del Proyecto</h3>
      <div class="info-grid">
        <span class="info-label">Dominio:</span>
        <span class="info-value">${datos.dominio}</span>

        <span class="info-label">Sector:</span>
        <span class="info-value">${datos.sector}</span>

        <span class="info-label">CMS:</span>
        <span class="info-value">${datos.cms}</span>

        <span class="info-label">Idiomas:</span>
        <span class="info-value">${datos.idiomas.join(', ')}</span>

        <span class="info-label">Mercados:</span>
        <span class="info-value">${datos.mercados_objetivo.join(', ')}</span>
      </div>

      <h3 style="margin-top: 16px;">Objetivos SEO</h3>
      <ul class="bullets" style="list-style: none; padding: 0; margin: 0;">
        ${datos.objetivos_seo.map(obj => `
          <li style="padding: 6px 0 6px 20px; position: relative; font-size: 14px; line-height: 1.5;">
            <span style="position: absolute; left: 0; color: #88B04B;">•</span>
            ${obj}
          </li>
        `).join('')}
      </ul>
    `;

    // Columna derecha con screenshot
    const rightColumn = document.createElement('div');
    rightColumn.className = 'project-screenshot';

    // Verificar si hay imagen en los datos
    const screenshot = paginaData.contenido.screenshot || datos.screenshot;
    if (screenshot) {
      rightColumn.innerHTML = `
        <img src="${screenshot}" alt="Screenshot ${datos.dominio}" class="screenshot-img" />
        <p class="screenshot-caption">Captura de pantalla: ${datos.dominio}</p>
      `;
    } else {
      // Placeholder si no hay imagen
      rightColumn.innerHTML = `
        <div style="width: 100%; aspect-ratio: 16/10; background: #f1f5f9; border: 2px dashed #cbd5e1;
                    display: flex; align-items: center; justify-content: center; border-radius: 4px;">
          <div style="text-align: center; color: #64748b;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            <p style="margin: 8px 0 0 0; font-size: 14px;">Screenshot pendiente</p>
            <p style="margin: 4px 0 0 0; font-size: 12px; font-style: italic;">${datos.dominio}</p>
          </div>
        </div>
      `;
    }

    container.appendChild(leftColumn);
    container.appendChild(rightColumn);
  }

  /**
   * Renderiza keywords por país
   */
  renderKeywordsPais(container, paginaData) {
    const datos = paginaData.contenido.datos;

    const grid = document.createElement('div');
    grid.style.cssText = `
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin: 24px 0;
    `;

    datos.por_pais.forEach(pais => {
      const card = document.createElement('div');
      card.style.cssText = `
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
        border-left: 4px solid #88B04B;
      `;

      card.innerHTML = `
        <h4 style="margin: 0 0 16px 0; color: #1a1a1a; font-size: 18px;">
          ${pais.pais}
        </h4>
        <div style="display: grid; gap: 10px; font-size: 14px;">
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Keywords:</span>
            <strong style="color: #88B04B; font-size: 20px;">${pais.keywords}</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Clics totales:</span>
            <strong>${pais.clics}</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #666;">Mejor posición:</span>
            <strong style="color: #88B04B;">${pais.mejor_posicion}</strong>
          </div>
          <div style="margin-top: 8px; padding-top: 12px; border-top: 1px solid #e2e8f0;">
            <div style="color: #666; font-size: 12px; margin-bottom: 4px;">Top keyword:</div>
            <div style="font-weight: 500;">"${pais.keyword_mejor}"</div>
          </div>
        </div>
      `;

      grid.appendChild(card);
    });

    container.appendChild(grid);
  }

  /**
   * Crea una tarjeta de métrica
   */
  createMetricCard(label, value) {
    const card = document.createElement('div');
    card.className = 'metric-card';
    card.style.cssText = `
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      border-top: 3px solid #88B04B;
    `;

    card.innerHTML = `
      <div style="font-size: 28px; font-weight: 700; color: #88B04B; margin-bottom: 8px;">
        ${value}
      </div>
      <div style="font-size: 14px; color: #666; font-weight: 500;">
        ${label}
      </div>
    `;

    return card;
  }

  /**
   * Renderiza una gráfica usando Chart.js
   */
  renderChart(container, pageId, chartConfig) {
    // Crear contenedor para el canvas
    const chartContainer = document.createElement('div');
    chartContainer.className = 'chart-container';
    chartContainer.style.cssText = `
      margin: 32px 0;
      padding: 24px;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
    `;

    const title = document.createElement('h4');
    title.textContent = chartConfig.titulo;
    title.style.cssText = `
      margin: 0 0 20px 0;
      color: #1a1a1a;
      font-size: 16px;
      font-weight: 600;
    `;
    chartContainer.appendChild(title);

    const canvasWrapper = document.createElement('div');
    canvasWrapper.style.cssText = 'position: relative; height: 300px;';

    const canvas = document.createElement('canvas');
    canvas.id = `chart-${pageId}`;
    canvasWrapper.appendChild(canvas);
    chartContainer.appendChild(canvasWrapper);

    container.appendChild(chartContainer);

    // Renderizar la gráfica con Chart.js
    this.createChart(canvas, chartConfig);
  }

  /**
   * Crea una gráfica con Chart.js
   */
  createChart(canvas, config) {
    if (typeof Chart === 'undefined') {
      // Chart.js no cargado (silenciado)
      return;
    }

    const ctx = canvas.getContext('2d');
    const colors = this.config?.colores || {
      primario: '#88B04B',
      secundario: '#6d8f3c',
      terciario: '#8cc77e',
      cuaternario: '#aed69e'
    };

    let chartConfig = {
      type: this.getChartType(config.tipo),
      data: {
        labels: config.etiquetas || [],
        datasets: []
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: config.tipo !== 'pie',
            position: 'bottom'
          }
        }
      }
    };

    // Configurar datasets según el tipo
    if (config.tipo === 'pie') {
      chartConfig.data.datasets.push({
        data: config.valores || [],
        backgroundColor: config.colores || [
          colors.primario,
          colors.secundario,
          colors.terciario,
          colors.cuaternario
        ],
        borderWidth: 2,
        borderColor: '#ffffff'
      });
    } else if (config.datasets) {
      // Gráficas con múltiples datasets
      const colorList = [colors.primario, colors.secundario, colors.terciario];
      config.datasets.forEach((dataset, index) => {
        chartConfig.data.datasets.push({
          label: dataset.label,
          data: dataset.valores,
          backgroundColor: dataset.color || colorList[index % colorList.length],
          borderColor: dataset.color || colorList[index % colorList.length],
          borderWidth: 2
        });
      });
    }

    // Crear y guardar la gráfica
    const chart = new Chart(ctx, chartConfig);
    this.charts.set(canvas.id, chart);
  }

  /**
   * Convierte tipo de gráfica del JSON a Chart.js
   */
  getChartType(tipo) {
    const typeMap = {
      'pie': 'pie',
      'bar': 'bar',
      'bar_horizontal': 'bar',
      'grouped_bar': 'bar',
      'line': 'line',
      'doughnut': 'doughnut'
    };
    return typeMap[tipo] || 'bar';
  }

  /**
   * Destruye todas las gráficas
   */
  destroyAllCharts() {
    this.charts.forEach(chart => chart.destroy());
    this.charts.clear();
  }
}

// Exportar para uso global
window.AuditoriaDataLoader = AuditoriaDataLoader;
