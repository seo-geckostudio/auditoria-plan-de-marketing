<?php
/**
 * Módulo m4.4 - SEO Off-Page
 * Análisis del perfil de enlaces externos, autoridad de dominio y estrategias de construcción de enlaces
 *
 * Estructura: 4 páginas
 * - Página 1: Introducción Off-Page + Métricas Autoridad + Comparativa Competencia
 * - Página 2: Perfil de Enlaces + Distribución + Top Anchor Texts
 * - Página 3: Análisis de SPAM + Dominios Tóxicos + Plan de Limpieza
 * - Página 4: Anchor Text Optimization + GAP Analysis + Estrategia
 */

// Cargar datos del JSON
$jsonPath = __DIR__ . '/../../data/seccion_04_seo_offpage.json';
$jsonContent = file_get_contents($jsonPath);
$datosModulo = json_decode($jsonContent, true);

$seccion = $datosModulo['seccion'];
$paginas = $datosModulo['paginas'];
?>

<!-- PÁGINA 1: INTRODUCCIÓN OFF-PAGE + MÉTRICAS AUTORIDAD -->
<div class="audit-page offpage-intro-page">
    <div class="page-header">
        <div class="section-number">Sección <?php echo $seccion['numero']; ?></div>
        <h1><?php echo htmlspecialchars($seccion['titulo']); ?></h1>
        <p class="section-description"><?php echo htmlspecialchars($seccion['descripcion']); ?></p>
    </div>

    <?php
    $pagina1 = $paginas[0];
    $datos1 = $pagina1['contenido']['datos'];
    $metricas = $datos1['metricas_autoridad'];
    $competencia = $datos1['comparativa_competencia'];
    $resumen = $datos1['resumen_estado'];
    $grafica1 = $pagina1['contenido']['grafica'];
    ?>

    <div class="page-content">
        <!-- Métricas de Autoridad -->
        <div class="authority-metrics-section">
            <h2><i class="fas fa-chart-line"></i> Métricas de Autoridad del Dominio</h2>
            <div class="authority-grid">
                <div class="authority-card highlight">
                    <div class="metric-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="metric-content">
                        <div class="metric-label">Domain Rating (Ahrefs)</div>
                        <div class="metric-value large"><?php echo $metricas['domain_rating_ahrefs']; ?></div>
                        <div class="metric-context">Escala 0-100</div>
                    </div>
                </div>

                <div class="authority-card">
                    <div class="metric-icon"><i class="fas fa-link"></i></div>
                    <div class="metric-content">
                        <div class="metric-label">URL Rating (Home)</div>
                        <div class="metric-value"><?php echo $metricas['url_rating_home']; ?></div>
                        <div class="metric-context">Autoridad Homepage</div>
                    </div>
                </div>

                <div class="authority-card">
                    <div class="metric-icon"><i class="fas fa-globe"></i></div>
                    <div class="metric-content">
                        <div class="metric-label">Dominios Referidos</div>
                        <div class="metric-value"><?php echo number_format($metricas['dominios_referidos']); ?></div>
                        <div class="metric-context">Dominios únicos</div>
                    </div>
                </div>

                <div class="authority-card">
                    <div class="metric-icon"><i class="fas fa-arrow-circle-left"></i></div>
                    <div class="metric-content">
                        <div class="metric-label">Backlinks Totales</div>
                        <div class="metric-value"><?php echo number_format($metricas['backlinks_totales']); ?></div>
                        <div class="metric-context">Enlaces entrantes</div>
                    </div>
                </div>

                <div class="authority-card">
                    <div class="metric-icon"><i class="fas fa-users"></i></div>
                    <div class="metric-content">
                        <div class="metric-label">Tráfico Referido</div>
                        <div class="metric-value"><?php echo number_format($metricas['trafico_referido_estimado']); ?></div>
                        <div class="metric-context">Visitas/mes estimadas</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparativa con Competencia -->
        <div class="competition-comparison">
            <h2><i class="fas fa-users-cog"></i> Comparativa con Competencia</h2>

            <table class="competition-table">
                <thead>
                    <tr>
                        <th>Dominio</th>
                        <th>Domain Rating</th>
                        <th>Dominios Referidos</th>
                        <th>Backlinks</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competencia as $index => $comp): ?>
                    <tr class="<?php echo $index === 0 ? 'own-domain' : ''; ?>">
                        <td>
                            <?php if ($index === 0): ?>
                                <strong><?php echo $comp['dominio']; ?></strong>
                                <span class="badge badge-primary">Tu sitio</span>
                            <?php else: ?>
                                <?php echo $comp['dominio']; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="dr-badge dr-<?php
                                if ($comp['dr'] >= 60) echo 'excellent';
                                elseif ($comp['dr'] >= 50) echo 'good';
                                elseif ($comp['dr'] >= 40) echo 'medium';
                                else echo 'low';
                            ?>">
                                DR <?php echo $comp['dr']; ?>
                            </span>
                        </td>
                        <td><?php echo number_format($comp['dominios_ref']); ?></td>
                        <td><?php echo number_format($comp['backlinks']); ?></td>
                        <td>
                            <?php if ($index === 0): ?>
                                <span class="status-badge warning">Por debajo</span>
                            <?php else: ?>
                                <span class="status-badge info">Competidor</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráfica Comparativa -->
        <div class="chart-container">
            <canvas id="dr-comparison-chart"></canvas>
        </div>

        <!-- Resumen de Estado -->
        <div class="status-summary">
            <h3><i class="fas fa-clipboard-check"></i> Resumen de Estado Actual</h3>
            <ul class="status-list">
                <?php foreach ($resumen as $item): ?>
                <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="page-footer">
        <span>Sección <?php echo $seccion['numero']; ?> - <?php echo $seccion['titulo']; ?></span>
        <span>Página 1/4</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx1 = document.getElementById('dr-comparison-chart').getContext('2d');
    new Chart(ctx1, {
        type: '<?php echo $grafica1['tipo']; ?>',
        data: {
            labels: <?php echo json_encode($grafica1['etiquetas']); ?>,
            datasets: [{
                label: '<?php echo $grafica1['datasets'][0]['label']; ?>',
                data: <?php echo json_encode($grafica1['datasets'][0]['valores']); ?>,
                backgroundColor: '<?php echo $grafica1['datasets'][0]['color']; ?>',
                borderColor: '<?php echo $grafica1['datasets'][0]['color']; ?>',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Domain Rating (0-100)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '<?php echo $grafica1['titulo']; ?>',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            }
        }
    });
});
</script>

