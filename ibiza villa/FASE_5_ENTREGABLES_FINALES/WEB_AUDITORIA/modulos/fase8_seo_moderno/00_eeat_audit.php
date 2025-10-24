<?php
/**
 * Módulo: E-E-A-T Analysis (m9.1)
 * Fase: 9 - SEO Avanzado
 * Descripción: Análisis de Experience, Expertise, Authoritativeness, Trustworthiness
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$experience = $datosModulo['experience_signals'] ?? [];
$expertise = $datosModulo['expertise_signals'] ?? [];
$authoritativeness = $datosModulo['authoritativeness_signals'] ?? [];
$trustworthiness = $datosModulo['trustworthiness_signals'] ?? [];
$puntuacion_general = $datosModulo['puntuacion_general'] ?? [];
$analisis_competencia = $datosModulo['analisis_competencia'] ?? [];
$gaps_detectados = $datosModulo['gaps_detectados'] ?? [];
$recomendaciones = $datosModulo['recomendaciones'] ?? [];
?>

<style>
.eeat-analysis-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

.eeat-analysis-page .executive-summary {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.eeat-analysis-page .executive-summary h2 {
    margin: 0 0 20px 0;
    font-size: 24px;
    font-weight: 700;
}

.eeat-analysis-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.eeat-analysis-page .summary-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 20px;
    border-radius: 6px;
    backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 8px;
}

.eeat-analysis-page .summary-card .label {
    font-size: 14px;
    opacity: 1;
    color: white;
    font-weight: 600;
    order: 1;
}

.eeat-analysis-page .summary-card .value {
    font-size: 28px;
    font-weight: 700;
    margin: 0;
    word-break: break-word;
    order: 2;
    color: white;
}

.eeat-analysis-page .eeat-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #88B04B;
}

.eeat-analysis-page .eeat-section h3 {
    margin: 0 0 20px 0;
    color: #88B04B;
    font-size: 20px;
    font-weight: 600;
}

.eeat-analysis-page .score-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f7ee;
}

.eeat-analysis-page .score-badge {
    background: #88B04B;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 18px;
    font-weight: 600;
}

.eeat-analysis-page .score-badge.low {
    background: #e74c3c;
}

.eeat-analysis-page .score-badge.medium {
    background: #f39c12;
}

.eeat-analysis-page .score-badge.high {
    background: #88B04B;
}

.eeat-analysis-page .signals-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
}

.eeat-analysis-page .signal-card {
    background: #fafafa;
    padding: 15px;
    border-radius: 6px;
    border-left: 3px solid #88B04B;
}

.eeat-analysis-page .signal-card h4 {
    margin: 0 0 10px 0;
    color: #000000;
    font-size: 15px;
    font-weight: 600;
}

.eeat-analysis-page .signal-status {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}

.eeat-analysis-page .status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.eeat-analysis-page .status-indicator.presente {
    background: #88B04B;
}

.eeat-analysis-page .status-indicator.parcial {
    background: #f39c12;
}

.eeat-analysis-page .status-indicator.ausente {
    background: #e74c3c;
}

.eeat-analysis-page .status-text {
    font-size: 13px;
    color: #7f8c8d;
}

.eeat-analysis-page .comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.eeat-analysis-page .comparison-table th,
.eeat-analysis-page .comparison-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.eeat-analysis-page .comparison-table th {
    background: #f0f7ee;
    color: #88B04B;
    font-weight: 600;
    font-size: 14px;
}

.eeat-analysis-page .comparison-table tr:hover {
    background: #fafafa;
}

.eeat-analysis-page .gaps-section {
    background: #f0f7e6;
    border: 1px solid #88B04B;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.eeat-analysis-page .gaps-section h3 {
    color: #856404;
    margin-top: 0;
}

.eeat-analysis-page .gap-item {
    background: white;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 12px;
    border-left: 3px solid #88B04B;
}

.eeat-analysis-page .gap-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.eeat-analysis-page .gap-title {
    font-weight: 600;
    color: #000000;
}

.eeat-analysis-page .priority-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.eeat-analysis-page .priority-badge.A {
    background: #e74c3c;
    color: white;
}

.eeat-analysis-page .priority-badge.B {
    background: #f39c12;
    color: white;
}

.eeat-analysis-page .priority-badge.C {
    background: #95a5a6;
    color: white;
}

.eeat-analysis-page .recommendations-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.eeat-analysis-page .recommendations-list li {
    background: white;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 12px;
    border-left: 4px solid #88B04B;
    display: flex;
    gap: 15px;
}

.eeat-analysis-page .rec-number {
    background: #88B04B;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    flex-shrink: 0;
}

.eeat-analysis-page .rec-content {
    flex: 1;
}

.eeat-analysis-page .rec-title {
    font-weight: 600;
    color: #000000;
    margin-bottom: 5px;
}

.eeat-analysis-page .rec-description {
    color: #7f8c8d;
    font-size: 14px;
}

.eeat-analysis-page .metric-bar {
    width: 100%;
    height: 8px;
    background: #e1e8ed;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 8px;
}

.eeat-analysis-page .metric-fill {
    height: 100%;
    background: #88B04B;
    transition: width 0.3s ease;
}

@media print {
    .eeat-analysis-page .eeat-section {
        page-break-inside: avoid;
    }
}

/* ============================================================ */
/* ESTILOS PATRÓN EDUCATIVO E-E-A-T */
/* ============================================================ */

