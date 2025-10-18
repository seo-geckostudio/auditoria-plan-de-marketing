<?php
/**
 * Módulo: Checklist de Accesos (m1.2)
 * Fase: 1 - Preparación
 */

$categorias = $datosModulo['categorias'] ?? [];
$resumen = $datosModulo['resumen'] ?? [];
$acciones = $datosModulo['acciones_pendientes'] ?? [];
$proximos = $datosModulo['proximos_pasos'] ?? [];
?>

<div class="audit-page checklist-page">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-key"></i>
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Checklist de Accesos'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? ''); ?></p>
        <div class="page-date">
            Verificación realizada: <?php echo htmlspecialchars($datosModulo['fecha_verificacion'] ?? date('d/m/Y')); ?>
        </div>
    </div>

    <div class="page-body">

        <!-- Resumen visual -->
        <?php if (!empty($resumen)): ?>
        <div class="checklist-summary">
            <div class="summary-card verified">
                <div class="summary-icon"><i class="fas fa-check-circle"></i></div>
                <div class="summary-content">
                    <h3><?php echo $resumen['accesos_verificados'] ?? 0; ?></h3>
                    <p>Verificados</p>
                </div>
            </div>
            <div class="summary-card pending">
                <div class="summary-icon"><i class="fas fa-clock"></i></div>
                <div class="summary-content">
                    <h3><?php echo $resumen['accesos_pendientes'] ?? 0; ?></h3>
                    <p>Pendientes</p>
                </div>
            </div>
            <div class="summary-card unavailable">
                <div class="summary-icon"><i class="fas fa-times-circle"></i></div>
                <div class="summary-content">
                    <h3><?php echo $resumen['accesos_no_disponibles'] ?? 0; ?></h3>
                    <p>No Disponibles</p>
                </div>
            </div>
            <div class="summary-card optional">
                <div class="summary-icon"><i class="fas fa-minus-circle"></i></div>
                <div class="summary-content">
                    <h3><?php echo $resumen['no_requeridos'] ?? 0; ?></h3>
                    <p>No Requeridos</p>
                </div>
            </div>
        </div>

        <div class="progress-bar-container">
            <div class="progress-label">
                <strong>Progreso de Verificación:</strong>
                <span><?php echo $resumen['porcentaje_completado'] ?? 0; ?>%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $resumen['porcentaje_completado'] ?? 0; ?>%"></div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Checklist por categorías -->
        <?php foreach ($categorias as $categoria): ?>
        <div class="checklist-category">
            <h2 class="category-title">
                <i class="fas fa-folder"></i>
                <?php echo htmlspecialchars($categoria['nombre']); ?>
            </h2>

            <table class="checklist-table">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th>Herramienta</th>
                        <th>Nivel de Acceso</th>
                        <th>Estado</th>
                        <th>Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categoria['items'] as $item): ?>
                    <tr class="checklist-item status-<?php echo $item['estado']; ?>">
                        <td class="status-icon">
                            <?php
                            $icons = [
                                'verificado' => '<i class="fas fa-check-circle text-success"></i>',
                                'pendiente' => '<i class="fas fa-clock text-warning"></i>',
                                'no_disponible' => '<i class="fas fa-times-circle text-danger"></i>',
                                'no_requerido' => '<i class="fas fa-minus-circle text-muted"></i>',
                                'disponible' => '<i class="fas fa-check text-info"></i>'
                            ];
                            echo $icons[$item['estado']] ?? '';
                            ?>
                        </td>
                        <td class="tool-name">
                            <strong><?php echo htmlspecialchars($item['herramienta']); ?></strong>
                            <?php if (isset($item['property_id'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($item['property_id']); ?></small>
                            <?php endif; ?>
                            <?php if (isset($item['container_id'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($item['container_id']); ?></small>
                            <?php endif; ?>
                            <?php if (isset($item['version'])): ?>
                            <br><small class="text-muted">v<?php echo htmlspecialchars($item['version']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="access-badge badge-<?php echo strtolower(str_replace(' ', '-', $item['nivel_acceso'])); ?>">
                                <?php echo htmlspecialchars($item['nivel_acceso']); ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $statusLabels = [
                                'verificado' => 'Verificado',
                                'pendiente' => 'Pendiente',
                                'no_disponible' => 'No Disponible',
                                'no_requerido' => 'No Requerido',
                                'disponible' => 'Disponible'
                            ];
                            ?>
                            <span class="status-badge status-<?php echo $item['estado']; ?>">
                                <?php echo $statusLabels[$item['estado']] ?? $item['estado']; ?>
                            </span>
                        </td>
                        <td class="notes-cell">
                            <?php echo htmlspecialchars($item['notas']); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?>

        <!-- Acciones pendientes -->
        <?php if (!empty($acciones)): ?>
        <div class="actions-section">
            <h2 class="section-title">
                <i class="fas fa-exclamation-triangle"></i>
                Acciones Pendientes
            </h2>
            <ul class="actions-list">
                <?php foreach ($acciones as $accion): ?>
                <li>
                    <i class="fas fa-arrow-right text-warning"></i>
                    <?php echo htmlspecialchars($accion); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Próximos pasos -->
        <?php if (!empty($proximos)): ?>
        <div class="next-steps-section">
            <h2 class="section-title">
                <i class="fas fa-forward"></i>
                Próximos Pasos
            </h2>
            <ol class="next-steps-list">
                <?php foreach ($proximos as $paso): ?>
                <li><?php echo htmlspecialchars($paso); ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($configuracionCliente['proyecto']['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 1: Preparación</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos específicos del checklist */
.checklist-summary {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.summary-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    border: 2px solid #e0e0e0;
}

.summary-card.verified { border-color: #88B04B; }
.summary-card.pending { border-color: #88B04B; }
.summary-card.unavailable { border-color: #dc3545; }
.summary-card.optional { border-color: #6c757d; }

.summary-icon {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.summary-card.verified .summary-icon { color: #88B04B; }
.summary-card.pending .summary-icon { color: #88B04B; }
.summary-card.unavailable .summary-icon { color: #dc3545; }
.summary-card.optional .summary-icon { color: #6c757d; }

.summary-content h3 {
    font-size: 2.5em;
    font-weight: 700;
    margin: 10px 0 5px 0;
    color: #333;
}

.summary-content p {
    font-size: 0.9em;
    color: #666;
    margin: 0;
}

.progress-bar-container {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 1em;
}

.progress-bar {
    height: 30px;
    background: #e9ecef;
    border-radius: 15px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%);
    transition: width 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-right: 10px;
    color: white;
    font-weight: 600;
}

.checklist-category {
    margin-bottom: 40px;
}

.category-title {
    font-size: 1.5em;
    color: #88B04B;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #88B04B;
}

.checklist-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.checklist-table thead {
    background: #f8f9fa;
}

.checklist-table th {
    padding: 12px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #dee2e6;
}

.checklist-table td {
    padding: 12px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: top;
}

.status-icon {
    text-align: center;
    font-size: 1.2em;
}

.tool-name strong {
    color: #333;
}

.access-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    font-weight: 500;
    background: #e9ecef;
    color: #333;
}

.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    font-weight: 500;
}

.status-badge.status-verificado {
    background: #d4edda;
    color: #155724;
}

.status-badge.status-pendiente {
    background: #f0f7e6;
    color: #856404;
}

.status-badge.status-no_disponible {
    background: #f8d7da;
    color: #721c24;
}

.status-badge.status-no_requerido {
    background: #e2e3e5;
    color: #383d41;
}

.status-badge.status-disponible {
    background: #d1ecf1;
    color: #0c5460;
}

.notes-cell {
    font-size: 0.9em;
    color: #666;
}

.actions-section, .next-steps-section {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.next-steps-section {
    background: #e8f5e9;
    border-left-color: #88B04B;
}

.actions-list, .next-steps-list {
    margin: 10px 0 0 0;
    padding-left: 0;
    list-style: none;
}

.actions-list li, .next-steps-list li {
    padding: 8px 0;
    padding-left: 30px;
    position: relative;
}

.actions-list i {
    position: absolute;
    left: 0;
    top: 10px;
}

.next-steps-list {
    list-style: decimal;
    padding-left: 30px;
}

@media print {
    .checklist-summary {
        page-break-inside: avoid;
    }

    .checklist-category {
        page-break-inside: avoid;
    }
}
</style>
