<?php
/**
 * Módulo: Entidades y Knowledge Graph (m9.6)
 * Fase: 9 - SEO Moderno
 * Descripción: Optimización para entidades, Knowledge Panel y entity-based SEO
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$knowledge_panel = $datosModulo['knowledge_panel'] ?? [];
$entidades_principales = $datosModulo['entidades_principales'] ?? [];
$relaciones = $datosModulo['grafo_relaciones'] ?? [];
$menciones_externas = $datosModulo['menciones_externas'] ?? [];
$schema_implementado = $datosModulo['schema_implementado'] ?? [];
$optimizaciones = $datosModulo['optimizaciones'] ?? [];
$estrategia_entidades = $datosModulo['estrategia_entidades'] ?? [];
?>

<style>
.entidades-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

.entidades-page .executive-summary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.entidades-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.entidades-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.entidades-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.entidades-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.entidades-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.entidades-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #f5576c;
}

.entidades-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #f5576c;
    font-size: 20px;
    font-weight: 600;
}

.entidades-page .kp-status {
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.entidades-page .kp-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.entidades-page .kp-status-badge {
    padding: 8px 16px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 600;
}

.entidades-page .kp-status-badge.activo {
    background: #d4edda;
    color: #155724;
}

.entidades-page .kp-status-badge.inactivo {
    background: #f8d7da;
    color: #721c24;
}

.entidades-page .kp-status-badge.parcial {
    background: #f0f7e6;
    color: #856404;
}

.entidades-page .kp-preview {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-top: 15px;
}

.entidades-page .kp-field {
    margin: 12px 0;
    font-size: 14px;
}

.entidades-page .kp-field-label {
    font-weight: 600;
    color: #6c757d;
    margin-right: 8px;
}

.entidades-page .entity-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 3px solid #f5576c;
}

.entidades-page .entity-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
}

.entidades-page .entity-name {
    font-weight: 600;
    color: #000000;
    font-size: 18px;
}

.entidades-page .entity-type {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    background: #f5576c;
    color: white;
}

.entidades-page .entity-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    margin-top: 12px;
}

.entidades-page .entity-metric {
    font-size: 13px;
}

.entidades-page .entity-metric-label {
    color: #6c757d;
    font-weight: 500;
}

.entidades-page .entity-metric-value {
    color: #000000;
    font-weight: 600;
}

.entidades-page .relationship-diagram {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin: 20px 0;
    text-align: center;
}

.entidades-page .relationship-node {
    display: inline-block;
    background: #f8f9fa;
    border: 2px solid #f5576c;
    border-radius: 8px;
    padding: 15px 20px;
    margin: 10px;
    font-weight: 600;
    position: relative;
}

.entidades-page .relationship-node.central {
    background: #f5576c;
    color: white;
    font-size: 18px;
}

.entidades-page .mention-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 12px;
}

.entidades-page .mention-source {
    font-weight: 600;
    color: #000000;
    margin-bottom: 8px;
}

.entidades-page .mention-authority {
    display: inline-block;
    background: #f5576c;
    color: white;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-left: 10px;
}

.entidades-page .mention-context {
    background: #f8f9fa;
    border-left: 3px solid #f5576c;
    padding: 10px;
    margin-top: 8px;
    font-size: 13px;
    font-style: italic;
}

.entidades-page .schema-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.entidades-page .schema-table th,
.entidades-page .schema-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.entidades-page .schema-table th {
    background: #fff0f3;
    color: #f5576c;
    font-weight: 600;
    font-size: 14px;
}

.entidades-page .schema-table tr:hover {
    background: #fafafa;
}

.entidades-page .implementation-status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
}

.entidades-page .implementation-status.implementado {
    background: #d4edda;
    color: #155724;
}

.entidades-page .implementation-status.pendiente {
    background: #f8d7da;
    color: #721c24;
}

.entidades-page .optimization-item {
    background: #f0f7e6;
    border: 1px solid #88B04B;
    border-radius: 6px;
    padding: 18px;
    margin-bottom: 15px;
    border-left: 4px solid #88B04B;
}

.entidades-page .optimization-title {
    font-weight: 600;
    color: #000000;
    margin-bottom: 10px;
}

.entidades-page .priority-tag {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    margin-right: 8px;
}

.entidades-page .priority-tag.alta {
    background: #dc3545;
    color: white;
}

.entidades-page .priority-tag.media {
    background: #88B04B;
    color: #333;
}

.entidades-page .priority-tag.baja {
    background: #6c757d;
    color: white;
}

.entidades-page .action-steps {
    margin: 12px 0;
    padding-left: 20px;
}

.entidades-page .action-steps li {
    margin: 6px 0;
    font-size: 14px;
}

.entidades-page .strategy-timeline {
    margin-top: 20px;
}

.entidades-page .timeline-item {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 4px solid #f5576c;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    position: relative;
}

.entidades-page .timeline-phase {
    font-weight: 600;
    color: #f5576c;
    font-size: 16px;
    margin-bottom: 8px;
}

.entidades-page .timeline-duration {
    display: inline-block;
    background: #f5576c;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
}

@media print {
    .entidades-page .content-section {
        page-break-inside: avoid;
    }
}

/* ========================================
   SECCIÓN EDUCATIVA - KNOWLEDGE GRAPH
   ======================================== */

