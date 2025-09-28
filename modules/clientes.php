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
 * Prepara los datos para la vista de crear cliente
 */
function prepararDatosCrearCliente() {
    return [];
}

/**
 * Prepara los datos para la vista de editar cliente
 */
function prepararDatosEditarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Obtener datos del cliente
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    return ['cliente' => $cliente];
}

/**
 * Prepara los datos para la vista de ver cliente
 */
function prepararDatosVerCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Obtener datos del cliente
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Obtener auditorías del cliente
    $auditorias = obtenerAuditoriasPorCliente($clienteId);
    
    // Obtener estadísticas del cliente
    $estadisticas = obtenerEstadisticasCliente($clienteId);
    
    return [
        'cliente' => $cliente,
        'auditorias' => $auditorias,
        'estadisticas' => $estadisticas
    ];
}

// =====================================================
// FUNCIONES DE PROCESAMIENTO (CON REDIRECCIÓN)
// =====================================================

/**
 * Procesa la eliminación (desactivación) de un cliente
 */
function procesarEliminarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Verificar que el cliente existe
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Verificar que no tenga auditorías activas
    $auditoriasActivas = contarAuditoriasActivasCliente($clienteId);
    if ($auditoriasActivas > 0) {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=tiene_auditorias_activas');
        exit;
    }
    
    // Desactivar cliente
    $resultado = desactivarCliente($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=listar&mensaje=cliente_desactivado');
    } else {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=error_desactivar');
    }
    exit;
}

/**
 * Procesa el borrado permanente de un cliente
 */
function procesarBorrarClientePermanente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Verificar que el cliente existe
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Verificar que no tenga auditorías (activas o inactivas)
    $totalAuditorias = contarTodasAuditoriasCliente($clienteId);
    if ($totalAuditorias > 0) {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=tiene_auditorias');
        exit;
    }
    
    // Borrar cliente permanentemente
    $resultado = borrarClienteDefinitivamente($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=listar&mensaje=cliente_borrado');
    } else {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=error_borrar');
    }
    exit;
}

/**
 * Procesa la activación de un cliente
 */
function procesarActivarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Verificar que el cliente existe
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Activar cliente
    $resultado = activarCliente($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=listar&mensaje=cliente_activado');
    } else {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=error_activar');
    }
    exit;
}

// =====================================================
// FUNCIÓN DE GENERACIÓN DE VISTAS
// =====================================================

/**
 * Genera la vista correspondiente según la acción y los datos
 */
function generarVistaClientes($accion, $datos) {
    // Extraer variables para las vistas
    extract($datos);
    
    switch ($accion) {
        case 'listar':
            include __DIR__ . '/../views/clientes/lista.php';
            break;
            
        case 'crear':
            include __DIR__ . '/../views/clientes/crear.php';
            break;
            
        case 'editar':
            include __DIR__ . '/../views/clientes/editar.php';
            break;
            
        case 'ver':
            include __DIR__ . '/../views/clientes/ver.php';
            break;
    }
}

// =====================================================
// FUNCIONES DE VISTA (OBSOLETAS - MANTENER POR COMPATIBILIDAD)
// =====================================================

/**
 * Muestra la lista de clientes con filtros y paginación
 */
function listarClientes() {
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
    
    include __DIR__ . '/../views/clientes/lista.php';
}

/**
 * Muestra el formulario para crear un nuevo cliente
 */
function crearCliente() {
    // Solo mostrar la vista - el procesamiento se hace en processor.php
    include __DIR__ . '/../views/clientes/crear.php';
}

/**
 * Muestra el formulario para editar un cliente existente
 */
function editarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Obtener datos del cliente
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Solo mostrar la vista - el procesamiento se hace en processor.php
    include __DIR__ . '/../views/clientes/editar.php';
}

/**
 * Muestra los detalles de un cliente específico
 */
function verCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Obtener datos del cliente
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Obtener auditorías del cliente
    $auditorias = obtenerAuditoriasPorCliente($clienteId);
    
    // Obtener estadísticas del cliente
    $estadisticas = obtenerEstadisticasCliente($clienteId);
    
    include __DIR__ . '/../views/clientes/ver.php';
}

