<?php
/**
 * Módulo: Featured Snippets Opportunities (m9.4)
 * Fase: 9 - SEO Avanzado
 * Descripción: Identificación y optimización para featured snippets (posición 0)
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$snippets_actuales = $datosModulo['snippets_actuales'] ?? [];
$oportunidades = $datosModulo['oportunidades'] ?? [];
$tipos_snippet = $datosModulo['tipos_snippet'] ?? [];
$competencia = $datosModulo['analisis_competencia'] ?? [];
$quick_wins = $datosModulo['quick_wins'] ?? [];
$estrategia = $datosModulo['estrategia_implementacion'] ?? [];
?>

<style>
.featured-snippets-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.featured-snippets-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.featured-snippets-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.featured-snippets-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.featured-snippets-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.featured-snippets-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.featured-snippets-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.featured-snippets-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #54a34a;
}

.featured-snippets-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #54a34a;
    font-size: 20px;
    font-weight: 600;
}

.featured-snippets-page .snippet-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 15px;
    border-left: 3px solid #54a34a;
}

.featured-snippets-page .snippet-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 10px;
}

.featured-snippets-page .snippet-keyword {
    font-weight: 600;
    color: #2c3e50;
    flex: 1;
}

.featured-snippets-page .snippet-type {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    margin-left: 10px;
}

.featured-snippets-page .snippet-type.parrafo {
    background: #e3f2fd;
    color: #1565c0;
}

.featured-snippets-page .snippet-type.lista {
    background: #f3e5f5;
    color: #6a1b9a;
}

.featured-snippets-page .snippet-type.tabla {
    background: #e8f5e9;
    color: #2e7d32;
}

.featured-snippets-page .snippet-type.video {
    background: #ffebee;
    color: #c62828;
}

.featured-snippets-page .snippet-metrics {
    display: flex;
    gap: 20px;
    font-size: 13px;
    color: #6c757d;
    margin-top: 8px;
}

.featured-snippets-page .snippet-preview {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.featured-snippets-page .opportunity-card {
    background: #fff9e6;
    border: 1px solid #ffc107;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #ffc107;
}

.featured-snippets-page .opportunity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.featured-snippets-page .opportunity-keyword {
    font-weight: 600;
    color: #2c3e50;
    font-size: 16px;
}

.featured-snippets-page .priority-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.featured-snippets-page .priority-badge.alta {
    background: #dc3545;
    color: white;
}

.featured-snippets-page .priority-badge.media {
    background: #ffc107;
    color: #333;
}

.featured-snippets-page .priority-badge.baja {
    background: #6c757d;
    color: white;
}

.featured-snippets-page .opportunity-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 12px;
}

.featured-snippets-page .detail-item {
    font-size: 13px;
}

.featured-snippets-page .detail-label {
    color: #6c757d;
    font-weight: 500;
}

.featured-snippets-page .detail-value {
    color: #2c3e50;
    font-weight: 600;
}

.featured-snippets-page .action-recommendation {
    background: #e8f5e9;
    border-left: 3px solid #4caf50;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
    border-radius: 4px;
}

.featured-snippets-page .type-examples {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 15px;
}

.featured-snippets-page .type-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 20px;
}

.featured-snippets-page .type-card h4 {
    margin: 0 0 10px 0;
    color: #54a34a;
    font-size: 18px;
}

.featured-snippets-page .type-description {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 15px;
}

.featured-snippets-page .example-code {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    font-family: 'Courier New', monospace;
    font-size: 12px;
    overflow-x: auto;
}

.featured-snippets-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.featured-snippets-page .comparison-table th,
.featured-snippets-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.featured-snippets-page .comparison-table th {
    background: #f0f7ee;
    color: #54a34a;
    font-weight: 600;
    font-size: 14px;
}

.featured-snippets-page .comparison-table tr:hover {
    background: #fafafa;
}

.featured-snippets-page .quick-win-item {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
    border-left: 4px solid #28a745;
}

.featured-snippets-page .quick-win-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.featured-snippets-page .quick-win-title {
    font-weight: 600;
    color: #155724;
}

.featured-snippets-page .effort-badge {
    background: #28a745;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

@media print {
    .featured-snippets-page .content-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page featured-snippets-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Featured Snippets Opportunities'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Oportunidades de posición 0 en Google'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Capturar posición 0 en SERPs</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Snippets Actuales</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['snippets_actuales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Oportunidades</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['oportunidades_totales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Quick Wins</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['quick_wins'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tráfico Potencial</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['trafico_potencial'] ?? '0'); ?></div>
            </div>
        </div>
    </div>

    <!-- Snippets Actuales -->
    <?php if (!empty($snippets_actuales)): ?>
    <div class="content-section">
        <h3>Featured Snippets Actuales</h3>
        <p>Keywords donde ya aparecemos en posición 0.</p>

        <?php foreach ($snippets_actuales as $snippet): ?>
        <div class="snippet-card">
            <div class="snippet-header">
                <div class="snippet-keyword"><?php echo htmlspecialchars($snippet['keyword']); ?></div>
                <span class="snippet-type <?php echo $snippet['tipo']; ?>">
                    <?php echo strtoupper($snippet['tipo']); ?>
                </span>
            </div>
            <div class="snippet-metrics">
                <span><strong>Volumen:</strong> <?php echo htmlspecialchars($snippet['volumen']); ?>/mes</span>
                <span><strong>CTR:</strong> <?php echo htmlspecialchars($snippet['ctr']); ?>%</span>
                <span><strong>URL:</strong> <?php echo htmlspecialchars($snippet['url']); ?></span>
            </div>
            <?php if (isset($snippet['preview'])): ?>
            <div class="snippet-preview"><?php echo htmlspecialchars($snippet['preview']); ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Oportunidades -->
    <div class="content-section">
        <h3>Oportunidades de Featured Snippets</h3>
        <p>Keywords donde estamos posicionados en página 1 (posiciones 2-10) y existe un snippet.</p>

        <?php foreach ($oportunidades ?? [] as $opp): ?>
        <div class="opportunity-card">
            <div class="opportunity-header">
                <div class="opportunity-keyword"><?php echo htmlspecialchars($opp['keyword']); ?></div>
                <span class="priority-badge <?php echo strtolower($opp['prioridad']); ?>">
                    <?php echo htmlspecialchars($opp['prioridad']); ?>
                </span>
            </div>

            <div class="opportunity-details">
                <div class="detail-item">
                    <div class="detail-label">Posición Actual</div>
                    <div class="detail-value">#<?php echo htmlspecialchars($opp['posicion_actual']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Volumen Mensual</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['volumen']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tipo de Snippet</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['tipo_snippet']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Quién tiene el snippet</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['competidor']); ?></div>
                </div>
            </div>

            <div class="action-recommendation">
                <strong>Recomendación:</strong> <?php echo htmlspecialchars($opp['accion']); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Tipos de Snippet -->
    <div class="content-section">
        <h3>Guía de Tipos de Featured Snippets</h3>
        <p>Cómo estructurar contenido para cada tipo de snippet.</p>

        <div class="type-examples">
            <?php foreach ($tipos_snippet ?? [] as $tipo): ?>
            <div class="type-card">
                <h4><?php echo htmlspecialchars($tipo['nombre']); ?></h4>
                <p class="type-description"><?php echo htmlspecialchars($tipo['descripcion']); ?></p>
                <p style="font-size: 13px; margin: 10px 0;"><strong>Mejor para:</strong> <?php echo htmlspecialchars($tipo['mejor_para']); ?></p>
                <?php if (isset($tipo['ejemplo_estructura'])): ?>
                <div class="example-code"><?php echo htmlspecialchars($tipo['ejemplo_estructura']); ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Comparativa Competencia -->
    <?php if (!empty($competencia)): ?>
    <div class="content-section">
        <h3>Análisis Competencia Featured Snippets</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Competidor</th>
                    <th>Snippets Totales</th>
                    <th>Tipo Párrafo</th>
                    <th>Tipo Lista</th>
                    <th>Tipo Tabla</th>
                    <th>Tráfico Estimado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['total']); ?></td>
                    <td><?php echo htmlspecialchars($comp['parrafo']); ?></td>
                    <td><?php echo htmlspecialchars($comp['lista']); ?></td>
                    <td><?php echo htmlspecialchars($comp['tabla']); ?></td>
                    <td><?php echo htmlspecialchars($comp['trafico_estimado']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Quick Wins -->
    <?php if (!empty($quick_wins)): ?>
    <div class="content-section">
        <h3>Quick Wins - Acción Inmediata</h3>
        <p>Oportunidades de bajo esfuerzo y alto impacto que podemos implementar rápidamente.</p>

        <?php foreach ($quick_wins as $win): ?>
        <div class="quick-win-item">
            <div class="quick-win-header">
                <div class="quick-win-title"><?php echo htmlspecialchars($win['keyword']); ?></div>
                <span class="effort-badge"><?php echo htmlspecialchars($win['esfuerzo']); ?></span>
            </div>
            <p style="margin: 8px 0; font-size: 14px;"><?php echo htmlspecialchars($win['accion_especifica']); ?></p>
            <p style="margin: 5px 0; font-size: 13px; color: #155724;">
                <strong>Impacto:</strong> <?php echo htmlspecialchars($win['impacto_estimado']); ?>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Estrategia de Implementación -->
    <?php if (!empty($estrategia)): ?>
    <div class="content-section">
        <h3>Estrategia de Implementación</h3>

        <?php foreach ($estrategia as $fase): ?>
        <div style="margin-bottom: 20px;">
            <h4 style="color: #54a34a; margin-bottom: 10px;"><?php echo htmlspecialchars($fase['fase']); ?></h4>
            <p style="margin-bottom: 10px;"><?php echo htmlspecialchars($fase['descripcion']); ?></p>
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($fase['acciones'] ?? [] as $accion): ?>
                <li style="margin: 5px 0;"><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>Featured Snippets Opportunities</span>
    </div>
</div>