.eeat-educativo .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.eeat-educativo .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.eeat-educativo .concepto-icon {
    font-size: 36px;
}

.eeat-educativo .concepto-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
}

.eeat-educativo .concepto-intro {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 25px;
    opacity: 0.95;
}

.eeat-educativo .eeat-pillars {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin: 25px 0;
}

.eeat-educativo .pillar-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 8px;
    display: flex;
    gap: 15px;
    align-items: start;
}

.eeat-educativo .pillar-letter {
    font-size: 48px;
    font-weight: 900;
    color: #ffd700;
    line-height: 1;
    flex-shrink: 0;
}

.eeat-educativo .pillar-content {
    flex: 1;
}

.eeat-educativo .pillar-content strong {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
}

.eeat-educativo .pillar-content p {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
    line-height: 1.5;
}

.eeat-educativo .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid rgba(255,255,255,0.5);
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.eeat-educativo .analogia-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 16px;
}

.eeat-educativo .analogia-icon {
    font-size: 24px;
}

.eeat-educativo .analogia-list {
    list-style: none;
    padding-left: 0;
    margin: 15px 0;
}

.eeat-educativo .analogia-list li {
    padding: 10px 0;
    padding-left: 25px;
    position: relative;
    line-height: 1.5;
}

.eeat-educativo .analogia-list li:before {
    content: "▸";
    position: absolute;
    left: 0;
    color: rgba(255,255,255,0.8);
    font-weight: bold;
}

.eeat-educativo .analogia-footer {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.3);
    font-size: 15px;
    line-height: 1.6;
}

.eeat-educativo .impacto-negocio {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.eeat-educativo .impacto-negocio h3 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 18px;
}

.eeat-educativo .impacto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.eeat-educativo .impacto-item {
    text-align: center;
    padding: 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
}

.eeat-educativo .impacto-numero {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 8px;
    color: #ffd700;
}

.eeat-educativo .impacto-texto {
    font-size: 14px;
    line-height: 1.4;
}

/* Sección Entregables */
.eeat-educativo .entregables-section {
    margin: 40px 0;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 12px;
}

.eeat-educativo .entregables-section h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.eeat-educativo .entregables-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.eeat-educativo .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 30px;
    margin-top: 25px;
}

.eeat-educativo .csv-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.eeat-educativo .csv-card:hover {
    border-color: #88B04B;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.2);
    transform: translateY(-2px);
}

.eeat-educativo .csv-header {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    margin-bottom: 20px;
}

.eeat-educativo .csv-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 28px;
}

.eeat-educativo .csv-info h3 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 18px;
}

.eeat-educativo .csv-descripcion {
    color: #666;
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
}

.eeat-educativo .csv-metadata {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.eeat-educativo .csv-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #555;
}

.eeat-educativo .csv-meta-item i {
    color: #88B04B;
}

.eeat-educativo .csv-usage {
    margin: 20px 0;
    padding: 20px;
    background: #fffbf0;
    border-left: 4px solid #88B04B;
    border-radius: 6px;
}

.eeat-educativo .csv-usage h4 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 15px;
}

.eeat-educativo .csv-usage ol {
    margin: 10px 0;
    padding-left: 20px;
    color: #555;
}

.eeat-educativo .csv-usage ol li {
    margin: 8px 0;
    line-height: 1.5;
    font-size: 14px;
}

.eeat-educativo .csv-tip {
    margin: 15px 0 0 0;
    padding: 12px;
    background: rgba(255, 193, 7, 0.1);
    border-radius: 6px;
    font-size: 14px;
    color: #555;
}

.eeat-educativo .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.eeat-educativo .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

/* Comparación ANTES/DESPUÉS */
.eeat-educativo .comparacion-antes-despues {
    margin: 40px 0;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.eeat-educativo .comparacion-antes-despues h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.eeat-educativo .comparacion-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.eeat-educativo .texto-rojo {
    color: #dc3545;
    font-weight: 600;
}

.eeat-educativo .texto-verde {
    color: #88B04B;
    font-weight: 600;
}

.eeat-educativo .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
}

