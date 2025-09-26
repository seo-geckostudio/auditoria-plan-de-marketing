<?php
/**
 * SISTEMA DE NOTIFICACIONES TEMPORALES
 * 
 * Maneja la visualización de mensajes de éxito, error, información y advertencia
 * mediante modales no intrusivos que no afectan el diseño principal.
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

/**
 * Muestra las notificaciones almacenadas en la sesión
 */
function mostrarNotificaciones() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $html = '';
    
    // Verificar si hay mensajes en la sesión
    $tipos = ['success', 'error', 'warning', 'info'];
    
    foreach ($tipos as $tipo) {
        if (isset($_SESSION[$tipo]) && !empty($_SESSION[$tipo])) {
            $mensaje = $_SESSION[$tipo];
            $html .= generarModalNotificacion($tipo, $mensaje);
            
            // Limpiar el mensaje de la sesión después de mostrarlo
            unset($_SESSION[$tipo]);
        }
    }
    
    return $html;
}

/**
 * Genera el HTML del modal de notificación
 */
function generarModalNotificacion($tipo, $mensaje) {
    $iconos = [
        'success' => '✓',
        'error' => '✗',
        'warning' => '⚠',
        'info' => 'ℹ'
    ];
    
    $colores = [
        'success' => '#28a745',
        'error' => '#dc3545',
        'warning' => '#ffc107',
        'info' => '#17a2b8'
    ];
    
    $icono = $iconos[$tipo] ?? 'ℹ';
    $color = $colores[$tipo] ?? '#17a2b8';
    
    $modalId = 'notification-' . $tipo . '-' . uniqid();
    
    return "
    <div id='{$modalId}' class='notification-modal' style='
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-left: 4px solid {$color};
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-radius: 4px;
        padding: 16px 20px;
        max-width: 400px;
        z-index: 9999;
        font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif;
        animation: slideInRight 0.3s ease-out;
    '>
        <div style='display: flex; align-items: flex-start; gap: 12px;'>
            <div style='
                color: {$color};
                font-size: 18px;
                font-weight: bold;
                line-height: 1;
                margin-top: 2px;
            '>{$icono}</div>
            <div style='flex: 1;'>
                <div style='
                    color: #333;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                '>{$mensaje}</div>
            </div>
            <button onclick='cerrarNotificacion(\"{$modalId}\")' style='
                background: none;
                border: none;
                color: #999;
                cursor: pointer;
                font-size: 16px;
                padding: 0;
                line-height: 1;
                margin-left: 8px;
            '>×</button>
        </div>
    </div>
    
    <style>
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .notification-modal.closing {
            animation: slideOutRight 0.3s ease-in forwards;
        }
    </style>
    
    <script>
        // Auto-cerrar después de 5 segundos
        setTimeout(function() {
            cerrarNotificacion('{$modalId}');
        }, 5000);
        
        function cerrarNotificacion(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('closing');
                setTimeout(function() {
                    if (modal.parentNode) {
                        modal.parentNode.removeChild(modal);
                    }
                }, 300);
            }
        }
    </script>
    ";
}

/**
 * Establece un mensaje de éxito
 */
function setMensajeExito($mensaje) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['success'] = $mensaje;
}

/**
 * Establece un mensaje de error
 */
function setMensajeError($mensaje) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['error'] = $mensaje;
}

/**
 * Establece un mensaje de advertencia
 */
function setMensajeAdvertencia($mensaje) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['warning'] = $mensaje;
}

/**
 * Establece un mensaje informativo
 */
function setMensajeInfo($mensaje) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['info'] = $mensaje;
}

/**
 * Verifica si hay notificaciones pendientes
 */
function hayNotificacionesPendientes() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['success']) || 
           isset($_SESSION['error']) || 
           isset($_SESSION['warning']) || 
           isset($_SESSION['info']);
}

?>