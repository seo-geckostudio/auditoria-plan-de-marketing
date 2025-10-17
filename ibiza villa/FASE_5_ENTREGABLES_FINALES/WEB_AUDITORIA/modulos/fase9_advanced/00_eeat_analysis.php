<?php
/**
 * Módulo: E-E-A-T Analysis (m9.1)
 * Fase: 9 - SEO Avanzado
 * Descripción: Análisis de Experience, Expertise, Authoritativeness, Trustworthiness
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$experience = $datosModulo['experience_signals'] ?? [];
$expertise = $datosModulo['expertise_signals'] ?? [];
$authoritativeness = $datosModulo['authoritativeness_signals'] ?? [];
$trustworthiness = $datosModulo['trustworthiness_signals'] ?? [];
$puntuacion_general = $datosModulo['puntuacion_general'] ?? [];
$analisis_competencia = $datosModulo['analisis_competencia'] ?? [];
$gaps_detectados = $datosModulo['gaps_detectados'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<style>
.eeat-analysis-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.eeat-analysis-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.eeat-analysis-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 24px;
    font-weight: 700;
}

.eeat-analysis-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.eeat-analysis-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    backdrop-filter: blur(10px);
}

.eeat-analysis-page .summary-card .value {
    font-size: 32px;
    font-weight: 700;
    margin: 10px 0;
}

.eeat-analysis-page .summary-card .label {
    font-size: 14px;
    opacity: 0.9;
}

.eeat-analysis-page .eeat-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #54a34a;
}

.eeat-analysis-page .eeat-section h3 {
    margin: 0 0 20px 0;
    color: #54a34a;
    font-size: 20px;
    font-weight: 600;
}

.eeat-analysis-page .score-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f7ee;
}

.eeat-analysis-page .score-badge {
    background: #54a34a;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 18px;
    font-weight: 600;
}

.eeat-analysis-page .score-badge.low {
    background: #e74c3c;
}

.eeat-analysis-page .score-badge.medium {
    background: #f39c12;
}

.eeat-analysis-page .score-badge.high {
    background: #54a34a;
}

.eeat-analysis-page .signals-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
}

.eeat-analysis-page .signal-card {
    background: #fafafa;
    padding: 15px;
    border-radius: 6px;
    border-left: 3px solid #54a34a;
}

.eeat-analysis-page .signal-card h4 {
    margin: 0 0 10px 0;
    color: #2c3e50;
    font-size: 15px;
    font-weight: 600;
}

.eeat-analysis-page .signal-status {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}

.eeat-analysis-page .status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.eeat-analysis-page .status-indicator.presente {
    background: #54a34a;
}

.eeat-analysis-page .status-indicator.parcial {
    background: #f39c12;
}

.eeat-analysis-page .status-indicator.ausente {
    background: #e74c3c;
}

.eeat-analysis-page .status-text {
    font-size: 13px;
    color: #7f8c8d;
}

.eeat-analysis-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.eeat-analysis-page .comparison-table th,
.eeat-analysis-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.eeat-analysis-page .comparison-table th {
    background: #f0f7ee;
    color: #54a34a;
    font-weight: 600;
    font-size: 14px;
}

.eeat-analysis-page .comparison-table tr:hover {
    background: #fafafa;
}

.eeat-analysis-page .gaps-section {
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.eeat-analysis-page .gaps-section h3 {
    color: #856404;
    margin-top: 0;
}

.eeat-analysis-page .gap-item {
    background: white;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 12px;
    border-left: 3px solid #ffc107;
}

.eeat-analysis-page .gap-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.eeat-analysis-page .gap-title {
    font-weight: 600;
    color: #2c3e50;
}

.eeat-analysis-page .priority-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.eeat-analysis-page .priority-badge.A {
    background: #e74c3c;
    color: white;
}

.eeat-analysis-page .priority-badge.B {
    background: #f39c12;
    color: white;
}

.eeat-analysis-page .priority-badge.C {
    background: #95a5a6;
    color: white;
}

.eeat-analysis-page .recommendations-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.eeat-analysis-page .recommendations-list li {
    background: white;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 12px;
    border-left: 4px solid #54a34a;
    display: flex;
    gap: 15px;
}

.eeat-analysis-page .rec-number {
    background: #54a34a;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    flex-shrink: 0;
}

.eeat-analysis-page .rec-content {
    flex: 1;
}

.eeat-analysis-page .rec-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.eeat-analysis-page .rec-description {
    color: #7f8c8d;
    font-size: 14px;
}

.eeat-analysis-page .metric-bar {
    width: 100%;
    height: 8px;
    background: #e1e8ed;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 8px;
}

.eeat-analysis-page .metric-fill {
    height: 100%;
    background: #54a34a;
    transition: width 0.3s ease;
}

@media print {
    .eeat-analysis-page .eeat-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page eeat-analysis-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Análisis E-E-A-T'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Experience, Expertise, Authoritativeness, Trustworthiness'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Basado en Quality Rater Guidelines de Google</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo E-E-A-T</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="summary-card">
                <div class="label">Puntuación General</div>
                <div class="value"><?php echo htmlspecialchars($resumen['puntuacion_general'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Experience Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['experience_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Expertise Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['expertise_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Authoritativeness Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['authoritativeness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Trustworthiness Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['trustworthiness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Gaps Críticos</div>
                <div class="value"><?php echo htmlspecialchars($resumen['gaps_criticos'] ?? 'N/A'); ?></div>
            </div>
        </div>
    </div>

    <!-- Experience Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Experience (Experiencia)</h3>
            <span class="score-badge <?php echo strtolower($experience['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($experience['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($experience['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($experience['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Expertise Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Expertise (Experiencia Profesional)</h3>
            <span class="score-badge <?php echo strtolower($expertise['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($expertise['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($expertise['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($expertise['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Authoritativeness Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Authoritativeness (Autoridad)</h3>
            <span class="score-badge <?php echo strtolower($authoritativeness['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($authoritativeness['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($authoritativeness['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($authoritativeness['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
                <?php if (isset($signal['valor_actual'])): ?>
                <div class="metric-bar">
                    <div class="metric-fill" style="width: <?php echo min(100, ($signal['valor_actual'] / $signal['valor_objetivo']) * 100); ?>%"></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Trustworthiness Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Trustworthiness (Confianza)</h3>
            <span class="score-badge <?php echo strtolower($trustworthiness['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($trustworthiness['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($trustworthiness['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($trustworthiness['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Comparativa Competencia -->
    <?php if (!empty($analisis_competencia)): ?>
    <div class="eeat-section">
        <h3>Comparativa E-E-A-T vs Competencia</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Sitio</th>
                    <th>Experience</th>
                    <th>Expertise</th>
                    <th>Authoritativeness</th>
                    <th>Trustworthiness</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($analisis_competencia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['experience']); ?></td>
                    <td><?php echo htmlspecialchars($comp['expertise']); ?></td>
                    <td><?php echo htmlspecialchars($comp['authoritativeness']); ?></td>
                    <td><?php echo htmlspecialchars($comp['trustworthiness']); ?></td>
                    <td><strong><?php echo htmlspecialchars($comp['total']); ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Gaps Detectados -->
    <?php if (!empty($gaps_detectados)): ?>
    <div class="gaps-section">
        <h3>Gaps Críticos Detectados</h3>

        <?php foreach ($gaps_detectados as $gap): ?>
        <div class="gap-item">
            <div class="gap-header">
                <span class="gap-title"><?php echo htmlspecialchars($gap['titulo']); ?></span>
                <span class="priority-badge <?php echo $gap['prioridad']; ?>">
                    Prioridad <?php echo $gap['prioridad']; ?>
                </span>
            </div>
            <p style="margin: 5px 0; color: #7f8c8d; font-size: 14px;"><?php echo htmlspecialchars($gap['descripcion']); ?></p>
            <p style="margin: 10px 0 0 0; font-size: 13px;"><strong>Impacto:</strong> <?php echo htmlspecialchars($gap['impacto']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Recomendaciones -->
    <div class="eeat-section">
        <h3>Recomendaciones de Mejora E-E-A-T</h3>

        <ul class="recommendations-list">
            <?php foreach ($recomendaciones ?? [] as $index => $rec): ?>
            <li>
                <div class="rec-number"><?php echo $index + 1; ?></div>
                <div class="rec-content">
                    <div class="rec-title"><?php echo htmlspecialchars($rec['titulo']); ?></div>
                    <div class="rec-description"><?php echo htmlspecialchars($rec['descripcion']); ?></div>
                    <?php if (isset($rec['esfuerzo'])): ?>
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #95a5a6;">
                        <strong>Esfuerzo:</strong> <?php echo htmlspecialchars($rec['esfuerzo']); ?> |
                        <strong>Impacto:</strong> <?php echo htmlspecialchars($rec['impacto']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>E-E-A-T Analysis</span>
    </div>
</div>
