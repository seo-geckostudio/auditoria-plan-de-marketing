# 📋 INSTRUCCIONES PARA LA FASE 3: ARQUITECTURA DEL SITIO

## 🎯 Objetivo de la Fase
Analizar la arquitectura actual del sitio, optimizar la estructura para SEO y crear un mapping estratégico entre keywords y páginas que maximice la autoridad temática y facilite la navegación tanto para usuarios como para bots.

---

## 📊 ORDEN SECUENCIAL RECOMENDADO

### 1️⃣ Análisis Arquitectura Actual (2-3 días)
**Documento:** `07_arquitectura_actual.md`

**PROCESO PASO A PASO:**

#### Crawling completo con Screaming Frog (1-2 horas):
1. **Configuración inicial SF:**
   - Mode: Spider
   - Crawl: HTML + CSS + JS (si es SPA)
   - Max Crawl Depth: 10 (o sin límite si sitio <10k páginas)
   - Follow robots.txt: Sí
   - User-agent: Googlebot

2. **Exportaciones críticas SF:**
   - Internal tab > All → CSV (todas las URLs internas)
   - Internal tab > Level (1-5) → CSV (por profundidad)
   - Page Titles > All → CSV
   - Response Codes > All → CSV
   - Redirects > All → CSV

3. **Generación visual:**
   - Crawl Tree Graph → Export PDF
   - Force Directed Crawl Diagram → Export PNG

#### Análisis manual navegación (2 horas):
1. **Screenshots estructura:**
   - Menú principal (desktop + mobile)
   - Footer navigation
   - Breadcrumbs implementation
   - Sidebar navigation (si aplica)

2. **Mapeo manual rutas principales:**
   - Homepage > Categorías > Subcategorías > Productos
   - Homepage > Blog > Categorías > Artículos
   - Páginas institucionales y su ubicación

3. **Test navegación usuario:**
   - ¿Se puede llegar a cualquier página en <4 clics?
   - ¿La navegación es consistente?
   - ¿Hay dead-ends sin enlaces de retorno?

#### Análisis técnico arquitectura (3-4 horas):
1. **Distribución por profundidad:**
   - Level 1 (homepage): ___ páginas
   - Level 2: ___ páginas
   - Level 3: ___ páginas
   - Level 4+: ___ páginas

2. **Identificación problemas:**
   - Páginas huérfanas (sin enlaces internos)
   - Over-optimization (demasiadas subcategorías)
   - Under-optimization (categorías muy amplias)
   - Inconsistencias en naming conventions

**⚠️ RED FLAGS:**
- >50% contenido en profundidad >3
- Páginas importantes en profundidad >2
- Categorías con <3 páginas de contenido
- URLs sin patrón lógico consistente

---

### 2️⃣ Mapping Keywords a Arquitectura (1-2 días)
**Documento:** `08_mapping_keywords_arquitectura.md`

**PROCESO PASO A PASO:**

#### Cruce datos Fase 2 + arquitectura (2-3 horas):
1. **Input de Fase 2:**
   - Keywords actuales con URLs ranking
   - Oportunidades identificadas
   - Keywords competencia
   - Keyword mapping inicial

2. **Cruce con arquitectura actual:**
   - ¿Qué URLs reciben tráfico orgánico?
   - ¿Qué secciones no tienen keywords asignadas?
   - ¿Hay keywords compitiendo por misma URL?

3. **Identificación gaps arquitectura-keywords:**
   - Keywords comerciales sin landing específica
   - Secciones sin keywords objetivo
   - URLs sin optimización SEO

#### Detección canibalizaciones (1-2 horas):
1. **Tipos canibalización:**
   - Total: Misma keyword, múltiples URLs similares
   - Parcial: Keywords relacionadas compitiendo
   - Arquitectural: Problema estructura (ej: /categoria vs /categoria/)

2. **Priorización resolución:**
   - Critical: Keywords comerciales principales
   - High: Keywords con volumen >1000
   - Medium: Keywords marca o informacionales

#### Content clusters planning (2-3 horas):
1. **Diseño clusters semánticos:**
   - Página pilar (comercial) + contenido soporte (blog)
   - Interconexión estratégica
   - Flujo de autoridad hacia páginas comerciales

2. **Validación feasibility:**
   - ¿Hay recursos para crear contenido?
   - ¿Se alinea con objetivos negocio?
   - ¿Es sostenible a largo plazo?

