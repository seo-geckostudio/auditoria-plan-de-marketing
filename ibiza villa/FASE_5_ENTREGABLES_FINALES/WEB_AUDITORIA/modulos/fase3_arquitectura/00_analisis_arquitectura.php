<?php
/**
 * Módulo: Análisis de Arquitectura Actual (m3.1)
 * Fase: 3 - Arquitectura
 * Descripción: Evaluar estructura web actual, jerarquía de contenido y crawl efficiency
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 3
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$estructura_actual = $datosModulo['estructura_actual'] ?? [];
$metricas_crawl = $datosModulo['metricas_crawl'] ?? [];
$profundidad_paginas = $datosModulo['profundidad_paginas'] ?? [];
$categorias = $datosModulo['analisis_categorias'] ?? [];
$distribucion_contenido = $datosModulo['distribucion_contenido'] ?? [];
$problemas_arquitectura = $datosModulo['problemas_detectados'] ?? [];
$benchmark_competencia = $datosModulo['benchmark_competencia'] ?? [];
$oportunidades = $datosModulo['oportunidades_mejora'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page arquitectura-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Análisis de Arquitectura Actual'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Evaluación de estructura web, jerarquía y crawl efficiency'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Herramientas: Screaming Frog, Google Analytics 4, Google Search Console</span>
            <span>Fase 3 - Arquitectura</span>
        </div>
    </div>

    <div class="page-body">

        <!-- Resumen Ejecutivo -->
        <?php if (!empty($resumen)): ?>
        <section class="executive-summary">
            <h2>Resumen Ejecutivo</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Score Arquitectura</div>
                    <div class="summary-value <?php echo $resumen['score_class'] ?? ''; ?>">
                        <?php echo htmlspecialchars($resumen['score'] ?? 'N/A'); ?>/100
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['score_description'] ?? ''); ?></div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Total URLs</div>
                    <div class="summary-value">
                        <?php echo number_format($resumen['total_urls'] ?? 0); ?>
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['urls_indexables'] ?? '0'); ?> indexables</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Profundidad Media</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['profundidad_media'] ?? 'N/A'); ?> clics
                    </div>
                    <div class="summary-detail">Óptimo: ≤3 clics</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Crawl Efficiency</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['crawl_efficiency'] ?? 'N/A'); ?>%
                    </div>
                    <div class="summary-detail"><?php echo htmlspecialchars($resumen['efficiency_status'] ?? ''); ?></div>
                </div>
            </div>
            <?php if (!empty($resumen['diagnostico'])): ?>
            <div class="summary-diagnosis">
                <h3>Diagnóstico General</h3>
                <p><?php echo nl2br(htmlspecialchars($resumen['diagnostico'])); ?></p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Estructura Actual -->
        <?php if (!empty($estructura_actual)): ?>
        <section class="estructura-section">
            <h2>Estructura de Navegación Actual</h2>

            <div class="estructura-overview">
                <h3>Jerarquía de Niveles</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nivel</th>
                            <th>Descripción</th>
                            <th>URLs</th>
                            <th>% Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estructura_actual['niveles'] ?? [] as $nivel): ?>
                        <tr>
                            <td><strong>Nivel <?php echo htmlspecialchars($nivel['numero']); ?></strong></td>
                            <td><?php echo htmlspecialchars($nivel['descripcion']); ?></td>
                            <td><?php echo number_format($nivel['urls']); ?></td>
                            <td><?php echo number_format($nivel['porcentaje'], 1); ?>%</td>
                            <td>
                                <span class="status-badge <?php echo $nivel['estado_class']; ?>">
                                    <?php echo htmlspecialchars($nivel['estado']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($estructura_actual['mapa_sitio'])): ?>
            <div class="sitemap-structure">
                <h3>Mapa de Estructura Principal</h3>
                <div class="sitemap-tree">
                    <?php echo $estructura_actual['mapa_sitio']; ?>
                </div>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Métricas de Crawl -->
        <?php if (!empty($metricas_crawl)): ?>
        <section class="crawl-metrics-section">
            <h2>Métricas de Crawl Efficiency</h2>

            <div class="metrics-grid">
                <div class="metric-box">
                    <div class="metric-header">Total URLs Crawleadas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['total_crawled'] ?? 0); ?></div>
                    <div class="metric-footer">
                        <?php echo number_format($metricas_crawl['total_indexable'] ?? 0); ?> indexables
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">URLs Duplicadas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['duplicadas'] ?? 0); ?></div>
                    <div class="metric-footer">
                        <?php echo number_format($metricas_crawl['porcentaje_duplicadas'] ?? 0, 1); ?>% del total
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">URLs Huérfanas</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['huerfanas'] ?? 0); ?></div>
                    <div class="metric-footer">
                        Sin enlaces internos
                    </div>
                </div>
                <div class="metric-box">
                    <div class="metric-header">Tiempo Medio Carga</div>
                    <div class="metric-number"><?php echo number_format($metricas_crawl['tiempo_medio_carga'] ?? 0, 2); ?>s</div>
                    <div class="metric-footer">
                        Objetivo: &lt;3s
                    </div>
                </div>
            </div>

            <?php if (!empty($metricas_crawl['distribucion_status'])): ?>
            <div class="status-distribution">
                <h3>Distribución de Status Codes</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Status Code</th>
                            <th>Cantidad</th>
                            <th>% Total</th>
                            <th>Impacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($metricas_crawl['distribucion_status'] as $status): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($status['code']); ?></strong></td>
                            <td><?php echo number_format($status['cantidad']); ?></td>
                            <td><?php echo number_format($status['porcentaje'], 1); ?>%</td>
                            <td><?php echo htmlspecialchars($status['impacto']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Profundidad de Páginas -->
        <?php if (!empty($profundidad_paginas)): ?>
        <section class="profundidad-section">
            <h2>Análisis de Profundidad de Páginas</h2>

            <div class="profundidad-chart">
                <h3>Distribución por Nivel de Profundidad</h3>
                <div class="profundidad-bars">
                    <?php foreach ($profundidad_paginas['distribucion'] ?? [] as $prof): ?>
                    <div class="profundidad-row">
                        <div class="prof-label">
                            <?php echo htmlspecialchars($prof['nivel']); ?> clics
                        </div>
                        <div class="prof-bar-container">
                            <div class="prof-bar" style="width: <?php echo $prof['porcentaje']; ?>%;">
                                <span class="prof-bar-text">
                                    <?php echo number_format($prof['urls']); ?> URLs (<?php echo number_format($prof['porcentaje'], 1); ?>%)
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (!empty($profundidad_paginas['paginas_profundas'])): ?>
            <div class="paginas-profundas">
                <h3>URLs Críticas con Excesiva Profundidad (>4 clics)</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Profundidad</th>
                            <th>Tráfico Orgánico</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($profundidad_paginas['paginas_profundas'] as $pagina): ?>
                        <tr>
                            <td class="url-cell"><?php echo htmlspecialchars($pagina['url']); ?></td>
                            <td><?php echo htmlspecialchars($pagina['profundidad']); ?> clics</td>
                            <td><?php echo number_format($pagina['trafico_organico']); ?> sesiones/mes</td>
                            <td>
                                <span class="priority-badge priority-<?php echo strtolower($pagina['prioridad']); ?>">
                                    <?php echo htmlspecialchars($pagina['prioridad']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <div class="profundidad-insight">
                <h3>Insight Clave</h3>
                <p><?php echo nl2br(htmlspecialchars($profundidad_paginas['insight'] ?? '')); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Análisis de Categorías -->
        <?php if (!empty($categorias)): ?>
        <section class="categorias-section">
            <h2>Análisis de Categorías y Secciones</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>URLs</th>
                        <th>Tráfico Orgánico</th>
                        <th>Profundidad Media</th>
                        <th>Enlaces Internos</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias['secciones'] ?? [] as $seccion): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($seccion['nombre']); ?></strong></td>
                        <td><?php echo number_format($seccion['urls']); ?></td>
                        <td><?php echo number_format($seccion['trafico']); ?> sesiones/mes</td>
                        <td><?php echo number_format($seccion['profundidad_media'], 1); ?> clics</td>
                        <td><?php echo number_format($seccion['enlaces_internos']); ?></td>
                        <td>
                            <span class="status-badge <?php echo $seccion['estado_class']; ?>">
                                <?php echo htmlspecialchars($seccion['estado']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($categorias['recomendaciones'])): ?>
            <div class="categorias-recommendations">
                <h3>Recomendaciones por Categoría</h3>
                <ul class="recommendations-list">
                    <?php foreach ($categorias['recomendaciones'] as $rec): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($rec['categoria']); ?>:</strong>
                        <?php echo htmlspecialchars($rec['recomendacion']); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Distribución de Contenido -->
        <?php if (!empty($distribucion_contenido)): ?>
        <section class="distribucion-section">
            <h2>Distribución de Contenido por Tipo</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tipo de Contenido</th>
                        <th>Cantidad</th>
                        <th>% Total</th>
                        <th>Tráfico Promedio</th>
                        <th>Evaluación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($distribucion_contenido['tipos'] ?? [] as $tipo): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($tipo['nombre']); ?></strong></td>
                        <td><?php echo number_format($tipo['cantidad']); ?></td>
                        <td><?php echo number_format($tipo['porcentaje'], 1); ?>%</td>
                        <td><?php echo number_format($tipo['trafico_promedio']); ?> sesiones</td>
                        <td><?php echo htmlspecialchars($tipo['evaluacion']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="distribucion-insight">
                <h3>Análisis de Balance de Contenido</h3>
                <p><?php echo nl2br(htmlspecialchars($distribucion_contenido['analisis'] ?? '')); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Problemas Detectados -->
        <?php if (!empty($problemas_arquitectura)): ?>
        <section class="problemas-section">
            <h2>Problemas de Arquitectura Detectados</h2>

            <?php foreach ($problemas_arquitectura as $problema): ?>
            <div class="problema-card severity-<?php echo strtolower($problema['severidad']); ?>">
                <div class="problema-header">
                    <span class="problema-severidad"><?php echo htmlspecialchars($problema['severidad']); ?></span>
                    <h3><?php echo htmlspecialchars($problema['titulo']); ?></h3>
                </div>
                <div class="problema-body">
                    <div class="problema-description">
                        <strong>Descripción:</strong>
                        <p><?php echo nl2br(htmlspecialchars($problema['descripcion'])); ?></p>
                    </div>
                    <div class="problema-impact">
                        <strong>Impacto SEO:</strong>
                        <p><?php echo nl2br(htmlspecialchars($problema['impacto'])); ?></p>
                    </div>
                    <div class="problema-urls">
                        <strong>URLs Afectadas:</strong> <?php echo number_format($problema['urls_afectadas']); ?>
                    </div>
                    <?php if (!empty($problema['ejemplos'])): ?>
                    <div class="problema-ejemplos">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($problema['ejemplos'] as $ejemplo): ?>
                            <li><?php echo htmlspecialchars($ejemplo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <!-- Benchmark Competencia -->
        <?php if (!empty($benchmark_competencia)): ?>
        <section class="benchmark-section">
            <h2>Benchmark vs Competencia</h2>

            <table class="data-table competitive-table">
                <thead>
                    <tr>
                        <th>Sitio</th>
                        <th>Total URLs</th>
                        <th>Profundidad Media</th>
                        <th>Niveles Jerarquía</th>
                        <th>Crawl Efficiency</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($benchmark_competencia['sitios'] ?? [] as $sitio): ?>
                    <tr class="<?php echo $sitio['es_tuyo'] ? 'highlight-row' : ''; ?>">
                        <td>
                            <strong><?php echo htmlspecialchars($sitio['nombre']); ?></strong>
                            <?php if ($sitio['es_tuyo']): ?>
                            <span class="badge-current">TU SITIO</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo number_format($sitio['total_urls']); ?></td>
                        <td><?php echo number_format($sitio['profundidad_media'], 1); ?> clics</td>
                        <td><?php echo htmlspecialchars($sitio['niveles_jerarquia']); ?></td>
                        <td><?php echo number_format($sitio['crawl_efficiency'], 1); ?>%</td>
                        <td>
                            <span class="score-badge score-<?php echo $sitio['score_class']; ?>">
                                <?php echo htmlspecialchars($sitio['score']); ?>/100
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($benchmark_competencia['insights'])): ?>
            <div class="benchmark-insights">
                <h3>Insights Competitivos</h3>
                <ul>
                    <?php foreach ($benchmark_competencia['insights'] as $insight): ?>
                    <li><?php echo htmlspecialchars($insight); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Oportunidades de Mejora -->
        <?php if (!empty($oportunidades)): ?>
        <section class="oportunidades-section">
            <h2>Oportunidades de Mejora Identificadas</h2>

            <div class="oportunidades-grid">
                <?php foreach ($oportunidades as $oportunidad): ?>
                <div class="oportunidad-card">
                    <div class="oportunidad-header">
                        <h3><?php echo htmlspecialchars($oportunidad['titulo']); ?></h3>
                        <span class="impact-badge impact-<?php echo strtolower($oportunidad['impacto']); ?>">
                            Impacto: <?php echo htmlspecialchars($oportunidad['impacto']); ?>
                        </span>
                    </div>
                    <div class="oportunidad-body">
                        <p><?php echo nl2br(htmlspecialchars($oportunidad['descripcion'])); ?></p>
                    </div>
                    <div class="oportunidad-footer">
                        <span class="effort-label">Esfuerzo: <?php echo htmlspecialchars($oportunidad['esfuerzo']); ?></span>
                        <span class="benefit-label">Beneficio potencial: <?php echo htmlspecialchars($oportunidad['beneficio']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <section class="recommendations-section">
            <h2>Recomendaciones Prioritarias</h2>

            <?php
            $prioridades = ['A' => 'Alta', 'B' => 'Media', 'C' => 'Baja'];
            foreach ($prioridades as $prioridad => $label):
                $recs_prioridad = array_filter($recomendaciones, function($r) use ($prioridad) {
                    return $r['prioridad'] === $prioridad;
                });
                if (empty($recs_prioridad)) continue;
            ?>
            <div class="priority-group">
                <h3 class="priority-header priority-<?php echo strtolower($prioridad); ?>">
                    Prioridad <?php echo $prioridad; ?> - <?php echo $label; ?>
                </h3>
                <div class="recommendations-list">
                    <?php foreach ($recs_prioridad as $rec): ?>
                    <div class="recommendation-item">
                        <div class="rec-title"><?php echo htmlspecialchars($rec['titulo']); ?></div>
                        <div class="rec-description"><?php echo nl2br(htmlspecialchars($rec['descripcion'])); ?></div>
                        <div class="rec-meta">
                            <span>Esfuerzo: <?php echo htmlspecialchars($rec['esfuerzo']); ?></span>
                            <span>Impacto: <?php echo htmlspecialchars($rec['impacto_esperado']); ?></span>
                            <?php if (!empty($rec['kpis'])): ?>
                            <span>KPIs: <?php echo htmlspecialchars($rec['kpis']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($config['proyecto']['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Análisis de Arquitectura | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos profesionales para Análisis de Arquitectura - Color corporativo #54a34a */
