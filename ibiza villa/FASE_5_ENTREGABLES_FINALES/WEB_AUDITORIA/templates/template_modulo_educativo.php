<?php
/**
 * TEMPLATE: Módulo Educativo con Entregables Accionables
 *
 * Este template debe ser copiado y personalizado para cada módulo de auditoría.
 *
 * INSTRUCCIONES DE USO:
 * 1. Copiar este archivo a la ubicación del módulo correspondiente
 * 2. Buscar y reemplazar todos los [PLACEHOLDERS] con contenido real
 * 3. Personalizar el gradiente CSS según el tipo de módulo (ver PATRON_MODULOS_EDUCATIVOS_ENTREGABLES.md)
 * 4. Crear los archivos CSV correspondientes en /entregables/[categoria]/
 * 5. Ajustar el número de tarjetas de entregables según CSVs disponibles
 * 6. Modificar las métricas de ANTES/DESPUÉS con datos reales del análisis
 *
 * PLACEHOLDERS A REEMPLAZAR:
 * - [NOMBRE_MODULO] - Ej: "Keywords", "On-Page", "Contenido"
 * - [CONCEPTO] - Ej: "Keywords", "Arquitectura Web", "Meta Tags"
 * - [DESCRIPCION_SIMPLE] - Explicación en lenguaje no técnico
 * - [ANALOGIA] - Comparación con algo cotidiano
 * - [GRADIENTE_CSS] - Código de gradiente específico del módulo
 * - [CATEGORIA_CSV] - Nombre de carpeta en /entregables/
 * - [TIPO_CSV] - Identificador del tipo (urls_huerfanas, paginas_sin_h1, etc)
 * - [NUMERO_ITEMS] - Cantidad de elementos (se actualiza automáticamente vía JS)
 *
 * NOTA: Los CSVs se generan AUTOMÁTICAMENTE al cargar la página.
 * Solo necesitas definir data-entregable-tipo en los botones.
 */

// Obtener datos del módulo (ajustar según estructura real)
$auditoriaId = $_GET['auditoria_id'] ?? null;
$pasoId = $_GET['paso_id'] ?? null;

// Obtener datos específicos del módulo desde la base de datos o JSON
// $datos = obtenerDatosModulo($auditoriaId, $pasoId);
?>

<!-- Cargar script de generación automática de CSVs -->
<script src="/js/entregables-generator.js" defer></script>
<body data-auditoria-id="<?php echo $auditoriaId; ?>" data-modulo="[NOMBRE_MODULO]">

