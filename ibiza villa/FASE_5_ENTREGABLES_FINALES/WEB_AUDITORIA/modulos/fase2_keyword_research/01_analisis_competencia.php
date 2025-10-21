<!-- Página 1: Visión General de Competidores -->
<div class="audit-page competitor-overview-page">
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1><?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
                <p class="subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo']); ?></p>
            </div>
            <div class="header-meta">
                <div class="meta-item">
                    <span><?php echo htmlspecialchars($datosModulo['periodo']); ?></span>
                </div>
                <div class="meta-item">
                    <span><?php echo implode(', ', $datosModulo['herramientas']); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Tabla de competidores -->
        <section class="competitors-table-section">
            <h2>Competidores Analizados</h2>

            <div class="competitors-grid">
                <?php foreach ($datosModulo['competidores_analizados'] as $index => $competidor): ?>
                <div class="competitor-card <?php echo $index === 3 ? 'our-site' : ''; ?>">
                    <div class="competitor-rank">#<?php echo $index + 1; ?></div>
                    <div class="competitor-header">
                        <?php if ($index === 3): ?>
                        <span class="badge badge-primary">Nuestro Sitio</span>
                        <?php else: ?>
                        <h3><?php echo htmlspecialchars($competidor['nombre']); ?></h3>
                        <?php endif; ?>
                        <span class="competitor-url"><?php echo htmlspecialchars($competidor['url']); ?></span>
                    </div>
                    <div class="competitor-metrics">
                        <div class="metric">
                            <span class="metric-label">Domain Authority</span>
                            <span class="metric-value da-score da-<?php echo $competidor['autoridad_dominio']; ?>">
                                <?php echo $competidor['autoridad_dominio']; ?>
                            </span>
                        </div>
                        <div class="metric">
                            <span class="metric-label">Keywords Orgánicas</span>
                            <span class="metric-value"><?php echo number_format($competidor['keywords_organicas']); ?></span>
                        </div>
                        <div class="metric">
                            <span class="metric-label">Tráfico Estimado</span>
                            <span class="metric-value"><?php echo number_format($competidor['trafico_estimado']); ?>/mes</span>
                        </div>
                    </div>
                    <div class="competitor-position">
                        <span class="position-badge"><?php echo htmlspecialchars($competidor['posicion']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Gráfico de comparación -->
        <section class="comparison-chart-section">
            <h2>Comparativa de Métricas Clave</h2>
            <div class="chart-container">
                <canvas id="competitorComparisonChart"></canvas>
            </div>
        </section>
    </div>

    <div class="page-footer">
        <div class="footer-note">
            <span>Datos actualizados al <?php echo date('d/m/Y'); ?> | Fuentes: <?php echo implode(', ', $datosModulo['herramientas']); ?></span>
        </div>
    </div>
</div>

<script>
// Gráfico de comparación de competidores
(function() {
    const ctx = document.getElementById('competitorComparisonChart');
    if (!ctx) return;

    const data = <?php echo json_encode($datosModulo['comparativa_metricas']['datos']); ?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(row => row[0]),
            datasets: [
                {
                    label: 'Domain Authority',
                    data: data.map(row => row[1]),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Keywords (x10)',
                    data: data.map(row => parseInt(row[2].replace(/,/g, '')) / 10),
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Tráfico (x100)',
                    data: data.map(row => parseInt(row[3].replace(/,/g, '')) / 100),
                    backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valores Normalizados'
                    }
                }
            }
        }
    });
})();
</script>

<style>
.competitor-overview-page {
    background: white;
    color: #333;
}

.competitor-overview-page .page-header {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 12px 12px 0 0;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
}

.header-text {
    flex: 1;
}

.header-text h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    color: white;
}

.header-text .subtitle {
    margin: 0;
    opacity: 0.95;
    color: white;
}

.header-meta {
    display: flex;
    gap: 1.5rem;
    flex-direction: column;
    align-items: flex-end;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    color: white;
}

.competitors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.competitor-card {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: transform 0.2s;
}

.competitor-card:hover {
    transform: translateY(-4px);
}

.competitor-card.our-site {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border: 3px solid #88B04B;
    box-shadow: 0 8px 16px rgba(136, 176, 75, 0.3);
}

.competitor-rank {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    background: #88B04B;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
}

