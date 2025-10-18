<?php
/**
 * Módulo: Análisis de Competencia 360
 * Fase: 0 - Marketing Digital
 *
 * Muestra análisis completo de competencia con datos REALES de Ahrefs
 * Fuente: FASE_0_MARKETING_DIGITAL/01_competencia_360.md
 */

// Cargar datos desde JSON
$jsonFile = __DIR__ . '/../../data/fase0/competencia.json';
$moduloData = json_decode(file_get_contents($jsonFile), true);

if (!$moduloData) {
    die('Error: No se pudieron cargar los datos del módulo de competencia.');
}

$modulo = $moduloData['modulo'];
$paginas = $moduloData['paginas'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($modulo['nombre']); ?> - Ibiza Villa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>

<?php foreach ($paginas as $pagina): ?>
    <div class="audit-page competencia-page" id="pagina-fase0-comp-<?php echo $pagina['numero']; ?>">

        <?php if ($pagina['numero'] === 1): ?>
            <!-- PÁGINA 1: PORTADA -->
            <div class="page-header competencia-header">
                <div class="fase-label">FASE 0 - MARKETING DIGITAL</div>
                <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
                <h2 class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></h2>
            </div>

            <?php $portada = $pagina['contenido']['datos']; ?>

            <div class="competencia-summary-grid">
                <div class="summary-card primary">
                    <div class="card-icon">🏆</div>
                    <div class="card-value"><?php echo $portada['competidores_analizados']; ?></div>
                    <div class="card-label">Competidores Analizados</div>
                    <div class="card-sublabel">Con métricas de Ahrefs</div>
                </div>

                <div class="summary-card">
                    <div class="card-icon">🌍</div>
                    <div class="card-value"><?php echo count($portada['mercados_geograficos']); ?></div>
                    <div class="card-label">Mercados Geográficos</div>
                    <div class="card-sublabel"><?php echo implode(', ', $portada['mercados_geograficos']); ?></div>
                </div>

                <div class="summary-card">
                    <div class="card-icon">📊</div>
                    <div class="card-value"><?php echo $portada['metricas_comparadas']; ?></div>
                    <div class="card-label">Métricas Comparadas</div>
                    <div class="card-sublabel">Análisis exhaustivo</div>
                </div>

                <div class="summary-card">
                    <div class="card-icon">⏱️</div>
                    <div class="card-value"><?php echo $portada['periodo_analisis']; ?></div>
                    <div class="card-label">Período de Análisis</div>
                    <div class="card-sublabel">Datos actualizados</div>
                </div>
            </div>

            <div class="analysis-categories-section">
                <h3>Categorías de Análisis</h3>
                <div class="categories-grid">
                    <?php foreach ($portada['categorias_analisis'] as $categoria): ?>
                        <div class="category-card">
                            <h4><?php echo htmlspecialchars($categoria['categoria']); ?></h4>
                            <span class="metrics-badge"><?php echo $categoria['metricas']; ?> métricas</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="data-sources-section">
                <h3>Fuentes de Datos</h3>
                <div class="sources-list">
                    <?php foreach ($portada['fuentes_datos'] as $fuente): ?>
                        <span class="source-badge"><?php echo htmlspecialchars($fuente); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($pagina['numero'] === 2): ?>
            <!-- PÁGINA 2: TOP 10 COMPETIDORES -->
            <div class="page-header">
                <h2><?php echo htmlspecialchars($pagina['titulo']); ?></h2>
                <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
            </div>

            <?php
            $datos = $pagina['contenido']['datos'];
            $competidores = $datos['competidores'];
            ?>

            <div class="competitors-table-section">
                <table class="competitors-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Competidor</th>
                            <th>Tipo</th>
                            <th>DR</th>
                            <th>Tráfico/mes</th>
                            <th>Keywords</th>
                            <th>Overlap %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($competidores as $comp): ?>
                            <tr class="<?php echo $comp['posicion'] <= 2 ? 'global-player' : ($comp['tipo'] === 'Competidor Directo' ? 'direct-competitor' : ''); ?>">
                                <td class="position-cell"><?php echo $comp['posicion']; ?></td>
                                <td class="competitor-name">
                                    <strong><?php echo htmlspecialchars($comp['nombre']); ?></strong>
                                </td>
                                <td>
                                    <span class="type-badge type-<?php echo strtolower(str_replace(' ', '-', $comp['tipo'])); ?>">
                                        <?php echo htmlspecialchars($comp['tipo']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="dr-badge <?php echo $comp['metricas']['domain_rating'] >= 70 ? 'dr-high' : ($comp['metricas']['domain_rating'] >= 50 ? 'dr-medium' : 'dr-low'); ?>">
                                        <?php echo $comp['metricas']['domain_rating']; ?>
                                    </span>
                                </td>
                                <td class="traffic-cell"><?php echo htmlspecialchars($comp['metricas']['trafico_organico_mes']); ?></td>
                                <td class="keywords-cell"><?php echo htmlspecialchars($comp['metricas']['keywords_totales']); ?></td>
                                <td>
                                    <div class="overlap-bar">
                                        <div class="overlap-fill" style="width: <?php echo $comp['metricas']['overlap_porcentaje']; ?>%"></div>
                                        <span class="overlap-text"><?php echo $comp['metricas']['overlap_porcentaje']; ?>%</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php
            // Mostrar detalles de competidores directos (posición 3-10)
            $competidoresDirectos = array_filter($competidores, function($c) { return $c['tipo'] === 'Competidor Directo'; });
            ?>

            <div class="direct-competitors-analysis">
                <h3>Análisis Detallado - Competidores Directos</h3>

                <div class="competitors-grid">
                    <?php foreach ($competidoresDirectos as $comp): ?>
                        <div class="competitor-detail-card">
                            <div class="competitor-header">
                                <h4><?php echo htmlspecialchars($comp['nombre']); ?></h4>
                                <span class="position-badge">#<?php echo $comp['posicion']; ?></span>
                            </div>

                            <div class="competitor-metrics">
                                <div class="metric-item">
                                    <span class="metric-label">Domain Rating</span>
                                    <span class="metric-value"><?php echo $comp['metricas']['domain_rating']; ?></span>
                                </div>
                                <div class="metric-item">
                                    <span class="metric-label">Tráfico/mes</span>
                                    <span class="metric-value"><?php echo $comp['metricas']['trafico_organico_mes']; ?></span>
                                </div>
                                <div class="metric-item">
                                    <span class="metric-label">Keywords</span>
                                    <span class="metric-value"><?php echo $comp['metricas']['keywords_totales']; ?></span>
                                </div>
                            </div>

                            <div class="competitor-analysis">
                                <div class="strengths">
                                    <h5>💪 Fortalezas</h5>
                                    <ul>
                                        <?php foreach ($comp['fortalezas'] as $fortaleza): ?>
                                            <li><?php echo htmlspecialchars($fortaleza); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <div class="weaknesses">
                                    <h5>⚠️ Debilidades</h5>
                                    <ul>
                                        <?php foreach ($comp['debilidades'] as $debilidad): ?>
                                            <li><?php echo htmlspecialchars($debilidad); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <?php if (isset($comp['keywords_atacar'])): ?>
                                    <div class="keywords-attack">
                                        <h5>🎯 Keywords a Atacar</h5>
                                        <ul>
                                            <?php foreach ($comp['keywords_atacar'] as $keyword): ?>
                                                <li><?php echo htmlspecialchars($keyword); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (isset($datos['posicion_ibizavilla'])): ?>
                <div class="our-position-section">
                    <h3>📍 Nuestra Posición</h3>
                    <div class="position-analysis">
                        <div class="position-card">
                            <p class="position-desc"><?php echo htmlspecialchars($datos['posicion_ibizavilla']['comparacion']); ?></p>
                            <div class="position-metrics">
                                <div class="metric">
                                    <span class="label">DR Estimado:</span>
                                    <span class="value"><?php echo $datos['posicion_ibizavilla']['dr_estimado']; ?></span>
                                </div>
                                <div class="metric">
                                    <span class="label">Gap con líder:</span>
                                    <span class="value warning"><?php echo $datos['posicion_ibizavilla']['gap_con_lider_directo']; ?></span>
                                </div>
                            </div>
                            <div class="opportunity-note">
                                ✅ <?php echo htmlspecialchars($datos['posicion_ibizavilla']['oportunidad']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Gráfica Radar -->
            <?php if (isset($datos['grafica'])): ?>
                <div class="chart-section">
                    <h3><?php echo htmlspecialchars($datos['grafica']['titulo']); ?></h3>
                    <div class="chart-container">
                        <canvas id="competitorsRadarChart"></canvas>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('competitorsRadarChart');
                    if (ctx) {
                        new Chart(ctx, {
                            type: 'radar',
                            data: {
                                labels: <?php echo json_encode($datos['grafica']['etiquetas']); ?>,
                                datasets: <?php echo json_encode(array_map(function($dataset) {
                                    return [
                                        'label' => $dataset['label'],
                                        'data' => $dataset['valores'],
                                        'backgroundColor' => $dataset['color'] . '20',
                                        'borderColor' => $dataset['color'],
                                        'borderWidth' => 2,
                                        'pointBackgroundColor' => $dataset['color'],
                                        'pointBorderColor' => '#fff',
                                        'pointHoverBackgroundColor' => '#fff',
                                        'pointHoverBorderColor' => $dataset['color']
                                    ];
                                }, $datos['grafica']['datasets'])); ?>
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                scales: {
                                    r: {
                                        beginAtZero: true,
                                        max: 100,
                                        ticks: {
                                            stepSize: 20
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    }
                });
                </script>
            <?php endif; ?>

        <?php elseif ($pagina['numero'] === 3): ?>
            <!-- PÁGINA 3: KEYWORDS GAPS -->
            <div class="page-header">
                <h2><?php echo htmlspecialchars($pagina['titulo']); ?></h2>
                <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
            </div>

            <?php $datos = $pagina['contenido']['datos']; ?>

            <div class="keywords-summary-section">
                <div class="summary-metric">
                    <span class="metric-label">Volumen Total de Oportunidades</span>
                    <span class="metric-value-large"><?php echo $datos['volumen_total_oportunidades']; ?></span>
                </div>
                <div class="summary-metric">
                    <span class="metric-label">Dificultad Promedio</span>
                    <span class="metric-value-large"><?php echo $datos['dificultad_promedio']; ?>/100</span>
                </div>
            </div>

            <div class="keywords-main-opportunities">
                <h3>🎯 Oportunidades Principales</h3>
                <table class="keywords-table">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Volumen/mes</th>
                            <th>Competidores</th>
                            <th>Posición Actual</th>
                            <th>Dificultad</th>
                            <th>Oportunidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos['oportunidades_principales'] as $kw): ?>
                            <tr>
                                <td class="keyword-cell"><strong><?php echo htmlspecialchars($kw['keyword']); ?></strong></td>
                                <td class="volume-cell"><?php echo number_format($kw['volumen_mes']); ?></td>
                                <td class="competitors-cell">
                                    <small><?php echo implode(', ', $kw['competidores_rankean']); ?></small>
                                </td>
                                <td class="position-cell">
                                    <span class="badge badge-warning"><?php echo $kw['posicion_actual']; ?></span>
                                </td>
                                <td class="difficulty-cell">
                                    <div class="difficulty-bar">
                                        <div class="difficulty-fill" style="width: <?php echo $kw['dificultad']; ?>%"></div>
                                        <span><?php echo $kw['dificultad']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="opportunity-badge opportunity-<?php echo strtolower($kw['oportunidad']); ?>">
                                        <?php echo $kw['oportunidad']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="keywords-by-intent-section">
                <h3>📊 Gaps por Intención de Búsqueda</h3>

                <?php foreach ($datos['gaps_por_intencion'] as $tipo => $keywords): ?>
                    <div class="intent-block">
                        <h4 class="intent-title intent-<?php echo $tipo; ?>">
                            <?php
                            $icons = ['informacional' => '📚', 'navegacional' => '🧭', 'transaccional' => '💳', 'comercial' => '🛒'];
                            echo $icons[$tipo] ?? '📌';
                            ?>
                            <?php echo ucfirst($tipo); ?>
                        </h4>
                        <div class="intent-keywords-grid">
                            <?php foreach ($keywords as $kw): ?>
                                <div class="keyword-card">
                                    <div class="keyword-main"><?php echo htmlspecialchars($kw['keyword']); ?></div>
                                    <div class="keyword-volume"><?php echo number_format($kw['volumen_mes']); ?>/mes</div>
                                    <div class="keyword-competitors">
                                        <small><?php echo implode(', ', $kw['competidores']); ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($pagina['numero'] === 4): ?>
            <!-- PÁGINA 4: ESTRATEGIA -->
            <div class="page-header">
                <h2><?php echo htmlspecialchars($pagina['titulo']); ?></h2>
                <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
            </div>

            <?php $datos = $pagina['contenido']['datos']; ?>

            <div class="competition-levels-section">
                <h3>🎯 Nivel de Competencia por Categorías</h3>
                <table class="competition-matrix">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Nivel</th>
                            <th>Líder Actual</th>
                            <th>Oportunidad</th>
                            <th>Estrategia Recomendada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos['nivel_competencia_categorias'] as $cat): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($cat['categoria']); ?></strong></td>
                                <td>
                                    <span class="level-badge level-<?php echo strtolower($cat['nivel']); ?>">
                                        <?php echo $cat['nivel']; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($cat['lider_actual']); ?></td>
                                <td>
                                    <span class="opportunity-badge opportunity-<?php echo strtolower($cat['oportunidad']); ?>">
                                        <?php echo $cat['oportunidad']; ?>
                                    </span>
                                </td>
                                <td><em><?php echo htmlspecialchars($cat['estrategia']); ?></em></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="opportunities-timeline">
                <h3>⏱️ Roadmap de Oportunidades</h3>

                <div class="timeline-level">
                    <h4 class="timeline-title priority-high">🚀 Primer Nivel (Inmediatas - 2-4 semanas)</h4>
                    <div class="opportunities-grid">
                        <?php foreach ($datos['oportunidades_primer_nivel'] as $opp): ?>
                            <div class="opportunity-card priority-high">
                                <h5><?php echo htmlspecialchars($opp['accion']); ?></h5>
                                <p class="opp-reason"><strong>Por qué:</strong> <?php echo htmlspecialchars($opp['razon']); ?></p>
                                <div class="opp-footer">
                                    <span class="time-badge"><?php echo $opp['tiempo_implementacion']; ?></span>
                                    <span class="impact-badge impact-<?php echo strtolower($opp['impacto']); ?>">
                                        Impacto: <?php echo $opp['impacto']; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="timeline-level">
                    <h4 class="timeline-title priority-medium">📈 Segundo Nivel (Mediano Plazo - 3-6 meses)</h4>
                    <div class="opportunities-grid">
                        <?php foreach ($datos['oportunidades_segundo_nivel'] as $opp): ?>
                            <div class="opportunity-card priority-medium">
                                <h5><?php echo htmlspecialchars($opp['accion']); ?></h5>
                                <p class="opp-reason"><strong>Por qué:</strong> <?php echo htmlspecialchars($opp['razon']); ?></p>
                                <div class="opp-footer">
                                    <span class="time-badge"><?php echo $opp['tiempo_implementacion']; ?></span>
                                    <span class="impact-badge impact-<?php echo strtolower($opp['impacto']); ?>">
                                        Impacto: <?php echo $opp['impacto']; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="timeline-level">
                    <h4 class="timeline-title priority-low">🎯 Tercer Nivel (Largo Plazo - 12-18 meses)</h4>
                    <div class="opportunities-grid">
                        <?php foreach ($datos['oportunidades_tercer_nivel'] as $opp): ?>
                            <div class="opportunity-card priority-low">
                                <h5><?php echo htmlspecialchars($opp['accion']); ?></h5>
                                <p class="opp-reason"><strong>Por qué:</strong> <?php echo htmlspecialchars($opp['razon']); ?></p>
                                <div class="opp-footer">
                                    <span class="time-badge"><?php echo $opp['tiempo_implementacion']; ?></span>
                                    <span class="impact-badge impact-<?php echo strtolower(str_replace(' ', '-', $opp['impacto'])); ?>">
                                        Impacto: <?php echo $opp['impacto']; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="threats-section">
                <h3>⚠️ Amenazas Competitivas</h3>
                <div class="threats-grid">
                    <?php foreach ($datos['amenazas'] as $amenaza): ?>
                        <div class="threat-card probability-<?php echo strtolower($amenaza['probabilidad']); ?>">
                            <div class="threat-header">
                                <h5><?php echo htmlspecialchars($amenaza['amenaza']); ?></h5>
                                <span class="probability-badge"><?php echo $amenaza['probabilidad']; ?></span>
                            </div>
                            <div class="threat-mitigation">
                                <strong>Mitigación:</strong> <?php echo htmlspecialchars($amenaza['mitigacion']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>

        <div class="page-footer">
            <div class="footer-text">
                <?php echo htmlspecialchars($modulo['nombre']); ?> -
                Fuente: <?php echo htmlspecialchars($modulo['fuente_datos']); ?>
            </div>
            <div class="footer-page-num">
                Página <?php echo $pagina['numero']; ?> de <?php echo count($paginas); ?>
            </div>
        </div>

    </div>
<?php endforeach; ?>

<style>
/* Estilos específicos para el módulo de competencia */
.competencia-page {
    font-family: 'Inter', sans-serif;
}

.competencia-header {
    text-align: center;
    padding: 40px 0;
    border-bottom: 3px solid var(--brand-color);
}

.fase-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--brand-color);
    letter-spacing: 1px;
    margin-bottom: 12px;
}

.competencia-summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 32px 0;
}

.summary-card {
    background: var(--bg-lighter);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 24px;
    text-align: center;
}

.summary-card.primary {
    background: linear-gradient(135deg, var(--brand-color) 0%, var(--brand-dark) 100%);
    color: white;
    border: none;
}

.summary-card.primary .card-icon,
.summary-card.primary .card-label,
.summary-card.primary .card-sublabel {
    color: white;
}

.card-icon {
    font-size: 2rem;
    margin-bottom: 12px;
}

.card-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--brand-color);
    line-height: 1;
    margin: 8px 0;
}

.summary-card.primary .card-value {
    color: white;
}

.card-label {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 8px 0;
}

.card-sublabel {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
    margin: 24px 0;
}

.category-card {
    background: white;
    border: 1px solid var(--border);
    border-left: 4px solid var(--brand-color);
    border-radius: 6px;
    padding: 20px;
}

.category-card h4 {
    margin: 0 0 8px 0;
    font-size: 1.125rem;
}

.metrics-badge {
    display: inline-block;
    background: var(--brand-color);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.8125rem;
    font-weight: 600;
}

.sources-list {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin: 16px 0;
}

.source-badge {
    background: var(--bg-lighter);
    border: 1px solid var(--border);
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
}

.competitors-table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
    font-size: 0.9375rem;
}

