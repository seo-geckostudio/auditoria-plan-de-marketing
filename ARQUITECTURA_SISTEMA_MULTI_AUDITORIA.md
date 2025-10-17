# 🏗️ Arquitectura de Sistema Multi-Auditoría Configurable

**Fecha**: 2025-10-17
**Objetivo**: Diseñar sistema escalable para diferentes tipos de auditorías con configuración flexible de procesamiento, IA y visibilidad.

---

## 🎯 Requisitos del Sistema

### Escalabilidad
- ✅ Soportar múltiples tipos de auditoría (SEO, Accesibilidad, Rendimiento, Seguridad, UX)
- ✅ Añadir nuevos tipos sin modificar código base
- ✅ Configuración declarativa (JSON/YAML)

### Flexibilidad de Procesamiento
- ✅ Datos automáticos (calculados desde fuentes)
- ✅ Datos por IA (análisis con LLM)
- ✅ Datos manuales (input del auditor)
- ✅ Datos ocultos (procesamiento interno)
- ✅ Datos visibles (mostrados al cliente)

### Inteligencia
- ✅ Reglas de validación configurables
- ✅ Priorización automática
- ✅ Análisis contextual con IA
- ✅ Recomendaciones generadas

---

## 🗂️ Estructura de Configuración

### Archivo de Tipo de Auditoría

**Ubicación**: `config/tipos_auditoria/[tipo].json`

```json
{
  "tipo": "seo",
  "nombre": "Auditoría SEO",
  "version": "1.0",
  "descripcion": "Auditoría técnica y de contenido SEO completa",

  "fuentes_datos": {
    "screaming_frog": {
      "requerido": true,
      "formato": "json",
      "ubicacion": "data/screamingfrog/auditoria_{id}.json"
    },
    "google_analytics": {
      "requerido": true,
      "tipo": "api",
      "credenciales": "config/ga_credentials.json"
    },
    "ahrefs": {
      "requerido": false,
      "formato": "csv",
      "ubicacion": "data/ahrefs/auditoria_{id}/"
    }
  },

  "modulos": [
    {
      "id": "arquitectura",
      "nombre": "Arquitectura Web",
      "orden": 1,
      "habilitado": true,
      "campos": [...],
      "entregables": [...],
      "procesadores": [...]
    }
  ],

  "reglas_globales": {
    "prioridad": {
      "critica": { "trafico_min": 500, "impacto": "alto" },
      "muy_alta": { "trafico_min": 200, "impacto": "medio-alto" },
      "alta": { "trafico_min": 50, "impacto": "medio" }
    }
  }
}
```

---

## 📊 Sistema de Campos Configurables

### Definición de Campo

```json
{
  "id": "urls_huerfanas",
  "nombre": "URLs Huérfanas",
  "tipo_dato": "array",
  "tipo_procesamiento": "automatico",
  "visibilidad": "visible",
  "editable": false,

  "fuente": {
    "origen": "screaming_frog",
    "procesador": "FiltrarURLsHuerfanas"
  },

  "validaciones": [
    {
      "tipo": "rango",
      "campo": "count",
      "min": 0,
      "max": 10000,
      "mensaje": "Número de URLs fuera de rango esperado"
    }
  ],

  "presentacion": {
    "formato": "tabla",
    "columnas": ["url", "trafico", "prioridad", "accion"],
    "ordenar_por": "prioridad_desc"
  },

  "entregable": {
    "generar_csv": true,
    "nombre_archivo": "urls_huerfanas_corregir.csv",
    "incluir_en_resumen": true
  }
}
```

### Tipos de Procesamiento

