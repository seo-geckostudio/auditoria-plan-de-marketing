# 📋 INSTRUCCIONES PARA LA FASE 4: RECOPILACIÓN DE DATOS

## 🎯 Objetivo de la Fase
Ejecutar una auditoría técnica y de contenidos exhaustiva que abarque todos los aspectos críticos del SEO: rendimiento, optimización on-page, contenido, enlaces, aspectos técnicos, móvil, velocidad, enlaces externos e indexación. Esta fase genera la data base que alimentará las recomendaciones finales.

---

## 📊 OVERVIEW FASE 4

### Scope completo análisis (17 áreas)
1. **Situación actual y rendimiento SEO general**
2. **Posicionamiento orgánico**
3. **SEO On Page**
4. **Menú y navegación**
5. **Enlazado interno**
6. **Análisis de contenido**
7. **Meta Tags y optimización**
8. **Optimización de imágenes**
9. **Blog y contenido**
10. **Rich Snippets y datos estructurados**
11. **Multidioma y hreflang**
12. **Evaluación E-E-A-T**
13. **Errores técnicos**
14. **Mobile y Core Web Vitals**
15. **Rendimiento WPO**
16. **Perfil de enlaces**
17. **Aspectos técnicos indexación**

### Metodología general
**Cada análisis incluye:**
- **Herramientas específicas** requeridas
- **Exportaciones exact as** necesarias
- **Configuraciones precisas**
- **Documento structured** para generar
- **Métricas clave** a capturar
- **Benchmarks** y referencias
- **Actionable insights** identificados

---

## ⚙️ HERRAMIENTAS NECESARIAS FASE 4

### Herramientas principales:
- **Google Search Console** (acceso verificado)
- **Google Analytics 4** (acceso editor)
- **Ahrefs** (cuenta active con créditos)
- **Screaming Frog SEO Spider** (licencia pro recomendada)

### Herramientas complementarias:
- **PageSpeed Insights** (Google, gratuito)
- **Lighthouse** (Chrome DevTools)
- **GTMetrix** (cuenta gratuita/pro)
- **Rich Results Test** (Google, gratuito)
- **Schema Markup Validator** (Google)
- **Mobile-Friendly Test** (Google)

### Herramientas opcionales avanzadas:
- **Sitebulb** (alternativa premium a Screaming Frog)
- **OnCrawl** (análisis avanzado enterprise)
- **DeepCrawl** (sitios muy grandes)

---

## 📅 CRONOGRAMA RECOMENDADO FASE 4

### Semana 1: Análisis fundacionales
- **Días 1-2:** Situación general + Posicionamiento + SEO On-Page
- **Días 3-4:** Navegación + Enlazado interno + Contenido
- **Día 5:** Meta tags + Imágenes + Blog

### Semana 2: Análisis técnicos avanzados
- **Días 1-2:** Rich Snippets + Multidioma + E-E-A-T
- **Días 3-4:** Errores técnicos + Mobile + WPO
- **Día 5:** Enlaces + Indexación + Consolidación

### Checkpoints obligatorios:
- **Día 3:** Validar acceso a todas las herramientas
- **Día 7:** Review calidad primeros análisis
- **Día 10:** Confirmation data completeness
- **Día 12:** Validación findings con stakeholders

---

## 🛠️ CONFIGURACIONES ESPECÍFICAS

### Screaming Frog SEO Spider
**Configuración standard all análisis:**
```
Configuration > Spider:
- Respect robots.txt: ✓
- Follow internal nofollow: ✗
- Follow external nofollow: ✗
- Crawl outside of start directory: ✗

Configuration > Limits:
- Max URI Length: 2048
- Max Crawl Depth: 10 (adjust per site size)

Configuration > Speed:
- Delay between requests: 0.5s (be respectful)
- Threads: 5 (adjust for server capacity)

Configuration > User-Agent:
- Set to Googlebot for SEO crawling
```

### Google Search Console
**Período standard para exports:**
- **Time range:** Last 12 months (unless specified)
- **Country filter:** Target market only
- **Device filter:** All devices (unless mobile-specific analysis)
- **Search type:** Web (unless image/video specific)