.competitors-table thead {
    background: var(--bg-lighter);
}

.competitors-table th {
    padding: 12px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--border);
}

.competitors-table td {
    padding: 12px;
    border-bottom: 1px solid var(--border-light);
}

.competitors-table tr.global-player {
    background: #f0f7e6;
}

.competitors-table tr.direct-competitor {
    background: #f0f7e6;
}

.position-cell {
    font-weight: 700;
    font-size: 1.125rem;
    color: var(--brand-color);
}

.competitor-name {
    font-size: 1rem;
}

.type-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8125rem;
    font-weight: 500;
}

.type-plataforma-global {
    background: #f0f7e6;
    color: #1e40af;
}

.type-competidor-directo {
    background: #f0f7e6;
    color: #991b1b;
}

.type-competidor-local {
    background: #f0f7e6;
    color: #92400e;
}

.dr-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 700;
}

.dr-high {
    background: #88B04B;
    color: white;
}

.dr-medium {
    background: #88B04B;
    color: white;
}

.dr-low {
    background: #787878;
    color: white;
}

.overlap-bar {
    position: relative;
    height: 24px;
    background: var(--bg-lighter);
    border-radius: 4px;
    overflow: hidden;
}

.overlap-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, var(--brand-color) 0%, var(--brand-dark) 100%);
    transition: width 0.3s ease;
}

