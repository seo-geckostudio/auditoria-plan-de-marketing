<?php
/**
 * Módulo: Featured Snippets Opportunities (m9.4)
 * Fase: 9 - SEO Avanzado
 * Descripción: Identificación y optimización para featured snippets (posición 0)
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$snippets_actuales = $datosModulo['snippets_actuales'] ?? [];
$oportunidades = $datosModulo['oportunidades'] ?? [];
$tipos_snippet = $datosModulo['tipos_snippet'] ?? [];
$competencia = $datosModulo['analisis_competencia'] ?? [];
$quick_wins = $datosModulo['quick_wins'] ?? [];
$estrategia = $datosModulo['estrategia_implementacion'] ?? [];
?>

<style>
.featured-snippets-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

.featured-snippets-page .executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.featured-snippets-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.featured-snippets-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.featured-snippets-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.featured-snippets-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.featured-snippets-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.featured-snippets-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #88B04B;
}

.featured-snippets-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #88B04B;
    font-size: 20px;
    font-weight: 600;
}

.featured-snippets-page .snippet-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 15px;
    border-left: 3px solid #88B04B;
}

.featured-snippets-page .snippet-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 10px;
}

.featured-snippets-page .snippet-keyword {
    font-weight: 600;
    color: #000000;
    flex: 1;
}

.featured-snippets-page .snippet-type {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    margin-left: 10px;
}

.featured-snippets-page .snippet-type.parrafo {
    background: #e3f2fd;
    color: #1565c0;
}

.featured-snippets-page .snippet-type.lista {
    background: #f3e5f5;
    color: #6a1b9a;
}

.featured-snippets-page .snippet-type.tabla {
    background: #e8f5e9;
    color: #2e7d32;
}

.featured-snippets-page .snippet-type.video {
    background: #ffebee;
    color: #c62828;
}

.featured-snippets-page .snippet-metrics {
    display: flex;
    gap: 20px;
    font-size: 13px;
    color: #6c757d;
    margin-top: 8px;
}

.featured-snippets-page .snippet-preview {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.featured-snippets-page .opportunity-card {
    background: #f0f7e6;
    border: 1px solid #88B04B;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #88B04B;
}

.featured-snippets-page .opportunity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.featured-snippets-page .opportunity-keyword {
    font-weight: 600;
    color: #000000;
    font-size: 16px;
}

.featured-snippets-page .priority-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.featured-snippets-page .priority-badge.alta {
    background: #dc3545;
    color: white;
}

.featured-snippets-page .priority-badge.media {
    background: #88B04B;
    color: #333;
}

.featured-snippets-page .priority-badge.baja {
    background: #6c757d;
    color: white;
}

.featured-snippets-page .opportunity-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 12px;
}

.featured-snippets-page .detail-item {
    font-size: 13px;
}

.featured-snippets-page .detail-label {
    color: #6c757d;
    font-weight: 500;
}

.featured-snippets-page .detail-value {
    color: #000000;
    font-weight: 600;
}

.featured-snippets-page .action-recommendation {
    background: #e8f5e9;
    border-left: 3px solid #4caf50;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
    border-radius: 4px;
}

.featured-snippets-page .type-examples {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 15px;
}

.featured-snippets-page .type-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 20px;
}

.featured-snippets-page .type-card h4 {
    margin: 0 0 10px 0;
    color: #88B04B;
    font-size: 18px;
}

.featured-snippets-page .type-description {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 15px;
}

.featured-snippets-page .example-code {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    font-family: 'Courier New', monospace;
    font-size: 12px;
    overflow-x: auto;
}

.featured-snippets-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.featured-snippets-page .comparison-table th,
.featured-snippets-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.featured-snippets-page .comparison-table th {
    background: #f0f7ee;
    color: #88B04B;
    font-weight: 600;
    font-size: 14px;
}

.featured-snippets-page .comparison-table tr:hover {
    background: #fafafa;
}

.featured-snippets-page .quick-win-item {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
    border-left: 4px solid #88B04B;
}

.featured-snippets-page .quick-win-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.featured-snippets-page .quick-win-title {
    font-weight: 600;
    color: #155724;
}

.featured-snippets-page .effort-badge {
    background: #88B04B;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

@media print {
    .featured-snippets-page .content-section {
        page-break-inside: avoid;
    }
}

/* ========================================
   SECCIÓN EDUCATIVA - FEATURED SNIPPETS
   ======================================== */

.featured-snippets-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.featured-snippets-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.featured-snippets-page .concepto-icon {
    font-size: 48px;
}

.featured-snippets-page .concepto-header h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
}

.featured-snippets-page .concepto-intro {
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.featured-snippets-page .analogia-box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
}

.featured-snippets-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 600;
}

.featured-snippets-page .analogia-icon {
    font-size: 28px;
}

