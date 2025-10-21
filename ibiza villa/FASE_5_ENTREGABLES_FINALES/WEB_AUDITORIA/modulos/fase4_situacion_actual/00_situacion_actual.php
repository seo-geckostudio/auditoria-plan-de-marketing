<?php
/**
 * Módulo: Análisis Situación Actual (m4.1)
 * Fase: 4 - Recopilación de Datos
 * Páginas: 17
 */

// Extraer datos del módulo
$seccion = $datosModulo['seccion'];
$metricas_generales = $datosModulo['metricas_generales'];
$paginas = $datosModulo['paginas'];
?>

<!-- Página 1: Portada de Sección -->
<div class="audit-page section-cover-page">
    <div class="page-header">
        <div class="section-number">Sección <?php echo $seccion['numero']; ?></div>
        <h1><?php echo htmlspecialchars($seccion['titulo']); ?></h1>
        <p class="section-description"><?php echo htmlspecialchars($seccion['descripcion']); ?></p>
    </div>

    <div class="page-content">
        <div class="section-overview">
            <h2>Resumen de Métricas Generales</h2>
            <p class="period">Período de análisis: <?php echo htmlspecialchars($metricas_generales['periodo']); ?></p>

            <div class="metrics-grid-large">
                <div class="metric-card large">
                    <div class="metric-icon">
                    </div>
                    <div class="metric-content">
                        <div class="metric-value"><?php echo number_format($metricas_generales['keywords_totales']); ?></div>
                        <div class="metric-label">Keywords Totales</div>
                    </div>
                </div>
                <div class="metric-card large">
                    <div class="metric-icon">
                    </div>
                    <div class="metric-content">
                        <div class="metric-value"><?php echo number_format($metricas_generales['clics_totales']); ?></div>
                        <div class="metric-label">Clics Totales</div>
                    </div>
                </div>
                <div class="metric-card large">
                    <div class="metric-icon">
                    </div>
                    <div class="metric-content">
                        <div class="metric-value"><?php echo number_format($metricas_generales['impresiones_totales']); ?></div>
                        <div class="metric-label">Impresiones</div>
                    </div>
                </div>
                <div class="metric-card large highlight">
                    <div class="metric-icon">
                    </div>
                    <div class="metric-content">
                        <div class="metric-value"><?php echo number_format($metricas_generales['ctr_promedio'], 1); ?>%</div>
                        <div class="metric-label">CTR Promedio</div>
                    </div>
                </div>
                <div class="metric-card large">
                    <div class="metric-icon">
                    </div>
                    <div class="metric-content">
                        <div class="metric-value"><?php echo number_format($metricas_generales['posicion_promedio'], 1); ?></div>
                        <div class="metric-label">Posición Promedio</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-contents">
            <h2>Contenido de esta Sección</h2>
            <div class="contents-list">
                <div class="content-item">
                    <span>Descripción del Proyecto</span>
                </div>
                <div class="content-item">
                    <span>Analítica Web (GA4)</span>
                </div>
                <div class="content-item">
                    <span>Canales de Captación</span>
                </div>
                <div class="content-item">
                    <span>Posicionamiento y Keywords</span>
                </div>
                <div class="content-item">
                    <span>Análisis por País</span>
                </div>
                <div class="content-item">
                    <span>Conclusiones y Recomendaciones</span>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página 1</span>
    </div>
</div>

<style>
.section-cover-page {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    padding: 60px;
    min-height: 100vh;
    color: white;
}

.section-cover-page .page-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-number {
    font-size: 72px;
    font-weight: 800;
    opacity: 0.3;
    margin-bottom: -20px;
}

.section-cover-page h1 {
    font-size: 48px;
    margin: 0 0 20px 0;
    font-weight: 700;
}

.section-description {
    font-size: 18px;
    max-width: 800px;
    margin: 0 auto;
    opacity: 0.9;
    line-height: 1.6;
}

.section-overview {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
}

.section-overview h2 {
    font-size: 28px;
    margin: 0 0 10px 0;
    font-weight: 600;
}

