<?php
/**
 * Módulo: Roadmap de Auditoría (m1.3)
 * Fase: 1 - Preparación
 */

$fases = $datosModulo['fases'] ?? [];
$hitos = $datosModulo['hitos_clave'] ?? [];
$equipo = $datosModulo['equipo'] ?? [];
$metricas = $datosModulo['metricas_seguimiento'] ?? [];
$riesgos = $datosModulo['riesgos_identificados'] ?? [];
?>

<div class="audit-page roadmap-page">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-route"></i>
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Roadmap de Auditoría'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? ''); ?></p>
        <div class="page-meta">
            <span><strong>Proyecto:</strong> <?php echo htmlspecialchars($datosModulo['proyecto'] ?? ''); ?></span>
            <span><strong>Duración:</strong> <?php echo htmlspecialchars($datosModulo['duracion_total'] ?? ''); ?></span>
            <span><strong>Periodo:</strong> <?php echo htmlspecialchars($datosModulo['fecha_inicio'] ?? ''); ?> - <?php echo htmlspecialchars($datosModulo['fecha_fin'] ?? ''); ?></span>
        </div>
    </div>

    <div class="page-body">

        <!-- Métricas del proyecto -->
        <?php if (!empty($metricas)): ?>
        <div class="project-metrics">
            <div class="metric-box">
                <div class="metric-icon"><i class="fas fa-clock"></i></div>
                <div class="metric-content">
                    <h3><?php echo $metricas['total_horas_planificadas']; ?>h</h3>
                    <p>Horas Totales</p>
                </div>
            </div>
            <div class="metric-box">
                <div class="metric-icon"><i class="fas fa-puzzle-piece"></i></div>
                <div class="metric-content">
                    <h3><?php echo $metricas['total_modulos']; ?></h3>
                    <p>Módulos</p>
                </div>
            </div>
            <div class="metric-box">
                <div class="metric-icon"><i class="fas fa-file-alt"></i></div>
                <div class="metric-content">
                    <h3><?php echo $metricas['total_paginas']; ?></h3>
                    <p>Páginas</p>
                </div>
            </div>
            <div class="metric-box">
                <div class="metric-icon"><i class="fas fa-tasks"></i></div>
                <div class="metric-content">
                    <h3><?php echo $metricas['progreso_actual']; ?>%</h3>
                    <p>Progreso</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Timeline visual de fases -->
        <div class="timeline-container">
            <h2 class="section-title">Timeline del Proyecto</h2>
            <div class="timeline-visual">
                <?php foreach ($fases as $index => $fase): ?>
                <div class="timeline-phase phase-<?php echo $fase['estado']; ?>">
                    <div class="phase-header">
                        <div class="phase-number">Fase <?php echo $fase['numero']; ?></div>
                        <div class="phase-status">
                            <?php
                            $statusIcons = [
                                'completado' => '<i class="fas fa-check-circle"></i> Completado',
                                'en_curso' => '<i class="fas fa-spinner"></i> En Curso',
                                'pendiente' => '<i class="fas fa-clock"></i> Pendiente',
                                'no_aplicable' => '<i class="fas fa-minus-circle"></i> No Aplicable'
                            ];
                            echo $statusIcons[$fase['estado']] ?? $fase['estado'];
                            ?>
                        </div>
                    </div>
                    <h3 class="phase-name"><?php echo htmlspecialchars($fase['nombre']); ?></h3>
                    <div class="phase-dates">
                        <i class="fas fa-calendar"></i>
                        <?php echo htmlspecialchars($fase['fecha_inicio']); ?> - <?php echo htmlspecialchars($fase['fecha_fin']); ?>
                        <span class="phase-duration">(<?php echo htmlspecialchars($fase['duracion']); ?>)</span>
                    </div>

                    <div class="phase-details">
                        <div class="phase-stats">
                            <span><strong><?php echo $fase['modulos']; ?></strong> módulos</span>
                            <span><strong><?php echo $fase['horas_estimadas']; ?>h</strong> estimadas</span>
                        </div>

                        <?php if (!empty($fase['objetivos'])): ?>
                        <div class="phase-objectives">
                            <strong>Objetivos:</strong>
                            <ul>
                                <?php foreach ($fase['objetivos'] as $objetivo): ?>
                                <li><?php echo htmlspecialchars($objetivo); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($fase['entregables'])): ?>
                        <div class="phase-deliverables">
                            <strong>Entregables:</strong>
                            <ul>
                                <?php foreach ($fase['entregables'] as $entregable): ?>
                                <li><i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($entregable); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($fase['herramientas'])): ?>
                        <div class="phase-tools">
                            <strong>Herramientas:</strong>
                            <?php foreach ($fase['herramientas'] as $herramienta): ?>
                            <span class="tool-badge"><?php echo htmlspecialchars($herramienta); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if (isset($fase['nota'])): ?>
                        <div class="phase-note">
                            <i class="fas fa-info-circle"></i>
                            <?php echo htmlspecialchars($fase['nota']); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($index < count($fases) - 1): ?>
                    <div class="timeline-connector"></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Hitos clave -->
        <?php if (!empty($hitos)): ?>
        <div class="milestones-section">
            <h2 class="section-title">
                <i class="fas fa-flag-checkered"></i>
                Hitos Clave del Proyecto
            </h2>
            <div class="milestones-grid">
                <?php foreach ($hitos as $hito): ?>
                <div class="milestone-card">
                    <div class="milestone-date"><?php echo htmlspecialchars($hito['fecha']); ?></div>
                    <h4 class="milestone-title"><?php echo htmlspecialchars($hito['hito']); ?></h4>
                    <p class="milestone-description"><?php echo htmlspecialchars($hito['descripcion']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Equipo -->
        <?php if (!empty($equipo)): ?>
        <div class="team-section">
            <h2 class="section-title">
                <i class="fas fa-users"></i>
                Equipo del Proyecto
            </h2>
            <div class="team-lead">
                <strong>Consultor Principal:</strong> <?php echo htmlspecialchars($equipo['consultor_principal'] ?? ''); ?>
            </div>
            <?php if (!empty($equipo['roles'])): ?>
            <div class="team-roles">
                <?php foreach ($equipo['roles'] as $rol): ?>
                <div class="role-card">
                    <div class="role-title"><?php echo htmlspecialchars($rol['rol']); ?></div>
                    <div class="role-person"><?php echo htmlspecialchars($rol['responsable']); ?></div>
                    <div class="role-dedication"><?php echo htmlspecialchars($rol['dedicacion']); ?> dedicación</div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Riesgos -->
        <?php if (!empty($riesgos)): ?>
        <div class="risks-section">
            <h2 class="section-title">
                <i class="fas fa-exclamation-triangle"></i>
                Riesgos Identificados y Mitigación
            </h2>
            <table class="risks-table">
                <thead>
                    <tr>
                        <th>Riesgo</th>
                        <th style="width: 100px;">Impacto</th>
                        <th>Estrategia de Mitigación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riesgos as $riesgo): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($riesgo['riesgo']); ?></strong></td>
                        <td>
                            <span class="impact-badge impact-<?php echo strtolower($riesgo['impacto']); ?>">
                                <?php echo htmlspecialchars($riesgo['impacto']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($riesgo['mitigacion']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
/* Estilos del roadmap */
.page-meta {
    display: flex;
    gap: 30px;
    margin-top: 15px;
    font-size: 0.95em;
}

.project-metrics {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.metric-box {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 24px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.metric-icon {
    font-size: 2.5em;
    opacity: 0.9;
}

.metric-content h3 {
    font-size: 2em;
    font-weight: 700;
    margin: 0 0 5px 0;
}

.metric-content p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9em;
}

.timeline-container {
    margin: 40px 0;
}

.timeline-visual {
    position: relative;
    padding: 20px 0;
}

.timeline-phase {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 30px;
    position: relative;
}

.timeline-phase.phase-completado {
    border-color: #88B04B;
    background: #f8fff8;
}

.timeline-phase.phase-en_curso {
    border-color: #88B04B;
    background: #f0f7e6;
}

.timeline-phase.phase-pendiente {
    border-color: #6c757d;
}

.timeline-phase.phase-no_aplicable {
    border-color: #dee2e6;
    background: #f8f9fa;
    opacity: 0.7;
}

.phase-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.phase-number {
    background: #88B04B;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9em;
}

.phase-status {
    font-size: 0.9em;
    font-weight: 600;
}

.phase-completado .phase-status { color: #88B04B; }
.phase-en_curso .phase-status { color: #88B04B; }
.phase-pendiente .phase-status { color: #6c757d; }
.phase-no_aplicable .phase-status { color: #6c757d; }

.phase-name {
    font-size: 1.5em;
    color: #333;
    margin: 10px 0;
}

.phase-dates {
    color: #666;
    font-size: 0.95em;
    margin-bottom: 16px;
}

.phase-duration {
    color: #999;
    font-style: italic;
}

.phase-details {
    margin-top: 16px;
}

.phase-stats {
    display: flex;
    gap: 24px;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e0e0e0;
}

.phase-objectives ul,
.phase-deliverables ul {
    margin: 8px 0 16px 0;
    padding-left: 20px;
}

.phase-objectives li,
.phase-deliverables li {
    margin: 6px 0;
    color: #555;
}

.phase-tools {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
}

.tool-badge {
    background: #e9ecef;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    color: #495057;
}

.phase-note {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
    padding: 12px;
    margin-top: 12px;
    border-radius: 4px;
    font-size: 0.9em;
}

.timeline-connector {
    width: 2px;
    height: 30px;
    background: #dee2e6;
    margin: 0 auto;
}

.milestones-section {
    margin: 40px 0;
}

.milestones-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.milestone-card {
    background: white;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.milestone-date {
    background: #88B04B;
    color: white;
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9em;
    margin-bottom: 10px;
}

.milestone-title {
    font-size: 1.1em;
    color: #333;
    margin: 10px 0;
}

.milestone-description {
    color: #666;
    font-size: 0.9em;
    margin: 0;
}

.team-section {
    background: #f8f9fa;
    padding: 24px;
    border-radius: 12px;
    margin: 40px 0;
}

.team-lead {
    font-size: 1.1em;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid #dee2e6;
}

.team-roles {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.role-card {
    background: white;
    padding: 16px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.role-title {
    font-weight: 700;
    color: #88B04B;
    margin-bottom: 8px;
}

.role-person {
    color: #333;
    margin-bottom: 6px;
}

.role-dedication {
    color: #666;
    font-size: 0.85em;
}

.risks-section {
    margin: 40px 0;
}

.risks-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.risks-table th {
    background: #f8f9fa;
    padding: 12px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.risks-table td {
    padding: 12px;
    border-bottom: 1px solid #e9ecef;
}

.impact-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    font-weight: 600;
    text-align: center;
}

.impact-badge.impact-bajo {
    background: #d4edda;
    color: #155724;
}

.impact-badge.impact-medio {
    background: #f0f7e6;
    color: #856404;
}

.impact-badge.impact-alto {
    background: #f8d7da;
    color: #721c24;
}

@media print {
    .timeline-phase {
        page-break-inside: avoid;
    }

    .milestone-card {
        page-break-inside: avoid;
    }
}
</style>
