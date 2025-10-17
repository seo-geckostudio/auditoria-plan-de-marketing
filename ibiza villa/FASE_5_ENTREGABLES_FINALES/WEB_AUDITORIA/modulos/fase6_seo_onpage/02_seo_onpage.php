<?php
/**
 * Módulo: SEO On-Page (m6.1)
 * Fase: 6 - SEO On-Page
 * Análisis detallado por áreas con hallazgos específicos
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$areas = $datosModulo['areas_analizadas'] ?? [];
?>

<!-- Página 1: Portada SEO On-Page -->
<div class="audit-page onpage-cover">
    <div class="cover-content">
        <div class="cover-badge">Sección 6</div>
        <h1 class="cover-title">Análisis SEO On-Page</h1>
        <p class="cover-subtitle">Análisis Técnico Detallado de Optimización Interna</p>

        <div class="cover-stats">
            <div class="stat-item">
                <div class="stat-number"><?php echo number_format($resumen['paginas_rastreadas'] ?? 0); ?></div>
                <div class="stat-label">Páginas Analizadas</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo count($areas); ?></div>
                <div class="stat-label">Áreas de Análisis</div>
            </div>
            <div class="stat-item highlight">
                <div class="stat-number"><?php echo ($resumen['hallazgos_totales']['total_issues'] ?? 0); ?></div>
                <div class="stat-label">Issues Detectados</div>
            </div>
        </div>

        <div class="cover-areas">
            <h2>Áreas Analizadas</h2>
            <div class="areas-grid">
                <?php foreach ($areas as $area): ?>
                <div class="area-card" style="border-left-color: <?php echo $area['color'] ?? '#667eea'; ?>">
                    <div class="area-name"><?php echo htmlspecialchars($area['nombre'] ?? ''); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.onpage-cover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cover-content {
    width: 100%;
    max-width: 1000px;
}

.cover-badge {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0.8;
    margin-bottom: 20px;
    text-align: center;
}

.cover-title {
    font-size: 56px;
    font-weight: 800;
    margin: 0 0 15px 0;
    text-align: center;
    line-height: 1.1;
}

.cover-subtitle {
    font-size: 20px;
    text-align: center;
    opacity: 0.9;
    margin-bottom: 50px;
}

.cover-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 50px;
}

.stat-item {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
}

.stat-item.highlight {
    background: rgba(255,255,255,0.25);
}

.stat-number {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
}

.cover-areas {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
}

.cover-areas h2 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 25px 0;
    text-align: center;
}

.areas-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.area-card {
    background: rgba(255,255,255,0.2);
    border-left: 4px solid;
    border-radius: 8px;
    padding: 15px 20px;
}

.area-name {
    font-size: 15px;
    font-weight: 600;
}
</style>

<?php
// Página 2: Resumen Ejecutivo
?>
<div class="audit-page onpage-summary">
    <div class="page-header">
        <h1>Resumen Ejecutivo</h1>
        <p class="subtitle">Visión General del Análisis SEO On-Page</p>
    </div>

    <div class="page-content">
        <div class="summary-card">
            <h2>Alcance de la Auditoría</h2>
            <div class="summary-grid">
                <div class="summary-item">
                    <span class="label">URL Auditada:</span>
                    <strong><?php echo htmlspecialchars($resumen['url_auditada'] ?? ''); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Páginas Rastreadas:</span>
                    <strong><?php echo number_format($resumen['paginas_rastreadas'] ?? 0); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Metodología:</span>
                    <strong><?php echo htmlspecialchars($resumen['metodologia'] ?? ''); ?></strong>
                </div>
                <div class="summary-item">
                    <span class="label">Fecha:</span>
                    <strong><?php echo htmlspecialchars($resumen['fecha_auditoria'] ?? ''); ?></strong>
                </div>
            </div>
        </div>

        <div class="hallazgos-summary">
            <h2>Distribución de Hallazgos</h2>
            <div class="hallazgos-grid">
                <div class="hallazgo-card criticos">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['criticos'] ?? 0; ?></div>
                    <div class="label">Críticos</div>
                    <div class="description">Requieren atención inmediata</div>
                </div>
                <div class="hallazgo-card importantes">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['importantes'] ?? 0; ?></div>
                    <div class="label">Importantes</div>
                    <div class="description">Alto impacto en SEO</div>
                </div>
                <div class="hallazgo-card menores">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['menores'] ?? 0; ?></div>
                    <div class="label">Menores</div>
                    <div class="description">Optimizaciones recomendadas</div>
                </div>
                <div class="hallazgo-card total">
                    <div class="number"><?php echo $resumen['hallazgos_totales']['total_issues'] ?? 0; ?></div>
                    <div class="label">Total Issues</div>
                    <div class="description">Oportunidades de mejora</div>
                </div>
            </div>
        </div>

        <div class="areas-index">
            <h2>Índice de Áreas Analizadas</h2>
            <p class="index-intro">Cada área contiene un análisis detallado con hallazgos específicos, ejemplos reales y recomendaciones priorizadas:</p>
            <div class="index-list">
                <?php foreach ($areas as $index => $area): ?>
                <div class="index-item">
                    <div class="index-number"><?php echo $index + 1; ?></div>
                    <div class="index-content">
                        <div class="index-title" style="color: <?php echo $area['color'] ?? '#667eea'; ?>">
                            <?php echo htmlspecialchars($area['nombre'] ?? ''); ?>
                        </div>
                        <div class="index-metrics">
                            <?php
                            $metricas = $area['metricas'] ?? [];
                            $count = 0;
                            foreach ($metricas as $key => $value):
                                if ($count >= 2) break;
                                $count++;
                            ?>
                            <span><?php echo ucfirst(str_replace('_', ' ', $key)); ?>: <strong><?php echo is_numeric($value) ? number_format($value) : $value; ?></strong></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="index-pages">Página <?php echo $index + 3; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.onpage-summary {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-header h1 {
    font-size: 42px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.subtitle {
    font-size: 18px;
    color: #718096;
    margin: 0;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.summary-card h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.summary-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.summary-item .label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.summary-item strong {
    font-size: 15px;
    color: #2d3748;
}

.hallazgos-summary {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.hallazgos-summary h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.hallazgos-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.hallazgo-card {
    border-radius: 12px;
    padding: 25px 20px;
    text-align: center;
}

.hallazgo-card.criticos {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
}

.hallazgo-card.importantes {
    background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
}

.hallazgo-card.menores {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
}

.hallazgo-card.total {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.hallazgo-card .number {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 8px;
}

.hallazgo-card.criticos .number { color: #991b1b; }
.hallazgo-card.importantes .number { color: #92400e; }
.hallazgo-card.menores .number { color: #854d0e; }

.hallazgo-card .label {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.hallazgo-card.criticos .label { color: #991b1b; }
.hallazgo-card.importantes .label { color: #92400e; }
.hallazgo-card.menores .label { color: #854d0e; }

.hallazgo-card .description {
    font-size: 11px;
    opacity: 0.8;
    margin-top: 4px;
}

.hallazgo-card.criticos .description { color: #7f1d1d; }
.hallazgo-card.importantes .description { color: #78350f; }
.hallazgo-card.menores .description { color: #713f12; }

.areas-index {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
}

.areas-index h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.index-intro {
    font-size: 14px;
    color: #718096;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.index-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.index-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px 20px;
    background: #f7fafc;
    border-radius: 10px;
    transition: all 0.2s;
}

.index-item:hover {
    background: #edf2f7;
    transform: translateX(4px);
}

.index-number {
    font-size: 20px;
    font-weight: 800;
    color: white;
    background: #667eea;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.index-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.index-title {
    font-size: 16px;
    font-weight: 700;
}

.index-metrics {
    font-size: 12px;
    color: #718096;
    display: flex;
    gap: 15px;
}

.index-pages {
    font-size: 13px;
    color: #a0aec0;
    font-weight: 600;
    flex-shrink: 0;
}
</style>

<?php
// Páginas de Análisis Detallado por Área
$pagina_numero = 3;

foreach ($areas as $area):
?>

<!-- Análisis Detallado: <?php echo htmlspecialchars($area['nombre'] ?? ''); ?> -->
<div class="audit-page area-analysis">
    <div class="area-header" style="background: linear-gradient(135deg, <?php echo $area['color'] ?? '#667eea'; ?> 0%, <?php echo $area['color'] ?? '#764ba2'; ?>dd 100%);">
        <div class="area-badge">Análisis Detallado</div>
        <h1 class="area-title"><?php echo htmlspecialchars($area['nombre'] ?? ''); ?></h1>
        <div class="area-metrics-header">
            <?php
            $metricas = $area['metricas'] ?? [];
            foreach ($metricas as $key => $value):
            ?>
            <div class="metric-header-item">
                <div class="metric-value"><?php echo is_numeric($value) ? number_format($value) : htmlspecialchars($value); ?></div>
                <div class="metric-label"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="area-content">
        <!-- Hallazgos -->
        <div class="hallazgos-section">
            <h2>Hallazgos Identificados</h2>
            <?php
            $hallazgos = $area['hallazgos'] ?? [];
            foreach ($hallazgos as $hallazgo):
                $tipo_class = $hallazgo['tipo'] ?? 'menor';
            ?>
            <div class="hallazgo-detail <?php echo $tipo_class; ?>">
                <div class="hallazgo-header">
                    <div class="hallazgo-tipo-badge <?php echo $tipo_class; ?>">
                        <?php echo ucfirst($hallazgo['tipo'] ?? ''); ?>
                    </div>
                    <?php if (isset($hallazgo['cantidad']) && $hallazgo['cantidad'] !== null): ?>
                    <div class="hallazgo-cantidad">
                        <?php echo number_format($hallazgo['cantidad']); ?> ocurrencias
                    </div>
                    <?php endif; ?>
                </div>

                <h3 class="hallazgo-titulo"><?php echo htmlspecialchars($hallazgo['titulo'] ?? ''); ?></h3>

                <div class="hallazgo-descripcion">
                    <?php echo htmlspecialchars($hallazgo['descripcion'] ?? ''); ?>
                </div>

                <?php if (!empty($hallazgo['ejemplos'])): ?>
                <div class="hallazgo-ejemplos">
                    <strong>Ejemplos detectados:</strong>
                    <ul>
                        <?php foreach ($hallazgo['ejemplos'] as $ejemplo): ?>
                        <li><code><?php echo htmlspecialchars($ejemplo); ?></code></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (!empty($hallazgo['causas'])): ?>
                <div class="hallazgo-causas">
                    <strong>Causas identificadas:</strong>
                    <ul>
                        <?php foreach ($hallazgo['causas'] as $causa): ?>
                        <li><?php echo htmlspecialchars($causa); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="hallazgo-impacto">
                    <span class="impacto-label">Impacto:</span>
                    <?php echo htmlspecialchars($hallazgo['impacto'] ?? ''); ?>
                </div>

                <div class="hallazgo-recomendacion">
                    <span class="rec-label">Recomendación:</span>
                    <?php echo htmlspecialchars($hallazgo['recomendacion'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Ejemplos de Optimización -->
        <?php if (!empty($area['ejemplos_optimizacion'])): ?>
        <div class="optimizacion-section">
            <h2>Ejemplos de Optimización</h2>
            <?php foreach ($area['ejemplos_optimizacion'] as $ejemplo): ?>
            <div class="ejemplo-card">
                <div class="ejemplo-tipo"><?php echo htmlspecialchars($ejemplo['tipo'] ?? ''); ?></div>
                <div class="ejemplo-comparison">
                    <div class="ejemplo-actual">
                        <span class="ejemplo-label">Actual:</span>
                        <code><?php echo htmlspecialchars($ejemplo['actual'] ?? ''); ?></code>
                        <?php if (isset($ejemplo['caracteres_actual'])): ?>
                        <span class="ejemplo-chars">(<?php echo $ejemplo['caracteres_actual']; ?> caracteres)</span>
                        <?php endif; ?>
                    </div>
                    <div class="ejemplo-arrow">→</div>
                    <div class="ejemplo-propuesto">
                        <span class="ejemplo-label">Propuesto:</span>
                        <code><?php echo htmlspecialchars($ejemplo['propuesto'] ?? ''); ?></code>
                        <?php if (isset($ejemplo['caracteres_propuesto'])): ?>
                        <span class="ejemplo-chars">(<?php echo $ejemplo['caracteres_propuesto']; ?> caracteres)</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ejemplo-mejora">
                    <strong>Mejora:</strong> <?php echo htmlspecialchars($ejemplo['mejora'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Oportunidades de Optimización -->
        <?php if (!empty($area['oportunidades_optimizacion'])): ?>
        <div class="oportunidades-section">
            <h2>Oportunidades de Optimización</h2>
            <div class="oportunidades-grid">
                <?php foreach ($area['oportunidades_optimizacion'] as $oportunidad): ?>
                <div class="oportunidad-card">
                    <div class="oportunidad-header">
                        <span class="oportunidad-prioridad <?php echo strtolower($oportunidad['prioridad'] ?? 'media'); ?>">
                            <?php echo ucfirst($oportunidad['prioridad'] ?? 'Media'); ?>
                        </span>
                        <span class="oportunidad-ahorro"><?php echo htmlspecialchars($oportunidad['ahorro_tiempo'] ?? ''); ?></span>
                    </div>
                    <div class="oportunidad-accion"><?php echo htmlspecialchars($oportunidad['accion'] ?? ''); ?></div>
                    <div class="oportunidad-complejidad">Complejidad: <?php echo htmlspecialchars($oportunidad['complejidad'] ?? ''); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Schemas Recomendados -->
        <?php if (!empty($area['schemas_recomendados'])): ?>
        <div class="schemas-section">
            <h2>Schemas Recomendados</h2>
            <?php foreach ($area['schemas_recomendados'] as $schema): ?>
            <div class="schema-card">
                <div class="schema-header">
                    <span class="schema-tipo"><?php echo htmlspecialchars($schema['tipo'] ?? ''); ?></span>
                    <span class="schema-prioridad <?php echo strtolower($schema['prioridad'] ?? 'media'); ?>">
                        Prioridad: <?php echo ucfirst($schema['prioridad'] ?? 'Media'); ?>
                    </span>
                </div>
                <div class="schema-paginas"><?php echo htmlspecialchars($schema['paginas'] ?? ''); ?></div>
                <div class="schema-beneficio">
                    <strong>Beneficio:</strong> <?php echo htmlspecialchars($schema['beneficio'] ?? ''); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Recomendaciones Prioritarias -->
        <div class="recomendaciones-section">
            <h2>Plan de Acción Priorizado</h2>
            <div class="recomendaciones-list">
                <?php
                $prioridades = $area['recomendaciones_prioritarias'] ?? [];
                foreach ($prioridades as $index => $recomendacion):
                ?>
                <div class="recomendacion-item">
                    <div class="rec-numero"><?php echo $index + 1; ?></div>
                    <div class="rec-texto"><?php echo htmlspecialchars($recomendacion); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Impacto Estimado -->
        <?php if (!empty($area['impacto_estimado'])): ?>
        <div class="impacto-final">
            <div class="impacto-icon">📈</div>
            <div class="impacto-content">
                <strong>Impacto Estimado de las Optimizaciones:</strong>
                <p><?php echo htmlspecialchars($area['impacto_estimado']); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis SEO On-Page - <?php echo htmlspecialchars($area['nombre'] ?? ''); ?></span>
        <span class="page-number">Página <?php echo $pagina_numero; ?></span>
    </div>
</div>

<?php
$pagina_numero++;
endforeach;
?>

<style>
.area-analysis {
    background: #f7fafc;
    padding: 0;
    min-height: 100vh;
}

.area-header {
    color: white;
    padding: 40px 50px;
    border-radius: 0;
}

.area-badge {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    opacity: 0.9;
    margin-bottom: 15px;
    font-weight: 600;
}

.area-title {
    font-size: 38px;
    font-weight: 800;
    margin: 0 0 30px 0;
}

.area-metrics-header {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
}

.metric-header-item {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 15px 20px;
    text-align: center;
}

.metric-value {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 5px;
}

.metric-label {
    font-size: 12px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.area-content {
    padding: 40px 50px;
}

.area-content h2 {
    font-size: 28px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 700;
}

.hallazgos-section {
    margin-bottom: 40px;
}

.hallazgo-detail {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border-left: 6px solid;
}

.hallazgo-detail.critico { border-left-color: #dc2626; }
.hallazgo-detail.importante { border-left-color: #f59e0b; }
.hallazgo-detail.menor { border-left-color: #eab308; }

.hallazgo-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.hallazgo-tipo-badge {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hallazgo-tipo-badge.critico {
    background: #fee2e2;
    color: #991b1b;
}

.hallazgo-tipo-badge.importante {
    background: #fed7aa;
    color: #92400e;
}

.hallazgo-tipo-badge.menor {
    background: #fef3c7;
    color: #854d0e;
}

.hallazgo-cantidad {
    font-size: 13px;
    color: #718096;
    font-weight: 600;
}

.hallazgo-titulo {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.hallazgo-descripcion {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.7;
    margin-bottom: 15px;
}

.hallazgo-ejemplos,
.hallazgo-causas {
    background: #f7fafc;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
}

.hallazgo-ejemplos strong,
.hallazgo-causas strong {
    display: block;
    font-size: 13px;
    color: #2d3748;
    margin-bottom: 10px;
}

.hallazgo-ejemplos ul,
.hallazgo-causas ul {
    margin: 0;
    padding-left: 20px;
}

.hallazgo-ejemplos li,
.hallazgo-causas li {
    font-size: 13px;
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 8px;
}

.hallazgo-ejemplos code {
    background: #e2e8f0;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
    color: #1e293b;
    word-break: break-all;
}

.hallazgo-impacto {
    background: #fef3c7;
    border-left: 3px solid #f59e0b;
    padding: 12px 15px;
    border-radius: 6px;
    font-size: 13px;
    color: #78350f;
    margin-bottom: 12px;
    line-height: 1.6;
}

.impacto-label {
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;
}

.hallazgo-recomendacion {
    background: #dcfce7;
    border-left: 3px solid #10b981;
    padding: 12px 15px;
    border-radius: 6px;
    font-size: 13px;
    color: #065f46;
    line-height: 1.6;
}

.rec-label {
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;
}

.optimizacion-section,
.oportunidades-section,
.schemas-section,
.recomendaciones-section {
    margin-bottom: 40px;
}

.ejemplo-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.ejemplo-tipo {
    font-size: 14px;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 15px;
}

.ejemplo-comparison {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 20px;
    align-items: center;
    margin-bottom: 15px;
}

.ejemplo-actual,
.ejemplo-propuesto {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ejemplo-label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.ejemplo-actual code {
    background: #fee2e2;
    color: #991b1b;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    display: block;
    word-break: break-word;
}

.ejemplo-propuesto code {
    background: #dcfce7;
    color: #065f46;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    display: block;
    word-break: break-word;
}

.ejemplo-chars {
    font-size: 11px;
    color: #a0aec0;
}

.ejemplo-arrow {
    font-size: 24px;
    color: #667eea;
    font-weight: bold;
}

.ejemplo-mejora {
    font-size: 13px;
    color: #4a5568;
    background: #f7fafc;
    padding: 10px 15px;
    border-radius: 6px;
}

.oportunidades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.oportunidad-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.oportunidad-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.oportunidad-prioridad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.oportunidad-prioridad.alta {
    background: #fee2e2;
    color: #991b1b;
}

.oportunidad-prioridad.media {
    background: #fed7aa;
    color: #92400e;
}

.oportunidad-prioridad.baja {
    background: #fef3c7;
    color: #854d0e;
}

.oportunidad-ahorro {
    font-size: 16px;
    font-weight: 700;
    color: #10b981;
}

.oportunidad-accion {
    font-size: 15px;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 10px;
}

.oportunidad-complejidad {
    font-size: 12px;
    color: #718096;
}

.schemas-section {
    margin-bottom: 40px;
}

.schema-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.schema-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.schema-tipo {
    font-size: 16px;
    font-weight: 700;
    color: #667eea;
}

.schema-prioridad {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.schema-prioridad.alta {
    background: #fee2e2;
    color: #991b1b;
}

.schema-prioridad.media {
    background: #fed7aa;
    color: #92400e;
}

.schema-prioridad.baja {
    background: #fef3c7;
    color: #854d0e;
}

.schema-paginas {
    font-size: 13px;
    color: #718096;
    margin-bottom: 8px;
}

.schema-beneficio {
    font-size: 14px;
    color: #4a5568;
}

.recomendaciones-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.recomendacion-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    background: white;
    border-radius: 12px;
    padding: 18px 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.rec-numero {
    font-size: 18px;
    font-weight: 800;
    color: white;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.rec-texto {
    font-size: 14px;
    color: #2d3748;
    line-height: 1.7;
    flex: 1;
}

.impacto-final {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    border-radius: 12px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.15);
}

.impacto-icon {
    font-size: 48px;
}

.impacto-content {
    flex: 1;
}

.impacto-content strong {
    display: block;
    font-size: 18px;
    color: #065f46;
    margin-bottom: 8px;
}

.impacto-content p {
    font-size: 15px;
    color: #047857;
    margin: 0;
    line-height: 1.6;
}

.page-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    border-top: 2px solid #e2e8f0;
    font-size: 13px;
    color: #718096;
}

.page-number {
    font-weight: 600;
}
</style>