.period {
    font-size: 16px;
    opacity: 0.9;
    margin: 0 0 30px 0;
}

.metrics-grid-large {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.metric-card.large {
    background: rgba(255,255,255,0.95);
    border-radius: 16px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.metric-card.large.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #d97706 100%);
    color: white;
}

.metric-card.large .metric-icon {
    font-size: 40px;
    margin-bottom: 15px;
    color: #88B04B;
}

.metric-card.large.highlight .metric-icon {
    color: white;
}

.metric-card.large .metric-value {
    font-size: 36px;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 5px;
}

.metric-card.large.highlight .metric-value {
    color: white;
}

.metric-card.large .metric-label {
    font-size: 13px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.metric-card.large.highlight .metric-label {
    color: rgba(255,255,255,0.9);
}

.section-contents {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
}

.section-contents h2 {
    font-size: 28px;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.contents-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.content-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
}

.content-item i {
    font-size: 24px;
    opacity: 0.8;
}

.page-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 50px;
    padding-top: 20px;
    border-top: 2px solid rgba(255,255,255,0.3);
    font-size: 14px;
}
</style>

<?php
// Renderizar páginas dinámicamente según el contenido
foreach ($paginas as $index => $pagina):
    $numero_pagina = $index + 2; // Página 1 es la portada
    $contenido = $pagina['contenido'];
    $tipo = $contenido['tipo'];
    $datos = $contenido['datos'];
?>

<?php if ($tipo === 'descripcion'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Descripción del Proyecto -->
<div class="audit-page project-description-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="project-info-grid">
            <div class="info-card">
                <div class="info-icon">
                </div>
                <div class="info-content">
                    <div class="info-label">Dominio</div>
                    <div class="info-value"><?php echo htmlspecialchars($datos['dominio']); ?></div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">
                </div>
                <div class="info-content">
                    <div class="info-label">Sector</div>
                    <div class="info-value"><?php echo htmlspecialchars($datos['sector']); ?></div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">
                </div>
                <div class="info-content">
                    <div class="info-label">CMS/Plataforma</div>
                    <div class="info-value"><?php echo htmlspecialchars($datos['cms']); ?></div>
                </div>
            </div>
        </div>

        <div class="project-details">
            <div class="detail-section">
                <h3>Mercados Objetivo</h3>
                <div class="markets-list">
                    <?php foreach ($datos['mercados_objetivo'] as $mercado): ?>
                    <div class="market-badge"><?php echo htmlspecialchars($mercado); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="detail-section">
                <h3>Idiomas Disponibles</h3>
                <div class="languages-list">
                    <?php foreach ($datos['idiomas'] as $idioma): ?>
                    <div class="language-badge"><?php echo htmlspecialchars($idioma); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="detail-section">
                <h3>Objetivos SEO Principales</h3>
                <ul class="objectives-list">
                    <?php foreach ($datos['objetivos_seo'] as $objetivo): ?>
                    <li><?php echo htmlspecialchars($objetivo); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.project-description-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.project-description-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.project-description-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.project-description-page .subtitle {
    font-size: 20px;
    color: #88B04B;
    margin: 0;
    font-weight: 600;
}

.project-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-bottom: 40px;
}

.info-card {
    display: flex;
    align-items: center;
    gap: 20px;
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.info-icon {
    font-size: 42px;
    color: #88B04B;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    border-radius: 16px;
}

.info-content {
    flex: 1;
}

.info-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 6px;
}

.info-value {
    font-size: 18px;
    color: #2d3748;
    font-weight: 700;
}

.project-details {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.detail-section {
    margin-bottom: 35px;
}

.detail-section:last-child {
    margin-bottom: 0;
}

.detail-section h3 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 20px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}

.detail-section h3 i {
    color: #88B04B;
}

.markets-list,
.languages-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.market-badge,
.language-badge {
    padding: 10px 20px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
}

.language-badge {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
}

.objectives-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.objectives-list li {
    padding: 14px 14px 14px 45px;
    background: #f7fafc;
    border-left: 4px solid #88B04B;
    border-radius: 8px;
    margin-bottom: 12px;
    position: relative;
    font-size: 15px;
    color: #2d3748;
    line-height: 1.6;
}

.objectives-list li:before {
    content: "→";
    position: absolute;
    left: 18px;
    color: #88B04B;
    font-weight: bold;
    font-size: 18px;
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
</style>

<?php elseif ($tipo === 'metricas'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Analítica Web -->
<div class="audit-page analytics-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="analytics-grid">
            <div class="analytics-card primary">
                <div class="card-icon">
                </div>
                <div class="card-content">
                    <div class="card-value"><?php echo number_format($datos['usuarios_mes']); ?></div>
                    <div class="card-label">Usuarios/Mes</div>
                </div>
            </div>
            <div class="analytics-card primary">
                <div class="card-icon">
                </div>
                <div class="card-content">
                    <div class="card-value"><?php echo number_format($datos['sesiones_mes']); ?></div>
                    <div class="card-label">Sesiones/Mes</div>
                </div>
            </div>
            <div class="analytics-card">
                <div class="card-icon">
                </div>
                <div class="card-content">
                    <div class="card-value"><?php echo number_format($datos['paginas_vistas']); ?></div>
                    <div class="card-label">Páginas Vistas</div>
                </div>
            </div>
            <div class="analytics-card">
                <div class="card-icon">
                </div>
                <div class="card-content">
                    <div class="card-value"><?php echo htmlspecialchars($datos['duracion_sesion_promedio']); ?></div>
                    <div class="card-label">Duración Promedio</div>
                </div>
            </div>
            <div class="analytics-card">
                <div class="card-icon">
                </div>
                <div class="card-content">
                    <div class="card-value"><?php echo htmlspecialchars($datos['tasa_rebote']); ?></div>
                    <div class="card-label">Tasa de Rebote</div>
                </div>
            </div>
        </div>

        <div class="traffic-sources-section">
            <h2>Fuentes de Tráfico</h2>
            <div class="sources-grid">
                <?php foreach ($datos['fuentes_trafico'] as $fuente => $porcentaje): ?>
                <div class="source-card">
                    <div class="source-header">
                        <span class="source-name"><?php echo ucfirst($fuente); ?></span>
                        <span class="source-percentage"><?php echo number_format($porcentaje, 1); ?>%</span>
                    </div>
                    <div class="source-bar">
                        <div class="source-fill" style="width: <?php echo $porcentaje; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($contenido['grafica'])):
                $grafica = $contenido['grafica'];
            ?>
            <div class="chart-container">
                <canvas id="traffic-chart-<?php echo $numero_pagina; ?>"></canvas>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('traffic-chart-<?php echo $numero_pagina; ?>').getContext('2d');
                new Chart(ctx, {
                    type: '<?php echo $grafica['tipo']; ?>',
                    data: {
                        labels: <?php echo json_encode($grafica['etiquetas']); ?>,
                        datasets: [{
                            data: <?php echo json_encode($grafica['valores']); ?>,
                            backgroundColor: <?php echo json_encode($grafica['colores']); ?>,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 20,
                                    font: { size: 13 }
                                }
                            },
                            title: {
                                display: true,
                                text: '<?php echo addslashes($grafica['titulo']); ?>',
                                font: { size: 16, weight: 'bold' }
                            }
                        }
                    }
                });
            });
            </script>
            <?php endif; ?>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.analytics-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.analytics-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.analytics-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.analytics-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.analytics-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border: 2px solid #f5f5f5;
}

