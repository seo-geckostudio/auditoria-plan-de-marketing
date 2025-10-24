<?php
/**
 * Módulo: Resumen Ejecutivo (m5.1)
 * Fase: 5 - Entregables Finales
 */

// Cargar datos del JSON
$jsonPath = __DIR__ . '/../../data/fase5/resumen_ejecutivo.json';
$jsonContent = file_get_contents($jsonPath);
$datosModulo = json_decode($jsonContent, true);
?>

<!-- Página 1: Introducción y Situación Actual -->
<div class="audit-page executive-summary-page">
    <div class="page-header">
        <div class="header-content">
            <h1><?php echo htmlspecialchars($datosModulo['titulo']); ?></h1>
            <div class="header-meta">
                <span class="meta-item"><?php echo htmlspecialchars($datosModulo['cliente']); ?></span>
                <span class="meta-item"><?php echo htmlspecialchars($datosModulo['fecha']); ?></span>
                <span class="meta-item">v<?php echo htmlspecialchars($datosModulo['version']); ?></span>
                <?php if ($datosModulo['confidencial']): ?>
                <span class="confidential-badge">CONFIDENCIAL</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="page-body">
        <!-- Introducción -->
        <section class="introduction-section">
            <h2><?php echo htmlspecialchars($datosModulo['introduccion']['titulo']); ?></h2>
            <?php foreach ($datosModulo['introduccion']['parrafos'] as $parrafo): ?>
            <p><?php echo htmlspecialchars($parrafo); ?></p>
            <?php endforeach; ?>
        </section>

        <!-- Situación Actual -->
        <section class="current-situation-section">
            <h2><?php echo htmlspecialchars($datosModulo['situacion_actual']['titulo']); ?></h2>

            <div class="situation-summary">
                <p><?php echo htmlspecialchars($datosModulo['situacion_actual']['resumen']); ?></p>
            </div>

            <!-- Métricas por categoría -->
            <?php foreach ($datosModulo['situacion_actual']['metricas_clave'] as $categoria): ?>
            <div class="metrics-category">
                <h3><?php echo htmlspecialchars($categoria['categoria']); ?></h3>
                <div class="metrics-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Métrica</th>
                                <th>Valor Actual</th>
                                <th>Evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoria['datos'] as $dato): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dato['metrica']); ?></td>
                                <td class="metric-value"><?php echo htmlspecialchars($dato['valor']); ?></td>
                                <td>
                                    <span class="evaluation-badge eval-<?php echo strtolower($dato['evaluacion']); ?>">
                                        <?php echo htmlspecialchars($dato['evaluacion']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Fortalezas y Debilidades -->
            <div class="strengths-weaknesses">
                <div class="strengths-column">
                    <h3>Fortalezas Principales</h3>
                    <ul>
                        <?php foreach ($datosModulo['situacion_actual']['fortalezas_principales'] as $fortaleza): ?>
                        <li><?php echo htmlspecialchars($fortaleza); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="weaknesses-column">
                    <h3>Debilidades Principales</h3>
                    <ul>
                        <?php foreach ($datosModulo['situacion_actual']['debilidades_principales'] as $debilidad): ?>
                        <li><?php echo htmlspecialchars($debilidad); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.executive-summary-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.page-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
    color: white;
    padding: 3rem 2rem;
    margin: -2rem -2rem 2rem -2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(135deg, rgba(136, 176, 75, 0.1) 0%, transparent 100%);
    pointer-events: none;
}

.header-content {
    position: relative;
    z-index: 1;
}

.header-content h1 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 2.5rem;
    font-weight: 700;
    letter-spacing: -0.5px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.header-meta {
    display: flex;
    gap: 2.5rem;
    flex-wrap: wrap;
    align-items: center;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1rem;
    opacity: 0.95;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.meta-item:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.confidential-badge {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }
    50% { box-shadow: 0 4px 20px rgba(220, 53, 69, 0.6); }
}