<!-- PÁGINA 2: PERFIL DE ENLACES -->
<div class="audit-page link-profile-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($paginas[1]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[1]['subtitulo']); ?></p>
    </div>

    <?php
    $datos2 = $paginas[1]['contenido']['datos'];
    $distribucion = $datos2['distribucion_enlaces'];
    $tipos = $datos2['tipos_enlace'];
    $anchors = $datos2['top_anchor_texts'];
    $problemas = $datos2['problemas_detectados'];
    $oportunidades = $datos2['oportunidades'];
    $grafica2 = $paginas[1]['contenido']['grafica'];
    ?>

    <div class="page-content">
        <!-- Distribución de Enlaces -->
        <div class="link-distribution-section">
            <h2><i class="fas fa-chart-pie"></i> Distribución de Enlaces</h2>

            <div class="distribution-grid">
                <div class="dist-card">
                    <div class="dist-label">Follow</div>
                    <div class="dist-value highlight"><?php echo number_format($distribucion['follow']); ?></div>
                    <div class="dist-percentage"><?php echo number_format($distribucion['porcentaje_follow'], 1); ?>%</div>
                </div>

                <div class="dist-card">
                    <div class="dist-label">Nofollow</div>
                    <div class="dist-value"><?php echo number_format($distribucion['nofollow']); ?></div>
                    <div class="dist-percentage"><?php echo number_format(100 - $distribucion['porcentaje_follow'], 1); ?>%</div>
                </div>

                <div class="dist-card">
                    <div class="dist-label">Enlaces de Texto</div>
                    <div class="dist-value"><?php echo number_format($distribucion['enlaces_texto']); ?></div>
                    <div class="dist-percentage"><?php echo number_format(($distribucion['enlaces_texto'] / ($distribucion['follow'] + $distribucion['nofollow'])) * 100, 1); ?>%</div>
                </div>

                <div class="dist-card">
                    <div class="dist-label">Enlaces de Imagen</div>
                    <div class="dist-value"><?php echo number_format($distribucion['enlaces_imagen']); ?></div>
                    <div class="dist-percentage"><?php echo number_format(($distribucion['enlaces_imagen'] / ($distribucion['follow'] + $distribucion['nofollow'])) * 100, 1); ?>%</div>
                </div>
            </div>
        </div>

        <!-- Tipos de Enlace -->
        <div class="link-types-section">
            <h2><i class="fas fa-list-ul"></i> Análisis por Tipo de Enlace</h2>

            <table class="link-types-table">
                <thead>
                    <tr>
                        <th>Tipo de Enlace</th>
                        <th>Cantidad</th>
                        <th>Porcentaje</th>
                        <th>Calidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tipos as $tipo): ?>
                    <tr>
                        <td><strong><?php echo $tipo['tipo']; ?></strong></td>
                        <td><?php echo number_format($tipo['cantidad']); ?></td>
                        <td>
                            <div class="percentage-bar">
                                <div class="percentage-fill" style="width: <?php echo $tipo['porcentaje']; ?>%"></div>
                                <span class="percentage-text"><?php echo number_format($tipo['porcentaje'], 1); ?>%</span>
                            </div>
                        </td>
                        <td>
                            <span class="quality-badge quality-<?php echo strtolower(str_replace('-', '', $tipo['calidad'])); ?>">
                                <?php echo $tipo['calidad']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráfica de Distribución -->
        <div class="chart-container">
            <canvas id="link-distribution-chart"></canvas>
        </div>

        <!-- Top Anchor Texts -->
        <div class="anchor-texts-section">
            <h2><i class="fas fa-anchor"></i> Top Anchor Texts</h2>

            <table class="anchor-table">
                <thead>
                    <tr>
                        <th>Anchor Text</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anchors as $anchor): ?>
                    <tr>
                        <td><code><?php echo htmlspecialchars($anchor['anchor']); ?></code></td>
                        <td><strong><?php echo number_format($anchor['cantidad']); ?></strong></td>
                        <td>
                            <span class="anchor-type-badge type-<?php echo strtolower($anchor['tipo']); ?>">
                                <?php echo $anchor['tipo']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Problemas y Oportunidades -->
        <div class="findings-grid">
            <div class="findings-card problems">
                <h3><i class="fas fa-exclamation-triangle"></i> Problemas Detectados</h3>
                <ul class="findings-list">
                    <?php foreach ($problemas as $problema): ?>
                    <li><?php echo htmlspecialchars($problema); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="findings-card opportunities">
                <h3><i class="fas fa-lightbulb"></i> Oportunidades</h3>
                <ul class="findings-list">
                    <?php foreach ($oportunidades as $oportunidad): ?>
                    <li><?php echo htmlspecialchars($oportunidad); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Sección <?php echo $seccion['numero']; ?> - <?php echo $seccion['titulo']; ?></span>
        <span>Página 2/4</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx2 = document.getElementById('link-distribution-chart').getContext('2d');
    new Chart(ctx2, {
        type: '<?php echo $grafica2['tipo']; ?>',
        data: {
            labels: <?php echo json_encode($grafica2['etiquetas']); ?>,
            datasets: [{
                data: <?php echo json_encode($grafica2['valores']); ?>,
                backgroundColor: <?php echo json_encode($grafica2['colores']); ?>,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                title: {
                    display: true,
                    text: '<?php echo $grafica2['titulo']; ?>',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            }
        }
    });
});
</script>

