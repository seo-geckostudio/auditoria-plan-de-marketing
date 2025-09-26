**Quiero que actúes como un consultor SEO experto y me ayudes a generar un plan completo para ejecutar una auditoría SEO técnica y de contenidos de forma profesional.**  
 Este plan no debe contener los resultados de la auditoría, sino **una guía estructurada de pasos a seguir**, documentación a generar, herramientas a utilizar y los tipos de datos necesarios para llevarla a cabo.

### **🔧 Herramientas que deben formar parte del proceso:**

* Google Search Console

* Google Analytics 4 (GA4)

* Ahrefs

* Screaming Frog SEO Spider

### **🧩 La guía debe estar organizada en bloques que correspondan a las siguientes etapas:**

---

#### **🔹 0\. Contexto Estratégico Marketing Digital (Opcional)**

**🎯 0.1 Análisis de mercado SEO-orientado**
* **Documento**: `00_analisis_mercado_completo.md`
* **Modalidades**: Express (solo SEO) / Estándar (SEO + contexto) / Premium (análisis completo)
* **Contenido SEO esencial**:
  - Estacionalidad de búsquedas (Google Trends)
  - Volúmenes de búsqueda por sector
  - Comportamiento geográfico y mobile vs desktop
  - Patrones temporales de búsqueda
* **Contenido marketing adicional** (Estándar/Premium):
  - Tamaño de mercado y crecimiento
  - Canales de adquisición predominantes
  - Tendencias de consumo digital

**🏆 0.2 Competencia 360° SEO-focused**
* **Documento**: `01_competencia_360.md`
* **Contenido SEO esencial**:
  - Dominios de autoridad principales
  - Keywords gaps identificados
  - Nivel de competencia SEO por categorías
  - Oportunidades de contenido sin explotar
* **Contenido marketing adicional** (Estándar/Premium):
  - Estrategias redes sociales competencia
  - Canales publicitarios utilizados
  - Posicionamiento de marca y messaging

**👥 0.3 Buyer personas completas**
* **Documento**: `02_buyer_personas_completas.md`
* **Contenido SEO esencial**:
  - Intención de búsqueda por persona
  - Lenguaje utilizado en búsquedas
  - Customer journey de búsquedas
  - Preguntas frecuentes que buscan
* **Contenido marketing adicional** (Estándar/Premium):
  - Demografía detallada y comportamiento social
  - Canales de comunicación preferidos
  - Triggers de compra y objeciones

**📝 0.4 Estrategia de contenidos SEO**
* **Documento**: `03_estrategia_contenidos.md`
* **Contenido SEO esencial**:
  - Content gaps por intención de búsqueda
  - Temas prioritarios para SEO
  - Estructura de contenido por buyer persona
* **Contenido marketing adicional** (Estándar/Premium):
  - Contenido para otros canales
  - Calendario editorial sugerido
  - Estrategia multimedia

**🌐 0.5 Panorama canales digitales** (Solo Estándar/Premium)
* **Documento**: `04_canales_digitales_panorama.md`
* **Contenido**:
  - Análisis de oportunidades por canal
  - Recomendaciones integración SEO + otros canales
  - ROI estimado por canal

**📋 0.6 Plan marketing digital ejecutivo** (Solo Premium)
* **Documento**: `05_plan_marketing_digital_ejecutivo.md`
* **Entregable cliente**:
  - Resumen ejecutivo de oportunidades
  - Roadmap de marketing digital completo
  - Presupuestos y ROI proyectado

---

#### **🔹 1\. Preparación Inicial**

**📋 1.1 Checklist de accesos necesarios**
* **Documento**: `00_checklist_accesos.xlsx`
* **Contenido**:
  - Google Search Console (propietario/editor)
  - Google Analytics 4 (editor)
  - Ahrefs (acceso cuenta cliente o propia)
  - Acceso CMS/Backend (si aplica)
  - Credenciales FTP/hosting (si aplica)
  - Contactos técnicos del cliente

**📝 1.2 Brief inicial del cliente**
* **Documento**: `01_brief_cliente.docx`
* **Información a recopilar**:
  - Modelo de negocio y objetivos
  - Público objetivo principal
  - Competencia directa identificada
  - KPIs actuales y metas
  - Historial SEO previo
  - URLs prioritarias del negocio
  - Presupuesto y timeline

**🗺️ 1.3 Roadmap de auditoría**
* **Documento**: `02_roadmap_auditoria.xlsx`
* **Contenido**:
  - Cronograma por fases (fechas)
  - Responsables por tarea
  - Hitos de entrega
  - Dependencias entre tareas
  - Puntos de revisión con cliente

