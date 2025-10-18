<!-- Página 1: Visión General del Mapping -->
<div class="audit-page mapping-overview-page">
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1><i class="fas fa-sitemap"></i> <?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
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
        <section class="mapping-metrics">
            <div class="metrics-grid">
                <?php foreach ($datosModulo['metricas_mapping'] as $metrica): ?>
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

        <!-- Estructura del sitio -->
        <section class="site-structure-section">
            <h2><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($datosModulo['estructura_sitio']['titulo']); ?></h2>

            <div class="structure-grid">
                <?php foreach ($datosModulo['estructura_sitio']['categorias'] as $categoria): ?>
                <div class="structure-card">
                    <div class="structure-header">
                        <h3><?php echo htmlspecialchars($categoria['tipo']); ?></h3>
                        <span class="priority-badge priority-<?php echo strtolower($categoria['prioridad']); ?>">
                            <?php echo htmlspecialchars($categoria['prioridad']); ?>
                        </span>
                    </div>

                    <div class="structure-stats">
                        <div class="stat-row">
                            <span class="stat-label"><i class="fas fa-link"></i> URLs:</span>
                            <span class="stat-value"><?php echo $categoria['total_urls']; ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label"><i class="fas fa-key"></i> Keywords:</span>
                            <span class="stat-value"><?php echo $categoria['keywords_asignadas']; ?></span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label"><i class="fas fa-bullseye"></i> Intención:</span>
                            <span class="stat-value"><?php echo htmlspecialchars($categoria['intención']); ?></span>
                        </div>
                    </div>

                    <div class="structure-example">
                        <strong>Ejemplo URL:</strong>
                        <code><?php echo htmlspecialchars($categoria['ejemplo_url']); ?></code>
                    </div>

                    <div class="structure-keywords">
                        <strong>Keywords principales:</strong>
                        <div class="keywords-tags">
                            <?php foreach ($categoria['keywords_principales'] as $kw): ?>
                            <span class="kw-tag"><?php echo htmlspecialchars($kw); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="structure-status">
                        <span class="status-badge status-<?php echo strtolower(str_replace(' ', '-', $categoria['estado'])); ?>">
                            <?php echo htmlspecialchars($categoria['estado']); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Gráfico de distribución -->
        <section class="distribution-chart">
            <h2><i class="fas fa-chart-pie"></i> Distribución de Keywords por Tipo de Página</h2>
            <div class="chart-container">
                <canvas id="keywordDistributionChart"></canvas>
            </div>
        </section>
    </div>
</div>

<script>
(function() {
    const ctx = document.getElementById('keywordDistributionChart');
    if (!ctx) return;

    const categorias = <?php echo json_encode($datosModulo['estructura_sitio']['categorias']); ?>;

    const colors = [
        '#88B04B', '#6d8f3c', '#f093fb', '#f5576c',
        '#4facfe', '#00f2fe', '#43e97b', '#38f9d7'
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categorias.map(c => c.tipo),
            datasets: [{
                label: 'Keywords Asignadas',
                data: categorias.map(c => c.keywords_asignadas),
                backgroundColor: colors,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Número de Keywords'
                    }
                }
            }
        }
    });
})();
</script>

