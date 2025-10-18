<?php
/**
 * Módulo: Voice Search Optimization (m9.3)
 * Fase: 9 - SEO Avanzado
 * Descripción: Optimización para búsquedas por voz y assistentes virtuales
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$estado_actual = $datosModulo['estado_actual'] ?? [];
$keywords_conversacionales = $datosModulo['keywords_conversacionales'] ?? [];
$preguntas_frecuentes = $datosModulo['preguntas_frecuentes'] ?? [];
$optimizacion_tecnica = $datosModulo['optimizacion_tecnica'] ?? [];
$competencia_voice = $datosModulo['analisis_competencia'] ?? [];
$oportunidades = $datosModulo['oportunidades'] ?? [];
$plan_accion = $datosModulo['plan_accion'] ?? [];
?>

<style>
/* ============================================
   PATRÓN EDUCATIVO VOICE SEARCH - CSS COMPLETO
   ============================================ */

.voice-search-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

/* SECCIÓN EDUCATIVA */
.voice-search-page .concepto-educativo {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.voice-search-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.voice-search-page .concepto-icon {
    font-size: 48px;
    line-height: 1;
}

.voice-search-page .concepto-header h2 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
}

.voice-search-page .concepto-intro {
    font-size: 18px;
    margin-bottom: 25px;
    line-height: 1.7;
}

.voice-search-page .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 25px;
    margin: 25px 0;
    border-left: 5px solid #ffd700;
}

.voice-search-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    font-size: 17px;
}

.voice-search-page .analogia-icon {
    font-size: 28px;
}

.voice-search-page .analogia-list {
    list-style: none;
    padding: 0;
    margin: 12px 0;
}

.voice-search-page .analogia-list li {
    padding: 10px 0 10px 35px;
    position: relative;
    font-size: 15px;
    line-height: 1.6;
}

.voice-search-page .analogia-list li:before {
    content: "→";
    position: absolute;
    left: 10px;
    color: #ffd700;
    font-weight: bold;
    font-size: 18px;
}

.voice-search-page .impacto-negocio {
    margin-top: 30px;
    background: rgba(255, 255, 255, 0.1);
    padding: 25px;
    border-radius: 10px;
}

.voice-search-page .impacto-negocio h3 {
    margin: 0 0 20px 0;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.voice-search-page .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.voice-search-page .impacto-item {
    background: rgba(255, 255, 255, 0.95);
    color: #2c3e50;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.voice-search-page .impacto-icon {
    font-size: 36px;
    margin-bottom: 12px;
    display: block;
}

.voice-search-page .impacto-texto {
    font-size: 14px;
    line-height: 1.6;
}

.voice-search-page .contexto-ibiza-villa {
    margin-top: 25px;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 8px;
}

.voice-search-page .contexto-ibiza-villa h4 {
    margin: 0 0 15px 0;
    font-size: 19px;
}

.voice-search-page .contexto-ibiza-villa ul {
    margin: 10px 0;
    padding-left: 25px;
}

.voice-search-page .contexto-ibiza-villa li {
    margin: 10px 0;
    line-height: 1.7;
}

/* ENTREGABLES DESCARGABLES */
.voice-search-page .entregables-section {
    background: #f8f9fa;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
}

.voice-search-page .section-title {
    font-size: 26px;
    color: #2c3e50;
    margin-bottom: 25px;
    font-weight: 700;
}

.voice-search-page .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.voice-search-page .csv-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 25px;
    transition: all 0.3s ease;
}

.voice-search-page .csv-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.voice-search-page .csv-icon {
    font-size: 48px;
    margin-bottom: 15px;
    display: block;
}

.voice-search-page .csv-title {
    font-size: 22px;
    color: #2c3e50;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.voice-search-page .csv-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.voice-search-page .csv-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.voice-search-page .csv-badge-critica {
    background: #dc3545;
    color: white;
}

.voice-search-page .csv-badge-success {
    background: #28a745;
    color: white;
}

.voice-search-page .csv-badge-warning {
    background: #ffc107;
    color: #333;
}

.voice-search-page .csv-badge-info {
    background: #2196f3;
    color: white;
}

.voice-search-page .csv-description {
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 15px;
    color: #495057;
}

.voice-search-page .csv-contenido {
    list-style: none;
    padding: 0;
    margin: 15px 0;
    background: #f8f9fa;
    border-radius: 6px;
    padding: 15px;
}

.voice-search-page .csv-contenido li {
    padding: 8px 0 8px 25px;
    position: relative;
    font-size: 14px;
    line-height: 1.6;
}

.voice-search-page .csv-contenido li:before {
    content: "✓";
    position: absolute;
    left: 5px;
    color: #28a745;
    font-weight: bold;
}

