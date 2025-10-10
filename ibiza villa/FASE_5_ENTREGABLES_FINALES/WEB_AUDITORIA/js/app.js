/* Navegación, estado activo y carga opcional desde JSON */

document.addEventListener('DOMContentLoaded', () => {
  // Actualizar fecha del sistema en la portada
  const systemDateElement = document.getElementById('system-date');
  if (systemDateElement) {
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
    .map(a => document.querySelector(a.getAttribute('href')))
    .filter(Boolean);
  const totalPages = sections.length;

  // Smooth scroll
  links.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const id = link.getAttribute('href');
      const target = document.querySelector(id);
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

  // Toggle sidebar (modo compacto)
  const toggle = document.querySelector('.toggle');
  const sidebar = document.querySelector('.sidebar');
  if (toggle && sidebar) {
    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('compact');
      document.querySelector('.content').classList.toggle('expanded');
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
  tryLoad('../../../analisis_pdf_auditoria/analisis_estructura.json')
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

        // Footer: izquierda (página y fuentes) + derecha (x de Y)
        const footer = sec.querySelector('.page-footer');
        if (footer) {
          const left = footer.querySelector('.footer-text') || document.createElement('span');
          left.className = 'footer-text';
          const fuentesTxt = Array.isArray(p.fuentes) ? p.fuentes.join(', ') : (p.fuentes || '');
          left.textContent = `Página: ${p.titulo || p.id} — Fuentes: ${fuentesTxt}`;

          let right = footer.querySelector('.footer-page-num');
          if (!right) {
            right = document.createElement('span');
            right.className = 'footer-page-num';
            footer.appendChild(right);
          }
          const pageIndex = sections.indexOf(sec) + 1;
          right.textContent = `Página ${pageIndex} de ${totalPages}`;

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
          a.style.color = '#54a34a';
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
        const h1 = sec.querySelector('.page-header h1');
        const footer = sec.querySelector('.page-footer');
        if (!footer) return;
        const left = footer.querySelector('.footer-text') || document.createElement('span');
        left.className = 'footer-text';
        const existing = footer.querySelector('.footer-text')?.textContent || '';
        const fuentes = existing.split(':').slice(1).join(':').trim();
        left.textContent = `Página: ${h1?.textContent || sec.id} — Fuentes: ${fuentes || 'N/D'}`;
        if (!footer.contains(left)) footer.insertBefore(left, footer.firstChild);

        let right = footer.querySelector('.footer-page-num');
        if (!right) {
          right = document.createElement('span');
          right.className = 'footer-page-num';
          footer.appendChild(right);
        }
        right.textContent = `Página ${idx + 1} de ${totalPages}`;
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
    img.src = `../imagenes auditoria pdf/FASE 1 - Auditoría Técnica BARNER/Diapositiva${slideNumber}.JPG`;
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
    title.style.color = '#54a34a';
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
});