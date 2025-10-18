<!-- Página 1: Introducción y Situación Actual -->
<div class="audit-page executive-summary-page">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
            <div class="header-meta">
                <span class="meta-item"><i class="fas fa-user"></i> <?php echo htmlspecialchars($datosModulo['cliente']); ?></span>
                <span class="meta-item"><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['fecha']); ?></span>
                <span class="meta-item"><i class="fas fa-code-branch"></i> v<?php echo htmlspecialchars($datosModulo['version']); ?></span>
                <?php if ($datosModulo['confidencial']): ?>
                <span class="confidential-badge"><i class="fas fa-lock"></i> CONFIDENCIAL</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Introducción -->
        <section class="introduction-section">
            <h2><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($datosModulo['introduccion']['titulo']); ?></h2>
            <?php foreach ($datosModulo['introduccion']['parrafos'] as $parrafo): ?>
            <p><?php echo htmlspecialchars($parrafo); ?></p>
            <?php endforeach; ?>
        </section>

        <!-- Situación Actual -->
        <section class="current-situation-section">
            <h2><i class="fas fa-chart-bar"></i> <?php echo htmlspecialchars($datosModulo['situacion_actual']['titulo']); ?></h2>

            <div class="situation-summary">
                <i class="fas fa-quote-left"></i>
                <p><?php echo htmlspecialchars($datosModulo['situacion_actual']['resumen']); ?></p>
            </div>

            <!-- Métricas por categoría -->
            <?php foreach ($datosModulo['situacion_actual']['metricas_clave'] as $categoria): ?>
            <div class="metrics-category">
                <h3><?php echo htmlspecialchars($categoria['categoria']); ?></h3>
                <div class="metrics-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Métrica</th>
                                <th>Valor Actual</th>
                                <th>Evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoria['datos'] as $dato): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dato['metrica']); ?></td>
                                <td class="metric-value"><?php echo htmlspecialchars($dato['valor']); ?></td>
                                <td>
                                    <span class="evaluation-badge eval-<?php echo strtolower($dato['evaluacion']); ?>">
                                        <?php echo htmlspecialchars($dato['evaluacion']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Fortalezas y Debilidades -->
            <div class="strengths-weaknesses">
                <div class="strengths-column">
                    <h3><i class="fas fa-check-circle"></i> Fortalezas Principales</h3>
                    <ul>
                        <?php foreach ($datosModulo['situacion_actual']['fortalezas_principales'] as $fortaleza): ?>
                        <li><?php echo htmlspecialchars($fortaleza); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="weaknesses-column">
                    <h3><i class="fas fa-exclamation-triangle"></i> Debilidades Principales</h3>
                    <ul>
                        <?php foreach ($datosModulo['situacion_actual']['debilidades_principales'] as $debilidad): ?>
                        <li><?php echo htmlspecialchars($debilidad); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.executive-summary-page {
    background: #f8f9fa;
}

.page-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.header-content h1 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 2rem;
}

.header-meta {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.9;
}

.confidential-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #dc3545;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
}

.executive-summary-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.executive-summary-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #e0e0e0;
}

.introduction-section p {
    margin: 0 0 1rem 0;
    font-size: 1.05rem;
    line-height: 1.8;
    color: #555;
    text-align: justify;
}

.situation-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    position: relative;
}

.situation-summary i {
    font-size: 2rem;
    opacity: 0.3;
    margin-bottom: 1rem;
}

.situation-summary p {
    margin: 0;
    font-size: 1.2rem;
    line-height: 1.8;
}

.metrics-category {
    margin-bottom: 2rem;
}

.metrics-category h3 {
    margin: 0 0 1rem 0;
    color: #88B04B;
    font-size: 1.3rem;
}

.metrics-table {
    overflow-x: auto;
}

.metrics-table table {
    width: 100%;
    border-collapse: collapse;
}

.metrics-table thead {
    background: #2c3e50;
    color: white;
}

.metrics-table th,
.metrics-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.metrics-table tbody tr:hover {
    background: #f8f9fa;
}

.metric-value {
    font-weight: bold;
    font-size: 1.1rem;
}

.evaluation-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.9rem;
}

.evaluation-badge.eval-excelente {
    background: #28a745;
    color: white;
}

