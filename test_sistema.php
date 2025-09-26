<?php
/**
 * BATERÍA DE TESTS DEL SISTEMA
 * 
 * Este script realiza una serie de tests automatizados para verificar
 * que todas las funcionalidades del sistema funcionan correctamente.
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

// Configurar para mostrar todos los errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir funciones del sistema
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/modules/clientes.php';
require_once __DIR__ . '/modules/auditorias.php';

// Inicializar variables de test
$tests_ejecutados = 0;
$tests_exitosos = 0;
$tests_fallidos = 0;
$errores = [];

/**
 * Ejecuta un test y registra el resultado
 */
function ejecutarTest($nombre, $funcion) {
    global $tests_ejecutados, $tests_exitosos, $tests_fallidos, $errores;
    
    $tests_ejecutados++;
    echo "<div class='test-item'>";
    echo "<h4>🧪 Test: $nombre</h4>";
    
    try {
        $resultado = $funcion();
        if ($resultado === true) {
            $tests_exitosos++;
            echo "<div class='alert alert-success'>✅ EXITOSO</div>";
        } else {
            $tests_fallidos++;
            $errores[] = "$nombre: $resultado";
            echo "<div class='alert alert-danger'>❌ FALLIDO: $resultado</div>";
        }
    } catch (Exception $e) {
        $tests_fallidos++;
        $error = $e->getMessage();
        $errores[] = "$nombre: $error";
        echo "<div class='alert alert-danger'>❌ ERROR: $error</div>";
    }
    
    echo "</div>";
}

/**
 * Test de conexión a la base de datos
 */
function testConexionBD() {
    try {
        $pdo = obtenerConexion();
        if ($pdo) {
            return true;
        } else {
            return "No se pudo establecer conexión con la base de datos";
        }
    } catch (Exception $e) {
        return "Error de conexión: " . $e->getMessage();
    }
}

/**
 * Test de verificación de instalación
 */
function testVerificacionInstalacion() {
    if (verificarInstalacion()) {
        return true;
    } else {
        return "El sistema no está correctamente instalado";
    }
}

/**
 * Test de funciones de clientes
 */
function testFuncionesClientes() {
    // Verificar que existan clientes
    $clientes = obtenerClientesFiltrados([]);
    if (!is_array($clientes)) {
        return "Error al obtener lista de clientes";
    }
    
    // Si hay clientes, verificar que se puedan obtener por ID
    if (count($clientes) > 0) {
        $cliente = obtenerClientePorId($clientes[0]['id']);
        if (!$cliente) {
            return "Error al obtener cliente por ID";
        }
    }
    
    return true;
}

/**
 * Test de funciones de auditorías
 */
function testFuncionesAuditorias() {
    // Verificar que se puedan obtener auditorías
    $sql = "SELECT COUNT(*) as total FROM auditorias";
    $resultado = obtenerRegistro($sql);
    if ($resultado === false) {
        return "Error al consultar tabla de auditorías";
    }
    
    return true;
}

/**
 * Test de funciones de pasos
 */
function testFuncionesPasos() {
    // Verificar que se puedan obtener pasos de plantilla
    $sql = "SELECT COUNT(*) as total FROM pasos_plantilla";
    $resultado = obtenerRegistro($sql);
    if ($resultado === false) {
        return "Error al consultar tabla de pasos_plantilla";
    }
    
    return true;
}

/**
 * Test de funciones de archivos
 */
function testFuncionesArchivos() {
    // Verificar que se puedan obtener archivos
    $sql = "SELECT COUNT(*) as total FROM archivos";
    $resultado = obtenerRegistro($sql);
    if ($resultado === false) {
        return "Error al consultar tabla de archivos";
    }
    
    return true;
}

/**
 * Test de seguridad CSRF
 */
function testSeguridadCSRF() {
    // Generar token CSRF
    $token = generarTokenCSRF();
    if (empty($token)) {
        return "Error al generar token CSRF";
    }
    
    // Verificar token
    if (!verificarTokenCSRF($token)) {
        return "Error al verificar token CSRF válido";
    }
    
    // Verificar token inválido
    if (verificarTokenCSRF('token_invalido')) {
        return "El sistema acepta tokens CSRF inválidos";
    }
    
    return true;
}

/**
 * Test de funciones de sanitización
 */
function testSanitizacion() {
    $texto_sucio = "<script>alert('xss')</script>Texto normal";
    $texto_limpio = sanitizar($texto_sucio);
    
    if (strpos($texto_limpio, '<script>') !== false) {
        return "La función sanitizar no está eliminando scripts";
    }
    
    if (strpos($texto_limpio, 'Texto normal') === false) {
        return "La función sanitizar está eliminando texto válido";
    }
    
    return true;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests del Sistema - Auditorías SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .test-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .stats-card {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">
                    <i class="fas fa-vial"></i>
                    Batería de Tests del Sistema
                </h1>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Ejecutando tests automatizados para verificar el funcionamiento del sistema...
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <?php
            // Ejecutar todos los tests
            ejecutarTest("Conexión a Base de Datos", "testConexionBD");
            ejecutarTest("Verificación de Instalación", "testVerificacionInstalacion");
            ejecutarTest("Funciones de Clientes", "testFuncionesClientes");
            ejecutarTest("Funciones de Auditorías", "testFuncionesAuditorias");
            ejecutarTest("Funciones de Pasos", "testFuncionesPasos");
            ejecutarTest("Funciones de Archivos", "testFuncionesArchivos");
            ejecutarTest("Seguridad CSRF", "testSeguridadCSRF");
            ejecutarTest("Sanitización de Datos", "testSanitizacion");
            ?>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <h3><?= $tests_ejecutados ?></h3>
                        <p>Tests Ejecutados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body">
                        <h3><?= $tests_exitosos ?></h3>
                        <p>Tests Exitosos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-danger text-white">
                    <div class="card-body">
                        <h3><?= $tests_fallidos ?></h3>
                        <p>Tests Fallidos</p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if (!empty($errores)): ?>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle"></i>
                            Errores Encontrados
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php foreach ($errores as $error): ?>
                                <li class="mb-2">
                                    <i class="fas fa-times text-danger"></i>
                                    <?= htmlspecialchars($error) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert <?= $tests_fallidos == 0 ? 'alert-success' : 'alert-warning' ?>">
                    <?php if ($tests_fallidos == 0): ?>
                        <i class="fas fa-check-circle"></i>
                        <strong>¡Todos los tests pasaron exitosamente!</strong>
                        El sistema está funcionando correctamente.
                    <?php else: ?>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Se encontraron <?= $tests_fallidos ?> errores.</strong>
                        Revisa los detalles arriba para corregir los problemas.
                    <?php endif; ?>
                </div>
                
                <div class="text-center">
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-home"></i>
                        Volver al Sistema
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>