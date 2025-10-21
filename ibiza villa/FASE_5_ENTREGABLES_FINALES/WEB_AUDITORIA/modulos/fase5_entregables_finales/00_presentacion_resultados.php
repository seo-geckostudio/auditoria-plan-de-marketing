<!-- Página 1: Portada y Agenda -->
<div class="audit-page presentation-cover-page">
    <div class="cover-content">
        <div class="cover-header">
            <div class="logo-section">
                <div class="logo-placeholder">
                    <span>Logo Cliente</span>
                </div>
            </div>
        </div>

        <div class="cover-main">
            <h1 class="main-title"><?php echo htmlspecialchars($datosModulo['portada']['titulo_principal']); ?></h1>
            <h2 class="subtitle"><?php echo htmlspecialchars($datosModulo['portada']['subtitulo']); ?></h2>

            <div class="project-info">
                <div class="info-item">
                    <div>
                        <strong>Cliente:</strong>
                        <span><?php echo htmlspecialchars($datosModulo['portada']['cliente']); ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <div>
                        <strong>Proyecto:</strong>
                        <span><?php echo htmlspecialchars($datosModulo['portada']['proyecto']); ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <div>
                        <strong>Fecha:</strong>
                        <span><?php echo htmlspecialchars($datosModulo['portada']['fecha']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="cover-footer">
            <span class="version">Versión <?php echo htmlspecialchars($datosModulo['portada']['version']); ?></span>
            <span class="presented-by">Presentado por: <?php echo htmlspecialchars($datosModulo['presentado_por']); ?></span>
        </div>
    </div>
</div>

<style>
.presentation-cover-page {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.cover-content {
    width: 100%;
    max-width: 900px;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 80vh;
}

.cover-header {
    text-align: center;
}

.logo-placeholder {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    font-size: 1.2rem;
    font-weight: 600;
}

.cover-main {
    text-align: center;
    margin: 4rem 0;
}

.main-title {
    font-size: 3.5rem;
    margin: 0 0 1.5rem 0;
    font-weight: 800;
    line-height: 1.2;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.subtitle {
    font-size: 1.8rem;
    margin: 0 0 3rem 0;
    font-weight: 400;
    opacity: 0.95;
}

.project-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    max-width: 600px;
    margin: 0 auto;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 1rem;
    text-align: left;
}

.info-item div {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-item strong {
    font-size: 0.9rem;
    opacity: 0.8;
}

.info-item span {
    font-size: 1.3rem;
    font-weight: 600;
}

.cover-footer {
    display: flex;
    justify-content: space-between;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    opacity: 0.9;
}
</style>

<!-- Página 2: Agenda -->
<div class="audit-page agenda-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($datosModulo['agenda']['titulo']); ?></h1>
        <span class="duration-badge">
            Duración total: <?php echo htmlspecialchars($datosModulo['agenda']['duracion_total']); ?>
        </span>
    </div>

    <div class="page-body">
        <div class="agenda-timeline">
            <?php foreach ($datosModulo['agenda']['secciones'] as $seccion): ?>
            <div class="agenda-item">
                <div class="agenda-number"><?php echo $seccion['numero']; ?></div>
                <div class="agenda-content">
                    <div class="agenda-header">
                        <h2><?php echo htmlspecialchars($seccion['titulo']); ?></h2>
                        <span class="duration-pill">
                            <?php echo htmlspecialchars($seccion['duracion']); ?>
                        </span>
                    </div>
                    <ul class="agenda-topics">
                        <?php foreach ($seccion['temas'] as $tema): ?>
                        <li><?php echo htmlspecialchars($tema); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
.agenda-page {
    background: #f8f9fa;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    margin: -2rem -2rem 2rem -2rem;
    border-radius: 0;
}

.page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.duration-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

.agenda-timeline {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    position: relative;
    padding-left: 3rem;
}

.agenda-timeline::before {
    content: '';
    position: absolute;
    left: 40px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #88B04B 0%, #6d8f3c 100%);
}

.agenda-item {
    display: flex;
    gap: 2rem;
    position: relative;
}

.agenda-number {
    position: absolute;
    left: -3rem;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    z-index: 1;
}

.agenda-content {
    flex: 1;
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.agenda-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.agenda-header h2 {
    margin: 0;
    color: #88B04B;
    font-size: 1.5rem;
}

.duration-pill {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #e3f2fd;
    color: #1976d2;
    border-radius: 2rem;
    font-size: 0.9rem;
    font-weight: 600;
}

.agenda-topics {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.agenda-topics li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    font-size: 1.05rem;
    padding-left: 1.5rem;
    position: relative;
}

.agenda-topics li::before {
    content: '→';
    position: absolute;
    left: 0.75rem;
    color: #88B04B;
    font-weight: bold;
}
</style>

<!-- Página 3: Contexto y Objetivos -->
<div class="audit-page context-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($datosModulo['contexto_objetivos']['titulo']); ?></h1>
    </div>

    <div class="page-body">
        <!-- Situación actual -->
        <section class="current-situation">
            <h2>Situación Actual</h2>
            <p class="situation-description">
                <?php echo htmlspecialchars($datosModulo['contexto_objetivos']['situacion_actual']['descripcion']); ?>
            </p>

            <div class="metrics-grid">
                <?php foreach ($datosModulo['contexto_objetivos']['situacion_actual']['metricas'] as $metrica): ?>
                <div class="metric-card">
                    <h3><?php echo htmlspecialchars($metrica['metrica']); ?></h3>
                    <p class="metric-value"><?php echo htmlspecialchars($metrica['valor_actual']); ?></p>
                    <span class="metric-context"><?php echo htmlspecialchars($metrica['contexto']); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Objetivos de negocio -->
        <section class="business-objectives">
            <h2>Objetivos de Negocio</h2>

            <div class="objectives-grid">
                <?php foreach ($datosModulo['contexto_objetivos']['objetivos_negocio'] as $objetivo): ?>
                <div class="objective-card">
                    <h3><?php echo htmlspecialchars($objetivo['objetivo']); ?></h3>
                    <p><?php echo htmlspecialchars($objetivo['descripcion']); ?></p>
                    <div class="kpi-badge">
                        <span><?php echo htmlspecialchars($objetivo['kpi']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Alcance de la auditoría -->
        <section class="audit-scope">
            <h2>Alcance de la Auditoría</h2>

            <div class="scope-columns">
                <div class="scope-column">
                    <h3>Áreas Analizadas</h3>
                    <ul>
                        <?php foreach ($datosModulo['contexto_objetivos']['alcance_auditoria']['areas_analizadas'] as $area): ?>
                        <li><?php echo htmlspecialchars($area); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="scope-column">
                    <h3>Herramientas Utilizadas</h3>
                    <ul>
                        <?php foreach ($datosModulo['contexto_objetivos']['alcance_auditoria']['herramientas_utilizadas'] as $herramienta): ?>
                        <li><?php echo htmlspecialchars($herramienta); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="period-info">
                <strong>Periodo de datos:</strong>
                <?php echo htmlspecialchars($datosModulo['contexto_objetivos']['alcance_auditoria']['periodo_datos']); ?>
            </div>
        </section>
    </div>
</div>

<style>
.context-page {
    background: #f8f9fa;
}

.context-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.context-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #88B04B;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
}

.situation-description {
    margin: 0 0 2rem 0;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
}

.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.metric-card {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    text-align: center;
}

.metric-card h3 {
    margin: 0 0 1rem 0;
    font-size: 0.95rem;
    opacity: 0.9;
}

.metric-value {
    margin: 0;
    font-size: 2.5rem;
    font-weight: bold;
}

.metric-context {
    font-size: 0.9rem;
    opacity: 0.85;
}

.objectives-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.objective-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #88B04B;
}

.objective-card h3 {
    margin: 0 0 1rem 0;
    color: #88B04B;
    font-size: 1.2rem;
}

.objective-card p {
    margin: 0 0 1rem 0;
    line-height: 1.6;
    color: #555;
}

.kpi-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #d4edda;
    color: #155724;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 0.9rem;
}

.scope-columns {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.scope-column h3 {
    margin: 0 0 1rem 0;
    color: #333;
    font-size: 1.2rem;
}

.scope-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.scope-column li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem 0;
    padding-left: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    position: relative;
}

.scope-column li:last-child {
    border-bottom: none;
}

.scope-column li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.period-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: #e3f2fd;
    border-radius: 0.5rem;
    color: #1976d2;
    font-size: 1.05rem;
}
</style>

<!-- Página 4: Hallazgos Principales -->
<div class="audit-page findings-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($datosModulo['hallazgos_principales']['titulo']); ?></h1>
    </div>

    <div class="page-body">
        <!-- Resumen ejecutivo -->
        <div class="executive-summary">
            <p><?php echo htmlspecialchars($datosModulo['hallazgos_principales']['resumen_ejecutivo']); ?></p>
        </div>

        <!-- Fortalezas -->
        <section class="strengths-section">
            <h2>Fortalezas Identificadas</h2>

            <div class="strengths-grid">
                <?php foreach ($datosModulo['hallazgos_principales']['fortalezas'] as $fortaleza): ?>
                <div class="strength-card">
                    <h3><?php echo htmlspecialchars($fortaleza['categoria']); ?></h3>
                    <ul>
                        <?php foreach ($fortaleza['items'] as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Oportunidades -->
        <section class="opportunities-section">
            <h2>Oportunidades de Mejora</h2>

            <?php foreach ($datosModulo['hallazgos_principales']['oportunidades'] as $oportunidad): ?>
            <div class="opportunity-card">
                <div class="opportunity-header">
                    <h3><?php echo htmlspecialchars($oportunidad['categoria']); ?></h3>
                    <div class="opportunity-badges">
                        <span class="impact-badge impact-<?php echo strtolower($oportunidad['impacto']); ?>">
                            Impacto: <?php echo htmlspecialchars($oportunidad['impacto']); ?>
                        </span>
                        <span class="effort-badge effort-<?php echo strtolower($oportunidad['esfuerzo']); ?>">
                            Esfuerzo: <?php echo htmlspecialchars($oportunidad['esfuerzo']); ?>
                        </span>
                    </div>
                </div>
                <ul>
                    <?php foreach ($oportunidad['items'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="roi-badge">
                    ROI Estimado: <?php echo htmlspecialchars($oportunidad['roi_estimado']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Problemas críticos -->
        <section class="critical-issues-section">
            <h2>Problemas Críticos a Resolver</h2>

            <?php foreach ($datosModulo['hallazgos_principales']['problemas_criticos'] as $problema): ?>
            <div class="issue-card severity-<?php echo strtolower($problema['severidad']); ?>">
                <div class="issue-header">
                    <h3><?php echo htmlspecialchars($problema['problema']); ?></h3>
                    <span class="severity-badge"><?php echo htmlspecialchars($problema['severidad']); ?></span>
                </div>
                <p class="issue-description"><?php echo htmlspecialchars($problema['descripcion']); ?></p>
                <div class="issue-impact">
                    <strong>Impacto:</strong>
                    <?php echo htmlspecialchars($problema['impacto']); ?>
                </div>
                <div class="issue-solution">
                    <strong>Solución:</strong>
                    <?php echo htmlspecialchars($problema['solucion']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>

<style>
.findings-page {
    background: #f8f9fa;
}

.executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    font-size: 1.2rem;
    line-height: 1.8;
    position: relative;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.executive-summary p {
    margin: 0;
}

.findings-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.findings-page section h2 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
}

.strengths-section h2 {
    color: #88B04B;
}

.opportunities-section h2 {
    color: #88B04B;
}

.critical-issues-section h2 {
    color: #dc3545;
}

.strengths-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.strength-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-top: 4px solid #88B04B;
}

.strength-card h3 {
    margin: 0 0 1rem 0;
    color: #88B04B;
}

.strength-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.strength-card li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.strength-card li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.opportunity-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
    border-left: 4px solid #88B04B;
    margin-bottom: 1.5rem;
}

.opportunity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.opportunity-header h3 {
    margin: 0;
    color: #333;
}

.opportunity-badges {
    display: flex;
    gap: 0.75rem;
}

.impact-badge,
.effort-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
}

.impact-badge.impact-alto {
    background: #88B04B;
    color: white;
}

.impact-badge.impact-muy-alto {
    background: #dc3545;
    color: white;
}

.effort-badge.effort-bajo {
    background: #d4edda;
    color: #155724;
}

.effort-badge.effort-medio {
    background: #f0f7e6;
    color: #856404;
}

.effort-badge.effort-alto {
    background: #f8d7da;
    color: #721c24;
}

.opportunity-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
}

.opportunity-card li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.opportunity-card li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.roi-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 0.5rem;
    font-weight: bold;
}