<!-- PÁGINA 3: ANÁLISIS DE SPAM -->
<div class="audit-page spam-analysis-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($paginas[2]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[2]['subtitulo']); ?></p>
    </div>

    <?php
    $datos3 = $paginas[2]['contenido']['datos'];
    $toxicidad = $datos3['resumen_toxicidad'];
    $categorias = $datos3['categorias_spam'];
    $dominios_toxicos = $datos3['top_dominios_toxicos'];
    $plan_limpieza = $datos3['plan_limpieza'];
    $disavow = $datos3['archivo_disavow_preview'];
    ?>

    <div class="page-content">
        <!-- Resumen de Toxicidad -->
        <div class="toxicity-summary">
            <h2><i class="fas fa-shield-virus"></i> Resumen de Toxicidad</h2>

            <div class="toxicity-grid">
                <div class="tox-card">
                    <div class="tox-label">Enlaces Totales</div>
                    <div class="tox-value"><?php echo number_format($toxicidad['enlaces_totales']); ?></div>
                </div>

                <div class="tox-card danger">
                    <div class="tox-label">Enlaces Tóxicos</div>
                    <div class="tox-value large"><?php echo number_format($toxicidad['enlaces_toxicos']); ?></div>
                    <div class="tox-percentage"><?php echo number_format($toxicidad['porcentaje_spam'], 1); ?>% del total</div>
                </div>

                <div class="tox-card warning">
                    <div class="tox-label">Dominios SPAM</div>
                    <div class="tox-value"><?php echo number_format($toxicidad['dominios_spam']); ?></div>
                    <div class="tox-context">Dominios a desautorizar</div>
                </div>

                <div class="tox-card">
                    <div class="tox-label">Spam Score Promedio</div>
                    <div class="tox-value"><?php echo $toxicidad['spam_score_promedio']; ?></div>
                    <div class="tox-context">Escala 0-100</div>
                </div>
            </div>
        </div>

        <!-- Categorías de SPAM -->
        <div class="spam-categories-section">
            <h2><i class="fas fa-layer-group"></i> Categorías de SPAM</h2>

            <table class="spam-categories-table">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Ejemplo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td><strong><?php echo $cat['categoria']; ?></strong></td>
                        <td><span class="spam-count"><?php echo number_format($cat['cantidad']); ?></span></td>
                        <td><code><?php echo htmlspecialchars($cat['ejemplo']); ?></code></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Top Dominios Tóxicos -->
        <div class="toxic-domains-section">
            <h2><i class="fas fa-ban"></i> Top Dominios Tóxicos a Desautorizar</h2>

            <table class="toxic-domains-table">
                <thead>
                    <tr>
                        <th>Dominio</th>
                        <th>Enlaces</th>
                        <th>Spam Score</th>
                        <th>Acción Recomendada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dominios_toxicos as $dom): ?>
                    <tr>
                        <td><code><?php echo htmlspecialchars($dom['dominio']); ?></code></td>
                        <td><?php echo $dom['enlaces']; ?></td>
                        <td>
                            <div class="spam-score-badge score-<?php
                                if ($dom['spam_score'] >= 90) echo 'critical';
                                elseif ($dom['spam_score'] >= 75) echo 'high';
                                else echo 'medium';
                            ?>">
                                <?php echo $dom['spam_score']; ?>/100
                            </div>
                        </td>
                        <td><span class="action-badge danger"><?php echo $dom['accion']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Plan de Limpieza -->
        <div class="cleanup-plan">
            <h2><i class="fas fa-broom"></i> Plan de Limpieza de Enlaces Tóxicos</h2>

            <div class="plan-phases">
                <div class="phase-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Fase 1: Crear Archivo Disavow</h4>
                        <p><?php echo $plan_limpieza['fase_1']; ?></p>
                    </div>
                </div>

                <div class="phase-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Fase 2: Subir a Google</h4>
                        <p><?php echo $plan_limpieza['fase_2']; ?></p>
                    </div>
                </div>

                <div class="phase-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Fase 3: Monitoreo</h4>
                        <p><?php echo $plan_limpieza['fase_3']; ?></p>
                    </div>
                </div>

                <div class="phase-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Fase 4: Mantenimiento</h4>
                        <p><?php echo $plan_limpieza['fase_4']; ?></p>
                    </div>
                </div>
            </div>

            <div class="expected-impact">
                <strong>Impacto Estimado:</strong> <?php echo $plan_limpieza['impacto_estimado']; ?>
            </div>
        </div>

        <!-- Preview Archivo Disavow -->
        <div class="disavow-preview">
            <h3><i class="fas fa-file-code"></i> Preview: Archivo Disavow</h3>
            <div class="code-block">
                <pre><?php
                    foreach ($disavow as $line) {
                        echo htmlspecialchars($line) . "\n";
                    }
                ?></pre>
            </div>
            <p class="disavow-note">
                <i class="fas fa-info-circle"></i>
                Este archivo debe subirse en Google Search Console &gt; Seguridad y Acciones Manuales &gt; Desautorizar Enlaces
            </p>
        </div>
    </div>

    <div class="page-footer">
        <span>Sección <?php echo $seccion['numero']; ?> - <?php echo $seccion['titulo']; ?></span>
        <span>Página 3/4</span>
    </div>