```json
{
  "tipos_procesamiento": {
    "automatico": {
      "descripcion": "Calculado desde fuentes de datos",
      "requiere_input": false,
      "procesador": "PHP_Class::metodo",
      "cache": true,
      "cache_duracion": 86400
    },

    "ia": {
      "descripcion": "Analizado por modelo de lenguaje",
      "requiere_input": false,
      "modelo": "claude-3-5-sonnet",
      "prompt_template": "prompts/analizar_{campo}.txt",
      "temperatura": 0.3,
      "max_tokens": 4000,
      "cache": true
    },

    "ia_asistido": {
      "descripcion": "IA genera propuesta, auditor revisa",
      "requiere_input": "revision",
      "modelo": "claude-3-5-sonnet",
      "editable": true,
      "guardado_automatico": true
    },

    "manual": {
      "descripcion": "Input manual del auditor",
      "requiere_input": true,
      "tipo_input": "textarea|select|number|file",
      "validacion_requerida": true
    },

    "hibrido": {
      "descripcion": "Automático con override manual",
      "valor_default": "automatico",
      "permite_override": true,
      "guarda_ambos": true
    }
  }
}
```

### Niveles de Visibilidad

```json
{
  "visibilidad": {
    "visible": {
      "descripcion": "Mostrado al cliente en informe",
      "incluir_en_pdf": true,
      "incluir_en_web": true
    },

    "visible_resumen": {
      "descripcion": "Solo en resumen ejecutivo",
      "incluir_en_pdf": true,
      "incluir_en_web": false
    },

    "interno": {
      "descripcion": "Visible para auditor, no para cliente",
      "incluir_en_pdf": false,
      "incluir_en_web": false,
      "panel_auditor": true
    },

    "oculto": {
      "descripcion": "Solo para procesamiento interno",
      "incluir_en_pdf": false,
      "incluir_en_web": false,
      "panel_auditor": false
    }
  }
}
```

---

## 🤖 Sistema de Procesadores

### Arquitectura de Procesadores

```php
/**
 * Interfaz base para procesadores
 */
interface IAuditoriaProcessor {
    public function procesar($datos, $config, $contexto);
    public function validar($resultado);
    public function getCacheDuration();
}

/**
 * Procesador Automático
 */
class AutomaticProcessor implements IAuditoriaProcessor {
    public function procesar($datos, $config, $contexto) {
        // Lógica de procesamiento determinista
        $resultado = $this->aplicarReglas($datos, $config['reglas']);
        return $resultado;
    }
}

/**
 * Procesador IA
 */
class AIProcessor implements IAuditoriaProcessor {
    private $aiProvider; // Claude, GPT, etc.

    public function procesar($datos, $config, $contexto) {
        $prompt = $this->construirPrompt($datos, $config);
        $resultado = $this->aiProvider->analyze($prompt, $config['parametros_ia']);

        return [
            'analisis' => $resultado,
            'confianza' => $resultado['confidence'],
            'timestamp' => time(),
            'modelo' => $config['modelo']
        ];
    }
}

/**
 * Procesador Híbrido
 */
class HybridProcessor implements IAuditoriaProcessor {
    private $autoProcessor;
    private $aiProcessor;

    public function procesar($datos, $config, $contexto) {
        // 1. Procesar automáticamente
        $resultadoAuto = $this->autoProcessor->procesar($datos, $config, $contexto);

        // 2. Si hay casos complejos, usar IA
        $casoComplejos = $this->detectarComplejidad($resultadoAuto);

        if (!empty($casoComplejos)) {
            $resultadoIA = $this->aiProcessor->procesar($casoComplejos, $config, $contexto);
            $resultadoAuto = $this->merge($resultadoAuto, $resultadoIA);
        }

        return $resultadoAuto;
    }
}
```

---

## 🧩 Ejemplo: Configuración Completa de Módulo

### Módulo de Arquitectura SEO