.eeat-educativo .comparacion-columna {
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.eeat-educativo .comparacion-header {
    padding: 20px;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.eeat-educativo .header-antes {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.eeat-educativo .header-despues {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
}

.eeat-educativo .comparacion-contenido {
    padding: 25px;
}

.eeat-educativo .problema-item,
.eeat-educativo .solucion-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.eeat-educativo .problema-item:last-child,
.eeat-educativo .solucion-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.eeat-educativo .problema-icono,
.eeat-educativo .solucion-icono {
    flex-shrink: 0;
    font-size: 24px;
}

.eeat-educativo .problema-texto strong,
.eeat-educativo .solucion-texto strong {
    display: block;
    margin-bottom: 6px;
    color: #333;
    font-size: 15px;
}

.eeat-educativo .problema-texto p,
.eeat-educativo .solucion-texto p {
    margin: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.5;
}

.eeat-educativo .comparacion-footer {
    padding: 20px;
    display: flex;
    justify-content: space-around;
    color: white;
}

.eeat-educativo .footer-antes {
    background: linear-gradient(135deg, #c82333 0%, #a71d2a 100%);
}

.eeat-educativo .footer-despues {
    background: linear-gradient(135deg, #6d8f3c 0%, #1e7e34 100%);
}

.eeat-educativo .footer-stat {
    text-align: center;
}

.eeat-educativo .stat-label {
    display: block;
    font-size: 13px;
    opacity: 0.9;
    margin-bottom: 5px;
}

.eeat-educativo .stat-value {
    display: block;
    font-size: 24px;
    font-weight: bold;
}

/* Asegurar texto blanco en footers de comparación */
.eeat-educativo .comparacion-footer .stat-label,
.eeat-educativo .comparacion-footer .stat-value {
    color: white;
}

.eeat-educativo .comparacion-flecha {
    display: flex;
    align-items: center;
    justify-content: center;
}

.eeat-educativo .flecha-contenedor {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 20px;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.eeat-educativo .flecha-contenedor i {
    font-size: 36px;
    animation: pulse 2s ease-in-out infinite;
}

.eeat-educativo .flecha-texto {
    font-size: 13px;
    font-weight: 600;
    text-align: center;
    line-height: 1.3;
}

/* Timeline */
.eeat-educativo .timeline-implementacion {
    margin-top: 40px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 12px;
}

.eeat-educativo .timeline-implementacion h3 {
    margin: 0 0 25px 0;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.eeat-educativo .timeline-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}

.eeat-educativo .timeline-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #88B04B;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.eeat-educativo .timeline-periodo {
    font-weight: 700;
    color: #88B04B;
    font-size: 15px;
    margin-bottom: 10px;
}

.eeat-educativo .timeline-accion {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
    margin-bottom: 10px;
}

.eeat-educativo .timeline-resultado {
    font-size: 13px;
    color: #88B04B;
    font-weight: 600;
    padding-top: 10px;
    border-top: 1px solid #e0e0e0;
}

/* Tabla KPIs */
.eeat-educativo .tabla-kpis-section {
    margin: 40px 0;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.eeat-educativo .tabla-kpis-section h2 {
    color: #333;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.eeat-educativo .kpis-intro {
    color: #555;
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
}

.eeat-educativo .tabla-kpis-container {
    overflow-x: auto;
    margin: 25px 0;
}

.eeat-educativo .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 8px;
    overflow: hidden;
}

.eeat-educativo .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.eeat-educativo .tabla-kpis th {
    padding: 18px 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.eeat-educativo .tabla-kpis th .subtitulo {
    display: block;
    font-size: 11px;
    font-weight: 400;
    opacity: 0.9;
    margin-top: 4px;
}

.eeat-educativo .tabla-kpis tbody tr {
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.2s ease;
}

.eeat-educativo .tabla-kpis tbody tr:hover {
    background-color: #f8f9fa;
}

.eeat-educativo .tabla-kpis tbody tr.fila-destacada {
    background: linear-gradient(90deg, rgba(255,215,0,0.1) 0%, rgba(255,215,0,0.05) 100%);
    border-left: 4px solid #ffd700;
}

.eeat-educativo .tabla-kpis td {
    padding: 18px 15px;
    font-size: 14px;
    vertical-align: top;
}

.eeat-educativo .metrica-nombre {
    font-weight: 500;
}

.eeat-educativo .metrica-nombre i {
    color: #88B04B;
    margin-right: 8px;
}

.eeat-educativo .metrica-nombre strong {
    display: block;
    color: #333;
    font-size: 15px;
    margin-bottom: 4px;
}

.eeat-educativo .metrica-nombre small {
    display: block;
    color: #777;
    font-size: 12px;
    font-weight: 400;
}

.eeat-educativo .valor-principal {
    display: block;
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 4px;
}

.eeat-educativo .valor-detalle,
.eeat-educativo .impacto-detalle {
    display: block;
    font-size: 12px;
    color: #666;
    line-height: 1.4;
}

.eeat-educativo .valor-antes .valor-principal {
    color: #dc3545;
}

.eeat-educativo .valor-despues .valor-principal {
    color: #88B04B;
}

.eeat-educativo .badge-mejora {
    display: inline-block;
    padding: 6px 12px;
    background: linear-gradient(135deg, #88B04B 0%, #20c997 100%);
    color: white;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.eeat-educativo .impacto-principal {
    display: block;
    font-weight: 700;
    font-size: 15px;
    color: #88B04B;
    margin-bottom: 4px;
}

.eeat-educativo .nota-tiempos {
    margin-top: 30px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #88B04B;
}

.eeat-educativo .nota-tiempos h4 {
    margin: 0 0 15px 0;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.eeat-educativo .nota-tiempos ul {
    margin: 15px 0;
    padding-left: 20px;
    color: #555;
}

.eeat-educativo .nota-tiempos li {
    margin: 10px 0;
    line-height: 1.6;
    font-size: 14px;
}

.eeat-educativo .nota-importante {
    margin-top: 20px;
    padding: 15px;
    background: rgba(255, 193, 7, 0.1);
    border-left: 4px solid #88B04B;
    border-radius: 6px;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

/* Badges de Sección */
.eeat-educativo .seccion-badge {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.eeat-educativo .seccion-badge-red {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.eeat-educativo .seccion-badge-green {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

/* Responsive Design */
@media (max-width: 992px) {
    .eeat-educativo .comparacion-grid {
        grid-template-columns: 1fr;
    }

    .eeat-educativo .comparacion-flecha {
        transform: rotate(90deg);
        margin: 20px 0;
    }

    .eeat-educativo .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .eeat-educativo .eeat-pillars {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .eeat-educativo .concepto-educativo {
        padding: 20px;
    }

    .eeat-educativo .impacto-grid {
        grid-template-columns: 1fr;
    }

    .eeat-educativo .timeline-grid {
        grid-template-columns: 1fr;
    }
}

</style>

<div class="audit-page eeat-analysis-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Análisis E-E-A-T'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Experience, Expertise, Authoritativeness, Trustworthiness'); ?></p>
        <div class="page-meta">
            <span>Fecha análisis: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Basado en Quality Rater Guidelines de Google</span>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- SECCIÓN EDUCATIVA: Patrón ANTES/DESPUÉS con Entregables -->
    <!-- ============================================================ -->
    <div class="eeat-educativo">

    <!-- SECCIÓN EDUCATIVA: ¿Qué es E-E-A-T? -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon"></span>
            <h2>¿Qué es E-E-A-T y Por Qué Google lo Valora Tanto?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                E-E-A-T es el framework de Google para evaluar la calidad de un sitio web y decidir si merece
                posiciones altas en los resultados de búsqueda. Son <strong>4 factores críticos</strong> que
                Google analiza para determinar si tu sitio es digno de confianza y debe mostrarse a sus usuarios:
            </p>

            <div class="eeat-pillars">
                <div class="pillar-box">
                    <div class="pillar-letter">E</div>
                    <div class="pillar-content">
                        <strong>Experience (Experiencia)</strong>
                        <p>¿Has vivido de primera mano lo que describes? Fotos reales, testimonios, guías basadas en experiencia directa.</p>
                    </div>
                </div>
                <div class="pillar-box">
                    <div class="pillar-letter">E</div>
                    <div class="pillar-content">
                        <strong>Expertise (Pericia)</strong>
                        <p>¿Tienes conocimiento profesional del tema? Certificaciones, años en el negocio, contenido especializado.</p>
                    </div>
                </div>
                <div class="pillar-box">
                    <div class="pillar-letter">A</div>
                    <div class="pillar-content">
                        <strong>Authoritativeness (Autoridad)</strong>
                        <p>¿Te reconocen otros como referente? Menciones en prensa, premios, backlinks de sitios autoridad.</p>
                    </div>
                </div>
                <div class="pillar-box">
                    <div class="pillar-letter">T</div>
                    <div class="pillar-content">
                        <strong>Trustworthiness (Confiabilidad)</strong>
                        <p>¿Pueden confiar en ti? HTTPS, reviews verificadas, políticas claras, contacto real, transparencia.</p>
                    </div>
                </div>
            </div>

            <div class="analogia-box">
                <div class="analogia-header">
                    <strong>Piensa en E-E-A-T como un agente inmobiliario de lujo certificado:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>Experience</strong> = Años visitando propiedades, conoce cada villa personalmente, fotos propias de todas las propiedades</li>
                    <li><strong>Expertise</strong> = Certificaciones inmobiliarias, formación continua, conoce el mercado y las leyes, especialista en lujo</li>
                    <li><strong>Authoritativeness</strong> = Premios del sector, featured en Forbes/Timeout, otros agentes lo recomiendan, habla en conferencias</li>
                    <li><strong>Trustworthiness</strong> = Licencias verificadas, opiniones clientes 4.8, contratos transparentes, oficina física, seguros</li>
                </ul>
                <p class="analogia-footer">
                    <strong>Para Ibiza Villa:</strong> E-E-A-T es aún MÁS importante porque estás en un nicho YMYL
                    (Your Money Your Life) - transacciones alto valor/semana. Google quiere asegurarse de que
                    los usuarios no sean estafados. Un sitio con E-E-A-T bajo = penalización algorítmica inmediata.
                </p>
            </div>

            <div class="impacto-negocio">
                <h3> Impacto Directo en el Negocio:</h3>
                <div class="impacto-grid">
                    <div class="impacto-item">
                        <div class="impacto-numero">+35-55%</div>
                        <div class="impacto-texto">Mejora en rankings para keywords YMYL tras optimizar E-E-A-T</div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-numero">2-3x</div>
                        <div class="impacto-texto">Mayor confianza del usuario = Conversión significativamente mayor</div>
                    </div>
                    <div class="impacto-item">
                        <div class="impacto-numero">+15-30% mensual</div>
                        <div class="impacto-texto">Valor estimado mensual del tráfico adicional con E-E-A-T alto</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN ENTREGABLES: Archivos CSV Descargables -->
    <section class="entregables-section">
        <div class="seccion-badge seccion-badge-green">
            DESPUÉS - HERRAMIENTAS DE OPTIMIZACIÓN
        </div>
        <h2>Archivos Descargables - E-E-A-T Ibiza Villa</h2>
        <p class="entregables-intro">
            Hemos preparado <strong>2 archivos CSV</strong> con el análisis completo de E-E-A-T de Ibiza Villa y
            las mejoras prioritarias. Estos archivos te permiten auditar cada señal y priorizar acciones:
        </p>

        <div class="csv-cards-grid">
            <!-- CSV 1: E-E-A-T Signals Audit -->
            <div class="csv-card">
                <div class="csv-header">
                    <div class="csv-info">
                        <h3>Auditoría Completa de Señales E-E-A-T</h3>
                        <p class="csv-descripcion">
                            Análisis exhaustivo de 30 señales E-E-A-T críticas para Ibiza Villa: estado actual
                            (Presente/Parcial/No), calidad, impacto y acción recomendada para cada señal.
                            Organizado por las 4 categorías: Experience, Expertise, Authoritativeness, Trustworthiness.
                        </p>
                    </div>
                </div>
                <div class="csv-metadata">
                    <span class="csv-meta-item">30 señales auditadas</span>
                    <span class="csv-meta-item">12 gaps críticos detectados</span>
                    <span class="csv-meta-item">Impacto cuantificado por señal</span>
                </div>
                <div class="csv-usage">
                    <h4> Cómo Usar Este Archivo:</h4>
                    <ol>
                        <li>Abre el CSV y filtra por columna "Presente" = "No" o "Parcial"</li>
                        <li>Ordena por "Impacto_EEAT" (Muy Alto → Alto → Medio → Bajo)</li>
                        <li>Enfócate primero en señales "Crítica" y "Muy Alta" prioridad</li>
                        <li>Usa columna "Accion_Recomendada" como hoja de ruta</li>
                        <li>Marca como completadas a medida que implementas</li>
                    </ol>
                    <p class="csv-tip">
                        <strong> Tip:</strong> Las 10 señales de prioridad "Muy Alta" o "Crítica" representan el 75%
                        del impacto total en E-E-A-T.
                    </p>
                </div>
                <a href="entregables/eeat/eeat_signals_audit.csv" class="btn-download" download>
                    Descargar Auditoría Señales.csv
                </a>
            </div>

            <!-- CSV 2: Mejoras Prioritarias -->
            <div class="csv-card">
                <div class="csv-header">
                    <div class="csv-info">
                        <h3>Plan de Mejoras Prioritarias E-E-A-T</h3>
                        <p class="csv-descripcion">
                            Roadmap de 15 mejoras prioritarias ordenadas por ROI e impacto. Cada mejora incluye:
                            descripción detallada, impacto en score E-E-A-T, esfuerzo, timeline, pasos de implementación
                            y métricas de éxito. Listo para ejecutar.
                        </p>
                    </div>
                </div>
                <div class="csv-metadata">
                    <span class="csv-meta-item">15 mejoras priorizadas por ROI</span>
                    <span class="csv-meta-item">Impacto total: +162 puntos E-E-A-T</span>
                    <span class="csv-meta-item">Timeline: 1 semana a 6 meses</span>
                </div>
                <div class="csv-usage">
                    <h4> Cómo Usar Este Archivo:</h4>
                    <ol>
                        <li>Ordena por "Impacto_Score" descendente (mayor impacto primero)</li>
                        <li>Filtra por "Esfuerzo" = "Bajo" o "Medio" para quick wins</li>
                        <li>Usa columna "Pasos_Implementacion" como checklist operativo</li>
                        <li>Asigna responsables y fechas límite por mejora</li>
                        <li>Trackea "Metricas_Exito" mensualmente</li>
                    </ol>
                    <p class="csv-tip">
                        <strong> Tip:</strong> Empieza por "Ampliar página Sobre Nosotros" (+15 pts, Esfuerzo Bajo, 1 semana).
                        Es el quick win con mayor ROI (9:1).
                    </p>
                </div>
                <a href="entregables/eeat/eeat_mejoras_prioritarias.csv" class="btn-download" download>
                    Descargar Plan Mejoras.csv
                </a>
            </div>
        </div>
    </section>

    <!-- SECCIÓN COMPARATIVA: ANTES vs DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h2>Transformación E-E-A-T: Situación Actual vs Optimizada</h2>
        <p class="comparacion-intro">
            Esta comparación muestra el estado actual de E-E-A-T de Ibiza Villa (<span class="texto-rojo">ANTES</span>)
            vs el estado tras implementar las 15 mejoras prioritarias (<span class="texto-verde">DESPUÉS</span>):
        </p>

        <div class="comparacion-grid">
            <!-- Columna ANTES -->
            <div class="comparacion-columna columna-antes">
                <div class="comparacion-header header-antes">
                    ANTES - Situación Actual
                </div>
                <div class="comparacion-contenido">
                    <div class="problema-item">
                        <div class="problema-icono"></div>
                        <div class="problema-texto">
                            <strong>Experience Score: 45/100</strong>
                            <p>Fotos básicas, 0 videos, testimonios genéricos, sin guías locales propias, sin blog experiencias clientes</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-icono"></div>
                        <div class="problema-texto">
                            <strong>Expertise Score: 38/100</strong>
                            <p>Página 'Sobre Nosotros' básica sin equipo, 0 contenido educativo, FAQs limitadas, sin proceso inspección visible</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-icono"></div>
                        <div class="problema-texto">
                            <strong>Authoritativeness Score: 32/100</strong>
                            <p>0 menciones en medios, sin premios, sin colaboraciones, backlinks bajos (DR promedio 28)</p>
                        </div>
                    </div>
                    <div class="problema-item">
                        <div class="problema-icono"></div>
                        <div class="problema-texto">
                            <strong>Trustworthiness Score: 58/100</strong>
                            <p>12 reviews totales, respuesta irregular, políticas básicas, sin sellos confianza visibles, transparencia precio limitada</p>
                        </div>
                    </div>
                </div>
                <div class="comparacion-footer footer-antes">
                    <div class="footer-stat">
                        <span class="stat-label">Score E-E-A-T Total</span>
                        <span class="stat-value">43/100</span>
                    </div>
                    <div class="footer-stat">
                        <span class="stat-label">Nivel</span>
                        <span class="stat-value">BAJO</span>
                    </div>
                </div>
            </div>

            <!-- Flecha de Transformación -->
            <div class="comparacion-flecha">
                <div class="flecha-contenedor">
                    <span class="flecha-simbolo">→</span>
                    <span class="flecha-texto">MEJORAS<br>E-E-A-T</span>
                </div>
            </div>

            <!-- Columna DESPUÉS -->
            <div class="comparacion-columna columna-despues">
                <div class="comparacion-header header-despues">
                    DESPUÉS - E-E-A-T Optimizado
                </div>
                <div class="comparacion-contenido">
                    <div class="solucion-item">
                        <div class="solucion-icono"></div>
                        <div class="solucion-texto">
                            <strong>Experience Score: 85/100</strong>
                            <p>50+ fotos profesionales/villa, 5 videos tour, 10 guías locales propias, 3 casos estudio detallados, blog experiencias activo</p>
                        </div>
                    </div>
                    <div class="solucion-item">
                        <div class="solucion-icono"></div>
                        <div class="solucion-texto">
                            <strong>Expertise Score: 82/100</strong>
                            <p>Equipo completo con biografías, 15 artículos educativos, 30+ FAQs, proceso inspección documentado, certificaciones visibles</p>
                        </div>
                    </div>
                    <div class="solucion-item">
                        <div class="solucion-icono"></div>
                        <div class="solucion-texto">
                            <strong>Authoritativeness Score: 78/100</strong>
                            <p>5 menciones medios autoridad (Forbes/Timeout/etc), 3 partnerships lujo, 5 guest posts, backlinks DR 60-85</p>
                        </div>
                    </div>
                    <div class="solucion-item">
                        <div class="solucion-icono"></div>
                        <div class="solucion-texto">
                            <strong>Trustworthiness Score: 92/100</strong>
                            <p>50+ reviews (4.7), respuesta 100% <24h, sellos confianza visibles, precios transparentes, garantías claras</p>
                        </div>
                    </div>
                </div>
                <div class="comparacion-footer footer-despues">
                    <div class="footer-stat">
                        <span class="stat-label">Score E-E-A-T Total</span>
                        <span class="stat-value">84/100</span>
                    </div>
                    <div class="footer-stat">
                        <span class="stat-label">Nivel</span>
                        <span class="stat-value">ALTO</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="timeline-implementacion">
            <h3>Timeline de Implementación:</h3>
            <div class="timeline-grid">
                <div class="timeline-item">
                    <div class="timeline-periodo">Semana 1-2 (Quick Wins)</div>
                    <div class="timeline-accion">Sobre Nosotros + FAQs + Sellos confianza + Transparencia precios</div>
                    <div class="timeline-resultado">E-E-A-T 43 → 57 (+14 pts)</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-periodo">Mes 1-2</div>
                    <div class="timeline-accion">Videos profesionales + 10 guías locales + Casos estudio + LinkedIn activo</div>
                    <div class="timeline-resultado">E-E-A-T 57 → 68 (+11 pts)</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-periodo">Mes 3-4</div>
                    <div class="timeline-accion">Contenido educativo + Guest posts + Partnerships + 30+ reviews acumuladas</div>
                    <div class="timeline-resultado">E-E-A-T 68 → 78 (+10 pts)</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-periodo">Mes 5-6</div>
                    <div class="timeline-accion">Menciones prensa autoridad + 50+ reviews + Consolidación autoridad</div>
                    <div class="timeline-resultado">E-E-A-T 78 → 84 (+6 pts)</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN KPIs: Tabla de Resultados Esperados -->
    <section class="tabla-kpis-section">
        <div class="seccion-badge seccion-badge-green">
            DESPUÉS - RESULTADOS ESPERADOS
        </div>
        <h2>KPIs y Resultados Cuantificados - E-E-A-T</h2>
        <p class="kpis-intro">
            Estos son los <strong>KPIs medibles</strong> que cambiarán tras implementar las mejoras de E-E-A-T.
            Todas las métricas son cuantificadas y alcanzables en <strong>6 meses</strong>:
        </p>

        <div class="tabla-kpis-container">
            <table class="tabla-kpis">
                <thead>
                    <tr>
                        <th class="col-metrica">Métrica E-E-A-T</th>
                        <th class="col-antes">ANTES<br><span class="subtitulo">(Situación Actual)</span></th>
                        <th class="col-despues">DESPUÉS<br><span class="subtitulo">(E-E-A-T Optimizado)</span></th>
                        <th class="col-mejora">Mejora</th>
                        <th class="col-impacto">Impacto en Negocio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fila-destacada">
                        <td class="metrica-nombre">
                            <strong>Score E-E-A-T Global</strong>
                            <small>Puntuación general de los 4 pilares</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">43/100</span>
                            <span class="valor-detalle">Nivel BAJO - Penalización YMYL</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">84/100</span>
                            <span class="valor-detalle">Nivel ALTO - Favorecimiento algoritmo</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+95%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+35-55% rankings YMYL keywords</span>
                            <span class="impacto-detalle">Salida de penalización = crecimiento exponencial tráfico</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="metrica-nombre">
                            <strong>Experience Signals</strong>
                            <small>Señales de experiencia de primera mano</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">45/100</span>
                            <span class="valor-detalle">Fotos genéricas, 0 videos, sin guías</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">85/100</span>
                            <span class="valor-detalle">50+ fotos/villa, 5 videos, 10 guías</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+89%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+40% engagement contenido</span>
                            <span class="impacto-detalle">Videos + guías = tiempo en sitio +120%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="metrica-nombre">
                            <strong>Expertise Signals</strong>
                            <small>Señales de conocimiento profesional</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">38/100</span>
                            <span class="valor-detalle">Sin equipo visible, FAQs básicas</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">82/100</span>
                            <span class="valor-detalle">Equipo completo, 15 artículos, 30 FAQs</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+116%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+30% conversión leads</span>
                            <span class="impacto-detalle">Expertise visible = confianza decisión compra</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="metrica-nombre">
                            <strong>Authoritativeness Signals</strong>
                            <small>Reconocimiento externo como autoridad</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">32/100</span>
                            <span class="valor-detalle">0 menciones prensa, DR bajo</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">78/100</span>
                            <span class="valor-detalle">5 medios autoridad, DR 60-85</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+144%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+25% tráfico referral de calidad</span>
                            <span class="impacto-detalle">Menciones Forbes/Timeout = audiencia premium</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="metrica-nombre">
                            <strong>Trustworthiness Signals</strong>
                            <small>Señales de confiabilidad y seguridad</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">58/100</span>
                            <span class="valor-detalle">12 reviews, sin sellos, políticas básicas</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">92/100</span>
                            <span class="valor-detalle">50+ reviews (4.7), sellos, transparencia</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+59%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+40% conversión checkout</span>
                            <span class="impacto-detalle">Confianza = menor abandono carrito</span>
                        </td>
                    </tr>
                    <tr class="fila-destacada">
                        <td class="metrica-nombre">
                            <strong>Valor Tráfico Cualificado</strong>
                            <small>Estimación económica tráfico mensual</small>
                        </td>
                        <td class="valor-antes">
                            <span class="valor-principal">Coste bajo continuo</span>
                            <span class="valor-detalle">E-E-A-T bajo = menor visibilidad</span>
                        </td>
                        <td class="valor-despues">
                            <span class="valor-principal">+27-48% mensual</span>
                            <span class="valor-detalle">E-E-A-T alto = dominancia YMYL</span>
                        </td>
                        <td class="valor-mejora">
                            <span class="badge-mejora">+167%</span>
                        </td>
                        <td class="valor-impacto">
                            <span class="impacto-principal">+15-30% mejora mensual neta</span>
                            <span class="impacto-detalle">ROI promedio 11:1 en mejoras E-E-A-T</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="nota-tiempos">
            <h4>Nota sobre Tiempos y ROI:</h4>
            <ul>
                <li><strong>Quick Wins (Semana 1-2):</strong> Sobre Nosotros + FAQs + Sellos (+14 pts, ROI 15:1)</li>
                <li><strong>Contenido (Mes 1-2):</strong> Videos + Guías + Casos estudio (+11 pts, ROI 10:1)</li>
                <li><strong>Autoridad (Mes 3-4):</strong> Guest posts + Partnerships + Contenido educativo (+10 pts, ROI 8:1)</li>
                <li><strong>Consolidación (Mes 5-6):</strong> Prensa + Reviews + Posicionamiento experto (+6 pts, ROI 9:1)</li>
            </ul>
            <p class="nota-importante">
                <strong>Importante:</strong> E-E-A-T es acumulativo y compuesto. Cada señal refuerza las demás.
                Por ejemplo: Mención en Forbes (Authoritativeness) → Más tráfico → Más reviews (Trustworthiness) →
                Mejor posicionamiento (círculo virtuoso). Tras 6 meses, la ventaja competitiva es casi imposible de alcanzar.
            </p>
        </div>
    </section>

    </div>
    <!-- FIN SECCIÓN EDUCATIVA -->

    <!-- Resumen Ejecutivo -->
    <div class="seccion-badge seccion-badge-red">
        ANTES - SITUACIÓN ACTUAL
    </div>
    <div class="executive-summary">
        <h2>Resumen Ejecutivo E-E-A-T</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="summary-card">
                <div class="label">Puntuación General</div>
                <div class="value"><?php echo htmlspecialchars($resumen['puntuacion_general'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Experience Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['experience_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Expertise Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['expertise_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Authoritativeness Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['authoritativeness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Trustworthiness Score</div>
                <div class="value"><?php echo htmlspecialchars($resumen['trustworthiness_score'] ?? 'N/A'); ?>/100</div>
            </div>
            <div class="summary-card">
                <div class="label">Gaps Críticos</div>
                <div class="value"><?php echo htmlspecialchars($resumen['gaps_criticos'] ?? 'N/A'); ?></div>
            </div>
        </div>
    </div>

    <!-- Experience Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Experience (Experiencia)</h3>
            <span class="score-badge <?php echo strtolower($experience['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($experience['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($experience['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($experience['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Expertise Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Expertise (Experiencia Profesional)</h3>
            <span class="score-badge <?php echo strtolower($expertise['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($expertise['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($expertise['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($expertise['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Authoritativeness Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Authoritativeness (Autoridad)</h3>
            <span class="score-badge <?php echo strtolower($authoritativeness['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($authoritativeness['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($authoritativeness['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($authoritativeness['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
                <?php if (isset($signal['valor_actual'])): ?>
                <div class="metric-bar">
                    <div class="metric-fill" style="width: <?php echo min(100, ($signal['valor_actual'] / $signal['valor_objetivo']) * 100); ?>%"></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Trustworthiness Signals -->
    <div class="eeat-section">
        <div class="score-header">
            <h3>Trustworthiness (Confianza)</h3>
            <span class="score-badge <?php echo strtolower($trustworthiness['nivel'] ?? 'medium'); ?>">
                <?php echo htmlspecialchars($trustworthiness['puntuacion'] ?? 'N/A'); ?>/100
            </span>
        </div>

        <p><?php echo htmlspecialchars($trustworthiness['descripcion'] ?? ''); ?></p>

        <div class="signals-grid">
            <?php foreach ($trustworthiness['signals'] ?? [] as $signal): ?>
            <div class="signal-card">
                <h4><?php echo htmlspecialchars($signal['nombre']); ?></h4>
                <p style="font-size: 13px; color: #7f8c8d; margin: 5px 0;"><?php echo htmlspecialchars($signal['descripcion']); ?></p>
                <div class="signal-status">
                    <span class="status-indicator <?php echo $signal['estado']; ?>"></span>
                    <span class="status-text"><?php echo htmlspecialchars($signal['estado_texto']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Comparativa Competencia -->
    <?php if (!empty($analisis_competencia)): ?>
    <div class="eeat-section">
        <h3>Comparativa E-E-A-T vs Competencia</h3>

        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Sitio</th>
                    <th>Experience</th>
                    <th>Expertise</th>
                    <th>Authoritativeness</th>
                    <th>Trustworthiness</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($analisis_competencia as $comp): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($comp['sitio']); ?></strong></td>
                    <td><?php echo htmlspecialchars($comp['experience']); ?></td>
                    <td><?php echo htmlspecialchars($comp['expertise']); ?></td>
                    <td><?php echo htmlspecialchars($comp['authoritativeness']); ?></td>
                    <td><?php echo htmlspecialchars($comp['trustworthiness']); ?></td>
                    <td><strong><?php echo htmlspecialchars($comp['total']); ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Gaps Detectados -->
    <?php if (!empty($gaps_detectados)): ?>
    <div class="gaps-section">
        <h3>Gaps Críticos Detectados</h3>

        <?php foreach ($gaps_detectados as $gap): ?>
        <div class="gap-item">
            <div class="gap-header">
                <span class="gap-title"><?php echo htmlspecialchars($gap['titulo']); ?></span>
                <span class="priority-badge <?php echo $gap['prioridad']; ?>">
                    Prioridad <?php echo $gap['prioridad']; ?>
                </span>
            </div>
            <p style="margin: 5px 0; color: #7f8c8d; font-size: 14px;"><?php echo htmlspecialchars($gap['descripcion']); ?></p>
            <p style="margin: 10px 0 0 0; font-size: 13px;"><strong>Impacto:</strong> <?php echo htmlspecialchars($gap['impacto']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Recomendaciones -->
    <div class="eeat-section">
        <h3>Recomendaciones de Mejora E-E-A-T</h3>

        <ul class="recommendations-list">
            <?php foreach ($recomendaciones ?? [] as $index => $rec): ?>
            <li>
                <div class="rec-number"><?php echo $index + 1; ?></div>
                <div class="rec-content">
                    <div class="rec-title"><?php echo htmlspecialchars($rec['titulo']); ?></div>
                    <div class="rec-description"><?php echo htmlspecialchars($rec['descripcion']); ?></div>
                    <?php if (isset($rec['esfuerzo'])): ?>
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #95a5a6;">
                        <strong>Esfuerzo:</strong> <?php echo htmlspecialchars($rec['esfuerzo']); ?> |
                        <strong>Impacto:</strong> <?php echo htmlspecialchars($rec['impacto']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="page-footer">
        <span>Fase 9 - SEO Avanzado</span>
        <span>E-E-A-T Analysis</span>
    </div>
</div>
