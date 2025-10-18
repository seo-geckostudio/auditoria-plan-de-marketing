<!-- Página 1: Overview + Resumen Impacto + Fase 1 -->
<div class="audit-page action-plan-intro-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
        <p class="subtitle">Estrategia de Implementación 12 Meses</p>
    </div>

    <div class="page-content">
        <!-- Resumen Ejecutivo del Plan -->
        <div class="plan-summary">
            <h2>Resumen Ejecutivo del Plan</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="summary-content">
                        <div class="summary-label">Duración Total</div>
                        <div class="summary-value"><?php echo htmlspecialchars($datosModulo['resumen_ejecutivo']['duracion_total']); ?></div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="summary-content">
                        <div class="summary-label">Fases de Implementación</div>
                        <div class="summary-value"><?php echo $datosModulo['resumen_ejecutivo']['fases']; ?> Fases</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                    <div class="summary-content">
                        <div class="summary-label">Inversión Estimada</div>
                        <div class="summary-value"><?php echo htmlspecialchars($datosModulo['resumen_ejecutivo']['inversion_estimada']); ?></div>
                    </div>
                </div>
                <div class="summary-card highlight">
                    <div class="summary-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="summary-content">
                        <div class="summary-label">ROI Esperado</div>
                        <div class="summary-value roi-value"><?php echo htmlspecialchars($datosModulo['resumen_ejecutivo']['roi_esperado']); ?></div>
                    </div>
                </div>
            </div>
            <div class="plan-objective">
                <i class="fas fa-bullseye"></i>
                <p><?php echo htmlspecialchars($datosModulo['resumen_ejecutivo']['objetivo_principal']); ?></p>
            </div>
        </div>

        <!-- Métricas Objetivo -->
        <div class="impact-metrics">
            <h2>Métricas Objetivo (12 Meses)</h2>
            <div class="metrics-comparison-grid">
                <?php foreach ($datosModulo['resumen_impacto']['metricas_objetivo'] as $metrica): ?>
                <div class="metric-comparison-card">
                    <div class="metric-header">
                        <h4><?php echo htmlspecialchars($metrica['metrica']); ?></h4>
                    </div>
                    <div class="metric-evolution">
                        <div class="metric-current">
                            <span class="label">Actual</span>
                            <span class="value"><?php echo htmlspecialchars($metrica['actual']); ?></span>
                        </div>
                        <div class="metric-arrow">
                            <i class="fas fa-long-arrow-alt-right"></i>
                            <span class="increment <?php echo strpos($metrica['incremento'], '+') === 0 ? 'positive' : ''; ?>">
                                <?php echo htmlspecialchars($metrica['incremento']); ?>
                            </span>
                        </div>
                        <div class="metric-target">
                            <span class="label">Objetivo</span>
                            <span class="value target"><?php echo htmlspecialchars($metrica['objetivo']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Fase 1: Quick Wins -->
        <div class="phase-section phase-1">
            <div class="phase-header">
                <div class="phase-number">Fase 1</div>
                <div class="phase-title-block">
                    <h2><?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['titulo']); ?></h2>
                    <div class="phase-meta">
                        <span class="phase-duration">
                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['duracion']); ?>
                        </span>
                        <span class="phase-priority critical">
                            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['prioridad']); ?>
                        </span>
                        <span class="phase-investment">
                            <i class="fas fa-euro-sign"></i> <?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['inversion']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="phase-objective">
                <strong>Objetivo:</strong> <?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['objetivo']); ?>
            </div>
            <div class="phase-impact">
                <i class="fas fa-chart-line"></i>
                <strong>Impacto Esperado:</strong> <?php echo htmlspecialchars($datosModulo['fase_1_quick_wins']['impacto_esperado']); ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Plan de Acción SEO - Roadmap Estratégico</span>
        <span class="page-number">Página 1 de 4</span>
    </div>
</div>

<style>
.action-plan-intro-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 60px;
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 3px solid #88B04B;
}

