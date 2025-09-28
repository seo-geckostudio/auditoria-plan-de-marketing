<?php
/**
 * VISTA: SISTEMA DE AYUDA CONTEXTUAL POR PASO
 * ==========================================
 *
 * Muestra información de ayuda específica para cada paso de auditoría
 * incluyendo especificaciones técnicas, ejemplos y mejores prácticas
 */

// Verificar que se ha incluido desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

// Obtener información del paso
$paso_id = (int)($_GET['paso_id'] ?? 0);
$codigo_paso = $_GET['codigo_paso'] ?? '';

if (!$paso_id && !$codigo_paso) {
    echo '<div class="alert alert-danger">Parámetros incorrectos</div>';
    return;
}

// Obtener información del paso
if ($paso_id) {
    $sql = "SELECT * FROM pasos_plantilla WHERE id = ?";
    $paso_info = obtenerRegistro($sql, [$paso_id]);
} else {
    $sql = "SELECT * FROM pasos_plantilla WHERE codigo_paso = ?";
    $paso_info = obtenerRegistro($sql, [$codigo_paso]);
}

if (!$paso_info) {
    echo '<div class="alert alert-danger">Paso no encontrado</div>';
    return;
}

// Cargar configuración de ayuda específica del paso
$ayuda_config = obtenerConfiguracionAyuda($paso_info['codigo_paso']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda: <?= htmlspecialchars($paso_info['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .help-section {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        .csv-spec {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            padding: 1rem;
            border-radius: 0.375rem;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }
        .file-spec {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 1rem;
            border-radius: 0.375rem;
        }
        .tip-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
        .code-example {
            background: #2d3748;
            color: #e2e8f0;
            padding: 1rem;
            border-radius: 0.375rem;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-1">
                            <i class="fas fa-question-circle text-primary"></i>
                            Ayuda: <?= htmlspecialchars($paso_info['nombre']) ?>
                        </h1>
                        <p class="text-muted mb-0">
                            <i class="fas fa-tag"></i> <?= htmlspecialchars($paso_info['codigo_paso']) ?>
                            <span class="ms-3">
                                <i class="fas fa-clock"></i> <?= $paso_info['tiempo_estimado_horas'] ?> horas estimadas
                            </span>
                        </p>
                    </div>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.close()">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Objetivo del paso -->
                <div class="help-section">
                    <h4><i class="fas fa-bullseye text-success"></i> Objetivo del Paso</h4>
                    <p><?= nl2br(htmlspecialchars($ayuda_config['objetivo'] ?? $paso_info['descripcion'])) ?></p>
                </div>

                <!-- Datos necesarios -->
                <?php if (!empty($ayuda_config['datos_necesarios'])): ?>
                <div class="help-section">
                    <h4><i class="fas fa-database text-info"></i> Datos Necesarios</h4>
                    <ul>
                        <?php foreach ($ayuda_config['datos_necesarios'] as $dato): ?>
                            <li><?= htmlspecialchars($dato) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Herramientas requeridas -->
                <?php if (!empty($ayuda_config['herramientas'])): ?>
                <div class="help-section">
                    <h4><i class="fas fa-tools text-warning"></i> Herramientas Requeridas</h4>
                    <div class="row">
                        <?php foreach ($ayuda_config['herramientas'] as $herramienta): ?>
                            <div class="col-md-6 mb-2">
                                <div class="card">
                                    <div class="card-body py-2">
                                        <h6 class="card-title mb-1"><?= htmlspecialchars($herramienta['nombre']) ?></h6>
                                        <small class="text-muted"><?= htmlspecialchars($herramienta['uso']) ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Especificaciones CSV -->
                <?php if (strpos($paso_info['metodos_entrada'], 'csv') !== false && !empty($ayuda_config['csv_specs'])): ?>
                <div class="help-section">
                    <h4><i class="fas fa-file-csv text-success"></i> Especificaciones CSV</h4>

                    <?php foreach ($ayuda_config['csv_specs'] as $fuente => $spec): ?>
                        <div class="mb-3">
                            <h5><?= htmlspecialchars($fuente) ?></h5>
                            <div class="csv-spec">
                                <strong>Archivo:</strong> <?= htmlspecialchars($spec['archivo']) ?><br>
                                <strong>Configuración:</strong> <?= htmlspecialchars($spec['configuracion']) ?><br>
                                <strong>Headers esperados:</strong><br>
                                <code><?= htmlspecialchars($spec['headers']) ?></code>
                            </div>

                            <?php if (!empty($spec['ejemplo'])): ?>
                                <div class="mt-2">
                                    <strong>Ejemplo:</strong>
                                    <div class="code-example">
                                        <?= htmlspecialchars($spec['ejemplo']) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Especificaciones de archivos -->
                <?php if (strpos($paso_info['metodos_entrada'], 'archivo') !== false && !empty($ayuda_config['file_specs'])): ?>
                <div class="help-section">
                    <h4><i class="fas fa-file-upload text-primary"></i> Documentos Esperados</h4>

                    <?php foreach ($ayuda_config['file_specs'] as $tipo => $spec): ?>
                        <div class="file-spec mb-3">
                            <h6><?= htmlspecialchars($tipo) ?></h6>
                            <ul class="mb-0">
                                <li><strong>Formatos:</strong> <?= htmlspecialchars($spec['formatos']) ?></li>
                                <li><strong>Tamaño máximo:</strong> <?= htmlspecialchars($spec['tamaño_max']) ?></li>
                                <li><strong>Descripción:</strong> <?= htmlspecialchars($spec['descripcion']) ?></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Tips y mejores prácticas -->
                <?php if (!empty($ayuda_config['tips'])): ?>
                <div class="tip-box">
                    <h4><i class="fas fa-lightbulb"></i> Tips y Mejores Prácticas</h4>
                    <ul class="mb-0">
                        <?php foreach ($ayuda_config['tips'] as $tip): ?>
                            <li><?= htmlspecialchars($tip) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <!-- Métodos de entrada disponibles -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fas fa-route"></i> Métodos Disponibles</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $metodos = json_decode($paso_info['metodos_entrada'], true);
                        foreach ($metodos as $metodo):
                        ?>
                            <div class="d-flex align-items-center mb-2">
                                <?php if ($metodo === 'formulario'): ?>
                                    <i class="fas fa-edit text-primary me-2"></i>
                                    <span>Formulario dinámico</span>
                                <?php elseif ($metodo === 'csv'): ?>
                                    <i class="fas fa-file-csv text-success me-2"></i>
                                    <span>Importación CSV</span>
                                <?php elseif ($metodo === 'archivo'): ?>
                                    <i class="fas fa-upload text-warning me-2"></i>
                                    <span>Subida de archivos</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="card">
                    <div class="card-header">
                        <h5><i class="fas fa-info-circle"></i> Información Adicional</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($paso_info['instrucciones'])): ?>
                            <div class="mb-3">
                                <h6>Instrucciones:</h6>
                                <p class="small"><?= nl2br(htmlspecialchars($paso_info['instrucciones'])) ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <h6>Tiempo estimado:</h6>
                            <p class="small"><?= $paso_info['tiempo_estimado_horas'] ?> horas</p>
                        </div>

                        <?php if (!empty($ayuda_config['recursos_adicionales'])): ?>
                            <div class="mb-3">
                                <h6>Recursos adicionales:</h6>
                                <ul class="small">
                                    <?php foreach ($ayuda_config['recursos_adicionales'] as $recurso): ?>
                                        <li>
                                            <a href="<?= htmlspecialchars($recurso['url']) ?>" target="_blank">
                                                <?= htmlspecialchars($recurso['titulo']) ?>
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
/**
 * Función para obtener configuración de ayuda específica del paso
 */
function obtenerConfiguracionAyuda($codigo_paso) {
    // Configuraciones específicas por paso
    $configuraciones = [
        '01_brief_cliente' => [
            'objetivo' => 'Recopilar información detallada sobre el cliente, su negocio, objetivos SEO y contexto actual para personalizar la auditoría.',
            'datos_necesarios' => [
                'Información básica de la empresa y contacto',
                'Modelo de negocio y productos/servicios principales',
                'Mercados objetivo y audiencia',
                'Competidores principales identificados',
                'Problemas SEO actuales percibidos',
                'Recursos internos disponibles para SEO',
                'Presupuesto y timeline aproximado',
                'KPIs y objetivos específicos'
            ],
            'herramientas' => [
                ['nombre' => 'Formulario dinámico', 'uso' => 'Captura estructurada de información']
            ],
            'tips' => [
                'Programa una llamada de 30-45 minutos para completar el brief',
                'Envía las preguntas con antelación para que el cliente se prepare',
                'Documenta expectativas específicas y timeline realista',
                'Identifica limitaciones técnicas y de recursos desde el inicio'
            ]
        ],
        '03_keywords_actuales' => [
            'objetivo' => 'Analizar las keywords por las que el sitio está posicionado actualmente, identificar oportunidades de mejora y gaps de contenido.',
            'datos_necesarios' => [
                'Export de queries de Google Search Console (90 días)',
                'Keywords orgánicas de Ahrefs/SEMrush',
                'Páginas con mejor rendimiento orgánico',
                'Análisis de CTR por posición',
                'Keywords con mayor potencial de mejora'
            ],
            'herramientas' => [
                ['nombre' => 'Google Search Console', 'uso' => 'Export de queries y páginas'],
                ['nombre' => 'Ahrefs', 'uso' => 'Análisis de keywords orgánicas'],
                ['nombre' => 'Excel/Google Sheets', 'uso' => 'Análisis y procesamiento de datos']
            ],
            'csv_specs' => [
                'Google Search Console' => [
                    'archivo' => 'queries.csv',
                    'configuracion' => 'Últimos 90 días, agrupado por consulta, sin filtros',
                    'headers' => 'Query,Clicks,Impressions,CTR,Position',
                    'ejemplo' => '"keyword ejemplo",125,1500,8.33,5.2
"otra keyword seo",89,980,9.08,3.1
"long tail keyword example",23,245,9.39,8.7'
                ],
                'Ahrefs' => [
                    'archivo' => 'organic_keywords.csv',
                    'configuracion' => 'Top 1000 keywords, base de datos del país objetivo',
                    'headers' => 'Keyword,Position,Search Volume,KD,Traffic,Traffic Value,URL',
                    'ejemplo' => '"keyword ejemplo",5,1200,15,45,89,"https://example.com/page"
"seo keyword",8,800,25,25,45,"https://example.com/other-page"'
                ]
            ],
            'tips' => [
                'Exporta datos de al menos 90 días para tener suficiente volumen',
                'Filtra keywords con menos de 3 impresiones para reducir ruido',
                'Identifica keywords en posiciones 4-10 con alto potencial',
                'Agrupa keywords por tema/intención para mejor análisis',
                'Cruza datos de GSC con Ahrefs para visión completa'
            ]
        ],
        '02_roadmap_auditoria' => [
            'objetivo' => 'Definir la estructura, timeline y metodología específica de la auditoría SEO, estableciendo expectativas claras y recursos necesarios.',
            'datos_necesarios' => [
                'Metodología de auditoría seleccionada (Express, Estándar, Premium)',
                'Timeline del proyecto con fechas clave',
                'Fases específicas incluidas en esta auditoría',
                'Entregables acordados con el cliente',
                'Recursos y accesos necesarios del cliente',
                'Equipo asignado y responsabilidades',
                'Puntos de revisión y validación'
            ],
            'herramientas' => [
                ['nombre' => 'Formulario dinámico', 'uso' => 'Captura de información estructurada'],
                ['nombre' => 'Archivos adjuntos', 'uso' => 'Cronogramas, diagramas de flujo, documentos del cliente']
            ],
            'file_specs' => [
                'Cronograma del Proyecto' => [
                    'formatos' => 'Excel (.xlsx), Project (.mpp), PDF',
                    'tamaño_max' => '10MB',
                    'descripcion' => 'Cronograma detallado con hitos y dependencias'
                ],
                'Diagrama de Flujo' => [
                    'formatos' => 'PDF, PNG, Visio (.vsdx)',
                    'tamaño_max' => '5MB',
                    'descripcion' => 'Flujo de trabajo y metodología visual'
                ],
                'Documentos del Cliente' => [
                    'formatos' => 'PDF, Word (.docx)',
                    'tamaño_max' => '25MB',
                    'descripcion' => 'Brief extendido, documentación técnica adicional'
                ]
            ],
            'tips' => [
                'Define claramente las fases incluidas desde el inicio',
                'Establece puntos de revisión regulares con el cliente',
                'Documenta todos los accesos y recursos necesarios',
                'Ajusta la metodología según el presupuesto y timeline',
                'Incluye buffer time para imprevistos (15-20%)',
                'Valida expectativas de entregables específicos'
            ]
        ],
        '03_keywords_actuales' => [
            'objetivo' => 'Analizar las keywords por las que el sitio está posicionado actualmente, identificar oportunidades de mejora y gaps de contenido.',
            'datos_necesarios' => [
                'Export de queries de Google Search Console (90 días mínimo)',
                'Keywords orgánicas de Ahrefs/SEMrush',
                'Páginas con mejor rendimiento orgánico',
                'Análisis de CTR por posición',
                'Keywords objetivo del cliente',
                'Análisis de tendencias históricas'
            ],
            'herramientas' => [
                ['nombre' => 'Google Search Console', 'uso' => 'Export de queries y páginas'],
                ['nombre' => 'Ahrefs', 'uso' => 'Análisis de keywords orgánicas'],
                ['nombre' => 'Excel/Google Sheets', 'uso' => 'Análisis y procesamiento de datos']
            ],
            'csv_specs' => [
                'Google Search Console - Queries' => [
                    'archivo' => 'queries.csv',
                    'configuracion' => 'Últimos 90 días, agrupado por consulta, sin filtros',
                    'headers' => 'Query,Clicks,Impressions,CTR,Position',
                    'ejemplo' => '"keyword ejemplo",125,1500,8.33,5.2
"otra keyword seo",89,980,9.08,3.1
"long tail keyword",23,245,9.39,8.7'
                ],
                'Google Search Console - Pages' => [
                    'archivo' => 'pages.csv',
                    'configuracion' => 'Últimos 90 días, agrupado por página',
                    'headers' => 'Page,Clicks,Impressions,CTR,Position',
                    'ejemplo' => '"/pagina-ejemplo",250,3200,7.81,4.2
"/otra-pagina",180,2100,8.57,5.1'
                ],
                'Ahrefs - Organic Keywords' => [
                    'archivo' => 'organic_keywords.csv',
                    'configuracion' => 'Top 1000 keywords, base de datos del país objetivo',
                    'headers' => 'Keyword,Position,Search Volume,KD,Traffic,Traffic Value,URL',
                    'ejemplo' => '"keyword ejemplo",5,1200,15,45,89,"https://example.com/page"
"seo keyword",8,800,25,25,45,"https://example.com/other"'
                ]
            ],
            'tips' => [
                'Exporta datos de al menos 90 días para volumen suficiente',
                'Filtra keywords con menos de 3 impresiones para reducir ruido',
                'Identifica keywords en posiciones 4-10 con alto potencial',
                'Agrupa keywords por tema/intención para mejor análisis',
                'Cruza datos de GSC con Ahrefs para visión completa',
                'Documenta keywords objetivo del cliente para comparar'
            ]
        ],
        '12_posicionamiento_organico' => [
            'objetivo' => 'Analizar en detalle el posicionamiento orgánico histórico, identificar tendencias, caídas de tráfico y oportunidades de mejora de rankings.',
            'datos_necesarios' => [
                'Export histórico de posiciones (12 meses mínimo)',
                'Análisis de tendencias de tráfico orgánico por períodos',
                'Identificación de keywords que han perdido/ganado posiciones',
                'Análisis de impacto de cambios algorítmicos',
                'Keywords en posiciones 4-10 con potencial rápido',
                'Comparativa con competidores principales'
            ],
            'herramientas' => [
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Análisis histórico de posiciones y trends'],
                ['nombre' => 'SEMrush Position Tracking', 'uso' => 'Seguimiento histórico detallado'],
                ['nombre' => 'Google Search Console', 'uso' => 'Datos de rendimiento real y comparativas'],
                ['nombre' => 'Sistrix Toolbox', 'uso' => 'Análisis de visibilidad histórica']
            ],
            'csv_specs' => [
                'Ahrefs - Position History' => [
                    'archivo' => 'position_history.csv',
                    'configuracion' => 'Últimos 12 meses, keywords monitoreadas',
                    'headers' => 'Keyword,Date,Position,Search Volume,URL,Traffic',
                    'ejemplo' => '"keyword ejemplo","2024-01-01",3,1200,"https://example.com/page",45
"keyword ejemplo","2024-02-01",5,1200,"https://example.com/page",28
"keyword ejemplo","2024-03-01",4,1200,"https://example.com/page",35'
                ],
                'SEMrush - Position Tracking' => [
                    'archivo' => 'position_tracking.csv',
                    'configuracion' => 'Proyecto configurado, export histórico completo',
                    'headers' => 'Keyword,Current Position,Previous Position,Change,Search Volume,URL',
                    'ejemplo' => '"keyword seo",5,8,"+3",2400,"https://example.com/seo"
"marketing digital",12,15,"+3",1800,"https://example.com/marketing"'
                ],
                'Google Search Console - Performance' => [
                    'archivo' => 'gsc_performance_historical.csv',
                    'configuracion' => 'Últimos 16 meses (máximo disponible), por consulta',
                    'headers' => 'Query,Date,Clicks,Impressions,CTR,Position',
                    'ejemplo' => '"keyword ejemplo","2024-01-01",25,300,8.33,5.2
"keyword ejemplo","2024-02-01",20,280,7.14,6.1
"keyword ejemplo","2024-03-01",30,350,8.57,4.8'
                ]
            ],
            'tips' => [
                'Analiza períodos de 12+ meses para identificar tendencias reales',
                'Documenta correlaciones con cambios algorítmicos conocidos',
                'Identifica keywords que han perdido posiciones recientemente',
                'Prioriza keywords de alto volumen en posiciones 6-15',
                'Busca patrones estacionales en el comportamiento',
                'Cruza datos de múltiples herramientas para mayor precisión',
                'Enfócate en oportunidades rápidas (posición 4-10)',
                'Documenta el contexto de cambios (updates, competencia, etc.)'
            ]
        ],
        '04_analisis_competencia' => [
            'objetivo' => 'Realizar un análisis completo de la competencia SEO, identificando gaps de oportunidad, fortalezas y debilidades en el posicionamiento orgánico.',
            'datos_necesarios' => [
                'Identificación de competidores directos e indirectos',
                'Análisis de keywords por las que compiten los rivales',
                'Estudio de páginas con mejor rendimiento de la competencia',
                'Comparativa de volúmenes de tráfico orgánico',
                'Análisis de estrategias de contenido de los competidores',
                'Evaluación de autoridad de dominio y backlinks',
                'Gaps de keywords no cubiertas por el cliente',
                'Oportunidades de contenido identificadas'
            ],
            'herramientas' => [
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Análisis de competidores y keywords'],
                ['nombre' => 'SEMrush Competitive Research', 'uso' => 'Comparativas directas de tráfico'],
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Análisis técnico de sitios competidores'],
                ['nombre' => 'SimilarWeb', 'uso' => 'Métricas de tráfico y audiencia'],
                ['nombre' => 'Google Search Console', 'uso' => 'Datos propios para comparación']
            ],
            'csv_specs' => [
                'Ahrefs - Competing Domains' => [
                    'archivo' => 'competing_domains.csv',
                    'configuracion' => 'Top 10 competidores orgánicos, último mes',
                    'headers' => 'Domain,Common Keywords,SE Keywords,SE Traffic,SE Traffic Value,DR',
                    'ejemplo' => '"competitor1.com",450,2500,15000,25000,65
"competitor2.com",380,2100,12000,20000,58
"competitor3.com",320,1800,9500,15000,52'
                ],
                'Ahrefs - Competitors Keywords' => [
                    'archivo' => 'competitors_keywords.csv',
                    'configuracion' => 'Keywords donde competidores superan al cliente',
                    'headers' => 'Keyword,Search Volume,KD,Competitor Domain,Competitor Position,Client Position,Gap Score',
                    'ejemplo' => '"keyword competencia",2400,25,"competitor1.com",2,15,85
"seo avanzado",1800,30,"competitor2.com",3,-,100
"marketing digital",3200,35,"competitor1.com",1,8,70'
                ],
                'SEMrush - Keyword Gap' => [
                    'archivo' => 'keyword_gap.csv',
                    'configuracion' => 'Análisis de gaps vs top 3 competidores',
                    'headers' => 'Keyword,Search Volume,KD,Missing,Weak,Strong,Top',
                    'ejemplo' => '"keyword gap example",1500,20,1,0,0,0
"another keyword",2100,28,0,1,0,0
"strong keyword",1200,15,0,0,1,0'
                ]
            ],
            'tips' => [
                'Identifica al menos 5-8 competidores directos',
                'Enfócate en keywords de alto volumen donde estás ausente',
                'Analiza la calidad del contenido, no solo las métricas',
                'Documenta estrategias exitosas para replicar',
                'Prioriza oportunidades con baja dificultad (KD < 30)',
                'Estudia la arquitectura de información de competidores exitosos',
                'Identifica nichos de contenido no explotados'
            ]
        ],
        '05_oportunidades_keywords' => [
            'objetivo' => 'Identificar y evaluar nuevas oportunidades de keywords para ampliar la estrategia SEO, basándose en research de mercado, tendencias y gaps competitivos.',
            'datos_necesarios' => [
                'Research de keywords relacionadas y semánticas',
                'Análisis de volúmenes de búsqueda y tendencias',
                'Evaluación de dificultad de posicionamiento (KD)',
                'Identificación de keywords long-tail de oportunidad',
                'Análisis de intención de búsqueda por keyword',
                'Estimación de potencial de tráfico y conversión',
                'Priorización basada en ROI estimado',
                'Keywords estacionales y de temporada'
            ],
            'herramientas' => [
                ['nombre' => 'Ahrefs Keywords Explorer', 'uso' => 'Research de keywords y análisis de dificultad'],
                ['nombre' => 'SEMrush Keyword Magic Tool', 'uso' => 'Descubrimiento de keywords relacionadas'],
                ['nombre' => 'Google Keyword Planner', 'uso' => 'Volúmenes de búsqueda y estimaciones'],
                ['nombre' => 'Sistrix Keyword Tool', 'uso' => 'Análisis de tendencias y oportunidades'],
                ['nombre' => 'AnswerThePublic', 'uso' => 'Keywords de preguntas y long-tail'],
                ['nombre' => 'Google Trends', 'uso' => 'Análisis de tendencias temporales'],
                ['nombre' => 'Ubersuggest', 'uso' => 'Sugerencias de keywords alternativas']
            ],
            'csv_specs' => [
                'Ahrefs - Keyword Ideas' => [
                    'archivo' => 'keyword_ideas.csv',
                    'configuracion' => 'Keywords Explorer > Keyword Ideas, filtrado por KD < 40',
                    'headers' => 'Keyword,Search Volume,KD,CPC,Parent Topic,Traffic Potential,Word Count',
                    'ejemplo' => '"nuevas oportunidades seo",1200,25,2.50,"oportunidades seo",450,3
"keywords long tail seo",800,15,1.80,"seo keywords",280,4
"estrategia keywords 2024",950,30,3.20,"estrategia seo",350,3'
                ],
                'SEMrush - Keyword Magic Tool' => [
                    'archivo' => 'keyword_magic_tool.csv',
                    'configuracion' => 'Keyword Magic Tool con filtros de volumen > 100 y KD < 50',
                    'headers' => 'Keyword,Search Volume,KD%,CPC,Competitive Density,Number of Results,Trend',
                    'ejemplo' => '"keyword research avanzado",1500,28,2.10,0.85,1250000,"stable"
"herramientas seo keywords",1100,22,1.95,0.72,980000,"growing"
"analisis competencia keywords",750,35,2.80,0.90,1100000,"stable"'
                ],
                'Google Keyword Planner' => [
                    'archivo' => 'keyword_planner.csv',
                    'configuracion' => 'Export desde Keyword Planner con competencia y CPC',
                    'headers' => 'Keyword,Avg Monthly Searches,Competition,Top of page bid (low range),Top of page bid (high range)',
                    'ejemplo' => '"oportunidades keywords",1200,"Medium",1.50,3.20
"research keywords gratis",890,"Low",0.80,2.10
"keywords para blog",2100,"High",1.80,4.50'
                ]
            ],
            'tips' => [
                'Enfócate en keywords con KD < 40 para oportunidades realizables',
                'Prioriza keywords long-tail (3+ palabras) para menor competencia',
                'Considera la intención de búsqueda: informacional, comercial, transaccional',
                'Analiza keywords relacionadas y sinónimos para ampliar cobertura',
                'Evalúa el potencial de conversión, no solo el volumen de tráfico',
                'Identifica keywords estacionales para planificación temporal',
                'Busca gaps en keywords de pregunta (qué, cómo, cuándo, dónde)',
                'Considera keywords locales si aplica al negocio'
            ]
        ],
        '00_analisis_mercado_completo' => [
            'objetivo' => 'Realizar un análisis exhaustivo del mercado, sector y contexto competitivo para establecer el panorama completo en el que opera el cliente.',
            'datos_necesarios' => [
                'Análisis del sector y mercado objetivo',
                'Tamaño del mercado y potencial de crecimiento',
                'Segmentación de audiencia y comportamiento del consumidor',
                'Tendencias del mercado y factores de influencia',
                'Análisis de barreras de entrada y salida',
                'Cadena de valor del sector',
                'Análisis de stakeholders y grupos de interés',
                'Factores macro-económicos que afectan al sector',
                'Regulaciones y normativas del sector',
                'Análisis de oportunidades y amenazas del mercado'
            ],
            'herramientas' => [
                ['nombre' => 'Google Market Finder', 'uso' => 'Análisis de mercados y oportunidades'],
                ['nombre' => 'SimilarWeb', 'uso' => 'Análisis de tráfico del sector'],
                ['nombre' => 'Statista', 'uso' => 'Estadísticas del mercado'],
                ['nombre' => 'Google Trends', 'uso' => 'Tendencias de búsqueda del sector'],
                ['nombre' => 'SEMrush Market Explorer', 'uso' => 'Análisis competitivo del mercado'],
                ['nombre' => 'Think with Google', 'uso' => 'Insights del comportamiento del consumidor'],
                ['nombre' => 'Euromonitor', 'uso' => 'Investigación de mercado profesional']
            ],
            'tips' => [
                'Define claramente el mercado relevante (geográfico, demográfico, psicográfico)',
                'Identifica las principales tendencias que afectan al sector',
                'Analiza el customer journey completo del sector',
                'Considera factores estacionales y cíclicos del mercado',
                'Evalúa el nivel de digitalización del sector',
                'Identifica influenciadores y prescriptores del sector',
                'Analiza el comportamiento de compra online vs offline',
                'Documenta las principales fuentes de información del sector'
            ]
        ],
        '01_competencia_360' => [
            'objetivo' => 'Realizar un análisis integral 360° de la competencia, evaluando no solo SEO sino también estrategias de marketing digital, posicionamiento de marca y presencia omnicanal.',
            'datos_necesarios' => [
                'Identificación de competidores directos, indirectos y emergentes',
                'Análisis de posicionamiento de marca y propuesta de valor',
                'Estrategias de marketing digital completas (SEO, SEM, Social, Email)',
                'Presencia omnicanal y experiencia de usuario',
                'Análisis de pricing y modelos de negocio',
                'Fortalezas y debilidades competitivas por canal',
                'Share of voice en medios digitales',
                'Innovaciones y diferenciadores competitivos',
                'Análisis de contenido y tono de comunicación',
                'Performance de canales de adquisición'
            ],
            'herramientas' => [
                ['nombre' => 'SimilarWeb Pro', 'uso' => 'Análisis completo de tráfico y canales'],
                ['nombre' => 'SEMrush Traffic Analytics', 'uso' => 'Análisis de audiencia y comportamiento'],
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Análisis SEO y contenido competitivo'],
                ['nombre' => 'SpyFu', 'uso' => 'Análisis histórico de SEM y keywords'],
                ['nombre' => 'Facebook Ad Library', 'uso' => 'Análisis de creativos publicitarios'],
                ['nombre' => 'BuzzSumo', 'uso' => 'Análisis de contenido y engagement social'],
                ['nombre' => 'Wappalyzer', 'uso' => 'Análisis de tecnologías utilizadas'],
                ['nombre' => 'Built With', 'uso' => 'Stack tecnológico de competidores']
            ],
            'csv_specs' => [
                'SimilarWeb - Traffic Overview' => [
                    'archivo' => 'traffic_overview_competitors.csv',
                    'configuracion' => 'Export de tráfico de top 5 competidores, últimos 6 meses',
                    'headers' => 'Domain,Total Visits,Bounce Rate,Pages per Visit,Avg Visit Duration,Traffic Sources',
                    'ejemplo' => '"competitor1.com",1250000,45.2,3.8,"00:02:45","Direct: 35%, Search: 28%, Social: 15%"
"competitor2.com",890000,52.1,2.9,"00:01:58","Direct: 42%, Search: 32%, Referrals: 12%"'
                ],
                'SEMrush - Competitor Traffic' => [
                    'archivo' => 'competitor_traffic_semrush.csv',
                    'configuracion' => 'Traffic Analytics de competidores principales',
                    'headers' => 'Domain,Monthly Visits,Unique Visitors,Bounce Rate,Top Countries,Top Age Groups',
                    'ejemplo' => '"competitor1.com",1100000,850000,47.5,"Spain: 65%, Mexico: 20%","25-34: 35%, 35-44: 28%"
"competitor2.com",750000,580000,51.2,"Spain: 70%, Argentina: 15%","18-24: 30%, 25-34: 40%"'
                ],
                'BuzzSumo - Content Performance' => [
                    'archivo' => 'content_performance_competitors.csv',
                    'configuracion' => 'Top performing content de competidores últimos 90 días',
                    'headers' => 'URL,Domain,Total Engagements,Facebook Shares,Twitter Shares,Content Type,Published Date',
                    'ejemplo' => '"https://competitor1.com/post1","competitor1.com",2500,1200,800,"Article","2024-09-15"
"https://competitor2.com/post2","competitor2.com",1800,900,650,"Guide","2024-09-20"'
                ]
            ],
            'tips' => [
                'Segmenta competidores por nivel: directos, indirectos, aspiracionales',
                'Analiza no solo métricas sino también estrategias cualitativas',
                'Evalúa la experiencia de usuario completa del customer journey',
                'Documenta innovaciones y diferenciadores únicos',
                'Identifica gaps en el mercado que ningún competidor cubre',
                'Analiza la coherencia omnicanal de cada competidor',
                'Evalúa la velocidad de adaptación a tendencias del mercado',
                'Identifica competidores emergentes y disruptores potenciales'
            ]
        ],
        '02_buyer_personas_completas' => [
            'objetivo' => 'Desarrollar perfiles detallados y completos de buyer personas basados en datos reales, comportamientos digitales y patrones de búsqueda para orientar la estrategia SEO.',
            'datos_necesarios' => [
                'Datos demográficos y psicográficos detallados',
                'Comportamientos de búsqueda y patrones de navegación',
                'Customer journey completo por persona',
                'Pain points y motivaciones específicas',
                'Canales preferidos de información y compra',
                'Dispositivos y horarios de navegación',
                'Nivel de conocimiento técnico y digital',
                'Influenciadores y fuentes de información',
                'Proceso de toma de decisiones',
                'Objeciones y barreras de conversión'
            ],
            'herramientas' => [
                ['nombre' => 'Google Analytics 4', 'uso' => 'Datos demográficos y comportamiento de audiencia'],
                ['nombre' => 'Google Search Console', 'uso' => 'Análisis de consultas de búsqueda'],
                ['nombre' => 'Facebook Audience Insights', 'uso' => 'Datos psicográficos y de intereses'],
                ['nombre' => 'SEMrush Audience Intelligence', 'uso' => 'Comportamiento digital de la audiencia'],
                ['nombre' => 'Hotjar', 'uso' => 'Mapas de calor y grabaciones de usuario'],
                ['nombre' => 'SurveyMonkey/Typeform', 'uso' => 'Encuestas directas a clientes'],
                ['nombre' => 'Social Media Analytics', 'uso' => 'Comportamiento en redes sociales']
            ],
            'tips' => [
                'Basa las personas en datos reales, no en suposiciones',
                'Incluye keywords específicas que usa cada persona',
                'Define el customer journey digital completo',
                'Identifica los pain points específicos de búsqueda',
                'Documenta el lenguaje y terminología que usan',
                'Analiza el comportamiento multi-dispositivo',
                'Considera diferentes niveles de conocimiento del producto',
                'Incluye objeciones específicas y cómo superarlas'
            ]
        ],
        '03_estrategia_contenidos' => [
            'objetivo' => 'Desarrollar una estrategia integral de contenidos SEO basada en las buyer personas, análisis de mercado y oportunidades identificadas, con plan de implementación y KPIs.',
            'datos_necesarios' => [
                'Mapping de contenidos por buyer persona y customer journey',
                'Calendario editorial SEO orientado a conversión',
                'Tipos de contenido optimizados por intención de búsqueda',
                'Estrategia de keywords por pilares de contenido',
                'Plan de distribución y promoción de contenidos',
                'Métricas y KPIs específicos por tipo de contenido',
                'Recursos necesarios para producción de contenido',
                'Análisis de contenido competitivo y gaps identificados',
                'Estrategia de actualización y optimización continua',
                'Plan de linkbuilding interno y arquitectura de contenido'
            ],
            'herramientas' => [
                ['nombre' => 'Google Search Console', 'uso' => 'Análisis de performance de contenido actual'],
                ['nombre' => 'Ahrefs Content Explorer', 'uso' => 'Research de contenido competitivo'],
                ['nombre' => 'SEMrush Content Audit', 'uso' => 'Auditoría de contenido existente'],
                ['nombre' => 'AnswerThePublic', 'uso' => 'Ideas de contenido basadas en preguntas'],
                ['nombre' => 'BuzzSumo', 'uso' => 'Análisis de contenido viral y engagement'],
                ['nombre' => 'Google Trends', 'uso' => 'Tendencias de búsqueda para planificación'],
                ['nombre' => 'Screaming Frog', 'uso' => 'Análisis de arquitectura de contenido']
            ],
            'tips' => [
                'Alinea cada pieza de contenido con una buyer persona específica',
                'Crea pilares de contenido basados en keywords principales',
                'Incluye contenido para cada fase del customer journey',
                'Desarrolla formatos diversos: blog, guías, videos, infografías',
                'Planifica contenido evergreen y estacional balanceado',
                'Define métricas específicas para cada tipo de contenido',
                'Establece un flujo de trabajo de producción escalable',
                'Considera la reutilización y adaptación de contenido existente'
            ]
        ],
        '06_keyword_mapping' => [
            'objetivo' => 'Crear un mapeo estratégico completo de keywords a URLs específicas del sitio web, estableciendo la arquitectura de contenido SEO optimizada para maximizar el posicionamiento.',
            'datos_necesarios' => [
                'Lista consolidada de keywords principales y secundarias',
                'Inventario completo de URLs del sitio web actual',
                'Mapeo de keywords por página existente',
                'Identificación de gaps en la arquitectura actual',
                'Propuesta de nuevas páginas/URLs necesarias',
                'Distribución de keywords por intención de búsqueda',
                'Clusters de keywords relacionados por tema',
                'Jerarquía de contenido y navegación propuesta',
                'Análisis de cannibalización de keywords actual',
                'Especificaciones técnicas para implementación'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Extracción completa de URLs y estructura actual', 'exportar' => 'Internal.csv - Todas las URLs internas'],
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Keywords actuales por página', 'exportar' => 'Keywords por URL - Top pages CSV'],
                ['nombre' => 'Google Search Console', 'uso' => 'Performance por query y página', 'exportar' => 'Queries.csv - Todas las consultas con páginas asociadas'],
                ['nombre' => 'SEMrush Keyword Magic Tool', 'uso' => 'Agrupación de keywords por clusters temáticos'],
                ['nombre' => 'Ahrefs Keywords Explorer', 'uso' => 'Análisis de dificultad y volumen por keyword'],
                ['nombre' => 'Excel/Google Sheets', 'uso' => 'Matriz de mapeo keyword-URL final']
            ],
            'tips' => [
                'Una keyword principal por página - evita cannibalización',
                'Agrupa keywords relacionadas semánticamente en la misma URL',
                'Prioriza keywords de mayor volumen para páginas principales',
                'Asigna keywords de cola larga a páginas específicas/blog',
                'Mantén coherencia entre keyword asignada y contenido existente',
                'Considera la intención de búsqueda al asignar keywords',
                'Documenta todas las decisiones de mapeo para referencia futura',
                'Planifica URLs nuevas siguiendo estructura SEO-friendly',
                'Revisa competencia para validar strategy de mapeo',
                'Incluye keywords de marca y navegacionales en el mapeo'
            ]
        ],
        '07_arquitectura_actual' => [
            'objetivo' => 'Realizar un análisis exhaustivo de la arquitectura actual del sitio web, evaluando estructura de URLs, navegación, jerarquías, enlaces internos y usabilidad para identificar optimizaciones SEO.',
            'datos_necesarios' => [
                'Mapa completo de arquitectura de información actual',
                'Análisis de estructura de URLs y patrones existentes',
                'Evaluación de navegación principal y secundaria',
                'Análisis de categorización y taxonomías',
                'Revisión de breadcrumbs y migas de pan',
                'Análisis de enlaces internos y distribución de PageRank',
                'Evaluación de profundidad de páginas y clics necesarios',
                'Análisis de páginas huérfanas y sin enlaces',
                'Revisión de estructura de sitemaps XML',
                'Evaluación de usabilidad y experiencia de usuario'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Crawling completo y análisis de arquitectura', 'exportar' => 'Internal.csv, All Inlinks.csv, All Outlinks.csv'],
                ['nombre' => 'Google Analytics 4', 'uso' => 'Análisis de flujos de usuarios y navegación', 'exportar' => 'User Explorer - Rutas de navegación'],
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Análisis de enlaces internos y estructura', 'exportar' => 'Internal Links Report - CSV'],
                ['nombre' => 'Google Search Console', 'uso' => 'Análisis de indexación y cobertura', 'exportar' => 'Coverage.csv - Páginas indexadas'],
                ['nombre' => 'SEMrush Site Audit', 'uso' => 'Análisis técnico de arquitectura'],
                ['nombre' => 'Hotjar/Crazy Egg', 'uso' => 'Análisis de comportamiento de usuarios'],
                ['nombre' => 'XML Sitemaps Generator', 'uso' => 'Verificación de estructura de sitemaps']
            ],
            'tips' => [
                'Evalúa la regla de 3 clics: cualquier página debe ser alcanzable en máximo 3 clics',
                'Identifica páginas huérfanas sin enlaces internos entrantes',
                'Revisa la lógica de categorización y si es intuitiva para usuarios',
                'Analiza la distribución de PageRank interno y oportunidades',
                'Verifica que la navegación principal refleje las keywords objetivo',
                'Evalúa la coherencia de URLs con la estructura del contenido',
                'Identifica oportunidades de mejora en breadcrumbs y navegación',
                'Analiza la velocidad de carga por secciones del sitio',
                'Revisa la arquitectura responsive y mobile-first',
                'Documenta patrones de URLs para futuras implementaciones'
            ]
        ],
        '08_mapping_keywords_arquitectura' => [
            'objetivo' => 'Integrar el keyword mapping final con la nueva arquitectura propuesta, estableciendo un plan de migración detallado que preserve autoridad SEO y optimice la implementación técnica.',
            'datos_necesarios' => [
                'Plan de migración URL por URL con redirects 301',
                'Calendario de implementación por fases',
                'Estrategia de preservación de autoridad durante migración',
                'Plan de comunicación de cambios a stakeholders',
                'Protocolo de testing y validación pre-lanzamiento',
                'Estrategia de monitoreo post-implementación',
                'Plan de rollback en caso de problemas críticos',
                'Documentación técnica para desarrollo',
                'Plan de actualización de contenido y enlaces',
                'Checklist de verificación SEO post-migración'
            ],
            'herramientas' => [
                ['nombre' => 'Excel/Google Sheets', 'uso' => 'Matriz de migración y timeline', 'exportar' => 'Mapping URL vieja → URL nueva con redirects'],
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Validación pre y post migración', 'exportar' => 'Crawls comparativos antes/después'],
                ['nombre' => 'Google Search Console', 'uso' => 'Monitoreo durante migración', 'exportar' => 'Performance reports pre/post'],
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Tracking de autoridad y rankings', 'exportar' => 'Backlinks y rankings baseline'],
                ['nombre' => 'Google Analytics', 'uso' => 'Monitoreo de tráfico durante migración'],
                ['nombre' => 'Redirect Mapper Tools', 'uso' => 'Generación masiva de redirects'],
                ['nombre' => 'Project Management Tools', 'uso' => 'Gestión de timeline y tareas']
            ],
            'tips' => [
                'Implementa en fases pequeñas para minimizar riesgo de pérdidas SEO',
                'Mantén las URLs más importantes sin cambios si es posible',
                'Configura redirects 301 antes de eliminar URLs antiguas',
                'Monitorea rankings diariamente durante las primeras 2 semanas',
                'Comunica cambios a Google Search Console proactivamente',
                'Realiza tests exhaustivos en entorno staging antes de producción',
                'Documenta todos los cambios para referencia futura',
                'Prepara plan de comunicación para usuarios si hay cambios visibles'
            ]
        ],
        '10_configuracion_tracking' => [
            'objetivo' => 'Establecer un sistema de seguimiento de posiciones completo y configurar el tracking necesario para monitorizar el progreso SEO.',
            'datos_necesarios' => [
                'Lista de keywords objetivo prioritarias (50-100)',
                'Configuración de tracking en herramientas SEO',
                'URLs específicas para cada keyword',
                'Ubicaciones geográficas para tracking',
                'Frecuencia de seguimiento requerida',
                'Configuración de alertas automáticas',
                'Integración con Google Analytics/Search Console',
                'Dashboard de métricas SEO personalizado',
                'Benchmarks iniciales de posiciones',
                'Competidores para seguimiento comparativo'
            ],
            'herramientas' => [
                ['nombre' => 'Google Search Console', 'uso' => 'Configuración de tracking básico'],
                ['nombre' => 'Ahrefs Rank Tracker', 'uso' => 'Seguimiento avanzado de posiciones'],
                ['nombre' => 'SEMrush Position Tracking', 'uso' => 'Monitorización competitiva'],
                ['nombre' => 'Google Analytics 4', 'uso' => 'Integración de datos de tráfico orgánico']
            ],
            'csv_specs' => [
                'Keywords para Tracking' => [
                    'archivo' => 'keywords_tracking.csv',
                    'configuracion' => 'Lista priorizada de keywords objetivo',
                    'headers' => 'Keyword,URL Objetivo,Prioridad,Volumen,Dificultad,Posicion Actual',
                    'ejemplo' => '"keyword principal","/landing-page",Alta,2400,25,15
"keyword secundaria","/categoria/",Media,890,18,23
"long tail keyword","/blog/articulo",Baja,120,8,45'
                ],
                'Competidores para Seguimiento' => [
                    'archivo' => 'competidores_tracking.csv',
                    'configuracion' => 'Competidores principales para monitorización',
                    'headers' => 'Dominio,Tipo Competidor,Relevancia,Keywords Compartidas',
                    'ejemplo' => '"competidor1.com",Directo,Alta,85
"competidor2.es",Indirecto,Media,42
"competidor3.com",Nicho,Alta,156'
                ]
            ],
            'tips' => [
                'Prioriza keywords con mayor impacto en el negocio',
                'Incluye tanto keywords actuales como objetivo futuro',
                'Configura tracking por ubicación geográfica específica',
                'Establece alertas para cambios significativos de posición',
                'Integra datos de múltiples herramientas para visión completa',
                'Incluye competidores directos e indirectos en el seguimiento',
                'Documenta cambios de algoritmo y correlaciona con fluctuaciones',
                'Revisa y ajusta la lista de keywords mensualmente'
            ]
        ],
        '11_situacion_general_seo' => [
            'objetivo' => 'Evaluar el estado actual y rendimiento SEO general del sitio web, estableciendo una línea base completa antes de implementar mejoras.',
            'datos_necesarios' => [
                'Análisis de tráfico orgánico actual (GA4/GSC)',
                'Evaluación de keywords ranking principales',
                'Assessment de salud técnica SEO básica',
                'Review de métricas de autoridad y enlaces',
                'Análisis de performance user experience',
                'Evaluación de presencia en resultados destacados',
                'Assessment de competencia directa básica',
                'Review de configuraciones SEO técnicas actuales',
                'Análisis de contenido y estructura actual',
                'Evaluación de oportunidades de mejora inmediatas'
            ],
            'herramientas' => [
                ['nombre' => 'Google Analytics 4', 'uso' => 'Análisis de tráfico orgánico y comportamiento'],
                ['nombre' => 'Google Search Console', 'uso' => 'Performance orgánica y problemas técnicos'],
                ['nombre' => 'Ahrefs Site Explorer', 'uso' => 'Análisis de autoridad, enlaces y keywords'],
                ['nombre' => 'SEMrush Domain Overview', 'uso' => 'Visión general rendimiento SEO'],
                ['nombre' => 'GTmetrix/PageSpeed Insights', 'uso' => 'Evaluación performance técnica']
            ],
            'csv_specs' => [
                'Google Analytics - Tráfico Orgánico' => [
                    'archivo' => 'ga4_organic_traffic.csv',
                    'configuracion' => 'Últimos 12 meses, canal orgánico, métricas principales',
                    'headers' => 'Date,Users,Sessions,Pageviews,Bounce Rate,Avg Session Duration,Goal Completions',
                    'ejemplo' => '"2024-01-01",1250,1580,3240,68.5,180,45
"2024-02-01",1180,1520,3100,70.2,175,38
"2024-03-01",1420,1850,3980,65.8,195,52'
                ],
                'Google Search Console - Performance' => [
                    'archivo' => 'gsc_performance_overview.csv',
                    'configuracion' => 'Últimos 6 meses, métricas totales',
                    'headers' => 'Date,Clicks,Impressions,CTR,Position',
                    'ejemplo' => '"2024-01-01",890,15400,5.78,12.5
"2024-02-01",920,16200,5.68,11.8
"2024-03-01",1050,18500,5.68,11.2'
                ]
            ],
            'tips' => [
                'Enfócate en métricas de tendencia, no solo números absolutos',
                'Identifica estacionalidad en el tráfico orgánico',
                'Correlaciona cambios de tráfico con eventos conocidos',
                'Prioriza problemas con mayor impacto en visibilidad',
                'Documenta configuraciones técnicas actuales para referencia',
                'Establece benchmarks claros para medir progreso futuro',
                'Identifica quick wins para implementación inmediata',
                'Analiza tanto escritorio como móvil por separado'
            ]
        ],
        '13_seo_onpage_analisis' => [
            'objetivo' => 'Realizar un análisis exhaustivo del SEO On-Page del sitio web, evaluando optimización de contenido, estructura HTML y elementos técnicos.',
            'datos_necesarios' => [
                'Auditoría completa de meta tags (title, description, headers)',
                'Análisis de estructura de URLs y arquitectura interna',
                'Evaluación de optimización de contenido y keyword density',
                'Review de imágenes, alt texts y optimización multimedia',
                'Análisis de enlaces internos y distribución de authority',
                'Evaluación de schema markup y datos estructurados',
                'Assessment de factores de experiencia de usuario (UX)',
                'Review de performance y Core Web Vitals',
                'Análisis de optimización móvil y responsive design',
                'Identificación de contenido duplicado y issues técnicos'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Crawleo completo y análisis técnico on-page'],
                ['nombre' => 'Ahrefs Site Audit', 'uso' => 'Identificación de problemas SEO on-page'],
                ['nombre' => 'SEMrush Site Audit', 'uso' => 'Análisis técnico y recomendaciones'],
                ['nombre' => 'Google PageSpeed Insights', 'uso' => 'Evaluación de performance y UX'],
                ['nombre' => 'Google Mobile-Friendly Test', 'uso' => 'Verificación optimización móvil']
            ],
            'csv_specs' => [
                'Screaming Frog - Internal Pages' => [
                    'archivo' => 'sf_internal_pages.csv',
                    'configuracion' => 'Crawl completo, todas las páginas internas',
                    'headers' => 'Address,Title 1,Meta Description 1,H1-1,H2-1,Word Count,Status Code,Indexability',
                    'ejemplo' => '"/homepage","Home - Empresa SEO",,"Servicios SEO Profesionales","¿Qué hacemos?",850,200,Indexable
"/servicios/","Servicios SEO",,"Nuestros Servicios SEO","Consultoría SEO",650,200,Indexable'
                ],
                'Screaming Frog - Images' => [
                    'archivo' => 'sf_images.csv',
                    'configuracion' => 'Análisis de imágenes y optimización',
                    'headers' => 'Address,Image URLs,Alt Text,Title,Size (Bytes)',
                    'ejemplo' => '"/homepage","image1.jpg","Servicios SEO profesionales","SEO",45000
"/servicios/","hero.png","Consultoría SEO Madrid","",120000'
                ]
            ],
            'tips' => [
                'Prioriza páginas con mayor tráfico orgánico para optimización',
                'Enfócate en meta titles únicos y descriptivos por página',
                'Verifica que cada página tenga un H1 único y optimizado',
                'Evalúa keyword density sin sobre-optimización',
                'Asegura que todas las imágenes tengan alt text descriptivo',
                'Revisa estructura de URLs para SEO-friendliness',
                'Identifica oportunidades de mejora en enlaces internos',
                'Analiza tiempo de carga y optimiza elementos críticos'
            ]
        ],
        '14_navegacion_arquitectura' => [
            'objetivo' => 'Analizar en profundidad la navegación del sitio web y la arquitectura de información para optimizar la experiencia de usuario y el crawling de motores de búsqueda.',
            'datos_necesarios' => [
                'Mapa completo de navegación principal y secundaria',
                'Análisis de profundidad de páginas y clicks to content',
                'Evaluación de breadcrumbs y navegación contextual',
                'Review de menús, filtros y sistemas de navegación',
                'Análisis de enlaces internos y distribución de link juice',
                'Evaluación de arquitectura de categorías y taxonomías',
                'Assessment de URL structure y jerarquía lógica',
                'Review de navegación móvil y usabilidad responsive',
                'Análisis de sitemap XML vs navegación real',
                'Identificación de páginas huérfanas y dead ends'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Mapeo completo de arquitectura y navegación'],
                ['nombre' => 'Ahrefs Site Audit', 'uso' => 'Análisis de estructura interna y problemas'],
                ['nombre' => 'Google Analytics', 'uso' => 'Flujos de navegación y behavior flow'],
                ['nombre' => 'Hotjar/Crazy Egg', 'uso' => 'Heatmaps y análisis de comportamiento de usuario'],
                ['nombre' => 'Xenu Link Sleuth', 'uso' => 'Verificación de enlaces y estructura']
            ],
            'csv_specs' => [
                'Screaming Frog - Internal Links' => [
                    'archivo' => 'sf_internal_links.csv',
                    'configuracion' => 'Análisis completo de enlaces internos',
                    'headers' => 'Source,Destination,Anchor,Alt Text,Follow,Target,Link Position',
                    'ejemplo' => '"/","//servicios/","Servicios","","Follow","","Navigation
"/servicios/","/servicios/seo/","SEO","","Follow","","Content"'
                ],
                'Site Architecture Depth' => [
                    'archivo' => 'site_depth_analysis.csv',
                    'configuracion' => 'Profundidad de páginas desde homepage',
                    'headers' => 'URL,Crawl Depth,Clicks from Home,Page Type,Category',
                    'ejemplo' => '"/",0,0,"Homepage","Root"
"/servicios/",1,1,"Category","Services"
"/servicios/seo/consultoría/",3,3,"Service Page","SEO"'
                ]
            ],
            'tips' => [
                'Mantén páginas importantes a máximo 3 clicks de la homepage',
                'Asegura que la navegación principal sea consistente en todo el sitio',
                'Implementa breadcrumbs claros en todas las páginas internas',
                'Optimiza la navegación móvil para touch y usabilidad',
                'Distribuye enlaces internos para potenciar páginas importantes',
                'Elimina páginas huérfanas y mejora la interconexión',
                'Usa anchor texts descriptivos en enlaces internos',
                'Estructura URLs de forma jerárquica y lógica'
            ]
        ],
        '15_enlazado_interno' => [
            'objetivo' => 'Analizar y optimizar la estrategia de enlazado interno del sitio web para maximizar la distribución de autoridad y mejorar la experiencia de navegación.',
            'datos_necesarios' => [
                'Mapa completo de enlaces internos del sitio',
                'Análisis de distribución de PageRank interno',
                'Evaluación de anchor texts y su optimización',
                'Assessment de páginas con mayor autoridad interna',
                'Review de oportunidades de enlazado perdidas',
                'Análisis de patrones de enlazado por secciones',
                'Evaluación de enlaces rotos y redirecciones internas',
                'Assessment de profundidad de enlazado y clusters',
                'Review de enlaces contextuales vs navegacionales',
                'Identificación de páginas sub-enlazadas e híper-enlazadas'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Análisis exhaustivo de enlaces internos'],
                ['nombre' => 'Ahrefs Site Audit', 'uso' => 'Internal linking y distribución de autoridad'],
                ['nombre' => 'SEMrush Site Audit', 'uso' => 'Problemas de enlazado interno'],
                ['nombre' => 'Internal Link Juicer', 'uso' => 'Análisis de oportunidades de enlazado'],
                ['nombre' => 'Link Whisper', 'uso' => 'Sugerencias de enlazado contextual']
            ],
            'csv_specs' => [
                'Internal Links Analysis' => [
                    'archivo' => 'internal_links_complete.csv',
                    'configuracion' => 'Todos los enlaces internos con métricas',
                    'headers' => 'Source URL,Target URL,Anchor Text,Link Type,Position,Follow/Nofollow,Internal PageRank',
                    'ejemplo' => '"/homepage","/servicios/","Nuestros Servicios","Content","Middle","Follow",0.85
"/blog/","/servicios/seo/","consultoría SEO","Contextual","Content","Follow",0.45'
                ],
                'Page Authority Distribution' => [
                    'archivo' => 'page_authority_internal.csv',
                    'configuracion' => 'Distribución de autoridad interna por página',
                    'headers' => 'URL,Internal Links In,Internal Links Out,Authority Score,Link Equity',
                    'ejemplo' => '"/",0,45,1.0,0.95
"/servicios/",8,12,0.85,0.78
"/about/",3,5,0.65,0.58'
                ]
            ],
            'tips' => [
                'Prioriza enlazar hacia páginas de conversión importantes',
                'Usa anchor texts descriptivos pero naturales',
                'Distribuye enlaces desde páginas con alta autoridad',
                'Crea clusters temáticos de contenido relacionado',
                'Evita sobre-optimización en anchor texts internos',
                'Enlaza contenido nuevo desde páginas establecidas',
                'Mantén balance entre enlaces navegacionales y contextuales',
                'Monitorea y repara enlaces rotos regularmente'
            ]
        ],
        '16_analisis_contenido' => [
            'objetivo' => 'Realizar un análisis exhaustivo del contenido del sitio web, evaluando calidad, relevancia, gaps de contenido y oportunidades de optimización.',
            'datos_necesarios' => [
                'Inventario completo de contenido existente',
                'Análisis de calidad y profundidad de contenido',
                'Evaluación de relevancia temática y keyword targeting',
                'Assessment de contenido duplicado e issues de calidad',
                'Review de formatos de contenido (texto, video, imágenes)',
                'Análisis de engagement y performance de contenido',
                'Identificación de gaps de contenido y oportunidades',
                'Evaluación de contenido evergreen vs temporal',
                'Assessment de contenido para diferentes buyer personas',
                'Review de call-to-actions y elementos de conversión'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Inventario y análisis técnico de contenido'],
                ['nombre' => 'Copyscape/Plagiarism Checker', 'uso' => 'Detección de contenido duplicado'],
                ['nombre' => 'Google Analytics', 'uso' => 'Performance y engagement de contenido'],
                ['nombre' => 'Ahrefs Content Explorer', 'uso' => 'Análisis de content gaps y oportunidades'],
                ['nombre' => 'SEMrush Content Audit', 'uso' => 'Evaluación integral de contenido']
            ],
            'csv_specs' => [
                'Content Inventory' => [
                    'archivo' => 'content_inventory.csv',
                    'configuracion' => 'Inventario completo de páginas y contenido',
                    'headers' => 'URL,Title,Word Count,Content Type,Last Modified,Performance Score,Issues',
                    'ejemplo' => '"/blog/seo-tips/","Guía SEO 2024",2400,"Blog Post","2024-01-15",8.5,"Low engagement"
"/servicios/","Nuestros Servicios",850,"Service Page","2023-12-10",9.2,"Good performance"'
                ],
                'Content Performance' => [
                    'archivo' => 'content_performance.csv',
                    'configuracion' => 'Métricas de rendimiento por contenido',
                    'headers' => 'URL,Pageviews,Time on Page,Bounce Rate,Conversions,Social Shares',
                    'ejemplo' => '"/blog/seo-tips/",15400,240,45.2,23,156
"/about/",3200,120,65.8,8,12'
                ]
            ],
            'tips' => [
                'Prioriza contenido con alto tráfico pero bajo engagement',
                'Identifica páginas thin content para mejora o consolidación',
                'Evalúa contenido desde perspectiva de search intent',
                'Analiza competidores para identificar content gaps',
                'Optimiza contenido existente antes de crear nuevo',
                'Considera diferentes formatos para variar la experiencia',
                'Alinea contenido con buyer journey y personas',
                'Implementa CTAs relevantes y elementos de conversión'
            ]
        ],
        '17_meta_tags_optimizacion' => [
            'objetivo' => 'Optimizar exhaustivamente todos los meta tags del sitio web para maximizar CTR, relevancia y performance en resultados de búsqueda.',
            'datos_necesarios' => [
                'Auditoría completa de title tags existentes',
                'Review de meta descriptions y su optimización',
                'Análisis de meta keywords y relevancia',
                'Evaluación de Open Graph tags para social media',
                'Assessment de Twitter Card tags',
                'Review de canonical tags y implementación',
                'Análisis de meta robots y directivas de indexación',
                'Evaluación de viewport y mobile meta tags',
                'Assessment de meta tags para rich snippets',
                'Plan de optimización y mejores prácticas'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Extracción masiva de meta tags'],
                ['nombre' => 'SEOquake', 'uso' => 'Review rápida de meta tags por página'],
                ['nombre' => 'Facebook Debugger', 'uso' => 'Validación de Open Graph tags'],
                ['nombre' => 'Twitter Card Validator', 'uso' => 'Verificación de Twitter Cards'],
                ['nombre' => 'Google SERP Simulator', 'uso' => 'Preview de titles y descriptions']
            ],
            'csv_specs' => [
                'Meta Tags Audit' => [
                    'archivo' => 'meta_tags_complete_audit.csv',
                    'configuracion' => 'Todos los meta tags del sitio',
                    'headers' => 'URL,Title Tag,Meta Description,Title Length,Description Length,Issues,Recommendations',
                    'ejemplo' => '"/","Home - Empresa SEO | Servicios Profesionales","Servicios de SEO profesionales...",45,155,"Title corto","Expandir title"
"/servicios/","Servicios SEO Madrid | Consultoría","Consultoría SEO en Madrid...",38,148,"OK","Optimizado"'
                ],
                'Social Media Tags' => [
                    'archivo' => 'social_media_meta_tags.csv',
                    'configuracion' => 'Open Graph y Twitter Cards',
                    'headers' => 'URL,OG Title,OG Description,OG Image,Twitter Card,Implementation Status',
                    'ejemplo' => '"/","Empresa SEO Profesional","Servicios de SEO...","/images/og-home.jpg","summary_large_image","Complete"
"/blog/","Blog SEO Tips","Últimos consejos...","/images/blog-og.jpg","summary","Partial"'
                ]
            ],
            'tips' => [
                'Mantén titles entre 50-60 caracteres para mostrado completo',
                'Escribe meta descriptions de 150-160 caracteres',
                'Incluye keywords principales al inicio del title',
                'Crea descriptions únicas y persuasivas para cada página',
                'Implementa Open Graph para mejor sharing en redes',
                'Usa canonical tags para evitar contenido duplicado',
                'Optimiza meta tags para featured snippets',
                'Testa previews en diferentes dispositivos'
            ]
        ],
        '18_optimizacion_imagenes' => [
            'objetivo' => 'Optimizar todas las imágenes del sitio web para mejorar velocidad de carga, SEO y experiencia de usuario.',
            'datos_necesarios' => [
                'Inventario completo de imágenes del sitio',
                'Análisis de tamaños y formatos de archivo',
                'Evaluación de alt texts y accessibility',
                'Assessment de lazy loading implementation',
                'Review de responsive images y srcset',
                'Análisis de compresión y quality settings',
                'Evaluación de CDN y delivery optimization',
                'Assessment de image SEO y filename optimization',
                'Review de structured data para imágenes',
                'Plan de optimización y mejores prácticas'
            ],
            'herramientas' => [
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Inventario completo de imágenes'],
                ['nombre' => 'GTmetrix', 'uso' => 'Análisis de optimización de imágenes'],
                ['nombre' => 'TinyPNG/JPG', 'uso' => 'Compresión y optimización'],
                ['nombre' => 'Google PageSpeed Insights', 'uso' => 'Performance de imágenes'],
                ['nombre' => 'WebP Converter', 'uso' => 'Conversión a formatos modernos']
            ],
            'tips' => [
                'Usa formatos modernos como WebP cuando sea posible',
                'Implementa lazy loading para mejorar velocidad inicial',
                'Optimiza alt texts para SEO y accessibility',
                'Considera responsive images con srcset',
                'Comprime imágenes manteniendo calidad visual',
                'Usa CDN para delivery global optimizado',
                'Implementa structured data para image SEO',
                'Monitorea impacto en Core Web Vitals'
            ]
        ]
                'Planifica horarios de baja actividad para cambios críticos',
                'Ten un plan de rollback listo antes de cada fase',
                'Actualiza sitemaps XML inmediatamente después de cada cambio'
            ]
        ],
        '09_propuesta_arquitectura' => [
            'objetivo' => 'Diseñar una propuesta optimizada de arquitectura SEO basada en el análisis previo, el keyword mapping y las mejores prácticas, priorizando usabilidad, crawlabilidad y distribución eficiente de PageRank.',
            'datos_necesarios' => [
                'Nueva estructura de navegación principal optimizada para SEO',
                'Propuesta de reorganización de categorías y taxonomías',
                'Diseño de URLs SEO-friendly y patrones coherentes',
                'Plan de redistribución de enlaces internos y PageRank',
                'Propuesta de breadcrumbs y navegación contextual',
                'Estrategia de reducción de profundidad de páginas',
                'Plan de resolución de páginas huérfanas',
                'Diseño de nueva estructura de sitemaps XML',
                'Propuesta de mejoras en experiencia de usuario',
                'Roadmap de implementación con fases y prioridades'
            ],
            'herramientas' => [
                ['nombre' => 'Figma/Sketch', 'uso' => 'Diseño visual de nueva arquitectura', 'exportar' => 'Wireframes y mockups de navegación'],
                ['nombre' => 'Lucidchart/Draw.io', 'uso' => 'Mapas de sitio y diagramas de flujo', 'exportar' => 'Diagramas de arquitectura de información'],
                ['nombre' => 'Excel/Google Sheets', 'uso' => 'Matrices de URLs y estructura', 'exportar' => 'Mapping detallado URL anterior → URL nueva'],
                ['nombre' => 'Ahrefs Keywords Explorer', 'uso' => 'Validación de keywords para categorías'],
                ['nombre' => 'Screaming Frog SEO Spider', 'uso' => 'Simulación de nueva estructura'],
                ['nombre' => 'User Testing Tools', 'uso' => 'Validación de usabilidad de propuesta'],
                ['nombre' => 'Google Analytics', 'uso' => 'Análisis de patrones de navegación actuales']
            ],
            'tips' => [
                'Prioriza la arquitectura flat: máximo 3-4 niveles de profundidad',
                'Diseña URLs descriptivas y coherentes con la estructura del contenido',
                'Asegura que la navegación principal refleje las keywords más importantes',
                'Planifica la distribución de PageRank hacia páginas comerciales clave',
                'Diseña breadcrumbs que soporten la arquitectura y mejoren UX',
                'Considera la escalabilidad futura de la arquitectura propuesta',
                'Valida la propuesta con tests de usabilidad antes de implementar',
                'Documenta claramente todos los cambios para facilitar implementación',
                'Prioriza cambios por impacto SEO vs esfuerzo de implementación',
                'Incluye plan de redirects 301 para preservar autoridad existente'
            ]
        ]
    ];

    return $configuraciones[$codigo_paso] ?? [
        'objetivo' => 'Información no disponible aún. Consulta la documentación del paso.',
        'datos_necesarios' => [],
        'herramientas' => [],
        'tips' => ['Este paso aún está en configuración. Contacta al administrador para más información.']
    ];
}
?>