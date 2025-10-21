<?php
/**
 * Módulo: Monitoreo de Algoritmo (m9.7)
 * Fase: 9 - SEO Moderno
 * Descripción: Sistema de monitoreo de updates algorítmicos y playbook de recuperación
 *
 * Basado en INSTRUCCIONES_MODULOS_AUDITORIA.md - Fase 9
 */

$resumen = $datosModulo['resumen_ejecutivo'] ?? [];
$historial_updates = $datosModulo['historial_updates'] ?? [];
$impacto_actual = $datosModulo['impacto_actual'] ?? [];
$metricas_monitorizadas = $datosModulo['metricas_monitorizadas'] ?? [];
$alertas_configuradas = $datosModulo['alertas_configuradas'] ?? [];
$playbook_recuperacion = $datosModulo['playbook_recuperacion'] ?? [];
$calendario_updates = $datosModulo['calendario_updates'] ?? [];
?>

<style>
.monitoreo-page {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #000000;
    line-height: 1.6;
}

.monitoreo-page .executive-summary {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.monitoreo-page .executive-summary h2 {
    margin: 0 0 15px 0;
    font-size: 24px;
    font-weight: 700;
}

.monitoreo-page .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.monitoreo-page .stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 15px;
    border-radius: 6px;
    text-align: center;
}

.monitoreo-page .stat-value {
    font-size: 32px;
    font-weight: 700;
    margin: 5px 0;
}

.monitoreo-page .stat-label {
    font-size: 12px;
    opacity: 0.9;
}

.monitoreo-page .content-section {
    background: white;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid #ff6b6b;
}

.monitoreo-page .content-section h3 {
    margin: 0 0 20px 0;
    color: #ff6b6b;
    font-size: 20px;
    font-weight: 600;
}

.monitoreo-page .update-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 15px;
    border-left: 4px solid #ff6b6b;
}

.monitoreo-page .update-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 12px;
}

.monitoreo-page .update-name {
    font-weight: 600;
    color: #000000;
    font-size: 18px;
}

.monitoreo-page .update-date {
    font-size: 13px;
    color: #6c757d;
}

.monitoreo-page .impact-badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin-top: 5px;
}

.monitoreo-page .impact-badge.positivo {
    background: #d4edda;
    color: #155724;
}

.monitoreo-page .impact-badge.negativo {
    background: #f8d7da;
    color: #721c24;
}

.monitoreo-page .impact-badge.neutro {
    background: #d1ecf1;
    color: #0c5460;
}

.monitoreo-page .impact-details {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 12px;
    margin-top: 10px;
    font-size: 14px;
}

.monitoreo-page .metric-row {
    display: flex;
    justify-content: space-between;
    margin: 8px 0;
    font-size: 13px;
}

.monitoreo-page .metric-label {
    color: #6c757d;
}

.monitoreo-page .metric-value {
    font-weight: 600;
    color: #000000;
}

.monitoreo-page .metric-value.negative {
    color: #dc3545;
}

.monitoreo-page .metric-value.positive {
    color: #88B04B;
}

.monitoreo-page .current-impact {
    background: linear-gradient(135deg, #f0f7e6 0%, #ffe8cc 100%);
    border: 2px solid #88B04B;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.monitoreo-page .impact-status {
    font-size: 20px;
    font-weight: 700;
    color: #000000;
    margin-bottom: 15px;
}

.monitoreo-page .monitoring-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.monitoreo-page .monitoring-table th,
.monitoreo-page .monitoring-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e1e8ed;
}

.monitoreo-page .monitoring-table th {
    background: #fff0f0;
    color: #ff6b6b;
    font-weight: 600;
    font-size: 14px;
}

.monitoreo-page .monitoring-table tr:hover {
    background: #fafafa;
}

.monitoreo-page .frequency-badge {
    padding: 3px 10px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

.monitoreo-page .frequency-badge.diaria {
    background: #dc3545;
    color: white;
}

.monitoreo-page .frequency-badge.semanal {
    background: #88B04B;
    color: #333;
}

.monitoreo-page .frequency-badge.mensual {
    background: #6c757d;
    color: white;
}

.monitoreo-page .alert-card {
    background: white;
    border: 1px solid #dee2e6;
    border-left: 4px solid #ff6b6b;
    border-radius: 6px;
    padding: 18px;
    margin-bottom: 12px;
}

.monitoreo-page .alert-trigger {
    font-weight: 600;
    color: #000000;
    margin-bottom: 8px;
}

.monitoreo-page .alert-action {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 4px;
    margin-top: 8px;
    font-size: 13px;
}

.monitoreo-page .playbook-section {
    background: #e8f5e9;
    border: 2px solid #4caf50;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 20px;
}

.monitoreo-page .playbook-title {
    color: #000000;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
}

.monitoreo-page .playbook-steps {
    counter-reset: step-counter;
    list-style: none;
    padding: 0;
}

.monitoreo-page .playbook-steps li {
    counter-increment: step-counter;
    position: relative;
    padding-left: 45px;
    margin-bottom: 20px;
}

.monitoreo-page .playbook-steps li::before {
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 0;
    background: #4caf50;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.monitoreo-page .step-title {
    font-weight: 600;
    color: #000000;
    margin-bottom: 5px;
}

.monitoreo-page .step-description {
    color: #6c757d;
    font-size: 14px;
}

.monitoreo-page .calendar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.monitoreo-page .calendar-month {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 6px;
    padding: 15px;
}

.monitoreo-page .month-name {
    font-weight: 600;
    color: #ff6b6b;
    font-size: 16px;
    margin-bottom: 12px;
    text-align: center;
}

.monitoreo-page .expected-updates {
    font-size: 13px;
}

.monitoreo-page .update-item {
    background: #f8f9fa;
    padding: 8px;
    border-radius: 4px;
    margin: 6px 0;
    font-size: 12px;
}

@media print {
    .monitoreo-page .content-section {
        page-break-inside: avoid;
    }
}

/* ============================================
   ESTILOS PATRÓN EDUCATIVO ANTES/DESPUÉS
   ============================================ */

/* Sección Educativa */
.monitoreo-page .concepto-educativo {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
}

.monitoreo-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.monitoreo-page .concepto-icon {
    font-size: 42px;
}

.monitoreo-page .concepto-header h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
}