.page-header h1 {
    font-size: 42px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.page-header .subtitle {
    font-size: 20px;
    color: #718096;
    margin: 0;
}

.plan-summary {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.plan-summary h2 {
    font-size: 26px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f7fafc;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    transition: all 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.summary-card.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    border: none;
}

.summary-card.highlight .summary-label,
.summary-card.highlight .summary-value {
    color: white;
}

.summary-icon {
    font-size: 32px;
    color: #88B04B;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 12px;
}

.summary-card.highlight .summary-icon {
    background: rgba(255,255,255,0.2);
    color: white;
}

.summary-content {
    flex: 1;
}

.summary-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 5px;
}

.summary-value {
    font-size: 20px;
    color: #2d3748;
    font-weight: 700;
}

.roi-value {
    font-size: 28px;
}

.plan-objective {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    border-radius: 12px;
    border-left: 4px solid #88B04B;
}

.plan-objective i {
    font-size: 24px;
    color: #88B04B;
    margin-top: 2px;
}

.plan-objective p {
    margin: 0;
    font-size: 16px;
    color: #2d3748;
    line-height: 1.6;
}

.impact-metrics {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.impact-metrics h2 {
    font-size: 26px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.metrics-comparison-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.metric-comparison-card {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    background: #f7fafc;
}

.metric-comparison-card .metric-header h4 {
    font-size: 15px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 600;
}

.metric-evolution {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.metric-current,
.metric-target {
    display: flex;
    flex-direction: column;
    gap: 5px;
    flex: 1;
}

.metric-current .label,
.metric-target .label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.metric-current .value {
    font-size: 18px;
    color: #718096;
    font-weight: 600;
}

.metric-target .value.target {
    font-size: 20px;
    color: #10b981;
    font-weight: 700;
}

.metric-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    padding: 0 10px;
}

.metric-arrow i {
    font-size: 24px;
    color: #88B04B;
}

.metric-arrow .increment {
    font-size: 13px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    background: #dcfce7;
    color: #10b981;
}

.phase-section {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.phase-header {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 20px;
}

.phase-number {
    font-size: 48px;
    font-weight: 800;
    color: #88B04B;
    line-height: 1;
    min-width: 80px;
}

.phase-title-block h2 {
    font-size: 26px;
    color: #2d3748;
    margin: 0 0 12px 0;
    font-weight: 600;
}

.phase-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.phase-meta span {
    font-size: 13px;
    padding: 6px 14px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
}

.phase-duration {
    background: #dbeafe;
    color: #1e40af;
}

.phase-priority.critical {
    background: #fee2e2;
    color: #991b1b;
}

.phase-investment {
    background: #dcfce7;
    color: #166534;
}

.phase-objective {
    padding: 18px;
    background: #f0f9ff;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 15px;
    color: #1e3a8a;
    line-height: 1.6;
}

.phase-impact {
    padding: 18px;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-radius: 10px;
    font-size: 15px;
    color: #065f46;
    display: flex;
    align-items: center;
    gap: 12px;
}

.phase-impact i {
    font-size: 22px;
}

.page-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 2px solid #cbd5e0;
    font-size: 13px;
    color: #718096;
}

.page-number {
    font-weight: 600;
}
</style>

<!-- Página 2: Fase 1 Tareas Detalladas -->
<div class="audit-page phase-tasks-page">
    <div class="page-header">
        <h1>Fase 1: Quick Wins - Tareas Detalladas</h1>
    </div>

    <div class="page-content">
        <div class="tasks-list">
            <?php foreach ($datosModulo['fase_1_quick_wins']['tareas'] as $index => $tarea): ?>
            <div class="task-card">
                <div class="task-header">
                    <div class="task-id"><?php echo htmlspecialchars($tarea['id']); ?></div>
                    <div class="task-title-block">
                        <h3><?php echo htmlspecialchars($tarea['tarea']); ?></h3>
                        <div class="task-meta">
                            <span class="task-priority priority-<?php echo strtolower(str_replace(['Crítica', 'Alta', 'Media'], ['critical', 'high', 'medium'], $tarea['prioridad'])); ?>">
                                <?php echo htmlspecialchars($tarea['prioridad']); ?>
                            </span>
                            <span class="task-effort">
                                <i class="fas fa-clock"></i> <?php echo htmlspecialchars($tarea['esfuerzo']); ?>
                            </span>
                            <span class="task-timing">
                                <i class="fas fa-calendar"></i> <?php echo htmlspecialchars($tarea['semanas']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="task-description">
                    <?php echo htmlspecialchars($tarea['descripcion']); ?>
                </div>
                <div class="task-details-grid">
                    <div class="task-detail">
                        <h4><i class="fas fa-user"></i> Responsable</h4>
                        <p><?php echo htmlspecialchars($tarea['responsable']); ?></p>
                    </div>
                    <div class="task-detail">
                        <h4><i class="fas fa-check-circle"></i> Entregables</h4>
                        <ul>
                            <?php foreach ($tarea['entregables'] as $entregable): ?>
                            <li><?php echo htmlspecialchars($entregable); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="task-detail">
                        <h4><i class="fas fa-chart-bar"></i> KPIs</h4>
                        <ul class="kpi-list">
                            <?php foreach ($tarea['kpis'] as $kpi): ?>
                            <li><?php echo htmlspecialchars($kpi); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if ($index == 3): break; endif; // Solo primeras 4 tareas en esta página ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="page-footer">
        <span>Plan de Acción SEO - Fase 1 Detallada</span>
        <span class="page-number">Página 2 de 4</span>
    </div>
</div>

<style>
.phase-tasks-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.phase-tasks-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.phase-tasks-page .page-header h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0;
    font-weight: 700;
}

.tasks-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.task-card {
    background: white;
    border-radius: 14px;
    padding: 28px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border-left: 5px solid #88B04B;
}

.task-header {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    margin-bottom: 16px;
}

.task-id {
    font-size: 18px;
    font-weight: 800;
    color: white;
    background: #88B04B;
    padding: 8px 16px;
    border-radius: 8px;
    min-width: 80px;
    text-align: center;
}

.task-title-block {
    flex: 1;
}

.task-title-block h3 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 600;
}

.task-meta {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.task-meta span {
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-weight: 600;
}

.task-priority {
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.task-priority.priority-critical {
    background: #fee2e2;
    color: #991b1b;
}

.task-priority.priority-high {
    background: #fef3c7;
    color: #92400e;
}

.task-priority.priority-medium {
    background: #dbeafe;
    color: #1e40af;
}

.task-effort {
    background: #e0e7ff;
    color: #3730a3;
}

.task-timing {
    background: #d1fae5;
    color: #065f46;
}

.task-description {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.6;
    margin-bottom: 20px;
    padding: 14px;
    background: #f7fafc;
    border-radius: 8px;
}

.task-details-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1.5fr;
    gap: 20px;
}

.task-detail h4 {
    font-size: 13px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.task-detail h4 i {
    color: #88B04B;
}

.task-detail p {
    font-size: 13px;
    color: #4a5568;
    margin: 0;
    line-height: 1.5;
}

.task-detail ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.task-detail ul li {
    font-size: 12px;
    color: #4a5568;
    line-height: 1.6;
    padding: 6px 0 6px 20px;
    position: relative;
}

.task-detail ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: bold;
}

.kpi-list li {
    background: #f0f9ff;
    padding: 8px 8px 8px 24px !important;
    border-radius: 6px;
    margin-bottom: 6px;
    border-left: 3px solid #0ea5e9;
}

.kpi-list li:before {
    color: #0ea5e9;
}
</style>

<!-- Página 3: Fases 2 y 3 -->
<div class="audit-page phases-overview-page">
    <div class="page-header">
        <h1>Fases 2 y 3: Contenido y Autoridad</h1>
    </div>

    <div class="page-content">
        <!-- Fase 2: Contenido Estratégico -->
        <div class="phase-section phase-2">
            <div class="phase-header">
                <div class="phase-number">Fase 2</div>
                <div class="phase-title-block">
                    <h2><?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['titulo']); ?></h2>
                    <div class="phase-meta">
                        <span class="phase-duration">
                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['duracion']); ?>
                        </span>
                        <span class="phase-priority high">
                            <i class="fas fa-star"></i> <?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['prioridad']); ?>
                        </span>
                        <span class="phase-investment">
                            <i class="fas fa-euro-sign"></i> <?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['inversion']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="phase-objective">
                <strong>Objetivo:</strong> <?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['objetivo']); ?>
            </div>
            <div class="phase-impact">
                <i class="fas fa-chart-line"></i>
                <strong>Impacto Esperado:</strong> <?php echo htmlspecialchars($datosModulo['fase_2_contenido_estrategico']['impacto_esperado']); ?>
            </div>

            <div class="tasks-summary">
                <h3>Tareas Principales (<?php echo count($datosModulo['fase_2_contenido_estrategico']['tareas']); ?>)</h3>
                <div class="tasks-grid">
                    <?php foreach ($datosModulo['fase_2_contenido_estrategico']['tareas'] as $tarea): ?>
                    <div class="task-summary-card">
                        <div class="task-summary-id"><?php echo htmlspecialchars($tarea['id']); ?></div>
                        <h4><?php echo htmlspecialchars($tarea['tarea']); ?></h4>
                        <p><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                        <div class="task-summary-meta">
                            <span class="priority-badge priority-<?php echo strtolower(str_replace(['Crítica', 'Alta', 'Media'], ['critical', 'high', 'medium'], $tarea['prioridad'])); ?>">
                                <?php echo htmlspecialchars($tarea['prioridad']); ?>
                            </span>
                            <span class="effort-badge"><?php echo htmlspecialchars($tarea['esfuerzo']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="phase-summary-box">
                <h3><i class="fas fa-clipboard-check"></i> Resumen de Fase</h3>
                <div class="summary-stats">
                    <div class="stat">
                        <span class="stat-value"><?php echo $datosModulo['fase_2_contenido_estrategico']['resumen_fase']['total_tareas']; ?></span>
                        <span class="stat-label">Tareas Totales</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value"><?php echo $datosModulo['fase_2_contenido_estrategico']['resumen_fase']['horas_totales']; ?></span>
                        <span class="stat-label">Horas Estimadas</span>
                    </div>
                </div>
                <div class="milestones">
                    <h4>Hitos Clave</h4>
                    <ul>
                        <?php foreach ($datosModulo['fase_2_contenido_estrategico']['resumen_fase']['hitos_clave'] as $hito): ?>
                        <li><?php echo htmlspecialchars($hito); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Fase 3: Autoridad y Enlaces -->
        <div class="phase-section phase-3">
            <div class="phase-header">
                <div class="phase-number">Fase 3</div>
                <div class="phase-title-block">
                    <h2><?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['titulo']); ?></h2>
                    <div class="phase-meta">
                        <span class="phase-duration">
                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['duracion']); ?>
                        </span>
                        <span class="phase-priority high">
                            <i class="fas fa-star"></i> <?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['prioridad']); ?>
                        </span>
                        <span class="phase-investment">
                            <i class="fas fa-euro-sign"></i> <?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['inversion']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="phase-objective">
                <strong>Objetivo:</strong> <?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['objetivo']); ?>
            </div>
            <div class="phase-impact">
                <i class="fas fa-chart-line"></i>
                <strong>Impacto Esperado:</strong> <?php echo htmlspecialchars($datosModulo['fase_3_autoridad_enlaces']['impacto_esperado']); ?>
            </div>

            <div class="tasks-summary compact">
                <h3>Tareas Principales (<?php echo count($datosModulo['fase_3_autoridad_enlaces']['tareas']); ?>)</h3>
                <div class="compact-tasks-list">
                    <?php foreach ($datosModulo['fase_3_autoridad_enlaces']['tareas'] as $tarea): ?>
                    <div class="compact-task-item">
                        <div class="compact-task-header">
                            <span class="compact-task-id"><?php echo htmlspecialchars($tarea['id']); ?></span>
                            <span class="compact-task-title"><?php echo htmlspecialchars($tarea['tarea']); ?></span>
                            <span class="priority-badge priority-<?php echo strtolower(str_replace(['Crítica', 'Alta', 'Media'], ['critical', 'high', 'medium'], $tarea['prioridad'])); ?>">
                                <?php echo htmlspecialchars($tarea['prioridad']); ?>
                            </span>
                        </div>
                        <div class="compact-task-desc"><?php echo htmlspecialchars($tarea['descripcion']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Plan de Acción SEO - Fases 2 y 3</span>
        <span class="page-number">Página 3 de 4</span>
    </div>
</div>

<style>
.phases-overview-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.phases-overview-page .page-header h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 40px 0;
    font-weight: 700;
    text-align: center;
}

