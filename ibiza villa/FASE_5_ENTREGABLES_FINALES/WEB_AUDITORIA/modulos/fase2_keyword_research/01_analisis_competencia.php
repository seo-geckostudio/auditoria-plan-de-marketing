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
                    <i class="fas fa-calendar-alt"></i>
                    <span><?php echo htmlspecialchars($datosModulo['periodo']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-tools"></i>
                    <span><?php echo implode(', ', $datosModulo['herramientas']); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Tabla de competidores -->
        <section class="competitors-table-section">
            <h2><i class="fas fa-building"></i> Competidores Analizados</h2>

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
            <h2><i class="fas fa-chart-bar"></i> Comparativa de Métricas Clave</h2>
            <div class="chart-container">
                <canvas id="competitorComparisonChart"></canvas>
            </div>
        </section>
    </div>

    <div class="page-footer">
        <div class="footer-note">
            <i class="fas fa-info-circle"></i>
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
        <h1><i class="fas fa-search-minus"></i> <?php echo htmlspecialchars($datosModulo['keyword_gap_analysis']['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($datosModulo['keyword_gap_analysis']['subtitulo']); ?></p>
    </div>

    <div class="page-body">
        <!-- Resumen de gap -->
        <section class="gap-summary">
            <?php $resumen = $datosModulo['keyword_gap_analysis']['resumen']; ?>
            <div class="gap-cards">
                <div class="gap-card total">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Total Keywords Gap</h3>
                    <p class="gap-number"><?php echo number_format($resumen['total_gap_keywords']); ?></p>
                    <span class="gap-label">Keywords donde competencia nos supera</span>
                </div>
                <div class="gap-card quick">
                    <i class="fas fa-bolt"></i>
                    <h3>Oportunidades Rápidas</h3>
                    <p class="gap-number"><?php echo number_format($resumen['oportunidades_rapidas']); ?></p>
                    <span class="gap-label">Dificultad baja, alto impacto</span>
                </div>
                <div class="gap-card medium">
                    <i class="fas fa-balance-scale"></i>
                    <h3>Oportunidades Medias</h3>
                    <p class="gap-number"><?php echo number_format($resumen['oportunidades_medias']); ?></p>
                    <span class="gap-label">Requiere esfuerzo moderado</span>
                </div>
                <div class="gap-card difficult">
                    <i class="fas fa-mountain"></i>
                    <h3>Oportunidades Difíciles</h3>
                    <p class="gap-number"><?php echo number_format($resumen['oportunidades_dificiles']); ?></p>
                    <span class="gap-label">Alta competitividad</span>
                </div>
            </div>
        </section>

        <!-- Top gap keywords -->
        <section class="gap-keywords-section">
            <h2><i class="fas fa-list"></i> Top Keywords con Potencial de Captura</h2>

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
                                <div class="difficulty-bar">
                                    <div class="difficulty-fill" style="width: <?php echo $keyword['dificultad']; ?>%"></div>
                                    <span class="difficulty-text"><?php echo $keyword['dificultad']; ?></span>
                                </div>
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
            <h2><i class="fas fa-users"></i> <?php echo htmlspecialchars($datosModulo['keywords_compartidas']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['keywords_compartidas']['subtitulo']); ?> (<?php echo $datosModulo['keywords_compartidas']['total']; ?> total)</p>

            <div class="shared-keywords-list">
                <?php foreach ($datosModulo['keywords_compartidas']['datos'] as $keyword): ?>
                <div class="shared-keyword-item">
                    <div class="shared-keyword-header">
                        <h4><?php echo htmlspecialchars($keyword['keyword']); ?></h4>
                        <div class="keyword-stats">
                            <span class="volume"><i class="fas fa-chart-line"></i> <?php echo number_format($keyword['volumen']); ?></span>
                            <span class="distance <?php echo $keyword['distancia_al_lider'] < 0 ? 'positive' : 'negative'; ?>">
                                <i class="fas fa-<?php echo $keyword['distancia_al_lider'] < 0 ? 'arrow-up' : 'arrow-down'; ?>"></i>
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
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
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
    min-width: 900px;
    border-collapse: collapse;
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
    table-layout: fixed;
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
.gap-table td:nth-child(3) { width: 25%; } /* Competencia */
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
    max-height: 120px;
    overflow-y: auto;
    padding-right: 0.5rem;
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
    background: #e9ecef;
    border-radius: 0.5rem;
    height: 24px;
    width: 80px;
}

.difficulty-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, #88B04B 0%, #88B04B 50%, #dc3545 100%);
    border-radius: 0.5rem;
    transition: width 0.3s;
}

.difficulty-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.75rem;
    font-weight: bold;
    z-index: 1;
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
    background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
    color: white;
    font-weight: bold;
    border: 2px solid #ffd700;
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
        <h1><i class="fas fa-chess"></i> Estrategia de Diferenciación y Conclusiones</h1>
    </div>

    <div class="page-body">
        <!-- Ventajas competitivas -->
        <section class="competitive-advantages">
            <h2><i class="fas fa-trophy"></i> <?php echo htmlspecialchars($datosModulo['ventajas_competitivas']['titulo']); ?></h2>

            <div class="advantages-grid">
                <div class="advantages-column strengths">
                    <h3><i class="fas fa-check-circle"></i> Nuestras Fortalezas</h3>
                    <?php foreach ($datosModulo['ventajas_competitivas']['nuestras_fortalezas'] as $fortaleza): ?>
                    <div class="advantage-item">
                        <h4><?php echo htmlspecialchars($fortaleza['area']); ?></h4>
                        <p><?php echo htmlspecialchars($fortaleza['descripcion']); ?></p>
                        <span class="example"><i class="fas fa-quote-left"></i> <?php echo htmlspecialchars($fortaleza['ejemplo']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="advantages-column weaknesses">
                    <h3><i class="fas fa-exclamation-triangle"></i> Debilidades Detectadas</h3>
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
            <h2><i class="fas fa-lightbulb"></i> <?php echo htmlspecialchars($datosModulo['estrategia_diferenciacion']['titulo']); ?></h2>

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
                                <i class="fas fa-tools"></i> Esfuerzo: <?php echo htmlspecialchars($estrategia['esfuerzo']); ?>
                            </span>
                            <span class="metric-badge impacto">
                                <i class="fas fa-chart-line"></i> Impacto: <?php echo htmlspecialchars($estrategia['impacto_esperado']); ?>
                            </span>
                            <span class="metric-badge tiempo">
                                <i class="fas fa-clock"></i> Tiempo: <?php echo htmlspecialchars($estrategia['tiempo']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Conclusiones -->
        <section class="conclusions-section">
            <h2><i class="fas fa-list-check"></i> Conclusiones Principales</h2>
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
            <h2><i class="fas fa-forward"></i> Plan de Acción Inmediato</h2>
            <div class="next-steps-timeline">
                <?php foreach ($datosModulo['proximos_pasos'] as $paso): ?>
                <div class="step-item priority-<?php echo strtolower($paso['prioridad']); ?>">
                    <div class="step-priority">
                        <span class="priority-badge"><?php echo htmlspecialchars($paso['prioridad']); ?></span>
                    </div>
                    <div class="step-content">
                        <h4><?php echo htmlspecialchars($paso['accion']); ?></h4>
                        <span class="step-timeline">
                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($paso['plazo']); ?>
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
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
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
</style>