.competitor-card.our-site .competitor-rank {
    background: white;
    color: #88B04B;
    border: 2px solid #88B04B;
}

.competitor-header h3 {
    margin: 0 0 0.25rem 0;
    font-size: 1.2rem;
}

.competitor-url {
    font-size: 0.85rem;
    opacity: 0.7;
    display: block;
    margin-bottom: 0.5rem;
}

.badge {
    display: inline-block;
    padding: 0.5rem 1.25rem;
    border-radius: 2rem;
    font-size: 0.9rem;
    font-weight: bold;
    margin-top: 0rem;
    margin-bottom: 0.5rem;
}

.badge-primary {
    background: rgba(255, 255, 255, 0.95);
    color: #88B04B;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.competitor-metrics {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin: 1.5rem 0;
}

.metric {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: rgba(0, 0, 0, 0.05);
    border-radius: 0.5rem;
}

.competitor-card.our-site .metric {
    background: rgba(255, 255, 255, 0.2);
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.8;
}

.metric-value {
    font-weight: bold;
    font-size: 1.1rem;
}

.da-score {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    background: #88B04B;
    color: white;
}

.competitor-position {
    text-align: center;
    margin-top: 1rem;
}

.position-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.9rem;
}

.competitor-card.our-site .position-badge {
    background: rgba(255, 255, 255, 0.3);
}

.comparison-chart-section {
    margin-top: 3rem;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 2rem;
    border-radius: 1rem;
}

.comparison-chart-section h2 {
    margin-top: 0;
}

.chart-container {
    height: 400px;
    margin-top: 1.5rem;
}

.page-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.footer-note {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    opacity: 0.8;
}
</style>