.evaluation-badge.eval-bueno {
    background: #17a2b8;
    color: white;
}

.evaluation-badge.eval-moderado {
    background: #ffc107;
    color: #333;
}

.evaluation-badge.eval-bajo {
    background: #dc3545;
    color: white;
}

.evaluation-badge.eval-crítico {
    background: #6c757d;
    color: white;
}

.strengths-weaknesses {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.strengths-column,
.weaknesses-column {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.strengths-column {
    border-left: 4px solid #28a745;
}

.weaknesses-column {
    border-left: 4px solid #dc3545;
}

.strengths-column h3,
.weaknesses-column h3 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.strengths-column h3 {
    color: #28a745;
}

.weaknesses-column h3 {
    color: #dc3545;
}

.strengths-weaknesses ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.strengths-weaknesses li {
    padding: 0.75rem 0;
    padding-left: 2rem;
    position: relative;
    line-height: 1.6;
    border-bottom: 1px solid #e0e0e0;
}

.strengths-weaknesses li:last-child {
    border-bottom: none;
}

.strengths-column li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
    font-size: 1.3rem;
}

.weaknesses-column li::before {
    content: '⚠';
    position: absolute;
    left: 0;
    font-size: 1.2rem;
}
</style>

<!-- Página 2: Hallazgos Críticos y Recomendaciones -->
<div class="audit-page critical-findings-page">
    <div class="page-header">
        <h1><i class="fas fa-exclamation-circle"></i> Hallazgos Críticos y Recomendaciones</h1>
    </div>

    <div class="page-body">
        <!-- Hallazgos críticos -->
        <section class="critical-findings-section">
            <h2><i class="fas fa-list-ol"></i> <?php echo htmlspecialchars($datosModulo['hallazgos_criticos']['titulo']); ?></h2>

            <?php foreach ($datosModulo['hallazgos_criticos']['hallazgos'] as $hallazgo): ?>
            <div class="finding-card priority-<?php echo strtolower(str_replace(' ', '-', $hallazgo['prioridad'])); ?>">
                <div class="finding-header">
                    <span class="finding-number">#<?php echo $hallazgo['id']; ?></span>
                    <h3><?php echo htmlspecialchars($hallazgo['titulo']); ?></h3>
                    <span class="severity-badge"><?php echo htmlspecialchars($hallazgo['severidad']); ?></span>
                </div>

                <div class="finding-content">
                    <p class="finding-description"><?php echo htmlspecialchars($hallazgo['descripcion']); ?></p>

                    <div class="finding-details">
                        <div class="detail-item impact">
                            <strong><i class="fas fa-chart-line"></i> Impacto en Negocio:</strong>
                            <p><?php echo htmlspecialchars($hallazgo['impacto_negocio']); ?></p>
                        </div>

                        <div class="detail-item action">
                            <strong><i class="fas fa-tasks"></i> Acción Requerida:</strong>
                            <p><?php echo htmlspecialchars($hallazgo['accion_requerida']); ?></p>
                        </div>
                    </div>

                    <div class="finding-priority">
                        <span class="priority-label">Prioridad:</span>
                        <span class="priority-badge priority-<?php echo strtolower($hallazgo['prioridad']); ?>">
                            <?php echo htmlspecialchars($hallazgo['prioridad']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Recomendaciones estratégicas -->
        <section class="strategic-recommendations-section">
            <h2><i class="fas fa-lightbulb"></i> <?php echo htmlspecialchars($datosModulo['recomendaciones_estrategicas']['titulo']); ?></h2>

            <div class="recommendations-summary">
                <p><?php echo htmlspecialchars($datosModulo['recomendaciones_estrategicas']['resumen']); ?></p>
            </div>

            <?php foreach ($datosModulo['recomendaciones_estrategicas']['recomendaciones'] as $recomendacion): ?>
            <div class="recommendation-card">
                <div class="recommendation-header">
                    <div class="rec-title-section">
                        <span class="priority-number">Prioridad <?php echo $recomendacion['prioridad']; ?></span>
                        <h3><?php echo htmlspecialchars($recomendacion['titulo']); ?></h3>
                    </div>
                    <span class="rec-type-badge"><?php echo htmlspecialchars($recomendacion['tipo']); ?></span>
                </div>

                <div class="recommendation-objective">
                    <strong>Objetivo:</strong> <?php echo htmlspecialchars($recomendacion['objetivo']); ?>
                </div>

                <div class="recommendation-actions">
                    <strong>Acciones Clave:</strong>
                    <ul>
                        <?php foreach ($recomendacion['acciones'] as $accion): ?>
                        <li><?php echo htmlspecialchars($accion); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="recommendation-metrics">
                    <div class="rec-metric">
                        <i class="fas fa-euro-sign"></i>
                        <div>
                            <span class="metric-label">Inversión</span>
                            <span class="metric-value"><?php echo htmlspecialchars($recomendacion['inversion']); ?></span>
                        </div>
                    </div>
                    <div class="rec-metric">
                        <i class="fas fa-percentage"></i>
                        <div>
                            <span class="metric-label">ROI Esperado</span>
                            <span class="metric-value roi"><?php echo htmlspecialchars($recomendacion['roi_esperado']); ?></span>
                        </div>
                    </div>
                    <div class="rec-metric">
                        <i class="fas fa-clock"></i>
                        <div>
                            <span class="metric-label">Tiempo Resultados</span>
                            <span class="metric-value"><?php echo htmlspecialchars($recomendacion['tiempo_resultados']); ?></span>
                        </div>
                    </div>
                    <div class="rec-metric">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <span class="metric-label">Riesgo</span>
                            <span class="metric-value risk-<?php echo strtolower(str_replace('-', '', $recomendacion['riesgo'])); ?>">
                                <?php echo htmlspecialchars($recomendacion['riesgo']); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="recommendation-results">
                    <i class="fas fa-bullseye"></i>
                    <strong>Resultados Esperados:</strong>
                    <?php echo htmlspecialchars($recomendacion['resultados']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>

<style>
.critical-findings-page {
    background: #f8f9fa;
}

.critical-findings-page .page-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.critical-findings-page .page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.critical-findings-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.critical-findings-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #e0e0e0;
}

.finding-card {
    background: #fff;
    border: 3px solid;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    overflow: hidden;
}

.finding-card.priority-crítica {
    border-color: #dc3545;
}

.finding-card.priority-alta {
    border-color: #ffc107;
}

.finding-card.priority-media-alta {
    border-color: #17a2b8;
}

.finding-header {
    background: #2c3e50;
    color: white;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.finding-number {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.finding-header h3 {
    margin: 0;
    flex: 1;
    font-size: 1.3rem;
}

.severity-badge {
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.9rem;
    white-space: nowrap;
}

.finding-content {
    padding: 2rem;
}

.finding-description {
    margin: 0 0 1.5rem 0;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
}

.finding-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    padding: 1rem;
    border-radius: 0.5rem;
}

.detail-item.impact {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
}

.detail-item.action {
    background: #d4edda;
    border-left: 4px solid #28a745;
}

.detail-item strong {
    display: block;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.detail-item p {
    margin: 0;
    line-height: 1.6;
}

.finding-priority {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 2px solid #e0e0e0;
}

.priority-label {
    font-weight: bold;
}

.priority-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: bold;
    text-transform: uppercase;
}

.priority-badge.priority-crítica {
    background: #dc3545;
    color: white;
}

.priority-badge.priority-alta {
    background: #ffc107;
    color: #333;
}

.priority-badge.priority-media-alta {
    background: #17a2b8;
    color: white;
}

.recommendations-summary {
    background: #e3f2fd;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #2196f3;
    margin-bottom: 2rem;
}

.recommendations-summary p {
    margin: 0;
    font-size: 1.1rem;
    line-height: 1.8;
}

.recommendation-card {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 2rem;
    margin-bottom: 2rem;
    border-left: 5px solid #88B04B;
}

.recommendation-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.rec-title-section {
    flex: 1;
}

.priority-number {
    display: inline-block;
    background: #88B04B;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.recommendation-header h3 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.4rem;
}

.rec-type-badge {
    padding: 0.5rem 1rem;
    background: #2c3e50;
    color: white;
    border-radius: 0.5rem;
    font-weight: bold;
    font-size: 0.9rem;
}

.recommendation-objective {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    border-left: 4px solid #88B04B;
}

.recommendation-actions {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.recommendation-actions strong {
    display: block;
    margin-bottom: 0.75rem;
}

.recommendation-actions ul {
    margin: 0;
    padding-left: 1.5rem;
}

.recommendation-actions li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

.recommendation-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.rec-metric {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
}

.rec-metric i {
    font-size: 1.5rem;
    color: #88B04B;
}

.rec-metric div {
    display: flex;
    flex-direction: column;
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.7;
}

.metric-value {
    font-weight: bold;
    font-size: 1.1rem;
}

.metric-value.roi {
    color: #28a745;
    font-size: 1.3rem;
}

.metric-value.risk-bajo {
    color: #28a745;
}

.metric-value.risk-bajomedio,
.metric-value.risk-medio {
    color: #ffc107;
}

.metric-value.risk-medioalto,
.metric-value.risk-alto {
    color: #dc3545;
}

.recommendation-results {
    background: #d4edda;
    padding: 1rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    border-left: 4px solid #28a745;
}

.recommendation-results i {
    color: #28a745;
    font-size: 1.3rem;
    margin-top: 0.25rem;
}
</style>

<!-- Página 3: ROI, Decisión Ejecutiva y Próximos Pasos -->
<div class="audit-page decision-page">
    <div class="page-header">
        <h1><i class="fas fa-handshake"></i> Análisis ROI y Decisión Ejecutiva</h1>
    </div>

    <div class="page-body">
        <!-- Análisis ROI -->
        <section class="roi-analysis-section">
            <h2><i class="fas fa-chart-line"></i> <?php echo htmlspecialchars($datosModulo['analisis_roi']['titulo']); ?></h2>

            <div class="roi-summary">
                <p><?php echo htmlspecialchars($datosModulo['analisis_roi']['resumen']); ?></p>
            </div>

            <!-- Comparativa Actual vs Proyectada -->
            <div class="comparison-grid">
                <div class="comparison-card current">
                    <h3><i class="fas fa-calendar-day"></i> Situación Actual</h3>
                    <?php $actual = $datosModulo['analisis_roi']['comparativa']['situacion_actual']; ?>
                    <div class="comparison-metrics">
                        <div class="comp-metric">
                            <span class="label">Tráfico Mensual</span>
                            <span class="value"><?php echo number_format($actual['trafico_mensual']); ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Valor Anual</span>
                            <span class="value">€<?php echo number_format($actual['valor_anual']); ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Keywords Top 10</span>
                            <span class="value"><?php echo $actual['keywords_top10']; ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Conversiones/Mes</span>
                            <span class="value"><?php echo $actual['conversiones_mensuales']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="comparison-arrow">
                    <i class="fas fa-arrow-right"></i>
                    <?php $incrementos = $datosModulo['analisis_roi']['comparativa']['incrementos']; ?>
                    <div class="increments">
                        <span><?php echo $incrementos['trafico']; ?></span>
                        <span><?php echo $incrementos['valor']; ?></span>
                        <span><?php echo $incrementos['keywords']; ?></span>
                        <span><?php echo $incrementos['conversiones']; ?></span>
                    </div>
                </div>

                <div class="comparison-card projected">
                    <h3><i class="fas fa-rocket"></i> Situación Proyectada (12 meses)</h3>
                    <?php $proyectada = $datosModulo['analisis_roi']['comparativa']['situacion_proyectada']; ?>
                    <div class="comparison-metrics">
                        <div class="comp-metric">
                            <span class="label">Tráfico Mensual</span>
                            <span class="value highlight"><?php echo number_format($proyectada['trafico_mensual']); ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Valor Anual</span>
                            <span class="value highlight">€<?php echo number_format($proyectada['valor_anual']); ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Keywords Top 10</span>
                            <span class="value highlight"><?php echo $proyectada['keywords_top10']; ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Conversiones/Mes</span>
                            <span class="value highlight"><?php echo $proyectada['conversiones_mensuales']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficios adicionales -->
            <div class="additional-benefits">
                <h3>Beneficios Adicionales</h3>
                <div class="benefits-grid">
                    <?php foreach ($datosModulo['analisis_roi']['beneficios_adicionales'] as $beneficio): ?>
                    <div class="benefit-item">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo htmlspecialchars($beneficio); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Decisión Ejecutiva -->
        <section class="executive-decision-section">
            <h2><i class="fas fa-gavel"></i> <?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['titulo']); ?></h2>

            <div class="decision-question">
                <i class="fas fa-question-circle"></i>
                <h3><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['pregunta']); ?></h3>
            </div>

            <div class="options-grid">
                <?php foreach ($datosModulo['decision_ejecutiva']['opciones'] as $index => $opcion): ?>
                <div class="option-card <?php echo $index === 0 ? 'recommended' : ''; ?>">
                    <?php if ($index === 0): ?>
                    <div class="recommended-badge"><i class="fas fa-star"></i> RECOMENDADO</div>
                    <?php endif; ?>

                    <h3><?php echo htmlspecialchars($opcion['opcion']); ?></h3>
                    <p class="option-description"><?php echo htmlspecialchars($opcion['descripcion']); ?></p>

                    <div class="option-investment">
                        <strong>Inversión:</strong> <?php echo htmlspecialchars($opcion['inversion']); ?>
                    </div>
                    <div class="option-roi">
                        <strong>ROI Esperado:</strong> <span class="roi-value"><?php echo htmlspecialchars($opcion['roi_esperado']); ?></span>
                    </div>

                    <div class="pros-cons">
                        <div class="pros">
                            <strong><i class="fas fa-thumbs-up"></i> Pros:</strong>
                            <ul>
                                <?php foreach ($opcion['pros'] as $pro): ?>
                                <li><?php echo htmlspecialchars($pro); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="cons">
                            <strong><i class="fas fa-thumbs-down"></i> Contras:</strong>
                            <ul>
                                <?php foreach ($opcion['cons'] as $con): ?>
                                <li><?php echo htmlspecialchars($con); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="agency-recommendation">
                <h3><i class="fas fa-award"></i> Recomendación de la Agencia</h3>
                <p class="recommendation-choice"><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['recomendacion_agencia']); ?></p>
                <p class="justification"><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['justificacion']); ?></p>
            </div>
        </section>

        <!-- Próximos Pasos -->
        <section class="next-steps-section">
            <h2><i class="fas fa-forward"></i> <?php echo htmlspecialchars($datosModulo['proximos_pasos']['titulo']); ?></h2>

            <div class="next-steps-columns">
                <div class="approved-steps">
                    <h3><i class="fas fa-check-circle"></i> Si el Plan es Aprobado</h3>
                    <?php foreach ($datosModulo['proximos_pasos']['si_aprobado'] as $paso): ?>
                    <div class="step-item">
                        <div class="step-timeline"><?php echo htmlspecialchars($paso['plazo']); ?></div>
                        <div class="step-content">
                            <strong><?php echo htmlspecialchars($paso['accion']); ?></strong>
                            <span class="step-responsible"><?php echo htmlspecialchars($paso['responsable']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="postponed-risks">
                    <h3><i class="fas fa-exclamation-triangle"></i> Si se Pospone la Decisión</h3>
                    <ul class="risks-list">
                        <?php foreach ($datosModulo['proximos_pasos']['si_pospuesto'] as $riesgo): ?>
                        <li><?php echo htmlspecialchars($riesgo); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Contacto -->
        <section class="contact-section">
            <h2><i class="fas fa-phone"></i> <?php echo htmlspecialchars($datosModulo['contacto']['titulo']); ?></h2>
            <p class="contact-message"><?php echo htmlspecialchars($datosModulo['contacto']['mensaje']); ?></p>

            <div class="contact-details">
                <div class="contact-item">
                    <i class="fas fa-user-tie"></i>
                    <div>
                        <strong><?php echo htmlspecialchars($datosModulo['contacto']['persona']); ?></strong>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <a href="mailto:<?php echo htmlspecialchars($datosModulo['contacto']['email']); ?>">
                            <?php echo htmlspecialchars($datosModulo['contacto']['email']); ?>
                        </a>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <span><?php echo htmlspecialchars($datosModulo['contacto']['telefono']); ?></span>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span><?php echo htmlspecialchars($datosModulo['contacto']['disponibilidad']); ?></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.decision-page {
    background: #f8f9fa;
}

.decision-page .page-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
}

