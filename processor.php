<?php
/**
 * PROCESADOR ÚNICO DE FORMULARIOS
 *
 * Este archivo maneja TODOS los formularios del sistema de manera centralizada.
 * Los formularios se identifican por nombres únicos basados en módulo + acción.
 *
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

// Inicialización segura del sistema
require_once __DIR__ . '/includes/init.php';

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Obtener el nombre del formulario
$form_name = $_POST['form_name'] ?? '';

if (empty($form_name)) {
    $_SESSION['error'] = 'Formulario no identificado correctamente';
    header('Location: index.php');
    exit;
}

// Procesar según el tipo de formulario
switch ($form_name) {
    
    // =====================================================
    // FORMULARIOS DE CLIENTES
    // =====================================================
    
    case 'clientes_crear':
        $resultado = procesarCrearCliente();
        if ($resultado['success']) {
            $_SESSION['success'] = $resultado['message'];
            header('Location: index.php?modulo=clientes&accion=ver&id=' . $resultado['cliente_id']);
        } else {
            $_SESSION['error'] = $resultado['message'];
            header('Location: index.php?modulo=clientes&accion=crear');
        }
        exit;
        break;
        
    case 'clientes_editar':
        procesarEditarClienteForm();
        break;
        
    // =====================================================
    // FORMULARIOS DE AUDITORÍAS
    // =====================================================
    
    case 'auditorias_crear':
        procesarCrearAuditoria();
        break;
        
    case 'auditorias_editar':
        procesarEditarAuditoria();
        break;
        
    // =====================================================
    // FORMULARIOS DE PASOS
    // =====================================================
    
    case 'pasos_actualizar':
        procesarActualizarPaso();
        break;
        
    // =====================================================
    // FORMULARIOS DE ARCHIVOS
    // =====================================================
    
    case 'archivos_subir':
        procesarSubirArchivo();
        break;
        
    default:
        $_SESSION['error'] = 'Tipo de formulario no reconocido: ' . htmlspecialchars($form_name);
        header('Location: index.php');
        exit;
}

// =====================================================
// FUNCIONES DE PROCESAMIENTO DE CLIENTES
// =====================================================

// Nota: Las funciones de procesamiento de clientes están en modules/clientes.php

/**
 * Procesa la edición de un cliente existente
 */
function procesarEditarClienteForm() {
    try {
        $clienteId = intval($_POST['cliente_id'] ?? 0);
        
        if (!$clienteId) {
            $_SESSION['error'] = 'ID de cliente no válido';
            header('Location: index.php?modulo=clientes');
            exit;
        }
        
        // Verificar que el cliente existe
        $cliente = obtenerClientePorId($clienteId);
        if (!$cliente) {
            $_SESSION['error'] = 'Cliente no encontrado';
            header('Location: index.php?modulo=clientes');
            exit;
        }
        
        // Validar datos
        $errores = [];
        
        $nombre_empresa = trim($_POST['nombre_empresa'] ?? '');
        $contacto_nombre = trim($_POST['contacto_nombre'] ?? '');
        $contacto_email = trim($_POST['contacto_email'] ?? '');
        $contacto_telefono = trim($_POST['contacto_telefono'] ?? '');
        $sector = trim($_POST['sector'] ?? '');
        $pais = trim($_POST['pais'] ?? '');
        $sitio_web = trim($_POST['sitio_web'] ?? '');
        $notas = trim($_POST['notas'] ?? '');
        
        // Validaciones
        if (empty($nombre_empresa)) {
            $errores[] = 'El nombre de la empresa es obligatorio';
        }
        
        if (empty($contacto_nombre)) {
            $errores[] = 'El nombre del contacto es obligatorio';
        }
        
        if (empty($contacto_email)) {
            $errores[] = 'El email del contacto es obligatorio';
        } elseif (!filter_var($contacto_email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El email del contacto no es válido';
        } elseif (existeClienteConEmail($contacto_email, $clienteId)) {
            $errores[] = 'Ya existe otro cliente con este email';
        }
        
        if (!empty($errores)) {
            $_SESSION['error'] = implode('<br>', $errores);
            header('Location: index.php?modulo=clientes&accion=editar&id=' . $clienteId);
            exit;
        }
        
        // Actualizar cliente
        $clienteData = [
            'nombre_empresa' => $nombre_empresa,
            'contacto_nombre' => $contacto_nombre,
            'contacto_email' => $contacto_email,
            'contacto_telefono' => $contacto_telefono,
            'sector' => $sector,
            'pais' => $pais,
            'sitio_web' => $sitio_web,
            'notas' => $notas
        ];
        
        $resultado = actualizarClienteEnBD($clienteId, $clienteData);
        
        if ($resultado) {
            $_SESSION['success'] = 'Cliente actualizado exitosamente';
            header('Location: index.php?modulo=clientes&accion=ver&id=' . $clienteId);
        } else {
            $_SESSION['error'] = 'Error al actualizar el cliente';
            header('Location: index.php?modulo=clientes&accion=editar&id=' . $clienteId);
        }
        
    } catch (Exception $e) {
        registrarError("Error procesando edición de cliente: " . $e->getMessage());
        $_SESSION['error'] = 'Error interno del sistema';
        header('Location: index.php?modulo=clientes');
    }
    exit;
}

// =====================================================
// FUNCIONES DE PROCESAMIENTO DE AUDITORÍAS
// =====================================================

// Nota: Las funciones de procesamiento de auditorías están en includes/forms.php

// =====================================================
// FUNCIONES DE PROCESAMIENTO DE PASOS Y ARCHIVOS
// =====================================================

// Nota: Las funciones de procesamiento están en includes/forms.php

// =====================================================
// FUNCIONES AUXILIARES DE BASE DE DATOS
// =====================================================

/**
 * Crea un cliente en la base de datos
 */
function crearClienteEnBD($datos) {
    try {
        $pdo = obtenerConexion();
        
        $sql = "INSERT INTO clientes (
            nombre_empresa, contacto_nombre, contacto_email, contacto_telefono,
            sector, pais, sitio_web, notas, activo, fecha_creacion
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute([
            $datos['nombre_empresa'],
            $datos['contacto_nombre'],
            $datos['contacto_email'],
            $datos['contacto_telefono'],
            $datos['sector'],
            $datos['pais'],
            $datos['sitio_web'],
            $datos['notas'],
            $datos['activo'],
            $datos['fecha_creacion']
        ]);
        
        return $resultado ? $pdo->lastInsertId() : false;
        
    } catch (Exception $e) {
        registrarError("Error creando cliente en BD: " . $e->getMessage());
        return false;
    }
}

/**
 * Actualiza un cliente en la base de datos
 */
function actualizarClienteEnBD($clienteId, $datos) {
    try {
        $pdo = obtenerConexion();
        
        $sql = "UPDATE clientes SET 
            nombre_empresa = ?, contacto_nombre = ?, contacto_email = ?, 
            contacto_telefono = ?, sector = ?, pais = ?, sitio_web = ?, notas = ?
            WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre_empresa'],
            $datos['contacto_nombre'],
            $datos['contacto_email'],
            $datos['contacto_telefono'],
            $datos['sector'],
            $datos['pais'],
            $datos['sitio_web'],
            $datos['notas'],
            $clienteId
        ]);
        
    } catch (Exception $e) {
        registrarError("Error actualizando cliente en BD: " . $e->getMessage());
        return false;
    }
}

?>