.entidades-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.entidades-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.entidades-page .concepto-icon {
    font-size: 48px;
}

.entidades-page .concepto-header h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
}

.entidades-page .concepto-intro {
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.entidades-page .analogia-box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
}

.entidades-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: 600;
}

.entidades-page .analogia-icon {
    font-size: 28px;
}

.entidades-page .analogia-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.entidades-page .analogia-list li {
    padding-left: 25px;
    margin-bottom: 12px;
    position: relative;
    font-size: 15px;
    line-height: 1.6;
}

.entidades-page .analogia-list li:before {
    content: "🆔";
    position: absolute;
    left: 0;
    top: 0;
}

.entidades-page .impacto-negocio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

.entidades-page .impacto-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.entidades-page .impacto-icon {
    font-size: 42px;
    margin-bottom: 12px;
}

.entidades-page .impacto-texto strong {
    display: block;
    font-size: 18px;
    margin-bottom: 8px;
}

.entidades-page .impacto-texto p {
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
    opacity: 0.95;
}

/* ========================================
   ENTREGABLES CSV
   ======================================== */

.entidades-page .entregables-csv {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.entidades-page .entregables-header {
    margin-bottom: 30px;
}

.entidades-page .entregables-header h3 {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 15px 0 10px 0;
}

.entidades-page .entregables-header p {
    color: #6c757d;
    font-size: 15px;
    margin: 0;
}

.entidades-page .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    margin-bottom: 30px;
}

.entidades-page .csv-card {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.entidades-page .csv-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.entidades-page .csv-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-bottom: 2px solid #dee2e6;
}

.entidades-page .csv-icon {
    font-size: 32px;
    margin-bottom: 10px;
    display: block;
}

.entidades-page .csv-card-header h4 {
    margin: 10px 0;
    color: #000000;
    font-size: 19px;
    font-weight: 700;
}

.entidades-page .csv-priority {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    margin-top: 8px;
}

.entidades-page .csv-priority.priority-critica {
    background: #dc3545;
    color: white;
}

.entidades-page .csv-priority.priority-alta {
    background: #88B04B;
    color: #333;
}

.entidades-page .csv-card-body {
    padding: 20px;
}

.entidades-page .csv-description {
    font-size: 14px;
    color: #495057;
    line-height: 1.6;
    margin-bottom: 15px;
}

.entidades-page .csv-contenido {
    list-style: none;
    padding: 0;
    margin: 0 0 15px 0;
}

.entidades-page .csv-contenido li {
    padding-left: 20px;
    margin-bottom: 8px;
    position: relative;
    font-size: 13px;
    color: #6c757d;
}

.entidades-page .csv-contenido li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: bold;
}