.decision-page .page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.decision-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.decision-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #e0e0e0;
}

.roi-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    font-size: 1.15rem;
    line-height: 1.8;
}

.roi-summary p {
    margin: 0;
}

.comparison-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
    align-items: center;
}

.comparison-card {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 0.75rem;
}

.comparison-card.current {
    border: 3px solid #6c757d;
}

.comparison-card.projected {
    border: 3px solid #28a745;
}

.comparison-card h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.2rem;
}

.comparison-metrics {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.comp-metric {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
}

.comp-metric .label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.comp-metric .value {
    font-weight: bold;
    font-size: 1.2rem;
}

.comp-metric .value.highlight {
    color: #28a745;
    font-size: 1.4rem;
}

.comparison-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.comparison-arrow i {
    font-size: 3rem;
    color: #28a745;
}

.increments {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    text-align: center;
}

.increments span {
    background: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
}

.additional-benefits {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.additional-benefits h3 {
    margin: 0 0 1rem 0;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
}

.benefit-item i {
    color: #28a745;
    font-size: 1.2rem;
    margin-top: 0.25rem;
}

.decision-question {
    background: #fff3cd;
    padding: 2rem;
    border-radius: 0.75rem;
    text-align: center;
    margin-bottom: 2rem;
    border: 3px solid #ffc107;
}

.decision-question i {
    font-size: 3rem;
    color: #ffc107;
    margin-bottom: 1rem;
}

.decision-question h3 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.option-card {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 0.75rem;
    border: 3px solid #e0e0e0;
    position: relative;
}

.option-card.recommended {
    border-color: #28a745;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.recommended-badge {
    position: absolute;
    top: -15px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.option-card h3 {
    margin: 0 0 1rem 0;
    color: #2c3e50;
    font-size: 1.2rem;
}

.option-description {
    margin: 0 0 1.5rem 0;
    line-height: 1.6;
    color: #555;
}

.option-investment,
.option-roi {
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
}

.option-roi .roi-value {
    color: #28a745;
    font-weight: bold;
    font-size: 1.2rem;
}

.pros-cons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 1rem;
}

.pros,
.cons {
    padding: 1rem;
    border-radius: 0.5rem;
}

.pros {
    background: #d4edda;
    border-left: 4px solid #28a745;
}

.cons {
    background: #f8d7da;
    border-left: 4px solid #dc3545;
}

.pros strong,
.cons strong {
    display: block;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pros ul,
.cons ul {
    margin: 0;
    padding-left: 1.5rem;
}

.pros li,
.cons li {
    margin: 0.25rem 0;
    font-size: 0.9rem;
}

.agency-recommendation {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 2rem;
    border-radius: 0.75rem;
    text-align: center;
}

.agency-recommendation h3 {
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    font-size: 1.5rem;
}

.recommendation-choice {
    font-size: 1.8rem;
    font-weight: bold;
    margin: 0 0 1rem 0;
}

.justification {
    margin: 0;
    font-size: 1.1rem;
    line-height: 1.8;
    opacity: 0.95;
}

.next-steps-columns {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.approved-steps,
.postponed-risks {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.approved-steps {
    border-left: 4px solid #28a745;
}

.postponed-risks {
    border-left: 4px solid #dc3545;
}

.approved-steps h3,
.postponed-risks h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.step-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 0.5rem;
}

.step-timeline {
    background: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    white-space: nowrap;
    align-self: flex-start;
}

.step-content {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.step-responsible {
    font-size: 0.9rem;
    opacity: 0.7;
}

.risks-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.risks-list li {
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    padding-left: 2.5rem;
    position: relative;
}

.risks-list li::before {
    content: '⚠';
    position: absolute;
    left: 0.75rem;
    font-size: 1.2rem;
}

.contact-section {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.contact-section h2 {
    color: white;
    border-bottom-color: rgba(255, 255, 255, 0.3);
}

.contact-message {
    font-size: 1.1rem;
    margin: 0 0 2rem 0;
    text-align: center;
}

.contact-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.contact-item i {
    font-size: 2rem;
}

.contact-item a {
    color: white;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
}

.contact-item a:hover {
    border-bottom-color: white;
}
</style>
