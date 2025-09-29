<?php
/**
 * Script de prueba para diagnosticar problemas en la creación de clientes
 */

// Configurar para mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir constante del sistema
define('SISTEMA_INICIADO', true);

// Incluir funciones del sistema
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/modules/clientes.php';
require_once __DIR__ . '/config/database.php';

// Función para mostrar información de depuración
function debug($data, $title = null) {
    echo "<div style='margin: 10px; padding: 10px; border: 1px solid #ccc; background: #f9f9f9;'>";
    if ($title) {
        echo "<h3>$title</h3>";
    }
    echo "<pre>";
    print_r($data);
    echo "</pre></div>";
}

// Simular datos de formulario para crear un cliente
$datos_cliente = [
    'form_name' => 'clientes_crear',
    'nombre_empresa' => 'Empresa de Prueba ' . date('YmdHis'),
    'sitio_web' => 'https://www.empresaprueba.com',
    'sector' => 'Tecnología',
    'pais' => 'España',
    'persona_contacto' => 'Juan Prueba',
    'email' => 'contacto' . rand(1000, 9999) . '@empresaprueba.com',
    'telefono' => '666123456',
    'csrf_token' => $_SESSION['csrf_token'] ?? 'token_simulado'
];

// Generar un token CSRF si no existe
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $datos_cliente['csrf_token'] = $_SESSION['csrf_token'];
}

// Mostrar datos que se van a enviar
debug($datos_cliente, 'Datos del formulario');

// Verificar la conexión a la base de datos
try {
    $db = obtenerConexion();
    echo "<div style='color: green; font-weight: bold;'>Conexión a la base de datos establecida correctamente</div>";
    
    // Mostrar información de la tabla clientes
    $stmt = $db->query("PRAGMA table_info(clientes)");
    $estructura_tabla = $stmt->fetchAll(PDO::FETCH_ASSOC);
    debug($estructura_tabla, 'Estructura de la tabla clientes');
    
} catch (PDOException $e) {
    echo "<div style='color: red; font-weight: bold;'>Error de conexión a la base de datos: " . $e->getMessage() . "</div>";
    exit;
}

// Simular el procesamiento del formulario
echo "<h2>Simulando procesamiento del formulario</h2>";

// Guardar los datos originales de $_POST
$post_original = $_POST;

// Simular la petición POST
$_POST = $datos_cliente;

// Llamar directamente a la función de procesamiento
echo "<h3>Llamando a procesarCrearCliente()</h3>";
try {
    $resultado = procesarCrearCliente();
    debug($resultado, 'Resultado de procesarCrearCliente()');
} catch (Exception $e) {
    echo "<div style='color: red; font-weight: bold;'>Excepción: " . $e->getMessage() . "</div>";
}

// Restaurar $_POST original
$_POST = $post_original;

// Verificar si el cliente fue creado
if (isset($resultado['cliente_id']) && $resultado['cliente_id']) {
    echo "<h3>Verificando cliente creado</h3>";
    try {
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$resultado['cliente_id']]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($cliente) {
            echo "<div style='color: green; font-weight: bold;'>Cliente creado correctamente con ID: " . $cliente['id'] . "</div>";
            debug($cliente, 'Datos del cliente en la base de datos');
        } else {
            echo "<div style='color: red; font-weight: bold;'>No se encontró el cliente en la base de datos</div>";
        }
    } catch (PDOException $e) {
        echo "<div style='color: red; font-weight: bold;'>Error al verificar cliente: " . $e->getMessage() . "</div>";
    }
}

// Mostrar variables de sesión
debug($_SESSION, 'Variables de sesión');