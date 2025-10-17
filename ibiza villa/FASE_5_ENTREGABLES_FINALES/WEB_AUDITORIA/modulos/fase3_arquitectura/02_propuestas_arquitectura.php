<?php
/**
 * Módulo: Propuestas de Arquitectura (m3.3)
 * Fase: 3 - Arquitectura
 * Descripción: Diseñar nueva estructura web optimizada para SEO
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 3
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$propuesta_principal = $datosModulo['propuesta_principal'] ?? [];
$comparativa = $datosModulo['comparativa_antes_despues'] ?? [];
$estructura_propuesta = $datosModulo['estructura_propuesta'] ?? [];
$nuevas_categorias = $datosModulo['nuevas_categorias'] ?? [];
$mejoras_navegacion = $datosModulo['mejoras_navegacion'] ?? [];
$implementacion = $datosModulo['plan_implementacion'] ?? [];
$impacto_estimado = $datosModulo['impacto_estimado'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page propuestas-arquitectura-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Propuestas de Arquitectura'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Nueva estructura web optimizada para SEO y experiencia de usuario'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Basado en: Análisis arquitectura + Keyword research + Benchmarking</span>
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
                    <div class="summary-label">Mejora Score</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['score_actual'] ?? 0); ?> → <?php echo htmlspecialchars($resumen['score_propuesto'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">+<?php echo htmlspecialchars($resumen['mejora_score'] ?? 0); ?> puntos</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Reducción Profundidad</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['profundidad_actual'] ?? 0); ?> → <?php echo htmlspecialchars($resumen['profundidad_propuesta'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">clics promedio</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Nuevas Categorías</div>
                    <div class="summary-value">
                        +<?php echo number_format($resumen['nuevas_categorias'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">Oportunidades identificadas</div>
                </div>
                <div class="summary-card">
                    <div class="summary-label">Tráfico Estimado</div>
                    <div class="summary-value">
                        +<?php echo number_format($resumen['trafico_estimado'] ?? 0); ?>
                    </div>
                    <div class="summary-detail">sesiones/mes adicionales</div>
                </div>
            </div>
            <?php if (!empty($resumen['propuesta_principal'])): ?>
            <div class="summary-diagnosis">
                <h3>Propuesta Principal</h3>
                <p><?php echo nl2br(htmlspecialchars($resumen['propuesta_principal'])); ?></p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Comparativa Antes/Después -->
        <?php if (!empty($comparativa)): ?>
        <section class="comparativa-section">
            <h2>Comparativa: Estructura Actual vs Propuesta</h2>

            <div class="comparison-grid">
                <div class="comparison-col">
                    <h3>Arquitectura Actual</h3>
                    <div class="architecture-box current">
                        <div class="arch-metric">
                            <span class="metric-label">Total URLs:</span>
                            <span class="metric-value"><?php echo number_format($comparativa['actual']['total_urls'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Profundidad media:</span>
                            <span class="metric-value"><?php echo htmlspecialchars($comparativa['actual']['profundidad_media'] ?? 0); ?> clics</span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Niveles jerarquía:</span>
                            <span class="metric-value"><?php echo htmlspecialchars($comparativa['actual']['niveles'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">URLs huérfanas:</span>
                            <span class="metric-value negative"><?php echo number_format($comparativa['actual']['huerfanas'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Crawl efficiency:</span>
                            <span class="metric-value"><?php echo number_format($comparativa['actual']['crawl_efficiency'] ?? 0, 1); ?>%</span>
                        </div>
                    </div>

                    <div class="problemas-actuales">
                        <h4>Problemas Principales</h4>
                        <ul>
                            <?php foreach ($comparativa['actual']['problemas'] ?? [] as $problema): ?>
                            <li><?php echo htmlspecialchars($problema); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="comparison-arrow">
                    <div class="arrow-icon">→</div>
                    <div class="arrow-label">Mejora Propuesta</div>
                </div>

                <div class="comparison-col">
                    <h3>Arquitectura Propuesta</h3>
                    <div class="architecture-box proposed">
                        <div class="arch-metric">
                            <span class="metric-label">Total URLs:</span>
                            <span class="metric-value"><?php echo number_format($comparativa['propuesta']['total_urls'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Profundidad media:</span>
                            <span class="metric-value positive"><?php echo htmlspecialchars($comparativa['propuesta']['profundidad_media'] ?? 0); ?> clics</span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Niveles jerarquía:</span>
                            <span class="metric-value"><?php echo htmlspecialchars($comparativa['propuesta']['niveles'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">URLs huérfanas:</span>
                            <span class="metric-value positive"><?php echo number_format($comparativa['propuesta']['huerfanas'] ?? 0); ?></span>
                        </div>
                        <div class="arch-metric">
                            <span class="metric-label">Crawl efficiency:</span>
                            <span class="metric-value positive"><?php echo number_format($comparativa['propuesta']['crawl_efficiency'] ?? 0, 1); ?>%</span>
                        </div>
                    </div>

                    <div class="mejoras-propuestas">
                        <h4>Mejoras Implementadas</h4>
                        <ul>
                            <?php foreach ($comparativa['propuesta']['mejoras'] ?? [] as $mejora): ?>
                            <li><?php echo htmlspecialchars($mejora); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Estructura Propuesta Detallada -->
        <?php if (!empty($estructura_propuesta)): ?>
        <section class="estructura-propuesta-section">
            <h2>Estructura de Navegación Propuesta</h2>

            <div class="estructura-visual">
                <h3>Mapa de Sitio Propuesto</h3>
                <div class="sitemap-tree">
                    <?php echo $estructura_propuesta['mapa_visual'] ?? ''; ?>
                </div>
            </div>

            <div class="niveles-jerarquia">
                <h3>Distribución por Niveles</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nivel</th>
                            <th>Descripción</th>
                            <th>URLs Actual</th>
                            <th>URLs Propuesto</th>
                            <th>Cambio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estructura_propuesta['niveles'] ?? [] as $nivel): ?>
                        <tr>
                            <td><strong>Nivel <?php echo htmlspecialchars($nivel['numero']); ?></strong></td>
                            <td><?php echo htmlspecialchars($nivel['descripcion']); ?></td>
                            <td><?php echo number_format($nivel['urls_actual']); ?></td>
                            <td><?php echo number_format($nivel['urls_propuesto']); ?></td>
                            <td>
                                <?php
                                $cambio = $nivel['urls_propuesto'] - $nivel['urls_actual'];
                                $clase = $cambio > 0 ? 'positive' : ($cambio < 0 ? 'negative' : 'neutral');
                                $signo = $cambio > 0 ? '+' : '';
                                ?>
                                <span class="cambio-badge <?php echo $clase; ?>">
                                    <?php echo $signo . $cambio; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php endif; ?>

        <!-- Nuevas Categorías Propuestas -->
        <?php if (!empty($nuevas_categorias)): ?>
        <section class="nuevas-categorias-section">
            <h2>Nuevas Categorías y Secciones Propuestas</h2>
            <p class="section-intro">Categorías que deberían crearse para capturar oportunidades de tráfico identificadas en keyword research.</p>

            <?php foreach ($nuevas_categorias as $categoria): ?>
            <div class="categoria-card">
                <div class="categoria-header">
                    <h3><?php echo htmlspecialchars($categoria['nombre']); ?></h3>
                    <span class="priority-badge priority-<?php echo strtolower($categoria['prioridad']); ?>">
                        Prioridad <?php echo htmlspecialchars($categoria['prioridad']); ?>
                    </span>
                </div>
                <div class="categoria-body">
                    <div class="categoria-info">
                        <div class="info-item">
                            <strong>URL propuesta:</strong>
                            <span class="url-text"><?php echo htmlspecialchars($categoria['url']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>Tipo:</strong>
                            <span><?php echo htmlspecialchars($categoria['tipo']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>Nivel jerarquía:</strong>
                            <span><?php echo htmlspecialchars($categoria['nivel']); ?></span>
                        </div>
                    </div>

                    <div class="categoria-keywords">
                        <strong>Keywords objetivo (<?php echo count($categoria['keywords'] ?? []); ?>):</strong>
                        <div class="keywords-list">
                            <?php foreach ($categoria['keywords'] ?? [] as $kw): ?>
                            <span class="keyword-tag">
                                <?php echo htmlspecialchars($kw['keyword']); ?>
                                <small>(<?php echo number_format($kw['volumen']); ?>/mes)</small>
                            </span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="categoria-descripcion">
                        <strong>Descripción:</strong>
                        <p><?php echo nl2br(htmlspecialchars($categoria['descripcion'])); ?></p>
                    </div>

                    <div class="categoria-contenido">
                        <strong>Contenido sugerido:</strong>
                        <ul>
                            <?php foreach ($categoria['contenido_sugerido'] ?? [] as $contenido): ?>
                            <li><?php echo htmlspecialchars($contenido); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="categoria-metrics">
                        <div class="metric-inline">
                            <span class="metric-label">Tráfico estimado:</span>
                            <span class="metric-value"><?php echo number_format($categoria['trafico_estimado']); ?> sesiones/mes</span>
                        </div>
                        <div class="metric-inline">
                            <span class="metric-label">Esfuerzo:</span>
                            <span class="metric-value"><?php echo htmlspecialchars($categoria['esfuerzo']); ?></span>
                        </div>
                        <div class="metric-inline">
                            <span class="metric-label">ROI estimado:</span>
                            <span class="metric-value"><?php echo htmlspecialchars($categoria['roi']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="categorias-summary">
                <p><strong>Impacto total:</strong> Las <?php echo count($nuevas_categorias); ?> nuevas categorías podrían generar <?php echo number_format($resumen['trafico_nuevas_categorias'] ?? 0); ?> sesiones orgánicas adicionales/mes.</p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Mejoras de Navegación -->
        <?php if (!empty($mejoras_navegacion)): ?>
        <section class="mejoras-navegacion-section">
            <h2>Mejoras de Navegación y UX</h2>

            <?php foreach ($mejoras_navegacion as $mejora): ?>
            <div class="mejora-box">
                <div class="mejora-header">
                    <h3><?php echo htmlspecialchars($mejora['titulo'] ?? 'Mejora'); ?></h3>
                </div>
                <div class="mejora-content">
                    <div class="mejora-descripcion">
                        <p><?php echo nl2br(htmlspecialchars($mejora['descripcion'] ?? '')); ?></p>
                    </div>

                    <?php if (!empty($mejora['elementos'])): ?>
                    <div class="mejora-elementos">
                        <strong>Elementos a implementar:</strong>
                        <ul>
                            <?php foreach ($mejora['elementos'] as $elemento): ?>
                            <li><?php echo htmlspecialchars($elemento); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($mejora['ejemplo'])): ?>
                    <div class="mejora-ejemplo">
                        <strong>Ejemplo de implementación:</strong>
                        <pre><?php echo htmlspecialchars($mejora['ejemplo']); ?></pre>
                    </div>
                    <?php endif; ?>

                    <div class="mejora-beneficios">
                        <strong>Beneficios SEO y UX:</strong>
                        <p><?php echo htmlspecialchars($mejora['beneficios'] ?? ''); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <!-- Plan de Implementación -->
        <?php if (!empty($implementacion)): ?>
        <section class="implementacion-section">
            <h2>Plan de Implementación</h2>

            <div class="fases-implementacion">
                <?php foreach ($implementacion['fases'] ?? [] as $fase): ?>
                <div class="fase-implementacion">
                    <div class="fase-numero">Fase <?php echo htmlspecialchars($fase['numero']); ?></div>
                    <div class="fase-content">
                        <h3><?php echo htmlspecialchars($fase['nombre']); ?></h3>
                        <div class="fase-info">
                            <span><strong>Duración:</strong> <?php echo htmlspecialchars($fase['duracion']); ?></span>
                            <span><strong>Recursos:</strong> <?php echo htmlspecialchars($fase['recursos']); ?></span>
                        </div>
                        <div class="fase-tareas">
                            <strong>Tareas principales:</strong>
                            <ol>
                                <?php foreach ($fase['tareas'] ?? [] as $tarea): ?>
                                <li><?php echo htmlspecialchars($tarea); ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                        <?php if (!empty($fase['entregables'])): ?>
                        <div class="fase-entregables">
                            <strong>Entregables:</strong> <?php echo htmlspecialchars(implode(', ', $fase['entregables'])); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="timeline-resumen">
                <h3>Timeline Total</h3>
                <table class="data-table compact">
                    <thead>
                        <tr>
                            <th>Fase</th>
                            <th>Duración</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Dependencias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($implementacion['timeline'] ?? [] as $item): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($item['fase']); ?></strong></td>
                            <td><?php echo htmlspecialchars($item['duracion']); ?></td>
                            <td><?php echo htmlspecialchars($item['inicio']); ?></td>
                            <td><?php echo htmlspecialchars($item['fin']); ?></td>
                            <td><?php echo htmlspecialchars($item['dependencias']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="timeline-total"><strong>Duración total estimada:</strong> <?php echo htmlspecialchars($implementacion['duracion_total'] ?? 'N/A'); ?></p>
            </div>
        </section>
        <?php endif; ?>

        <!-- Impacto Estimado -->
        <?php if (!empty($impacto_estimado)): ?>
        <section class="impacto-section">
            <h2>Impacto Estimado de la Nueva Arquitectura</h2>

            <div class="impacto-grid">
                <div class="impacto-card">
                    <h3>Tráfico Orgánico</h3>
                    <div class="impacto-number">+<?php echo number_format($impacto_estimado['trafico_adicional'] ?? 0); ?></div>
                    <div class="impacto-label">sesiones/mes adicionales</div>
                    <div class="impacto-detail">(+<?php echo htmlspecialchars($impacto_estimado['trafico_porcentaje'] ?? 0); ?>% vs actual)</div>
                </div>

                <div class="impacto-card">
                    <h3>Mejora Rankings</h3>
                    <div class="impacto-number"><?php echo number_format($impacto_estimado['keywords_mejoradas'] ?? 0); ?></div>
                    <div class="impacto-label">keywords con mejora esperada</div>
                    <div class="impacto-detail">Promedio: +<?php echo htmlspecialchars($impacto_estimado['mejora_posiciones'] ?? 0); ?> posiciones</div>
                </div>

                <div class="impacto-card">
                    <h3>Experiencia Usuario</h3>
                    <div class="impacto-number">-<?php echo htmlspecialchars($impacto_estimado['reduccion_clics'] ?? 0); ?></div>
                    <div class="impacto-label">clics promedio para encontrar contenido</div>
                    <div class="impacto-detail">Bounce rate estimado: -<?php echo htmlspecialchars($impacto_estimado['reduccion_bounce'] ?? 0); ?>%</div>
                </div>

                <div class="impacto-card">
                    <h3>Crawl Budget</h3>
                    <div class="impacto-number">+<?php echo htmlspecialchars($impacto_estimado['mejora_crawl'] ?? 0); ?>%</div>
                    <div class="impacto-label">crawl efficiency</div>
                    <div class="impacto-detail">Indexación más rápida de contenido nuevo</div>
                </div>
            </div>

            <div class="impacto-desglose">
                <h3>Desglose de Impacto por Cambio</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Cambio Implementado</th>
                            <th>Impacto en Tráfico</th>
                            <th>Impacto en Rankings</th>
                            <th>Timeframe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($impacto_estimado['desglose'] ?? [] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['cambio']); ?></td>
                            <td>+<?php echo htmlspecialchars($item['impacto_trafico']); ?></td>
                            <td><?php echo htmlspecialchars($item['impacto_rankings']); ?></td>
                            <td><?php echo htmlspecialchars($item['timeframe']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <section class="recommendations-section">
            <h2>Recomendaciones de Implementación</h2>

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
                            <span>Impacto: <?php echo htmlspecialchars($rec['impacto']); ?></span>
                            <?php if (!empty($rec['timeframe'])): ?>
                            <span>Timeframe: <?php echo htmlspecialchars($rec['timeframe']); ?></span>
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
        <div class="footer-center">Propuestas de Arquitectura | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos profesionales para Propuestas Arquitectura - Color corporativo #54a34a */
