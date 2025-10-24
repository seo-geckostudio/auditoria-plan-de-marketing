# Arquitectura Sistema Automatizado de Auditoría SEO v2.0

## Visión General

**Objetivo**: Sistema SaaS que permita generar auditorías SEO completas automáticamente usando IA, partiendo de archivos CSV y APIs de herramientas SEO.

**Flujo de Usuario**:
```
Cliente registra cuenta → Sube archivos CSV/conecta APIs →
IA procesa automáticamente → Sistema genera auditoría completa →
Cliente descarga PDF + accede a dashboard web
```

---

## Stack Tecnológico Recomendado

### Opción Recomendada: **Laravel + Vue.js + PostgreSQL + Claude AI**

**Backend**: Laravel 11
- Framework PHP maduro y popular
- ORM Eloquent para base de datos
- Sistema de colas (Jobs) para procesamiento asíncrono
- API RESTful nativa
- Autenticación robusta (Sanctum)

**Frontend**: Vue.js 3 + Inertia.js
- Componentes reactivos
- SPA sin complejidad de API separada
- Tailwind CSS para diseño rápido

**Base de Datos**: PostgreSQL 16
- JSONB para datos flexibles
- Mejor rendimiento que MySQL
- Soporte nativo para búsqueda full-text

**IA**: Anthropic Claude API
- Claude 3.5 Sonnet para análisis
- Mejor en análisis estructurado que GPT
- Pricing competitivo

**Procesamiento de archivos**: Laravel Excel + Spatie
- Parser de CSV robusto
- Validación de datos
- Transformación automática

**Generación de PDF**: Browsershot (Puppeteer)
- HTML → PDF de alta calidad
- Gráficos renderizados correctamente
- Control total sobre layout

**Hosting**: DigitalOcean App Platform / AWS
- Escalable
- CI/CD integrado
- Base de datos managed

---

## Arquitectura de Base de Datos

```sql
-- USUARIOS Y AUTENTICACIÓN
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    company_name VARCHAR(255),
    plan_type VARCHAR(50) DEFAULT 'free', -- free, basic, pro, enterprise
    credits_remaining INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- PROYECTOS (CLIENTES FINALES)
CREATE TABLE projects (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    name VARCHAR(255) NOT NULL,
    domain VARCHAR(255) NOT NULL,
    industry VARCHAR(100),
    status VARCHAR(50) DEFAULT 'draft', -- draft, processing, completed, delivered
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- AUDITORÍAS (UNA POR PROYECTO)
CREATE TABLE audits (
    id BIGSERIAL PRIMARY KEY,
    project_id BIGINT REFERENCES projects(id),
    audit_type VARCHAR(50) DEFAULT 'complete', -- complete, keyword-only, technical-only
    processing_status VARCHAR(50) DEFAULT 'pending',
    progress_percentage INT DEFAULT 0,
    completed_at TIMESTAMP NULL,
    pdf_generated_at TIMESTAMP NULL,
    pdf_url TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- ARCHIVOS SUBIDOS
CREATE TABLE uploaded_files (
    id BIGSERIAL PRIMARY KEY,
    audit_id BIGINT REFERENCES audits(id),
    file_type VARCHAR(100) NOT NULL, -- ahrefs_organic, gsc_queries, ga4_traffic, etc.
    original_filename VARCHAR(255),
    storage_path TEXT,
    file_size BIGINT,
    row_count INT,
    processed BOOLEAN DEFAULT false,
    processed_at TIMESTAMP NULL,
    validation_errors JSONB DEFAULT '[]',
    created_at TIMESTAMP
);

-- DATOS PROCESADOS (ESTRUCTURADOS)
CREATE TABLE processed_data (
    id BIGSERIAL PRIMARY KEY,
    audit_id BIGINT REFERENCES audits(id),
    data_type VARCHAR(100) NOT NULL, -- keywords, competitors, backlinks, etc.
    raw_data JSONB NOT NULL,
    processed_data JSONB NOT NULL,
    metadata JSONB DEFAULT '{}',
    created_at TIMESTAMP
);

-- ANÁLISIS GENERADOS POR IA
CREATE TABLE ai_insights (
    id BIGSERIAL PRIMARY KEY,
    audit_id BIGINT REFERENCES audits(id),
    insight_type VARCHAR(100) NOT NULL, -- problem, opportunity, recommendation
    category VARCHAR(100), -- technical, content, keywords, links, etc.
    priority VARCHAR(20) DEFAULT 'medium', -- low, medium, high, critical
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    evidence JSONB DEFAULT '[]', -- referencias a datos que soportan el insight
    impact_score INT DEFAULT 0, -- 0-100
    effort_score INT DEFAULT 0, -- 0-100 (menor = más fácil)
    expected_results TEXT,
    implementation_steps JSONB DEFAULT '[]',
    tokens_used INT DEFAULT 0,
    model_version VARCHAR(50),
    created_at TIMESTAMP
);

-- RECOMENDACIONES PRIORIZADAS
CREATE TABLE recommendations (
    id BIGSERIAL PRIMARY KEY,
    audit_id BIGINT REFERENCES audits(id),
    ai_insight_id BIGINT REFERENCES ai_insights(id) NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(100),
    priority INT DEFAULT 0, -- orden de prioridad calculado
    quick_win BOOLEAN DEFAULT false,
    estimated_hours DECIMAL(10,2),
    expected_improvement TEXT,
    resources_needed JSONB DEFAULT '[]',
    status VARCHAR(50) DEFAULT 'pending', -- pending, in_progress, completed, skipped
    created_at TIMESTAMP
);

-- PLANTILLAS DE PROMPTS PARA IA
CREATE TABLE ai_prompts (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    prompt_template TEXT NOT NULL,
    variables JSONB DEFAULT '[]', -- lista de variables requeridas
    model VARCHAR(50) DEFAULT 'claude-3-5-sonnet',
    max_tokens INT DEFAULT 4000,
    temperature DECIMAL(3,2) DEFAULT 0.7,
    is_active BOOLEAN DEFAULT true,
    version INT DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- LOGS DE PROCESAMIENTO
CREATE TABLE processing_logs (
    id BIGSERIAL PRIMARY KEY,
    audit_id BIGINT REFERENCES audits(id),
    step VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL, -- started, completed, failed
    message TEXT,
    duration_seconds INT,
    created_at TIMESTAMP
);

-- CONFIGURACIÓN DE AUDITORÍA
CREATE TABLE audit_configurations (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES users(id),
    name VARCHAR(255),
    modules_enabled JSONB DEFAULT '[]', -- lista de módulos a incluir
    branding JSONB DEFAULT '{}', -- logo, colores, footer
    is_default BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- ÍNDICES
CREATE INDEX idx_audits_project_id ON audits(project_id);
CREATE INDEX idx_uploaded_files_audit_id ON uploaded_files(audit_id);
CREATE INDEX idx_ai_insights_audit_id ON ai_insights(audit_id);
CREATE INDEX idx_ai_insights_priority ON ai_insights(priority);
CREATE INDEX idx_processed_data_audit_id ON processed_data(audit_id);
CREATE INDEX idx_recommendations_audit_id ON recommendations(audit_id);
CREATE INDEX idx_recommendations_priority ON recommendations(priority);
```

