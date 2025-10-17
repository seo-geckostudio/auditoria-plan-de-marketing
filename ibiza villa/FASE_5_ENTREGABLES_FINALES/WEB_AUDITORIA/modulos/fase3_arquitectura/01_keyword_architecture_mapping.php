<?php
/**
 * Módulo: Keyword-to-Architecture Mapping (m3.2)
 * Fase: 3 - Arquitectura
 * Descripción: Mapear keywords a propuesta de arquitectura óptima
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 3
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$keywords_sin_url = $datosModulo['keywords_sin_url'] ?? [];
$urls_sin_keyword = $datosModulo['urls_sin_keyword'] ?? [];
$mapping_actual = $datosModulo['mapping_actual'] ?? [];
$mapping_propuesto = $datosModulo['mapping_propuesto'] ?? [];
$conflictos_cannibalizacion = $datosModulo['conflictos_cannibalizacion'] ?? [];
$oportunidades_nuevas_urls = $datosModulo['oportunidades_nuevas_urls'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page keyword-mapping-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Keyword-to-Architecture Mapping'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Mapeo de keywords a estructura de URLs óptima'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Herramientas: Google Search Console, Ahrefs, Análisis manual</span>
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
                    <div class="summary-label">Keywords Analizadas</div>
                    <div class="summary-value">
                        <?php echo number_format($resumen['total_keywords'] ?? 0); ?>
                    </div>
                    <div class="summary-detail"><?php echo number_format($resumen['keywords_prioritarias'] ?? 0); ?> prioritarias</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Keywords sin URL</div>
                    <div class="summary-value <?php echo ($resumen['keywords_sin_url'] ?? 0) > 50 ? 'alert' : ''; ?>">
                        <?php echo number_format($resumen['keywords_sin_url'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">Oportunidades perdidas</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">URLs sin Keyword</div>
                    <div class="summary-value <?php echo ($resumen['urls_sin_keyword'] ?? 0) > 30 ? 'alert' : ''; ?>">
                        <?php echo number_format($resumen['urls_sin_keyword'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">Sin objetivo SEO claro</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Conflictos Detec

tados</div>
                    <div class="summary-value <?php echo ($resumen['conflictos'] ?? 0) > 0 ? 'alert' : ''; ?>">
                        <?php echo number_format($resumen['conflictos'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">Canibalización potencial</div>
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

        <!-- Keywords sin URL Asignada -->
        <?php if (!empty($keywords_sin_url)): ?>
        <section class="keywords-sin-url-section">
            <h2>Keywords sin URL Asignada</h2>
            <p class="section-intro">Keywords con potencial de tráfico que no tienen una URL específica optimizada en el sitio actual.</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Volumen Búsqueda</th>
                        <th>Dificultad</th>
                        <th>Intención</th>
                        <th>URL Propuesta</th>
                        <th>Prioridad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keywords_sin_url as $kw): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($kw['keyword']); ?></strong></td>
                        <td><?php echo number_format($kw['volumen']); ?>/mes</td>
                        <td>
                            <span class="difficulty-badge diff-<?php echo strtolower($kw['dificultad_class']); ?>">
                                <?php echo htmlspecialchars($kw['dificultad']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($kw['intencion']); ?></td>
                        <td class="url-cell"><?php echo htmlspecialchars($kw['url_propuesta']); ?></td>
                        <td>
                            <span class="priority-badge priority-<?php echo strtolower($kw['prioridad']); ?>">
                                <?php echo htmlspecialchars($kw['prioridad']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="section-summary">
                <p><strong>Oportunidad total estimada:</strong> <?php echo number_format($resumen['trafico_potencial_keywords_sin_url'] ?? 0); ?> sesiones orgánicas/mes al crear estas URLs optimizadas.</p>
            </div>
        </section>
        <?php endif; ?>

        <!-- URLs sin Keyword Objetivo -->
        <?php if (!empty($urls_sin_keyword)): ?>
        <section class="urls-sin-keyword-section">
            <h2>URLs sin Keyword Objetivo Definida</h2>
            <p class="section-intro">URLs con tráfico orgánico pero sin keyword primaria clara, indicando falta de optimización o contenido sin foco.</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Tráfico Actual</th>
                        <th>Keywords Ranking</th>
                        <th>Problema</th>
                        <th>Acción Recomendada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($urls_sin_keyword as $url): ?>
                    <tr>
                        <td class="url-cell"><?php echo htmlspecialchars($url['url']); ?></td>
                        <td><?php echo number_format($url['trafico']); ?> sesiones/mes</td>
                        <td><?php echo number_format($url['keywords_ranking']); ?> kws</td>
                        <td><?php echo htmlspecialchars($url['problema']); ?></td>
                        <td><?php echo htmlspecialchars($url['accion']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <?php endif; ?>

        <!-- Mapping Actual vs Propuesto -->
        <?php if (!empty($mapping_actual) && !empty($mapping_propuesto)): ?>
        <section class="mapping-comparison-section">
            <h2>Comparativa: Mapping Actual vs Propuesto</h2>

            <div class="mapping-tables">
                <div class="mapping-col">
                    <h3>Estructura Actual</h3>
                    <table class="data-table compact">
                        <thead>
                            <tr>
                                <th>Keyword</th>
                                <th>URL Actual</th>
                                <th>Posición</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mapping_actual as $map): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($map['keyword']); ?></td>
                                <td class="url-cell"><?php echo htmlspecialchars($map['url']); ?></td>
                                <td><?php echo htmlspecialchars($map['posicion'] ?? 'No ranking'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mapping-col">
                    <h3>Estructura Propuesta</h3>
                    <table class="data-table compact">
                        <thead>
                            <tr>
                                <th>Keyword</th>
                                <th>URL Propuesta</th>
                                <th>Mejora Esperada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mapping_propuesto as $map): ?>
                            <tr class="<?php echo $map['es_nuevo'] ? 'highlight-new' : ''; ?>">
                                <td><?php echo htmlspecialchars($map['keyword']); ?></td>
                                <td class="url-cell"><?php echo htmlspecialchars($map['url']); ?></td>
                                <td class="improvement-cell">
                                    <?php if ($map['es_nuevo']): ?>
                                        <span class="badge-new">NUEVA URL</span>
                                    <?php else: ?>
                                        <?php echo htmlspecialchars($map['mejora']); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mapping-benefits">
                <h3>Beneficios del Mapping Propuesto</h3>
                <ul>
                    <?php foreach ($resumen['beneficios_mapping'] ?? [] as $beneficio): ?>
                    <li><?php echo htmlspecialchars($beneficio); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <?php endif; ?>

        <!-- Conflictos de Canibalización -->
        <?php if (!empty($conflictos_cannibalizacion)): ?>
        <section class="conflictos-section">
            <h2>Conflictos de Canibalización Detectados</h2>
            <p class="section-intro">Múltiples URLs compitiendo por la misma keyword, diluyendo autoridad y confundiendo a Google.</p>

            <?php foreach ($conflictos_cannibalizacion as $conflicto): ?>
            <div class="conflicto-card">
                <div class="conflicto-header">
                    <h3>Keyword: <?php echo htmlspecialchars($conflicto['keyword']); ?></h3>
                    <span class="severity-badge severity-<?php echo strtolower($conflicto['severidad']); ?>">
                        <?php echo htmlspecialchars($conflicto['severidad']); ?>
                    </span>
                </div>
                <div class="conflicto-body">
                    <div class="conflicto-info">
                        <span><strong>Volumen búsqueda:</strong> <?php echo number_format($conflicto['volumen']); ?>/mes</span>
                        <span><strong>URLs compitiendo:</strong> <?php echo count($conflicto['urls_compitiendo']); ?></span>
                        <span><strong>Posición flotante:</strong> <?php echo htmlspecialchars($conflicto['posicion_flotante']); ?></span>
                    </div>

                    <div class="urls-compitiendo">
                        <strong>URLs en conflicto:</strong>
                        <table class="data-table mini">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Posición Promedio</th>
                                    <th>Clics/mes</th>
                                    <th>Tráfico Potencial</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($conflicto['urls_compitiendo'] as $url_conf): ?>
                                <tr class="<?php echo $url_conf['es_ganadora_propuesta'] ? 'url-ganadora' : ''; ?>">
                                    <td class="url-cell">
                                        <?php echo htmlspecialchars($url_conf['url']); ?>
                                        <?php if ($url_conf['es_ganadora_propuesta']): ?>
                                        <span class="badge-winner">URL GANADORA</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo number_format($url_conf['posicion'], 1); ?></td>
                                    <td><?php echo number_format($url_conf['clics']); ?></td>
                                    <td><?php echo number_format($url_conf['trafico_potencial']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="conflicto-solucion">
                        <strong>Solución propuesta:</strong>
                        <p><?php echo nl2br(htmlspecialchars($conflicto['solucion'])); ?></p>
                    </div>

                    <div class="conflicto-impacto">
                        <strong>Impacto de resolver:</strong> <?php echo htmlspecialchars($conflicto['impacto_resolucion']); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <!-- Oportunidades de Nuevas URLs -->
        <?php if (!empty($oportunidades_nuevas_urls)): ?>
        <section class="nuevas-urls-section">
            <h2>Oportunidades para Crear Nuevas URLs</h2>
            <p class="section-intro">URLs que deberían crearse para capturar keywords con alto potencial de tráfico.</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>URL Propuesta</th>
                        <th>Keywords Objetivo</th>
                        <th>Volumen Total</th>
                        <th>Tipo Contenido</th>
                        <th>Prioridad</th>
                        <th>Esfuerzo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($oportunidades_nuevas_urls as $oportunidad): ?>
                    <tr>
                        <td class="url-cell"><strong><?php echo htmlspecialchars($oportunidad['url']); ?></strong></td>
                        <td><?php echo number_format(count($oportunidad['keywords'])); ?> keywords</td>
                        <td><?php echo number_format($oportunidad['volumen_total']); ?>/mes</td>
                        <td><?php echo htmlspecialchars($oportunidad['tipo_contenido']); ?></td>
                        <td>
                            <span class="priority-badge priority-<?php echo strtolower($oportunidad['prioridad']); ?>">
                                <?php echo htmlspecialchars($oportunidad['prioridad']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($oportunidad['esfuerzo']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="section-summary">
                <p><strong>Potencial total:</strong> Crear estas <?php echo count($oportunidades_nuevas_urls); ?> URLs nuevas podría generar <?php echo number_format($resumen['trafico_potencial_nuevas_urls'] ?? 0); ?> sesiones orgánicas adicionales/mes.</p>
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
                            <?php if (!empty($rec['urls_afectadas'])): ?>
                            <span>URLs: <?php echo htmlspecialchars($rec['urls_afectadas']); ?></span>
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
        <div class="footer-center">Keyword-to-Architecture Mapping | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos profesionales para Keyword Mapping - Color corporativo #54a34a */
