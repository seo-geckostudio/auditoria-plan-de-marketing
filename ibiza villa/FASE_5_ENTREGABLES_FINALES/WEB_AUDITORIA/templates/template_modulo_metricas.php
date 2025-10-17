<?php
/**
 * Template: Módulo de Métricas y KPIs
 *
 * Plantilla para páginas que muestran métricas clave, KPIs y comparativas
 * Tipo de página: Métricas/KPIs (según GUIA_DISENO_PAGINAS_AUDITORIA.md)
 *
 * Variables requeridas:
 * - $datosModulo: Array con datos del módulo cargados desde JSON
 */

// Variables de ejemplo - en producción vienen de $datosModulo
$titulo = $datosModulo['titulo'] ?? 'Título del Módulo';
$subtitulo = $datosModulo['subtitulo'] ?? 'Subtítulo descriptivo';
$periodo = $datosModulo['periodo'] ?? 'Período de análisis';
$metricas = $datosModulo['metricas'] ?? [];
$graficas = $datosModulo['graficas'] ?? [];
$conclusiones = $datosModulo['conclusiones'] ?? [];
?>

<!-- ============================================ -->
<!-- PÁGINA: <?php echo $titulo; ?> -->
<!-- ============================================ -->
<div class="audit-page metrics-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($subtitulo); ?></p>
        <div class="page-period"><?php echo htmlspecialchars($periodo); ?></div>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <?php if (!empty($metricas)): ?>
        <!-- Grid de métricas principales -->
        <div class="metrics-grid">
            <?php foreach ($metricas as $metrica): ?>
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas <?php echo htmlspecialchars($metrica['icono'] ?? 'fa-chart-line'); ?>"></i>
                </div>
                <div class="metric-content">
                    <h3 class="metric-label"><?php echo htmlspecialchars($metrica['label']); ?></h3>
                    <p class="metric-value"><?php echo htmlspecialchars($metrica['valor']); ?></p>
                    <?php if (isset($metrica['variacion'])): ?>
                    <p class="metric-change <?php echo $metrica['variacion'] >= 0 ? 'positive' : 'negative'; ?>">
                        <i class="fas fa-arrow-<?php echo $metrica['variacion'] >= 0 ? 'up' : 'down'; ?>"></i>
                        <?php echo htmlspecialchars($metrica['variacion']); ?>%
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($graficas)): ?>
        <!-- Sección de gráficas -->
        <?php foreach ($graficas as $index => $grafica): ?>
        <div class="chart-section">
            <h2 class="chart-title"><?php echo htmlspecialchars($grafica['titulo']); ?></h2>
            <canvas id="chart-<?php echo $index; ?>" height="280"></canvas>
        </div>

        <script>
        // Configuración de Chart.js
        document.addEventListener('DOMContentLoaded', function() {
            const ctx<?php echo $index; ?> = document.getElementById('chart-<?php echo $index; ?>').getContext('2d');
            new Chart(ctx<?php echo $index; ?>, {
                type: '<?php echo $grafica['tipo'] ?? 'line'; ?>',
                data: {
                    labels: <?php echo json_encode($grafica['labels'] ?? []); ?>,
                    datasets: <?php echo json_encode($grafica['datasets'] ?? []); ?>
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
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
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($conclusiones)): ?>
        <!-- Sección de conclusiones -->
        <div class="conclusions-section">
            <h2 class="section-title">Conclusiones Clave</h2>
            <ul class="conclusions-list">
                <?php foreach ($conclusiones as $conclusion): ?>
                <li class="conclusion-item">
                    <i class="fas fa-check-circle text-success"></i>
                    <?php echo htmlspecialchars($conclusion); ?>
                </li>
                <?php endforeach; ?>
            </ul>
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
