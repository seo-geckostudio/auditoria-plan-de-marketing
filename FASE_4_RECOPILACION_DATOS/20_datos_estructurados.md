# ⭐ RICH SNIPPETS Y DATOS ESTRUCTURADOS

**Cliente:** _________________________
**Fecha análisis:** ___________________
**URLs analizadas:** __________________
**Herramientas utilizadas:** Screaming Frog + Rich Results Test + Schema Validator
**Analista:** _________________________

---

## 📋 DATOS BASE REQUERIDOS

### Screaming Frog - Structured data:
**Configuración necesaria:**
- [ ] **Crawl completo** sitio
- [ ] **Structured Data tab** activado
- [ ] **Extract Schema.org** habilitado
- [ ] **JSON-LD detection** activado

### Exportaciones Screaming Frog necesarias:
- [ ] **Structured Data > All** → CSV
- [ ] **Structured Data > Schema validation errors** → CSV
- [ ] **Structured Data > Missing structured data** → CSV
- [ ] **Structured Data > JSON-LD** → CSV

### Validación manual complementaria:
- [ ] **Rich Results Test** páginas principales → Screenshots
- [ ] **Schema Markup Validator** → Reports
- [ ] **Google Search Console** enhanced results → CSV
- [ ] **Testing tool** diferentes tipos schema → Reports

---

## 📊 ANÁLISIS GENERAL DATOS ESTRUCTURADOS

### Resumen implementación schema
- **Total páginas con structured data:** _________________
- **Páginas sin structured data:** ______________________ 
- **% cobertura structured data:** _____% del sitio
- **Tipos schema implementados:** _______ tipos diferentes
- **Errores validación detectados:** ____________________
- **Warnings detectados:** _____________________________

### Distribución por tipo schema
| Schema Type | Páginas | % Implementación | Errores | Warnings | Estado |
|-------------|---------|-----------------|---------|----------|--------|
| **Organization** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **WebSite** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **Article** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **Product** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **BreadcrumbList** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **LocalBusiness** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **FAQ** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **Review/Rating** | | % | | | ☐ ✅ ☐ ⚠️ ☐ ❌ |

---

## 🏢 ANALYSIS ORGANIZATION & WEBSITE SCHEMA

### Organization schema implementation
**Página implementación:** ________________________________
- **@type correcto:** ☐ Sí ☐ No
- **name presente:** ☐ Sí ☐ No
- **url presente:** ☐ Sí ☐ No
- **logo presente:** ☐ Sí ☐ No
- **contactPoint presente:** ☐ Sí ☐ No
- **address presente:** ☐ Sí ☐ No
- **sameAs (social media):** ☐ Sí ☐ No

### WebSite schema implementation
**Implementación detectada:** ☐ Sí ☐ No
- **potentialAction (SearchAction):** ☐ Sí ☐ No
- **target search URL:** ☐ Correcto ☐ Incorrecto ☐ Faltante
- **query-input specified:** ☐ Sí ☐ No
- **name website:** ☐ Presente ☐ Faltante
- **url website:** ☐ Correcto ☐ Incorrecto

---

## 📝 ANALYSIS ARTICLE SCHEMA

### Article schema en blog/noticias
- **Artículos con Article schema:** ____________________
- **% cobertura blog:** _______% de artículos
- **Implementación consistente:** ☐ Sí ☐ No ☐ Parcial

### Top 10 artículos Article schema analysis
| Artículo | Article Schema | headline | author | datePublished | image | Errores |
|----------|---------------|----------|--------|---------------|-------|----------|
| 1. | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | |
| 2. | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | |
| 3. | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | |

### Article schema missing properties
| Propiedad Faltante | Páginas Afectadas | Impacto Rich Results | Prioridad Fix |
|-------------------|-------------------|---------------------|----------------|
| **author** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| **dateModified** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| **image** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| **publisher** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |

---

## 🛍️ PRODUCT SCHEMA ANALYSIS

### Product schema implementation
- **Páginas producto con schema:** ______________________
- **% cobertura productos:** _______% de páginas producto
- **Propiedades promedio implementadas:** _____ de 15