.keyword-mapping-page {
    font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #333;
    line-height: 1.6;
}

.keyword-mapping-page .page-header {
    border-bottom: 3px solid #54a34a;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.keyword-mapping-page .page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.keyword-mapping-page .page-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0 0 15px 0;
}

.keyword-mapping-page .page-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #888;
}

.keyword-mapping-page section {
    margin-bottom: 40px;
}

.keyword-mapping-page section h2 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 15px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #54a34a;
}

.keyword-mapping-page .section-intro {
    color: #666;
    margin-bottom: 20px;
    font-size: 15px;
}

/* Executive Summary - mismo estilo que arquitectura */
.keyword-mapping-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.keyword-mapping-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 22px;
    font-weight: 600;
    border: none;
}

.keyword-mapping-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.keyword-mapping-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.keyword-mapping-page .summary-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    opacity: 0.9;
}

.keyword-mapping-page .summary-value {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
}

.keyword-mapping-page .summary-value.alert {
    color: #ffeb3b;
}

.keyword-mapping-page .summary-detail {
    font-size: 13px;
    opacity: 0.85;
}

.keyword-mapping-page .summary-diagnosis {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 6px;
    margin-top: 20px;
}

.keyword-mapping-page .summary-diagnosis h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    font-weight: 600;
}