.overlap-text {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--text-color);
    z-index: 1;
}

.competitors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 24px;
    margin: 32px 0;
}

.competitor-detail-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 24px;
}

.competitor-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--border-light);
}

.competitor-header h4 {
    margin: 0;
    font-size: 1.25rem;
}

.position-badge {
    background: var(--brand-color);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-weight: 700;
}

.competitor-metrics {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin: 16px 0;
}

.metric-item {
    text-align: center;
    padding: 12px;
    background: var(--bg-lighter);
    border-radius: 6px;
}

.metric-label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-bottom: 4px;
}

.metric-value {
    display: block;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--brand-color);
}

.competitor-analysis {
    margin-top: 20px;
}

.strengths,
.weaknesses,
.keywords-attack {
    margin: 16px 0;
}

.strengths h5 {
    color: #88B04B;
    margin: 0 0 8px 0;
}

.weaknesses h5 {
    color: #88B04B;
    margin: 0 0 8px 0;
}

.keywords-attack h5 {
    color: var(--brand-color);
    margin: 0 0 8px 0;
}

.competitor-analysis ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.competitor-analysis li {
    padding: 6px 0 6px 20px;
    font-size: 0.875rem;
    position: relative;
}

.competitor-analysis li::before {
    content: "→";
    position: absolute;
    left: 0;
    color: var(--brand-color);
    font-weight: 700;
}

