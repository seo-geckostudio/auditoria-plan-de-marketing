# Marketing Control Panel - Arquitectura con IA Integrada

**Versión:** 2.0 (Extensión con IA como Motor de Decisión)
**Fecha:** 2025-01-24
**Para:** Migue (Dios)
**Complementa:** ESPECIFICACION_MARKETING_CONTROL_PANEL.md

---

## 📋 Índice

1. [Cambio de Paradigma](#cambio-de-paradigma)
2. [Arquitectura de IA Integrada](#arquitectura-de-ia-integrada)
3. [Flujo Principal: Brief → Plan → Auditoría (IA-Driven)](#flujo-principal-ia-driven)
4. [Sistema Multi-Idioma](#sistema-multi-idioma)
5. [Auditorías Pre-Desarrollo vs Post-Desarrollo](#auditorías-pre-vs-post-desarrollo)
6. [Integración con Odoo](#integración-con-odoo)
7. [Módulo: IA Service (Core)](#módulo-ia-service-core)
8. [Casos de Uso de IA en el Sistema](#casos-de-uso-ia)
9. [Actualización del Roadmap](#actualización-roadmap)

---

## 1. Cambio de Paradigma

### 1.1. De "IA para Desarrollar" a "IA como Motor Operativo"

**ANTES (especificación original):**
```
.claude/           → IA ayuda a DESARROLLAR la app
src/               → Aplicación PHP con lógica programada
```

**AHORA (nueva arquitectura):**
```
.claude/           → IA ayuda a DESARROLLAR la app
src/
  ├── Core/
  │   └── AIService/   → IA DENTRO de la app (motor de decisión)
  │       ├── ClaudeProvider.php
  │       ├── OpenAIProvider.php
  │       └── AIProviderInterface.php
  ├── Modules/
  │   ├── AuditoriaSEO/
  │   │   └── Agents/
  │   │       ├── AnalistaAgent.php     → USA AIService
  │   │       ├── ArquitectoAgent.php   → USA AIService
  │   │       └── OperadorAgent.php     → USA AIService
```

### 1.2. Diagrama de Arquitectura Actualizado

```
┌─────────────────────────────────────────────────────────────────┐
│                   MARKETING CONTROL PANEL (PHP)                 │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │                  AI SERVICE (Core)                       │  │
│  │  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐  │  │
│  │  │   Claude     │  │   OpenAI     │  │   Gemini     │  │  │
│  │  │   Provider   │  │   Provider   │  │   Provider   │  │  │
│  │  └──────────────┘  └──────────────┘  └──────────────┘  │  │
│  │          ↑                 ↑                 ↑          │  │
│  │          └─────────────────┴─────────────────┘          │  │
│  │                AIProviderInterface                       │  │
│  └──────────────────────┬───────────────────────────────────┘  │
│                         ↓                                       │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │           MÓDULOS QUE USAN IA                            │  │
│  │                                                           │  │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐     │  │
│  │  │   Brief     │  │    Plan     │  │  Auditoría  │     │  │
│  │  │  Generator  │  │  Marketing  │  │     SEO     │     │  │
│  │  │     ↓       │  │   Generator │  │   Analyzer  │     │  │
│  │  │  Uses AI    │  │   Uses AI   │  │   Uses AI   │     │  │
│  │  └─────────────┘  └─────────────┘  └─────────────┘     │  │
│  │                                                           │  │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐     │  │
│  │  │  Content    │  │   Tareas    │  │    MCP      │     │  │
│  │  │  Generator  │  │  Generator  │  │  Executor   │     │  │
│  │  │   Uses AI   │  │   Uses AI   │  │   Uses AI   │     │  │
│  │  └─────────────┘  └─────────────┘  └─────────────┘     │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │           INTEGRACIONES EXTERNAS                          │  │
│  │                                                           │  │
│  │  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌─────────┐ │  │
│  │  │   Odoo   │  │WordPress │  │  Google  │  │   MCP   │ │  │
│  │  │   API    │  │   API    │  │   APIs   │  │ Tools   │ │  │
│  │  └──────────┘  └──────────┘  └──────────┘  └─────────┘ │  │
│  └──────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────┘
```

### 1.3. Principios de Diseño con IA

1. **IA Configurable**: Claude por defecto, pero intercambiable (OpenAI, Gemini, etc)
2. **Decisiones IA, No Lógica Booleana**: Análisis, estrategia, creatividad → IA
3. **Humano en el Loop**: IA propone, humano aprueba (excepto tareas de bajo riesgo)
4. **Trazabilidad**: Todos los prompts y respuestas de IA se loggean
5. **Fallback**: Si IA falla, el sistema debe poder continuar (modo degradado)

---

## 2. Arquitectura de IA Integrada

### 2.1. Core: AIService

**Ubicación:** `src/Core/AIService/`

#### 2.1.1. AIProviderInterface

```php
<?php
// ABOUTME: Interfaz para proveedores de IA
// ABOUTME: Permite intercambiar Claude, OpenAI, Gemini, etc

namespace App\Core\AIService;

interface AIProviderInterface {
    /**
     * Envía un prompt a la IA y obtiene respuesta
     *
     * @param string $prompt Prompt del usuario
     * @param array $context Contexto adicional (archivos, datos)
     * @param array $tools Herramientas MCP disponibles
     * @param array $options Opciones (temperatura, max_tokens, etc)
     * @return AIResponse
     */
    public function chat(
        string $prompt,
        array $context = [],
        array $tools = [],
        array $options = []
    ): AIResponse;

    /**
     * Envía mensajes conversacionales (con historial)
     *
     * @param array $messages Array de mensajes [role, content]
     * @param array $tools Herramientas MCP disponibles
     * @param array $options Opciones
     * @return AIResponse
     */
    public function conversation(
        array $messages,
        array $tools = [],
        array $options = []
    ): AIResponse;

    /**
     * Streaming de respuesta (para UX en tiempo real)
     */
    public function stream(
        string $prompt,
        array $context = [],
        callable $callback
    ): void;

    /**
     * Ejecuta una herramienta MCP
     */
    public function executeTool(string $toolName, array $params): mixed;

    /**
     * Obtiene nombre del proveedor
     */
    public function getName(): string;
}
```

#### 2.1.2. ClaudeProvider (Implementación Anthropic)

```php
<?php
// ABOUTME: Proveedor de IA usando Claude API (Anthropic)
// ABOUTME: Implementa AIProviderInterface con Model Context Protocol

namespace App\Core\AIService\Providers;

use App\Core\AIService\AIProviderInterface;
use App\Core\AIService\AIResponse;
use GuzzleHttp\Client;

class ClaudeProvider implements AIProviderInterface {
    private string $apiKey;
    private string $model = 'claude-sonnet-4-5-20250929'; // Modelo por defecto
    private Client $httpClient;

    public function __construct(string $apiKey, string $model = null) {
        $this->apiKey = $apiKey;
        if ($model) {
            $this->model = $model;
        }
        $this->httpClient = new Client([
            'base_uri' => 'https://api.anthropic.com/v1/',
            'headers' => [
                'x-api-key' => $this->apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function chat(
        string $prompt,
        array $context = [],
        array $tools = [],
        array $options = []
    ): AIResponse {
        // Construir prompt completo con contexto
        $fullPrompt = $this->buildPromptWithContext($prompt, $context);

        $payload = [
            'model' => $this->model,
            'max_tokens' => $options['max_tokens'] ?? 4096,
            'temperature' => $options['temperature'] ?? 1.0,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $fullPrompt
                ]
            ]
        ];

        // Añadir herramientas MCP si existen
        if (!empty($tools)) {
            $payload['tools'] = $this->formatToolsForClaude($tools);
        }

        // System prompt si existe
        if (!empty($options['system'])) {
            $payload['system'] = $options['system'];
        }

        try {
            $response = $this->httpClient->post('messages', [
                'json' => $payload
            ]);

            $data = json_decode($response->getBody(), true);

            return new AIResponse(
                content: $data['content'][0]['text'] ?? '',
                toolCalls: $this->extractToolCalls($data),
                usage: [
                    'input_tokens' => $data['usage']['input_tokens'],
                    'output_tokens' => $data['usage']['output_tokens']
                ],
                raw: $data,
                provider: 'claude'
            );
        } catch (\Exception $e) {
            // Log error
            error_log("Claude API Error: " . $e->getMessage());

            throw new AIServiceException(
                "Error comunicando con Claude: " . $e->getMessage()
            );
        }
    }

    public function conversation(
        array $messages,
        array $tools = [],
        array $options = []
    ): AIResponse {
        $payload = [
            'model' => $this->model,
            'max_tokens' => $options['max_tokens'] ?? 4096,
            'temperature' => $options['temperature'] ?? 1.0,
            'messages' => $messages
        ];

        if (!empty($tools)) {
            $payload['tools'] = $this->formatToolsForClaude($tools);
        }

        if (!empty($options['system'])) {
            $payload['system'] = $options['system'];
        }

        $response = $this->httpClient->post('messages', [
            'json' => $payload
        ]);

        $data = json_decode($response->getBody(), true);

        return new AIResponse(
            content: $data['content'][0]['text'] ?? '',
            toolCalls: $this->extractToolCalls($data),
            usage: [
                'input_tokens' => $data['usage']['input_tokens'],
                'output_tokens' => $data['usage']['output_tokens']
            ],
            raw: $data,
            provider: 'claude'
        );
    }

    public function stream(
        string $prompt,
        array $context = [],
        callable $callback
    ): void {
        // Implementación con Server-Sent Events
        // Para UX en tiempo real (mostrar respuesta mientras se genera)
        // Similar a useChat de Vercel AI SDK
    }

    public function executeTool(string $toolName, array $params): mixed {
        // Ejecutar herramienta MCP y devolver resultado
        // Por ejemplo: wordpress.createPost, google.searchConsole, etc
        return $this->mcpRegistry->execute($toolName, $params);
    }

    public function getName(): string {
        return 'claude';
    }

    private function buildPromptWithContext(string $prompt, array $context): string {
        $fullPrompt = $prompt;

        // Añadir archivos del contexto
        if (!empty($context['files'])) {
            $fullPrompt .= "\n\n# Archivos de Contexto:\n\n";
            foreach ($context['files'] as $file) {
                $fullPrompt .= "## {$file['path']}:\n```\n{$file['content']}\n```\n\n";
            }
        }

        // Añadir datos estructurados del contexto
        if (!empty($context['data'])) {
            $fullPrompt .= "\n\n# Datos de Contexto:\n\n";
            $fullPrompt .= json_encode($context['data'], JSON_PRETTY_PRINT);
        }

        return $fullPrompt;
    }

    private function formatToolsForClaude(array $tools): array {
        // Convertir herramientas MCP a formato Claude
        $claudeTools = [];
        foreach ($tools as $tool) {
            $claudeTools[] = [
                'name' => $tool['name'],
                'description' => $tool['description'],
                'input_schema' => $tool['parameters']
            ];
        }
        return $claudeTools;
    }

    private function extractToolCalls(array $response): array {
        $toolCalls = [];
        foreach ($response['content'] as $block) {
            if ($block['type'] === 'tool_use') {
                $toolCalls[] = [
                    'id' => $block['id'],
                    'name' => $block['name'],
                    'input' => $block['input']
                ];
            }
        }
        return $toolCalls;
    }
}
```

#### 2.1.3. AIResponse (DTO)

```php
<?php
// ABOUTME: Data Transfer Object para respuestas de IA
// ABOUTME: Estructura común independiente del proveedor

namespace App\Core\AIService;

class AIResponse {
    public function __construct(
        public string $content,
        public array $toolCalls = [],
        public array $usage = [],
        public array $raw = [],
        public string $provider = ''
    ) {}

    public function hasToolCalls(): bool {
        return !empty($this->toolCalls);
    }

    public function getToolCall(string $name): ?array {
        foreach ($this->toolCalls as $call) {
            if ($call['name'] === $name) {
                return $call;
            }
        }
        return null;
    }

    public function toArray(): array {
        return [
            'content' => $this->content,
            'tool_calls' => $this->toolCalls,
            'usage' => $this->usage,
            'provider' => $this->provider
        ];
    }
}
```

#### 2.1.4. AIServiceFactory

```php
<?php
// ABOUTME: Factory para crear instancias de proveedores de IA
// ABOUTME: Permite configurar provider desde .env o base de datos

namespace App\Core\AIService;

use App\Core\Config;

class AIServiceFactory {
    public static function create(?string $provider = null): AIProviderInterface {
        $provider = $provider ?? Config::get('ai.default_provider', 'claude');

        return match($provider) {
            'claude' => new Providers\ClaudeProvider(
                apiKey: Config::get('ai.claude_api_key'),
                model: Config::get('ai.claude_model')
            ),
            'openai' => new Providers\OpenAIProvider(
                apiKey: Config::get('ai.openai_api_key'),
                model: Config::get('ai.openai_model')
            ),
            'gemini' => new Providers\GeminiProvider(
                apiKey: Config::get('ai.gemini_api_key'),
                model: Config::get('ai.gemini_model')
            ),
            default => throw new \InvalidArgumentException("Provider no soportado: $provider")
        };
    }
}
```

### 2.2. Configuración (.env)

```bash
# ============================================
# IA Configuration
# ============================================

# Provider por defecto (claude, openai, gemini)
AI_DEFAULT_PROVIDER=claude

# Claude (Anthropic)
AI_CLAUDE_API_KEY=sk-ant-xxxxxxxxxxxxx
AI_CLAUDE_MODEL=claude-sonnet-4-5-20250929

# OpenAI (alternativo)
AI_OPENAI_API_KEY=sk-xxxxxxxxxxxxx
AI_OPENAI_MODEL=gpt-4o

# Gemini (alternativo)
AI_GEMINI_API_KEY=xxxxxxxxxxxxx
AI_GEMINI_MODEL=gemini-2.0-flash-exp

# Opciones generales
AI_MAX_TOKENS=4096
AI_TEMPERATURE=1.0
AI_LOG_PROMPTS=true  # Loggear todos los prompts/respuestas
AI_LOG_PATH=data/logs/ai_interactions.json
```

---

## 3. Flujo Principal: Brief → Plan → Auditoría (IA-Driven)

### 3.1. Flujo Completo Automatizado

```
Usuario da de alta cliente
    ↓
[PASO 1: BRIEF ASISTIDO POR IA]
    ↓
Usuario completa brief básico (5 preguntas)
    ↓
IA analiza brief y genera preguntas adicionales inteligentes
    ↓
Usuario responde preguntas IA
    ↓
IA genera brief.json completo y detallado
    ↓
[PASO 2: PLAN DE MARKETING GENERADO POR IA]
    ↓
IA lee brief.json
    ↓
IA genera plan_marketing.json completo:
    - Objetivos SMART
    - Canales recomendados
    - Estrategia de contenidos
    - KPIs sugeridos
    - Timeline
    ↓
Usuario revisa y aprueba plan
    ↓
[PASO 3: AUDITORÍA SEO (PRE o POST DESARROLLO)]
    ↓
SI web_ya_existe:
    ├─> IA ejecuta MCP tools para obtener datos:
    │   - google.searchConsole.getQueries()
    │   - google.analytics.getPageData()
    │   - screamingFrog.crawl(url)
    │   - ahrefs.getBacklinks() (si disponible)
    ├─> IA analiza datos (Agente Analista)
    ├─> IA genera auditoria_seo.json con insights
    └─> IA propone arquitectura optimizada
SINO (web por hacer):
    ├─> IA analiza brief + plan
    ├─> IA investiga competencia (MCP: web scraping)
    ├─> IA diseña arquitectura desde cero
    └─> IA genera plan de desarrollo SEO
    ↓
[PASO 4: ARQUITECTURA Y TAREAS]
    ↓
IA genera arquitectura_propuesta.json:
    - Estructura de URLs
    - Mapeo keywords → URLs
    - Plan de contenidos
    - Estrategia de enlaces
    ↓
IA convierte arquitectura en TAREAS ejecutables
    ↓
IA crea tareas en Odoo vía API
    ↓
Usuario asigna tareas a desarrolladores
    ↓
[PASO 5: EJECUCIÓN Y VALIDACIÓN]
    ↓
Desarrolladores completan tareas
    ↓
SI web_ya_existe:
    └─> Ejecutar cambios vía MCP (WordPress, etc)
SINO (web nueva):
    └─> Desarrollar web siguiendo arquitectura
    ↓
Al finalizar desarrollo:
    ├─> IA ejecuta auditoría POST-DESARROLLO
    ├─> IA valida que se implementó según plan
    ├─> IA genera reporte de QA
    └─> IA sugiere ajustes finales
    ↓
[FIN] Sistema en producción optimizado
```

### 3.2. Implementación: BriefGeneratorService (IA)

```php
<?php
// ABOUTME: Servicio para generar brief asistido por IA
// ABOUTME: IA analiza respuestas iniciales y genera brief completo

namespace App\Modules\Cliente\Services;

use App\Core\AIService\AIServiceFactory;

class BriefGeneratorService {
    private $ai;
    private $clienteModel;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
        $this->clienteModel = new \App\Modules\Cliente\Models\Cliente();
    }

    /**
     * Genera brief completo a partir de respuestas iniciales
     *
     * @param int $clienteId
     * @param array $respuestasIniciales Respuestas del usuario
     * @return array Brief completo generado por IA
     */
    public function generarBriefCompleto(int $clienteId, array $respuestasIniciales): array {
        $cliente = $this->clienteModel->find($clienteId);

        // Prompt para IA
        $prompt = $this->buildBriefPrompt($cliente, $respuestasIniciales);

        // System prompt
        $systemPrompt = $this->getBriefSystemPrompt();

        // Llamar a IA
        $response = $this->ai->chat(
            prompt: $prompt,
            context: [
                'data' => [
                    'cliente' => $cliente,
                    'respuestas' => $respuestasIniciales
                ]
            ],
            options: [
                'system' => $systemPrompt,
                'temperature' => 0.7,
                'max_tokens' => 4096
            ]
        );

        // Extraer JSON de la respuesta
        $brief = $this->extractJSONFromResponse($response->content);

        // Guardar log de interacción con IA
        $this->logAIInteraction($clienteId, 'brief_generation', $prompt, $response);

        return $brief;
    }

    /**
     * Genera preguntas adicionales inteligentes basadas en respuestas
     */
    public function generarPreguntasAdicionales(int $clienteId, array $respuestasPrevias): array {
        $prompt = <<<PROMPT
He recibido estas respuestas iniciales de un cliente:

{$this->formatRespuestas($respuestasPrevias)}

Genera 3-5 preguntas adicionales inteligentes para profundizar en:
1. Objetivos específicos
2. Público objetivo
3. Competencia
4. Recursos disponibles
5. Expectativas de timeline

Devuelve las preguntas en formato JSON:
{
  "preguntas": [
    {
      "id": "q1",
      "pregunta": "...",
      "tipo": "texto|select|multiple",
      "opciones": [...] (si aplica)
    }
  ]
}
PROMPT;

        $response = $this->ai->chat($prompt, options: ['temperature' => 0.8]);
        return $this->extractJSONFromResponse($response->content);
    }

    private function buildBriefPrompt($cliente, $respuestas): string {
        return <<<PROMPT
# Tarea: Generar Brief de Marketing Completo

## Cliente
- Nombre: {$cliente->nombre}
- Empresa: {$cliente->empresa}
- Dominio: {$cliente->dominio}
- Email: {$cliente->email}

## Respuestas del Cliente

{$this->formatRespuestas($respuestas)}

## Tu Misión

Genera un brief de marketing completo y profesional en formato JSON siguiendo esta estructura:

{
  "informacion_empresa": {
    "descripcion": "...",
    "sector": "...",
    "tamano": "...",
    "ubicacion": "..."
  },
  "objetivos_marketing": {
    "objetivo_principal": "...",
    "objetivos_secundarios": [...],
    "metricas_exito": [...]
  },
  "publico_objetivo": {
    "segmentos": [
      {
        "nombre": "...",
        "demografia": {...},
        "psicografia": {...},
        "pain_points": [...]
      }
    ]
  },
  "competencia": {
    "competidores_principales": [
      {
        "nombre": "...",
        "url": "...",
        "fortalezas": [...],
        "debilidades": [...]
      }
    ]
  },
  "situacion_actual": {
    "web_existente": true/false,
    "estado_seo": "...",
    "trafico_actual": "...",
    "presencia_digital": [...]
  },
  "recursos": {
    "presupuesto": "...",
    "equipo": "...",
    "herramientas": [...]
  },
  "timeline": {
    "inicio": "...",
    "duracion_estimada": "...",
    "hitos": [...]
  }
}

**IMPORTANTE:**
1. Infiere información razonable basándote en las respuestas
2. Si falta información, usa tu conocimiento del sector para sugerir defaults inteligentes
3. Sé específico y accionable
4. El brief debe ser suficiente para generar un plan de marketing completo
PROMPT;
    }

    private function getBriefSystemPrompt(): string {
        return <<<SYSTEM
Eres un consultor de marketing estratégico experto.

Tu misión es analizar las respuestas del cliente y generar un brief completo, profesional y accionable.

Principios:
- Inferir información razonable cuando falte contexto
- Usar conocimiento del sector para defaults inteligentes
- Ser específico, no genérico
- Pensar como CMO, no como copywriter
- Priorizar objetivos medibles (SMART)

Siempre devuelve JSON válido. No añadas markdown ni explicaciones fuera del JSON.
SYSTEM;
    }

    private function formatRespuestas(array $respuestas): string {
        $formatted = "";
        foreach ($respuestas as $key => $value) {
            $formatted .= "**{$key}:** {$value}\n";
        }
        return $formatted;
    }

    private function extractJSONFromResponse(string $content): array {
        // Extraer JSON del contenido (puede estar envuelto en markdown)
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        if (empty($matches)) {
            throw new \Exception("No se pudo extraer JSON de la respuesta de IA");
        }
        return json_decode($matches[0], true);
    }

    private function logAIInteraction(int $clienteId, string $tipo, string $prompt, $response): void {
        $logPath = __DIR__ . "/../../../../data/logs/ai_interactions.json";

        $log = [
            'timestamp' => date('Y-m-d H:i:s'),
            'cliente_id' => $clienteId,
            'tipo' => $tipo,
            'prompt' => $prompt,
            'response' => $response->content,
            'usage' => $response->usage,
            'provider' => $response->provider
        ];

        // Append al archivo de log
        $logs = file_exists($logPath) ? json_decode(file_get_contents($logPath), true) : [];
        $logs[] = $log;
        file_put_contents($logPath, json_encode($logs, JSON_PRETTY_PRINT));
    }
}
```

### 3.3. Implementación: PlanMarketingGeneratorService (IA)

```php
<?php
// ABOUTME: Servicio para generar plan de marketing con IA
// ABOUTME: Lee brief y genera plan completo automáticamente

namespace App\Modules\PlanMarketing\Services;

use App\Core\AIService\AIServiceFactory;

class PlanMarketingGeneratorService {
    private $ai;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
    }

    /**
     * Genera plan de marketing completo a partir del brief
     */
    public function generarPlan(int $clienteId): array {
        // Leer brief del cliente
        $briefPath = __DIR__ . "/../../../../data/clientes/$clienteId/brief.json";
        if (!file_exists($briefPath)) {
            throw new \Exception("Brief no encontrado para cliente $clienteId");
        }
        $brief = json_decode(file_get_contents($briefPath), true);

        // Leer datos del cliente
        $clienteModel = new \App\Modules\Cliente\Models\Cliente();
        $cliente = $clienteModel->find($clienteId);

        // Prompt para generar plan
        $prompt = $this->buildPlanPrompt($cliente, $brief);

        $response = $this->ai->chat(
            prompt: $prompt,
            context: [
                'files' => [
                    [
                        'path' => 'brief.json',
                        'content' => json_encode($brief, JSON_PRETTY_PRINT)
                    ]
                ]
            ],
            options: [
                'system' => $this->getPlanSystemPrompt(),
                'temperature' => 0.7,
                'max_tokens' => 6000
            ]
        );

        $plan = $this->extractJSONFromResponse($response->content);

        // Guardar plan
        $planPath = __DIR__ . "/../../../../data/clientes/$clienteId/plan_marketing.json";
        file_put_contents($planPath, json_encode($plan, JSON_PRETTY_PRINT));

        return $plan;
    }

    private function buildPlanPrompt($cliente, $brief): string {
        return <<<PROMPT
# Tarea: Generar Plan de Marketing Estratégico

## Cliente
- Nombre: {$cliente->nombre}
- Empresa: {$cliente->empresa}
- Dominio: {$cliente->dominio}

## Brief Completo
[Ver brief.json adjunto]

## Tu Misión

Genera un plan de marketing completo, estratégico y ejecutable siguiendo esta estructura JSON:

{
  "resumen_ejecutivo": "...",
  "objetivo_principal": "...",
  "objetivos_smart": [
    {
      "objetivo": "...",
      "specific": "...",
      "measurable": "...",
      "achievable": "...",
      "relevant": "...",
      "timebound": "..."
    }
  ],
  "canales_recomendados": [
    {
      "canal": "seo|sem|email|social|content",
      "razon": "...",
      "prioridad": "alta|media|baja",
      "presupuesto_sugerido": "...",
      "kpis": [...]
    }
  ],
  "estrategia_contenidos": {
    "pilares_contenido": [...],
    "calendario_editorial": {
      "frecuencia": "...",
      "temas_mensuales": [...]
    },
    "tipos_contenido": [...]
  },
  "keyword_strategy": {
    "keywords_principales": [...],
    "keywords_long_tail": [...],
    "grupos_semanticos": [...]
  },
  "timeline": {
    "duracion_meses": 12,
    "fases": [
      {
        "fase": "Fase 1: Quick Wins",
        "duracion": "1-2 meses",
        "actividades": [...],
        "entregables": [...]
      }
    ],
    "hitos": [
      {
        "mes": 3,
        "hito": "...",
        "metrica": "..."
      }
    ]
  },
  "kpis_principales": [
    {
      "kpi": "...",
      "valor_actual": "...",
      "valor_objetivo": "...",
      "frecuencia_medicion": "mensual|semanal|diaria"
    }
  ],
  "presupuesto_total": {
    "total": "...",
    "desglose": {
      "seo": "...",
      "contenido": "...",
      "publicidad": "...",
      "herramientas": "..."
    }
  }
}

**IMPORTANTE:**
1. El plan debe ser específico para el sector del cliente
2. Los objetivos deben ser SMART y medibles
3. Los canales deben estar priorizados según el presupuesto y recursos
4. El timeline debe ser realista
5. Los KPIs deben ser alcanzables pero ambiciosos
PROMPT;
    }

    private function getPlanSystemPrompt(): string {
        return <<<SYSTEM
Eres un Director de Marketing (CMO) con 15+ años de experiencia.

Tu misión es crear planes de marketing estratégicos, ejecutables y orientados a resultados.

Principios:
- Basado en datos, no en intuición
- Objetivos SMART siempre
- ROI debe ser medible
- Priorizar quick wins al inicio
- Timeline realista (no sobreprometer)
- Considerar recursos y presupuesto del cliente

Siempre devuelve JSON válido. Sé específico, no genérico. Piensa estratégicamente.
SYSTEM;
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        if (empty($matches)) {
            throw new \Exception("No se pudo extraer JSON de la respuesta de IA");
        }
        return json_decode($matches[0], true);
    }
}
```

---

## 4. Sistema Multi-Idioma

### 4.1. Tipos de Implementación Multi-Idioma

```php
<?php
// ABOUTME: Configuración de estrategias multi-idioma
// ABOUTME: Soporta carpetas, subdominios y dominios regionales

namespace App\Shared\Multilang;

enum MultilangStrategy: string {
    case SUBFOLDERS = 'subfolders';      // ejemplo.com/es/ ejemplo.com/en/
    case SUBDOMAINS = 'subdomains';      // es.ejemplo.com en.ejemplo.com
    case CCLTDS = 'ccltds';              // ejemplo.es ejemplo.com ejemplo.fr
    case PARAMETERS = 'parameters';       // ejemplo.com?lang=es
}

class MultilangConfig {
    public MultilangStrategy $strategy;
    public string $defaultLang;
    public array $languages;
    public array $domainMapping = [];  // Para ccTLDs

    public static function fromClientConfig(array $config): self {
        $instance = new self();
        $instance->strategy = MultilangStrategy::from($config['strategy']);
        $instance->defaultLang = $config['default_lang'];
        $instance->languages = $config['languages'];

        if ($instance->strategy === MultilangStrategy::CCLTDS) {
            $instance->domainMapping = $config['domain_mapping'];
            // Ejemplo:
            // [
            //   'es' => 'ejemplo.es',
            //   'en' => 'ejemplo.com',
            //   'fr' => 'exemple.fr'
            // ]
        }

        return $instance;
    }

    public function getURLForLang(string $lang, string $path = '/'): string {
        return match($this->strategy) {
            MultilangStrategy::SUBFOLDERS => "https://{$this->baseDomain}/{$lang}{$path}",
            MultilangStrategy::SUBDOMAINS => "https://{$lang}.{$this->baseDomain}{$path}",
            MultilangStrategy::CCLTDS => "https://{$this->domainMapping[$lang]}{$path}",
            MultilangStrategy::PARAMETERS => "https://{$this->baseDomain}{$path}?lang={$lang}"
        };
    }
}
```

### 4.2. Auditoría SEO Multi-Idioma

```php
<?php
// ABOUTME: Service para auditoría SEO multi-idioma
// ABOUTME: IA analiza cada idioma independientemente y cross-lang

namespace App\Modules\AuditoriaSEO\Services;

use App\Core\AIService\AIServiceFactory;
use App\Shared\Multilang\MultilangConfig;

class MultilangAuditoriaService {
    private $ai;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
    }

    /**
     * Ejecuta auditoría para sitio multi-idioma
     */
    public function auditarMultilang(int $clienteId, MultilangConfig $config): array {
        $auditorias = [];

        // Auditar cada idioma independientemente
        foreach ($config->languages as $lang) {
            $auditorias[$lang] = $this->auditarIdioma($clienteId, $lang, $config);
        }

        // Análisis cross-language (hreflang, duplicados, etc)
        $crossLangAnalysis = $this->analizarCrossLanguage($clienteId, $auditorias, $config);

        return [
            'por_idioma' => $auditorias,
            'cross_language' => $crossLangAnalysis,
            'recomendaciones_globales' => $this->generarRecomendacionesGlobales($auditorias, $crossLangAnalysis)
        ];
    }

    private function auditarIdioma(int $clienteId, string $lang, MultilangConfig $config): array {
        // Obtener URL base para este idioma
        $baseURL = $config->getURLForLang($lang);

        // Ejecutar crawl con MCP
        $crawlData = $this->executeMCPCrawl($baseURL);

        // Obtener datos GSC para este idioma
        $gscData = $this->executeMCPGSC($baseURL);

        // IA analiza
        $prompt = <<<PROMPT
Analiza este sitio web en idioma {$lang}:
URL base: {$baseURL}

Datos del crawl:
{$this->formatCrawlData($crawlData)}

Datos de Google Search Console:
{$this->formatGSCData($gscData)}

Genera análisis SEO específico para este idioma considerando:
1. Errores técnicos
2. Contenido thin o duplicado
3. Keywords relevantes para {$lang}
4. Oportunidades de optimización
5. Comparación con mejores prácticas para SEO en {$lang}

Devuelve JSON con estructura estándar de auditoría.
PROMPT;

        $response = $this->ai->chat($prompt, tools: $this->getMCPTools());

        return $this->extractJSONFromResponse($response->content);
    }

    private function analizarCrossLanguage(int $clienteId, array $auditorias, MultilangConfig $config): array {
        $prompt = <<<PROMPT
Analiza la implementación multi-idioma de este sitio:

Estrategia: {$config->strategy->value}
Idiomas: {implode(', ', $config->languages)}

Auditorías por idioma:
{json_encode($auditorias, JSON_PRETTY_PRINT)}

Analiza:
1. Implementación correcta de hreflang
2. Contenido duplicado entre idiomas
3. Canonical tags correctos
4. Arquitectura de URLs coherente
5. Distribución de autoridad entre idiomas
6. Missing translations
7. Inconsistencias cross-lang

Devuelve JSON con:
{
  "hreflang_errors": [...],
  "duplicate_content": [...],
  "missing_translations": [...],
  "arquitectura_issues": [...],
  "recomendaciones": [...]
}
PROMPT;

        $response = $this->ai->chat($prompt);
        return $this->extractJSONFromResponse($response->content);
    }

    private function generarRecomendacionesGlobales(array $auditorias, array $crossLang): array {
        // IA genera recomendaciones priorizadas para todo el sitio multi-idioma
        $prompt = <<<PROMPT
Basándote en las auditorías por idioma y el análisis cross-language, genera un plan de acción priorizado.

Auditorías:
{json_encode($auditorias, JSON_PRETTY_PRINT)}

Análisis Cross-Language:
{json_encode($crossLang, JSON_PRETTY_PRINT)}

Genera plan de acción con:
1. Quick wins (implementación < 1 semana)
2. Mejoras de impacto medio (1-4 semanas)
3. Proyectos grandes (> 1 mes)

Para cada acción:
- Descripción
- Impacto esperado (tráfico estimado)
- Esfuerzo (horas)
- Prioridad
- Idiomas afectados

Devuelve JSON estructurado.
PROMPT;

        $response = $this->ai->chat($prompt);
        return $this->extractJSONFromResponse($response->content);
    }

    private function executeMCPCrawl(string $url): array {
        // Ejecutar Screaming Frog vía MCP
        $toolCall = $this->ai->executeTool('screamingfrog.crawl', [
            'url' => $url,
            'max_urls' => 10000
        ]);
        return $toolCall['data'];
    }

    private function executeMCPGSC(string $url): array {
        // Ejecutar Google Search Console vía MCP
        $toolCall = $this->ai->executeTool('google.searchConsole.getQueries', [
            'siteUrl' => $url,
            'startDate' => date('Y-m-d', strtotime('-3 months')),
            'endDate' => date('Y-m-d')
        ]);
        return $toolCall['data'];
    }

    private function getMCPTools(): array {
        return [
            [
                'name' => 'screamingfrog.crawl',
                'description' => 'Crawl a website with Screaming Frog',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'url' => ['type' => 'string'],
                        'max_urls' => ['type' => 'integer']
                    ],
                    'required' => ['url']
                ]
            ],
            [
                'name' => 'google.searchConsole.getQueries',
                'description' => 'Get search queries from Google Search Console',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'siteUrl' => ['type' => 'string'],
                        'startDate' => ['type' => 'string'],
                        'endDate' => ['type' => 'string']
                    ],
                    'required' => ['siteUrl', 'startDate', 'endDate']
                ]
            ]
        ];
    }

    private function formatCrawlData(array $data): string {
        // Formatear datos del crawl para el prompt
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    private function formatGSCData(array $data): string {
        // Formatear datos de GSC para el prompt
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        return json_decode($matches[0] ?? '{}', true);
    }
}
```

---

## 5. Auditorías Pre-Desarrollo vs Post-Desarrollo

### 5.1. Tipos de Auditoría

```php
<?php
// ABOUTME: Enum para tipos de auditoría SEO
// ABOUTME: Pre-desarrollo (diseño) vs Post-desarrollo (QA)

namespace App\Modules\AuditoriaSEO\Enums;

enum TipoAuditoria: string {
    case PRE_DESARROLLO = 'pre_desarrollo';   // Web no existe, diseño desde cero
    case POST_DESARROLLO = 'post_desarrollo'; // Web existe, validar implementación
    case COMPETENCIA = 'competencia';         // Analizar competidores
    case MIGRACION = 'migracion';             // Pre-migración de dominio/plataforma
}
```

### 5.2. Service: AuditoriaOrchestrator

```php
<?php
// ABOUTME: Orquestador de auditorías según tipo
// ABOUTME: Decide qué análisis ejecutar según contexto

namespace App\Modules\AuditoriaSEO\Services;

use App\Modules\AuditoriaSEO\Enums\TipoAuditoria;
use App\Core\AIService\AIServiceFactory;

class AuditoriaOrchestrator {
    private $ai;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
    }

    /**
     * Ejecuta auditoría según tipo
     */
    public function ejecutarAuditoria(
        int $clienteId,
        TipoAuditoria $tipo,
        array $opciones = []
    ): array {
        return match($tipo) {
            TipoAuditoria::PRE_DESARROLLO => $this->auditoriaPreDesarrollo($clienteId, $opciones),
            TipoAuditoria::POST_DESARROLLO => $this->auditoriaPostDesarrollo($clienteId, $opciones),
            TipoAuditoria::COMPETENCIA => $this->auditoriaCompetencia($clienteId, $opciones),
            TipoAuditoria::MIGRACION => $this->auditoriaMigracion($clienteId, $opciones)
        };
    }

    /**
     * Auditoría PRE-DESARROLLO
     * La web NO existe. IA diseña arquitectura desde cero.
     */
    private function auditoriaPreDesarrollo(int $clienteId, array $opciones): array {
        // Leer brief y plan de marketing
        $brief = $this->loadJSON("data/clientes/$clienteId/brief.json");
        $plan = $this->loadJSON("data/clientes/$clienteId/plan_marketing.json");

        // IA analiza competencia
        $competenciaAnalysis = $this->analizarCompetencia($brief['competencia']['competidores_principales']);

        // IA investiga keywords
        $keywordResearch = $this->investigarKeywords($brief, $plan);

        // IA diseña arquitectura de información
        $prompt = <<<PROMPT
# Tarea: Diseñar Arquitectura SEO para Web Nueva

## Contexto del Cliente
{$this->formatBrief($brief)}

## Plan de Marketing
{$this->formatPlan($plan)}

## Análisis de Competencia
{json_encode($competenciaAnalysis, JSON_PRETTY_PRINT)}

## Keyword Research
{json_encode($keywordResearch, JSON_PRETTY_PRINT)}

## Tu Misión

Diseña la arquitectura de información SEO-optimizada para esta web nueva.

Genera JSON con:
{
  "arquitectura_propuesta": {
    "estrategia": "hub-spoke|siloed|flat|...",
    "razonamiento": "...",
    "estructura_urls": {
      "homepage": "/",
      "hubs": [
        {
          "url": "/categoria/",
          "keyword_principal": "...",
          "descripcion": "...",
          "contenido_requerido": {...}
        }
      ],
      "spokes": [...],
      "support_pages": [...]
    },
    "mapeo_keywords": [
      {
        "keyword": "...",
        "url": "...",
        "intencion": "transaccional|informacional|navegacional",
        "volumen": 1200,
        "dificultad": 45
      }
    ],
    "plan_enlaces_internos": {
      "estrategia": "...",
      "anchor_texts": [...],
      "distribucion_autoridad": [...]
    },
    "plan_contenidos": {
      "contenido_prioritario": [
        {
          "url": "...",
          "tipo": "landing|hub|blog",
          "palabras_minimas": 1500,
          "elementos_requeridos": ["h2", "imagenes", "video", ...],
          "objetivo": "...",
          "ctas": [...]
        }
      ]
    },
    "fases_implementacion": [
      {
        "fase": "Fase 1: Core (MVP)",
        "duracion": "2-4 semanas",
        "paginas": [...],
        "criterio_exito": "..."
      }
    ]
  },
  "estimaciones": {
    "paginas_totales": 35,
    "horas_desarrollo": 120,
    "horas_contenido": 80,
    "potencial_trafico_6m": 5000,
    "potencial_trafico_12m": 12000
  }
}

**IMPORTANTE:**
- La web NO existe aún, diseña desde cero
- Prioriza quick wins (páginas de alto impacto, baja competencia)
- Arquitectura debe ser escalable
- Considera recursos del cliente (presupuesto, equipo)
PROMPT;

        $response = $this->ai->chat($prompt, options: ['max_tokens' => 8000]);
        $arquitectura = $this->extractJSONFromResponse($response->content);

        // Guardar
        $this->saveJSON("data/clientes/$clienteId/arquitectura_propuesta.json", $arquitectura);

        return [
            'tipo' => 'pre_desarrollo',
            'arquitectura' => $arquitectura,
            'competencia' => $competenciaAnalysis,
            'keywords' => $keywordResearch
        ];
    }

    /**
     * Auditoría POST-DESARROLLO
     * La web YA existe. IA valida implementación vs plan.
     */
    private function auditoriaPostDesarrollo(int $clienteId, array $opciones): array {
        $cliente = (new \App\Modules\Cliente\Models\Cliente())->find($clienteId);
        $url = "https://{$cliente->dominio}";

        // Cargar arquitectura propuesta (lo que se DEBÍA implementar)
        $arquitecturaPropuesta = $this->loadJSON("data/clientes/$clienteId/arquitectura_propuesta.json");

        // Crawl de la web real
        $crawlData = $this->executeMCPCrawl($url);

        // Obtener datos GSC/GA4
        $gscData = $this->executeMCPGSC($url);
        $ga4Data = $this->executeMCPGA4($url);

        // IA compara propuesta vs realidad
        $prompt = <<<PROMPT
# Tarea: Auditoría POST-DESARROLLO (QA SEO)

## Arquitectura Propuesta (Lo que se DEBÍA implementar)
{json_encode($arquitecturaPropuesta, JSON_PRETTY_PRINT)}

## Web Real (Lo que SE implementó)
URL: {$url}

### Datos del Crawl
{json_encode($crawlData, JSON_PRETTY_PRINT)}

### Google Search Console
{json_encode($gscData, JSON_PRETTY_PRINT)}

### Google Analytics 4
{json_encode($ga4Data, JSON_PRETTY_PRINT)}

## Tu Misión

Valida la implementación y genera reporte de QA SEO.

Genera JSON con:
{
  "cumplimiento_arquitectura": {
    "porcentaje_implementado": 85,
    "paginas_implementadas": [...],
    "paginas_faltantes": [...],
    "paginas_extra": [...]  // No estaban en plan
  },
  "errores_tecnicos": [
    {
      "tipo": "404|500|redirect|meta|...",
      "severidad": "critica|alta|media|baja",
      "descripcion": "...",
      "urls_afectadas": [...],
      "solucion": "..."
    }
  ],
  "calidad_contenido": {
    "thin_content": [...],  // < 300 palabras
    "duplicate_content": [...],
    "missing_h1": [...],
    "missing_meta_description": [...]
  },
  "implementacion_keywords": {
    "keywords_correctas": [...],
    "keywords_ausentes": [...],
    "keywords_mal_implementadas": [
      {
        "keyword": "...",
        "url_propuesta": "...",
        "url_real": "...",
        "problema": "..."
      }
    ]
  },
  "enlaces_internos": {
    "correctos": [...],
    "faltantes": [...],
    "anchor_texts_incorrectos": [...]
  },
  "rendimiento": {
    "velocidad_carga": {...},
    "core_web_vitals": {...},
    "mobile_friendly": true/false
  },
  "recomendaciones_priorizadas": [
    {
      "prioridad": "critica|alta|media|baja",
      "descripcion": "...",
      "impacto": "...",
      "esfuerzo": "horas",
      "tareas_odoo": [...]  // Tareas a crear en Odoo
    }
  ]
}

**IMPORTANTE:**
- Sé específico sobre qué no se implementó y por qué es importante
- Prioriza errores críticos que bloquean indexación
- Estima impacto de cada problema (tráfico perdido)
PROMPT;

        $response = $this->ai->chat($prompt, tools: $this->getMCPTools());
        $auditoria = $this->extractJSONFromResponse($response->content);

        // Guardar
        $this->saveJSON("data/clientes/$clienteId/auditoria_post_desarrollo.json", $auditoria);

        return [
            'tipo' => 'post_desarrollo',
            'auditoria' => $auditoria,
            'crawl' => $crawlData,
            'gsc' => $gscData,
            'ga4' => $ga4Data
        ];
    }

    private function analizarCompetencia(array $competidores): array {
        // IA analiza sitios de competidores
        $analisis = [];
        foreach ($competidores as $competidor) {
            $crawlData = $this->executeMCPCrawl($competidor['url']);

            $prompt = <<<PROMPT
Analiza este competidor:
Nombre: {$competidor['nombre']}
URL: {$competidor['url']}

Datos del crawl:
{json_encode($crawlData, JSON_PRETTY_PRINT)}

Extrae:
1. Arquitectura de URLs
2. Keywords principales que rankean
3. Estrategia de contenidos
4. Fortalezas SEO
5. Debilidades/oportunidades

Devuelve JSON estructurado.
PROMPT;

            $response = $this->ai->chat($prompt);
            $analisis[$competidor['nombre']] = $this->extractJSONFromResponse($response->content);
        }

        return $analisis;
    }

    private function investigarKeywords(array $brief, array $plan): array {
        // IA genera keyword research exhaustivo
        $prompt = <<<PROMPT
Genera keyword research para:

Sector: {$brief['informacion_empresa']['sector']}
Público objetivo: {json_encode($brief['publico_objetivo'])}
Objetivos: {json_encode($plan['objetivos_smart'])}

Genera lista de keywords con:
- Keyword
- Volumen de búsqueda (estimado)
- Dificultad (0-100)
- Intención (transaccional, informacional, navegacional)
- CPC estimado
- Grupos semánticos

Devuelve JSON con al menos 50 keywords.
PROMPT;

        $response = $this->ai->chat($prompt, tools: $this->getKeywordResearchTools());
        return $this->extractJSONFromResponse($response->content);
    }

    // Métodos auxiliares...
    private function loadJSON(string $path): array {
        $fullPath = __DIR__ . "/../../../../$path";
        return json_decode(file_get_contents($fullPath), true);
    }

    private function saveJSON(string $path, array $data): void {
        $fullPath = __DIR__ . "/../../../../$path";
        file_put_contents($fullPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        return json_decode($matches[0] ?? '{}', true);
    }

    private function formatBrief(array $brief): string {
        return json_encode($brief, JSON_PRETTY_PRINT);
    }

    private function formatPlan(array $plan): string {
        return json_encode($plan, JSON_PRETTY_PRINT);
    }

    private function executeMCPCrawl(string $url): array {
        // MCP tool execution
        return $this->ai->executeTool('screamingfrog.crawl', ['url' => $url]);
    }

    private function executeMCPGSC(string $url): array {
        return $this->ai->executeTool('google.searchConsole.getQueries', [
            'siteUrl' => $url,
            'startDate' => date('Y-m-d', strtotime('-3 months')),
            'endDate' => date('Y-m-d')
        ]);
    }

    private function executeMCPGA4(string $url): array {
        return $this->ai->executeTool('google.analytics.getPageData', [
            'propertyId' => 'XXX', // TODO: Get from cliente config
            'startDate' => date('Y-m-d', strtotime('-3 months')),
            'endDate' => date('Y-m-d')
        ]);
    }

    private function getMCPTools(): array {
        return [
            ['name' => 'screamingfrog.crawl', 'description' => '...', 'parameters' => [...]],
            ['name' => 'google.searchConsole.getQueries', 'description' => '...', 'parameters' => [...]],
            ['name' => 'google.analytics.getPageData', 'description' => '...', 'parameters' => [...]]
        ];
    }

    private function getKeywordResearchTools(): array {
        return [
            ['name' => 'google.keywordPlanner', 'description' => '...', 'parameters' => [...]],
            ['name' => 'ahrefs.keywords', 'description' => '...', 'parameters' => [...]]
        ];
    }
}
```

---

## 6. Integración con Odoo

### 6.1. Arquitectura de Integración

```
┌─────────────────────────────────────────────────────────┐
│         MARKETING CONTROL PANEL (MCP)                   │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │   IA genera recomendaciones y tareas             │  │
│  │   (desde auditoría o arquitectura propuesta)     │  │
│  └──────────────────┬───────────────────────────────┘  │
│                     ↓                                    │
│  ┌──────────────────────────────────────────────────┐  │
│  │   Módulo: Gestión de Tareas                      │  │
│  │   - Crea tareas en MCP                           │  │
│  │   - Sincroniza con Odoo                          │  │
│  │   - Tracking bidireccional                       │  │
│  └──────────────────┬───────────────────────────────┘  │
│                     ↓                                    │
└─────────────────────┼────────────────────────────────────┘
                      │
                      ↓ REST API
┌─────────────────────────────────────────────────────────┐
│                    ODOO ERP                              │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │   Módulo: Project                                 │  │
│  │   - Proyectos por cliente                        │  │
│  │   - Tareas (development, content, seo)           │  │
│  │   - Asignación a usuarios                        │  │
│  │   - Tracking de horas                            │  │
│  └──────────────────────────────────────────────────┘  │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │   Módulo: CRM (opcional)                         │  │
│  │   - Leads de clientes                            │  │
│  │   - Pipeline de ventas                           │  │
│  └──────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

### 6.2. OdooAPIService

```php
<?php
// ABOUTME: Servicio para integración con Odoo REST API
// ABOUTME: Gestiona proyectos, tareas y sincronización bidireccional

namespace App\Shared\Integrations;

use GuzzleHttp\Client;

class OdooAPIService {
    private Client $client;
    private string $baseUrl;
    private string $database;
    private int $uid;
    private string $apiKey;

    public function __construct() {
        $this->baseUrl = $_ENV['ODOO_URL'];
        $this->database = $_ENV['ODOO_DATABASE'];
        $this->apiKey = $_ENV['ODOO_API_KEY'];

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'api-key' => $this->apiKey
            ]
        ]);

        // Autenticar
        $this->uid = $this->authenticate();
    }

    private function authenticate(): int {
        // Odoo REST API authentication
        $response = $this->client->post('/api/v2/auth/login', [
            'json' => [
                'jsonrpc' => '2.0',
                'params' => [
                    'db' => $this->database,
                    'login' => $_ENV['ODOO_USERNAME'],
                    'password' => $_ENV['ODOO_PASSWORD']
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['result']['uid'];
    }

    /**
     * Crea un proyecto en Odoo para un cliente
     */
    public function crearProyecto(int $clienteId, string $nombreCliente, array $metadata = []): int {
        $response = $this->client->post('/api/v2/project.project', [
            'json' => [
                'jsonrpc' => '2.0',
                'params' => [
                    'name' => "Marketing - {$nombreCliente}",
                    'partner_id' => $metadata['partner_id'] ?? null,
                    'user_id' => $this->uid,
                    'description' => $metadata['descripcion'] ?? '',
                    'x_mcp_cliente_id' => $clienteId,  // Campo custom en Odoo
                    'tag_ids' => [[6, 0, [1]]]  // Tag "Marketing"
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['result'];
    }

    /**
     * Crea tarea en Odoo
     */
    public function crearTarea(array $tarea): int {
        $response = $this->client->post('/api/v2/project.task', [
            'json' => [
                'jsonrpc' => '2.0',
                'params' => [
                    'name' => $tarea['nombre'],
                    'project_id' => $tarea['proyecto_id'],
                    'description' => $tarea['descripcion'],
                    'planned_hours' => $tarea['horas_estimadas'] ?? 0,
                    'priority' => $this->mapPrioridad($tarea['prioridad']),
                    'tag_ids' => $this->mapTags($tarea['tipo']),
                    'user_ids' => [[6, 0, $tarea['asignados'] ?? []]],
                    'date_deadline' => $tarea['fecha_limite'] ?? null,

                    // Campos custom de MCP
                    'x_mcp_tarea_id' => $tarea['mcp_id'] ?? null,
                    'x_tipo_tarea' => $tarea['tipo'],  // 'seo', 'contenido', 'desarrollo', 'redirect'
                    'x_reversible' => $tarea['reversible'] ?? true,
                    'x_requiere_aprobacion' => $tarea['requiere_aprobacion'] ?? true,
                    'x_datos_json' => json_encode($tarea['metadata'] ?? [])
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['result'];
    }

    /**
     * Crea múltiples tareas en lote
     */
    public function crearTareasEnLote(int $proyectoId, array $tareas): array {
        $tareasCreadas = [];

        foreach ($tareas as $tarea) {
            $tarea['proyecto_id'] = $proyectoId;
            $odooTaskId = $this->crearTarea($tarea);
            $tareasCreadas[] = [
                'mcp_id' => $tarea['mcp_id'] ?? null,
                'odoo_id' => $odooTaskId,
                'nombre' => $tarea['nombre']
            ];
        }

        return $tareasCreadas;
    }

    /**
     * Actualiza estado de tarea
     */
    public function actualizarEstadoTarea(int $odooTaskId, string $estado): bool {
        $stageId = $this->mapEstadoToStage($estado);

        $response = $this->client->put("/api/v2/project.task/{$odooTaskId}", [
            'json' => [
                'jsonrpc' => '2.0',
                'params' => [
                    'stage_id' => $stageId
                ]
            ]
        ]);

        return $response->getStatusCode() === 200;
    }

    /**
     * Obtiene tareas de un proyecto
     */
    public function obtenerTareasProyecto(int $proyectoId): array {
        $response = $this->client->get('/api/v2/project.task', [
            'query' => [
                'domain' => json_encode([['project_id', '=', $proyectoId]]),
                'fields' => json_encode([
                    'id', 'name', 'stage_id', 'user_ids', 'priority',
                    'date_deadline', 'x_mcp_tarea_id', 'x_tipo_tarea'
                ])
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['result'];
    }

    /**
     * Sincroniza tareas MCP → Odoo
     */
    public function sincronizarTareas(int $clienteId): array {
        // Obtener tareas pendientes de sincronización en MCP
        $tareasModel = new \App\Modules\Tareas\Models\Tarea();
        $tareasPendientes = $tareasModel->findPendientesSincronizacion($clienteId);

        $resultados = [];
        foreach ($tareasPendientes as $tarea) {
            if (!$tarea->odoo_task_id) {
                // Crear en Odoo
                $odooTaskId = $this->crearTarea([
                    'nombre' => $tarea->nombre,
                    'proyecto_id' => $tarea->odoo_project_id,
                    'descripcion' => $tarea->descripcion,
                    'horas_estimadas' => $tarea->horas_estimadas,
                    'prioridad' => $tarea->prioridad,
                    'tipo' => $tarea->tipo,
                    'mcp_id' => $tarea->id,
                    'reversible' => $tarea->reversible,
                    'requiere_aprobacion' => $tarea->requiere_aprobacion,
                    'metadata' => json_decode($tarea->metadata_json, true)
                ]);

                // Actualizar MCP con ID de Odoo
                $tareasModel->update($tarea->id, ['odoo_task_id' => $odooTaskId]);

                $resultados[] = [
                    'mcp_id' => $tarea->id,
                    'odoo_id' => $odooTaskId,
                    'accion' => 'creada'
                ];
            } else {
                // Sincronizar estado
                $this->actualizarEstadoTarea($tarea->odoo_task_id, $tarea->estado);

                $resultados[] = [
                    'mcp_id' => $tarea->id,
                    'odoo_id' => $tarea->odoo_task_id,
                    'accion' => 'sincronizada'
                ];
            }
        }

        return $resultados;
    }

    /**
     * Webhook para recibir actualizaciones desde Odoo
     */
    public function procesarWebhookOdoo(array $payload): void {
        // Cuando Odoo actualiza una tarea, sincronizar en MCP
        $odooTaskId = $payload['id'];
        $nuevoEstado = $payload['stage_id'];
        $mcpTareaId = $payload['x_mcp_tarea_id'];

        if ($mcpTareaId) {
            $tareasModel = new \App\Modules\Tareas\Models\Tarea();
            $tareasModel->update($mcpTareaId, [
                'estado' => $this->mapStageToEstado($nuevoEstado),
                'odoo_last_sync' => date('Y-m-d H:i:s')
            ]);
        }
    }

    // Mappers
    private function mapPrioridad(string $prioridad): string {
        return match($prioridad) {
            'critica' => '3',  // Urgent
            'alta' => '2',     // High
            'media' => '1',    // Normal
            'baja' => '0',     // Low
            default => '1'
        };
    }

    private function mapTags(string $tipo): array {
        // IDs de tags en Odoo (configurar según tu instalación)
        $tagMap = [
            'seo' => 1,
            'contenido' => 2,
            'desarrollo' => 3,
            'redirect' => 4,
            'meta_tags' => 5,
            'enlaces_internos' => 6
        ];

        $tagId = $tagMap[$tipo] ?? null;
        return $tagId ? [[6, 0, [$tagId]]] : [];
    }

    private function mapEstadoToStage(string $estado): int {
        // IDs de stages en Odoo (configurar según tu instalación)
        return match($estado) {
            'pendiente' => 1,
            'en_progreso' => 2,
            'en_revision' => 3,
            'aprobada' => 4,
            'completada' => 5,
            'cancelada' => 6,
            default => 1
        };
    }

    private function mapStageToEstado(int $stageId): string {
        return match($stageId) {
            1 => 'pendiente',
            2 => 'en_progreso',
            3 => 'en_revision',
            4 => 'aprobada',
            5 => 'completada',
            6 => 'cancelada',
            default => 'pendiente'
        };
    }
}
```

### 6.3. Flujo de Creación de Tareas desde Auditoría

```php
<?php
// ABOUTME: Service que convierte recomendaciones de IA en tareas Odoo
// ABOUTME: Genera tareas estructuradas y ejecutables

namespace App\Modules\Tareas\Services;

use App\Shared\Integrations\OdooAPIService;

class TareasGeneratorService {
    private $odoo;
    private $ai;

    public function __construct() {
        $this->odoo = new OdooAPIService();
        $this->ai = \App\Core\AIService\AIServiceFactory::create();
    }

    /**
     * Convierte recomendaciones de auditoría en tareas ejecutables
     */
    public function generarTareasDesdeAuditoria(int $clienteId, array $auditoria): array {
        // IA convierte recomendaciones en tareas ejecutables
        $prompt = <<<PROMPT
# Tarea: Convertir Recomendaciones de Auditoría en Tareas Ejecutables

## Recomendaciones de Auditoría
{json_encode($auditoria['recomendaciones_priorizadas'], JSON_PRETTY_PRINT)}

## Tu Misión

Convierte cada recomendación en tareas ejecutables y granulares.

Para cada recomendación, genera 1 o más tareas con:

{
  "tareas": [
    {
      "nombre": "...",  // Título corto y accionable
      "descripcion": "...",  // Descripción detallada con contexto
      "tipo": "seo|contenido|desarrollo|redirect|meta_tags|enlaces_internos",
      "prioridad": "critica|alta|media|baja",
      "horas_estimadas": 2.5,
      "skills_requeridos": ["seo", "wordpress", "html"],
      "dependencias": [],  // IDs de otras tareas (si aplica)
      "reversible": true,
      "comando_reversion": "...",  // Si es reversible
      "requiere_aprobacion": true,
      "criterio_aceptacion": "...",
      "urls_afectadas": [...],
      "impacto_estimado": "...",  // Ej: "+500 visitas/mes"
      "metadata": {
        "wordpress_post_id": null,
        "redirect_from": "...",
        "redirect_to": "...",
        // Datos específicos según tipo
      }
    }
  ]
}

**IMPORTANTE:**
- Una tarea = una acción concreta (no "mejorar SEO", sino "añadir meta description a /pagina-x/")
- Especificar URLs afectadas
- Estimar horas realísticamente
- Marcar dependencias (ej: redirect antes de eliminar contenido)
- Tareas reversibles SIEMPRE deben tener comando de reversión
PROMPT;

        $response = $this->ai->chat($prompt);
        $tareasGeneradas = $this->extractJSONFromResponse($response->content);

        // Guardar en BD local
        $tareasModel = new \App\Modules\Tareas\Models\Tarea();
        $tareasCreadas = [];

        foreach ($tareasGeneradas['tareas'] as $tarea) {
            $tareaId = $tareasModel->create([
                'cliente_id' => $clienteId,
                'auditoria_id' => $auditoria['id'],
                'nombre' => $tarea['nombre'],
                'descripcion' => $tarea['descripcion'],
                'tipo' => $tarea['tipo'],
                'prioridad' => $tarea['prioridad'],
                'horas_estimadas' => $tarea['horas_estimadas'],
                'skills_requeridos' => json_encode($tarea['skills_requeridos']),
                'estado' => 'pendiente',
                'reversible' => $tarea['reversible'],
                'comando_reversion' => $tarea['comando_reversion'] ?? null,
                'requiere_aprobacion' => $tarea['requiere_aprobacion'],
                'criterio_aceptacion' => $tarea['criterio_aceptacion'],
                'impacto_estimado' => $tarea['impacto_estimado'],
                'metadata_json' => json_encode($tarea['metadata']),
                'odoo_task_id' => null,  // Sincronizar después
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $tareasCreadas[] = array_merge($tarea, ['id' => $tareaId]);
        }

        // Sincronizar con Odoo
        $this->sincronizarConOdoo($clienteId, $tareasCreadas);

        return $tareasCreadas;
    }

    private function sincronizarConOdoo(int $clienteId, array $tareas): void {
        // Obtener proyecto Odoo del cliente (o crearlo)
        $clienteModel = new \App\Modules\Cliente\Models\Cliente();
        $cliente = $clienteModel->find($clienteId);

        if (!$cliente->odoo_project_id) {
            // Crear proyecto en Odoo
            $proyectoId = $this->odoo->crearProyecto($clienteId, $cliente->nombre);
            $clienteModel->update($clienteId, ['odoo_project_id' => $proyectoId]);
        }

        // Crear tareas en Odoo
        $this->odoo->crearTareasEnLote($cliente->odoo_project_id, $tareas);
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        return json_decode($matches[0] ?? '{}', true);
    }
}
```

---

## 7. Sistema de Aprobaciones y Reversibilidad

### 7.1. Principios de Seguridad

1. **Todo cambio en producción requiere aprobación humana**
2. **Todo cambio debe ser reversible**
3. **Logs completos de todas las acciones**
4. **Preview obligatorio antes de aprobar**
5. **Rollback en un click**

### 7.2. ApprovalService

```php
<?php
// ABOUTME: Servicio para gestionar aprobaciones humanas
// ABOUTME: Implementa workflow: borrador → revisión → aprobado → ejecutado

namespace App\Core\Approvals;

class ApprovalService {
    private $tareasModel;
    private $approvalsModel;

    public function __construct() {
        $this->tareasModel = new \App\Modules\Tareas\Models\Tarea();
        $this->approvalsModel = new ApprovalModel();
    }

    /**
     * Solicita aprobación para una tarea
     */
    public function solicitarAprobacion(int $tareaId, array $preview): int {
        $tarea = $this->tareasModel->find($tareaId);

        // Crear registro de aprobación
        $approvalId = $this->approvalsModel->create([
            'tarea_id' => $tareaId,
            'tipo' => $tarea->tipo,
            'estado' => 'pendiente',
            'solicitado_en' => date('Y-m-d H:i:s'),
            'preview_data' => json_encode($preview),
            'reversible' => $tarea->reversible,
            'comando_reversion' => $tarea->comando_reversion
        ]);

        // Actualizar estado de tarea
        $this->tareasModel->update($tareaId, [
            'estado' => 'pendiente_aprobacion',
            'approval_id' => $approvalId
        ]);

        // Notificar a usuarios con permisos de aprobación
        $this->notificarAprobadores($approvalId);

        return $approvalId;
    }

    /**
     * Aprobar una tarea
     */
    public function aprobar(int $approvalId, int $userId, string $comentario = ''): bool {
        $approval = $this->approvalsModel->find($approvalId);

        if ($approval->estado !== 'pendiente') {
            throw new \Exception("La aprobación ya fue procesada");
        }

        // Marcar como aprobada
        $this->approvalsModel->update($approvalId, [
            'estado' => 'aprobada',
            'aprobado_por' => $userId,
            'aprobado_en' => date('Y-m-d H:i:s'),
            'comentario_aprobacion' => $comentario
        ]);

        // Actualizar tarea
        $this->tareasModel->update($approval->tarea_id, [
            'estado' => 'aprobada',
            'aprobada_por' => $userId,
            'aprobada_en' => date('Y-m-d H:i:s')
        ]);

        // EJECUTAR la tarea automáticamente (si es auto-ejecutable)
        $this->ejecutarTareaAprobada($approval->tarea_id);

        return true;
    }

    /**
     * Rechazar una tarea
     */
    public function rechazar(int $approvalId, int $userId, string $razon): bool {
        $approval = $this->approvalsModel->find($approvalId);

        $this->approvalsModel->update($approvalId, [
            'estado' => 'rechazada',
            'rechazado_por' => $userId,
            'rechazado_en' => date('Y-m-d H:i:s'),
            'razon_rechazo' => $razon
        ]);

        $this->tareasModel->update($approval->tarea_id, [
            'estado' => 'rechazada'
        ]);

        return true;
    }

    /**
     * Revertir una tarea ejecutada
     */
    public function revertir(int $tareaId, int $userId, string $razon): bool {
        $tarea = $this->tareasModel->find($tareaId);

        if (!$tarea->reversible) {
            throw new \Exception("Esta tarea no es reversible");
        }

        if ($tarea->estado !== 'completada') {
            throw new \Exception("Solo se pueden revertir tareas completadas");
        }

        // Ejecutar comando de reversión
        $reversionService = new ReversionService();
        $resultado = $reversionService->ejecutarReversion($tarea);

        // Log de reversión
        $this->approvalsModel->create([
            'tarea_id' => $tareaId,
            'tipo' => 'reversion',
            'estado' => 'completada',
            'aprobado_por' => $userId,
            'aprobado_en' => date('Y-m-d H:i:s'),
            'comentario_aprobacion' => "REVERSIÓN: {$razon}",
            'preview_data' => json_encode($resultado)
        ]);

        // Actualizar tarea
        $this->tareasModel->update($tareaId, [
            'estado' => 'revertida',
            'revertida_por' => $userId,
            'revertida_en' => date('Y-m-d H:i:s'),
            'razon_reversion' => $razon
        ]);

        return true;
    }

    private function ejecutarTareaAprobada(int $tareaId): void {
        // Delegar a ExecutionService
        $executionService = new \App\Modules\Tareas\Services\ExecutionService();
        $executionService->ejecutar($tareaId);
    }

    private function notificarAprobadores(int $approvalId): void {
        // Email/notificación a usuarios con rol 'aprobador'
        // TODO: Implementar notificaciones
    }
}
```

### 7.3. ReversionService

```php
<?php
// ABOUTME: Servicio para revertir cambios en producción
// ABOUTME: Ejecuta comandos de reversión guardados

namespace App\Core\Approvals;

class ReversionService {
    /**
     * Ejecuta reversión de una tarea
     */
    public function ejecutarReversion($tarea): array {
        $log = [
            'tarea_id' => $tarea->id,
            'tipo' => $tarea->tipo,
            'timestamp' => date('Y-m-d H:i:s'),
            'acciones' => []
        ];

        // Ejecutar según tipo de tarea
        switch ($tarea->tipo) {
            case 'redirect':
                $log['acciones'][] = $this->revertirRedirect($tarea);
                break;

            case 'contenido':
                $log['acciones'][] = $this->revertirContenido($tarea);
                break;

            case 'meta_tags':
                $log['acciones'][] = $this->revertirMetaTags($tarea);
                break;

            case 'desarrollo':
                // Desarrollo no suele ser auto-reversible
                $log['acciones'][] = [
                    'resultado' => 'manual',
                    'mensaje' => 'Reversión de desarrollo requiere intervención manual'
                ];
                break;

            default:
                // Ejecutar comando de reversión custom
                if ($tarea->comando_reversion) {
                    $log['acciones'][] = $this->ejecutarComandoCustom($tarea->comando_reversion);
                }
        }

        return $log;
    }

    private function revertirRedirect($tarea): array {
        $metadata = json_decode($tarea->metadata_json, true);

        // Obtener configuración de WordPress
        $wpAPI = new \App\Shared\API\WordPressAPI(
            $metadata['wordpress_url'],
            $metadata['wordpress_user'],
            $metadata['wordpress_password']
        );

        // Eliminar redirect (usando plugin Redirection)
        $resultado = $wpAPI->deleteRedirect($metadata['redirect_id']);

        return [
            'accion' => 'eliminar_redirect',
            'redirect_id' => $metadata['redirect_id'],
            'from' => $metadata['redirect_from'],
            'to' => $metadata['redirect_to'],
            'resultado' => $resultado
        ];
    }

    private function revertirContenido($tarea): array {
        $metadata = json_decode($tarea->metadata_json, true);

        $wpAPI = new \App\Shared\API\WordPressAPI(
            $metadata['wordpress_url'],
            $metadata['wordpress_user'],
            $metadata['wordpress_password']
        );

        if ($metadata['accion'] === 'crear') {
            // Si se creó contenido, eliminarlo
            $resultado = $wpAPI->deletePost($metadata['post_id'], force: true);

            return [
                'accion' => 'eliminar_post',
                'post_id' => $metadata['post_id'],
                'resultado' => $resultado
            ];

        } elseif ($metadata['accion'] === 'actualizar') {
            // Si se actualizó contenido, restaurar versión anterior
            $versionAnterior = $metadata['version_anterior'];
            $resultado = $wpAPI->updatePost($metadata['post_id'], [
                'content' => $versionAnterior['content'],
                'title' => $versionAnterior['title']
            ]);

            return [
                'accion' => 'restaurar_version',
                'post_id' => $metadata['post_id'],
                'resultado' => $resultado
            ];
        }
    }

    private function revertirMetaTags($tarea): array {
        $metadata = json_decode($tarea->metadata_json, true);

        $wpAPI = new \App\Shared\API\WordPressAPI(
            $metadata['wordpress_url'],
            $metadata['wordpress_user'],
            $metadata['wordpress_password']
        );

        // Restaurar meta tags anteriores
        $versionAnterior = $metadata['version_anterior'];
        $resultado = $wpAPI->updateYoastMeta(
            $metadata['post_id'],
            $versionAnterior['meta_title'],
            $versionAnterior['meta_description'],
            $versionAnterior['focus_keyword']
        );

        return [
            'accion' => 'restaurar_meta_tags',
            'post_id' => $metadata['post_id'],
            'resultado' => $resultado
        ];
    }

    private function ejecutarComandoCustom(string $comando): array {
        // Ejecutar comando custom de reversión
        // IMPORTANTE: Sanitizar y validar comando por seguridad

        exec($comando, $output, $returnCode);

        return [
            'accion' => 'comando_custom',
            'comando' => $comando,
            'output' => $output,
            'return_code' => $returnCode,
            'resultado' => $returnCode === 0 ? 'success' : 'error'
        ];
    }
}
```

### 7.4. Vista de Aprobaciones (UI)

```php
<?php
// ABOUTME: Vista para gestionar aprobaciones pendientes
// ABOUTME: Muestra preview y permite aprobar/rechazar
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h4 class="page-title">Aprobaciones Pendientes</h4>
</div>

<div class="content">
    <?php foreach ($aprobaciones_pendientes as $approval): ?>
    <div class="card mb-3">
        <div class="card-header bg-warning">
            <h5 class="mb-0">
                <i class="ph-warning me-2"></i>
                <?= htmlspecialchars($approval->tarea_nombre) ?>
                <span class="badge bg-<?= getPrioridadBadge($approval->tarea_prioridad) ?> float-end">
                    <?= ucfirst($approval->tarea_prioridad) ?>
                </span>
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Descripción</h6>
                    <p><?= nl2br(htmlspecialchars($approval->tarea_descripcion)) ?></p>

                    <h6>Tipo</h6>
                    <span class="badge bg-info"><?= ucfirst($approval->tipo) ?></span>

                    <h6 class="mt-3">Impacto Estimado</h6>
                    <p><?= htmlspecialchars($approval->impacto_estimado) ?></p>

                    <h6>URLs Afectadas</h6>
                    <ul>
                        <?php foreach (json_decode($approval->urls_afectadas) as $url): ?>
                        <li><a href="<?= $url ?>" target="_blank"><?= $url ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h6>Preview</h6>
                    <div class="border p-3 bg-light">
                        <?php $preview = json_decode($approval->preview_data, true); ?>

                        <?php if ($approval->tipo === 'redirect'): ?>
                            <strong>Redirect:</strong><br>
                            FROM: <code><?= $preview['from'] ?></code><br>
                            TO: <code><?= $preview['to'] ?></code><br>
                            Tipo: <?= $preview['tipo'] ?> (<?= $preview['tipo'] === '301' ? 'Permanente' : 'Temporal' ?>)

                        <?php elseif ($approval->tipo === 'contenido'): ?>
                            <strong>Contenido:</strong><br>
                            Título: <?= htmlspecialchars($preview['title']) ?><br>
                            Palabras: <?= $preview['word_count'] ?><br>
                            <a href="<?= $preview['preview_url'] ?>" target="_blank" class="btn btn-sm btn-primary mt-2">
                                <i class="ph-eye me-1"></i> Ver Preview en WordPress
                            </a>

                        <?php elseif ($approval->tipo === 'meta_tags'): ?>
                            <strong>Meta Tags:</strong><br>
                            Title: <code><?= htmlspecialchars($preview['meta_title']) ?></code><br>
                            Description: <code><?= htmlspecialchars($preview['meta_description']) ?></code><br>
                            Keyword: <?= htmlspecialchars($preview['focus_keyword']) ?>

                        <?php endif; ?>
                    </div>

                    <?php if ($approval->reversible): ?>
                    <div class="alert alert-success mt-3">
                        <i class="ph-arrow-counter-clockwise me-2"></i>
                        Esta acción es <strong>reversible</strong>. Puedes deshacerla si es necesario.
                    </div>
                    <?php else: ?>
                    <div class="alert alert-danger mt-3">
                        <i class="ph-warning me-2"></i>
                        Esta acción <strong>NO es reversible</strong>. Revisa cuidadosamente antes de aprobar.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <div>
                <small class="text-muted">
                    Solicitada: <?= date('d/m/Y H:i', strtotime($approval->solicitado_en)) ?>
                </small>
            </div>
            <div>
                <button
                    class="btn btn-success"
                    onclick="aprobar(<?= $approval->id ?>)">
                    <i class="ph-check-circle me-1"></i>
                    Aprobar y Ejecutar
                </button>
                <button
                    class="btn btn-danger"
                    onclick="rechazar(<?= $approval->id ?>)">
                    <i class="ph-x-circle me-1"></i>
                    Rechazar
                </button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($aprobaciones_pendientes)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="ph-check-circle text-success" style="font-size: 64px;"></i>
            <h5 class="mt-3">No hay aprobaciones pendientes</h5>
            <p class="text-muted">Todas las tareas están aprobadas o completadas.</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function aprobar(approvalId) {
    const comentario = prompt('Comentario de aprobación (opcional):');
    if (comentario === null) return;  // Cancelado

    fetch(`/aprobaciones/${approvalId}/aprobar`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ comentario })
    })
    .then(res => res.json())
    .then(data => {
        alert('Tarea aprobada y ejecutada exitosamente');
        location.reload();
    })
    .catch(err => {
        alert('Error al aprobar: ' + err.message);
    });
}

function rechazar(approvalId) {
    const razon = prompt('¿Por qué rechazas esta tarea?');
    if (!razon) {
        alert('Debes proporcionar una razón');
        return;
    }

    fetch(`/aprobaciones/${approvalId}/rechazar`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ razon })
    })
    .then(res => res.json())
    .then(data => {
        alert('Tarea rechazada');
        location.reload();
    })
    .catch(err => {
        alert('Error al rechazar: ' + err.message);
    });
}
</script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
```

---

## 8. Módulo: Creación y Modificación de Webs

### 8.1. Tipos de Proyectos Web

```php
<?php
// ABOUTME: Enum para tipos de proyectos web
// ABOUTME: Define si es creación nueva, modificación o rediseño

namespace App\Modules\WebsProjects\Enums;

enum TipoProyectoWeb: string {
    case CREACION_NUEVA = 'creacion_nueva';           // Web no existe
    case MODIFICACION_EXISTENTE = 'modificacion';     // Web existe, cambios
    case REDISENO_COMPLETO = 'rediseno';              // Web existe, rediseño total
    case MIGRACION = 'migracion';                     // Cambio de plataforma/dominio
}

enum PlataformaWeb: string {
    case WORDPRESS = 'wordpress';
    case SHOPIFY = 'shopify';
    case CUSTOM_PHP = 'custom_php';
    case NEXTJS = 'nextjs';
    case OTRO = 'otro';
}
```

### 8.2. WebProjectService

```php
<?php
// ABOUTME: Servicio para gestión de proyectos de creación/modificación de webs
// ABOUTME: Orquesta IA, auditorías, desarrollo y deployment

namespace App\Modules\WebsProjects\Services;

use App\Modules\WebsProjects\Enums\TipoProyectoWeb;
use App\Modules\WebsProjects\Enums\PlataformaWeb;
use App\Core\AIService\AIServiceFactory;

class WebProjectService {
    private $ai;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
    }

    /**
     * Inicia proyecto de creación/modificación de web
     */
    public function iniciarProyecto(
        int $clienteId,
        TipoProyectoWeb $tipo,
        PlataformaWeb $plataforma,
        array $opciones = []
    ): array {
        $flujo = match($tipo) {
            TipoProyectoWeb::CREACION_NUEVA => $this->flujoCreacionNueva($clienteId, $plataforma, $opciones),
            TipoProyectoWeb::MODIFICACION_EXISTENTE => $this->flujoModificacionExistente($clienteId, $opciones),
            TipoProyectoWeb::REDISENO_COMPLETO => $this->flujoRedisenoCompleto($clienteId, $plataforma, $opciones),
            TipoProyectoWeb::MIGRACION => $this->flujoMigracion($clienteId, $opciones)
        };

        return $flujo;
    }

    /**
     * Flujo: CREACIÓN DE WEB NUEVA (sin auditoría previa)
     */
    private function flujoCreacionNueva(int $clienteId, PlataformaWeb $plataforma, array $opciones): array {
        $log = ['tipo' => 'creacion_nueva', 'fases' => []];

        // FASE 1: Brief y Plan (obligatorio)
        $log['fases'][] = $this->ejecutarBriefYPlan($clienteId);

        // FASE 2: IA diseña arquitectura SEO desde cero
        $auditoriaService = new \App\Modules\AuditoriaSEO\Services\AuditoriaOrchestrator();
        $arquitectura = $auditoriaService->ejecutarAuditoria(
            $clienteId,
            \App\Modules\AuditoriaSEO\Enums\TipoAuditoria::PRE_DESARROLLO,
            ['plataforma' => $plataforma->value]
        );
        $log['fases'][] = ['fase' => 'arquitectura_seo', 'resultado' => $arquitectura];

        // FASE 3: IA genera especificación técnica de la web
        $especificacion = $this->generarEspecificacionTecnica($clienteId, $arquitectura, $plataforma);
        $log['fases'][] = ['fase' => 'especificacion_tecnica', 'resultado' => $especificacion];

        // FASE 4: IA genera tareas de desarrollo
        $tareasService = new \App\Modules\Tareas\Services\TareasGeneratorService();
        $tareas = $this->generarTareasDesarrollo($clienteId, $especificacion, $plataforma);
        $log['fases'][] = ['fase' => 'tareas_desarrollo', 'total' => count($tareas)];

        // FASE 5: Sincronizar con Odoo
        $tareasService->sincronizarConOdoo($clienteId, $tareas);
        $log['fases'][] = ['fase' => 'sincronizacion_odoo', 'resultado' => 'ok'];

        // FASE 6: Auditoría POST-DESARROLLO (cuando terminen las tareas)
        // Nota: Se ejecutará manualmente cuando desarrollo esté completo

        return $log;
    }

    /**
     * Flujo: MODIFICACIÓN DE WEB EXISTENTE (con auditoría)
     */
    private function flujoModificacionExistente(int $clienteId, array $opciones): array {
        $log = ['tipo' => 'modificacion', 'fases' => []];

        // FASE 1: Auditoría de web existente
        $auditoriaService = new \App\Modules\AuditoriaSEO\Services\AuditoriaOrchestrator();
        $auditoria = $auditoriaService->ejecutarAuditoria(
            $clienteId,
            \App\Modules\AuditoriaSEO\Enums\TipoAuditoria::POST_DESARROLLO,
            []
        );
        $log['fases'][] = ['fase' => 'auditoria', 'resultado' => $auditoria];

        // FASE 2: IA genera tareas de mejora
        $tareasService = new \App\Modules\Tareas\Services\TareasGeneratorService();
        $tareas = $tareasService->generarTareasDesdeAuditoria($clienteId, $auditoria);
        $log['fases'][] = ['fase' => 'tareas_mejora', 'total' => count($tareas)];

        // FASE 3: Las tareas se ejecutan con aprobación humana
        // (Workflow de aprobaciones automático)

        return $log;
    }

    private function generarEspecificacionTecnica(int $clienteId, array $arquitectura, PlataformaWeb $plataforma): array {
        $brief = $this->loadJSON("data/clientes/$clienteId/brief.json");
        $plan = $this->loadJSON("data/clientes/$clienteId/plan_marketing.json");

        $prompt = <<<PROMPT
# Tarea: Generar Especificación Técnica de Web

## Contexto
Cliente: [ID: {$clienteId}]
Plataforma: {$plataforma->value}

## Brief
{json_encode($brief, JSON_PRETTY_PRINT)}

## Plan de Marketing
{json_encode($plan, JSON_PRETTY_PRINT)}

## Arquitectura SEO
{json_encode($arquitectura, JSON_PRETTY_PRINT)}

## Tu Misión

Genera especificación técnica completa para desarrollar esta web.

Devuelve JSON con:
{
  "estructura_paginas": [
    {
      "url": "/",
      "tipo": "homepage",
      "template": "home",
      "secciones": ["hero", "servicios", "testimonios", "cta"],
      "contenido_requerido": {
        "hero": {
          "titulo": "...",
          "subtitulo": "...",
          "cta_texto": "...",
          "imagen": "hero-image.jpg"
        },
        "servicios": [...],
        "testimonios": [...]
      },
      "seo": {
        "title": "...",
        "meta_description": "...",
        "h1": "...",
        "keywords": [...]
      }
    }
  ],
  "funcionalidades": [
    {
      "nombre": "Formulario de contacto",
      "descripcion": "...",
      "ubicacion": ["pagina-contacto", "footer"],
      "campos": [...],
      "integraciones": ["email", "crm"]
    }
  ],
  "diseno": {
    "paleta_colores": {
      "primario": "#...",
      "secundario": "#...",
      "acento": "#..."
    },
    "tipografia": {
      "headings": "...",
      "body": "..."
    },
    "componentes": ["navbar", "footer", "cards", "forms", "buttons"]
  },
  "integraciones": [
    {
      "servicio": "Google Analytics 4",
      "tracking_id": "...",
      "eventos": [...]
    },
    {
      "servicio": "Google Search Console",
      "verificacion": "..."
    }
  ],
  "requisitos_tecnicos": {
    "hosting": "...",
    "ssl": true,
    "cdn": true,
    "performance": {
      "target_lcp": "< 2.5s",
      "target_fid": "< 100ms",
      "target_cls": "< 0.1"
    }
  }
}

**IMPORTANTE:**
- Especificación debe ser ejecutable por desarrolladores
- Contenido debe alinearse con keywords de arquitectura SEO
- Diseño coherente con sector del cliente
- Funcionalidades según presupuesto
PROMPT;

        $response = $this->ai->chat($prompt, options: ['max_tokens' => 10000]);
        $especificacion = $this->extractJSONFromResponse($response->content);

        // Guardar
        $this->saveJSON("data/clientes/$clienteId/especificacion_web.json", $especificacion);

        return $especificacion;
    }

    private function generarTareasDesarrollo(int $clienteId, array $especificacion, PlataformaWeb $plataforma): array {
        $prompt = <<<PROMPT
# Tarea: Convertir Especificación en Tareas de Desarrollo

## Especificación Web
{json_encode($especificacion, JSON_PRETTY_PRINT)}

## Plataforma
{$plataforma->value}

## Tu Misión

Genera tareas granulares de desarrollo para implementar esta web.

Categorías de tareas:
1. **Setup:** Instalación, configuración inicial
2. **Diseño:** Templates, componentes visuales
3. **Desarrollo:** Páginas, funcionalidades
4. **Contenido:** Redacción, imágenes, SEO
5. **Integraciones:** Analytics, formularios, APIs
6. **Testing:** QA, performance, SEO
7. **Deployment:** Migración a producción

Para cada tarea:
{
  "nombre": "...",
  "descripcion": "...",
  "tipo": "setup|diseno|desarrollo|contenido|integracion|testing|deployment",
  "categoria": "...",
  "prioridad": "alta|media|baja",
  "dependencias": [],  // IDs de tareas previas
  "horas_estimadas": X,
  "skills": ["wordpress", "php", "seo", ...],
  "entregables": [...],
  "criterio_aceptacion": "..."
}

**IMPORTANTE:**
- Orden lógico de implementación (setup → diseño → desarrollo → contenido → testing → deployment)
- Dependencias claras
- Horas realistas
PROMPT;

        $response = $this->ai->chat($prompt);
        $tareasData = $this->extractJSONFromResponse($response->content);

        // Crear tareas en BD
        $tareasModel = new \App\Modules\Tareas\Models\Tarea();
        $tareas = [];

        foreach ($tareasData['tareas'] as $tarea) {
            $tareaId = $tareasModel->create([
                'cliente_id' => $clienteId,
                'nombre' => $tarea['nombre'],
                'descripcion' => $tarea['descripcion'],
                'tipo' => $tarea['tipo'],
                'prioridad' => $tarea['prioridad'],
                'horas_estimadas' => $tarea['horas_estimadas'],
                'skills_requeridos' => json_encode($tarea['skills']),
                'estado' => 'pendiente',
                'reversible' => false,  // Desarrollo no suele ser reversible
                'requiere_aprobacion' => ($tarea['tipo'] === 'deployment'),  // Solo deployment requiere aprobación
                'criterio_aceptacion' => $tarea['criterio_aceptacion'],
                'metadata_json' => json_encode($tarea),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $tareas[] = array_merge($tarea, ['id' => $tareaId]);
        }

        return $tareas;
    }

    private function ejecutarBriefYPlan(int $clienteId): array {
        // Asegurarse de que brief y plan existen
        $briefPath = "data/clientes/$clienteId/brief.json";
        $planPath = "data/clientes/$clienteId/plan_marketing.json";

        if (!file_exists($briefPath)) {
            // Generar brief con IA
            $briefService = new \App\Modules\Cliente\Services\BriefGeneratorService();
            // Asumimos que ya se completó formulario inicial
        }

        if (!file_exists($planPath)) {
            // Generar plan con IA
            $planService = new \App\Modules\PlanMarketing\Services\PlanMarketingGeneratorService();
            $planService->generarPlan($clienteId);
        }

        return [
            'brief' => file_exists($briefPath),
            'plan' => file_exists($planPath)
        ];
    }

    // Métodos auxiliares
    private function loadJSON(string $path): array {
        $fullPath = __DIR__ . "/../../../../$path";
        return json_decode(file_get_contents($fullPath), true);
    }

    private function saveJSON(string $path, array $data): void {
        $fullPath = __DIR__ . "/../../../../$path";
        file_put_contents($fullPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        return json_decode($matches[0] ?? '{}', true);
    }
}
```

---

## 9. Estrategia MCP vs API (Decisión de IA)

### 9.1. Principio de Decisión Inteligente

La IA decide en tiempo real si usar MCP o API directa según:
- **Disponibilidad**: ¿Existe herramienta MCP?
- **Funcionalidad**: ¿MCP cubre la necesidad?
- **Performance**: ¿Cuál es más eficiente?
- **Mantenibilidad**: ¿Cuál es más fácil de mantener?

### 9.2. IntegrationStrategyService

```php
<?php
// ABOUTME: Servicio para decidir estrategia de integración (MCP vs API)
// ABOUTME: IA evalúa y selecciona mejor opción

namespace App\Core\Integrations;

use App\Core\AIService\AIServiceFactory;

class IntegrationStrategyService {
    private $ai;
    private $mcpRegistry;
    private $apiRegistry;

    public function __construct() {
        $this->ai = AIServiceFactory::create();
        $this->mcpRegistry = new MCPToolsRegistry();
        $this->apiRegistry = new APIRegistry();
    }

    /**
     * Decide si usar MCP o API para una integración
     */
    public function decidirEstrategia(string $servicio, string $accion, array $contexto = []): array {
        // Obtener herramientas disponibles
        $mcpDisponible = $this->mcpRegistry->exists($servicio, $accion);
        $apiDisponible = $this->apiRegistry->exists($servicio, $accion);

        // Si solo hay una opción, usarla
        if ($mcpDisponible && !$apiDisponible) {
            return ['estrategia' => 'mcp', 'razon' => 'Solo MCP disponible'];
        }
        if (!$mcpDisponible && $apiDisponible) {
            return ['estrategia' => 'api', 'razon' => 'Solo API disponible'];
        }
        if (!$mcpDisponible && !$apiDisponible) {
            return ['estrategia' => 'ninguna', 'razon' => 'No hay integración disponible'];
        }

        // Ambas disponibles → IA decide
        $prompt = <<<PROMPT
# Decisión: MCP vs API

Servicio: {$servicio}
Acción: {$accion}

## Contexto
{json_encode($contexto, JSON_PRETTY_PRINT)}

## MCP Tool Disponible
{json_encode($this->mcpRegistry->getInfo($servicio, $accion), JSON_PRETTY_PRINT)}

## API Disponible
{json_encode($this->apiRegistry->getInfo($servicio, $accion), JSON_PRETTY_PRINT)}

## Tu Misión

Decide qué estrategia usar: MCP o API directa.

Criterios:
1. **Funcionalidad**: ¿Cuál cubre mejor la necesidad?
2. **Performance**: ¿Cuál es más rápido?
3. **Mantenibilidad**: ¿Cuál es más fácil de mantener?
4. **Confiabilidad**: ¿Cuál es más estable?
5. **Contexto específico**: Según el caso de uso

Devuelve JSON:
{
  "estrategia": "mcp|api",
  "razon": "...",
  "ventajas": [...],
  "desventajas": [...]
}
PROMPT;

        $response = $this->ai->chat($prompt);
        return $this->extractJSONFromResponse($response->content);
    }

    /**
     * Ejecuta acción usando estrategia decidida
     */
    public function ejecutar(string $servicio, string $accion, array $params): mixed {
        $estrategia = $this->decidirEstrategia($servicio, $accion, ['params' => $params]);

        if ($estrategia['estrategia'] === 'mcp') {
            return $this->mcpRegistry->execute($servicio, $accion, $params);
        } elseif ($estrategia['estrategia'] === 'api') {
            return $this->apiRegistry->execute($servicio, $accion, $params);
        } else {
            throw new \Exception("No hay integración disponible para {$servicio}.{$accion}");
        }
    }

    private function extractJSONFromResponse(string $content): array {
        preg_match('/\{[\s\S]*\}/', $content, $matches);
        return json_decode($matches[0] ?? '{}', true);
    }
}
```

---

## 10. Actualización del Roadmap

### 10.1. Nuevo Roadmap con IA Integrada (16 semanas)

```
FASE 0: Setup + IA Core (Semanas 1-2)
├─> Semana 1: Infraestructura base
│   - Docker, BD, Limitless template
│   - Core PHP (Router, Database, Auth)
└─> Semana 2: AIService + MCP
    - ClaudeProvider, OpenAIProvider
    - MCP Tools Registry
    - Integration Strategy Service

FASE 1: Módulos Core con IA (Semanas 3-5)
├─> Semana 3: Módulo Cliente + Brief IA
│   - CRUD clientes
│   - BriefGeneratorService (IA)
│   - Preguntas inteligentes IA
└─> Semanas 4-5: Plan Marketing + Auditoría IA
    - PlanMarketingGeneratorService (IA)
    - AuditoriaOrchestrator (IA)
    - Multi-idioma support
    - Pre-desarrollo vs Post-desarrollo

FASE 2: Sistema de Tareas + Odoo (Semanas 6-7)
├─> Semana 6: Generación de Tareas IA
│   - TareasGeneratorService (IA)
│   - Conversión auditoría → tareas
│   - Priorización inteligente
└─> Semana 7: Integración Odoo
    - OdooAPIService (REST)
    - Sincronización bidireccional
    - Webhooks

FASE 3: Aprobaciones + Reversibilidad (Semana 8)
└─> ApprovalService
    - Workflow aprobaciones
    - Preview obligatorio
    - ReversionService
    - Logs completos

FASE 4: Proyectos Web (Semanas 9-11)
├─> Semana 9: Creación de Webs Nuevas
│   - WebProjectService
│   - Especificación técnica IA
│   - Generación tareas desarrollo
├─> Semana 10: Modificación Webs Existentes
│   - Flujo con auditoría
│   - Tareas de mejora IA
└─> Semana 11: WordPress Integration
    - WordPressAPI completo
    - MCP WordPress tools
    - Content generation IA

FASE 5: Automatizaciones MCP (Semanas 12-13)
├─> Semana 12: Ejecución Automatizada
│   - MCPService
│   - Drip mode execution
│   - Logging obligatorio
└─> Semana 13: Más Integraciones
    - Google APIs (GSC, GA4)
    - Screaming Frog MCP
    - Ahrefs (opcional)

FASE 6: Testing E2E + Security (Semana 14)
└─> Testing completo
    - Flujos E2E con IA
    - Security testing
    - Performance testing

FASE 7: Deployment + Docs (Semanas 15-16)
└─> Producción
    - Docker production
    - SSL, backups
    - Monitoring
    - Documentación completa
```

### 10.2. Métricas de Éxito Actualizadas

**Funcionales:**
- ✅ Brief generado por IA (< 10 min)
- ✅ Plan de marketing completo por IA (< 15 min)
- ✅ Auditoría SEO automatizada (< 30 min)
- ✅ Tareas generadas y sincronizadas con Odoo
- ✅ Aprobaciones humanas antes de producción
- ✅ 100% acciones reversibles
- ✅ Logs completos de toda interacción IA

**Técnicos:**
- ✅ IA configurable (Claude, OpenAI, Gemini)
- ✅ MCP vs API decidido por IA
- ✅ Multi-idioma soportado
- ✅ Pre-desarrollo y Post-desarrollo
- ✅ Integración Odoo bidireccional
- ✅ Sistema de aprobaciones robusto

---

## 11. Configuración .env Completa

```bash
# ============================================
# IA Configuration
# ============================================
AI_DEFAULT_PROVIDER=claude
AI_CLAUDE_API_KEY=sk-ant-xxxxx
AI_CLAUDE_MODEL=claude-sonnet-4-5-20250929
AI_OPENAI_API_KEY=sk-xxxxx
AI_OPENAI_MODEL=gpt-4o
AI_MAX_TOKENS=8000
AI_TEMPERATURE=0.7
AI_LOG_PROMPTS=true
AI_LOG_PATH=data/logs/ai_interactions.json

# ============================================
# Odoo Integration
# ============================================
ODOO_URL=https://tuempresa.odoo.com
ODOO_DATABASE=tuempresa-prod
ODOO_USERNAME=admin@tuempresa.com
ODOO_PASSWORD=xxxxx
ODOO_API_KEY=xxxxx

# ============================================
# MCP Tools
# ============================================
MCP_ENABLED=true
MCP_TOOLS_PATH=config/mcp_tools.json

# ============================================
# Google APIs
# ============================================
GOOGLE_CLIENT_ID=xxxxx
GOOGLE_CLIENT_SECRET=xxxxx
GOOGLE_REDIRECT_URI=https://tu-mcp.com/auth/google/callback

# ============================================
# Screaming Frog
# ============================================
SCREAMING_FROG_PATH="C:\Program Files (x86)\Screaming Frog SEO Spider\ScreamingFrogSEOSpiderCli.exe"
SCREAMING_FROG_LICENSE=xxxxx

# ============================================
# Approvals & Reversibility
# ============================================
APPROVAL_REQUIRED_FOR_PRODUCTION=true
APPROVAL_TIMEOUT_HOURS=48
REVERSIBILITY_LOG_PATH=data/logs/reversions.json
```

---

**FIN DEL DOCUMENTO**

Migue, este documento completo define la arquitectura con:

1. ✅ **IA como motor de decisión integrado**
2. ✅ **Creación y modificación de webs** (con/sin auditoría)
3. ✅ **Aprobaciones humanas obligatorias** pre-producción
4. ✅ **Reversibilidad total** de acciones
5. ✅ **Integración Odoo** (REST API, bidireccional)
6. ✅ **MCP vs API decidido por IA**
7. ✅ **Roadmap actualizado** (16 semanas)

¿Necesitas que desarrolle alguna sección más en profundidad o comenzamos la implementación?