.executive-summary-page section {
    background: white;
    padding: 2.5rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.executive-summary-page section:hover {
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.executive-summary-page section h2 {
    margin: 0 0 2rem 0;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 2rem;
    font-weight: 700;
    padding-bottom: 1rem;
    border-bottom: 3px solid transparent;
    background: linear-gradient(to right, #88B04B 0%, transparent 100%);
    background-position: 0 100%;
    background-size: 100% 3px;
    background-repeat: no-repeat;
    letter-spacing: -0.3px;
}

.introduction-section p {
    margin: 0 0 1.25rem 0;
    font-size: 1.1rem;
    line-height: 1.9;
    color: #444;
    text-align: justify;
}

.introduction-section p:last-of-type {
    margin-bottom: 0;
}

.situation-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2.5rem;
    border-radius: 1rem;
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(136, 176, 75, 0.3);
}

.situation-summary::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.situation-summary p {
    margin: 0;
    font-size: 1.25rem;
    line-height: 1.9;
    position: relative;
    z-index: 1;
    font-weight: 500;
}

.metrics-category {
    margin-bottom: 2.5rem;
}

.metrics-category h3 {
    margin: 0 0 1.25rem 0;
    color: #88B04B;
    font-size: 1.4rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.metrics-table {
    overflow-x: auto;
    border-radius: 0.75rem;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

.metrics-table table {
    width: 100%;
    border-collapse: collapse;
}

.metrics-table thead {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
    color: white;
}

.metrics-table th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 700;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.metrics-table td {
    padding: 1.25rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
}

.metrics-table tbody tr {
    transition: all 0.2s ease;
}

.metrics-table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: scale(1.01);
}

.metrics-table tbody tr:last-child td {
    border-bottom: none;
}

.metric-value {
    font-weight: 700;
    font-size: 1.15rem;
    color: #1a1a1a;
}

.evaluation-badge {
    display: inline-block;
    padding: 0.6rem 1.25rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.evaluation-badge.eval-excelente {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.evaluation-badge.eval-bueno {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
}

.evaluation-badge.eval-moderado {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: #333;
}

.evaluation-badge.eval-bajo {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.evaluation-badge.eval-crítico {
    background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
    color: white;
}

.strengths-weaknesses {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-top: 2.5rem;
}

.strengths-column,
.weaknesses-column {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.strengths-column::before,
.weaknesses-column::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    transition: width 0.3s ease;
}

.strengths-column::before {
    background: linear-gradient(180deg, #88B04B 0%, #6d8f3c 100%);
}

.weaknesses-column::before {
    background: linear-gradient(180deg, #dc3545 0%, #c82333 100%);
}

.strengths-column:hover::before,
.weaknesses-column:hover::before {
    width: 8px;
}

.strengths-column:hover,
.weaknesses-column:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
}

.strengths-column h3,
.weaknesses-column h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.3rem;
    font-weight: 700;
}

.strengths-column h3 {
    color: #88B04B;
}

.weaknesses-column h3 {
    color: #dc3545;
}

.strengths-weaknesses ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.strengths-weaknesses li {
    padding: 1rem 1rem 1rem 2.5rem;
    position: relative;
    line-height: 1.7;
    border-bottom: 1px solid #e9ecef;
    transition: all 0.2s ease;
    background: white;
    margin-bottom: 0.5rem;
    border-radius: 0.5rem;
}

.strengths-weaknesses li:hover {
    background: #f8f9fa;
    padding-left: 3rem;
}

.strengths-weaknesses li:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.strengths-column li::before {
    content: '✓';
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #88B04B;
    font-weight: bold;
    font-size: 1.3rem;
}

.weaknesses-column li::before {
    content: '✗';
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #dc3545;
    font-weight: bold;
    font-size: 1.2rem;
}
</style>

<!-- Página 2: Hallazgos Críticos y Recomendaciones -->
<div class="audit-page critical-findings-page">
    <div class="page-header">
        <h1>Hallazgos Críticos y Recomendaciones</h1>
    </div>

    <div class="page-body">
        <!-- Hallazgos críticos -->
        <section class="critical-findings-section">
            <h2><?php echo htmlspecialchars($datosModulo['hallazgos_criticos']['titulo']); ?></h2>

            <?php foreach ($datosModulo['hallazgos_criticos']['hallazgos'] as $hallazgo): ?>
            <div class="finding-card priority-<?php echo strtolower(str_replace(' ', '-', $hallazgo['prioridad'])); ?>">
                <div class="finding-header">
                    <span class="finding-number">#<?php echo $hallazgo['id']; ?></span>
                    <h3><?php echo htmlspecialchars($hallazgo['titulo']); ?></h3>
                    <span class="severity-badge"><?php echo htmlspecialchars($hallazgo['severidad']); ?></span>
                </div>

                <div class="finding-content">
                    <p class="finding-description"><?php echo htmlspecialchars($hallazgo['descripcion']); ?></p>

                    <div class="finding-details">
                        <div class="detail-item impact">
                            <strong>Impacto en Negocio:</strong>
                            <p><?php echo htmlspecialchars($hallazgo['impacto_negocio']); ?></p>
                        </div>

                        <div class="detail-item action">
                            <strong>Acción Requerida:</strong>
                            <p><?php echo htmlspecialchars($hallazgo['accion_requerida']); ?></p>
                        </div>
                    </div>

                    <div class="finding-priority">
                        <span class="priority-label">Prioridad:</span>
                        <span class="priority-badge priority-<?php echo strtolower($hallazgo['prioridad']); ?>">
                            <?php echo htmlspecialchars($hallazgo['prioridad']); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Recomendaciones estratégicas -->
        <section class="strategic-recommendations-section">
            <h2><?php echo htmlspecialchars($datosModulo['recomendaciones_estrategicas']['titulo']); ?></h2>

            <div class="recommendations-summary">
                <p><?php echo htmlspecialchars($datosModulo['recomendaciones_estrategicas']['resumen']); ?></p>
            </div>

            <?php foreach ($datosModulo['recomendaciones_estrategicas']['recomendaciones'] as $recomendacion): ?>
            <div class="recommendation-card">
                <div class="recommendation-header">
                    <div class="rec-title-section">
                        <span class="priority-number">Prioridad <?php echo $recomendacion['prioridad']; ?></span>
                        <h3><?php echo htmlspecialchars($recomendacion['titulo']); ?></h3>
                    </div>
                    <span class="rec-type-badge"><?php echo htmlspecialchars($recomendacion['tipo']); ?></span>
                </div>

                <div class="recommendation-objective">
                    <strong>Objetivo:</strong> <?php echo htmlspecialchars($recomendacion['objetivo']); ?>
                </div>

                <div class="recommendation-actions">
                    <strong>Acciones Clave:</strong>
                    <ul>
                        <?php foreach ($recomendacion['acciones'] as $accion): ?>
                        <li><?php echo htmlspecialchars($accion); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="recommendation-metrics">
                    <?php if (isset($recomendacion['inversion']) && $recomendacion['inversion']): ?>
                    <div class="rec-metric">
                        <div>
                            <span class="metric-label">Esfuerzo</span>
                            <span class="metric-value"><?php echo htmlspecialchars($recomendacion['inversion']); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($recomendacion['roi_esperado']) && $recomendacion['roi_esperado']): ?>
                    <div class="rec-metric">
                        <div>
                            <span class="metric-label">Mejora Esperada</span>
                            <span class="metric-value roi"><?php echo htmlspecialchars($recomendacion['roi_esperado']); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="rec-metric">
                        <div>
                            <span class="metric-label">Tiempo Resultados</span>
                            <span class="metric-value"><?php echo htmlspecialchars($recomendacion['tiempo_resultados']); ?></span>
                        </div>
                    </div>
                    <div class="rec-metric">
                        <div>
                            <span class="metric-label">Riesgo</span>
                            <span class="metric-value risk-<?php echo strtolower(str_replace('-', '', $recomendacion['riesgo'])); ?>">
                                <?php echo htmlspecialchars($recomendacion['riesgo']); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="recommendation-results">
                    <strong>Resultados Esperados:</strong>
                    <?php echo htmlspecialchars($recomendacion['resultados']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>

<style>
.critical-findings-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.critical-findings-page .page-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    padding: 3rem 2rem;
    margin: -2rem -2rem 2rem -2rem;
    box-shadow: 0 10px 30px rgba(220, 53, 69, 0.4);
    position: relative;
    overflow: hidden;
}

.critical-findings-page .page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.critical-findings-page .page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.critical-findings-page section {
    background: white;
    padding: 2.5rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.critical-findings-page section:hover {
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
}

.critical-findings-page section h2 {
    margin: 0 0 2rem 0;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 2rem;
    font-weight: 700;
    padding-bottom: 1rem;
    background: linear-gradient(to right, #dc3545 0%, transparent 100%);
    background-position: 0 100%;
    background-size: 100% 3px;
    background-repeat: no-repeat;
    letter-spacing: -0.3px;
}

.finding-card {
    background: #fff;
    border: none;
    border-radius: 1rem;
    margin-bottom: 2rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
}

.finding-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    transition: width 0.3s ease;
}

.finding-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 35px rgba(0, 0, 0, 0.15);
}

.finding-card:hover::before {
    width: 8px;
}

.finding-card.priority-crítica::before {
    background: linear-gradient(180deg, #dc3545 0%, #c82333 100%);
}

.finding-card.priority-alta::before {
    background: linear-gradient(180deg, #ffc107 0%, #e0a800 100%);
}

.finding-card.priority-media-alta::before {
    background: linear-gradient(180deg, #17a2b8 0%, #138496 100%);
}

.finding-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.finding-number {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.4rem;
    flex-shrink: 0;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.finding-header h3 {
    margin: 0;
    flex: 1;
    font-size: 1.4rem;
    font-weight: 700;
}

.severity-badge {
    padding: 0.65rem 1.25rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.finding-content {
    padding: 2.5rem;
}

.finding-description {
    margin: 0 0 2rem 0;
    font-size: 1.15rem;
    line-height: 1.8;
    color: #444;
}

.finding-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.detail-item {
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.detail-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    transition: width 0.3s ease;
}

.detail-item:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.detail-item:hover::before {
    width: 6px;
}

.detail-item.impact {
    background: linear-gradient(135deg, #f0f7e6 0%, #ffffff 100%);
}

.detail-item.impact::before {
    background: linear-gradient(180deg, #88B04B 0%, #6d8f3c 100%);
}

.detail-item.action {
    background: linear-gradient(135deg, #d4edda 0%, #ffffff 100%);
}

.detail-item.action::before {
    background: linear-gradient(180deg, #28a745 0%, #218838 100%);
}

.detail-item strong {
    display: block;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.05rem;
    color: #1a1a1a;
}

.detail-item p {
    margin: 0;
    line-height: 1.7;
    color: #555;
}

.finding-priority {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e9ecef;
}

.priority-label {
    font-weight: 700;
    font-size: 1.05rem;
}

.priority-badge {
    padding: 0.85rem 1.75rem;
    border-radius: 50px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
}

.priority-badge.priority-crítica {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.priority-badge.priority-alta {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: #333;
}

.priority-badge.priority-media-alta {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
}

.recommendations-summary {
    background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%);
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(33, 150, 243, 0.15);
}

.recommendations-summary::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: linear-gradient(180deg, #2196f3 0%, #1976d2 100%);
}

.recommendations-summary p {
    margin: 0;
    font-size: 1.15rem;
    line-height: 1.9;
    position: relative;
    z-index: 1;
}

.recommendation-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 1rem;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.recommendation-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: linear-gradient(180deg, #88B04B 0%, #6d8f3c 100%);
    transition: width 0.3s ease;
}

.recommendation-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
}

.recommendation-card:hover::before {
    width: 8px;
}

.recommendation-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    gap: 1rem;
}

.rec-title-section {
    flex: 1;
}

.priority-number {
    display: inline-block;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    box-shadow: 0 2px 8px rgba(136, 176, 75, 0.3);
}

.recommendation-header h3 {
    margin: 0;
    color: #1a1a1a;
    font-size: 1.5rem;
    font-weight: 700;
}

.rec-type-badge {
    padding: 0.65rem 1.25rem;
    background: linear-gradient(135deg, #1a1a1a 0%, #2d3748 100%);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.recommendation-objective {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
}

.recommendation-objective::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #88B04B 0%, #6d8f3c 100%);
}

.recommendation-objective strong {
    color: #1a1a1a;
}

.recommendation-actions {
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.recommendation-actions strong {
    display: block;
    margin-bottom: 1rem;
    color: #1a1a1a;
    font-size: 1.05rem;
}

.recommendation-actions ul {
    margin: 0;
    padding-left: 1.5rem;
}

.recommendation-actions li {
    margin: 0.75rem 0;
    line-height: 1.7;
}

.recommendation-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.rec-metric {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    padding: 1.25rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.rec-metric:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.rec-metric i {
    font-size: 1.5rem;
    color: #88B04B;
}

.rec-metric div {
    display: flex;
    flex-direction: column;
}

.metric-label {
    font-size: 0.85rem;
    opacity: 0.7;
    margin-bottom: 0.25rem;
}

.metric-value {
    font-weight: 700;
    font-size: 1.15rem;
    color: #1a1a1a;
}

.metric-value.roi {
    color: #88B04B;
    font-size: 1.35rem;
}

.metric-value.risk-bajo {
    color: #88B04B;
}

.metric-value.risk-bajomedio,
.metric-value.risk-medio {
    color: #ffc107;
}

.metric-value.risk-medioalto,
.metric-value.risk-alto {
    color: #dc3545;
}

.recommendation-results {
    background: linear-gradient(135deg, #d4edda 0%, #ffffff 100%);
    padding: 1.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.15);
    position: relative;
    overflow: hidden;
}

.recommendation-results::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #28a745 0%, #218838 100%);
}

.recommendation-results i {
    color: #28a745;
    font-size: 1.3rem;
    margin-top: 0.25rem;
}

.recommendation-results strong {
    color: #1a1a1a;
}
</style>

<!-- Página 3: ROI, Decisión Ejecutiva y Próximos Pasos -->
<div class="audit-page decision-page">
    <div class="page-header">
        <h1>Análisis de Resultados y Decisión Ejecutiva</h1>
    </div>

    <div class="page-body">
        <!-- Análisis de Resultados -->
        <section class="roi-analysis-section">
            <h2><?php echo htmlspecialchars($datosModulo['analisis_roi']['titulo']); ?></h2>

            <div class="roi-summary">
                <p><?php echo htmlspecialchars($datosModulo['analisis_roi']['resumen']); ?></p>
            </div>

            <!-- Comparativa Actual vs Proyectada -->
            <div class="comparison-grid">
                <div class="comparison-card current">
                    <h3>Situación Actual</h3>
                    <?php $actual = $datosModulo['analisis_roi']['comparativa']['situacion_actual']; ?>
                    <div class="comparison-metrics">
                        <div class="comp-metric">
                            <span class="label">Tráfico Mensual</span>
                            <span class="value"><?php echo number_format($actual['trafico_mensual']); ?></span>
                        </div>
                        <?php if (isset($actual['valor_anual']) && $actual['valor_anual']): ?>
                        <div class="comp-metric">
                            <span class="label">Índice Mejora Anual</span>
                            <span class="value"><?php echo number_format($actual['valor_anual']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="comp-metric">
                            <span class="label">Keywords Top 10</span>
                            <span class="value"><?php echo $actual['keywords_top10']; ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Conversiones/Mes</span>
                            <span class="value"><?php echo $actual['conversiones_mensuales']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="comparison-arrow">
                    <?php $incrementos = $datosModulo['analisis_roi']['comparativa']['incrementos']; ?>
                    <div class="increments">
                        <span><?php echo $incrementos['trafico']; ?></span>
                        <?php if (isset($incrementos['valor']) && $incrementos['valor']): ?>
                        <span><?php echo $incrementos['valor']; ?></span>
                        <?php else: ?>
                        <span>-</span>
                        <?php endif; ?>
                        <span><?php echo $incrementos['keywords']; ?></span>
                        <span><?php echo $incrementos['conversiones']; ?></span>
                    </div>
                </div>

                <div class="comparison-card projected">
                    <h3>Situación Proyectada (12 meses)</h3>
                    <?php $proyectada = $datosModulo['analisis_roi']['comparativa']['situacion_proyectada']; ?>
                    <div class="comparison-metrics">
                        <div class="comp-metric">
                            <span class="label">Tráfico Mensual</span>
                            <span class="value highlight"><?php echo number_format($proyectada['trafico_mensual']); ?></span>
                        </div>
                        <?php if (isset($proyectada['valor_anual']) && $proyectada['valor_anual']): ?>
                        <div class="comp-metric">
                            <span class="label">Índice Mejora Anual</span>
                            <span class="value highlight"><?php echo number_format($proyectada['valor_anual']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="comp-metric">
                            <span class="label">Keywords Top 10</span>
                            <span class="value highlight"><?php echo $proyectada['keywords_top10']; ?></span>
                        </div>
                        <div class="comp-metric">
                            <span class="label">Conversiones/Mes</span>
                            <span class="value highlight"><?php echo $proyectada['conversiones_mensuales']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficios adicionales -->
            <div class="additional-benefits">
                <h3>Beneficios Adicionales</h3>
                <div class="benefits-grid">
                    <?php foreach ($datosModulo['analisis_roi']['beneficios_adicionales'] as $beneficio): ?>
                    <div class="benefit-item">
                        <span><?php echo htmlspecialchars($beneficio); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Decisión Ejecutiva -->
        <section class="executive-decision-section">
            <h2><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['titulo']); ?></h2>

            <div class="decision-question">
                <h3><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['pregunta']); ?></h3>
            </div>

            <div class="options-grid">
                <?php foreach ($datosModulo['decision_ejecutiva']['opciones'] as $index => $opcion): ?>
                <div class="option-card <?php echo $index === 0 ? 'recommended' : ''; ?>">
                    <?php if ($index === 0): ?>
                    <div class="recommended-badge">RECOMENDADO</div>
                    <?php endif; ?>

                    <h3><?php echo htmlspecialchars($opcion['opcion']); ?></h3>
                    <p class="option-description"><?php echo htmlspecialchars($opcion['descripcion']); ?></p>

                    <?php if (isset($opcion['roi_esperado']) && $opcion['roi_esperado']): ?>
                    <div class="option-roi">
                        <strong>Mejora Esperada:</strong> <span class="roi-value"><?php echo htmlspecialchars($opcion['roi_esperado']); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="pros-cons">
                        <div class="pros">
                            <strong>Pros:</strong>
                            <ul>
                                <?php foreach ($opcion['pros'] as $pro): ?>
                                <li><?php echo htmlspecialchars($pro); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="cons">
                            <strong>Contras:</strong>
                            <ul>
                                <?php foreach ($opcion['cons'] as $con): ?>
                                <li><?php echo htmlspecialchars($con); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="agency-recommendation">
                <h3>Recomendación de la Agencia</h3>
                <p class="recommendation-choice"><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['recomendacion_agencia']); ?></p>
                <p class="justification"><?php echo htmlspecialchars($datosModulo['decision_ejecutiva']['justificacion']); ?></p>
            </div>
        </section>

        <!-- Próximos Pasos -->
        <section class="next-steps-section">
            <h2><?php echo htmlspecialchars($datosModulo['proximos_pasos']['titulo']); ?></h2>

            <div class="next-steps-columns">
                <div class="approved-steps">
                    <h3>Si el Plan es Aprobado</h3>
                    <?php foreach ($datosModulo['proximos_pasos']['si_aprobado'] as $paso): ?>
                    <div class="step-item">
                        <div class="step-timeline"><?php echo htmlspecialchars($paso['plazo']); ?></div>
                        <div class="step-content">
                            <strong><?php echo htmlspecialchars($paso['accion']); ?></strong>
                            <span class="step-responsible"><?php echo htmlspecialchars($paso['responsable']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="postponed-risks">
                    <h3>Si se Pospone la Decisión</h3>
                    <ul class="risks-list">
                        <?php foreach ($datosModulo['proximos_pasos']['si_pospuesto'] as $riesgo): ?>
                        <li><?php echo htmlspecialchars($riesgo); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Contacto -->
        <section class="contact-section">
            <h2><?php echo htmlspecialchars($datosModulo['contacto']['titulo']); ?></h2>
            <p class="contact-message"><?php echo htmlspecialchars($datosModulo['contacto']['mensaje']); ?></p>

            <div class="contact-details">
                <div class="contact-item">
                    <div>
                        <strong><?php echo htmlspecialchars($datosModulo['contacto']['persona']); ?></strong>
                    </div>
                </div>
                <div class="contact-item">
                    <div>
                        <a href="mailto:<?php echo htmlspecialchars($datosModulo['contacto']['email']); ?>">
                            <?php echo htmlspecialchars($datosModulo['contacto']['email']); ?>
                        </a>
                    </div>
                </div>
                <div class="contact-item">
                    <div>
                        <span><?php echo htmlspecialchars($datosModulo['contacto']['telefono']); ?></span>
                    </div>
                </div>
                <div class="contact-item">
                    <div>
                        <span><?php echo htmlspecialchars($datosModulo['contacto']['disponibilidad']); ?></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.decision-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.decision-page .page-header {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
    padding: 3rem 2rem;
    margin: -2rem -2rem 2rem -2rem;
    box-shadow: 0 10px 30px rgba(136, 176, 75, 0.4);
    position: relative;
    overflow: hidden;
}

.decision-page .page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.decision-page .page-header h1 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 2.5rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.decision-page section {
    background: white;
    padding: 2.5rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.decision-page section:hover {
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
}

.decision-page section h2 {
    margin: 0 0 2rem 0;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 2rem;
    font-weight: 700;
    padding-bottom: 1rem;
    background: linear-gradient(to right, #88B04B 0%, transparent 100%);
    background-position: 0 100%;
    background-size: 100% 3px;
    background-repeat: no-repeat;
    letter-spacing: -0.3px;
}

.roi-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 2.5rem;
    border-radius: 1rem;
    margin-bottom: 2.5rem;
    font-size: 1.2rem;
    line-height: 1.9;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(136, 176, 75, 0.3);
}

.roi-summary::before {
    content: '';
    position: absolute;
    bottom: -50%;
    left: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
}

.roi-summary p {
    margin: 0;
    position: relative;
    z-index: 1;
    font-weight: 500;
}

.comparison-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2rem;
    margin-bottom: 2.5rem;
    align-items: center;
}

.comparison-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 2.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.comparison-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    transition: height 0.3s ease;
}

.comparison-card.current::before {
    background: linear-gradient(90deg, #6c757d 0%, #545b62 100%);
}

.comparison-card.projected::before {
    background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%);
}

.comparison-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 35px rgba(0, 0, 0, 0.12);
}

.comparison-card:hover::before {
    height: 8px;
}

.comparison-card h3 {
    margin: 0 0 2rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
}

.comparison-metrics {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.comp-metric {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.25rem;
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.comp-metric:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.comp-metric .label {
    font-size: 0.95rem;
    opacity: 0.8;
    font-weight: 500;
}

.comp-metric .value {
    font-weight: 700;
    font-size: 1.3rem;
    color: #1a1a1a;
}

.comp-metric .value.highlight {
    color: #88B04B;
    font-size: 1.5rem;
}

.comparison-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

.comparison-arrow i {
    font-size: 3rem;
    color: #88B04B;
}

.increments {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    text-align: center;
}

.increments span {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 0.65rem 1.25rem;
    border-radius: 50px;
    font-weight: 700;
    box-shadow: 0 3px 10px rgba(136, 176, 75, 0.3);
    font-size: 0.95rem;
}

.additional-benefits {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.additional-benefits h3 {
    margin: 0 0 1rem 0;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
}

.decision-question {
    background: #f0f7e6;
    padding: 2rem;
    border-radius: 0.75rem;
    text-align: center;
    margin-bottom: 2rem;
    border: 3px solid #88B04B;
}

.decision-question h3 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.option-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 2.5rem;
    border-radius: 1rem;
    border: 2px solid #e9ecef;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.option-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.option-card.recommended {
    border-color: #88B04B;
    border-width: 3px;
    box-shadow: 0 6px 25px rgba(136, 176, 75, 0.25);
}

.option-card.recommended:hover {
    box-shadow: 0 10px 40px rgba(136, 176, 75, 0.35);
}

.recommended-badge {
    position: absolute;
    top: -15px;
    right: 20px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 0.65rem 1.25rem;
    border-radius: 50px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(136, 176, 75, 0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

.option-card h3 {
    margin: 0 0 1.25rem 0;
    color: #1a1a1a;
    font-size: 1.35rem;
    font-weight: 700;
}

.option-description {
    margin: 0 0 1.5rem 0;
    line-height: 1.7;
    color: #555;
    font-size: 1.05rem;
}

.option-investment,
.option-roi {
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
}

.option-roi .roi-value {
    color: #88B04B;
    font-weight: bold;
    font-size: 1.2rem;
}

.pros-cons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 1rem;
}

.pros,
.cons {
    padding: 1rem;
    border-radius: 0.5rem;
}

.pros {
    background: #d4edda;
    border-left: 4px solid #88B04B;
}

.cons {
    background: #f8d7da;
    border-left: 4px solid #dc3545;
}

.pros strong,
.cons strong {
    display: block;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pros ul,
.cons ul {
    margin: 0;
    padding-left: 1.5rem;
}

.pros li,
.cons li {
    margin: 0.25rem 0;
    font-size: 0.9rem;
}

.agency-recommendation {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
    padding: 3rem;
    border-radius: 1rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(136, 176, 75, 0.3);
    position: relative;
    overflow: hidden;
}

.agency-recommendation::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    pointer-events: none;
}

.agency-recommendation h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    font-size: 1.6rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.recommendation-choice {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 1.5rem 0;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.justification {
    margin: 0;
    font-size: 1.15rem;
    line-height: 1.9;
    opacity: 0.95;
    position: relative;
    z-index: 1;
    font-weight: 500;
}

.next-steps-columns {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.approved-steps,
.postponed-risks {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.approved-steps {
    border-left: 4px solid #88B04B;
}

.postponed-risks {
    border-left: 4px solid #dc3545;
}

.approved-steps h3,
.postponed-risks h3 {
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.step-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 0.5rem;
}

.step-timeline {
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

.risks-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.risks-list li {
    padding: 0.75rem;
    background: white;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    padding-left: 2.5rem;
    position: relative;
}

.risks-list li::before {
    content: '';
    position: absolute;
    left: 0.75rem;
    font-size: 1.2rem;
}

.contact-section {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    box-shadow: 0 8px 30px rgba(136, 176, 75, 0.3);
    position: relative;
    overflow: hidden;
}

.contact-section::before {
    content: '';
    position: absolute;
    bottom: -30%;
    right: -15%;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    pointer-events: none;
}

.contact-section h2 {
    color: white;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.5) 0%, transparent 100%);
    background-position: 0 100%;
    background-size: 100% 3px;
    background-repeat: no-repeat;
    position: relative;
    z-index: 1;
}

.contact-message {
    font-size: 1.2rem;
    margin: 0 0 2.5rem 0;
    text-align: center;
    line-height: 1.8;
    position: relative;
    z-index: 1;
    font-weight: 500;
}

.contact-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    position: relative;
    z-index: 1;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 1.75rem;
    border-radius: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.contact-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.contact-item a {
    color: white;
    text-decoration: none;
    border-bottom: 2px solid rgba(255, 255, 255, 0.5);
    transition: all 0.2s ease;
    font-weight: 500;
}

.contact-item a:hover {
    border-bottom-color: white;
    padding-bottom: 2px;
}
</style>
