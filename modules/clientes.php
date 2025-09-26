<?php
/**
 * MÓDULO DE GESTIÓN DE CLIENTES
 * 
 * Este módulo maneja todas las operaciones CRUD para la gestión de clientes
 * en el sistema de auditorías SEO.
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

// Verificar que se incluya desde index.php
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/forms.php';

// =====================================================
// CONTROLADOR PRINCIPAL
// =====================================================

/**
 * Maneja las acciones del módulo de clientes
 */
function manejarClientes() {
    $accion = $_GET['accion'] ?? 'listar';
    
    // Procesar acciones que requieren redirección ANTES de generar HTML
    switch ($accion) {
        case 'eliminar':
            procesarEliminarCliente();
            return; // Termina aquí porque hace redirección
            
        case 'borrar':
            procesarBorrarClientePermanente();
            return; // Termina aquí porque hace redirección
            
        case 'activar':
            procesarActivarCliente();
            return; // Termina aquí porque hace redirección
    }
    
    // Preparar datos para las vistas (sin generar HTML aún)
    switch ($accion) {
        case 'listar':
            $datos = prepararDatosListaClientes();
            break;
            
        case 'crear':
            $datos = prepararDatosCrearCliente();
            break;
            
        case 'editar':
            $datos = prepararDatosEditarCliente();
            break;
            
        case 'ver':
            $datos = prepararDatosVerCliente();
            break;
            
        default:
            $datos = prepararDatosListaClientes();
            $accion = 'listar';
    }
    
    // Ahora generar la vista correspondiente
    generarVistaClientes($accion, $datos);
}

// =====================================================
// FUNCIONES DE PREPARACIÓN DE DATOS
// =====================================================

/**
 * Prepara los datos para la vista de lista de clientes
 */
function prepararDatosListaClientes() {
    // Obtener filtros
    $filtros = [
        'busqueda' => $_GET['busqueda'] ?? '',
        'sector' => $_GET['sector'] ?? '',
        'pais' => $_GET['pais'] ?? '',
        'activo' => $_GET['activo'] ?? ''
    ];
    
    // Obtener clientes
    $clientes = obtenerClientesFiltrados($filtros);
    
    // Obtener datos para filtros
    $sectores = obtenerSectoresUnicos();
    $paises = obtenerPaisesUnicos();
    
    return [
        'filtros' => $filtros,
        'clientes' => $clientes,
        'sectores' => $sectores,
        'paises' => $paises
    ];
}

/**
 * Prepara los datos para crear un cliente
 */
function prepararDatosCrearCliente() {
    // Procesar formulario si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return procesarCrearCliente();
    }
    
    return [
        'sectores' => obtenerSectoresUnicos(),
        'paises' => obtenerPaisesUnicos()
    ];
}

/**
 * Prepara los datos para editar un cliente
 */
function prepararDatosEditarCliente() {
    $clienteId = (int)($_GET['id'] ?? 0);
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&mensaje=error&texto=ID de cliente requerido');
        exit;
    }
    
    $cliente = obtenerCliente($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&mensaje=error&texto=Cliente no encontrado');
        exit;
    }
    
    // Procesar formulario si es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return procesarEditarCliente($clienteId, $cliente);
    }
    
    return [
        'cliente' => $cliente,
        'sectores' => obtenerSectoresUnicos(),
        'paises' => obtenerPaisesUnicos()
    ];
}

/**
 * Prepara los datos para ver un cliente
 */
function prepararDatosVerCliente() {
    $clienteId = (int)($_GET['id'] ?? 0);
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&mensaje=error&texto=ID de cliente requerido');
        exit;
    }
    
    $cliente = obtenerCliente($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&mensaje=error&texto=Cliente no encontrado');
        exit;
    }
    
    // Obtener auditorías del cliente
    $auditorias = obtenerAuditorias(['cliente_id' => $clienteId]);
    
    return [
        'cliente' => $cliente,
        'auditorias' => $auditorias
    ];
}

// =====================================================
// FUNCIONES DE PROCESAMIENTO
// =====================================================

/**
 * Procesa la creación de un cliente
 */
