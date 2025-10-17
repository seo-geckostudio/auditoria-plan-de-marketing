<?php
/**
 * Módulo: Local SEO (m9.5)
 * Fase: 9 - SEO Moderno
 * Página: 138 - Optimización para búsquedas locales y Google Business Profile
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Sección 09
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$gbp_status = $datosModulo['google_business_profile'] ?? [];
$local_schema = $datosModulo['local_schema'] ?? [];
$nap_consistency = $datosModulo['nap_consistency'] ?? [];
$citations = $datosModulo['citations'] ?? [];
$reviews = $datosModulo['reviews'] ?? [];
$local_pack = $datosModulo['local_pack_visibility'] ?? [];
$competencia_local = $datosModulo['competencia_local'] ?? [];
$local_keywords = $datosModulo['local_keywords'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<div class="audit-page local-seo-page">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-map-marker-alt"></i>
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Local SEO'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para Búsquedas Locales y Google Business Profile'); ?></p>
        <div class="page-meta">
            <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span><i class="fas fa-tools"></i> Google Business Profile, Google Maps, LSI Graph</span>
            <span><i class="fas fa-book"></i> Página 138</span>
        </div>
    </div>

    <div class="page-body">

        <!-- Resumen Ejecutivo -->
        <?php if (!empty($resumen)): ?>
        <section class="executive-summary">
            <h2><i class="fas fa-chart-line"></i> Resumen Ejecutivo</h2>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-label">Score Local SEO</div>
                    <div class="summary-value <?php echo $resumen['score_class'] ?? ''; ?>">
                        <?php echo htmlspecialchars($resumen['score'] ?? 'N/A'); ?>/100
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">GBP Status</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['gbp_status'] ?? 'No verificado'); ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Local Pack Visibility</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['local_pack_visibility'] ?? '0%'); ?>
                    </div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Reviews</div>
                    <div class="summary-value">
                        <?php echo htmlspecialchars($resumen['total_reviews'] ?? '0'); ?>
                        (⭐ <?php echo htmlspecialchars($resumen['avg_rating'] ?? '0.0'); ?>)
                    </div>
                </div>
            </div>
            <?php if (!empty($resumen['diagnostico'])): ?>
            <div class="summary-diagnosis">
                <p><?php echo nl2br(htmlspecialchars($resumen['diagnostico'])); ?></p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Google Business Profile Status -->
        <?php if (!empty($gbp_status)): ?>
        <section class="gbp-section">
            <h2><i class="fas fa-google"></i> Google Business Profile - Status</h2>

            <div class="gbp-completion">
                <h3>Completitud del Perfil: <?php echo htmlspecialchars($gbp_status['completion_percentage'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($gbp_status['completion_percentage'] ?? '0'); ?>%;"></div>
                </div>
            </div>

            <div class="gbp-checklist">
                <h3>Checklist de Optimización (100 puntos)</h3>

                <div class="checklist-category">
                    <h4>1. Información Básica (25 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $info_basica = $gbp_status['informacion_basica'] ?? [];
                        foreach ($info_basica as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                            <?php if (!empty($item['nota'])): ?>
                            <span class="item-note"><?php echo htmlspecialchars($item['nota']); ?></span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>2. Content y Multimedia (20 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $multimedia = $gbp_status['multimedia'] ?? [];
                        foreach ($multimedia as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                            <?php if (!empty($item['cantidad'])): ?>
                            <span class="item-quantity">(<?php echo htmlspecialchars($item['cantidad']); ?>)</span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>3. Products y Services (15 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $products = $gbp_status['products_services'] ?? [];
                        foreach ($products as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>4. Google Posts (10 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $posts = $gbp_status['google_posts'] ?? [];
                        foreach ($posts as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>5. Reviews Management (20 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $reviews_mgmt = $gbp_status['reviews_management'] ?? [];
                        foreach ($reviews_mgmt as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="checklist-category">
                    <h4>6. Q&A Section (10 puntos)</h4>
                    <ul class="checklist-items">
                        <?php
                        $qna = $gbp_status['qna_section'] ?? [];
                        foreach ($qna as $item):
                        ?>
                        <li class="<?php echo $item['status'] ? 'completed' : 'pending'; ?>">
                            <i class="fas fa-<?php echo $item['status'] ? 'check-circle' : 'times-circle'; ?>"></i>
                            <?php echo htmlspecialchars($item['item']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Local Schema Implementation -->
        <?php if (!empty($local_schema)): ?>
        <section class="local-schema-section">
            <h2><i class="fas fa-code"></i> Local Schema Implementation</h2>

            <div class="schema-status">
                <div class="status-item">
                    <span class="status-label">LocalBusiness Schema:</span>
                    <span class="status-badge <?php echo $local_schema['localbusiness_presente'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['localbusiness_presente'] ? '✓ Implementado' : '✗ No encontrado'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">NAP en Schema:</span>
                    <span class="status-badge <?php echo $local_schema['nap_en_schema'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['nap_en_schema'] ? '✓ Correcto' : '✗ Incompleto'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">GeoCoordinates:</span>
                    <span class="status-badge <?php echo $local_schema['geo_presente'] ? 'success' : 'error'; ?>">
                        <?php echo $local_schema['geo_presente'] ? '✓ Implementado' : '✗ Falta'; ?>
                    </span>
                </div>
                <div class="status-item">
                    <span class="status-label">Opening Hours:</span>
                    <span class="status-badge <?php echo $local_schema['hours_presente'] ? 'success' : 'warning'; ?>">
                        <?php echo $local_schema['hours_presente'] ? '✓ Implementado' : '⚠ Falta'; ?>
                    </span>
                </div>
            </div>

            <?php if (!empty($local_schema['schema_recomendado'])): ?>
            <div class="schema-code">
                <h3>Schema Recomendado:</h3>
                <pre><code><?php echo htmlspecialchars($local_schema['schema_recomendado']); ?></code></pre>
                <button class="btn-copy" onclick="copyToClipboard(this)">
                    <i class="fas fa-copy"></i> Copiar código
                </button>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- NAP Consistency -->
        <?php if (!empty($nap_consistency)): ?>
        <section class="nap-section">
            <h2><i class="fas fa-address-card"></i> NAP Consistency (Name, Address, Phone)</h2>

            <div class="nap-score">
                <h3>Consistencia NAP: <?php echo htmlspecialchars($nap_consistency['consistency_score'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($nap_consistency['consistency_score'] ?? '0'); ?>%;"></div>
                </div>
            </div>

            <?php if (!empty($nap_consistency['variaciones_encontradas'])): ?>
            <div class="nap-variations">
                <h3>Variaciones Encontradas:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Plataforma</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nap_consistency['variaciones_encontradas'] as $variacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($variacion['plataforma']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($variacion['telefono']); ?></td>
                            <td>
                                <span class="status-badge <?php echo $variacion['consistente'] ? 'success' : 'error'; ?>">
                                    <?php echo $variacion['consistente'] ? '✓' : '✗'; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <?php if (!empty($nap_consistency['nap_canonico'])): ?>
            <div class="nap-canonical">
                <h3>NAP Canónico Recomendado:</h3>
                <div class="canonical-box">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['nombre']); ?></p>
                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['direccion']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($nap_consistency['nap_canonico']['telefono']); ?></p>
                </div>
                <p class="info-note">
                    <i class="fas fa-info-circle"></i>
                    Usar esta versión exacta en todas las plataformas para maximizar consistencia
                </p>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Citations Analysis -->
        <?php if (!empty($citations)): ?>
        <section class="citations-section">
            <h2><i class="fas fa-link"></i> Citations y Directorios</h2>

            <div class="citations-summary">
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['total_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Total Citations</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['consistent_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Consistentes</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['inconsistent_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Inconsistentes</span>
                </div>
                <div class="citation-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($citations['missing_citations'] ?? '0'); ?></span>
                    <span class="stat-label">Oportunidades</span>
                </div>
            </div>

            <?php if (!empty($citations['top_citations'])): ?>
            <div class="citations-list">
                <h3>Top Citations Prioritarios:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Directorio</th>
                            <th>Domain Authority</th>
                            <th>Status</th>
                            <th>NAP Consistent</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citations['top_citations'] as $citation): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($citation['directorio']); ?></strong></td>
                            <td><?php echo htmlspecialchars($citation['da']); ?></td>
                            <td>
                                <span class="status-badge <?php echo $citation['presente'] ? 'success' : 'error'; ?>">
                                    <?php echo $citation['presente'] ? 'Presente' : 'Falta'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($citation['presente']): ?>
                                <span class="status-badge <?php echo $citation['nap_consistent'] ? 'success' : 'warning'; ?>">
                                    <?php echo $citation['nap_consistent'] ? '✓' : '✗'; ?>
                                </span>
                                <?php else: ?>
                                <span>N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($citation['accion']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Reviews Analysis -->
        <?php if (!empty($reviews)): ?>
        <section class="reviews-section">
            <h2><i class="fas fa-star"></i> Análisis de Reviews</h2>

            <div class="reviews-summary">
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['total_reviews'] ?? '0'); ?></span>
                    <span class="stat-label">Total Reviews</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number">⭐ <?php echo htmlspecialchars($reviews['avg_rating'] ?? '0.0'); ?></span>
                    <span class="stat-label">Rating Promedio</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['response_rate'] ?? '0'); ?>%</span>
                    <span class="stat-label">Tasa de Respuesta</span>
                </div>
                <div class="review-stat">
                    <span class="stat-number"><?php echo htmlspecialchars($reviews['avg_response_time'] ?? 'N/A'); ?></span>
                    <span class="stat-label">Tiempo Promedio Respuesta</span>
                </div>
            </div>

            <?php if (!empty($reviews['distribucion_estrellas'])): ?>
            <div class="reviews-distribution">
                <h3>Distribución de Estrellas:</h3>
                <div class="stars-chart">
                    <?php foreach ($reviews['distribucion_estrellas'] as $estrellas => $datos): ?>
                    <div class="star-row">
                        <span class="star-label"><?php echo $estrellas; ?> ⭐</span>
                        <div class="star-bar">
                            <div class="star-fill" style="width: <?php echo $datos['porcentaje']; ?>%;"></div>
                        </div>
                        <span class="star-count"><?php echo $datos['cantidad']; ?> (<?php echo $datos['porcentaje']; ?>%)</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($reviews['keywords_reviews'])): ?>
            <div class="reviews-keywords">
                <h3>Keywords Mencionadas en Reviews:</h3>
                <div class="keywords-cloud">
                    <?php foreach ($reviews['keywords_reviews'] as $keyword): ?>
                    <span class="keyword-tag" style="font-size: <?php echo 12 + ($keyword['frecuencia'] / 2); ?>px;">
                        <?php echo htmlspecialchars($keyword['keyword']); ?>
                        <small>(<?php echo $keyword['frecuencia']; ?>)</small>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="reviews-templates">
                <h3>Templates de Respuesta Recomendados:</h3>

                <div class="template-box positive">
                    <h4>Review Positiva (4-5 estrellas):</h4>
                    <pre>"Hola [Nombre], ¡Muchas gracias por tu review y por confiar en <?php echo htmlspecialchars($datosModulo['nombre_negocio'] ?? '[Negocio]'); ?>!
Nos alegra mucho que [específico sobre su experiencia].
[Invitación personalizada a volver].
¡Saludos! - [Tu Nombre], [Título]"</pre>
                </div>

                <div class="template-box negative">
                    <h4>Review Negativa (1-2 estrellas):</h4>
                    <pre>"Hola [Nombre], lamentamos mucho tu experiencia.
[Reconocimiento específico del problema].
Nos gustaría resolver esto directamente.
Por favor contáctanos en [email/phone] para encontrar una solución.
Gracias por tu feedback. - [Tu Nombre], [Título]"</pre>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Local Pack Visibility -->
        <?php if (!empty($local_pack)): ?>
        <section class="local-pack-section">
            <h2><i class="fas fa-map"></i> Visibilidad en Local Pack</h2>

            <div class="local-pack-score">
                <h3>Apariciones en Local Pack: <?php echo htmlspecialchars($local_pack['apariciones_porcentaje'] ?? '0'); ?>%</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo htmlspecialchars($local_pack['apariciones_porcentaje'] ?? '0'); ?>%;"></div>
                </div>
                <p class="pack-detail">
                    <?php echo htmlspecialchars($local_pack['apariciones_count'] ?? '0'); ?> apariciones
                    de <?php echo htmlspecialchars($local_pack['keywords_analizadas'] ?? '0'); ?> keywords locales analizadas
                </p>
            </div>

            <?php if (!empty($local_pack['keywords_ranking'])): ?>
            <div class="local-keywords-table">
                <h3>Keywords en Local Pack:</h3>
                <table class="audit-table">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Volumen</th>
                            <th>Posición Local Pack</th>
                            <th>Status</th>
                            <th>Competidores</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($local_pack['keywords_ranking'] as $kw): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($kw['keyword']); ?></strong></td>
                            <td><?php echo htmlspecialchars($kw['volumen']); ?></td>
                            <td>
                                <?php if ($kw['posicion'] > 0): ?>
                                    #<?php echo $kw['posicion']; ?>
                                <?php else: ?>
                                    No aparece
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge <?php echo $kw['posicion'] > 0 && $kw['posicion'] <= 3 ? 'success' : 'warning'; ?>">
                                    <?php echo $kw['posicion'] > 0 && $kw['posicion'] <= 3 ? 'Visible' : 'Mejorable'; ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars(implode(', ', $kw['competidores'] ?? [])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Competencia Local -->
        <?php if (!empty($competencia_local)): ?>
        <section class="competencia-local-section">
            <h2><i class="fas fa-users"></i> Benchmarking vs Competencia Local</h2>

            <?php if (!empty($competencia_local['comparativa'])): ?>
            <table class="audit-table competitive-table">
                <thead>
                    <tr>
                        <th>Negocio</th>
                        <th>GBP Score</th>
                        <th>Reviews</th>
                        <th>Rating</th>
                        <th>Local Pack</th>
                        <th>Citations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competencia_local['comparativa'] as $comp): ?>
                    <tr class="<?php echo $comp['es_tuyo'] ? 'highlight-row' : ''; ?>">
                        <td>
                            <strong><?php echo htmlspecialchars($comp['nombre']); ?></strong>
                            <?php if ($comp['es_tuyo']): ?>
                            <span class="badge-you">TÚ</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($comp['gbp_score']); ?>/100</td>
                        <td><?php echo htmlspecialchars($comp['reviews_count']); ?></td>
                        <td>⭐ <?php echo htmlspecialchars($comp['rating']); ?></td>
                        <td><?php echo htmlspecialchars($comp['local_pack_appearances']); ?>%</td>
                        <td><?php echo htmlspecialchars($comp['citations_count']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>

            <?php if (!empty($competencia_local['insights'])): ?>
            <div class="competitive-insights">
                <h3>Insights Competitivos:</h3>
                <ul>
                    <?php foreach ($competencia_local['insights'] as $insight): ?>
                    <li><?php echo htmlspecialchars($insight); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <!-- Recomendaciones -->
        <?php if (!empty($recomendaciones)): ?>
        <section class="recommendations-section">
            <h2><i class="fas fa-lightbulb"></i> Recomendaciones Prioritarias</h2>

            <div class="recommendations-grid">
                <?php foreach ($recomendaciones as $rec): ?>
                <div class="recommendation-card priority-<?php echo strtolower($rec['prioridad']); ?>">
                    <div class="rec-header">
                        <span class="rec-priority"><?php echo htmlspecialchars($rec['prioridad']); ?></span>
                        <h3><?php echo htmlspecialchars($rec['titulo']); ?></h3>
                    </div>
                    <p class="rec-description"><?php echo nl2br(htmlspecialchars($rec['descripcion'])); ?></p>
                    <div class="rec-meta">
                        <span class="rec-effort">
                            <i class="fas fa-clock"></i>
                            <?php echo htmlspecialchars($rec['esfuerzo']); ?>
                        </span>
                        <span class="rec-impact">
                            <i class="fas fa-bolt"></i>
                            Impacto: <?php echo htmlspecialchars($rec['impacto']); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>

    <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($config['proyecto']['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Local SEO | Auditoría SEO</div>
        <div class="footer-right">Página <span class="page-number"></span></div>
    </div>
</div>

<script>
function copyToClipboard(button) {
    const code = button.previousElementSibling.textContent;
    navigator.clipboard.writeText(code).then(() => {
        button.innerHTML = '<i class="fas fa-check"></i> ¡Copiado!';
        setTimeout(() => {
            button.innerHTML = '<i class="fas fa-copy"></i> Copiar código';
        }, 2000);
    });
}
</script>

<style>
/* Estilos específicos para el módulo Local SEO */
.local-seo-page .executive-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.local-seo-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.local-seo-page .summary-item {
    text-align: center;
}