---

## Arquitectura de la Aplicación

```
┌─────────────────────────────────────────────────────────┐
│                     FRONTEND                            │
│  Vue.js 3 + Inertia.js + Tailwind CSS                  │
│  ┌─────────────┬──────────────┬──────────────┐         │
│  │  Dashboard  │ File Upload  │  Report View │         │
│  │   Panel     │    Wizard    │   Dashboard  │         │
│  └─────────────┴──────────────┴──────────────┘         │
└────────────────────┬────────────────────────────────────┘
                     │ HTTP/JSON
                     ▼
┌─────────────────────────────────────────────────────────┐
│                  LARAVEL BACKEND                        │
│  ┌──────────────────────────────────────────────────┐  │
│  │             API Controllers                       │  │
│  │  - AuditController                               │  │
│  │  - FileUploadController                          │  │
│  │  - ReportController                              │  │
│  └─────────────────┬────────────────────────────────┘  │
│                    │                                    │
│  ┌─────────────────▼────────────────────────────────┐  │
│  │             Services Layer                        │  │
│  │  - AuditProcessingService                        │  │
│  │  - AIAnalysisService                             │  │
│  │  - ReportGenerationService                       │  │
│  │  - FileParserService                             │  │
│  └─────────────────┬────────────────────────────────┘  │
│                    │                                    │
│  ┌─────────────────▼────────────────────────────────┐  │
│  │          Job Queue (Redis)                        │  │
│  │  - ProcessUploadedFilesJob                       │  │
│  │  - GenerateAIInsightsJob                         │  │
│  │  - CreatePDFReportJob                            │  │
│  │  - SendReportReadyNotificationJob                │  │
│  └─────────────────┬────────────────────────────────┘  │
│                    │                                    │
└────────────────────┼────────────────────────────────────┘
                     │
    ┌────────────────┼────────────────┐
    │                │                │
    ▼                ▼                ▼
┌─────────┐  ┌──────────────┐  ┌──────────┐
│PostgreSQL│  │ Claude AI    │  │ Storage  │
│ Database │  │ API (Anthropic)│ │ (S3/DO)  │
└─────────┘  └──────────────┘  └──────────┘
```

---

## Módulos Principales

### 1. **File Upload & Validation Module**

**Responsabilidad**: Recibir, validar y almacenar archivos CSV

