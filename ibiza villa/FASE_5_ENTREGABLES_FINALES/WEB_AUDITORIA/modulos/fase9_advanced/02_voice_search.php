<?php
/**
 * Módulo: Voice Search Optimization (m9.3)
 * Fase: 9 - SEO Avanzado
 * Descripción: Optimización para búsquedas por voz y assistentes virtuales
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$estado_actual = $datosModulo['estado_actual'] ?? [];
$keywords_conversacionales = $datosModulo['keywords_conversacionales'] ?? [];
$preguntas_frecuentes = $datosModulo['preguntas_frecuentes'] ?? [];
$optimizacion_tecnica = $datosModulo['optimizacion_tecnica'] ?? [];
$competencia_voice = $datosModulo['analisis_competencia'] ?? [];
$oportunidades = $datosModulo['oportunidades'] ?? [];
$plan_accion = $datosModulo['plan_accion'] ?? [];
?>

<style>
.voice-search-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

.voice-search-page .executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.voice-search-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.voice-search-page .summary-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.voice-search-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    backdrop-filter: blur(10px);
}

.voice-search-page .stat-value {
    font-size: 28px;
    font-weight: 700;
    margin: 8px 0;
}

.voice-search-page .stat-label {
    font-size: 13px;
    opacity: 0.9;
}

.voice-search-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #88B04B;
}

.voice-search-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #88B04B;
    font-size: 20px;
    font-weight: 600;
}

.voice-search-page .readiness-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.voice-search-page .readiness-item {
    background: #fafafa;
    padding: 15px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.voice-search-page .readiness-label {
    font-weight: 500;
    color: #000000;
}

.voice-search-page .readiness-status {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.voice-search-page .readiness-status.si {
    background: #d4edda;
    color: #155724;
}

.voice-search-page .readiness-status.no {
    background: #f8d7da;
    color: #721c24;
}

.voice-search-page .readiness-status.parcial {
    background: #f0f7e6;
    color: #856404;
}

.voice-search-page .keywords-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.voice-search-page .keywords-table th,
.voice-search-page .keywords-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.voice-search-page .keywords-table th {
    background: #f0f7ee;
    color: #88B04B;
    font-weight: 600;
    font-size: 14px;
}

.voice-search-page .keywords-table tr:hover {
    background: #fafafa;
}

.voice-search-page .query-type {
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

.voice-search-page .query-type.local {
    background: #e3f2fd;
    color: #1565c0;
}

.voice-search-page .query-type.informacional {
    background: #f3e5f5;
    color: #6a1b9a;
}

.voice-search-page .query-type.transaccional {
    background: #e8f5e9;
    color: #2e7d32;
}

.voice-search-page .question-card {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
    border-left: 3px solid #88B04B;
}

.voice-search-page .question-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 10px;
}

.voice-search-page .question-text {
    font-weight: 600;
    color: #000000;
    font-size: 15px;
    flex: 1;
}

.voice-search-page .volume-badge {
    background: #88B04B;
    color: white;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    margin-left: 10px;
}

.voice-search-page .answer-preview {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 4px;
    font-size: 14px;
    color: #495057;
    margin-top: 8px;
}

.voice-search-page .coverage-status {
    margin-top: 8px;
    font-size: 13px;
}

.voice-search-page .coverage-yes {
    color: #88B04B;
}

.voice-search-page .coverage-no {
    color: #dc3545;
}

.voice-search-page .tech-checklist {
    list-style: none;
    padding: 0;
    margin: 0;
}

.voice-search-page .tech-checklist li {
    padding: 12px;
    margin-bottom: 8px;
    background: #fafafa;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.voice-search-page .check-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.voice-search-page .check-icon.yes {
    background: #88B04B;
    color: white;
}

.voice-search-page .check-icon.no {
    background: #dc3545;
    color: white;
}

.voice-search-page .opportunity-card {
    background: #f0f7e6;
    border: 1px solid #ffeb3b;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #88B04B;
}

.voice-search-page .opportunity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.voice-search-page .opportunity-title {
    font-weight: 600;
    color: #000000;
    font-size: 16px;
}

.voice-search-page .impact-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.voice-search-page .impact-badge.alto {
    background: #dc3545;
    color: white;
}

.voice-search-page .impact-badge.medio {
    background: #88B04B;
    color: #333;
}

.voice-search-page .action-plan-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
}

.voice-search-page .action-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 15px;
    border-left: 4px solid #88B04B;
}

.voice-search-page .action-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.voice-search-page .action-title {
    font-weight: 600;
    color: #000000;
}

.voice-search-page .action-meta {
    display: flex;
    gap: 15px;
    font-size: 13px;
    color: #6c757d;
    margin-top: 8px;
}

@media print {
    .voice-search-page .content-section,
    .voice-search-page .action-plan-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page voice-search-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Optimización para Voice Search'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Análisis y estrategia para búsquedas por voz'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Optimizado para Google Assistant, Alexa, Siri</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-stats">
            <div class="stat-card">
                <div class="stat-label">Readiness Score</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['readiness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Keywords Conversacionales</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['keywords_identificadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Preguntas Detectadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['preguntas_detectadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Páginas Optimizadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['paginas_optimizadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tráfico Voice Estimado</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['trafico_potencial'] ?? 'N/A'); ?></div>
            </div>
        </div>
    </div>

    <!-- Estado Actual -->
    <div class="content-section">
        <h3>Estado Actual de Voice Search Readiness</h3>
        <p><?php echo htmlspecialchars($estado_actual['resumen'] ?? ''); ?></p>

        <div class="readiness-grid">
            <?php foreach ($estado_actual['criterios'] ?? [] as $criterio): ?>
            <div class="readiness-item">
                <span class="readiness-label"><?php echo htmlspecialchars($criterio['nombre']); ?></span>
                <span class="readiness-status <?php echo $criterio['estado']; ?>">
                    <?php echo strtoupper($criterio['estado']); ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Keywords Conversacionales -->
    <div class="content-section">
        <h3>Keywords Conversacionales Identificadas</h3>
        <p>Keywords basadas en lenguaje natural que las personas usan al hacer búsquedas por voz.</p>

        <table class="keywords-table">
            <thead>
                <tr>
                    <th>Query Conversacional</th>
                    <th>Tipo</th>
                    <th>Volumen/mes</th>
                    <th>Dificultad</th>
                    <th>Cobertura Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keywords_conversacionales ?? [] as $kw): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($kw['query']); ?></strong></td>
                    <td><span class="query-type <?php echo $kw['tipo']; ?>"><?php echo strtoupper($kw['tipo']); ?></span></td>
                    <td><?php echo htmlspecialchars($kw['volumen']); ?></td>
                    <td><?php echo htmlspecialchars($kw['dificultad']); ?></td>
                    <td class="<?php echo $kw['cubierta'] ? 'coverage-yes' : 'coverage-no'; ?>">
                        <?php echo $kw['cubierta'] ? 'Cubierta' : 'No cubierta'; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Preguntas Frecuentes -->
    <div class="content-section">
        <h3>Preguntas Frecuentes para Voice Search</h3>
        <p>Preguntas que los usuarios hacen a asistentes de voz relacionadas con alquiler de villas en Ibiza.</p>

        <?php foreach ($preguntas_frecuentes ?? [] as $pregunta): ?>
        <div class="question-card">
            <div class="question-header">
                <span class="question-text"><?php echo htmlspecialchars($pregunta['pregunta']); ?></span>
                <span class="volume-badge"><?php echo htmlspecialchars($pregunta['volumen']); ?>/mes</span>
            </div>

            <?php if (isset($pregunta['respuesta_sugerida'])): ?>
            <div class="answer-preview">
                <strong>Respuesta sugerida:</strong> <?php echo htmlspecialchars($pregunta['respuesta_sugerida']); ?>
            </div>
            <?php endif; ?>

            <div class="coverage-status">
                <?php if ($pregunta['cubierta']): ?>
                <span class="coverage-yes">✓ Cubierta en: <?php echo htmlspecialchars($pregunta['url_actual']); ?></span>
                <?php else: ?>
                <span class="coverage-no">✗ No cubierta - Oportunidad de crear contenido</span>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Optimización Técnica -->
    <div class="content-section">
        <h3>Checklist de Optimización Técnica</h3>
        <p>Elementos técnicos que impactan la capacidad de aparecer en resultados de voice search.</p>

        <ul class="tech-checklist">
            <?php foreach ($optimizacion_tecnica ?? [] as $item): ?>
            <li>
                <span class="check-icon <?php echo $item['implementado'] ? 'yes' : 'no'; ?>">
                    <?php echo $item['implementado'] ? '✓' : '✗'; ?>
                </span>
                <div style="flex: 1;">
                    <div><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></div>
                    <div style="font-size: 13px; color: #6c757d;"><?php echo htmlspecialchars($item['descripcion']); ?></div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Análisis Competencia -->
    <?php if (!empty($competencia_voice)): ?>
    <div class="content-section">
        <h3>Análisis Competencia Voice Search</h3>

        <table class="keywords-table">
            <thead>
                <tr>
                    <th>Competidor</th>
                    <th>Readiness Score</th>
                    <th>FAQs Implementadas</th>
                    <th>Schema Markup</th>
                    <th>Velocidad Móvil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia_voice as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['readiness_score']); ?>/100</td>
                    <td><?php echo htmlspecialchars($comp['faqs']); ?></td>
                    <td><?php echo htmlspecialchars($comp['schema']); ?></td>
                    <td><?php echo htmlspecialchars($comp['velocidad']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Oportunidades -->
    <?php if (!empty($oportunidades)): ?>
    <div class="content-section">
        <h3>Oportunidades de Voice Search</h3>

        <?php foreach ($oportunidades as $oportunidad): ?>
        <div class="opportunity-card">
            <div class="opportunity-header">
                <span class="opportunity-title"><?php echo htmlspecialchars($oportunidad['titulo']); ?></span>
                <span class="impact-badge <?php echo strtolower($oportunidad['impacto']); ?>">
                    Impacto <?php echo htmlspecialchars($oportunidad['impacto']); ?>
                </span>
            </div>
            <p style="margin: 10px 0; color: #495057;"><?php echo htmlspecialchars($oportunidad['descripcion']); ?></p>
            <p style="margin: 5px 0; font-size: 13px; color: #6c757d;">
                <strong>Tráfico potencial:</strong> <?php echo htmlspecialchars($oportunidad['trafico_estimado']); ?>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Plan de Acción -->
    <div class="action-plan-section">
        <h3>Plan de Acción para Voice Search</h3>

        <?php foreach ($plan_accion ?? [] as $index => $accion): ?>
        <div class="action-item">
            <div class="action-header">
                <span class="action-title"><?php echo ($index + 1) . '. ' . htmlspecialchars($accion['titulo']); ?></span>
            </div>
            <p style="margin: 10px 0; color: #495057;"><?php echo htmlspecialchars($accion['descripcion']); ?></p>
            <div class="action-meta">
                <span><strong>Prioridad:</strong> <?php echo htmlspecialchars($accion['prioridad']); ?></span>
                <span><strong>Esfuerzo:</strong> <?php echo htmlspecialchars($accion['esfuerzo']); ?></span>
                <span><strong>Timeline:</strong> <?php echo htmlspecialchars($accion['timeline']); ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>Voice Search Optimization</span>
    </div>
</div>