.local-seo-page .summary-label {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 8px;
}

.local-seo-page .summary-value {
    font-size: 32px;
    font-weight: bold;
}

.local-seo-page .gbp-completion,
.local-seo-page .nap-score,
.local-seo-page .local-pack-score {
    margin: 20px 0;
}

.local-seo-page .progress-bar {
    height: 30px;
    background: #e0e0e0;
    border-radius: 15px;
    overflow: hidden;
    margin: 10px 0;
}

.local-seo-page .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #54a34a 0%, #6ab85e 100%);
    transition: width 0.3s ease;
}

.local-seo-page .checklist-category {
    margin: 30px 0;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}

.local-seo-page .checklist-items {
    list-style: none;
    padding: 0;
}

.local-seo-page .checklist-items li {
    padding: 12px;
    margin: 8px 0;
    background: white;
    border-radius: 6px;
    border-left: 4px solid #ddd;
}

.local-seo-page .checklist-items li.completed {
    border-left-color: #54a34a;
}

.local-seo-page .checklist-items li.pending {
    border-left-color: #f44336;
}

.local-seo-page .schema-code {
    background: #1e1e1e;
    color: #d4d4d4;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    position: relative;
}

.local-seo-page .schema-code pre {
    margin: 0;
    overflow-x: auto;
}