.analytics-card.primary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border: none;
}

.analytics-card .card-icon {
    font-size: 36px;
    color: #88B04B;
    margin-bottom: 12px;
}

.analytics-card.primary .card-icon {
    color: white;
}

.card-value {
    font-size: 32px;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 6px;
}

.analytics-card.primary .card-value {
    color: white;
}

.card-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.analytics-card.primary .card-label {
    color: rgba(255,255,255,0.9);
}

.traffic-sources-section {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.traffic-sources-section h2 {
    font-size: 26px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.sources-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.source-card {
    padding: 20px;
    background: #f7fafc;
    border-radius: 12px;
    border: 2px solid #f5f5f5;
}

.source-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.source-name {
    font-size: 15px;
    font-weight: 600;
    color: #2d3748;
    text-transform: capitalize;
}

.source-percentage {
    font-size: 20px;
    font-weight: 800;
    color: #88B04B;
}

.source-bar {
    height: 12px;
    background: #f5f5f5;
    border-radius: 6px;
    overflow: hidden;
}

.source-fill {
    height: 100%;
    background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%);
    transition: width 1s ease;
}

.chart-container {
    height: 350px;
    margin-top: 30px;
}
</style>

<?php elseif ($tipo === 'canales'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Canales de Captación -->
<div class="audit-page channels-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="channels-grid">
            <?php foreach ($datos as $canal => $info):
                if ($canal === 'grafica') continue;
            ?>
            <div class="channel-card">
                <div class="channel-header">
                    <h3><?php echo ucfirst($canal); ?></h3>
                    <div class="channel-percentage"><?php echo number_format($info['porcentaje'], 1); ?>%</div>
                </div>
                <div class="channel-metrics">
                    <div class="channel-metric">
                        <div class="metric-value"><?php echo number_format($info['sesiones']); ?></div>
                        <div class="metric-label">Sesiones</div>
                    </div>
                    <div class="channel-metric">
                        <div class="metric-value"><?php echo number_format($info['conversiones']); ?></div>
                        <div class="metric-label">Conversiones</div>
                    </div>
                    <div class="channel-metric highlight">
                        <div class="metric-value"><?php echo number_format($info['tasa_conversion'], 1); ?>%</div>
                        <div class="metric-label">Tasa de Conversión</div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($contenido['grafica'])):
            $grafica = $contenido['grafica'];
        ?>
        <div class="chart-section">
            <canvas id="channels-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('channels-chart-<?php echo $numero_pagina; ?>').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $grafica['tipo']; ?>',
                data: {
                    labels: <?php echo json_encode($grafica['etiquetas']); ?>,
                    datasets: <?php echo json_encode($grafica['datasets']); ?>
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: '<?php echo addslashes($grafica['titulo']); ?>',
                            font: { size: 18, weight: 'bold' }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { size: 12 } }
                        },
                        x: {
                            ticks: { font: { size: 12 } }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.channels-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.channels-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.channels-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.channels-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-bottom: 40px;
}

