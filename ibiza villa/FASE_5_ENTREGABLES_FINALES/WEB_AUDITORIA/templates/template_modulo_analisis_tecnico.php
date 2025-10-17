<?php
/**
 * Template: Módulo de Análisis Técnico
 *
 * Plantilla para páginas que muestran análisis técnicos detallados,
 * errores, advertencias y recomendaciones
 * Tipo de página: Análisis Técnico (según GUIA_DISENO_PAGINAS_AUDITORIA.md)
 *
 * Variables requeridas:
 * - $datosModulo: Array con datos del módulo cargados desde JSON
 */

$titulo = $datosModulo['titulo'] ?? 'Análisis Técnico';
$subtitulo = $datosModulo['subtitulo'] ?? '';
$resumen = $datosModulo['resumen'] ?? [];
$problemas = $datosModulo['problemas'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
$ejemplos = $datosModulo['ejemplos'] ?? [];
?>

<!-- ============================================ -->
<!-- PÁGINA: <?php echo $titulo; ?> -->
<!-- ============================================ -->
<div class="audit-page technical-analysis-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <?php if ($subtitulo): ?>
        <p class="page-subtitle"><?php echo htmlspecialchars($subtitulo); ?></p>
        <?php endif; ?>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <?php if (!empty($resumen)): ?>
        <!-- Resumen técnico -->
        <div class="technical-summary">
            <div class="summary-grid">
                <?php if (isset($resumen['total_errores'])): ?>
                <div class="summary-card error">
                    <div class="summary-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Errores Críticos</h3>
                        <p class="summary-value"><?php echo htmlspecialchars($resumen['total_errores']); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (isset($resumen['total_advertencias'])): ?>
                <div class="summary-card warning">
                    <div class="summary-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Advertencias</h3>
                        <p class="summary-value"><?php echo htmlspecialchars($resumen['total_advertencias']); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (isset($resumen['total_avisos'])): ?>
                <div class="summary-card info">
                    <div class="summary-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Avisos</h3>
                        <p class="summary-value"><?php echo htmlspecialchars($resumen['total_avisos']); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (isset($resumen['puntuacion'])): ?>
                <div class="summary-card success">
                    <div class="summary-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Puntuación</h3>
                        <p class="summary-value"><?php echo htmlspecialchars($resumen['puntuacion']); ?>/100</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($problemas)): ?>
        <!-- Lista de problemas detectados -->
        <div class="problems-section">
            <h2 class="section-title">Problemas Detectados</h2>

            <?php
            // Agrupar por severidad
            $porSeveridad = ['critico' => [], 'alto' => [], 'medio' => [], 'bajo' => []];
            foreach ($problemas as $problema) {
                $severidad = $problema['severidad'] ?? 'medio';
                $porSeveridad[$severidad][] = $problema;
            }
            ?>

            <?php foreach ($porSeveridad as $severidad => $listaProblemas): ?>
                <?php if (!empty($listaProblemas)): ?>
                <div class="severity-group severity-<?php echo $severidad; ?>">
                    <h3 class="severity-title">
                        <i class="fas fa-<?php
                            echo $severidad === 'critico' ? 'exclamation-circle' :
                                 ($severidad === 'alto' ? 'exclamation-triangle' :
                                 ($severidad === 'medio' ? 'info-circle' : 'check-circle'));
                        ?>"></i>
                        <?php echo ucfirst($severidad); ?> (<?php echo count($listaProblemas); ?>)
                    </h3>

                    <?php foreach ($listaProblemas as $problema): ?>
                    <div class="problem-card">
                        <div class="problem-header">
                            <h4 class="problem-title"><?php echo htmlspecialchars($problema['titulo']); ?></h4>
                            <?php if (isset($problema['cantidad'])): ?>
                            <span class="problem-count"><?php echo htmlspecialchars($problema['cantidad']); ?> casos</span>
                            <?php endif; ?>
                        </div>
                        <p class="problem-description"><?php echo htmlspecialchars($problema['descripcion']); ?></p>

                        <?php if (isset($problema['impacto'])): ?>
                        <div class="problem-impact">
                            <strong>Impacto:</strong> <?php echo htmlspecialchars($problema['impacto']); ?>
                        </div>
                        <?php endif; ?>

                        <?php if (isset($problema['urls']) && !empty($problema['urls'])): ?>
                        <details class="problem-details">
                            <summary>Ver URLs afectadas (<?php echo count($problema['urls']); ?>)</summary>
                            <ul class="affected-urls">
                                <?php foreach (array_slice($problema['urls'], 0, 10) as $url): ?>
                                <li><code><?php echo htmlspecialchars($url); ?></code></li>
                                <?php endforeach; ?>
                                <?php if (count($problema['urls']) > 10): ?>
                                <li class="more-items">... y <?php echo count($problema['urls']) - 10; ?> más</li>
                                <?php endif; ?>
                            </ul>
                        </details>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($recomendaciones)): ?>
        <!-- Recomendaciones -->
        <div class="recommendations-section">
            <h2 class="section-title">Recomendaciones</h2>
            <div class="recommendations-list">
                <?php foreach ($recomendaciones as $index => $recomendacion): ?>
                <div class="recommendation-card">
                    <div class="recommendation-number"><?php echo $index + 1; ?></div>
                    <div class="recommendation-content">
                        <h4 class="recommendation-title"><?php echo htmlspecialchars($recomendacion['titulo']); ?></h4>
                        <p class="recommendation-text"><?php echo htmlspecialchars($recomendacion['descripcion']); ?></p>
                        <?php if (isset($recomendacion['prioridad'])): ?>
                        <span class="recommendation-priority priority-<?php echo $recomendacion['prioridad']; ?>">
                            Prioridad: <?php echo ucfirst($recomendacion['prioridad']); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($ejemplos)): ?>
        <!-- Ejemplos de código/implementación -->
        <div class="examples-section">
            <h2 class="section-title">Ejemplos de Implementación</h2>
            <?php foreach ($ejemplos as $ejemplo): ?>
            <div class="example-card">
                <h4 class="example-title"><?php echo htmlspecialchars($ejemplo['titulo']); ?></h4>
                <pre><code class="language-<?php echo $ejemplo['lenguaje'] ?? 'html'; ?>"><?php echo htmlspecialchars($ejemplo['codigo']); ?></code></pre>
            </div>
            <?php endforeach; ?>
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