#### **🔹 2\. Keyword Research**

**🔍 2.1 Análisis de keywords actuales**
* **Herramientas**: GSC + Ahrefs
* **Exportaciones GSC**:
  - Consultas (12 meses, >10 impresiones) → CSV
  - Páginas con mejor rendimiento → CSV
* **Exportaciones Ahrefs**:
  - Organic Keywords → CSV
  - Keywords Explorer (dominio) → CSV
* **Documento**: `03_keywords_actuales.xlsx` (posiciones, volúmenes, CTR)

**🎯 2.2 Investigación competencia**
* **Herramienta**: Ahrefs
* **Exportaciones Ahrefs**:
  - Top Competing Pages → CSV (por cada competidor)
  - Keywords Gap → CSV (vs 3 competidores principales)
  - Content Gap → CSV
* **Documento**: `04_analisis_competencia.xlsx` (oportunidades keywords)

**📊 2.3 Research nuevas oportunidades**
* **Herramienta**: Ahrefs Keywords Explorer
* **Exportaciones Ahrefs**:
  - Keywords by intent (informational, commercial, etc.) → CSV
  - Related keywords → CSV
  - Questions → CSV
* **Documento**: `05_oportunidades_keywords.xlsx` (categorizado por intención de búsqueda)

**📋 2.4 Keyword mapping final**
* **Documento**: `06_keyword_mapping.xlsx`
* **Contenido**:
  - Keywords por página/sección
  - Prioridad y dificultad
  - Volumen de búsqueda mensual
  - Intención de búsqueda
  - URLs target actuales vs recomendadas

#### **🔹 3\. Arquitectura del Sitio**

**🏗️ 3.1 Análisis arquitectura actual**
* **Herramientas**: Screaming Frog + análisis visual
* **Exportaciones SF**:
  - Internal tab → All (filtrar por profundidad 1-5) → CSV
  - Crawl Tree Graph → Export visual
* **Análisis manual**:
  - Screenshots estructura de menús
  - Mapeo visual navegación principal
* **Documento**: `07_arquitectura_actual.xlsx` + `arquitectura_visual.pdf`

**🗺️ 3.2 Mapping keywords a arquitectura**
* **Herramientas**: Datos de keyword research + SF
* **Proceso**:
  - Crucear keywords con URLs actuales
  - Identificar páginas huérfanas sin keywords
  - Detectar cannibalizaciones por arquitectura
* **Documento**: `08_mapping_keywords_arquitectura.xlsx`

**🎯 3.3 Propuesta nueva arquitectura**
* **Documento**: `09_propuesta_arquitectura.xlsx` + `nueva_arquitectura_visual.pdf`
* **Contenido**:
  - Árbol de navegación optimizado
  - URLs recomendadas vs actuales
  - Redistribución de keywords
  - Plan de redirects necesarios

**📈 3.4 Setup tracking posiciones**
* **Herramientas**: Ahrefs + herramienta rank tracking
* **Configuración**:
  - Lista final keywords a trackear (top 100-200)
  - Configuración localización y device
  - Frecuencia de seguimiento
  - Competidores a monitorear
* **Documento**: `10_configuracion_tracking.xlsx` (setup + baseline)

#### **🔹 4\. Recopilación de Datos para Auditoría Técnica y de Contenidos**

**Cada punto incluye: herramienta, exportación específica y documento a generar**

---

**📊 4.1 Situación actual y rendimiento SEO general**
* **Herramientas**: Google Search Console + Ahrefs
* **Exportaciones GSC**:
  - Rendimiento (últimos 12 meses) → CSV
  - Cobertura de índice → CSV
  - Mejoras (Core Web Vitals, Usabilidad móvil) → CSV
* **Exportaciones Ahrefs**:
  - Site Overview → PDF
  - Organic Traffic → CSV
  - Top Pages → CSV (tráfico orgánico)
* **Documento**: `01_situacion_general_seo.xlsx` (dashboard resumen con gráficos)

**📈 4.2 Posicionamiento orgánico**
* **Herramientas**: GSC + Ahrefs
* **Exportaciones GSC**:
  - Consultas (12 meses, filtrar >10 impresiones) → CSV
  - Páginas con rendimiento → CSV
* **Exportaciones Ahrefs**:
  - Keywords Explorer (marca + competencia) → CSV
  - Ranking Keywords → CSV
* **Documento**: `02_posicionamiento_organico.xlsx` (análisis keywords + competencia)

