<?php
/**
 * Módulo: Análisis de Demanda (m4.2)
 * Fase: 4 - Recopilación de Datos
 * Páginas: 5
 */

$seccion = $datosModulo['seccion'];
$paginas = $datosModulo['paginas'];
?>

<!-- Página 1: Portada de Sección -->
<div class="audit-page demand-cover-page">
    <div class="page-header">
        <div class="section-number">Sección <?php echo $seccion['numero']; ?></div>
        <h1><?php echo htmlspecialchars($seccion['titulo']); ?></h1>
        <p class="section-description"><?php echo htmlspecialchars($seccion['descripcion']); ?></p>
    </div>

    <div class="page-content">
        <div class="cover-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Keyword Research</h3>
                <p>Análisis exhaustivo de palabras clave por mercado y oportunidades de posicionamiento</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe-europe"></i>
                </div>
                <h3>Análisis por Mercado</h3>
                <p>Evaluación detallada de 4 mercados principales: España, Francia, Alemania y Reino Unido</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Oportunidades</h3>
                <p>Identificación de keywords transaccionales y oportunidades de crecimiento rápido</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Estrategia</h3>
                <p>Roadmap de optimización y prioridades para maximizar ROI</p>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis de Demanda - IbizaVilla.com</span>
        <span class="page-number">Página 1</span>
    </div>
</div>

<style>
.demand-cover-page {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
    padding: 60px;
    min-height: 100vh;
    color: white;
}

.demand-cover-page .page-header {
    text-align: center;
    margin-bottom: 60px;
}

.section-number {
    font-size: 72px;
    font-weight: 800;
    opacity: 0.3;
    margin-bottom: -20px;
}

.demand-cover-page h1 {
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

.cover-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.feature-card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
}

.feature-icon {
    font-size: 56px;
    margin-bottom: 20px;
    opacity: 0.9;
}