```json
{
  "modulo": {
    "id": "arquitectura",
    "nombre": "Análisis de Arquitectura Web",
    "descripcion": "Evalúa estructura, navegación y crawl efficiency",
    "icono": "🏗️",
    "orden": 1,

    "campos": [
      {
        "id": "urls_huerfanas",
        "nombre": "URLs Huérfanas",
        "tipo_dato": "array",
        "tipo_procesamiento": "automatico",
        "visibilidad": "visible",

        "fuente": {
          "origen": "screaming_frog.internal",
          "procesador": "ArquitecturaProcessor::filtrarURLsHuerfanas"
        },

        "reglas_filtrado": {
          "inlinks": 0,
          "status_code": 200,
          "indexability": "Indexable"
        },

        "enriquecimiento": [
          {
            "tipo": "automatico",
            "fuente": "google_analytics",
            "campo": "ga_sessions",
            "asignar_a": "trafico_mensual"
          },
          {
            "tipo": "ia",
            "procesador": "AIProcessor::generarAccionRecomendada",
            "prompt": "Analiza la URL {url} y sugiere desde qué página enlazarla y qué acción tomar",
            "modelo": "claude-3-5-sonnet",
            "temperatura": 0.3
          }
        ],

        "priorizacion": {
          "tipo": "automatico",
          "reglas": [
            {
              "condicion": "trafico_mensual > 500",
              "prioridad": "Crítica"
            },
            {
              "condicion": "trafico_mensual > 200",
              "prioridad": "Muy Alta"
            },
            {
              "condicion": "trafico_mensual > 50",
              "prioridad": "Alta"
            }
          ]
        },

        "entregable": {
          "tipo": "csv",
          "nombre": "urls_huerfanas_corregir.csv",
          "columnas": [
            "URL",
            "Profundidad_Actual",
            "Trafico_Mensual",
            "Prioridad",
            "Pagina_Desde_Enlazar",
            "Accion_Recomendada"
          ],
          "ordenar_por": "Prioridad DESC, Trafico_Mensual DESC"
        }
      },

      {
        "id": "estructura_propuesta",
        "nombre": "Estructura Propuesta",
        "tipo_dato": "object",
        "tipo_procesamiento": "ia_asistido",
        "visibilidad": "visible",

        "procesador_ia": {
          "modelo": "claude-3-5-sonnet",
          "prompt_template": "prompts/proponer_estructura.txt",
          "inputs": [
            "screaming_frog.internal",
            "google_analytics.page_hierarchy",
            "ahrefs.top_pages"
          ],
          "temperatura": 0.5,
          "max_tokens": 8000
        },

        "revision_manual": {
          "requerida": true,
          "campos_editables": ["categorias", "subcategorias", "estructura_urls"],
          "guardado_automatico": true
        }
      },

      {
        "id": "metricas_internas",
        "nombre": "Métricas de Procesamiento",
        "tipo_dato": "object",
        "tipo_procesamiento": "automatico",
        "visibilidad": "oculto",

        "uso": "Métricas para algoritmos internos de priorización"
      }
    ],

    "seccion_educativa": {
      "habilitada": true,
      "tipo": "template",
      "template": "templates/educativo_arquitectura.php",

      "contenido": {
        "concepto": "¿Qué es la Arquitectura Web?",
        "analogia": "Edificio con pisos y habitaciones",
        "beneficios": ["Mejor crawl efficiency", "Mayor visibilidad", "Mejor UX"],
        "riesgos": ["Páginas huérfanas invisibles", "Desperdicio de crawl budget"]
      }
    }
  }
}
```

---

## 🎨 Ejemplos de Configuración por Tipo

### Auditoría de Accesibilidad

```json
{
  "tipo": "accesibilidad",
  "nombre": "Auditoría de Accesibilidad WCAG 2.1",

  "fuentes_datos": {
    "axe_core": {
      "requerido": true,
      "tipo": "automatico",
      "herramienta": "axe-core"
    },
    "lighthouse": {
      "requerido": true,
      "tipo": "automatico",
      "categoria": "accessibility"
    },
    "manual_testing": {
      "requerido": true,
      "tipo": "manual"
    }
  },

  "modulos": [
    {
      "id": "wcag_nivel_a",
      "nombre": "Cumplimiento WCAG 2.1 Nivel A",

      "campos": [
        {
          "id": "imagenes_sin_alt",
          "tipo_procesamiento": "automatico",
          "visibilidad": "visible",
          "fuente": "axe_core.image-alt",

          "enriquecimiento": [
            {
              "tipo": "ia",
              "procesador": "AIProcessor::generarAltTextRecomendado",
              "prompt": "Analiza la imagen en contexto y sugiere alt text apropiado",
              "modelo": "claude-3-5-sonnet-vision"
            }
          ]
        },

        {
          "id": "contraste_colores",
          "tipo_procesamiento": "automatico",
          "visibilidad": "visible",
          "fuente": "axe_core.color-contrast",

          "validacion_adicional": {
            "tipo": "manual",
            "razon": "Casos edge requieren validación humana"
          }
        },

        {
          "id": "navegacion_teclado",
          "tipo_procesamiento": "manual",
          "visibilidad": "visible",

          "guia_testing": {
            "pasos": [
              "Usar solo teclado para navegar",
              "Verificar orden lógico de tabulación",
              "Comprobar visibilidad de foco"
            ]
          }
        }
      ]
    }
  ]
}
```

