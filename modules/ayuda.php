<?php
/**
 * MÓDULO DE AYUDA
 * ===============
 *
 * Módulo para gestionar el sistema de ayuda contextual
 */

require_once __DIR__ . '/../includes/functions.php';

/**
 * Controlador principal del módulo de ayuda
 */
function manejarAyuda() {
    $accion = $_GET['accion'] ?? 'general';

    switch ($accion) {
        case 'paso':
            mostrarAyudaPaso();
            break;
        case 'csv':
            mostrarEspecificacionesCSV();
            break;
        case 'herramientas':
            mostrarGuiaHerramientas();
            break;
        case 'general':
        default:
            mostrarAyudaGeneral();
            break;
    }
}

/**
 * Muestra ayuda específica de un paso
 */
function mostrarAyudaPaso() {
    include __DIR__ . '/../views/ayuda/ayuda_paso.php';
}

/**
 * Muestra especificaciones generales de CSV
 */
function mostrarEspecificacionesCSV() {
    include __DIR__ . '/../views/ayuda/especificaciones_csv.php';
}

/**
 * Muestra guía de herramientas
 */
function mostrarGuiaHerramientas() {
    include __DIR__ . '/../views/ayuda/guia_herramientas.php';
}

/**
 * Muestra ayuda general del sistema
 */
function mostrarAyudaGeneral() {
    include __DIR__ . '/../views/ayuda/ayuda_general.php';
}
?>