/**
 * Elimina (desactiva) un cliente
 */
function eliminarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Verificar que el cliente existe
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Verificar que no tenga auditorías activas
    $auditoriasActivas = contarAuditoriasActivasCliente($clienteId);
    if ($auditoriasActivas > 0) {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=tiene_auditorias_activas');
        exit;
    }
    
    // Desactivar cliente
    $resultado = desactivarCliente($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=listar&mensaje=cliente_desactivado');
    } else {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=error_desactivar');
    }
    exit;
}

/**
 * Borra permanentemente un cliente del sistema
 */
function borrarClientePermanente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Verificar que el cliente existe
    $cliente = obtenerClientePorId($clienteId);
    if (!$cliente) {
        header('Location: ?modulo=clientes&accion=listar&error=cliente_no_encontrado');
        exit;
    }
    
    // Verificar que no tenga auditorías (activas o inactivas)
    $totalAuditorias = contarTodasAuditoriasCliente($clienteId);
    if ($totalAuditorias > 0) {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=tiene_auditorias');
        exit;
    }
    
    // Borrar cliente permanentemente
    $resultado = borrarClienteDefinitivamente($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=listar&mensaje=cliente_borrado');
    } else {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&error=error_borrar');
    }
    exit;
}

/**
 * Activa un cliente desactivado
 */
function activarCliente() {
    $clienteId = $_GET['id'] ?? 0;
    
    if (!$clienteId) {
        header('Location: ?modulo=clientes&accion=listar&error=id_requerido');
        exit;
    }
    
    // Activar cliente
    $resultado = activarClientePorId($clienteId);
    if ($resultado) {
        header('Location: ?modulo=clientes&accion=ver&id=' . $clienteId . '&mensaje=cliente_activado');
    } else {
        header('Location: ?modulo=clientes&accion=listar&error=error_activar');
    }
    exit;
}

// =====================================================
// FUNCIONES DE PROCESAMIENTO
// =====================================================

/**
 * Procesa la creación de un nuevo cliente (wrapper para compatibilidad con index.php)
 *
 * @return array Resultado del procesamiento
 */
function procesarFormularioCliente() {
    return procesarCrearCliente();
}

/**
 * Procesa la creación de un nuevo cliente
 *
 * @return array Resultado del procesamiento
 */