<div class="[NOMBRE_MODULO]-page">

    <!-- ============================================
         SECCIÓN 1: EDUCATIVA
         ============================================ -->
    <section class="concepto-educativo">
        <div class="concepto-header">
            <span class="concepto-icon">[ICONO_EMOJI]</span>
            <h2>¿Qué es [CONCEPTO] y Por Qué es Importante?</h2>
        </div>

        <div class="concepto-content">
            <p class="concepto-intro">
                [DESCRIPCION_SIMPLE - Explicación en lenguaje simple del concepto técnico.
                Debe ser comprensible para alguien sin conocimientos de SEO.]
            </p>

            <!-- ANALOGÍA -->
            <div class="analogia-box">
                <div class="analogia-header">
                    <span class="analogia-icon">💡</span>
                    <strong>Piensa en [CONCEPTO] como [ANALOGIA]:</strong>
                </div>
                <ul class="analogia-list">
                    <li><strong>[Elemento 1]</strong> es como [comparación familiar]</li>
                    <li><strong>[Elemento 2]</strong> es como [comparación familiar]</li>
                    <li><strong>[Elemento 3]</strong> es como [comparación familiar]</li>
                    <li><strong>[Elemento 4]</strong> es como [comparación familiar]</li>
                </ul>
                <p class="analogia-conclusion">
                    <strong>Problema:</strong> [Descripción del problema en términos de negocio,
                    no técnicos. Por ejemplo: "perderás clientes potenciales", "Google no te encontrará"]
                </p>
            </div>

            <!-- IMPACTO EN NEGOCIO -->
            <div class="impacto-negocio">
                <h3>🎯 Impacto en tu Negocio</h3>
                <div class="impacto-grid">
                    <div class="impacto-item positivo">
                        <span class="impacto-icon">✅</span>
                        <div>
                            <strong>[Beneficio 1]</strong>
                            <p>[Descripción del beneficio en términos de negocio]</p>
                        </div>
                    </div>
                    <div class="impacto-item positivo">
                        <span class="impacto-icon">✅</span>
                        <div>
                            <strong>[Beneficio 2]</strong>
                            <p>[Descripción del beneficio]</p>
                        </div>
                    </div>
                    <div class="impacto-item positivo">
                        <span class="impacto-icon">✅</span>
                        <div>
                            <strong>[Beneficio 3]</strong>
                            <p>[Descripción del beneficio]</p>
                        </div>
                    </div>
                    <div class="impacto-item negativo">
                        <span class="impacto-icon">⚠️</span>
                        <div>
                            <strong>Riesgo si no se corrige</strong>
                            <p>[Descripción de consecuencias negativas si no se actúa]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         SECCIÓN 2: ENTREGABLES
         ============================================ -->
    <section class="entregables-section">
        <div class="entregables-header">
            <span class="entregables-icon">📄</span>
            <h2>Archivos de Trabajo para Implementar las Mejoras</h2>
        </div>

        <p class="entregables-intro">
            Descarga estos archivos CSV con las acciones específicas priorizadas.
            Cada archivo está listo para abrir en Excel/Google Sheets y asignar tareas a tu equipo.
        </p>

        <div class="entregables-grid">

            <!-- TARJETA ENTREGABLE 1 -->
            <div class="entregable-card priority-critical">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>[Título del Archivo CSV 1]</h3>
                    <p class="entregable-desc">
                        <strong>[NUMERO_ITEMS]</strong> [descripción de qué contiene el archivo].
                        [Qué información específica incluye cada fila].
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: [Crítica/Muy Alta/Alta/Media/Baja]</span>
                        <span class="meta-badge impact">Impacto: [estimación de beneficio]</span>
                    </div>
                    <!-- IMPORTANTE: Usar data-entregable-tipo para generación automática -->
                    <a href="#"
                       class="btn-download"
                       data-entregable-tipo="[TIPO_CSV_1]"
                       data-entregable-categoria="[CATEGORIA_CSV]"
                       download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>

            <!-- TARJETA ENTREGABLE 2 -->
            <div class="entregable-card priority-high">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>[Título del Archivo CSV 2]</h3>
                    <p class="entregable-desc">
                        <strong>[NUMERO_ITEMS]</strong> [descripción].
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: [Nivel]</span>
                        <span class="meta-badge impact">Impacto: [estimación]</span>
                    </div>
                    <a href="#"
                       class="btn-download"
                       data-entregable-tipo="[TIPO_CSV_2]"
                       data-entregable-categoria="[CATEGORIA_CSV]"
                       download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>

            <!-- TARJETA ENTREGABLE 3 (opcional, repetir según necesidad) -->
            <div class="entregable-card priority-medium">
                <div class="entregable-icon">
                    <i class="fas fa-file-csv"></i>
                </div>
                <div class="entregable-content">
                    <h3>[Título del Archivo CSV 3]</h3>
                    <p class="entregable-desc">
                        <strong>[NUMERO_ITEMS]</strong> [descripción].
                    </p>
                    <div class="entregable-meta">
                        <span class="meta-badge priority">Prioridad: [Nivel]</span>
                        <span class="meta-badge impact">Impacto: [estimación]</span>
                    </div>
                    <a href="#"
                       class="btn-download"
                       data-entregable-tipo="[TIPO_CSV_3]"
                       data-entregable-categoria="[CATEGORIA_CSV]"
                       download>
                        <i class="fas fa-download"></i> Descargar CSV
                    </a>
                </div>
            </div>

        </div>

        <!-- INSTRUCCIONES DE USO -->
        <div class="como-usar-entregables">
            <h3>💡 Cómo Usar Estos Archivos</h3>
            <ol class="uso-list">
                <li><strong>Descarga</strong> el CSV que corresponda a la tarea que quieres empezar</li>
                <li><strong>Ábrelo</strong> en Excel, Google Sheets o cualquier editor de hojas de cálculo</li>
                <li><strong>Ordena</strong> las filas por columna "Prioridad" para empezar por lo más importante</li>
                <li><strong>Asigna</strong> cada línea a un miembro de tu equipo técnico o agencia</li>
                <li><strong>Marca</strong> en el archivo cuando completes cada tarea (puedes añadir columna "Estado")</li>
            </ol>
            <div class="entregables-tip">
                <span class="tip-icon">💡</span>
                <p><strong>Tip:</strong> Puedes añadir una columna "Fecha Completado" y "Responsable" para hacer seguimiento del progreso.</p>
            </div>
        </div>
    </section>

    <!-- ============================================
         SECCIÓN 3: ANTES/DESPUÉS
         ============================================ -->
    <section class="antes-despues-section">
        <div class="antes-despues-header">
            <span class="antes-despues-icon">🔄</span>
            <h2>Tu Situación Actual vs. Situación Optimizada</h2>
        </div>

        <div class="comparacion-grid">

            <!-- ESTADO ACTUAL -->
            <div class="comparacion-card estado-actual">
                <div class="comparacion-header">
                    <span class="estado-badge actual">❌ Estado Actual</span>
                    <h3>Problemas Detectados</h3>
                </div>
                <div class="metricas-lista">
                    <div class="metrica-item negativo">
                        <span class="metrica-valor">[Número]</span>
                        <span class="metrica-label">[Descripción del problema 1]</span>
                    </div>
                    <div class="metrica-item negativo">
                        <span class="metrica-valor">[Número]</span>
                        <span class="metrica-label">[Descripción del problema 2]</span>
                    </div>
                    <div class="metrica-item negativo">
                        <span class="metrica-valor">[Número]</span>
                        <span class="metrica-label">[Descripción del problema 3]</span>
                    </div>
                </div>
                <div class="impacto-resumen negativo">
                    <strong>Impacto Negativo:</strong> [Descripción del impacto en tráfico, conversiones, o negocio en general]
                </div>
            </div>

            <!-- FLECHA DE TRANSICIÓN -->
            <div class="comparacion-arrow">
                <i class="fas fa-arrow-right"></i>
                <span>Tras implementar mejoras</span>
            </div>

            <!-- ESTADO OPTIMIZADO -->
            <div class="comparacion-card estado-optimizado">
                <div class="comparacion-header">
                    <span class="estado-badge optimizado">✅ Estado Optimizado</span>
                    <h3>Mejoras Implementadas</h3>
                </div>
                <div class="metricas-lista">
                    <div class="metrica-item positivo">
                        <span class="metrica-valor">[Número Mejorado]</span>
                        <span class="metrica-label">[Descripción de la mejora 1]</span>
                    </div>
                    <div class="metrica-item positivo">
                        <span class="metrica-valor">[Número Mejorado]</span>
                        <span class="metrica-label">[Descripción de la mejora 2]</span>
                    </div>
                    <div class="metrica-item positivo">
                        <span class="metrica-valor">[Número Mejorado]</span>
                        <span class="metrica-label">[Descripción de la mejora 3]</span>
                    </div>
                </div>
                <div class="impacto-resumen positivo">
                    <strong>Beneficio Esperado:</strong> [Descripción del beneficio en tráfico, conversiones, o mejora de negocio]
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================
         SECCIÓN 4: CONTENIDO TÉCNICO EXISTENTE
         ============================================ -->
    <!-- A partir de aquí, insertar el contenido técnico original del módulo:
         - Gráficos de Chart.js
         - Tablas de datos
         - Análisis detallados
         - etc.
    -->

    <section class="datos-tecnicos">
        <h2>[Título de Análisis Técnico]</h2>
        <!-- Contenido técnico original aquí -->
    </section>

