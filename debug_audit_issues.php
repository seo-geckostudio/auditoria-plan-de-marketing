<?php
require_once 'config/database.php';

echo "<h2>Debug: Problemas con Auditorías</h2>";

try {
    $pdo = obtenerConexion();
    
    // 1. Verificar todas las auditorías en la base de datos
    echo "<h3>1. Todas las auditorías en la base de datos:</h3>";
    $stmt = $pdo->query("SELECT id, titulo, cliente_id, estado, fecha_creacion FROM auditorias ORDER BY id DESC");
    $auditorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>Total de auditorías encontradas: " . count($auditorias) . "</p>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Cliente ID</th><th>Estado</th><th>Fecha Creación</th></tr>";
    
    foreach ($auditorias as $auditoria) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($auditoria['id']) . "</td>";
        echo "<td>" . htmlspecialchars($auditoria['nombre'] ?? 'NULL') . "</td>";
        echo "<td>" . htmlspecialchars($auditoria['cliente_id'] ?? 'NULL') . "</td>";
        echo "<td>" . htmlspecialchars($auditoria['estado'] ?? 'NULL') . "</td>";
        echo "<td>" . htmlspecialchars($auditoria['fecha_creacion'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // 2. Verificar la función obtenerAuditorias
    echo "<h3>2. Resultado de obtenerAuditorias():</h3>";
    require_once 'includes/functions.php';
    
    $auditorias_funcion = obtenerAuditorias();
    echo "<p>Auditorías devueltas por obtenerAuditorias(): " . (is_array($auditorias_funcion) ? count($auditorias_funcion) : 'No es array') . "</p>";
    
    if (is_array($auditorias_funcion) && !empty($auditorias_funcion)) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Cliente</th><th>Estado</th><th>Fecha Creación</th></tr>";
        
        foreach ($auditorias_funcion as $auditoria) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($auditoria['id'] ?? 'NULL') . "</td>";
            echo "<td>" . htmlspecialchars($auditoria['nombre'] ?? 'NULL') . "</td>";
            echo "<td>" . htmlspecialchars($auditoria['cliente_nombre'] ?? 'NULL') . "</td>";
            echo "<td>" . htmlspecialchars($auditoria['estado'] ?? 'NULL') . "</td>";
            echo "<td>" . htmlspecialchars($auditoria['fecha_creacion'] ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se obtuvieron auditorías o hubo un error.</p>";
    }
    
    // 3. Verificar la última auditoría creada específicamente
    echo "<h3>3. Detalles de la última auditoría (ID más alto):</h3>";
    $stmt = $pdo->query("SELECT * FROM auditorias ORDER BY id DESC LIMIT 1");
    $ultima_auditoria = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($ultima_auditoria) {
        echo "<pre>";
        print_r($ultima_auditoria);
        echo "</pre>";
    } else {
        echo "<p>No se encontró ninguna auditoría.</p>";
    }
    
    // 4. Verificar si hay clientes
    echo "<h3>4. Clientes en la base de datos:</h3>";
    $stmt = $pdo->query("SELECT id, nombre_empresa FROM clientes ORDER BY id");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>Total de clientes: " . count($clientes) . "</p>";
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            echo "<p>ID: " . $cliente['id'] . " - Nombre: " . htmlspecialchars($cliente['nombre_empresa']) . "</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>