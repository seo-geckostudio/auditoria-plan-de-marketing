<?php
/**
 * Template: Módulo de Rankings y Top N
 *
 * Plantilla para páginas que muestran rankings, listas ordenadas y top N
 * Tipo de página: Rankings/Top N (según GUIA_DISENO_PAGINAS_AUDITORIA.md)
 *
 * Variables requeridas:
 * - $datosModulo: Array con datos del módulo cargados desde JSON
 */

$titulo = $datosModulo['titulo'] ?? 'Ranking';
$subtitulo = $datosModulo['subtitulo'] ?? '';
$periodo = $datosModulo['periodo'] ?? '';
$rankings = $datosModulo['rankings'] ?? [];
$insights = $datosModulo['insights'] ?? [];
?>

<!-- ============================================ -->
<!-- PÁGINA: <?php echo $titulo; ?> -->
<!-- ============================================ -->
<div class="audit-page ranking-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <?php if ($subtitulo): ?>
        <p class="page-subtitle"><?php echo htmlspecialchars($subtitulo); ?></p>
        <?php endif; ?>
        <?php if ($periodo): ?>
        <div class="page-period"><?php echo htmlspecialchars($periodo); ?></div>
        <?php endif; ?>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <?php if (!empty($rankings)): ?>
        <?php foreach ($rankings as $ranking): ?>
        <div class="ranking-section">
            <h2 class="ranking-title"><?php echo htmlspecialchars($ranking['titulo']); ?></h2>

            <?php if ($ranking['tipo'] === 'tabla'): ?>
            <!-- Tabla de ranking -->
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php foreach ($ranking['columnas'] as $columna): ?>
                        <th><?php echo htmlspecialchars($columna); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ranking['datos'] as $posicion => $fila): ?>
                    <tr class="<?php echo $posicion < 3 ? 'top-three' : ''; ?>">
                        <td class="position-cell">
                            <?php if ($posicion === 0): ?>
                            <i class="fas fa-crown text-warning"></i>
                            <?php endif; ?>
                            <strong><?php echo $posicion + 1; ?></strong>
                        </td>
                        <?php foreach ($fila as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php elseif ($ranking['tipo'] === 'barras'): ?>
            <!-- Gráfica de barras horizontal -->
            <div class="chart-section">
                <canvas id="ranking-chart-<?php echo $ranking['id']; ?>" height="300"></canvas>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('ranking-chart-<?php echo $ranking['id']; ?>').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($ranking['labels'] ?? []); ?>,
                        datasets: [{
                            label: '<?php echo addslashes($ranking['titulo']); ?>',
                            data: <?php echo json_encode($ranking['valores'] ?? []); ?>,
                            backgroundColor: '#54a34a',
                            borderColor: '#54a34a',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
            </script>

            <?php elseif ($ranking['tipo'] === 'lista'): ?>
            <!-- Lista ordenada -->
            <ol class="ranking-list">
                <?php foreach ($ranking['datos'] as $item): ?>
                <li class="ranking-item">
                    <strong><?php echo htmlspecialchars($item['nombre']); ?></strong>
                    <span class="ranking-value"><?php echo htmlspecialchars($item['valor']); ?></span>
                    <?php if (isset($item['descripcion'])): ?>
                    <p class="ranking-description"><?php echo htmlspecialchars($item['descripcion']); ?></p>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ol>
            <?php endif; ?>

        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($insights)): ?>
        <!-- Insights clave -->
        <div class="insights-section">
            <h2 class="section-title">Insights Principales</h2>
            <div class="insights-grid">
                <?php foreach ($insights as $insight): ?>
                <div class="insight-card">
                    <i class="fas <?php echo htmlspecialchars($insight['icono'] ?? 'fa-lightbulb'); ?> insight-icon"></i>
                    <p class="insight-text"><?php echo htmlspecialchars($insight['texto']); ?></p>
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
