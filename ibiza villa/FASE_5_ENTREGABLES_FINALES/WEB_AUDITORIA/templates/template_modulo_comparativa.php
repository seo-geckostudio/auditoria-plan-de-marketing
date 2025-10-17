<?php
/**
 * Template: Módulo de Comparativas
 *
 * Plantilla para páginas que muestran comparaciones entre períodos,
 * competidores, o diferentes métricas
 * Tipo de página: Comparativas (según GUIA_DISENO_PAGINAS_AUDITORIA.md)
 *
 * Variables requeridas:
 * - $datosModulo: Array con datos del módulo cargados desde JSON
 */

$titulo = $datosModulo['titulo'] ?? 'Comparativa';
$subtitulo = $datosModulo['subtitulo'] ?? '';
$tipo_comparativa = $datosModulo['tipo'] ?? 'temporal'; // temporal, competidores, segmentos
$comparaciones = $datosModulo['comparaciones'] ?? [];
$conclusiones = $datosModulo['conclusiones'] ?? [];
?>

<!-- ============================================ -->
<!-- PÁGINA: <?php echo $titulo; ?> -->
<!-- ============================================ -->
<div class="audit-page comparative-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <?php if ($subtitulo): ?>
        <p class="page-subtitle"><?php echo htmlspecialchars($subtitulo); ?></p>
        <?php endif; ?>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <?php if (!empty($comparaciones)): ?>
        <?php foreach ($comparaciones as $index => $comparacion): ?>
        <div class="comparison-section">
            <h2 class="comparison-title"><?php echo htmlspecialchars($comparacion['titulo']); ?></h2>

            <?php if ($comparacion['formato'] === 'tabla'): ?>
            <!-- Tabla comparativa -->
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th><?php echo htmlspecialchars($comparacion['columna_principal'] ?? 'Métrica'); ?></th>
                        <?php foreach ($comparacion['columnas'] as $columna): ?>
                        <th><?php echo htmlspecialchars($columna); ?></th>
                        <?php endforeach; ?>
                        <?php if (isset($comparacion['mostrar_variacion']) && $comparacion['mostrar_variacion']): ?>
                        <th>Variación</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comparacion['filas'] as $fila): ?>
                    <tr>
                        <td class="metric-name"><strong><?php echo htmlspecialchars($fila['nombre']); ?></strong></td>
                        <?php foreach ($fila['valores'] as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                        <?php endforeach; ?>
                        <?php if (isset($fila['variacion'])): ?>
                        <td class="<?php echo $fila['variacion'] >= 0 ? 'text-success' : 'text-danger'; ?>">
                            <i class="fas fa-arrow-<?php echo $fila['variacion'] >= 0 ? 'up' : 'down'; ?>"></i>
                            <?php echo abs($fila['variacion']); ?>%
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($comparacion['formato'] === 'grafica'): ?>
            <!-- Gráfica comparativa -->
            <div class="chart-section">
                <canvas id="comparison-chart-<?php echo $index; ?>" height="300"></canvas>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('comparison-chart-<?php echo $index; ?>').getContext('2d');
                new Chart(ctx, {
                    type: '<?php echo $comparacion['tipo_grafica'] ?? 'bar'; ?>',
                    data: {
                        labels: <?php echo json_encode($comparacion['labels'] ?? []); ?>,
                        datasets: <?php echo json_encode($comparacion['datasets'] ?? []); ?>
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
            </script>

            <?php elseif ($comparacion['formato'] === 'tarjetas'): ?>
            <!-- Grid de tarjetas comparativas -->
            <div class="comparison-cards-grid">
                <?php foreach ($comparacion['items'] as $item): ?>
                <div class="comparison-card">
                    <h3 class="card-title"><?php echo htmlspecialchars($item['nombre']); ?></h3>
                    <?php foreach ($item['metricas'] as $metrica): ?>
                    <div class="card-metric">
                        <span class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?>:</span>
                        <span class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></span>
                    </div>
                    <?php endforeach; ?>
                    <?php if (isset($item['destacado']) && $item['destacado']): ?>
                    <div class="card-badge">
                        <i class="fas fa-star"></i> Destacado
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php elseif ($comparacion['formato'] === 'antes_despues'): ?>
            <!-- Comparación Antes/Después -->
            <div class="before-after-comparison">
                <div class="before-section">
                    <h3 class="section-label">
                        <i class="fas fa-arrow-left"></i> Antes
                    </h3>
                    <div class="comparison-content">
                        <?php foreach ($comparacion['antes'] as $metrica): ?>
                        <div class="metric-row">
                            <span class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?></span>
                            <span class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="comparison-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <div class="after-section">
                    <h3 class="section-label">
                        <i class="fas fa-arrow-right"></i> Después
                    </h3>
                    <div class="comparison-content">
                        <?php foreach ($comparacion['despues'] as $metrica): ?>
                        <div class="metric-row">
                            <span class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?></span>
                            <span class="metric-value improved"><?php echo htmlspecialchars($metrica['valor']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($comparacion['nota'])): ?>
            <div class="comparison-note">
                <i class="fas fa-info-circle"></i>
                <p><?php echo htmlspecialchars($comparacion['nota']); ?></p>
            </div>
            <?php endif; ?>

        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($conclusiones)): ?>
        <!-- Conclusiones de la comparativa -->
        <div class="conclusions-section">
            <h2 class="section-title">Conclusiones de la Comparativa</h2>
            <div class="conclusions-grid">
                <?php foreach ($conclusiones as $conclusion): ?>
                <div class="conclusion-card <?php echo $conclusion['tipo'] ?? 'neutral'; ?>">
                    <i class="fas fa-<?php
                        echo ($conclusion['tipo'] ?? 'neutral') === 'positivo' ? 'check-circle' :
                             (($conclusion['tipo'] ?? 'neutral') === 'negativo' ? 'times-circle' : 'minus-circle');
                    ?>"></i>
                    <p><?php echo htmlspecialchars($conclusion['texto']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <!-- Footer de la página -->
    <div class="page-footer">
        <div class="footer-left">
            <?php echo htmlspecialchars($configuracionCliente['proyecto']['nombre'] ?? 'Proyecto'); ?>
        </div>
        <div class="footer-center">
            Auditoría SEO | <?php echo date('Y'); ?>
        </div>
        <div class="footer-right">
            Página <span class="page-number"></span>
        </div>
    </div>

</div>
