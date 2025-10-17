<?php
/**
 * Módulo: Keywords Actuales (m2.1)
 * Fase: 2 - Keyword Research
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$metricas = $datosModulo['metricas_principales'] ?? [];
$evolucion = $datosModulo['evolucion_temporal'] ?? [];
$topKeywords = $datosModulo['top_keywords'] ?? [];
$distribucion = $datosModulo['distribucion_posiciones'] ?? [];
$categorias = $datosModulo['keywords_por_categoria'] ?? [];
$competitividad = $datosModulo['analisis_competitividad'] ?? [];
$conclusiones = $datosModulo['conclusiones'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page keywords-page">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-key"></i>
            <?php echo htmlspecialchars($datosModulo['titulo']); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo']); ?></p>
        <div class="page-meta">
            <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['periodo']); ?></span>
            <span><i class="fas fa-tools"></i> <?php echo implode(', ', $datosModulo['herramientas']); ?></span>
        </div>
    </div>

    <div class="page-body">

        <!-- Métricas principales -->
        <div class="metrics-grid">
            <?php foreach ($metricas as $metrica): ?>
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas <?php echo $metrica['icono']; ?>"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?></h3>
                    <p class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></p>
                    <?php if (isset($metrica['unidad'])): ?>
                    <small class="metric-unit"><?php echo htmlspecialchars($metrica['unidad']); ?></small>
                    <?php endif; ?>
                    <?php if (isset($metrica['variacion'])): ?>
                    <p class="metric-change <?php echo $metrica['tendencia']; ?>">
                        <i class="fas fa-arrow-<?php echo $metrica['variacion'] >= 0 ? 'up' : 'down'; ?>"></i>
                        <?php echo abs($metrica['variacion']); ?>% vs mes anterior
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Gráfica de evolución temporal -->
        <?php if (!empty($evolucion)): ?>
        <div class="chart-section">
            <h2 class="chart-title"><?php echo htmlspecialchars($evolucion['titulo']); ?></h2>
            <canvas id="evolucion-chart" height="280"></canvas>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('evolucion-chart').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $evolucion['tipo']; ?>',
                data: {
                    labels: <?php echo json_encode($evolucion['labels']); ?>,
                    datasets: <?php echo json_encode($evolucion['datasets']); ?>
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Keywords'
                            }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 2: Top Keywords -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title"><?php echo htmlspecialchars($topKeywords['titulo']); ?></h2>
    </div>

    <div class="page-body">
        <table class="keywords-table">
            <thead>
                <tr>
                    <?php foreach ($topKeywords['columnas'] as $columna): ?>
                    <th><?php echo htmlspecialchars($columna); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topKeywords['datos'] as $index => $fila): ?>
                <tr class="<?php echo $index < 3 ? 'top-three' : ''; ?>">
                    <td class="rank-cell">
                        <?php if ($index === 0): ?>
                        <i class="fas fa-crown text-warning"></i>
                        <?php endif; ?>
                        <strong><?php echo $fila[0]; ?></strong>
                    </td>
                    <td class="keyword-cell"><strong><?php echo htmlspecialchars($fila[1]); ?></strong></td>
                    <td class="position-cell">
                        <span class="position-badge pos-<?php echo $fila[2]; ?>">
                            <?php echo $fila[2]; ?>
                        </span>
                    </td>
                    <td class="volume-cell"><?php echo htmlspecialchars($fila[3]); ?></td>
                    <td class="traffic-cell"><strong><?php echo htmlspecialchars($fila[4]); ?></strong></td>
                    <td class="change-cell">
                        <?php
                        $change = $fila[5];
                        $class = $change[0] === '+' ? 'text-success' : ($change[0] === '-' ? 'text-danger' : 'text-muted');
                        $icon = $change[0] === '+' ? 'up' : ($change[0] === '-' ? 'down' : 'minus');
                        ?>
                        <span class="<?php echo $class; ?>">
                            <i class="fas fa-arrow-<?php echo $icon; ?>"></i>
                            <?php echo htmlspecialchars($change); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 3: Distribución y Categorías -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title">Análisis de Distribución y Categorización</h2>
    </div>

    <div class="page-body">

        <!-- Gráfica de distribución -->
        <?php if (!empty($distribucion)): ?>
        <div class="chart-section">
            <h3 class="chart-title"><?php echo htmlspecialchars($distribucion['titulo']); ?></h3>
            <canvas id="distribucion-chart" height="250"></canvas>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('distribucion-chart').getContext('2d');
            new Chart(ctx, {
                type: '<?php echo $distribucion['tipo']; ?>',
                data: {
                    labels: <?php echo json_encode($distribucion['labels']); ?>,
                    datasets: [{
                        label: 'Keywords',
                        data: <?php echo json_encode($distribucion['valores']); ?>,
                        backgroundColor: <?php echo json_encode($distribucion['colores']); ?>,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Cantidad de Keywords'
                            }
                        }
                    }
                }
            });
        });
        </script>
        <?php endif; ?>

        <!-- Keywords por categoría -->
        <?php if (!empty($categorias)): ?>
        <div class="categories-section">
            <h3 class="section-title">
                <i class="fas fa-tags"></i>
                <?php echo htmlspecialchars($categorias['titulo']); ?>
            </h3>
            <div class="categories-grid">
                <?php foreach ($categorias['datos'] as $cat): ?>
                <div class="category-card">
                    <div class="category-header">
                        <h4><?php echo htmlspecialchars($cat['categoria']); ?></h4>
                        <span class="category-percentage"><?php echo $cat['porcentaje']; ?>%</span>
                    </div>
                    <div class="category-stats">
                        <div class="stat-item">
                            <span class="stat-label">Total:</span>
                            <span class="stat-value"><?php echo $cat['total']; ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Top 10:</span>
                            <span class="stat-value highlight"><?php echo $cat['top10']; ?></span>
                        </div>
                    </div>
                    <div class="category-examples">
                        <strong>Ejemplos:</strong>
                        <ul>
                            <?php foreach ($cat['ejemplos'] as $ejemplo): ?>
                            <li><?php echo htmlspecialchars($ejemplo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Competitividad -->
        <?php if (!empty($competitividad)): ?>
        <div class="competitiveness-section">
            <h3 class="section-title">
                <i class="fas fa-chart-pie"></i>
                <?php echo htmlspecialchars($competitividad['titulo']); ?>
            </h3>
            <div class="competitiveness-grid">
                <?php foreach ($competitividad['datos'] as $nivel): ?>
                <div class="competitiveness-card" style="border-left-color: <?php echo $nivel['color']; ?>">
                    <h4 style="color: <?php echo $nivel['color']; ?>">
                        Competitividad <?php echo htmlspecialchars($nivel['nivel']); ?>
                    </h4>
                    <div class="competitiveness-value"><?php echo $nivel['cantidad']; ?></div>
                    <div class="competitiveness-percentage"><?php echo $nivel['porcentaje']; ?>%</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<!-- Página 4: Conclusiones y Recomendaciones -->
<div class="audit-page keywords-page">
    <div class="page-header">
        <h2 class="page-title">Conclusiones y Recomendaciones</h2>
    </div>

    <div class="page-body">

        <!-- Conclusiones -->
        <?php if (!empty($conclusiones)): ?>
        <div class="conclusions-section">
            <h3 class="section-title">
                <i class="fas fa-check-circle"></i>
                Conclusiones Principales
            </h3>
            <ul class="conclusions-list">
                <?php foreach ($conclusiones as $conclusion): ?>
                <li>
                    <i class="fas fa-angle-right"></i>
                    <?php echo htmlspecialchars($conclusion); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <div class="recommendations-section">
            <h3 class="section-title">
                <i class="fas fa-lightbulb"></i>
                Recomendaciones Estratégicas
            </h3>
            <?php foreach ($recomendaciones as $index => $rec): ?>
            <div class="recommendation-card priority-<?php echo strtolower($rec['prioridad']); ?>">
                <div class="recommendation-header">
                    <div class="recommendation-number"><?php echo $index + 1; ?></div>
                    <div class="recommendation-priority">
                        <span class="priority-badge priority-<?php echo strtolower($rec['prioridad']); ?>">
                            <?php echo htmlspecialchars($rec['prioridad']); ?>
                        </span>
                    </div>
                </div>
                <h4 class="recommendation-title"><?php echo htmlspecialchars($rec['titulo']); ?></h4>
                <p class="recommendation-description"><?php echo htmlspecialchars($rec['descripcion']); ?></p>
                <div class="recommendation-meta">
                    <span><strong>Esfuerzo:</strong> <?php echo htmlspecialchars($rec['esfuerzo']); ?></span>
                    <span><strong>Impacto:</strong> <?php echo htmlspecialchars($rec['impacto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($datosModulo['cliente'] ?? 'Ibiza Villa'); ?></div>
        <div class="footer-center">Auditoría SEO | Fase 2: Keyword Research</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<style>
/* Estilos específicos para keywords */
.page-meta {
    display: flex;
    gap: 24px;
    margin-top: 12px;
    font-size: 0.95em;
    color: #666;
}