.channel-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.channel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 3px solid #f5f5f5;
}

.channel-header h3 {
    font-size: 22px;
    color: #2d3748;
    margin: 0;
    font-weight: 700;
    text-transform: capitalize;
}

.channel-percentage {
    font-size: 32px;
    font-weight: 800;
    color: #88B04B;
}

.channel-metrics {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.channel-metric {
    text-align: center;
    padding: 18px;
    background: #f7fafc;
    border-radius: 12px;
}

.channel-metric.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
}

.channel-metric .metric-value {
    font-size: 26px;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 6px;
}

.channel-metric.highlight .metric-value {
    color: white;
}

.channel-metric .metric-label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.channel-metric.highlight .metric-label {
    color: rgba(255,255,255,0.9);
}

.chart-section {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    height: 400px;
}
</style>

<?php elseif ($tipo === 'keywords'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Posicionamiento Keywords -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="keywords-table-section">
            <h2>Top Keywords por Clics</h2>
            <table class="keywords-table">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Clics</th>
                        <th>Impresiones</th>
                        <th>CTR</th>
                        <th>Posición</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['top_keywords'] as $kw): ?>
                    <tr>
                        <td class="keyword-cell"><?php echo htmlspecialchars($kw['keyword']); ?></td>
                        <td class="numeric-cell"><?php echo number_format($kw['clics']); ?></td>
                        <td class="numeric-cell"><?php echo number_format($kw['impresiones']); ?></td>
                        <td class="numeric-cell"><?php echo number_format($kw['ctr'], 2); ?>%</td>
                        <td class="position-cell">
                            <span class="position-badge <?php echo $kw['posicion'] <= 10 ? 'good' : 'warning'; ?>">
                                <?php echo number_format($kw['posicion'], 1); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($contenido['grafica'])):
            $grafica = $contenido['grafica'];
        ?>
        <div class="chart-section">
            <canvas id="keywords-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('keywords-chart-<?php echo $numero_pagina; ?>').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($grafica['etiquetas']); ?>,
                    datasets: [{
                        label: '<?php echo $grafica['datasets'][0]['label']; ?>',
                        data: <?php echo json_encode($grafica['datasets'][0]['valores']); ?>,
                        backgroundColor: '<?php echo $grafica['datasets'][0]['color']; ?>',
                        borderRadius: 8
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: '<?php echo addslashes($grafica['titulo']); ?>',
                            font: { size: 18, weight: 'bold' }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { font: { size: 12 } }
                        },
                        y: {
                            ticks: { font: { size: 12 } }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.keywords-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.keywords-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.keywords-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.keywords-table-section {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.keywords-table-section h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.keywords-table {
    width: 100%;
    border-collapse: collapse;
}

.keywords-table thead tr {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.keywords-table th {
    padding: 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.keywords-table th:not(:first-child) {
    text-align: center;
}

.keywords-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.2s ease;
}

.keywords-table tbody tr:hover {
    background: #f7fafc;
}

.keywords-table td {
    padding: 16px;
    font-size: 14px;
}

.keyword-cell {
    font-weight: 600;
    color: #2d3748;
}

.numeric-cell {
    text-align: center;
    color: #4a5568;
    font-weight: 600;
}

.position-cell {
    text-align: center;
}

.position-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}

.position-badge.good {
    background: #f0f7e6;
    color: #065f46;
}

.position-badge.warning {
    background: #f0f7e6;
    color: #92400e;
}

.chart-section {
    background: white;
    border-radius: 16px;
    padding: 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    height: 400px;
}
</style>

<?php elseif ($tipo === 'keywords_pais'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Keywords por País -->
<div class="audit-page keywords-country-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="countries-grid">
            <?php foreach ($datos['por_pais'] as $pais_data): ?>
            <div class="country-card">
                <div class="country-header">
                    <h3><?php echo htmlspecialchars($pais_data['pais']); ?></h3>
                </div>
                <div class="country-stats">
                    <div class="stat-item">
                        <div class="stat-label">Keywords</div>
                        <div class="stat-value"><?php echo $pais_data['keywords']; ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Clics</div>
                        <div class="stat-value"><?php echo $pais_data['clics']; ?></div>
                    </div>
                    <div class="stat-item highlight">
                        <div class="stat-label">Mejor Posición</div>
                        <div class="stat-value"><?php echo number_format($pais_data['mejor_posicion'], 1); ?></div>
                    </div>
                </div>
                <div class="best-keyword">
                    <span><?php echo htmlspecialchars($pais_data['keyword_mejor']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($contenido['grafica'])):
            $grafica = $contenido['grafica'];
        ?>
        <div class="chart-section">
            <canvas id="country-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('country-chart-<?php echo $numero_pagina; ?>').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($grafica['etiquetas']); ?>,
                    datasets: [
                        {
                            label: '<?php echo $grafica['datasets'][0]['label']; ?>',
                            data: <?php echo json_encode($grafica['datasets'][0]['valores']); ?>,
                            backgroundColor: '<?php echo $grafica['datasets'][0]['color']; ?>',
                            borderRadius: 8
                        },
                        {
                            label: '<?php echo $grafica['datasets'][1]['label']; ?>',
                            data: <?php echo json_encode($grafica['datasets'][1]['valores']); ?>,
                            backgroundColor: '<?php echo $grafica['datasets'][1]['color']; ?>',
                            borderRadius: 8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { size: 13 } }
                        },
                        title: {
                            display: true,
                            text: '<?php echo addslashes($grafica['titulo']); ?>',
                            font: { size: 18, weight: 'bold' }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { size: 12 } }
                        },
                        x: {
                            ticks: { font: { size: 12 } }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.keywords-country-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.keywords-country-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.keywords-country-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.countries-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-bottom: 30px;
}

.country-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.country-header h3 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 20px 0;
    font-weight: 700;
    padding-bottom: 15px;
    border-bottom: 3px solid #88B04B;
}

.country-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: #f7fafc;
    border-radius: 10px;
}

.stat-item.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
    border: 2px solid rgba(255,255,255,0.3);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.stat-label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 6px;
}

