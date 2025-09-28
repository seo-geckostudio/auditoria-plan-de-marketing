<?php
/**
 * MÓDULO DE FORMULARIOS DINÁMICOS
 * ================================
 *
 * Módulo para la gestión de formularios dinámicos en auditorías SEO
 * Permite crear formularios basados en configuración de base de datos
 *
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

require_once __DIR__ . '/../includes/functions.php';

// =====================================================
// FUNCIONES DE FORMULARIOS DINÁMICOS
// =====================================================

/**
 * Obtiene los campos configurados para un paso específico
 *
 * @param int $paso_plantilla_id ID del paso plantilla
 * @return array Lista de campos configurados
 */
function obtenerCamposPaso($paso_plantilla_id) {
    $sql = "
        SELECT * FROM paso_campos
        WHERE paso_plantilla_id = ? AND activo = 1
        ORDER BY orden ASC, id ASC
    ";

    return ejecutarConsulta($sql, [$paso_plantilla_id]);
}

/**
 * Obtiene los valores ya guardados para un paso de auditoría
 *
 * @param int $auditoria_paso_id ID del paso de auditoría
 * @return array Array asociativo campo_id => valor
 */
function obtenerValoresPaso($auditoria_paso_id) {
    $sql = "
        SELECT campo_id, valor
        FROM paso_datos
        WHERE auditoria_paso_id = ?
    ";

    $resultados = ejecutarConsulta($sql, [$auditoria_paso_id]);
    $valores = [];

    foreach ($resultados as $fila) {
        $valores[$fila['campo_id']] = $fila['valor'];
    }

    return $valores;
}

/**
 * Genera HTML para un campo de formulario dinámico
 *
 * @param array $campo Configuración del campo
 * @param array $valores_guardados Valores ya guardados (opcional)
 * @return string HTML del campo
 */