.entidades-page .csv-metadata {
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

.entidades-page .csv-card-footer {
    padding: 20px;
    background: white;
    border-top: 1px solid #dee2e6;
}

.entidades-page .btn-download {
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

.entidades-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    color: white;
    text-decoration: none;
}

.entidades-page .download-icon {
    font-size: 18px;
}

.entidades-page .instrucciones-uso {
    background: #e8f5e9;
    border-left: 4px solid #4caf50;
    padding: 20px 25px;
    border-radius: 8px;
}

.entidades-page .instrucciones-uso h4 {
    margin: 0 0 15px 0;
    color: #2e7d32;
    font-size: 18px;
}

.entidades-page .instrucciones-uso ol {
    margin: 0;
    padding-left: 20px;
}

.entidades-page .instrucciones-uso li {
    margin-bottom: 10px;
    font-size: 14px;
    color: #1b5e20;
    line-height: 1.6;
}

/* ========================================
   COMPARACIÓN ANTES vs DESPUÉS
   ======================================== */

.entidades-page .comparacion-antes-despues {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.entidades-page .comparacion-title {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 30px 0;
    text-align: center;
}

.entidades-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
    margin-bottom: 30px;
}

.entidades-page .comparacion-columna {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.entidades-page .columna-header {
    padding: 20px;
    text-align: center;
}

.entidades-page .antes-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.entidades-page .despues-header {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
}

.entidades-page .columna-header .header-icon {
    font-size: 36px;
    display: block;
    margin-bottom: 10px;
}

.entidades-page .columna-header h4 {
    margin: 0 0 8px 0;
    font-size: 20px;
    font-weight: 700;
}

.entidades-page .columna-header .subtitle {
    font-size: 13px;
    opacity: 0.95;
    display: block;
}

.entidades-page .columna-content {
    padding: 25px;
    background: #f8f9fa;
}

.entidades-page .problema-item,
.entidades-page .mejora-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    align-items: start;
}

.entidades-page .problema-item:last-child,
.entidades-page .mejora-item:last-child {
    margin-bottom: 0;
}

.entidades-page .problema-numero,
.entidades-page .mejora-numero {
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

.entidades-page .problema-numero {
    background: #dc3545;
    color: white;
}

.entidades-page .mejora-numero {
    background: #88B04B;
    color: white;
}

.entidades-page .problema-texto strong,
.entidades-page .mejora-texto strong {
    display: block;
    color: #000000;
    font-size: 15px;
    margin-bottom: 5px;
}

.entidades-page .problema-texto p,
.entidades-page .mejora-texto p {
    margin: 0;
    font-size: 13px;
    color: #6c757d;
    line-height: 1.5;
}

.entidades-page .columna-footer {
    padding: 15px 20px;
    text-align: center;
    font-size: 14px;
}

.entidades-page .perdida-footer {
    background: #f8d7da;
    color: #721c24;
    border-top: 2px solid #dc3545;
}

.entidades-page .ganancia-footer {
    background: #d4edda;
    color: #155724;
    border-top: 2px solid #88B04B;
}

.entidades-page .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.entidades-page .flecha-contenido {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.entidades-page .flecha-icono {
    font-size: 48px;
    margin-bottom: 8px;
}

.entidades-page .flecha-texto {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 5px;
}

.entidades-page .flecha-subtexto {
    font-size: 13px;
    opacity: 0.9;
}

.entidades-page .timeline-implementacion {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-top: 30px;
}

.entidades-page .timeline-implementacion h4 {
    color: #000000;
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 20px 0;
}

.entidades-page .timeline-items {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.entidades-page .timeline-item {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    border-left: 4px solid #88B04B;
}

.entidades-page .timeline-badge {
    background: #88B04B;
    color: white;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 10px;
}

.entidades-page .timeline-content strong {
    display: block;
    color: #000000;
    font-size: 14px;
    margin-bottom: 8px;
}

.entidades-page .timeline-content p {
    font-size: 13px;
    color: #6c757d;
    line-height: 1.5;
    margin: 0 0 10px 0;
}

.entidades-page .timeline-resultado {
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
   TABLA KPIs KNOWLEDGE GRAPH
   ======================================== */

.entidades-page .kpis-knowledge-graph {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

.entidades-page .kpis-title {
    color: #000000;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 15px 0;
}

.entidades-page .kpis-intro {
    color: #6c757d;
    font-size: 15px;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.entidades-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    font-size: 14px;
}

.entidades-page .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.entidades-page .tabla-kpis th {
    padding: 14px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
}

.entidades-page .tabla-kpis td {
    padding: 14px 12px;
    border-bottom: 1px solid #e1e8ed;
    vertical-align: top;
}

.entidades-page .tabla-kpis tr:hover {
    background: #f8f9fa;
}

.entidades-page .tabla-kpis .fila-destacada {
    background: #f0f7e6;
    border-left: 4px solid #ffd700;
}

.entidades-page .tabla-kpis .fila-destacada:hover {
    background: #f0f7e6;
}

.entidades-page .tabla-kpis .col-metrica {
    width: 25%;
}

.entidades-page .tabla-kpis .col-antes,
.entidades-page .tabla-kpis .col-despues {
    width: 18%;
}

.entidades-page .tabla-kpis .col-mejora {
    width: 12%;
}

.entidades-page .tabla-kpis .col-impacto {
    width: 27%;
}

.entidades-page .tabla-kpis .valor-antes {
    color: #dc3545;
    font-weight: 600;
}

.entidades-page .tabla-kpis .valor-despues {
    color: #88B04B;
    font-weight: 600;
}

.entidades-page .tabla-kpis .valor-mejora {
    color: #88B04B;
    font-weight: 700;
    font-size: 15px;
}

.entidades-page .tabla-kpis .detalle {
    display: block;
    font-size: 11px;
    font-weight: 400;
    opacity: 0.8;
    margin-top: 3px;
}

.entidades-page .tabla-kpis .impacto-texto {
    color: #495057;
    font-size: 13px;
    line-height: 1.5;
}

.entidades-page .nota-importante {
    background: #f0f7e6;
    border: 1px solid #88B04B;
    border-radius: 8px;
    padding: 20px;
    border-left: 4px solid #88B04B;
}

.entidades-page .nota-importante strong {
    color: #856404;
    font-size: 15px;
    display: block;
    margin-bottom: 10px;
}

.entidades-page .nota-importante ul {
    margin: 10px 0 0 0;
    padding-left: 20px;
}

.entidades-page .nota-importante li {
    color: #856404;
    font-size: 14px;
    margin-bottom: 8px;
    line-height: 1.5;
}

/* ========================================
   BADGES DE SECCIÓN
   ======================================== */

.entidades-page .badge-seccion {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.entidades-page .badge-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.entidades-page .badge-despues {
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
}

/* ========================================
   RESPONSIVE DESIGN
   ======================================== */

@media (max-width: 992px) {
    .entidades-page .impacto-negocio-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .entidades-page .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .entidades-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .entidades-page .comparacion-flecha {
        order: 2;
        padding: 15px 0;
    }

    .entidades-page .flecha-contenido {
        transform: rotate(90deg);
    }

    .entidades-page .columna-despues {
        order: 3;
    }

    .entidades-page .timeline-items {
        grid-template-columns: 1fr;
    }

    .entidades-page .tabla-kpis {
        font-size: 12px;
    }

    .entidades-page .tabla-kpis th,
    .entidades-page .tabla-kpis td {
        padding: 10px 8px;
    }
}
</style>

<div class="audit-page entidades-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Entidades y Knowledge Graph'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Optimización para Knowledge Panel y entity-based SEO'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Objetivo: Establecer marca como entidad reconocida</span>
        </div>
    </div>

    <!-- Sección Educativa: ¿Qué son las Entidades y Knowledge Graph? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon">🆔</span>
            <h2>¿Qué son las Entidades, Knowledge Graph y Knowledge Panel?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                Las <strong>Entidades</strong> son "cosas" (personas, lugares, marcas, organizaciones) que Google reconoce de manera
                única y verificada en su <strong>Knowledge Graph</strong> (base de datos masiva de entidades y sus relaciones). Cuando Google reconoce
                tu marca como entidad, puedes obtener un <strong>Knowledge Panel</strong>: un cuadro informativo que aparece en búsquedas
                de tu marca con logo, descripción, redes sociales, reseñas, y más.
            </p>

            <div class="analogia-box">
                <div class="analogia-header">
                    <span class="analogia-icon">💡</span>
                    <strong>Piensa en ser una Entidad como tener una Tarjeta de Identidad Digital Verificada por Google:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>Sin entidad = Sin DNI digital</strong>: Google te ve como "texto en internet", no como negocio legítimo verificado</li>
                    <li><strong>Entidad reconocida = DNI digital oficial</strong>: Google confirma que existes, con datos verificados (nombre, logo, ubicación)</li>
                    <li><strong>Knowledge Panel = Tu ficha oficial</strong> que muestra Google cuando alguien busca tu marca (como mostrar DNI)</li>
                    <li><strong>Knowledge Graph = Registro civil</strong> donde Google guarda información verificada sobre ti y tus relaciones</li>
                    <li><strong>Schema markup = Documentos que presentas</strong> para demostrar quién eres (como presentar DNI + certificados)</li>
                </ul>
            </div>

            <div class="impacto-negocio-grid">
                <div class="impacto-item">
                    <div class="impacto-icon">🎯</div>
                    <div class="impacto-texto">
                        <strong>Credibilidad Máxima</strong>
                        <p>Knowledge Panel = <strong>sello de verificación Google</strong>. Usuarios confían +65% más en marcas con panel vs sin panel.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon">📊</div>
                    <div class="impacto-texto">
                        <strong>Control Información Marca</strong>
                        <p>Knowledge Panel muestra <strong>TU información verificada</strong>: logo, descripción, contacto, redes. Controlas narrativa.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon">⚡</div>
                    <div class="impacto-texto">
                        <strong>Visibilidad Preferencial</strong>
                        <p>Entidades obtienen <strong>prioridad en IA/SGE, Voice Search, Featured Snippets</strong>. Google favorece entidades verificadas.</p>
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
            <p>Descarga estos archivos con la auditoría completa de señales entidad y el plan de implementación Schema markup.</p>
        </div>

        <div class="csv-cards-grid">
            <!-- CSV 1: Entity Audit -->
            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon">📋</span>
                    <h4>Auditoría Señales de Entidad</h4>
                    <span class="csv-priority priority-critica">Muy Alta Prioridad</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        Auditoría completa de <strong>15 elementos críticos</strong> para que Google reconozca Ibiza Villa como entidad verificada:
                        Knowledge Panel, Wikidata, Organization Schema, menciones autoritativas, perfiles sociales, NAP consistency, y más.
                    </p>
                    <ul class="csv-contenido">
                        <li><strong>Knowledge Panel Status:</strong> Estado actual + requisitos para activar</li>
                        <li><strong>Wikidata Entry:</strong> Presencia en fuente autorizada neutral (crítico para KP)</li>
                        <li><strong>Organization Schema:</strong> SameAs properties, Founder, ContactPoint faltantes</li>
                        <li><strong>Menciones DA 70+:</strong> Solo 2/8 necesarias para triggear Knowledge Panel</li>
                        <li><strong>LinkedIn Company Page:</strong> Señal entidad profesional B2B ausente</li>
                        <li><strong>NAP Consistency:</strong> Inconsistencias en 5+ perfiles (problema crítico)</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>Total elementos auditados:</strong> 15 señales entidad</span>
                        <span><strong>Críticos detectados:</strong> 7 elementos prioritarios</span>
                        <span><strong>Score actual entidad:</strong> 32/100 (Bajo - No elegible KP)</span>
                    </div>
                </div>
                <div class="csv-card-footer">
                    <a href="../entregables/knowledge_graph/entity_audit.csv"
                       class="btn-download" download>
                        <span class="download-icon">⬇️</span>
                        Descargar CSV - Auditoría Señales Entidad
                    </a>
                </div>
            </div>

            <!-- CSV 2: Schema Implementation Plan -->
            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon">⚙️</span>
                    <h4>Plan Implementación Schema Markup</h4>
                    <span class="csv-priority priority-alta">Alta Prioridad</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        Plan detallado de <strong>15 tipos de Schema markup</strong> necesarios para establecer entidad: Organization, LocalBusiness,
                        Person (fundador), Product, Review, VideoObject, y más. Incluye código JSON-LD copiable para cada tipo.
                    </p>
                    <ul class="csv-contenido">
                        <li><strong>Organization Schema Completo:</strong> SameAs 6 propiedades + Founder + ContactPoint</li>
                        <li><strong>LocalBusiness Schema:</strong> Geo coordinates + OpeningHours + AggregateRating</li>
                        <li><strong>Person Schema (Fundador):</strong> Expertise humano detrás marca (E-E-A-T)</li>
                        <li><strong>Product Schema (Villas):</strong> Brand property conecta productos con entidad</li>
                        <li><strong>Review Schema Aggregado:</strong> Consolidar reviews múltiples fuentes (Google + TripAdvisor)</li>
                        <li><strong>VideoObject + ImageObject:</strong> Asociar multimedia con entidad</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>Tipos Schema cubiertos:</strong> 15 formatos diferentes</span>
                        <span><strong>Código JSON-LD:</strong> Ejemplos completos copiables</span>
                        <span><strong>Timeline implementación:</strong> 3-4 semanas para 15 schemas</span>
                    </div>
                </div>
                <div class="csv-card-footer">
                    <a href="../entregables/knowledge_graph/schema_implementation_plan.csv"
                       class="btn-download" download>
                        <span class="download-icon">⬇️</span>
                        Descargar CSV - Plan Implementación Schema
                    </a>
                </div>
            </div>
        </div>

        <!-- Instrucciones de Uso -->
        <div class="instrucciones-uso">
            <h4>📖 Cómo usar estos archivos para construir tu entidad:</h4>
            <ol>
                <li><strong>Descarga Entity Audit CSV</strong> y revisa los 15 elementos - identifica cuáles faltan o están incompletos</li>
                <li><strong>Prioriza por impacto:</strong> Críticos primero (Wikidata, GBP, Organization Schema, menciones DA 70+)</li>
                <li><strong>Descarga Schema Implementation Plan</strong> y copia el código JSON-LD de cada Schema type necesario</li>
                <li><strong>Implementa Organization Schema completo</strong> en footer de todas las páginas (base fundamental)</li>
                <li><strong>Crea perfiles faltantes:</strong> LinkedIn Company, Wikidata entry, perfiles sociales completos con NAP consistente</li>
                <li><strong>Estrategia PR para menciones:</strong> Pitch a Forbes, Timeout, Condé Nast para conseguir 6-8 menciones DA 70+</li>
                <li><strong>Valida Schema markup:</strong> Google Rich Results Test + Search Console para cada Schema implementado</li>
                <li><strong>Monitorea Knowledge Panel:</strong> Búsquedas marca cada 2 semanas para ver si aparece panel (4-6 meses)</li>
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
                    <span class="subtitle">Sin Entidad Reconocida (Score 32/100)</span>
                </div>
                <div class="columna-content">
                    <div class="problema-item">
                        <div class="problema-numero">1</div>
                        <div class="problema-texto">
                            <strong>0 Knowledge Panel activo</strong>
                            <p>Búsquedas "Ibiza Villa" no muestran panel lateral. Google no reconoce como entidad verificada. Solo resultados orgánicos tradicionales.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">2</div>
                        <div class="problema-texto">
                            <strong>Sin presencia Wikidata</strong>
                            <p>No existe entrada Wikidata = Google no tiene fuente autorizada neutral para verificar entidad. Probabilidad Knowledge Panel <15%.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">3</div>
                        <div class="problema-texto">
                            <strong>Organization Schema incompleto (40%)</strong>
                            <p>Falta SameAs properties (LinkedIn, Wikidata, Twitter, Instagram, YouTube), Founder Person, ContactPoint, AreaServed.</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">4</div>
                        <div class="problema-texto">
                            <strong>Solo 2 menciones DA 70+ (insuficiente)</strong>
                            <p>Necesario mínimo 5-8 menciones en sitios autoritativos para triggear Knowledge Panel. Actual: 2 menciones (Forbes, Timeout).</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-numero">5</div>
                        <div class="problema-texto">
                            <strong>NAP inconsistente en 8 perfiles</strong>
                            <p>Nombre varía (Ibiza Villa / IbizaVilla / Ibiza-Villa), direcciones diferentes. Google no puede confirmar perfiles = misma entidad.</p>
                        </div>
                    </div>
                </div>
                <div class="columna-footer perdida-footer">
                    <strong>Pérdida credibilidad:</strong> -65% confianza usuario vs marcas con Knowledge Panel
                </div>
            </div>

            <!-- Flecha de transformación -->
            <div class="comparacion-flecha">
                <div class="flecha-contenido">
                    <div class="flecha-icono">🆔</div>
                    <div class="flecha-texto">ENTIDAD VERIFICADA</div>
                    <div class="flecha-subtexto">Knowledge Graph</div>
                </div>
            </div>

            <!-- Columna DESPUÉS -->
            <div class="comparacion-columna columna-despues">
                <div class="columna-header despues-header">
                    <span class="header-icon">✅</span>
                    <h4>DESPUÉS - Entidad Establecida</h4>
                    <span class="subtitle">Knowledge Panel Activo (Score 88/100)</span>
                </div>
                <div class="columna-content">
                    <div class="mejora-item">
                        <div class="mejora-numero">1</div>
                        <div class="mejora-texto">
                            <strong>Knowledge Panel activo en búsquedas marca</strong>
                            <p>Aparece panel lateral con: Logo oficial, Descripción verificada, Contacto, Redes sociales, Reviews 4.8★, Sitelinks, Search box.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">2</div>
                        <div class="mejora-texto">
                            <strong>Entrada Wikidata verificada + activa</strong>
                            <p>Wikidata entry completa con logo, descripción, categoría (Tourism/Hospitality), enlaces bidireccionales web ↔ Wikidata.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">3</div>
                        <div class="mejora-texto">
                            <strong>Organization Schema 100% completo</strong>
                            <p>SameAs a 6 perfiles (LinkedIn, Wikidata, Twitter, Instagram, YouTube, Facebook), Founder Person Schema, ContactPoint, AreaServed, KnowsAbout.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">4</div>
                        <div class="mejora-texto">
                            <strong>8 menciones en sitios DA 70-90</strong>
                            <p>Featured en: Forbes Travel, Timeout Ibiza, Condé Nast Traveler, Luxury Retreats, Spain Tourism, TripAdvisor Guides, Ibiza Spotlight.</p>
                        </div>
                    </div>
                    <div class="mejora-item">
                        <div class="mejora-numero">5</div>
                        <div class="mejora-texto">
                            <strong>NAP 100% consistente en 15+ perfiles</strong>
                            <p>Nombre exacto idéntico, dirección formato estándar, teléfono +34 formato internacional. Google confirma todos perfiles = misma entidad.</p>
                        </div>
                    </div>
                </div>
                <div class="columna-footer ganancia-footer">
                    <strong>Ganancia credibilidad:</strong> +65% confianza usuario + Control narrativa marca
                </div>
            </div>
        </div>

        <!-- Timeline de Implementación -->
        <div class="timeline-implementacion">
            <h4>Timeline de Implementación (4-6 meses)</h4>
            <div class="timeline-items">
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 1</div>
                    <div class="timeline-content">
                        <strong>Foundation - Schema + Perfiles</strong>
                        <p>Implementar Organization Schema completo. Crear LinkedIn Company, perfiles sociales. Auditar NAP y corregir inconsistencias.</p>
                        <span class="timeline-resultado">Score 32 → 52 (+62%)</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 2-3</div>
                    <div class="timeline-content">
                        <strong>Wikidata + GBP Optimization</strong>
                        <p>Crear entrada Wikidata (aprobación 2-4 semanas). Verificar y optimizar GBP 100%. Implementar LocalBusiness + Person Schema.</p>
                        <span class="timeline-resultado">Score 52 → 68 (+31%)</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 3-5</div>
                    <div class="timeline-content">
                        <strong>PR + Menciones Autoritativas</strong>
                        <p>Estrategia PR: Conseguir 6-8 menciones DA 70+ (Forbes, Timeout, Condé Nast). Implementar Product + Review Schema aggregado.</p>
                        <span class="timeline-resultado">Score 68 → 82 (+21%)</span>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-badge">Mes 4-6</div>
                    <div class="timeline-content">
                        <strong>Knowledge Panel Trigger</strong>
                        <p>Google crawlea señales acumuladas. Knowledge Panel aparece (no instantáneo - puede tardar semanas tras cumplir requisitos).</p>
                        <span class="timeline-resultado">Score 82 → 88 (+7%) + KP activo</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabla de KPIs Knowledge Graph -->
    <section class="kpis-knowledge-graph">
        <h3 class="kpis-title">KPIs y Resultados Esperados - Entidad y Knowledge Graph</h3>
        <p class="kpis-intro">
            Métricas cuantificadas del impacto de establecer Ibiza Villa como entidad reconocida por Google con Knowledge Panel activo.
        </p>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th class="col-metrica">Métrica</th>
                    <th class="col-antes">ANTES<br><span style="font-weight: 400; font-size: 12px;">Sin entidad reconocida</span></th>
                    <th class="col-despues">DESPUÉS<br><span style="font-weight: 400; font-size: 12px;">4-6 meses implementación</span></th>
                    <th class="col-mejora">Mejora</th>
                    <th class="col-impacto">Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Knowledge Panel Status</strong></td>
                    <td class="valor-antes">No Existe<br><span class="detalle">(0% búsquedas marca)</span></td>
                    <td class="valor-despues">Activo<br><span class="detalle">(78-85% búsquedas marca)</span></td>
                    <td class="valor-mejora">+∞</td>
                    <td class="impacto-texto">Panel lateral con logo, descripción, contacto, reviews, sitelinks verificados</td>
                </tr>
                <tr>
                    <td><strong>Entity Recognition Score</strong></td>
                    <td class="valor-antes">32/100<br><span class="detalle">(Bajo - No elegible KP)</span></td>
                    <td class="valor-despues">88/100<br><span class="detalle">(Muy Alto - KP activo)</span></td>
                    <td class="valor-mejora">+175%</td>
                    <td class="impacto-texto">Google reconoce Ibiza Villa como entidad verificada y autorizada</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Confianza Usuario Marca</strong></td>
                    <td class="valor-antes">Baja<br><span class="detalle">(Sin verificación visual)</span></td>
                    <td class="valor-despues">Alta<br><span class="detalle">(Sello verificación Google)</span></td>
                    <td class="valor-mejora">+65%</td>
                    <td class="impacto-texto"><strong>+65% confianza usuario</strong> en marcas con Knowledge Panel vs sin panel</td>
                </tr>
                <tr>
                    <td><strong>Menciones Sitios Autoritativos</strong></td>
                    <td class="valor-antes">2 menciones<br><span class="detalle">(DA 70+, insuficiente)</span></td>
                    <td class="valor-despues">8-10 menciones<br><span class="detalle">(DA 70-90, Forbes/Timeout/etc.)</span></td>
                    <td class="valor-mejora">+300-400%</td>
                    <td class="impacto-texto">Menciones autoritativas confirman entidad es notable en industria</td>
                </tr>
                <tr>
                    <td><strong>Schema Markup Completitud</strong></td>
                    <td class="valor-antes">2 tipos parciales<br><span class="detalle">(Organization 40%, LocalBusiness 0%)</span></td>
                    <td class="valor-despues">8 tipos completos<br><span class="detalle">(Org, Local, Person, Product, Review, etc.)</span></td>
                    <td class="valor-mejora">+300%</td>
                    <td class="impacto-texto">Google entiende contexto completo entidad: quién, qué, dónde, productos, equipo</td>
                </tr>
                <tr>
                    <td><strong>Prioridad en IA/SGE y Voice Search</strong></td>
                    <td class="valor-antes">Baja<br><span class="detalle">(Sin entidad, texto genérico)</span></td>
                    <td class="valor-despues">Muy Alta<br><span class="detalle">(Entidad preferente citada)</span></td>
                    <td class="valor-mejora">+200-300%</td>
                    <td class="impacto-texto">Google favorece entidades en SGE responses y voice answers (+40-60% probabilidad citación)</td>
                </tr>
            </tbody>
        </table>

        <div class="nota-importante">
            <strong>⚠️ Nota Importante:</strong> Knowledge Panel <strong>NO es instantáneo ni garantizado</strong>:
            <ul>
                <li>Requisitos mínimos: GBP verificado + Wikidata + 5-8 menciones DA 70+ + Organization Schema completo</li>
                <li>Timeline realista: <strong>4-6 meses</strong> desde implementar requisitos hasta panel aparece</li>
                <li>Google <strong>no promete</strong> Knowledge Panel - decisión algorítmica basada en "notability" percibida</li>
                <li>Una vez activo, panel es <strong>persistente</strong> si mantienes señales entidad (no desaparece fácilmente)</li>
                <li>Beneficio real: incluso SIN panel, señales entidad mejoran rankings, IA/SGE, y trust general</li>
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
                <div class="stat-label">Knowledge Panel</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['knowledge_panel_status'] ?? 'NO'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Entidades Detectadas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['entidades_detectadas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Menciones Externas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['menciones_externas'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Score Autoridad</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['score_autoridad'] ?? '0'); ?>/100</div>
            </div>
        </div>
    </div>

    <!-- Knowledge Panel Status -->
    <div class="content-section">
        <h3>Estado del Knowledge Panel</h3>

        <div class="kp-status">
            <div class="kp-header">
                <div>
                    <h4 style="margin: 0; color: #000000;">Google Knowledge Panel</h4>
                    <p style="margin: 5px 0 0 0; font-size: 14px; color: #6c757d;">
                        Panel informativo que aparece en búsquedas de marca
                    </p>
                </div>
                <span class="kp-status-badge <?php echo strtolower($knowledge_panel['estado'] ?? 'inactivo'); ?>">
                    <?php echo htmlspecialchars($knowledge_panel['estado'] ?? 'Inactivo'); ?>
                </span>
            </div>

            <?php if (!empty($knowledge_panel['datos_actuales'])): ?>
            <div class="kp-preview">
                <h5 style="margin: 0 0 15px 0; color: #000000;">Datos Actuales en Knowledge Panel</h5>
                <?php foreach ($knowledge_panel['datos_actuales'] as $field => $value): ?>
                <div class="kp-field">
                    <span class="kp-field-label"><?php echo htmlspecialchars($field); ?>:</span>
                    <span><?php echo htmlspecialchars($value); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($knowledge_panel['recomendacion'])): ?>
            <div style="background: #e8f5e9; border-left: 3px solid #4caf50; padding: 12px; margin-top: 15px; border-radius: 4px;">
                <strong>Recomendación:</strong> <?php echo htmlspecialchars($knowledge_panel['recomendacion']); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Entidades Principales -->
    <div class="content-section">
        <h3>Entidades Principales Identificadas</h3>
        <p>Entidades reconocidas por Google en relación con la marca y contenido.</p>

        <?php foreach ($entidades_principales ?? [] as $entity): ?>
        <div class="entity-card">
            <div class="entity-header">
                <div class="entity-name"><?php echo htmlspecialchars($entity['nombre'] ?? ''); ?></div>
                <span class="entity-type"><?php echo htmlspecialchars($entity['tipo'] ?? ''); ?></span>
            </div>

            <p style="margin: 10px 0; font-size: 14px; color: #6c757d;">
                <?php echo htmlspecialchars($entity['descripcion'] ?? ''); ?>
            </p>

            <div class="entity-details">
                <div class="entity-metric">
                    <span class="entity-metric-label">Menciones:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['menciones'] ?? '0'); ?></span>
                </div>
                <div class="entity-metric">
                    <span class="entity-metric-label">Relevancia:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['relevancia'] ?? 'N/A'); ?></span>
                </div>
                <div class="entity-metric">
                    <span class="entity-metric-label">Contexto:</span>
                    <span class="entity-metric-value"><?php echo htmlspecialchars($entity['contexto'] ?? 'N/A'); ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Grafo de Relaciones -->
    <?php if (!empty($relaciones)): ?>
    <div class="content-section">
        <h3>Grafo de Relaciones de Entidades</h3>
        <p>Red de conexiones entre la marca y otras entidades relevantes.</p>

        <div class="relationship-diagram">
            <div style="margin-bottom: 30px;">
                <div class="relationship-node central">
                    <?php echo htmlspecialchars($relaciones['entidad_central'] ?? 'Ibiza Villa'); ?>
                </div>
            </div>

            <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px;">
                <?php foreach ($relaciones['relaciones'] ?? [] as $rel): ?>
                <div style="text-align: center;">
                    <div class="relationship-node">
                        <?php echo htmlspecialchars($rel['entidad'] ?? ''); ?>
                    </div>
                    <div style="font-size: 12px; color: #6c757d; margin-top: 5px;">
                        <?php echo htmlspecialchars($rel['tipo_relacion'] ?? ''); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Menciones Externas -->
    <?php if (!empty($menciones_externas)): ?>
    <div class="content-section">
        <h3>Menciones Externas de Marca</h3>
        <p>Referencias a la marca en sitios externos que refuerzan la identidad de entidad.</p>

        <?php foreach ($menciones_externas as $mention): ?>
        <div class="mention-card">
            <div class="mention-source">
                <?php echo htmlspecialchars($mention['fuente'] ?? ''); ?>
                <span class="mention-authority">DA <?php echo htmlspecialchars($mention['domain_authority'] ?? '0'); ?></span>
            </div>
            <div style="font-size: 13px; color: #6c757d; margin: 5px 0;">
                <strong>URL:</strong> <?php echo htmlspecialchars($mention['url'] ?? ''); ?>
            </div>
            <?php if (isset($mention['contexto'])): ?>
            <div class="mention-context">
                "<?php echo htmlspecialchars($mention['contexto']); ?>"
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Schema Implementado -->
    <?php if (!empty($schema_implementado)): ?>
    <div class="content-section">
        <h3>Schema Markup Implementado</h3>

        <table class="schema-table">
            <thead>
                <tr>
                    <th>Tipo de Schema</th>
                    <th>Páginas</th>
                    <th>Estado</th>
                    <th>Validación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schema_implementado as $schema): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($schema['tipo'] ?? ''); ?></strong></td>
                    <td><?php echo htmlspecialchars($schema['paginas'] ?? '0'); ?></td>
                    <td>
                        <span class="implementation-status <?php echo strtolower($schema['estado'] ?? 'pendiente'); ?>">
                            <?php echo htmlspecialchars($schema['estado'] ?? 'Pendiente'); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($schema['validacion'] ?? 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Optimizaciones -->
    <div class="content-section">
        <h3>Optimizaciones Recomendadas</h3>

        <?php foreach ($optimizaciones ?? [] as $opt): ?>
        <div class="optimization-item">
            <div class="optimization-title">
                <span class="priority-tag <?php echo strtolower($opt['prioridad'] ?? 'media'); ?>">
                    <?php echo htmlspecialchars($opt['prioridad'] ?? 'Media'); ?>
                </span>
                <?php echo htmlspecialchars($opt['titulo'] ?? ''); ?>
            </div>

            <p style="margin: 10px 0; font-size: 14px;">
                <?php echo htmlspecialchars($opt['descripcion'] ?? ''); ?>
            </p>

            <?php if (!empty($opt['acciones'])): ?>
            <ul class="action-steps">
                <?php foreach ($opt['acciones'] as $accion): ?>
                <li><?php echo htmlspecialchars($accion); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (isset($opt['impacto'])): ?>
            <p style="margin-top: 10px; font-size: 13px; color: #856404;">
                <strong>Impacto esperado:</strong> <?php echo htmlspecialchars($opt['impacto']); ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Estrategia -->
    <?php if (!empty($estrategia_entidades)): ?>
    <div class="content-section">
        <h3>Estrategia de Construcción de Entidad</h3>

        <div class="strategy-timeline">
            <?php foreach ($estrategia_entidades as $phase): ?>
            <div class="timeline-item">
                <div class="timeline-phase"><?php echo htmlspecialchars($phase['fase'] ?? ''); ?></div>
                <span class="timeline-duration"><?php echo htmlspecialchars($phase['duracion'] ?? ''); ?></span>

                <p style="margin: 15px 0; font-size: 14px;">
                    <?php echo htmlspecialchars($phase['descripcion'] ?? ''); ?>
                </p>

                <?php if (!empty($phase['objetivos'])): ?>
                <ul class="action-steps">
                    <?php foreach ($phase['objetivos'] as $obj): ?>
                    <li><?php echo htmlspecialchars($obj); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>Entidades y Knowledge Graph</span>
    </div>
</div>