```php
// app/Services/FileUploadService.php
class FileUploadService
{
    public function processUpload(UploadedFile $file, string $fileType, int $auditId): ProcessedFile
    {
        // 1. Validar formato y tamaño
        $this->validateFile($file, $fileType);

        // 2. Guardar archivo original
        $path = $file->store("audits/{$auditId}/uploads");

        // 3. Parsear CSV y validar estructura
        $data = $this->parseCSV($path, $fileType);

        // 4. Validar columnas esperadas
        $this->validateColumns($data, $fileType);

        // 5. Guardar en BD
        $uploadedFile = UploadedFile::create([
            'audit_id' => $auditId,
            'file_type' => $fileType,
            'storage_path' => $path,
            'row_count' => count($data),
            'processed' => false
        ]);

        // 6. Disparar Job de procesamiento
        ProcessUploadedFilesJob::dispatch($uploadedFile);

        return $uploadedFile;
    }
}
```

### 2. **AI Analysis Module**

**Responsabilidad**: Analizar datos con IA y generar insights

```php
// app/Services/AIAnalysisService.php
class AIAnalysisService
{
    protected $anthropic;

    public function analyzeKeywordOpportunities(array $keywordData, array $competitorData): array
    {
        $prompt = $this->buildPrompt('keyword_opportunities', [
            'keywords' => $keywordData,
            'competitors' => $competitorData
        ]);

        $response = $this->anthropic->messages()->create([
            'model' => 'claude-3-5-sonnet-20241022',
            'max_tokens' => 4000,
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ]
        ]);

        $insights = $this->parseAIResponse($response->content);

        // Guardar insights en BD
        foreach ($insights as $insight) {
            AIInsight::create([
                'audit_id' => $auditId,
                'insight_type' => $insight['type'],
                'category' => 'keywords',
                'priority' => $insight['priority'],
                'title' => $insight['title'],
                'description' => $insight['description'],
                'evidence' => $insight['evidence'],
                'tokens_used' => $response->usage->total_tokens,
                'model_version' => 'claude-3-5-sonnet'
            ]);
        }

        return $insights;
    }

    protected function buildPrompt(string $template, array $data): string
    {
        $promptTemplate = AIPrompt::where('name', $template)->first();

        // Reemplazar variables en template
        $prompt = $promptTemplate->prompt_template;
        foreach ($data as $key => $value) {
            $prompt = str_replace("{{" . $key . "}}", json_encode($value), $prompt);
        }

        return $prompt;
    }
}
```

### 3. **Report Generation Module**

**Responsabilidad**: Generar PDF y dashboard web

```php
// app/Services/ReportGenerationService.php
class ReportGenerationService
{
    public function generatePDF(int $auditId): string
    {
        $audit = Audit::with([
            'project',
            'insights',
            'recommendations',
            'processedData'
        ])->findOrFail($auditId);

        // 1. Preparar datos para la vista
        $data = $this->prepareReportData($audit);

        // 2. Renderizar HTML desde blade template
        $html = view('reports.pdf.complete', $data)->render();

        // 3. Generar PDF con Browsershot
        $pdfPath = storage_path("app/audits/{$auditId}/report.pdf");

        Browsershot::html($html)
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->showBackground()
            ->save($pdfPath);

        // 4. Subir a storage cloud
        $url = Storage::disk('s3')->putFile("reports/{$auditId}", $pdfPath);

        // 5. Actualizar audit
        $audit->update([
            'pdf_generated_at' => now(),
            'pdf_url' => $url
        ]);

        return $url;
    }
}
```

### 4. **Job Queue Processors**

```php
// app/Jobs/GenerateAIInsightsJob.php
class GenerateAIInsightsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $auditId) {}

    public function handle(AIAnalysisService $aiService): void
    {
        $audit = Audit::findOrFail($this->auditId);

        // Obtener datos procesados
        $keywordData = ProcessedData::where('audit_id', $this->auditId)
            ->where('data_type', 'keywords')
            ->first()->processed_data;

        $competitorData = ProcessedData::where('audit_id', $this->auditId)
            ->where('data_type', 'competitors')
            ->first()->processed_data;

        // Analizar con IA
        $aiService->analyzeKeywordOpportunities($keywordData, $competitorData);
        $aiService->analyzeTechnicalIssues($technicalData);
        $aiService->analyzeContentGaps($contentData);

        // Actualizar progreso
        $audit->update([
            'progress_percentage' => 70
        ]);

        // Siguiente paso: generar recomendaciones
        GenerateRecommendationsJob::dispatch($this->auditId);
    }
}
```

---

## Plantillas de Prompts para IA