.feature-card h3 {
    font-size: 24px;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.feature-card p {
    font-size: 15px;
    margin: 0;
    opacity: 0.9;
    line-height: 1.6;
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
// Renderizar páginas dinámicamente
foreach ($paginas as $index => $pagina):
    $numero_pagina = $index + 2;
    $contenido = $pagina['contenido'];
    $tipo = $contenido['tipo'];
    $datos = $contenido['datos'];
?>

<?php if ($tipo === 'keyword_research'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Keyword Research Overview -->
<div class="audit-page keyword-research-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <div class="research-summary">
            <h2>Resumen General</h2>
            <div class="summary-metrics">
                <div class="summary-metric">
                    <div class="metric-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="metric-value"><?php echo number_format($datos['resumen']['keywords_totales']); ?></div>
                    <div class="metric-label">Keywords Totales</div>
                </div>
                <div class="summary-metric">
                    <div class="metric-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="metric-value"><?php echo $datos['resumen']['mercados_analizados']; ?></div>
                    <div class="metric-label">Mercados Analizados</div>
                </div>
                <div class="summary-metric highlight">
                    <div class="metric-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="metric-value"><?php echo number_format($datos['resumen']['volumen_busqueda_mensual']); ?></div>
                    <div class="metric-label">Vol. Búsqueda/Mes</div>
                </div>
                <div class="summary-metric">
                    <div class="metric-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="metric-value"><?php echo $datos['resumen']['oportunidades_identificadas']; ?></div>
                    <div class="metric-label">Oportunidades</div>
                </div>
            </div>
        </div>

        <div class="markets-analysis">
            <h2>Análisis por Mercado</h2>
            <table class="markets-table">
                <thead>
                    <tr>
                        <th>País</th>
                        <th>Keywords</th>
                        <th>Clics</th>
                        <th>Impresiones</th>
                        <th>CTR (%)</th>
                        <th>Pos. Media</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['mercados'] as $mercado): ?>
                    <tr>
                        <td class="country-cell">
                            <strong><?php echo htmlspecialchars($mercado['pais']); ?></strong>
                        </td>
                        <td class="numeric-cell"><?php echo $mercado['keywords']; ?></td>
                        <td class="numeric-cell"><?php echo $mercado['clics']; ?></td>
                        <td class="numeric-cell"><?php echo number_format($mercado['impresiones']); ?></td>
                        <td class="numeric-cell"><?php echo number_format($mercado['ctr'], 2); ?>%</td>
                        <td class="position-cell">
                            <span class="position-badge <?php echo $mercado['posicion_media'] <= 10 ? 'good' : 'warning'; ?>">
                                <?php echo number_format($mercado['posicion_media'], 1); ?>
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
            <canvas id="research-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('research-chart-<?php echo $numero_pagina; ?>').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $grafica['tipo']; ?>',
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
        <span>Análisis de Demanda - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.keyword-research-page {
    background: #f7fafc;
    padding: 60px;
    min-height: 100vh;
}

.keyword-research-page .page-header {
    text-align: center;
    margin-bottom: 40px;
}

.keyword-research-page h1 {
    font-size: 38px;
    color: #2d3748;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.keyword-research-page .subtitle {
    font-size: 18px;
    color: #88B04B;
    margin: 0;
    font-weight: 600;
}

.research-summary {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.research-summary h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.summary-metrics {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.summary-metric {
    text-align: center;
    padding: 25px;
    background: #f7fafc;
    border-radius: 14px;
    border: 2px solid #f5f5f5;
}

.summary-metric.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
    color: white;
    border: none;
}

.summary-metric .metric-icon {
    font-size: 36px;
    color: #88B04B;
    margin-bottom: 12px;
}

.summary-metric.highlight .metric-icon {
    color: white;
}

.summary-metric .metric-value {
    font-size: 32px;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 6px;
}

.summary-metric.highlight .metric-value {
    color: white;
}

.summary-metric .metric-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.summary-metric.highlight .metric-label {
    color: rgba(255,255,255,0.9);
}

.markets-analysis {
    background: white;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.markets-analysis h2 {
    font-size: 24px;
    color: #2d3748;
    margin: 0 0 25px 0;
    font-weight: 600;
}

.markets-table {
    width: 100%;
    border-collapse: collapse;
}

.markets-table thead tr {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
    color: white;
}

.markets-table th {
    padding: 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.markets-table th:not(:first-child) {
    text-align: center;
}

.markets-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
}

.markets-table tbody tr:hover {
    background: #f7fafc;
}

.markets-table td {
    padding: 16px;
    font-size: 14px;
}

.country-cell {
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
    height: 350px;
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

<?php elseif ($tipo === 'oportunidades_pais'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Oportunidades por País -->
<div class="audit-page country-opportunities-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <!-- Situación Actual -->
        <div class="current-situation">
            <h2><i class="fas fa-chart-pie"></i> Situación Actual - <?php echo htmlspecialchars($datos['pais']); ?></h2>
            <div class="situation-grid">
                <div class="situation-metric">
                    <div class="metric-value"><?php echo $datos['situacion_actual']['keywords_activas']; ?></div>
                    <div class="metric-label">Keywords Activas</div>
                </div>
                <div class="situation-metric">
                    <div class="metric-value"><?php echo $datos['situacion_actual']['clics_totales']; ?></div>
                    <div class="metric-label">Clics Totales</div>
                </div>
                <div class="situation-metric">
                    <div class="metric-value"><?php echo number_format($datos['situacion_actual']['impresiones']); ?></div>
                    <div class="metric-label">Impresiones</div>
                </div>
                <div class="situation-metric">
                    <div class="metric-value"><?php echo number_format($datos['situacion_actual']['ctr_promedio'], 2); ?>%</div>
                    <div class="metric-label">CTR Promedio</div>
                </div>
                <div class="situation-metric highlight">
                    <div class="metric-value"><?php echo number_format($datos['situacion_actual']['posicion_promedio'], 1); ?></div>
                    <div class="metric-label">Posición Promedio</div>
                </div>
            </div>
        </div>

        <!-- Fortalezas -->
        <div class="strengths-section">
            <h3><i class="fas fa-check-circle"></i> Fortalezas Identificadas</h3>
            <ul class="strengths-list">
                <?php foreach ($datos['fortalezas'] as $fortaleza): ?>
                <li><?php echo htmlspecialchars($fortaleza); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Oportunidades Críticas -->
        <div class="opportunities-section">
            <h3><i class="fas fa-bullseye"></i> Oportunidades Críticas</h3>
            <table class="opportunities-table">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Posición Actual</th>
                        <th>Impresiones</th>
                        <th>Potencial Clics</th>
                        <th>Prioridad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['oportunidades_criticas'] as $opp): ?>
                    <tr>
                        <td class="keyword-cell"><?php echo htmlspecialchars($opp['keyword']); ?></td>
                        <td class="numeric-cell"><?php echo number_format($opp['posicion_actual'], 1); ?></td>
                        <td class="numeric-cell"><?php echo number_format($opp['impresiones']); ?></td>
                        <td class="numeric-cell strong"><?php echo $opp['potencial_clics']; ?></td>
                        <td class="priority-cell">
                            <span class="priority-badge priority-<?php echo strtolower($opp['prioridad']); ?>">
                                <?php echo htmlspecialchars($opp['prioridad']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Plan de Acción -->
        <div class="action-plan-grid">
            <div class="action-plan-card phase-1">
                <h4><i class="fas fa-rocket"></i> Fase 1 (Meses 1-3)</h4>
                <ul>
                    <?php foreach ($datos['plan_accion']['fase_1'] as $accion): ?>
                    <li><?php echo htmlspecialchars($accion); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="action-plan-card phase-2">
                <h4><i class="fas fa-chart-line"></i> Fase 2 (Meses 4-6)</h4>
                <ul>
                    <?php foreach ($datos['plan_accion']['fase_2'] as $accion): ?>
                    <li><?php echo htmlspecialchars($accion); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <?php if (isset($contenido['grafica'])):
            $grafica = $contenido['grafica'];
        ?>
        <div class="chart-compact">
            <canvas id="opp-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('opp-chart-<?php echo $numero_pagina; ?>').getContext('2d');
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
                            font: { size: 16, weight: 'bold' }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { font: { size: 11 } }
                        },
                        y: {
                            ticks: { font: { size: 11 } }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis de Demanda - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.country-opportunities-page {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.country-opportunities-page .page-header {
    text-align: center;
    margin-bottom: 30px;
}

.country-opportunities-page h1 {
    font-size: 34px;
    color: #2d3748;
    margin: 0 0 8px 0;
    font-weight: 700;
}

.current-situation {
    background: white;
    border-radius: 14px;
    padding: 28px;
    margin-bottom: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.current-situation h2 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 20px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.current-situation h2 i {
    color: #88B04B;
}

.situation-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 15px;
}

.situation-metric {
    text-align: center;
    padding: 18px;
    background: #f7fafc;
    border-radius: 10px;
}

.situation-metric.highlight {
    background: linear-gradient(135deg, #88B04B 0%, #059669 100%);
    color: white;
}

.situation-metric .metric-value {
    font-size: 26px;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 6px;
}

.situation-metric.highlight .metric-value {
    color: white;
}

.situation-metric .metric-label {
    font-size: 11px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.situation-metric.highlight .metric-label {
    color: rgba(255,255,255,0.9);
}

.strengths-section {
    background: linear-gradient(135deg, #f0f7e6 0%, #a7f3d0 100%);
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 25px;
}

.strengths-section h3 {
    font-size: 18px;
    color: #065f46;
    margin: 0 0 15px 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.strengths-section h3 i {
    font-size: 22px;
}

.strengths-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.strengths-list li {
    padding: 10px 10px 10px 30px;
    margin-bottom: 8px;
    background: rgba(255,255,255,0.6);
    border-radius: 8px;
    position: relative;
    font-size: 13px;
    color: #065f46;
    line-height: 1.5;
    font-weight: 500;
}

.strengths-list li:before {
    content: "✓";
    position: absolute;
    left: 10px;
    color: #88B04B;
    font-weight: bold;
    font-size: 16px;
}

.opportunities-section {
    background: white;
    border-radius: 14px;
    padding: 28px;
    margin-bottom: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.opportunities-section h3 {
    font-size: 18px;
    color: #2d3748;
    margin: 0 0 18px 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.opportunities-section h3 i {
    color: #88B04B;
    font-size: 22px;
}

.opportunities-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.opportunities-table thead tr {
    background: #f7fafc;
    border-bottom: 2px solid #f5f5f5;
}

.opportunities-table th {
    padding: 12px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #4a5568;
}

.opportunities-table th:not(:first-child) {
    text-align: center;
}

.opportunities-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
}

.opportunities-table tbody tr:hover {
    background: #f7fafc;
}

.opportunities-table td {
    padding: 12px;
}

.keyword-cell {
    font-weight: 600;
    color: #2d3748;
}

.numeric-cell {
    text-align: center;
    color: #4a5568;
    font-weight: 500;
}

.numeric-cell.strong {
    font-weight: 800;
    color: #88B04B;
    font-size: 15px;
}

.priority-cell {
    text-align: center;
}

.priority-badge {
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.priority-badge.priority-alta {
    background: #f0f7e6;
    color: #991b1b;
}

.priority-badge.priority-media {
    background: #f0f7e6;
    color: #92400e;
}

.action-plan-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.action-plan-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.action-plan-card.phase-1 {
    border-left: 5px solid #88B04B;
}

.action-plan-card.phase-2 {
    border-left: 5px solid #88B04B;
}

.action-plan-card h4 {
    font-size: 16px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.action-plan-card.phase-1 h4 i {
    color: #88B04B;
}

.action-plan-card.phase-2 h4 i {
    color: #88B04B;
}

.action-plan-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.action-plan-card ul li {
    padding: 8px 8px 8px 24px;
    margin-bottom: 8px;
    background: #f7fafc;
    border-radius: 6px;
    position: relative;
    font-size: 13px;
    color: #2d3748;
    line-height: 1.5;
}

.action-plan-card ul li:before {
    content: "→";
    position: absolute;
    left: 8px;
    font-weight: bold;
}

.action-plan-card.phase-1 ul li:before {
    color: #88B04B;
}

.action-plan-card.phase-2 ul li:before {
    color: #88B04B;
}

.chart-compact {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    height: 280px;
}
</style>

<?php elseif ($tipo === 'keywords_transaccionales'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Keywords Transaccionales -->
<div class="audit-page transactional-keywords-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <!-- Definición y Resumen -->
        <div class="definition-box">
            <div class="definition-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="definition-content">
                <h3>¿Qué son Keywords Transaccionales?</h3>
                <p><?php echo htmlspecialchars($datos['definicion']); ?></p>
                <div class="definition-stats">
                    <div class="def-stat">
                        <span class="stat-value"><?php echo $datos['total_keywords_transaccionales']; ?></span>
                        <span class="stat-label">Keywords Identificadas</span>
                    </div>
                    <div class="def-stat highlight">
                        <span class="stat-value"><?php echo number_format($datos['conversion_rate_promedio'], 1); ?>%</span>
                        <span class="stat-label">Conversión Promedio</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Keywords Transaccionales -->
        <div class="transactional-table-section">
            <h2>Top Keywords Transaccionales</h2>
            <table class="trans-keywords-table">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Posición</th>
                        <th>Clics</th>
                        <th>Imp.</th>
                        <th>CTR</th>
                        <th>Conv. Est.</th>
                        <th>Mercado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['top_keywords'] as $kw): ?>
                    <tr>
                        <td class="keyword-cell"><?php echo htmlspecialchars($kw['keyword']); ?></td>
                        <td class="numeric-cell">
                            <span class="position-badge <?php echo $kw['posicion'] <= 10 ? 'good' : 'warning'; ?>">
                                <?php echo number_format($kw['posicion'], 1); ?>
                            </span>
                        </td>
                        <td class="numeric-cell"><?php echo $kw['clics']; ?></td>
                        <td class="numeric-cell"><?php echo $kw['impresiones']; ?></td>
                        <td class="numeric-cell"><?php echo number_format($kw['ctr'], 2); ?>%</td>
                        <td class="conversion-cell">
                            <strong><?php echo number_format($kw['conversion_estimada'], 1); ?>%</strong>
                        </td>
                        <td class="market-cell"><?php echo htmlspecialchars($kw['mercado']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Recomendaciones -->
        <div class="recommendations-section">
            <h2><i class="fas fa-lightbulb"></i> Recomendaciones Estratégicas</h2>
            <div class="recommendations-grid">
                <?php foreach ($datos['recomendaciones'] as $index => $recomendacion): ?>
                <div class="recommendation-card">
                    <div class="rec-number"><?php echo $index + 1; ?></div>
                    <p><?php echo htmlspecialchars($recomendacion); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (isset($contenido['grafica'])):
            $grafica = $contenido['grafica'];
        ?>
        <div class="chart-section">
            <canvas id="trans-chart-<?php echo $numero_pagina; ?>"></canvas>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('trans-chart-<?php echo $numero_pagina; ?>').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($grafica['etiquetas']); ?>,
                    datasets: [
                        {
                            label: '<?php echo $grafica['datasets'][0]['label']; ?>',
                            data: <?php echo json_encode($grafica['datasets'][0]['valores']); ?>,
                            backgroundColor: '<?php echo $grafica['datasets'][0]['color']; ?>',
                            borderRadius: 6
                        },
                        {
                            label: '<?php echo $grafica['datasets'][1]['label']; ?>',
                            data: <?php echo json_encode($grafica['datasets'][1]['valores']); ?>,
                            backgroundColor: '<?php echo $grafica['datasets'][1]['color']; ?>',
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { size: 12 } }
                        },
                        title: {
                            display: true,
                            text: '<?php echo addslashes($grafica['titulo']); ?>',
                            font: { size: 16, weight: 'bold' }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { size: 11 } }
                        },
                        x: {
                            ticks: { font: { size: 10 } }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>
    </div>

    <div class="page-footer">
        <span>Análisis de Demanda - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.transactional-keywords-page {
    background: #f7fafc;
    padding: 50px;
    min-height: 100vh;
}

.transactional-keywords-page .page-header {
    text-align: center;
    margin-bottom: 30px;
}

.transactional-keywords-page h1 {
    font-size: 34px;
    color: #2d3748;
    margin: 0 0 8px 0;
    font-weight: 700;
}

.definition-box {
    display: flex;
    gap: 25px;
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    border-radius: 14px;
    padding: 30px;
    margin-bottom: 28px;
    border-left: 5px solid #88B04B;
}

.definition-icon {
    font-size: 48px;
    color: #88B04B;
}

.definition-content {
    flex: 1;
}

.definition-content h3 {
    font-size: 18px;
    color: #1e3a8a;
    margin: 0 0 12px 0;
    font-weight: 700;
}

.definition-content p {
    font-size: 14px;
    color: #1e40af;
    margin: 0 0 18px 0;
    line-height: 1.6;
}

.definition-stats {
    display: flex;
    gap: 25px;
}

.def-stat {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.def-stat .stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #1e3a8a;
}

.def-stat.highlight .stat-value {
    color: #88B04B;
}

.def-stat .stat-label {
    font-size: 11px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.transactional-table-section {
    background: white;
    border-radius: 14px;
    padding: 28px;
    margin-bottom: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.transactional-table-section h2 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 20px 0;
    font-weight: 600;
}

.trans-keywords-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.trans-keywords-table thead tr {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.trans-keywords-table th {
    padding: 12px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.trans-keywords-table th:not(:first-child) {
    text-align: center;
}

.trans-keywords-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
}

.trans-keywords-table tbody tr:hover {
    background: #f7fafc;
}

.trans-keywords-table td {
    padding: 12px;
}

.conversion-cell {
    text-align: center;
    color: #88B04B;
    font-size: 14px;
}

.market-cell {
    text-align: center;
    font-size: 12px;
    color: #4a5568;
}

.recommendations-section {
    background: white;
    border-radius: 14px;
    padding: 28px;
    margin-bottom: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.recommendations-section h2 {
    font-size: 20px;
    color: #2d3748;
    margin: 0 0 20px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.recommendations-section h2 i {
    color: #88B04B;
}

.recommendations-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.recommendation-card {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 18px;
    background: #f7fafc;
    border-radius: 10px;
    border-left: 4px solid #88B04B;
}

.rec-number {
    font-size: 20px;
    font-weight: 800;
    color: white;
    background: #88B04B;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.recommendation-card p {
    margin: 0;
    font-size: 13px;
    color: #2d3748;
    line-height: 1.6;
}

.chart-section {
    background: white;
    border-radius: 14px;
    padding: 28px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    height: 320px;
}
</style>

<?php elseif ($tipo === 'conclusiones'): ?>
<!-- Página <?php echo $numero_pagina; ?>: Conclusiones -->
<div class="audit-page demand-conclusions-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($pagina['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($pagina['subtitulo']); ?></p>
    </div>

    <div class="page-content">
        <!-- Hallazgos Clave -->
        <div class="key-findings">
            <h2><i class="fas fa-search"></i> Hallazgos Clave</h2>
            <div class="findings-list">
                <?php foreach ($datos['hallazgos_clave'] as $hallazgo): ?>
                <div class="finding-item">
                    <i class="fas fa-chart-bar"></i>
                    <span><?php echo htmlspecialchars($hallazgo); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- DAFO Compacto -->
        <div class="dafo-compact-grid">
            <div class="dafo-compact fortalezas">
                <h3><i class="fas fa-check-circle"></i> Fortalezas</h3>
                <ul>
                    <?php foreach ($datos['fortalezas'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="dafo-compact debilidades">
                <h3><i class="fas fa-exclamation-triangle"></i> Debilidades</h3>
                <ul>
                    <?php foreach ($datos['debilidades'] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Quick Wins -->
        <div class="quick-wins-section">
            <h2><i class="fas fa-bolt"></i> Oportunidades Quick Wins</h2>
            <div class="quick-wins-grid">
                <?php foreach ($datos['oportunidades_quick_wins'] as $qw): ?>
                <div class="quick-win-card">
                    <div class="qw-header">
                        <span class="qw-roi roi-<?php echo strtolower(str_replace(' ', '-', $qw['roi'])); ?>">
                            ROI: <?php echo htmlspecialchars($qw['roi']); ?>
                        </span>
                    </div>
                    <h4><?php echo htmlspecialchars($qw['accion']); ?></h4>
                    <div class="qw-metrics">
                        <div class="qw-metric">
                            <i class="fas fa-arrow-up"></i>
                            <span><?php echo htmlspecialchars($qw['impacto']); ?></span>
                        </div>
                        <div class="qw-metric">
                            <i class="fas fa-clock"></i>
                            <span>Esfuerzo: <?php echo htmlspecialchars($qw['esfuerzo']); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Estrategia 12 Meses -->
        <div class="strategy-timeline">
            <h2><i class="fas fa-calendar-check"></i> Estrategia 12 Meses</h2>
            <div class="timeline-phases">
                <div class="timeline-phase">
                    <div class="phase-badge">Meses 1-3</div>
                    <ul>
                        <?php foreach ($datos['estrategia_12_meses']['mes_1_3'] as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="timeline-phase">
                    <div class="phase-badge">Meses 4-6</div>
                    <ul>
                        <?php foreach ($datos['estrategia_12_meses']['mes_4_6'] as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="timeline-phase">
                    <div class="phase-badge">Meses 7-12</div>
                    <ul>
                        <?php foreach ($datos['estrategia_12_meses']['mes_7_12'] as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- KPIs -->
        <div class="kpis-tracking">
            <h2><i class="fas fa-chart-line"></i> KPIs de Seguimiento</h2>
            <div class="kpis-list">
                <?php foreach ($datos['kpis_seguimiento'] as $kpi): ?>
                <div class="kpi-item"><?php echo htmlspecialchars($kpi); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Análisis de Demanda - IbizaVilla.com</span>
        <span class="page-number">Página <?php echo $numero_pagina; ?></span>
    </div>
</div>

<style>
.demand-conclusions-page {
    background: #f7fafc;
    padding: 45px;
    min-height: 100vh;
}

.demand-conclusions-page .page-header {
    text-align: center;
    margin-bottom: 30px;
}

.demand-conclusions-page h1 {
    font-size: 32px;
    color: #2d3748;
    margin: 0 0 8px 0;
    font-weight: 700;
}

.key-findings {
    background: white;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.key-findings h2 {
    font-size: 18px;
    color: #2d3748;
    margin: 0 0 18px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.key-findings h2 i {
    color: #88B04B;
}

.findings-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.finding-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: #f7fafc;
    border-radius: 8px;
    border-left: 3px solid #88B04B;
}

.finding-item i {
    color: #88B04B;
    margin-top: 2px;
}

.finding-item span {
    font-size: 13px;
    color: #2d3748;
    line-height: 1.5;
}

.dafo-compact-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 22px;
}

.dafo-compact {
    background: white;
    border-radius: 14px;
    padding: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.dafo-compact.fortalezas {
    border-left: 5px solid #88B04B;
}

.dafo-compact.debilidades {
    border-left: 5px solid #88B04B;
}

.dafo-compact h3 {
    font-size: 16px;
    color: #2d3748;
    margin: 0 0 15px 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}

.dafo-compact.fortalezas h3 i {
    color: #88B04B;
}

.dafo-compact.debilidades h3 i {
    color: #88B04B;
}

.dafo-compact ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.dafo-compact ul li {
    padding: 8px 8px 8px 22px;
    margin-bottom: 8px;
    background: #f7fafc;
    border-radius: 6px;
    position: relative;
    font-size: 12px;
    color: #2d3748;
    line-height: 1.4;
}

.dafo-compact ul li:before {
    content: "•";
    position: absolute;
    left: 8px;
    font-weight: bold;
    font-size: 16px;
}

.dafo-compact.fortalezas ul li:before {
    color: #88B04B;
}

.dafo-compact.debilidades ul li:before {
    color: #88B04B;
}

.quick-wins-section {
    background: white;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.quick-wins-section h2 {
    font-size: 18px;
    color: #2d3748;
    margin: 0 0 18px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.quick-wins-section h2 i {
    color: #88B04B;
}

.quick-wins-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.quick-win-card {
    padding: 18px;
    background: #f7fafc;
    border-radius: 10px;
    border-left: 4px solid #88B04B;
}

.qw-header {
    margin-bottom: 10px;
}

.qw-roi {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.qw-roi.roi-muy-alto {
    background: #f0f7e6;
    color: #065f46;
}

.qw-roi.roi-alto {
    background: #f0f7e6;
    color: #1e40af;
}

.quick-win-card h4 {
    font-size: 14px;
    color: #2d3748;
    margin: 0 0 12px 0;
    font-weight: 600;
    line-height: 1.3;
}

.qw-metrics {
    display: flex;
    gap: 15px;
    font-size: 11px;
    color: #4a5568;
}

.qw-metric {
    display: flex;
    align-items: center;
    gap: 5px;
}

.qw-metric i {
    color: #88B04B;
}

.strategy-timeline {
    background: white;
    border-radius: 14px;
    padding: 25px;
    margin-bottom: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.strategy-timeline h2 {
    font-size: 18px;
    color: #2d3748;
    margin: 0 0 18px 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.strategy-timeline h2 i {
    color: #88B04B;
}

.timeline-phases {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.timeline-phase {
    padding: 18px;
    background: #f7fafc;
    border-radius: 10px;
}

.phase-badge {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 12px;
}

.timeline-phase ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.timeline-phase ul li {
    padding: 6px 0 6px 18px;
    margin-bottom: 6px;
    position: relative;
    font-size: 11px;
    color: #2d3748;
    line-height: 1.4;
}

.timeline-phase ul li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.kpis-tracking {
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}

.kpis-tracking h2 {
    font-size: 18px;
    color: #1e3a8a;
    margin: 0 0 18px 0;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.kpis-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.kpi-item {
    padding: 10px 10px 10px 30px;
    background: rgba(255,255,255,0.7);
    border-radius: 8px;
    position: relative;
    font-size: 12px;
    color: #1e3a8a;
    line-height: 1.5;
    font-weight: 500;
}

.kpi-item:before {
    content: "✓";
    position: absolute;
    left: 10px;
    color: #88B04B;
    font-weight: bold;
    font-size: 14px;
}
</style>

<?php endif; ?>

<?php endforeach; ?>