function procesarCrearCliente() {
    // Validar datos
    $errores = validarDatosCliente($_POST);
    if (!empty($errores)) {
        return [
            'success' => false,
            'errores' => $errores,
            'datos' => $_POST,
            'sectores' => obtenerSectoresUnicos(),
            'paises' => obtenerPaisesUnicos()
        ];
    }
    
    // Preparar datos
    $datos = [
        'nombre_empresa' => sanitizar($_POST['nombre_empresa']),
        'contacto_nombre' => sanitizar($_POST['contacto_nombre'] ?? ''),
        'contacto_email' => sanitizar($_POST['contacto_email'] ?? ''),
        'contacto_telefono' => sanitizar($_POST['contacto_telefono'] ?? ''),
        'sector' => sanitizar($_POST['sector'] ?? ''),
        'url_principal' => sanitizar($_POST['url_principal'] ?? ''),
        'pais' => sanitizar($_POST['pais'] ?? ''),
        'notas' => sanitizar($_POST['notas'] ?? ''),
        'activo' => 1
    ];
    
    // Crear cliente
    $clienteId = insertarRegistro('clientes', $datos);
    
    if ($clienteId) {
        header('Location: ?modulo=clientes&mensaje=success&texto=Cliente creado exitosamente');
        exit;
    } else {
        return [
            'success' => false,
            'mensaje' => 'Error al crear el cliente',
            'datos' => $_POST,
            'sectores' => obtenerSectoresUnicos(),
            'paises' => obtenerPaisesUnicos()
        ];
    }
}

/**
 * Procesa la edición de un cliente
 */
function procesarEditarCliente($clienteId, $clienteActual) {
    // Validar datos
    $errores = validarDatosCliente($_POST, $clienteId);
    if (!empty($errores)) {
        return [
            'success' => false,
            'errores' => $errores,
            'cliente' => array_merge($clienteActual, $_POST),
            'sectores' => obtenerSectoresUnicos(),
            'paises' => obtenerPaisesUnicos()
        ];
    }
    
    // Preparar datos actualizados
    $datosNuevos = [
        'nombre_empresa' => sanitizar($_POST['nombre_empresa']),
        'contacto_nombre' => sanitizar($_POST['contacto_nombre'] ?? ''),
        'contacto_email' => sanitizar($_POST['contacto_email'] ?? ''),
        'contacto_telefono' => sanitizar($_POST['contacto_telefono'] ?? ''),
        'sector' => sanitizar($_POST['sector'] ?? ''),
        'url_principal' => sanitizar($_POST['url_principal'] ?? ''),
        'pais' => sanitizar($_POST['pais'] ?? ''),
        'notas' => sanitizar($_POST['notas'] ?? ''),
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ];
    
    // Actualizar cliente
    $resultado = actualizarRegistro('clientes', $clienteId, $datosNuevos);
    
    if ($resultado) {
        header('Location: ?modulo=clientes&mensaje=success&texto=Cliente actualizado exitosamente');
        exit;
    } else {
        return [
            'success' => false,
            'mensaje' => 'Error al actualizar el cliente',
            'cliente' => array_merge($clienteActual, $_POST),
            'sectores' => obtenerSectoresUnicos(),
            'paises' => obtenerPaisesUnicos()
        ];
    }
}

/**
 * Procesa la eliminación (desactivación) de un cliente
 */
function procesarEliminarCliente() {
    $clienteId = (int)($_GET['id'] ?? 0);
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&mensaje=error&texto=ID de cliente requerido');
        exit;
    }
    
    // Verificar si tiene auditorías activas
    $auditorias = obtenerAuditorias(['cliente_id' => $clienteId]);
    $tieneAuditoriasActivas = false;
    
    foreach ($auditorias as $auditoria) {
        if (in_array($auditoria['estado'], ['planificada', 'en_progreso'])) {
            $tieneAuditoriasActivas = true;
            break;
        }
    }
    
    if ($tieneAuditoriasActivas) {
        header('Location: ?modulo=clientes&mensaje=error&texto=No se puede eliminar un cliente con auditorías activas');
        exit;
    }
    
    // Desactivar cliente
    $resultado = actualizarRegistro('clientes', $clienteId, [
        'activo' => 0,
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ]);
    
    if ($resultado) {
        header('Location: ?modulo=clientes&mensaje=success&texto=Cliente desactivado exitosamente');
    } else {
        header('Location: ?modulo=clientes&mensaje=error&texto=Error al desactivar el cliente');
    }
    exit;
}

/**
 * Procesa la activación de un cliente
 */
function procesarActivarCliente() {
    $clienteId = (int)($_GET['id'] ?? 0);
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&mensaje=error&texto=ID de cliente requerido');
        exit;
    }
    
    // Activar cliente
    $resultado = actualizarRegistro('clientes', $clienteId, [
        'activo' => 1,
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ]);
    
    if ($resultado) {
        header('Location: ?modulo=clientes&mensaje=success&texto=Cliente activado exitosamente');
    } else {
        header('Location: ?modulo=clientes&mensaje=error&texto=Error al activar el cliente');
    }
    exit;
}

/**
 * Procesa el borrado permanente de un cliente
 */
