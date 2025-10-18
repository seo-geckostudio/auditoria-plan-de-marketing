<!-- Página 1: Resumen Ejecutivo de Oportunidades -->
<div class="audit-page opportunities-overview-page">
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1><i class="fas fa-lightbulb"></i> <?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
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
        <!-- Métricas principales -->
        <section class="opportunities-metrics">
            <div class="metrics-grid">
                <?php foreach ($datosModulo['metricas_oportunidades'] as $metrica): ?>
                <div class="metric-card">
                    <div class="metric-icon">
                        <i class="fas <?php echo $metrica['icono']; ?>"></i>
                    </div>
                    <div class="metric-content">
                        <h3><?php echo htmlspecialchars($metrica['label']); ?></h3>
                        <p class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></p>
                        <span class="metric-description"><?php echo htmlspecialchars($metrica['descripcion']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Categorías de oportunidades -->
        <section class="categories-section">
            <h2><i class="fas fa-layer-group"></i> Categorías de Oportunidades</h2>

            <div class="categories-grid">
                <?php foreach ($datosModulo['categorias_oportunidades'] as $categoria): ?>
                <div class="category-card" style="border-left-color: <?php echo $categoria['color']; ?>">
                    <div class="category-header">
                        <h3><?php echo htmlspecialchars($categoria['categoria']); ?></h3>
                        <span class="priority-badge" style="background: <?php echo $categoria['color']; ?>">
                            <?php echo htmlspecialchars($categoria['prioridad']); ?>
                        </span>
                    </div>
                    <p class="category-description"><?php echo htmlspecialchars($categoria['descripcion']); ?></p>

                    <div class="category-stats">
                        <div class="stat">
                            <i class="fas fa-key"></i>
                            <span><strong><?php echo $categoria['total_keywords']; ?></strong> keywords</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-users"></i>
                            <span><strong><?php echo number_format($categoria['trafico_potencial']); ?></strong> visitas/mes</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-gauge"></i>
                            <span>Dificultad <strong><?php echo $categoria['dificultad_promedio']; ?></strong></span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-tools"></i>
                            <span>Esfuerzo <strong><?php echo htmlspecialchars($categoria['esfuerzo']); ?></strong></span>
                        </div>
                    </div>

                    <div class="category-examples">
                        <h4>Ejemplos destacados:</h4>
                        <?php foreach (array_slice($categoria['ejemplos'], 0, 2) as $ejemplo): ?>
                        <div class="example-item">
                            <strong><?php echo htmlspecialchars($ejemplo['keyword']); ?></strong>
                            <div class="example-details">
                                <span class="detail-badge">Vol: <?php echo number_format($ejemplo['volumen']); ?></span>
                                <span class="detail-badge">Dif: <?php echo $ejemplo['dificultad']; ?></span>
                                <span class="detail-badge">CPC: <?php echo htmlspecialchars($ejemplo['cpc']); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Gráfico de distribución -->
        <section class="distribution-chart-section">
            <h2><i class="fas fa-chart-pie"></i> Distribución de Oportunidades</h2>
            <div class="chart-container">
                <canvas id="opportunitiesDistributionChart"></canvas>
            </div>
        </section>
    </div>
</div>

<script>
(function() {
    const ctx = document.getElementById('opportunitiesDistributionChart');
    if (!ctx) return;

    const categorias = <?php echo json_encode($datosModulo['categorias_oportunidades']); ?>;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: categorias.map(c => c.categoria),
            datasets: [{
                data: categorias.map(c => c.total_keywords),
                backgroundColor: categorias.map(c => c.color),
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        font: {
                            size: 14
                        },
                        padding: 20
                    }
                },
                title: {
                    display: false
                }
            }
        }
    });
})();
</script>

