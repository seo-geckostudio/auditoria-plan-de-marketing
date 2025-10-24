<?php
/**
 * Módulo: IA/SGE Optimization (m9.2)
 * Fase: 9 - SEO Moderno
 * Descripción: Optimización para AI Overviews y Search Generative Experience de Google
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$visibilidad_sge = $datosModulo['visibilidad_sge'] ?? [];
$analisis_contenido = $datosModulo['analisis_contenido'] ?? [];
$optimizaciones = $datosModulo['optimizaciones_recomendadas'] ?? [];
$entidades = $datosModulo['entidades_mencionadas'] ?? [];
$competencia_ia = $datosModulo['competencia_ia'] ?? [];
$estrategia = $datosModulo['estrategia_contenido_ia'] ?? [];
$metricas = $datosModulo['metricas_seguimiento'] ?? [];
?>

<style>
/* ============================================
   PATRÓN EDUCATIVO IA/SGE - CSS COMPLETO
   ============================================ */

.ia-sge-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

/* SECCIÓN EDUCATIVA */
.ia-sge-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.ia-sge-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.ia-sge-page .concepto-icon {
    font-size: 48px;
    line-height: 1;
}

.ia-sge-page .concepto-header h2 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
}

.ia-sge-page .concepto-intro {
    font-size: 18px;
    margin-bottom: 25px;
    line-height: 1.7;
}

.ia-sge-page .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 25px;
    margin: 25px 0;
    border-left: 5px solid #ffd700;
}

.ia-sge-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    font-size: 17px;
}

.ia-sge-page .analogia-icon {
    font-size: 28px;
}

.ia-sge-page .analogia-list {
    list-style: none;
    padding: 0;
    margin: 12px 0;
}

.ia-sge-page .analogia-list li {
    padding: 10px 0 10px 35px;
    position: relative;
    font-size: 15px;
    line-height: 1.6;
}

.ia-sge-page .analogia-list li:before {
    content: "→";
    position: absolute;
    left: 10px;
    color: #ffd700;
    font-weight: bold;
    font-size: 18px;
}

.ia-sge-page .impacto-negocio {
    margin-top: 30px;
    background: rgba(255, 255, 255, 0.1);
    padding: 25px;
    border-radius: 10px;
}

.ia-sge-page .impacto-negocio h3 {
    margin: 0 0 20px 0;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.ia-sge-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.ia-sge-page .impacto-item {
    background: rgba(255, 255, 255, 0.95);
    color: #000000;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.ia-sge-page .impacto-icon {
    font-size: 36px;
    margin-bottom: 12px;
    display: block;
}

.ia-sge-page .impacto-texto {
    font-size: 14px;
    line-height: 1.6;
}

.ia-sge-page .contexto-ibiza-villa {
    margin-top: 25px;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 8px;
}

.ia-sge-page .contexto-ibiza-villa h4 {
    margin: 0 0 15px 0;
    font-size: 19px;
}

.ia-sge-page .contexto-ibiza-villa ul {
    margin: 10px 0;
    padding-left: 25px;
}

.ia-sge-page .contexto-ibiza-villa li {
    margin: 10px 0;
    line-height: 1.7;
}

/* ENTREGABLES DESCARGABLES */
.ia-sge-page .entregables-section {
    background: #f8f9fa;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
}

.ia-sge-page .section-title {
    font-size: 26px;
    color: #000000;
    margin-bottom: 25px;
    font-weight: 700;
}

.ia-sge-page .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.ia-sge-page .csv-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 25px;
    transition: all 0.3s ease;
}

.ia-sge-page .csv-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.ia-sge-page .csv-icon {
    font-size: 48px;
    margin-bottom: 15px;
    display: block;
}

.ia-sge-page .csv-title {
    font-size: 22px;
    color: #000000;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.ia-sge-page .csv-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.ia-sge-page .csv-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.ia-sge-page .csv-badge-critica {
    background: #dc3545;
    color: white;
}

.ia-sge-page .csv-badge-success {
    background: #88B04B;
    color: white;
}

.ia-sge-page .csv-badge-warning {
    background: #88B04B;
    color: #333;
}

.ia-sge-page .csv-badge-info {
    background: #2196f3;
    color: white;
}

.ia-sge-page .csv-description {
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 15px;
    color: #495057;
}

.ia-sge-page .csv-contenido {
    list-style: none;
    padding: 0;
    margin: 15px 0;
    background: #f8f9fa;
    border-radius: 6px;
    padding: 15px;
}

.ia-sge-page .csv-contenido li {
    padding: 8px 0 8px 25px;
    position: relative;
    font-size: 14px;
    line-height: 1.6;
}

.ia-sge-page .csv-contenido li:before {
    content: "";
    position: absolute;
    left: 5px;
    color: #88B04B;
    font-weight: bold;
}