function procesarCrearCliente() {
    // Debug: Log inicio del proceso
    error_log("DEBUG: Iniciando procesarCrearCliente");
    error_log("DEBUG: POST data: " . print_r($_POST, true));
    
    // Validar token CSRF
    if (!verificarTokenCSRF($_POST['csrf_token'] ?? '')) {
        error_log("DEBUG: Token CSRF inválido");
        return ['success' => false, 'message' => 'Token de seguridad inválido'];
    }
    error_log("DEBUG: Token CSRF válido");
    
    // Validar datos requeridos
    $errores = validarDatosCliente($_POST);
    if (!empty($errores)) {
        error_log("DEBUG: Errores de validación: " . print_r($errores, true));
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    error_log("DEBUG: Validación de datos exitosa");
    
    // Verificar que no exista un cliente con el mismo email
    if (!empty($_POST['contacto_email']) && existeClienteConEmail($_POST['contacto_email'])) {
        error_log("DEBUG: Cliente con email ya existe: " . $_POST['contacto_email']);
        return ['success' => false, 'message' => 'Ya existe un cliente con ese email'];
    }
    error_log("DEBUG: Email único verificado");
    
    $datos = [
        'nombre_empresa' => sanitizar($_POST['nombre_empresa']),
        'contacto_nombre' => sanitizar($_POST['contacto_nombre'] ?? ''),
        'contacto_email' => sanitizar($_POST['contacto_email'] ?? ''),
        'contacto_telefono' => sanitizar($_POST['contacto_telefono'] ?? ''),
        'sector' => sanitizar($_POST['sector'] ?? ''),
        'url_principal' => sanitizar($_POST['sitio_web'] ?? ''),
        'pais' => sanitizar($_POST['pais'] ?? ''),
        'notas' => sanitizar($_POST['notas'] ?? ''),
        'activo' => isset($_POST['activo']) ? (int)$_POST['activo'] : 1
    ];
    
    error_log("DEBUG: Datos preparados para insertar: " . print_r($datos, true));
    
    $clienteId = insertarRegistro('clientes', $datos);
    
    error_log("DEBUG: Resultado de insertarRegistro: " . ($clienteId ? $clienteId : 'false'));
    
    if ($clienteId) {
        error_log("DEBUG: Cliente creado exitosamente con ID: " . $clienteId);
        return [
            'success' => true, 
            'message' => 'Cliente creado exitosamente',
            'cliente_id' => $clienteId
        ];
    } else {
        error_log("DEBUG: Error al crear el cliente");
        return ['success' => false, 'message' => 'Error al crear el cliente'];
    }
}

/**
 * Procesa la edición de un cliente existente
 * 
 * @param int $clienteId ID del cliente a editar
 * @return array Resultado del procesamiento
 */
function procesarEditarCliente($clienteId) {
    // Validar token CSRF
    if (!verificarTokenCSRF($_POST['csrf_token'] ?? '')) {
        return ['success' => false, 'message' => 'Token de seguridad inválido'];
    }
    
    // Validar datos requeridos
    $errores = validarDatosCliente($_POST, $clienteId);
    if (!empty($errores)) {
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    
    // Verificar que no exista otro cliente con el mismo email
    if (existeClienteConEmail($_POST['contacto_email'], $clienteId)) {
        return ['success' => false, 'message' => 'Ya existe otro cliente con ese email'];
    }
    
    $datos = [
        'nombre_empresa' => sanitizar($_POST['nombre_empresa']),
        'contacto_nombre' => sanitizar($_POST['contacto_nombre'] ?? ''),
        'contacto_email' => sanitizar($_POST['contacto_email'] ?? ''),
        'contacto_telefono' => sanitizar($_POST['contacto_telefono'] ?? ''),
        'sector' => sanitizar($_POST['sector'] ?? ''),
        'url_principal' => sanitizar($_POST['url_principal'] ?? ''),
        'pais' => sanitizar($_POST['pais'] ?? ''),
        'notas' => sanitizar($_POST['notas'] ?? ''),
        'activo' => isset($_POST['activo']) ? (int)$_POST['activo'] : 1
    ];
    
    $resultado = actualizarRegistro('clientes', $clienteId, $datos);
    
    if ($resultado) {
        return [
            'success' => true, 
            'message' => 'Cliente actualizado exitosamente'
        ];
    } else {
        return ['success' => false, 'message' => 'Error al actualizar el cliente'];
    }
}

// =====================================================
// FUNCIONES DE VALIDACIÓN
// =====================================================

/**
 * Valida los datos de un cliente
 * 
 * @param array $datos Datos a validar
 * @param int $clienteId ID del cliente (para edición)
 * @return array Errores encontrados
 */
function validarDatosCliente($datos, $clienteId = null) {
    $errores = [];
    
    // Nombre de empresa es requerido
    if (empty($datos['nombre_empresa'])) {
        $errores['nombre_empresa'] = 'El nombre de la empresa es requerido';
    } elseif (strlen($datos['nombre_empresa']) > 200) {
        $errores['nombre_empresa'] = 'El nombre de la empresa no puede exceder 200 caracteres';
    }
    
    // Validar email si se proporciona
    if (!empty($datos['contacto_email'])) {
        if (!filter_var($datos['contacto_email'], FILTER_VALIDATE_EMAIL)) {
            $errores['contacto_email'] = 'El email no tiene un formato válido';
        } elseif (strlen($datos['contacto_email']) > 150) {
            $errores['contacto_email'] = 'El email no puede exceder 150 caracteres';
        }
    }
    
    // Validar URL si se proporciona
    if (!empty($datos['url_principal'])) {
        if (!filter_var($datos['url_principal'], FILTER_VALIDATE_URL)) {
            $errores['url_principal'] = 'La URL no tiene un formato válido';
        } elseif (strlen($datos['url_principal']) > 255) {
            $errores['url_principal'] = 'La URL no puede exceder 255 caracteres';
        }
    }
    
    // Validar longitud de campos opcionales
    if (!empty($datos['contacto_nombre']) && strlen($datos['contacto_nombre']) > 100) {
        $errores['contacto_nombre'] = 'El nombre de contacto no puede exceder 100 caracteres';
    }
    
    if (!empty($datos['contacto_telefono']) && strlen($datos['contacto_telefono']) > 20) {
        $errores['contacto_telefono'] = 'El teléfono no puede exceder 20 caracteres';
    }
    
    if (!empty($datos['sector']) && strlen($datos['sector']) > 100) {
        $errores['sector'] = 'El sector no puede exceder 100 caracteres';
    }
    
    if (!empty($datos['pais']) && strlen($datos['pais']) > 50) {
        $errores['pais'] = 'El país no puede exceder 50 caracteres';
    }
    
    return $errores;
}

// =====================================================
// FUNCIONES DE BASE DE DATOS
// =====================================================

/**
 * Obtiene clientes filtrados
 * 
 * @param array $filtros Filtros a aplicar
 * @return array Lista de clientes
 */
function obtenerClientesFiltrados($filtros = []) {
    $sql = "SELECT * FROM clientes WHERE 1=1";
    $params = [];
    
    if (!empty($filtros['busqueda'])) {
        $sql .= " AND (nombre_empresa LIKE ? OR contacto_nombre LIKE ? OR contacto_email LIKE ?)";
        $busqueda = '%' . $filtros['busqueda'] . '%';
        $params[] = $busqueda;
        $params[] = $busqueda;
        $params[] = $busqueda;
    }
    
    if (!empty($filtros['sector'])) {
        $sql .= " AND sector = ?";
        $params[] = $filtros['sector'];
    }
    
    if (!empty($filtros['pais'])) {
        $sql .= " AND pais = ?";
        $params[] = $filtros['pais'];
    }
    
    if ($filtros['activo'] !== '') {
        $sql .= " AND activo = ?";
        $params[] = $filtros['activo'];
    }
    
    $sql .= " ORDER BY nombre_empresa ASC";
    
    $resultado = ejecutarConsulta($sql, $params);
    return is_array($resultado) ? $resultado : [];
}

/**
 * Obtiene un cliente por su ID
 * 
 * @param int $clienteId ID del cliente
 * @return array|false Datos del cliente
 */
function obtenerClientePorId($clienteId) {
    $sql = "SELECT * FROM clientes WHERE id = ?";
    return obtenerRegistro($sql, [$clienteId]);
}

/**
 * Verifica si existe un cliente con el email dado
 * 
 * @param string $email Email a verificar
 * @param int $excluirId ID a excluir de la búsqueda
 * @return bool True si existe
 */
function existeClienteConEmail($email, $excluirId = null) {
    if (empty($email)) return false;
    
    $sql = "SELECT COUNT(*) as total FROM clientes WHERE contacto_email = ?";
    $params = [$email];
    
    if ($excluirId) {
        $sql .= " AND id != ?";
        $params[] = $excluirId;
    }
    
    $resultado = obtenerRegistro($sql, $params);
    return $resultado && $resultado['total'] > 0;
}

/**
 * Obtiene auditorías de un cliente
 * 
 * @param int $clienteId ID del cliente
 * @return array Lista de auditorías
 */
function obtenerAuditoriasPorCliente($clienteId) {
    $sql = "
        SELECT a.*, u.nombre as usuario_nombre
        FROM auditorias a
        LEFT JOIN usuarios u ON a.usuario_id = u.id
        WHERE a.cliente_id = ?
        ORDER BY a.fecha_inicio DESC
    ";
    
    $resultado = ejecutarConsulta($sql, [$clienteId]);
    return is_array($resultado) ? $resultado : [];
}

/**
 * Cuenta auditorías activas de un cliente
 * 
 * @param int $clienteId ID del cliente
 * @return int Número de auditorías activas
 */
function contarAuditoriasActivasCliente($clienteId) {
    $sql = "SELECT COUNT(*) as total FROM auditorias WHERE cliente_id = ? AND estado IN ('planificada', 'en_progreso')";
    $resultado = obtenerRegistro($sql, [$clienteId]);
    return $resultado ? $resultado['total'] : 0;
}

/**
 * Obtiene estadísticas de un cliente
 * 
 * @param int $clienteId ID del cliente
 * @return array Estadísticas del cliente
 */
function obtenerEstadisticasCliente($clienteId) {
    try {
        $pdo = obtenerConexion();
        
        $stats = [];
        
        // Total de auditorías
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM auditorias WHERE cliente_id = ?");
        $stmt->execute([$clienteId]);
        $stats['total_auditorias'] = $stmt->fetchColumn();
        
        // Auditorías por estado
        $stmt = $pdo->prepare("
            SELECT estado, COUNT(*) as total 
            FROM auditorias 
            WHERE cliente_id = ? 
            GROUP BY estado
        ");
        $stmt->execute([$clienteId]);
        $stats['auditorias_por_estado'] = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        // Progreso promedio
        $stmt = $pdo->prepare("
            SELECT AVG(porcentaje_completado) as promedio 
            FROM auditorias 
            WHERE cliente_id = ? AND estado != 'cancelada'
        ");
        $stmt->execute([$clienteId]);
        $stats['progreso_promedio'] = round($stmt->fetchColumn(), 2);
        
        return $stats;
        
    } catch (Exception $e) {
        registrarError("Error obteniendo estadísticas del cliente: " . $e->getMessage());
        return [
            'total_auditorias' => 0,
            'auditorias_por_estado' => [],
            'progreso_promedio' => 0
        ];
    }
}

/**
 * Desactiva un cliente
 * 
 * @param int $clienteId ID del cliente
 * @return bool True si se desactivó correctamente
 */
function desactivarCliente($clienteId) {
    return actualizarRegistro('clientes', $clienteId, ['activo' => 0]);
}

/**
 * Activa un cliente
 * 
 * @param int $clienteId ID del cliente
 * @return bool True si se activó correctamente
 */
function activarClientePorId($clienteId) {
    return actualizarRegistro('clientes', $clienteId, ['activo' => 1]);
}

/**
 * Cuenta todas las auditorías de un cliente (activas e inactivas)
 * 
 * @param int $clienteId ID del cliente
 * @return int Número total de auditorías
 */
function contarTodasAuditoriasCliente($clienteId) {
    $sql = "SELECT COUNT(*) as total FROM auditorias WHERE cliente_id = ?";
    $resultado = obtenerRegistro($sql, [$clienteId]);
    return $resultado ? $resultado['total'] : 0;
}

/**
 * Borra definitivamente un cliente de la base de datos
 * 
 * @param int $clienteId ID del cliente
 * @return bool True si se borró correctamente
 */
function borrarClienteDefinitivamente($clienteId) {
    return eliminarRegistro('clientes', $clienteId);
}

/**
 * Obtiene sectores únicos de los clientes
 * 
 * @return array Lista de sectores
 */
function obtenerSectoresUnicos() {
    $sql = "SELECT DISTINCT sector FROM clientes WHERE sector IS NOT NULL AND sector != '' ORDER BY sector";
    $resultado = ejecutarConsulta($sql);
    return is_array($resultado) ? array_column($resultado, 'sector') : [];
}

/**
 * Obtiene países únicos de los clientes
 * 
 * @return array Lista de países
 */
function obtenerPaisesUnicos() {
    $sql = "SELECT DISTINCT pais FROM clientes WHERE pais IS NOT NULL AND pais != '' ORDER BY pais";
    $resultado = ejecutarConsulta($sql);
    return is_array($resultado) ? array_column($resultado, 'pais') : [];
}

?>