</div>

<!-- ============================================
     ESTILOS CSS ESPECÍFICOS DEL MÓDULO
     ============================================ -->
<style>
/* ==============================================
   ESTILOS PERSONALIZADOS DEL MÓDULO
   ============================================== */

/* Contenedor principal del módulo */
.[NOMBRE_MODULO]-page {
    padding: 0;
    max-width: 100%;
}

/* ===== SECCIÓN EDUCATIVA ===== */
.[NOMBRE_MODULO]-page .concepto-educativo {
    background: [GRADIENTE_CSS]; /* CAMBIAR según módulo */
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.[NOMBRE_MODULO]-page .concepto-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.[NOMBRE_MODULO]-page .concepto-icon {
    font-size: 2.5rem;
}

.[NOMBRE_MODULO]-page .concepto-header h2 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
}

.[NOMBRE_MODULO]-page .concepto-intro {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 25px;
}

.[NOMBRE_MODULO]-page .analogia-box {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-left: 4px solid #ffd700;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.[NOMBRE_MODULO]-page .analogia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.[NOMBRE_MODULO]-page .analogia-icon {
    font-size: 1.5rem;
}

.[NOMBRE_MODULO]-page .analogia-list {
    list-style: none;
    padding-left: 0;
    margin: 15px 0;
}