.monitoreo-page .concepto-intro {
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 25px;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 8px;
    backdrop-filter: blur(10px);
}

.monitoreo-page .analogia-box {
    background: rgba(255, 255, 255, 0.15);
    padding: 25px;
    border-radius: 10px;
    margin-top: 20px;
    backdrop-filter: blur(10px);
}

.monitoreo-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 18px;
}

.monitoreo-page .analogia-icon {
    font-size: 28px;
}

.monitoreo-page .analogia-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.monitoreo-page .analogia-list li {
    padding: 10px 0;
    padding-left: 25px;
    position: relative;
    font-size: 15px;
    line-height: 1.6;
}

.monitoreo-page .analogia-list li::before {
    content: "";
    position: absolute;
    left: 0;
}

.monitoreo-page .impacto-negocio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.monitoreo-page .impacto-item {
    background: rgba(255, 255, 255, 0.12);
    padding: 20px;
    border-radius: 10px;
    display: flex;
    align-items: start;
    gap: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.monitoreo-page .impacto-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.monitoreo-page .impacto-icon {
    font-size: 42px;
    flex-shrink: 0;
}

.monitoreo-page .impacto-text strong {
    display: block;
    font-size: 17px;
    margin-bottom: 8px;
}

.monitoreo-page .impacto-text p {
    font-size: 14px;
    margin: 0;
    line-height: 1.6;
    opacity: 0.95;
}

/* Entregables CSV */
.monitoreo-page .entregables-csv {
    background: #f8f9fa;
    padding: 35px;
    border-radius: 12px;
    margin-bottom: 40px;
    border: 1px solid #e1e8ed;
}

.monitoreo-page .section-title-download {
    color: #000000;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 15px 0;
}

.monitoreo-page .section-description {
    color: #6c757d;
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 30px;
}

.monitoreo-page .csv-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.monitoreo-page .csv-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.monitoreo-page .csv-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    border-color: #88B04B;
}

.monitoreo-page .csv-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-bottom: 2px solid #e1e8ed;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.monitoreo-page .csv-icon {
    font-size: 32px;
    margin-right: 12px;
}

.monitoreo-page .csv-card-header h3 {
    font-size: 20px;
    color: #000000;
    margin: 0;
    flex: 1;
    display: flex;
    align-items: center;
}

