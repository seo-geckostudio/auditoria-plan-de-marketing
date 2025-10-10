# REQUISITOS DE DATOS REALES PARA AUDITORÍA SEO

**Proyecto:** Sistema de Auditoría SEO - Datos Reales
**Fecha:** 27/01/2025
**Objetivo:** Documentar todos los archivos, fuentes y condiciones necesarias para importar datos reales en cada fase

---

## 📋 RESUMEN EJECUTIVO

Este documento especifica **exactamente qué datos reales** necesitas extraer de cada herramienta para reemplazar los datos ficticios actuales. Incluye:
- ✅ **Archivos específicos** a exportar
- ✅ **Herramientas de origen** 
- ✅ **Condiciones y filtros** exactos
- ✅ **Formatos de exportación**
- ✅ **Fechas y períodos** requeridos

---

## 🎯 FASE_0_MARKETING_DIGITAL

### Datos Requeridos:

#### 1. **Análisis de Mercado**
**Archivo:** `00_analisis_mercado_completo.md`

**Fuentes de datos:**
- **Google Trends**
  - Exportar: Tendencias últimos 12 meses para "villa ibiza", "rent villa ibiza", "alquiler villa ibiza"
  - Formato: CSV
  - Filtros: España + Internacional, Todas las categorías
  - Período: Enero 2024 - Enero 2025

- **Ahrefs Keywords Explorer**
  - Exportar: Volúmenes de búsqueda por categorías
  - Keywords semilla: villa ibiza, rent villa ibiza, alquiler villa ibiza, luxury villa ibiza
  - Datos: Volumen, KD, CPC, Tendencia 12 meses
  - Formato: CSV (máximo 1000 keywords)

#### 2. **Análisis de Competencia 360**
**Archivo:** `01_competencia_360.md`

**Fuentes de datos:**
- **Ahrefs Site Explorer**
  - Dominios competidores: airbnb.es, booking.com, vrbo.com, homeaway.es
  - Exportar: Organic Keywords, Top Pages, Backlinks Overview
  - Período: Últimos 6 meses
  - Formato: CSV

- **SimilarWeb** (si disponible)
  - Tráfico estimado competidores
  - Canales de adquisición
  - Formato: PDF/Excel

#### 3. **Buyer Personas**
**Archivo:** `02_buyer_personas_completas.md`

**Fuentes de datos:**
- **Google Analytics 4**
  - Exportar: Audiencia > Datos demográficos (12 meses)
  - Exportar: Audiencia > Intereses (12 meses)
  - Exportar: Audiencia > Tecnología (dispositivos, navegadores)
  - Formato: CSV

- **Google Search Console**
  - Exportar: Rendimiento > Países (12 meses)
  - Exportar: Rendimiento > Dispositivos (12 meses)
  - Formato: CSV

---

## 🔧 FASE_1_PREPARACION

### Datos Requeridos:

#### 1. **Checklist de Accesos**
**Archivo:** `00_checklist_accesos.md`

**Datos reales necesarios:**
- **Google Search Console**
  - URL real de la propiedad
  - Email con acceso real
  - Fecha real de verificación
  - ID de propiedades verificadas

- **Google Analytics 4**
  - ID real de propiedad GA4 (G-XXXXXXXXXX)
  - Nivel de permisos actual
  - Estado conexión GSC-GA4

- **Información técnica real**
  - CMS real utilizado
  - Proveedor de hosting real
  - URLs de admin reales
  - Plugins SEO instalados

#### 2. **Brief del Cliente**
**Archivo:** `01_brief_cliente.md`

**Fuentes de datos:**
- **Entrevista con cliente** (datos reales)
- **Google My Business**
  - Información de negocio verificada
  - Horarios, servicios, descripción
  - Formato: Manual/Screenshots

#### 3. **Roadmap de Auditoría**
**Archivo:** `02_roadmap_auditoria.md`

**Datos basados en:**
- Análisis técnico real del sitio
- Cronograma real del proyecto
- Recursos reales disponibles

---

## 🔍 FASE_2_KEYWORD_RESEARCH

### Datos Requeridos:

#### 1. **Keywords Actuales**
**Archivo:** `03_keywords_actuales.md`

**Fuentes de datos CRÍTICAS:**

**Google Search Console (OBLIGATORIO):**
- **Exportar:** Rendimiento > Consultas
- **Período:** Últimos 12 meses completos
- **Filtros:** Mínimo 10 impresiones
- **Datos:** Consulta, Impresiones, Clics, CTR, Posición
- **Formato:** CSV
- **Fecha exportación:** Último día disponible

**Ahrefs Organic Keywords (OBLIGATORIO):**
- **Exportar:** Todas las keywords posicionadas
- **Filtros:** Posiciones 1-100
- **Datos:** Keyword, Posición, Volumen, KD, Tráfico estimado
- **Formato:** CSV
- **Fecha:** Datos más recientes disponibles