.arquitectura-page {
    font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #333;
    line-height: 1.6;
}

.arquitectura-page .page-header {
    border-bottom: 3px solid #54a34a;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.arquitectura-page .page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.arquitectura-page .page-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0 0 15px 0;
}

.arquitectura-page .page-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #888;
}

.arquitectura-page .page-meta span {
    padding: 4px 0;
}

/* Executive Summary */
.arquitectura-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.arquitectura-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 22px;
    font-weight: 600;
}

.arquitectura-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.arquitectura-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.arquitectura-page .summary-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    opacity: 0.9;
}

.arquitectura-page .summary-value {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
}

.arquitectura-page .summary-detail {
    font-size: 13px;
    opacity: 0.85;
}

.arquitectura-page .summary-diagnosis {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 6px;
    margin-top: 20px;
}

.arquitectura-page .summary-diagnosis h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    font-weight: 600;
}

.arquitectura-page .summary-diagnosis p {
    margin: 0;
    line-height: 1.7;
}

/* Secciones */
.arquitectura-page section {
    margin-bottom: 40px;
}

.arquitectura-page section h2 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #54a34a;
}

.arquitectura-page section h3 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 20px 0 15px 0;
}

/* Tablas */
.arquitectura-page .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border: 1px solid #e0e0e0;
}