.featured-snippets-page .analogia-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.featured-snippets-page .analogia-list li {
    padding-left: 25px;
    margin-bottom: 12px;
    position: relative;
    font-size: 15px;
    line-height: 1.6;
}

.featured-snippets-page .analogia-list li:before {
    content: "🏆";
    position: absolute;
    left: 0;
    top: 0;
}

.featured-snippets-page .impacto-negocio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.featured-snippets-page .impacto-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.featured-snippets-page .impacto-icon {
    font-size: 42px;
    margin-bottom: 12px;
}

.featured-snippets-page .impacto-texto strong {
    display: block;
    font-size: 18px;
    margin-bottom: 8px;
}

.featured-snippets-page .impacto-texto p {
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
    opacity: 0.95;
}

/* ========================================
   ENTREGABLES CSV
   ======================================== */

.featured-snippets-page .entregables-csv {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.featured-snippets-page .entregables-header {
    margin-bottom: 30px;
}

.featured-snippets-page .entregables-header h3 {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 15px 0 10px 0;
}

.featured-snippets-page .entregables-header p {
    color: #6c757d;
    font-size: 15px;
    margin: 0;
}

.featured-snippets-page .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-bottom: 30px;
}

.featured-snippets-page .csv-card {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.featured-snippets-page .csv-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.featured-snippets-page .csv-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-bottom: 2px solid #dee2e6;
}

.featured-snippets-page .csv-icon {
    font-size: 32px;
    margin-bottom: 10px;
    display: block;
}

.featured-snippets-page .csv-card-header h4 {
    margin: 10px 0;
    color: #000000;
    font-size: 19px;
    font-weight: 700;
}

.featured-snippets-page .csv-priority {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-top: 8px;
}

.featured-snippets-page .csv-priority.priority-critica {
    background: #dc3545;
    color: white;
}

.featured-snippets-page .csv-priority.priority-alta {
    background: #88B04B;
    color: #333;
}

.featured-snippets-page .csv-card-body {
    padding: 20px;
}

.featured-snippets-page .csv-description {
    font-size: 14px;
    color: #495057;
    line-height: 1.6;
    margin-bottom: 15px;
}

.featured-snippets-page .csv-contenido {
    list-style: none;
    padding: 0;
    margin: 0 0 15px 0;
}

.featured-snippets-page .csv-contenido li {
    padding-left: 20px;
    margin-bottom: 8px;
    position: relative;
    font-size: 13px;
    color: #6c757d;
}

.featured-snippets-page .csv-contenido li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.featured-snippets-page .csv-metadata {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 12px;
    color: #6c757d;
    background: white;
    padding: 12px;
    border-radius: 6px;
    border-left: 3px solid #88B04B;
}

.featured-snippets-page .csv-card-footer {
    padding: 20px;
    background: white;
    border-top: 1px solid #dee2e6;
}