/* Tablas */
.keyword-mapping-page .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border: 1px solid #e0e0e0;
}

.keyword-mapping-page .data-table thead {
    background: #f5f5f5;
}

.keyword-mapping-page .data-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #555;
    border-bottom: 2px solid #54a34a;
}

.keyword-mapping-page .data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

.keyword-mapping-page .data-table tbody tr:hover {
    background: #f9f9f9;
}

.keyword-mapping-page .data-table.compact td,
.keyword-mapping-page .data-table.compact th {
    padding: 8px 12px;
    font-size: 13px;
}

.keyword-mapping-page .data-table.mini td,
.keyword-mapping-page .data-table.mini th {
    padding: 6px 10px;
    font-size: 12px;
}

.keyword-mapping-page .url-cell {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    max-width: 350px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.keyword-mapping-page .highlight-new {
    background: #f0f7ee;
}

.keyword-mapping-page .url-ganadora {
    background: #fff9e6;
    font-weight: 600;
}

/* Badges */
.keyword-mapping-page .difficulty-badge,
.keyword-mapping-page .priority-badge,
.keyword-mapping-page .severity-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.keyword-mapping-page .difficulty-badge.diff-facil,
.keyword-mapping-page .priority-badge.priority-c {
    background: #e8f5e9;
    color: #2e7d32;
}

.keyword-mapping-page .difficulty-badge.diff-media,
.keyword-mapping-page .priority-badge.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.keyword-mapping-page .difficulty-badge.diff-dificil,
.keyword-mapping-page .priority-badge.priority-a {
    background: #ffebee;
    color: #c62828;
}

.keyword-mapping-page .severity-badge.severity-alta {
    background: #ffebee;
    color: #c62828;
}

.keyword-mapping-page .severity-badge.severity-media {
    background: #fff3e0;
    color: #ef6c00;
}

.keyword-mapping-page .badge-new,
.keyword-mapping-page .badge-winner {
    background: #54a34a;
    color: white;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 10px;
    margin-left: 8px;
    white-space: nowrap;
}

/* Mapping Comparison */
.keyword-mapping-page .mapping-tables {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin: 20px 0;
}

.keyword-mapping-page .mapping-col h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
}

