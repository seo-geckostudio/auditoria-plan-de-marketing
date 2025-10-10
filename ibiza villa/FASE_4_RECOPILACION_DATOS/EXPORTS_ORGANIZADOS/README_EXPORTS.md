# EXPORTS ORGANIZADOS - FASE 4 ANÁLISIS TÉCNICO

## 📁 ESTRUCTURA DE CARPETAS

### 🔍 **GOOGLE SEARCH CONSOLE (GSC)**
**Ubicación**: `EXPORTS_GSC/`
**Total archivos requeridos**: 15+ archivos

#### **Rendimiento y Tráfico**
- `gsc_performance_queries_3months.csv` - Top queries últimos 3 meses
- `gsc_performance_pages_3months.csv` - Top páginas últimos 3 meses
- `gsc_performance_countries_3months.csv` - Rendimiento por países
- `gsc_performance_devices_3months.csv` - Rendimiento por dispositivos
- `gsc_clicks_impressions_ctr_position.csv` - Métricas principales

#### **Indexación y Cobertura**
- `gsc_coverage_valid_pages.csv` - Páginas válidas indexadas
- `gsc_coverage_errors.csv` - Errores de indexación
- `gsc_coverage_warnings.csv` - Advertencias de indexación
- `gsc_coverage_excluded.csv` - Páginas excluidas

#### **Experiencia de Usuario**
- `gsc_core_web_vitals_mobile.csv` - Core Web Vitals móvil
- `gsc_core_web_vitals_desktop.csv` - Core Web Vitals escritorio
- `gsc_mobile_usability_issues.csv` - Problemas usabilidad móvil

#### **Enlaces y Sitemaps**
- `gsc_internal_links.csv` - Enlaces internos principales
- `gsc_external_links.csv` - Enlaces externos entrantes
- `gsc_sitemaps_status.csv` - Estado de sitemaps enviados

---

### 🔗 **AHREFS**
**Ubicación**: `EXPORTS_AHREFS/`
**Total archivos requeridos**: 18+ archivos

#### **Keywords y Rankings**
- `ahrefs_organic_keywords_top1000.csv` - Top 1000 keywords orgánicas
- `ahrefs_keyword_rankings_positions.csv` - Posiciones actuales keywords
- `ahrefs_keyword_difficulty_analysis.csv` - Dificultad de keywords
- `ahrefs_serp_features_opportunities.csv` - Oportunidades SERP features
- `ahrefs_competitor_keywords_gaps.csv` - Gap analysis competidores

#### **Backlinks y Autoridad**
- `ahrefs_backlinks_overview.csv` - Resumen perfil de enlaces
- `ahrefs_referring_domains.csv` - Dominios referentes
- `ahrefs_anchor_text_distribution.csv` - Distribución anchor text
- `ahrefs_lost_backlinks_6months.csv` - Enlaces perdidos últimos 6 meses
- `ahrefs_new_backlinks_6months.csv` - Enlaces nuevos últimos 6 meses

#### **Análisis Competitivo**
- `ahrefs_top_competitors.csv` - Principales competidores orgánicos
- `ahrefs_competitor_content_gaps.csv` - Gaps de contenido vs competencia
- `ahrefs_competitor_backlink_opportunities.csv` - Oportunidades de enlaces

#### **Contenido y Páginas**
- `ahrefs_top_pages_organic_traffic.csv` - Páginas con más tráfico orgánico
- `ahrefs_content_decay_analysis.csv` - Análisis declive contenido
- `ahrefs_internal_linking_opportunities.csv` - Oportunidades enlazado interno

#### **Técnico y Crawling**
- `ahrefs_site_audit_overview.csv` - Resumen auditoría técnica
- `ahrefs_broken_links_404s.csv` - Enlaces rotos y 404s

---

### 🕷️ **SCREAMING FROG**
**Ubicación**: `EXPORTS_SCREAMING_FROG/`
**Total archivos requeridos**: 25+ archivos

#### **Crawling General**
- `sf_all_urls_crawled.csv` - Todas las URLs crawleadas
- `sf_response_codes.csv` - Códigos de respuesta HTTP
- `sf_redirect_chains.csv` - Cadenas de redirecciones
- `sf_crawl_depth_analysis.csv` - Análisis profundidad crawling

#### **SEO On-Page**
- `sf_page_titles.csv` - Títulos de páginas
- `sf_meta_descriptions.csv` - Meta descriptions
- `sf_h1_headings.csv` - Encabezados H1
- `sf_h2_h6_headings.csv` - Encabezados H2-H6
- `sf_canonical_urls.csv` - URLs canónicas
- `sf_meta_robots.csv` - Directivas meta robots