.propuestas-arquitectura-page {
    font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #333;
    line-height: 1.6;
}

.propuestas-arquitectura-page .page-header {
    border-bottom: 3px solid #54a34a;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.propuestas-arquitectura-page .page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.propuestas-arquitectura-page .page-subtitle {
    font-size: 16px;
    color: #666;
    margin: 0 0 15px 0;
}

.propuestas-arquitectura-page .page-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #888;
}

.propuestas-arquitectura-page section {
    margin-bottom: 40px;
}

.propuestas-arquitectura-page section h2 {
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 15px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #54a34a;
}

.propuestas-arquitectura-page .section-intro {
    color: #666;
    margin-bottom: 20px;
    font-size: 15px;
}

/* Executive Summary */
.propuestas-arquitectura-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.propuestas-arquitectura-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 22px;
    font-weight: 600;
    border: none;
}

.propuestas-arquitectura-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.propuestas-arquitectura-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.propuestas-arquitectura-page .summary-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    opacity: 0.9;
}

.propuestas-arquitectura-page .summary-value {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
}

.propuestas-arquitectura-page .summary-detail {
    font-size: 13px;
    opacity: 0.85;
}

.propuestas-arquitectura-page .summary-diagnosis {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 6px;
    margin-top: 20px;
}

.propuestas-arquitectura-page .summary-diagnosis h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    font-weight: 600;
}