.[NOMBRE_MODULO]-page .analogia-list li {
    padding: 8px 0;
    padding-left: 25px;
    position: relative;
}

.[NOMBRE_MODULO]-page .analogia-list li::before {
    content: "→";
    position: absolute;
    left: 0;
    color: #ffd700;
    font-weight: bold;
}

.[NOMBRE_MODULO]-page .analogia-conclusion {
    background: rgba(255,255,255,0.2);
    padding: 15px;
    border-radius: 6px;
    margin-top: 15px;
}

.[NOMBRE_MODULO]-page .impacto-negocio {
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 8px;
}

.[NOMBRE_MODULO]-page .impacto-negocio h3 {
    margin-top: 0;
    margin-bottom: 20px;
}

.[NOMBRE_MODULO]-page .impacto-grid {
    display: grid;
    gap: 15px;
}

.[NOMBRE_MODULO]-page .impacto-item {
    display: flex;
    gap: 15px;
    background: rgba(255,255,255,0.15);
    padding: 15px;
    border-radius: 6px;
}

.[NOMBRE_MODULO]-page .impacto-item.positivo {
    border-left: 4px solid #4ade80;
}

.[NOMBRE_MODULO]-page .impacto-item.negativo {
    border-left: 4px solid #f87171;
}

.[NOMBRE_MODULO]-page .impacto-icon {
    font-size: 1.5rem;
}

.[NOMBRE_MODULO]-page .impacto-item strong {
    display: block;
    margin-bottom: 5px;
}

.[NOMBRE_MODULO]-page .impacto-item p {
    margin: 0;
    font-size: 0.95rem;
}

/* ===== SECCIÓN ENTREGABLES ===== */
.[NOMBRE_MODULO]-page .entregables-section {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 12px;
    margin-bottom: 40px;
}

.[NOMBRE_MODULO]-page .entregables-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.[NOMBRE_MODULO]-page .entregables-icon {
    font-size: 2.5rem;
}

.[NOMBRE_MODULO]-page .entregables-header h2 {
    margin: 0;
    color: #2d3748;
    font-size: 1.8rem;
}

.[NOMBRE_MODULO]-page .entregables-intro {
    color: #4a5568;
    font-size: 1.05rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.[NOMBRE_MODULO]-page .entregables-grid {
    display: grid;
    gap: 20px;
    margin-bottom: 30px;
}

.[NOMBRE_MODULO]-page .entregable-card {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 25px;
    display: flex;
    gap: 20px;
    transition: all 0.3s ease;
}

.[NOMBRE_MODULO]-page .entregable-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    transform: translateY(-2px);
}

.[NOMBRE_MODULO]-page .entregable-card.priority-critical {
    border-left: 4px solid #dc2626;
}

.[NOMBRE_MODULO]-page .entregable-card.priority-high {
    border-left: 4px solid #f59e0b;
}

.[NOMBRE_MODULO]-page .entregable-card.priority-medium {
    border-left: 4px solid #88B04B;
}

.[NOMBRE_MODULO]-page .entregable-icon {
    font-size: 3rem;
    color: #667eea;
    display: flex;
    align-items: center;
}

.[NOMBRE_MODULO]-page .entregable-content {
    flex: 1;
}

.[NOMBRE_MODULO]-page .entregable-content h3 {
    margin: 0 0 10px 0;
    color: #2d3748;
    font-size: 1.3rem;
}

.[NOMBRE_MODULO]-page .entregable-desc {
    color: #4a5568;
    margin-bottom: 15px;
    line-height: 1.6;
}

.[NOMBRE_MODULO]-page .entregable-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 15px;
}

.[NOMBRE_MODULO]-page .meta-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.[NOMBRE_MODULO]-page .meta-badge.priority {
    background: #fef3c7;
    color: #92400e;
}

.[NOMBRE_MODULO]-page .meta-badge.impact {
    background: #dbeafe;
    color: #1e40af;
}

.[NOMBRE_MODULO]-page .btn-download {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #667eea;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.[NOMBRE_MODULO]-page .btn-download:hover {
    background: #5568d3;
    transform: translateX(5px);
    color: white;
}

.[NOMBRE_MODULO]-page .como-usar-entregables {
    background: white;
    padding: 25px;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
}

.[NOMBRE_MODULO]-page .como-usar-entregables h3 {
    margin-top: 0;
    color: #2d3748;
    margin-bottom: 15px;
}

.[NOMBRE_MODULO]-page .uso-list {
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 20px;
}