<!-- Página 2: Keyword Gap Analysis -->
<div class="audit-page keyword-gap-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($datosModulo['keyword_gap_analysis']['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($datosModulo['keyword_gap_analysis']['subtitulo']); ?></p>
    </div>

    <div class="page-body">
        <!-- WIREFRAME: Resumen de Gap de Keywords -->
        <section class="wireframes-visuales">
            <div class="wireframe-container">
                <div class="wireframe-header priority-high">
                    <h3>Análisis de Keyword Gap: Oportunidades vs Competencia</h3>
                    <div class="wireframe-meta">
                        <span class="meta-tag priority-critical">Análisis Crítico</span>
                        <?php $resumen = $datosModulo['keyword_gap_analysis']['resumen']; ?>
                        <span class="meta-tag">Total Gap: <?php echo number_format($resumen['total_gap_keywords']); ?> keywords</span>
                        <span class="meta-tag">Oportunidades Rápidas: <?php echo number_format($resumen['oportunidades_rapidas']); ?></span>
                    </div>
                </div>

                <div class="wireframe-visual">
                    <!-- Grid de Oportunidades -->
                    <div class="grid-4-gap">
                        <!-- Total Gap (CTA Block) -->
                        <div class="wireframe-block cta-block">
                            <div class="block-label">⚠️ TOTAL KEYWORD GAP</div>
                            <div class="block-content text-center">
                                <div class="gap-number-large"><?php echo number_format($resumen['total_gap_keywords']); ?></div>
                                <div class="element-tag" style="margin-top: 10px;">
                                    Keywords donde la competencia nos supera significativamente
                                </div>
                            </div>
                        </div>

                        <!-- Oportunidades Rápidas (Must-have) -->
                        <div class="wireframe-block must-have">
                            <div class="block-label">⚡ OPORTUNIDADES RÁPIDAS</div>
                            <div class="block-content text-center">
                                <div class="gap-number-medium" style="color: #88B04B;"><?php echo number_format($resumen['oportunidades_rapidas']); ?></div>
                                <div class="element-tag" style="margin-top: 10px;">
                                    <strong>Dificultad:</strong> Baja | <strong>Impacto:</strong> Alto<br>
                                    <small>Implementar en los próximos 1-2 meses</small>
                                </div>
                            </div>
                        </div>

                        <!-- Oportunidades Medias (Must-have) -->
                        <div class="wireframe-block must-have">
                            <div class="block-label">⚖️ OPORTUNIDADES MEDIAS</div>
                            <div class="block-content text-center">
                                <div class="gap-number-medium" style="color: #88B04B;"><?php echo number_format($resumen['oportunidades_medias']); ?></div>
                                <div class="element-tag" style="margin-top: 10px;">
                                    <strong>Dificultad:</strong> Media | <strong>Esfuerzo:</strong> Moderado<br>
                                    <small>Planificar para 3-6 meses</small>
                                </div>
                            </div>
                        </div>

                        <!-- Oportunidades Difíciles (Nice-to-have) -->
                        <div class="wireframe-block nice-to-have">
                            <div class="block-label">🏔️ OPORTUNIDADES DIFÍCILES</div>
                            <div class="block-content text-center">
                                <div class="gap-number-medium" style="color: #6c757d;"><?php echo number_format($resumen['oportunidades_dificiles']); ?></div>
                                <div class="element-tag" style="margin-top: 10px;">
                                    <strong>Dificultad:</strong> Alta | <strong>Competitividad:</strong> Muy alta<br>
                                    <small>Objetivo a largo plazo (6-12 meses)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interpretación de Resultados -->
                    <div class="wireframe-block must-have" style="margin-top: 20px;">
                        <div class="block-label">💡 INTERPRETACIÓN DE RESULTADOS</div>
                        <div class="block-content">
                            <div class="element-tag">
                                <strong>Keyword Gap:</strong> La diferencia entre keywords en las que rankean tus competidores principales pero tú no (o estás muy atrás)
                            </div>
                            <div class="element-tag">
                                <strong>Oportunidades Rápidas (Quick Wins):</strong> Keywords con volumen decente, baja dificultad y donde ya tienes cierta autoridad. Puedes capturarlas con optimizaciones on-page y contenido dirigido.
                            </div>
                            <div class="element-tag">
                                <strong>Oportunidades Medias:</strong> Requieren esfuerzo en contenido de calidad, enlaces internos y algunas mejoras técnicas. Resultados positivos en 3-6 meses.
                            </div>
                            <div class="element-tag">
                                <strong>Oportunidades Difíciles:</strong> Alta competencia, requiere estrategia de contenido exhaustiva, link building y tiempo. Objetivo a largo plazo pero con potencial de alto tráfico.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wireframe-footer">
                    <div class="cta-list">
                        <strong>Exporta los Datos:</strong>
                        <a href="#" class="cta-tag" onclick="alert('Funcionalidad de descarga CSV próximamente')">
                            Descargar Keyword Gap Completo (CSV)
                        </a>
                        <a href="#" class="cta-tag" onclick="alert('Funcionalidad de descarga Excel próximamente')">
                            Descargar Priorización (Excel)
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top gap keywords -->
        <section class="gap-keywords-section">
            <h2>Top Keywords con Potencial de Captura</h2>

            <div class="gap-table-container">
                <table class="gap-table">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Nuestra Pos.</th>
                            <th>Competencia</th>
                            <th>Volumen</th>
                            <th>Dificultad</th>
                            <th>Oportunidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datosModulo['keyword_gap_analysis']['top_gap_keywords'] as $keyword): ?>
                        <tr>
                            <td class="keyword-cell">
                                <strong><?php echo htmlspecialchars($keyword['keyword']); ?></strong>
                            </td>
                            <td class="position-cell">
                                <?php if ($keyword['posicion_nuestra'] === null): ?>
                                <span class="badge badge-danger">No posicionado</span>
                                <?php else: ?>
                                <span class="badge badge-warning">#<?php echo $keyword['posicion_nuestra']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="competitor-positions">
                                <?php foreach ($keyword['posicion_competencia'] as $comp => $pos): ?>
                                <div class="comp-pos">
                                    <span class="comp-name"><?php echo htmlspecialchars($comp); ?></span>
                                    <span class="pos-badge">#<?php echo $pos; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </td>
                            <td class="volume-cell">
                                <?php echo number_format($keyword['volumen']); ?>
                            </td>
                            <td class="difficulty-cell">
                                <?php
                                $dificultad = $keyword['dificultad'];
                                $diffClass = '';
                                $diffLabel = '';

                                if ($dificultad <= 30) {
                                    $diffClass = 'diff-easy';
                                    $diffLabel = 'Fácil';
                                } elseif ($dificultad <= 60) {
                                    $diffClass = 'diff-medium';
                                    $diffLabel = 'Media';
                                } else {
                                    $diffClass = 'diff-hard';
                                    $diffLabel = 'Difícil';
                                }
                                ?>
                                <span class="difficulty-badge <?php echo $diffClass; ?>">
                                    <?php echo $diffLabel; ?> (<?php echo $dificultad; ?>)
                                </span>
                            </td>
                            <td class="opportunity-cell">
                                <span class="opp-badge opp-<?php echo strtolower($keyword['oportunidad']); ?>">
                                    <?php echo htmlspecialchars($keyword['oportunidad']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Keywords compartidas -->
        <section class="shared-keywords-section">
            <h2><?php echo htmlspecialchars($datosModulo['keywords_compartidas']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['keywords_compartidas']['subtitulo']); ?> (<?php echo $datosModulo['keywords_compartidas']['total']; ?> total)</p>

            <div class="shared-keywords-list">
                <?php foreach ($datosModulo['keywords_compartidas']['datos'] as $keyword): ?>
                <div class="shared-keyword-item">
                    <div class="shared-keyword-header">
                        <h4><?php echo htmlspecialchars($keyword['keyword']); ?></h4>
                        <div class="keyword-stats">
                            <span class="volume"><?php echo number_format($keyword['volumen']); ?></span>
                            <span class="distance <?php echo $keyword['distancia_al_lider'] < 0 ? 'positive' : 'negative'; ?>">
                                <?php echo abs($keyword['distancia_al_lider']); ?> posiciones <?php echo $keyword['distancia_al_lider'] < 0 ? 'mejor' : 'peor'; ?> que líder
                            </span>
                        </div>
                    </div>
                    <div class="positions-bar">
                        <?php
                        $sorted = $keyword['posiciones'];
                        asort($sorted);
                        foreach ($sorted as $site => $pos):
                            $isOurSite = ($site === 'Nuestro Sitio');
                        ?>
                        <div class="position-item <?php echo $isOurSite ? 'our-site' : ''; ?>">
                            <span class="site-name"><?php echo htmlspecialchars($site); ?></span>
                            <span class="site-position">#<?php echo $pos; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<style>
.keyword-gap-page {
    background: white;
    color: #333;
}

.gap-summary {
    margin-bottom: 2rem;
}

.gap-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
}