/* Comparativa Antes/Después */
.propuestas-arquitectura-page .comparison-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: center;
    margin: 30px 0;
}

.propuestas-arquitectura-page .comparison-arrow {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.propuestas-arquitectura-page .arrow-icon {
    font-size: 48px;
    color: #54a34a;
    font-weight: bold;
}

.propuestas-arquitectura-page .arrow-label {
    font-size: 13px;
    font-weight: 600;
    color: #54a34a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.propuestas-arquitectura-page .comparison-col h3 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
    text-align: center;
}

.propuestas-arquitectura-page .architecture-box {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.propuestas-arquitectura-page .architecture-box.proposed {
    border-color: #54a34a;
    background: #f0f7ee;
}

.propuestas-arquitectura-page .arch-metric {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.propuestas-arquitectura-page .arch-metric:last-child {
    border-bottom: none;
}

.propuestas-arquitectura-page .metric-label {
    font-size: 14px;
    color: #666;
}

.propuestas-arquitectura-page .metric-value {
    font-weight: 600;
    font-size: 15px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .metric-value.positive {
    color: #2e7d32;
}

.propuestas-arquitectura-page .metric-value.negative {
    color: #c62828;
}

.propuestas-arquitectura-page .problemas-actuales,
.propuestas-arquitectura-page .mejoras-propuestas {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 6px;
}

.propuestas-arquitectura-page .problemas-actuales h4,
.propuestas-arquitectura-page .mejoras-propuestas h4 {
    margin: 0 0 10px 0;
    font-size: 14px;
    font-weight: 600;
    color: #555;
}

.propuestas-arquitectura-page .problemas-actuales ul,
.propuestas-arquitectura-page .mejoras-propuestas ul {
    margin: 0;
    padding-left: 20px;
}

.propuestas-arquitectura-page .problemas-actuales li,
.propuestas-arquitectura-page .mejoras-propuestas li {
    margin-bottom: 6px;
    font-size: 14px;
    line-height: 1.5;
}

/* Tablas */
.propuestas-arquitectura-page .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border: 1px solid #e0e0e0;
}

.propuestas-arquitectura-page .data-table thead {
    background: #f5f5f5;
}

.propuestas-arquitectura-page .data-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #555;
    border-bottom: 2px solid #54a34a;
}

.propuestas-arquitectura-page .data-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e0e0e0;
}

.propuestas-arquitectura-page .data-table tbody tr:hover {
    background: #f9f9f9;
}

.propuestas-arquitectura-page .data-table.compact td,
.propuestas-arquitectura-page .data-table.compact th {
    padding: 8px 12px;
    font-size: 13px;
}

.propuestas-arquitectura-page .cambio-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 600;
}

