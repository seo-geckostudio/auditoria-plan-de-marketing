# 📋 INDEXACIÓN Y ASPECTOS TÉCNICOS

**Cliente:** _________________________
**Fecha análisis:** ___________________
**URLs analizadas:** __________________
**Herramientas utilizadas:** Screaming Frog + GSC + Análisis manual
**Analista:** _________________________

---

## 📋 DATOS BASE REQUERIDOS

### Screaming Frog - Indexación técnica:
- [ ] **Canonical tab > All** → CSV
- [ ] **Pagination** → CSV
- [ ] **Meta Robots** → CSV
- [ ] **Response Codes** → CSV

### Google Search Console:
- [ ] **Index Coverage** → CSV
- [ ] **Sitemaps status** → CSV
- [ ] **URL Inspection** páginas críticas → Reports

### Análisis manual:
- [ ] **Robots.txt** → Copiar contenido completo
- [ ] **XML Sitemaps** → Lista URLs + estado
- [ ] **Htaccess** review → Copiar relevant sections

---

## 🤖 ANÁLISIS ROBOTS.TXT

### Robots.txt configuration
**URL robots.txt:** ____________________________________
- **Accesible:** ☐ Sí ☐ No ☐ Error
- **Sintaxis correcta:** ☐ Sí ☐ No ☐ Warnings
- **Tamaño archivo:** _______ KB

### Directivas robots.txt
| User-agent | Directiva | Paths Affected | Issues | Recommendations |
|------------|-----------|---------------|--------|-----------------|
| **Googlebot** | ☐ Allow ☐ Disallow | | | |
| **Bingbot** | ☐ Allow ☐ Disallow | | | |
| ***** | ☐ Allow ☐ Disallow | | | |

### Sitemap declarations en robots.txt
- **Sitemaps declarados:** _______________________________
- **Sitemaps válidos:** ________________________________
- **URLs sitemap accesibles:** ☐ Sí ☐ No ☐ Parcial

---

## 🗺️ ANÁLISIS XML SITEMAPS

### Sitemaps overview
- **Total sitemaps XML:** _______________________________
- **URLs en sitemaps:** _________________________________
- **Sitemaps accesibles:** ______________________________
- **Errores sitemaps:** _________________________________

### Análisis por sitemap
| Sitemap | URLs | Status | Last Modified | Errors | GSC Status |
|---------|------|--------|---------------|--------|------------|
| **sitemap.xml** | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | | ☐ Submitted ☐ Not submitted |
| **posts.xml** | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | | ☐ Submitted ☐ Not submitted |
| **pages.xml** | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | | ☐ Submitted ☐ Not submitted |
| **categories.xml** | | ☐ ✅ ☐ ⚠️ ☐ ❌ | | | ☐ Submitted ☐ Not submitted |

### Sitemap quality issues
- **URLs 404 en sitemaps:** ____________________________
- **URLs redirected en sitemaps:** _____________________
- **URLs noindex en sitemaps:** _________________________
- **URLs duplicadas en sitemaps:** ______________________

---

## 📑 ANÁLISIS CANONICAL TAGS

### Implementación canonicals
- **Páginas con canonical:** ____________________________
- **Páginas sin canonical:** ____________________________
- **Self-referencing canonicals:** ______________________
- **Cross-domain canonicals:** ___________________________

### Canonical issues detectados
| Issue Type | Pages Affected | SEO Impact | Fix Priority |
|------------|---------------|------------|---------------|
| **Missing canonical** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta ☐ Media |
| **Non-canonical in sitemap** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta ☐ Media |
| **Canonical chain** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta ☐ Media |
| **Canonical 404/5XX** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta ☐ Media |

### Top 10 canonical problems
| URL | Canonical Issue | Current Canonical | Recommended Fix |
|-----|----------------|------------------|-----------------|
| 1. | | | |
| 2. | | | |
| 3. | | | |
| 4. | | | |
| 5. | | | |