.issue-card {
    background: #fff;
    border: 2px solid;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
}

.issue-card.severity-alta {
    border-color: #dc3545;
}

.issue-card.severity-media-alta,
.issue-card.severity-media {
    border-color: #88B04B;
}

.issue-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.issue-header h3 {
    margin: 0;
    color: #333;
}

.severity-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.85rem;
    font-weight: bold;
    background: #dc3545;
    color: white;
}

.issue-description {
    margin: 0 0 1rem 0;
    line-height: 1.6;
    color: #555;
}

.issue-impact,
.issue-solution {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.issue-impact {
    border-left: 4px solid #dc3545;
}

.issue-solution {
    border-left: 4px solid #88B04B;
}
</style>

<!-- Página 5: Plan de Acción y Próximos Pasos -->
<div class="audit-page action-plan-page">
    <div class="page-header">
        <h1>Plan de Acción y Próximos Pasos</h1>
    </div>

    <div class="page-body">
        <!-- Plan de acción resumen -->
        <section class="action-plan-summary">
            <h2><?php echo htmlspecialchars($datosModulo['plan_accion_resumen']['titulo']); ?></h2>
            <p class="plan-vision"><?php echo htmlspecialchars($datosModulo['plan_accion_resumen']['vision_general']); ?></p>

            <?php foreach ($datosModulo['plan_accion_resumen']['fases'] as $fase): ?>
            <div class="phase-card">
                <div class="phase-header">
                    <h3><?php echo htmlspecialchars($fase['fase']); ?></h3>
                    <div class="phase-meta">
                        <span class="period-badge"><?php echo htmlspecialchars($fase['periodo']); ?></span>
                        <span class="priority-badge priority-<?php echo strtolower($fase['prioridad']); ?>">
                            <?php echo htmlspecialchars($fase['prioridad']); ?>
                        </span>
                    </div>
                </div>

                <div class="phase-content">
                    <div class="phase-section">
                        <strong>Acciones principales:</strong>
                        <ul>
                            <?php foreach ($fase['acciones_principales'] as $accion): ?>
                            <li><?php echo htmlspecialchars($accion); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="phase-metrics">
                        <div class="phase-metric">
                            <div>
                                <span class="metric-label">Inversión</span>
                                <span class="metric-value"><?php echo htmlspecialchars($fase['inversion']); ?></span>
                            </div>
                        </div>
                        <div class="phase-metric">
                            <div>
                                <span class="metric-label">ROI Esperado</span>
                                <span class="metric-value"><?php echo htmlspecialchars($fase['roi_esperado']); ?></span>
                            </div>
                        </div>
                        <div class="phase-metric">
                            <div>
                                <span class="metric-label">Resultados</span>
                                <span class="metric-value"><?php echo htmlspecialchars($fase['resultados_esperados']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="total-summary">
                <div class="summary-item">
                    <strong>Inversión Total 12 Meses:</strong>
                    <span><?php echo htmlspecialchars($datosModulo['plan_accion_resumen']['inversion_total']); ?></span>
                </div>
                <div class="summary-item highlight">
                    <strong>ROI Total:</strong>
                    <span><?php echo htmlspecialchars($datosModulo['plan_accion_resumen']['roi_total_12_meses']); ?></span>
                </div>
                <div class="summary-item highlight">
                    <strong>Valor Generado:</strong>
                    <span><?php echo htmlspecialchars($datosModulo['plan_accion_resumen']['valor_generado']); ?></span>
                </div>
            </div>
        </section>

        <!-- Próximos pasos -->
        <section class="next-steps-section">
            <h2><?php echo htmlspecialchars($datosModulo['proximos_pasos']['titulo']); ?></h2>

            <div class="timeline-immediate">
                <h3>Timeline Inmediato</h3>
                <?php foreach ($datosModulo['proximos_pasos']['timeline_inmediato'] as $step): ?>
                <div class="timeline-step">
                    <div class="step-badge"><?php echo htmlspecialchars($step['plazo']); ?></div>
                    <div class="step-content">
                        <strong><?php echo htmlspecialchars($step['accion']); ?></strong>
                        <span class="step-responsible">Responsable: <?php echo htmlspecialchars($step['responsable']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="resources-kpis">
                <div class="resources-column">
                    <h3>Recursos Necesarios</h3>
                    <?php foreach ($datosModulo['proximos_pasos']['recursos_necesarios'] as $recurso): ?>
                    <div class="resource-item">
                        <h4><?php echo htmlspecialchars($recurso['recurso']); ?></h4>
                        <p><?php echo htmlspecialchars($recurso['descripcion']); ?></p>
                        <?php if (isset($recurso['dedicacion'])): ?>
                        <span class="resource-tag"><?php echo htmlspecialchars($recurso['dedicacion']); ?></span>
                        <?php endif; ?>
                        <?php if (isset($recurso['responsable'])): ?>
                        <span class="resource-tag"><?php echo htmlspecialchars($recurso['responsable']); ?></span>
                        <?php endif; ?>
                        <?php if (isset($recurso['estructura'])): ?>
                        <span class="resource-tag"><?php echo htmlspecialchars($recurso['estructura']); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="kpis-column">
                    <h3>KPIs de Seguimiento</h3>
                    <ul class="kpis-list">
                        <?php foreach ($datosModulo['proximos_pasos']['kpis_seguimiento'] as $kpi): ?>
                        <li><?php echo htmlspecialchars($kpi); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Cierre -->
        <section class="closing-section">
            <h2><?php echo htmlspecialchars($datosModulo['cierre']['titulo']); ?></h2>
            <p class="closing-message"><?php echo htmlspecialchars($datosModulo['cierre']['mensaje']); ?></p>

            <div class="contact-info">
                <div class="contact-item">
                    <strong>Email:</strong>
                    <a href="mailto:<?php echo htmlspecialchars($datosModulo['cierre']['contacto']['email']); ?>">
                        <?php echo htmlspecialchars($datosModulo['cierre']['contacto']['email']); ?>
                    </a>
                </div>
                <div class="contact-item">
                    <strong>Teléfono:</strong>
                    <span><?php echo htmlspecialchars($datosModulo['cierre']['contacto']['telefono']); ?></span>
                </div>
                <div class="contact-item">
                    <strong>Web:</strong>
                    <a href="http://<?php echo htmlspecialchars($datosModulo['cierre']['contacto']['web']); ?>">
                        <?php echo htmlspecialchars($datosModulo['cierre']['contacto']['web']); ?>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.action-plan-page {
    background: #f8f9fa;
}

.action-plan-page section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.action-plan-page section h2 {
    margin: 0 0 1.5rem 0;
    color: #88B04B;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.8rem;
}

.plan-vision {
    margin: 0 0 2rem 0;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    padding: 1rem;
    background: #f8f9fa;
    border-left: 4px solid #88B04B;
    border-radius: 0.5rem;
}

.phase-card {
    background: #f8f9fa;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
    overflow: hidden;
}

.phase-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 1.5rem;
}

.phase-header h3 {
    margin: 0;
    font-size: 1.3rem;
}

.phase-meta {
    display: flex;
    gap: 1rem;
}

.period-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
}

.priority-badge {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.priority-badge.priority-crítica {
    background: #dc3545;
}

.priority-badge.priority-alta {
    background: #88B04B;
    color: #333;
}

.phase-content {
    padding: 1.5rem;
}

.phase-section ul {
    list-style: none;
    padding: 0;
    margin: 0.5rem 0 1.5rem 0;
}

.phase-section li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.phase-section li::before {
    content: '';
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.phase-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.phase-metric {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 0.5rem;
    border: 2px solid #e0e0e0;
}

.phase-metric div {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.7;
}

.metric-value {
    font-weight: bold;
    color: #333;
}

.total-summary {
    display: flex;
    justify-content: space-around;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
}

.summary-item {
    text-align: center;
}

.summary-item strong {
    display: block;
    margin-bottom: 0.5rem;
    opacity: 0.9;
}

.summary-item span {
    font-size: 1.8rem;
    font-weight: bold;
}

.summary-item.highlight span {
    color: #ffd700;
}

.timeline-immediate {
    margin-bottom: 2rem;
}

.timeline-immediate h3 {
    margin: 0 0 1.5rem 0;
    color: #333;
}

.timeline-step {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.step-badge {
    background: #88B04B;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: bold;
    white-space: nowrap;
    align-self: flex-start;
}

.step-content {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.step-responsible {
    font-size: 0.9rem;
    opacity: 0.7;
}

.resources-kpis {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.resources-kpis h3 {
    margin: 0 0 1rem 0;
    color: #333;
}

.resource-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.resource-item h4 {
    margin: 0 0 0.5rem 0;
    color: #88B04B;
}

.resource-item p {
    margin: 0 0 0.5rem 0;
    font-size: 0.95rem;
    line-height: 1.6;
}

.resource-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: white;
    border-radius: 0.25rem;
    font-size: 0.85rem;
    margin-right: 0.5rem;
    margin-top: 0.5rem;
}

.kpis-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.kpis-list li {
    padding: 0.75rem;
    padding-left: 1.5rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
}

.kpis-list li::before {
    content: '→';
    position: absolute;
    left: 0.75rem;
    color: #88B04B;
    font-weight: bold;
}

.closing-section {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    text-align: center;
}

.closing-section h2 {
    color: white;
    font-size: 2.5rem;
    margin-bottom: 1rem;
    justify-content: center;
}

.closing-message {
    font-size: 1.3rem;
    margin: 0 0 2rem 0;
}

.contact-info {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.1rem;
}

.contact-item strong {
    font-weight: 700;
}

.contact-item a {
    color: white;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
}

.contact-item a:hover {
    border-bottom-color: white;
}
</style>