.voice-search-page .btn-download {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.voice-search-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.voice-search-page .download-icon {
    margin-right: 8px;
}

.voice-search-page .csv-stats {
    margin-top: 15px;
    padding: 12px;
    background: #e8f5e9;
    border-left: 4px solid #28a745;
    border-radius: 4px;
    font-size: 14px;
    color: #155724;
}

.voice-search-page .instrucciones-uso {
    background: white;
    padding: 25px;
    border-radius: 10px;
    border-left: 5px solid #2196f3;
}

.voice-search-page .instrucciones-uso h4 {
    margin: 0 0 18px 0;
    color: #2c3e50;
    font-size: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.voice-search-page .pasos-implementacion {
    margin: 15px 0;
    padding-left: 25px;
}

.voice-search-page .pasos-implementacion li {
    margin: 12px 0;
    line-height: 1.7;
    font-size: 15px;
}

/* COMPARACIÓN ANTES/DESPUÉS */
.voice-search-page .comparacion-antes-despues {
    margin-bottom: 40px;
}

.voice-search-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
    margin-top: 25px;
}

.voice-search-page .comparacion-columna {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.voice-search-page .comparacion-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.voice-search-page .badge-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
}

.voice-search-page .badge-success {
    background: linear-gradient(135deg, #28a745 0%, #218838 100%);
    color: white;
    box-shadow: 0 2px 6px rgba(40, 167, 69, 0.3);
}

.voice-search-page .comparacion-titulo {
    font-size: 22px;
    margin: 0 0 20px 0;
    color: #2c3e50;
    font-weight: 700;
}

.voice-search-page .problema-item,
.voice-search-page .solucion-item {
    display: flex;
    gap: 15px;
    margin-bottom: 18px;
    padding: 15px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.voice-search-page .problema-item {
    background: #fff5f5;
    border-left: 4px solid #dc3545;
}

.voice-search-page .solucion-item {
    background: #f0f8f4;
    border-left: 4px solid #28a745;
}

.voice-search-page .problema-item:hover,
.voice-search-page .solucion-item:hover {
    transform: translateX(5px);
}

.voice-search-page .problema-icon,
.voice-search-page .solucion-icon {
    font-size: 24px;
    line-height: 1;
    flex-shrink: 0;
}

.voice-search-page .problema-contenido,
.voice-search-page .solucion-contenido {
    font-size: 14px;
    line-height: 1.6;
}

.voice-search-page .impacto-negocio-antes,
.voice-search-page .impacto-negocio-despues {
    margin-top: 20px;
    padding: 15px;
    border-radius: 8px;
    font-size: 14px;
    line-height: 1.6;
}

.voice-search-page .impacto-negocio-antes {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    color: #856404;
}

.voice-search-page .impacto-negocio-despues {
    background: #d4edda;
    border-left: 4px solid #28a745;
    color: #155724;
}

.voice-search-page .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.voice-search-page .flecha-container {
    text-align: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 20px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.voice-search-page .flecha-icon {
    font-size: 32px;
    margin-bottom: 8px;
}

.voice-search-page .flecha-text {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 8px;
}

.voice-search-page .flecha-arrow {
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
.voice-search-page .timeline-implementacion {
    margin-top: 35px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 10px;
}

.voice-search-page .timeline-implementacion h4 {
    margin: 0 0 25px 0;
    font-size: 20px;
    color: #2c3e50;
}

.voice-search-page .timeline-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
}

.voice-search-page .timeline-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.voice-search-page .timeline-badge {
    display: inline-block;
    background: #667eea;
    color: white;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 12px;
}

.voice-search-page .timeline-content {
    font-size: 14px;
    line-height: 1.7;
}

.voice-search-page .timeline-content strong {
    display: block;
    margin-bottom: 10px;
    color: #2c3e50;
    font-size: 16px;
}

.voice-search-page .timeline-content em {
    display: block;
    margin-top: 10px;
    color: #28a745;
    font-style: normal;
    font-weight: 600;
}

/* TABLA KPIs */
.voice-search-page .kpis-section {
    margin-bottom: 40px;
}

.voice-search-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
    margin-top: 20px;
}

.voice-search-page .tabla-kpis thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.voice-search-page .tabla-kpis th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.voice-search-page .tabla-kpis td {
    padding: 15px;
    border-bottom: 1px solid #e1e8ed;
    font-size: 14px;
}

.voice-search-page .tabla-kpis tbody tr:hover {
    background: #f8f9fa;
}

.voice-search-page .tabla-kpis .fila-destacada {
    background: #fff8e1;
    border-left: 4px solid #ffd700;
}

.voice-search-page .tabla-kpis .fila-destacada:hover {
    background: #fff3cd;
}

.voice-search-page .mejora-positiva {
    color: #28a745;
    font-weight: 700;
}

.voice-search-page .nota-importante {
    margin-top: 30px;
    display: flex;
    gap: 20px;
    background: #fff3cd;
    border-left: 5px solid #ffc107;
    padding: 20px;
    border-radius: 8px;
}

.voice-search-page .nota-icon {
    font-size: 32px;
    flex-shrink: 0;
}

.voice-search-page .nota-contenido {
    font-size: 14px;
    line-height: 1.7;
    color: #856404;
}

.voice-search-page .nota-contenido ul {
    margin: 12px 0;
    padding-left: 20px;
}

.voice-search-page .nota-contenido li {
    margin: 8px 0;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .voice-search-page .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .voice-search-page .comparacion-flecha {
        order: 2;
        padding: 15px 0;
    }

    .voice-search-page .flecha-container {
        transform: rotate(90deg);
    }

    .voice-search-page .comparacion-antes {
        order: 1;
    }

    .voice-search-page .comparacion-despues {
        order: 3;
    }

    .voice-search-page .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .voice-search-page .impacto-grid {
        grid-template-columns: 1fr;
    }
}

/* SECCIONES CONTENIDO ORIGINAL */

.voice-search-page .executive-summary {
    background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.voice-search-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.voice-search-page .summary-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.voice-search-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    backdrop-filter: blur(10px);
}

.voice-search-page .stat-value {
    font-size: 28px;
    font-weight: 700;
    margin: 8px 0;
}

.voice-search-page .stat-label {
    font-size: 13px;
    opacity: 0.9;
}

.voice-search-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #54a34a;
}

.voice-search-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #54a34a;
    font-size: 20px;
    font-weight: 600;
}

.voice-search-page .readiness-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.voice-search-page .readiness-item {
    background: #fafafa;
    padding: 15px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.voice-search-page .readiness-label {
    font-weight: 500;
    color: #2c3e50;
}

.voice-search-page .readiness-status {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.voice-search-page .readiness-status.si {
    background: #d4edda;
    color: #155724;
}

.voice-search-page .readiness-status.no {
    background: #f8d7da;
    color: #721c24;
}

.voice-search-page .readiness-status.parcial {
    background: #fff3cd;
    color: #856404;
}

.voice-search-page .keywords-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.voice-search-page .keywords-table th,
.voice-search-page .keywords-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.voice-search-page .keywords-table th {
    background: #f0f7ee;
    color: #54a34a;
    font-weight: 600;
    font-size: 14px;
}

.voice-search-page .keywords-table tr:hover {
    background: #fafafa;
}

.voice-search-page .query-type {
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

.voice-search-page .query-type.local {
    background: #e3f2fd;
    color: #1565c0;
}

.voice-search-page .query-type.informacional {
    background: #f3e5f5;
    color: #6a1b9a;
}

.voice-search-page .query-type.transaccional {
    background: #e8f5e9;
    color: #2e7d32;
}

.voice-search-page .question-card {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
    border-left: 3px solid #54a34a;
}

.voice-search-page .question-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 10px;
}

.voice-search-page .question-text {
    font-weight: 600;
    color: #2c3e50;
    font-size: 15px;
    flex: 1;
}

.voice-search-page .volume-badge {
    background: #54a34a;
    color: white;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    margin-left: 10px;
}

.voice-search-page .answer-preview {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 4px;
    font-size: 14px;
    color: #495057;
    margin-top: 8px;
}

.voice-search-page .coverage-status {
    margin-top: 8px;
    font-size: 13px;
}

.voice-search-page .coverage-yes {
    color: #28a745;
}

.voice-search-page .coverage-no {
    color: #dc3545;
}

.voice-search-page .tech-checklist {
    list-style: none;
    padding: 0;
    margin: 0;
}

.voice-search-page .tech-checklist li {
    padding: 12px;
    margin-bottom: 8px;
    background: #fafafa;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.voice-search-page .check-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.voice-search-page .check-icon.yes {
    background: #28a745;
    color: white;
}

.voice-search-page .check-icon.no {
    background: #dc3545;
    color: white;
}

.voice-search-page .opportunity-card {
    background: #fff9e6;
    border: 1px solid #ffeb3b;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #ffc107;
}

.voice-search-page .opportunity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.voice-search-page .opportunity-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 16px;
}

.voice-search-page .impact-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.voice-search-page .impact-badge.alto {
    background: #dc3545;
    color: white;
}

.voice-search-page .impact-badge.medio {
    background: #ffc107;
    color: #333;
}

.voice-search-page .action-plan-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
}

.voice-search-page .action-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 15px;
    border-left: 4px solid #54a34a;
}