.propuestas-arquitectura-page .cambio-badge.positive {
    background: #e8f5e9;
    color: #2e7d32;
}

.propuestas-arquitectura-page .cambio-badge.negative {
    background: #ffebee;
    color: #c62828;
}

.propuestas-arquitectura-page .cambio-badge.neutral {
    background: #f5f5f5;
    color: #666;
}

/* Sitemap Tree */
.propuestas-arquitectura-page .sitemap-tree {
    background: #fafafa;
    padding: 20px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.8;
    overflow-x: auto;
    margin: 20px 0;
}

/* Nuevas Categorías Cards */
.propuestas-arquitectura-page .categoria-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #54a34a;
    border-radius: 6px;
    margin-bottom: 25px;
    overflow: hidden;
}

.propuestas-arquitectura-page .categoria-header {
    background: #f0f7ee;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.propuestas-arquitectura-page .categoria-header h3 {
    margin: 0;
    font-size: 18px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .categoria-body {
    padding: 20px;
}

.propuestas-arquitectura-page .categoria-body > div {
    margin-bottom: 15px;
}

.propuestas-arquitectura-page .categoria-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 4px;
}

.propuestas-arquitectura-page .info-item {
    display: flex;
    gap: 10px;
}

.propuestas-arquitectura-page .info-item strong {
    min-width: 120px;
    color: #555;
    font-size: 13px;
}