.keyword-mapping-page .mapping-benefits {
    background: #f9f9f9;
    border-left: 4px solid #54a34a;
    padding: 20px;
    margin-top: 30px;
    border-radius: 4px;
}

.keyword-mapping-page .mapping-benefits h3 {
    margin: 0 0 15px 0;
    font-size: 16px;
}

.keyword-mapping-page .mapping-benefits ul {
    margin: 0;
    padding-left: 20px;
}

.keyword-mapping-page .mapping-benefits li {
    margin-bottom: 8px;
    line-height: 1.6;
}

/* Conflictos Cards */
.keyword-mapping-page .conflicto-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #ef6c00;
    border-radius: 6px;
    margin-bottom: 25px;
    overflow: hidden;
}

.keyword-mapping-page .conflicto-header {
    background: #fff3e0;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.keyword-mapping-page .conflicto-header h3 {
    margin: 0;
    font-size: 16px;
    color: #1a1a1a;
}

.keyword-mapping-page .conflicto-body {
    padding: 20px;
}

.keyword-mapping-page .conflicto-info {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 4px;
    margin-bottom: 20px;
    font-size: 14px;
}

.keyword-mapping-page .urls-compitiendo {
    margin: 20px 0;
}

.keyword-mapping-page .urls-compitiendo strong {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

.keyword-mapping-page .conflicto-solucion {
    background: #f0f7ee;
    padding: 15px;
    border-radius: 4px;
    margin: 20px 0;
}

.keyword-mapping-page .conflicto-solucion strong {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

.keyword-mapping-page .conflicto-impacto {
    font-size: 14px;
    padding: 12px;
    background: #f9f9f9;
    border-left: 3px solid #54a34a;
    border-radius: 4px;
}

/* Section Summary */
.keyword-mapping-page .section-summary {
    background: #f0f7ee;
    padding: 15px 20px;
    border-left: 4px solid #54a34a;
    margin-top: 20px;
    border-radius: 4px;
}

.keyword-mapping-page .section-summary p {
    margin: 0;
    font-weight: 500;
    color: #333;
}

/* Recommendations */
.keyword-mapping-page .priority-group {
    margin-bottom: 30px;
}

.keyword-mapping-page .priority-header {
    background: #f5f5f5;
    padding: 12px 20px;
    margin: 0 0 15px 0;
    border-radius: 4px;
    font-size: 16px;
}

.keyword-mapping-page .priority-header.priority-a {
    background: #ffebee;
    color: #c62828;
}

.keyword-mapping-page .priority-header.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.keyword-mapping-page .priority-header.priority-c {
    background: #e3f2fd;
    color: #1565c0;
}

.keyword-mapping-page .recommendation-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 3px solid #54a34a;
    padding: 15px 20px;
    margin-bottom: 12px;
    border-radius: 4px;
}

.keyword-mapping-page .rec-title {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.keyword-mapping-page .rec-description {
    margin-bottom: 10px;
    color: #555;
    line-height: 1.6;
}

.keyword-mapping-page .rec-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #888;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}

/* Page Footer */
.keyword-mapping-page .page-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #888;
}

@media print {
    .keyword-mapping-page {
        page-break-before: always;
    }

    .keyword-mapping-page .conflicto-card,
    .keyword-mapping-page .recommendation-item {
        page-break-inside: avoid;
    }

    .keyword-mapping-page .mapping-tables {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 1200px) {
    .keyword-mapping-page .mapping-tables {
        grid-template-columns: 1fr;
    }
}
</style>
