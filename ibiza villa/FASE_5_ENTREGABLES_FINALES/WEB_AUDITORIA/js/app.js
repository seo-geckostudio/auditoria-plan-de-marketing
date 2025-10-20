/* Navegación, estado activo y carga opcional desde JSON */

document.addEventListener('DOMContentLoaded', async () => {
  // === Integración de datos reales (GA4/GSC) para páginas 006–014 ===
  // Utiliza CSV/JSON ubicados en assets/data/* si están disponibles.
  async function fetchText(path) {
    try {
      const res = await fetch(path);
      if (!res.ok) return null;
      return await res.text();
    } catch (e) { return null; }
  }

  // Renderizador simple de gráficos de barras con Chart.js
  function renderBarChart(canvasId, labels, values, title = '') {
    const canvas = document.getElementById(canvasId);
    if (!canvas || !window.Chart) return;
    const ctx = canvas.getContext('2d');
    // Destruir gráfico previo si existe
    if (canvas._chartInstance) {
      canvas._chartInstance.destroy();
      canvas._chartInstance = null;
    }
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          label: title || 'Datos',
          data: values,
          backgroundColor: '#88B04B',
          borderRadius: 4,
          maxBarThickness: 48
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { 
            ticks: { color: '#334155' },
            grid: { display: false }
          },
          y: {
            ticks: { color: '#334155' },
            grid: { color: '#e2e8f0' }
          }
        },
        plugins: {
          legend: { display: false },
          tooltip: { enabled: true }
        }
      }
    });
    canvas._chartInstance = chart;
  }

  // Renderizador simple de gráficos de líneas con Chart.js
  function renderLineChart(canvasId, labels, values, title = '') {
    const canvas = document.getElementById(canvasId);
    if (!canvas || !window.Chart) return;
    const ctx = canvas.getContext('2d');
    if (canvas._chartInstance) {
      canvas._chartInstance.destroy();
      canvas._chartInstance = null;
    }
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: title || 'Datos',
          data: values,
          borderColor: '#88B04B',
          backgroundColor: 'rgba(136,176,75,0.12)',
          borderWidth: 2,
          fill: true,
          tension: 0.3,
          pointRadius: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { 
            ticks: { color: '#334155' },
            grid: { display: false }
          },
          y: {
            ticks: { color: '#334155' },
            grid: { color: '#e2e8f0' }
          }
        },
        plugins: {
          legend: { display: false },
          tooltip: { enabled: true }
        }
      }
    });
    canvas._chartInstance = chart;
  }

  // Renderizador de líneas multi-serie con doble eje (CR en eje derecho)
  function renderLineChartMulti(canvasId, labels, series, title = '') {
    const canvas = document.getElementById(canvasId);
    if (!canvas || !window.Chart) return;
    const ctx = canvas.getContext('2d');
    if (canvas._chartInstance) {
      canvas._chartInstance.destroy();
      canvas._chartInstance = null;
    }
    const datasets = series.map(s => ({
      label: s.label,
      data: s.data,
      borderColor: s.color || '#88B04B',
      backgroundColor: (s.axis === 'y1') ? 'rgba(120,120,120,0.12)' : 'rgba(136,176,75,0.12)',
      borderWidth: 2,
      fill: true,
      tension: 0.3,
      pointRadius: 2,
      yAxisID: s.axis || 'y'
    }));

    const chart = new Chart(ctx, {
      type: 'line',
      data: { labels, datasets },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            ticks: { color: '#334155' },
            grid: { color: '#e2e8f0' }
          },
          y1: {
            position: 'right',
            ticks: {
              color: '#334155',
              callback: v => `${v}%`
            },
            grid: { drawOnChartArea: false }
          }
        },
        plugins: {
          legend: { display: true },
          tooltip: { enabled: true }
        }
      }
    });
    canvas._chartInstance = chart;
  }

  function parseCSV(text) {
    if (!text) return [];
    const lines = text.trim().split(/\r?\n/);
    const headers = lines.shift().split(',').map(h => h.trim());
    return lines.map(line => {
      const cols = line.split(',');
      const obj = {};
      headers.forEach((h, i) => obj[h] = (cols[i] || '').trim());
      return obj;
    });
  }

  function renderTableRows(tbodyId, rows, mapper) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return;
    tbody.innerHTML = '';
    if (!rows || rows.length === 0) {
      const tr = document.createElement('tr');
      const td = document.createElement('td');
      td.colSpan = 5;
      td.textContent = 'Sin datos disponibles. Coloca exports reales en assets/data/';
      tr.appendChild(td);
      tbody.appendChild(tr);
      return;
    }
    rows.forEach(r => {
      const tr = document.createElement('tr');
      mapper(r).forEach(cellVal => {
        const td = document.createElement('td');
        td.textContent = cellVal;
        tr.appendChild(td);
      });
      tbody.appendChild(tr);
    });
  }

  // Cargar datasets si existen y pintar tablas
  // Pag. 006: Canales históricos (GA4)
  fetchText('assets/data/custom/channels_last365.csv').then(text => {
    const rows = parseCSV(text);
    renderTableRows('table-channels-body', rows, r => [
      r.channelGroup || r.channel || '-',
      r.sessions || '-',
      r.sessionsPct || r.sessions_pct || '-',
      r.revenuePct || r.revenue_pct || '-',
      r.notes || '—'
    ]);

    // Gráfico: sesiones por canal
    const labels = rows.map(r => r.channelGroup || r.channel || '-');
    const values = rows.map(r => parseFloat((r.sessions || '0').toString().replace(/[,]/g,'')) || 0);
    renderBarChart('chart-channels', labels, values, 'Sesiones por canal');
  });

  // Pag. 008: Landing pages orgánicas (GA4)
  fetchText('assets/data/custom/pages_sample.csv').then(text => {
    const rows = parseCSV(text);
    // Ordenar por screenPageViews descendente si existe
    rows.sort((a,b) => (parseInt(b.screenPageViews||'0') - parseInt(a.screenPageViews||'0')));
    renderTableRows('table-landing-pages-body', rows.slice(0,10), r => [
      r.pagePath || r.page || '-',
      r.role || '—',
      r.notes || '—'
    ]);

    // Gráfico: pageviews por página (Top 10)
    const top = rows.slice(0,10);
    const labels = top.map(r => (r.pagePath || r.page || '-').slice(0,30));
    const values = top.map(r => parseInt(r.screenPageViews||'0'));
    renderBarChart('chart-landing-pages', labels, values, 'PageViews por página');
  });

  // Pag. 010: Países (GA4)
  fetchText('assets/data/custom/pageviews_by_country_last30.csv').then(text => {
    const rows = parseCSV(text);
    renderTableRows('table-countries-body', rows.slice(0,10), r => [
      r.country || '-',
      r.role || '—',
      r.notes || '—'
    ]);

    const labels = rows.slice(0,10).map(r => r.country || '-');
    const values = rows.slice(0,10).map(r => parseInt(r.screenPageViews||'0'));
    renderBarChart('chart-countries', labels, values, 'PageViews por país');
  });

  // Pag. 011: Dispositivos (GA4)
  fetchText('assets/data/custom/pageviews_by_device_last30.csv').then(text => {
    const rows = parseCSV(text);
    renderTableRows('table-devices-body', rows, r => [
      r.deviceCategory || r.device || '-',
      r.notes || '—'
    ]);

    const labels = rows.map(r => r.deviceCategory || r.device || '-');
    const values = rows.map(r => parseInt(r.screenPageViews||'0'));
    renderBarChart('chart-devices', labels, values, 'PageViews por dispositivo');
  });

  // Pag. 012: Buscadores (GA4/Ahrefs)
  fetchText('assets/data/custom/search_engines_last30.csv').then(text => {
    const rows = parseCSV(text);
    renderTableRows('table-search-engines-body', rows, r => [
      r.searchEngine || r.engine || '-',
      r.notes || '—'
    ]);

    const labels = rows.map(r => r.searchEngine || r.engine || '-');
    const values = rows.map(r => parseInt(r.sessions||'0'));
    renderBarChart('chart-search-engines', labels, values, 'Sesiones por buscador');
  });

  // Pag. 009: Comparativa YoY de sesiones orgánicas
  fetchText('assets/data/custom/organic_sessions_yoy_last12.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    const labels = rows.map(r => r.month || r.mes || '-');
    const prev = rows.map(r => parseFloat((r.sessions_prev || r.sesiones_prev || '0').toString().replace(/[,]/g,'')) || 0);
    const curr = rows.map(r => parseFloat((r.sessions_curr || r.sesiones_curr || '0').toString().replace(/[,]/g,'')) || 0);
    renderLineChartMulti('chart-yoy-sessions', labels, [
      { label: 'Sesiones año anterior', data: prev, color: '#787878', axis: 'y' },
      { label: 'Sesiones año actual', data: curr, color: '#88B04B', axis: 'y' }
    ], 'Sesiones orgánicas YoY');
  });

  // Utilidad: insertar módulo “sin conversiones” y ocultar gráficas
  function insertNoConversionsNotice(pageId, chartCanvasId) {
    try {
      const section = document.getElementById(pageId);
      if (!section) return;
      const content = section.querySelector('.page-content') || section;
      if (!content || content.querySelector('.no-conversions-module')) return;

      // Ocultar la gráfica si existe
      if (chartCanvasId) {
        const canvas = content.querySelector(`#${chartCanvasId}`);
        if (canvas) {
          const container = canvas.closest('.chart-container') || canvas.parentElement;
          if (container) container.style.display = 'none';
        }
      }

      const notice = document.createElement('div');
      notice.className = 'alert alert-warning no-conversions-module';
      notice.setAttribute('data-ai-task', 'configure_conversions');
      notice.innerHTML = `
        <strong>⚠️ No hay conversiones configuradas en GA4.</strong>
        <p>Las gráficas de conversiones no se muestran porque no existen eventos de conversión/microconversion configurados o datos disponibles.</p>
        <h5>Qué debes hacer</h5>
        <ul class="audit-bullets">
          <li>Instalar <em>conversiones</em> clave (p. ej., <code>purchase</code>, <code>generate_lead</code>, <code>submit_form</code>).</li>
          <li>Configurar <em>microconversiones</em> (clic en CTA, iniciar reserva, ver contacto).</li>
          <li>Filtrar origen orgánico: <code>sessionDefaultChannelGroup = "Organic Search"</code>.</li>
          <li>Generar y colocar CSVs en <code>assets/data/custom/</code>:
            <code>organic_conversions_by_month_last12.csv</code> y <code>organic_conversions_yoy_last12.csv</code>.</li>
        </ul>
      `;
      content.appendChild(notice);
    } catch (_) { /* no-op */ }
  }

  // INSTRUCCIONES PARA IA (relleno automático de conversiones)
  // -------------------------------------------------------------------
  // Objetivo: crear los datasets de conversiones si faltan.
  // 1) Dataset mensual últimos 12 meses: assets/data/custom/organic_conversions_by_month_last12.csv
  //    Columnas requeridas: month, conversions
  //    Ejemplo:
  //      month,conversions
  //      2024-11,12
  //      2024-12,9
  // 2) Dataset YoY de conversiones: assets/data/custom/organic_conversions_yoy_last12.csv
  //    Columnas requeridas: month, conv_prev, conv_curr
  //    Ejemplo:
  //      month,conv_prev,conv_curr
  //      2024-11,8,12
  //      2024-12,7,9
  // Fuente de datos: Google Analytics 4 (GA4 Data API — RunReport)
  // Parámetros recomendados:
  //   - dimensions: ["month", "sessionDefaultChannelGroup"]
  //   - metrics: ["conversions"]
  //   - filter: sessionDefaultChannelGroup == "Organic Search"
  //   - dateRanges: últimos 12 meses (p. ej., 2024-11-01 a 2025-10-31)
  // Guardar los CSV en la ruta indicada para que el sistema renderice las gráficas.
  // -------------------------------------------------------------------

  // Pag. 013: Conversiones orgánicas históricas
  fetchText('assets/data/custom/organic_conversions_by_month_last12.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) {
      insertNoConversionsNotice('pagina-013', 'chart-organic-conversions-013');
      return;
    }
    const labels = rows.map(r => r.month || r.mes || '-');
    const convs = rows.map(r => parseFloat((r.conversions || r.conv || '0').toString().replace(/[,]/g,'')) || 0);
    renderLineChart('chart-organic-conversions-013', labels, convs, 'Conversiones orgánicas');
  }).catch(() => {
    insertNoConversionsNotice('pagina-013', 'chart-organic-conversions-013');
  });

  // Pag. 014: Comparativa Conversiones Orgánicas YoY (si falta dataset, mostrar aviso)
  fetchText('assets/data/custom/organic_conversions_yoy_last12.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) {
      insertNoConversionsNotice('pagina-014');
      return;
    }
    // Si en el futuro se añade un canvas para YoY, aquí se podrá renderizar.
  }).catch(() => {
    insertNoConversionsNotice('pagina-014');
  });

  // Pag. 015: Posicionamiento orgánico (bar chart por categoría)
  fetchText('assets/data/custom/positions_by_category.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    const labels = rows.map(r => r.category || r.categoria || '-');
    const values = rows.map(r => parseFloat((r.avg_position || r.posicion_media || '0').toString().replace(/[,]/g,'')) || 0);
    renderBarChart('chart-ranking-positions', labels, values, 'Posición media por categoría');
  });

  // Pag. 016: Visibilidad orgánica (CSV manual)
  fetchText('assets/data/custom/visibility_index_project.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    const labels = rows.map(r => r.month || r.mes || '-');
    const values = rows.map(r => parseFloat((r.visibility_index || r.indice_visibilidad || '0').toString().replace(/[,]/g,'')) || 0);
    renderLineChart('chart-visibility-016', labels, values, 'Índice de visibilidad');
  });

  // Pag. 017: Comparativa visibilidad Ibiza Villa vs Sector (CSV manual)
  fetchText('assets/data/custom/visibility_comparison_project_vs_sector.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    const labels = rows.map(r => r.month || r.mes || '-');
    const ibiza = rows.map(r => parseFloat((r.ibiza_villa || r.iv || '0').toString().replace(/[,]/g,'')) || 0);
    const sector = rows.map(r => parseFloat((r.sector_avg || r.sector || '0').toString().replace(/[,]/g,'')) || 0);
    renderLineChartMulti('chart-sector-visibility-017', labels, [
      { label: 'Ibiza Villa', data: ibiza, color: '#88B04B', axis: 'y' },
      { label: 'Media sector', data: sector, color: '#88B04B', axis: 'y' }
    ], 'Comparativa visibilidad');
  });

  // Pag. 018: Páginas con clics orgánicos (GSC últimos 30 días)
  fetchText('assets/data/custom/gsc_pages_last30.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    // Normalizar claves y números
    const norm = rows.map(r => {
      const page = r.page || r.url || r.pageUrl || r.pagePath || '-';
      const clicks = parseFloat((r.clicks || r.Clics || '0').toString().replace(/[,]/g,'')) || 0;
      const impressions = parseFloat((r.impressions || r.Impresiones || '0').toString().replace(/[,]/g,'')) || 0;
      const ctrRaw = parseFloat((r.ctr || r.CTR || '0').toString().replace(/[,]/g,'')) || 0;
      const position = parseFloat((r.position || r.Posicion || '0').toString().replace(/[,]/g,'')) || 0;
      return { page, clicks, impressions, ctr: ctrRaw, position };
    });

    // Ordenar por clics descendente y tomar top 10
    norm.sort((a,b) => b.clicks - a.clicks);
    const top = norm.slice(0, 10);

    // Tabla
    renderTableRows('table-gsc-pages-body-018', top, r => [
      r.page,
      Math.round(r.clicks).toString(),
      Math.round(r.impressions).toString(),
      `${(r.ctr * 100).toFixed(1)}%`,
      r.position.toFixed(1)
    ]);

    // Gráfico de barras: clics por página
    const labels = top.map(r => r.page.length > 40 ? r.page.slice(0, 40) + '…' : r.page);
    const values = top.map(r => r.clicks);
    renderBarChart('chart-gsc-pages-018', labels, values, 'Clics orgánicos por página');
  });

  // Pag. 019: Keywords con clics orgánicos (GSC últimos 30 días)
  fetchText('assets/data/custom/gsc_queries_last30.csv').then(text => {
    const rows = parseCSV(text);
    if (!rows || rows.length === 0) return;
    const norm = rows.map(r => {
      const query = r.query || r.keyword || r.term || '-';
      const clicks = parseFloat((r.clicks || r.Clics || '0').toString().replace(/[,]/g,'')) || 0;
      const impressions = parseFloat((r.impressions || r.Impresiones || '0').toString().replace(/[,]/g,'')) || 0;
      const ctrRaw = parseFloat((r.ctr || r.CTR || '0').toString().replace(/[,]/g,'')) || 0;
      const position = parseFloat((r.position || r.Posicion || '0').toString().replace(/[,]/g,'')) || 0;
      return { query, clicks, impressions, ctr: ctrRaw, position };
    });

    norm.sort((a,b) => b.clicks - a.clicks);
    const top = norm.slice(0, 10);

    renderTableRows('table-gsc-queries-body-019', top, r => [
      r.query,
      Math.round(r.clicks).toString(),
      Math.round(r.impressions).toString(),
      `${(r.ctr * 100).toFixed(1)}%`,
      r.position.toFixed(1)
    ]);

    const labels = top.map(r => r.query.length > 40 ? r.query.slice(0, 40) + '…' : r.query);
    const values = top.map(r => r.clicks);
    renderBarChart('chart-gsc-queries-019', labels, values, 'Clics orgánicos por keyword');
  });

  // Asegurar footers en todas las páginas excepto portadas interiores
  (function ensureFooters() {
    const pages = Array.from(document.querySelectorAll('section.audit-page'));
    const isCover = (sec) => sec.classList.contains('cover-page') ||
                             sec.classList.contains('index-page') ||
                             /-cover$/i.test((sec.id||''));

    const nonCoverPages = pages.filter(sec => !isCover(sec));

    nonCoverPages.forEach(sec => {
      // Solo páginas con contenido real (evitar portadas internas/navegación)
      const content = sec.querySelector('.page-content');
      const hasRealContent = !!(content && content.querySelector(
        '.chart-container, .report-table, .audit-image, .audit-bullets, .kpi-grid, .content-analysis, .page-image'
      ));
      if (!hasRealContent) return;

      let footer = sec.querySelector('.page-footer');
      if (!footer) {
        footer = document.createElement('div');
        footer.className = 'page-footer';
        sec.appendChild(footer);
      }

      let left = footer.querySelector('.footer-text');
      if (!left) {
        left = document.createElement('span');
        left.className = 'footer-text';
        const title = (
          sec.querySelector('.page-title')?.textContent ||
          sec.querySelector('.page-header h1')?.textContent ||
          sec.querySelector('.page-header h2')?.textContent ||
          sec.id || ''
        ).trim();
        const fuentes = (sec.getAttribute('data-source') || '').trim();
        left.textContent = 'Página: ' + title + (fuentes ? ' — Fuentes: ' + fuentes : '');
        footer.insertBefore(left, footer.firstChild);
      }

      let right = footer.querySelector('.footer-page-num');
      if (!right) {
        right = document.createElement('span');
        right.className = 'footer-page-num';
        const numAttr = (sec.getAttribute('data-page-number') || '').trim();
        right.textContent = numAttr || (nonCoverPages.indexOf(sec) + 1).toString();
        footer.appendChild(right);
      }
    });
  })();
  // Inicializar sistema de carga de datos
  if (typeof AuditoriaDataLoader !== 'undefined') {
    const dataLoader = new AuditoriaDataLoader();
    const loaded = await dataLoader.init();

    if (loaded) {
      console.log('✓ Sistema de datos externo inicializado correctamente');
    } else {
      console.log('→ Usando datos embebidos en HTML (fallback)');
    }
  }

  // Actualizar fecha del sistema en la portada (fallback si no hay JSON)
  const systemDateElement = document.getElementById('system-date');
  if (systemDateElement && systemDateElement.textContent === 'Cargando fecha...') {
    const now = new Date();
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      timeZone: 'Europe/Madrid'
    };
    systemDateElement.textContent = now.toLocaleDateString('es-ES', options);
  }

  // Inicializar navegación desplegable
  initializeDropdownNavigation();

  const links = Array.from(document.querySelectorAll('.nav a'));
  const sections = links
    .map(a => {
      const href = a.getAttribute('href') || '';
      if (href.startsWith('#')) {
        return document.getElementById(href.slice(1));
      }
      try {
        return document.querySelector(href);
      } catch {
        return null;
      }
    })
    .filter(Boolean);
  const totalPages = sections.length;

  // Helpers para títulos y fuentes del footer
  function getPageTitle(section) {
    return (
      section.querySelector('.page-title')?.textContent ||
      section.querySelector('.page-header h1')?.textContent ||
      section.querySelector('.page-header h2')?.textContent ||
      section.id
    );
  }

  function getFuentesFromFooter(footer) {
    const ds = footer.querySelector('.data-source');
    if (!ds) return '';
    const text = ds.textContent.trim();
    return text.replace(/^Fuente:\s*/i, '').trim();
  }

  // Smooth scroll
  links.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const href = link.getAttribute('href') || '';
      const target = href.startsWith('#')
        ? document.getElementById(href.slice(1))
        : (() => { try { return document.querySelector(href); } catch { return null; } })();
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  // Active link on scroll
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const id = '#' + entry.target.id;
      const link = links.find(a => a.getAttribute('href') === id);
      if (entry.isIntersecting) {
        links.forEach(a => a.classList.remove('active'));
        if (link) link.classList.add('active');
      }
    });
  }, { rootMargin: '-30% 0px -60% 0px', threshold: 0.1 });

  sections.forEach(sec => observer.observe(sec));

  // Crear botón toggle flotante para el sidebar
  const sidebarToggleBtn = document.createElement('button');
  sidebarToggleBtn.className = 'sidebar-toggle-btn';
  sidebarToggleBtn.innerHTML = '☰';
  sidebarToggleBtn.setAttribute('aria-label', 'Toggle sidebar');
  document.body.appendChild(sidebarToggleBtn);

  // Toggle sidebar (collapsar/expandir desde la derecha)
  const sidebar = document.querySelector('.sidebar');
  const content = document.querySelector('.content');
  let sidebarVisible = true;

  if (sidebarToggleBtn && sidebar && content) {
    sidebarToggleBtn.addEventListener('click', () => {
      sidebarVisible = !sidebarVisible;

      if (sidebarVisible) {
        sidebar.classList.remove('collapsed');
        content.classList.remove('full-width');
        sidebarToggleBtn.classList.add('active');
        sidebarToggleBtn.innerHTML = '☰';
      } else {
        sidebar.classList.add('collapsed');
        content.classList.add('full-width');
        sidebarToggleBtn.classList.remove('active');
        sidebarToggleBtn.innerHTML = '☰';
      }
    });
  }

  // Toggle sidebar (modo compacto) - mantener funcionalidad original
  const toggle = document.querySelector('.toggle');
  if (toggle && sidebar) {
    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('compact');
      content.classList.toggle('expanded');
    });
  }

  // Función para inicializar la navegación desplegable
  function initializeDropdownNavigation() {
    const sectionToggles = document.querySelectorAll('.section-toggle');
    
    sectionToggles.forEach(toggle => {
      toggle.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        const sectionId = toggle.getAttribute('data-section');
        const subsectionList = document.getElementById(`subsection-${sectionId}`);
        const icon = toggle.querySelector('.section-icon');
        
        if (subsectionList && icon) {
          const isVisible = subsectionList.style.display !== 'none';
          
          // Cerrar todas las otras secciones
          document.querySelectorAll('.subsection-list').forEach(list => {
            list.style.display = 'none';
          });
          document.querySelectorAll('.section-icon').forEach(ic => {
            ic.textContent = '▼';
          });
          
          // Toggle la sección actual
          if (!isVisible) {
            subsectionList.style.display = 'block';
            icon.textContent = '▲';
            toggle.classList.add('active');
          } else {
            subsectionList.style.display = 'none';
            icon.textContent = '▼';
            toggle.classList.remove('active');
          }
        }
      });
    });
    
    // Inicializar todas las subsecciones como ocultas
    document.querySelectorAll('.subsection-list').forEach(list => {
      list.style.display = 'none';
    });
  }

  // Cargar JSON con datos reales de la auditoría
  const tryLoad = (url) => fetch(url).then(r => r.ok ? r.json() : Promise.reject('no_json'));
  tryLoad('analisis_pdf_auditoria/analisis_estructura.json')
    .catch(() => tryLoad('data/analisis_estructura.json'))
    .then(data => {
      // Espera estructura: { paginas: [{ id: 'pagina-001', titulo: '...', subtitulo: '...', bullets: [...] }, ...] }
      if (!data || !Array.isArray(data.paginas)) return;

      data.paginas.forEach((p, index) => {
        const sec = document.getElementById(p.id);
        if (!sec) return;
        const h1 = sec.querySelector('.page-header h1');
        const sub = sec.querySelector('.page-header .subtitle');
        const ul = sec.querySelector('.page-body .bullets') || document.createElement('ul');
        ul.className = 'bullets';

        if (h1 && p.titulo) h1.textContent = p.titulo;
        if (sub && p.subtitulo) sub.textContent = p.subtitulo;

        ul.innerHTML = '';
        (p.bullets || []).forEach(item => {
          const li = document.createElement('li');
          li.textContent = item;
          ul.appendChild(li);
        });

        const body = sec.querySelector('.page-body');
        if (body && !body.querySelector('.bullets')) body.appendChild(ul);

        // Agregar imagen correspondiente
        addAuditImage(sec, p, index + 1); // +1 porque las imágenes empiezan en 1

        // Footer: izquierda (página y fuentes condicional) + derecha (solo número)
        const footer = sec.querySelector('.page-footer');
        if (footer) {
          const left = footer.querySelector('.footer-text') || document.createElement('span');
          left.className = 'footer-text';
          const titulo = p.titulo || getPageTitle(sec);
          const fuentesTxt = Array.isArray(p.fuentes) ? p.fuentes.join(', ') : (p.fuentes || '');
          left.textContent = `Página: ${titulo}` + (fuentesTxt ? ` — Fuentes: ${fuentesTxt}` : '');

          let right = footer.querySelector('.footer-page-num');
          if (!right) {
            right = document.createElement('span');
            right.className = 'footer-page-num';
            footer.appendChild(right);
          }
          const pageIndex = sections.indexOf(sec) + 1;
          right.textContent = `${pageIndex}`;

          // Eliminar el elemento de fuente original del footer para evitar duplicaciones
          const dataSourceEl = footer.querySelector('.data-source');
          if (dataSourceEl) dataSourceEl.remove();

          if (!footer.contains(left)) footer.insertBefore(left, footer.firstChild);
        }
      });

      // Crear navegación jerárquica con secciones principales
      const nav = document.querySelector('.nav ul');
      if (nav && data.secciones) {
        nav.innerHTML = '';
        
        // Agregar enlaces principales (portada e índice)
        const portadaLi = document.createElement('li');
        const portadaA = document.createElement('a');
        portadaA.href = '#portada';
        portadaA.textContent = 'Portada';
        portadaLi.appendChild(portadaA);
        nav.appendChild(portadaLi);
        
        const indiceLi = document.createElement('li');
        const indiceA = document.createElement('a');
        indiceA.href = '#indice';
        indiceA.textContent = 'Índice General';
        indiceLi.appendChild(indiceA);
        nav.appendChild(indiceLi);
        
        // Agregar secciones principales con navegación expandible
        data.secciones.forEach(seccion => {
          // Crear elemento de sección principal
          const sectionLi = document.createElement('li');
          sectionLi.className = 'nav-section';
          
          const sectionHeader = document.createElement('div');
          sectionHeader.className = 'nav-section-header';
          sectionHeader.innerHTML = `
            <a href="#${seccion.id}-cover" class="section-main-link">${seccion.titulo}</a>
            <button class="section-toggle" data-section="${seccion.id}">▼</button>
          `;
          
          const sectionContent = document.createElement('ul');
          sectionContent.className = 'nav-section-content';
          sectionContent.style.display = 'none';
          
          // Agregar páginas de la sección
          seccion.paginas.forEach(pageNum => {
            const page = data.paginas.find(p => p.id === `pagina-${pageNum.toString().padStart(3, '0')}`);
            if (page) {
              const pageLi = document.createElement('li');
              const pageA = document.createElement('a');
              pageA.href = `#${page.id}`;
              pageA.textContent = `${pageNum}. ${page.titulo || page.id}`;
              pageLi.appendChild(pageA);
              sectionContent.appendChild(pageLi);
            }
          });
          
          sectionLi.appendChild(sectionHeader);
          sectionLi.appendChild(sectionContent);
          nav.appendChild(sectionLi);
          
          // Agregar funcionalidad de toggle
          const toggleBtn = sectionHeader.querySelector('.section-toggle');
          toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const isVisible = sectionContent.style.display !== 'none';
            sectionContent.style.display = isVisible ? 'none' : 'block';
            toggleBtn.textContent = isVisible ? '▼' : '▲';
          });
        });
      }

      // Construir índice interactivo (excluye portada/índice)
      const indiceSec = document.getElementById('indice');
      const indiceLista = document.getElementById('indice-lista');
      if (indiceSec && indiceLista) {
        indiceLista.innerHTML = '';
        const paginasContenido = data.paginas.filter(p => p.id !== 'portada' && p.id !== 'indice');
        paginasContenido.forEach((p, idx) => {
          const li = document.createElement('li');
          const a = document.createElement('a');
          a.href = `#${p.id}`;
          a.textContent = `${idx + 1}. ${p.titulo || p.id}`;
          a.style.cursor = 'pointer';
          a.style.color = '#88B04B';
          a.style.textDecoration = 'none';
          a.addEventListener('mouseover', () => a.style.textDecoration = 'underline');
          a.addEventListener('mouseout', () => a.style.textDecoration = 'none');
          li.appendChild(a);
          indiceLista.appendChild(li);
        });
        
        // Agregar estilos al índice
        indiceLista.style.listStyle = 'none';
        indiceLista.style.padding = '0';
        indiceLista.style.margin = '0';
        
        // Estilo para cada elemento li
        const liElements = indiceLista.querySelectorAll('li');
        liElements.forEach(li => {
          li.style.padding = '8px 0';
          li.style.borderBottom = '1px solid #e2e8f0';
        });
      }

      logAction('json_loaded', { paginas: data.paginas.length });
    })
    .catch(() => {
      // Fallback sin JSON: formatear footers con título actual y fuentes existentes
      sections.forEach((sec, idx) => {
        const footer = sec.querySelector('.page-footer');
        if (!footer) return;
        const left = footer.querySelector('.footer-text') || document.createElement('span');
        left.className = 'footer-text';

        const titulo = getPageTitle(sec);
        const fuentes = getFuentesFromFooter(footer);

        // Eliminar el elemento de fuente original del footer para que el lado derecho quede limpio
        const dataSourceEl = footer.querySelector('.data-source');
        if (dataSourceEl) dataSourceEl.remove();

        left.textContent = `Página: ${titulo}` + (fuentes ? ` — Fuentes: ${fuentes}` : '');
        if (!footer.contains(left)) footer.insertBefore(left, footer.firstChild);

        let right = footer.querySelector('.footer-page-num');
        if (!right) {
          right = document.createElement('span');
          right.className = 'footer-page-num';
          footer.appendChild(right);
        }
        right.textContent = `${idx + 1}`;
      });
    });

  // Cargar resumen desde analisis_pdf_auditoria/resumen_analisis.txt (si existe)
  fetch('/analisis_pdf_auditoria/resumen_analisis.txt')
    .then(r => r.ok ? r.text() : Promise.reject('no_txt'))
    .then(text => {
      const el = document.getElementById('portada-resumen');
      if (el) {
        el.textContent = text.trim().slice(0, 1000);
      }
      logAction('resumen_loaded', { size: text.length });
    })
    .catch(() => {});

  // Logging util
  function logAction(action, details = {}) {
    try {
      fetch('api/logger.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action, details, timestamp: new Date().toISOString() })
      }).catch(() => {});
    } catch (e) {}
  }

  // Función para agregar imágenes de auditoría
  function addAuditImage(section, pageData, index) {
    // No agregar imágenes a portada e índice
    if (pageData.id === 'portada' || pageData.id === 'indice') return;
    
    const body = section.querySelector('.page-body') || section.querySelector('.page-content');
    if (!body) return;
    
    // Extraer número de página del ID (pagina-XXX)
    let slideNumber;
    if (pageData.id.startsWith('pagina-')) {
      slideNumber = parseInt(pageData.id.replace('pagina-', ''));
    } else {
      slideNumber = index;
    }
    
    if (slideNumber < 1 || slideNumber > 131) return;
    
    // Crear contenedor de imagen
    const imageContainer = document.createElement('div');
    imageContainer.className = 'image-container';
    
    const img = document.createElement('img');
    img.className = 'audit-image';
    img.src = `analisis_pdf_auditoria/Diapositiva${slideNumber}.JPG`;
    img.alt = `Auditoría ${pageData.titulo} - Diapositiva ${slideNumber}`;
    img.loading = 'lazy';
    
    // Manejar errores de carga
    img.onerror = function() {
      console.warn(`No se pudo cargar la imagen: Diapositiva${slideNumber}.JPG`);
      this.style.display = 'none';
    };
    
    imageContainer.appendChild(img);
    
    // Insertar imagen después del header pero antes del contenido
    const existingContent = body.querySelector('.bullets') || body.querySelector('ul') || body.querySelector('.audit-bullets');
    if (existingContent) {
      body.insertBefore(imageContainer, existingContent);
    } else {
      body.appendChild(imageContainer);
    }
    
    // Agregar visualización de datos si hay métricas
    if (pageData.bullets && pageData.bullets.length > 0) {
      addDataVisualization(body, pageData);
    }
  }
  
  // Función para agregar visualización de datos
  function addDataVisualization(body, pageData) {
    const dataViz = document.createElement('div');
    dataViz.className = 'data-visualization';
    
    const title = document.createElement('h4');
    title.textContent = 'Datos de la Auditoría';
    title.style.margin = '0 0 12px 0';
    title.style.color = '#88B04B';
    dataViz.appendChild(title);
    
    // Crear grid de métricas si hay datos numéricos
    const metrics = extractMetrics(pageData.bullets);
    if (metrics.length > 0) {
      const metricsGrid = document.createElement('div');
      metricsGrid.className = 'metrics-grid';
      
      metrics.forEach(metric => {
        const card = document.createElement('div');
        card.className = 'metric-card';
        
        const value = document.createElement('div');
        value.className = 'metric-value';
        value.textContent = metric.value;
        
        const label = document.createElement('div');
        label.className = 'metric-label';
        label.textContent = metric.label;
        
        card.appendChild(value);
        card.appendChild(label);
        metricsGrid.appendChild(card);
      });
      
      dataViz.appendChild(metricsGrid);
    }
    
    body.appendChild(dataViz);
  }
  
  // Función para extraer métricas de los bullets
  function extractMetrics(bullets) {
    const metrics = [];
    
    bullets.forEach(bullet => {
      // Buscar números y porcentajes
      const percentMatch = bullet.match(/(\d+(?:\.\d+)?)\s*%/);
      const numberMatch = bullet.match(/(\d+(?:,\d{3})*(?:\.\d+)?)/);
      
      if (percentMatch) {
        metrics.push({
          value: percentMatch[1] + '%',
          label: bullet.replace(percentMatch[0], '').trim().substring(0, 30) + '...'
        });
      } else if (numberMatch && !percentMatch) {
        metrics.push({
          value: numberMatch[1],
          label: bullet.replace(numberMatch[0], '').trim().substring(0, 30) + '...'
        });
      }
    });
    
    return metrics.slice(0, 4); // Máximo 4 métricas por página
  }

  logAction('page_load', { totalPages });

  // Log al imprimir
  window.addEventListener('beforeprint', () => {
    logAction('print', { totalPages });
  });
  // Pag. 007: Tráfico orgánico histórico (GA4) — sesiones, conversiones y CR%
  Promise.all([
    fetchText('assets/data/custom/organic_sessions_by_month_last12.csv'),
    fetchText('assets/data/custom/organic_conversions_by_month_last12.csv')
  ]).then(([textSess, textConv]) => {
    if (!textSess) return; // sin sesiones no hay gráfico
    const rowsSess = parseCSV(textSess);
    const labels = rowsSess.map(r => r.month || r.mes || '-');
    const sessions = rowsSess.map(r => parseInt((r.sessions || '0').toString().replace(/[,]/g,'')) || 0);

    let conversions = [];
    if (textConv) {
      const rowsConv = parseCSV(textConv);
      const mapConv = new Map(rowsConv.map(r => [ (r.month || r.mes || '-'), parseInt((r.conversions || '0').toString().replace(/[,]/g,'')) || 0 ]));
      conversions = labels.map(m => mapConv.get(m) || 0);
    }

    const cr = (conversions.length ? labels.map((_, i) => {
      const s = sessions[i] || 0;
      const c = conversions[i] || 0;
      return s > 0 ? +(c / s * 100).toFixed(2) : 0;
    }) : []);

    if (document.getElementById('chart-organic-historical')) {
      const series = [
        { label: 'Sesiones', data: sessions, axis: 'y', color: '#88B04B' },
        ...(conversions.length ? [{ label: 'Conversiones', data: conversions, axis: 'y', color: '#88B04B' }] : []),
        ...(cr.length ? [{ label: 'CR %', data: cr, axis: 'y1', color: '#787878' }] : [])
      ];
      // Si solo tenemos sesiones, usa renderLineChart simple
      if (series.length === 1) {
        renderLineChart('chart-organic-historical', labels, sessions, 'Sesiones orgánicas — últimos 12 meses');
      } else {
        renderLineChartMulti('chart-organic-historical', labels, series, 'Sesiones, Conversiones y CR — últimos 12 meses');
      }
    }
  }).catch(() => { /* silencioso si faltan datasets */ });

});