**💡 BEST PRACTICES:**
- 1 keyword comercial principal por página categoria
- Content clusters con 1 pilar + 3-7 artículos soporte
- Máximo 3 niveles profundidad para contenido comercial
- Breadcrumbs reflejando estructura keywords

---

### 3️⃣ Propuesta Nueva Arquitectura (2-3 días)
**Documento:** `09_propuesta_arquitectura.md`

**PROCESO PASO A PASO:**

#### Diseño nueva estructura (4-6 horas):
1. **Principios de diseño:**
   - Keyword-driven architecture
   - User journey optimization
   - Search engine crawling efficiency
   - Escalabilidad futura

2. **Estructura propuesta:**
   - Homepage (palabras clave principales)
   - Categorías comerciales (keywords transaccionales)
   - Subcategorías (long-tail específicas)
   - Blog clusters (keywords informacionales)

3. **URL strategy:**
   - Estructura URL lógica y SEO-friendly
   - Consistencia naming conventions
   - Evitar parámetros cuando sea posible
   - Implementación breadcrumbs

#### Plan migración/restructuración (2-3 horas):
1. **URLs que cambiarán:**
   - Mapeo 1:1 URLs actuales → nuevas URLs
   - Plan redirects 301 necesarios
   - Actualizaciones enlaces internos
   - Timeline implementación

2. **Páginas nuevas a crear:**
   - Landing pages comerciales faltantes
   - Páginas categoria necesarias
   - Content hubs para clusters
   - Páginas soporte (FAQ, recursos, etc.)

3. **Risk assessment:**
   - Impacto potencial en rankings
   - Recursos development necesarios
   - Timeline realista implementación
   - Plan rollback si surgen problemas

#### Validación técnica propuesta (1 hora):
1. **Feasibility check:**
   - ¿CMS soporta estructura propuesta?
   - ¿Hay limitaciones técnicas?
   - ¿Se requiere desarrollo custom?

2. **Performance impact:**
   - ¿Afectará velocidad sitio?
   - ¿Se mantiene mobile-friendly?
   - ¿Impacto en Core Web Vitals?

**🚨 VALIDACIONES CRÍTICAS:**
- No más de 3-4 clics para páginas importantes
- Cada página comercial tiene keyword principal clara
- Blog clusters enlazados estratégicamente a comerciales
- Plan redirects completo para URLs que cambien

---

### 4️⃣ Setup Tracking Posiciones (1 día)
**Documento:** `10_configuracion_tracking.md`

**PROCESO PASO A PASO:**

#### Selección keywords trackear (2-3 horas):
1. **Criterios selección:**
   - Keywords comerciales principales (prioritad 1)
   - Keywords con volumen >500/mes
   - Keywords competencia nos supera
   - Keywords nueva arquitectura optimizará

2. **Segmentación tracking:**
   - Branded vs Non-branded
   - Comercial vs Informacional
   - Head terms vs Long-tail
   - Desktop vs Mobile (si hay diferencias)

3. **Lista final (50-200 keywords máximo):**
   - Evitar over-tracking (costoso y poco útil)
   - Focus en keywords accionables
   - Include competitors tracking

#### Configuración herramientas (1-2 horas):
1. **Ahrefs Rank Tracker:**
   - Añadir keywords seleccionadas
   - Configurar ubicación target
   - Configurar frecuencia (semanal recomendado)
   - Añadir competidores (3-5 máximo)

2. **Baseline establishment:**
   - Captura posiciones actuales
   - Screenshot rank tracker setup
   - Export initial positions CSV

3. **Alertas y reportes:**
   - Configurar alertas grandes movimientos (+/-10 posiciones)
   - Setup reportes automáticos mensuales
   - Definir responsable revisión

#### Documentation y handoff (1 hora):
1. **Proceso documentación:**
   - Instrucciones acceso rank tracker
   - Explicación métricas importantes
   - Timeline revisiones y acciones

2. **Training stakeholders:**
   - ¿Qué métricas monitorear?
   - ¿Cuándo preocuparse?
   - ¿Cómo interpretar cambios?

**📈 MÉTRICAS CLAVE TRACKING:**
- Position changes (semana a semana)
- Average position por categoría keywords
- Share of voice vs competidores
- Keywords entering/leaving top 10/20

---

## 📊 FLUJO DE DATOS ENTRE DOCUMENTOS