```php
// Database seed para prompts

AIPrompt::create([
    'name' => 'keyword_opportunities',
    'category' => 'keyword_research',
    'prompt_template' => <<<'PROMPT'
Eres un consultor SEO experto. Analiza los siguientes datos de keywords y competidores para identificar oportunidades.

KEYWORDS DEL CLIENTE:
{{keywords}}

KEYWORDS DE COMPETIDORES:
{{competitors}}

Por favor, proporciona:
1. Top 10 keyword gaps (keywords que ranquean competidores pero no el cliente)
2. Oportunidades de quick wins (keywords con KD bajo y volumen alto donde el cliente está en página 2-3)
3. Clusters de keywords relacionados que podrían atacarse con contenido pilar

Responde en formato JSON con esta estructura:
{
  "keyword_gaps": [
    {
      "keyword": "string",
      "volume": number,
      "difficulty": number,
      "ranking_competitor": "string",
      "competitor_position": number,
      "opportunity_score": number (0-100),
      "reasoning": "string"
    }
  ],
  "quick_wins": [
    {
      "keyword": "string",
      "current_position": number,
      "potential_position": number,
      "estimated_traffic_gain": number,
      "actions_needed": ["string"]
    }
  ],
  "content_clusters": [
    {
      "pillar_topic": "string",
      "related_keywords": ["string"],
      "total_volume": number,
      "content_type": "string",
      "priority": "high|medium|low"
    }
  ]
}
PROMPT,
    'variables' => ['keywords', 'competitors'],
    'model' => 'claude-3-5-sonnet-20241022',
    'max_tokens' => 4000
]);
```

---

## Flujo de Procesamiento Completo

```
1. Usuario crea nuevo proyecto
   └─> POST /api/projects

2. Usuario sube archivos CSV
   └─> POST /api/audits/{id}/upload
       └─> FileUploadService valida y guarda
           └─> Dispara ProcessUploadedFilesJob
               └─> Parser extrae datos
                   └─> Guarda en processed_data

3. Cuando todos los archivos procesados
   └─> Dispara GenerateAIInsightsJob
       └─> Llama a Claude API con prompts específicos
           └─> Guarda insights en ai_insights
               └─> Dispara GenerateRecommendationsJob
                   └─> Prioriza y estructura recomendaciones

4. Usuario solicita generar reporte
   └─> POST /api/audits/{id}/generate-report
       └─> Dispara CreatePDFReportJob
           └─> ReportGenerationService crea PDF
               └─> Sube a S3/DO Spaces
                   └─> Envía email con link de descarga

5. Usuario accede a dashboard web
   └─> GET /audits/{id}/dashboard
       └─> Vista interactiva con gráficos y datos
```

---

## Pricing y Planes

```
FREE (0€/mes):
- 1 auditoría por mes
- Módulos básicos (keywords, technical)
- Marca de agua en PDF
- 100 insights de IA

BASIC (49€/mes):
- 5 auditorías por mes
- Todos los módulos
- Sin marca de agua
- 500 insights de IA
- Branding personalizado

PRO (149€/mes):
- Auditorías ilimitadas
- Insights ilimitados
- API access
- White label completo
- Soporte prioritario

ENTERPRISE (custom):
- Todo lo de Pro
- Hosting dedicado
- Personalización completa
- SLA garantizado
```

---

## Roadmap de Implementación

### Fase 1 (4 semanas): MVP
- [x] Setup Laravel + Vue + PostgreSQL
- [ ] Sistema de usuarios y autenticación
- [ ] Upload y parsing de CSVs básicos
- [ ] Integración Claude API (1 prompt: keyword opportunities)
- [ ] Generación PDF simple
- [ ] Dashboard básico

### Fase 2 (6 semanas): Análisis Completo
- [ ] 10+ prompts para diferentes análisis
- [ ] Sistema de colas con Redis
- [ ] Procesamiento asíncrono
- [ ] Dashboard interactivo con gráficos
- [ ] Sistema de recomendaciones priorizadas

### Fase 3 (4 semanas): Productización
- [ ] Pagos con Stripe
- [ ] Sistema de créditos
- [ ] Email notifications
- [ ] Branding personalizable
- [ ] Exportación múltiples formatos

### Fase 4 (8 semanas): SaaS Completo
- [ ] API pública
- [ ] Integraciones (WordPress, Shopify)
- [ ] Multi-tenant
- [ ] Analytics del sistema
- [ ] Marketplace de plantillas

---

## Próximos Pasos

1. **Terminar Ibiza Villa** (2-3 días)
2. **Diseñar mockups del nuevo sistema** (2 días)
3. **Setup inicial del proyecto Laravel** (1 día)
4. **Implementar MVP** (4 semanas)

---

## Preguntas a Resolver

- ¿Qué herramientas SEO priorizar primero? (Ahrefs, GSC, ambas)
- ¿Modelo de negocio? (SaaS, licencia única, freemium)
- ¿Mercado objetivo? (consultores SEO, agencias, empresas directas)
- ¿Idiomas? (ES solo, EN, multilenguaje)