.arquitectura-page .data-table thead {
    background: #f5f5f5;
}

.arquitectura-page .data-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #555;
    border-bottom: 2px solid #54a34a;
}

.arquitectura-page .data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

.arquitectura-page .data-table tbody tr:hover {
    background: #f9f9f9;
}

.arquitectura-page .url-cell {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.arquitectura-page .highlight-row {
    background: #f0f7ee;
    font-weight: 600;
}

/* Badges */
.arquitectura-page .status-badge,
.arquitectura-page .priority-badge,
.arquitectura-page .score-badge,
.arquitectura-page .impact-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .status-badge.success,
.arquitectura-page .score-badge.score-high {
    background: #e8f5e9;
    color: #2e7d32;
}

.arquitectura-page .status-badge.warning,
.arquitectura-page .score-badge.score-medium {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .status-badge.error,
.arquitectura-page .score-badge.score-low {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-badge.priority-a,
.arquitectura-page .impact-badge.impact-alto {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-badge.priority-b,
.arquitectura-page .impact-badge.impact-medio {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .priority-badge.priority-c,
.arquitectura-page .impact-badge.impact-bajo {
    background: #e3f2fd;
    color: #1565c0;
}

.arquitectura-page .badge-current {
    background: #54a34a;
    color: white;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 10px;
    margin-left: 8px;
}

/* Metrics Grid */
.arquitectura-page .metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.arquitectura-page .metric-box {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #54a34a;
    padding: 20px;
    border-radius: 4px;
}

.arquitectura-page .metric-header {
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.arquitectura-page .metric-number {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 5px;
}

.arquitectura-page .metric-footer {
    font-size: 12px;
    color: #888;
}

/* Profundidad Bars */
.arquitectura-page .profundidad-bars {
    margin: 20px 0;
}

.arquitectura-page .profundidad-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.arquitectura-page .prof-label {
    width: 80px;
    font-size: 13px;
    font-weight: 600;
    color: #555;
}

.arquitectura-page .prof-bar-container {
    flex: 1;
    background: #f0f0f0;
    border-radius: 4px;
    overflow: hidden;
    height: 32px;
}

.arquitectura-page .prof-bar {
    background: linear-gradient(90deg, #54a34a 0%, #6ab85e 100%);
    height: 100%;
    display: flex;
    align-items: center;
    padding: 0 10px;
    transition: width 0.3s ease;
}

.arquitectura-page .prof-bar-text {
    color: white;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

/* Problemas Cards */
.arquitectura-page .problema-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 20px;
    overflow: hidden;
}

.arquitectura-page .problema-card.severity-alta {
    border-left: 4px solid #c62828;
}

.arquitectura-page .problema-card.severity-media {
    border-left: 4px solid #ef6c00;
}

.arquitectura-page .problema-card.severity-baja {
    border-left: 4px solid #1565c0;
}

.arquitectura-page .problema-header {
    background: #f5f5f5;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.arquitectura-page .problema-severidad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .problema-header h3 {
    margin: 0;
    font-size: 16px;
}

.arquitectura-page .problema-body {
    padding: 20px;
}

.arquitectura-page .problema-body > div {
    margin-bottom: 15px;
}

.arquitectura-page .problema-body strong {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-size: 13px;
}

.arquitectura-page .problema-ejemplos ul {
    margin: 5px 0 0 0;
    padding-left: 20px;
}

.arquitectura-page .problema-ejemplos li {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    margin-bottom: 3px;
}

/* Oportunidades Grid */
.arquitectura-page .oportunidades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.arquitectura-page .oportunidad-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    overflow: hidden;
}

.arquitectura-page .oportunidad-header {
    background: #f9f9f9;
    padding: 15px 20px;
    border-bottom: 1px solid #e0e0e0;
}

.arquitectura-page .oportunidad-header h3 {
    margin: 0 0 8px 0;
    font-size: 16px;
}

.arquitectura-page .oportunidad-body {
    padding: 15px 20px;
}

.arquitectura-page .oportunidad-footer {
    padding: 12px 20px;
    background: #f5f5f5;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #666;
}

/* Recommendations */
.arquitectura-page .priority-group {
    margin-bottom: 30px;
}

.arquitectura-page .priority-header {
    background: #f5f5f5;
    padding: 12px 20px;
    margin: 0 0 15px 0;
    border-radius: 4px;
    font-size: 16px;
}

.arquitectura-page .priority-header.priority-a {
    background: #ffebee;
    color: #c62828;
}

.arquitectura-page .priority-header.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.arquitectura-page .priority-header.priority-c {
    background: #e3f2fd;
    color: #1565c0;
}

.arquitectura-page .recommendation-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 3px solid #54a34a;
    padding: 15px 20px;
    margin-bottom: 12px;
    border-radius: 4px;
}

.arquitectura-page .rec-title {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.arquitectura-page .rec-description {
    margin-bottom: 10px;
    color: #555;
    line-height: 1.6;
}

.arquitectura-page .rec-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #888;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}

.arquitectura-page .rec-meta span {
    display: inline-block;
}

/* Insight boxes */
.arquitectura-page .profundidad-insight,
.arquitectura-page .distribucion-insight,
.arquitectura-page .benchmark-insights {
    background: #f9f9f9;
    border-left: 4px solid #54a34a;
    padding: 20px;
    margin: 20px 0;
    border-radius: 4px;
}

.arquitectura-page .recommendations-list ul {
    margin: 0;
    padding-left: 20px;
}

.arquitectura-page .recommendations-list li {
    margin-bottom: 10px;
    line-height: 1.6;
}

/* Sitemap structure */
.arquitectura-page .sitemap-tree {
    background: #fafafa;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.8;
    overflow-x: auto;
}

/* Page footer */
.arquitectura-page .page-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #888;
}

@media print {
    .arquitectura-page {
        page-break-before: always;
    }

    .arquitectura-page .problema-card,
    .arquitectura-page .oportunidad-card,
    .arquitectura-page .recommendation-item {
        page-break-inside: avoid;
    }
}
</style>
