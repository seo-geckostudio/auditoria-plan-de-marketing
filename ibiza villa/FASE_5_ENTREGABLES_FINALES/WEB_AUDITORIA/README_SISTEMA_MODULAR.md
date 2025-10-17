# 🧩 Sistema Modular de Auditoría SEO

## 📋 Índice

1. [Introducción](#introducción)
2. [Arquitectura del Sistema](#arquitectura-del-sistema)
3. [Instalación y Configuración](#instalación-y-configuración)
4. [Uso del ModuleLoader](#uso-del-moduleloader)
5. [Creación de Nuevos Módulos](#creación-de-nuevos-módulos)
6. [Tipos de Plantillas](#tipos-de-plantillas)
7. [Perfiles de Proyecto](#perfiles-de-proyecto)
8. [Testing y Validación](#testing-y-validación)
9. [Ejemplos Prácticos](#ejemplos-prácticos)

---

## 🎯 Introducción

El **Sistema Modular de Auditoría SEO** es una arquitectura flexible que permite generar auditorías SEO personalizadas según el tipo de proyecto. Cada auditoría se compone de módulos independientes que pueden activarse o desactivarse según las necesidades del cliente.

### Características Principales

- ✅ **34 módulos** distribuidos en 5 fases de auditoría
- ✅ **8 perfiles de proyecto** predefinidos (corporativo, ecommerce, portal, etc.)
- ✅ **5 tipos de plantillas** para diferentes formatos de página
- ✅ **Validación automática** de dependencias entre módulos
- ✅ **Estimación de tiempos y costes** según módulos activos
- ✅ **Sistema de carga dinámica** mediante PHP

---

## 🏗️ Arquitectura del Sistema

### Estructura de Carpetas

```
WEB_AUDITORIA/
├── config/                              # Configuración JSON
│   ├── modulos_disponibles.json         # Catálogo de módulos
│   ├── perfiles_proyecto.json           # Perfiles predefinidos
│   └── configuracion_cliente.json       # Config del proyecto actual
│
├── modulos/                             # Módulos PHP por fase
│   ├── fase0_marketing/
│   ├── fase1_preparacion/
│   ├── fase2_keyword_research/
│   ├── fase3_arquitectura/
│   ├── fase4_recopilacion_datos/
│   └── fase5_entregables/
│
├── templates/                           # Plantillas reutilizables
│   ├── template_modulo_metricas.php
│   ├── template_modulo_ranking.php
│   ├── template_modulo_analisis_tecnico.php
│   ├── template_modulo_comparativa.php
│   └── template_modulo_dafo.php
│
├── includes/                            # Clases y utilidades
│   └── module_loader.php                # Clase principal ModuleLoader
│
├── data/                                # Datos JSON por módulo
│   ├── fase0/
│   ├── fase1/
│   ├── fase2/
│   └── ...
│
└── test_module_loader.php               # Página de prueba del sistema
```

### Componentes Principales

1. **ModuleLoader.php**: Clase que gestiona la carga dinámica de módulos
2. **Archivos JSON de configuración**: Definen módulos, perfiles y configuración del cliente
3. **Plantillas PHP**: Templates reutilizables para diferentes tipos de páginas
4. **Módulos**: Archivos PHP individuales que generan secciones de la auditoría

---

## 🔧 Instalación y Configuración

### Paso 1: Verificar Estructura

Asegúrate de que existan las carpetas necesarias:

```bash
mkdir -p config modulos/fase0_marketing modulos/fase1_preparacion
mkdir -p modulos/fase2_keyword_research modulos/fase3_arquitectura
mkdir -p modulos/fase4_recopilacion_datos modulos/fase5_entregables
mkdir -p templates includes data
```

### Paso 2: Configurar Archivos JSON

#### A. `config/modulos_disponibles.json`

Define todos los módulos disponibles en el sistema:

```json
{
  "version": "1.0",
  "last_updated": "2025-10-11",
  "modulos": [
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
    }
  ]
}
```

#### B. `config/perfiles_proyecto.json`

Define los 8 perfiles de proyecto:

```json
{
  "perfiles": {
    "corporativo_basico": {
      "nombre": "Corporativo Básico",
      "descripcion": "Web corporativa simple (<20 páginas)",
      "icono": "🏢",
      "modulos_obligatorios": ["m1.1", "m1.2", "m1.3", ...],
      "modulos_opcionales": ["m0.1", "m0.2"],
      "tiempo_total_min_horas": 40,
      "tiempo_total_max_horas": 60,
      "precio_referencia_min": 1500,
      "precio_referencia_max": 2500,
      "duracion_semanas": "4-6"
    }
  }
}
```

#### C. `config/configuracion_cliente.json`

Configuración específica del proyecto actual:

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
    "m1.1", "m1.2", "m1.3",
    "m2.1", "m2.2", "m2.3",
    "m4.1", "m4.3"
  ]
}
```

### Paso 3: Incluir ModuleLoader

En tu archivo PHP principal:

```php
<?php
require_once 'includes/module_loader.php';

$loader = new ModuleLoader('./config/');
```

---

## 🚀 Uso del ModuleLoader

### Métodos Principales

#### 1. Inicialización

```php
$loader = new ModuleLoader('./config/');

// Verificar errores
if ($loader->tieneErrores()) {
    $errores = $loader->obtenerErrores();
    // Manejar errores
}
```

#### 2. Obtener Información del Proyecto

```php
// Obtener perfil actual
$perfil = $loader->obtenerPerfilActual();

// Obtener configuración del cliente
$config = $loader->obtenerConfiguracionCliente();

// Obtener información de un módulo específico
$modulo = $loader->obtenerModulo('m1.1');
```

#### 3. Validar Dependencias

```php
$validacion = $loader->validarDependencias();

if (!$validacion['valido']) {
    foreach ($validacion['errores'] as $error) {
        echo $error;
    }
}
```

#### 4. Obtener Estadísticas

```php
$stats = $loader->calcularEstadisticas();

echo "Total módulos: " . $stats['total_modulos'];
echo "Total páginas: " . $stats['total_paginas'];
echo "Total horas: " . $stats['total_horas'];
```

#### 5. Renderizar Módulos

```php
// Renderizar un módulo específico
echo $loader->renderizarModulo('m1.1');

// Renderizar todos los módulos activos
echo $loader->renderizarTodosModulos();

// Obtener módulos organizados por fase
$fases = $loader->obtenerModulosPorFase();
```

#### 6. Exportar Configuración

```php
// Como JSON
$json = $loader->exportarConfiguracion();

// Como array
$reporte = $loader->generarReporteConfiguracion();
```

---

## 🆕 Creación de Nuevos Módulos

### Paso 1: Definir el Módulo en JSON

Agregar al archivo `config/modulos_disponibles.json`:

```json
{
  "id": "m2.5",
  "fase": 2,
  "nombre": "Análisis de Long Tail",
  "descripcion": "Keywords de cola larga con bajo volumen y alta conversión",
  "archivo_php": "modulos/fase2_keyword_research/04_long_tail.php",
  "archivo_datos": "data/fase2/long_tail.json",
  "paginas_generadas": 3,
  "dependencias": ["m2.1", "m2.3"],
  "herramientas_requeridas": ["Ahrefs", "Answer the Public"],
  "tiempo_estimado_horas": 6,
  "nivel_prioridad": 2,
  "tipos_proyecto": ["ecommerce_pequeno", "ecommerce_grande", "saas"]
}
```

### Paso 2: Crear el Archivo PHP del Módulo

Crear `modulos/fase2_keyword_research/04_long_tail.php`:

```php
<?php
/**
 * Módulo: Análisis de Long Tail
 */

// $datosModulo viene del archivo JSON en data/fase2/long_tail.json

// Opción A: Usar plantilla existente
include 'templates/template_modulo_ranking.php';

// Opción B: Código personalizado
?>
<div class="audit-page">
    <div class="page-header">
        <h1><?php echo $datosModulo['titulo']; ?></h1>
    </div>
    <div class="page-body">
        <!-- Tu HTML personalizado aquí -->
    </div>
</div>
```

### Paso 3: Crear el Archivo de Datos JSON

Crear `data/fase2/long_tail.json`:

```json
{
  "titulo": "Análisis de Keywords Long Tail",
  "subtitulo": "Oportunidades de cola larga",
  "rankings": [
    {
      "titulo": "Top 20 Long Tail Keywords",
      "tipo": "tabla",
      "columnas": ["Keyword", "Volumen", "Dificultad", "Potencial"],
      "datos": [
        ["alquiler villas lujo ibiza con piscina", 120, 25, "Alto"],
        ["casas verano ibiza playa talamanca", 90, 20, "Alto"]
      ]
    }
  ]
}
```

### Paso 4: Activar el Módulo

Agregar el ID a `config/configuracion_cliente.json`:

```json
{
  "modulos_activos": [
    "m1.1", "m1.2", "m2.1", "m2.5"
  ]
}
```

---

## 📄 Tipos de Plantillas

### 1. **template_modulo_metricas.php**

Para páginas con KPIs, métricas y gráficas temporales.

**Uso ideal:**
- Tráfico orgánico histórico
- Evolución de rankings
- Métricas de rendimiento

**Variables requeridas:**
```php
$datosModulo = [
    'titulo' => 'Tráfico Orgánico',
    'subtitulo' => 'Últimos 12 meses',
    'periodo' => 'Oct 2024 - Sep 2025',
    'metricas' => [
        ['label' => 'Sesiones', 'valor' => '9,768', 'variacion' => 12.5]
    ],
    'graficas' => [
        [
            'titulo' => 'Evolución mensual',
            'tipo' => 'line',
            'labels' => ['Oct', 'Nov', 'Dic'],
            'datasets' => [...]
        ]
    ]
];
```

### 2. **template_modulo_ranking.php**

Para rankings, top N, listas ordenadas.

**Uso ideal:**
- Top 10 keywords
- Ranking de países
- Páginas más visitadas

**Variables requeridas:**
```php
$datosModulo = [
    'titulo' => 'Top 10 Keywords',
    'rankings' => [
        [
            'titulo' => 'Keywords por tráfico',
            'tipo' => 'tabla', // o 'barras', 'lista'
            'columnas' => ['Keyword', 'Posición', 'Tráfico'],
            'datos' => [...]
        ]
    ]
];
```

### 3. **template_modulo_analisis_tecnico.php**

Para análisis técnicos con errores, advertencias y recomendaciones.

**Uso ideal:**
- Errores 404
- Problemas de indexación
- Issues de Core Web Vitals

**Variables requeridas:**
```php
$datosModulo = [
    'titulo' => 'Análisis de Errores 404',
    'resumen' => [
        'total_errores' => 45,
        'total_advertencias' => 12,
        'puntuacion' => 65
    ],
    'problemas' => [
        [
            'titulo' => 'URLs con 404',
            'severidad' => 'alto',
            'descripcion' => 'Se encontraron 45 enlaces rotos',
            'cantidad' => 45,
            'urls' => [...]
        ]
    ],
    'recomendaciones' => [...]
];
```

### 4. **template_modulo_comparativa.php**

Para comparaciones entre períodos, competidores o segmentos.

**Uso ideal:**
- Antes vs Después
- Competencia vs Sitio
- Móvil vs Desktop

**Variables requeridas:**
```php
$datosModulo = [
    'titulo' => 'Comparativa Dispositivos',
    'tipo' => 'temporal', // o 'competidores', 'segmentos'
    'comparaciones' => [
        [
            'titulo' => 'Móvil vs Desktop',
            'formato' => 'tabla', // o 'grafica', 'tarjetas', 'antes_despues'
            'columnas' => ['Móvil', 'Desktop'],
            'filas' => [...]
        ]
    ]
];
```

### 5. **template_modulo_dafo.php**

Para análisis DAFO, estrategias y roadmaps.

**Uso ideal:**
- Análisis DAFO
- Estrategias SEO
- Plan de acción

**Variables requeridas:**
```php
$datosModulo = [
    'titulo' => 'Análisis DAFO SEO',
    'dafo' => [
        'fortalezas' => ['Contenido de calidad', 'Buena velocidad'],
        'debilidades' => ['Pocos backlinks', 'Mobile lento'],
        'oportunidades' => ['Keywords sin explotar'],
        'amenazas' => ['Competencia fuerte']
    ],
    'estrategias' => [
        'ofensivas' => [...],
        'defensivas' => [...]
    ],
    'roadmap' => [...]
];
```

---

## 🎨 Perfiles de Proyecto

### 8 Perfiles Predefinidos

| Perfil | Módulos | Horas | Páginas | Precio |
|--------|---------|-------|---------|--------|
| **🏢 Corporativo Básico** | 12 | 40-60h | 45 | 1,500-2,500€ |
| **🏛️ Corporativo Avanzado** | 17 | 70-90h | 75 | 2,800-4,200€ |
| **🛒 Ecommerce Pequeño** | 18 | 85-110h | 90 | 3,500-5,000€ |
| **🏬 Ecommerce Grande** | 18 | 120-160h | 110 | 5,000-8,000€ |
| **📰 Portal de Contenidos** | 16 | 75-95h | 85 | 3,000-4,500€ |
| **📍 Negocio Local** | 12 | 35-50h | 40 | 1,200-2,000€ |
| **💻 SaaS/Software** | 18 | 95-120h | 95 | 4,000-6,000€ |
| **🏪 Marketplace** | 18 | 140-180h | 120 | 6,000-10,000€ |

### Cambiar de Perfil

Editar `config/configuracion_cliente.json`:

```json
{
  "proyecto": {
    "tipo_perfil": "ecommerce_pequeno"
  }
}
```

El sistema automáticamente:
- ✅ Carga los módulos correspondientes
- ✅ Calcula nuevas estimaciones de tiempo
- ✅ Ajusta el precio de referencia
- ✅ Valida las dependencias

---

## ✅ Testing y Validación

### Página de Prueba

Accede a `test_module_loader.php` para:

- Ver información del proyecto
- Validar dependencias
- Revisar estadísticas
- Ver módulos por fase
- Exportar configuración JSON

### Validación Manual

```php
$loader = new ModuleLoader();

// 1. Verificar errores de carga
if ($loader->tieneErrores()) {
    print_r($loader->obtenerErrores());
}

// 2. Validar dependencias
$validacion = $loader->validarDependencias();
if (!$validacion['valido']) {
    print_r($validacion['errores']);
}

// 3. Verificar que existan archivos PHP
$modulos = $loader->obtenerModulosPorFase();
foreach ($modulos as $fase) {
    foreach ($fase['modulos'] as $modulo) {
        if (!file_exists($modulo['archivo_php'])) {
            echo "FALTA: " . $modulo['archivo_php'];
        }
    }
}
```

---

## 💡 Ejemplos Prácticos

### Ejemplo 1: Generar Auditoría Completa

```php
require_once 'includes/module_loader.php';

$loader = new ModuleLoader();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Auditoría SEO - <?php echo $loader->obtenerConfiguracionCliente()['proyecto']['nombre']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <?php echo $loader->renderizarTodosModulos(); ?>
</body>
</html>
```

### Ejemplo 2: Renderizar Solo Una Fase

```php
$loader = new ModuleLoader();
$fases = $loader->obtenerModulosPorFase();

// Renderizar solo Fase 2: Keyword Research
foreach ($fases[2]['modulos'] as $modulo) {
    echo $loader->renderizarModulo($modulo['id']);
}
```

### Ejemplo 3: Dashboard de Proyecto

```php
$loader = new ModuleLoader();
$stats = $loader->calcularEstadisticas();
?>
<div class="dashboard">
    <h1>Dashboard del Proyecto</h1>
    <div class="stats-grid">
        <div class="stat-card">
            <h3><?php echo $stats['total_modulos']; ?></h3>
            <p>Módulos Activos</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $stats['total_horas']; ?>h</h3>
            <p>Tiempo Estimado</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $stats['total_paginas']; ?></h3>
            <p>Páginas Totales</p>
        </div>
    </div>
</div>
```

---

## 📚 Recursos Adicionales

- **SISTEMA_MODULAR_AUDITORIA.md**: Especificación técnica completa
- **GUIA_DISENO_PAGINAS_AUDITORIA.md**: Guía de diseño de páginas
- **test_module_loader.php**: Página de prueba interactiva

---

## 🤝 Contribuir

Para agregar nuevos módulos o perfiles:

1. Definir módulo en `config/modulos_disponibles.json`
2. Crear archivo PHP en `modulos/fase*/`
3. Crear archivo de datos en `data/fase*/`
4. Probar con `test_module_loader.php`
5. Documentar en este README

---

**Última actualización:** 11 de Octubre de 2025
**Versión del sistema:** 1.0