<style>
.mapping-overview-page {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.mapping-overview-page .page-header {
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

.site-structure-section {
    margin-bottom: 2rem;
}

.site-structure-section h2 {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.structure-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.structure-card {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.structure-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e0e0e0;
}

.structure-header h3 {
    margin: 0;
    font-size: 1.2rem;
    color: #88B04B;
}

.priority-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
}

.priority-badge.priority-crítica {
    background: #dc3545;
    color: white;
}

.priority-badge.priority-alta {
    background: #88B04B;
    color: #333;
}

.priority-badge.priority-media {
    background: #88B04B;
    color: white;
}

.structure-stats {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stat-label i {
    color: #88B04B;
}

.stat-value {
    font-weight: bold;
}

.structure-example {
    margin: 1rem 0;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.structure-example strong {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.structure-example code {
    display: block;
    padding: 0.5rem;
    background: white;
    border-radius: 0.25rem;
    color: #88B04B;
    font-family: 'Courier New', monospace;
}

.structure-keywords {
    margin: 1rem 0;
}

.structure-keywords strong {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.keywords-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.kw-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: #e9ecef;
    border-radius: 0.5rem;
    font-size: 0.85rem;
}

.structure-status {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e0e0e0;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.9rem;
}

.status-badge.status-optimizar {
    background: #f0f7e6;
    color: #856404;
}

.status-badge.status-crear-8-nuevas,
.status-badge.status-crear-5-nuevas,
.status-badge.status-crear-3-nuevas,
.status-badge.status-crear-8-nuevas,
.status-badge.status-crear-30-artículos-nuevos {
    background: #d4edda;
    color: #155724;
}

.status-badge.status-optimizar-fichas-existentes {
    background: #d1ecf1;
    color: #0c5460;
}

.distribution-chart {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 2rem;
    border-radius: 1rem;
}

.distribution-chart h2 {
    margin-top: 0;
}

.chart-container {
    height: 500px;
    margin-top: 1.5rem;
}
</style>

<!-- Página 2: Mapping Detallado y Clusters Temáticos -->
<div class="audit-page mapping-detail-page">
    <div class="page-header">
        <h1><i class="fas fa-map-marked-alt"></i> Mapping Detallado y Clusters Temáticos</h1>
    </div>

    <div class="page-body">
        <!-- Mapping detallado top URLs -->
        <section class="detailed-mapping-section">
            <h2><i class="fas fa-list-ul"></i> <?php echo htmlspecialchars($datosModulo['mapping_detallado']['titulo']); ?></h2>

            <?php foreach ($datosModulo['mapping_detallado']['urls'] as $url): ?>
            <div class="url-mapping-card">
                <div class="url-header">
                    <div class="url-info">
                        <h3><?php echo htmlspecialchars($url['url']); ?></h3>
                        <div class="url-meta">
                            <span class="type-badge"><?php echo htmlspecialchars($url['tipo']); ?></span>
                            <span class="status-badge"><?php echo htmlspecialchars($url['estado']); ?></span>
                        </div>
                    </div>
                    <div class="url-metrics">
                        <?php if ($url['posicion_actual'] !== null): ?>
                        <div class="metric-item">
                            <span class="metric-label">Posición</span>
                            <span class="position-badge current">#<?php echo $url['posicion_actual']; ?></span>
                            <i class="fas fa-arrow-right"></i>
                            <span class="position-badge target">#<?php echo $url['objetivo_posicion']; ?></span>
                        </div>
                        <?php else: ?>
                        <div class="metric-item">
                            <span class="metric-label">Objetivo</span>
                            <span class="position-badge target">#<?php echo $url['objetivo_posicion']; ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="metric-item">
                            <span class="metric-label">Tráfico</span>
                            <span class="traffic-value"><?php echo number_format($url['trafico_actual']); ?></span>
                            <i class="fas fa-arrow-right"></i>
                            <span class="traffic-value potential"><?php echo number_format($url['trafico_potencial']); ?></span>
                        </div>
                    </div>
                </div>

                <div class="url-keywords">
                    <div class="keyword-group">
                        <strong><i class="fas fa-star"></i> Keyword Principal:</strong>
                        <span class="main-keyword"><?php echo htmlspecialchars($url['keyword_principal']); ?></span>
                    </div>

                    <div class="keyword-group">
                        <strong><i class="fas fa-tags"></i> Keywords Secundarias:</strong>
                        <div class="keywords-list">
                            <?php foreach ($url['keywords_secundarias'] as $kw): ?>
                            <span class="kw-tag secondary"><?php echo htmlspecialchars($kw); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="keyword-group">
                        <strong><i class="fas fa-list"></i> Long Tail:</strong>
                        <div class="keywords-list">
                            <?php foreach ($url['keywords_long_tail'] as $kw): ?>
                            <span class="kw-tag longtail"><?php echo htmlspecialchars($kw); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="url-actions">
                    <strong><i class="fas fa-tasks"></i> Acciones Recomendadas:</strong>
                    <ul>
                        <?php foreach ($url['acciones'] as $accion): ?>
                        <li><?php echo htmlspecialchars($accion); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Clusters temáticos -->
        <section class="clusters-section">
            <h2><i class="fas fa-object-group"></i> <?php echo htmlspecialchars($datosModulo['clusters_tematicos']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['clusters_tematicos']['descripcion']); ?></p>

            <div class="clusters-grid">
                <?php foreach ($datosModulo['clusters_tematicos']['clusters'] as $cluster): ?>
                <div class="cluster-card">
                    <div class="cluster-header">
                        <h3><?php echo htmlspecialchars($cluster['tema']); ?></h3>
                        <span class="priority-badge priority-<?php echo strtolower($cluster['prioridad']); ?>">
                            <?php echo htmlspecialchars($cluster['prioridad']); ?>
                        </span>
                    </div>

                    <div class="pillar-info">
                        <strong>Pillar Page:</strong>
                        <code><?php echo htmlspecialchars($cluster['pillar_page']); ?></code>
                        <div class="pillar-stats">
                            <span><i class="fas fa-key"></i> <?php echo $cluster['total_keywords']; ?> keywords</span>
                            <span class="status-badge"><?php echo htmlspecialchars($cluster['estado']); ?></span>
                        </div>
                    </div>

                    <div class="subtopics-list">
                        <strong>Sub-tópicos:</strong>
                        <?php foreach ($cluster['sub_topicos'] as $subtopic): ?>
                        <div class="subtopic-item">
                            <div class="subtopic-info">
                                <span class="subtopic-name"><?php echo htmlspecialchars($subtopic['nombre']); ?></span>
                                <code class="subtopic-url"><?php echo htmlspecialchars($subtopic['url']); ?></code>
                            </div>
                            <div class="subtopic-meta">
                                <span class="kw-count"><?php echo $subtopic['keywords']; ?> KW</span>
                                <span class="status-mini status-<?php echo strtolower($subtopic['estado']); ?>">
                                    <?php echo htmlspecialchars($subtopic['estado']); ?>
                                </span>
                            </div>
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
.mapping-detail-page {
    background: #f8f9fa;
}

.section-subtitle {
    margin: -0.5rem 0 1.5rem 0;
    opacity: 0.7;
    font-size: 1.05rem;
}

.url-mapping-card {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #88B04B;
}

.url-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #e0e0e0;
}

.url-info h3 {
    margin: 0 0 0.75rem 0;
    color: #88B04B;
    font-family: 'Courier New', monospace;
}

.url-meta {
    display: flex;
    gap: 0.75rem;
}

.type-badge {
    padding: 0.25rem 0.75rem;
    background: #e9ecef;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    background: #d4edda;
    color: #155724;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.url-metrics {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: flex-end;
}

.metric-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.7;
}

.position-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
}

.position-badge.current {
    background: #88B04B;
    color: #333;
}

.position-badge.target {
    background: #88B04B;
    color: white;
}

.traffic-value {
    font-weight: bold;
    font-size: 1.1rem;
}

.traffic-value.potential {
    color: #88B04B;
}

.url-keywords {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.keyword-group {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
}

.keyword-group strong {
    display: block;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.keyword-group strong i {
    color: #88B04B;
}

.main-keyword {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 0.5rem;
    font-weight: bold;
}

.keywords-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.kw-tag {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.9rem;
}

.kw-tag.secondary {
    background: #e3f2fd;
    color: #1976d2;
}

.kw-tag.longtail {
    background: #fff3e0;
    color: #e65100;
}

.url-actions {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
}

.url-actions strong {
    display: block;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.url-actions strong i {
    color: #88B04B;
}

.url-actions ul {
    margin: 0;
    padding-left: 1.5rem;
}

.url-actions li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

.clusters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.cluster-card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-top: 4px solid #88B04B;
}

.cluster-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.cluster-header h3 {
    margin: 0;
    color: #88B04B;
}

.pillar-info {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.pillar-info strong {
    display: block;
    margin-bottom: 0.5rem;
}

.pillar-info code {
    display: block;
    padding: 0.5rem;
    background: white;
    border-radius: 0.25rem;
    color: #88B04B;
    font-family: 'Courier New', monospace;
    margin-bottom: 0.75rem;
}

.pillar-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pillar-stats span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pillar-stats i {
    color: #88B04B;
}

.subtopics-list strong {
    display: block;
    margin-bottom: 1rem;
}

.subtopic-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
}

.subtopic-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.subtopic-name {
    font-weight: bold;
}

.subtopic-url {
    font-size: 0.85rem;
    color: #6c757d;
    font-family: 'Courier New', monospace;
}

.subtopic-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.kw-count {
    font-size: 0.85rem;
    font-weight: bold;
    color: #88B04B;
}

.status-mini {
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: bold;
}

.status-mini.status-optimizar {
    background: #f0f7e6;
    color: #856404;
}

.status-mini.status-crear {
    background: #d4edda;
    color: #155724;
}
</style>

<!-- Página 3: Keywords Huérfanas y Plan de Implementación -->
<div class="audit-page implementation-page">
    <div class="page-header">
        <h1><i class="fas fa-road"></i> Keywords Huérfanas y Plan de Implementación</h1>
    </div>

    <div class="page-body">
        <!-- Keywords huérfanas -->
        <section class="orphan-keywords-section">
            <h2><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($datosModulo['keywords_huerfanas']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['keywords_huerfanas']['descripcion']); ?></p>

            <div class="orphan-summary">
                <div class="summary-card">
                    <i class="fas fa-key"></i>
                    <div class="summary-content">
                        <h3>Total Keywords Huérfanas</h3>
                        <p class="summary-value"><?php echo $datosModulo['keywords_huerfanas']['total']; ?></p>
                    </div>
                </div>
            </div>

            <?php foreach ($datosModulo['keywords_huerfanas']['categorias'] as $categoria): ?>
            <div class="orphan-category">
                <h3><?php echo htmlspecialchars($categoria['categoria']); ?></h3>
                <div class="orphan-keywords-list">
                    <?php foreach ($categoria['keywords'] as $kw): ?>
                    <div class="orphan-keyword-card">
                        <div class="orphan-header">
                            <h4><?php echo htmlspecialchars($kw['keyword']); ?></h4>
                            <div class="orphan-metrics">
                                <span class="metric-badge volume">
                                    <i class="fas fa-chart-line"></i> <?php echo number_format($kw['volumen']); ?>
                                </span>
                                <span class="metric-badge difficulty">
                                    <i class="fas fa-gauge"></i> Dif: <?php echo $kw['dificultad']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="orphan-proposal">
                            <div class="proposal-item">
                                <strong>URL Propuesta:</strong>
                                <code><?php echo htmlspecialchars($kw['url_propuesta']); ?></code>
                            </div>
                            <div class="proposal-item">
                                <strong>Tipo de Contenido:</strong>
                                <span class="content-type-badge"><?php echo htmlspecialchars($kw['tipo_contenido']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Estrategia de internal linking -->
        <section class="linking-strategy-section">
            <h2><i class="fas fa-link"></i> <?php echo htmlspecialchars($datosModulo['estrategia_internal_linking']['titulo']); ?></h2>
            <p class="section-subtitle"><?php echo htmlspecialchars($datosModulo['estrategia_internal_linking']['descripcion']); ?></p>

            <div class="linking-pillars">
                <?php foreach ($datosModulo['estrategia_internal_linking']['pilares'] as $pilar): ?>
                <div class="linking-card">
                    <h3><?php echo htmlspecialchars($pilar['tipo']); ?></h3>
                    <span class="priority-badge priority-<?php echo strtolower($pilar['prioridad']); ?>">
                        <?php echo htmlspecialchars($pilar['prioridad']); ?>
                    </span>
                    <div class="linking-info">
                        <div class="info-item">
                            <strong>Enlaces de salida:</strong>
                            <span><?php echo $pilar['enlaces_salida']; ?></span>
                        </div>
                        <div class="info-item">
                            <strong>Destinos:</strong>
                            <span><?php echo implode(', ', $pilar['destinos']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>Estrategia:</strong>
                            <p><?php echo htmlspecialchars($pilar['estrategia']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="linking-rules">
                <h3>Reglas de Enlazado</h3>
                <ul>
                    <?php foreach ($datosModulo['estrategia_internal_linking']['reglas_enlazado'] as $regla): ?>
                    <li><?php echo htmlspecialchars($regla); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <!-- Calendario de implementación -->
        <section class="calendar-section">
            <h2><i class="fas fa-calendar-check"></i> <?php echo htmlspecialchars($datosModulo['calendario_implementacion']['titulo']); ?></h2>

            <div class="calendar-grid">
                <?php foreach (['q4_2025', 'q1_2026'] as $quarter):
                    $data = $datosModulo['calendario_implementacion'][$quarter];
                ?>
                <div class="quarter-card">
                    <div class="quarter-header">
                        <h3><?php echo htmlspecialchars($data['periodo']); ?></h3>
                        <span class="priority-badge priority-<?php echo strtolower($data['prioridad']); ?>">
                            <?php echo htmlspecialchars($data['prioridad']); ?>
                        </span>
                    </div>
                    <div class="quarter-stats">
                        <div class="stat">
                            <i class="fas fa-plus-circle"></i>
                            <span><?php echo $data['urls_nuevas']; ?> URLs nuevas</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-key"></i>
                            <span><?php echo $data['keywords_objetivo']; ?> keywords objetivo</span>
                        </div>
                    </div>
                    <div class="quarter-actions">
                        <strong>Acciones principales:</strong>
                        <ul>
                            <?php foreach ($data['acciones'] as $accion): ?>
                            <li><?php echo htmlspecialchars($accion); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Conclusiones y recomendaciones -->
        <section class="final-section">
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
.implementation-page {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
}

.implementation-page .page-header {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    padding: 1.5rem;
    margin: -2rem -2rem 2rem -2rem;
}

.implementation-page section {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
}

.orphan-summary {
    margin-bottom: 2rem;
}

.summary-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.summary-card i {
    font-size: 3rem;
    color: #dc3545;
}

.summary-content h3 {
    margin: 0 0 0.5rem 0;
}

.summary-value {
    margin: 0;
    font-size: 2.5rem;
    font-weight: bold;
    color: #dc3545;
}

.orphan-category {
    margin-bottom: 2rem;
}

.orphan-category h3 {
    margin: 0 0 1rem 0;
    color: #88B04B;
}

.orphan-keywords-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.orphan-keyword-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #dc3545;
}

.orphan-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.orphan-header h4 {
    margin: 0;
    color: #333;
}

.orphan-metrics {
    display: flex;
    gap: 0.75rem;
}

.metric-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.metric-badge.volume {
    background: #e3f2fd;
    color: #1976d2;
}

.metric-badge.difficulty {
    background: #fff3e0;
    color: #e65100;
}

.orphan-proposal {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.proposal-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.proposal-item code {
    padding: 0.25rem 0.75rem;
    background: #f8f9fa;
    border-radius: 0.25rem;
    color: #88B04B;
    font-family: 'Courier New', monospace;
}

.content-type-badge {
    padding: 0.25rem 0.75rem;
    background: #d4edda;
    color: #155724;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.linking-pillars {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.linking-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-top: 4px solid #88B04B;
}

.linking-card h3 {
    margin: 0 0 0.75rem 0;
    color: #88B04B;
}

.linking-info {
    margin-top: 1rem;
}

.info-item {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e0e0e0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item strong {
    display: block;
    margin-bottom: 0.5rem;
}

.info-item p {
    margin: 0;
    line-height: 1.6;
}

.linking-rules {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.linking-rules h3 {
    margin: 0 0 1rem 0;
}

.linking-rules ul {
    margin: 0;
    padding-left: 1.5rem;
}

.linking-rules li {
    margin: 0.75rem 0;
    line-height: 1.6;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.quarter-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.quarter-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e0e0e0;
}

.quarter-header h3 {
    margin: 0;
    color: #88B04B;
}

.quarter-stats {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.quarter-stats .stat {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.quarter-stats .stat i {
    color: #88B04B;
}

.quarter-actions strong {
    display: block;
    margin-bottom: 0.75rem;
}

.quarter-actions ul {
    margin: 0;
    padding-left: 1.5rem;
}

.quarter-actions li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

.final-section {
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
    border-left: 4px solid #88B04B;
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
    border-left-color: #88B04B;
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
    background: #88B04B;
    color: #333;
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