### Auditoría de Rendimiento

```json
{
  "tipo": "rendimiento",
  "nombre": "Auditoría de Rendimiento Web",

  "fuentes_datos": {
    "lighthouse": {
      "requerido": true,
      "categorias": ["performance"]
    },
    "webpagetest": {
      "requerido": false,
      "ubicacion": "data/webpagetest/"
    },
    "chrome_ux_report": {
      "requerido": false,
      "tipo": "api"
    }
  },

  "modulos": [
    {
      "id": "core_web_vitals",
      "nombre": "Core Web Vitals",

      "campos": [
        {
          "id": "lcp_urls",
          "nombre": "URLs con LCP > 2.5s",
          "tipo_procesamiento": "automatico",

          "enriquecimiento": [
            {
              "tipo": "ia",
              "procesador": "AIProcessor::analizarCausasLCP",
              "prompt": "Analiza los recursos críticos y sugiere optimizaciones para mejorar LCP"
            }
          ]
        },

        {
          "id": "optimizacion_imagenes",
          "tipo_procesamiento": "hibrido",

          "procesador_automatico": "calcularAhorroCompresion",
          "procesador_ia": "sugerirFormatosModernos",

          "entregable": {
            "tipo": "csv",
            "nombre": "imagenes_optimizar.csv",
            "incluye": ["url_imagen", "tamano_actual", "tamano_optimizado", "ahorro_kb"]
          }
        }
      ]
    }
  ]
}
```

---

## 🔌 API de Configuración

### Cargar Tipo de Auditoría

```php
class AuditoriaConfigManager {

    /**
     * Carga configuración de un tipo de auditoría
     */
    public function cargarTipo($tipo) {
        $configFile = __DIR__ . "/config/tipos_auditoria/{$tipo}.json";

        if (!file_exists($configFile)) {
            throw new Exception("Tipo de auditoría '{$tipo}' no encontrado");
        }

        $config = json_decode(file_get_contents($configFile), true);

        // Validar esquema
        $this->validarEsquema($config);

        // Cargar procesadores
        $this->cargarProcesadores($config);

        return new AuditoriaConfig($config);
    }

    /**
     * Lista tipos disponibles
     */
    public function listarTipos() {
        $files = glob(__DIR__ . "/config/tipos_auditoria/*.json");
        $tipos = [];

        foreach ($files as $file) {
            $config = json_decode(file_get_contents($file), true);
            $tipos[] = [
                'id' => $config['tipo'],
                'nombre' => $config['nombre'],
                'version' => $config['version'],
                'descripcion' => $config['descripcion']
            ];
        }

        return $tipos;
    }
}
```

### Procesar Campo