</div>

<!-- PÁGINA 4: ANCHOR TEXT OPTIMIZATION -->
<div class="audit-page anchor-optimization-page">
    <div class="page-header">
        <h1><?php echo htmlspecialchars($paginas[3]['titulo']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($paginas[3]['subtitulo']); ?></p>
    </div>

    <?php
    $datos4 = $paginas[3]['contenido']['datos'];
    $dist_actual = $datos4['distribucion_actual'];
    $dist_ideal = $datos4['distribucion_ideal'];
    $gap = $datos4['gap_analisis'];
    $keywords_objetivo = $datos4['keywords_objetivo_link_building'];
    $estrategia = $datos4['estrategia_anchor_text'];
    $grafica4 = $paginas[3]['contenido']['grafica'];
    ?>

    <div class="page-content">
        <!-- Distribución Actual vs Ideal -->
        <div class="distribution-comparison">
            <h2><i class="fas fa-balance-scale"></i> Distribución Anchor Text: Actual vs Ideal</h2>

            <div class="comparison-grid">
                <div class="comparison-column">
                    <h3>Distribución Actual</h3>
                    <div class="dist-items">
                        <?php foreach ($dist_actual as $tipo => $cantidad): ?>
                        <div class="dist-item">
                            <div class="dist-type"><?php echo ucfirst($tipo); ?></div>
                            <div class="dist-count"><?php echo number_format($cantidad); ?> enlaces</div>
                            <div class="dist-percent"><?php echo number_format(($cantidad / array_sum($dist_actual)) * 100, 1); ?>%</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="comparison-column ideal">
                    <h3>Distribución Ideal</h3>
                    <div class="dist-items">
                        <?php foreach ($dist_ideal as $tipo => $rango): ?>
                        <div class="dist-item">
                            <div class="dist-type"><?php echo ucfirst($tipo); ?></div>
                            <div class="dist-range"><?php echo $rango; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- GAP Analysis -->
        <div class="gap-analysis-section">
            <h2><i class="fas fa-chart-bar"></i> GAP Analysis</h2>

            <table class="gap-table">
                <thead>
                    <tr>
                        <th>Tipo Anchor</th>
                        <th>% Actual</th>
                        <th>Rango Ideal</th>
                        <th>Estado</th>
                        <th>Acción Requerida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gap as $item): ?>
                    <tr>
                        <td><strong><?php echo $item['tipo']; ?></strong></td>
                        <td><?php echo number_format($item['actual'], 1); ?>%</td>
                        <td><?php echo $item['ideal']; ?>%</td>
                        <td>
                            <span class="status-badge status-<?php
                                if ($item['estado'] === 'Óptimo') echo 'success';
                                elseif ($item['estado'] === 'Por debajo') echo 'warning';
                                else echo 'danger';
                            ?>">
                                <?php echo $item['estado']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($item['estado'] === 'Por debajo'): ?>
                                <i class="fas fa-arrow-up"></i> Aumentar
                            <?php elseif ($item['estado'] === 'Excesivo'): ?>
                                <i class="fas fa-arrow-down"></i> Reducir
                            <?php else: ?>
                                <i class="fas fa-check"></i> Mantener
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráfica Comparativa -->
        <div class="chart-container">
            <canvas id="anchor-comparison-chart"></canvas>
        </div>

        <!-- Keywords Objetivo para Link Building -->
        <div class="target-keywords-section">
            <h2><i class="fas fa-bullseye"></i> Keywords Objetivo para Link Building</h2>

            <div class="keywords-grid">
                <?php foreach ($keywords_objetivo as $kw): ?>
                <div class="keyword-card">
                    <i class="fas fa-key"></i>
                    <span><?php echo htmlspecialchars($kw); ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="keywords-note">
                <i class="fas fa-info-circle"></i>
                Priorizar estas keywords en campañas de guest posting, relaciones públicas digitales y contenido editorial.
            </p>
        </div>

        <!-- Estrategia de Anchor Text -->
        <div class="anchor-strategy-section">
            <h2><i class="fas fa-rocket"></i> Estrategia de Optimización de Anchor Text</h2>

            <div class="strategy-steps">
                <?php foreach ($estrategia as $index => $paso): ?>
                <div class="strategy-step">
                    <div class="step-badge"><?php echo $index + 1; ?></div>
                    <div class="step-text"><?php echo htmlspecialchars($paso); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Recomendaciones Finales -->
        <div class="final-recommendations">
            <h3><i class="fas fa-lightbulb"></i> Recomendaciones Clave</h3>
            <div class="recommendations-grid">
                <div class="rec-card">
                    <div class="rec-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4>Prioridad Alta</h4>
                    <p>Reducir enlaces genéricos eliminando SPAM y mejorando calidad del perfil de enlaces</p>
                </div>

                <div class="rec-card">
                    <div class="rec-icon"><i class="fas fa-chart-line"></i></div>
                    <h4>Crecimiento</h4>
                    <p>Aumentar anchors con keywords objetivo mediante guest posting estratégico</p>
                </div>

                <div class="rec-card">
                    <div class="rec-icon"><i class="fas fa-balance-scale"></i></div>
                    <h4>Balance</h4>
                    <p>Mantener distribución natural: 50-60% marca/URL, 20% keywords, resto variado</p>
                </div>

                <div class="rec-card">
                    <div class="rec-icon"><i class="fas fa-globe-europe"></i></div>
                    <h4>Diversificación</h4>
                    <p>Expandir link building a mercados FR y DE con keywords localizadas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <span>Sección <?php echo $seccion['numero']; ?> - <?php echo $seccion['titulo']; ?></span>
        <span>Página 4/4</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx4 = document.getElementById('anchor-comparison-chart').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($grafica4['etiquetas']); ?>,
            datasets: [
                {
                    label: '<?php echo $grafica4['datasets'][0]['label']; ?>',
                    data: <?php echo json_encode($grafica4['datasets'][0]['valores']); ?>,
                    backgroundColor: '<?php echo $grafica4['datasets'][0]['color']; ?>',
                    borderColor: '<?php echo $grafica4['datasets'][0]['color']; ?>',
                    borderWidth: 2
                },
                {
                    label: '<?php echo $grafica4['datasets'][1]['label']; ?>',
                    data: <?php echo json_encode($grafica4['datasets'][1]['valores']); ?>,
                    backgroundColor: '<?php echo $grafica4['datasets'][1]['color']; ?>',
                    borderColor: '<?php echo $grafica4['datasets'][1]['color']; ?>',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 40,
                    title: {
                        display: true,
                        text: 'Porcentaje (%)'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: '<?php echo $grafica4['titulo']; ?>',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            }
        }
    });
});
</script>

