<?php
/**
 * GESTIÓN DE FORMULARIOS
 * ======================
 * 
 * Archivo para manejar todos los formularios del sistema
 * de gestión de auditorías SEO
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

require_once __DIR__ . '/functions.php';

// =====================================================
// PROCESAMIENTO DE FORMULARIOS
// =====================================================

/**
 * Procesa el formulario según la acción especificada
 * 
 * @return array Resultado del procesamiento
 */
function procesarFormulario() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return ['success' => false, 'message' => 'Método no permitido'];
    }
    
    // Verificar token CSRF
    if (!verificarTokenCSRF($_POST['csrf_token'] ?? '')) {
        return ['success' => false, 'message' => 'Token de seguridad inválido'];
    }
    
    $accion = sanitizar($_POST['accion'] ?? '');
    
    switch ($accion) {
        case 'crear_auditoria':
            return procesarCrearAuditoria();
        case 'actualizar_auditoria':
            return procesarActualizarAuditoria();
        case 'actualizar_paso':
            return procesarActualizarPaso();
        case 'subir_archivo':
            return procesarSubirArchivo();
        case 'agregar_comentario':
            return procesarAgregarComentario();
        case 'crear_cliente':
            // Esta funcionalidad se maneja ahora en modules/clientes.php
            return ['success' => false, 'message' => 'Usar el módulo de clientes para esta acción'];
        default:
            return ['success' => false, 'message' => 'Acción no válida'];
    }
}

// =====================================================
// FORMULARIOS DE AUDITORÍAS
// =====================================================

/**
 * Procesa la creación de una nueva auditoría
 * 
 * @return array Resultado del procesamiento
 */