.our-position-section {
    background: linear-gradient(135deg, #f0f7e6 0%, #f0f7e6 100%);
    padding: 32px;
    border-radius: 12px;
    margin: 32px 0;
}

.position-analysis {
    margin-top: 16px;
}

.position-card {
    background: white;
    padding: 24px;
    border-radius: 8px;
}

.position-desc {
    font-size: 1.125rem;
    margin-bottom: 16px;
    color: var(--text-color);
}

.position-metrics {
    display: flex;
    gap: 32px;
    margin: 16px 0;
}

.position-metrics .metric {
    flex: 1;
}

.position-metrics .label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 4px;
}

.position-metrics .value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--brand-color);
}

.position-metrics .value.warning {
    color: #88B04B;
}

.opportunity-note {
    background: #f0f7e6;
    padding: 12px 16px;
    border-radius: 6px;
    margin-top: 16px;
    font-weight: 500;
}

.keywords-table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
}

.keywords-table th {
    background: var(--bg-lighter);
    padding: 12px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--border);
}

.keywords-table td {
    padding: 12px;
    border-bottom: 1px solid var(--border-light);
}

.keyword-cell {
    font-size: 1rem;
}

.volume-cell {
    font-weight: 600;
    color: var(--brand-color);
}

.difficulty-bar {
    position: relative;
    height: 24px;
    background: var(--bg-lighter);
    border-radius: 4px;
    overflow: hidden;
    min-width: 60px;
}