.monitoreo-page .csv-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.monitoreo-page .csv-badge.muy-alta {
    background: linear-gradient(135deg, #ff9800 0%, #ff6b00 100%);
    color: white;
}

.monitoreo-page .csv-badge.critica {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.monitoreo-page .csv-card-body {
    padding: 25px;
}

.monitoreo-page .csv-description {
    color: #495057;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 18px;
}

.monitoreo-page .csv-highlights {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.monitoreo-page .csv-highlights li {
    padding: 8px 0;
    padding-left: 22px;
    position: relative;
    font-size: 14px;
    color: #495057;
    line-height: 1.6;
}

.monitoreo-page .csv-highlights li::before {
    content: "";
    position: absolute;
    left: 0;
    color: #88B04B;
    font-weight: 700;
}

.monitoreo-page .csv-metadata {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
    font-size: 13px;
    color: #6c757d;
}

.monitoreo-page .csv-metadata span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.monitoreo-page .btn-download {
    display: inline-block;
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.monitoreo-page .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.monitoreo-page .instrucciones-uso {
    background: white;
    padding: 25px;
    border-radius: 10px;
    border-left: 4px solid #88B04B;
}

.monitoreo-page .instrucciones-uso h4 {
    color: #000000;
    font-size: 18px;
    margin: 0 0 15px 0;
}

.monitoreo-page .instrucciones-list {
    margin: 0;
    padding-left: 20px;
}

.monitoreo-page .instrucciones-list li {
    margin: 10px 0;
    font-size: 14px;
    line-height: 1.7;
    color: #495057;
}

/* Comparación ANTES/DESPUÉS */
.monitoreo-page .comparacion-antes-despues {
    margin-bottom: 40px;
}

.monitoreo-page .section-title-comparison {
    color: #000000;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 20px 0;
}

.monitoreo-page .comparacion-intro {
    background: #f0f7e6;
    border-left: 4px solid #88B04B;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.monitoreo-page .comparacion-intro p {
    margin: 0;
    color: #495057;
    font-size: 15px;
    line-height: 1.7;
}

.monitoreo-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: start;
    margin-bottom: 40px;
}

.monitoreo-page .comparacion-columna {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 25px;
}

.monitoreo-page .comparacion-columna.antes {
    border-color: #dc3545;
}

.monitoreo-page .comparacion-columna.despues {
    border-color: #88B04B;
}

.monitoreo-page .badge-seccion {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.monitoreo-page .antes-badge {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
}

.monitoreo-page .despues-badge {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.monitoreo-page .comparacion-columna h3 {
    color: #000000;
    font-size: 20px;
    margin: 0 0 20px 0;
}

.monitoreo-page .problema-item,
.monitoreo-page .solucion-item {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 8px;
    display: flex;
    gap: 15px;
    align-items: start;
}

.monitoreo-page .problema-item {
    background: #fff5f5;
    border-left: 4px solid #dc3545;
}

.monitoreo-page .solucion-item {
    background: #f0f9f4;
    border-left: 4px solid #88B04B;
}

.monitoreo-page .problema-numero,
.monitoreo-page .solucion-numero {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.monitoreo-page .problema-numero {
    background: #dc3545;
    color: white;
}

.monitoreo-page .solucion-numero {
    background: #88B04B;
    color: white;
    font-size: 20px;
}

.monitoreo-page .problema-content strong,
.monitoreo-page .solucion-content strong {
    display: block;
    color: #000000;
    font-size: 15px;
    margin-bottom: 6px;
}

.monitoreo-page .problema-content p,
.monitoreo-page .solucion-content p {
    margin: 0;
    font-size: 14px;
    color: #6c757d;
    line-height: 1.6;
}

.monitoreo-page .comparacion-flecha {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 20px 0;
}

.monitoreo-page .flecha-icon {
    font-size: 48px;
    animation: pulse 2s ease-in-out infinite;
}

.monitoreo-page .flecha-text {
    font-weight: 700;
    font-size: 14px;
    color: #88B04B;
    text-align: center;
    line-height: 1.4;
    text-transform: uppercase;
    letter-spacing: 1px;
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

.monitoreo-page .timeline-implementacion {
    background: white;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #e1e8ed;
}

.monitoreo-page .timeline-implementacion h4 {
    color: #000000;
    font-size: 20px;
    margin: 0 0 25px 0;
}

.monitoreo-page .timeline-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
}

.monitoreo-page .timeline-fase {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #88B04B;
}

.monitoreo-page .fase-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.monitoreo-page .fase-badge.fase-1 {
    background: #e3f2fd;
    color: #1976d2;
}

.monitoreo-page .fase-badge.fase-2 {
    background: #f3e5f5;
    color: #7b1fa2;
}

.monitoreo-page .fase-badge.fase-3 {
    background: #fff3e0;
    color: #f57c00;
}

.monitoreo-page .fase-badge.fase-4 {
    background: #e8f5e9;
    color: #388e3c;
}

.monitoreo-page .timeline-fase h5 {
    color: #000000;
    font-size: 16px;
    margin: 0 0 10px 0;
}

.monitoreo-page .timeline-fase p {
    font-size: 13px;
    color: #6c757d;
    line-height: 1.6;
    margin: 0 0 12px 0;
}

.monitoreo-page .resultado-fase {
    display: block;
    font-size: 12px;
    color: #88B04B;
    font-weight: 600;
    margin-top: 10px;
}

/* KPIs */
.monitoreo-page .kpis-section {
    margin-bottom: 40px;
}

.monitoreo-page .section-title-kpis {
    color: #000000;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 20px 0;
}

.monitoreo-page .kpis-intro {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.monitoreo-page .kpis-intro p {
    margin: 0;
    color: #495057;
    font-size: 15px;
    line-height: 1.7;
}

.monitoreo-page .tabla-kpis {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 25px;
}

.monitoreo-page .tabla-kpis thead {
    background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%);
    color: white;
}

.monitoreo-page .tabla-kpis th {
    padding: 16px 14px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.monitoreo-page .tabla-kpis td {
    padding: 14px;
    border-bottom: 1px solid #e1e8ed;
    font-size: 14px;
    color: #495057;
}

.monitoreo-page .tabla-kpis tbody tr:hover {
    background: #f8f9fa;
}

.monitoreo-page .tabla-kpis tbody tr:last-child td {
    border-bottom: none;
}

.monitoreo-page .tabla-kpis .fila-destacada {
    background: #f0f7e6;
}

.monitoreo-page .tabla-kpis .fila-destacada td {
    border-top: 2px solid #ffd700;
    border-bottom: 2px solid #ffd700;
    font-weight: 600;
}

.monitoreo-page .tabla-kpis .mejora-positiva {
    color: #88B04B;
    font-weight: 600;
}

.monitoreo-page .kpis-nota-importante {
    background: linear-gradient(135deg, #f0f7e6 0%, #ffe8cc 100%);
    border: 2px solid #88B04B;
    border-radius: 10px;
    padding: 25px;
}

.monitoreo-page .kpis-nota-importante h4 {
    color: #000000;
    font-size: 18px;
    margin: 0 0 15px 0;
}

.monitoreo-page .kpis-nota-importante p {
    margin: 0;
    color: #495057;
    font-size: 14px;
    line-height: 1.7;
}

/* Responsive */
@media (max-width: 992px) {
    .monitoreo-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .monitoreo-page .comparacion-flecha {
        transform: rotate(90deg);
        padding: 15px 0;
    }

    .monitoreo-page .csv-cards-grid {
        grid-template-columns: 1fr;
    }

    .monitoreo-page .impacto-negocio-grid {
        grid-template-columns: 1fr;
    }

    .monitoreo-page .timeline-grid {
        grid-template-columns: 1fr;
    }

    .monitoreo-page .tabla-kpis {
        font-size: 12px;
    }

    .monitoreo-page .tabla-kpis th,
    .monitoreo-page .tabla-kpis td {
        padding: 10px 8px;
    }
}

@media (max-width: 576px) {
    .monitoreo-page .concepto-educativo {
        padding: 20px;
    }

    .monitoreo-page .entregables-csv {
        padding: 20px;
    }

    .monitoreo-page .comparacion-columna {
        padding: 18px;
    }

    .monitoreo-page .tabla-kpis {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>

<div class="audit-page monitoreo-page">
    <div class="page-header">
        <h1 class="page-title">
            <?php echo htmlspecialchars($datosModulo['titulo'] ?? 'Monitoreo de Algoritmo'); ?>
        </h1>
        <p class="page-subtitle"><?php echo htmlspecialchars($datosModulo['subtitulo'] ?? 'Sistema de alertas y playbook de recuperación'); ?></p>
        <div class="page-meta">
            <span>Última actualización: <?php echo htmlspecialchars($datosModulo['fecha_analisis'] ?? date('d/m/Y')); ?></span>
            <span>Estado: Monitoreo activo</span>
        </div>
    </div>

    <!-- Sección Educativa -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon"></span>
            <h2>¿Qué es el Monitoreo de Algoritmo y Por Qué es Crítico para Ibiza Villa?</h2>
        </div>
        <div class="concepto-content">
            <p class="concepto-intro">
                El <strong>Monitoreo de Algoritmo</strong> es el sistema que detecta <strong>actualizaciones del algoritmo de Google</strong>
                (Core Updates, Helpful Content, Spam Updates, etc.) y <strong>su impacto en tus rankings y tráfico</strong>. Google
                lanza <strong>4-6 Core Updates al año</strong> que pueden causar caídas dramáticas de tráfico (-20-50%) en cuestión de días
                si tu sitio tiene vulnerabilidades. Un sistema de monitoreo robusto + playbook de recuperación puede reducir el
                <strong>tiempo de recuperación de 120 días a 30-45 días</strong>.
            </p>
            <div class="analogia-box">
                <div class="analogia-header">
                    
                    <strong>Piensa en el Monitoreo de Algoritmo como un Sistema de Alerta Temprana de Terremotos:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>Google Algorithm Updates = Terremotos</strong>: impredecibles, pueden ocurrir cualquier día sin aviso previo</li>
                    <li><strong>Sistema de Monitoreo = Sismógrafo</strong>: detecta temblores (cambios tráfico/rankings) en tiempo real, 24/7</li>
                    <li><strong>Playbook de Recuperación = Plan de Evacuación</strong>: pasos exactos a seguir cuando terremoto golpea</li>
                    <li><strong>Vulnerabilidades del Sitio = Edificio Mal Construido</strong>: contenido thin, links spam, E-E-A-T débil = colapso con primer temblor</li>
                    <li><strong>Auditorías Preventivas = Inspecciones de Seguridad</strong>: cada 3 meses para detectar grietas antes del terremoto grande</li>
                </ul>
            </div>
            <div class="impacto-negocio-grid">
                <div class="impacto-item">
                    <div class="impacto-icon"></div>
                    <div class="impacto-text">
                        <strong>Detección Temprana Crítica</strong>
                        <p>Sin monitoreo: te enteras de caída tráfico 30-45 días después (cuando ya perdiste €10k-20k ingresos). Con monitoreo: alertas en 24-48h.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon">️</div>
                    <div class="impacto-text">
                        <strong>Reducción Tiempo Recuperación</strong>
                        <p>Playbook documentado reduce tiempo recuperación de 90-120 días a 30-45 días (2-3x más rápido). Pérdida minimizada.</p>
                    </div>
                </div>
                <div class="impacto-item">
                    <div class="impacto-icon"></div>
                    <div class="impacto-text">
                        <strong>Protección Ingresos</strong>
                        <p>Caída -30% tráfico orgánico = pérdida €12k-18k/mes. Recuperación en 45 días vs 120 días = ahorro €36k-54k adicionales.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Entregables CSV Descargables -->
    <section class="entregables-csv">
        <h2 class="section-title-download"> Entregables: Auditoría de Algorithm Updates y Playbook de Recuperación</h2>
        <p class="section-description">
            Descarga 2 archivos CSV con <strong>auditoría completa de 14 algorithm updates históricos</strong> que impactaron Ibiza Villa
            (2016-2024) y <strong>13 playbooks de recuperación</strong> para escenarios críticos (caída tráfico, penalties, CWV issues, etc.).
        </p>

        <div class="csv-cards-grid">
            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon"></span>
                    <h3>1. Auditoría Historical Algorithm Updates</h3>
                    <span class="csv-badge muy-alta">Muy Alta Prioridad</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        <strong>14 algorithm updates auditados</strong> (Helpful Content, Core Updates, E-E-A-T, Mobile-First, Spam, etc.)
                        con impacto cuantificado en Ibiza Villa desde 2016.
                    </p>
                    <ul class="csv-highlights">
                        <li><strong>Impactos Negativos:</strong> HCU -18% tráfico, E-E-A-T Update -25% transaccional, Mobile-First -15%</li>
                        <li><strong>Impactos Positivos:</strong> Spam Update +3%, BERT Update +12% long-tail, Local Search +18%</li>
                        <li><strong>Tiempos Recuperación:</strong> 30-120 días dependiendo severidad y velocidad acción</li>
                        <li><strong>Lecciones Aprendidas:</strong> E-E-A-T crítico YMYL, contenido thin vulnerable HCU, CWV mobile ranking factor</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>14 updates</strong> auditados</span>
                        <span><strong>13 columnas</strong> de análisis</span>
                        <span><strong>2016-2024</strong> histórico</span>
                    </div>
                    <a href="../entregables/algorithm_monitoring/algorithm_updates_audit.csv" download class="btn-download">
                         Descargar Auditoría Updates (CSV)
                    </a>
                </div>
            </div>

            <div class="csv-card">
                <div class="csv-card-header">
                    <span class="csv-icon"></span>
                    <h3>2. Playbook Monitoreo y Recuperación</h3>
                    <span class="csv-badge critica">Prioridad Crítica</span>
                </div>
                <div class="csv-card-body">
                    <p class="csv-description">
                        <strong>13 playbooks documentados</strong> para escenarios críticos con triggers de alerta, métricas a monitorear,
                        umbrales críticos, y pasos exactos de recuperación.
                    </p>
                    <ul class="csv-highlights">
                        <li><strong>Escenarios Cubiertos:</strong> Caída tráfico súbita, Penalty manual, CWV degradación, HCU penalty, Spam attack</li>
                        <li><strong>Triggers Automáticos:</strong> Tráfico -15% en 7 días, LCP >4s, 100+ spam links/semana</li>
                        <li><strong>Tiempos Estimados:</strong> 14-120 días recuperación dependiendo escenario y severidad</li>
                        <li><strong>Herramientas Necesarias:</strong> GSC, Ahrefs, SEMrush Sensor, MozCast, PageSpeed Insights</li>
                    </ul>
                    <div class="csv-metadata">
                        <span><strong>13 playbooks</strong> documentados</span>
                        <span><strong>15 columnas</strong> detalladas</span>
                        <span><strong>Paso a paso</strong> recuperación</span>
                    </div>
                    <a href="../entregables/algorithm_monitoring/monitoring_playbook.csv" download class="btn-download">
                         Descargar Playbook Recuperación (CSV)
                    </a>
                </div>
            </div>
        </div>

        <div class="instrucciones-uso">
            <h4> Cómo Usar Estos Archivos:</h4>
            <ol class="instrucciones-list">
                <li><strong>Auditoría Updates:</strong> Revisar histórico para entender qué updates impactaron Ibiza Villa en el pasado y por qué (lecciones aprendidas)</li>
                <li><strong>Identificar Vulnerabilidades:</strong> Si HCU causó -18% tráfico por contenido thin, indica que E-E-A-T sigue siendo vulnerabilidad actual</li>
                <li><strong>Playbook Caída Tráfico:</strong> Si detectas caída >15% en 7 días, seguir playbook "Caída Tráfico Orgánico Súbita" paso a paso</li>
                <li><strong>Configurar Alertas:</strong> Usar umbrales críticos CSV para configurar alertas automáticas en GSC/Ahrefs (ej: alerta si tráfico -10% semanal)</li>
                <li><strong>Priorizar Playbooks:</strong> Enfocar en playbooks "Prioridad Crítica" (penalty manual, HCU penalty, mobile-first issues)</li>
                <li><strong>Documentar Nuevos Updates:</strong> Cuando nuevo update ocurre, añadir fila a CSV Auditoría con impacto + acciones tomadas</li>
                <li><strong>Revisión Trimestral:</strong> Cada 3 meses revisar playbooks y actualizar con nuevas herramientas/estrategias aprendidas</li>
            </ol>
        </div>
    </section>

    <!-- Comparación ANTES/DESPUÉS -->
    <section class="comparacion-antes-despues">
        <h2 class="section-title-comparison">️ Comparación: Monitoreo Algoritmo ANTES vs DESPUÉS</h2>

        <div class="comparacion-intro">
            <p>
                Actualmente Ibiza Villa <strong>NO tiene sistema de monitoreo algorítmico activo</strong>, lo que resulta en
                <strong>detección tardía de impactos</strong> (30-45 días después de caída) y <strong>recuperaciones lentas</strong>
                (90-120 días por falta de playbook documentado). Implementar monitoreo proactivo + playbooks reduce tiempo recuperación
                <strong>de 120 días a 30-45 días</strong> (2-3x más rápido = ahorro €36k-54k por incidente).
            </p>
        </div>

        <div class="comparacion-grid">
            <div class="comparacion-columna antes">
                <div class="badge-seccion antes-badge"> ANTES - SITUACIÓN ACTUAL</div>
                <h3>Sin Sistema de Monitoreo Activo</h3>

                <div class="problema-item">
                    <div class="problema-numero">1</div>
                    <div class="problema-content">
                        <strong>Detección Reactiva Tardía (30-45 días después)</strong>
                        <p>
                            Te enteras de caída tráfico cuando cliente pregunta "¿por qué menos reservas?" o al revisar Analytics
                            mensualmente. Para entonces ya perdiste €10k-20k ingresos irrecuperables.
                        </p>
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-numero">2</div>
                    <div class="problema-content">
                        <strong>Sin Playbooks Documentados = Improvisación</strong>
                        <p>
                            Cada vez que Google lanza update, empiezas de cero: "¿Qué hacemos?", "¿A quién consultamos?", "¿Qué arreglamos primero?".
                            Improvisación = 90-120 días recuperación vs 30-45 días con playbook.
                        </p>
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-numero">3</div>
                    <div class="problema-content">
                        <strong>Métricas No Monitorizadas Sistemáticamente</strong>
                        <p>
                            No tracking diario de: tráfico orgánico, rankings keywords críticas, Core Web Vitals, spam score links, indexing
                            issues. Problemas crecen silenciosamente hasta ser crisis.
                        </p>
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-numero">4</div>
                    <div class="problema-content">
                        <strong>Pérdida Acumulada: €36k-72k/año</strong>
                        <p>
                            3-4 Core Updates/año con tiempo recuperación promedio 105 días (vs 35 días con playbook) = pérdida adicional
                            70 días × €500-1,000/día = €36k-72k/año evitables con monitoreo proactivo.
                        </p>
                    </div>
                </div>

                <div class="problema-item">
                    <div class="problema-numero">5</div>
                    <div class="problema-content">
                        <strong>Vulnerabilidades Silenciosas Sin Detectar</strong>
                        <p>
                            Contenido thin, E-E-A-T débil, CWV degradándose, spam links acumulándose. Todo OK hasta que próximo Core Update
                            golpea y caída -30-50% tráfico en 7 días. Vulnerabilidad = bomba de tiempo.
                        </p>
                    </div>
                </div>
            </div>

            <div class="comparacion-flecha">
                <div class="flecha-icon"></div>
                <div class="flecha-text">MONITOREO<br>PROACTIVO</div>
            </div>

            <div class="comparacion-columna despues">
                <div class="badge-seccion despues-badge"> DESPUÉS - CON SISTEMA MONITOREO</div>
                <h3>Sistema Proactivo + Playbooks Documentados</h3>

                <div class="solucion-item">
                    <div class="solucion-numero"></div>
                    <div class="solucion-content">
                        <strong>Detección Temprana Automática (24-48 horas)</strong>
                        <p>
                            Alertas automáticas Google Search Console + Ahrefs cuando tráfico cae >10% en 7 días, o rankings caen >5 posiciones
                            en keywords críticas. Acción inmediata = pérdida minimizada €2k-4k vs €10k-20k.
                        </p>
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-numero"></div>
                    <div class="solucion-content">
                        <strong>13 Playbooks Documentados Listos para Ejecutar</strong>
                        <p>
                            Cada escenario tiene playbook paso a paso: Caída tráfico súbita (5 pasos, 30-90 días), Penalty manual (5 pasos, 14-45 días),
                            HCU penalty (5 pasos, 90-120 días). Cero improvisación, máxima eficiencia.
                        </p>
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-numero"></div>
                    <div class="solucion-content">
                        <strong>18 Métricas Críticas Monitorizadas Diaria/Semanalmente</strong>
                        <p>
                            Tráfico orgánico (diario), Rankings Top 10 (semanal), Core Web Vitals (semanal), Spam score links (mensual), Indexing
                            issues (semanal). Problemas detectados cuando son molehills, no mountains.
                        </p>
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-numero"></div>
                    <div class="solucion-content">
                        <strong>Ahorro Acumulado: €36k-72k/año</strong>
                        <p>
                            Tiempo recuperación reducido de 105 días a 35 días promedio = 70 días ahorrados × €500-1,000/día × 3-4 updates/año
                            = €36k-72k/año protegidos. ROI monitoreo 15:1 primer año.
                        </p>
                    </div>
                </div>

                <div class="solucion-item">
                    <div class="solucion-numero"></div>
                    <div class="solucion-content">
                        <strong>Auditorías Preventivas Cada 3 Meses</strong>
                        <p>
                            Contenido thin eliminado, E-E-A-T reforzado, CWV optimizados, spam links disavowed ANTES de próximo Core Update.
                            Sitio resiliente = impactos negativos -60-80% menores cuando update golpea.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="timeline-implementacion">
            <h4> Timeline de Implementación (Sistema Monitoreo Completo)</h4>
            <div class="timeline-grid">
                <div class="timeline-fase">
                    <div class="fase-badge fase-1">Semanas 1-2</div>
                    <h5>Setup Herramientas Monitoreo</h5>
                    <p>
                        Configurar Google Search Console alerts (tráfico -10%, coverage issues), Ahrefs rank tracking diario 50 keywords,
                        SEMrush Sensor monitoring, PageSpeed Insights weekly CWV. Dashboards centralizados.
                    </p>
                    <span class="resultado-fase">Detección automática activa 24/7</span>
                </div>
                <div class="timeline-fase">
                    <div class="fase-badge fase-2">Semanas 3-4</div>
                    <h5>Documentar Playbooks</h5>
                    <p>
                        Documentar 13 playbooks en Notion/Confluence con pasos exactos, herramientas necesarias, tiempos estimados, responsables.
                        Entrenamiento equipo en ejecución playbooks top 5 críticos.
                    </p>
                    <span class="resultado-fase">Playbooks listos para ejecutar en <24h</span>
                </div>
                <div class="timeline-fase">
                    <div class="fase-badge fase-3">Mes 2-3</div>
                    <h5>Auditoría Preventiva Completa</h5>
                    <p>
                        E-E-A-T audit (entity signals, Schema Person, mentions), contenido thin audit (<500 palabras), link profile spam audit
                        (spam score >70), CWV optimization (LCP <2.5s, CLS <0.1). Eliminar vulnerabilidades ANTES de update.
                    </p>
                    <span class="resultado-fase">Sitio resiliente, vulnerabilidades críticas eliminadas</span>
                </div>
                <div class="timeline-fase">
                    <div class="fase-badge fase-4">Mes 4+</div>
                    <h5>Monitoreo Continuo + Mejoras</h5>
                    <p>
                        Monitoreo diario automatizado, auditorías preventivas trimestrales, playbooks actualizados con learnings nuevos,
                        tracking ROI sistema (pérdidas evitadas vs inversión monitoreo).
                    </p>
                    <span class="resultado-fase">Sistema maduro, auto-sostenible, ROI 15:1</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabla KPIs -->
    <section class="kpis-section">
        <h2 class="section-title-kpis"> KPIs: Monitoreo de Algoritmo y Recuperación</h2>

        <div class="kpis-intro">
            <p>
                Métricas clave que miden la <strong>eficacia del sistema de monitoreo</strong> y la <strong>velocidad de recuperación</strong>
                ante algorithm updates negativos. Objetivo: <strong>reducir tiempo recuperación de 105 días a 35 días</strong> (promedio) y
                <strong>minimizar pérdida ingresos de €10k-20k a €2k-4k</strong> por incidente.
            </p>
        </div>

        <table class="tabla-kpis">
            <thead>
                <tr>
                    <th>Métrica Monitoreo</th>
                    <th>ANTES (Sin Sistema)</th>
                    <th>DESPUÉS (Con Sistema)</th>
                    <th>Mejora</th>
                    <th>Impacto en Negocio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Tiempo Detección Caída Tráfico</strong></td>
                    <td>30-45 días (manual review Analytics)</td>
                    <td>24-48 horas (alertas automáticas)</td>
                    <td class="mejora-positiva">-93% tiempo (29-44 días más rápido)</td>
                    <td>Pérdida reducida de €10k-20k a €2k-4k por incidente (ahorro €8k-16k)</td>
                </tr>
                <tr>
                    <td><strong>Tiempo Recuperación Promedio</strong></td>
                    <td>90-120 días (sin playbook, improvisación)</td>
                    <td>30-45 días (playbook documentado)</td>
                    <td class="mejora-positiva">-67% tiempo (60-75 días más rápido)</td>
                    <td>3-4 updates/año × 70 días ahorrados = €36k-72k/año protegidos</td>
                </tr>
                <tr class="fila-destacada">
                    <td><strong>Pérdida Ingresos por Update Negativo</strong></td>
                    <td>€10,000-20,000 (detección tardía + recuperación lenta)</td>
                    <td>€2,000-4,000 (detección temprana + playbook)</td>
                    <td class="mejora-positiva">-80-85% pérdida (€8k-16k ahorrados)</td>
                    <td>ROI sistema monitoreo: 15:1 primer año (inversión €4k vs ahorro €60k)</td>
                </tr>
                <tr>
                    <td><strong>Métricas Monitorizadas Activamente</strong></td>
                    <td>3-4 métricas (tráfico, conversión - manual)</td>
                    <td>18 métricas (tráfico, rankings, CWV, indexing, spam, etc.)</td>
                    <td class="mejora-positiva">+350-450% cobertura (14-15 métricas adicionales)</td>
                    <td>Detección temprana vulnerabilidades ANTES de convertirse en crisis</td>
                </tr>
                <tr>
                    <td><strong>Playbooks Documentados Listos</strong></td>
                    <td>0 playbooks (improvisación cada update)</td>
                    <td>13 playbooks (escenarios críticos cubiertos 100%)</td>
                    <td class="mejora-positiva">+∞ (de cero a cobertura completa)</td>
                    <td>Cero tiempo perdido decidiendo "qué hacer". Ejecución inmediata.</td>
                </tr>
                <tr>
                    <td><strong>Auditorías Preventivas Realizadas</strong></td>
                    <td>0-1 vez/año (reactivo, post-crisis)</td>
                    <td>4 veces/año (trimestral preventivo)</td>
                    <td class="mejora-positiva">+300-400% frecuencia (proactivo vs reactivo)</td>
                    <td>Vulnerabilidades eliminadas ANTES de update = impacto -60-80% menor</td>
                </tr>
            </tbody>
        </table>

        <div class="kpis-nota-importante">
            <h4>️ Nota Importante: Monitoreo Algoritmo = Seguro Contra Desastres</h4>
            <p>
                El monitoreo de algoritmo funciona como un <strong>seguro contra desastres SEO</strong>. Pagas €300-500/mes (herramientas + tiempo)
                pero cuando caída -30% tráfico ocurre (inevitable con 4-6 Core Updates/año), recuperas en 35 días vs 105 días sin sistema =
                <strong>ahorro €35k-52k por incidente</strong>. Sistema se paga solo con prevenir UN SOLO impacto negativo mayor al año.
                <br><br>
                <strong>Analogía:</strong> No contratas seguro incendios porque esperas que casa se queme. Lo contratas porque SI ocurre,
                recuperación sin seguro te arruina (€200k pérdida vs €5k deducible con seguro). Monitoreo algoritmo = deducible €4k/año
                vs pérdida €60k-120k/año sin sistema.
            </p>
        </div>
    </section>

    <!-- Resumen Ejecutivo -->
    <div class="executive-summary">
        <h2>Resumen Ejecutivo</h2>
        <p><?php echo htmlspecialchars($resumen['descripcion'] ?? ''); ?></p>

        <div class="summary-grid">
            <div class="stat-card">
                <div class="stat-label">Updates Detectados</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['updates_detectados'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Impacto Negativo</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['impactos_negativos'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tiempo Recuperación</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['tiempo_recuperacion_avg'] ?? '0'); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Alertas Activas</div>
                <div class="stat-value"><?php echo htmlspecialchars($resumen['alertas_activas'] ?? '0'); ?></div>
            </div>
        </div>
    </div>

    <!-- Impacto Actual -->
    <?php if (!empty($impacto_actual)): ?>
    <div class="current-impact">
        <div class="impact-status">
            Estado Actual: <?php echo htmlspecialchars($impacto_actual['estado'] ?? 'Normal'); ?>
        </div>

        <p style="margin: 10px 0; font-size: 14px;">
            <?php echo htmlspecialchars($impacto_actual['descripcion'] ?? ''); ?>
        </p>

        <?php if (isset($impacto_actual['ultimo_update'])): ?>
        <div style="margin-top: 15px;">
            <strong>Último update detectado:</strong> <?php echo htmlspecialchars($impacto_actual['ultimo_update']); ?>
            <br>
            <strong>Fecha:</strong> <?php echo htmlspecialchars($impacto_actual['fecha_update'] ?? ''); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Historial de Updates -->
    <div class="content-section">
        <h3>Historial de Algorithm Updates</h3>
        <p>Registro de actualizaciones algorítmicas de Google y su impacto en el sitio.</p>

        <?php foreach ($historial_updates ?? [] as $update): ?>
        <div class="update-card">
            <div class="update-header">
                <div>
                    <div class="update-name"><?php echo htmlspecialchars($update['nombre'] ?? ''); ?></div>
                    <div class="update-date"><?php echo htmlspecialchars($update['fecha'] ?? ''); ?></div>
                </div>
                <span class="impact-badge <?php echo strtolower($update['impacto_tipo'] ?? 'neutro'); ?>">
                    <?php echo htmlspecialchars($update['impacto_tipo'] ?? 'Neutro'); ?>
                </span>
            </div>

            <p style="margin: 10px 0; font-size: 14px; color: #6c757d;">
                <?php echo htmlspecialchars($update['descripcion'] ?? ''); ?>
            </p>

            <?php if (!empty($update['metricas'])): ?>
            <div class="impact-details">
                <strong style="display: block; margin-bottom: 8px;">Métricas de Impacto:</strong>
                <?php foreach ($update['metricas'] as $metric => $value): ?>
                <div class="metric-row">
                    <span class="metric-label"><?php echo htmlspecialchars($metric); ?>:</span>
                    <span class="metric-value <?php echo (strpos($value, '-') === 0) ? 'negative' : ((strpos($value, '+') === 0) ? 'positive' : ''); ?>">
                        <?php echo htmlspecialchars($value); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($update['acciones_tomadas'])): ?>
            <div style="margin-top: 12px; padding: 10px; background: #e8f5e9; border-radius: 4px; font-size: 13px;">
                <strong>Acciones tomadas:</strong> <?php echo htmlspecialchars($update['acciones_tomadas']); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Métricas Monitorizadas -->
    <?php if (!empty($metricas_monitorizadas)): ?>
    <div class="content-section">
        <h3>Métricas Monitorizadas</h3>

        <table class="monitoring-table">
            <thead>
                <tr>
                    <th>Métrica</th>
                    <th>Frecuencia</th>
                    <th>Umbral Alerta</th>
                    <th>Fuente Datos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metricas_monitorizadas as $metric): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($metric['nombre'] ?? ''); ?></strong></td>
                    <td>
                        <span class="frequency-badge <?php echo strtolower($metric['frecuencia'] ?? 'semanal'); ?>">
                            <?php echo htmlspecialchars($metric['frecuencia'] ?? 'Semanal'); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($metric['umbral_alerta'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($metric['fuente'] ?? 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Alertas Configuradas -->
    <div class="content-section">
        <h3>Alertas Configuradas</h3>
        <p>Sistema automático de alertas ante cambios significativos.</p>

        <?php foreach ($alertas_configuradas ?? [] as $alert): ?>
        <div class="alert-card">
            <div class="alert-trigger">
                <?php echo htmlspecialchars($alert['trigger'] ?? ''); ?>
            </div>
            <p style="margin: 8px 0; font-size: 13px; color: #6c757d;">
                <?php echo htmlspecialchars($alert['descripcion'] ?? ''); ?>
            </p>
            <div class="alert-action">
                <strong>Acción automática:</strong> <?php echo htmlspecialchars($alert['accion'] ?? ''); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Playbook de Recuperación -->
    <?php if (!empty($playbook_recuperacion)): ?>
    <div class="content-section">
        <h3>Playbook de Recuperación</h3>

        <?php foreach ($playbook_recuperacion as $scenario): ?>
        <div class="playbook-section">
            <div class="playbook-title"><?php echo htmlspecialchars($scenario['escenario'] ?? ''); ?></div>

            <ul class="playbook-steps">
                <?php foreach ($scenario['pasos'] ?? [] as $step): ?>
                <li>
                    <div class="step-title"><?php echo htmlspecialchars($step['titulo'] ?? ''); ?></div>
                    <div class="step-description"><?php echo htmlspecialchars($step['descripcion'] ?? ''); ?></div>
                </li>
                <?php endforeach; ?>
            </ul>

            <?php if (isset($scenario['tiempo_estimado'])): ?>
            <div style="margin-top: 15px; font-size: 13px; color: #6c757d;">
                <strong>Tiempo estimado de recuperación:</strong> <?php echo htmlspecialchars($scenario['tiempo_estimado']); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Calendario de Updates -->
    <?php if (!empty($calendario_updates)): ?>
    <div class="content-section">
        <h3>Calendario de Updates Esperados</h3>
        <p>Previsión de actualizaciones algorítmicas basada en patrones históricos.</p>

        <div class="calendar-grid">
            <?php foreach ($calendario_updates as $month): ?>
            <div class="calendar-month">
                <div class="month-name"><?php echo htmlspecialchars($month['mes'] ?? ''); ?></div>
                <div class="expected-updates">
                    <?php foreach ($month['updates_esperados'] ?? [] as $update): ?>
                    <div class="update-item">
                        <strong><?php echo htmlspecialchars($update['tipo'] ?? ''); ?></strong>
                        <br>
                        <span style="font-size: 11px;"><?php echo htmlspecialchars($update['probabilidad'] ?? ''); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="page-footer">
        <span>Fase 9 - SEO Moderno</span>
        <span>Monitoreo de Algoritmo</span>
    </div>
</div>
