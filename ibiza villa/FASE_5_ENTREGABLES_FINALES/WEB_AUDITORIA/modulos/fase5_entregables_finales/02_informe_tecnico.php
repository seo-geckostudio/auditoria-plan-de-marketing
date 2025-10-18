<!-- Página 1: Introducción y Resumen Técnico -->
<div class="audit-page technical-report-intro-page">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-cogs"></i> <?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
            <div class="header-meta">
                <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($datosModulo['cliente']); ?></span>
                <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['fecha']); ?></span>
                <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($datosModulo['periodo_analisis']); ?></span>
            </div>
            <div class="auditors">
                <strong>Equipo Auditor:</strong>
                <?php echo implode(' • ', $datosModulo['auditores']); ?>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Introducción -->
        <section class="introduction-section">
            <h2><i class="fas fa-info-circle"></i> Introducción</h2>
            <div class="intro-grid">
                <div class="intro-card">
                    <h3>Objetivo</h3>
                    <p><?php echo htmlspecialchars($datosModulo['introduccion']['objetivo']); ?></p>
                </div>
                <div class="intro-card">
                    <h3>Alcance</h3>
                    <p><?php echo htmlspecialchars($datosModulo['introduccion']['alcance']); ?></p>
                </div>
                <div class="intro-card full-width">
                    <h3>Metodología</h3>
                    <p><?php echo htmlspecialchars($datosModulo['introduccion']['metodologia']); ?></p>
                </div>
            </div>
        </section>

        <!-- Resumen Técnico -->
        <section class="technical-summary-section">
            <h2><i class="fas fa-chart-pie"></i> <?php echo htmlspecialchars($datosModulo['resumen_tecnico']['titulo']); ?></h2>

            <div class="overall-status">
                <div class="status-badge">
                    <span class="status-label">Estado General</span>
                    <span class="status-value"><?php echo htmlspecialchars($datosModulo['resumen_tecnico']['estado_general']); ?></span>
                </div>
                <div class="overall-score">
                    <div class="score-circle">
                        <span class="score-number"><?php echo $datosModulo['resumen_tecnico']['puntuacion_seo']['total']; ?></span>
                        <span class="score-total">/<?php echo $datosModulo['resumen_tecnico']['puntuacion_seo']['sobre']; ?></span>
                    </div>
                    <span class="score-label">Puntuación SEO General</span>
                </div>
            </div>

            <!-- Desglose por áreas -->
            <div class="areas-breakdown">
                <h3>Desglose por Áreas</h3>
                <div class="areas-grid">
                    <?php foreach ($datosModulo['resumen_tecnico']['puntuacion_seo']['desglose'] as $area): ?>
                    <div class="area-card">
                        <div class="area-header">
                            <h4><?php echo htmlspecialchars($area['area']); ?></h4>
                            <span class="area-estado estado-<?php echo strtolower($area['estado']); ?>">
                                <?php echo htmlspecialchars($area['estado']); ?>
                            </span>
                        </div>
                        <div class="area-score">
                            <div class="score-bar">
                                <div class="score-fill" style="width: <?php echo $area['puntuacion']; ?>%"></div>
                            </div>
                            <span class="score-text"><?php echo $area['puntuacion']; ?>/100</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Métricas Clave -->
            <div class="key-metrics-section">
                <h3>Métricas Clave del Sitio</h3>

                <div class="metrics-category">
                    <h4><i class="fas fa-users"></i> Tráfico y Engagement</h4>
                    <div class="metrics-row">
                        <?php foreach ($datosModulo['resumen_tecnico']['metricas_clave']['trafico'] as $metrica => $valor): ?>
                        <div class="metric-item">
                            <span class="metric-label"><?php echo ucwords(str_replace('_', ' ', $metrica)); ?></span>
                            <span class="metric-value"><?php echo htmlspecialchars($valor); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="metrics-category">
                    <h4><i class="fas fa-key"></i> Keywords y Posicionamiento</h4>
                    <div class="metrics-row">
                        <?php foreach ($datosModulo['resumen_tecnico']['metricas_clave']['keywords'] as $metrica => $valor): ?>
                        <div class="metric-item">
                            <span class="metric-label"><?php echo ucwords(str_replace('_', ' ', $metrica)); ?></span>
                            <span class="metric-value"><?php echo htmlspecialchars($valor); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="metrics-category">
                    <h4><i class="fas fa-cogs"></i> Aspectos Técnicos</h4>
                    <div class="metrics-row">
                        <?php foreach ($datosModulo['resumen_tecnico']['metricas_clave']['tecnicos'] as $metrica => $valor): ?>
                        <div class="metric-item">
                            <span class="metric-label"><?php echo ucwords(str_replace('_', ' ', $metrica)); ?></span>
                            <span class="metric-value"><?php echo htmlspecialchars($valor); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.technical-report-intro-page {
    background: #f8f9fa;
}