---

## 🔄 ANÁLISIS PAGINACIÓN

### Pagination implementation
- **Páginas con paginación:** ___________________________
- **Rel next/prev implementado:** ☐ Sí ☐ No ☐ Obsoleto
- **Canonical en páginas paginadas:** ☐ Correcto ☐ Incorrecto
- **View All páginas:** ☐ Presente ☐ Ausente

### Pagination SEO issues
| Pagination Issue | Pages | Impact | Solution |
|------------------|-------|--------|----------|
| **Missing rel canonical** | | ☐ Alto ☐ Medio ☐ Bajo | |
| **Orphaned paginated pages** | | ☐ Alto ☐ Medio ☐ Bajo | |
| **Inconsistent pagination** | | ☐ Alto ☐ Medio ☐ Bajo | |

---

## 🚫 ANÁLISIS META ROBOTS

### Meta robots distribution
- **Index, follow:** ____________________________________
- **Noindex:** _________________________________________
- **Nofollow:** ________________________________________
- **Noarchive/nosnippet:** ______________________________

### Meta robots conflicts
| URL | Meta Robots | Robots.txt | Sitemap | Conflict | Action |
|-----|-------------|------------|---------|----------|--------|
| 1. | | ☐ Allow ☐ Disallow | ☐ Included ☐ Excluded | ☐ Sí ☐ No | |
| 2. | | ☐ Allow ☐ Disallow | ☐ Included ☐ Excluded | ☐ Sí ☐ No | |
| 3. | | ☐ Allow ☐ Disallow | ☐ Included ☐ Excluded | ☐ Sí ☐ No | |

---

## 📊 GOOGLE SEARCH CONSOLE INDEXATION

### Index coverage analysis
- **Valid indexed pages:** ____________________________
- **Valid with warnings:** _____________________________
- **Error pages:** ____________________________________
- **Excluded pages:** __________________________________

### Coverage errors breakdown
| Error Type | URLs | Trend | Fix Priority |
|------------|------|-------|---------------|
| **404 not found** | | ☐ ↗️ ☐ ↘️ ☐ → | ☐ Crítica ☐ Alta ☐ Media |
| **Redirect error** | | ☐ ↗️ ☐ ↘️ ☐ → | ☐ Crítica ☐ Alta ☐ Media |
| **Server error (5xx)** | | ☐ ↗️ ☐ ↘️ ☐ → | ☐ Crítica ☐ Alta ☐ Media |
| **Submitted URL not found** | | ☐ ↗️ ☐ ↘️ ☐ → | ☐ Crítica ☐ Alta ☐ Media |

### Exclusiones importantes
| Exclusion Reason | URLs | Intentional | Action Required |
|------------------|------|-------------|-----------------|
| **Noindex tag** | | ☐ Sí ☐ No | |
| **Robots.txt blocked** | | ☐ Sí ☐ No | |
| **Duplicate content** | | ☐ Sí ☐ No | |
| **Crawl anomaly** | | ☐ Sí ☐ No | |

---

## 🔧 ASPECTOS TÉCNICOS ADICIONALES

### HTTPS implementation
- **SSL certificate:** ☐ Válido ☐ Expirado ☐ Inválido
- **Mixed content:** ☐ Detectado ☐ No detectado
- **HSTS header:** ☐ Implementado ☐ No implementado
- **Secure cookies:** ☐ Implementado ☐ No implementado

### Technical SEO factors
| Factor | Status | Implementation | Priority Fix |
|--------|--------|---------------|--------------|
| **Schema markup** | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ Comprehensive ☐ Basic ☐ Missing | ☐ Alta ☐ Media ☐ Baja |
| **Page speed** | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ Optimized ☐ Basic ☐ Poor | ☐ Alta ☐ Media ☐ Baja |
| **Mobile-friendly** | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ Responsive ☐ Partial ☐ Not mobile | ☐ Alta ☐ Media ☐ Baja |
| **Core Web Vitals** | ☐ ✅ ☐ ⚠️ ☐ ❌ | ☐ Good ☐ Needs work ☐ Poor | ☐ Alta ☐ Media ☐ Baja |