### Product schema properties analysis
| Página Producto | name | description | image | price | availability | brand | review | sku | Completeness |
|----------------|------|-------------|-------|-------|-------------|-------|--------|-----|-------------|
| 1. | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | /8 |
| 2. | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | /8 |

### Oportunidades Product Rich Snippets
- **Productos elegibles rich snippets:** ________________
- **Productos actualmente mostrando:** ___________________
- **Gap rich snippets:** _____________ productos
- **Revenue potential:** _____________ EUR/mes estimado

---

## 🗺️ BREADCRUMB SCHEMA ANALYSIS

### BreadcrumbList implementation
- **Páginas con breadcrumb schema:** ___________________
- **Breadcrumbs visuales sin schema:** __________________
- **% cobertura breadcrumb schema:** _______% del sitio
- **Implementación consistente:** ☐ Sí ☐ No ☐ Parcial

### Breadcrumb schema validation
| Tipo Página | Visual Breadcrumb | Schema Present | position | name | item | Status |
|-------------|------------------|----------------|----------|------|------|--------|
| **Categorías** | ☐ Sí ☐ No | ☐ Sí ☐ No | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **Productos** | ☐ Sí ☐ No | ☐ Sí ☐ No | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ⚠️ ☐ ❌ |
| **Blog** | ☐ Sí ☐ No | ☐ Sí ☐ No | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ❌ | ☐ ✅ ☐ ⚠️ ☐ ❌ |

---

## ❓ FAQ SCHEMA OPPORTUNITIES

### FAQ schema implementation
- **Páginas con FAQ schema:** ____________________________
- **Páginas con FAQs sin schema:** ______________________
- **FAQ rich snippets detectados:** ______________________

### FAQ schema opportunities
| Página | FAQ Content Present | Schema Implemented | Questions Count | Rich Snippet Potential | Priority |
|--------|-------------------|------------------|----------------|----------------------|----------|
| 1. | ☐ Sí ☐ No | ☐ Sí ☐ No | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| 2. | ☐ Sí ☐ No | ☐ Sí ☐ No | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| 3. | ☐ Sí ☐ No | ☐ Sí ☐ No | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |

---

## ⭐ REVIEW & RATING SCHEMA

### Review schema analysis
- **Productos con reviews:** ____________________________
- **Review schema implementado:** ________________________
- **Average rating presente:** ☐ Sí ☐ No
- **Individual reviews marcadas:** ☐ Sí ☐ No

### Review rich snippets opportunities
| Producto/Servicio | Reviews Present | Schema Implemented | Stars Potential | CTR Impact | Implementation Priority |
|------------------|----------------|------------------|----------------|------------|------------------------|
| 1. | ☐ Sí ☐ No | ☐ Sí ☐ No | /5 | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |
| 2. | ☐ Sí ☐ No | ☐ Sí ☐ No | /5 | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alta ☐ Media ☐ Baja |

---

## 🏢 LOCAL BUSINESS SCHEMA

### LocalBusiness implementation
**Implementación detectada:** ☐ Sí ☐ No
- **@type específico:** _______________________________
- **address completa:** ☐ Sí ☐ No
- **geo coordinates:** ☐ Sí ☐ No
- **openingHours:** ☐ Sí ☐ No
- **telephone:** ☐ Sí ☐ No
- **priceRange:** ☐ Sí ☐ No

### Local SEO schema opportunities
| Ubicación | Business Type | Schema Present | GMB Integration | Rich Results Potential |
|-----------|--------------|---------------|----------------|----------------------|
| **Sede principal** | | ☐ Sí ☐ No | ☐ Sí ☐ No | ☐ Alto ☐ Medio ☐ Bajo |
| **Otras ubicaciones** | | ☐ Sí ☐ No | ☐ Sí ☐ No | ☐ Alto ☐ Medio ☐ Bajo |

---

## 🔍 ERRORES Y VALIDACIÓN

