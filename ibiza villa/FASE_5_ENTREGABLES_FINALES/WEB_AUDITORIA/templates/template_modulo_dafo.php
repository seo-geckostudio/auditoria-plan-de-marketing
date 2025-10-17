<?php
/**
 * Template: Módulo de Análisis DAFO
 *
 * Plantilla para páginas de conclusiones, análisis DAFO,
 * estrategias y roadmaps
 * Tipo de página: Conclusiones/DAFO (según GUIA_DISENO_PAGINAS_AUDITORIA.md)
 *
 * Variables requeridas:
 * - $datosModulo: Array con datos del módulo cargados desde JSON
 */

$titulo = $datosModulo['titulo'] ?? 'Análisis DAFO';
$subtitulo = $datosModulo['subtitulo'] ?? '';
$dafo = $datosModulo['dafo'] ?? [];
$estrategias = $datosModulo['estrategias'] ?? [];
$roadmap = $datosModulo['roadmap'] ?? [];
?>

<!-- ============================================ -->
<!-- PÁGINA: <?php echo $titulo; ?> -->
<!-- ============================================ -->
<div class="audit-page dafo-page">

    <!-- Header de la página -->
    <div class="page-header">
        <h1 class="page-title"><?php echo htmlspecialchars($titulo); ?></h1>
        <?php if ($subtitulo): ?>
        <p class="page-subtitle"><?php echo htmlspecialchars($subtitulo); ?></p>
        <?php endif; ?>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">

        <?php if (!empty($dafo)): ?>
        <!-- Matriz DAFO -->
        <div class="dafo-matrix">
            <!-- Fortalezas -->
            <div class="dafo-quadrant strengths">
                <div class="quadrant-header">
                    <i class="fas fa-plus-circle"></i>
                    <h2>Fortalezas</h2>
                </div>
                <ul class="quadrant-list">
                    <?php foreach ($dafo['fortalezas'] ?? [] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Debilidades -->
            <div class="dafo-quadrant weaknesses">
                <div class="quadrant-header">
                    <i class="fas fa-minus-circle"></i>
                    <h2>Debilidades</h2>
                </div>
                <ul class="quadrant-list">
                    <?php foreach ($dafo['debilidades'] ?? [] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Oportunidades -->
            <div class="dafo-quadrant opportunities">
                <div class="quadrant-header">
                    <i class="fas fa-lightbulb"></i>
                    <h2>Oportunidades</h2>
                </div>
                <ul class="quadrant-list">
                    <?php foreach ($dafo['oportunidades'] ?? [] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Amenazas -->
            <div class="dafo-quadrant threats">
                <div class="quadrant-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h2>Amenazas</h2>
                </div>
                <ul class="quadrant-list">
                    <?php foreach ($dafo['amenazas'] ?? [] as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($estrategias)): ?>
        <!-- Estrategias derivadas del DAFO -->
        <div class="strategies-section">
            <h2 class="section-title">Estrategias Recomendadas</h2>

            <?php
            $tiposEstrategia = [
                'ofensivas' => ['icono' => 'fa-rocket', 'titulo' => 'Estrategias Ofensivas (FO)', 'descripcion' => 'Aprovechan fortalezas para explotar oportunidades'],
                'defensivas' => ['icono' => 'fa-shield-alt', 'titulo' => 'Estrategias Defensivas (FA)', 'descripcion' => 'Usan fortalezas para evitar amenazas'],
                'reorientacion' => ['icono' => 'fa-sync-alt', 'titulo' => 'Estrategias de Reorientación (DO)', 'descripcion' => 'Superan debilidades aprovechando oportunidades'],
                'supervivencia' => ['icono' => 'fa-life-ring', 'titulo' => 'Estrategias de Supervivencia (DA)', 'descripcion' => 'Minimizan debilidades y evitan amenazas']
            ];
            ?>

            <?php foreach ($tiposEstrategia as $tipo => $config): ?>
                <?php if (isset($estrategias[$tipo]) && !empty($estrategias[$tipo])): ?>
                <div class="strategy-group">
                    <h3 class="strategy-type">
                        <i class="fas <?php echo $config['icono']; ?>"></i>
                        <?php echo $config['titulo']; ?>
                    </h3>
                    <p class="strategy-description"><?php echo $config['descripcion']; ?></p>
                    <ol class="strategy-list">
                        <?php foreach ($estrategias[$tipo] as $estrategia): ?>
                        <li class="strategy-item">
                            <strong><?php echo htmlspecialchars($estrategia['titulo']); ?></strong>
                            <p><?php echo htmlspecialchars($estrategia['descripcion']); ?></p>
                            <?php if (isset($estrategia['prioridad'])): ?>
                            <span class="strategy-priority priority-<?php echo $estrategia['prioridad']; ?>">
                                Prioridad: <?php echo ucfirst($estrategia['prioridad']); ?>
                            </span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($roadmap)): ?>
        <!-- Roadmap de implementación -->
        <div class="roadmap-section">
            <h2 class="section-title">Roadmap de Implementación</h2>

            <div class="timeline">
                <?php foreach ($roadmap as $fase): ?>
                <div class="timeline-item">
                    <div class="timeline-marker">
                        <i class="fas <?php echo $fase['icono'] ?? 'fa-flag'; ?>"></i>
                    </div>
                    <div class="timeline-content">
                        <h3 class="timeline-title"><?php echo htmlspecialchars($fase['titulo']); ?></h3>
                        <span class="timeline-duration"><?php echo htmlspecialchars($fase['duracion']); ?></span>

                        <?php if (isset($fase['objetivos'])): ?>
                        <ul class="timeline-objectives">
                            <?php foreach ($fase['objetivos'] as $objetivo): ?>
                            <li><?php echo htmlspecialchars($objetivo); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (isset($fase['kpis'])): ?>
                        <div class="timeline-kpis">
                            <strong>KPIs:</strong>
                            <?php foreach ($fase['kpis'] as $kpi): ?>
                            <span class="kpi-badge"><?php echo htmlspecialchars($kpi); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
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
