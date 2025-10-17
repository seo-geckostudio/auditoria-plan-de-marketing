<?php
/**
 * Módulo: Monitoreo de Algoritmo (m9.7)
 * Fase: 9 - SEO Moderno
 * Descripción: Sistema de monitoreo de updates algorítmicos y playbook de recuperación
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$historial_updates = $datosModulo['historial_updates'] ?? [];
$impacto_actual = $datosModulo['impacto_actual'] ?? [];
$metricas_monitorizadas = $datosModulo['metricas_monitorizadas'] ?? [];
$alertas_configuradas = $datosModulo['alertas_configuradas'] ?? [];
$playbook_recuperacion = $datosModulo['playbook_recuperacion'] ?? [];
$calendario_updates = $datosModulo['calendario_updates'] ?? [];
?>

<style>
.monitoreo-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.monitoreo-page .executive-summary {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.monitoreo-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.monitoreo-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.monitoreo-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.monitoreo-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.monitoreo-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.monitoreo-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #ff6b6b;
}

.monitoreo-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #ff6b6b;
    font-size: 20px;
    font-weight: 600;
}

.monitoreo-page .update-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #ff6b6b;
}

.monitoreo-page .update-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
}

.monitoreo-page .update-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 18px;
}

.monitoreo-page .update-date {
    font-size: 13px;
    color: #6c757d;
}

.monitoreo-page .impact-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin-top: 5px;
}

.monitoreo-page .impact-badge.positivo {
    background: #d4edda;
    color: #155724;
}

.monitoreo-page .impact-badge.negativo {
    background: #f8d7da;
    color: #721c24;
}

.monitoreo-page .impact-badge.neutro {
    background: #d1ecf1;
    color: #0c5460;
}

.monitoreo-page .impact-details {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.monitoreo-page .metric-row {
    display: flex;
    justify-content: space-between;
    margin: 8px 0;
    font-size: 13px;
}

.monitoreo-page .metric-label {
    color: #6c757d;
}

.monitoreo-page .metric-value {
    font-weight: 600;
    color: #2c3e50;
}

.monitoreo-page .metric-value.negative {
    color: #dc3545;
}

.monitoreo-page .metric-value.positive {
    color: #28a745;
}

.monitoreo-page .current-impact {
    background: linear-gradient(135deg, #fff9e6 0%, #ffe8cc 100%);
    border: 2px solid #ffc107;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.monitoreo-page .impact-status {
    font-size: 20px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.monitoreo-page .monitoring-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.monitoreo-page .monitoring-table th,
.monitoreo-page .monitoring-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.monitoreo-page .monitoring-table th {
    background: #fff0f0;
    color: #ff6b6b;
    font-weight: 600;
    font-size: 14px;
}

.monitoreo-page .monitoring-table tr:hover {
    background: #fafafa;
}

.monitoreo-page .frequency-badge {
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

.monitoreo-page .frequency-badge.diaria {
    background: #dc3545;
    color: white;
}

.monitoreo-page .frequency-badge.semanal {
    background: #ffc107;
    color: #333;
}

.monitoreo-page .frequency-badge.mensual {
    background: #6c757d;
    color: white;
}

.monitoreo-page .alert-card {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 4px solid #ff6b6b;
    border-radius: 6px;
    padding: 18px;
    margin-bottom: 12px;
}

.monitoreo-page .alert-trigger {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.monitoreo-page .alert-action {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 4px;
    margin-top: 8px;
    font-size: 13px;
}

.monitoreo-page .playbook-section {
    background: #e8f5e9;
    border: 2px solid #4caf50;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.monitoreo-page .playbook-title {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
}

.monitoreo-page .playbook-steps {
    counter-reset: step-counter;
    list-style: none;
    padding: 0;
}

.monitoreo-page .playbook-steps li {
    counter-increment: step-counter;
    position: relative;
    padding-left: 45px;
    margin-bottom: 20px;
}

.monitoreo-page .playbook-steps li::before {
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 0;
    background: #4caf50;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.monitoreo-page .step-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.monitoreo-page .step-description {
    color: #6c757d;
    font-size: 14px;
}

.monitoreo-page .calendar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.monitoreo-page .calendar-month {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
}

.monitoreo-page .month-name {
    font-weight: 600;
    color: #ff6b6b;
    font-size: 16px;
    margin-bottom: 12px;
    text-align: center;
}

.monitoreo-page .expected-updates {
    font-size: 13px;
}

.monitoreo-page .update-item {
    background: #f8f9fa;
    padding: 8px;
    border-radius: 4px;
    margin: 6px 0;
    font-size: 12px;
}

@media print {
    .monitoreo-page .content-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page monitoreo-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Monitoreo de Algoritmo'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Sistema de alertas y playbook de recuperación'); ?></p>
        <div class="page-meta">
            <span>Última actualización: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Estado: Monitoreo activo</span>
        </div>
    </div>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Updates Detectados</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['updates_detectados'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Impacto Negativo</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['impactos_negativos'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tiempo Recuperación</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['tiempo_recuperacion_avg'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Alertas Activas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['alertas_activas'] ?? '0'); ?></div>
            </div>
        </div>
    </div>

    <!-- Impacto Actual -->
    <?php if (!empty($impacto_actual)): ?>
    <div class="current-impact">
        <div class="impact-status">
            Estado Actual: <?php echo htmlspecialchars($impacto_actual['estado'] ?? 'Normal'); ?>
        </div>

        <p style="margin: 10px 0; font-size: 14px;">
            <?php echo htmlspecialchars($impacto_actual['descripcion'] ?? ''); ?>
        </p>

        <?php if (isset($impacto_actual['ultimo_update'])): ?>
        <div style="margin-top: 15px;">
            <strong>Último update detectado:</strong> <?php echo htmlspecialchars($impacto_actual['ultimo_update']); ?>
            <br>
            <strong>Fecha:</strong> <?php echo htmlspecialchars($impacto_actual['fecha_update'] ?? ''); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Historial de Updates -->
    <div class="content-section">
        <h3>Historial de Algorithm Updates</h3>
        <p>Registro de actualizaciones algorítmicas de Google y su impacto en el sitio.</p>

        <?php foreach ($historial_updates ?? [] as $update): ?>
        <div class="update-card">
            <div class="update-header">
                <div>
                    <div class="update-name"><?php echo htmlspecialchars($update['nombre'] ?? ''); ?></div>
                    <div class="update-date"><?php echo htmlspecialchars($update['fecha'] ?? ''); ?></div>
                </div>
                <span class="impact-badge <?php echo strtolower($update['impacto_tipo'] ?? 'neutro'); ?>">
                    <?php echo htmlspecialchars($update['impacto_tipo'] ?? 'Neutro'); ?>
                </span>
            </div>

            <p style="margin: 10px 0; font-size: 14px; color: #6c757d;">
                <?php echo htmlspecialchars($update['descripcion'] ?? ''); ?>
            </p>

            <?php if (!empty($update['metricas'])): ?>
            <div class="impact-details">
                <strong style="display: block; margin-bottom: 8px;">Métricas de Impacto:</strong>
                <?php foreach ($update['metricas'] as $metric => $value): ?>
                <div class="metric-row">
                    <span class="metric-label"><?php echo htmlspecialchars($metric); ?>:</span>
                    <span class="metric-value <?php echo (strpos($value, '-') === 0) ? 'negative' : ((strpos($value, '+') === 0) ? 'positive' : ''); ?>">
                        <?php echo htmlspecialchars($value); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($update['acciones_tomadas'])): ?>
            <div style="margin-top: 12px; padding: 10px; background: #e8f5e9; border-radius: 4px; font-size: 13px;">
                <strong>Acciones tomadas:</strong> <?php echo htmlspecialchars($update['acciones_tomadas']); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Métricas Monitorizadas -->
    <?php if (!empty($metricas_monitorizadas)): ?>
    <div class="content-section">
        <h3>Métricas Monitorizadas</h3>

        <table class="monitoring-table">
            <thead>
                <tr>
                    <th>Métrica</th>
                    <th>Frecuencia</th>
                    <th>Umbral Alerta</th>
                    <th>Fuente Datos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metricas_monitorizadas as $metric): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($metric['nombre'] ?? ''); ?></strong></td>
                    <td>
                        <span class="frequency-badge <?php echo strtolower($metric['frecuencia'] ?? 'semanal'); ?>">
                            <?php echo htmlspecialchars($metric['frecuencia'] ?? 'Semanal'); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($metric['umbral_alerta'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($metric['fuente'] ?? 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Alertas Configuradas -->
    <div class="content-section">
        <h3>Alertas Configuradas</h3>
        <p>Sistema automático de alertas ante cambios significativos.</p>

        <?php foreach ($alertas_configuradas ?? [] as $alert): ?>
        <div class="alert-card">
            <div class="alert-trigger">
                <?php echo htmlspecialchars($alert['trigger'] ?? ''); ?>
            </div>
            <p style="margin: 8px 0; font-size: 13px; color: #6c757d;">
                <?php echo htmlspecialchars($alert['descripcion'] ?? ''); ?>
            </p>
            <div class="alert-action">
                <strong>Acción automática:</strong> <?php echo htmlspecialchars($alert['accion'] ?? ''); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Playbook de Recuperación -->
    <?php if (!empty($playbook_recuperacion)): ?>
    <div class="content-section">
        <h3>Playbook de Recuperación</h3>

        <?php foreach ($playbook_recuperacion as $scenario): ?>
        <div class="playbook-section">
            <div class="playbook-title"><?php echo htmlspecialchars($scenario['escenario'] ?? ''); ?></div>

            <ul class="playbook-steps">
                <?php foreach ($scenario['pasos'] ?? [] as $step): ?>
                <li>
                    <div class="step-title"><?php echo htmlspecialchars($step['titulo'] ?? ''); ?></div>
                    <div class="step-description"><?php echo htmlspecialchars($step['descripcion'] ?? ''); ?></div>
                </li>
                <?php endforeach; ?>
            </ul>

            <?php if (isset($scenario['tiempo_estimado'])): ?>
            <div style="margin-top: 15px; font-size: 13px; color: #6c757d;">
                <strong>Tiempo estimado de recuperación:</strong> <?php echo htmlspecialchars($scenario['tiempo_estimado']); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Calendario de Updates -->
    <?php if (!empty($calendario_updates)): ?>
    <div class="content-section">
        <h3>Calendario de Updates Esperados</h3>
        <p>Previsión de actualizaciones algorítmicas basada en patrones históricos.</p>

        <div class="calendar-grid">
            <?php foreach ($calendario_updates as $month): ?>
            <div class="calendar-month">
                <div class="month-name"><?php echo htmlspecialchars($month['mes'] ?? ''); ?></div>
                <div class="expected-updates">
                    <?php foreach ($month['updates_esperados'] ?? [] as $update): ?>
                    <div class="update-item">
                        <strong><?php echo htmlspecialchars($update['tipo'] ?? ''); ?></strong>
                        <br>
                        <span style="font-size: 11px;"><?php echo htmlspecialchars($update['probabilidad'] ?? ''); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>Monitoreo de Algoritmo</span>
    </div>
</div>
