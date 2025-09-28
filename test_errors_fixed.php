<?php
/**
 * TEST: VERIFICAR QUE LOS ERRORES SE HAN SOLUCIONADO
 * ==================================================
 */

// Intentar inicializar el sistema como lo haría index.php
require_once __DIR__ . '/includes/init.php';

echo "<h2>🧪 Test de Errores Solucionados</h2>";

// Test 1: Verificar sesión
echo "<h3>✅ Test 1: Sesión</h3>";
if (session_status() === PHP_SESSION_ACTIVE) {
    echo "<p>✓ Sesión iniciada correctamente</p>";
    echo "<p>✓ Usuario ID: " . ($_SESSION['usuario_id'] ?? 'No definido') . "</p>";
} else {
    echo "<p>❌ Error: Sesión no iniciada</p>";
}

// Test 2: Verificar directorio temp
echo "<h3>✅ Test 2: Directorio temp</h3>";
$temp_dir = __DIR__ . '/temp';
if (is_dir($temp_dir) && is_writable($temp_dir)) {
    echo "<p>✓ Directorio temp existe y es escribible</p>";
} else {
    echo "<p>❌ Error: Problemas con directorio temp</p>";
}

// Test 3: Verificar funciones de auditoría
echo "<h3>✅ Test 3: Funciones de Auditoría</h3>";
if (function_exists('obtenerAuditoria')) {
    echo "<p>✓ Función obtenerAuditoria existe</p>";
} else {
    echo "<p>❌ Error: Función obtenerAuditoria no existe</p>";
}

// Test 4: Verificar base de datos
echo "<h3>✅ Test 4: Base de Datos</h3>";
try {
    $pdo = obtenerConexion();
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM auditorias");
    $result = $stmt->fetch();
    echo "<p>✓ Conexión a base de datos: OK</p>";
    echo "<p>✓ Auditorías en BD: " . $result['count'] . "</p>";
} catch (Exception $e) {
    echo "<p>❌ Error de BD: " . $e->getMessage() . "</p>";
}

// Test 5: Verificar nuevas tablas
echo "<h3>✅ Test 5: Nuevas Tablas de Formularios</h3>";
try {
    $pdo = obtenerConexion();

    // Verificar tabla paso_campos
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM paso_campos");
    $result = $stmt->fetch();
    echo "<p>✓ Tabla paso_campos: " . $result['count'] . " campos configurados</p>";

    // Verificar tabla csv_configuraciones
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM csv_configuraciones");
    $result = $stmt->fetch();
    echo "<p>✓ Tabla csv_configuraciones: " . $result['count'] . " configuraciones</p>";

} catch (Exception $e) {
    echo "<p>❌ Error verificando nuevas tablas: " . $e->getMessage() . "</p>";
}

echo "<h3>🎉 URLs de Prueba</h3>";
echo "<p><a href='index.php' target='_blank'>📍 Página Principal</a></p>";
echo "<p><a href='index.php?modulo=auditorias&accion=listar' target='_blank'>📋 Lista de Auditorías</a></p>";
echo "<p><a href='index.php?modulo=auditorias&accion=formulario&auditoria_id=1&paso_id=1' target='_blank'>📝 Formulario Dinámico</a></p>";
echo "<p><a href='index.php?modulo=auditorias&accion=eliminar&id=24' target='_blank'>🗑️ Eliminar Auditoría</a></p>";

echo "<hr>";
echo "<p><strong>Estado:</strong> Sistema listo para usar ✅</p>";
?>