.ia-sge-page .btn-download {
    display: inline-block;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.ia-sge-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.ia-sge-page .download-icon {
    margin-right: 8px;
}

.ia-sge-page .csv-stats {
    margin-top: 15px;
    padding: 12px;
    background: #e8f5e9;
    border-left: 4px solid #88B04B;
    border-radius: 4px;
    font-size: 14px;
    color: #155724;
}

.ia-sge-page .instrucciones-uso {
    background: white;
    padding: 25px;
    border-radius: 10px;
    border-left: 5px solid #2196f3;
}

.ia-sge-page .instrucciones-uso h4 {
    margin: 0 0 18px 0;
    color: #000000;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.ia-sge-page .pasos-implementacion {
    margin: 15px 0;
    padding-left: 25px;
}

.ia-sge-page .pasos-implementacion li {
    margin: 12px 0;
    line-height: 1.7;
    font-size: 15px;
}

/* COMPARACIÓN ANTES/DESPUÉS */
.ia-sge-page .comparacion-antes-despues {
    margin-bottom: 40px;
}

.ia-sge-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
    margin-top: 25px;
}

.ia-sge-page .comparacion-columna {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.ia-sge-page .comparacion-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.ia-sge-page .badge-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
}

.ia-sge-page .badge-success {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    box-shadow: 0 2px 6px rgba(40, 167, 69, 0.3);
}

.ia-sge-page .comparacion-titulo {
    font-size: 22px;
    margin: 0 0 20px 0;
    color: #000000;
    font-weight: 700;
}

.ia-sge-page .problema-item,
.ia-sge-page .solucion-item {
    display: flex;
    gap: 15px;
    margin-bottom: 18px;
    padding: 15px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.ia-sge-page .problema-item {
    background: #fff5f5;
    border-left: 4px solid #dc3545;
}

.ia-sge-page .solucion-item {
    background: #f0f8f4;
    border-left: 4px solid #88B04B;
}

.ia-sge-page .problema-item:hover,
.ia-sge-page .solucion-item:hover {
    transform: translateX(5px);
}

.ia-sge-page .problema-icon,
.ia-sge-page .solucion-icon {
    font-size: 24px;
    line-height: 1;
    flex-shrink: 0;
}

.ia-sge-page .problema-contenido,
.ia-sge-page .solucion-contenido {
    font-size: 14px;
    line-height: 1.6;
}

.ia-sge-page .impacto-negocio-antes,
.ia-sge-page .impacto-negocio-despues {
    margin-top: 20px;
    padding: 15px;
    border-radius: 8px;
    font-size: 14px;
    line-height: 1.6;
}

.ia-sge-page .impacto-negocio-antes {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
    color: #856404;
}

.ia-sge-page .impacto-negocio-despues {
    background: #d4edda;
    border-left: 4px solid #88B04B;
    color: #155724;
}

.ia-sge-page .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.ia-sge-page .flecha-container {
    text-align: center;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 25px 20px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.ia-sge-page .flecha-icon {
    font-size: 32px;
    margin-bottom: 8px;
}

.ia-sge-page .flecha-text {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 8px;
}

.ia-sge-page .flecha-arrow {
    font-size: 28px;
    font-weight: bold;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.9;
    }
}

/* TIMELINE */
.ia-sge-page .timeline-implementacion {
    margin-top: 35px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 10px;
}

.ia-sge-page .timeline-implementacion h4 {
    margin: 0 0 25px 0;
    font-size: 20px;
    color: #000000;
}

.ia-sge-page .timeline-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
}

.ia-sge-page .timeline-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #88B04B;
}

.ia-sge-page .timeline-badge {
    display: inline-block;
    background: #88B04B;
    color: white;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 12px;
}

.ia-sge-page .timeline-content {
    font-size: 14px;
    line-height: 1.7;
}

.ia-sge-page .timeline-content strong {
    display: block;
    margin-bottom: 10px;
    color: #000000;
    font-size: 16px;
}

.ia-sge-page .timeline-content em {
    display: block;
    margin-top: 10px;
    color: #88B04B;
    font-style: normal;
    font-weight: 600;
}

/* TABLA KPIs */
.ia-sge-page .kpis-section {
    margin-bottom: 40px;
}

.ia-sge-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
    margin-top: 20px;
}

.ia-sge-page .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.ia-sge-page .tabla-kpis th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.ia-sge-page .tabla-kpis td {
    padding: 15px;
    border-bottom: 1px solid #e1e8ed;
    font-size: 14px;
}

.ia-sge-page .tabla-kpis tbody tr:hover {
    background: #f8f9fa;
}

.ia-sge-page .tabla-kpis .fila-destacada {
    background: #fff8e1;
    border-left: 4px solid #ffd700;
}

.ia-sge-page .tabla-kpis .fila-destacada:hover {
    background: #f0f7e6;
}

.ia-sge-page .mejora-positiva {
    color: #88B04B;
    font-weight: 700;
}