.difficulty-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, #88B04B 0%, #88B04B 50%, #88B04B 100%);
}

.difficulty-bar span {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-size: 0.8125rem;
    font-weight: 600;
    z-index: 1;
}

.opportunity-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8125rem;
    font-weight: 600;
}

.opportunity-alta {
    background: #f0f7e6;
    color: #047857;
}

.opportunity-media {
    background: #f0f7e6;
    color: #92400e;
}

.opportunity-baja {
    background: #f5f5f5;
    color: #374151;
}

.intent-block {
    margin: 32px 0;
}

.intent-title {
    padding: 12px 16px;
    border-radius: 6px;
    margin: 0 0 16px 0;
}

.intent-informacional {
    background: #f0f7e6;
    color: #1e40af;
}

.intent-navegacional {
    background: #f0f7e6;
    color: #9f1239;
}

.intent-transaccional {
    background: #f0f7e6;
    color: #15803d;
}

.intent-comercial {
    background: #f0f7e6;
    color: #92400e;
}

.intent-keywords-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px;
}

.keyword-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 16px;
}

.keyword-main {
    font-weight: 600;
    margin-bottom: 8px;
}

.keyword-volume {
    color: var(--brand-color);
    font-weight: 600;
    margin: 4px 0;
}

.keyword-competitors {
    color: var(--text-secondary);
    font-size: 0.8125rem;
}