.phase-section {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.phase-section.phase-2 {
    border-left: 5px solid #10b981;
}

.phase-section.phase-3 {
    border-left: 5px solid #f59e0b;
}

.phase-section.phase-2 .phase-number {
    color: #10b981;
}

.phase-section.phase-3 .phase-number {
    color: #f59e0b;
}

.phase-priority.high {
    background: #fef3c7;
    color: #92400e;
}

.tasks-summary h3 {
    font-size: 20px;
    color: #2d3748;
    margin: 25px 0 18px 0;
    font-weight: 600;
}

.tasks-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

.task-summary-card {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    background: #f7fafc;
    transition: all 0.3s ease;
}

.task-summary-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.task-summary-id {
    font-size: 13px;
    font-weight: 800;
    color: white;
    background: #88B04B;
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 10px;
}

.task-summary-card h4 {
    font-size: 15px;
    color: #2d3748;
    margin: 0 0 8px 0;
    font-weight: 600;
    line-height: 1.3;
}

.task-summary-card p {
    font-size: 12px;
    color: #4a5568;
    margin: 0 0 12px 0;
    line-height: 1.5;
}

.task-summary-meta {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.priority-badge,
.effort-badge {
    font-size: 10px;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.priority-badge.priority-critical {
    background: #fee2e2;
    color: #991b1b;
}

.priority-badge.priority-high {
    background: #fef3c7;
    color: #92400e;
}

.priority-badge.priority-medium {
    background: #dbeafe;
    color: #1e40af;
}

.effort-badge {
    background: #e0e7ff;
    color: #3730a3;
}

.phase-summary-box {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
}

.phase-summary-box h3 {
    font-size: 18px;
    color: #0c4a6e;
    margin: 0 0 16px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-stats {
    display: flex;
    gap: 30px;
    margin-bottom: 18px;
}

.stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #0c4a6e;
}

.stat-label {
    font-size: 12px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.milestones h4 {
    font-size: 14px;
    color: #0c4a6e;
    margin: 0 0 10px 0;
    font-weight: 600;
}

.milestones ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.milestones ul li {
    font-size: 13px;
    color: #1e3a8a;
    padding: 6px 0 6px 24px;
    position: relative;
    line-height: 1.5;
}

.milestones ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: bold;
    font-size: 16px;
}

.tasks-summary.compact .compact-tasks-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.compact-task-item {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    background: #f7fafc;
}

.compact-task-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 6px;
}

.compact-task-id {
    font-size: 11px;
    font-weight: 800;
    color: white;
    background: #88B04B;
    padding: 3px 8px;
    border-radius: 5px;
}

.compact-task-title {
    font-size: 14px;
    color: #2d3748;
    font-weight: 600;
    flex: 1;
}

.compact-task-desc {
    font-size: 12px;
    color: #4a5568;
    line-height: 1.5;
    padding-left: 24px;
}
</style>

<!-- Página 4: Fase 4 + Recursos + Timeline + KPIs -->
<div class="audit-page final-overview-page">
    <div class="page-header">
        <h1>Fase 4, Recursos y Seguimiento</h1>
    </div>

    <div class="page-content">
        <!-- Fase 4: Consolidación -->
        <div class="phase-section phase-4">
            <div class="phase-header compact">
                <div class="phase-number">Fase 4</div>
                <div class="phase-title-block">
                    <h2><?php echo htmlspecialchars($datosModulo['fase_4_consolidacion_escalado']['titulo']); ?></h2>
                    <div class="phase-meta">
                        <span class="phase-duration">
                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($datosModulo['fase_4_consolidacion_escalado']['duracion']); ?>
                        </span>
                        <span class="phase-investment">
                            <i class="fas fa-euro-sign"></i> <?php echo htmlspecialchars($datosModulo['fase_4_consolidacion_escalado']['inversion']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="phase-objective compact">
                <strong>Objetivo:</strong> <?php echo htmlspecialchars($datosModulo['fase_4_consolidacion_escalado']['objetivo']); ?>
            </div>
            <div class="mini-tasks-list">
                <?php foreach (array_slice($datosModulo['fase_4_consolidacion_escalado']['tareas'], 0, 4) as $tarea): ?>
                <span class="mini-task"><?php echo htmlspecialchars($tarea['tarea']); ?></span>
                <?php endforeach; ?>
                <span class="mini-task more">+<?php echo count($datosModulo['fase_4_consolidacion_escalado']['tareas']) - 4; ?> tareas más</span>
            </div>
        </div>

        <!-- Equipo Core -->
        <div class="resources-section">
            <h2><i class="fas fa-users"></i> Equipo Core Necesario</h2>
            <div class="team-grid">
                <?php foreach ($datosModulo['recursos_necesarios']['equipo_core'] as $miembro): ?>
                <div class="team-card">
                    <div class="team-role"><?php echo htmlspecialchars($miembro['rol']); ?></div>
                    <div class="team-dedication"><?php echo htmlspecialchars($miembro['dedicacion']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Presupuesto -->
        <div class="budget-section">
            <h2><i class="fas fa-euro-sign"></i> Presupuesto 12 Meses</h2>
            <div class="budget-grid">
                <?php
                $fases_presupuesto = ['fase_1', 'fase_2', 'fase_3', 'fase_4'];
                foreach ($fases_presupuesto as $key):
                    $fase_data = $datosModulo['presupuesto_detallado'][$key];
                ?>
                <div class="budget-card">
                    <div class="budget-phase">Fase <?php echo substr($key, -1); ?></div>
                    <div class="budget-amount"><?php echo htmlspecialchars($fase_data['total']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="budget-total">
                <span class="total-label">Total Inversión 12 Meses:</span>
                <span class="total-amount"><?php echo htmlspecialchars($datosModulo['presupuesto_detallado']['total_12_meses']['total']); ?></span>
            </div>
        </div>

        <!-- Timeline Hitos -->
        <div class="timeline-section">
            <h2><i class="fas fa-calendar-check"></i> Timeline de Hitos Clave</h2>
            <div class="timeline">
                <?php
                $meses = ['mes_1', 'mes_2', 'mes_3', 'mes_6', 'mes_9', 'mes_12'];
                foreach ($meses as $mes):
                    $mes_num = str_replace('mes_', '', $mes);
                ?>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="timeline-month">Mes <?php echo $mes_num; ?></div>
                        <ul>
                            <?php foreach ($datosModulo['calendario_hitos'][$mes] as $hito): ?>
                            <li><?php echo htmlspecialchars($hito); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- KPIs Primarios -->
        <div class="kpis-section">
            <h2><i class="fas fa-chart-line"></i> KPIs de Seguimiento</h2>
            <div class="kpis-grid">
                <?php foreach (array_slice($datosModulo['kpis_seguimiento']['metricas_primarias'], 0, 4) as $kpi): ?>
                <div class="kpi-card">
                    <div class="kpi-metric"><?php echo htmlspecialchars($kpi['metrica']); ?></div>
                    <div class="kpi-values">
                        <span class="kpi-baseline"><?php echo htmlspecialchars($kpi['baseline']); ?></span>
                        <i class="fas fa-arrow-right"></i>
                        <span class="kpi-target"><?php echo htmlspecialchars($kpi['objetivo_12m']); ?></span>
                    </div>
                    <div class="kpi-tool">
                        <i class="fas fa-tools"></i> <?php echo htmlspecialchars($kpi['herramienta']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Criterios Éxito -->
        <div class="success-criteria">
            <h2><i class="fas fa-trophy"></i> Criterios de Éxito</h2>
            <div class="criteria-columns">
                <div class="criteria-column must">
                    <h3>Must-Have (Obligatorios)</h3>
                    <ul>
                        <?php foreach ($datosModulo['criterios_exito']['must_have'] as $criterio): ?>
                        <li><?php echo htmlspecialchars($criterio); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="criteria-column should">
                    <h3>Should-Have (Esperados)</h3>
                    <ul>
                        <?php foreach (array_slice($datosModulo['criterios_exito']['should_have'], 0, 4) as $criterio): ?>
                        <li><?php echo htmlspecialchars($criterio); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Plan de Acción SEO - Visión Completa</span>
        <span class="page-number">Página 4 de 4</span>
    </div>
</div>

<style>
.final-overview-page {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.final-overview-page .page-header h1 {
    font-size: 36px;
    color: #2d3748;
    margin: 0 0 30px 0;
    font-weight: 700;
    text-align: center;
}

.phase-section.phase-4 {
    border-left: 5px solid #8b5cf6;
    padding: 20px;
    margin-bottom: 25px;
}

.phase-section.phase-4 .phase-number {
    color: #8b5cf6;
    font-size: 36px;
}

.phase-header.compact {
    margin-bottom: 12px;
}

.phase-header.compact .phase-title-block h2 {
    font-size: 22px;
    margin-bottom: 8px;
}

.phase-objective.compact {
    font-size: 13px;
    padding: 12px;
    margin-bottom: 12px;
}

.mini-tasks-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.mini-task {
    font-size: 11px;
    padding: 5px 12px;
    background: #e0e7ff;
    color: #3730a3;
    border-radius: 15px;
    font-weight: 600;
}

.mini-task.more {
    background: #cbd5e0;
    color: #2d3748;
}

.resources-section,
.budget-section,
.timeline-section,
.kpis-section,
.success-criteria {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.resources-section h2,
.budget-section h2,
.timeline-section h2,
.kpis-section h2,
.success-criteria h2 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 16px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.team-card {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    background: #f7fafc;
    text-align: center;
}

.team-role {
    font-size: 13px;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 6px;
}

.team-dedication {
    font-size: 11px;
    color: #718096;
}

.budget-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}

.budget-card {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 14px;
    text-align: center;
    background: #f7fafc;
}

.budget-phase {
    font-size: 12px;
    color: #718096;
    font-weight: 600;
    margin-bottom: 6px;
    text-transform: uppercase;
}

.budget-amount {
    font-size: 16px;
    color: #10b981;
    font-weight: 700;
}

.budget-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    border-radius: 8px;
    color: white;
}

.total-label {
    font-size: 14px;
    font-weight: 600;
}

.total-amount {
    font-size: 22px;
    font-weight: 800;
}

.timeline {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.timeline-item {
    display: flex;
    gap: 16px;
}

.timeline-marker {
    width: 16px;
    height: 16px;
    background: #88B04B;
    border-radius: 50%;
    margin-top: 6px;
    flex-shrink: 0;
}

.timeline-content {
    flex: 1;
    padding-bottom: 12px;
    border-left: 2px solid #e2e8f0;
    padding-left: 16px;
    margin-left: 7px;
}

.timeline-month {
    font-size: 14px;
    color: #88B04B;
    font-weight: 700;
    margin-bottom: 6px;
}

.timeline-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.timeline-content ul li {
    font-size: 11px;
    color: #4a5568;
    line-height: 1.5;
    padding: 3px 0;
}

.timeline-content ul li:before {
    content: "→ ";
    color: #88B04B;
}

.kpis-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.kpi-card {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 14px;
    background: #f7fafc;
}

.kpi-metric {
    font-size: 13px;
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 10px;
}

.kpi-values {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.kpi-baseline {
    font-size: 14px;
    color: #718096;
}

.kpi-values i {
    color: #88B04B;
    font-size: 14px;
}

.kpi-target {
    font-size: 16px;
    color: #10b981;
    font-weight: 700;
}

.kpi-tool {
    font-size: 10px;
    color: #718096;
}

.criteria-columns {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.criteria-column h3 {
    font-size: 14px;
    margin: 0 0 10px 0;
    font-weight: 600;
    padding: 8px;
    border-radius: 6px;
}

.criteria-column.must h3 {
    background: #fee2e2;
    color: #991b1b;
}

.criteria-column.should h3 {
    background: #dbeafe;
    color: #1e40af;
}

.criteria-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.criteria-column ul li {
    font-size: 11px;
    color: #4a5568;
    padding: 5px 0 5px 18px;
    position: relative;
    line-height: 1.4;
}

.criteria-column.must ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #ef4444;
    font-weight: bold;
}

.criteria-column.should ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #3b82f6;
    font-weight: bold;
}
</style>