function procesarCrearAuditoria() {
    // Validar datos requeridos
    $errores = validarDatosAuditoria($_POST);
    if (!empty($errores)) {
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    
    // Preparar datos
    $datos = [
        'cliente_id' => (int)$_POST['cliente_id'],
        'usuario_id' => (int)$_POST['usuario_id'],
        'titulo' => sanitizar($_POST['nombre']),
        'descripcion' => sanitizar($_POST['descripcion']),
        'fecha_inicio' => $_POST['fecha_inicio'],
        'fecha_fin' => $_POST['fecha_estimada_fin'] ?? null,
        'estado' => 'planificada',
        'porcentaje_completado' => 0.00
    ];
    
    // Crear auditoría
    $auditoriaId = crearAuditoria($datos);
    
    if ($auditoriaId) {
        // Crear pasos de auditoría basados en las fases seleccionadas
        if (!empty($_POST['fases'])) {
            crearPasosAuditoria($auditoriaId, $_POST['fases']);
        }
        
        return [
            'success' => true, 
            'message' => 'Auditoría creada exitosamente',
            'auditoria_id' => $auditoriaId
        ];
    } else {
        return ['success' => false, 'message' => 'Error al crear la auditoría'];
    }
}

/**
 * Procesa la actualización de una auditoría
 * 
 * @return array Resultado del procesamiento
 */
function procesarActualizarAuditoria() {
    $auditoriaId = (int)$_POST['auditoria_id'];
    
    if (!$auditoriaId) {
        return ['success' => false, 'message' => 'ID de auditoría requerido'];
    }
    
    // Obtener datos actuales para el historial
    $auditoriaActual = obtenerAuditoria($auditoriaId);
    if (!$auditoriaActual) {
        return ['success' => false, 'message' => 'Auditoría no encontrada'];
    }
    
    // Validar datos
    $errores = validarDatosAuditoria($_POST, $auditoriaId);
    if (!empty($errores)) {
        return ['success' => false, 'message' => 'Errores de validación', 'errores' => $errores];
    }
    
    // Preparar datos actualizados
    $datosNuevos = [
        'titulo' => sanitizar($_POST['nombre']),
        'descripcion' => sanitizar($_POST['descripcion']),
        'fecha_fin' => $_POST['fecha_estimada_fin'] ?? null,
        'estado' => sanitizar($_POST['estado'])
    ];
    
    // Actualizar
    $resultado = actualizarRegistro('auditorias', $auditoriaId, $datosNuevos);
    
    if ($resultado) {
        // Registrar cambio en historial
        registrarCambio($auditoriaId, $_POST['usuario_id'], 'actualizacion', 
                       'Auditoría actualizada', $auditoriaActual, $datosNuevos);
        
        return ['success' => true, 'message' => 'Auditoría actualizada exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al actualizar la auditoría'];
    }
}

/**
 * Crea los pasos de auditoría basados en las fases seleccionadas
 * 
 * @param int $auditoriaId ID de la auditoría
 * @param array $fasesSeleccionadas IDs de las fases seleccionadas
 * @return bool True si se crearon correctamente
 */
function crearPasosAuditoriaFormulario($auditoriaId, $fasesSeleccionadas) {
    return crearPasosAuditoria($auditoriaId, $fasesSeleccionadas);
}

// =====================================================
// FORMULARIOS DE PASOS
// =====================================================

/**
 * Procesa la actualización de un paso de auditoría
 * 
 * @return array Resultado del procesamiento
 */
function procesarActualizarPaso() {
    $pasoId = (int)$_POST['paso_id'];
    $auditoriaId = (int)$_POST['auditoria_id'];
    
    if (!$pasoId || !$auditoriaId) {
        return ['success' => false, 'message' => 'IDs requeridos'];
    }
    
    // Obtener datos actuales
    $pasoActual = obtenerRegistro("SELECT * FROM auditoria_pasos WHERE id = ?", [$pasoId]);
    if (!$pasoActual) {
        return ['success' => false, 'message' => 'Paso no encontrado'];
    }
    
    // Preparar datos actualizados
    $datosNuevos = [
        'estado' => sanitizar($_POST['estado']),
        'notas' => sanitizar($_POST['notas'] ?? ''),
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ];
    
    // Si se marca como completado, agregar fecha
    if ($datosNuevos['estado'] === 'completado' && $pasoActual['estado'] !== 'completado') {
        $datosNuevos['fecha_completado'] = date('Y-m-d H:i:s');
    }
    
    // Si se marca como en progreso, agregar fecha de inicio
    if ($datosNuevos['estado'] === 'en_progreso' && $pasoActual['estado'] === 'pendiente') {
        $datosNuevos['fecha_inicio'] = date('Y-m-d H:i:s');
    }
    
    // Actualizar paso
    $resultado = actualizarRegistro('auditoria_pasos', $pasoId, $datosNuevos);
    
    if ($resultado) {
        // Actualizar porcentaje de la auditoría
        actualizarPorcentajeCompletado($auditoriaId);
        
        // Registrar cambio en historial
        registrarCambio($auditoriaId, $_POST['usuario_id'] ?? 1, 'estado_paso', 
                       'Estado de paso actualizado', $pasoActual, $datosNuevos);
        
        return ['success' => true, 'message' => 'Paso actualizado exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al actualizar el paso'];
    }
}

// =====================================================
// FORMULARIOS DE ARCHIVOS
// =====================================================

/**
 * Procesa la subida de un archivo
 * 
 * @return array Resultado del procesamiento
 */
function procesarSubirArchivo() {
    $pasoId = (int)$_POST['paso_id'];
    $auditoriaId = (int)$_POST['auditoria_id'];
    
    if (!$pasoId || !$auditoriaId) {
        return ['success' => false, 'message' => 'IDs requeridos'];
    }
    
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Error al subir el archivo'];
    }
    
    $archivo = $_FILES['archivo'];
    
    // Validar archivo
    $erroresArchivo = validarArchivo($archivo);
    if (!empty($erroresArchivo)) {
        return ['success' => false, 'message' => 'Archivo no válido', 'errores' => $erroresArchivo];
    }
    
    // Generar nombre único
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombreUnico = uniqid() . '_' . time() . '.' . $extension;
    $rutaDestino = UPLOAD_PATH . $nombreUnico;
    
    // Mover archivo
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        // Guardar información en base de datos
        $datosArchivo = [
            'auditoria_paso_id' => $pasoId,
            'nombre_original' => $archivo['name'],
            'nombre_archivo' => $nombreUnico,
            'ruta_archivo' => $rutaDestino,
            'tipo_mime' => $archivo['type'],
            'tamaño_bytes' => $archivo['size'],
            'descripcion' => sanitizar($_POST['descripcion'] ?? ''),
            'subido_por_usuario_id' => $_POST['usuario_id'] ?? 1
        ];
        
        $archivoId = insertarRegistro('archivos', $datosArchivo);
        
        if ($archivoId) {
            // Registrar en historial
            registrarCambio($auditoriaId, $_POST['usuario_id'] ?? 1, 'archivo_subido', 
                           'Archivo subido: ' . $archivo['name']);
            
            return [
                'success' => true, 
                'message' => 'Archivo subido exitosamente',
                'archivo_id' => $archivoId
            ];
        } else {
            // Eliminar archivo si no se pudo guardar en BD
            unlink($rutaDestino);
            return ['success' => false, 'message' => 'Error al guardar información del archivo'];
        }
    } else {
        return ['success' => false, 'message' => 'Error al mover el archivo'];
    }
}