.[NOMBRE_MODULO]-page .uso-list li {
    margin-bottom: 10px;
}

.[NOMBRE_MODULO]-page .entregables-tip {
    display: flex;
    gap: 15px;
    background: #fef3c7;
    padding: 15px;
    border-radius: 6px;
    border-left: 4px solid #f59e0b;
}

.[NOMBRE_MODULO]-page .tip-icon {
    font-size: 1.5rem;
}

.[NOMBRE_MODULO]-page .entregables-tip p {
    margin: 0;
    color: #78350f;
}

/* ===== SECCIÓN ANTES/DESPUÉS ===== */
.[NOMBRE_MODULO]-page .antes-despues-section {
    margin-bottom: 40px;
}

.[NOMBRE_MODULO]-page .antes-despues-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.[NOMBRE_MODULO]-page .antes-despues-icon {
    font-size: 2.5rem;
}

.[NOMBRE_MODULO]-page .antes-despues-header h2 {
    margin: 0;
    color: #2d3748;
}

.[NOMBRE_MODULO]-page .comparacion-grid {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 30px;
    align-items: center;
}

@media (max-width: 968px) {
    .[NOMBRE_MODULO]-page .comparacion-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

.[NOMBRE_MODULO]-page .comparacion-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.[NOMBRE_MODULO]-page .comparacion-card.estado-actual {
    border: 2px solid #fca5a5;
}

.[NOMBRE_MODULO]-page .comparacion-card.estado-optimizado {
    border: 2px solid #86efac;
}

.[NOMBRE_MODULO]-page .comparacion-header {
    margin-bottom: 20px;
}

.[NOMBRE_MODULO]-page .estado-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.[NOMBRE_MODULO]-page .estado-badge.actual {
    background: #fef2f2;
    color: #991b1b;
}

.[NOMBRE_MODULO]-page .estado-badge.optimizado {
    background: #f0fdf4;
    color: #166534;
}

.[NOMBRE_MODULO]-page .comparacion-header h3 {
    margin: 0;
    color: #2d3748;
    font-size: 1.3rem;
}

.[NOMBRE_MODULO]-page .metricas-lista {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.[NOMBRE_MODULO]-page .metrica-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 6px;
}

.[NOMBRE_MODULO]-page .metrica-item.negativo {
    background: #fef2f2;
    border-left: 3px solid #dc2626;
}

.[NOMBRE_MODULO]-page .metrica-item.positivo {
    background: #f0fdf4;
    border-left: 3px solid #16a34a;
}

.[NOMBRE_MODULO]-page .metrica-valor {
    font-size: 1.5rem;
    font-weight: 700;
    min-width: 60px;
}

.[NOMBRE_MODULO]-page .metrica-item.negativo .metrica-valor {
    color: #dc2626;
}

.[NOMBRE_MODULO]-page .metrica-item.positivo .metrica-valor {
    color: #16a34a;
}

.[NOMBRE_MODULO]-page .metrica-label {
    color: #4a5568;
    font-size: 0.95rem;
}

.[NOMBRE_MODULO]-page .impacto-resumen {
    padding: 15px;
    border-radius: 6px;
    font-size: 0.95rem;
}

.[NOMBRE_MODULO]-page .impacto-resumen.negativo {
    background: #fef2f2;
    color: #991b1b;
}

.[NOMBRE_MODULO]-page .impacto-resumen.positivo {
    background: #f0fdf4;
    color: #166534;
}

.[NOMBRE_MODULO]-page .comparacion-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    color: #667eea;
    font-size: 2rem;
}

.[NOMBRE_MODULO]-page .comparacion-arrow span {
    font-size: 0.85rem;
    font-weight: 600;
    text-align: center;
}

@media (max-width: 968px) {
    .[NOMBRE_MODULO]-page .comparacion-arrow {
        transform: rotate(90deg);
    }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .[NOMBRE_MODULO]-page .concepto-educativo,
    .[NOMBRE_MODULO]-page .entregables-section {
        padding: 20px;
    }

    .[NOMBRE_MODULO]-page .entregable-card {
        flex-direction: column;
    }

    .[NOMBRE_MODULO]-page .entregable-icon {
        font-size: 2rem;
    }
}

/* ===== ESTILOS PARA IMPRESIÓN ===== */
@media print {
    .[NOMBRE_MODULO]-page .concepto-educativo {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .[NOMBRE_MODULO]-page .btn-download {
        display: none;
    }
}
</style>