.local-seo-page .btn-copy {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 8px 16px;
    background: #54a34a;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.local-seo-page .status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}

.local-seo-page .status-badge.success {
    background: #e8f5e9;
    color: #2e7d32;
}

.local-seo-page .status-badge.error {
    background: #ffebee;
    color: #c62828;
}

.local-seo-page .status-badge.warning {
    background: #fff3e0;
    color: #ef6c00;
}

.local-seo-page .audit-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.local-seo-page .audit-table th,
.local-seo-page .audit-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

.local-seo-page .audit-table th {
    background: #f5f5f5;
    font-weight: bold;
}

.local-seo-page .highlight-row {
    background: #fff9e6;
    font-weight: bold;
}

.local-seo-page .badge-you {
    background: #54a34a;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    margin-left: 8px;
}

.local-seo-page .reviews-distribution {
    margin: 30px 0;
}

.local-seo-page .star-row {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 10px 0;
}

.local-seo-page .star-label {
    min-width: 60px;
}

.local-seo-page .star-bar {
    flex: 1;
    height: 20px;
    background: #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
}

.local-seo-page .star-fill {
    height: 100%;
    background: #ffa726;
}

.local-seo-page .template-box {
    padding: 20px;
    border-radius: 8px;
    margin: 15px 0;
}

.local-seo-page .template-box.positive {
    background: #e8f5e9;
    border-left: 4px solid #4caf50;
}

.local-seo-page .template-box.negative {
    background: #ffebee;
    border-left: 4px solid #f44336;
}

.local-seo-page .recommendations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.local-seo-page .recommendation-card {
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid;
}

.local-seo-page .recommendation-card.priority-a {
    background: #ffebee;
    border-left-color: #f44336;
}

.local-seo-page .recommendation-card.priority-b {
    background: #fff3e0;
    border-left-color: #ff9800;
}

.local-seo-page .recommendation-card.priority-c {
    background: #e3f2fd;
    border-left-color: #2196f3;
}

@media print {
    .local-seo-page .btn-copy {
        display: none;
    }
}
</style>