.featured-snippets-page .btn-download {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.featured-snippets-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.featured-snippets-page .download-icon {
    font-size: 18px;
}

.featured-snippets-page .instrucciones-uso {
    background: #e8f5e9;
    border-left: 4px solid #4caf50;
    padding: 20px 25px;
    border-radius: 8px;
}

.featured-snippets-page .instrucciones-uso h4 {
    margin: 0 0 15px 0;
    color: #2e7d32;
    font-size: 18px;
}

.featured-snippets-page .instrucciones-uso ol {
    margin: 0;
    padding-left: 20px;
}

.featured-snippets-page .instrucciones-uso li {
    margin-bottom: 10px;
    font-size: 14px;
    color: #1b5e20;
    line-height: 1.6;
}

/* ========================================
   COMPARACIÓN ANTES vs DESPUÉS
   ======================================== */

.featured-snippets-page .comparacion-antes-despues {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.featured-snippets-page .comparacion-title {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 30px 0;
    text-align: center;
}

.featured-snippets-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
    margin-bottom: 30px;
}

.featured-snippets-page .comparacion-columna {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.featured-snippets-page .columna-header {
    padding: 20px;
    text-align: center;
}

.featured-snippets-page .antes-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.featured-snippets-page .despues-header {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
}

.featured-snippets-page .columna-header .header-icon {
    font-size: 36px;
    display: block;
    margin-bottom: 10px;
}

.featured-snippets-page .columna-header h4 {
    margin: 0 0 8px 0;
    font-size: 20px;
    font-weight: 700;
}

.featured-snippets-page .columna-header .subtitle {
    font-size: 13px;
    opacity: 0.95;
    display: block;
}

.featured-snippets-page .columna-content {
    padding: 25px;
    background: #f8f9fa;
}

.featured-snippets-page .problema-item,
.featured-snippets-page .mejora-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    align-items: start;
}

.featured-snippets-page .problema-item:last-child,
.featured-snippets-page .mejora-item:last-child {
    margin-bottom: 0;
}

.featured-snippets-page .problema-numero,
.featured-snippets-page .mejora-numero {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}

.featured-snippets-page .problema-numero {
    background: #dc3545;
    color: white;
}

.featured-snippets-page .mejora-numero {
    background: #88B04B;
    color: white;
}

.featured-snippets-page .problema-texto strong,
.featured-snippets-page .mejora-texto strong {
    display: block;
    color: #000000;
    font-size: 15px;
    margin-bottom: 5px;
}

.featured-snippets-page .problema-texto p,
.featured-snippets-page .mejora-texto p {
    margin: 0;
    font-size: 13px;
    color: #6c757d;
    line-height: 1.5;
}

.featured-snippets-page .columna-footer {
    padding: 15px 20px;
    text-align: center;
    font-size: 14px;
}

.featured-snippets-page .perdida-footer {
    background: #f8d7da;
    color: #721c24;
    border-top: 2px solid #dc3545;
}

.featured-snippets-page .ganancia-footer {
    background: #d4edda;
    color: #155724;
    border-top: 2px solid #88B04B;
}

.featured-snippets-page .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.featured-snippets-page .flecha-contenido {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.featured-snippets-page .flecha-icono {
    font-size: 48px;
    margin-bottom: 8px;
}

.featured-snippets-page .flecha-texto {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 5px;
}

.featured-snippets-page .flecha-subtexto {
    font-size: 13px;
    opacity: 0.9;
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

.featured-snippets-page .timeline-implementacion {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-top: 30px;
}

.featured-snippets-page .timeline-implementacion h4 {
    color: #000000;
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 20px 0;
}

.featured-snippets-page .timeline-items {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.featured-snippets-page .timeline-item {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    border-left: 4px solid #88B04B;
}

.featured-snippets-page .timeline-badge {
    background: #88B04B;
    color: white;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 10px;
}

.featured-snippets-page .timeline-content strong {
    display: block;
    color: #000000;
    font-size: 14px;
    margin-bottom: 8px;
}

.featured-snippets-page .timeline-content p {
    font-size: 13px;
    color: #6c757d;
    line-height: 1.5;
    margin: 0 0 10px 0;
}

.featured-snippets-page .timeline-resultado {
    display: block;
    background: #e8f5e9;
    color: #2e7d32;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
}

/* ========================================
   TABLA KPIs FEATURED SNIPPETS
   ======================================== */

.featured-snippets-page .kpis-featured-snippets {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.featured-snippets-page .kpis-title {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 15px 0;
}

.featured-snippets-page .kpis-intro {
    color: #6c757d;
    font-size: 15px;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.featured-snippets-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    font-size: 14px;
}

.featured-snippets-page .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.featured-snippets-page .tabla-kpis th {
    padding: 14px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
}

.featured-snippets-page .tabla-kpis td {
    padding: 14px 12px;
    border-bottom: 1px solid #e1e8ed;
    vertical-align: top;
}

.featured-snippets-page .tabla-kpis tr:hover {
    background: #f8f9fa;
}

.featured-snippets-page .tabla-kpis .fila-destacada {
    background: #f0f7e6;
    border-left: 4px solid #ffd700;
}

.featured-snippets-page .tabla-kpis .fila-destacada:hover {
    background: #f0f7e6;
}

.featured-snippets-page .tabla-kpis .col-metrica {
    width: 25%;
}

.featured-snippets-page .tabla-kpis .col-antes,
.featured-snippets-page .tabla-kpis .col-despues {
    width: 18%;
}

.featured-snippets-page .tabla-kpis .col-mejora {
    width: 12%;
}

.featured-snippets-page .tabla-kpis .col-impacto {
    width: 27%;
}

.featured-snippets-page .tabla-kpis .valor-antes {
    color: #dc3545;
    font-weight: 600;
}

.featured-snippets-page .tabla-kpis .valor-despues {
    color: #88B04B;
    font-weight: 600;
}

.featured-snippets-page .tabla-kpis .valor-mejora {
    color: #88B04B;
    font-weight: 700;
    font-size: 15px;
}

.featured-snippets-page .tabla-kpis .detalle {
    display: block;
    font-size: 11px;
    font-weight: 400;
    opacity: 0.8;
    margin-top: 3px;
}

.featured-snippets-page .tabla-kpis .impacto-texto {
    color: #495057;
    font-size: 13px;
    line-height: 1.5;
}

.featured-snippets-page .nota-importante {
    background: #f0f7e6;
    border: 1px solid #88B04B;
    border-radius: 8px;
    padding: 20px;
    border-left: 4px solid #88B04B;
}

.featured-snippets-page .nota-importante strong {
    color: #856404;
    font-size: 15px;
    display: block;
    margin-bottom: 10px;
}

.featured-snippets-page .nota-importante ul {
    margin: 10px 0 0 0;
    padding-left: 20px;
}

.featured-snippets-page .nota-importante li {
    color: #856404;
    font-size: 14px;
    margin-bottom: 8px;
    line-height: 1.5;
}

/* ========================================
   BADGES DE SECCIÓN
   ======================================== */

.featured-snippets-page .badge-seccion {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.featured-snippets-page .badge-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.featured-snippets-page .badge-despues {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
}

/* ========================================
   RESPONSIVE DESIGN
   ======================================== */

@media (max-width: 992px) {
    .featured-snippets-page .impacto-negocio-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .featured-snippets-page .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .featured-snippets-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .featured-snippets-page .comparacion-flecha {
        order: 2;
        padding: 15px 0;
    }

    .featured-snippets-page .flecha-contenido {
        transform: rotate(90deg);
    }

    .featured-snippets-page .columna-despues {
        order: 3;
    }

    .featured-snippets-page .timeline-items {
        grid-template-columns: 1fr;
    }

    .featured-snippets-page .tabla-kpis {
        font-size: 12px;
    }

    .featured-snippets-page .tabla-kpis th,
    .featured-snippets-page .tabla-kpis td {
        padding: 10px 8px;
    }
}
</style>

<div class="audit-page featured-snippets-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Featured Snippets Opportunities'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Oportunidades de posición 0 en Google'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Capturar posición 0 en SERPs</span>
        </div>
    </div>

    <!-- Sección Educativa: ¿Qué son los Featured Snippets? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon">🏆</span>
            <h2>¿Qué son los Featured Snippets y Por Qué son Críticos para Ibiza Villa?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                Los <strong>Featured Snippets</strong> (también llamados <strong>Posición 0</strong>) son respuestas destacadas
                que Google muestra <strong>por encima del resultado #1</strong> en los resultados de búsqueda. Son la primera
                cosa que ven los usuarios y <strong>capturan entre 35-50% de los clics</strong>, dejando solo el 15-20% para
                el resultado #1 tradicional.
            </p>

            <div class="analogia-box">
                <div class="analogia-header">
                    <span class="analogia-icon">💡</span>
                    <strong>Piensa en Featured Snippets como la Portada de una Revista de Viajes de Lujo:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>La revista tiene muchos artículos</strong> dentro (resultados #1 a #10)</li>
                    <li><strong>Pero solo UN artículo aparece en la portada</strong> (Featured Snippet = Posición 0)</li>
                    <li><strong>La mayoría de lectores compran la revista por el artículo de portada</strong> (35-50% CTR)</li>
                    <li><strong>Estar en la portada multiplica tu visibilidad x10</strong> vs estar solo dentro de la revista</li>
                    <li><strong>Google elige qué artículo merece la portada</strong> basándose en calidad, estructura, y relevancia</li>
                </ul>
            </div>

            <div class="impacto-negocio-grid">
                <div class="impacto-item">
                    <div class="impacto-icon">📊</div>
                    <div class="impacto-texto">
                        <strong>CTR Masivo</strong>
                        <p>Posición 0 = 35-50% CTR vs Posición #1 = 15-20% CTR. <strong>2-3x más clics</strong> con misma keyword.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon">🎯</div>
                    <div class="impacto-texto">
                        <strong>Autoridad de Marca</strong>
                        <p>Google te presenta como <strong>LA respuesta autorizada</strong>. Efecto halo: usuarios confían más en tu marca.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon">💰</div>
                    <div class="impacto-texto">
                        <strong>Tráfico Cualificado</strong>
                        <p>Queries informativas (precios, cómo, mejores) = <strong>usuarios en fase de investigación</strong> que luego reservan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Entregables CSV Descargables -->
    <section class="entregables-csv">
        <div class="entregables-header">
            <span class="badge-seccion badge-despues">✅ DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN</span>
            <h3>Archivos CSV Descargables para Implementación</h3>
            <p>Descarga estos archivos con las oportunidades específicas identificadas y la guía de optimización por tipo de snippet.</p>
        </div>

        <div class="csv-cards-grid">
            <!-- CSV 1: Oportunidades Featured Snippets -->
            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon">📄</span>
                    <h4>Featured Snippets - Oportunidades</h4>
                    <span class="csv-priority priority-critica">Muy Alta Prioridad</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        <strong>15 queries</strong> donde Ibiza Villa está posicionado #2-#10 y existe un Featured Snippet
                        capturado por competidores (Booking, Timeout, Airbnb, etc.). <strong>Oportunidad inmediata</strong>
                        de capturar Posición 0.
                    </p>
                    <ul class="csv-contenido">
                        <li><strong>Query objetivo</strong> con volumen mensual y dificultad</li>
                        <li><strong>Posición actual</strong> de Ibiza Villa (#2-#10)</li>
                        <li><strong>Competidor</strong> que tiene el snippet actualmente</li>
                        <li><strong>Tipo de snippet</strong> (párrafo, lista, tabla, video, etc.)</li>
                        <li><strong>Acción recomendada</strong> específica para capturar snippet</li>
                        <li><strong>CTR ganancia estimada</strong> (+25% a +58% vs posición actual)</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>Total oportunidades:</strong> 15 queries</span>
                        <span><strong>Volumen total:</strong> 5,735 búsquedas/mes</span>
                        <span><strong>Ganancia potencial:</strong> +1,800-2,400 sesiones/mes</span>
                    </div>
                </div>
                <div class="csv-card-footer">
                    <a href="../entregables/featured_snippets/featured_snippets_opportunities.csv"
                       class="btn-download" download>
                        <span class="download-icon">⬇️</span>
                        Descargar CSV - Oportunidades Featured Snippets
                    </a>
                </div>
            </div>

            <!-- CSV 2: Guía de Optimización por Tipo de Snippet -->
            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon">📋</span>
                    <h4>Guía de Optimización por Tipo de Snippet</h4>
                    <span class="csv-priority priority-alta">Alta Prioridad</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        Guía completa de <strong>10 tipos de Featured Snippets</strong> con formato HTML recomendado,
                        longitud óptima, ejemplos concretos para Ibiza Villa, y Schema markup necesario para cada tipo.
                    </p>
                    <ul class="csv-contenido">
                        <li><strong>Párrafo:</strong> Respuestas directas 40-60 palabras (40% snippets)</li>
                        <li><strong>Lista Numerada:</strong> Pasos secuenciales con HowTo Schema (30% snippets)</li>
                        <li><strong>Lista Bullets:</strong> Características, servicios incluidos (20% snippets)</li>
                        <li><strong>Tabla Comparativa:</strong> Precios, temporadas, zonas (15% snippets)</li>
                        <li><strong>Video Snippet:</strong> Con transcript y VideoObject Schema</li>
                        <li><strong>Y 5 tipos adicionales:</strong> Definition Box, PAA, Local Pack, Rich Answer, Imágenes</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>Tipos cubiertos:</strong> 10 formatos diferentes</span>
                        <span><strong>Ejemplos HTML:</strong> Código copiable directo</span>
                        <span><strong>Schema markup:</strong> FAQPage, HowTo, Product, VideoObject</span>
                    </div>
                </div>
                <div class="csv-card-footer">
                    <a href="../entregables/featured_snippets/snippet_optimization_guide.csv"
                       class="btn-download" download>
                        <span class="download-icon">⬇️</span>
                        Descargar CSV - Guía de Optimización Snippets
                    </a>
                </div>
            </div>
        </div>

        <!-- Instrucciones de Uso -->
        <div class="instrucciones-uso">
            <h4>📖 Cómo usar estos archivos:</h4>
            <ol>
                <li><strong>Descarga ambos CSV</strong> y ábrelos en Excel/Google Sheets</li>
                <li><strong>Prioriza por volumen y CTR ganancia</strong>: Empieza por queries de mayor tráfico potencial</li>
                <li><strong>Identifica tipo de snippet</strong> requerido para cada query (CSV 1)</li>
                <li><strong>Consulta la guía de optimización</strong> (CSV 2) para ese tipo específico de snippet</li>
                <li><strong>Implementa el formato HTML recomendado</strong> en la página correspondiente</li>
                <li><strong>Añade Schema markup</strong> según tipo (FAQPage, HowTo, VideoObject, etc.)</li>
                <li><strong>Monitorea en 7-14 días</strong>: Google re-crawlea y puede otorgar snippet</li>
            </ol>
        </div>
    </section>

    <!-- Comparación ANTES vs DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h3 class="comparacion-title">Comparación: Situación ANTES vs Resultados DESPUÉS</h3>

        <div class="comparacion-grid">
            <!-- Columna ANTES -->
            <div class="comparacion-columna columna-antes">
                <div class="columna-header antes-header">
                    <span class="header-icon">❌</span>
                    <h4>ANTES - Situación Actual</h4>
                    <span class="subtitle">Featured Snippets Desaprovechados</span>
                </div>
                <div class="columna-content">
                    <div class="problema-item">
                        <div class="problema-numero">1</div>
                        <div class="problema-texto">
                            <strong>0-1 Featured Snippets capturados</strong>
                            <p>Ibiza Villa prácticamente ausente en Posición 0. Competidores (Booking, Timeout, Airbnb) dominan.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">2</div>
                        <div class="problema-texto">
                            <strong>15 oportunidades sin explotar</strong>
                            <p>Posicionados #2-#10 en queries con snippet activo, pero sin formato optimizado para capturar Posición 0.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">3</div>
                        <div class="problema-texto">
                            <strong>Contenido NO estructurado para snippets</strong>
                            <p>Formato narrativo largo sin respuestas directas, listas, o tablas. Imposible que Google extraiga snippet.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">4</div>
                        <div class="problema-texto">
                            <strong>0 Schema markup FAQPage/HowTo</strong>
                            <p>Sin structured data que facilite a Google identificar contenido snippet-friendly.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">5</div>
                        <div class="problema-texto">
                            <strong>Pérdida masiva de tráfico cualificado</strong>
                            <p>Competidores capturan 35-50% CTR en queries informativas (precios, cómo reservar, mejores zonas) donde estamos #2-#6.</p>
                        </div>
                    </div>
                </div>
                <div class="columna-footer perdida-footer">
                    <strong>Pérdida estimada:</strong> 1,800-2,400 sesiones/mes desde queries con snippet
                </div>
            </div>

            <!-- Flecha de transformación -->
            <div class="comparacion-flecha">
                <div class="flecha-contenido">
                    <div class="flecha-icono">🏆</div>
                    <div class="flecha-texto">FEATURED SNIPPETS</div>
                    <div class="flecha-subtexto">Posición 0</div>
                </div>
            </div>

            <!-- Columna DESPUÉS -->
            <div class="comparacion-columna columna-despues">
                <div class="columna-header despues-header">
                    <span class="header-icon">✅</span>
                    <h4>DESPUÉS - Implementación Completada</h4>
                    <span class="subtitle">Posición 0 Capturada (3-4 meses)</span>
                </div>
                <div class="columna-content">
                    <div class="mejora-item">
                        <div class="mejora-numero">1</div>
                        <div class="mejora-texto">
                            <strong>8-12 Featured Snippets capturados</strong>
                            <p>53-80% de las 15 oportunidades identificadas ahora dominadas por Ibiza Villa en Posición 0.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">2</div>
                        <div class="mejora-texto">
                            <strong>Contenido restructurado snippet-friendly</strong>
                            <p>25-30 páginas optimizadas con respuestas directas primeros 50 palabras, listas estructuradas, tablas comparativas.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">3</div>
                        <div class="mejora-texto">
                            <strong>Schema markup completo implementado</strong>
                            <p>FAQPage Schema en 10-12 páginas, HowTo Schema en 5 guías, VideoObject en 3 videos, Product Schema en villas.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">4</div>
                        <div class="mejora-texto">
                            <strong>Monopolio queries informativas clave</strong>
                            <p>Dominancia en "cuánto cuesta", "mejores zonas", "cómo reservar", "qué incluye" - queries pre-conversión críticas.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">5</div>
                        <div class="mejora-texto">
                            <strong>Autoridad de marca reforzada</strong>
                            <p>Usuarios perciben Ibiza Villa como LA fuente autorizada sobre villas lujo Ibiza (Google nos presenta como expertos).</p>
                        </div>
                    </div>
                </div>
                <div class="columna-footer ganancia-footer">
                    <strong>Ganancia estimada:</strong> +1,800-2,400 sesiones/mes tráfico cualificado
                </div>
            </div>
        </div>

        <!-- Timeline de Implementación -->
        <div class="timeline-implementacion">
            <h4>Timeline de Implementación (3-4 meses)</h4>
            <div class="timeline-items">
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 1-2</div>
                    <div class="timeline-content">
                        <strong>Quick Wins - Snippets de Párrafo</strong>
                        <p>Optimizar 8-10 páginas con respuestas directas primeros 50 palabras. Captura: 2-3 snippets inmediatos.</p>
                        <span class="timeline-resultado">+15-20% cobertura snippets</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 3-6</div>
                    <div class="timeline-content">
                        <strong>Listas y FAQs con Schema</strong>
                        <p>Implementar FAQPage Schema en 10 páginas + crear 5 guías con listas numeradas. Captura: 3-4 snippets adicionales.</p>
                        <span class="timeline-resultado">+35-40% cobertura snippets</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 7-10</div>
                    <div class="timeline-content">
                        <strong>Tablas y Contenido Visual</strong>
                        <p>Crear tablas comparativas (precios, temporadas, zonas) + 3 videos con transcript. Captura: 2-3 snippets tablas/video.</p>
                        <span class="timeline-resultado">+15-20% cobertura snippets</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Semanas 11-14</div>
                    <div class="timeline-content">
                        <strong>Consolidación y Monitoreo</strong>
                        <p>Reforzar snippets capturados (actualizar datos, ampliar contenido). Optimizar snippets no capturados en primer intento.</p>
                        <span class="timeline-resultado">+5-10% cobertura final</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabla de KPIs Featured Snippets -->
    <section class="kpis-featured-snippets">
        <h3 class="kpis-title">KPIs y Resultados Esperados - Featured Snippets</h3>
        <p class="kpis-intro">
            Métricas cuantificadas del impacto de capturar Featured Snippets (Posición 0) en queries clave para Ibiza Villa.
        </p>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th class="col-metrica">Métrica</th>
                    <th class="col-antes">ANTES<br><span style="font-weight: 400; font-size: 12px;">Situación Actual</span></th>
                    <th class="col-despues">DESPUÉS<br><span style="font-weight: 400; font-size: 12px;">3-4 meses implementación</span></th>
                    <th class="col-mejora">Mejora</th>
                    <th class="col-impacto">Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Featured Snippets Capturados</strong></td>
                    <td class="valor-antes">0-1 snippets<br><span class="detalle">(6% de oportunidades)</span></td>
                    <td class="valor-despues">8-12 snippets<br><span class="detalle">(53-80% cobertura)</span></td>
                    <td class="valor-mejora">+700-1,100%</td>
                    <td class="impacto-texto">Dominancia Posición 0 en queries informativas clave</td>
                </tr>
                <tr>
                    <td><strong>CTR Promedio Queries con Snippet</strong></td>
                    <td class="valor-antes">15-20%<br><span class="detalle">(Posición #2-#6)</span></td>
                    <td class="valor-despues">35-50%<br><span class="detalle">(Posición 0 snippet)</span></td>
                    <td class="valor-mejora">+133-233%</td>
                    <td class="impacto-texto">2-3x más clics con mismo posicionamiento keyword</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Tráfico desde Queries con Snippet</strong></td>
                    <td class="valor-antes">450-600 sess/mes<br><span class="detalle">(CTR bajo pos #2-#6)</span></td>
                    <td class="valor-despues">2,250-3,000 sess/mes<br><span class="detalle">(CTR alto snippet)</span></td>
                    <td class="valor-mejora">+400-500%</td>
                    <td class="impacto-texto"><strong>+1,800-2,400 sesiones/mes adicionales</strong> tráfico cualificado</td>
                </tr>
                <tr>
                    <td><strong>Páginas con Schema FAQPage/HowTo</strong></td>
                    <td class="valor-antes">0 páginas<br><span class="detalle">(0% sitio)</span></td>
                    <td class="valor-despues">15-17 páginas<br><span class="detalle">(11-13% sitio)</span></td>
                    <td class="valor-mejora">+∞</td>
                    <td class="impacto-texto">Google prioriza contenido con Schema estructurado +40%</td>
                </tr>
                <tr>
                    <td><strong>Snippets por Tipo Capturados</strong></td>
                    <td class="valor-antes">N/A<br><span class="detalle">(Sin distribución)</span></td>
                    <td class="valor-despues">Párrafo: 4-5<br>Lista: 2-4<br>Tabla: 1-2<br>Video: 1</td>
                    <td class="valor-mejora">Diversificado</td>
                    <td class="impacto-texto">Cobertura múltiples tipos de queries (info/trans/local)</td>
                </tr>
                <tr>
                    <td><strong>Autoridad Marca Percibida</strong></td>
                    <td class="valor-antes">Baja<br><span class="detalle">(Ausente Posición 0)</span></td>
                    <td class="valor-despues">Muy Alta<br><span class="detalle">(Google presenta como experto)</span></td>
                    <td class="valor-mejora">+300-400%</td>
                    <td class="impacto-texto">Efecto halo: usuarios confían más → +15-20% conversión</td>
                </tr>
            </tbody>
        </table>

        <div class="nota-importante">
            <strong>⚠️ Nota Importante:</strong> Featured Snippets tienen comportamiento <strong>"winner-takes-most"</strong>:
            <ul>
                <li>Posición 0 (snippet) captura <strong>35-50% de los clics</strong> de esa query</li>
                <li>Posición #1 tradicional (debajo del snippet) solo recibe <strong>15-20% CTR</strong> (antes recibía 30-35%)</li>
                <li>Posiciones #2-#10 reciben <strong>menos del 10% CTR combinado</strong> si hay snippet</li>
                <li>Capturar snippet = <strong>monopolio tráfico</strong> para esa query específica</li>
                <li>Google puede <strong>rotar snippets</strong>: necesario monitorear y reforzar contenido continuamente</li>
            </ul>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <span class="badge-seccion badge-antes">🔍 ANTES - SITUACIÓN ACTUAL</span>
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Snippets Actuales</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['snippets_actuales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Oportunidades</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['oportunidades_totales'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Quick Wins</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['quick_wins'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tráfico Potencial</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['trafico_potencial'] ?? '0'); ?></div>
            </div>
        </div>
    </div>

    <!-- Snippets Actuales -->
    <?php if (!empty($snippets_actuales)): ?>
    <div class="content-section">
        <h3>Featured Snippets Actuales</h3>
        <p>Keywords donde ya aparecemos en posición 0.</p>

        <?php foreach ($snippets_actuales as $snippet): ?>
        <div class="snippet-card">
            <div class="snippet-header">
                <div class="snippet-keyword"><?php echo htmlspecialchars($snippet['keyword']); ?></div>
                <span class="snippet-type <?php echo $snippet['tipo']; ?>">
                    <?php echo strtoupper($snippet['tipo']); ?>
                </span>
            </div>
            <div class="snippet-metrics">
                <span><strong>Volumen:</strong> <?php echo htmlspecialchars($snippet['volumen']); ?>/mes</span>
                <span><strong>CTR:</strong> <?php echo htmlspecialchars($snippet['ctr']); ?>%</span>
                <span><strong>URL:</strong> <?php echo htmlspecialchars($snippet['url']); ?></span>
            </div>
            <?php if (isset($snippet['preview'])): ?>
            <div class="snippet-preview"><?php echo htmlspecialchars($snippet['preview']); ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Oportunidades -->
    <div class="content-section">
        <h3>Oportunidades de Featured Snippets</h3>
        <p>Keywords donde estamos posicionados en página 1 (posiciones 2-10) y existe un snippet.</p>

        <?php foreach ($oportunidades ?? [] as $opp): ?>
        <div class="opportunity-card">
            <div class="opportunity-header">
                <div class="opportunity-keyword"><?php echo htmlspecialchars($opp['keyword']); ?></div>
                <span class="priority-badge <?php echo strtolower($opp['prioridad']); ?>">
                    <?php echo htmlspecialchars($opp['prioridad']); ?>
                </span>
            </div>

            <div class="opportunity-details">
                <div class="detail-item">
                    <div class="detail-label">Posición Actual</div>
                    <div class="detail-value">#<?php echo htmlspecialchars($opp['posicion_actual']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Volumen Mensual</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['volumen']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tipo de Snippet</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['tipo_snippet']); ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Quién tiene el snippet</div>
                    <div class="detail-value"><?php echo htmlspecialchars($opp['competidor']); ?></div>
                </div>
            </div>

            <div class="action-recommendation">
                <strong>Recomendación:</strong> <?php echo htmlspecialchars($opp['accion']); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Tipos de Snippet -->
    <div class="content-section">
        <h3>Guía de Tipos de Featured Snippets</h3>
        <p>Cómo estructurar contenido para cada tipo de snippet.</p>

        <div class="type-examples">
            <?php foreach ($tipos_snippet ?? [] as $tipo): ?>
            <div class="type-card">
                <h4><?php echo htmlspecialchars($tipo['nombre']); ?></h4>
                <p class="type-description"><?php echo htmlspecialchars($tipo['descripcion']); ?></p>
                <p style="font-size: 13px; margin: 10px 0;"><strong>Mejor para:</strong> <?php echo htmlspecialchars($tipo['mejor_para']); ?></p>
                <?php if (isset($tipo['ejemplo_estructura'])): ?>
                <div class="example-code"><?php echo htmlspecialchars($tipo['ejemplo_estructura']); ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Comparativa Competencia -->
    <?php if (!empty($competencia)): ?>
    <div class="content-section">
        <h3>Análisis Competencia Featured Snippets</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Competidor</th>
                    <th>Snippets Totales</th>
                    <th>Tipo Párrafo</th>
                    <th>Tipo Lista</th>
                    <th>Tipo Tabla</th>
                    <th>Tráfico Estimado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competencia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['total']); ?></td>
                    <td><?php echo htmlspecialchars($comp['parrafo']); ?></td>
                    <td><?php echo htmlspecialchars($comp['lista']); ?></td>
                    <td><?php echo htmlspecialchars($comp['tabla']); ?></td>
                    <td><?php echo htmlspecialchars($comp['trafico_estimado']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Quick Wins -->
    <?php if (!empty($quick_wins)): ?>
    <div class="content-section">
        <h3>Quick Wins - Acción Inmediata</h3>
        <p>Oportunidades de bajo esfuerzo y alto impacto que podemos implementar rápidamente.</p>

        <?php foreach ($quick_wins as $win): ?>
        <div class="quick-win-item">
            <div class="quick-win-header">
                <div class="quick-win-title"><?php echo htmlspecialchars($win['keyword']); ?></div>
                <span class="effort-badge"><?php echo htmlspecialchars($win['esfuerzo']); ?></span>
            </div>
            <p style="margin: 8px 0; font-size: 14px;"><?php echo htmlspecialchars($win['accion_especifica']); ?></p>
            <p style="margin: 5px 0; font-size: 13px; color: #155724;">
                <strong>Impacto:</strong> <?php echo htmlspecialchars($win['impacto_estimado']); ?>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Estrategia de Implementación -->
    <?php if (!empty($estrategia)): ?>
    <div class="content-section">
        <h3>Estrategia de Implementación</h3>

        <?php foreach ($estrategia as $fase): ?>
        <div style="margin-bottom: 20px;">
            <h4 style="color: #88B04B; margin-bottom: 10px;"><?php echo htmlspecialchars($fase['fase']); ?></h4>
            <p style="margin-bottom: 10px;"><?php echo htmlspecialchars($fase['descripcion']); ?></p>
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($fase['acciones'] ?? [] as $accion): ?>
                <li style="margin: 5px 0;"><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>Featured Snippets Opportunities</span>
    </div>
</div>