```
Fase 2: Keywords + Mapping
         ↓
07_arquitectura_actual.md
         ↓
(gap analysis arquitectura-keywords)
         ↓
08_mapping_keywords_arquitectura.md
         ↓
(plan optimización estructura)
         ↓
09_propuesta_arquitectura.md
         ↓
(keywords prioritarios tracking)
         ↓
10_configuracion_tracking.md
```

---

## 🛠️ HERRAMIENTAS Y CONFIGURACIONES

### Screaming Frog Settings Recomendadas:
- **Configuration > Spider:**
  - Respect robots.txt: ✓
  - Follow internal nofollow: ✗
  - Crawl outside of start directory: ✗
- **Configuration > Limits:**
  - Max URI Length: 2048
  - Max crawl depth: 10 (ajustar según sitio)
- **Configuration > Speed:**
  - Seconds delay: 0.5 (ser respetuoso)

### Herramientas Complementarias:
- **Ahrefs:** Site audit + Site structure report
- **Sitebulb:** Advanced crawling + visualizations
- **GScreaming Frog Log Analyzer:** Para logs grandes
- **Draw.io/Lucidchart:** Para diagramas arquitectura

### Analytics Setup:
- **GA4:** Enhanced ecommerce + custom events
- **GSC:** Property verification + sitemap submission
- **Hotjar/Clarity:** Heatmaps navegación usuario

---

## ⏱️ TIMELINE DETALLADO RECOMENDADO

### Semana 1:
- **Días 1-2:** Crawling completo + análisis arquitectura actual
- **Días 3-4:** Mapping keywords-arquitectura + detección problemas
- **Día 5:** Review hallazgos + validación cliente

### Semana 2:
- **Días 1-3:** Diseño propuesta nueva arquitectura
- **Días 4-5:** Configuración tracking + documentación

### Checkpoints obligatorios:
- **Día 3:** Validar problems arquitectura con cliente
- **Día 7:** Confirmar feasibility propuesta arquitectura
- **Día 10:** Approval final propuesta antes implementación

---

## ⚠️ SEÑALES DE ALERTA

### Datos insuficientes:
- Sitio demasiado pequeño (<50 páginas)
- CMS limitado que impide cambios arquitectura
- No hay acceso developer/technical team

### Red flags técnicos:
- >80% páginas en profundidad >3
- >50% URLs generan errores 4XX
- No hay consistency en URL patterns
- Site speed <3 segundos average

### Problemas de negocio:
- No hay budget para development
- Cliente no entiende impacto cambios arquitectura
- Timeline muy agresivo (<4 semanas implementación)
- Stakeholders internos no alineados

---

## 📈 MÉTRICAS DE ÉXITO FASE 3

### Outputs mínimos requeridos:
- **Arquitectura actual** completamente mapeada
- **Problemas identificados** con priorización
- **Propuesta específica** con plan implementación
- **50+ keywords tracking** configurado correctamente
- **Plan redirects** detallado si aplica

### Validación calidad:
- **100% páginas importantes** en profundidad ≤3
- **0 canibalizaciones** sin plan resolución
- **Plan implementación realista** validado técnicamente
- **Tracking keywords** alineado con objetivos negocio

---

## 🔄 TRANSICIÓN A FASE 4

### Antes de avanzar verificar:
- [ ] **Propuesta arquitectura aprobada por cliente**
- [ ] **Plan técnico implementación definido**
- [ ] **Tracking keywords configurado y funcionando**
- [ ] **Timeline implementación acordado**

### Outputs para Fase 4:
- Arquitectura optimizada (implementada o en roadmap)
- Keywords tracking baseline establecido
- Lista páginas prioritarias para auditoría técnica
- Content gaps identificados para creación

**⏰ Tiempo estimado Fase 3: 4-6 días según complejidad sitio**

---

## 📚 RECURSOS ADICIONALES

### Lecturas recomendadas:
- Google: Site Structure Guidelines
- Moz: Information Architecture for SEO
- Screaming Frog: Technical SEO Site Audit

### Tools alternativas:
- **DeepCrawl:** Para sitios enterprise grandes
- **Botify:** Análisis avanzado log files
- **OnCrawl:** Visualizaciones arquitectura

### Plantillas útiles:
- Sitemap.xml generator tools
- URL redirect mapping templates
- Information architecture templates

**💡 TIP:** Siempre hacer backup completo antes cambios arquitectura