<style>
/* ========================================
   ESTILOS PÁGINA 1: INTRODUCCIÓN OFF-PAGE
   ======================================== */
.offpage-intro-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 60px;
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-number {
    font-size: 14px;
    color: #667eea;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.page-header h1 {
    font-size: 42px;
    color: #2d3748;
    margin: 15px 0;
    font-weight: 700;
}

.section-description {
    font-size: 18px;
    color: #4a5568;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

.authority-metrics-section {
    margin-bottom: 40px;
}

.authority-metrics-section h2 {
    font-size: 24px;
    color: #2d3748;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.authority-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.authority-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s ease;
}

.authority-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.15);
}

.authority-card.highlight {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.metric-icon {
    font-size: 32px;
    color: #667eea;
    opacity: 0.8;
}

.authority-card.highlight .metric-icon {
    color: white;
}

.metric-content {
    flex: 1;
}

.metric-label {
    font-size: 13px;
    opacity: 0.8;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.metric-value {
    font-size: 32px;
    font-weight: 700;
    line-height: 1;
}

.metric-value.large {
    font-size: 48px;
}

.metric-context {
    font-size: 12px;
    opacity: 0.7;
    margin-top: 5px;
}

.competition-comparison {
    margin: 40px 0;
}

.competition-comparison h2 {
    font-size: 24px;
    color: #2d3748;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.competition-table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.competition-table thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.competition-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

.competition-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.competition-table tr.own-domain {
    background: #f7fafc;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 8px;
}

.badge-primary {
    background: #667eea;
    color: white;
}

.dr-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 14px;
}

.dr-badge.dr-excellent {
    background: #48bb78;
    color: white;
}

.dr-badge.dr-good {
    background: #4299e1;
    color: white;
}

.dr-badge.dr-medium {
    background: #ed8936;
    color: white;
}

.dr-badge.dr-low {
    background: #e53e3e;
    color: white;
}

.status-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.warning {
    background: #fef5e7;
    color: #d97706;
}

.status-badge.info {
    background: #eff6ff;
    color: #3b82f6;
}

.status-badge.success {
    background: #f0fdf4;
    color: #22c55e;
}

.status-badge.danger {
    background: #fef2f2;
    color: #ef4444;
}

.chart-container {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin: 30px 0;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    height: 400px;
}

.status-summary {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.status-summary h3 {
    font-size: 20px;
    color: #2d3748;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-list {
    list-style: none;
    padding: 0;
}

.status-list li {
    padding: 12px 0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-list li:last-child {
    border-bottom: none;
}

.status-list li:before {
    content: "•";
    color: #667eea;
    font-size: 20px;
    font-weight: bold;
}

/* ========================================
   ESTILOS PÁGINA 2: PERFIL DE ENLACES
   ======================================== */
.link-profile-page {
    background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
    padding: 60px;
    min-height: 100vh;
}

.subtitle {
    font-size: 16px;
    color: #4a5568;
    margin-top: 5px;
}

.link-distribution-section {
    margin-bottom: 40px;
}

.distribution-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.dist-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.dist-label {
    font-size: 14px;
    color: #718096;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.dist-value {
    font-size: 36px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.dist-value.highlight {
    color: #667eea;
}

.dist-percentage {
    font-size: 18px;
    color: #48bb78;
    font-weight: 600;
}

.link-types-section {
    margin: 40px 0;
}

.link-types-table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.link-types-table thead {
    background: linear-gradient(135deg, #00acc1 0%, #00838f 100%);
    color: white;
}

.link-types-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

.link-types-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.percentage-bar {
    position: relative;
    height: 30px;
    background: #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
}

.percentage-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    transition: width 0.3s ease;
}

.percentage-text {
    position: relative;
    z-index: 1;
    line-height: 30px;
    padding: 0 10px;
    font-weight: 600;
    color: #2d3748;
}

.quality-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.quality-badge.quality-alta {
    background: #48bb78;
    color: white;
}

.quality-badge.quality-media {
    background: #4299e1;
    color: white;
}

.quality-badge.quality-mediabaja {
    background: #ed8936;
    color: white;
}

.quality-badge.quality-baja {
    background: #e53e3e;
    color: white;
}

.quality-badge.quality-variable {
    background: #9f7aea;
    color: white;
}

.anchor-texts-section {
    margin: 40px 0;
}

.anchor-table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.anchor-table thead {
    background: #2d3748;
    color: white;
}

.anchor-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

.anchor-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.anchor-table code {
    background: #f7fafc;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 13px;
}

.anchor-type-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.anchor-type-badge.type-marca {
    background: #dbeafe;
    color: #1e40af;
}

.anchor-type-badge.type-url {
    background: #e0e7ff;
    color: #4338ca;
}

.anchor-type-badge.type-keyword {
    background: #dcfce7;
    color: #15803d;
}

.anchor-type-badge.type-genérico {
    background: #fee2e2;
    color: #991b1b;
}

.findings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 40px;
}

.findings-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.findings-card.problems {
    border-left: 5px solid #e53e3e;
}

.findings-card.opportunities {
    border-left: 5px solid #48bb78;
}

.findings-card h3 {
    font-size: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.findings-card.problems h3 {
    color: #e53e3e;
}

.findings-card.opportunities h3 {
    color: #48bb78;
}

.findings-list {
    list-style: none;
    padding: 0;
}

.findings-list li {
    padding: 10px 0;
    border-bottom: 1px solid #e2e8f0;
    padding-left: 25px;
    position: relative;
}

.findings-list li:last-child {
    border-bottom: none;
}

.findings-card.problems .findings-list li:before {
    content: "⚠";
    position: absolute;
    left: 0;
    color: #e53e3e;
}

.findings-card.opportunities .findings-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #48bb78;
}

/* ========================================
   ESTILOS PÁGINA 3: ANÁLISIS DE SPAM
   ======================================== */
.spam-analysis-page {
    background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
    padding: 60px;
    min-height: 100vh;
}

.toxicity-summary {
    margin-bottom: 40px;
}

.toxicity-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.tox-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.tox-card.danger {
    background: linear-gradient(135deg, #fc8181 0%, #e53e3e 100%);
    color: white;
}

.tox-card.warning {
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
    color: white;
}

.tox-label {
    font-size: 13px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
}

.tox-value {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 5px;
}

.tox-value.large {
    font-size: 48px;
}

.tox-percentage,
.tox-context {
    font-size: 14px;
    opacity: 0.8;
}

.spam-categories-section,
.toxic-domains-section {
    margin: 40px 0;
}

.spam-categories-table,
.toxic-domains-table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.spam-categories-table thead,
.toxic-domains-table thead {
    background: linear-gradient(135deg, #e53e3e 0%, #991b1b 100%);
    color: white;
}

.spam-categories-table th,
.toxic-domains-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

.spam-categories-table td,
.toxic-domains-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.spam-count {
    display: inline-block;
    background: #fed7d7;
    color: #991b1b;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 700;
}

.spam-score-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 14px;
}

.spam-score-badge.score-critical {
    background: #991b1b;
    color: white;
}

.spam-score-badge.score-high {
    background: #e53e3e;
    color: white;
}

.spam-score-badge.score-medium {
    background: #ed8936;
    color: white;
}

.action-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.action-badge.danger {
    background: #fee2e2;
    color: #991b1b;
}

.cleanup-plan {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin: 40px 0;
}

.cleanup-plan h2 {
    font-size: 24px;
    color: #2d3748;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.plan-phases {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-bottom: 30px;
}

.phase-step {
    display: flex;
    gap: 15px;
    align-items: start;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
    flex-shrink: 0;
}

.step-content h4 {
    font-size: 16px;
    color: #2d3748;
    margin-bottom: 8px;
}

.step-content p {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.6;
}

.expected-impact {
    background: #f0fdf4;
    border-left: 4px solid #22c55e;
    padding: 15px 20px;
    border-radius: 6px;
    color: #15803d;
}

.disavow-preview {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.disavow-preview h3 {
    font-size: 20px;
    color: #2d3748;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.code-block {
    background: #1e293b;
    border-radius: 8px;
    padding: 20px;
    overflow-x: auto;
    margin-bottom: 15px;
}

.code-block pre {
    color: #e2e8f0;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    margin: 0;
    line-height: 1.6;
}

.disavow-note {
    background: #eff6ff;
    padding: 15px;
    border-radius: 6px;
    color: #1e40af;
    font-size: 14px;
}

/* ========================================
   ESTILOS PÁGINA 4: ANCHOR TEXT OPTIMIZATION
   ======================================== */
.anchor-optimization-page {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    padding: 60px;
    min-height: 100vh;
}

.distribution-comparison {
    margin-bottom: 40px;
}

.comparison-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.comparison-column {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.comparison-column.ideal {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
}

.comparison-column h3 {
    font-size: 20px;
    color: #2d3748;
    margin-bottom: 20px;
    text-align: center;
}

.dist-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.dist-item {
    padding: 15px;
    background: #f7fafc;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.comparison-column.ideal .dist-item {
    border-left-color: #22c55e;
}

.dist-type {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.dist-count {
    font-size: 18px;
    color: #4a5568;
}

.dist-percent {
    font-size: 24px;
    font-weight: 700;
    color: #667eea;
}

.dist-range {
    font-size: 20px;
    font-weight: 700;
    color: #22c55e;
}

.gap-analysis-section {
    margin: 40px 0;
}

.gap-table {
    width: 100%;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.gap-table thead {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.gap-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
}

.gap-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.target-keywords-section {
    margin: 40px 0;
}

.keywords-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.keyword-card {
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.keyword-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.keyword-card i {
    color: #f59e0b;
}

.keywords-note {
    background: white;
    padding: 15px;
    border-radius: 8px;
    color: #4a5568;
    font-size: 14px;
}

.anchor-strategy-section {
    margin: 40px 0;
}

.strategy-steps {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.strategy-step {
    background: white;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: start;
    gap: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.step-badge {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.step-text {
    flex: 1;
    font-size: 15px;
    color: #2d3748;
    line-height: 1.6;
}

.final-recommendations {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.final-recommendations h3 {
    font-size: 24px;
    color: #2d3748;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.recommendations-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.rec-card {
    background: #f7fafc;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    transition: transform 0.3s ease;
}

.rec-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.rec-icon {
    font-size: 40px;
    color: #667eea;
    margin-bottom: 15px;
}

.rec-card h4 {
    font-size: 18px;
    color: #2d3748;
    margin-bottom: 10px;
}

.rec-card p {
    font-size: 14px;
    color: #4a5568;
    line-height: 1.6;
}

/* ========================================
   ESTILOS COMUNES PARA TODAS LAS PÁGINAS
   ======================================== */
.page-footer {
    margin-top: 50px;
    padding-top: 20px;
    border-top: 2px solid rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #4a5568;
}

@media print {
    .audit-page {
        page-break-after: always;
    }
}
</style>
