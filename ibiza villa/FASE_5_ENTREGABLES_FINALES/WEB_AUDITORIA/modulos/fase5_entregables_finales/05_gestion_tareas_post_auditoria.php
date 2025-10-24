<!--
   GESTIÓN DE TAREAS POST-AUDITORÍA
   Sistema de planificación de ejecución basado en tareas con dependencias
-->

<?php
// Cargar datos de tareas desde JSON embebido
$tareasJSON = <<<'JSON'
{
  "metadata": {
    "version": "1.0.0",
    "fecha_creacion": "2025-01-21",
    "descripcion": "Catálogo completo de tareas post-auditoría con dependencias y estimaciones",
    "total_tareas": 85
  },
  "categorias": {
    "tecnico": "Técnico SEO",
    "contenido": "Contenido y Copywriting",
    "diseno": "Diseño y UX",
    "analytics": "Analytics y Medición",
    "linkbuilding": "Link Building y Autoridad",
    "estrategia": "Estrategia y Consultoría"
  },
  "roles": {
    "seo_specialist": "SEO Specialist",
    "developer": "Desarrollador",
    "copywriter": "Copywriter / Content Writer",
    "designer": "UX/UI Designer",
    "analyst": "Data Analyst",
    "pr_specialist": "Digital PR Specialist",
    "consultant": "SEO Consultant (Senior)"
  },
  "tareas": [
    {
      "id": "T001",
      "codigo": "QW-01",
      "nombre": "Auditoría de Errores 404 y Redirecciones",
      "descripcion": "Identificar todas las URLs con error 404, crear mapa de redirecciones 301, implementar y verificar",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["developer", "seo_specialist"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["Mapa de redirecciones 301", "Informe URLs 404 resueltas", "Verificación GSC"],
      "herramientas": ["Google Search Console", "Screaming Frog", "Ahrefs"],
      "impacto_esperado": "Reducción 80% errores en GSC, mejora crawl budget",
      "kpis": ["0 errores 404 en páginas principales", "100% redirecciones implementadas"]
    },
    {
      "id": "T002",
      "codigo": "QW-02",
      "nombre": "Corrección de Canonical Tags Duplicados",
      "descripcion": "Auditar y corregir canonical tags duplicados o conflictivos en todo el sitio",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["developer", "seo_specialist"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": [],
      "entregables": ["Audit de canonicals", "Canonicals corregidos", "Informe de verificación"],
      "herramientas": ["Screaming Frog", "Google Search Console"],
      "impacto_esperado": "100% canonicals correctos, eliminación contenido duplicado indexado",
      "kpis": ["0 errores canonical en GSC", "Páginas indexadas correctas"]
    },
    {
      "id": "T003",
      "codigo": "QW-03",
      "nombre": "Optimización Masiva de Title Tags",
      "descripcion": "Reescribir todos los title tags con keywords estratégicas, longitud óptima (50-60 chars), únicos",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 8,
      "dependencias": ["T015"],
      "entregables": ["Documento con todos los titles optimizados", "Implementación en CMS", "Tracking de mejoras CTR"],
      "herramientas": ["Google Search Console", "Ahrefs", "Excel/Sheets"],
      "impacto_esperado": "CTR orgánico +25% en 2 meses, mejora posicionamiento",
      "kpis": ["100% páginas con titles únicos", "0 titles duplicados", "CTR +25%"]
    },
    {
      "id": "T004",
      "codigo": "QW-04",
      "nombre": "Optimización Masiva de Meta Descriptions",
      "descripcion": "Crear meta descriptions únicas, persuasivas, con call-to-action, longitud óptima (150-160 chars)",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 7,
      "dependencias": ["T003"],
      "entregables": ["Documento con meta descriptions", "Implementación", "A/B testing CTR"],
      "herramientas": ["Google Search Console", "CMS"],
      "impacto_esperado": "CTR +15-20%, mejora presentación en SERP",
      "kpis": ["100% páginas con descriptions únicas", "CTR mejorado"]
    },
    {
      "id": "T005",
      "codigo": "QW-05",
      "nombre": "Implementación Schema Markup Básico",
      "descripcion": "Añadir schemas: Organization, WebSite, BreadcrumbList en todas las páginas",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": ["T002"],
      "entregables": ["Schemas implementados", "Validación Google Rich Results", "Documentación"],
      "herramientas": ["Google Rich Results Test", "Schema.org"],
      "impacto_esperado": "Mejor comprensión por buscadores, base para rich snippets",
      "kpis": ["0 errores validación schemas", "100% páginas con schema básico"]
    },
    {
      "id": "T006",
      "codigo": "QW-06",
      "nombre": "Schema Markup Avanzado (Productos/Servicios)",
      "descripcion": "Implementar schemas específicos: Product, Service, Review, AggregateRating, FAQPage",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 16,
      "dependencias": ["T005"],
      "entregables": ["Schemas avanzados implementados", "Validación completa", "Monitoreo rich snippets"],
      "herramientas": ["Google Rich Results Test", "Schema Markup Generator"],
      "impacto_esperado": "Aparición rich snippets, CTR +30-50%",
      "kpis": ["Rich snippets activos en 30 días", "CTR incrementado"]
    },
    {
      "id": "T007",
      "codigo": "QW-07",
      "nombre": "Compresión y Optimización de Imágenes",
      "descripcion": "Comprimir todas las imágenes (WebP/AVIF), mantener calidad visual, reducir peso 60-70%",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": [],
      "entregables": ["Script compresión automática", "Imágenes optimizadas", "Comparativa antes/después"],
      "herramientas": ["ImageOptim", "Squoosh", "CDN"],
      "impacto_esperado": "Reducción 60% peso imágenes, LCP mejorado",
      "kpis": ["Peso medio imagen < 100KB", "LCP < 2.5s"]
    },
    {
      "id": "T008",
      "codigo": "QW-08",
      "nombre": "Implementación Lazy Loading Imágenes",
      "descripcion": "Activar lazy loading nativo HTML o librería, priorizar above-the-fold",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 6,
      "dependencias": ["T007"],
      "entregables": ["Lazy loading implementado", "Testing en múltiples dispositivos", "Documentación"],
      "herramientas": ["Chrome DevTools", "Lighthouse"],
      "impacto_esperado": "Carga inicial 40% más rápida, mejor UX",
      "kpis": ["LCP < 2.5s en 90% páginas", "FCP < 1.8s"]
    },
    {
      "id": "T009",
      "codigo": "QW-09",
      "nombre": "Optimización de Alt Tags en Imágenes",
      "descripcion": "Añadir alt tags descriptivos, con keywords naturales, en todas las imágenes",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": ["T007"],
      "entregables": ["Documento con alt tags", "Implementación", "Verificación accesibilidad"],
      "herramientas": ["Screaming Frog", "WAVE Accessibility"],
      "impacto_esperado": "Mejor posicionamiento Google Images, accesibilidad mejorada",
      "kpis": ["100% imágenes con alt tags", "Tráfico desde Google Images +20%"]
    },
    {
      "id": "T010",
      "codigo": "QW-10",
      "nombre": "Configuración e Implementación de CDN",
      "descripcion": "Configurar Cloudflare o CDN similar, optimizar caché, activar minificación automática",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["CDN configurado", "Reglas de caché optimizadas", "SSL/HTTPS verificado"],
      "herramientas": ["Cloudflare", "KeyCDN", "BunnyCDN"],
      "impacto_esperado": "TTFB reducido 50%, disponibilidad global mejorada",
      "kpis": ["TTFB < 600ms", "Uptime 99.9%"]
    },
    {
      "id": "T011",
      "codigo": "QW-11",
      "nombre": "Minificación CSS y JavaScript",
      "descripcion": "Minificar y combinar archivos CSS/JS, eliminar código no utilizado, defer non-critical JS",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 10,
      "dependencias": ["T010"],
      "entregables": ["CSS/JS minificados", "Código no usado eliminado", "Testing funcionalidad"],
      "herramientas": ["Webpack", "Terser", "PurgeCSS"],
      "impacto_esperado": "Tamaño archivos reducido 40%, FCP mejorado",
      "kpis": ["Total blocking time < 200ms", "FCP < 1.8s"]
    },
    {
      "id": "T012",
      "codigo": "QW-12",
      "nombre": "Optimización de Caché del Servidor",
      "descripcion": "Configurar caché de página completa, caché de objetos, caché de base de datos",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": ["T010"],
      "entregables": ["Caché configurado", "Headers HTTP optimizados", "Documentación purge"],
      "herramientas": ["Redis", "Memcached", "Varnish"],
      "impacto_esperado": "TTFB < 500ms, servidor soporta 10x tráfico",
      "kpis": ["TTFB < 600ms", "Cache hit rate > 85%"]
    },
    {
      "id": "T013",
      "codigo": "QW-13",
      "nombre": "Auditoría y Corrección de Enlazado Interno",
      "descripcion": "Mapear estructura de enlaces internos, identificar páginas huérfanas, corregir enlaces rotos",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 12,
      "dependencias": ["T001"],
      "entregables": ["Mapa de enlazado interno", "Enlaces rotos corregidos", "Informe de profundidad"],
      "herramientas": ["Screaming Frog", "Ahrefs", "Sitebulb"],
      "impacto_esperado": "Profundidad media < 3 clics, mejor distribución PageRank",
      "kpis": ["0 enlaces internos rotos", "Profundidad < 3 clics"]
    },
    {
      "id": "T014",
      "codigo": "QW-14",
      "nombre": "Estrategia de Enlazado Interno por Keywords",
      "descripcion": "Crear 200+ enlaces internos estratégicos con anchor text optimizado",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["seo_specialist", "copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": ["T013", "T015"],
      "entregables": ["Estrategia de anchor text", "200+ enlaces implementados", "Tracking de rankings"],
      "herramientas": ["Ahrefs", "Excel"],
      "impacto_esperado": "Mejora rankings keywords objetivo, distribución autoridad",
      "kpis": ["200+ enlaces estratégicos", "Rankings mejorados en páginas enlazadas"]
    },
    {
      "id": "T015",
      "codigo": "KR-01",
      "nombre": "Keyword Research Completo",
      "descripcion": "Investigación exhaustiva: keywords principales, long-tail, preguntas, competencia",
      "categoria": "estrategia",
      "fase_origen": 2,
      "prioridad": "critical",
      "rol": ["seo_specialist", "consultant"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 24,
      "dependencias": [],
      "entregables": ["Lista 500+ keywords", "Análisis competencia", "Priorización por oportunidad"],
      "herramientas": ["Ahrefs", "SEMrush", "Google Keyword Planner"],
      "impacto_esperado": "Base estratégica para toda optimización on-page y contenido",
      "kpis": ["500+ keywords identificadas", "Oportunidades priorizadas"]
    },
    {
      "id": "T016",
      "codigo": "KR-02",
      "nombre": "Keyword-to-Page Mapping",
      "descripcion": "Asignar keywords a páginas existentes, identificar gaps de contenido",
      "categoria": "estrategia",
      "fase_origen": 2,
      "prioridad": "high",
      "rol": ["seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": ["T015"],
      "entregables": ["Mapa keyword-página completo", "Lista páginas faltantes", "Priorización creación"],
      "herramientas": ["Excel", "Ahrefs"],
      "impacto_esperado": "Claridad de qué optimizar y qué crear",
      "kpis": ["100% keywords mapeadas", "Gaps identificados"]
    },
    {
      "id": "T017",
      "codigo": "ARCH-01",
      "nombre": "Reestructuración de Arquitectura del Sitio",
      "descripcion": "Reorganizar categorías, crear silos temáticos, optimizar jerarquía de información",
      "categoria": "tecnico",
      "fase_origen": 3,
      "prioridad": "high",
      "rol": ["consultant", "developer"],
      "tipo_paquete": ["dev_design", "seo"],
      "horas_estimadas": 8,
      "dependencias": ["T015", "T016"],
      "entregables": ["Nueva arquitectura diseñada", "Mapa de redirecciones", "Implementación"],
      "herramientas": ["Lucidchart", "Miro", "Screaming Frog"],
      "impacto_esperado": "Profundidad < 2.5 clics, crawl efficiency +30%",
      "kpis": ["Arquitectura implementada sin pérdida rankings", "Crawl efficiency mejorado"]
    },
    {
      "id": "T018",
      "codigo": "ARCH-02",
      "nombre": "Optimización de URLs y Breadcrumbs",
      "descripcion": "URLs limpias, jerárquicas, con keywords, breadcrumbs con schema markup",
      "categoria": "tecnico",
      "fase_origen": 3,
      "prioridad": "medium",
      "rol": ["developer", "seo_specialist"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 16,
      "dependencias": ["T017"],
      "entregables": ["URLs optimizadas", "Breadcrumbs con schema", "Redirecciones implementadas"],
      "herramientas": ["CMS", "Google Rich Results Test"],
      "impacto_esperado": "CTR mejorado, navegación clara para usuarios y bots",
      "kpis": ["100% URLs optimizadas", "Breadcrumbs en todas las páginas"]
    },
    {
      "id": "T019",
      "codigo": "CONT-01",
      "nombre": "Creación de Contenido Long-Tail (12 artículos)",
      "descripcion": "Escribir 12 artículos de blog (2,000+ palabras) targeting long-tail keywords de alta conversión",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "high",
      "rol": ["copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 20,
      "dependencias": ["T015", "T016"],
      "entregables": ["12 artículos SEO-optimizados", "Publicación programada", "Promoción social"],
      "herramientas": ["WordPress", "Surfer SEO", "Grammarly"],
      "impacto_esperado": "Posicionamiento TOP 20 en 60 días, tráfico long-tail",
      "kpis": ["12 artículos publicados", "TOP 20 en 60 días", "Tiempo en página > 3 min"]
    },
    {
      "id": "T020",
      "codigo": "CONT-02",
      "nombre": "Hub de Contenido: Pilar Page + 15 Cluster Pages",
      "descripcion": "Crear hub completo: 1 pilar page (5,000+ palabras) + 15 cluster pages (1,500+ palabras)",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "high",
      "rol": ["copywriter", "consultant"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 120,
      "dependencias": ["T015", "T016"],
      "entregables": ["Pilar page publicada", "15 cluster pages", "Enlazado hub/spoke"],
      "herramientas": ["Ahrefs", "Surfer SEO"],
      "impacto_esperado": "TOP 10 pilar en 90 días, autoridad temática establecida",
      "kpis": ["Hub completo publicado", "TOP 10 pilar", "50+ enlaces internos"]
    },
    {
      "id": "T021",
      "codigo": "CONT-03",
      "nombre": "Landing Pages Locales (25 páginas)",
      "descripcion": "Crear 25 landing pages para áreas geográficas específicas con contenido único",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": ["T015"],
      "entregables": ["25 páginas locales", "Schema LocalBusiness", "Google My Business optimizado"],
      "herramientas": ["Google My Business", "Local SEO tools"],
      "impacto_esperado": "TOP 5 búsquedas locales, CTR > 8%",
      "kpis": ["25 páginas publicadas", "TOP 5 geo-específicas"]
    },
    {
      "id": "T022",
      "codigo": "CONT-04",
      "nombre": "Actualización de Contenido Existente (50 páginas)",
      "descripcion": "Auditar y actualizar 50 páginas con bajo rendimiento, expandir contenido, optimizar",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 14,
      "dependencias": ["T016"],
      "entregables": ["50 páginas actualizadas", "Contenido expandido", "Tracking de mejoras"],
      "herramientas": ["Google Analytics", "Ahrefs"],
      "impacto_esperado": "Tiempo en página +40%, recuperación posiciones",
      "kpis": ["50 páginas actualizadas", "Mejora 40% engagement"]
    },
    {
      "id": "T023",
      "codigo": "CONT-05",
      "nombre": "Creación de FAQs Optimizadas (30 páginas)",
      "descripcion": "Crear secciones FAQ en 30 páginas clave, targeting featured snippets",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 24,
      "dependencias": ["T015"],
      "entregables": ["30 FAQs implementadas", "Schema FAQPage", "Optimización snippets"],
      "herramientas": ["AnswerThePublic", "AlsoAsked"],
      "impacto_esperado": "10+ featured snippets capturados, CTR +20%",
      "kpis": ["30 FAQs publicadas", "10+ featured snippets"]
    },
    {
      "id": "T024",
      "codigo": "CONT-06",
      "nombre": "Recursos Descargables (5 Lead Magnets)",
      "descripcion": "Diseñar 5 recursos premium: guías PDF, checklists, mapas interactivos",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["copywriter", "designer"],
      "tipo_paquete": ["seo", "dev_design"],
      "horas_estimadas": 10,
      "dependencias": [],
      "entregables": ["5 recursos descargables", "Landing pages", "Email capture"],
      "herramientas": ["Canva", "InDesign", "Mailchimp"],
      "impacto_esperado": "500+ descargas en 3 meses, conversión > 12%",
      "kpis": ["5 recursos publicados", "500+ descargas"]
    },
    {
      "id": "T025",
      "codigo": "CONT-07",
      "nombre": "Programa de Contenido Continuo (24 artículos/trimestre)",
      "descripcion": "Publicar 24 artículos (2/semana) targeting keywords de media cola",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 144,
      "dependencias": ["T015", "T019"],
      "entregables": ["24 artículos publicados", "Calendario editorial", "Tracking rankings"],
      "herramientas": ["WordPress", "CoSchedule"],
      "impacto_esperado": "50% artículos TOP 20 en 60 días, 15,000+ palabras/mes",
      "kpis": ["24 artículos publicados", "50% TOP 20"]
    },
    {
      "id": "T026",
      "codigo": "MOB-01",
      "nombre": "Optimización Mobile-First Completa",
      "descripcion": "Revisar experiencia móvil, corregir tap targets, mejorar navegación touch",
      "categoria": "diseno",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["designer", "developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["Diseño responsive optimizado", "Navegación móvil mejorada", "Testing en dispositivos"],
      "herramientas": ["Chrome DevTools", "BrowserStack"],
      "impacto_esperado": "Mobile Usability 100/100, bounce rate móvil < 55%",
      "kpis": ["Mobile Usability 100/100", "0 errores mobile-friendly"]
    },
    {
      "id": "T027",
      "codigo": "CWV-01",
      "nombre": "Optimización Core Web Vitals Básica",
      "descripcion": "Optimizar LCP, FID, CLS para pasar umbrales en 75%+ páginas",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 10,
      "dependencias": ["T007", "T008", "T010", "T011"],
      "entregables": ["Optimizaciones implementadas", "Reporte PageSpeed", "Monitoreo CrUX"],
      "herramientas": ["Lighthouse", "WebPageTest", "CrUX"],
      "impacto_esperado": "75%+ URLs pasan CWV, mejor ranking signal",
      "kpis": ["LCP < 2.5s", "FID < 100ms", "CLS < 0.1"]
    },
    {
      "id": "T028",
      "codigo": "CWV-02",
      "nombre": "Optimización Core Web Vitals Avanzada",
      "descripcion": "SSR/SSG, edge caching, resource hints, optimizaciones avanzadas",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": ["T027"],
      "entregables": ["SSR/SSG implementado", "Edge caching", "100% URLs pasan CWV"],
      "herramientas": ["Next.js", "Vercel", "Cloudflare Workers"],
      "impacto_esperado": "100% URLs pasan CWV, Performance Score > 90",
      "kpis": ["LCP < 2.0s", "Performance Score > 90"]
    },
    {
      "id": "T029",
      "codigo": "ANA-01",
      "nombre": "Configuración Completa Google Analytics 4",
      "descripcion": "Setup GA4, definir eventos, conversiones, audiencias, explorations",
      "categoria": "analytics",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["analyst", "developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["GA4 configurado", "Eventos implementados", "Conversiones definidas"],
      "herramientas": ["Google Analytics 4", "Google Tag Manager"],
      "impacto_esperado": "Medición precisa de resultados SEO",
      "kpis": ["GA4 operativo", "Eventos tracked correctamente"]
    },
    {
      "id": "T030",
      "codigo": "ANA-02",
      "nombre": "Implementación Google Tag Manager Completo",
      "descripcion": "Setup GTM container, implementar 28 eventos de medición, testing",
      "categoria": "analytics",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["analyst", "developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": ["T029"],
      "entregables": ["GTM configurado", "28 eventos implementados", "DataLayer optimizado"],
      "herramientas": ["Google Tag Manager", "GA4", "GTM Preview"],
      "impacto_esperado": "Tracking completo embudo de conversión",
      "kpis": ["28 eventos funcionando", "0 errores tracking"]
    },
    {
      "id": "T031",
      "codigo": "ANA-03",
      "nombre": "Integración Sistemas Externos (PMS, CRM, Stripe)",
      "descripcion": "Conectar webhooks de sistemas externos a GA4 via GTM server-side",
      "categoria": "analytics",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer", "analyst"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 10,
      "dependencias": ["T030"],
      "entregables": ["Webhooks configurados", "Server-side GTM", "Conversiones externas tracked"],
      "herramientas": ["GTM Server-side", "Cloud Functions", "APIs"],
      "impacto_esperado": "Visibilidad completa de ROI, atribución correcta",
      "kpis": ["Conversiones externas medidas", "Atribución funcional"]
    },
    {
      "id": "T032",
      "codigo": "ANA-04",
      "nombre": "Dashboards Automatizados Looker Studio",
      "descripcion": "Crear 3 dashboards: Ejecutivo, SEO Técnico, Contenido",
      "categoria": "analytics",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["analyst"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 24,
      "dependencias": ["T029"],
      "entregables": ["3 dashboards operativos", "Alertas automáticas", "Accesos configurados"],
      "herramientas": ["Looker Studio", "Google Analytics", "Google Search Console"],
      "impacto_esperado": "Tiempo reporte reducido 80%, visibilidad 24/7",
      "kpis": ["Dashboards operativos", "Reportes automatizados"]
    },
    {
      "id": "T033",
      "codigo": "LB-01",
      "nombre": "Campaña Digital PR y Outreach (30 enlaces)",
      "descripcion": "Conseguir 30 menciones/enlaces en medios turísticos, blogs viaje, guías",
      "categoria": "linkbuilding",
      "fase_origen": 5,
      "prioridad": "high",
      "rol": ["pr_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 20,
      "dependencias": ["T020"],
      "entregables": ["Lista 100 targets", "Templates pitching", "30+ backlinks DR 40+"],
      "herramientas": ["BuzzStream", "Hunter.io", "Ahrefs"],
      "impacto_esperado": "30+ backlinks DR 40+, Domain Rating +8 puntos",
      "kpis": ["30+ backlinks DR 40+", "DR +8 puntos"]
    },
    {
      "id": "T034",
      "codigo": "LB-02",
      "nombre": "Creación de Linkable Assets (5 piezas)",
      "descripcion": "Crear 5 piezas contenido premium diseñadas para atraer enlaces naturales",
      "categoria": "linkbuilding",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter", "designer", "analyst"],
      "tipo_paquete": ["seo", "dev_design"],
      "horas_estimadas": 20,
      "dependencias": ["T015"],
      "entregables": ["Estudio original", "Infografía interactiva", "Calculadora", "Guía visual", "Video"],
      "herramientas": ["Canva", "Tableau", "Premiere Pro"],
      "impacto_esperado": "50+ backlinks naturales en 6 meses",
      "kpis": ["5 assets publicados", "50+ backlinks", "1,000+ shares"]
    },
    {
      "id": "T035",
      "codigo": "LB-03",
      "nombre": "Guest Posting Estratégico (15 posts)",
      "descripcion": "Publicar 15 guest posts en blogs DR 30+ del sector turismo/viajes",
      "categoria": "linkbuilding",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter", "pr_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 18,
      "dependencias": [],
      "entregables": ["15 guest posts publicados", "Relaciones con editores", "Tráfico referral"],
      "herramientas": ["BuzzStream", "Ahrefs"],
      "impacto_esperado": "15 backlinks DR 30+, tráfico referral +15%",
      "kpis": ["15 guest posts DR 30+", "Tráfico referral +15%"]
    },
    {
      "id": "T036",
      "codigo": "LB-04",
      "nombre": "Recuperación Enlaces Perdidos + Broken Link Building",
      "descripcion": "Recuperar 20 enlaces perdidos, conseguir 10 via broken link building",
      "categoria": "linkbuilding",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["pr_specialist", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 24,
      "dependencias": [],
      "entregables": ["20 enlaces recuperados", "10 enlaces broken link", "Informe backlink health"],
      "herramientas": ["Ahrefs", "Check My Links"],
      "impacto_esperado": "30 backlinks adicionales, perfil más fuerte",
      "kpis": ["30 enlaces conseguidos/recuperados"]
    },
    {
      "id": "T037",
      "codigo": "LB-05",
      "nombre": "Auditoría y Limpieza Perfil de Enlaces",
      "descripcion": "Identificar y desautorizar enlaces tóxicos, mejorar calidad perfil",
      "categoria": "linkbuilding",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["seo_specialist", "consultant"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["Auditoría backlinks", "Archivo disavow", "Perfil limpio"],
      "herramientas": ["Ahrefs", "Moz", "Google Disavow Tool"],
      "impacto_esperado": "Toxic Score < 5%, perfil de calidad",
      "kpis": ["Toxic Score < 5%", "100% tóxicos desautorizados"]
    },
    {
      "id": "T038",
      "codigo": "LB-06",
      "nombre": "Partnerships Estratégicos (10 alianzas)",
      "descripcion": "Establecer 10 partnerships con negocios complementarios",
      "categoria": "linkbuilding",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["consultant", "pr_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["10 partnerships", "Co-branded content", "15+ backlinks partners"],
      "herramientas": ["LinkedIn", "Email"],
      "impacto_esperado": "15+ backlinks, tráfico referral +25%",
      "kpis": ["10 partnerships", "15+ backlinks"]
    },
    {
      "id": "T039",
      "codigo": "CRO-01",
      "nombre": "Optimización de CTAs y Formularios",
      "descripcion": "Optimizar CTAs en 20 páginas, simplificar formularios, elementos de confianza",
      "categoria": "diseno",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["designer", "copywriter"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["CTAs optimizados", "Formularios simplificados", "Reviews visible"],
      "herramientas": ["Hotjar", "Google Optimize"],
      "impacto_esperado": "Conversion rate +30%, form completion +40%",
      "kpis": ["Conversion rate +30%", "Form completion +40%"]
    },
    {
      "id": "T040",
      "codigo": "CRO-02",
      "nombre": "A/B Testing y Optimización Avanzada CRO",
      "descripcion": "Ejecutar 10 tests A/B, personalización por segmento, optimización embudo",
      "categoria": "diseno",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["analyst", "designer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": ["T039"],
      "entregables": ["10 tests A/B ejecutados", "Personalización implementada", "Embudo optimizado"],
      "herramientas": ["Google Optimize", "VWO", "Hotjar"],
      "impacto_esperado": "Conversion rate +25% adicional, AOV +15%",
      "kpis": ["10 tests completados", "Conversión +25%"]
    },
    {
      "id": "T041",
      "codigo": "INT-01",
      "nombre": "Implementación Hreflang y Expansión Internacional",
      "descripcion": "Preparar versiones EN/DE, implementar hreflang, traducir 50 páginas clave",
      "categoria": "tecnico",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["developer", "seo_specialist"],
      "tipo_paquete": ["dev_design", "seo"],
      "horas_estimadas": 16,
      "dependencias": ["T017"],
      "entregables": ["Hreflang implementado", "50 páginas EN", "30 páginas DE"],
      "herramientas": ["Hreflang Tag Generator", "Google Search Console"],
      "impacto_esperado": "Tráfico internacional +60%, indexación correcta",
      "kpis": ["Hreflang sin errores", "Tráfico internacional +60%"]
    },
    {
      "id": "T042",
      "codigo": "AUD-01",
      "nombre": "Auditoría SEO Completa Trimestral",
      "descripcion": "Auditoría profunda 200+ puntos, identificar nuevas oportunidades",
      "categoria": "estrategia",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["consultant"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 10,
      "dependencias": [],
      "entregables": ["Auditoría completa", "Informe oportunidades", "Roadmap actualizado"],
      "herramientas": ["Screaming Frog", "Ahrefs", "Sitebulb"],
      "impacto_esperado": "20+ nuevas oportunidades identificadas",
      "kpis": ["Auditoría completada", "20+ oportunidades"]
    },
    {
      "id": "T043",
      "codigo": "FORM-01",
      "nombre": "Formación Interna y Documentación",
      "descripcion": "Capacitar equipo cliente, crear manual SEO interno, videos tutoriales",
      "categoria": "estrategia",
      "fase_origen": 5,
      "prioridad": "low",
      "rol": ["consultant"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["3 sesiones formación", "Manual 50+ páginas", "Videos tutoriales"],
      "herramientas": ["Zoom", "Loom", "Google Docs"],
      "impacto_esperado": "Equipo interno capacitado, autonomía tareas básicas",
      "kpis": ["Equipo capacitado", "Autonomía SEO básico"]
    },
    {
      "id": "T044",
      "codigo": "GSC-01",
      "nombre": "Configuración y Optimización Google Search Console",
      "descripcion": "Setup GSC, verificar propiedad, configurar sitemaps, resolver errores críticos",
      "categoria": "analytics",
      "fase_origen": 1,
      "prioridad": "critical",
      "rol": ["seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 4,
      "dependencias": [],
      "entregables": ["GSC configurado", "Sitemaps enviados", "Errores críticos resueltos"],
      "herramientas": ["Google Search Console"],
      "impacto_esperado": "Visibilidad completa indexación y rendimiento",
      "kpis": ["GSC operativo", "0 errores críticos"]
    },
    {
      "id": "T045",
      "codigo": "SIT-01",
      "nombre": "Generación y Optimización de Sitemaps XML",
      "descripcion": "Crear sitemaps XML optimizados, enviar a GSC, configurar actualización automática",
      "categoria": "tecnico",
      "fase_origen": 1,
      "prioridad": "high",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 6,
      "dependencias": ["T044"],
      "entregables": ["Sitemaps XML", "Envío a buscadores", "Actualización automática"],
      "herramientas": ["Screaming Frog", "Yoast SEO"],
      "impacto_esperado": "Indexación más rápida y completa",
      "kpis": ["Sitemaps funcionando", "100% URLs importantes incluidas"]
    },
    {
      "id": "T046",
      "codigo": "ROB-01",
      "nombre": "Optimización de Robots.txt",
      "descripcion": "Revisar y optimizar robots.txt, permitir crawling estratégico, bloquear recursos no importantes",
      "categoria": "tecnico",
      "fase_origen": 1,
      "prioridad": "high",
      "rol": ["seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 4,
      "dependencias": ["T044"],
      "entregables": ["Robots.txt optimizado", "Testing con GSC", "Documentación"],
      "herramientas": ["Google Search Console", "Robots.txt Tester"],
      "impacto_esperado": "Crawl budget optimizado, indexación eficiente",
      "kpis": ["Robots.txt optimizado", "0 bloqueos incorrectos"]
    },
    {
      "id": "T047",
      "codigo": "INDEX-01",
      "nombre": "Auditoría y Optimización de Indexación",
      "descripcion": "Identificar problemas de indexación, corregir noindex incorrectos, solicitar indexación prioritaria",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 12,
      "dependencias": ["T044", "T045", "T046"],
      "entregables": ["Informe indexación", "Noindex corregidos", "Indexación solicitada"],
      "herramientas": ["Google Search Console", "Screaming Frog"],
      "impacto_esperado": "100% páginas importantes indexadas",
      "kpis": ["100% páginas objetivo indexadas", "0 noindex incorrectos"]
    },
    {
      "id": "T048",
      "codigo": "SEC-01",
      "nombre": "Implementación HTTPS y Certificado SSL",
      "descripcion": "Migrar a HTTPS si necesario, configurar redirecciones, actualizar enlaces internos",
      "categoria": "tecnico",
      "fase_origen": 1,
      "prioridad": "critical",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["HTTPS implementado", "SSL configurado", "Redirecciones HTTP→HTTPS"],
      "herramientas": ["Let's Encrypt", "SSL Labs"],
      "impacto_esperado": "Seguridad mejorada, ranking signal positivo",
      "kpis": ["100% HTTPS", "SSL Score A+"]
    },
    {
      "id": "T049",
      "codigo": "H1-01",
      "nombre": "Optimización de H1 y Estructura de Headings",
      "descripcion": "Revisar todos los H1, asegurar unicidad, optimizar H2-H6 por jerarquía lógica",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 20,
      "dependencias": ["T003"],
      "entregables": ["H1 optimizados", "Jerarquía headings corregida", "Implementación"],
      "herramientas": ["Screaming Frog"],
      "impacto_esperado": "Mejor comprensión contenido por buscadores",
      "kpis": ["100% páginas con H1 único", "Jerarquía lógica implementada"]
    },
    {
      "id": "T050",
      "codigo": "EEAT-01",
      "nombre": "Optimización E-E-A-T Signals",
      "descripcion": "Añadir author bios, credentials, about us robusto, testimonios, casos de éxito",
      "categoria": "contenido",
      "fase_origen": 5,
      "prioridad": "medium",
      "rol": ["copywriter"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 24,
      "dependencias": [],
      "entregables": ["Author bios", "About us page", "Testimonios", "Casos de éxito"],
      "herramientas": ["Schema.org (Person, Organization)"],
      "impacto_esperado": "Mejora E-E-A-T, confianza usuarios y buscadores",
      "kpis": ["E-E-A-T signals implementados", "Trust signals visibles"]
    },
    {
      "id": "T051",
      "codigo": "ACC-01",
      "nombre": "Auditoría y Mejora de Accesibilidad Web",
      "descripcion": "Auditoría WCAG 2.1 AA, corregir problemas contraste, navegación por teclado, ARIA labels",
      "categoria": "diseno",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer", "designer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 24,
      "dependencias": [],
      "entregables": ["Auditoría accesibilidad", "Correcciones implementadas", "WCAG 2.1 AA compliance"],
      "herramientas": ["WAVE", "axe DevTools", "Lighthouse"],
      "impacto_esperado": "Mejor accesibilidad, UX inclusiva, potencial ranking boost",
      "kpis": ["WCAG 2.1 AA compliance", "Accessibility score > 90"]
    },
    {
      "id": "T052",
      "codigo": "VID-01",
      "nombre": "Optimización SEO de Videos (YouTube + Sitio)",
      "descripcion": "Optimizar títulos, descripciones, tags de videos, video sitemaps, schema VideoObject",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "low",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["Videos optimizados", "Video sitemap", "Schema VideoObject"],
      "herramientas": ["YouTube Studio", "Schema.org"],
      "impacto_esperado": "Mejor posicionamiento en Google Videos y YouTube",
      "kpis": ["100% videos optimizados", "Video sitemap enviado"]
    },
    {
      "id": "T053",
      "codigo": "PAG-01",
      "nombre": "Implementación de Paginación SEO-Friendly",
      "descripcion": "Optimizar paginación con rel=next/prev o infinite scroll con fallback, canonicals correctos",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": [],
      "entregables": ["Paginación optimizada", "Canonicals correctos", "Testing indexación"],
      "herramientas": ["Google Search Console"],
      "impacto_esperado": "Indexación correcta de páginas paginadas",
      "kpis": ["Paginación SEO-friendly", "0 errores canonical en paginación"]
    },
    {
      "id": "T054",
      "codigo": "404-01",
      "nombre": "Página 404 Personalizada y Optimizada",
      "descripcion": "Crear página 404 custom con enlaces útiles, buscador, sugerencias",
      "categoria": "diseno",
      "fase_origen": 1,
      "prioridad": "low",
      "rol": ["designer", "copywriter"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["Página 404 custom", "Enlaces útiles", "Tracking 404s"],
      "herramientas": ["Google Analytics"],
      "impacto_esperado": "Reducir bounce rate en 404, recuperar usuarios perdidos",
      "kpis": ["404 personalizada implementada", "Bounce rate 404 reducido"]
    },
    {
      "id": "T055",
      "codigo": "LOG-01",
      "nombre": "Análisis de Log Files del Servidor",
      "descripcion": "Analizar logs para entender comportamiento crawling, identificar problemas",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "low",
      "rol": ["seo_specialist", "developer"],
      "tipo_paquete": ["seo"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["Análisis log files", "Informe crawling behavior", "Recomendaciones"],
      "herramientas": ["Screaming Frog Log Analyzer", "OnCrawl"],
      "impacto_esperado": "Insights avanzados sobre crawling, optimización técnica",
      "kpis": ["Análisis completado", "Issues identificados"]
    },
    {
      "id": "T056",
      "codigo": "JS-01",
      "nombre": "Auditoría y Optimización SEO de JavaScript",
      "descripcion": "Verificar renderizado JS por bots, optimizar client-side rendering, implementar dynamic rendering si necesario",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 24,
      "dependencias": [],
      "entregables": ["Auditoría JS SEO", "Optimizaciones implementadas", "Dynamic rendering si necesario"],
      "herramientas": ["Chrome DevTools", "Mobile-Friendly Test"],
      "impacto_esperado": "100% contenido JS indexable",
      "kpis": ["Contenido JS 100% indexable", "0 problemas rendering"]
    },
    {
      "id": "T057",
      "codigo": "API-01",
      "nombre": "Optimización de APIs para Performance",
      "descripcion": "Optimizar llamadas API, implementar caché, reducir payloads, lazy loading de datos",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 20,
      "dependencias": [],
      "entregables": ["APIs optimizadas", "Caché implementado", "Performance mejorado"],
      "herramientas": ["Postman", "Chrome DevTools"],
      "impacto_esperado": "Tiempo carga reducido, UX mejorada",
      "kpis": ["API response time < 200ms", "Payloads reducidos 40%"]
    },
    {
      "id": "T058",
      "codigo": "FONT-01",
      "nombre": "Optimización de Web Fonts",
      "descripcion": "Subset fonts, preload critical fonts, font-display: swap, eliminar fonts no usadas",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "medium",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 8,
      "dependencias": [],
      "entregables": ["Fonts optimizadas", "Preload configurado", "Subset fonts"],
      "herramientas": ["Font Subsetter", "Chrome DevTools"],
      "impacto_esperado": "FCP mejorado, eliminación FOUT/FOIT",
      "kpis": ["Font size reducido 50%", "FCP mejorado"]
    },
    {
      "id": "T059",
      "codigo": "SEC-02",
      "nombre": "Implementación Headers de Seguridad HTTP",
      "descripcion": "Configurar headers: HSTS, CSP, X-Frame-Options, X-Content-Type-Options",
      "categoria": "tecnico",
      "fase_origen": 4,
      "prioridad": "low",
      "rol": ["developer"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 6,
      "dependencias": ["T048"],
      "entregables": ["Security headers configurados", "Testing headers", "Score mejorado"],
      "herramientas": ["SecurityHeaders.com"],
      "impacto_esperado": "Seguridad mejorada, confianza incrementada",
      "kpis": ["Security headers Score A", "Vulnerabilidades cerradas"]
    },
    {
      "id": "T060",
      "codigo": "SOC-01",
      "nombre": "Optimización de Social Media Meta Tags",
      "descripcion": "Implementar Open Graph, Twitter Cards, optimizar preview en redes sociales",
      "categoria": "tecnico",
      "fase_origen": 1,
      "prioridad": "medium",
      "rol": ["developer", "copywriter"],
      "tipo_paquete": ["dev_design"],
      "horas_estimadas": 12,
      "dependencias": ["T003", "T004"],
      "entregables": ["OG tags implementados", "Twitter Cards", "Preview optimizado"],
      "herramientas": ["Facebook Debugger", "Twitter Card Validator"],
      "impacto_esperado": "CTR social mejorado, shares +30%",
      "kpis": ["100% páginas con social tags", "Preview perfecto en todas redes"]
    },
    {
      "id": "T061",
      "codigo": "CONT-01",
      "nombre": "Auditoría de Contenido Existente",
      "descripcion": "Auditar todo el contenido actual, identificar gaps, contenido thin, duplicados, oportunidades de mejora",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "high",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 16,
      "dependencias": [],
      "entregables": ["Content audit spreadsheet", "Gap analysis", "Priorización páginas a optimizar"],
      "herramientas": ["Screaming Frog", "Google Analytics", "Ahrefs Content Explorer"],
      "impacto_esperado": "Identificar 30-50 páginas con potencial de mejora",
      "kpis": ["100% páginas auditadas", "Plan acción contenido"]
    },
    {
      "id": "T062",
      "codigo": "CONT-02",
      "nombre": "Estrategia de Contenido y Calendario Editorial",
      "descripcion": "Crear estrategia de contenido basada en keywords, buyer journey, competencia. Calendario editorial 6 meses",
      "categoria": "estrategia",
      "fase_origen": 2,
      "prioridad": "critical",
      "rol": ["consultant", "copywriter"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 20,
      "dependencias": ["T061"],
      "entregables": ["Content strategy document", "Calendario editorial 6 meses", "Templates contenido"],
      "herramientas": ["Google Sheets", "Notion", "Ahrefs"],
      "impacto_esperado": "Plan contenido alineado con objetivos SEO y negocio",
      "kpis": ["Calendario 6 meses completo", "24+ temas priorizados"]
    },
    {
      "id": "T063",
      "codigo": "CONT-03",
      "nombre": "Optimización de Páginas de Producto/Servicio",
      "descripcion": "Reescribir y optimizar descripciones de productos/servicios con keywords, beneficios, FAQs",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "critical",
      "rol": ["copywriter"],
      "tipo_paquete": ["marketing_contenidos", "seo"],
      "horas_estimadas": 8,
      "dependencias": ["T003", "T061"],
      "entregables": ["Descripciones optimizadas", "FAQs por producto", "Schema markup FAQ"],
      "herramientas": ["Surfer SEO", "Clearscope", "MarketMuse"],
      "impacto_esperado": "Conversión +15-20%, tiempo en página +40%",
      "kpis": ["100% productos con descripciones >300 palabras", "CR mejorado"]
    },
    {
      "id": "T064",
      "codigo": "CONT-04",
      "nombre": "Content Refresh de Páginas Top",
      "descripcion": "Actualizar, expandir y optimizar las 20 páginas con más tráfico que están perdiendo posiciones",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 7,
      "dependencias": ["T061"],
      "entregables": ["20 páginas actualizadas", "Contenido expandido +50%", "Fecha actualización visible"],
      "herramientas": ["Surfer SEO", "Google Search Console", "Ahrefs"],
      "impacto_esperado": "Recuperar posiciones perdidas, tráfico +30%",
      "kpis": ["20 páginas actualizadas", "Posiciones promedio mejoradas"]
    },
    {
      "id": "T065",
      "codigo": "CONT-05",
      "nombre": "Creación de Contenido Pilar (Pillar Pages)",
      "descripcion": "Crear 3-5 páginas pilar de 3000-5000 palabras sobre temas estratégicos, con cluster topics",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "high",
      "rol": ["copywriter", "designer"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 10,
      "dependencias": ["T062"],
      "entregables": ["3-5 pillar pages", "Diseño custom", "Internal linking a subtopics"],
      "herramientas": ["Surfer SEO", "Canva", "Figma"],
      "impacto_esperado": "Autoridad temática, +2000 sesiones/mes por pillar",
      "kpis": ["3-5 pillars publicadas", "Ranking top 10 keywords principales"]
    },
    {
      "id": "T066",
      "codigo": "CONT-06",
      "nombre": "Blog Posts Mensuales",
      "descripcion": "Escribir y publicar 4-8 posts/mes optimizados SEO, long-tail keywords, intención usuario",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "medium",
      "rol": ["copywriter"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 8,
      "dependencias": ["T062"],
      "entregables": ["4-8 posts/mes", "1200-1800 palabras/post", "Imágenes optimizadas"],
      "herramientas": ["Surfer SEO", "Grammarly", "Hemingway Editor"],
      "impacto_esperado": "Tráfico orgánico creciente +10-15% mensual",
      "kpis": ["8 posts/mes publicados", "Tráfico blog +15%"]
    },
    {
      "id": "T067",
      "codigo": "CONT-07",
      "nombre": "Guías y Recursos Descargables (Lead Magnets)",
      "descripcion": "Crear 3-5 guías PDF descargables optimizadas para generación de leads",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "medium",
      "rol": ["copywriter", "designer"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 24,
      "dependencias": ["T062"],
      "entregables": ["3-5 PDFs descargables", "Landing pages lead magnet", "Email nurturing sequence"],
      "herramientas": ["Canva", "Adobe InDesign", "Mailchimp"],
      "impacto_esperado": "Generación leads +200/mes, email list growth",
      "kpis": ["5 lead magnets creados", "Conversion rate >5%"]
    },
    {
      "id": "T068",
      "codigo": "CONT-08",
      "nombre": "Contenido Multimedia: Videos y Podcasts",
      "descripcion": "Crear estrategia video/podcast, producir 6-10 piezas, optimizar para YouTube/Spotify SEO",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "low",
      "rol": ["copywriter", "designer"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 10,
      "dependencias": ["T062"],
      "entregables": ["6-10 videos/podcasts", "Transcripciones SEO", "YouTube optimization"],
      "herramientas": ["Descript", "Canva Video", "TubeBuddy"],
      "impacto_esperado": "Engagement +50%, backlinks desde embeds",
      "kpis": ["10 videos publicados", "1000+ views/video"]
    },
    {
      "id": "T069",
      "codigo": "CONT-09",
      "nombre": "Glosarios y Páginas de Recursos",
      "descripcion": "Crear glosario términos industria, directorio recursos, páginas hub optimizadas",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "medium",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 16,
      "dependencias": ["T062"],
      "entregables": ["Glosario 50-100 términos", "2-3 páginas recursos", "Internal linking hub"],
      "herramientas": ["WordPress", "Excel", "Ahrefs"],
      "impacto_esperado": "Autoridad E-E-A-T, long-tail traffic +500 sesiones/mes",
      "kpis": ["Glosario completo", "Ranking términos específicos"]
    },
    {
      "id": "T070",
      "codigo": "CONT-10",
      "nombre": "Estudios de Caso y Testimonios",
      "descripcion": "Redactar 5-10 case studies con resultados clientes, testimonios estructurados con schema",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "medium",
      "rol": ["copywriter"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 20,
      "dependencias": [],
      "entregables": ["5-10 case studies", "Testimonials con schema", "Video testimonials (opcional)"],
      "herramientas": ["Google Docs", "Loom", "Schema.org"],
      "impacto_esperado": "Conversión +10%, trust signals mejorados",
      "kpis": ["10 case studies publicados", "Schema review implementado"]
    },
    {
      "id": "T071",
      "codigo": "CONT-11",
      "nombre": "FAQs Estratégicas por Categoría",
      "descripcion": "Crear páginas FAQ optimizadas por categoría/producto con schema markup",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["copywriter"],
      "tipo_paquete": ["marketing_contenidos", "seo"],
      "horas_estimadas": 12,
      "dependencias": ["T063"],
      "entregables": ["FAQs por categoría", "Schema FAQPage", "Featured snippets optimization"],
      "herramientas": ["Answer The Public", "AlsoAsked", "Schema Markup Generator"],
      "impacto_esperado": "Featured snippets, CTR +20%",
      "kpis": ["3-5 FAQ pages", "Featured snippets ganados"]
    },
    {
      "id": "T072",
      "codigo": "CONT-12",
      "nombre": "Content Promotion y Distribución",
      "descripcion": "Estrategia promoción contenido: social media, email, outreach, paid amplification",
      "categoria": "estrategia",
      "fase_origen": 2,
      "prioridad": "medium",
      "rol": ["pr_specialist", "consultant"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 16,
      "dependencias": ["T062"],
      "entregables": ["Promotion checklist", "Email templates", "Social media calendar"],
      "herramientas": ["Buffer", "Mailchimp", "BuzzSumo"],
      "impacto_esperado": "Reach 5x, backlinks +15-20",
      "kpis": ["Cada pieza promovida 5+ canales", "Shares +100%"]
    },
    {
      "id": "T073",
      "codigo": "CONT-13",
      "nombre": "Content Gaps vs Competencia",
      "descripcion": "Análisis content gap profundo vs top 3 competidores, identificar oportunidades",
      "categoria": "estrategia",
      "fase_origen": 2,
      "prioridad": "high",
      "rol": ["seo_specialist", "consultant"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 12,
      "dependencias": ["T061"],
      "entregables": ["Content gap report", "50-100 keywords opportunity", "Priorización temas"],
      "herramientas": ["Ahrefs Content Gap", "SEMrush", "Surfer SEO"],
      "impacto_esperado": "Identificar 50-100 keywords no explotados",
      "kpis": ["Gap analysis completo", "Plan 20+ nuevos contenidos"]
    },
    {
      "id": "T074",
      "codigo": "CONT-14",
      "nombre": "Optimización de Conversión en Contenido",
      "descripcion": "Añadir CTAs estratégicos, lead forms, exit-intent popups, content upgrades",
      "categoria": "contenido",
      "fase_origen": 4,
      "prioridad": "high",
      "rol": ["copywriter", "developer"],
      "tipo_paquete": ["marketing_contenidos", "dev_design"],
      "horas_estimadas": 16,
      "dependencias": ["T063", "T066"],
      "entregables": ["CTAs optimizados", "Lead forms", "A/B tests setup"],
      "herramientas": ["OptinMonster", "Elementor", "Google Optimize"],
      "impacto_esperado": "Conversion rate contenido +25%",
      "kpis": ["CTAs en 100% contenido", "CR de contenido +25%"]
    },
    {
      "id": "T075",
      "codigo": "CONT-15",
      "nombre": "Localización de Contenido (si aplica)",
      "descripcion": "Traducir y adaptar contenido clave a idiomas adicionales con SEO local",
      "categoria": "contenido",
      "fase_origen": 2,
      "prioridad": "low",
      "rol": ["copywriter", "seo_specialist"],
      "tipo_paquete": ["marketing_contenidos"],
      "horas_estimadas": 10,
      "dependencias": ["T063", "T065"],
      "entregables": ["Contenido en 2-3 idiomas", "Hreflang implementado", "SEO local optimizado"],
      "herramientas": ["DeepL", "Smartling", "Screaming Frog"],
      "impacto_esperado": "Mercados internacionales, +50% reach",
      "kpis": ["3 idiomas implementados", "Tráfico internacional +50%"]
    }
  ]
}
JSON;

$tareasData = json_decode($tareasJSON, true);
$tareas = $tareasData['tareas'];
$categorias = $tareasData['categorias'];
$roles = $tareasData['roles'];

// Función para obtener color por prioridad
function getColorPrioridad($prioridad) {
    switch($prioridad) {
        case 'critical': return '#dc2626';
        case 'high': return '#ea580c';
        case 'medium': return '#2563eb';
        case 'low': return '#64748b';
        default: return '#6b7280';
    }
}

// Función para obtener icono por categoría
function getIconCategoria($categoria) {
    $icons = [
        'tecnico' => 'fa-cogs',
        'contenido' => 'fa-file-alt',
        'diseno' => 'fa-paint-brush',
        'analytics' => 'fa-chart-line',
        'linkbuilding' => 'fa-link',
        'estrategia' => 'fa-lightbulb'
    ];
    return $icons[$categoria] ?? 'fa-tasks';
}

// Función para calcular duración en formato legible
function formatDuracion($horas) {
    if ($horas < 8) return $horas . 'h';
    $dias = round($horas / 8, 1);
    return $dias . ' días';
}

// Función para obtener tareas por prioridad
function getTareasPorPrioridad($tareas, $prioridad) {
    return array_filter($tareas, function($t) use ($prioridad) {
        return $t['prioridad'] === $prioridad;
    });
}

// Función para calcular estadísticas
// Separar tareas por tipo exclusivo y compartido
$tareasSoloSEO = array_filter($tareas, function($t) {
    return in_array('seo', $t['tipo_paquete']) && !in_array('dev_design', $t['tipo_paquete']);
});
$tareasCompartidas = array_filter($tareas, function($t) {
    return in_array('seo', $t['tipo_paquete']) && in_array('dev_design', $t['tipo_paquete']);
});
$tareasSoloDev = array_filter($tareas, function($t) {
    return in_array('dev_design', $t['tipo_paquete']) && !in_array('seo', $t['tipo_paquete']);
});

// Calcular breakdown SEO/Shared/Dev por cada nivel de prioridad
$prioridadBreakdown = [];
foreach (['critical', 'high', 'medium', 'low'] as $prioridad) {
    $tareasPrioridad = getTareasPorPrioridad($tareas, $prioridad);

    $seoSolo = array_filter($tareasPrioridad, function($t) {
        return in_array('seo', $t['tipo_paquete']) && !in_array('dev_design', $t['tipo_paquete']);
    });

    $compartidas = array_filter($tareasPrioridad, function($t) {
        return in_array('seo', $t['tipo_paquete']) && in_array('dev_design', $t['tipo_paquete']);
    });

    $devSolo = array_filter($tareasPrioridad, function($t) {
        return in_array('dev_design', $t['tipo_paquete']) && !in_array('seo', $t['tipo_paquete']);
    });

    $prioridadBreakdown[$prioridad] = [
        'total' => count($tareasPrioridad),
        'seo_horas' => array_sum(array_column($seoSolo, 'horas_estimadas')),
        'compartidas_horas' => array_sum(array_column($compartidas, 'horas_estimadas')),
        'dev_horas' => array_sum(array_column($devSolo, 'horas_estimadas')),
    ];
}

$stats = [
    'total' => count($tareas),
    'critical' => $prioridadBreakdown['critical']['total'],
    'high' => $prioridadBreakdown['high']['total'],
    'medium' => $prioridadBreakdown['medium']['total'],
    'low' => $prioridadBreakdown['low']['total'],
    'horas_total' => array_sum(array_column($tareas, 'horas_estimadas')),
    'seo_solo' => count($tareasSoloSEO),
    'seo_solo_horas' => array_sum(array_column($tareasSoloSEO, 'horas_estimadas')),
    'compartidas' => count($tareasCompartidas),
    'compartidas_horas' => array_sum(array_column($tareasCompartidas, 'horas_estimadas')),
    'dev_solo' => count($tareasSoloDev),
    'dev_solo_horas' => array_sum(array_column($tareasSoloDev, 'horas_estimadas')),
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas Post-Auditoría SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.js"></script>
    <style>
        :root {
            --primary: #88B04B;
            --primary-dark: #6d8f3c;
            --secondary: #2563eb;
            --danger: #dc2626;
            --warning: #ea580c;
            --info: #0891b2;
            --light-bg: #f8fafc;
        }

        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .hero-section {
            background: white;
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
        }

        .hero-section .subtitle {
            font-size: 20px;
            color: #64748b;
            margin-bottom: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.critical {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }

        .stat-card.high {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        }

        .stat-card.medium {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .stat-card.low {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        .stat-number {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
        }

        .task-card {
            background: #f8fafc;
            border-left: 4px solid var(--primary);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .task-card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }

        .task-card.critical {
            border-left-color: #dc2626;
            background: #fef2f2;
        }

        .task-card.high {
            border-left-color: #ea580c;
            background: #fff7ed;
        }

        .task-card.medium {
            border-left-color: #2563eb;
            background: #eff6ff;
        }

        .task-card.low {
            border-left-color: #64748b;
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .task-id {
            background: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            display: inline-block;
        }

        .task-name {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .task-description {
            color: #475569;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
        }

        .meta-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .meta-badge.hours {
            background: #dbeafe;
            color: #1e40af;
        }

        .meta-badge.role {
            background: #e0e7ff;
            color: #4338ca;
        }

        .meta-badge.category {
            background: #d1fae5;
            color: #065f46;
        }

        .meta-badge.priority {
            background: #fee2e2;
            color: #991b1b;
        }

        .dependencies-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .dependency-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            margin-right: 8px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .plan-generator {
            background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
        }

        .plan-generator h2 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 12px 20px;
            font-size: 16px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(136, 176, 75, 0.1);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
        }

        .btn-generate {
            background: var(--primary);
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-generate:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            background: white;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .methodology-section {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
        }

        .methodology-section h3 {
            color: #78350f;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .methodology-list {
            list-style: none;
            padding: 0;
        }

        .methodology-list li {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .methodology-list li i {
            color: var(--primary);
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 32px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1><i class="fas fa-tasks"></i> Gestión de Tareas Post-Auditoría</h1>
            <p class="subtitle">Sistema completo de planificación y ejecución de recomendaciones SEO</p>

            <!-- Estadísticas Generales -->
            <div class="stats-grid">
                <div class="stat-card" style="grid-column: span 2; background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);">
                    <div class="stat-number"><?php echo $stats['total']; ?> Tareas Totales</div>
                    <div class="stat-label" style="font-size: 16px; margin-top: 10px;">
                        <span style="color: #ffffff; font-weight: 700;">SEO</span>
                        (<?php echo $stats['seo_solo_horas']; ?>h /
                        <span style="color: #fef3c7;">↔ <?php echo $stats['compartidas_horas']; ?>h</span> /
                        <?php echo $stats['dev_solo_horas']; ?>h)
                        <span style="color: #93c5fd; font-weight: 700;">Dev</span>
                    </div>
                </div>
                <div class="stat-card critical">
                    <div class="stat-number"><?php echo $stats['critical']; ?></div>
                    <div class="stat-label">Críticas</div>
                    <div style="font-size: 11px; margin-top: 8px; opacity: 0.95;">
                        <span style="color: #88B04B; font-weight: 600;">SEO</span>
                        (<?php echo $prioridadBreakdown['critical']['seo_horas']; ?>h /
                        <span style="color: #fbbf24;">↔ <?php echo $prioridadBreakdown['critical']['compartidas_horas']; ?>h</span> /
                        <?php echo $prioridadBreakdown['critical']['dev_horas']; ?>h)
                        <span style="color: #2563eb; font-weight: 600;">Dev</span>
                    </div>
                </div>
                <div class="stat-card high">
                    <div class="stat-number"><?php echo $stats['high']; ?></div>
                    <div class="stat-label">Alta Prioridad</div>
                    <div style="font-size: 11px; margin-top: 8px; opacity: 0.95;">
                        <span style="color: #88B04B; font-weight: 600;">SEO</span>
                        (<?php echo $prioridadBreakdown['high']['seo_horas']; ?>h /
                        <span style="color: #fbbf24;">↔ <?php echo $prioridadBreakdown['high']['compartidas_horas']; ?>h</span> /
                        <?php echo $prioridadBreakdown['high']['dev_horas']; ?>h)
                        <span style="color: #2563eb; font-weight: 600;">Dev</span>
                    </div>
                </div>
                <div class="stat-card medium">
                    <div class="stat-number"><?php echo $stats['medium']; ?></div>
                    <div class="stat-label">Prioridad Media</div>
                    <div style="font-size: 11px; margin-top: 8px; opacity: 0.95;">
                        <span style="color: #88B04B; font-weight: 600;">SEO</span>
                        (<?php echo $prioridadBreakdown['medium']['seo_horas']; ?>h /
                        <span style="color: #fbbf24;">↔ <?php echo $prioridadBreakdown['medium']['compartidas_horas']; ?>h</span> /
                        <?php echo $prioridadBreakdown['medium']['dev_horas']; ?>h)
                        <span style="color: #2563eb; font-weight: 600;">Dev</span>
                    </div>
                </div>
                <div class="stat-card low">
                    <div class="stat-number"><?php echo $stats['low']; ?></div>
                    <div class="stat-label">Baja Prioridad</div>
                    <div style="font-size: 11px; margin-top: 8px; opacity: 0.95;">
                        <span style="color: #88B04B; font-weight: 600;">SEO</span>
                        (<?php echo $prioridadBreakdown['low']['seo_horas']; ?>h /
                        <span style="color: #fbbf24;">↔ <?php echo $prioridadBreakdown['low']['compartidas_horas']; ?>h</span> /
                        <?php echo $prioridadBreakdown['low']['dev_horas']; ?>h)
                        <span style="color: #2563eb; font-weight: 600;">Dev</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo number_format($stats['horas_total']); ?>h</div>
                    <div class="stat-label">Horas Totales</div>
                </div>
            </div>
        </div>

        <!-- PASO 1: Selección de Tareas -->
        <div class="task-selector" id="taskSelector" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h2><i class="fas fa-tasks"></i> Paso 1: Selección de Tareas</h2>
            <p style="margin-bottom: 25px; font-size: 16px; color: #6b7280;">Selecciona las tareas que deseas incluir en tu plan de ejecución</p>

            <!-- Calculadora de horas (sticky summary) -->
            <div id="taskSummary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; margin-bottom: 25px;">
                <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; text-align: center;">
                    <div>
                        <div style="font-size: 28px; font-weight: 700;" id="totalSelected">0</div>
                        <div style="font-size: 13px; opacity: 0.9;">Tareas Seleccionadas</div>
                    </div>
                    <div>
                        <div style="font-size: 28px; font-weight: 700;" id="totalHours">0h</div>
                        <div style="font-size: 13px; opacity: 0.9;">Horas Totales</div>
                    </div>
                    <div>
                        <div style="font-size: 20px; font-weight: 600;" id="criticalHours">0h</div>
                        <div style="font-size: 12px; opacity: 0.9;">Críticas</div>
                    </div>
                    <div>
                        <div style="font-size: 20px; font-weight: 600;" id="highHours">0h</div>
                        <div style="font-size: 12px; opacity: 0.9;">Altas</div>
                    </div>
                    <div>
                        <div style="font-size: 20px; font-weight: 600;" id="mediumLowHours">0h</div>
                        <div style="font-size: 12px; opacity: 0.9;">Medias+Bajas</div>
                    </div>
                </div>
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.3); font-size: 14px; opacity: 0.95;" id="packageSuggestion">
                    💡 Sugerencia: Selecciona tareas para ver recomendación de paquete
                </div>
            </div>

            <!-- Tabs por servicio -->
            <ul class="nav nav-tabs mb-3" id="serviceTabs" role="tablist" style="border-bottom: 2px solid #e5e7eb;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-panel" type="button" role="tab" style="color: #88B04B; font-weight: 600;">
                        <i class="fas fa-search"></i> SEO Técnico <span class="badge bg-success ms-2" id="seoCount">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dev-tab" data-bs-toggle="tab" data-bs-target="#dev-panel" type="button" role="tab" style="color: #2563eb; font-weight: 600;">
                        <i class="fas fa-code"></i> Dev/Design <span class="badge bg-primary ms-2" id="devCount">0</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="marketing-tab" data-bs-toggle="tab" data-bs-target="#marketing-panel" type="button" role="tab" style="color: #9333ea; font-weight: 600;">
                        <i class="fas fa-bullhorn"></i> Marketing <span class="badge bg-purple ms-2" id="marketingCount" style="background: #9333ea;">0</span>
                    </button>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="serviceTabsContent">
                <!-- SEO Panel -->
                <div class="tab-pane fade show active" id="seo-panel" role="tabpanel">
                    <div class="filter-bar" style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="selectAllService('seo')">
                                <i class="fas fa-check-double"></i> Todas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectNoneService('seo')">
                                <i class="fas fa-times"></i> Ninguna
                            </button>
                            <div style="border-left: 2px solid #d1d5db; height: 30px; margin: 0 8px;"></div>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="filterByPriority('seo', 'critical')">
                                🔴 Críticas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="filterByPriority('seo', 'high')">
                                🟠 Altas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="filterByPriority('seo', 'medium')">
                                🔵 Medias+Bajas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="filterQuickWins('seo')">
                                ⚡ Quick Wins
                            </button>
                        </div>
                    </div>
                    <div id="seo-tasks-list"></div>
                </div>

                <!-- Dev Panel -->
                <div class="tab-pane fade" id="dev-panel" role="tabpanel">
                    <div class="filter-bar" style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllService('dev')">
                                <i class="fas fa-check-double"></i> Todas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectNoneService('dev')">
                                <i class="fas fa-times"></i> Ninguna
                            </button>
                            <div style="border-left: 2px solid #d1d5db; height: 30px; margin: 0 8px;"></div>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="filterByPriority('dev', 'critical')">
                                🔴 Críticas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="filterByPriority('dev', 'high')">
                                🟠 Altas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="filterByPriority('dev', 'medium')">
                                🔵 Medias+Bajas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="filterQuickWins('dev')">
                                ⚡ Quick Wins
                            </button>
                        </div>
                    </div>
                    <div id="dev-tasks-list"></div>
                </div>

                <!-- Marketing Panel -->
                <div class="tab-pane fade" id="marketing-panel" role="tabpanel">
                    <div class="filter-bar" style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <button type="button" class="btn btn-sm" style="border: 1px solid #9333ea; color: #9333ea;" onclick="selectAllService('marketing')">
                                <i class="fas fa-check-double"></i> Todas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectNoneService('marketing')">
                                <i class="fas fa-times"></i> Ninguna
                            </button>
                            <div style="border-left: 2px solid #d1d5db; height: 30px; margin: 0 8px;"></div>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="filterByPriority('marketing', 'critical')">
                                🔴 Críticas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="filterByPriority('marketing', 'high')">
                                🟠 Altas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="filterByPriority('marketing', 'medium')">
                                🔵 Medias+Bajas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="filterQuickWins('marketing')">
                                ⚡ Quick Wins
                            </button>
                        </div>
                    </div>
                    <div id="marketing-tasks-list"></div>
                </div>
            </div>
        </div>

        <!-- PASO 2: Generador de Planes -->
        <div class="plan-generator" id="planGenerator">
            <h2><i class="fas fa-calendar-alt"></i> Paso 2: Configuración de Paquetes</h2>
            <p style="margin-bottom: 30px; font-size: 16px; color: #6b7280;">Define tus paquetes de horas iniciales y mensuales para las tareas seleccionadas</p>

            <form id="planForm">
                <!-- Fases completadas en auditoría -->
                <div class="alert alert-info mb-4" style="background: #e0f2fe; border-left: 4px solid #0284c7;">
                    <h6 style="margin: 0 0 15px 0; color: #0c4a6e;"><i class="fas fa-filter"></i> Filtrar tareas por fase de origen (Opcional)</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="faseCompletada1">
                                <label class="form-check-label" for="faseCompletada1">
                                    Excluir Fase 1: Preparación
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="faseCompletada2">
                                <label class="form-check-label" for="faseCompletada2">
                                    Excluir Fase 2: Keyword Research
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3" id="faseCompletada3">
                                <label class="form-check-label" for="faseCompletada3">
                                    Excluir Fase 3: Arquitectura
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4" id="faseCompletada4">
                                <label class="form-check-label" for="faseCompletada4">
                                    Excluir Fase 4: Auditoría
                                </label>
                            </div>
                        </div>
                    </div>
                    <small style="color: #0c4a6e; display: block; margin-top: 10px;">
                        Por defecto, se incluyen tareas de todas las fases. Marca las fases que quieres excluir del plan.
                    </small>
                </div>

                <!-- Paquete Inicial (One-time) -->
                <div class="card mb-4" style="border: 2px solid #88B04B;">
                    <div class="card-header" style="background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white;">
                        <h5 style="margin: 0; color: white;"><i class="fas fa-rocket"></i> Paquete Inicial (One-time)</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas SEO Iniciales</label>
                                <input type="number" class="form-control" id="horasSEOIniciales" min="0" max="500" value="0" placeholder="ej: 30">
                                <small class="form-text text-muted">Horas SEO técnico iniciales</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas Dev/Design Iniciales</label>
                                <input type="number" class="form-control" id="horasDevIniciales" min="0" max="500" value="0" placeholder="ej: 20">
                                <small class="form-text text-muted">Horas desarrollo/diseño iniciales</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas Marketing Contenidos Iniciales</label>
                                <input type="number" class="form-control" id="horasMarketingIniciales" min="0" max="500" value="0" placeholder="ej: 15">
                                <small class="form-text text-muted">Horas marketing de contenidos iniciales</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paquete Mensual (Recurrente) -->
                <div class="card mb-4" style="border: 2px solid #3b82f6;">
                    <div class="card-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                        <h5 style="margin: 0; color: white;"><i class="fas fa-sync"></i> Paquete Mensual Recurrente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas SEO/mes</label>
                                <select class="form-select" id="horasSEOMensual">
                                    <option value="0">Sin paquete mensual SEO</option>
                                    <option value="4">4 horas/mes (Mínimo)</option>
                                    <option value="8">8 horas/mes (Básico)</option>
                                    <option value="16">16 horas/mes (Estándar)</option>
                                    <option value="24">24 horas/mes (Profesional)</option>
                                    <option value="32">32 horas/mes (Avanzado)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas Dev/Design/mes</label>
                                <select class="form-select" id="horasDevMensual">
                                    <option value="0">Sin paquete mensual Dev</option>
                                    <option value="4">4 horas/mes (Mínimo)</option>
                                    <option value="8">8 horas/mes (Básico)</option>
                                    <option value="16">16 horas/mes (Estándar)</option>
                                    <option value="24">24 horas/mes (Profesional)</option>
                                    <option value="32">32 horas/mes (Avanzado)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Horas Marketing Contenidos/mes</label>
                                <select class="form-select" id="horasMarketingMensual">
                                    <option value="0">Sin paquete mensual Marketing</option>
                                    <option value="4">4 horas/mes (Mínimo)</option>
                                    <option value="8">8 horas/mes (Básico)</option>
                                    <option value="16">16 horas/mes (Estándar)</option>
                                    <option value="24">24 horas/mes (Profesional)</option>
                                    <option value="32">32 horas/mes (Avanzado)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configuración general -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duración del Plan (meses)</label>
                        <input type="number" class="form-control" id="numMeses" min="1" max="24" value="6" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Priorizar</label>
                        <select class="form-select" id="priorizar">
                            <option value="prioridad">Por Prioridad (Critical first)</option>
                            <option value="dependencias">Por Dependencias (Prerequisitos first)</option>
                            <option value="quick_wins">Quick Wins (Menor tiempo first)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-generate w-100">
                            <i class="fas fa-magic"></i> Generar Plan de Ejecución
                        </button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="button" class="btn btn-outline-primary w-100" id="btnComparar" style="display: none;">
                            <i class="fas fa-balance-scale"></i> Comparar con Otro Escenario
                        </button>
                    </div>
                </div>
            </form>

            <!-- Resultado del plan (se llenará dinámicamente) -->
            <div id="planResult" style="display: none; margin-top: 40px;">
                <!-- El plan generado aparecerá aquí -->
            </div>

            <!-- Comparación de escenarios -->
            <div id="comparacionResult" style="display: none; margin-top: 40px;">
                <!-- La comparación aparecerá aquí -->
            </div>
        </div>

        <!-- Metodología -->
        <div class="methodology-section">
            <h3><i class="fas fa-lightbulb"></i> Cómo Usar Este Sistema</h3>
            <ul class="methodology-list">
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span><strong>Paso 1:</strong> Revisa todas las tareas del catálogo completo abajo para entender el alcance total</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span><strong>Paso 2:</strong> Usa el generador de planes para crear un roadmap mensual adaptado a tus horas disponibles</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span><strong>Paso 3:</strong> El sistema respetará dependencias automáticamente (no podrás hacer B si A no está completo)</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span><strong>Paso 4:</strong> Cada tarea incluye roles necesarios, herramientas, KPIs e impacto esperado</span>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span><strong>Paso 5:</strong> Exporta el plan generado y úsalo para coordinar con tu equipo SEO/Dev/Design</span>
                </li>
            </ul>
        </div>

        <!-- Filtros -->
        <div class="filter-section">
            <h4 style="margin-bottom: 20px;"><i class="fas fa-filter"></i> Filtrar Tareas</h4>
            <div>
                <button class="filter-btn active" data-filter="all">Todas</button>
                <button class="filter-btn" data-filter="critical">Críticas</button>
                <button class="filter-btn" data-filter="high">Alta Prioridad</button>
                <button class="filter-btn" data-filter="medium">Media Prioridad</button>
                <button class="filter-btn" data-filter="low">Baja Prioridad</button>
                <button class="filter-btn" data-filter="tecnico">Técnico</button>
                <button class="filter-btn" data-filter="contenido">Contenido</button>
                <button class="filter-btn" data-filter="diseno">Diseño</button>
                <button class="filter-btn" data-filter="analytics">Analytics</button>
                <button class="filter-btn" data-filter="linkbuilding">Link Building</button>
            </div>
        </div>

        <!-- Catálogo Completo de Tareas -->
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-list-check"></i>
                Catálogo Completo de Tareas (<?php echo count($tareas); ?>)
            </h2>

            <div id="tasksContainer">
                <?php foreach ($tareas as $tarea): ?>
                <div class="task-card <?php echo $tarea['prioridad']; ?>"
                     data-priority="<?php echo $tarea['prioridad']; ?>"
                     data-category="<?php echo $tarea['categoria']; ?>">

                    <div class="task-id"><?php echo htmlspecialchars($tarea['id']); ?> - <?php echo htmlspecialchars($tarea['codigo']); ?></div>

                    <div class="task-header">
                        <div style="flex: 1;">
                            <h3 class="task-name"><?php echo htmlspecialchars($tarea['nombre']); ?></h3>
                            <p class="task-description"><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                        </div>
                    </div>

                    <div class="task-meta">
                        <span class="meta-badge priority" style="background-color: <?php echo getColorPrioridad($tarea['prioridad']); ?>; color: white;">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo ucfirst($tarea['prioridad']); ?>
                        </span>

                        <span class="meta-badge hours">
                            <i class="fas fa-clock"></i>
                            <?php echo formatDuracion($tarea['horas_estimadas']); ?>
                        </span>

                        <span class="meta-badge category">
                            <i class="fas <?php echo getIconCategoria($tarea['categoria']); ?>"></i>
                            <?php echo $categorias[$tarea['categoria']]; ?>
                        </span>

                        <?php foreach ($tarea['rol'] as $rol): ?>
                        <span class="meta-badge role">
                            <i class="fas fa-user"></i>
                            <?php echo $roles[$rol]; ?>
                        </span>
                        <?php endforeach; ?>
                    </div>

                    <?php if (!empty($tarea['dependencias'])): ?>
                    <div class="dependencies-section">
                        <strong style="color: #64748b; font-size: 14px;">
                            <i class="fas fa-sitemap"></i> Dependencias:
                        </strong>
                        <?php foreach ($tarea['dependencias'] as $dep): ?>
                        <span class="dependency-badge"><?php echo $dep; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e2e8f0;">
                        <strong style="color: #1e293b; font-size: 14px;">Impacto Esperado:</strong>
                        <p style="color: #475569; margin: 5px 0 0 0; font-size: 14px;">
                            <?php echo htmlspecialchars($tarea['impacto_esperado']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Datos de tareas en JavaScript
        const tareasData = <?php echo $tareasJSON; ?>;
        const tareas = tareasData.tareas;

        // Filtrado de tareas
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                const taskCards = document.querySelectorAll('.task-card');

                taskCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else if (card.dataset.priority === filter || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // ========================================
        // SISTEMA DE SELECCIÓN DE TAREAS
        // ========================================

        // Set global para almacenar IDs de tareas seleccionadas
        const selectedTasks = new Set();

        // Inicializar task lists al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar TODAS las tareas por defecto
            tareas.forEach(t => selectedTasks.add(t.id));

            renderTasksByService('seo');
            renderTasksByService('dev');
            renderTasksByService('marketing');
            updateTaskSummary();
        });

        /**
         * Renderiza las tareas para un servicio específico
         */
        function renderTasksByService(service) {
            const serviceMap = {
                'seo': 'seo',
                'dev': 'dev_design',
                'marketing': 'marketing_contenidos'
            };

            const tipoPaquete = serviceMap[service];
            const containerID = `${service}-tasks-list`;
            const container = document.getElementById(containerID);

            if (!container) return;

            // Filtrar tareas por tipo de paquete
            const tareasServicio = tareas.filter(t => t.tipo_paquete.includes(tipoPaquete));

            if (tareasServicio.length === 0) {
                container.innerHTML = '<div style="padding: 20px; text-align: center; color: #64748b;">No hay tareas disponibles para este servicio</div>';
                return;
            }

            // Agrupar por prioridad
            const prioridadOrden = ['critical', 'high', 'medium', 'low'];
            const tareasPorPrioridad = {};
            prioridadOrden.forEach(p => tareasPorPrioridad[p] = []);

            tareasServicio.forEach(t => {
                if (tareasPorPrioridad[t.prioridad]) {
                    tareasPorPrioridad[t.prioridad].push(t);
                }
            });

            let html = '';

            prioridadOrden.forEach(prioridad => {
                const tareasGrupo = tareasPorPrioridad[prioridad];
                if (tareasGrupo.length === 0) return;

                const prioridadLabels = {
                    'critical': '🔴 Críticas',
                    'high': '🟠 Altas',
                    'medium': '🔵 Medias',
                    'low': '⚪ Bajas'
                };

                const prioridadColors = {
                    'critical': '#dc2626',
                    'high': '#ea580c',
                    'medium': '#3b82f6',
                    'low': '#64748b'
                };

                html += `
                    <div class="priority-group mb-3" data-priority="${prioridad}">
                        <div style="background: ${prioridadColors[prioridad]}15; padding: 10px 15px; border-left: 4px solid ${prioridadColors[prioridad]}; margin-bottom: 10px; border-radius: 4px;">
                            <strong style="color: ${prioridadColors[prioridad]}; font-size: 14px;">
                                ${prioridadLabels[prioridad]} (${tareasGrupo.length} tareas, ${tareasGrupo.reduce((sum, t) => sum + t.horas_estimadas, 0)}h)
                            </strong>
                        </div>
                `;

                tareasGrupo.forEach(tarea => {
                    const isChecked = selectedTasks.has(tarea.id) ? 'checked' : '';
                    const quickWinBadge = tarea.horas_estimadas < 4 ? '<span style="background: #fbbf24; color: #78350f; padding: 2px 6px; border-radius: 3px; font-size: 11px; font-weight: 600; margin-left: 5px;">⚡ QUICK WIN</span>' : '';
                    const depBadge = tarea.dependencias.length > 0 ? `<span style="background: #e5e7eb; color: #374151; padding: 2px 6px; border-radius: 3px; font-size: 11px; margin-left: 5px;"><i class="fas fa-sitemap" style="font-size: 10px;"></i> ${tarea.dependencias.length} dep</span>` : '';

                    html += `
                        <div class="task-checkbox-item" data-task-id="${tarea.id}" data-priority="${prioridad}" data-hours="${tarea.horas_estimadas}" style="background: white; border: 1px solid #e5e7eb; border-radius: 6px; padding: 12px 15px; margin-bottom: 8px; transition: all 0.2s;">
                            <label style="display: flex; align-items: start; cursor: pointer; margin: 0; width: 100%;">
                                <input type="checkbox"
                                       class="task-checkbox"
                                       data-task-id="${tarea.id}"
                                       data-service="${service}"
                                       data-priority="${prioridad}"
                                       data-hours="${tarea.horas_estimadas}"
                                       ${isChecked}
                                       onchange="handleTaskCheckboxChange(this)"
                                       style="width: 18px; height: 18px; margin-right: 12px; margin-top: 2px; cursor: pointer;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px;">
                                        <strong style="color: #1e293b; font-size: 14px;">${tarea.nombre}</strong>
                                        <span style="color: #64748b; font-weight: 600; font-size: 14px; white-space: nowrap; margin-left: 10px;">
                                            <i class="fas fa-clock" style="font-size: 12px;"></i> ${tarea.horas_estimadas}h
                                        </span>
                                    </div>
                                    <div style="color: #64748b; font-size: 13px; line-height: 1.4; margin-bottom: 6px;">
                                        ${tarea.descripcion}
                                    </div>
                                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 5px;">
                                        <span style="background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 3px; font-size: 11px;">
                                            ${tarea.codigo}
                                        </span>
                                        ${quickWinBadge}
                                        ${depBadge}
                                    </div>
                                </div>
                            </label>
                        </div>
                    `;
                });

                html += `</div>`;
            });

            container.innerHTML = html;
        }

        /**
         * Maneja el cambio de estado de un checkbox de tarea
         */
        function handleTaskCheckboxChange(checkbox) {
            const taskId = checkbox.dataset.taskId; // IDs son strings "T001", "T002", etc.

            if (checkbox.checked) {
                selectedTasks.add(taskId);
            } else {
                selectedTasks.delete(taskId);
            }

            updateTaskSummary();
        }

        /**
         * Actualiza el resumen de tareas seleccionadas
         */
        function updateTaskSummary() {
            const selectedTasksArray = Array.from(selectedTasks).map(id =>
                tareas.find(t => t.id === id)
            ).filter(t => t); // Filtrar undefined

            const totalSelected = selectedTasksArray.length;
            const totalHours = selectedTasksArray.reduce((sum, t) => sum + t.horas_estimadas, 0);

            // Calcular horas por prioridad
            const criticalHours = selectedTasksArray.filter(t => t.prioridad === 'critical').reduce((sum, t) => sum + t.horas_estimadas, 0);
            const highHours = selectedTasksArray.filter(t => t.prioridad === 'high').reduce((sum, t) => sum + t.horas_estimadas, 0);
            const mediumLowHours = selectedTasksArray.filter(t => t.prioridad === 'medium' || t.prioridad === 'low').reduce((sum, t) => sum + t.horas_estimadas, 0);

            // Actualizar summary card
            document.getElementById('totalSelected').textContent = totalSelected;
            document.getElementById('totalHours').textContent = totalHours + 'h';
            document.getElementById('criticalHours').textContent = criticalHours + 'h';
            document.getElementById('highHours').textContent = highHours + 'h';
            document.getElementById('mediumLowHours').textContent = mediumLowHours + 'h';

            // Actualizar badges de tabs con formato "X de Y tareas (Ah de Bh)"
            // Calcular tareas SELECCIONADAS
            const seoTasksArray = selectedTasksArray.filter(t => t.tipo_paquete.includes('seo'));
            const devTasksArray = selectedTasksArray.filter(t => t.tipo_paquete.includes('dev_design'));
            const marketingTasksArray = selectedTasksArray.filter(t => t.tipo_paquete.includes('marketing_contenidos'));

            const seoHours = seoTasksArray.reduce((sum, t) => sum + t.horas_estimadas, 0);
            const devHours = devTasksArray.reduce((sum, t) => sum + t.horas_estimadas, 0);
            const marketingHours = marketingTasksArray.reduce((sum, t) => sum + t.horas_estimadas, 0);

            // Calcular TOTALES (todas las tareas disponibles)
            const seoTotalArray = tareas.filter(t => t.tipo_paquete.includes('seo'));
            const devTotalArray = tareas.filter(t => t.tipo_paquete.includes('dev_design'));
            const marketingTotalArray = tareas.filter(t => t.tipo_paquete.includes('marketing_contenidos'));

            const seoTotalHours = seoTotalArray.reduce((sum, t) => sum + t.horas_estimadas, 0);
            const devTotalHours = devTotalArray.reduce((sum, t) => sum + t.horas_estimadas, 0);
            const marketingTotalHours = marketingTotalArray.reduce((sum, t) => sum + t.horas_estimadas, 0);

            document.getElementById('seoCount').textContent = `${seoTasksArray.length} de ${seoTotalArray.length} (${seoHours}h de ${seoTotalHours}h)`;
            document.getElementById('devCount').textContent = `${devTasksArray.length} de ${devTotalArray.length} (${devHours}h de ${devTotalHours}h)`;
            document.getElementById('marketingCount').textContent = `${marketingTasksArray.length} de ${marketingTotalArray.length} (${marketingHours}h de ${marketingTotalHours}h)`;

            // Sugerencia de paquete
            const suggestionEl = document.getElementById('packageSuggestion');
            if (totalSelected === 0) {
                suggestionEl.innerHTML = '💡 Sugerencia: Selecciona tareas para ver recomendación de paquete';
            } else if (criticalHours + highHours <= 40) {
                suggestionEl.innerHTML = `💡 Sugerencia: <strong>Paquete Inicial de ${Math.ceil((criticalHours + highHours) / 4) * 4}h</strong> para críticas+altas, y plan mensual para el resto`;
            } else {
                suggestionEl.innerHTML = `💡 Sugerencia: <strong>Paquete Inicial de ${Math.ceil(criticalHours / 4) * 4}h</strong> para críticas, <strong>mensual de ${Math.ceil(highHours / 6)}h/mes</strong> para altas, resto en mantenimiento`;
            }
        }

        /**
         * Selecciona todas las tareas de un servicio
         */
        function selectAllService(service) {
            const checkboxes = document.querySelectorAll(`#${service}-tasks-list .task-checkbox`);
            checkboxes.forEach(cb => {
                cb.checked = true;
                selectedTasks.add(cb.dataset.taskId); // ID es string
            });
            updateTaskSummary();
        }

        /**
         * Deselecciona todas las tareas de un servicio
         */
        function selectNoneService(service) {
            const checkboxes = document.querySelectorAll(`#${service}-tasks-list .task-checkbox`);
            checkboxes.forEach(cb => {
                cb.checked = false;
                selectedTasks.delete(cb.dataset.taskId); // ID es string
            });
            updateTaskSummary();
        }

        /**
         * Toggle tareas por prioridad en un servicio
         */
        function filterByPriority(service, priority) {
            let checkboxes;

            // Para "medium", incluir también "low" (Medias+Bajas)
            if (priority === 'medium') {
                const mediumBoxes = document.querySelectorAll(`#${service}-tasks-list .task-checkbox[data-priority="medium"]`);
                const lowBoxes = document.querySelectorAll(`#${service}-tasks-list .task-checkbox[data-priority="low"]`);
                checkboxes = [...mediumBoxes, ...lowBoxes];
            } else {
                checkboxes = Array.from(document.querySelectorAll(`#${service}-tasks-list .task-checkbox[data-priority="${priority}"]`));
            }

            // Verificar si TODAS las tareas de esta prioridad están seleccionadas
            let allSelected = true;
            checkboxes.forEach(cb => {
                if (!cb.checked) {
                    allSelected = false;
                }
            });

            // TOGGLE: Si todas están seleccionadas → deseleccionar, sino → seleccionar todas
            checkboxes.forEach(cb => {
                if (allSelected) {
                    // Deseleccionar
                    cb.checked = false;
                    selectedTasks.delete(cb.dataset.taskId);
                } else {
                    // Seleccionar
                    cb.checked = true;
                    selectedTasks.add(cb.dataset.taskId);
                }
            });

            updateTaskSummary();
        }

        /**
         * Filtra quick wins (< 4 horas) en un servicio
         */
        function filterQuickWins(service) {
            // Primero, deseleccionar todas las tareas de este servicio
            selectNoneService(service);

            // Luego, seleccionar solo las quick wins
            const checkboxes = document.querySelectorAll(`#${service}-tasks-list .task-checkbox`);
            checkboxes.forEach(cb => {
                const hours = parseFloat(cb.dataset.hours);
                if (hours < 4) {
                    cb.checked = true;
                    selectedTasks.add(cb.dataset.taskId); // ID es string
                }
            });
            updateTaskSummary();
        }

        // Variable global para guardar escenarios
        let escenarioGuardado = null;

        // Generador de planes
        document.getElementById('planForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Leer configuración
            const horasSEOIniciales = parseInt(document.getElementById('horasSEOIniciales').value) || 0;
            const horasDevIniciales = parseInt(document.getElementById('horasDevIniciales').value) || 0;
            const horasMarketingIniciales = parseInt(document.getElementById('horasMarketingIniciales').value) || 0;
            const horasSEOMensual = parseInt(document.getElementById('horasSEOMensual').value) || 0;
            const horasDevMensual = parseInt(document.getElementById('horasDevMensual').value) || 0;
            const horasMarketingMensual = parseInt(document.getElementById('horasMarketingMensual').value) || 0;
            const numMeses = parseInt(document.getElementById('numMeses').value);
            const priorizar = document.getElementById('priorizar').value;

            // Leer fases completadas
            const fasesCompletadas = [];
            if (document.getElementById('faseCompletada1').checked) fasesCompletadas.push(1);
            if (document.getElementById('faseCompletada2').checked) fasesCompletadas.push(2);
            if (document.getElementById('faseCompletada3').checked) fasesCompletadas.push(3);
            if (document.getElementById('faseCompletada4').checked) fasesCompletadas.push(4);

            // Validar que hay tareas seleccionadas
            if (selectedTasks.size === 0) {
                alert('⚠️ Debes seleccionar al menos una tarea en el Paso 1 antes de generar un plan');
                // Scroll to task selection
                document.querySelector('#taskSelector').scrollIntoView({ behavior: 'smooth' });
                return;
            }

            // Validar que hay al menos algún paquete
            const totalInicial = horasSEOIniciales + horasDevIniciales + horasMarketingIniciales;
            const totalMensual = horasSEOMensual + horasDevMensual + horasMarketingMensual;

            if (totalInicial === 0 && totalMensual === 0) {
                alert('⚠️ Debes configurar al menos un paquete (inicial o mensual) para generar un plan');
                return;
            }

            // Filtrar solo las tareas SELECCIONADAS en el Paso 1
            let tareasFiltradas = tareas.filter(t => selectedTasks.has(t.id));

            // Filtrar tareas de fases completadas
            tareasFiltradas = tareasFiltradas.filter(t => {
                return !fasesCompletadas.includes(t.fase_origen);
            });

            // Ordenar según priorización
            // SIEMPRE ordenar por prioridad primero para asegurar que tareas críticas se asignen antes
            const prioridadOrden = { critical: 0, high: 1, medium: 2, low: 3 };

            if (priorizar === 'quick_wins') {
                // Quick wins: ordenar por horas DENTRO de cada nivel de prioridad
                tareasFiltradas.sort((a, b) => {
                    const diffPrioridad = prioridadOrden[a.prioridad] - prioridadOrden[b.prioridad];
                    if (diffPrioridad !== 0) return diffPrioridad;
                    return a.horas_estimadas - b.horas_estimadas;
                });
            } else {
                // Por defecto: ordenar solo por prioridad
                tareasFiltradas.sort((a, b) => prioridadOrden[a.prioridad] - prioridadOrden[b.prioridad]);
            }

            // Configuración del plan
            const configPlan = {
                horasSEOIniciales,
                horasDevIniciales,
                horasMarketingIniciales,
                horasSEOMensual,
                horasDevMensual,
                horasMarketingMensual,
                numMeses,
                fasesCompletadas
            };

            // Generar plan mensual con paquetes iniciales y mensuales
            const planMensual = generarPlanMensualConPaquetes(tareasFiltradas, configPlan);

            // Guardar plan actual para comparaciones
            planActualGenerado = {
                plan: planMensual,
                config: configPlan
            };

            // Mostrar resultado
            mostrarPlan(planMensual, configPlan);

            // Si hay un escenario guardado, esto es el Escenario B: mostrar comparación
            if (escenarioGuardado) {
                const escenarioB = {
                    plan: planMensual,
                    config: configPlan
                };
                mostrarComparacion(escenarioGuardado, escenarioB);

                // Resetear para permitir nuevas comparaciones
                escenarioGuardado = null;
                planActualGenerado = null;
                document.getElementById('btnComparar').textContent = '⚖️ Comparar con Otro Escenario';
            } else {
                // Mostrar botón de comparar si aún no hay un escenario guardado
                document.getElementById('btnComparar').style.display = 'block';
            }
        });

        // Botón comparar escenarios
        let planActualGenerado = null; // Variable para guardar el último plan generado

        document.getElementById('btnComparar').addEventListener('click', function() {
            if (!escenarioGuardado && planActualGenerado) {
                // Guardar el escenario actual
                escenarioGuardado = {
                    plan: planActualGenerado.plan,
                    config: planActualGenerado.config
                };

                // Resetear formulario para crear escenario B
                document.getElementById('horasSEOIniciales').value = '';
                document.getElementById('horasDevIniciales').value = '';
                document.getElementById('horasMarketingIniciales').value = '';
                document.getElementById('horasSEOMensual').value = '0';
                document.getElementById('horasDevMensual').value = '0';
                document.getElementById('horasMarketingMensual').value = '0';
                document.getElementById('numMeses').value = '6';

                this.textContent = '⚡ Generar Escenario B y Comparar';

                // Scroll al formulario
                document.getElementById('planForm').scrollIntoView({ behavior: 'smooth' });

                alert('✅ Escenario A guardado.\n\nAhora configura el Escenario B con diferentes paquetes de horas y haz clic en "Generar Plan" para ver la comparación.');
            }
        });

        function generarPlanMensualConPaquetes(tareas, config) {
            const plan = [];
            const tareasCompletadas = new Set();
            const tareasEnProgreso = {};

            // Tracking de horas restantes
            let horasSEOInicialesRestantes = config.horasSEOIniciales;
            let horasDevInicialesRestantes = config.horasDevIniciales;
            let horasMarketingInicialesRestantes = config.horasMarketingIniciales;

            for (let mes = 1; mes <= config.numMeses; mes++) {
                // Calcular horas disponibles para este mes
                let horasSEODisponibles = horasSEOInicialesRestantes + config.horasSEOMensual;
                let horasDevDisponibles = horasDevInicialesRestantes + config.horasDevMensual;
                let horasMarketingDisponibles = horasMarketingInicialesRestantes + config.horasMarketingMensual;

                const tareasMes = [];
                const horasInicioMes = {
                    seo: horasSEODisponibles,
                    dev: horasDevDisponibles,
                    marketing: horasMarketingDisponibles
                };

                for (const tarea of tareas) {
                    if (tareasCompletadas.has(tarea.id)) continue;

                    // Verificar dependencias
                    const dependenciasCumplidas = tarea.dependencias.every(dep => {
                        return tareasCompletadas.has(dep) || !tareas.find(t => t.id === dep);
                    });
                    if (!dependenciasCumplidas) continue;

                    // Determinar tipo de tarea
                    const esSEO = tarea.tipo_paquete.includes('seo');
                    const esDev = tarea.tipo_paquete.includes('dev_design');
                    const esMarketing = tarea.tipo_paquete.includes('marketing_contenidos');

                    // Calcular horas disponibles según tipo de tarea
                    let horasDisponibles = 0;
                    let tipoHorasUsadas = '';

                    // Determinar qué tipo de horas usar
                    const tiposDisponibles = [];
                    if (esSEO) tiposDisponibles.push({ tipo: 'seo', horas: horasSEODisponibles });
                    if (esDev) tiposDisponibles.push({ tipo: 'dev', horas: horasDevDisponibles });
                    if (esMarketing) tiposDisponibles.push({ tipo: 'marketing', horas: horasMarketingDisponibles });

                    // Si no tiene tipos, es una tarea inválida
                    if (tiposDisponibles.length === 0) continue;

                    // Si es mixta, usar el tipo con más horas disponibles
                    if (tiposDisponibles.length > 1) {
                        const tipoMax = tiposDisponibles.reduce((max, t) => t.horas > max.horas ? t : max);
                        horasDisponibles = tipoMax.horas;
                        tipoHorasUsadas = tipoMax.tipo;
                    } else {
                        // Solo un tipo, usar ese
                        horasDisponibles = tiposDisponibles[0].horas;
                        tipoHorasUsadas = tiposDisponibles[0].tipo;
                    }

                    if (horasDisponibles === 0) continue;

                    // Calcular horas pendientes
                    const horasPendientes = tareasEnProgreso[tarea.id]
                        ? tareasEnProgreso[tarea.id].horasRestantes
                        : tarea.horas_estimadas;

                    // Si la tarea cabe completa
                    if (horasPendientes <= horasDisponibles) {
                        const tareaCompleta = {
                            ...tarea,
                            horasAsignadas: horasPendientes,
                            tipoHorasUsadas: tipoHorasUsadas,
                            esFragmento: tareasEnProgreso[tarea.id] ? true : false,
                            mensajeContinuacion: tareasEnProgreso[tarea.id] ? `(Continuación - ${horasPendientes}h restantes)` : null
                        };
                        tareasMes.push(tareaCompleta);

                        // Restar horas según el tipo usado
                        if (tipoHorasUsadas === 'seo') {
                            horasSEODisponibles -= horasPendientes;
                        } else if (tipoHorasUsadas === 'dev') {
                            horasDevDisponibles -= horasPendientes;
                        } else if (tipoHorasUsadas === 'marketing') {
                            horasMarketingDisponibles -= horasPendientes;
                        }

                        tareasCompletadas.add(tarea.id);
                        delete tareasEnProgreso[tarea.id];
                    }
                    // Si es crítica/alta y no cabe, dividirla
                    else if ((tarea.prioridad === 'critical' || tarea.prioridad === 'high') && horasDisponibles > 0) {
                        const tareaFragmento = {
                            ...tarea,
                            horasAsignadas: horasDisponibles,
                            tipoHorasUsadas: tipoHorasUsadas,
                            esFragmento: true,
                            mensajeContinuacion: `(Parte ${tareasEnProgreso[tarea.id] ? tareasEnProgreso[tarea.id].fragmento + 1 : 1} - ${horasDisponibles}h de ${horasPendientes}h)`
                        };
                        tareasMes.push(tareaFragmento);

                        tareasEnProgreso[tarea.id] = {
                            horasRestantes: horasPendientes - horasDisponibles,
                            fragmento: tareasEnProgreso[tarea.id] ? tareasEnProgreso[tarea.id].fragmento + 1 : 1
                        };

                        // Agotar horas del tipo usado
                        if (tipoHorasUsadas === 'seo') {
                            horasSEODisponibles = 0;
                        } else if (tipoHorasUsadas === 'dev') {
                            horasDevDisponibles = 0;
                        } else if (tipoHorasUsadas === 'marketing') {
                            horasMarketingDisponibles = 0;
                        }
                    }
                }

                // Actualizar horas iniciales restantes
                const horasSEOUsadas = horasInicioMes.seo - horasSEODisponibles;
                const horasDevUsadas = horasInicioMes.dev - horasDevDisponibles;
                const horasMarketingUsadas = horasInicioMes.marketing - horasMarketingDisponibles;

                // Restar de iniciales primero
                if (horasSEOInicialesRestantes > 0) {
                    const usadoDeIniciales = Math.min(horasSEOUsadas, horasSEOInicialesRestantes);
                    horasSEOInicialesRestantes -= usadoDeIniciales;
                }

                if (horasDevInicialesRestantes > 0) {
                    const usadoDeIniciales = Math.min(horasDevUsadas, horasDevInicialesRestantes);
                    horasDevInicialesRestantes -= usadoDeIniciales;
                }

                if (horasMarketingInicialesRestantes > 0) {
                    const usadoDeIniciales = Math.min(horasMarketingUsadas, horasMarketingInicialesRestantes);
                    horasMarketingInicialesRestantes -= usadoDeIniciales;
                }

                plan.push({
                    mes: mes,
                    tareas: tareasMes,
                    horasSEOUsadas: horasSEOUsadas,
                    horasDevUsadas: horasDevUsadas,
                    horasMarketingUsadas: horasMarketingUsadas,
                    horasSEODisponibles: horasSEODisponibles,
                    horasDevDisponibles: horasDevDisponibles,
                    horasMarketingDisponibles: horasMarketingDisponibles,
                    horasSEOInicialesRestantes: horasSEOInicialesRestantes,
                    horasDevInicialesRestantes: horasDevInicialesRestantes,
                    horasMarketingInicialesRestantes: horasMarketingInicialesRestantes
                });
            }

            return plan;
        }

        function mostrarPlan(plan, config) {
            const resultDiv = document.getElementById('planResult');

            // Calcular estadísticas completas
            const totalTareas = plan.reduce((sum, m) => sum + m.tareas.length, 0);
            const totalHorasSEO = plan.reduce((sum, m) => sum + (m.horasSEOUsadas || 0), 0);
            const totalHorasDev = plan.reduce((sum, m) => sum + (m.horasDevUsadas || 0), 0);
            const totalHorasMarketing = plan.reduce((sum, m) => sum + (m.horasMarketingUsadas || 0), 0);
            const totalHoras = totalHorasSEO + totalHorasDev + totalHorasMarketing;

            // Calcular totales disponibles
            const totalSEODisponible = config.horasSEOIniciales + (config.horasSEOMensual * config.numMeses);
            const totalDevDisponible = config.horasDevIniciales + (config.horasDevMensual * config.numMeses);
            const totalMarketingDisponible = config.horasMarketingIniciales + (config.horasMarketingMensual * config.numMeses);
            const totalDisponible = totalSEODisponible + totalDevDisponible + totalMarketingDisponible;

            // Calcular horas por prioridad
            const horasPorPrioridad = {critical: 0, high: 0, medium: 0, low: 0};
            const tareasPorPrioridad = {critical: 0, high: 0, medium: 0, low: 0};
            plan.forEach(mes => {
                mes.tareas.forEach(tarea => {
                    const horasReales = tarea.horasAsignadas || tarea.horas_estimadas;
                    horasPorPrioridad[tarea.prioridad] += horasReales;
                    tareasPorPrioridad[tarea.prioridad]++;
                });
            });

            // Calcular SEO vs Dev vs Marketing
            let horasSEO = 0, horasDev = 0, horasMarketing = 0;
            let tareasSEO = 0, tareasDev = 0, tareasMarketing = 0;
            plan.forEach(mes => {
                mes.tareas.forEach(tarea => {
                    const horasReales = tarea.horasAsignadas || tarea.horas_estimadas;
                    if (tarea.tipo_paquete.includes('seo')) {
                        horasSEO += horasReales;
                        tareasSEO++;
                    }
                    if (tarea.tipo_paquete.includes('dev_design')) {
                        horasDev += horasReales;
                        if (!tarea.tipo_paquete.includes('seo')) tareasDev++;
                    }
                    if (tarea.tipo_paquete.includes('marketing_contenidos')) {
                        horasMarketing += horasReales;
                        if (!tarea.tipo_paquete.includes('seo') && !tarea.tipo_paquete.includes('dev_design')) tareasMarketing++;
                    }
                });
            });

            let html = '<div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">';
            html += '<h3 style="color: #1e293b; margin-bottom: 30px;"><i class="fas fa-calendar-check"></i> Plan de Ejecución Generado</h3>';

            // Resumen General con mejor contraste
            html += `<div style="background: #f0f7e6; padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 2px solid #88B04B;">`;
            html += `<h4 style="color: #2d3748; margin-bottom: 15px;">📊 Resumen General</h4>`;
            html += `<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Duración:</strong> ${config.numMeses} meses</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Total de Tareas:</strong> ${totalTareas}</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Total de Horas:</strong> ${totalHoras}h de ${totalDisponible}h disponibles</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Horas SEO:</strong> ${totalHorasSEO}h de ${totalSEODisponible}h</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Horas Dev:</strong> ${totalHorasDev}h de ${totalDevDisponible}h</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Horas Marketing:</strong> ${totalHorasMarketing}h de ${totalMarketingDisponible}h</p>`;
            html += `<p style="color: #1e293b; margin: 0;"><strong>Utilización:</strong> ${Math.round(totalHoras / totalDisponible * 100)}%</p>`;
            html += `</div></div>`;

            // Resumen de Paquetes
            html += `<div style="background: #dbeafe; padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 2px solid #3b82f6;">`;
            html += `<h4 style="color: #2d3748; margin-bottom: 15px;">💼 Configuración de Paquetes</h4>`;
            html += `<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">`;

            // Paquete Inicial
            html += `<div>`;
            html += `<h6 style="color: #1e293b; margin: 0 0 10px 0;">Paquete Inicial (One-time)</h6>`;
            html += `<div style="display: flex; gap: 10px;">`;
            html += `<div style="background: #88B04B; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasSEOIniciales}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">SEO Iniciales</div>`;
            html += `</div>`;
            html += `<div style="background: #2563eb; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasDevIniciales}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">Dev Iniciales</div>`;
            html += `</div>`;
            html += `<div style="background: #9333ea; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasMarketingIniciales}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">Marketing Iniciales</div>`;
            html += `</div>`;
            html += `</div></div>`;

            // Paquete Mensual
            html += `<div>`;
            html += `<h6 style="color: #1e293b; margin: 0 0 10px 0;">Paquete Mensual Recurrente</h6>`;
            html += `<div style="display: flex; gap: 10px;">`;
            html += `<div style="background: #6d8f3c; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasSEOMensual}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">SEO/mes</div>`;
            html += `</div>`;
            html += `<div style="background: #1e40af; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasDevMensual}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">Dev/mes</div>`;
            html += `</div>`;
            html += `<div style="background: #7c3aed; color: white; padding: 10px 12px; border-radius: 6px; flex: 1; text-align: center;">`;
            html += `<div style="font-size: 18px; font-weight: 700;">${config.horasMarketingMensual}h</div>`;
            html += `<div style="font-size: 10px; opacity: 0.9;">Marketing/mes</div>`;
            html += `</div>`;
            html += `</div></div>`;

            html += `</div></div>`;

            // Distribución por Prioridad
            html += `<div style="background: #fff7ed; padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 2px solid #ea580c;">`;
            html += `<h4 style="color: #2d3748; margin-bottom: 15px;">🎯 Distribución por Prioridad</h4>`;
            html += `<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;">`;

            // Critical
            html += `<div style="background: #fee2e2; padding: 15px; border-radius: 8px; text-align: center;">`;
            html += `<div style="font-size: 24px; font-weight: 700; color: #991b1b;">${tareasPorPrioridad.critical}</div>`;
            html += `<div style="font-size: 12px; color: #7f1d1d;">CRÍTICAS</div>`;
            html += `<div style="font-size: 14px; color: #991b1b; margin-top: 5px;">${horasPorPrioridad.critical}h</div>`;
            html += `</div>`;

            // High
            html += `<div style="background: #fed7aa; padding: 15px; border-radius: 8px; text-align: center;">`;
            html += `<div style="font-size: 24px; font-weight: 700; color: #c2410c;">${tareasPorPrioridad.high}</div>`;
            html += `<div style="font-size: 12px; color: #9a3412;">ALTA</div>`;
            html += `<div style="font-size: 14px; color: #c2410c; margin-top: 5px;">${horasPorPrioridad.high}h</div>`;
            html += `</div>`;

            // Medium
            html += `<div style="background: #dbeafe; padding: 15px; border-radius: 8px; text-align: center;">`;
            html += `<div style="font-size: 24px; font-weight: 700; color: #1e40af;">${tareasPorPrioridad.medium}</div>`;
            html += `<div style="font-size: 12px; color: #1e3a8a;">MEDIA</div>`;
            html += `<div style="font-size: 14px; color: #1e40af; margin-top: 5px;">${horasPorPrioridad.medium}h</div>`;
            html += `</div>`;

            // Low
            html += `<div style="background: #f1f5f9; padding: 15px; border-radius: 8px; text-align: center;">`;
            html += `<div style="font-size: 24px; font-weight: 700; color: #475569;">${tareasPorPrioridad.low}</div>`;
            html += `<div style="font-size: 12px; color: #334155;">BAJA</div>`;
            html += `<div style="font-size: 14px; color: #475569; margin-top: 5px;">${horasPorPrioridad.low}h</div>`;
            html += `</div>`;

            html += `</div></div>`;

            // Distribución SEO vs Dev vs Marketing (siempre mostrar si hay múltiples tipos)
            const tieneSEO = config.horasSEOIniciales > 0 || config.horasSEOMensual > 0;
            const tieneDev = config.horasDevIniciales > 0 || config.horasDevMensual > 0;
            const tieneMarketing = config.horasMarketingIniciales > 0 || config.horasMarketingMensual > 0;
            const tiposActivos = [tieneSEO, tieneDev, tieneMarketing].filter(Boolean).length;

            if (tiposActivos >= 2) {
                html += `<div style="background: #e0e7ff; padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 2px solid #4338ca;">`;
                html += `<h4 style="color: #2d3748; margin-bottom: 15px;">⚙️ Distribución por Tipo</h4>`;
                html += `<div style="display: grid; grid-template-columns: repeat(${tiposActivos}, 1fr); gap: 15px;">`;

                if (tieneSEO) {
                    html += `<div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #88B04B;">`;
                    html += `<div style="font-size: 28px; font-weight: 700; color: #6d8f3c;">${tareasSEO}</div>`;
                    html += `<div style="font-size: 14px; color: #1e293b;">Tareas SEO</div>`;
                    html += `<div style="font-size: 16px; color: #6d8f3c; margin-top: 5px;">${horasSEO}h (${Math.round(horasSEO/totalHoras*100)}%)</div>`;
                    html += `</div>`;
                }

                if (tieneDev) {
                    html += `<div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #2563eb;">`;
                    html += `<div style="font-size: 28px; font-weight: 700; color: #1e40af;">${tareasDev}</div>`;
                    html += `<div style="font-size: 14px; color: #1e293b;">Tareas Dev/Design</div>`;
                    html += `<div style="font-size: 16px; color: #1e40af; margin-top: 5px;">${horasDev}h (${Math.round(horasDev/totalHoras*100)}%)</div>`;
                    html += `</div>`;
                }

                if (tieneMarketing) {
                    html += `<div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #9333ea;">`;
                    html += `<div style="font-size: 28px; font-weight: 700; color: #7c3aed;">${tareasMarketing}</div>`;
                    html += `<div style="font-size: 14px; color: #1e293b;">Tareas Marketing</div>`;
                    html += `<div style="font-size: 16px; color: #7c3aed; margin-top: 5px;">${horasMarketing}h (${Math.round(horasMarketing/totalHoras*100)}%)</div>`;
                    html += `</div>`;
                }

                html += `</div></div>`;
            }

            // Desglose Mensual
            html += `<h4 style="color: #2d3748; margin: 30px 0 20px 0;">📅 Desglose Mensual</h4>`;
            plan.forEach(mes => {
                // Calcular horas totales disponibles para este mes
                const horasSEODisponibles = (mes.horasSEOInicialesRestantes || 0) + config.horasSEOMensual;
                const horasDevDisponibles = (mes.horasDevInicialesRestantes || 0) + config.horasDevMensual;
                const horasMarketingDisponibles = (mes.horasMarketingInicialesRestantes || 0) + config.horasMarketingMensual;
                const horasTotalesDisponibles = horasSEODisponibles + horasDevDisponibles + horasMarketingDisponibles;
                const horasTotalesUsadas = (mes.horasSEOUsadas || 0) + (mes.horasDevUsadas || 0) + (mes.horasMarketingUsadas || 0);

                html += `<div style="background: #f8fafc; border-left: 4px solid #88B04B; padding: 20px; margin-bottom: 20px; border-radius: 8px;">`;
                html += `<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">`;
                html += `<h5 style="color: #1e293b; margin: 0;">Mes ${mes.mes}</h5>`;
                html += `<div style="display: flex; gap: 10px;">`;

                // Badge SEO hours
                if (config.horasSEOIniciales > 0 || config.horasSEOMensual > 0) {
                    html += `<div style="background: #88B04B; color: white; padding: 5px 12px; border-radius: 6px; font-size: 12px;">`;
                    html += `<i class="fas fa-search"></i> ${mes.horasSEOUsadas || 0}h SEO`;
                    html += `</div>`;
                }

                // Badge Dev hours
                if (config.horasDevIniciales > 0 || config.horasDevMensual > 0) {
                    html += `<div style="background: #2563eb; color: white; padding: 5px 12px; border-radius: 6px; font-size: 12px;">`;
                    html += `<i class="fas fa-code"></i> ${mes.horasDevUsadas || 0}h Dev`;
                    html += `</div>`;
                }

                // Badge Marketing hours
                if (config.horasMarketingIniciales > 0 || config.horasMarketingMensual > 0) {
                    html += `<div style="background: #9333ea; color: white; padding: 5px 12px; border-radius: 6px; font-size: 12px;">`;
                    html += `<i class="fas fa-bullhorn"></i> ${mes.horasMarketingUsadas || 0}h Marketing`;
                    html += `</div>`;
                }

                html += `</div></div>`;

                // Información de horas iniciales restantes
                if (mes.horasSEOInicialesRestantes > 0 || mes.horasDevInicialesRestantes > 0 || mes.horasMarketingInicialesRestantes > 0) {
                    html += `<div style="background: #fef3c7; padding: 8px 12px; border-radius: 6px; margin-bottom: 12px; font-size: 12px; color: #78350f;">`;
                    html += `<i class="fas fa-info-circle"></i> Horas iniciales restantes: `;
                    const restos = [];
                    if (mes.horasSEOInicialesRestantes > 0) restos.push(`${mes.horasSEOInicialesRestantes}h SEO`);
                    if (mes.horasDevInicialesRestantes > 0) restos.push(`${mes.horasDevInicialesRestantes}h Dev`);
                    if (mes.horasMarketingInicialesRestantes > 0) restos.push(`${mes.horasMarketingInicialesRestantes}h Marketing`);
                    html += restos.join(' + ');
                    html += `</div>`;
                }

                html += `<p style="color: #64748b; margin-bottom: 15px; font-size: 14px;">${mes.tareas.length} tareas asignadas</p>`;

                mes.tareas.forEach(tarea => {
                    const horasMostradas = tarea.horasAsignadas || tarea.horas_estimadas;
                    const porcentaje = Math.round((horasMostradas / totalHoras) * 100);
                    const prioridadColor = {
                        critical: '#dc2626',
                        high: '#ea580c',
                        medium: '#2563eb',
                        low: '#64748b'
                    }[tarea.prioridad];

                    // Determinar el tipo de horas usadas
                    const esSEO = tarea.tipo_paquete.includes('seo');
                    const esDev = tarea.tipo_paquete.includes('dev_design');
                    const esMarketing = tarea.tipo_paquete.includes('marketing_contenidos');
                    let tipoHorasBadge = '';

                    // Construir badge según combinación de tipos
                    const tipos = [];
                    if (esSEO) tipos.push('SEO');
                    if (esDev) tipos.push('DEV');
                    if (esMarketing) tipos.push('MKT');

                    if (tipos.length > 1) {
                        tipoHorasBadge = `<span style="background: #6366f1; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; margin-left: 8px;">${tipos.join('+')}</span>`;
                    } else if (esSEO) {
                        tipoHorasBadge = `<span style="background: #88B04B; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; margin-left: 8px;">SEO</span>`;
                    } else if (esDev) {
                        tipoHorasBadge = `<span style="background: #2563eb; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; margin-left: 8px;">DEV</span>`;
                    } else if (esMarketing) {
                        tipoHorasBadge = `<span style="background: #9333ea; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; margin-left: 8px;">MKT</span>`;
                    }

                    html += `<div style="background: white; border: 1px solid #e2e8f0; border-left: 3px solid ${prioridadColor}; padding: 15px; border-radius: 8px; margin-bottom: 10px;">`;
                    html += `<div style="display: flex; justify-content: space-between; align-items: start;">`;
                    html += `<div style="flex: 1;">`;
                    html += `<strong style="color: #1e293b;">${tarea.id}</strong> - <span style="color: #1e293b;">${tarea.nombre}</span>`;
                    html += tipoHorasBadge;

                    // Mostrar mensaje de continuación si es un fragmento
                    if (tarea.mensajeContinuacion) {
                        html += ` <span style="color: #ea580c; font-weight: 600; font-size: 12px;">${tarea.mensajeContinuacion}</span>`;
                    }

                    html += `<div style="margin-top: 5px;">`;
                    html += `<span style="background: ${prioridadColor}; color: white; padding: 2px 8px; border-radius: 4px; font-size: 11px; margin-right: 8px;">${tarea.prioridad.toUpperCase()}</span>`;
                    html += `<span style="color: #1e293b; font-size: 13px;">${horasMostradas}h${tarea.esFragmento ? ` de ${tarea.horas_estimadas}h totales` : ''}</span>`;
                    html += `</div></div></div>`;
                    html += `<div style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #f1f5f9; color: #475569; font-size: 13px;">`;
                    html += `${tarea.impacto_esperado}`;
                    html += `</div>`;
                    html += `</div>`;
                });

                html += `</div>`;
            });

            html += '</div>';

            resultDiv.innerHTML = html;
            resultDiv.style.display = 'block';

            // Scroll to result
            resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function mostrarComparacion(escenarioA, escenarioB) {
            const resultDiv = document.getElementById('planResult');

            // Calcular estadísticas de ambos escenarios
            const statsA = calcularEstadisticas(escenarioA.plan, escenarioA.config);
            const statsB = calcularEstadisticas(escenarioB.plan, escenarioB.config);

            let html = '<div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">';
            html += '<h3 style="color: #1e293b; margin-bottom: 30px;"><i class="fas fa-balance-scale"></i> Comparación de Escenarios</h3>';

            // Tabla comparativa
            html += `<div style="background: #f8fafc; border-radius: 12px; padding: 25px; margin-bottom: 30px;">`;
            html += `<table style="width: 100%; border-collapse: collapse;">`;
            html += `<thead>`;
            html += `<tr style="border-bottom: 2px solid #cbd5e1;">`;
            html += `<th style="text-align: left; padding: 15px 10px; color: #64748b; font-weight: 600;">Métrica</th>`;
            html += `<th style="text-align: center; padding: 15px 10px; color: #88B04B; font-weight: 700;">Escenario A</th>`;
            html += `<th style="text-align: center; padding: 15px 10px; color: #2563eb; font-weight: 700;">Escenario B</th>`;
            html += `<th style="text-align: center; padding: 15px 10px; color: #64748b; font-weight: 600;">Diferencia</th>`;
            html += `</tr></thead><tbody>`;

            // Configuración de paquetes
            html += `<tr style="background: #e0f2fe; border-bottom: 1px solid #e2e8f0;">`;
            html += `<td colspan="4" style="padding: 12px 10px; font-weight: 700; color: #1e293b;">📦 Configuración de Paquetes</td>`;
            html += `</tr>`;

            html += crearFilaComparacion('Horas SEO Iniciales',
                `${escenarioA.config.horasSEOIniciales}h`,
                `${escenarioB.config.horasSEOIniciales}h`,
                escenarioB.config.horasSEOIniciales - escenarioA.config.horasSEOIniciales, 'h');

            html += crearFilaComparacion('Horas Dev Iniciales',
                `${escenarioA.config.horasDevIniciales}h`,
                `${escenarioB.config.horasDevIniciales}h`,
                escenarioB.config.horasDevIniciales - escenarioA.config.horasDevIniciales, 'h');

            html += crearFilaComparacion('Horas SEO/mes',
                `${escenarioA.config.horasSEOMensual}h`,
                `${escenarioB.config.horasSEOMensual}h`,
                escenarioB.config.horasSEOMensual - escenarioA.config.horasSEOMensual, 'h');

            html += crearFilaComparacion('Horas Dev/mes',
                `${escenarioA.config.horasDevMensual}h`,
                `${escenarioB.config.horasDevMensual}h`,
                escenarioB.config.horasDevMensual - escenarioA.config.horasDevMensual, 'h');

            // Resultados
            html += `<tr style="background: #fef3c7; border-bottom: 1px solid #e2e8f0;">`;
            html += `<td colspan="4" style="padding: 12px 10px; font-weight: 700; color: #1e293b;">📊 Resultados del Plan</td>`;
            html += `</tr>`;

            html += crearFilaComparacion('Duración',
                `${escenarioA.config.numMeses} meses`,
                `${escenarioB.config.numMeses} meses`,
                escenarioB.config.numMeses - escenarioA.config.numMeses, ' meses');

            html += crearFilaComparacion('Total de Tareas',
                statsA.totalTareas,
                statsB.totalTareas,
                statsB.totalTareas - statsA.totalTareas, ' tareas');

            html += crearFilaComparacion('Total Horas Usadas',
                `${statsA.totalHoras}h`,
                `${statsB.totalHoras}h`,
                statsB.totalHoras - statsA.totalHoras, 'h');

            html += crearFilaComparacion('Horas SEO Usadas',
                `${statsA.totalHorasSEO}h`,
                `${statsB.totalHorasSEO}h`,
                statsB.totalHorasSEO - statsA.totalHorasSEO, 'h');

            html += crearFilaComparacion('Horas Dev Usadas',
                `${statsA.totalHorasDev}h`,
                `${statsB.totalHorasDev}h`,
                statsB.totalHorasDev - statsA.totalHorasDev, 'h');

            html += crearFilaComparacion('Horas Marketing Usadas',
                `${statsA.totalHorasMarketing}h`,
                `${statsB.totalHorasMarketing}h`,
                statsB.totalHorasMarketing - statsA.totalHorasMarketing, 'h');

            html += crearFilaComparacion('% Utilización',
                `${statsA.porcentajeUso}%`,
                `${statsB.porcentajeUso}%`,
                statsB.porcentajeUso - statsA.porcentajeUso, '%');

            // Distribución por prioridad
            html += `<tr style="background: #fee2e2; border-bottom: 1px solid #e2e8f0;">`;
            html += `<td colspan="4" style="padding: 12px 10px; font-weight: 700; color: #1e293b;">🎯 Tareas por Prioridad</td>`;
            html += `</tr>`;

            html += crearFilaComparacion('Tareas Críticas',
                statsA.tareasPorPrioridad.critical,
                statsB.tareasPorPrioridad.critical,
                statsB.tareasPorPrioridad.critical - statsA.tareasPorPrioridad.critical, ' tareas');

            html += crearFilaComparacion('Tareas Alta Prioridad',
                statsA.tareasPorPrioridad.high,
                statsB.tareasPorPrioridad.high,
                statsB.tareasPorPrioridad.high - statsA.tareasPorPrioridad.high, ' tareas');

            html += `</tbody></table></div>`;

            // Recomendación
            html += `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 12px; margin-top: 20px;">`;
            html += `<h4 style="margin: 0 0 15px 0;"><i class="fas fa-lightbulb"></i> Recomendación</h4>`;

            if (statsA.totalTareas > statsB.totalTareas && statsA.porcentajeUso >= statsB.porcentajeUso) {
                html += `<p style="margin: 0; line-height: 1.6;"><strong>Escenario A</strong> es más eficiente: completa ${statsA.totalTareas - statsB.totalTareas} tareas adicionales con similar o mejor utilización de recursos (${statsA.porcentajeUso}% vs ${statsB.porcentajeUso}%).</p>`;
            } else if (statsB.totalTareas > statsA.totalTareas && statsB.porcentajeUso >= statsA.porcentajeUso) {
                html += `<p style="margin: 0; line-height: 1.6;"><strong>Escenario B</strong> es más eficiente: completa ${statsB.totalTareas - statsA.totalTareas} tareas adicionales con similar o mejor utilización de recursos (${statsB.porcentajeUso}% vs ${statsA.porcentajeUso}%).</p>`;
            } else if (escenarioA.config.numMeses < escenarioB.config.numMeses && Math.abs(statsA.totalTareas - statsB.totalTareas) <= 2) {
                html += `<p style="margin: 0; line-height: 1.6;"><strong>Escenario A</strong> permite completar tareas similares en ${escenarioA.config.numMeses - escenarioB.config.numMeses} meses menos, ideal si buscas resultados rápidos.</p>`;
            } else {
                html += `<p style="margin: 0; line-height: 1.6;">Ambos escenarios tienen ventajas. Considera <strong>Escenario A</strong> para inversión inicial mayor y resultados rápidos, o <strong>Escenario B</strong> para distribución más sostenible en el tiempo.</p>`;
            }

            html += `</div>`;

            html += '</div>';

            resultDiv.innerHTML = html;
            resultDiv.style.display = 'block';
            resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function calcularEstadisticas(plan, config) {
            const totalTareas = plan.reduce((sum, m) => sum + m.tareas.length, 0);
            const totalHorasSEO = plan.reduce((sum, m) => sum + (m.horasSEOUsadas || 0), 0);
            const totalHorasDev = plan.reduce((sum, m) => sum + (m.horasDevUsadas || 0), 0);
            const totalHorasMarketing = plan.reduce((sum, m) => sum + (m.horasMarketingUsadas || 0), 0);
            const totalHoras = totalHorasSEO + totalHorasDev + totalHorasMarketing;

            const totalSEODisponible = config.horasSEOIniciales + (config.horasSEOMensual * config.numMeses);
            const totalDevDisponible = config.horasDevIniciales + (config.horasDevMensual * config.numMeses);
            const totalMarketingDisponible = config.horasMarketingIniciales + (config.horasMarketingMensual * config.numMeses);
            const totalDisponible = totalSEODisponible + totalDevDisponible + totalMarketingDisponible;

            const tareasPorPrioridad = {critical: 0, high: 0, medium: 0, low: 0};
            plan.forEach(mes => {
                mes.tareas.forEach(tarea => {
                    tareasPorPrioridad[tarea.prioridad]++;
                });
            });

            return {
                totalTareas,
                totalHorasSEO,
                totalHorasDev,
                totalHorasMarketing,
                totalHoras,
                totalDisponible,
                porcentajeUso: Math.round(totalHoras / totalDisponible * 100),
                tareasPorPrioridad
            };
        }

        function crearFilaComparacion(metrica, valorA, valorB, diferencia, unidad = '') {
            let colorDiferencia = '#64748b';
            let iconoDiferencia = '';
            let textoDiferencia = diferencia === 0 ? 'Igual' : `${diferencia > 0 ? '+' : ''}${diferencia}${unidad}`;

            if (diferencia > 0) {
                colorDiferencia = '#16a34a';
                iconoDiferencia = '<i class="fas fa-arrow-up" style="margin-right: 5px;"></i>';
            } else if (diferencia < 0) {
                colorDiferencia = '#dc2626';
                iconoDiferencia = '<i class="fas fa-arrow-down" style="margin-right: 5px;"></i>';
            }

            let html = `<tr style="border-bottom: 1px solid #e2e8f0;">`;
            html += `<td style="padding: 12px 10px; color: #475569;">${metrica}</td>`;
            html += `<td style="text-align: center; padding: 12px 10px; color: #1e293b; font-weight: 600;">${valorA}</td>`;
            html += `<td style="text-align: center; padding: 12px 10px; color: #1e293b; font-weight: 600;">${valorB}</td>`;
            html += `<td style="text-align: center; padding: 12px 10px; color: ${colorDiferencia}; font-weight: 600;">${iconoDiferencia}${textoDiferencia}</td>`;
            html += `</tr>`;

            return html;
        }
    </script>
</body>
</html>