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
 * @param array $fases IDs de las fases seleccionadas
 * @return bool True si se crearon correctamente
 */
function crearPasosAuditoria($auditoriaId, $fases) {
    $sql = "
        SELECT id, codigo_paso, nombre, es_critico 
        FROM pasos_plantilla 
        WHERE fase_id IN (" . implode(',', array_map('intval', $fases)) . ") 
        AND activo = 1
        ORDER BY fase_id, orden_en_fase
    ";
    
    $pasos = ejecutarConsulta($sql);
    
    foreach ($pasos as $paso) {
        $datos = [
            'auditoria_id' => $auditoriaId,
            'paso_plantilla_id' => $paso['id'],
            'estado' => 'pendiente',
            'notas' => ''
        ];
        
        insertarRegistro('auditoria_pasos', $datos);
    }
    
    return true;
}

// =====================================================
// FORMULARIOS DE PASOS
// =====================================================

/**
 * Procesa la actualización de un paso
 * 
 * @return array Resultado del procesamiento
 */
function procesarActualizarPaso() {
    $auditoriaId = (int)$_POST['auditoria_id'];
    $pasoId = (int)$_POST['paso_id'];
    $nuevoEstado = sanitizar($_POST['estado']);
    $usuarioId = (int)$_POST['usuario_id'];
    
    if (!$auditoriaId || !$pasoId || !$nuevoEstado) {
        return ['success' => false, 'message' => 'Datos requeridos faltantes'];
    }
    
    // Validar estado
    if (!array_key_exists($nuevoEstado, ESTADOS_PASO)) {
        return ['success' => false, 'message' => 'Estado no válido'];
    }
    
    // Actualizar paso
    $datos = [
        'estado' => $nuevoEstado,
        'notas' => sanitizar($_POST['notas'] ?? '')
    ];
    
    if ($nuevoEstado === 'completado') {
        $datos['fecha_completado'] = date('Y-m-d H:i:s');
    } elseif ($nuevoEstado === 'en_progreso') {
        $datos['fecha_inicio'] = date('Y-m-d H:i:s');
    }
    
    $resultado = actualizarRegistro('auditoria_pasos', $pasoId, $datos);
    
    if ($resultado) {
        // El trigger automáticamente actualiza el porcentaje y registra el cambio
        return ['success' => true, 'message' => 'Paso actualizado exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al actualizar el paso'];
    }
}

// =====================================================
// FORMULARIOS DE ARCHIVOS
// =====================================================

/**
 * Procesa la subida de archivos
 * 
 * @return array Resultado del procesamiento
 */
function procesarSubirArchivo() {
    $auditoriaId = (int)$_POST['auditoria_id'];
    $pasoId = (int)$_POST['paso_id'];
    $usuarioId = (int)$_POST['usuario_id'];
    
    if (!$auditoriaId || !$pasoId || !$usuarioId) {
        return ['success' => false, 'message' => 'Datos requeridos faltantes'];
    }
    
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Error en la subida del archivo'];
    }
    
    $resultado = subirArchivo($auditoriaId, $pasoId, $_FILES['archivo'], $usuarioId);
    
    if ($resultado) {
        return ['success' => true, 'message' => 'Archivo subido exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al subir el archivo'];
    }
}

// =====================================================
// FORMULARIOS DE COMENTARIOS
// =====================================================

/**
 * Procesa la adición de comentarios
 * 
 * @return array Resultado del procesamiento
 */
function procesarAgregarComentario() {
    $auditoriaId = (int)$_POST['auditoria_id'];
    $pasoId = (int)$_POST['paso_id'];
    $usuarioId = (int)$_POST['usuario_id'];
    $comentario = sanitizar($_POST['comentario']);
    
    if (!$auditoriaId || !$usuarioId || !$comentario) {
        return ['success' => false, 'message' => 'Datos requeridos faltantes'];
    }
    
    $datos = [
        'auditoria_id' => $auditoriaId,
        'auditoria_paso_id' => $pasoId ?: null,
        'usuario_id' => $usuarioId,
        'comentario' => $comentario,
        'es_interno' => isset($_POST['es_interno']) ? 1 : 0
    ];
    
    $comentarioId = insertarRegistro('comentarios', $datos);
    
    if ($comentarioId) {
        // Registrar en historial
        $tipo = $pasoId ? 'comentario_paso' : 'comentario_auditoria';
        registrarCambio($auditoriaId, $usuarioId, $tipo, 'Comentario agregado');
        
        return ['success' => true, 'message' => 'Comentario agregado exitosamente'];
    } else {
        return ['success' => false, 'message' => 'Error al agregar el comentario'];
    }
}

// =====================================================
// FORMULARIOS DE CLIENTES
// =====================================================

// NOTA: Las funciones de clientes se han movido a modules/clientes.php
// para evitar duplicación y mejorar la organización del código.

// =====================================================
// FUNCIONES DE VALIDACIÓN
// =====================================================

/**
 * Valida los datos de una auditoría
 * 
 * @param array $datos Datos a validar
 * @param int $auditoriaId ID de auditoría (para actualizaciones)
 * @return array Errores encontrados
 */