.ia-sge-page .nota-importante {
    margin-top: 30px;
    display: flex;
    gap: 20px;
    background: #f0f7e6;
    border-left: 5px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
}

.ia-sge-page .nota-icon {
    font-size: 32px;
    flex-shrink: 0;
}

.ia-sge-page .nota-contenido {
    font-size: 14px;
    line-height: 1.7;
    color: #856404;
}

.ia-sge-page .nota-contenido ul {
    margin: 12px 0;
    padding-left: 20px;
}

.ia-sge-page .nota-contenido li {
    margin: 8px 0;
}

/* EXECUTIVE SUMMARY ORIGINAL */
.ia-sge-page .executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.ia-sge-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.ia-sge-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.ia-sge-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.ia-sge-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.ia-sge-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

/* SECCIONES CONTENIDO ORIGINAL */
.ia-sge-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #88B04B;
}

.ia-sge-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #88B04B;
    font-size: 20px;
    font-weight: 600;
}

.ia-sge-page .visibility-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
}

.ia-sge-page .keyword-query {
    font-weight: 600;
    color: #000000;
    font-size: 16px;
    margin-bottom: 10px;
}

.ia-sge-page .visibility-status {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.ia-sge-page .status-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.ia-sge-page .status-badge.presente {
    background: #d4edda;
    color: #155724;
}

.ia-sge-page .status-badge.ausente {
    background: #f8d7da;
    color: #721c24;
}

.ia-sge-page .status-badge.parcial {
    background: #f0f7e6;
    color: #856404;
}

.ia-sge-page .citation-info {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.ia-sge-page .optimization-card {
    background: #e8f5e9;
    border: 1px solid #c8e6c9;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #4caf50;
}

.ia-sge-page .optimization-title {
    font-weight: 600;
    color: #000000;
    font-size: 16px;
    margin-bottom: 10px;
}

.ia-sge-page .optimization-category {
    display: inline-block;
    background: #4caf50;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 10px;
}

.ia-sge-page .action-list {
    margin: 10px 0;
    padding-left: 20px;
}

.ia-sge-page .action-list li {
    margin: 8px 0;
    font-size: 14px;
}

.ia-sge-page .priority-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 8px;
}

.ia-sge-page .priority-indicator.alta {
    background: #dc3545;
}

.ia-sge-page .priority-indicator.media {
    background: #88B04B;
}

.ia-sge-page .priority-indicator.baja {
    background: #6c757d;
}

.ia-sge-page .entity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.ia-sge-page .entity-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
}

.ia-sge-page .entity-name {
    font-weight: 600;
    color: #88B04B;
    margin-bottom: 8px;
}

.ia-sge-page .entity-mentions {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 5px;
}

.ia-sge-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.ia-sge-page .comparison-table th,
.ia-sge-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.ia-sge-page .comparison-table th {
    background: #f0f4ff;
    color: #88B04B;
    font-weight: 600;
    font-size: 14px;
}

.ia-sge-page .comparison-table tr:hover {
    background: #fafafa;
}

.ia-sge-page .strategy-phase {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
}

.ia-sge-page .phase-title {
    color: #88B04B;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 10px;
}

.ia-sge-page .phase-duration {
    display: inline-block;
    background: #88B04B;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
}

.ia-sge-page .metric-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    text-align: center;
    min-height: 120px;
    max-height: 140px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.ia-sge-page .metric-label {
    font-size: 13px;
    color: #6c757d;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
    order: 1;
}

.ia-sge-page .metric-value {
    font-size: 24px;
    font-weight: 700;
    color: #88B04B;
    margin: 8px 0;
    order: 2;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ia-sge-page .metric-trend {
    font-size: 12px;
    margin-top: 5px;
    order: 3;
}

.ia-sge-page .metric-trend.up {
    color: #88B04B;
}

.ia-sge-page .metric-trend.down {
    color: #dc3545;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .ia-sge-page .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .ia-sge-page .comparacion-flecha {
        order: 2;
        padding: 15px 0;
    }

    .ia-sge-page .flecha-container {
        transform: rotate(90deg);
    }

    .ia-sge-page .comparacion-antes {
        order: 1;
    }

    .ia-sge-page .comparacion-despues {
        order: 3;
    }

    .ia-sge-page .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .ia-sge-page .impacto-grid {
        grid-template-columns: 1fr;
    }
}

