# 🧩 SISTEMA MODULAR DE AUDITORÍA SEO

## 📋 ÍNDICE

1. [Arquitectura del Sistema](#arquitectura)
2. [Matriz de Módulos por Tipo de Proyecto](#matriz)
3. [Catálogo de Módulos](#catalogo)
4. [Implementación Técnica](#implementacion)
5. [Plan de Trabajo y Distribución de Tiempo](#plan-trabajo)
6. [Sistema de Configuración](#configuracion)

---

## <a name="arquitectura"></a>🏗️ 1. ARQUITECTURA DEL SISTEMA

### Estructura de Carpetas

```
WEB_AUDITORIA/
├── config/
│   ├── modulos_disponibles.json      # Catálogo completo de módulos
│   ├── perfiles_proyecto.json        # Tipos de proyecto y módulos asociados
│   └── configuracion_cliente.json     # Config específica del cliente actual
├── modulos/
│   ├── fase0_marketing/
│   │   ├── 00_analisis_mercado.php
│   │   ├── 01_competencia.php
│   │   ├── 02_buyer_personas.php
│   │   ├── 03_estrategia_contenidos.php
│   │   └── 04_canales_digitales.php
│   ├── fase1_preparacion/
│   │   ├── 00_brief_cliente.php
│   │   ├── 01_checklist_accesos.php
│   │   └── 02_roadmap_auditoria.php
│   ├── fase2_keyword_research/
│   │   ├── 00_keywords_actuales.php
│   │   ├── 01_analisis_competencia.php
│   │   ├── 02_oportunidades.php
│   │   └── 03_keyword_mapping.php
│   ├── fase3_arquitectura/
│   │   ├── 00_arquitectura_actual.php
│   │   ├── 01_keyword_to_url.php
│   │   └── 02_propuesta_arquitectura.php
│   ├── fase4_recopilacion_datos/
│   │   ├── 00_situacion_actual.php
│   │   ├── 01_trafico_organico.php
│   │   ├── 02_posicionamiento.php
│   │   ├── 03_seo_onpage.php
│   │   ├── 04_arquitectura_tecnica.php
│   │   ├── 05_contenido.php
│   │   ├── 06_meta_tags.php
│   │   ├── 07_imagenes.php
│   │   ├── 08_datos_estructurados.php
│   │   ├── 09_errores_tecnicos.php
│   │   ├── 10_rendimiento.php
│   │   ├── 11_mobile_cwv.php
│   │   ├── 12_enlazado_interno.php
│   │   ├── 13_perfil_enlaces.php
│   │   ├── 14_indexacion.php
│   │   └── 15_seguridad.php
│   └── fase5_entregables/
│       ├── 00_resumen_ejecutivo.php
│       ├── 01_informe_tecnico.php
│       ├── 02_plan_accion.php
│       └── 03_priorizacion.php
├── data/
│   └── [archivos JSON de datos por módulo]
├── templates/
│   └── [plantillas visuales por tipo de módulo]
└── includes/
    ├── module_loader.php              # Cargador dinámico de módulos
    ├── module_validator.php           # Validación de dependencias
    └── report_generator.php           # Generador de informes personalizados
```

---

## <a name="matriz"></a>📊 2. MATRIZ DE MÓDULOS POR TIPO DE PROYECTO

### Tipos de Proyecto Definidos

1. **Corporativo Básico** - Web de empresa con pocas páginas
2. **Corporativo Avanzado** - Web corporativa con blog y recursos
3. **Ecommerce Pequeño** - Tienda online <500 productos
4. **Ecommerce Grande** - Tienda online >500 productos
5. **Portal de Contenidos** - Blog, revista digital, portal de noticias
6. **Sitio Local** - Negocio local con presencia online
7. **SaaS/Software** - Producto de software con documentación
8. **Marketplace** - Plataforma con múltiples vendedores

### Matriz de Activación

| Módulo | Corp. Básico | Corp. Avanz. | Ecom. Peq. | Ecom. Grande | Portal | Local | SaaS | Marketplace |
|--------|-------------|--------------|------------|--------------|--------|-------|------|-------------|
| **FASE 0: MARKETING** ||||||||
| Análisis de Mercado | ○ | ● | ● | ● | ○ | ○ | ● | ● |
| Análisis Competencia | ○ | ● | ● | ● | ● | ○ | ● | ● |
| Buyer Personas | ○ | ● | ● | ● | ● | ○ | ● | ● |
| Estrategia Contenidos | ○ | ● | ○ | ● | ● | ○ | ● | ● |
| Canales Digitales | ○ | ● | ● | ● | ● | ○ | ● | ● |
| **FASE 1: PREPARACIÓN** ||||||||
| Brief Cliente | ● | ● | ● | ● | ● | ● | ● | ● |
| Checklist Accesos | ● | ● | ● | ● | ● | ● | ● | ● |
| Roadmap Auditoría | ● | ● | ● | ● | ● | ● | ● | ● |
| **FASE 2: KEYWORD RESEARCH** ||||||||
| Keywords Actuales | ● | ● | ● | ● | ● | ● | ● | ● |
| Análisis Competencia | ● | ● | ● | ● | ● | ● | ● | ● |
| Oportunidades | ● | ● | ● | ● | ● | ● | ● | ● |
| Keyword Mapping | ○ | ● | ● | ● | ● | ○ | ● | ● |
| **FASE 3: ARQUITECTURA** ||||||||
| Arquitectura Actual | ● | ● | ● | ● | ● | ○ | ● | ● |
| Keyword to URL | ○ | ● | ● | ● | ● | ○ | ● | ● |
| Propuesta Arquitectura | ○ | ● | ● | ● | ● | ○ | ● | ● |
| **FASE 4: RECOPILACIÓN DATOS** ||||||||
| Situación Actual | ● | ● | ● | ● | ● | ● | ● | ● |
| Tráfico Orgánico | ● | ● | ● | ● | ● | ● | ● | ● |
| Posicionamiento | ● | ● | ● | ● | ● | ● | ● | ● |
| SEO On-Page | ● | ● | ● | ● | ● | ● | ● | ● |
| Arquitectura Técnica | ● | ● | ● | ● | ● | ○ | ● | ● |
| Contenido | ○ | ● | ○ | ● | ● | ○ | ● | ● |
| Meta Tags | ● | ● | ● | ● | ● | ● | ● | ● |
| Imágenes | ● | ● | ● | ● | ● | ○ | ● | ● |
| Datos Estructurados | ○ | ● | ● | ● | ○ | ● | ● | ● |
| Errores Técnicos | ● | ● | ● | ● | ● | ● | ● | ● |
| Rendimiento | ● | ● | ● | ● | ● | ● | ● | ● |
| Mobile + CWV | ● | ● | ● | ● | ● | ● | ● | ● |
| Enlazado Interno | ○ | ● | ● | ● | ● | ○ | ● | ● |
| Perfil Enlaces | ○ | ● | ● | ● | ● | ○ | ● | ● |
| Indexación | ● | ● | ● | ● | ● | ● | ● | ● |
| Seguridad | ● | ● | ● | ● | ● | ● | ● | ● |
| **FASE 5: ENTREGABLES** ||||||||
| Resumen Ejecutivo | ● | ● | ● | ● | ● | ● | ● | ● |
| Informe Técnico | ● | ● | ● | ● | ● | ● | ● | ● |
| Plan de Acción | ● | ● | ● | ● | ● | ● | ● | ● |
| Priorización | ● | ● | ● | ● | ● | ● | ● | ● |

**Leyenda:**
- ● = Obligatorio para este tipo de proyecto
- ○ = Opcional (según presupuesto/necesidad)
- (vacío) = No aplica

---

## <a name="catalogo"></a>📚 3. CATÁLOGO COMPLETO DE MÓDULOS

### FASE 0: MARKETING DIGITAL (Opcional)

#### Módulo 0.1: Análisis de Mercado
**Objetivo:** Entender el contexto de negocio y mercado del cliente

**Páginas generadas:**
1. Tamaño del mercado y tendencias
2. Estacionalidad y ciclos de demanda
3. Barreras de entrada y oportunidades

**Datos necesarios:**
- Sector/industria del cliente
- Geografía objetivo
- Competidores principales (3-5)

**Herramientas:**
- Google Trends
- SEMrush Market Explorer
- Informes del sector

**Tiempo estimado:** 4-6 horas

---

#### Módulo 0.2: Análisis de Competencia 360
**Objetivo:** Benchmark contra competidores directos

**Páginas generadas:**
1. Comparativa de tráfico orgánico
2. Gap de keywords
3. Estrategias de contenido competidores
4. Perfil de enlaces competidores

**Datos necesarios:**
- URLs competidores (3-5)
- Keywords objetivo compartidas

**Herramientas:**
- Ahrefs Site Explorer
- SEMrush Domain Overview
- SimilarWeb

**Tiempo estimado:** 6-8 horas

---

#### Módulo 0.3: Buyer Personas
**Objetivo:** Definir audiencias objetivo para personalizar estrategia

**Páginas generadas:**
1. Perfil demográfico y psicográfico
2. Puntos de dolor y necesidades
3. Viaje del cliente (customer journey)
4. Preferencias de búsqueda

**Datos necesarios:**
- Datos de Analytics (demographics)
- Entrevistas con cliente
- Análisis de competencia

**Herramientas:**
- Google Analytics 4
- Encuestas
- Análisis cualitativo

**Tiempo estimado:** 8-10 horas

---

#### Módulo 0.4: Estrategia de Contenidos
**Objetivo:** Definir tipos y formatos de contenido a crear

**Páginas generadas:**
1. Audit de contenido existente
2. Content gaps vs competencia
3. Calendario editorial propuesto
4. Distribución de contenido por funnel

**Datos necesarios:**
- URLs actuales con contenido
- Keywords objetivo
- Recursos disponibles del cliente

**Herramientas:**
- Screaming Frog
- Ahrefs Content Explorer
- Google Search Console

**Tiempo estimado:** 6-8 horas

---

#### Módulo 0.5: Canales Digitales - Panorama
**Objetivo:** Evaluar presencia en todos los canales digitales

**Páginas generadas:**
1. Auditoría de perfiles sociales
2. Email marketing y automatización
3. Publicidad digital (SEM, Display, Social Ads)
4. Integraciones y ecosistema digital

**Datos necesarios:**
- Acceso a plataformas (Facebook Ads, Google Ads, etc.)
- Datos de campañas actuales
- Stack tecnológico

**Herramientas:**
- Auditorías manuales
- Google Ads, Facebook Ads Manager
- BuiltWith

**Tiempo estimado:** 4-6 horas

---

### FASE 1: PREPARACIÓN (Obligatorio)

#### Módulo 1.1: Brief del Cliente
**Objetivo:** Capturar información clave del proyecto

**Páginas generadas:**
1. Descripción del proyecto y objetivos
2. Información técnica del sitio
3. Historial y contexto
4. Restricciones y consideraciones

**Datos necesarios:**
- Formulario de 12 campos completado
- Reunión inicial con cliente

**Herramientas:**
- Formulario estructurado
- Checklist de información

**Tiempo estimado:** 2 horas

---

#### Módulo 1.2: Checklist de Accesos
**Objetivo:** Asegurar acceso a todas las herramientas necesarias

**Páginas generadas:**
1. Estado de accesos por herramienta
2. Guía de configuración pendiente
3. Alternativas si no hay acceso

**Datos necesarios:**
- Lista de herramientas requeridas según módulos activos

**Herramientas:**
- Sistema de tracking de accesos

**Tiempo estimado:** 1 hora

---

#### Módulo 1.3: Roadmap de Auditoría
**Objetivo:** Planificar fases y plazos de entrega

**Páginas generadas:**
1. Cronograma visual
2. Hitos y entregables
3. Dependencias entre fases

**Datos necesarios:**
- Módulos activos
- Disponibilidad de recursos
- Fechas límite del cliente

**Herramientas:**
- Gantt o timeline

**Tiempo estimado:** 2 horas

---

### FASE 2: KEYWORD RESEARCH (Obligatorio)

#### Módulo 2.1: Keywords Actuales
**Objetivo:** Analizar keywords por las que ya posiciona el sitio

**Páginas generadas:**
1. Top keywords por tráfico
2. Distribución de posiciones
3. CTR por rango de posiciones
4. Keywords por país/dispositivo

**Datos necesarios:**
- Google Search Console (últimos 12 meses)
- Ahrefs Organic Keywords

**Herramientas:**
- GSC
- Ahrefs

**Tiempo estimado:** 3-4 horas

---

#### Módulo 2.2: Análisis de Competencia (Keywords)
**Objetivo:** Descubrir keywords de competidores

**Páginas generadas:**
1. Keywords compartidas
2. Keyword gaps (tienen ellos, no nosotros)
3. Comparativa de posiciones
4. Oportunidades quick-win

**Datos necesarios:**
- URLs competidores
- Keywords objetivo

**Herramientas:**
- Ahrefs Site Explorer
- SEMrush Keyword Gap

**Tiempo estimado:** 4-6 horas

---

#### Módulo 2.3: Oportunidades de Keywords
**Objetivo:** Identificar nuevas keywords con potencial

**Páginas generadas:**
1. Keywords de alto volumen y baja dificultad
2. Long-tail opportunities
3. Keywords por intención de búsqueda
4. Keywords estacionales

**Datos necesarios:**
- Seed keywords del cliente
- Análisis SERP

**Herramientas:**
- Ahrefs Keywords Explorer
- Answer the Public
- Google Keyword Planner

**Tiempo estimado:** 6-8 horas

---

#### Módulo 2.4: Keyword Mapping
**Objetivo:** Asignar keywords a URLs existentes/futuras

**Páginas generadas:**
1. Mapa keyword → URL
2. Clusters semánticos
3. Priorización de keywords
4. Plan de creación de contenido

**Datos necesarios:**
- Keywords priorizadas
- Estructura actual del sitio

**Herramientas:**
- Excel/Sheets
- Análisis manual

**Tiempo estimado:** 4-6 horas

---

### FASE 3: ARQUITECTURA (Opcional según proyecto)

#### Módulo 3.1: Arquitectura Actual
**Objetivo:** Mapear estructura actual del sitio

**Páginas generadas:**
1. Árbol de URLs
2. Profundidad de rastreo
3. Distribución de PageRank interno
4. Problemas de arquitectura detectados

**Datos necesarios:**
- Crawl completo de Screaming Frog
- Sitemap XML

**Herramientas:**
- Screaming Frog
- Sitebulb

**Tiempo estimado:** 4-6 horas

---

#### Módulo 3.2: Keyword to URL Mapping
**Objetivo:** Asignar keywords a páginas de forma óptima

**Páginas generadas:**
1. Mapa visual keyword → URL
2. Detección de canibalización
3. Páginas huérfanas sin keywords
4. Recomendaciones de fusión/split

**Datos necesarios:**
- Keywords priorizadas (Fase 2)
- URLs rastreadas (Módulo 3.1)

**Herramientas:**
- Análisis cruzado manual
- Scripts personalizados

**Tiempo estimado:** 6-8 horas

---

#### Módulo 3.3: Propuesta de Arquitectura Ideal
**Objetivo:** Diseñar estructura óptima para SEO

**Páginas generadas:**
1. Arquitectura propuesta (wireframe)
2. Nuevas categorías/secciones sugeridas
3. Plan de migración (si aplica)
4. Impacto estimado en posicionamiento

**Datos necesarios:**
- Análisis previo (3.1 y 3.2)
- Objetivos de negocio

**Herramientas:**
- Figma/Lucidchart
- Análisis estratégico

**Tiempo estimado:** 8-10 horas

---

### FASE 4: RECOPILACIÓN DE DATOS (Núcleo de la auditoría)

*(Módulos 4.1 a 4.15 ya están definidos en el sistema actual)*

#### Módulo 4.1: Situación Actual
**Páginas:** Descripción proyecto, Analítica Web, Canales captación

#### Módulo 4.2: Tráfico Orgánico
**Páginas:** Histórico, YoY, Por país, Por dispositivo, Por buscador

#### Módulo 4.3: Posicionamiento
**Páginas:** Keywords, Visibilidad, Clics, CTR, Evolución

#### Módulo 4.4: SEO On-Page
**Páginas:** Arquitectura URLs, Optimización URLs, Headings

#### Módulo 4.5: Contenido
**Páginas:** Análisis contenido, Calidad, Duplicados, Thin content

#### Módulo 4.6: Meta Tags
**Páginas:** Titles, Descriptions, Canonicals, Alternates

#### Módulo 4.7: Imágenes
**Páginas:** Optimización imágenes, Alt texts, Formatos, Lazy loading

#### Módulo 4.8: Datos Estructurados
**Páginas:** Schema markup, Rich snippets, Errores structured data

#### Módulo 4.9: Errores Técnicos
**Páginas:** 404s, Redirects, Crawl errors, Broken links

#### Módulo 4.10: Rendimiento
**Páginas:** PageSpeed, Lighthouse, GTmetrix, Optimizaciones

#### Módulo 4.11: Mobile + Core Web Vitals
**Páginas:** Mobile usability, CWV, Responsive, AMP

#### Módulo 4.12: Enlazado Interno
**Páginas:** Distribución PageRank, Enlaces internos, Anchors

#### Módulo 4.13: Perfil de Enlaces
**Páginas:** Backlinks, Dominios referidos, Anchor texts, Toxicidad

#### Módulo 4.14: Indexación
**Páginas:** Cobertura GSC, Sitemap, Robots.txt, Noindex

#### Módulo 4.15: Seguridad
**Páginas:** HTTPS, Certificado SSL, Headers seguridad, Vulnerabilidades

---

### FASE 5: ENTREGABLES FINALES (Obligatorio)

#### Módulo 5.1: Resumen Ejecutivo
**Objetivo:** Documento para decisores (C-level)

**Páginas generadas:**
1. Estado general del sitio (semáforo)
2. Top 5 problemas críticos
3. Oportunidades de mayor impacto
4. ROI estimado de implementación

**Datos necesarios:**
- Síntesis de todos los módulos

**Herramientas:**
- Análisis cualitativo

**Tiempo estimado:** 4-6 horas

---

#### Módulo 5.2: Informe Técnico Detallado
**Objetivo:** Documento para equipo técnico

**Páginas generadas:**
1. Todos los hallazgos técnicos consolidados
2. Priorización por impacto y esfuerzo
3. Referencias técnicas y documentación

**Datos necesarios:**
- Resultados de Fase 4

**Herramientas:**
- Compilación automática

**Tiempo estimado:** 6-8 horas

---

#### Módulo 5.3: Plan de Acción SEO
**Objetivo:** Roadmap de implementación

**Páginas generadas:**
1. Tareas priorizadas (matriz impacto/esfuerzo)
2. Cronograma de implementación
3. Recursos necesarios
4. KPIs de seguimiento

**Datos necesarios:**
- Todos los módulos
- Recursos disponibles del cliente

**Herramientas:**
- Priorización estratégica

**Tiempo estimado:** 8-10 horas

---

#### Módulo 5.4: Priorización y Quick Wins
**Objetivo:** Acciones inmediatas para resultados rápidos

**Páginas generadas:**
1. Top 10 quick wins
2. Implementación paso a paso
3. Impacto esperado
4. Calendario de ejecución (primeros 30 días)

**Datos necesarios:**
- Análisis de esfuerzo vs impacto

**Herramientas:**
- Matriz Eisenhower adaptada

**Tiempo estimado:** 4 horas

---

## <a name="implementacion"></a>⚙️ 4. IMPLEMENTACIÓN TÉCNICA

### 4.1. Archivo de Configuración: `modulos_disponibles.json`

```json
{
  "version": "1.0",
  "last_updated": "2025-10-11",
  "modulos": [
    {
      "id": "m0.1",
      "fase": 0,
      "nombre": "Análisis de Mercado",
      "descripcion": "Entender contexto de negocio y mercado",
      "archivo_php": "modulos/fase0_marketing/00_analisis_mercado.php",
      "archivo_datos": "data/fase0/analisis_mercado.json",
      "paginas_generadas": 3,
      "dependencias": [],
      "herramientas_requeridas": ["Google Trends", "SEMrush"],
      "tiempo_estimado_horas": 5,
      "nivel_prioridad": 2,
      "tipos_proyecto": ["corporativo_avanzado", "ecommerce_pequeno", "ecommerce_grande", "portal", "saas", "marketplace"]
    },
    {
      "id": "m1.1",
      "fase": 1,
      "nombre": "Brief del Cliente",
      "descripcion": "Capturar información clave del proyecto",
      "archivo_php": "modulos/fase1_preparacion/00_brief_cliente.php",
      "archivo_datos": "data/fase1/brief_cliente.json",
      "paginas_generadas": 1,
      "dependencias": [],
      "herramientas_requeridas": [],
      "tiempo_estimado_horas": 2,
      "nivel_prioridad": 1,
      "tipos_proyecto": ["all"]
    },
    {
      "id": "m2.1",
      "fase": 2,
      "nombre": "Keywords Actuales",
      "descripcion": "Analizar keywords actuales del sitio",
      "archivo_php": "modulos/fase2_keyword_research/00_keywords_actuales.php",
      "archivo_datos": "data/fase2/keywords_actuales.json",
      "paginas_generadas": 4,
      "dependencias": ["m1.1"],
      "herramientas_requeridas": ["Google Search Console", "Ahrefs"],
      "tiempo_estimado_horas": 4,
      "nivel_prioridad": 1,
      "tipos_proyecto": ["all"]
    }
    // ... resto de módulos
  ]
}
```

---

### 4.2. Perfil de Proyecto: `perfiles_proyecto.json`

```json
{
  "perfiles": {
    "corporativo_basico": {
      "nombre": "Corporativo Básico",
      "descripcion": "Web corporativa simple (<20 páginas)",
      "modulos_obligatorios": ["m1.1", "m1.2", "m1.3", "m2.1", "m2.2", "m2.3", "m4.1", "m4.2", "m4.3", "m4.4", "m4.6", "m4.9", "m4.10", "m4.11", "m4.14", "m4.15", "m5.1", "m5.2", "m5.3", "m5.4"],
      "modulos_opcionales": ["m0.1", "m0.2", "m0.3", "m3.1", "m4.5", "m4.7", "m4.8", "m4.12", "m4.13"],
      "tiempo_total_min_horas": 40,
      "tiempo_total_max_horas": 60,
      "precio_referencia_min": 1500,
      "precio_referencia_max": 2500
    },
    "ecommerce_grande": {
      "nombre": "Ecommerce Grande",
      "descripcion": "Tienda online >500 productos",
      "modulos_obligatorios": ["m0.1", "m0.2", "m0.3", "m0.4", "m0.5", "m1.1", "m1.2", "m1.3", "m2.1", "m2.2", "m2.3", "m2.4", "m3.1", "m3.2", "m3.3", "m4.1", "m4.2", "m4.3", "m4.4", "m4.5", "m4.6", "m4.7", "m4.8", "m4.9", "m4.10", "m4.11", "m4.12", "m4.13", "m4.14", "m4.15", "m5.1", "m5.2", "m5.3", "m5.4"],
      "modulos_opcionales": [],
      "tiempo_total_min_horas": 120,
      "tiempo_total_max_horas": 160,
      "precio_referencia_min": 5000,
      "precio_referencia_max": 8000
    }
    // ... resto de perfiles
  }
}
```

---

### 4.3. Configuración del Cliente Actual: `configuracion_cliente.json`

```json
{
  "proyecto": {
    "id": "ibizavilla_2025",
    "nombre": "Ibiza Villa",
    "tipo_perfil": "corporativo_avanzado",
    "fecha_inicio": "2025-10-01",
    "fecha_entrega": "2025-11-15"
  },
  "modulos_activos": [
    "m0.1",
    "m0.2",
    "m0.3",
    "m1.1",
    "m1.2",
    "m2.1",
    "m2.2",
    "m2.3",
    "m4.1",
    "m4.2",
    "m4.3",
    "m4.4",
    "m4.5",
    "m4.6",
    "m4.9",
    "m4.10",
    "m4.11",
    "m4.13",
    "m4.14",
    "m5.1",
    "m5.2",
    "m5.3",
    "m5.4"
  ],
  "personalizaciones": {
    "colores": {
      "primario": "#54a34a",
      "secundario": "#6ab85e"
    },
    "logo": "assets/logo_ibizavilla.png",
    "idioma": "es"
  }
}
```

---

### 4.4. Cargador de Módulos: `includes/module_loader.php`

```php
<?php
/**
 * Module Loader - Sistema de carga dinámica de módulos
 */

class ModuleLoader {
    private $config;
    private $modulos_disponibles;
    private $modulos_activos;

    public function __construct() {
        $this->loadConfig();
        $this->loadModulesDefinition();
        $this->loadActiveModules();
    }

    /**
     * Carga configuración del cliente actual
     */
    private function loadConfig() {
        $config_file = __DIR__ . '/../config/configuracion_cliente.json';
        if (!file_exists($config_file)) {
            throw new Exception("Archivo de configuración no encontrado");
        }
        $this->config = json_decode(file_get_contents($config_file), true);
    }

    /**
     * Carga definición de todos los módulos disponibles
     */
    private function loadModulesDefinition() {
        $modules_file = __DIR__ . '/../config/modulos_disponibles.json';
        if (!file_exists($modules_file)) {
            throw new Exception("Catálogo de módulos no encontrado");
        }
        $data = json_decode(file_get_contents($modules_file), true);
        $this->modulos_disponibles = $data['modulos'];
    }

    /**
     * Filtra módulos activos para el proyecto actual
     */
    private function loadActiveModules() {
        $activos = $this->config['modulos_activos'];
        $this->modulos_activos = array_filter($this->modulos_disponibles, function($modulo) use ($activos) {
            return in_array($modulo['id'], $activos);
        });

        // Ordenar por fase y prioridad
        usort($this->modulos_activos, function($a, $b) {
            if ($a['fase'] == $b['fase']) {
                return $a['nivel_prioridad'] - $b['nivel_prioridad'];
            }
            return $a['fase'] - $b['fase'];
        });
    }

    /**
     * Valida dependencias de módulos
     */
    public function validateDependencies() {
        $activos_ids = array_column($this->modulos_activos, 'id');
        $errores = [];

        foreach ($this->modulos_activos as $modulo) {
            foreach ($modulo['dependencias'] as $dep_id) {
                if (!in_array($dep_id, $activos_ids)) {
                    $errores[] = "Módulo {$modulo['id']} requiere {$dep_id} que no está activo";
                }
            }
        }

        return $errores;
    }

    /**
     * Genera el índice de contenidos según módulos activos
     */
    public function generateIndex() {
        $index = [];
        $page_number = 1;

        // Portada e índice siempre van primero
        $page_number += 2;

        foreach ($this->modulos_activos as $modulo) {
            $fase_nombre = $this->getFaseNombre($modulo['fase']);

            if (!isset($index[$fase_nombre])) {
                // Cover de sección
                $index[$fase_nombre] = [
                    'cover_page' => $page_number++,
                    'modulos' => []
                ];
            }

            $index[$fase_nombre]['modulos'][] = [
                'id' => $modulo['id'],
                'nombre' => $modulo['nombre'],
                'pagina_inicio' => $page_number,
                'pagina_fin' => $page_number + $modulo['paginas_generadas'] - 1
            ];

            $page_number += $modulo['paginas_generadas'];
        }

        return $index;
    }

    /**
     * Renderiza un módulo específico
     */
    public function renderModule($module_id) {
        $modulo = $this->getModuleById($module_id);
        if (!$modulo) {
            throw new Exception("Módulo $module_id no encontrado");
        }

        // Incluir el archivo PHP del módulo
        require_once __DIR__ . '/../' . $modulo['archivo_php'];

        // Cargar datos JSON si existen
        $data_file = __DIR__ . '/../' . $modulo['archivo_datos'];
        $data = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];

        // Renderizar páginas del módulo
        $render_function = 'render_' . str_replace('.', '_', $module_id);
        if (function_exists($render_function)) {
            return $render_function($data);
        }

        return null;
    }

    /**
     * Genera el informe completo
     */
    public function generateFullReport() {
        $html = '';

        // Portada
        $html .= $this->renderCover();

        // Índice
        $html .= $this->renderTableOfContents();

        // Módulos activos
        foreach ($this->modulos_activos as $modulo) {
            // Cover de sección (solo una vez por fase)
            if ($this->isFirstModuleInPhase($modulo)) {
                $html .= $this->renderPhaseCover($modulo['fase']);
            }

            // Páginas del módulo
            $html .= $this->renderModule($modulo['id']);
        }

        return $html;
    }

    // ... métodos auxiliares
}
```

---

## <a name="plan-trabajo"></a>📅 5. PLAN DE TRABAJO Y DISTRIBUCIÓN DE TIEMPO

### 5.1. Distribución de Tiempo por Tipo de Proyecto

#### Proyecto: **Corporativo Básico** (40-60 horas)

| Fase | Módulos | Horas | % Tiempo |
|------|---------|-------|----------|
| Preparación | Brief, Accesos, Roadmap | 5h | 10% |
| Keyword Research | Actuales, Competencia, Oportunidades | 13h | 25% |
| Datos Técnicos | 10 módulos básicos | 25h | 48% |
| Entregables | Resumen, Informe, Plan | 17h | 17% |
| **TOTAL** | **23 módulos** | **50h** | **100%** |

#### Proyecto: **Ecommerce Grande** (120-160 horas)

| Fase | Módulos | Horas | % Tiempo |
|------|---------|-------|----------|
| Marketing | 5 módulos completos | 28h | 20% |
| Preparación | Brief, Accesos, Roadmap | 5h | 4% |
| Keyword Research | 4 módulos completos | 18h | 13% |
| Arquitectura | 3 módulos completos | 20h | 14% |
| Datos Técnicos | 15 módulos completos | 50h | 36% |
| Entregables | 4 módulos completos | 19h | 13% |
| **TOTAL** | **34 módulos** | **140h** | **100%** |

---

### 5.2. Timeline Tipo (8 semanas - Proyecto Completo)

```
Semana 1: Preparación + Marketing (si aplica)
├─ Días 1-2: Brief + Accesos
├─ Días 3-5: Módulos Marketing (si activos)
└─ Fin semana: Roadmap ajustado

Semana 2: Keyword Research
├─ Días 1-2: Keywords actuales
├─ Días 3-4: Análisis competencia
└─ Día 5: Oportunidades + Quick review

Semana 3: Arquitectura (si aplica)
├─ Días 1-2: Arquitectura actual
├─ Días 3-4: Keyword mapping
└─ Día 5: Propuesta arquitectura

Semanas 4-6: Recopilación Datos (Fase 4)
├─ Semana 4: Módulos 4.1 a 4.5
├─ Semana 5: Módulos 4.6 a 4.10
└─ Semana 6: Módulos 4.11 a 4.15

Semana 7: Análisis y Síntesis
├─ Días 1-3: Consolidación datos
├─ Días 4-5: Priorización + Quick wins
└─ Fin semana: Primer borrador

Semana 8: Entregables
├─ Días 1-2: Resumen ejecutivo
├─ Días 3-4: Informe técnico + Plan acción
├─ Día 5: Revisión final + Entrega
└─ Follow-up: Presentación al cliente
```

---

### 5.3. Distribución de Esfuerzo por Rol

| Rol | Actividad Principal | % Tiempo | Fases Involucradas |
|-----|---------------------|----------|-------------------|
| **Estratega SEO** | Análisis, decisiones estratégicas, priorización | 30% | Todas |
| **Analista Técnico** | Crawling, análisis técnico, errores | 25% | Fase 4 |
| **Especialista Contenidos** | Keyword research, content audit | 20% | Fases 2, 4 |
| **Analista Datos** | Analytics, GSC, métricas | 15% | Fases 2, 4 |
| **Gestor Proyecto** | Coordinación, reporting, cliente | 10% | Todas |

---

## <a name="configuracion"></a>🔧 6. SISTEMA DE CONFIGURACIÓN

### 6.1. Interface de Configuración (Prototipo UI)

```
┌──────────────────────────────────────────────────┐
│  🎯 CONFIGURADOR DE AUDITORÍA SEO                │
├──────────────────────────────────────────────────┤
│                                                  │
│  1. INFORMACIÓN DEL PROYECTO                     │
│  ┌────────────────────────────────────────────┐ │
│  │ Nombre: [Ibiza Villa                    ] │ │
│  │ Dominio: [ibizavilla.com                ] │ │
│  │ Tipo de proyecto:                          │ │
│  │   ( ) Corporativo Básico                   │ │
│  │   (•) Corporativo Avanzado                 │ │
│  │   ( ) Ecommerce Pequeño                    │ │
│  │   ( ) Ecommerce Grande                     │ │
│  │   ( ) Portal de Contenidos                 │ │
│  │   ( ) Sitio Local                          │ │
│  │   ( ) SaaS/Software                        │ │
│  │   ( ) Marketplace                          │ │
│  └────────────────────────────────────────────┘ │
│                                                  │
│  2. MÓDULOS AUTOMÁTICOS (según tipo)             │
│  ✅ 23 módulos obligatorios cargados             │
│  ⚠️  5 módulos opcionales disponibles            │
│                                                  │
│  3. PERSONALIZAR MÓDULOS                         │
│  ┌────────────────────────────────────────────┐ │
│  │ FASE 0: MARKETING DIGITAL                  │ │
│  │ [✓] Análisis de Mercado         (5h)      │ │
│  │ [✓] Análisis Competencia        (7h)      │ │
│  │ [✓] Buyer Personas              (9h)      │ │
│  │ [ ] Estrategia Contenidos       (7h)      │ │
│  │ [ ] Canales Digitales           (5h)      │ │
│  │                                            │ │
│  │ FASE 1: PREPARACIÓN                        │ │
│  │ [✓] Brief Cliente               (2h) 🔒   │ │
│  │ [✓] Checklist Accesos           (1h) 🔒   │ │
│  │ [✓] Roadmap Auditoría           (2h) 🔒   │ │
│  │                                            │ │
│  │ ... (scroll para más fases)                │ │
│  └────────────────────────────────────────────┘ │
│                                                  │
│  4. RESUMEN                                      │
│  ┌────────────────────────────────────────────┐ │
│  │ Total módulos: 25                          │ │
│  │ Páginas estimadas: 87                      │ │
│  │ Tiempo estimado: 85-110 horas              │ │
│  │ Duración proyecto: 6-8 semanas             │ │
│  │ Precio referencia: €3,500 - €5,000         │ │
│  └────────────────────────────────────────────┘ │
│                                                  │
│  [Guardar Configuración]  [Generar Auditoría]   │
│                                                  │
└──────────────────────────────────────────────────┘
```

---

### 6.2. Flujo de Trabajo Completo

```
1. CONFIGURACIÓN
   ↓
   [Seleccionar tipo de proyecto]
   ↓
   [Cargar módulos automáticamente]
   ↓
   [Personalizar módulos opcionales]
   ↓
   [Validar dependencias]
   ↓
   [Guardar configuración]

2. PREPARACIÓN
   ↓
   [Ejecutar módulos de Fase 1]
   ↓
   [Verificar accesos herramientas]
   ↓
   [Aprobar roadmap con cliente]

3. EJECUCIÓN
   ↓
   [Procesar módulos por fases]
   ↓
   [Validar datos de cada módulo]
   ↓
   [Generar páginas HTML]

4. CONSOLIDACIÓN
   ↓
   [Integrar todos los módulos]
   ↓
   [Generar índice dinámico]
   ↓
   [Compilar documento final]

5. ENTREGA
   ↓
   [Exportar PDF]
   ↓
   [Generar versión interactiva]
   ↓
   [Presentación al cliente]
```

---

## 🎯 PRÓXIMOS PASOS

1. **Implementar estructura de carpetas** según arquitectura definida
2. **Migrar módulos existentes** a la nueva estructura modular
3. **Crear plantillas PHP** para cada tipo de módulo
4. **Desarrollar interfaz de configuración** (HTML + JS)
5. **Implementar `module_loader.php`** con toda la lógica
6. **Crear plantillas JSON de datos** para cada módulo
7. **Testear con diferentes tipos de proyecto**
8. **Documentar API de cada módulo**

---

**Versión:** 1.0
**Fecha:** 11 de Octubre de 2025
**Autor:** Sistema de Auditoría SEO Modular