.stat-item.highlight .stat-label {
    color: white;
    font-weight: 700;
}

.stat-value {
    font-size: 24px;
    font-weight: 800;
    color: #2d3748;
}

.stat-item.highlight .stat-value {
    color: white;
    font-weight: 900;
}

.best-keyword {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: #eef2ff;
    border-radius: 10px;
    color: #3730a3;
    font-weight: 600;
    font-size: 14px;
}

.best-keyword i {
    color: #88B04B;
}
</style>

<?php elseif ($tipo === 'conclusiones'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Conclusiones -->
<div class="audit-page conclusions-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="swot-grid">
            <div class="swot-card fortalezas">
                <div class="swot-header">
                    <h3>Fortalezas</h3>
                </div>
                <ul class="swot-list">
                    <?php foreach ($datos['fortalezas'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="swot-card debilidades">
                <div class="swot-header">
                    <h3>Debilidades</h3>
                </div>
                <ul class="swot-list">
                    <?php foreach ($datos['debilidades'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="swot-card oportunidades">
                <div class="swot-header">
                    <h3>Oportunidades</h3>
                </div>
                <ul class="swot-list">
                    <?php foreach ($datos['oportunidades'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="swot-card prioridades">
                <div class="swot-header">
                    <h3>Prioridades de Acción</h3>
                </div>
                <ul class="swot-list">
                    <?php foreach ($datos['prioridades'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis Situación Actual - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.conclusions-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.conclusions-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.conclusions-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.swot-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.swot-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.swot-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 3px solid;
}

.swot-card.fortalezas .swot-header {
    border-bottom-color: #88B04B;
}

.swot-card.debilidades .swot-header {
    border-bottom-color: #88B04B;
}

.swot-card.oportunidades .swot-header {
    border-bottom-color: #88B04B;
}

.swot-card.prioridades .swot-header {
    border-bottom-color: #88B04B;
}

.swot-header i {
    font-size: 28px;
}

.swot-card.fortalezas .swot-header i {
    color: #88B04B;
}

.swot-card.debilidades .swot-header i {
    color: #88B04B;
}

.swot-card.oportunidades .swot-header i {
    color: #88B04B;
}

.swot-card.prioridades .swot-header i {
    color: #88B04B;
}

.swot-header h3 {
    font-size: 20px;
    color: #2d3748;
    margin: 0;
    font-weight: 700;
}

.swot-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.swot-list li {
    padding: 12px 12px 12px 30px;
    margin-bottom: 10px;
    background: #f7fafc;
    border-radius: 8px;
    position: relative;
    font-size: 14px;
    color: #2d3748;
    line-height: 1.5;
}

.swot-list li:before {
    content: "•";
    position: absolute;
    left: 12px;
    font-weight: bold;
    font-size: 18px;
}

.swot-card.fortalezas .swot-list li:before {
    color: #88B04B;
}

.swot-card.debilidades .swot-list li:before {
    color: #88B04B;
}

.swot-card.oportunidades .swot-list li:before {
    color: #88B04B;
}

.swot-card.prioridades .swot-list li:before {
    color: #88B04B;
}
</style>

<?php endif; ?>

<?php endforeach; ?>