@media print {
    .ia-sge-page .content-section,
    .ia-sge-page .comparacion-columna {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page ia-sge-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'IA/SGE Optimization'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para AI Overviews y Search Generative Experience'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Maximizar visibilidad en resultados generados por IA</span>
        </div>
    </div>

    <!-- SECCIÓN EDUCATIVA: ¿Qué es IA/SGE Optimization? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon"></span>
            <h2>¿Qué es IA/SGE Optimization y Por Qué es Crítico para Ibiza Villa?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                <strong>IA/SGE (Search Generative Experience)</strong> es la nueva forma en que Google muestra resultados:
                <strong>respuestas generadas por Inteligencia Artificial</strong> que aparecen en la parte superior de los resultados,
                citando las fuentes más relevantes y autorizadas.
            </p>
            <div class="analogia-box">
                <div class="analogia-header">
                    
                    <strong>Piensa en IA/SGE como un periodista escribiendo un artículo y decidiendo a quién citar:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>Google's AI es el periodista</strong> escribiendo la respuesta para el usuario</li>
                    <li><strong>Tu web es el experto</strong> que el periodista puede (o no) decidir citar como fuente</li>
                    <li><strong>La citación/enlace en SGE</strong> es aparecer como fuente en el artículo final (máxima visibilidad)</li>
                    <li><strong>Credenciales (E-E-A-T)</strong> = por qué el periodista te consideraría experto confiable</li>
                    <li><strong>Contenido estructurado</strong> = información clara y fácil de citar (el periodista tiene prisa)</li>
                    <li><strong>Respuestas directas</strong> = el periodista busca quotes concretos, no narrativa vaga</li>
                </ul>
            </div>

            <div class="impacto-negocio">
                <h3><span class="icon"></span> Impacto en el Negocio de Villas de Lujo</h3>
                <div class="impacto-grid">
                    <div class="impacto-item">
                        <div class="impacto-icon"></div>
                        <div class="impacto-texto">
                            <strong>Visibilidad Posición Cero</strong><br>
                            Aparecer citado en SGE = estar SOBRE todos los resultados tradicionales.
                            Usuario ve tu marca ANTES de scroll. CTR +150-300% vs posición #1 orgánica.
                        </div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-icon"></div>
                        <div class="impacto-texto">
                            <strong>Capturar Tráfico Zero-Click</strong><br>
                            68% búsquedas informativas terminan sin click. SGE permite capturar ese tráfico
                            siendo citado. Marca brand awareness incluso sin visita inmediata.
                        </div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-icon"></div>
                        <div class="impacto-texto">
                            <strong>Autoridad y Confianza Algorítmica</strong><br>
                            Ser citado por la IA de Google = señal máxima de autoridad. Efecto halo:
                            mejora rankings en búsquedas tradicionales. Trust +40%, conversión +25-35%.
                        </div>
                    </div>
                </div>
            </div>

            <div class="contexto-ibiza-villa">
                <h4>¿Por qué es especialmente crítico para Ibiza Villa?</h4>
                <ul>
                    <li><strong>Búsquedas informativas</strong>: "cómo alquilar villa ibiza", "mejores zonas ibiza", "cuánto cuesta" → SGE muy activo</li>
                    <li><strong>Competencia con OTAs</strong>: Booking/Airbnb dominan SGE. Necesitas contenido educativo para competir</li>
                    <li><strong>Queries de planificación</strong>: Usuarios investigan 3-6 meses antes. SGE es primer punto de contacto</li>
                    <li><strong>Alto valor transaccional</strong>: alto valor por reserva. Cada citación SGE = potencial cliente cualificado</li>
                    <li><strong>Mercado internacional</strong>: SGE activo en UK, US, DE. Capturar ese tráfico = crecimiento exponencial</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ENTREGABLES DESCARGABLES -->
    <section class="entregables-section">
        <h2 class="section-title">
            <span class="badge badge-success">DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN</span>
            Entregables Descargables - IA/SGE Optimization
        </h2>

        <div class="csv-cards-grid">
            <!-- CSV 1: SGE Visibility Audit -->
            <div class="csv-card">
                <div class="csv-icon"></div>
                <h3 class="csv-title">Auditoría Visibilidad SGE</h3>
                <div class="csv-meta">
                    <span class="csv-badge csv-badge-critica">15 Queries Auditadas</span>
                    <span class="csv-badge csv-badge-warning">2 Presencias Parciales Detectadas</span>
                </div>
                <p class="csv-description">
                    <strong>Análisis completo de presencia en respuestas IA de Google</strong> para 15 queries clave del sector villas de lujo Ibiza.
                    Incluye estado actual (presente/ausente/parcial), competidores citados, y oportunidades específicas de optimización.
                </p>
                <ul class="csv-contenido">
                    <li><strong>Queries informativas:</strong> "cómo alquilar villa", "mejores zonas", "cuánto cuesta" (SGE muy activo)</li>
                    <li><strong>Queries comerciales:</strong> "villas ibiza con piscina", "cerca playa", "chef privado"</li>
                    <li><strong>Presencias detectadas:</strong> 2 queries parciales en posiciones #5 y #6 (oportunidad mejora)</li>
                    <li><strong>Gaps críticos:</strong> 13 queries con SGE activo donde NO aparecemos (competencia sí)</li>
                    <li><strong>Acción por query:</strong> Tipo de contenido necesario para cada oportunidad (guía/FAQ/calculadora/landing)</li>
                </ul>
                <a href="entregables/ia_sge/sge_visibility_audit.csv" class="btn-download" download>
                    <span class="download-icon">⬇</span> Descargar CSV - Auditoría SGE
                </a>
                <div class="csv-stats">
                    <strong>Ganancia estimada:</strong> +1,200-1,800 sesiones/mes capturando 8-10 citaciones SGE adicionales
                </div>
            </div>

            <!-- CSV 2: AI Content Optimizations -->
            <div class="csv-card">
                <div class="csv-icon"></div>
                <h3 class="csv-title">Plan de Optimización Contenido IA</h3>
                <div class="csv-meta">
                    <span class="csv-badge csv-badge-success">15 Optimizaciones</span>
                    <span class="csv-badge csv-badge-info">5 Críticas - ROI Alto</span>
                </div>
                <p class="csv-description">
                    <strong>Roadmap completo de mejoras de contenido</strong> para maximizar citaciones en respuestas generadas por IA.
                    Cubre estructura, formato, Schema markup, datos propios, y experiencia de usuario optimizada para parseo IA.
                </p>
                <ul class="csv-contenido">
                    <li><strong>Estructuras IA-friendly:</strong> FAQ format, Q&A headings, tablas comparativas, listas HTML semánticas</li>
                    <li><strong>Schema markup:</strong> FAQPage, HowTo, Product, Organization, Review (critical para citaciones)</li>
                    <li><strong>Contenido definitional:</strong> Guías "Cómo...", comparativas, calculadoras, checklists descargables</li>
                    <li><strong>Datos propios:</strong> Insights de 500+ reservas, estadísticas internas, casos de estudio cuantificados</li>
                    <li><strong>E-E-A-T signals:</strong> Team expertise visible, credenciales, experiencia local, testimonios estructurados</li>
                </ul>
                <a href="entregables/ia_sge/ai_content_optimizations.csv" class="btn-download" download>
                    <span class="download-icon">⬇</span> Descargar CSV - Optimizaciones IA
                </a>
                <div class="csv-stats">
                    <strong>Impacto combinado:</strong> +40-60% probabilidad citación SGE + Featured Snippets en 12-15 queries adicionales
                </div>
            </div>
        </div>

        <div class="instrucciones-uso">
            <h4><span class="icon-instrucciones"></span> Cómo Usar Estos Archivos</h4>
            <ol class="pasos-implementacion">
                <li><strong>Auditoría SGE:</strong> Priorizar queries con SGE activo + alto volumen + ausencia actual (máximo ROI)</li>
                <li><strong>Identificar gaps:</strong> 13 queries críticas donde competencia aparece pero Ibiza Villa no</li>
                <li><strong>Plan contenido:</strong> Crear contenido específico para cada query (guía/FAQ/calculadora según tipo)</li>
                <li><strong>Implementar optimizaciones:</strong> Empezar por 5 críticas del CSV 2 (ROI más alto, esfuerzo medio)</li>
                <li><strong>Schema markup:</strong> Priorizar FAQPage, HowTo, Product en contenido nuevo</li>
                <li><strong>Monitorear SGE:</strong> Tracking manual semanal de citaciones en queries objetivo (tool: BrightEdge/SearchGPT)</li>
            </ol>
        </div>
    </section>

    <!-- COMPARACIÓN ANTES/DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h2 class="section-title">Transformación IA/SGE: Situación Actual vs Optimizada</h2>

        <div class="comparacion-grid">
            <!-- ANTES -->
            <div class="comparacion-columna comparacion-antes">
                <div class="comparacion-badge badge-danger">
                    ANTES - SITUACIÓN ACTUAL
                </div>
                <h3 class="comparacion-titulo">Invisibilidad en IA Generativa</h3>

                <div class="problema-item">
                    <div class="problema-icon"></div>
                    <div class="problema-contenido">
                        <strong>Visibilidad SGE: 13% (2/15 queries)</strong><br>
                        Solo 2 citaciones parciales en posiciones bajas (#5, #6).
                        13 queries con SGE activo donde competencia aparece pero nosotros NO.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon"></div>
                    <div class="problema-contenido">
                        <strong>Contenido NO IA-friendly</strong><br>
                        Descripciones narrativas largas sin estructura.
                        0 FAQs estructuradas, 0 Schema FAQPage/HowTo, tablas ausentes.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon"></div>
                    <div class="problema-contenido">
                        <strong>Falta contenido definitional</strong><br>
                        Sin guías "Cómo...", sin comparativas, sin calculadoras.
                        IA no encuentra respuestas directas citables.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon"></div>
                    <div class="problema-contenido">
                        <strong>Datos propios ausentes</strong><br>
                        No se comparten insights internos (500+ reservas).
                        IA prefiere citar fuentes con datos originales.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon"></div>
                    <div class="problema-contenido">
                        <strong>Entidades débiles</strong><br>
                        Entidades no explícitas (0 Schema Organization/Person).
                        Knowledge Graph no reconoce marca como autoridad.
                    </div>
                </div>

                <div class="impacto-negocio-antes">
                    <strong>Pérdida estimada:</strong> 1,200-1,800 sesiones/mes potenciales desde SGE no capturadas.
                    Competencia (Booking, Airbnb, Timeout) monopolizan citaciones IA.
                </div>
            </div>

            <!-- FLECHA TRANSFORMACIÓN -->
            <div class="comparacion-flecha">
                <div class="flecha-container">
                    <div class="flecha-icon"></div>
                    <div class="flecha-text">IA/SGE<br>OPTIMIZATION</div>
                    <div class="flecha-arrow">→</div>
                </div>
            </div>

            <!-- DESPUÉS -->
            <div class="comparacion-columna comparacion-despues">
                <div class="comparacion-badge badge-success">
                    DESPUÉS - RESULTADOS ESPERADOS
                </div>
                <h3 class="comparacion-titulo">Autoridad en Ecosistema IA</h3>

                <div class="solucion-item">
                    <div class="solucion-icon"></div>
                    <div class="solucion-contenido">
                        <strong>Visibilidad SGE: 60-73% (9-11/15 queries)</strong><br>
                        Citaciones en Top 3 para 9-11 queries clave.
                        Presencia en queries informativas (alto tráfico) + comerciales (alta intención).
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon"></div>
                    <div class="solucion-contenido">
                        <strong>Contenido estructurado para IA</strong><br>
                        40+ FAQs con Schema, 12 guías "Cómo...", 8 tablas comparativas.
                        Formato Q&A, listas HTML semánticas, datos fáciles de parsear.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon"></div>
                    <div class="solucion-contenido">
                        <strong>Hub de contenido definitional</strong><br>
                        15 artículos educativos, calculadora precios, guía legal completa.
                        IA encuentra respuestas directas y cita como fuente autorizada.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon"></div>
                    <div class="solucion-contenido">
                        <strong>Insights y datos originales</strong><br>
                        Publicación análisis 500+ reservas, estadísticas temporadas, tendencias.
                        IA prioriza citar fuentes con datos propios (no replicables).
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon"></div>
                    <div class="solucion-contenido">
                        <strong>Entidades reconocidas</strong><br>
                        Schema Organization/Person completo, SameAs Wikidata/LinkedIn.
                        Knowledge Graph reconoce marca + equipo como autoridad villas Ibiza.
                    </div>
                </div>

                <div class="impacto-negocio-despues">
                    <strong>Ganancia estimada:</strong> +1,200-1,800 sesiones/mes desde citaciones SGE.
                    Posicionamiento como fuente #1 villas lujo Ibiza en ecosistema IA.
                </div>
            </div>
        </div>

        <!-- TIMELINE IMPLEMENTACIÓN -->
        <div class="timeline-implementacion">
            <h4>Timeline de Implementación (4 Fases - 4-6 Meses)</h4>
            <div class="timeline-grid">
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 1-2</div>
                    <div class="timeline-content">
                        <strong>Quick Wins Estructurales</strong><br>
                        • 40 FAQs con Schema FAQPage<br>
                        • Optimizar 20 páginas existentes (Q&A format)<br>
                        • Schema Organization/Person completo<br>
                        <em>Impacto:</em> +15-20% visibilidad SGE
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 2-3</div>
                    <div class="timeline-content">
                        <strong>Contenido Definitional</strong><br>
                        • 12 guías "Cómo..." con HowTo Schema<br>
                        • 5 comparativas con tablas<br>
                        • Calculadora precios interactiva<br>
                        <em>Impacto:</em> +20-25% visibilidad SGE adicional
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 3-4</div>
                    <div class="timeline-content">
                        <strong>Datos Originales</strong><br>
                        • Análisis 500+ reservas publicado<br>
                        • 8 casos de estudio detallados<br>
                        • Insights temporadas/tendencias<br>
                        <em>Impacto:</em> +10-15% autoridad IA
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 5-6</div>
                    <div class="timeline-content">
                        <strong>Consolidación</strong><br>
                        • Refresh contenido con datos Q1 2025<br>
                        • Monitoreo y ajustes basados en tracking<br>
                        • Expansión a queries long-tail<br>
                        <em>Impacto:</em> +5-10% coverage adicional
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TABLA KPIs -->
    <section class="kpis-section">
        <h2 class="section-title">
            <span class="badge badge-success">DESPUÉS - RESULTADOS ESPERADOS</span>
            KPIs y Resultados Esperados - IA/SGE Optimization
        </h2>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica IA/SGE</th>
                    <th>ANTES (Actual)</th>
                    <th>DESPUÉS (4-6 meses)</th>
                    <th>Mejora</th>
                    <th>Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Citaciones SGE en Queries Objetivo</strong></td>
                    <td>2/15 queries (13%)</td>
                    <td>9-11/15 queries (60-73%)</td>
                    <td class="mejora-positiva">+350-462%</td>
                    <td>+1,200-1,800 sesiones/mes capturadas desde SGE</td>
                </tr>
                <tr>
                    <td><strong>Posición Media Citación SGE</strong></td>
                    <td>#5.5 (cuando presente)</td>
                    <td>#2.1 promedio</td>
                    <td class="mejora-positiva">+3.4 posiciones</td>
                    <td>CTR citación +180% (posición influye visibilidad)</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Contenido con Schema IA-Friendly</strong></td>
                    <td>8 páginas (6% del sitio)</td>
                    <td>65+ páginas (48% del sitio)</td>
                    <td class="mejora-positiva">+700%</td>
                    <td>Featured Snippets +12-15 queries | Parseo IA +60%</td>
                </tr>
                <tr>
                    <td><strong>Entidades Reconocidas Knowledge Graph</strong></td>
                    <td>2 entidades débiles</td>
                    <td>18+ entidades explícitas</td>
                    <td class="mejora-positiva">+800%</td>
                    <td>Autoridad algorítmica +45% | Brand entity consolidado</td>
                </tr>
                <tr>
                    <td><strong>Contenido con Datos Propios Originales</strong></td>
                    <td>0 artículos</td>
                    <td>8 artículos data-driven</td>
                    <td class="mejora-positiva">+800%</td>
                    <td>IA prioriza citar (+30% vs contenido genérico)</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Tráfico Zero-Click Capturado</strong></td>
                    <td>~180 sesiones/mes</td>
                    <td>1,500-2,100 sesiones/mes</td>
                    <td class="mejora-positiva">+733-1,067%</td>
                    <td>Brand awareness +68% | Marca visible incluso sin click</td>
                </tr>
            </tbody>
        </table>

        <div class="nota-importante">
            <div class="nota-icon">️</div>
            <div class="nota-contenido">
                <strong>Nota Importante sobre IA/SGE:</strong><br>
                La visibilidad en IA generativa es <strong>acumulativa y de efecto compuesto</strong>. Cada citación SGE:
                <ul>
                    <li>Refuerza señal de autoridad para futuras citaciones (círculo virtuoso)</li>
                    <li>Mejora posicionamiento orgánico tradicional (efecto halo)</li>
                    <li>Incrementa CTR en citaciones posteriores (+marca conocida)</li>
                    <li>Genera backlinks indirectos (usuarios citan tu contenido citado por Google)</li>
                </ul>
                <strong>Timeline realista:</strong> Primeras citaciones SGE en 6-8 semanas tras implementar FAQs y Schema.
                Visibilidad 60-73% requiere 4-6 meses de contenido sostenido IA-friendly.
                Una vez consolidado, posición muy difícil de desbancar.
            </div>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <span class="badge badge-danger">ANTES - SITUACIÓN ACTUAL</span>
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Visibilidad SGE</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['visibilidad_sge'] ?? '0%'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Citaciones IA</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['citaciones_totales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Entidades Reconocidas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['entidades_reconocidas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Score E-E-A-T</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['score_eeat'] ?? '0'); ?>/100</div>
            </div>
        </div>
    </div>

    <!-- Visibilidad en SGE -->
    <?php if (!empty($visibilidad_sge)): ?>
    <div class="content-section">
        <h3>Visibilidad en Search Generative Experience</h3>
        <p>Análisis de presencia en respuestas generadas por IA de Google para queries clave.</p>

        <?php foreach ($visibilidad_sge as $query): ?>
        <div class="visibility-card">
            <div class="keyword-query"><?php echo htmlspecialchars($query['query'] ?? ''); ?></div>

            <div class="visibility-status">
                <span>Estado:</span>
                <span class="status-badge <?php echo strtolower($query['estado'] ?? 'ausente'); ?>">
                    <?php echo htmlspecialchars($query['estado'] ?? 'Ausente'); ?>
                </span>
            </div>

            <?php if (isset($query['citation'])): ?>
            <div class="citation-info">
                <strong>Citación:</strong> <?php echo htmlspecialchars($query['citation']); ?>
            </div>
            <?php endif; ?>

            <?php if (isset($query['posicion_citacion'])): ?>
            <p style="font-size: 13px; color: #6c757d; margin-top: 8px;">
                <strong>Posición en respuesta IA:</strong> <?php echo htmlspecialchars($query['posicion_citacion']); ?>
            </p>
            <?php endif; ?>

            <?php if (isset($query['competidores_citados'])): ?>
            <p style="font-size: 13px; color: #6c757d; margin-top: 5px;">
                <strong>Competidores citados:</strong> <?php echo htmlspecialchars($query['competidores_citados']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Análisis de Contenido -->
    <?php if (!empty($analisis_contenido)): ?>
    <div class="content-section">
        <h3>Análisis de Contenido para IA</h3>
        <p>Evaluación de qué tan bien estructurado está nuestro contenido para ser comprendido y citado por modelos de IA.</p>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Factor</th>
                    <th>Estado Actual</th>
                    <th>Benchmark</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($analisis_contenido as $factor): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($factor['factor'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($factor['estado_actual'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($factor['benchmark'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($factor['observaciones'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Optimizaciones Recomendadas -->
    <div class="content-section">
        <h3>Optimizaciones Recomendadas</h3>
        <p>Acciones específicas para mejorar la visibilidad en respuestas generadas por IA.</p>

        <?php foreach ($optimizaciones ?? [] as $opt): ?>
        <div class="optimization-card">
            <span class="optimization-category"><?php echo htmlspecialchars($opt['categoria'] ?? ''); ?></span>
            <div class="optimization-title">
                <span class="priority-indicator <?php echo strtolower($opt['prioridad'] ?? 'media'); ?>"></span>
                <?php echo htmlspecialchars($opt['titulo'] ?? ''); ?>
            </div>
            <p style="margin: 10px 0; font-size: 14px;"><?php echo htmlspecialchars($opt['descripcion'] ?? ''); ?></p>

            <?php if (!empty($opt['acciones'])): ?>
            <ul class="action-list">
                <?php foreach ($opt['acciones'] as $accion): ?>
                <li><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (isset($opt['impacto_estimado'])): ?>
            <p style="margin-top: 10px; font-size: 13px; color: #155724;">
                <strong>Impacto estimado:</strong> <?php echo htmlspecialchars($opt['impacto_estimado']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Entidades Mencionadas -->
    <?php if (!empty($entidades)): ?>
    <div class="content-section">
        <h3>Entidades y Relaciones</h3>
        <p>Entidades clave que los sistemas de IA reconocen en nuestro contenido.</p>

        <div class="entity-grid">
            <?php foreach ($entidades as $entity): ?>
            <div class="entity-card">
                <div class="entity-name"><?php echo htmlspecialchars($entity['nombre'] ?? ''); ?></div>
                <div class="entity-mentions">
                    Menciones: <?php echo htmlspecialchars($entity['menciones'] ?? '0'); ?>
                </div>
                <div style="font-size: 12px; color: #6c757d;">
                    Tipo: <?php echo htmlspecialchars($entity['tipo'] ?? 'N/A'); ?>
                </div>
                <?php if (isset($entity['contexto'])): ?>
                <div style="font-size: 12px; margin-top: 5px;">
                    <?php echo htmlspecialchars($entity['contexto']); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Competencia IA -->
    <?php if (!empty($competencia_ia)): ?>
    <div class="content-section">
        <h3>Benchmarking Competencia en IA</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Sitio</th>
                    <th>Citaciones SGE</th>
                    <th>% Visibilidad</th>
                    <th>Entidades</th>
                    <th>Fortalezas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia_ia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['citaciones'] ?? '0'); ?></td>
                    <td><?php echo htmlspecialchars($comp['visibilidad'] ?? '0%'); ?></td>
                    <td><?php echo htmlspecialchars($comp['entidades'] ?? '0'); ?></td>
                    <td><?php echo htmlspecialchars($comp['fortalezas'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Estrategia de Contenido IA -->
    <?php if (!empty($estrategia)): ?>
    <div class="content-section">
        <h3>Estrategia de Contenido para IA</h3>

        <?php foreach ($estrategia as $phase): ?>
        <div class="strategy-phase">
            <div class="phase-title"><?php echo htmlspecialchars($phase['fase'] ?? ''); ?></div>
            <span class="phase-duration"><?php echo htmlspecialchars($phase['duracion'] ?? ''); ?></span>

            <p style="margin: 15px 0;"><?php echo htmlspecialchars($phase['descripcion'] ?? ''); ?></p>

            <?php if (!empty($phase['objetivos'])): ?>
            <strong style="display: block; margin-top: 10px;">Objetivos:</strong>
            <ul class="action-list">
                <?php foreach ($phase['objetivos'] as $obj): ?>
                <li><?php echo htmlspecialchars($obj); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Métricas de Seguimiento -->
    <?php if (!empty($metricas)): ?>
    <div class="content-section">
        <h3>Métricas de Seguimiento</h3>
        <p>KPIs para monitorizar el impacto de las optimizaciones para IA.</p>

        <div class="summary-grid">
            <?php foreach ($metricas as $metric): ?>
            <div class="metric-card">
                <div class="metric-label"><?php echo htmlspecialchars($metric['nombre'] ?? ''); ?></div>
                <div class="metric-value"><?php echo htmlspecialchars($metric['valor'] ?? '0'); ?></div>
                <?php if (isset($metric['tendencia'])): ?>
                <div class="metric-trend <?php echo $metric['tendencia'] === 'positiva' ? 'up' : 'down'; ?>">
                    <?php echo htmlspecialchars($metric['cambio'] ?? ''); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>IA/SGE Optimization</span>
    </div>
</div>