#### 2. **Análisis de Competencia**
**Archivo:** `04_analisis_competencia.md`

**Fuentes de datos:**
- **Ahrefs Competing Domains**
  - Exportar: Dominios competidores orgánicos
  - Datos: Keywords compartidas, Gap de keywords
  - Formato: CSV

#### 3. **Oportunidades de Keywords**
**Archivo:** `05_oportunidades_keywords.md`

**Fuentes de datos:**
- **Ahrefs Keywords Explorer**
  - Búsqueda por términos semilla reales
  - Filtros: KD <30, Volumen >100
  - Exportar: Keywords sugeridas
  - Formato: CSV

#### 4. **Keyword Mapping**
**Archivo:** `06_keyword_mapping.md`

**Fuentes de datos:**
- Combinación de datos GSC + Ahrefs + análisis manual de URLs actuales

---

## 🏗️ FASE_3_ARQUITECTURA

### Datos Requeridos:

#### 1. **Arquitectura Actual**
**Archivo:** `07_arquitectura_actual.md`

**Fuentes de datos:**
- **Screaming Frog SEO Spider**
  - Crawl completo del sitio web real
  - Exportar: URL, Título, Meta Description, H1, Status Code
  - Formato: CSV
  - Configuración: Seguir JavaScript, límite 10,000 URLs

- **Google Search Console**
  - Exportar: Cobertura > Páginas válidas
  - Exportar: Cobertura > Páginas con errores
  - Formato: CSV

#### 2. **Mapping Keywords-Arquitectura**
**Archivo:** `08_mapping_keywords_arquitectura.md`

**Fuentes de datos:**
- Datos de GSC (páginas con tráfico orgánico)
- Estructura real de URLs del sitio
- Keywords reales de Fase 2

#### 3. **Propuesta de Arquitectura**
**Archivo:** `09_propuesta_arquitectura.md`

**Basado en:**
- Análisis real de la arquitectura actual
- Keywords reales identificadas
- Mejores prácticas SEO

---

## 📊 FASE_4_RECOPILACION_DATOS

### Datos Requeridos:

#### 1. **Configuración de Tracking**
**Archivo:** `10_configuracion_tracking.md`

**Fuentes de datos:**
- **Google Analytics 4**
  - Configuración actual de eventos
  - Goals/Conversiones configuradas
  - Audiencias definidas
  - Formato: Screenshots + CSV de configuración

- **Google Tag Manager** (si aplica)
  - Tags configurados
  - Triggers activos
  - Variables definidas
  - Formato: Exportación de contenedor

- **Herramientas adicionales**
  - Hotjar/Crazy Egg (si configurado)
  - Facebook Pixel (si configurado)
  - Otras herramientas de tracking

---

## 📋 CHECKLIST DE EXPORTACIÓN

### ✅ Antes de exportar datos:

1. **Verificar fechas:**
   - Usar siempre el último día disponible
   - Períodos completos (no parciales)
   - Misma ventana temporal para comparaciones

2. **Configurar filtros correctos:**
   - GSC: Mínimo 10 impresiones
   - Ahrefs: Posiciones 1-100
   - GA4: Excluir tráfico interno

3. **Formatos de exportación:**
   - Preferir CSV para datos tabulares
   - UTF-8 encoding
   - Separador: coma (,)

4. **Validación de datos:**
   - Verificar que no hay datos en blanco
   - Comprobar coherencia de fechas
   - Validar volúmenes vs. realidad

### ⚠️ Datos críticos que NO pueden ser ficticios:

- ❌ Posiciones actuales en GSC
- ❌ Volúmenes de búsqueda reales
- ❌ CTR y métricas de rendimiento
- ❌ URLs y estructura real del sitio
- ❌ Configuración técnica actual
- ❌ IDs reales de herramientas (GA4, GSC)

---

## 🔄 PROCESO DE IMPORTACIÓN

### Orden recomendado:

1. **FASE_1:** Verificar accesos y obtener datos técnicos
2. **FASE_2:** Exportar datos de GSC y Ahrefs (crítico)
3. **FASE_0:** Completar análisis de mercado con datos reales
4. **FASE_3:** Crawl técnico y análisis de arquitectura
5. **FASE_4:** Configuración y tracking actual

### Herramientas mínimas necesarias:

- ✅ **Google Search Console** (acceso obligatorio)
- ✅ **Google Analytics 4** (acceso obligatorio)
- ✅ **Ahrefs** (suscripción necesaria)
- ✅ **Screaming Frog** (versión gratuita suficiente)
- ⚪ **Google Trends** (gratuito)
- ⚪ **SimilarWeb** (opcional, datos limitados gratis)

---

**Próximos pasos:**
1. Verificar acceso a todas las herramientas listadas
2. Exportar datos siguiendo las especificaciones exactas
3. Reemplazar datos ficticios por datos reales
4. Validar coherencia entre fases
5. Actualizar análisis y conclusiones basándose en datos reales