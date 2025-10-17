<?php
/**
 * Módulo: IA/SGE Optimization (m9.2)
 * Fase: 9 - SEO Moderno
 * Descripción: Optimización para AI Overviews y Search Generative Experience de Google
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$visibilidad_sge = $datosModulo['visibilidad_sge'] ?? [];
$analisis_contenido = $datosModulo['analisis_contenido'] ?? [];
$optimizaciones = $datosModulo['optimizaciones_recomendadas'] ?? [];
$entidades = $datosModulo['entidades_mencionadas'] ?? [];
$competencia_ia = $datosModulo['competencia_ia'] ?? [];
$estrategia = $datosModulo['estrategia_contenido_ia'] ?? [];
$metricas = $datosModulo['metricas_seguimiento'] ?? [];
?>

<style>
.ia-sge-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.ia-sge-page .executive-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.ia-sge-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.ia-sge-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.ia-sge-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.ia-sge-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.ia-sge-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.ia-sge-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #667eea;
}

.ia-sge-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #667eea;
    font-size: 20px;
    font-weight: 600;
}

.ia-sge-page .visibility-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
}

.ia-sge-page .keyword-query {
    font-weight: 600;
    color: #2c3e50;
    font-size: 16px;
    margin-bottom: 10px;
}

.ia-sge-page .visibility-status {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.ia-sge-page .status-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.ia-sge-page .status-badge.presente {
    background: #d4edda;
    color: #155724;
}

.ia-sge-page .status-badge.ausente {
    background: #f8d7da;
    color: #721c24;
}

.ia-sge-page .status-badge.parcial {
    background: #fff3cd;
    color: #856404;
}

.ia-sge-page .citation-info {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.ia-sge-page .optimization-card {
    background: #e8f5e9;
    border: 1px solid #c8e6c9;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #4caf50;
}

.ia-sge-page .optimization-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 16px;
    margin-bottom: 10px;
}

.ia-sge-page .optimization-category {
    display: inline-block;
    background: #4caf50;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 10px;
}

.ia-sge-page .action-list {
    margin: 10px 0;
    padding-left: 20px;
}

.ia-sge-page .action-list li {
    margin: 8px 0;
    font-size: 14px;
}

.ia-sge-page .priority-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 8px;
}

.ia-sge-page .priority-indicator.alta {
    background: #dc3545;
}

.ia-sge-page .priority-indicator.media {
    background: #ffc107;
}

.ia-sge-page .priority-indicator.baja {
    background: #6c757d;
}

.ia-sge-page .entity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.ia-sge-page .entity-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
}

.ia-sge-page .entity-name {
    font-weight: 600;
    color: #667eea;
    margin-bottom: 8px;
}

.ia-sge-page .entity-mentions {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 5px;
}

.ia-sge-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.ia-sge-page .comparison-table th,
.ia-sge-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.ia-sge-page .comparison-table th {
    background: #f0f4ff;
    color: #667eea;
    font-weight: 600;
    font-size: 14px;
}

.ia-sge-page .comparison-table tr:hover {
    background: #fafafa;
}

.ia-sge-page .strategy-phase {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
}

.ia-sge-page .phase-title {
    color: #667eea;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 10px;
}

.ia-sge-page .phase-duration {
    display: inline-block;
    background: #667eea;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
}

.ia-sge-page .metric-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
}

.ia-sge-page .metric-value {
    font-size: 28px;
    font-weight: 700;
    color: #667eea;
    margin: 10px 0;
}

.ia-sge-page .metric-label {
    font-size: 13px;
    color: #6c757d;
}

.ia-sge-page .metric-trend {
    font-size: 12px;
    margin-top: 5px;
}

.ia-sge-page .metric-trend.up {
    color: #28a745;
}

.ia-sge-page .metric-trend.down {
    color: #dc3545;
}

@media print {
    .ia-sge-page .content-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page ia-sge-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'IA/SGE Optimization'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para AI Overviews y Search Generative Experience'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Maximizar visibilidad en resultados generados por IA</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Visibilidad SGE</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['visibilidad_sge'] ?? '0%'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Citaciones IA</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['citaciones_totales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Entidades Reconocidas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['entidades_reconocidas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Score E-E-A-T</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['score_eeat'] ?? '0'); ?>/100</div>
            </div>
        </div>
    </div>

    <!-- Visibilidad en SGE -->
    <?php if (!empty($visibilidad_sge)): ?>
    <div class="content-section">
        <h3>Visibilidad en Search Generative Experience</h3>
        <p>Análisis de presencia en respuestas generadas por IA de Google para queries clave.</p>

        <?php foreach ($visibilidad_sge as $query): ?>
        <div class="visibility-card">
            <div class="keyword-query"><?php echo htmlspecialchars($query['query'] ?? ''); ?></div>

            <div class="visibility-status">
                <span>Estado:</span>
                <span class="status-badge <?php echo strtolower($query['estado'] ?? 'ausente'); ?>">
                    <?php echo htmlspecialchars($query['estado'] ?? 'Ausente'); ?>
                </span>
            </div>

            <?php if (isset($query['citation'])): ?>
            <div class="citation-info">
                <strong>Citación:</strong> <?php echo htmlspecialchars($query['citation']); ?>
            </div>
            <?php endif; ?>

            <?php if (isset($query['posicion_citacion'])): ?>
            <p style="font-size: 13px; color: #6c757d; margin-top: 8px;">
                <strong>Posición en respuesta IA:</strong> <?php echo htmlspecialchars($query['posicion_citacion']); ?>
            </p>
            <?php endif; ?>

            <?php if (isset($query['competidores_citados'])): ?>
            <p style="font-size: 13px; color: #6c757d; margin-top: 5px;">
                <strong>Competidores citados:</strong> <?php echo htmlspecialchars($query['competidores_citados']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Análisis de Contenido -->
    <?php if (!empty($analisis_contenido)): ?>
    <div class="content-section">
        <h3>Análisis de Contenido para IA</h3>
        <p>Evaluación de qué tan bien estructurado está nuestro contenido para ser comprendido y citado por modelos de IA.</p>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Factor</th>
                    <th>Estado Actual</th>
                    <th>Benchmark</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($analisis_contenido as $factor): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($factor['factor'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($factor['estado_actual'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($factor['benchmark'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($factor['observaciones'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Optimizaciones Recomendadas -->
    <div class="content-section">
        <h3>Optimizaciones Recomendadas</h3>
        <p>Acciones específicas para mejorar la visibilidad en respuestas generadas por IA.</p>

        <?php foreach ($optimizaciones ?? [] as $opt): ?>
        <div class="optimization-card">
            <span class="optimization-category"><?php echo htmlspecialchars($opt['categoria'] ?? ''); ?></span>
            <div class="optimization-title">
                <span class="priority-indicator <?php echo strtolower($opt['prioridad'] ?? 'media'); ?>"></span>
                <?php echo htmlspecialchars($opt['titulo'] ?? ''); ?>
            </div>
            <p style="margin: 10px 0; font-size: 14px;"><?php echo htmlspecialchars($opt['descripcion'] ?? ''); ?></p>

            <?php if (!empty($opt['acciones'])): ?>
            <ul class="action-list">
                <?php foreach ($opt['acciones'] as $accion): ?>
                <li><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (isset($opt['impacto_estimado'])): ?>
            <p style="margin-top: 10px; font-size: 13px; color: #155724;">
                <strong>Impacto estimado:</strong> <?php echo htmlspecialchars($opt['impacto_estimado']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Entidades Mencionadas -->
    <?php if (!empty($entidades)): ?>
    <div class="content-section">
        <h3>Entidades y Relaciones</h3>
        <p>Entidades clave que los sistemas de IA reconocen en nuestro contenido.</p>

        <div class="entity-grid">
            <?php foreach ($entidades as $entity): ?>
            <div class="entity-card">
                <div class="entity-name"><?php echo htmlspecialchars($entity['nombre'] ?? ''); ?></div>
                <div class="entity-mentions">
                    Menciones: <?php echo htmlspecialchars($entity['menciones'] ?? '0'); ?>
                </div>
                <div style="font-size: 12px; color: #6c757d;">
                    Tipo: <?php echo htmlspecialchars($entity['tipo'] ?? 'N/A'); ?>
                </div>
                <?php if (isset($entity['contexto'])): ?>
                <div style="font-size: 12px; margin-top: 5px;">
                    <?php echo htmlspecialchars($entity['contexto']); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Competencia IA -->
    <?php if (!empty($competencia_ia)): ?>
    <div class="content-section">
        <h3>Benchmarking Competencia en IA</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Sitio</th>
                    <th>Citaciones SGE</th>
                    <th>% Visibilidad</th>
                    <th>Entidades</th>
                    <th>Fortalezas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia_ia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['citaciones'] ?? '0'); ?></td>
                    <td><?php echo htmlspecialchars($comp['visibilidad'] ?? '0%'); ?></td>
                    <td><?php echo htmlspecialchars($comp['entidades'] ?? '0'); ?></td>
                    <td><?php echo htmlspecialchars($comp['fortalezas'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Estrategia de Contenido IA -->
    <?php if (!empty($estrategia)): ?>
    <div class="content-section">
        <h3>Estrategia de Contenido para IA</h3>

        <?php foreach ($estrategia as $phase): ?>
        <div class="strategy-phase">
            <div class="phase-title"><?php echo htmlspecialchars($phase['fase'] ?? ''); ?></div>
            <span class="phase-duration"><?php echo htmlspecialchars($phase['duracion'] ?? ''); ?></span>

            <p style="margin: 15px 0;"><?php echo htmlspecialchars($phase['descripcion'] ?? ''); ?></p>

            <?php if (!empty($phase['objetivos'])): ?>
            <strong style="display: block; margin-top: 10px;">Objetivos:</strong>
            <ul class="action-list">
                <?php foreach ($phase['objetivos'] as $obj): ?>
                <li><?php echo htmlspecialchars($obj); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Métricas de Seguimiento -->
    <?php if (!empty($metricas)): ?>
    <div class="content-section">
        <h3>Métricas de Seguimiento</h3>
        <p>KPIs para monitorizar el impacto de las optimizaciones para IA.</p>

        <div class="summary-grid">
            <?php foreach ($metricas as $metric): ?>
            <div class="metric-card">
                <div class="metric-label"><?php echo htmlspecialchars($metric['nombre'] ?? ''); ?></div>
                <div class="metric-value"><?php echo htmlspecialchars($metric['valor'] ?? '0'); ?></div>
                <?php if (isset($metric['tendencia'])): ?>
                <div class="metric-trend <?php echo $metric['tendencia'] === 'positiva' ? 'up' : 'down'; ?>">
                    <?php echo htmlspecialchars($metric['cambio'] ?? ''); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>IA/SGE Optimization</span>
    </div>
</div>
