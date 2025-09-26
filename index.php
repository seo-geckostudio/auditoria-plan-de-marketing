<?php
/**
 * SISTEMA DE GESTIÓN DE AUDITORÍAS SEO
 * ====================================
 * 
 * Archivo principal del sistema - Punto de entrada y enrutador
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

// Definir constante de seguridad
define('SISTEMA_INICIADO', true);

// Iniciar sesión
session_start();

// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivos necesarios
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/notifications.php';

// Verificar instalación de la base de datos
if (!verificarInstalacion()) {
    header('Location: install.php');
    exit;
}

// Obtener parámetros de la URL
$modulo = $_GET['modulo'] ?? 'dashboard';
$accion = $_GET['accion'] ?? 'index';

// Verificar autenticación (simplificado para demo)
if (!isset($_SESSION['usuario_id'])) {
    // Para demo, crear sesión automática con usuario admin
    $_SESSION['usuario_id'] = 1;
    $_SESSION['usuario_nombre'] = 'Administrador';
    $_SESSION['usuario_email'] = 'admin@auditoriaseo.com';
    $_SESSION['usuario_rol'] = 'admin';
}

// INCLUIR MÓDULOS (sin ejecutar las vistas aún)
switch ($modulo) {
    case 'auditorias':
        require_once __DIR__ . '/modules/auditorias.php';
        break;
        
    case 'pasos':
        require_once __DIR__ . '/modules/pasos.php';
        break;
        
    case 'archivos':
        require_once __DIR__ . '/modules/archivos.php';
        break;
        
    case 'clientes':
        require_once __DIR__ . '/modules/clientes.php';
        break;
}

// PROCESAR FORMULARIOS POST ANTES DE GENERAR HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($modulo) {
        case 'auditorias':
            if ($accion === 'crear') {
                $resultado = procesarFormulario();
                if ($resultado['success']) {
                    header('Location: ?modulo=auditorias&accion=ver&id=' . $resultado['auditoria_id']);
                    exit;
                } else {
                    $_SESSION['form_error'] = $resultado['message'];
                    $_SESSION['form_errores'] = $resultado['errores'] ?? [];
                }
            }
            break;
            
        case 'clientes':
            if ($accion === 'crear') {
                $resultado = procesarFormularioCliente();
                if ($resultado['success']) {
                    header('Location: ?modulo=clientes&success=creado');
                    exit;
                } else {
                    $_SESSION['form_error'] = $resultado['message'];
                    $_SESSION['form_errores'] = $resultado['errores'] ?? [];
                }
            }
            break;
    }
}

// PROCESAR REDIRECCIONES ANTES DE GENERAR HTML
if ($modulo === 'auditorias' && $accion === 'ver') {
    $auditoriaId = (int)($_GET['id'] ?? 0);
    
    if (!$auditoriaId) {
        header('Location: ?modulo=auditorias&accion=listar');
        exit;
    }
    
    // Verificar que la auditoría existe
    require_once __DIR__ . '/modules/auditorias.php';
    $auditoria = obtenerAuditoria($auditoriaId);
    if (!$auditoria) {
        header('Location: ?modulo=auditorias&accion=listar&error=no_encontrada');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Auditorías SEO</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 2px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .badge {
            border-radius: 20px;
            padding: 8px 12px;
            font-weight: 500;
        }
        
        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            border-radius: 10px;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: var(--light-color);
            border: none;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color) !important;
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--secondary-color);
        }
        
        /* Estados de pasos */
        .badge-pendiente { background-color: var(--secondary-color); }
        .badge-en_progreso { background-color: var(--warning-color); }
        .badge-completado { background-color: var(--success-color); }
        .badge-pausada { background-color: var(--info-color); }
        .badge-cancelada { background-color: var(--danger-color); }
        .badge-omitido { background-color: #6c757d; }
        .badge-bloqueado { background-color: var(--dark-color); }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Mostrar notificaciones -->
    <?= mostrarNotificaciones() ?>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-search-dollar"></i>
                            Auditorías SEO
                        </h4>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'dashboard') ? 'active' : '' ?>" 
                               href="?modulo=dashboard">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'auditorias') ? 'active' : '' ?>" 
                               href="?modulo=auditorias&accion=listar">
                                <i class="fas fa-clipboard-list"></i>
                                Auditorías
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'pasos') ? 'active' : '' ?>" 
                               href="?modulo=pasos&accion=plantillas">
                                <i class="fas fa-tasks"></i>
                                Plantillas de Pasos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'clientes') ? 'active' : '' ?>" 
                               href="?modulo=clientes&accion=listar">
                                <i class="fas fa-users"></i>
                                Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'reportes') ? 'active' : '' ?>" 
                               href="?modulo=reportes">
                                <i class="fas fa-chart-bar"></i>
                                Reportes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($modulo === 'configuracion') ? 'active' : '' ?>" 
                               href="?modulo=configuracion">
                                <i class="fas fa-cog"></i>
                                Configuración
                            </a>
                        </li>
                    </ul>
                    
                    <hr class="text-white-50 mt-4">
                    
                    <div class="text-center text-white-50 small">
                        <p class="mb-1">Usuario: <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></p>
                        <p class="mb-0">
                            <a href="?accion=logout" class="text-white-50">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                        </p>
                    </div>
                </div>
            </nav>
            
            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Navbar superior -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="?modulo=dashboard" class="text-decoration-none">
                                    <i class="fas fa-home"></i> Inicio
                                </a>
                            </li>
                            <?php if ($modulo !== 'dashboard'): ?>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= ucfirst($modulo) ?>
                                </li>
                            <?php endif; ?>
                        </ol>
                    </nav>
                    
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download"></i> Exportar
                            </button>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Nuevo
                        </button>
                    </div>
                </div>
                
                <!-- Mensajes de sistema -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php
                        switch ($_GET['success']) {
                            case 'creado':
                                echo 'Elemento creado exitosamente';
                                break;
                            case 'actualizado':
                                echo 'Elemento actualizado exitosamente';
                                break;
                            case 'eliminado':
                                echo 'Elemento eliminado exitosamente';
                                break;
                            default:
                                echo 'Operación completada exitosamente';
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php
                        switch ($_GET['error']) {
                            case 'no_encontrado':
                                echo 'El elemento solicitado no fue encontrado';
                                break;
                            case 'permisos':
                                echo 'No tienes permisos para realizar esta acción';
                                break;
                            case 'datos_invalidos':
                                echo 'Los datos proporcionados no son válidos';
                                break;
                            default:
                                echo 'Ha ocurrido un error. Por favor, inténtalo de nuevo';
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Contenido dinámico -->
                <div class="fade-in">
                    <?php
                    // Enrutador principal - Ejecutar módulos dentro del marco HTML
                    switch ($modulo) {
                        case 'dashboard':
                            include __DIR__ . '/views/dashboard.php';
                            break;
                            
                        case 'auditorias':
                            manejarAuditorias();
                            break;
                            
                        case 'pasos':
                            manejarPasos();
                            break;
                            
                        case 'archivos':
                            manejarArchivos();
                            break;
                            
                        case 'clientes':
                            manejarClientes();
                            break;
                            
                        case 'reportes':
                            include __DIR__ . '/views/reportes/index.php';
                            break;
                            
                        case 'configuracion':
                            include __DIR__ . '/views/configuracion/index.php';
                            break;
                            
                        default:
                            include __DIR__ . '/views/dashboard.php';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script>
        // Funciones globales del sistema
        
        /**
         * Actualiza el estado de un paso via AJAX
         */
        function actualizarEstadoPaso(pasoId, auditoriaId, nuevoEstado) {
            const formData = new FormData();
            formData.append('accion', 'actualizar_paso');
            formData.append('paso_id', pasoId);
            formData.append('auditoria_id', auditoriaId);
            formData.append('estado', nuevoEstado);
            formData.append('usuario_id', <?= $_SESSION['usuario_id'] ?>);
            formData.append('csrf_token', '<?= generarTokenCSRF() ?>');
            
            fetch('?modulo=pasos&accion=actualizar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarMensaje('success', data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    mostrarMensaje('error', data.message);
                }
            })
            .catch(error => {
                mostrarMensaje('error', 'Error de conexión');
                console.error('Error:', error);
            });
        }
        
        /**
         * Sube un archivo via AJAX
         */
        function subirArchivo(formElement) {
            const formData = new FormData(formElement);
            formData.append('accion', 'subir_archivo');
            formData.append('usuario_id', <?= $_SESSION['usuario_id'] ?>);
            formData.append('csrf_token', '<?= generarTokenCSRF() ?>');
            
            // Mostrar indicador de carga
            const submitBtn = formElement.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subiendo...';
            submitBtn.disabled = true;
            
            fetch('?modulo=archivos&accion=subir', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarMensaje('success', data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    mostrarMensaje('error', data.message);
                }
            })
            .catch(error => {
                mostrarMensaje('error', 'Error al subir archivo');
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }
        
        /**
         * Muestra mensajes de notificación
         */
        function mostrarMensaje(tipo, mensaje) {
            const alertClass = tipo === 'success' ? 'alert-success' : 'alert-danger';
            const iconClass = tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
            
            const alertHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="fas ${iconClass} me-2"></i>
                    ${mensaje}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Insertar al inicio del contenido principal
            const mainContent = document.querySelector('.main-content');
            const firstChild = mainContent.firstElementChild;
            firstChild.insertAdjacentHTML('afterend', alertHTML);
        }
        
        /**
         * Confirma acción de eliminación
         */
        function confirmarEliminacion(mensaje = '¿Estás seguro de que deseas eliminar este elemento?') {
            return confirm(mensaje);
        }
        
        /**
         * Inicializa tooltips de Bootstrap
         */
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        
        /**
         * Auto-ocultar alertas después de 5 segundos
         */
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>