.propuestas-arquitectura-page .url-text {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .keywords-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 8px;
}

.propuestas-arquitectura-page .keyword-tag {
    background: #f0f7ee;
    border: 1px solid #54a34a;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .keyword-tag small {
    color: #666;
    font-size: 11px;
}

.propuestas-arquitectura-page .categoria-metrics {
    display: flex;
    gap: 25px;
    padding-top: 15px;
    border-top: 1px solid #e0e0e0;
}

.propuestas-arquitectura-page .metric-inline {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.propuestas-arquitectura-page .metric-inline .metric-label {
    font-size: 12px;
    color: #666;
}

.propuestas-arquitectura-page .metric-inline .metric-value {
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .categorias-summary {
    background: #f0f7ee;
    padding: 15px 20px;
    border-left: 4px solid #54a34a;
    margin-top: 20px;
    border-radius: 4px;
}

/* Mejoras de Navegación */
.propuestas-arquitectura-page .mejora-box {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 20px;
    overflow: hidden;
}

.propuestas-arquitectura-page .mejora-header {
    background: #f5f5f5;
    padding: 15px 20px;
}

.propuestas-arquitectura-page .mejora-header h3 {
    margin: 0;
    font-size: 16px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .mejora-content {
    padding: 20px;
}

.propuestas-arquitectura-page .mejora-content > div {
    margin-bottom: 15px;
}

.propuestas-arquitectura-page .mejora-ejemplo pre {
    background: #fafafa;
    border: 1px solid #e0e0e0;
    padding: 15px;
    border-radius: 4px;
    overflow-x: auto;
    font-size: 12px;
    line-height: 1.5;
}

/* Plan de Implementación */
.propuestas-arquitectura-page .fase-implementacion {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
}

.propuestas-arquitectura-page .fase-numero {
    min-width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    text-align: center;
    line-height: 1.3;
}

.propuestas-arquitectura-page .fase-content {
    flex: 1;
}

.propuestas-arquitectura-page .fase-content h3 {
    margin: 0 0 10px 0;
    font-size: 18px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .fase-info {
    display: flex;
    gap: 25px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #666;
}

.propuestas-arquitectura-page .fase-tareas ol {
    margin: 5px 0 0 0;
    padding-left: 20px;
}

.propuestas-arquitectura-page .fase-tareas li {
    margin-bottom: 6px;
    line-height: 1.5;
}

.propuestas-arquitectura-page .fase-entregables {
    margin-top: 10px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 4px;
    font-size: 13px;
}

.propuestas-arquitectura-page .timeline-total {
    margin-top: 15px;
    padding: 12px;
    background: #f0f7ee;
    border-left: 3px solid #54a34a;
    border-radius: 4px;
}

/* Impacto Estimado */
.propuestas-arquitectura-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin: 20px 0 30px 0;
}

.propuestas-arquitectura-page .impacto-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #54a34a;
    padding: 20px;
    border-radius: 6px;
    text-align: center;
}

.propuestas-arquitectura-page .impacto-card h3 {
    margin: 0 0 15px 0;
    font-size: 14px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.propuestas-arquitectura-page .impacto-number {
    font-size: 36px;
    font-weight: 700;
    color: #54a34a;
    margin-bottom: 5px;
}

.propuestas-arquitectura-page .impacto-label {
    font-size: 13px;
    color: #666;
    margin-bottom: 8px;
}

.propuestas-arquitectura-page .impacto-detail {
    font-size: 12px;
    color: #888;
}

/* Badges */
.propuestas-arquitectura-page .priority-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.propuestas-arquitectura-page .priority-badge.priority-a {
    background: #ffebee;
    color: #c62828;
}

.propuestas-arquitectura-page .priority-badge.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.propuestas-arquitectura-page .priority-badge.priority-c {
    background: #e3f2fd;
    color: #1565c0;
}

/* Recommendations */
.propuestas-arquitectura-page .priority-group {
    margin-bottom: 30px;
}

.propuestas-arquitectura-page .priority-header {
    background: #f5f5f5;
    padding: 12px 20px;
    margin: 0 0 15px 0;
    border-radius: 4px;
    font-size: 16px;
}

.propuestas-arquitectura-page .priority-header.priority-a {
    background: #ffebee;
    color: #c62828;
}

.propuestas-arquitectura-page .priority-header.priority-b {
    background: #fff3e0;
    color: #ef6c00;
}

.propuestas-arquitectura-page .priority-header.priority-c {
    background: #e3f2fd;
    color: #1565c0;
}

.propuestas-arquitectura-page .recommendation-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 3px solid #54a34a;
    padding: 15px 20px;
    margin-bottom: 12px;
    border-radius: 4px;
}

.propuestas-arquitectura-page .rec-title {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.propuestas-arquitectura-page .rec-description {
    margin-bottom: 10px;
    color: #555;
    line-height: 1.6;
}

.propuestas-arquitectura-page .rec-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 12px;
    color: #888;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}

/* Page Footer */
.propuestas-arquitectura-page .page-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #888;
}

@media print {
    .propuestas-arquitectura-page {
        page-break-before: always;
    }

    .propuestas-arquitectura-page .categoria-card,
    .propuestas-arquitectura-page .mejora-box,
    .propuestas-arquitectura-page .fase-implementacion,
    .propuestas-arquitectura-page .recommendation-item {
        page-break-inside: avoid;
    }

    .propuestas-arquitectura-page .comparison-grid {
        grid-template-columns: 1fr;
    }

    .propuestas-arquitectura-page .comparison-arrow {
        display: none;
    }
}

@media (max-width: 1200px) {
    .propuestas-arquitectura-page .comparison-grid {
        grid-template-columns: 1fr;
    }

    .propuestas-arquitectura-page .comparison-arrow {
        transform: rotate(90deg);
        margin: 20px 0;
    }
}
</style>
