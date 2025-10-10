# ALTERNATIVAS PARA DATOS SEO SIN DATAFORSEO NI COUPLER

## 📊 DATOS DISPONIBLES VIA MCPs

### ✅ GOOGLE SEARCH CONSOLE (GSC)
- **Consultas de búsqueda** con impresiones, clics, CTR, posición
- **Páginas indexadas** y estado de indexación
- **Errores de crawl** y problemas técnicos
- **Enlaces internos y externos**
- **Datos de Core Web Vitals**
- **Cobertura de sitemap**

### ✅ GOOGLE ANALYTICS 4 (GA4)
- **Datos demográficos** (edad, género, ubicación)
- **Comportamiento de usuarios** (sesiones, páginas vistas, duración)
- **Fuentes de tráfico** (orgánico, directo, referral, social)
- **Eventos personalizados** y conversiones
- **Audiencias** y segmentación
- **Métricas de engagement**

### ✅ GOOGLE KEYWORD PLANNER (via Google Ads API)
- **Volúmenes de búsqueda** mensuales
- **Competencia de keywords**
- **CPC estimado**
- **Sugerencias de palabras clave**
- **Tendencias estacionales**

## 🔄 ALTERNATIVAS GRATUITAS PARA DATOS FALTANTES

### 3. ANÁLISIS DE COMPETENCIA (Sin Ahrefs)
**Alternativas gratuitas:**
- **Ubersuggest (versión gratuita):** 3 búsquedas/día
- **SEMrush (versión gratuita):** 10 consultas/día
- **SimilarWeb (versión gratuita):** Datos básicos de tráfico
- **Google Trends:** Tendencias de búsqueda comparativas
- **AnswerThePublic (versión gratuita):** 3 búsquedas/día

**Proceso manual:**
1. Exportar datos básicos de cada herramienta
2. Consolidar en Excel/Google Sheets
3. Importar datos procesados al sistema

### 4. ANÁLISIS TÉCNICO (Sin Screaming Frog)
**Alternativas gratuitas:**
- **Google PageSpeed Insights API:** Métricas de rendimiento
- **Google Lighthouse:** Auditoría técnica completa
- **Sitemap XML:** Análisis manual de estructura
- **Google Search Console:** Errores de rastreo e indexación

**Herramientas de línea de comandos:**
```bash
# Lighthouse CLI (gratuito)
npm install -g lighthouse
lighthouse https://ejemplo.com --output json

# Análisis de sitemap
curl -s https://ejemplo.com/sitemap.xml | grep -o '<loc>[^<]*' | sed 's/<loc>//'
```

### 5. DATOS DE VOLUMEN DE BÚSQUEDA
**Alternativas a DataForSEO:**
- **Google Keyword Planner (MCP disponible)**
- **Google Trends (API gratuita)**
- **Keywords Everywhere (extensión de pago económica)**
- **Keyword Surfer (extensión gratuita)**

## 📊 MAPEO DE DATOS POR FASE

### FASE_0_MARKETING_DIGITAL
| Dato Requerido | Fuente Alternativa | Método |
|---|---|---|
| Volúmenes de búsqueda | Google Keyword Planner MCP | Automático |
| Tendencias estacionales | Google Trends API | Manual/Script |
| Análisis demográfico | GA4 (si disponible) | Manual |

### FASE_1_PREPARACION
| Dato Requerido | Fuente Alternativa | Método |
|---|---|---|
| Accesos GSC/GA4 | Configuración manual | Manual |
| Información del cliente | Formulario/Brief | Manual |

### FASE_2_KEYWORD_RESEARCH
| Dato Requerido | Fuente Alternativa | Método |
|---|---|---|
| Keywords actuales | GSC MCP | Automático |
| Volúmenes de búsqueda | Google Keyword Planner MCP | Automático |
| Competencia básica | Ubersuggest (manual) | Manual |
| Keywords relacionadas | Google Keyword Planner MCP | Automático |

### FASE_3_ARQUITECTURA
| Dato Requerido | Fuente Alternativa | Método |
|---|---|---|
| Páginas indexadas | GSC MCP | Automático |
| Estructura del sitio | Análisis manual del sitemap | Manual |
| Errores técnicos | GSC MCP + PageSpeed Insights | Semi-automático |

### FASE_4_RECOPILACION_DATOS
| Dato Requerido | Fuente Alternativa | Método |
|---|---|---|
| Configuración GA4 | Revisión manual | Manual |
| Eventos de conversión | GA4 (si disponible) | Manual |
| Configuración GTM | Revisión manual del código | Manual |

## 🛠️ HERRAMIENTAS GRATUITAS RECOMENDADAS

### APIs Gratuitas
```javascript
// Google Trends (sin API oficial, usar bibliotecas)
npm install google-trends-api

// PageSpeed Insights API
https://developers.google.com/speed/docs/insights/v5/get-started

// Lighthouse CI
npm install -g @lhci/cli
```

### Extensiones de Navegador
- **SEO Meta in 1 Click:** Análisis de metadatos
- **Keyword Surfer:** Volúmenes de búsqueda básicos
- **SEOquake:** Métricas SEO básicas
- **Wappalyzer:** Tecnologías del sitio web

### Herramientas Web Gratuitas
- **Google PageSpeed Insights**
- **GTmetrix (versión gratuita)**
- **Pingdom Website Speed Test**
- **Google Mobile-Friendly Test**

## 📋 PROCESO RECOMENDADO

### 1. CONFIGURACIÓN INICIAL
```bash
# Instalar MCPs disponibles
npm install -g mcp-server-gsc
npm install -g @ayushsinghvi92/app-seo-ai

# Instalar herramientas complementarias
npm install -g lighthouse
npm install -g google-trends-api
```

### 2. RECOPILACIÓN DE DATOS
1. **Automático (MCPs):**
   - GSC: Queries, páginas, rendimiento
   - Google Ads: Volúmenes, competencia

2. **Semi-automático (Scripts):**
   - PageSpeed Insights para todas las páginas
   - Google Trends para keywords principales

3. **Manual (Herramientas web):**
   - Ubersuggest para análisis de competencia
   - SimilarWeb para datos de tráfico
   - Análisis manual de estructura del sitio

### 3. CONSOLIDACIÓN
- Crear plantillas Excel/Google Sheets
- Importar datos de múltiples fuentes
- Normalizar formatos de datos
- Validar consistencia de información

## ⚠️ LIMITACIONES

### Datos NO disponibles sin herramientas de pago:
- **Backlinks detallados** (sin Ahrefs/Majestic)
- **Keywords de competencia completas** (sin SEMrush/Ahrefs)
- **Análisis técnico profundo** (sin Screaming Frog)
- **Datos históricos extensos** (limitados en herramientas gratuitas)

### Workarounds recomendados:
1. **Para backlinks:** Usar GSC "Enlaces" + análisis manual
2. **Para keywords competencia:** Combinar múltiples fuentes gratuitas
3. **Para análisis técnico:** GSC + Lighthouse + revisión manual
4. **Para datos históricos:** Usar períodos más cortos disponibles

## 🎯 PRÓXIMOS PASOS

1. **Configurar MCPs disponibles** (GSC + Google Keyword Planner)
2. **Crear scripts de automatización** para APIs gratuitas
3. **Establecer proceso de recopilación manual** para datos faltantes
4. **Crear plantillas de consolidación** de datos
5. **Documentar flujo de trabajo** optimizado

---
*Este enfoque permite obtener ~70% de los datos necesarios de forma automática/semi-automática, requiriendo trabajo manual solo para el 30% restante.*