.page-meta i {
    margin-right: 6px;
}

.keywords-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    font-size: 0.9em;
}

.keywords-table thead {
    background: #f8f9fa;
}

.keywords-table th {
    padding: 12px 8px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.keywords-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #e9ecef;
}

.keywords-table tr.top-three {
    background: #fff9e6;
}

.rank-cell {
    width: 40px;
    text-align: center;
}

.position-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9em;
}

.position-badge.pos-1,
.position-badge.pos-2,
.position-badge.pos-3 {
    background: #d4edda;
    color: #155724;
}

.position-badge[class*="pos-"]:not(.pos-1):not(.pos-2):not(.pos-3) {
    background: #fff3cd;
    color: #856404;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.category-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #54a34a;
}

.category-header h4 {
    margin: 0;
    color: #333;
}

.category-percentage {
    font-size: 1.5em;
    font-weight: 700;
    color: #54a34a;
}

.category-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
}

.stat-item {
    flex: 1;
}

.stat-label {
    color: #666;
    font-size: 0.9em;
}

.stat-value {
    font-size: 1.3em;
    font-weight: 700;
    color: #333;
    margin-left: 6px;
}

.stat-value.highlight {
    color: #54a34a;
}

.category-examples ul {
    list-style: none;
    padding: 0;
    margin: 8px 0 0 0;
}