function procesarBorrarClientePermanente() {
    $clienteId = (int)($_GET['id'] ?? 0);
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&mensaje=error&texto=ID de cliente requerido');
        exit;
    }
    
    // Verificar si tiene auditorías
    $auditorias = obtenerAuditorias(['cliente_id' => $clienteId]);
    if (!empty($auditorias)) {
        header('Location: ?modulo=clientes&mensaje=error&texto=No se puede borrar un cliente con auditorías asociadas');
        exit;
    }
    
    try {
        $pdo = obtenerConexion();
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
        $resultado = $stmt->execute([$clienteId]);
        
        if ($resultado) {
            header('Location: ?modulo=clientes&mensaje=success&texto=Cliente eliminado permanentemente');
        } else {
            header('Location: ?modulo=clientes&mensaje=error&texto=Error al eliminar el cliente');
        }
    } catch (PDOException $e) {
        registrarError("Error eliminando cliente: " . $e->getMessage());
        header('Location: ?modulo=clientes&mensaje=error&texto=Error al eliminar el cliente');
    }
    
    exit;
}

// =====================================================
// FUNCIONES DE DATOS
// =====================================================

/**
 * Obtiene clientes con filtros aplicados
 */
function obtenerClientesFiltrados($filtros) {
    $sql = "SELECT * FROM clientes WHERE 1=1";
    $params = [];
    
    // Filtro de búsqueda
    if (!empty($filtros['busqueda'])) {
        $sql .= " AND (nombre_empresa LIKE ? OR contacto_nombre LIKE ? OR contacto_email LIKE ?)";
        $busqueda = '%' . $filtros['busqueda'] . '%';
        $params[] = $busqueda;
        $params[] = $busqueda;
        $params[] = $busqueda;
    }
    
    // Filtro de sector
    if (!empty($filtros['sector'])) {
        $sql .= " AND sector = ?";
        $params[] = $filtros['sector'];
    }
    
    // Filtro de país
    if (!empty($filtros['pais'])) {
        $sql .= " AND pais = ?";
        $params[] = $filtros['pais'];
    }
    
    // Filtro de estado activo
    if ($filtros['activo'] !== '') {
        $sql .= " AND activo = ?";
        $params[] = (int)$filtros['activo'];
    }
    
    $sql .= " ORDER BY nombre_empresa";
    
    return ejecutarConsulta($sql, $params) ?: [];
}

/**
 * Obtiene sectores únicos de los clientes
 */
function obtenerSectoresUnicos() {
    $sql = "SELECT DISTINCT sector FROM clientes WHERE sector IS NOT NULL AND sector != '' ORDER BY sector";
    $resultados = ejecutarConsulta($sql);
    
    $sectores = [];
    foreach ($resultados as $resultado) {
        $sectores[] = $resultado['sector'];
    }
    
    return $sectores;
}

/**
 * Obtiene países únicos de los clientes
 */
function obtenerPaisesUnicos() {
    $sql = "SELECT DISTINCT pais FROM clientes WHERE pais IS NOT NULL AND pais != '' ORDER BY pais";
    $resultados = ejecutarConsulta($sql);
    
    $paises = [];
    foreach ($resultados as $resultado) {
        $paises[] = $resultado['pais'];
    }
    
    return $paises;
}

// =====================================================
// FUNCIONES DE VALIDACIÓN
// =====================================================

/**
 * Valida los datos de un cliente
 */
function validarDatosCliente($datos, $clienteId = null) {
    $errores = [];
    
    // Nombre de empresa requerido
    if (empty($datos['nombre_empresa'])) {
        $errores['nombre_empresa'] = 'El nombre de la empresa es requerido';
    }
    
    // Validar email si se proporciona
    if (!empty($datos['contacto_email']) && !filter_var($datos['contacto_email'], FILTER_VALIDATE_EMAIL)) {
        $errores['contacto_email'] = 'El formato del email no es válido';
    }
    
    // Validar URL si se proporciona
    if (!empty($datos['url_principal']) && !filter_var($datos['url_principal'], FILTER_VALIDATE_URL)) {
        $errores['url_principal'] = 'El formato de la URL no es válido';
    }
    
    // Verificar duplicados de nombre de empresa
    if (!empty($datos['nombre_empresa'])) {
        $sql = "SELECT id FROM clientes WHERE nombre_empresa = ?";
        $params = [$datos['nombre_empresa']];
        
        if ($clienteId) {
            $sql .= " AND id != ?";
            $params[] = $clienteId;
        }
        
        $existente = obtenerRegistro($sql, $params);
        if ($existente) {
            $errores['nombre_empresa'] = 'Ya existe un cliente con este nombre de empresa';
        }
    }
    
    return $errores;
}

// =====================================================
// FUNCIÓN DE GENERACIÓN DE VISTAS
// =====================================================

/**
 * Genera la vista correspondiente según la acción
 */
function generarVistaClientes($accion, $datos) {
    $archivoVista = __DIR__ . "/../views/clientes/{$accion}.php";
    
    if (file_exists($archivoVista)) {
        // Extraer datos para que estén disponibles en la vista
        extract($datos);
        include $archivoVista;
    } else {
        echo "<div class='alert alert-danger'>Vista no encontrada: {$accion}</div>";
    }
}

?>