### Ahrefs Configuration
**Settings recomendadas:**
- **Country database:** Match client target market
- **Search engine:** Google (unless specified otherwise)
- **Data mode:** Fresh/Live data
- **Export limits:** Use highest available

---

## 📋 ESTRUCTURA DOCUMENTOS

### Naming convention:
```
11_situacion_general_seo.md
12_posicionamiento_organico.md
13_seo_onpage_analisis.md
14_navegacion_arquitectura.md
15_enlazado_interno.md
16_analisis_contenido.md
17_meta_tags_optimizacion.md
18_optimizacion_imagenes.md
19_blog_contenido_analisis.md
20_datos_estructurados.md
21_hreflang_multidioma.md
22_evaluacion_eeat.md
23_errores_tecnicos.md
24_mobile_core_web_vitals.md
25_rendimiento_wpo.md
26_perfil_enlaces.md
27_indexacion_aspectos_tecnicos.md
```

### Template structure cada documento:
```markdown
# [TÍTULO ANÁLISIS]

**Cliente:** _________________________
**Fecha análisis:** ___________________
**Herramientas utilizadas:** ___________
**Analista:** _________________________

---

## 📋 DATOS BASE REQUERIDOS
[Herramientas + exportaciones específicas]

## 📊 ANÁLISIS PRINCIPAL
[Tablas y métricas core]

## 🔍 HALLAZGOS CLAVE
[Issues y opportunities identificados]

## ⚠️ PROBLEMAS CRÍTICOS
[High priority issues]

## 🚀 RECOMENDACIONES
[Actionable recommendations]

## 📁 ARCHIVOS GENERADOS
[Lista exports y documentos]

---
**Analizado por:** _______ **Fecha:** _______
```

---

## 🎯 CRITERIOS CALIDAD ANÁLISIS

### Data completeness check:
- [ ] **100% herramientas** funcionando correctamente
- [ ] **Todos los exports** generados successful
- [ ] **Screenshots** high quality incluidos donde requerido
- [ ] **Métricas baseline** correctamente capturadas
- [ ] **Benchmarks** industry/competitors incluidos

### Analysis depth verification:
- [ ] **Root cause analysis** problems identificados
- [ ] **Business impact** assessment completed
- [ ] **Priority ranking** problems aplicado
- [ ] **Feasibility** solutions considerada
- [ ] **ROI estimation** major recommendations

### Documentation standards:
- [ ] **Data tables** clearly formatted
- [ ] **Action items** specific and measurable
- [ ] **Technical details** sufficient for implementation
- [ ] **Non-technical summary** accessible stakeholders
- [ ] **Sources verification** data accuracy

---

## ⚠️ PRECAUCIONES Y LIMITACIONES

### Data privacy y access:
- **Never export** personal data de users
- **Respect crawl limits** site servers
- **Document access permissions** clearly
- **Handle sensitive data** according GDPR/local laws

### Technical considerations:
- **Large sites (>100k pages):** Adjust crawl depth y sampling
- **E-commerce sites:** Special attention product pages
- **Multi-language sites:** Ensure coverage all languages
- **Dynamic content:** Consider JavaScript rendering

### Timeline management:
- **Factor tool response times** en planning
- **Plan for data export limits** API rates
- **Buffer time for technical issues** 20%
- **Stakeholder review cycles** in timeline

---

## 📊 QUALITY ASSURANCE CHECKLIST

### Pre-analysis:
- [ ] **Tool access verified** y functional
- [ ] **Baseline data** captured correctly
- [ ] **Site scope** clearly defined
- [ ] **Analysis objectives** confirmed with stakeholders

### During analysis:
- [ ] **Data export quality** checked regularly
- [ ] **Anomalies flagged** for investigation
- [ ] **Cross-tool validation** where possible
- [ ] **Progress tracking** against timeline

### Post-analysis:
- [ ] **Data completeness** verified
- [ ] **Findings validated** cross-tools
- [ ] **Recommendations feasibility** checked
- [ ] **Documentation accuracy** reviewed
- [ ] **Stakeholder communication** preparada

---

## 🔄 INTERCONNECTIONS ANÁLISIS