.page-header {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.header-content h1 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-meta {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.header-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.auditors {
    opacity: 0.85;
    font-size: 0.95rem;
}

.technical-report-intro-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.technical-report-intro-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #e0e0e0;
}

.intro-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.intro-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #3498db;
}

.intro-card.full-width {
    grid-column: 1 / -1;
}

.intro-card h3 {
    margin: 0 0 1rem 0;
    color: #3498db;
    font-size: 1.2rem;
}

.intro-card p {
    margin: 0;
    line-height: 1.8;
    color: #555;
}

.overall-status {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
}

.status-badge {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.status-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

.status-value {
    font-size: 1.8rem;
    font-weight: bold;
}

.overall-score {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.score-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid white;
}

.score-number {
    font-size: 2.5rem;
    font-weight: bold;
}

.score-total {
    font-size: 1.2rem;
    opacity: 0.8;
}

.score-label {
    font-size: 0.95rem;
    opacity: 0.9;
}

.areas-breakdown {
    margin-bottom: 2rem;
}

.areas-breakdown h3 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
}

.areas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.area-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.area-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.area-header h4 {
    margin: 0;
    color: #333;
}

.area-estado {
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.area-estado.estado-excelente {
    background: #28a745;
    color: white;
}

.area-estado.estado-bueno {
    background: #17a2b8;
    color: white;
}

.area-estado.estado-mejorable {
    background: #ffc107;
    color: #333;
}

.area-estado.estado-bajo {
    background: #dc3545;
    color: white;
}

.area-score {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.score-bar {
    flex: 1;
    height: 20px;
    background: #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
}

.score-fill {
    height: 100%;
    background: linear-gradient(90deg, #28a745 0%, #17a2b8 50%, #ffc107 75%, #dc3545 100%);
    transition: width 0.3s;
}

.score-text {
    font-weight: bold;
    color: #333;
}

.key-metrics-section h3 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
}

.metrics-category {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
}

.metrics-category h4 {
    margin: 0 0 1rem 0;
    color: #3498db;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.metrics-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}

.metric-item {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.7;
    text-transform: capitalize;
}

.metric-value {
    font-size: 1.3rem;
    font-weight: bold;
    color: #2c3e50;
}
</style>

<!-- Página 2: SEO Técnico y Contenido -->
<div class="audit-page technical-seo-page">
    <div class="page-header">
        <h1><i class="fas fa-server"></i> Análisis SEO Técnico y Contenido</h1>
    </div>

    <div class="page-body">
        <!-- SEO Técnico -->
        <section class="seo-tecnico-section">
            <h2><i class="fas fa-code"></i> <?php echo htmlspecialchars($datosModulo['analisis_seo_tecnico']['titulo']); ?></h2>

            <!-- Crawlability -->
            <div class="technical-area">
                <div class="area-title">
                    <h3>Crawlability y Rastreabilidad</h3>
                    <div class="area-score-badge score-<?php echo $datosModulo['analisis_seo_tecnico']['crawlability']['puntuacion']; ?>">
                        <?php echo $datosModulo['analisis_seo_tecnico']['crawlability']['puntuacion']; ?>/100
                    </div>
                </div>

                <div class="findings-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Aspecto</th>
                                <th>Estado</th>
                                <th>Detalles</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datosModulo['analisis_seo_tecnico']['crawlability']['hallazgos'] as $hallazgo): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($hallazgo['aspecto']); ?></strong></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($hallazgo['estado']); ?>">
                                        <?php echo htmlspecialchars($hallazgo['estado']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($hallazgo['detalles']); ?></td>
                                <td class="action-cell"><?php echo htmlspecialchars($hallazgo['accion']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Indexación -->
            <div class="technical-area">
                <div class="area-title">
                    <h3>Indexación</h3>
                    <div class="area-score-badge score-<?php echo $datosModulo['analisis_seo_tecnico']['indexacion']['puntuacion']; ?>">
                        <?php echo $datosModulo['analisis_seo_tecnico']['indexacion']['puntuacion']; ?>/100
                    </div>
                </div>

                <div class="indexation-stats">
                    <?php $datos = $datosModulo['analisis_seo_tecnico']['indexacion']['datos']; ?>
                    <div class="stat-card">
                        <span class="stat-label">Páginas en Sitio</span>
                        <span class="stat-value"><?php echo $datos['paginas_en_sitio']; ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">Páginas Indexadas</span>
                        <span class="stat-value highlight"><?php echo $datos['paginas_indexadas']; ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">Tasa Indexación</span>
                        <span class="stat-value success"><?php echo $datos['tasa_indexacion']; ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">No Indexadas</span>
                        <span class="stat-value warning"><?php echo $datos['paginas_no_indexadas']; ?></span>
                    </div>
                </div>

                <?php if (!empty($datosModulo['analisis_seo_tecnico']['indexacion']['problemas'])): ?>
                <div class="problems-list">
                    <?php foreach ($datosModulo['analisis_seo_tecnico']['indexacion']['problemas'] as $problema): ?>
                    <div class="problem-card">
                        <div class="problem-header">
                            <h4><?php echo htmlspecialchars($problema['problema']); ?></h4>
                            <span class="problem-type"><?php echo htmlspecialchars($problema['tipo']); ?></span>
                        </div>
                        <div class="problem-causes">
                            <strong>Causas:</strong>
                            <ul>
                                <?php foreach ($problema['causas'] as $causa): ?>
                                <li><?php echo htmlspecialchars($causa); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="problem-solution">
                            <strong><i class="fas fa-check-circle"></i> Solución:</strong>
                            <?php echo htmlspecialchars($problema['solucion']); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Errores Técnicos -->
            <div class="technical-area">
                <div class="area-title">
                    <h3>Errores Técnicos Detectados</h3>
                </div>

                <?php $errores = $datosModulo['analisis_seo_tecnico']['errores_tecnicos']; ?>

                <?php if (empty($errores['criticos'])): ?>
                <div class="no-critical-errors">
                    <i class="fas fa-check-circle"></i>
                    <strong>Sin Errores Críticos</strong>
                    <span>No se detectaron errores críticos que requieran atención inmediata</span>
                </div>
                <?php endif; ?>

                <?php if (!empty($errores['importantes'])): ?>
                <div class="errors-section importantes">
                    <h4><i class="fas fa-exclamation-triangle"></i> Errores Importantes</h4>
                    <?php foreach ($errores['importantes'] as $error): ?>
                    <div class="error-item">
                        <div class="error-info">
                            <strong><?php echo htmlspecialchars($error['error']); ?></strong>
                            <span class="error-impact">Impacto: <?php echo htmlspecialchars($error['impacto']); ?></span>
                        </div>
                        <div class="error-count"><?php echo $error['afectadas']; ?> páginas</div>
                        <div class="error-solution"><?php echo htmlspecialchars($error['solucion']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($errores['menores'])): ?>
                <div class="errors-section menores">
                    <h4><i class="fas fa-info-circle"></i> Errores Menores</h4>
                    <?php foreach ($errores['menores'] as $error): ?>
                    <div class="error-item minor">
                        <div class="error-info">
                            <strong><?php echo htmlspecialchars($error['error']); ?></strong>
                            <span class="error-impact">Impacto: <?php echo htmlspecialchars($error['impacto']); ?></span>
                        </div>
                        <div class="error-count"><?php echo $error['afectadas']; ?> afectadas</div>
                        <div class="error-solution"><?php echo htmlspecialchars($error['solucion']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Análisis de Contenido -->
        <section class="content-analysis-section">
            <h2><i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($datosModulo['analisis_contenido']['titulo']); ?></h2>

            <!-- Calidad del Contenido -->
            <div class="content-quality">
                <div class="area-title">
                    <h3>Calidad del Contenido</h3>
                    <div class="area-score-badge score-<?php echo $datosModulo['analisis_contenido']['calidad_contenido']['puntuacion']; ?>">
                        <?php echo $datosModulo['analisis_contenido']['calidad_contenido']['puntuacion']; ?>/100
                    </div>
                </div>

                <div class="quality-aspects">
                    <?php foreach ($datosModulo['analisis_contenido']['calidad_contenido']['aspectos'] as $aspecto): ?>
                    <div class="quality-card">
                        <h4><?php echo htmlspecialchars($aspecto['aspecto']); ?></h4>
                        <div class="quality-score">
                            <div class="score-bar">
                                <div class="score-fill" style="width: <?php echo $aspecto['puntuacion']; ?>%"></div>
                            </div>
                            <span class="score-number"><?php echo $aspecto['puntuacion']; ?>/100</span>
                        </div>
                        <p class="quality-comment"><?php echo htmlspecialchars($aspecto['comentario']); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Optimización On-Page -->
            <div class="onpage-optimization">
                <div class="area-title">
                    <h3>Optimización On-Page</h3>
                    <div class="area-score-badge score-<?php echo $datosModulo['analisis_contenido']['optimizacion_onpage']['puntuacion']; ?>">
                        <?php echo $datosModulo['analisis_contenido']['optimizacion_onpage']['puntuacion']; ?>/100
                    </div>
                </div>

                <?php foreach ($datosModulo['analisis_contenido']['optimizacion_onpage']['elementos'] as $elemento): ?>
                <div class="onpage-element">
                    <div class="element-header">
                        <h4><?php echo htmlspecialchars($elemento['elemento']); ?></h4>
                        <div class="element-meta">
                            <span class="element-estado estado-<?php echo strtolower($elemento['estado']); ?>">
                                <?php echo htmlspecialchars($elemento['estado']); ?>
                            </span>
                            <span class="element-score"><?php echo $elemento['puntuacion']; ?>/100</span>
                        </div>
                    </div>

                    <div class="element-findings">
                        <ul>
                            <?php foreach ($elemento['hallazgos'] as $hallazgo): ?>
                            <li><?php echo htmlspecialchars($hallazgo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="element-recommendation">
                        <i class="fas fa-lightbulb"></i>
                        <strong>Recomendación:</strong>
                        <?php echo htmlspecialchars($elemento['recomendacion']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<style>
.technical-seo-page {
    background: #f8f9fa;
}

.technical-seo-page .page-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.technical-seo-page .page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.technical-seo-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.technical-seo-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #e0e0e0;
}

.technical-area {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
}

.area-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.area-title h3 {
    margin: 0;
    color: #2c3e50;
}

.area-score-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: bold;
    color: white;
    font-size: 1.1rem;
}

.area-score-badge.score-88,
.area-score-badge.score-92,
.area-score-badge.score-85 {
    background: #28a745;
}

.area-score-badge.score-72,
.area-score-badge.score-75,
.area-score-badge.score-68 {
    background: #17a2b8;
}

.findings-table {
    overflow-x: auto;
}

.findings-table table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 0.5rem;
    overflow: hidden;
}

.findings-table thead {
    background: #2c3e50;
    color: white;
}

.findings-table th,
.findings-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.findings-table tbody tr:hover {
    background: #f8f9fa;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.85rem;
}

.status-badge.status-correcto,
.status-badge.status-bueno {
    background: #28a745;
    color: white;
}

.status-badge.status-mejorable {
    background: #ffc107;
    color: #333;
}

.action-cell {
    color: #555;
    font-size: 0.9rem;
}

.indexation-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    text-align: center;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    opacity: 0.7;
    margin-bottom: 0.5rem;
}

.stat-value {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    color: #2c3e50;
}

.stat-value.highlight {
    color: #3498db;
}

.stat-value.success {
    color: #28a745;
}

.stat-value.warning {
    color: #ffc107;
}

.problems-list {
    margin-top: 1.5rem;
}

.problem-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #ffc107;
    margin-bottom: 1rem;
}

.problem-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.problem-header h4 {
    margin: 0;
}

.problem-type {
    padding: 0.25rem 0.75rem;
    background: #fff3cd;
    color: #856404;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.problem-causes,
.problem-solution {
    margin-top: 1rem;
}

.problem-causes ul {
    margin: 0.5rem 0 0 0;
    padding-left: 1.5rem;
}

.problem-solution {
    background: #d4edda;
    padding: 1rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    border-left: 4px solid #28a745;
}

.problem-solution i {
    color: #28a745;
    font-size: 1.2rem;
    margin-top: 0.25rem;
}

.no-critical-errors {
    background: #d4edda;
    padding: 2rem;
    border-radius: 0.75rem;
    text-align: center;
    border: 3px solid #28a745;
    margin-bottom: 1.5rem;
}

.no-critical-errors i {
    font-size: 3rem;
    color: #28a745;
    margin-bottom: 1rem;
}

.no-critical-errors strong {
    display: block;
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    color: #155724;
}

.errors-section {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
}

.errors-section h4 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.errors-section.importantes {
    border-left: 4px solid #ffc107;
}

.errors-section.menores {
    border-left: 4px solid #17a2b8;
}

.error-item {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 1rem;
}

.error-item.minor {
    opacity: 0.85;
}

.error-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.error-impact {
    font-size: 0.85rem;
    opacity: 0.7;
}

.error-count {
    background: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    text-align: center;
    align-self: center;
}

.error-solution {
    grid-column: 1 / -1;
    padding-top: 0.75rem;
    border-top: 1px solid #e0e0e0;
    font-size: 0.9rem;
    color: #555;
}

.content-quality,
.onpage-optimization {
    margin-bottom: 2rem;
}

.quality-aspects {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.quality-card {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.quality-card h4 {
    margin: 0 0 1rem 0;
    color: #3498db;
}

.quality-score {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.quality-comment {
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.6;
    color: #555;
}

.onpage-element {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    border-left: 4px solid #3498db;
}

.element-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.element-header h4 {
    margin: 0;
}

.element-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.element-estado {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.85rem;
}

.element-estado.estado-bueno,
.element-estado.estado-excelente {
    background: #28a745;
    color: white;
}

.element-estado.estado-mejorable {
    background: #ffc107;
    color: #333;
}

.element-estado.estado-adecuado {
    background: #17a2b8;
    color: white;
}

.element-score {
    background: #2c3e50;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
}

.element-findings ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.element-findings li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.element-findings li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #3498db;
    font-weight: bold;
    font-size: 1.2rem;
}

.element-recommendation {
    background: #fff3cd;
    padding: 1rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.element-recommendation i {
    color: #ffc107;
    font-size: 1.2rem;
    margin-top: 0.25rem;
}
</style>