.competition-matrix {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
}

.competition-matrix th {
    background: var(--bg-lighter);
    padding: 12px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--border);
}

.competition-matrix td {
    padding: 12px;
    border-bottom: 1px solid var(--border-light);
}

.level-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.8125rem;
}

.level-alta {
    background: #f0f7e6;
    color: #991b1b;
}

.level-media {
    background: #f0f7e6;
    color: #92400e;
}

.level-baja {
    background: #f0f7e6;
    color: #047857;
}

.opportunities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
    margin: 24px 0;
}

.opportunity-card {
    background: white;
    border: 1px solid var(--border);
    border-left: 4px solid;
    border-radius: 6px;
    padding: 20px;
}

.opportunity-card.priority-high {
    border-left-color: #88B04B;
    background: #f0f7e6;
}

.opportunity-card.priority-medium {
    border-left-color: #88B04B;
    background: #f0f7e6;
}

.opportunity-card.priority-low {
    border-left-color: #787878;
    background: #f5f5f5;
}

.opportunity-card h5 {
    margin: 0 0 12px 0;
    font-size: 1.125rem;
}

.opp-reason {
    font-size: 0.9375rem;
    color: var(--text-secondary);
    margin: 8px 0;
}

.opp-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border-light);
}

.time-badge {
    font-size: 0.8125rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.impact-badge {
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8125rem;
    font-weight: 600;
}

.impact-alto {
    background: #88B04B;
    color: white;
}

.impact-medio {
    background: #88B04B;
    color: white;
}

.impact-muy-alto {
    background: #88B04B;
    color: white;
}

.threats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 20px;
    margin: 24px 0;
}

.threat-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 20px;
}

.threat-card.probability-alta {
    border-left: 4px solid #88B04B;
}

.threat-card.probability-media {
    border-left: 4px solid #88B04B;
}

.threat-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
}

.threat-header h5 {
    margin: 0;
    flex: 1;
}

.probability-badge {
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8125rem;
    font-weight: 600;
    background: #f0f7e6;
    color: #991b1b;
}

.threat-mitigation {
    font-size: 0.9375rem;
    color: var(--text-secondary);
    margin-top: 8px;
}
</style>

</body>
</html>