**🏷️ 4.3 SEO On Page**
* **Herramienta**: Screaming Frog SEO Spider
* **Configuración SF**: Crawl completo del sitio, activar todos los filtros
* **Exportaciones SF**:
  - Internal tab → All → CSV
  - Page Titles → CSV
  - Meta Description → CSV
  - H1/H2 tab → CSV
  - Images tab → CSV (Missing Alt Text, Over 100kb)
* **Documento**: `03_seo_onpage_analisis.xlsx` (títulos, metas, headings por página)

**🧭 4.4 Menú y navegación**
* **Herramientas**: Análisis visual + Screaming Frog
* **Exportaciones SF**:
  - Internal tab → All (filtrar por profundidad) → CSV
  - Response Codes → CSV (404s, redirects)
* **Análisis manual**: Captura de pantalla de menús principales
* **Documento**: `04_navegacion_arquitectura.docx` (análisis visual + datos SF)

**🔗 4.5 Enlazado interno**
* **Herramientas**: Screaming Frog + Ahrefs
* **Exportaciones SF**:
  - Internal tab → All → CSV
  - Inlinks tab → CSV (enlaces internos por página)
* **Exportaciones Ahrefs**:
  - Best by links → CSV (páginas con más autoridad interna)
* **Documento**: `05_enlazado_interno.xlsx` (mapa de enlaces + páginas huérfanas)

**📋 4.6 Análisis de contenido**
* **Herramientas**: Screaming Frog + GSC
* **Exportaciones SF**:
  - Internal tab → Duplicate Titles/Meta Descriptions → CSV
  - Content → Near Duplicates → CSV
  - Word Count → CSV
* **Exportaciones GSC**:
  - Páginas indexadas vs no indexadas → CSV
* **Documento**: `06_analisis_contenido.xlsx` (duplicados, contenido pobre, canibalizaciones)

**🏷️ 4.7 Meta Tags y optimización**
* **Herramienta**: Screaming Frog
* **Exportaciones SF**:
  - Page Titles (Missing, Duplicate, Over/Under length) → CSV
  - Meta Description (Missing, Duplicate, Over/Under length) → CSV
  - H1 (Missing, Duplicate, Multiple) → CSV
* **Documento**: `07_meta_tags_optimizacion.xlsx` (análisis longitudes + duplicados)

**📷 4.8 Optimización de imágenes**
* **Herramienta**: Screaming Frog
* **Exportaciones SF**:
  - Images → Missing Alt Text → CSV
  - Images → Over 100kb → CSV
  - Images → All → CSV (para análisis general)
* **Documento**: `08_optimizacion_imagenes.xlsx` (peso, alt tags, formatos)

**📰 4.9 Blog y contenido**
* **Herramientas**: GSC + Ahrefs + SF
* **Exportaciones GSC**:
  - Rendimiento filtrado por carpeta /blog/ → CSV
* **Exportaciones Ahrefs**:
  - Content Gap (vs competencia) → CSV
* **Exportaciones SF**:
  - Crawl filtrado por /blog/ → CSV
* **Documento**: `09_blog_contenido_analisis.xlsx` (frecuencia, rendimiento, oportunidades)

**⭐ 4.10 Rich Snippets y datos estructurados**
* **Herramientas**: Screaming Frog + Rich Results Test + Schema Validator
* **Exportaciones SF**:
  - Structured Data tab → All → CSV
  - Schema validation errors → CSV
* **Validación manual**: Screenshots de Rich Results Test
* **Documento**: `10_datos_estructurados.docx` (implementación actual + oportunidades)

**🌍 4.11 Multidioma y hreflang**
* **Herramienta**: Screaming Frog
* **Exportaciones SF**:
  - Hreflang tab → All → CSV
  - Hreflang errors → CSV
* **Documento**: `11_hreflang_multidioma.xlsx` (implementación + errores)

**👥 4.12 Evaluación EEAT**
* **Herramientas**: Análisis manual + SF para estructura
* **Análisis manual**:
  - Screenshots páginas About, Contact, Authors
  - Análisis de biografías autores
  - Evaluación expertise por sección
* **Exportaciones SF**:
  - Crawl de páginas clave (about, contact, authors) → CSV
* **Documento**: `12_evaluacion_eeat.docx` (análisis cualitativo + recomendaciones)

**❌ 4.13 Errores técnicos**
* **Herramienta**: Screaming Frog + GSC
* **Exportaciones SF**:
  - Response Codes → 4XX Client Error → CSV
  - Response Codes → 5XX Server Error → CSV
  - Response Codes → 3XX Redirection → CSV
* **Exportaciones GSC**:
  - Coverage → Error pages → CSV
* **Documento**: `13_errores_tecnicos.xlsx` (listado + priorización)

