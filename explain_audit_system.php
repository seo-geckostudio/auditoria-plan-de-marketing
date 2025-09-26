<?php
// Explicación completa del sistema de auditorías y pasos
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Sistema de Auditorías SEO - Relación entre Auditorías y Pasos</h1>\n";

try {
    $pdo = obtenerConexion();
    
    echo "<h2>1. ESTRUCTURA DEL SISTEMA</h2>\n";
    echo "<p>El sistema funciona con una arquitectura jerárquica de 4 niveles:</p>\n";
    echo "<ol>\n";
    echo "<li><strong>Fases</strong> - Las 6 fases principales (0-5)</li>\n";
    echo "<li><strong>Plantillas de Pasos</strong> - Pasos predefinidos para cada fase</li>\n";
    echo "<li><strong>Auditorías</strong> - Proyectos específicos para clientes</li>\n";
    echo "<li><strong>Pasos de Auditoría</strong> - Instancias específicas de pasos en cada auditoría</li>\n";
    echo "</ol>\n";
    
    echo "<h2>2. RELACIONES EN LA BASE DE DATOS</h2>\n";
    
    // Mostrar fases
    echo "<h3>2.1 Fases del Sistema</h3>\n";
    $stmt = $pdo->query("SELECT numero_fase, nombre, descripcion FROM fases ORDER BY numero_fase");
    $fases = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>\n";
    echo "<tr style='background-color: #f0f0f0;'><th>Número</th><th>Nombre</th><th>Descripción</th></tr>\n";
    foreach ($fases as $fase) {
        echo "<tr>";
        echo "<td>{$fase['numero_fase']}</td>";
        echo "<td><strong>{$fase['nombre']}</strong></td>";
        echo "<td>{$fase['descripcion']}</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    
    // Mostrar plantillas de pasos
    echo "<h3>2.2 Plantillas de Pasos por Fase</h3>\n";
    $stmt = $pdo->query("
        SELECT f.numero_fase, f.nombre as fase_nombre, 
               COUNT(pp.id) as total_pasos,
               GROUP_CONCAT(pp.nombre, ' | ') as pasos_nombres
        FROM fases f 
        LEFT JOIN pasos_plantilla pp ON f.id = pp.fase_id 
        GROUP BY f.id 
        ORDER BY f.numero_fase
    ");
    $plantillas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>\n";
    echo "<tr style='background-color: #f0f0f0;'><th>Fase</th><th>Total Pasos</th><th>Ejemplos de Pasos</th></tr>\n";
    foreach ($plantillas as $plantilla) {
        $ejemplos = $plantilla['pasos_nombres'] ? substr($plantilla['pasos_nombres'], 0, 100) . '...' : 'Sin pasos definidos';
        echo "<tr>";
        echo "<td><strong>Fase {$plantilla['numero_fase']}</strong><br>{$plantilla['fase_nombre']}</td>";
        echo "<td style='text-align: center;'>{$plantilla['total_pasos']}</td>";
        echo "<td><small>{$ejemplos}</small></td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    
    // Mostrar auditorías existentes
    echo "<h3>2.3 Auditorías en el Sistema</h3>\n";
    $stmt = $pdo->query("
        SELECT a.id, a.titulo, a.estado, a.fecha_inicio, 
               c.nombre_empresa, u.nombre as consultor,
               COUNT(ap.id) as pasos_asignados,
               SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados
        FROM auditorias a
        LEFT JOIN clientes c ON a.cliente_id = c.id
        LEFT JOIN usuarios u ON a.usuario_id = u.id
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        GROUP BY a.id
        ORDER BY a.fecha_creacion DESC
        LIMIT 10
    ");
    $auditorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($auditorias) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>\n";
        echo "<tr style='background-color: #f0f0f0;'><th>ID</th><th>Auditoría</th><th>Cliente</th><th>Estado</th><th>Progreso</th><th>Fecha Inicio</th></tr>\n";
        foreach ($auditorias as $auditoria) {
            $progreso = $auditoria['pasos_asignados'] > 0 ? 
                round(($auditoria['pasos_completados'] / $auditoria['pasos_asignados']) * 100, 1) : 0;
            echo "<tr>";
            echo "<td>{$auditoria['id']}</td>";
            echo "<td><strong>{$auditoria['titulo']}</strong></td>";
            echo "<td>{$auditoria['nombre_empresa']}</td>";
            echo "<td><span style='padding: 2px 6px; background-color: " . 
                 ($auditoria['estado'] == 'completada' ? '#d4edda' : 
                  ($auditoria['estado'] == 'en_progreso' ? '#fff3cd' : '#f8d7da')) . 
                 ";'>{$auditoria['estado']}</span></td>";
            echo "<td>{$auditoria['pasos_completados']}/{$auditoria['pasos_asignados']} ({$progreso}%)</td>";
            echo "<td>{$auditoria['fecha_inicio']}</td>";
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else {
        echo "<p><em>No hay auditorías creadas aún.</em></p>\n";
    }
    
    echo "<h2>3. FLUJO DE TRABAJO</h2>\n";
    echo "<div style='background-color: #f8f9fa; padding: 15px; border-left: 4px solid #007bff;'>\n";
    echo "<h4>Proceso paso a paso:</h4>\n";
    echo "<ol>\n";
    echo "<li><strong>Crear Cliente</strong> - Registrar información del cliente</li>\n";
    echo "<li><strong>Crear Auditoría</strong> - Asociar auditoría al cliente y consultor</li>\n";
    echo "<li><strong>Asignar Pasos</strong> - El sistema crea automáticamente los pasos basados en las plantillas</li>\n";
    echo "<li><strong>Ejecutar Pasos</strong> - Completar cada paso, subir archivos, añadir notas</li>\n";
    echo "<li><strong>Seguimiento</strong> - Monitorear progreso y generar reportes</li>\n";
    echo "</ol>\n";
    echo "</div>\n";
    
    echo "<h2>4. INTRODUCCIÓN DE DATOS EN CADA PASO</h2>\n";
    echo "<p>Cada paso de una auditoría puede contener:</p>\n";
    echo "<ul>\n";
    echo "<li><strong>Estado</strong>: pendiente, en_progreso, completado, omitido, bloqueado</li>\n";
    echo "<li><strong>Notas</strong>: Observaciones y comentarios del consultor</li>\n";
    echo "<li><strong>Datos Completados</strong>: Información específica en formato JSON</li>\n";
    echo "<li><strong>Archivos</strong>: Documentos, imágenes, reportes asociados</li>\n";
    echo "<li><strong>Tiempo Real</strong>: Horas invertidas en el paso</li>\n";
    echo "<li><strong>Comentarios</strong>: Comunicación entre consultores</li>\n";
    echo "</ul>\n";
    
    // Ejemplo de estructura de datos
    echo "<h3>4.1 Ejemplo de Datos JSON en un Paso</h3>\n";
    echo "<pre style='background-color: #f8f9fa; padding: 10px; border: 1px solid #dee2e6;'>\n";
    echo "{\n";
    echo '  "checklist_accesos": {' . "\n";
    echo '    "google_analytics": true,' . "\n";
    echo '    "google_search_console": true,' . "\n";
    echo '    "acceso_ftp": false,' . "\n";
    echo '    "acceso_cms": true' . "\n";
    echo '  },' . "\n";
    echo '  "urls_analizadas": [' . "\n";
    echo '    "https://ejemplo.com",' . "\n";
    echo '    "https://ejemplo.com/productos"' . "\n";
    echo '  ],' . "\n";
    echo '  "observaciones": "Cliente necesita configurar acceso FTP"' . "\n";
    echo "}\n";
    echo "</pre>\n";
    
    echo "<h2>5. TABLAS PRINCIPALES Y SUS RELACIONES</h2>\n";
    echo "<div style='font-family: monospace; background-color: #f8f9fa; padding: 15px;'>\n";
    echo "<strong>fases</strong> (6 fases: 0-5)<br>\n";
    echo "├── <strong>pasos_plantilla</strong> (plantillas de pasos por fase)<br>\n";
    echo "│<br>\n";
    echo "<strong>clientes</strong><br>\n";
    echo "├── <strong>auditorias</strong> (proyectos específicos)<br>\n";
    echo "    ├── <strong>auditoria_pasos</strong> (instancias de pasos)<br>\n";
    echo "    │   ├── <strong>archivos</strong> (documentos subidos)<br>\n";
    echo "    │   └── <strong>comentarios</strong> (notas y comunicación)<br>\n";
    echo "    └── <strong>historial_cambios</strong> (log de actividades)<br>\n";
    echo "</div>\n";
    
    echo "<h2>6. PRÓXIMOS PASOS RECOMENDADOS</h2>\n";
    echo "<div style='background-color: #d1ecf1; padding: 15px; border-left: 4px solid #bee5eb;'>\n";
    echo "<ol>\n";
    echo "<li>Crear un cliente de prueba</li>\n";
    echo "<li>Crear una auditoría asociada al cliente</li>\n";
    echo "<li>Importar pasos desde las plantillas</li>\n";
    echo "<li>Probar la introducción de datos en los pasos</li>\n";
    echo "<li>Verificar el flujo completo de trabajo</li>\n";
    echo "</ol>\n";
    echo "</div>\n";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>\n";
}
?>