#### **Contenido y Estructura**
- `sf_word_count.csv` - Conteo de palabras por página
- `sf_readability_analysis.csv` - Análisis legibilidad contenido
- `sf_duplicate_content.csv` - Contenido duplicado detectado
- `sf_thin_content.csv` - Contenido delgado (< 200 palabras)

#### **Imágenes y Multimedia**
- `sf_images_analysis.csv` - Análisis completo imágenes
- `sf_images_missing_alt.csv` - Imágenes sin alt text
- `sf_images_oversized.csv` - Imágenes sobredimensionadas
- `sf_images_broken.csv` - Imágenes rotas

#### **Enlaces Internos**
- `sf_internal_links_all.csv` - Todos los enlaces internos
- `sf_internal_links_broken.csv` - Enlaces internos rotos
- `sf_anchor_text_internal.csv` - Anchor text enlaces internos

#### **Técnico Avanzado**
- `sf_hreflang_analysis.csv` - Análisis implementación hreflang
- `sf_structured_data.csv` - Datos estructurados detectados
- `sf_page_speed_insights.csv` - Métricas velocidad páginas
- `sf_mobile_rendering.csv` - Análisis renderizado móvil
- `sf_javascript_analysis.csv` - Análisis JavaScript y recursos

---

## 📊 **INSTRUCCIONES DE EXPORTACIÓN**

### **Google Search Console**
1. Acceder a GSC → Rendimiento
2. Configurar período: Últimos 3 meses
3. Exportar por consultas, páginas, países, dispositivos
4. Ir a Cobertura → Exportar válidas, errores, advertencias
5. Experiencia → Core Web Vitals → Exportar móvil y escritorio
6. Enlaces → Exportar internos y externos principales

### **Ahrefs**
1. Site Explorer → Organic Keywords → Exportar top 1000
2. Backlinks → Overview → Exportar resumen completo
3. Competing Domains → Exportar top competidores
4. Site Audit → Exportar issues técnicos
5. Content Gap → Exportar vs 3 competidores principales
6. Top Pages → Exportar por tráfico orgánico

### **Screaming Frog**
1. Configurar crawl: Seguir robots.txt, límite 10,000 URLs
2. Crawl completo del sitio principal
3. Exportar todas las pestañas principales
4. Bulk Export → Seleccionar todos los filtros
5. Configurar crawl móvil separado
6. Exportar análisis JavaScript habilitado

---

## 🎯 **CRITERIOS DE CALIDAD**

### **Completitud de Datos**
- ✅ Mínimo 15 archivos GSC
- ✅ Mínimo 18 archivos Ahrefs  
- ✅ Mínimo 25 archivos Screaming Frog
- ✅ Período consistente: Últimos 3 meses
- ✅ Formato CSV para análisis

### **Validación de Exports**
- ✅ Archivos sin errores de formato
- ✅ Headers correctos en CSV
- ✅ Datos completos sin truncar
- ✅ Fechas en formato consistente
- ✅ URLs completas y válidas

### **Organización**
- ✅ Nomenclatura consistente archivos
- ✅ Carpetas organizadas por herramienta
- ✅ README con instrucciones claras
- ✅ Fecha de exportación documentada
- ✅ Responsable de exportación identificado

---

## 📅 **CRONOGRAMA DE EXPORTACIÓN**

### **Semana 1 - GSC Exports**
- Días 1-2: Configuración y exportación GSC
- Día 3: Validación y organización archivos
- Día 4: Documentación y backup

### **Semana 2 - Ahrefs Exports**  
- Días 1-2: Exportación datos Ahrefs
- Día 3: Análisis competitivo adicional
- Día 4: Validación y organización

### **Semana 3 - Screaming Frog**
- Días 1-2: Crawling completo sitio
- Día 3: Crawling móvil y JavaScript
- Día 4: Exportación y validación final

---

## ⚠️ **CONSIDERACIONES IMPORTANTES**

### **Limitaciones de Herramientas**
- **GSC**: Datos limitados a 1000 filas por export
- **Ahrefs**: Límites según plan de suscripción
- **Screaming Frog**: Versión gratuita limitada a 500 URLs

### **Privacidad y Seguridad**
- No incluir datos sensibles en exports
- Anonimizar información confidencial
- Backup seguro de todos los archivos
- Acceso restringido a datos de cliente

### **Actualización de Datos**
- Exports válidos por 30 días máximo
- Re-exportar si análisis se extiende
- Documentar fecha de cada exportación
- Mantener versiones históricas para comparación

---

*Estructura creada para Fase 4 - Análisis Técnico*  
*Proyecto: Ibiza Villa SEO Audit*  
*Fecha: Enero 2025*