.gap-card {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 1.5rem;
    border-radius: 1rem;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.gap-card i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.gap-card.total i { color: #dc3545; }
.gap-card.quick i { color: #88B04B; }
.gap-card.medium i { color: #88B04B; }
.gap-card.difficult i { color: #6c757d; }

.gap-card h3 {
    margin: 0 0 1rem 0;
    font-size: 1rem;
}

.gap-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0.5rem 0;
}

.gap-label {
    font-size: 0.85rem;
    opacity: 0.7;
}

.gap-keywords-section,
.shared-keywords-section {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 2rem;
    border-radius: 1rem;
    margin-top: 2rem;
}

.gap-table-container {
    overflow-x: auto;
    margin-top: 1.5rem;
}

.gap-table {
    width: 100%;
    min-width: 1100px;
    border-collapse: collapse;
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    table-layout: auto;
}

.gap-table thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.gap-table th,
.gap-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    vertical-align: middle;
}

.gap-table th {
    font-weight: 600;
}

/* Anchos específicos para cada columna */
.gap-table th:nth-child(1),
.gap-table td:nth-child(1) { width: 25%; } /* Keyword */
.gap-table th:nth-child(2),
.gap-table td:nth-child(2) { width: 12%; } /* Nuestra Pos */
.gap-table th:nth-child(3),
.gap-table td:nth-child(3) { width: 300px; } /* Competencia */
.gap-table th:nth-child(4),
.gap-table td:nth-child(4) { width: 12%; } /* Volumen */
.gap-table th:nth-child(5),
.gap-table td:nth-child(5) { width: 14%; } /* Dificultad */
.gap-table th:nth-child(6),
.gap-table td:nth-child(6) { width: 12%; } /* Oportunidad */

.keyword-cell strong {
    color: #88B04B;
}

.position-cell .badge {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.badge-danger {
    background: #dc3545;
    color: white;
}

.badge-warning {
    background: #88B04B;
    color: #333;
}

.competitor-positions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.comp-pos {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    flex-shrink: 0;
}

.comp-name {
    opacity: 0.7;
}

.pos-badge {
    background: #e9ecef;
    padding: 0.125rem 0.5rem;
    border-radius: 0.25rem;
    font-weight: bold;
}

.difficulty-bar {
    position: relative;
    background: rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    height: 20px;
    width: 100%;
    max-width: 100px;
    display: inline-block;
    overflow: hidden;
}

.difficulty-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    background: linear-gradient(90deg, #88B04B 0%, #f59e0b 50%, #dc3545 100%);
    border-radius: 3px;
    transition: width 0.3s;
}

.difficulty-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.7rem;
    font-weight: bold;
    z-index: 1;
    color: #333;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.8);
}

/* Difficulty Badges - Nueva representación */
.difficulty-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
}

.difficulty-badge.diff-easy {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.difficulty-badge.diff-medium {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
    color: #000;
}

.difficulty-badge.diff-hard {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.difficulty-cell {
    padding: 0.5rem 1rem !important;
}

.opp-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.85rem;
}

.opp-badge.opp-alta {
    background: #88B04B;
    color: white;
}

.opp-badge.opp-media {
    background: #88B04B;
    color: #333;
}

.shared-keywords-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.shared-keyword-item {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border: 2px solid #e0e0e0;
}

.shared-keyword-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.shared-keyword-header h4 {
    margin: 0;
    color: #88B04B;
}

.keyword-stats {
    display: flex;
    gap: 1rem;
    font-size: 0.85rem;
}

.keyword-stats .volume {
    background: #e9ecef;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
}

.keyword-stats .distance {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-weight: bold;
}

.keyword-stats .distance.positive {
    background: #d4edda;
    color: #155724;
}

.keyword-stats .distance.negative {
    background: #f8d7da;
    color: #721c24;
}

.positions-bar {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.position-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.position-item.our-site {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    font-weight: bold;
    border: 2px solid #88B04B;
    box-shadow: 0 2px 8px rgba(136, 176, 75, 0.3);
}

.site-position {
    background: rgba(0, 0, 0, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-weight: bold;
}
</style>

<!-- Página 3: Estrategia y Conclusiones -->
<div class="audit-page strategy-page">
    <div class="page-header">
        <h1>Estrategia de Diferenciación y Conclusiones</h1>
    </div>

    <div class="page-body">
        <!-- Ventajas competitivas -->
        <section class="competitive-advantages">
            <h2><?php echo htmlspecialchars($datosModulo['ventajas_competitivas']['titulo']); ?></h2>

            <div class="advantages-grid">
                <div class="advantages-column strengths">
                    <h3>Nuestras Fortalezas</h3>
                    <?php foreach ($datosModulo['ventajas_competitivas']['nuestras_fortalezas'] as $fortaleza): ?>
                    <div class="advantage-item">
                        <h4><?php echo htmlspecialchars($fortaleza['area']); ?></h4>
                        <p><?php echo htmlspecialchars($fortaleza['descripcion']); ?></p>
                        <span class="example"><?php echo htmlspecialchars($fortaleza['ejemplo']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="advantages-column weaknesses">
                    <h3>Debilidades Detectadas</h3>
                    <?php foreach ($datosModulo['ventajas_competitivas']['debilidades_detectadas'] as $debilidad): ?>
                    <div class="advantage-item">
                        <h4><?php echo htmlspecialchars($debilidad['area']); ?></h4>
                        <p><?php echo htmlspecialchars($debilidad['descripcion']); ?></p>
                        <span class="impact impact-<?php echo strtolower($debilidad['impacto']); ?>">
                            Impacto: <?php echo htmlspecialchars($debilidad['impacto']); ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Estrategias de diferenciación -->
        <section class="differentiation-strategies">
            <h2><?php echo htmlspecialchars($datosModulo['estrategia_diferenciacion']['titulo']); ?></h2>

            <div class="strategies-list">
                <?php foreach ($datosModulo['estrategia_diferenciacion']['recomendaciones'] as $index => $estrategia): ?>
                <div class="strategy-card">
                    <div class="strategy-number"><?php echo $index + 1; ?></div>
                    <div class="strategy-content">
                        <h3><?php echo htmlspecialchars($estrategia['estrategia']); ?></h3>
                        <p class="strategy-description"><?php echo htmlspecialchars($estrategia['descripcion']); ?></p>

                        <div class="strategy-keywords">
                            <strong>Keywords objetivo:</strong>
                            <ul>
                                <?php foreach ($estrategia['keywords_objetivo'] as $kw): ?>
                                <li><?php echo htmlspecialchars($kw); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="strategy-metrics">
                            <span class="metric-badge esfuerzo">
                                Esfuerzo: <?php echo htmlspecialchars($estrategia['esfuerzo']); ?>
                            </span>
                            <span class="metric-badge impacto">
                                Impacto: <?php echo htmlspecialchars($estrategia['impacto_esperado']); ?>
                            </span>
                            <span class="metric-badge tiempo">
                                Tiempo: <?php echo htmlspecialchars($estrategia['tiempo']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Conclusiones -->
        <section class="conclusions-section">
            <h2>Conclusiones Principales</h2>
            <div class="conclusions-list">
                <?php foreach ($datosModulo['conclusiones'] as $index => $conclusion): ?>
                <div class="conclusion-item">
                    <span class="conclusion-number"><?php echo $index + 1; ?></span>
                    <p><?php echo htmlspecialchars($conclusion); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Próximos pasos -->
        <section class="next-steps-section">
            <h2>Plan de Acción Inmediato</h2>
            <div class="next-steps-timeline">
                <?php foreach ($datosModulo['proximos_pasos'] as $paso): ?>
                <div class="step-item priority-<?php echo strtolower($paso['prioridad']); ?>">
                    <div class="step-priority">
                        <span class="priority-badge"><?php echo htmlspecialchars($paso['prioridad']); ?></span>
                    </div>
                    <div class="step-content">
                        <h4><?php echo htmlspecialchars($paso['accion']); ?></h4>
                        <span class="step-timeline">
                            <?php echo htmlspecialchars($paso['plazo']); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<style>
.strategy-page {
    background: white;
    color: #333;
}

.competitive-advantages {
    margin-bottom: 2rem;
}

.advantages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-top: 1.5rem;
}

.advantages-column h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.advantages-column.strengths h3 {
    color: #88B04B;
}

.advantages-column.weaknesses h3 {
    color: #dc3545;
}

.advantage-item {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.advantage-item h4 {
    margin: 0 0 0.75rem 0;
    color: #333;
}

.advantage-item p {
    margin: 0 0 1rem 0;
    line-height: 1.6;
}

.example {
    display: block;
    font-style: italic;
    color: #6c757d;
    font-size: 0.9rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 0.25rem;
}

.impact {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.impact-alto {
    background: #dc3545;
    color: white;
}

.impact-medio {
    background: #88B04B;
    color: #333;
}

.differentiation-strategies {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.strategies-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.strategy-card {
    display: flex;
    gap: 1.5rem;
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #88B04B;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.strategy-number {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
}

.strategy-content {
    flex: 1;
}

.strategy-content h3 {
    margin: 0 0 0.75rem 0;
    color: #88B04B;
}

.strategy-description {
    margin: 0 0 1rem 0;
    line-height: 1.6;
}

.strategy-keywords {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.strategy-keywords strong {
    display: block;
    margin-bottom: 0.5rem;
}

.strategy-keywords ul {
    margin: 0;
    padding-left: 1.5rem;
}

.strategy-keywords li {
    margin: 0.25rem 0;
    color: #88B04B;
}

.strategy-metrics {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.metric-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.metric-badge.esfuerzo {
    background: #e3f2fd;
    color: #1976d2;
}

.metric-badge.impacto {
    background: #e8f5e9;
    color: #2e7d32;
}

.metric-badge.tiempo {
    background: #fff3e0;
    color: #e65100;
}

.conclusions-section,
.next-steps-section {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.conclusions-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.conclusion-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.conclusion-number {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    background: #88B04B;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.conclusion-item p {
    margin: 0;
    line-height: 1.6;
}

.next-steps-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.step-item {
    display: flex;
    gap: 1rem;
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #6c757d;
}

.step-item.priority-crítica {
    border-left-color: #dc3545;
}

.step-item.priority-alta {
    border-left-color: #88B04B;
}

.step-item.priority-media {
    border-left-color: #88B04B;
}

.priority-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.85rem;
    text-transform: uppercase;
}

.step-item.priority-crítica .priority-badge {
    background: #dc3545;
    color: white;
}

.step-item.priority-alta .priority-badge {
    background: #88B04B;
    color: #333;
}

.step-item.priority-media .priority-badge {
    background: #88B04B;
    color: white;
}

.step-content h4 {
    margin: 0 0 0.5rem 0;
}

.step-timeline {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.9rem;
}

/* ========================================
   WIREFRAMES SYSTEM - Keyword Gap Analysis
   ======================================== */

/* Wireframe Container */
.wireframes-visuales .wireframe-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
}

/* Wireframe Header con prioridades */
.wireframes-visuales .wireframe-header {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 25px 30px;
}

.wireframes-visuales .wireframe-header.priority-high {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.wireframes-visuales .wireframe-header h3 {
    margin: 0 0 15px 0;
    font-size: 1.4rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.wireframes-visuales .wireframe-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.wireframes-visuales .meta-tag {
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
}

.wireframes-visuales .meta-tag.priority-critical {
    animation: pulse 2s infinite;
    background: rgba(255, 255, 255, 0.3);
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Wireframe Visual Area */
.wireframes-visuales .wireframe-visual {
    padding: 30px;
    background: #f8f9fa;
}

/* Grid 4 columnas para Gap Analysis */
.grid-4-gap {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

@media (max-width: 1200px) {
    .grid-4-gap {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .grid-4-gap {
        grid-template-columns: 1fr;
    }
}

/* Wireframe Blocks */
.wireframes-visuales .wireframe-block {
    background: white;
    border-radius: 8px;
    margin-bottom: 15px;
    border: 2px solid #88B04B;
    overflow: hidden;
    transition: all 0.3s ease;
}

.wireframes-visuales .wireframe-block:hover {
    box-shadow: 0 4px 12px rgba(136, 176, 75, 0.25);
    transform: translateY(-3px);
}

.wireframes-visuales .wireframe-block.must-have {
    border-color: #88B04B;
    background: linear-gradient(135deg, #f0f7e6 0%, #ffffff 100%);
}

.wireframes-visuales .wireframe-block.nice-to-have {
    border-color: #adb5bd;
    border-style: dashed;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    opacity: 0.85;
}

.wireframes-visuales .wireframe-block.cta-block {
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
    border: 3px solid #ffc107;
}

/* Block Labels */
.wireframes-visuales .block-label {
    background: #88B04B;
    color: white;
    padding: 10px 18px;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.wireframes-visuales .nice-to-have .block-label {
    background: #6c757d;
}

.wireframes-visuales .cta-block .block-label {
    background: #ffc107;
    color: #000;
}

/* Block Content */
.wireframes-visuales .block-content {
    padding: 18px;
}

.wireframes-visuales .block-content.text-center {
    text-align: center;
}

/* Gap Numbers */
.gap-number-large {
    font-size: 3rem;
    font-weight: 800;
    color: #dc3545;
    line-height: 1;
    margin: 15px 0;
}

.gap-number-medium {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin: 10px 0;
}

/* Element Tags */
.wireframes-visuales .element-tag {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 3px solid #88B04B;
    padding: 8px 12px;
    border-radius: 5px;
    margin: 6px 0;
    font-size: 0.9rem;
    color: #495057;
    display: block;
}

.wireframes-visuales .nice-to-have .element-tag {
    border-left-color: #6c757d;
}

/* Wireframe Footer */
.wireframes-visuales .wireframe-footer {
    background: #f8f9fa;
    padding: 20px 30px;
    border-top: 2px solid #dee2e6;
}

.wireframes-visuales .cta-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.wireframes-visuales .cta-list strong {
    margin-right: 10px;
    color: #000;
}

.wireframes-visuales .cta-tag {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 10px 18px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.wireframes-visuales .cta-tag:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(136, 176, 75, 0.3);
    color: white;
    text-decoration: none;
}

.wireframes-visuales .cta-tag i {
    font-size: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .wireframes-visuales .wireframe-visual {
        padding: 20px;
    }

    .wireframes-visuales .wireframe-header h3 {
        font-size: 1.2rem;
    }

    .wireframes-visuales .wireframe-meta {
        flex-direction: column;
    }

    .gap-number-large {
        font-size: 2.5rem;
    }

    .gap-number-medium {
        font-size: 2rem;
    }

    .wireframes-visuales .cta-list {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