**📱 4.14 Mobile y Core Web Vitals**
* **Herramientas**: GSC + PageSpeed Insights + Screaming Frog
* **Exportaciones GSC**:
  - Core Web Vitals → CSV
  - Mobile Usability → CSV
* **Análisis PageSpeed**: Top 10 páginas importantes → Screenshots
* **Exportaciones SF**:
  - Page Speed (configurar mobile) → CSV
* **Documento**: `14_mobile_core_web_vitals.xlsx` (métricas + optimizaciones)

**⚡ 4.15 Rendimiento WPO**
* **Herramientas**: Screaming Frog + Lighthouse + GTMetrix
* **Exportaciones SF**:
  - Page Speed tab → All → CSV
  - Response Time → CSV
* **Análisis Lighthouse**: Top páginas → JSON exports
* **Documento**: `15_rendimiento_wpo.xlsx` (métricas + plan optimización)

**🔗 4.16 Perfil de enlaces**
* **Herramienta**: Ahrefs
* **Exportaciones Ahrefs**:
  - Backlinks → All → CSV
  - Referring Domains → CSV
  - Anchors → CSV
  - Toxic Backlinks → CSV
* **Documento**: `16_perfil_enlaces.xlsx` (análisis autoridad + toxicidad + anchor text)

**📋 4.17 Aspectos técnicos indexación**
* **Herramientas**: Screaming Frog + GSC + análisis manual
* **Exportaciones SF**:
  - Canonical tab → All → CSV
  - Pagination → CSV
* **Análisis manual**:
  - Robots.txt → Copiar contenido completo
  - XML Sitemaps → Lista URLs + estado
* **Exportaciones GSC**:
  - Sitemaps status → CSV
  - Index Coverage → CSV
* **Documento**: `17_indexacion_aspectos_tecnicos.xlsx` (robots, sitemaps, canonicals)

#### **🔹 5\. Organización del Trabajo y Entregables**

**📊 5.1 Informe Ejecutivo**
* **Documento**: `INFORME_EJECUTIVO_[cliente].pdf`
* **Contenido** (máximo 10 páginas):
  - Resumen ejecutivo (1 página)
  - Situación actual SEO (2 páginas)
  - Principales hallazgos (2 páginas)
  - Recomendaciones prioritarias (3 páginas)
  - ROI estimado y timeline (2 páginas)

**🔧 5.2 Informe Técnico Completo**
* **Documento**: `INFORME_TECNICO_[cliente].pdf`
* **Contenido** (30-50 páginas):
  - Metodología utilizada
  - Todos los análisis detallados (puntos 4.1 a 4.17)
  - Screenshots y evidencias
  - Datos específicos y métricas
  - Recomendaciones técnicas detalladas

**📋 5.3 Plan de Acción Priorizado**
* **Documento**: `PLAN_ACCION_[cliente].xlsx`
* **Contenido**:
  - Lista tareas por prioridad (crítica, alta, media, baja)
  - Esfuerzo estimado (horas)
  - Impacto esperado (alto, medio, bajo)
  - Responsable sugerido (técnico, contenido, UX)
  - Timeline recomendado
  - Dependencias entre tareas

**📈 5.4 Dashboard de seguimiento**
* **Documento**: `DASHBOARD_SEGUIMIENTO_[cliente].xlsx`
* **Contenido**:
  - KPIs baseline vs objetivos
  - Métricas a trackear mensualmente
  - Responsables por métrica
  - Fechas de revisión
  - Semáforo de progreso

**📁 5.5 Carpeta con todos los exports**
* **Estructura**: `DATOS_RAW_[cliente]/`
  - `/GSC_exports/` (todos los CSV de Search Console)
  - `/Ahrefs_exports/` (todos los CSV de Ahrefs)
  - `/ScreamingFrog_exports/` (todos los CSV de SF)
  - `/Screenshots/` (capturas PageSpeed, validadores, etc.)
  - `/Documentos_analisis/` (todos los Excel de análisis)

**✅ 5.6 Checklist final entrega**
* **Documento**: `CHECKLIST_ENTREGA.xlsx`
* **Verificación**:
  - [ ] Todos los documentos generados
  - [ ] Informe ejecutivo revisado
  - [ ] Plan de acción validado
  - [ ] Datos raw organizados
  - [ ] Presentación preparada
  - [ ] Meeting de entrega agendado

**🎯 5.7 Formatos y especificaciones**
* **PDFs**: Máximo 10MB, con índice navegable
* **Excel**: Máximo 5MB por archivo, con pestañas organizadas
* **CSVs**: UTF-8, separados por comas
* **Screenshots**: PNG, máximo 1MB c/u
* **Naming**: Siempre incluir fecha y nombre cliente