// =====================================================
// FORMULARIOS DE COMENTARIOS
// =====================================================

/**
 * Procesa la adición de un comentario
 * 
 * @return array Resultado del procesamiento
 */
function procesarAgregarComentario() {
    $pasoId = (int)$_POST['paso_id'];
    $auditoriaId = (int)$_POST['auditoria_id'];
    $comentario = sanitizar($_POST['comentario']);
    
    if (!$pasoId || !$auditoriaId || empty($comentario)) {
        return ['success' => false, 'message' => 'Datos requeridos faltantes'];
    }
    
    $datosComentario = [
        'auditoria_paso_id' => $pasoId,
        'usuario_id' => $_POST['usuario_id'] ?? 1,
        'comentario' => $comentario,
        'es_interno' => isset($_POST['es_interno']) ? 1 : 0
    ];
    
    $comentarioId = insertarRegistro('comentarios', $datosComentario);
    
    if ($comentarioId) {
        // Registrar en historial
        registrarCambio($auditoriaId, $_POST['usuario_id'] ?? 1, 'comentario', 
                       'Comentario agregado');
        
        return [
            'success' => true, 
            'message' => 'Comentario agregado exitosamente',
            'comentario_id' => $comentarioId
        ];
    } else {
        return ['success' => false, 'message' => 'Error al agregar el comentario'];
    }
}

// =====================================================
// FUNCIONES DE VALIDACIÓN
// =====================================================

/**
 * Valida los datos de una auditoría
 * 
 * @param array $datos Datos a validar
 * @param int $auditoriaId ID de auditoría (para edición)
 * @return array Lista de errores
 */
function validarDatosAuditoria($datos, $auditoriaId = null) {
    $errores = [];
    
    // Nombre requerido
    if (empty($datos['nombre'])) {
        $errores['nombre'] = 'El nombre de la auditoría es requerido';
    }
    
    // Cliente requerido
    if (empty($datos['cliente_id'])) {
        $errores['cliente_id'] = 'Debe seleccionar un cliente';
    }
    
    // Usuario requerido
    if (empty($datos['usuario_id'])) {
        $errores['usuario_id'] = 'Debe seleccionar un consultor';
    }
    
    // Fecha de inicio requerida
    if (empty($datos['fecha_inicio'])) {
        $errores['fecha_inicio'] = 'La fecha de inicio es requerida';
    }
    
    // Validar formato de fecha
    if (!empty($datos['fecha_inicio']) && !validarFecha($datos['fecha_inicio'])) {
        $errores['fecha_inicio'] = 'Formato de fecha inválido';
    }
    
    return $errores;
}

/**
 * Valida un archivo subido
 * 
 * @param array $archivo Información del archivo ($_FILES)
 * @return array Lista de errores
 */
function validarArchivo($archivo) {
    $errores = [];
    
    // Verificar tamaño
    if ($archivo['size'] > MAX_FILE_SIZE) {
        $errores[] = 'El archivo es demasiado grande. Máximo: ' . (MAX_FILE_SIZE / 1024 / 1024) . 'MB';
    }
    
    // Verificar extensión
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        $errores[] = 'Tipo de archivo no permitido. Permitidos: ' . implode(', ', ALLOWED_EXTENSIONS);
    }
    
    return $errores;
}

/**
 * Valida el formato de una fecha
 * 
 * @param string $fecha Fecha a validar
 * @return bool True si es válida
 */
function validarFecha($fecha) {
    $d = DateTime::createFromFormat('Y-m-d', $fecha);
    return $d && $d->format('Y-m-d') === $fecha;
}

// =====================================================
// FUNCIONES AUXILIARES PARA FORMULARIOS
// =====================================================

/**
 * Obtiene las opciones de clientes para formularios
 * 
 * @return array Lista de clientes
 */
function obtenerOpcionesClientes() {
    return obtenerClientes(['activo' => 1]);
}

/**
 * Obtiene las opciones de usuarios para formularios
 * 
 * @return array Lista de usuarios
 */
function obtenerOpcionesUsuarios() {
    return ejecutarConsulta("SELECT id, nombre FROM usuarios WHERE activo = 1 ORDER BY nombre") ?: [];
}

/**
 * Obtiene las opciones de fases para formularios
 * 
 * @return array Lista de fases
 */
function obtenerOpcionesFases() {
    return ejecutarConsulta("SELECT id, numero_fase, nombre, descripcion FROM fases WHERE activa = 1 ORDER BY orden_visualizacion") ?: [];
}

?>