---

## 🔍 HALLAZGOS CLAVE

### 🟢 Fortalezas técnicas identificadas
- ✅ _____________________________________________
- ✅ _____________________________________________
- ✅ _____________________________________________

### 🔴 Problemas críticos detectados
- ❌ _____________________________________________
- ❌ _____________________________________________
- ❌ _____________________________________________

### 🔶 Oportunidades mejora técnica
- 🎯 _____________________________________________
- 🎯 _____________________________________________
- 🎯 _____________________________________________

---

## ⚠️ PROBLEMAS CRÍTICOS

### Issues técnicos requieren fix inmediato
| Problema | Pages Affected | Impact Indexation | Impact Rankings | Prioridad |
|----------|---------------|-------------------|----------------|-----------|
| **URLs importantes no indexadas** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Errores canonical críticos** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Sitemap errors masivos** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |
| **Robots.txt blocking crítico** | | ☐ Alto ☐ Medio ☐ Bajo | ☐ Alto ☐ Medio ☐ Bajo | ☐ Crítica ☐ Alta |

---

## 🚀 PLAN OPTIMIZACIÓN TÉCNICA

### Quick Wins (1-2 semanas)
1. **Corregir errores indexación GSC:**
   - Errores: ___________________________________
   - URLs affected: ____________________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

2. **Optimizar sitemaps XML:**
   - Issues: ____________________________________
   - URLs to fix: _______________________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

3. **Resolver canonical conflicts:**
   - Conflicts: __________________________________
   - Pages affected: ____________________________
   - Impact estimado: ☐ Alto ☐ Medio ☐ Bajo

### Optimizaciones medio plazo (1-3 meses)
1. **Implementar structured data systematic:**
2. **Optimizar crawl budget:**
3. **Technical SEO monitoring setup:**

### Plan largo plazo (3-6 meses)
1. **Advanced technical SEO implementation:**
2. **International SEO technical setup:**
3. **Technical performance monitoring:**

---

## 📊 SCORECARD ASPECTOS TÉCNICOS

### Puntuación por aspecto técnico
| Aspecto | Score Actual | Score Objetivo | Gap | Acciones Requeridas |
|---------|-------------|----------------|-----|---------------------|
| **Indexation Health** | /100 | 95+ | | |
| **Robots.txt Optimization** | /100 | 90+ | | |
| **Sitemap Quality** | /100 | 95+ | | |
| **Canonical Implementation** | /100 | 90+ | | |
| **Meta Robots Consistency** | /100 | 95+ | | |
| **Technical Foundation** | /100 | 85+ | | |

### Score general aspectos técnicos: ___/600

---

## 📁 ARCHIVOS GENERADOS

### Análisis técnico:
- [ ] **indexacion_aspectos_tecnicos.xlsx** (análisis completo)
- [ ] **gsc_indexation_issues.xlsx** (problemas GSC)
- [ ] **canonical_audit.xlsx** (auditoría canonicals)
- [ ] **sitemap_optimization_plan.xlsx** (plan sitemaps)

### Datos técnicos:
- [ ] **robots_txt_analysis.txt** (análisis robots.txt)
- [ ] **SF_canonical_all.csv**
- [ ] **SF_pagination.csv**
- [ ] **GSC_index_coverage.csv**

### Configuración:
- [ ] **technical_seo_checklist.xlsx** (checklist técnico)
- [ ] **monitoring_setup.xlsx** (configuración monitoreo)
- [ ] **htaccess_recommendations.txt** (recomendaciones)

---

**Analizado por:** _________________ **Fecha:** ___________
**Revisado por:** __________________ **Fecha:** ___________