.category-examples li {
    padding: 4px 0;
    color: #666;
    font-size: 0.85em;
}

.competitiveness-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.competitiveness-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.competitiveness-value {
    font-size: 2.5em;
    font-weight: 700;
    color: #333;
    margin: 10px 0;
}

.competitiveness-percentage {
    font-size: 1.2em;
    color: #666;
}

.conclusions-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.conclusions-list li {
    padding: 12px 0 12px 30px;
    position: relative;
    border-bottom: 1px solid #e9ecef;
}

.conclusions-list i {
    position: absolute;
    left: 0;
    top: 14px;
    color: #54a34a;
}

.recommendation-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-left: 4px solid #54a34a;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 16px;
}

.recommendation-card.priority-alta {
    border-left-color: #dc3545;
    background: #fff5f5;
}

.recommendation-card.priority-media {
    border-left-color: #ffc107;
    background: #fffef8;
}

.recommendation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.recommendation-number {
    background: #54a34a;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.priority-badge {
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.85em;
    font-weight: 600;
}

.priority-badge.priority-alta {
    background: #dc3545;
    color: white;
}

.priority-badge.priority-media {
    background: #ffc107;
    color: #333;
}

.recommendation-title {
    font-size: 1.2em;
    color: #333;
    margin: 12px 0;
}

.recommendation-description {
    color: #666;
    line-height: 1.6;
    margin: 12px 0;
}

.recommendation-meta {
    display: flex;
    gap: 24px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e9ecef;
    font-size: 0.9em;
}

@media print {
    .audit-page {
        page-break-after: always;
    }
}
</style>