```php
class CampoProcessor {

    public function procesarCampo($campo, $datos, $contexto) {
        $tipoProcesamiento = $campo['tipo_procesamiento'];

        switch ($tipoProcesamiento) {
            case 'automatico':
                return $this->procesarAutomatico($campo, $datos);

            case 'ia':
                return $this->procesarIA($campo, $datos, $contexto);

            case 'ia_asistido':
                $propuesta = $this->procesarIA($campo, $datos, $contexto);
                return $this->solicitarRevision($propuesta, $campo);

            case 'manual':
                return $this->solicitarInput($campo);

            case 'hibrido':
                $valorAuto = $this->procesarAutomatico($campo, $datos);
                return $this->permitirOverride($valorAuto, $campo);
        }
    }

    private function procesarIA($campo, $datos, $contexto) {
        $aiConfig = $campo['procesador_ia'];

        // Construir prompt
        $prompt = $this->construirPrompt($aiConfig['prompt_template'], $datos, $contexto);

        // Llamar a IA
        $aiProvider = new ClaudeAIProvider();
        $resultado = $aiProvider->analyze([
            'prompt' => $prompt,
            'model' => $aiConfig['modelo'],
            'temperature' => $aiConfig['temperatura'] ?? 0.3,
            'max_tokens' => $aiConfig['max_tokens'] ?? 4000
        ]);

        // Cachear resultado
        if ($campo['cache'] ?? true) {
            $this->cache->set("ia_{$campo['id']}_{$contexto['auditoria_id']}", $resultado, 86400);
        }

        return $resultado;
    }
}
```

---

## 📋 Workflow de Auditoría Configurable

### Flujo General

```
1. Seleccionar Tipo de Auditoría
   ↓
2. Cargar Configuración
   ↓
3. Recopilar Fuentes de Datos
   ├─ Automáticas (APIs, crawlers)
   ├─ Manuales (uploads de auditor)
   └─ Generadas (análisis IA)
   ↓
4. Procesar Módulos Secuencialmente
   Para cada módulo:
     Para cada campo:
       ├─ Si es automático → calcular
       ├─ Si es IA → analizar con LLM
       ├─ Si es manual → solicitar input
       └─ Si es híbrido → calcular + permitir override
   ↓
5. Generar Entregables
   ├─ CSVs configurados
   ├─ Informe PDF
   └─ Vista web interactiva
   ↓
6. Validar Completitud
   ↓
7. Publicar/Entregar
```

---

## 🎯 Casos de Uso Reales

### Caso 1: Auditor Quiere Añadir Campo IA

```json
{
  "id": "analisis_semantico_contenido",
  "nombre": "Análisis Semántico de Contenido",
  "tipo_procesamiento": "ia",
  "visibilidad": "visible",

  "procesador_ia": {
    "modelo": "claude-3-5-sonnet",
    "prompt_template": "prompts/analizar_contenido_semantico.txt",
    "inputs": [
      "screaming_frog.internal.title",
      "screaming_frog.internal.meta_description",
      "screaming_frog.internal.h1",
      "scraped_content.body_text"
    ],
    "outputs": {
      "tematica_principal": "string",
      "keywords_detectadas": "array",
      "calidad_contenido": "number",
      "recomendaciones": "array"
    }
  },

  "cache": true,
  "cache_duracion": 604800
}
```

### Caso 2: Diferentes Niveles de Automatización por Cliente

```json
{
  "perfiles_cliente": {
    "basico": {
      "ia_habilitada": false,
      "procesamiento": "automatico",
      "visibilidad_predeterminada": "visible"
    },

    "profesional": {
      "ia_habilitada": true,
      "procesamiento": "hibrido",
      "revision_manual": false
    },

    "enterprise": {
      "ia_habilitada": true,
      "procesamiento": "ia_asistido",
      "revision_manual": true,
      "datos_internos_visibles": true
    }
  }
}
```

---

## 📊 Dashboard de Configuración

### Panel de Administración

Interfaz web para:
- ✅ Crear/editar tipos de auditoría
- ✅ Configurar módulos y campos
- ✅ Testear procesadores
- ✅ Ver logs de IA
- ✅ Gestionar prompts
- ✅ Monitorear costos de API IA

---

## 🚀 Próximos Pasos

1. **Implementar sistema de configuración** (JSON schema validation)
2. **Crear procesadores base** (Automático, IA, Manual, Híbrido)
3. **Integrar Claude AI** para procesamiento IA
4. **Migrar auditoría SEO actual** a configuración
5. **Crear auditoría de accesibilidad** como prueba
6. **Desarrollar panel de configuración** web

---

**Última actualización**: 2025-10-17
**Versión**: 1.0 (Diseño)
**Estado**: Propuesta de arquitectura
