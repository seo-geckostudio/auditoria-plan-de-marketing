<?php
/**
 * Módulo: Entidades y Knowledge Graph (m9.6)
 * Fase: 9 - SEO Moderno
 * Descripción: Optimización para entidades, Knowledge Panel y entity-based SEO
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$knowledge_panel = $datosModulo['knowledge_panel'] ?? [];
$entidades_principales = $datosModulo['entidades_principales'] ?? [];
$relaciones = $datosModulo['grafo_relaciones'] ?? [];
$menciones_externas = $datosModulo['menciones_externas'] ?? [];
$schema_implementado = $datosModulo['schema_implementado'] ?? [];
$optimizaciones = $datosModulo['optimizaciones'] ?? [];
$estrategia_entidades = $datosModulo['estrategia_entidades'] ?? [];
?>

<style>
.entidades-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.entidades-page .executive-summary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.entidades-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.entidades-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.entidades-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.entidades-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.entidades-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.entidades-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #f5576c;
}

.entidades-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #f5576c;
    font-size: 20px;
    font-weight: 600;
}

.entidades-page .kp-status {
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.entidades-page .kp-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.entidades-page .kp-status-badge {
    padding: 8px 16px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 600;
}

.entidades-page .kp-status-badge.activo {
    background: #d4edda;
    color: #155724;
}

.entidades-page .kp-status-badge.inactivo {
    background: #f8d7da;
    color: #721c24;
}

.entidades-page .kp-status-badge.parcial {
    background: #fff3cd;
    color: #856404;
}

.entidades-page .kp-preview {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-top: 15px;
}

.entidades-page .kp-field {
    margin: 12px 0;
    font-size: 14px;
}

.entidades-page .kp-field-label {
    font-weight: 600;
    color: #6c757d;
    margin-right: 8px;
}

.entidades-page .entity-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 3px solid #f5576c;
}

.entidades-page .entity-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
}

.entidades-page .entity-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 18px;
}

.entidades-page .entity-type {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    background: #f5576c;
    color: white;
}

.entidades-page .entity-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    margin-top: 12px;
}

.entidades-page .entity-metric {
    font-size: 13px;
}

.entidades-page .entity-metric-label {
    color: #6c757d;
    font-weight: 500;
}

.entidades-page .entity-metric-value {
    color: #2c3e50;
    font-weight: 600;
}

.entidades-page .relationship-diagram {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin: 20px 0;
    text-align: center;
}

.entidades-page .relationship-node {
    display: inline-block;
    background: #f8f9fa;
    border: 2px solid #f5576c;
    border-radius: 8px;
    padding: 15px 20px;
    margin: 10px;
    font-weight: 600;
    position: relative;
}

.entidades-page .relationship-node.central {
    background: #f5576c;
    color: white;
    font-size: 18px;
}

.entidades-page .mention-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
}

.entidades-page .mention-source {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.entidades-page .mention-authority {
    display: inline-block;
    background: #f5576c;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 10px;
}

.entidades-page .mention-context {
    background: #f8f9fa;
    border-left: 3px solid #f5576c;
    padding: 10px;
    margin-top: 8px;
    font-size: 13px;
    font-style: italic;
}

.entidades-page .schema-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.entidades-page .schema-table th,
.entidades-page .schema-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.entidades-page .schema-table th {
    background: #fff0f3;
    color: #f5576c;
    font-weight: 600;
    font-size: 14px;
}

.entidades-page .schema-table tr:hover {
    background: #fafafa;
}

.entidades-page .implementation-status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
}

.entidades-page .implementation-status.implementado {
    background: #d4edda;
    color: #155724;
}

.entidades-page .implementation-status.pendiente {
    background: #f8d7da;
    color: #721c24;
}

.entidades-page .optimization-item {
    background: #fff9e6;
    border: 1px solid #ffc107;
    border-radius: 6px;
    padding: 18px;
    margin-bottom: 15px;
    border-left: 4px solid #ffc107;
}

.entidades-page .optimization-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.entidades-page .priority-tag {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-right: 8px;
}

.entidades-page .priority-tag.alta {
    background: #dc3545;
    color: white;
}

.entidades-page .priority-tag.media {
    background: #ffc107;
    color: #333;
}

.entidades-page .priority-tag.baja {
    background: #6c757d;
    color: white;
}

.entidades-page .action-steps {
    margin: 12px 0;
    padding-left: 20px;
}

.entidades-page .action-steps li {
    margin: 6px 0;
    font-size: 14px;
}

.entidades-page .strategy-timeline {
    margin-top: 20px;
}

.entidades-page .timeline-item {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 4px solid #f5576c;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    position: relative;
}

.entidades-page .timeline-phase {
    font-weight: 600;
    color: #f5576c;
    font-size: 16px;
    margin-bottom: 8px;
}

.entidades-page .timeline-duration {
    display: inline-block;
    background: #f5576c;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
}

@media print {
    .entidades-page .content-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page entidades-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Entidades y Knowledge Graph'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para Knowledge Panel y entity-based SEO'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Establecer marca como entidad reconocida</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Knowledge Panel</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['knowledge_panel_status'] ?? 'NO'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Entidades Detectadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['entidades_detectadas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Menciones Externas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['menciones_externas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Score Autoridad</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['score_autoridad'] ?? '0'); ?>/100</div>
            </div>
        </div>
    </div>

    <!-- Knowledge Panel Status -->
    <div class="content-section">
        <h3>Estado del Knowledge Panel</h3>

        <div class="kp-status">
            <div class="kp-header">
                <div>
                    <h4 style="margin: 0; color: #2c3e50;">Google Knowledge Panel</h4>
                    <p style="margin: 5px 0 0 0; font-size: 14px; color: #6c757d;">
                        Panel informativo que aparece en búsquedas de marca
                    </p>
                </div>
                <span class="kp-status-badge <?php echo strtolower($knowledge_panel['estado'] ?? 'inactivo'); ?>">
                    <?php echo htmlspecialchars($knowledge_panel['estado'] ?? 'Inactivo'); ?>
                </span>
            </div>

            <?php if (!empty($knowledge_panel['datos_actuales'])): ?>
            <div class="kp-preview">
                <h5 style="margin: 0 0 15px 0; color: #2c3e50;">Datos Actuales en Knowledge Panel</h5>
                <?php foreach ($knowledge_panel['datos_actuales'] as $field => $value): ?>
                <div class="kp-field">
                    <span class="kp-field-label"><?php echo htmlspecialchars($field); ?>:</span>
                    <span><?php echo htmlspecialchars($value); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($knowledge_panel['recomendacion'])): ?>
            <div style="background: #e8f5e9; border-left: 3px solid #4caf50; padding: 12px; margin-top: 15px; border-radius: 4px;">
                <strong>Recomendación:</strong> <?php echo htmlspecialchars($knowledge_panel['recomendacion']); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Entidades Principales -->
    <div class="content-section">
        <h3>Entidades Principales Identificadas</h3>
        <p>Entidades reconocidas por Google en relación con la marca y contenido.</p>

        <?php foreach ($entidades_principales ?? [] as $entity): ?>
        <div class="entity-card">
            <div class="entity-header">
                <div class="entity-name"><?php echo htmlspecialchars($entity['nombre'] ?? ''); ?></div>
                <span class="entity-type"><?php echo htmlspecialchars($entity['tipo'] ?? ''); ?></span>
            </div>

            <p style="margin: 10px 0; font-size: 14px; color: #6c757d;">
                <?php echo htmlspecialchars($entity['descripcion'] ?? ''); ?>
            </p>

            <div class="entity-details">
                <div class="entity-metric">
                    <span class="entity-metric-label">Menciones:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['menciones'] ?? '0'); ?></span>
                </div>
                <div class="entity-metric">
                    <span class="entity-metric-label">Relevancia:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['relevancia'] ?? 'N/A'); ?></span>
                </div>
                <div class="entity-metric">
                    <span class="entity-metric-label">Contexto:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['contexto'] ?? 'N/A'); ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Grafo de Relaciones -->
    <?php if (!empty($relaciones)): ?>
    <div class="content-section">
        <h3>Grafo de Relaciones de Entidades</h3>
        <p>Red de conexiones entre la marca y otras entidades relevantes.</p>

        <div class="relationship-diagram">
            <div style="margin-bottom: 30px;">
                <div class="relationship-node central">
                    <?php echo htmlspecialchars($relaciones['entidad_central'] ?? 'Ibiza Villa'); ?>
                </div>
            </div>

            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px;">
                <?php foreach ($relaciones['relaciones'] ?? [] as $rel): ?>
                <div style="text-align: center;">
                    <div class="relationship-node">
                        <?php echo htmlspecialchars($rel['entidad'] ?? ''); ?>
                    </div>
                    <div style="font-size: 12px; color: #6c757d; margin-top: 5px;">
                        <?php echo htmlspecialchars($rel['tipo_relacion'] ?? ''); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Menciones Externas -->
    <?php if (!empty($menciones_externas)): ?>
    <div class="content-section">
        <h3>Menciones Externas de Marca</h3>
        <p>Referencias a la marca en sitios externos que refuerzan la identidad de entidad.</p>

        <?php foreach ($menciones_externas as $mention): ?>
        <div class="mention-card">
            <div class="mention-source">
                <?php echo htmlspecialchars($mention['fuente'] ?? ''); ?>
                <span class="mention-authority">DA <?php echo htmlspecialchars($mention['domain_authority'] ?? '0'); ?></span>
            </div>
            <div style="font-size: 13px; color: #6c757d; margin: 5px 0;">
                <strong>URL:</strong> <?php echo htmlspecialchars($mention['url'] ?? ''); ?>
            </div>
            <?php if (isset($mention['contexto'])): ?>
            <div class="mention-context">
                "<?php echo htmlspecialchars($mention['contexto']); ?>"
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Schema Implementado -->
    <?php if (!empty($schema_implementado)): ?>
    <div class="content-section">
        <h3>Schema Markup Implementado</h3>

        <table class="schema-table">
            <thead>
                <tr>
                    <th>Tipo de Schema</th>
                    <th>Páginas</th>
                    <th>Estado</th>
                    <th>Validación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schema_implementado as $schema): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($schema['tipo'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($schema['paginas'] ?? '0'); ?></td>
                    <td>
                        <span class="implementation-status <?php echo strtolower($schema['estado'] ?? 'pendiente'); ?>">
                            <?php echo htmlspecialchars($schema['estado'] ?? 'Pendiente'); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($schema['validacion'] ?? 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Optimizaciones -->
    <div class="content-section">
        <h3>Optimizaciones Recomendadas</h3>

        <?php foreach ($optimizaciones ?? [] as $opt): ?>
        <div class="optimization-item">
            <div class="optimization-title">
                <span class="priority-tag <?php echo strtolower($opt['prioridad'] ?? 'media'); ?>">
                    <?php echo htmlspecialchars($opt['prioridad'] ?? 'Media'); ?>
                </span>
                <?php echo htmlspecialchars($opt['titulo'] ?? ''); ?>
            </div>

            <p style="margin: 10px 0; font-size: 14px;">
                <?php echo htmlspecialchars($opt['descripcion'] ?? ''); ?>
            </p>

            <?php if (!empty($opt['acciones'])): ?>
            <ul class="action-steps">
                <?php foreach ($opt['acciones'] as $accion): ?>
                <li><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (isset($opt['impacto'])): ?>
            <p style="margin-top: 10px; font-size: 13px; color: #856404;">
                <strong>Impacto esperado:</strong> <?php echo htmlspecialchars($opt['impacto']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Estrategia -->
    <?php if (!empty($estrategia_entidades)): ?>
    <div class="content-section">
        <h3>Estrategia de Construcción de Entidad</h3>

        <div class="strategy-timeline">
            <?php foreach ($estrategia_entidades as $phase): ?>
            <div class="timeline-item">
                <div class="timeline-phase"><?php echo htmlspecialchars($phase['fase'] ?? ''); ?></div>
                <span class="timeline-duration"><?php echo htmlspecialchars($phase['duracion'] ?? ''); ?></span>

                <p style="margin: 15px 0; font-size: 14px;">
                    <?php echo htmlspecialchars($phase['descripcion'] ?? ''); ?>
                </p>

                <?php if (!empty($phase['objetivos'])): ?>
                <ul class="action-steps">
                    <?php foreach ($phase['objetivos'] as $obj): ?>
                    <li><?php echo htmlspecialchars($obj); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>Entidades y Knowledge Graph</span>
    </div>
</div>