function validarDatosAuditoria($datos, $auditoriaId = null) {
    $errores = [];
    
    // Nombre requerido
    if (empty($datos['nombre'])) {
        $errores['nombre'] = 'El nombre es requerido';
    } elseif (strlen($datos['nombre']) > 200) {
        $errores['nombre'] = 'El nombre no puede exceder 200 caracteres';
    }
    
    // Cliente requerido (solo para nuevas auditorías)
    if (!$auditoriaId && empty($datos['cliente_id'])) {
        $errores['cliente_id'] = 'El cliente es requerido';
    }
    
    // Usuario requerido (solo para nuevas auditorías)
    if (!$auditoriaId && empty($datos['usuario_id'])) {
        $errores['usuario_id'] = 'El usuario es requerido';
    }
    
    // URL principal (opcional, pero si se proporciona debe ser válida)
    if (!empty($datos['url_principal']) && !filter_var($datos['url_principal'], FILTER_VALIDATE_URL)) {
        $errores['url_principal'] = 'La URL principal no es válida';
    }
    
    // Fechas
    if (!empty($datos['fecha_inicio']) && !validarFecha($datos['fecha_inicio'])) {
        $errores['fecha_inicio'] = 'La fecha de inicio no es válida';
    }
    
    if (!empty($datos['fecha_estimada_fin'])) {
        if (!validarFecha($datos['fecha_estimada_fin'])) {
            $errores['fecha_estimada_fin'] = 'La fecha estimada de fin no es válida';
        } elseif (!empty($datos['fecha_inicio']) && 
                  strtotime($datos['fecha_estimada_fin']) <= strtotime($datos['fecha_inicio'])) {
            $errores['fecha_estimada_fin'] = 'La fecha de fin debe ser posterior a la fecha de inicio';
        }
    }
    
    return $errores;
}

// NOTA: La función validarDatosCliente() se ha movido a modules/clientes.php
// para centralizar todas las funciones relacionadas con clientes y evitar duplicaciones.

/**
 * Valida una fecha en formato Y-m-d
 * 
 * @param string $fecha Fecha a validar
 * @return bool True si es válida
 */
function validarFecha($fecha) {
    $d = DateTime::createFromFormat('Y-m-d', $fecha);
    return $d && $d->format('Y-m-d') === $fecha;
}

// =====================================================
// GENERADORES DE FORMULARIOS HTML
// =====================================================

/**
 * Genera un campo de formulario HTML
 * 
 * @param string $tipo Tipo de campo
 * @param string $nombre Nombre del campo
 * @param mixed $valor Valor del campo
 * @param array $opciones Opciones adicionales
 * @return string HTML del campo
 */
function generarCampo($tipo, $nombre, $valor = '', $opciones = []) {
    $id = $opciones['id'] ?? $nombre;
    $clase = $opciones['class'] ?? 'form-control';
    $placeholder = $opciones['placeholder'] ?? '';
    $requerido = $opciones['required'] ?? false;
    $readonly = $opciones['readonly'] ?? false;
    
    $atributos = "id=\"{$id}\" name=\"{$nombre}\" class=\"{$clase}\"";
    
    if ($placeholder) $atributos .= " placeholder=\"{$placeholder}\"";
    if ($requerido) $atributos .= " required";
    if ($readonly) $atributos .= " readonly";
    
    switch ($tipo) {
        case 'text':
        case 'email':
        case 'url':
        case 'date':
            return "<input type=\"{$tipo}\" {$atributos} value=\"" . htmlspecialchars($valor) . "\">";
            
        case 'textarea':
            $filas = $opciones['rows'] ?? 3;
            return "<textarea {$atributos} rows=\"{$filas}\">" . htmlspecialchars($valor) . "</textarea>";
            
        case 'select':
            $html = "<select {$atributos}>";
            if (isset($opciones['opciones'])) {
                foreach ($opciones['opciones'] as $key => $label) {
                    $selected = ($key == $valor) ? 'selected' : '';
                    $html .= "<option value=\"{$key}\" {$selected}>{$label}</option>";
                }
            }
            $html .= "</select>";
            return $html;
            
        case 'checkbox':
            $checked = $valor ? 'checked' : '';
            return "<input type=\"checkbox\" {$atributos} value=\"1\" {$checked}>";
            
        default:
            return "<input type=\"text\" {$atributos} value=\"" . htmlspecialchars($valor) . "\">";
    }
}

/**
 * Genera un token CSRF oculto para formularios
 * 
 * @return string HTML del campo oculto
 */
function generarCampoCSRF() {
    $token = generarTokenCSRF();
    return "<input type=\"hidden\" name=\"csrf_token\" value=\"{$token}\">";
}

/**
 * Genera opciones para select de clientes
 * 
 * @return array Opciones de clientes
 */
function obtenerOpcionesClientes() {
    $sql = "SELECT id, nombre_empresa as nombre, contacto_nombre FROM clientes WHERE activo = 1 ORDER BY nombre_empresa";
    $clientes = ejecutarConsulta($sql);
    
    if (is_array($clientes)) {
        return $clientes;
    }
    
    return [];
}

/**
 * Genera opciones para select de usuarios
 * 
 * @return array Opciones de usuarios
 */
function obtenerOpcionesUsuarios() {
    $sql = "SELECT id, nombre, email FROM usuarios WHERE activo = 1 ORDER BY nombre";
    $usuarios = ejecutarConsulta($sql);
    
    if (is_array($usuarios)) {
        return $usuarios;
    }
    
    return [];
}

/**
 * Genera opciones para select de fases
 * 
 * @return array Opciones de fases
 */
function obtenerOpcionesFases() {
    $sql = "SELECT id, numero_fase, nombre, descripcion FROM fases ORDER BY numero_fase";
    $fases = ejecutarConsulta($sql);
    
    if (is_array($fases)) {
        return $fases;
    }
    
    return [];
}

?>