### Errores críticos structured data
| Error Type | Páginas Afectadas | Schema Type | Error Description | Fix Priority |
|------------|------------------|-------------|------------------|-------------|
| **Missing required property** | | | | ☐ Crítica ☐ Alta ☐ Media |
| **Invalid property value** | | | | ☐ Crítica ☐ Alta ☐ Media |
| **Incorrect @type** | | | | ☐ Crítica ☐ Alta ☐ Media |
| **JSON-LD syntax error** | | | | ☐ Crítica ☐ Alta ☐ Media |

### Rich Results Test failures
| URL | Schema Type | Test Result | Issues Found | Eligible for Rich Results |
|-----|-------------|-------------|-------------|-------------------------|
| 1. | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | ☐ Sí ☐ No ☐ Parcial |
| 2. | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | ☐ Sí ☐ No ☐ Parcial |
| 3. | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | ☐ Sí ☐ No ☐ Parcial |

---

## 🔍 HALLAZGOS CLAVE

### 🟢 Fortalezas structured data identificadas
- ✅ _____________________________________________
- ✅ _____________________________________________
- ✅ _____________________________________________

### 🔴 Problemas críticos detectados
- ❌ _____________________________________________
- ❌ _____________________________________________
- ❌ _____________________________________________

### 🔶 Oportunidades rich snippets
- 🎯 _____________________________________________
- 🎯 _____________________________________________
- 🎯 _____________________________________________

---

## ⚠️ PROBLEMAS CRÍTICOS

### Issues structured data requieren fix inmediato
| Problema | Páginas Afectadas | Impacto Rich Results | Revenue Impact | Prioridad |
|----------|------------------|---------------------|----------------|-----------||
| **Schema errors críticos** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Missing required properties** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Oportunidades FAQ schema** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Product schema incompleto** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |

---

## 🚀 ESTRATEGIA DATOS ESTRUCTURADOS

### Quick Wins (1-2 semanas)
1. **Corregir errores validación críticos:**
   - Schemas: ____________________________________
   - Errors: ____________________________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

2. **Implementar FAQ schema:**
   - Páginas target: _____________________________
   - Questions identificadas: ____________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

3. **Completar Product schema:**
   - Productos: __________________________________
   - Properties missing: _________________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

### Estrategias medio plazo (1-3 meses)
1. **Implementación systematic breadcrumbs:**
2. **Review/Rating schema deployment:**
3. **Local business schema optimization:**

### Plan largo plazo (3-6 meses)
1. **Advanced schema types exploration:**
2. **Dynamic schema implementation:**
3. **Rich results monitoring system:**

---

## 📊 SCORECARD STRUCTURED DATA

### Puntuación por aspecto structured data
| Aspecto | Score Actual | Score Objetivo | Gap | Acciones Requeridas |
|---------|-------------|----------------| ----|--------------------|
| **Implementation Coverage** | /100 | 80+ | | |
| **Validation Quality** | /100 | 95+ | | |
| **Rich Results Eligibility** | /100 | 85+ | | |
| **Business Schema Complete** | /100 | 90+ | | |
| **Content Schema Coverage** | /100 | 85+ | | |
| **Technical Implementation** | /100 | 90+ | | |

### Score general structured data: ___/600

---

## 📁 ARCHIVOS GENERADOS

### Análisis structured data:
- [ ] **structured_data_audit.xlsx** (análisis completo)
- [ ] **schema_errors_fixes.xlsx** (plan correcciones)
- [ ] **rich_snippets_opportunities.xlsx** (oportunidades)
- [ ] **implementation_roadmap.xlsx** (plan implementación)

### Datos Screaming Frog:
- [ ] **SF_structured_data_all.csv**
- [ ] **SF_schema_errors.csv**
- [ ] **SF_missing_structured_data.csv**

### Validaciones:
- [ ] **rich_results_test_reports.pdf** (screenshots)
- [ ] **schema_validator_reports.pdf** (validaciones)
- [ ] **gsc_enhanced_results.csv** (datos GSC)

---

**Analizado por:** _________________ **Fecha:** ___________
**Revisado por:** __________________ **Fecha:** ___________