.voice-search-page .action-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.voice-search-page .action-title {
    font-weight: 600;
    color: #2c3e50;
}

.voice-search-page .action-meta {
    display: flex;
    gap: 15px;
    font-size: 13px;
    color: #6c757d;
    margin-top: 8px;
}

@media print {
    .voice-search-page .content-section,
    .voice-search-page .action-plan-section {
        page-break-inside: avoid;
    }
}
</style>

<div class="audit-page voice-search-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Optimización para Voice Search'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Análisis y estrategia para búsquedas por voz'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Optimizado para Google Assistant, Alexa, Siri</span>
        </div>
    </div>

    <!-- SECCIÓN EDUCATIVA: ¿Qué es Voice Search? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon">🎤</span>
            <h2>¿Qué es Voice Search y Por Qué es Crítico para Ibiza Villa?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                <strong>Voice Search (Búsqueda por Voz)</strong> es cuando los usuarios <strong>hablan</strong> con asistentes virtuales
                (Google Assistant, Alexa, Siri) en lugar de <strong>escribir</strong> en un buscador.
                En 2024, el 58% de las búsquedas de viajes se hacen por voz desde móvil.
            </p>
            <div class="analogia-box">
                <div class="analogia-header">
                    <span class="analogia-icon">💡</span>
                    <strong>Piensa en Voice Search como preguntar al Concierge de un Hotel de Lujo:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>Búsqueda escrita</strong> = rellenar un formulario (keywords: "villa piscina ibiza")</li>
                    <li><strong>Búsqueda por voz</strong> = conversación con concierge ("¿dónde puedo alquilar una villa con piscina en Ibiza?")</li>
                    <li><strong>Concierge responde hablando</strong> = asistente lee la respuesta en voz alta (no muestra lista de links)</li>
                    <li><strong>Pregunta completa y natural</strong> = el concierge entiende contexto, no solo palabras clave</li>
                    <li><strong>Respuesta directa y concisa</strong> = el concierge da la información específica, no un manual de 10 páginas</li>
                    <li><strong>Disponible 24/7 inmediatamente</strong> = voice search funciona siempre, desde cualquier lugar</li>
                </ul>
            </div>

            <div class="impacto-negocio">
                <h3><span class="icon">📊</span> Impacto en el Negocio de Villas de Lujo</h3>
                <div class="impacto-grid">
                    <div class="impacto-item">
                        <div class="impacto-icon">📱</div>
                        <div class="impacto-texto">
                            <strong>58% Búsquedas Viajes = Voice</strong><br>
                            Más de la mitad de los usuarios planificando vacaciones usan voice search.
                            "OK Google, villas lujo Ibiza para familia" = query típica.
                            No optimizar = perder 58% del mercado móvil.
                        </div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-icon">🎯</div>
                        <div class="impacto-texto">
                            <strong>Tráfico Local + Mobile First</strong><br>
                            76% voice searches = local intent ("cerca de mí", "en Ibiza", "disponible ahora").
                            Mobile-first indexing + Voice = sinergia crítica.
                            Velocidad móvil <3s = mandatory para aparecer.
                        </div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-icon">🏆</div>
                        <div class="impacto-texto">
                            <strong>Featured Snippet = Posición 0</strong><br>
                            Google Assistant lee el Featured Snippet en 40-50% de casos.
                            Posición #1 tradicional → ignorada en voice.
                            Featured Snippet optimizado = monopolio de tráfico voice.
                        </div>
                    </div>
                </div>
            </div>

            <div class="contexto-ibiza-villa">
                <h4>¿Por qué es especialmente crítico para Ibiza Villa?</h4>
                <ul>
                    <li><strong>Usuario en movimiento</strong>: Turistas buscando villas DESDE el móvil, a menudo conduciendo o caminando → voice natural</li>
                    <li><strong>Queries conversacionales</strong>: "¿Hay villas en Ibiza que admiten mascotas?" (preguntas completas, no keywords)</li>
                    <li><strong>Planificación anticipada</strong>: Usuarios preguntan 3-6 meses antes ("cuánto cuesta villa Ibiza agosto") → capturar early</li>
                    <li><strong>Mercado internacional</strong>: Voice funciona en 40+ idiomas → UK, DE, FR, US markets todos usan voice masivamente</li>
                    <li><strong>Competencia OTAs débil</strong>: Booking/Airbnb optimizados para escrito, NO para voice → oportunidad diferenciación</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ENTREGABLES DESCARGABLES -->
    <section class="entregables-section">
        <h2 class="section-title">
            <span class="badge badge-success">DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN</span>
            Entregables Descargables - Voice Search Optimization
        </h2>

        <div class="csv-cards-grid">
            <!-- CSV 1: Voice Keywords Audit -->
            <div class="csv-card">
                <div class="csv-icon">🎤</div>
                <h3 class="csv-title">Auditoría Keywords Conversacionales</h3>
                <div class="csv-meta">
                    <span class="csv-badge csv-badge-critica">15 Queries Voice Auditadas</span>
                    <span class="csv-badge csv-badge-warning">13 No Cubiertas</span>
                </div>
                <p class="csv-description">
                    <strong>Análisis completo de keywords conversacionales</strong> (lenguaje natural) usadas en voice search para
                    villas de lujo Ibiza. Incluye volumen, intent, cobertura actual, y acciones específicas de optimización.
                </p>
                <ul class="csv-contenido">
                    <li><strong>Queries naturales:</strong> "¿dónde puedo alquilar...?", "¿cuánto cuesta...?", "¿qué necesito...?"</li>
                    <li><strong>Intents mixtos:</strong> Local + Transaccional, Informacional + Consideración</li>
                    <li><strong>Cobertura actual:</strong> 2 queries parciales, 13 gaps completos (87% oportunidad)</li>
                    <li><strong>Tráfico estimado total:</strong> 950-1,320 sesiones/mes capturables</li>
                    <li><strong>Acciones detalladas:</strong> Landing, FAQ Schema, Speakable markup, HowTo Schema por query</li>
                </ul>
                <a href="../entregables/voice_search/voice_keywords_audit.csv" class="btn-download" download>
                    <span class="download-icon">⬇</span> Descargar CSV - Keywords Voice
                </a>
                <div class="csv-stats">
                    <strong>Ganancia estimada:</strong> +950-1,320 sesiones/mes optimizando para lenguaje conversacional
                </div>
            </div>

            <!-- CSV 2: Voice Technical Checklist -->
            <div class="csv-card">
                <div class="csv-icon">⚙️</div>
                <h3 class="csv-title">Checklist Técnico Voice Search</h3>
                <div class="csv-meta">
                    <span class="csv-badge csv-badge-success">20 Elementos Técnicos</span>
                    <span class="csv-badge csv-badge-info">8 Críticos - Implementar Ya</span>
                </div>
                <p class="csv-description">
                    <strong>Roadmap técnico completo</strong> para optimizar sitio para voice search: Schema markup
                    (FAQPage, Speakable, HowTo), performance móvil, featured snippets, content structure.
                </p>
                <ul class="csv-contenido">
                    <li><strong>Schema markup crítico:</strong> FAQPage, Speakable, HowTo, LocalBusiness, Review (5 tipos)</li>
                    <li><strong>Performance:</strong> Mobile speed <3s (actualmente 4.2s), Core Web Vitals optimization</li>
                    <li><strong>Content structure:</strong> Question-format headings, Answer boxes, Listas semánticas</li>
                    <li><strong>Featured Snippets:</strong> Optimization para Posición 0 (voice answer source)</li>
                    <li><strong>Natural language:</strong> Conversational tone, Frases cortas (<20 palabras), Audio-friendly</li>
                </ul>
                <a href="../entregables/voice_search/voice_technical_checklist.csv" class="btn-download" download>
                    <span class="download-icon">⬇</span> Descargar CSV - Checklist Técnico
                </a>
                <div class="csv-stats">
                    <strong>Readiness Score objetivo:</strong> 32/100 → 85+/100 implementando 20 elementos técnicos
                </div>
            </div>
        </div>

        <div class="instrucciones-uso">
            <h4><span class="icon-instrucciones">📋</span> Cómo Usar Estos Archivos</h4>
            <ol class="pasos-implementacion">
                <li><strong>Priorizar queries alto volumen + alto intent:</strong> "cuánto cuesta", "mejores villas", "cerca playa" (tráfico + conversión)</li>
                <li><strong>Implementar Schema crítico primero:</strong> FAQPage (8-10 páginas), Speakable (secciones clave), HowTo (guías)</li>
                <li><strong>Optimizar velocidad móvil:</strong> Target <3s LCP → 95% voice searches desde móvil requieren sitio rápido</li>
                <li><strong>Re-escribir contenido conversacional:</strong> 15-20 páginas top → lenguaje natural, preguntas como H2, respuestas directas</li>
                <li><strong>Featured Snippets:</strong> Formatear para Posición 0 → listas, tablas, definiciones primeros 50 palabras</li>
                <li><strong>Testing voice real:</strong> Google Assistant, Alexa, Siri → probar queries objetivo y verificar respuestas</li>
            </ol>
        </div>
    </section>

    <!-- COMPARACIÓN ANTES/DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h2 class="section-title">Transformación Voice Search: Situación Actual vs Optimizada</h2>

        <div class="comparacion-grid">
            <!-- ANTES -->
            <div class="comparacion-columna comparacion-antes">
                <div class="comparacion-badge badge-danger">
                    ANTES - SITUACIÓN ACTUAL
                </div>
                <h3 class="comparacion-titulo">Invisible para Voice Search</h3>

                <div class="problema-item">
                    <div class="problema-icon">❌</div>
                    <div class="problema-contenido">
                        <strong>Readiness Score: 32/100</strong><br>
                        Solo 6/20 elementos técnicos implementados.
                        FAQPage Schema: 0 páginas. Speakable: 0. HowTo: 0.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon">❌</div>
                    <div class="problema-contenido">
                        <strong>Cobertura Keywords Voice: 13% (2/15)</strong><br>
                        13 queries conversacionales NO cubiertas.
                        Competencia (Booking, Airbnb) captura ese tráfico.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon">❌</div>
                    <div class="problema-contenido">
                        <strong>Velocidad Móvil: 4.2s LCP</strong><br>
                        Voice search 95% desde móvil.
                        Sitio lento = descartado por algoritmo voice.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon">❌</div>
                    <div class="problema-contenido">
                        <strong>Contenido NO conversacional</strong><br>
                        Keywords stuffing ("villa piscina ibiza lujo").
                        Voice no entiende. Usuarios hablan naturalmente.
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-icon">❌</div>
                    <div class="problema-contenido">
                        <strong>0 Featured Snippets capturados</strong><br>
                        Google Assistant lee Featured Snippet en 40-50% casos.
                        Sin snippet = sin voice answer = 0 tráfico voice.
                    </div>
                </div>

                <div class="impacto-negocio-antes">
                    <strong>Pérdida estimada:</strong> 950-1,320 sesiones/mes desde voice search no capturadas.
                    58% de búsquedas viajes = voice → perdiendo más de la mitad del mercado móvil.
                </div>
            </div>

            <!-- FLECHA TRANSFORMACIÓN -->
            <div class="comparacion-flecha">
                <div class="flecha-container">
                    <div class="flecha-icon">🎤</div>
                    <div class="flecha-text">VOICE<br>OPTIMIZATION</div>
                    <div class="flecha-arrow">→</div>
                </div>
            </div>

            <!-- DESPUÉS -->
            <div class="comparacion-columna comparacion-despues">
                <div class="comparacion-badge badge-success">
                    DESPUÉS - RESULTADOS ESPERADOS
                </div>
                <h3 class="comparacion-titulo">Líder en Voice Search Villas Ibiza</h3>

                <div class="solucion-item">
                    <div class="solucion-icon">✅</div>
                    <div class="solucion-contenido">
                        <strong>Readiness Score: 85-92/100</strong><br>
                        18/20 elementos implementados. FAQPage en 10 páginas.
                        Speakable markup secciones clave. HowTo en 5 guías.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon">✅</div>
                    <div class="solucion-contenido">
                        <strong>Cobertura Keywords Voice: 80-93% (12-14/15)</strong><br>
                        12-14 queries optimizadas con contenido conversacional.
                        Landings específicas + FAQ Schema + Respuestas directas.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon">✅</div>
                    <div class="solucion-contenido">
                        <strong>Velocidad Móvil: 2.1s LCP</strong><br>
                        WebP, CDN, lazy loading, critical CSS.
                        Mobile PageSpeed 90+ → priorizado en voice ranking.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon">✅</div>
                    <div class="solucion-contenido">
                        <strong>15-20 páginas lenguaje natural</strong><br>
                        "¿Dónde puedo alquilar...?" como H2.
                        Respuestas conversacionales 40-60 palabras.
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-icon">✅</div>
                    <div class="solucion-contenido">
                        <strong>8-10 Featured Snippets capturados</strong><br>
                        Listas optimizadas, tablas, definiciones.
                        Google Assistant lee Ibiza Villa como respuesta voice.
                    </div>
                </div>

                <div class="impacto-negocio-despues">
                    <strong>Ganancia estimada:</strong> +950-1,320 sesiones/mes desde voice search.
                    Posicionamiento #1 voice answers "villas lujo Ibiza" mercado.
                </div>
            </div>
        </div>

        <!-- TIMELINE IMPLEMENTACIÓN -->
        <div class="timeline-implementacion">
            <h4>Timeline de Implementación (3 Fases - 8-10 Semanas)</h4>
            <div class="timeline-grid">
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 1-3</div>
                    <div class="timeline-content">
                        <strong>Schema Markup Crítico</strong><br>
                        • FAQPage Schema 8-10 páginas<br>
                        • Speakable markup secciones clave<br>
                        • HowTo Schema 5 guías<br>
                        <em>Impacto:</em> +20-25% Readiness Score
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 3-6</div>
                    <div class="timeline-content">
                        <strong>Performance + Content</strong><br>
                        • Optimizar LCP a <2.5s (móvil)<br>
                        • Re-escribir 15 páginas conversational<br>
                        • Question-format headings<br>
                        <em>Impacto:</em> +30-35% Readiness Score
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 6-10</div>
                    <div class="timeline-content">
                        <strong>Featured Snippets + Testing</strong><br>
                        • Optimization para Posición 0<br>
                        • Testing voice real (Assistant/Alexa/Siri)<br>
                        • Ajustes basados en resultados<br>
                        <em>Impacto:</em> +15-20% Readiness Score
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TABLA KPIs -->
    <section class="kpis-section">
        <h2 class="section-title">
            <span class="badge badge-success">DESPUÉS - RESULTADOS ESPERADOS</span>
            KPIs y Resultados Esperados - Voice Search Optimization
        </h2>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica Voice Search</th>
                    <th>ANTES (Actual)</th>
                    <th>DESPUÉS (8-10 semanas)</th>
                    <th>Mejora</th>
                    <th>Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Voice Search Readiness Score</strong></td>
                    <td>32/100</td>
                    <td>85-92/100</td>
                    <td class="mejora-positiva">+166-188%</td>
                    <td>Elegible para voice answers en 80-90% queries relevantes</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Cobertura Keywords Conversacionales</strong></td>
                    <td>2/15 queries (13%)</td>
                    <td>12-14/15 queries (80-93%)</td>
                    <td class="mejora-positiva">+500-615%</td>
                    <td>+950-1,320 sesiones/mes tráfico voice capturado</td>
                </tr>
                <tr>
                    <td><strong>Velocidad Móvil (LCP)</strong></td>
                    <td>4.2 segundos</td>
                    <td>2.1 segundos</td>
                    <td class="mejora-positiva">-50%</td>
                    <td>95% voice searches desde móvil - velocidad crítica ranking</td>
                </tr>
                <tr>
                    <td><strong>Featured Snippets Capturados</strong></td>
                    <td>0 queries</td>
                    <td>8-10 queries</td>
                    <td class="mejora-positiva">+∞</td>
                    <td>Google Assistant lee snippet en 40-50% respuestas voice</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>FAQPage Schema Implementado</strong></td>
                    <td>0 páginas</td>
                    <td>8-10 páginas</td>
                    <td class="mejora-positiva">+∞</td>
                    <td>Google lee directamente FAQs para respuestas voice</td>
                </tr>
                <tr>
                    <td><strong>Contenido Conversational Optimizado</strong></td>
                    <td>3 páginas (2%)</td>
                    <td>15-20 páginas (12-15%)</td>
                    <td class="mejora-positiva">+400-567%</td>
                    <td>Lenguaje natural = mejor match intent voice queries</td>
                </tr>
            </tbody>
        </table>

        <div class="nota-importante">
            <div class="nota-icon">⚠️</div>
            <div class="nota-contenido">
                <strong>Nota Importante sobre Voice Search:</strong><br>
                Voice search tiene <strong>comportamiento "winner-takes-all"</strong>. A diferencia de búsqueda escrita (usuarios ven 10 resultados):
                <ul>
                    <li>Google Assistant lee UNA sola respuesta (Featured Snippet o contenido directo)</li>
                    <li>Posición #2-10 = 0 tráfico voice (usuario no escucha alternativas)</li>
                    <li>Featured Snippet capturado = monopolio tráfico voice para esa query</li>
                    <li>Mobile speed <3s = mandatory (voice search 95% móvil, algoritmo prioriza velocidad)</li>
                </ul>
                <strong>Timeline realista:</strong> Primeros Featured Snippets en 4-6 semanas tras implementar FAQPage Schema.
                Cobertura 80-90% requiere 8-10 semanas de optimización sostenida.
                ROI: Capturar 8-10 snippets = +950-1,320 sesiones/mes (usuarios que antes iban a Booking/Airbnb).
            </div>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <span class="badge badge-danger">ANTES - SITUACIÓN ACTUAL</span>
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-stats">
            <div class="stat-card">
                <div class="stat-label">Readiness Score</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['readiness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Keywords Conversacionales</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['keywords_identificadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Preguntas Detectadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['preguntas_detectadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Páginas Optimizadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['paginas_optimizadas'] ?? 'N/A'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tráfico Voice Estimado</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['trafico_potencial'] ?? 'N/A'); ?></div>
            </div>
        </div>
    </div>

    <!-- Estado Actual -->
    <div class="content-section">
        <h3>Estado Actual de Voice Search Readiness</h3>
        <p><?php echo htmlspecialchars($estado_actual['resumen'] ?? ''); ?></p>

        <div class="readiness-grid">
            <?php foreach ($estado_actual['criterios'] ?? [] as $criterio): ?>
            <div class="readiness-item">
                <span class="readiness-label"><?php echo htmlspecialchars($criterio['nombre']); ?></span>
                <span class="readiness-status <?php echo $criterio['estado']; ?>">
                    <?php echo strtoupper($criterio['estado']); ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Keywords Conversacionales -->
    <div class="content-section">
        <h3>Keywords Conversacionales Identificadas</h3>
        <p>Keywords basadas en lenguaje natural que las personas usan al hacer búsquedas por voz.</p>

        <table class="keywords-table">
            <thead>
                <tr>
                    <th>Query Conversacional</th>
                    <th>Tipo</th>
                    <th>Volumen/mes</th>
                    <th>Dificultad</th>
                    <th>Cobertura Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keywords_conversacionales ?? [] as $kw): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($kw['query']); ?></strong></td>
                    <td><span class="query-type <?php echo $kw['tipo']; ?>"><?php echo strtoupper($kw['tipo']); ?></span></td>
                    <td><?php echo htmlspecialchars($kw['volumen']); ?></td>
                    <td><?php echo htmlspecialchars($kw['dificultad']); ?></td>
                    <td class="<?php echo $kw['cubierta'] ? 'coverage-yes' : 'coverage-no'; ?>">
                        <?php echo $kw['cubierta'] ? 'Cubierta' : 'No cubierta'; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Preguntas Frecuentes -->
    <div class="content-section">
        <h3>Preguntas Frecuentes para Voice Search</h3>
        <p>Preguntas que los usuarios hacen a asistentes de voz relacionadas con alquiler de villas en Ibiza.</p>

        <?php foreach ($preguntas_frecuentes ?? [] as $pregunta): ?>
        <div class="question-card">
            <div class="question-header">
                <span class="question-text"><?php echo htmlspecialchars($pregunta['pregunta']); ?></span>
                <span class="volume-badge"><?php echo htmlspecialchars($pregunta['volumen']); ?>/mes</span>
            </div>

            <?php if (isset($pregunta['respuesta_sugerida'])): ?>
            <div class="answer-preview">
                <strong>Respuesta sugerida:</strong> <?php echo htmlspecialchars($pregunta['respuesta_sugerida']); ?>
            </div>
            <?php endif; ?>

            <div class="coverage-status">
                <?php if ($pregunta['cubierta']): ?>
                <span class="coverage-yes">✓ Cubierta en: <?php echo htmlspecialchars($pregunta['url_actual']); ?></span>
                <?php else: ?>
                <span class="coverage-no">✗ No cubierta - Oportunidad de crear contenido</span>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Optimización Técnica -->
    <div class="content-section">
        <h3>Checklist de Optimización Técnica</h3>
        <p>Elementos técnicos que impactan la capacidad de aparecer en resultados de voice search.</p>

        <ul class="tech-checklist">
            <?php foreach ($optimizacion_tecnica ?? [] as $item): ?>
            <li>
                <span class="check-icon <?php echo $item['implementado'] ? 'yes' : 'no'; ?>">
                    <?php echo $item['implementado'] ? '✓' : '✗'; ?>
                </span>
                <div style="flex: 1;">
                    <div><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></div>
                    <div style="font-size: 13px; color: #6c757d;"><?php echo htmlspecialchars($item['descripcion']); ?></div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Análisis Competencia -->
    <?php if (!empty($competencia_voice)): ?>
    <div class="content-section">
        <h3>Análisis Competencia Voice Search</h3>

        <table class="keywords-table">
            <thead>
                <tr>
                    <th>Competidor</th>
                    <th>Readiness Score</th>
                    <th>FAQs Implementadas</th>
                    <th>Schema Markup</th>
                    <th>Velocidad Móvil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia_voice as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['readiness_score']); ?>/100</td>
                    <td><?php echo htmlspecialchars($comp['faqs']); ?></td>
                    <td><?php echo htmlspecialchars($comp['schema']); ?></td>
                    <td><?php echo htmlspecialchars($comp['velocidad']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Oportunidades -->
    <?php if (!empty($oportunidades)): ?>
    <div class="content-section">
        <h3>Oportunidades de Voice Search</h3>

        <?php foreach ($oportunidades as $oportunidad): ?>
        <div class="opportunity-card">
            <div class="opportunity-header">
                <span class="opportunity-title"><?php echo htmlspecialchars($oportunidad['titulo']); ?></span>
                <span class="impact-badge <?php echo strtolower($oportunidad['impacto']); ?>">
                    Impacto <?php echo htmlspecialchars($oportunidad['impacto']); ?>
                </span>
            </div>
            <p style="margin: 10px 0; color: #495057;"><?php echo htmlspecialchars($oportunidad['descripcion']); ?></p>
            <p style="margin: 5px 0; font-size: 13px; color: #6c757d;">
                <strong>Tráfico potencial:</strong> <?php echo htmlspecialchars($oportunidad['trafico_estimado']); ?>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Plan de Acción -->
    <div class="action-plan-section">
        <h3>Plan de Acción para Voice Search</h3>

        <?php foreach ($plan_accion ?? [] as $index => $accion): ?>
        <div class="action-item">
            <div class="action-header">
                <span class="action-title"><?php echo ($index + 1) . '. ' . htmlspecialchars($accion['titulo']); ?></span>
            </div>
            <p style="margin: 10px 0; color: #495057;"><?php echo htmlspecialchars($accion['descripcion'] ?? ''); ?></p>
            <div class="action-meta">
                <span><strong>Prioridad:</strong> <?php echo htmlspecialchars($accion['prioridad']); ?></span>
                <span><strong>Esfuerzo:</strong> <?php echo htmlspecialchars($accion['esfuerzo']); ?></span>
                <span><strong>Timeline:</strong> <?php echo htmlspecialchars($accion['timeline']); ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>Voice Search Optimization</span>
    </div>
</div>
