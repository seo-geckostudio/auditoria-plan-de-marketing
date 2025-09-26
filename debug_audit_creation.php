<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/forms.php';

echo "<h1>Debug: Creación de Auditoría Paso a Paso</h1>";

// 1. Verificar conexión a base de datos
echo "<h2>1. Verificación de Base de Datos</h2>";
try {
    $pdo = obtenerConexion();
    echo "✅ Conexión a base de datos: OK<br>";
    
    // Verificar si existe la tabla historial_cambios
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='historial_cambios'");
    $tabla = $stmt->fetch();
    if ($tabla) {
        echo "✅ Tabla historial_cambios: Existe<br>";
        
        // Verificar estructura de la tabla
        $stmt = $pdo->query("PRAGMA table_info(historial_cambios)");
        $columnas = $stmt->fetchAll();
        echo "📋 Columnas de historial_cambios:<br>";
        foreach ($columnas as $col) {
            echo "  - {$col['name']} ({$col['type']})<br>";
        }
    } else {
        echo "❌ Tabla historial_cambios: NO EXISTE<br>";
    }
    
    // Verificar tabla auditorias
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='auditorias'");
    $tabla = $stmt->fetch();
    if ($tabla) {
        echo "✅ Tabla auditorias: Existe<br>";
    } else {
        echo "❌ Tabla auditorias: NO EXISTE<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 2. Preparar datos de prueba
echo "<h2>2. Datos de Prueba</h2>";
$datosAuditoria = [
    'titulo' => 'Auditoría de Prueba Debug',
    'descripcion' => 'Descripción de prueba para debug',
    'cliente_id' => 1,
    'usuario_id' => 1,
    'estado' => 'planificada',
    'fecha_inicio' => date('Y-m-d'),
    'porcentaje_completado' => 0.00
];

echo "📋 Datos preparados:<br>";
foreach ($datosAuditoria as $campo => $valor) {
    echo "  - {$campo}: {$valor}<br>";
}

echo "<hr>";

// 3. Probar insertarRegistro directamente
echo "<h2>3. Prueba de insertarRegistro</h2>";
try {
    $auditoriaId = insertarRegistro('auditorias', $datosAuditoria);
    if ($auditoriaId) {
        echo "✅ insertarRegistro: OK - ID generado: {$auditoriaId}<br>";
        
        // Verificar que se insertó
        $auditoria = obtenerRegistro("SELECT * FROM auditorias WHERE id = ?", [$auditoriaId]);
        if ($auditoria) {
            echo "✅ Verificación: Auditoría insertada correctamente<br>";
            echo "📋 Datos insertados: " . json_encode($auditoria) . "<br>";
        } else {
            echo "❌ Verificación: No se encontró la auditoría insertada<br>";
        }
    } else {
        echo "❌ insertarRegistro: FALLÓ<br>";
    }
} catch (Exception $e) {
    echo "❌ Error en insertarRegistro: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 4. Probar registrarCambio
echo "<h2>4. Prueba de registrarCambio</h2>";
if (isset($auditoriaId) && $auditoriaId) {
    try {
        registrarCambio($auditoriaId, 1, 'creacion', 'Auditoría creada en debug');
        echo "✅ registrarCambio: OK<br>";
        
        // Verificar que se registró el cambio
        $cambio = obtenerRegistro("SELECT * FROM historial_cambios WHERE auditoria_id = ? ORDER BY id DESC LIMIT 1", [$auditoriaId]);
        if ($cambio) {
            echo "✅ Verificación: Cambio registrado correctamente<br>";
            echo "📋 Cambio registrado: " . json_encode($cambio) . "<br>";
        } else {
            echo "❌ Verificación: No se encontró el cambio registrado<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error en registrarCambio: " . $e->getMessage() . "<br>";
    }
} else {
    echo "⚠️ No se puede probar registrarCambio sin ID de auditoría<br>";
}

echo "<hr>";

// 5. Probar crearAuditoria completa
echo "<h2>5. Prueba de crearAuditoria</h2>";
$datosAuditoria2 = [
    'titulo' => 'Auditoría de Prueba Debug 2',
    'descripcion' => 'Segunda descripción de prueba para debug',
    'cliente_id' => 1,
    'usuario_id' => 1,
    'estado' => 'planificada',
    'fecha_inicio' => date('Y-m-d'),
    'porcentaje_completado' => 0.00
];

try {
    $auditoriaId2 = crearAuditoria($datosAuditoria2);
    if ($auditoriaId2) {
        echo "✅ crearAuditoria: OK - ID generado: {$auditoriaId2}<br>";
    } else {
        echo "❌ crearAuditoria: FALLÓ<br>";
    }
} catch (Exception $e) {
    echo "❌ Error en crearAuditoria: " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 6. Probar procesarCrearAuditoria
echo "<h2>6. Prueba de procesarCrearAuditoria</h2>";
$_POST = [
    'nombre' => 'Auditoría de Prueba Debug 3',
    'descripcion' => 'Tercera descripción de prueba para debug',
    'url_principal' => 'https://ejemplo3.com',
    'cliente_id' => '1',
    'usuario_id' => '1',
    'fecha_inicio' => date('Y-m-d'),
    'fases' => ['1', '2']
];

try {
    $resultado = procesarCrearAuditoria();
    echo "📋 Resultado de procesarCrearAuditoria:<br>";
    echo "<pre>" . print_r($resultado, true) . "</pre>";
} catch (Exception $e) {
    echo "❌ Error en procesarCrearAuditoria: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>🔍 Resumen del Debug</h2>";
echo "Este script ha probado cada componente del proceso de creación de auditorías.<br>";
echo "Revisa los resultados arriba para identificar dónde está el problema.<br>";
?>