function generarCampoFormulario($campo, $valores_guardados = []) {
    $valor_actual = $valores_guardados[$campo['id']] ?? $campo['valor_por_defecto'] ?? '';
    $required = $campo['obligatorio'] ? 'required' : '';
    $campo_id = 'campo_' . $campo['id'];
    $campo_name = 'campos[' . $campo['id'] . ']';

    $html = '<div class="mb-3">';
    $html .= '<label for="' . $campo_id . '" class="form-label">';
    $html .= htmlspecialchars($campo['etiqueta']);
    if ($campo['obligatorio']) {
        $html .= ' <span class="text-danger">*</span>';
    }
    $html .= '</label>';

    // Generar campo según tipo
    switch ($campo['tipo_campo']) {
        case 'text':
        case 'email':
        case 'url':
            $html .= '<input type="' . $campo['tipo_campo'] . '" class="form-control" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= 'value="' . htmlspecialchars($valor_actual) . '" ';
            if ($campo['placeholder']) {
                $html .= 'placeholder="' . htmlspecialchars($campo['placeholder']) . '" ';
            }
            if ($campo['min_length']) {
                $html .= 'minlength="' . $campo['min_length'] . '" ';
            }
            if ($campo['max_length']) {
                $html .= 'maxlength="' . $campo['max_length'] . '" ';
            }
            $html .= $required . '>';
            break;

        case 'number':
            $html .= '<input type="number" class="form-control" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= 'value="' . htmlspecialchars($valor_actual) . '" ';
            if ($campo['min_value']) {
                $html .= 'min="' . $campo['min_value'] . '" ';
            }
            if ($campo['max_value']) {
                $html .= 'max="' . $campo['max_value'] . '" ';
            }
            $html .= $required . '>';
            break;

        case 'date':
            $html .= '<input type="date" class="form-control" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= 'value="' . htmlspecialchars($valor_actual) . '" ';
            $html .= $required . '>';
            break;

        case 'textarea':
            $html .= '<textarea class="form-control" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= 'rows="4" ';
            if ($campo['placeholder']) {
                $html .= 'placeholder="' . htmlspecialchars($campo['placeholder']) . '" ';
            }
            $html .= $required . '>';
            $html .= htmlspecialchars($valor_actual);
            $html .= '</textarea>';
            break;

        case 'select':
            $html .= '<select class="form-select" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= $required . '>';

            if (!$campo['obligatorio']) {
                $html .= '<option value="">-- Seleccionar --</option>';
            }

            if ($campo['opciones']) {
                $opciones = json_decode($campo['opciones'], true);
                foreach ($opciones as $opcion) {
                    $selected = ($valor_actual == $opcion) ? 'selected' : '';
                    $html .= '<option value="' . htmlspecialchars($opcion) . '" ' . $selected . '>';
                    $html .= htmlspecialchars($opcion);
                    $html .= '</option>';
                }
            }
            $html .= '</select>';
            break;

        case 'checkbox':
            $html .= '<div class="form-check">';
            $html .= '<input type="checkbox" class="form-check-input" ';
            $html .= 'id="' . $campo_id . '" name="' . $campo_name . '" ';
            $html .= 'value="1" ';
            if ($valor_actual) {
                $html .= 'checked ';
            }
            $html .= '>';
            $html .= '<label class="form-check-label" for="' . $campo_id . '">';
            $html .= htmlspecialchars($campo['etiqueta']);
            $html .= '</label>';
            $html .= '</div>';
            break;

        case 'radio':
            if ($campo['opciones']) {
                $opciones = json_decode($campo['opciones'], true);
                foreach ($opciones as $key => $opcion) {
                    $radio_id = $campo_id . '_' . $key;
                    $checked = ($valor_actual == $opcion) ? 'checked' : '';

                    $html .= '<div class="form-check">';
                    $html .= '<input type="radio" class="form-check-input" ';
                    $html .= 'id="' . $radio_id . '" name="' . $campo_name . '" ';
                    $html .= 'value="' . htmlspecialchars($opcion) . '" ';
                    $html .= $checked . ' ' . $required . '>';
                    $html .= '<label class="form-check-label" for="' . $radio_id . '">';
                    $html .= htmlspecialchars($opcion);
                    $html .= '</label>';
                    $html .= '</div>';
                }
            }
            break;
    }

    // Descripción de ayuda
    if ($campo['descripcion_ayuda']) {
        $html .= '<div class="form-text">';
        $html .= htmlspecialchars($campo['descripcion_ayuda']);
        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Guarda los datos del formulario en la base de datos
 *
 * @param int $auditoria_paso_id ID del paso de auditoría
 * @param array $datos_formulario Datos del formulario ($_POST['campos'])
 * @param int $usuario_id ID del usuario que guarda
 * @return bool True si se guardó correctamente
 */
function guardarDatosFormulario($auditoria_paso_id, $datos_formulario, $usuario_id) {
    try {
        $pdo = obtenerConexion();
        $pdo->beginTransaction();

        foreach ($datos_formulario as $campo_id => $valor) {
            // Verificar si ya existe un registro para este campo
            $sql_check = "
                SELECT id FROM paso_datos
                WHERE auditoria_paso_id = ? AND campo_id = ?
            ";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([$auditoria_paso_id, $campo_id]);
            $existe = $stmt_check->fetch();

            if ($existe) {
                // Actualizar registro existente
                $sql_update = "
                    UPDATE paso_datos
                    SET valor = ?, fecha_actualizacion = datetime('now'), usuario_id = ?
                    WHERE id = ?
                ";
                $stmt_update = $pdo->prepare($sql_update);
                $stmt_update->execute([$valor, $usuario_id, $existe['id']]);
            } else {
                // Insertar nuevo registro
                $sql_insert = "
                    INSERT INTO paso_datos (auditoria_paso_id, campo_id, valor, usuario_id)
                    VALUES (?, ?, ?, ?)
                ";
                $stmt_insert = $pdo->prepare($sql_insert);
                $stmt_insert->execute([$auditoria_paso_id, $campo_id, $valor, $usuario_id]);
            }
        }

        // Actualizar estado del paso a 'en_progreso' o 'completado'
        $porcentaje_completado = calcularCompletitudFormulario($auditoria_paso_id);
        $nuevo_estado = ($porcentaje_completado >= 100) ? 'completado' : 'en_progreso';

        $sql_update_paso = "
            UPDATE auditoria_pasos
            SET estado = ?, porcentaje_completado = ?, fecha_actualizacion = datetime('now')
            WHERE id = ?
        ";
        $stmt_update_paso = $pdo->prepare($sql_update_paso);
        $stmt_update_paso->execute([$nuevo_estado, $porcentaje_completado, $auditoria_paso_id]);

        $pdo->commit();
        return true;

    } catch (Exception $e) {
        if (isset($pdo)) {
            $pdo->rollback();
        }
        registrarError("Error guardando formulario: " . $e->getMessage());
        return false;
    }
}

/**
 * Calcula el porcentaje de completitud de un formulario
 *
 * @param int $auditoria_paso_id ID del paso de auditoría
 * @return float Porcentaje de completitud (0-100)
 */
function calcularCompletitudFormulario($auditoria_paso_id) {
    // Obtener información del paso y sus campos obligatorios
    $sql = "
        SELECT
            ap.paso_plantilla_id,
            COUNT(pc.id) as total_campos,
            COUNT(CASE WHEN pc.obligatorio = 1 THEN 1 END) as campos_obligatorios,
            COUNT(pd.id) as campos_completados,
            COUNT(CASE WHEN pc.obligatorio = 1 AND pd.valor IS NOT NULL AND pd.valor != '' THEN 1 END) as obligatorios_completados
        FROM auditoria_pasos ap
        LEFT JOIN paso_campos pc ON ap.paso_plantilla_id = pc.paso_plantilla_id AND pc.activo = 1
        LEFT JOIN paso_datos pd ON ap.id = pd.auditoria_paso_id AND pc.id = pd.campo_id
        WHERE ap.id = ?
        GROUP BY ap.id, ap.paso_plantilla_id
    ";

    $resultado = obtenerRegistro($sql, [$auditoria_paso_id]);

    if (!$resultado || $resultado['total_campos'] == 0) {
        return 0;
    }

    // Si hay campos obligatorios, deben estar completos para considerar completitud del 100%
    if ($resultado['campos_obligatorios'] > 0) {
        if ($resultado['obligatorios_completados'] < $resultado['campos_obligatorios']) {
            // Calcular porcentaje basado en campos obligatorios
            return ($resultado['obligatorios_completados'] / $resultado['campos_obligatorios']) * 90; // máximo 90% si faltan obligatorios
        }
    }

    // Todos los obligatorios completados, calcular porcentaje total
    return ($resultado['campos_completados'] / $resultado['total_campos']) * 100;
}

/**
 * Valida los datos del formulario según las reglas definidas
 *
 * @param array $datos_formulario Datos del formulario
 * @param array $campos_config Configuración de los campos
 * @return array Array con errores encontrados (vacío si no hay errores)
 */
function validarFormulario($datos_formulario, $campos_config) {
    $errores = [];

    foreach ($campos_config as $campo) {
        $valor = $datos_formulario[$campo['id']] ?? '';
        $campo_nombre = $campo['etiqueta'];

        // Validar campos obligatorios
        if ($campo['obligatorio'] && empty($valor)) {
            $errores[] = "El campo '{$campo_nombre}' es obligatorio";
            continue;
        }

        // Si el campo está vacío y no es obligatorio, saltar validaciones
        if (empty($valor)) {
            continue;
        }

        // Validar longitud mínima y máxima
        if ($campo['min_length'] && strlen($valor) < $campo['min_length']) {
            $errores[] = "El campo '{$campo_nombre}' debe tener al menos {$campo['min_length']} caracteres";
        }

        if ($campo['max_length'] && strlen($valor) > $campo['max_length']) {
            $errores[] = "El campo '{$campo_nombre}' no puede exceder {$campo['max_length']} caracteres";
        }

        // Validar valores numéricos
        if ($campo['tipo_campo'] == 'number') {
            if (!is_numeric($valor)) {
                $errores[] = "El campo '{$campo_nombre}' debe ser un número válido";
                continue;
            }

            $valor_num = floatval($valor);
            if ($campo['min_value'] !== null && $valor_num < $campo['min_value']) {
                $errores[] = "El campo '{$campo_nombre}' debe ser mayor o igual a {$campo['min_value']}";
            }

            if ($campo['max_value'] !== null && $valor_num > $campo['max_value']) {
                $errores[] = "El campo '{$campo_nombre}' debe ser menor o igual a {$campo['max_value']}";
            }
        }

        // Validar email
        if ($campo['tipo_campo'] == 'email' && !filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El campo '{$campo_nombre}' debe ser una dirección de email válida";
        }

        // Validar URL
        if ($campo['tipo_campo'] == 'url' && !filter_var($valor, FILTER_VALIDATE_URL)) {
            $errores[] = "El campo '{$campo_nombre}' debe ser una URL válida";
        }

        // Validar con expresión regular personalizada
        if ($campo['validacion_regex'] && !preg_match($campo['validacion_regex'], $valor)) {
            $errores[] = "El campo '{$campo_nombre}' no tiene el formato correcto";
        }
    }

    return $errores;
}

/**
 * Obtiene los métodos de entrada permitidos para un paso
 *
 * @param int $paso_plantilla_id ID del paso plantilla
 * @return array Lista de métodos permitidos
 */
function obtenerMetodosEntradaPaso($paso_plantilla_id) {
    $sql = "SELECT metodos_entrada FROM pasos_plantilla WHERE id = ?";
    $resultado = obtenerRegistro($sql, [$paso_plantilla_id]);

    if ($resultado && $resultado['metodos_entrada']) {
        return json_decode($resultado['metodos_entrada'], true);
    }

    return ['formulario']; // por defecto solo formulario
}

/**
 * Exporta los datos del formulario a diferentes formatos
 *
 * @param int $auditoria_paso_id ID del paso de auditoría
 * @param string $formato Formato de exportación ('json', 'excel', 'pdf')
 * @return mixed Datos exportados o false en caso de error
 */
function exportarDatosFormulario($auditoria_paso_id, $formato = 'json') {
    $sql = "
        SELECT
            pc.nombre_campo,
            pc.etiqueta,
            pd.valor,
            pc.tipo_campo
        FROM paso_datos pd
        JOIN paso_campos pc ON pd.campo_id = pc.id
        WHERE pd.auditoria_paso_id = ?
        ORDER BY pc.orden ASC
    ";

    $datos = ejecutarConsulta($sql, [$auditoria_paso_id]);

    switch ($formato) {
        case 'json':
            $resultado = [];
            foreach ($datos as $fila) {
                $resultado[$fila['nombre_campo']] = [
                    'etiqueta' => $fila['etiqueta'],
                    'valor' => $fila['valor'],
                    'tipo' => $fila['tipo_campo']
                ];
            }
            return json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        case 'array':
            return $datos;

        default:
            return $datos;
    }
}
?>