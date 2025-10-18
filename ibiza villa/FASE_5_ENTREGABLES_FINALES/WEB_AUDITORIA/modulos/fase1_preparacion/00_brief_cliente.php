<?php
/**
 * Módulo: Brief del Cliente (m1.1)
 * Fase: 1 - Preparación
 *
 * Muestra información fundamental del proyecto capturada en el brief inicial
 */

// $datosModulo viene cargado desde data/fase1/brief_cliente.json
// $configuracionCliente contiene la configuración del proyecto

$proyecto = $datosModulo['proyecto'] ?? [];
$contacto = $datosModulo['contacto'] ?? [];
$situacion = $datosModulo['situacion_actual'] ?? [];
$objetivos = $datosModulo['objetivos'] ?? [];
$competencia = $datosModulo['competencia'] ?? [];
$recursos = $datosModulo['recursos_disponibles'] ?? [];
$timeline = $datosModulo['timeline'] ?? [];
?>

<!-- ============================================ -->
<!-- MÓDULO: BRIEF DEL CLIENTE -->
<!-- ============================================ -->
<div class="audit-page brief-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-file-alt"></i>
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Brief del Cliente'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? ''); ?></p>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <!-- Grid principal de 2 columnas -->
        <div class="brief-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px;">

            <!-- Columna Izquierda -->
            <div class="brief-column-left">

                <!-- Información del Proyecto -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-building"></i>
                        Información del Proyecto
                    </h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nombre:</span>
                            <span class="info-value"><?php echo htmlspecialchars($proyecto['nombre'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">URL:</span>
                            <span class="info-value">
                                <a href="<?php echo htmlspecialchars($proyecto['url'] ?? '#'); ?>" target="_blank">
                                    <?php echo htmlspecialchars($proyecto['url'] ?? 'N/A'); ?>
                                </a>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sector:</span>
                            <span class="info-value"><?php echo htmlspecialchars($proyecto['sector'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Ubicación:</span>
                            <span class="info-value"><?php echo htmlspecialchars($proyecto['ubicacion'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Idiomas:</span>
                            <span class="info-value">
                                <?php echo htmlspecialchars(implode(', ', $proyecto['idiomas'] ?? [])); ?>
                            </span>
                        </div>
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <span class="info-label">Público Objetivo:</span>
                            <span class="info-value"><?php echo htmlspecialchars($proyecto['publico_objetivo'] ?? 'N/A'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Situación Actual -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-chart-line"></i>
                        Situación Actual
                    </h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Antigüedad Web:</span>
                            <span class="info-value"><?php echo htmlspecialchars($situacion['antiguedad_web'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">CMS:</span>
                            <span class="info-value"><?php echo htmlspecialchars($situacion['cms'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Hosting:</span>
                            <span class="info-value"><?php echo htmlspecialchars($situacion['hosting'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tráfico Mensual:</span>
                            <span class="info-value"><?php echo htmlspecialchars($situacion['trafico_mensual'] ?? 'N/A'); ?></span>
                        </div>
                    </div>

                    <?php if (!empty($situacion['problemas_principales'])): ?>
                    <div class="mt-3">
                        <strong class="d-block mb-2">Problemas Principales:</strong>
                        <ul class="problems-list">
                            <?php foreach ($situacion['problemas_principales'] as $problema): ?>
                            <li>
                                <i class="fas fa-exclamation-circle text-warning"></i>
                                <?php echo htmlspecialchars($problema); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Competencia -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-users"></i>
                        Competencia
                    </h2>
                    <?php if (!empty($competencia['principales_competidores'])): ?>
                    <div class="mb-3">
                        <strong class="d-block mb-2">Principales Competidores:</strong>
                        <ul class="competitors-list">
                            <?php foreach ($competencia['principales_competidores'] as $competidor): ?>
                            <li>
                                <i class="fas fa-globe"></i>
                                <a href="https://<?php echo htmlspecialchars($competidor); ?>" target="_blank">
                                    <?php echo htmlspecialchars($competidor); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($competencia['ventajas_competitivas'])): ?>
                    <div>
                        <strong class="d-block mb-2">Ventajas Competitivas:</strong>
                        <ul class="advantages-list">
                            <?php foreach ($competencia['ventajas_competitivas'] as $ventaja): ?>
                            <li>
                                <i class="fas fa-check-circle text-success"></i>
                                <?php echo htmlspecialchars($ventaja); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Columna Derecha -->
            <div class="brief-column-right">

                <!-- Objetivos -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-bullseye"></i>
                        Objetivos del Proyecto
                    </h2>
                    <?php if (!empty($objetivos['principales'])): ?>
                    <ul class="objectives-list">
                        <?php foreach ($objetivos['principales'] as $objetivo): ?>
                        <li>
                            <i class="fas fa-arrow-right text-primary"></i>
                            <?php echo htmlspecialchars($objetivo); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($objetivos['kpis'])): ?>
                    <div class="kpis-section mt-4">
                        <strong class="d-block mb-3">KPIs Objetivo:</strong>
                        <div class="kpis-grid" style="display: grid; gap: 16px;">
                            <?php foreach ($objetivos['kpis'] as $kpi): ?>
                            <div class="kpi-card">
                                <h4 class="kpi-metric"><?php echo htmlspecialchars($kpi['metrica']); ?></h4>
                                <div class="kpi-values">
                                    <div class="kpi-current">
                                        <span class="kpi-label">Actual:</span>
                                        <span class="kpi-value"><?php echo htmlspecialchars($kpi['valor_actual']); ?></span>
                                    </div>
                                    <div class="kpi-arrow">→</div>
                                    <div class="kpi-target">
                                        <span class="kpi-label">Objetivo:</span>
                                        <span class="kpi-value text-success"><?php echo htmlspecialchars($kpi['objetivo']); ?></span>
                                    </div>
                                </div>
                                <div class="kpi-increment">
                                    <i class="fas fa-arrow-up"></i>
                                    <?php echo htmlspecialchars($kpi['incremento']); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Recursos Disponibles -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-tools"></i>
                        Recursos Disponibles
                    </h2>

                    <?php if (!empty($recursos['accesos'])): ?>
                    <div class="mb-3">
                        <strong class="d-block mb-2">Accesos y Herramientas:</strong>
                        <ul class="resources-list">
                            <?php foreach ($recursos['accesos'] as $acceso): ?>
                            <li>
                                <i class="fas fa-key text-info"></i>
                                <?php echo htmlspecialchars($acceso); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($recursos['equipo_interno'])): ?>
                    <div class="mb-3">
                        <strong class="d-block mb-2">Equipo Interno:</strong>
                        <ul class="resources-list">
                            <?php foreach ($recursos['equipo_interno'] as $miembro): ?>
                            <li>
                                <i class="fas fa-user text-primary"></i>
                                <?php echo htmlspecialchars($miembro); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($recursos['presupuesto_seo'])): ?>
                    <div class="budget-box">
                        <strong>Presupuesto SEO:</strong>
                        <span class="budget-value"><?php echo htmlspecialchars($recursos['presupuesto_seo']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Timeline -->
                <div class="brief-section">
                    <h2 class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Timeline del Proyecto
                    </h2>
                    <div class="timeline-simple">
                        <?php foreach ($timeline as $fase => $fecha): ?>
                        <div class="timeline-item-simple">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content-simple">
                                <strong><?php echo ucfirst(str_replace('_', ' ', $fase)); ?>:</strong>
                                <span><?php echo htmlspecialchars($fecha); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Footer de la página -->
    <div class="page-footer">
        <div class="footer-left">
            <?php echo htmlspecialchars($configuracionCliente['proyecto']['nombre'] ?? 'Proyecto'); ?>
        </div>
        <div class="footer-center">
            Auditoría SEO | Fase 1: Preparación
        </div>
        <div class="footer-right">
            Página <span class="page-number"></span>
        </div>
    </div>

</div>

<style>
/* Estilos específicos para el brief */
.brief-section {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 24px;
    margin-bottom: 24px;
}

.section-title {
    font-size: 1.3em;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #88B04B;
}

.section-title i {
    margin-right: 8px;
    color: #88B04B;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
}

.info-item {
    display: flex;
    padding: 8px;
    border-bottom: 1px solid #f0f0f0;
}

.info-label {
    font-weight: 600;
    color: #666;
    min-width: 140px;
}

.info-value {
    color: #333;
    flex: 1;
}

.problems-list, .competitors-list, .advantages-list, .objectives-list, .resources-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.problems-list li, .competitors-list li, .advantages-list li, .objectives-list li, .resources-list li {
    padding: 8px 0;
    padding-left: 24px;
    position: relative;
}

.problems-list i, .competitors-list i, .advantages-list i, .objectives-list i, .resources-list i {
    position: absolute;
    left: 0;
    top: 10px;
}

.kpi-card {
    background: #f8f9fa;
    border-left: 4px solid #88B04B;
    padding: 16px;
    border-radius: 4px;
}

.kpi-metric {
    font-size: 1em;
    margin-bottom: 12px;
    color: #333;
}

.kpi-values {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}

.kpi-arrow {
    font-size: 1.5em;
    color: #88B04B;
}

.kpi-label {
    font-size: 0.85em;
    color: #666;
    display: block;
}

.kpi-value {
    font-weight: 600;
    font-size: 1.1em;
}

.kpi-increment {
    color: #88B04B;
    font-weight: 600;
    font-size: 0.95em;
}

.budget-box {
    background: #e8f5e9;
    padding: 16px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.budget-value {
    font-size: 1.5em;
    font-weight: 700;
    color: #2e7d32;
}

.timeline-simple {
    position: relative;
    padding-left: 24px;
}

.timeline-item-simple {
    position: relative;
    padding-bottom: 20px;
}

.timeline-dot {
    position: absolute;
    left: -28px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #88B04B;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #88B04B;
}

.timeline-content-simple {
    display: flex;
    flex-direction: column;
}

.timeline-content-simple strong {
    color: #333;
    margin-bottom: 4px;
}

.timeline-content-simple span {
    color: #666;
    font-size: 0.95em;
}
</style>