<style>
.opportunities-overview-page {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.opportunities-overview-page .page-header {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.header-text h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-text .subtitle {
    margin: 0;
    opacity: 0.9;
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
}

.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.metric-card {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 1.5rem;
    border-radius: 1rem;
    display: flex;
    gap: 1.5rem;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.metric-card:hover {
    transform: translateY(-4px);
}

.metric-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.metric-content h3 {
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
    opacity: 0.7;
}

.metric-value {
    margin: 0;
    font-size: 2rem;
    font-weight: bold;
    color: #88B04B;
}

.metric-description {
    font-size: 0.85rem;
    opacity: 0.7;
}

.categories-section {
    margin-bottom: 2rem;
}

.categories-section h2 {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.category-card {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 1.5rem;
    border-radius: 1rem;
    border-left: 5px solid;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.category-header h3 {
    margin: 0;
    font-size: 1.3rem;
}

.priority-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
}

.category-description {
    margin: 0 0 1.5rem 0;
    line-height: 1.6;
    opacity: 0.8;
}

.category-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    font-size: 0.9rem;
}

.stat i {
    color: #88B04B;
}

.category-examples {
    border-top: 1px solid #e0e0e0;
    padding-top: 1rem;
}

.category-examples h4 {
    margin: 0 0 1rem 0;
    font-size: 0.95rem;
    opacity: 0.8;
}

.example-item {
    background: #f8f9fa;
    padding: 0.75rem;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
}

.example-item strong {
    display: block;
    margin-bottom: 0.5rem;
    color: #88B04B;
}

.example-details {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.detail-badge {
    padding: 0.25rem 0.5rem;
    background: white;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: bold;
}

.distribution-chart-section {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 2rem;
    border-radius: 1rem;
}

.distribution-chart-section h2 {
    margin-top: 0;
}

.chart-container {
    height: 400px;
    margin-top: 1.5rem;
}
</style>

<!-- Página 2: Análisis Detallado por Categoría -->
<div class="audit-page categories-detail-page">
    <div class="page-header">
        <h1><i class="fas fa-table"></i> Análisis Detallado por Categoría</h1>
    </div>

    <div class="page-body">
        <?php foreach ($datosModulo['categorias_oportunidades'] as $categoria): ?>
        <section class="category-detail-section" style="border-color: <?php echo $categoria['color']; ?>">
            <div class="category-detail-header" style="background: <?php echo $categoria['color']; ?>">
                <h2><?php echo htmlspecialchars($categoria['categoria']); ?></h2>
                <div class="header-badges">
                    <span class="badge"><?php echo $categoria['total_keywords']; ?> keywords</span>
                    <span class="badge"><?php echo number_format($categoria['trafico_potencial']); ?> visitas/mes</span>
                    <span class="badge">Prioridad: <?php echo htmlspecialchars($categoria['prioridad']); ?></span>
                </div>
            </div>

            <div class="category-detail-body">
                <p class="category-intro"><?php echo htmlspecialchars($categoria['descripcion']); ?></p>

                <div class="keywords-table-container">
                    <table class="keywords-table">
                        <thead>
                            <tr>
                                <th>Keyword</th>
                                <th>Posición Actual</th>
                                <th>Objetivo</th>
                                <th>Volumen</th>
                                <th>Dificultad</th>
                                <th>CPC</th>
                                <th>Acción Recomendada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoria['ejemplos'] as $ejemplo): ?>
                            <tr>
                                <td class="keyword-cell">
                                    <strong><?php echo htmlspecialchars($ejemplo['keyword']); ?></strong>
                                </td>
                                <td class="position-cell">
                                    <?php if ($ejemplo['posicion_actual'] === null): ?>
                                    <span class="pos-badge no-rank">No posicionado</span>
                                    <?php else: ?>
                                    <span class="pos-badge current">#<?php echo $ejemplo['posicion_actual']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="target-cell">
                                    <span class="pos-badge target">#<?php echo $ejemplo['posicion_objetivo']; ?></span>
                                    <?php if ($ejemplo['posicion_actual'] !== null): ?>
                                    <span class="improvement">
                                        <i class="fas fa-arrow-up"></i> <?php echo $ejemplo['posicion_actual'] - $ejemplo['posicion_objetivo']; ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td class="volume-cell"><?php echo number_format($ejemplo['volumen']); ?></td>
                                <td class="difficulty-cell">
                                    <div class="difficulty-indicator">
                                        <div class="difficulty-bar" style="width: <?php echo $ejemplo['dificultad']; ?>%"></div>
                                        <span><?php echo $ejemplo['dificultad']; ?></span>
                                    </div>
                                </td>
                                <td class="cpc-cell"><?php echo htmlspecialchars($ejemplo['cpc']); ?></td>
                                <td class="action-cell">
                                    <span class="action-text"><?php echo htmlspecialchars($ejemplo['accion']); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
    </div>
</div>

<style>
.categories-detail-page {
    background: #f8f9fa;
}

.category-detail-section {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    margin-bottom: 2rem;
    border-left: 5px solid;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.category-detail-header {
    color: white;
    padding: 1.5rem;
}

.category-detail-header h2 {
    margin: 0 0 1rem 0;
}

.header-badges {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.header-badges .badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
}

.category-detail-body {
    padding: 2rem;
}

.category-intro {
    margin: 0 0 2rem 0;
    font-size: 1.05rem;
    line-height: 1.6;
    color: #6c757d;
}

.keywords-table-container {
    overflow-x: auto;
}

.keywords-table {
    width: 100%;
    border-collapse: collapse;
}

.keywords-table thead {
    background: #f8f9fa;
}

.keywords-table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.keywords-table td {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.keywords-table tbody tr:hover {
    background: #f8f9fa;
}

.keyword-cell strong {
    color: #88B04B;
}

.pos-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.85rem;
}

.pos-badge.no-rank {
    background: #6c757d;
    color: white;
}

.pos-badge.current {
    background: #ffc107;
    color: #333;
}

.pos-badge.target {
    background: #28a745;
    color: white;
}

.improvement {
    display: inline-block;
    margin-left: 0.5rem;
    color: #28a745;
    font-size: 0.85rem;
    font-weight: bold;
}

.difficulty-indicator {
    position: relative;
    width: 100px;
    height: 24px;
    background: #e9ecef;
    border-radius: 0.5rem;
}

.difficulty-bar {
    position: absolute;
    height: 100%;
    background: linear-gradient(90deg, #28a745 0%, #ffc107 50%, #dc3545 100%);
    border-radius: 0.5rem;
    transition: width 0.3s;
}

.difficulty-indicator span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.75rem;
    font-weight: bold;
    z-index: 1;
}

.action-text {
    font-size: 0.9rem;
    color: #6c757d;
}
</style>

<!-- Página 3: Análisis Especiales -->
<div class="audit-page special-analysis-page">
    <div class="page-header">
        <h1><i class="fas fa-star"></i> Análisis Especiales</h1>
    </div>

    <div class="page-body">
        <!-- Keywords en tendencia -->
        <section class="trending-keywords-section">
            <h2><i class="fas fa-chart-line"></i> <?php echo htmlspecialchars($datosModulo['keywords_tendencia']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['keywords_tendencia']['descripcion']); ?></p>

            <div class="trending-grid">
                <?php foreach ($datosModulo['keywords_tendencia']['datos'] as $trend): ?>
                <div class="trending-card">
                    <div class="trending-header">
                        <h3><?php echo htmlspecialchars($trend['keyword']); ?></h3>
                        <span class="growth-badge">
                            <i class="fas fa-arrow-trend-up"></i> <?php echo htmlspecialchars($trend['crecimiento']); ?>
                        </span>
                    </div>
                    <div class="trending-stats">
                        <div class="stat-item">
                            <span class="stat-label">Volumen actual</span>
                            <span class="stat-value"><?php echo number_format($trend['volumen_actual']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Hace 12 meses</span>
                            <span class="stat-value"><?php echo number_format($trend['volumen_hace_12m']); ?></span>
                        </div>
                    </div>
                    <span class="opportunity-tag opp-<?php echo strtolower($trend['oportunidad']); ?>">
                        Oportunidad: <?php echo htmlspecialchars($trend['oportunidad']); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Análisis estacional -->
        <section class="seasonal-analysis-section">
            <h2><i class="fas fa-calendar-days"></i> <?php echo htmlspecialchars($datosModulo['analisis_estacional']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['analisis_estacional']['descripcion']); ?></p>

            <div class="seasons-grid">
                <?php foreach ($datosModulo['analisis_estacional']['temporadas'] as $temporada): ?>
                <div class="season-card">
                    <h3><?php echo htmlspecialchars($temporada['nombre']); ?></h3>
                    <p class="season-months"><?php echo htmlspecialchars($temporada['meses']); ?></p>

                    <div class="season-metrics">
                        <div class="metric">
                            <i class="fas fa-key"></i>
                            <span><?php echo $temporada['keywords_objetivo']; ?> keywords</span>
                        </div>
                        <div class="metric">
                            <i class="fas fa-chart-line"></i>
                            <span><?php echo htmlspecialchars($temporada['pico_busquedas']); ?> pico</span>
                        </div>
                        <div class="metric">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Prioridad <?php echo htmlspecialchars($temporada['prioridad']); ?></span>
                        </div>
                    </div>

                    <div class="season-examples">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($temporada['ejemplos'] as $ejemplo): ?>
                            <li><?php echo htmlspecialchars($ejemplo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Eventos especiales -->
            <div class="special-events">
                <h3><i class="fas fa-calendar-star"></i> Eventos Especiales</h3>
                <div class="events-grid">
                    <?php foreach ($datosModulo['analisis_estacional']['eventos_especiales'] as $evento): ?>
                    <div class="event-card">
                        <h4><?php echo htmlspecialchars($evento['evento']); ?></h4>
                        <p class="event-volume">
                            <i class="fas fa-users"></i> Volumen pico: <?php echo htmlspecialchars($evento['volumen_pico']); ?>
                        </p>
                        <div class="event-keywords">
                            <?php foreach ($evento['keywords'] as $kw): ?>
                            <span class="kw-tag"><?php echo htmlspecialchars($kw); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Análisis por intención -->
        <section class="intent-analysis-section">
            <h2><i class="fas fa-bullseye"></i> <?php echo htmlspecialchars($datosModulo['analisis_intencion']['titulo']); ?></h2>

            <div class="intent-grid">
                <?php foreach ($datosModulo['analisis_intencion']['distribución'] as $intent): ?>
                <div class="intent-card">
                    <h3><?php echo htmlspecialchars($intent['tipo']); ?></h3>
                    <p class="intent-description"><?php echo htmlspecialchars($intent['descripcion']); ?></p>

                    <div class="intent-metrics">
                        <div class="metric-row">
                            <span class="metric-label">Total keywords:</span>
                            <span class="metric-value"><?php echo $intent['total']; ?></span>
                        </div>
                        <div class="metric-row">
                            <span class="metric-label">Conversión esperada:</span>
                            <span class="metric-value conversion"><?php echo htmlspecialchars($intent['conversion_esperada']); ?></span>
                        </div>
                        <div class="metric-row">
                            <span class="metric-label">Valor promedio:</span>
                            <span class="metric-value value"><?php echo htmlspecialchars($intent['valor_promedio']); ?></span>
                        </div>
                    </div>

                    <div class="intent-examples">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($intent['ejemplos'] as $ej): ?>
                            <li><?php echo htmlspecialchars($ej); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<style>
.special-analysis-page {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.special-analysis-page .page-header {
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    margin: -2rem -2rem 2rem -2rem;
}

.special-analysis-page section {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.section-subtitle {
    margin: -0.5rem 0 1.5rem 0;
    opacity: 0.7;
}

.trending-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.trending-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border: 2px solid #e0e0e0;
}

.trending-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.trending-header h3 {
    margin: 0;
    font-size: 1.1rem;
    color: #88B04B;
    flex: 1;
}

.growth-badge {
    background: #28a745;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
    white-space: nowrap;
}

.trending-stats {
    display: flex;
    justify-content: space-between;
    margin: 1rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.7;
}

.stat-value {
    font-size: 1.2rem;
    font-weight: bold;
    color: #88B04B;
}

.opportunity-tag {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.opportunity-tag.opp-alta {
    background: #d4edda;
    color: #155724;
}

.opportunity-tag.opp-media {
    background: #fff3cd;
    color: #856404;
}

.seasons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.season-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #88B04B;
}

.season-card h3 {
    margin: 0 0 0.5rem 0;
    color: #88B04B;
}

.season-months {
    margin: 0 0 1rem 0;
    opacity: 0.7;
    font-weight: bold;
}

.season-metrics {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.season-metrics .metric {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.season-metrics .metric i {
    color: #88B04B;
}

.season-examples {
    border-top: 1px solid #e0e0e0;
    padding-top: 1rem;
}

.season-examples strong {
    display: block;
    margin-bottom: 0.5rem;
}

.season-examples ul {
    margin: 0;
    padding-left: 1.5rem;
}

.season-examples li {
    margin: 0.25rem 0;
    font-size: 0.9rem;
}

.special-events {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
}

.special-events h3 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.event-card {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
}

.event-card h4 {
    margin: 0 0 0.75rem 0;
}

.event-volume {
    margin: 0 0 0.75rem 0;
    font-size: 0.9rem;
    opacity: 0.8;
}

.event-keywords {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.kw-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: #e9ecef;
    border-radius: 0.25rem;
    font-size: 0.85rem;
}

.intent-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.intent-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-top: 4px solid #88B04B;
}

.intent-card h3 {
    margin: 0 0 0.75rem 0;
    color: #88B04B;
}

.intent-description {
    margin: 0 0 1.5rem 0;
    opacity: 0.7;
}

.intent-metrics {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.metric-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.metric-row:not(:last-child) {
    border-bottom: 1px solid #e0e0e0;
}

.metric-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.metric-value {
    font-weight: bold;
}

.metric-value.conversion {
    color: #28a745;
}

.metric-value.value {
    color: #ffc107;
}

.intent-examples {
    border-top: 1px solid #e0e0e0;
    padding-top: 1rem;
}

.intent-examples strong {
    display: block;
    margin-bottom: 0.5rem;
}

.intent-examples ul {
    margin: 0;
    padding-left: 1.5rem;
}

.intent-examples li {
    margin: 0.25rem 0;
    font-size: 0.9rem;
}
</style>

<!-- Página 4: Plan de Implementación y Priorización -->
<div class="audit-page implementation-plan-page">
    <div class="page-header">
        <h1><i class="fas fa-tasks"></i> Plan de Implementación y Matriz de Priorización</h1>
    </div>

    <div class="page-body">
        <!-- Matriz de priorización -->
        <section class="prioritization-matrix">
            <h2><i class="fas fa-sort-amount-down"></i> <?php echo htmlspecialchars($datosModulo['matriz_priorizacion']['titulo']); ?></h2>

            <div class="criteria-info">
                <strong>Criterios de priorización:</strong>
                <ul>
                    <?php foreach ($datosModulo['matriz_priorizacion']['criterios'] as $criterio): ?>
                    <li><?php echo htmlspecialchars($criterio); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="top-keywords-table-container">
                <table class="top-keywords-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Keyword</th>
                            <th>Score</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($datosModulo['matriz_priorizacion']['top_25_priorizadas'], 0, 15) as $kw): ?>
                        <tr>
                            <td class="rank-cell">
                                <span class="rank-badge rank-<?php echo $kw['rank']; ?>"><?php echo $kw['rank']; ?></span>
                            </td>
                            <td class="kw-cell">
                                <strong><?php echo htmlspecialchars($kw['keyword']); ?></strong>
                            </td>
                            <td class="score-cell">
                                <div class="score-bar">
                                    <div class="score-fill" style="width: <?php echo $kw['score']; ?>%"></div>
                                    <span><?php echo $kw['score']; ?></span>
                                </div>
                            </td>
                            <td class="category-cell">
                                <span class="cat-tag"><?php echo htmlspecialchars($kw['categoria']); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Plan de implementación -->
        <section class="implementation-phases">
            <h2><i class="fas fa-road"></i> <?php echo htmlspecialchars($datosModulo['plan_implementacion']['titulo']); ?></h2>

            <div class="phases-timeline">
                <?php foreach ($datosModulo['plan_implementacion']['fases'] as $index => $fase): ?>
                <div class="phase-card">
                    <div class="phase-number">Fase <?php echo $index + 1; ?></div>
                    <div class="phase-content">
                        <h3><?php echo htmlspecialchars($fase['fase']); ?></h3>
                        <div class="phase-meta">
                            <span class="meta-badge"><i class="fas fa-clock"></i> <?php echo htmlspecialchars($fase['duracion']); ?></span>
                            <span class="meta-badge"><i class="fas fa-key"></i> <?php echo $fase['keywords_objetivo']; ?> keywords</span>
                        </div>

                        <div class="phase-actions">
                            <strong>Acciones principales:</strong>
                            <ul>
                                <?php foreach ($fase['acciones'] as $accion): ?>
                                <li><?php echo htmlspecialchars($accion); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="phase-resources">
                            <div class="resource-item">
                                <i class="fas fa-users"></i>
                                <span><?php echo implode(', ', $fase['recursos_necesarios']); ?></span>
                            </div>
                            <div class="resource-item">
                                <i class="fas fa-euro-sign"></i>
                                <span><?php echo htmlspecialchars($fase['coste_estimado']); ?></span>
                            </div>
                            <div class="resource-item roi">
                                <i class="fas fa-chart-line"></i>
                                <span>ROI: <?php echo htmlspecialchars($fase['roi_esperado']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Conclusiones y recomendaciones -->
        <section class="final-recommendations">
            <div class="conclusions-column">
                <h2><i class="fas fa-check-double"></i> Conclusiones</h2>
                <ul class="conclusions-list">
                    <?php foreach ($datosModulo['conclusiones'] as $conclusion): ?>
                    <li><?php echo htmlspecialchars($conclusion); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="recommendations-column">
                <h2><i class="fas fa-lightbulb"></i> Recomendaciones</h2>
                <?php foreach ($datosModulo['recomendaciones'] as $rec): ?>
                <div class="recommendation-card priority-<?php echo strtolower($rec['prioridad']); ?>">
                    <div class="rec-header">
                        <span class="priority-badge"><?php echo htmlspecialchars($rec['prioridad']); ?></span>
                        <h4><?php echo htmlspecialchars($rec['titulo']); ?></h4>
                    </div>
                    <p><?php echo htmlspecialchars($rec['descripcion']); ?></p>
                    <span class="rec-timeline">
                        <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($rec['plazo']); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<style>
.implementation-plan-page {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
}

.implementation-plan-page .page-header {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    padding: 1.5rem;
    margin: -2rem -2rem 2rem -2rem;
}

.implementation-plan-page section {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.criteria-info {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.criteria-info ul {
    margin: 0.5rem 0 0 0;
    padding-left: 1.5rem;
}

.top-keywords-table-container {
    overflow-x: auto;
}

.top-keywords-table {
    width: 100%;
    border-collapse: collapse;
}

.top-keywords-table thead {
    background: #88B04B;
    color: white;
}

.top-keywords-table th,
.top-keywords-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
}

.rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-weight: bold;
    background: #88B04B;
    color: white;
}

.rank-badge.rank-1,
.rank-badge.rank-2,
.rank-badge.rank-3 {
    background: #ffd700;
    color: #333;
}

.kw-cell strong {
    color: #88B04B;
}

.score-bar {
    position: relative;
    width: 150px;
    height: 28px;
    background: #e9ecef;
    border-radius: 0.5rem;
}

.score-fill {
    position: absolute;
    height: 100%;
    background: linear-gradient(90deg, #28a745 0%, #ffc107 50%, #dc3545 100%);
    border-radius: 0.5rem;
}

.score-bar span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    z-index: 1;
}

.cat-tag {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #e9ecef;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.phases-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.phase-card {
    display: flex;
    gap: 1.5rem;
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #88B04B;
}

.phase-number {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: bold;
}

.phase-content {
    flex: 1;
}

.phase-content h3 {
    margin: 0 0 1rem 0;
    color: #88B04B;
}

.phase-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.meta-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    font-size: 0.9rem;
}

.phase-actions {
    margin-bottom: 1rem;
}

.phase-actions strong {
    display: block;
    margin-bottom: 0.5rem;
}

.phase-actions ul {
    margin: 0;
    padding-left: 1.5rem;
}

.phase-actions li {
    margin: 0.5rem 0;
}

.phase-resources {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding-top: 1rem;
    border-top: 1px solid #e0e0e0;
}

.resource-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.resource-item i {
    color: #88B04B;
}

.resource-item.roi {
    font-weight: bold;
    color: #28a745;
}

.final-recommendations {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.conclusions-list {
    list-style: none;
    padding: 0;
    margin: 1rem 0 0 0;
}

.conclusions-list li {
    padding: 1rem;
    background: white;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    border-left: 4px solid #28a745;
}

.recommendation-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    border-left: 4px solid;
}

.recommendation-card.priority-crítica {
    border-left-color: #dc3545;
}

.recommendation-card.priority-alta {
    border-left-color: #ffc107;
}

.recommendation-card.priority-media {
    border-left-color: #28a745;
}

.rec-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.rec-header .priority-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
}

.recommendation-card.priority-crítica .priority-badge {
    background: #dc3545;
    color: white;
}

.recommendation-card.priority-alta .priority-badge {
    background: #ffc107;
    color: #333;
}

.recommendation-card.priority-media .priority-badge {
    background: #28a745;
    color: white;
}

.rec-header h4 {
    margin: 0;
}

.recommendation-card p {
    margin: 0 0 1rem 0;
    line-height: 1.6;
}

.rec-timeline {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.9rem;
}
</style>