### Data flow between análisis:
```
Situación General → Feeds into → All other analysis
Posicionamiento → Informs → Content & On-page
SEO On-page → Connects to → Meta tags & Images
Navigation → Links to → Internal linking
Content → Relates to → Blog & E-E-A-T
Technical errors → Impacts → Mobile & Performance
Mobile/WPO → Affects → Overall rankings
Links → Influences → Authority & rankings
Indexation → Fundamental to → All SEO performance
```

### Cross-validation opportunities:
- **GSC data** vs **Ahrefs data** (keyword positions)
- **Screaming Frog errors** vs **GSC Coverage** (indexation issues)
- **PageSpeed data** vs **Core Web Vitals** (performance)
- **Internal linking** vs **Page authority** (link equity)

---

## 📈 BENCHMARK REFERENCES

### Industry standards:
- **Page load time:** <3 seconds desktop, <2 seconds mobile
- **Core Web Vitals:** LCP <2.5s, FID <100ms, CLS <0.1
- **Image optimization:** <100kb per image average
- **Content length:** 300+ words minimum pages
- **Internal links:** 3+ per page average
- **Meta descriptions:** 155-160 characters optimal

### Competitive benchmarking:
- **Compare against 3-5** direct competitors
- **Industry vertical** averages when available
- **Geographic market** considerations
- **Device usage patterns** target audience

---

## 🚀 OPTIMIZATION PRIORITIES

### Critical issues (fix immediately):
- **Security problems** (malware, hacked content)
- **Indexation blocking** issues
- **Major technical errors** (5XX, critical redirects)
- **Core Web Vitals** failures
- **Mobile usability** critical issues

### High priority (fix within 1-2 weeks):
- **Content quality** issues
- **On-page optimization** gaps
- **Internal linking** problems
- **Schema markup** missing/errors
- **Page speed** optimization opportunities

### Medium priority (fix within 1-2 months):
- **Image optimization**
- **Content expansion** opportunities
- **Link building** needs
- **User experience** improvements
- **Advanced technical optimizations**

---

## 📁 DELIVERABLE ORGANIZATION

### Raw data folder structure:
```
DATOS_RAW_FASE_4/
├── GSC_exports/
│   ├── performance_12months.csv
│   ├── coverage_index.csv
│   ├── mobile_usability.csv
│   └── core_web_vitals.csv
├── Ahrefs_exports/
│   ├── site_overview.pdf
│   ├── organic_keywords.csv
│   ├── top_pages.csv
│   └── backlink_profile.csv
├── ScreamingFrog_exports/
│   ├── internal_all.csv
│   ├── page_titles.csv
│   ├── meta_descriptions.csv
│   ├── images_analysis.csv
│   └── response_codes.csv
└── Screenshots/
    ├── pagespeed_insights/
    ├── rich_results_test/
    └── mobile_friendly_test/
```

### Analysis documents:
- **Individual analysis files** (11-27.md)
- **Consolidated findings** summary
- **Priority action items** extracted
- **Data visualization** charts y graphs

---

## 🎓 TRAINING REQUIREMENTS

### Team skills needed:
- **Technical SEO** expertise
- **Tool proficiency** (SF, Ahrefs, GSC)
- **Data analysis** capabilities
- **Report writing** skills
- **Client communication** abilities

### Knowledge areas:
- **Search engine algorithms** understanding
- **Web development** basics
- **Analytics interpretation**
- **Competitive analysis** methodologies
- **Performance optimization** principles

---

## 💡 SUCCESS METRICS FASE 4

### Completeness metrics:
- **100% análisis** completed successfully
- **17 documentos** generated with quality
- **All required exports** captured
- **Cross-validation** completed where applicable

### Quality metrics:
- **0 critical errors** unidentified
- **Actionable recommendations** for all findings
- **Clear prioritization** all issues
- **Stakeholder satisfaction** with thoroughness

### Timeline metrics:
- **On-time delivery** all análisis
- **Within budget** tool usage
- **Efficient workflow** across team members

**⏰ Tiempo estimado Fase 4: 8-12 días según complejidad y tamaño sitio**