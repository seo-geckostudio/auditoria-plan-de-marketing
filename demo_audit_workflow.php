<?php
// Demostración completa del flujo de trabajo de auditorías
require_once 'config/database.php';
require_once 'includes/functions.php';

echo "<h1>Demostración: Flujo de Trabajo de Auditorías SEO</h1>\n";

try {
    $pdo = obtenerConexion();
    
    echo "<h2>PASO 1: Crear una Auditoría de Ejemplo</h2>\n";
    
    // Verificar si existe un cliente
    $stmt = $pdo->query("SELECT * FROM clientes LIMIT 1");
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$cliente) {
        // Crear cliente de ejemplo
        $stmt = $pdo->prepare("
            INSERT INTO clientes (nombre_empresa, contacto_principal, email, telefono, sitio_web, fecha_creacion)
            VALUES (?, ?, ?, ?, ?, datetime('now'))
        ");
        $stmt->execute(['Empresa Demo SEO', 'Juan Pérez', 'juan@empresademo.com', '+34 600 123 456', 'https://empresademo.com']);
        $cliente_id = $pdo->lastInsertId();
        echo "✅ Cliente creado: ID $cliente_id - Empresa Demo SEO<br>\n";
    } else {
        $cliente_id = $cliente['id'];
        echo "✅ Usando cliente existente: ID {$cliente['id']} - {$cliente['nombre_empresa']}<br>\n";
    }
    
    // Verificar si existe un usuario
    $stmt = $pdo->query("SELECT * FROM usuarios LIMIT 1");
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$usuario) {
        // Crear usuario de ejemplo
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nombre, email, rol, activo, fecha_creacion)
            VALUES (?, ?, ?, 1, datetime('now'))
        ");
        $stmt->execute(['Consultor SEO Demo', 'consultor@demo.com', 'consultor']);
        $usuario_id = $pdo->lastInsertId();
        echo "✅ Usuario creado: ID $usuario_id - Consultor SEO Demo<br>\n";
    } else {
        $usuario_id = $usuario['id'];
        echo "✅ Usando usuario existente: ID {$usuario['id']} - {$usuario['nombre']}<br>\n";
    }
    
    // Crear auditoría de ejemplo
    $stmt = $pdo->prepare("
        INSERT INTO auditorias (cliente_id, usuario_id, titulo, descripcion, fecha_inicio, estado, fecha_creacion)
        VALUES (?, ?, ?, ?, ?, 'en_progreso', datetime('now'))
    ");
    $stmt->execute([
        $cliente_id, 
        $usuario_id, 
        'Auditoría SEO Completa - Empresa Demo', 
        'Auditoría completa de SEO técnico, contenido y competencia para mejorar el posicionamiento web',
        date('Y-m-d')
    ]);
    $auditoria_id = $pdo->lastInsertId();
    echo "✅ Auditoría creada: ID $auditoria_id<br>\n";
    
    echo "<h2>PASO 2: Asignar Pasos de las Plantillas</h2>\n";
    
    // Obtener plantillas de pasos de las primeras 3 fases
    $stmt = $pdo->query("
        SELECT pp.*, f.nombre as fase_nombre, f.numero_fase 
        FROM pasos_plantilla pp 
        JOIN fases f ON pp.fase_id = f.id 
        WHERE f.numero_fase IN (1, 2, 3)
        ORDER BY f.numero_fase, pp.orden_en_fase 
        LIMIT 10
    ");
    $plantillas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $pasos_creados = 0;
    foreach ($plantillas as $plantilla) {
        $stmt = $pdo->prepare("
            INSERT INTO auditoria_pasos (auditoria_id, paso_plantilla_id, estado, usuario_asignado_id, fecha_creacion)
            VALUES (?, ?, 'pendiente', ?, datetime('now'))
        ");
        $stmt->execute([$auditoria_id, $plantilla['id'], $usuario_id]);
        $pasos_creados++;
    }
    
    echo "✅ $pasos_creados pasos asignados a la auditoría<br>\n";
    
    echo "<h2>PASO 3: Simular Trabajo en los Pasos</h2>\n";
    
    // Obtener los pasos creados
    $stmt = $pdo->query("
        SELECT ap.*, pp.nombre as paso_nombre, pp.descripcion, f.nombre as fase_nombre
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        JOIN fases f ON pp.fase_id = f.id
        WHERE ap.auditoria_id = $auditoria_id
        ORDER BY f.numero_fase, pp.orden_en_fase
        LIMIT 5
    ");
    $pasos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>3.1 Completar Primer Paso: Brief Inicial</h3>\n";
    if (count($pasos) > 0) {
        $primer_paso = $pasos[0];
        
        // Datos de ejemplo para el brief inicial
        $datos_brief = [
            'objetivos_cliente' => [
                'aumentar_trafico_organico' => true,
                'mejorar_conversiones' => true,
                'posicionamiento_keywords' => ['seo madrid', 'consultor seo', 'auditoria seo']
            ],
            'situacion_actual' => [
                'trafico_mensual' => '15000',
                'keywords_posicionadas' => '45',
                'competencia_principal' => ['competidor1.com', 'competidor2.com']
            ],
            'accesos_proporcionados' => [
                'google_analytics' => true,
                'search_console' => true,
                'acceso_web' => false
            ],
            'presupuesto_estimado' => '2000-5000',
            'timeline_proyecto' => '3 meses'
        ];
        
        $stmt = $pdo->prepare("
            UPDATE auditoria_pasos 
            SET estado = 'completado', 
                fecha_inicio = datetime('now', '-2 hours'),
                fecha_completado = datetime('now'),
                tiempo_real_horas = 2.5,
                notas = 'Brief inicial completado. Cliente muy colaborativo, objetivos claros.',
                datos_completados = ?
            WHERE id = ?
        ");
        $stmt->execute([json_encode($datos_brief), $primer_paso['id']]);
        
        echo "✅ Paso completado: {$primer_paso['paso_nombre']}<br>\n";
        echo "<strong>Datos registrados:</strong><br>\n";
        echo "<pre style='background-color: #f8f9fa; padding: 10px; font-size: 12px;'>";
        echo json_encode($datos_brief, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo "</pre>\n";
    }
    
    echo "<h3>3.2 Trabajar en Segundo Paso: Checklist de Accesos</h3>\n";
    if (count($pasos) > 1) {
        $segundo_paso = $pasos[1];
        
        // Datos de ejemplo para checklist de accesos
        $datos_accesos = [
            'accesos_verificados' => [
                'google_analytics' => ['status' => 'ok', 'nivel_acceso' => 'editor'],
                'search_console' => ['status' => 'ok', 'nivel_acceso' => 'propietario'],
                'google_ads' => ['status' => 'pendiente', 'observacion' => 'Cliente debe dar acceso'],
                'ftp_cpanel' => ['status' => 'no_disponible', 'observacion' => 'No necesario por ahora']
            ],
            'herramientas_configuradas' => [
                'screaming_frog' => true,
                'semrush' => true,
                'ahrefs' => false
            ],
            'proximos_pasos' => 'Solicitar acceso a Google Ads para análisis de keywords pagadas'
        ];
        
        $stmt = $pdo->prepare("
            UPDATE auditoria_pasos 
            SET estado = 'en_progreso', 
                fecha_inicio = datetime('now', '-1 hour'),
                tiempo_real_horas = 1.0,
                notas = 'Verificando accesos. Falta Google Ads.',
                datos_completados = ?
            WHERE id = ?
        ");
        $stmt->execute([json_encode($datos_accesos), $segundo_paso['id']]);
        
        echo "✅ Paso en progreso: {$segundo_paso['paso_nombre']}<br>\n";
        echo "<strong>Estado actual:</strong><br>\n";
        echo "<pre style='background-color: #fff3cd; padding: 10px; font-size: 12px;'>";
        echo json_encode($datos_accesos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        echo "</pre>\n";
    }
    
    echo "<h2>PASO 4: Agregar Comentarios y Archivos</h2>\n";
    
    // Agregar comentarios de ejemplo
    if (count($pasos) > 0) {
        $stmt = $pdo->prepare("
            INSERT INTO comentarios (auditoria_paso_id, usuario_id, comentario, es_interno, fecha_creacion)
            VALUES (?, ?, ?, 0, datetime('now'))
        ");
        $stmt->execute([
            $pasos[0]['id'], 
            $usuario_id, 
            'Brief inicial muy completo. El cliente tiene objetivos claros y realistas. Recomiendo empezar con análisis técnico.'
        ]);
        
        $stmt->execute([
            $pasos[1]['id'], 
            $usuario_id, 
            'PENDIENTE: Solicitar acceso a Google Ads para completar el análisis de keywords pagadas.'
        ]);
        
        echo "✅ Comentarios agregados a los pasos<br>\n";
    }
    
    // Simular archivos subidos
    if (count($pasos) > 0) {
        $stmt = $pdo->prepare("
            INSERT INTO archivos (auditoria_paso_id, nombre_archivo, nombre_original, ruta_archivo, tipo_mime, tamaño_bytes, descripcion, usuario_subida_id, fecha_subida)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, datetime('now'))
        ");
        
        $stmt->execute([
            $pasos[0]['id'],
            'brief_inicial_empresa_demo.pdf',
            'Brief Inicial - Empresa Demo.pdf',
            '/uploads/auditorias/' . $auditoria_id . '/brief_inicial_empresa_demo.pdf',
            'application/pdf',
            245760,
            'Documento con el brief inicial completado por el cliente',
            $usuario_id
        ]);
        
        $stmt->execute([
            $pasos[1]['id'],
            'checklist_accesos_ga_gsc.xlsx',
            'Checklist Accesos - GA y GSC.xlsx',
            '/uploads/auditorias/' . $auditoria_id . '/checklist_accesos_ga_gsc.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            89432,
            'Checklist de verificación de accesos a herramientas',
            $usuario_id
        ]);
        
        echo "✅ Archivos de ejemplo agregados<br>\n";
    }
    
    echo "<h2>PASO 5: Resumen del Estado Actual</h2>\n";
    
    // Mostrar resumen de la auditoría
    $stmt = $pdo->query("
        SELECT 
            a.titulo,
            a.estado as auditoria_estado,
            c.nombre_empresa,
            u.nombre as consultor,
            COUNT(ap.id) as total_pasos,
            SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados,
            SUM(CASE WHEN ap.estado = 'en_progreso' THEN 1 ELSE 0 END) as pasos_en_progreso,
            SUM(CASE WHEN ap.estado = 'pendiente' THEN 1 ELSE 0 END) as pasos_pendientes,
            ROUND(AVG(ap.tiempo_real_horas), 2) as tiempo_promedio_horas
        FROM auditorias a
        JOIN clientes c ON a.cliente_id = c.id
        JOIN usuarios u ON a.usuario_id = u.id
        LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
        WHERE a.id = $auditoria_id
        GROUP BY a.id
    ");
    $resumen = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($resumen) {
        $progreso = $resumen['total_pasos'] > 0 ? 
            round(($resumen['pasos_completados'] / $resumen['total_pasos']) * 100, 1) : 0;
        
        echo "<div style='background-color: #e7f3ff; padding: 15px; border-left: 4px solid #2196F3;'>\n";
        echo "<h3>📊 Resumen de la Auditoría</h3>\n";
        echo "<strong>Proyecto:</strong> {$resumen['titulo']}<br>\n";
        echo "<strong>Cliente:</strong> {$resumen['nombre_empresa']}<br>\n";
        echo "<strong>Consultor:</strong> {$resumen['consultor']}<br>\n";
        echo "<strong>Estado:</strong> {$resumen['auditoria_estado']}<br>\n";
        echo "<strong>Progreso:</strong> {$progreso}% ({$resumen['pasos_completados']}/{$resumen['total_pasos']} pasos)<br>\n";
        echo "<strong>Distribución:</strong> {$resumen['pasos_completados']} completados, {$resumen['pasos_en_progreso']} en progreso, {$resumen['pasos_pendientes']} pendientes<br>\n";
        echo "<strong>Tiempo promedio por paso:</strong> {$resumen['tiempo_promedio_horas']} horas<br>\n";
        echo "</div>\n";
    }
    
    // Mostrar detalles de los pasos
    echo "<h3>📋 Detalle de Pasos</h3>\n";
    $stmt = $pdo->query("
        SELECT 
            ap.*,
            pp.nombre as paso_nombre,
            pp.descripcion,
            f.nombre as fase_nombre,
            f.numero_fase,
            COUNT(c.id) as total_comentarios,
            COUNT(ar.id) as total_archivos
        FROM auditoria_pasos ap
        JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
        JOIN fases f ON pp.fase_id = f.id
        LEFT JOIN comentarios c ON ap.id = c.auditoria_paso_id
        LEFT JOIN archivos ar ON ap.id = ar.auditoria_paso_id
        WHERE ap.auditoria_id = $auditoria_id
        GROUP BY ap.id
        ORDER BY f.numero_fase, pp.orden_en_fase
    ");
    $pasos_detalle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 12px;'>\n";
    echo "<tr style='background-color: #f0f0f0;'>";
    echo "<th>Fase</th><th>Paso</th><th>Estado</th><th>Tiempo</th><th>Archivos</th><th>Comentarios</th><th>Última Actualización</th>";
    echo "</tr>\n";
    
    foreach ($pasos_detalle as $paso) {
        $estado_color = [
            'completado' => '#d4edda',
            'en_progreso' => '#fff3cd',
            'pendiente' => '#f8d7da',
            'bloqueado' => '#f5c6cb',
            'omitido' => '#e2e3e5'
        ];
        
        echo "<tr>";
        echo "<td><strong>Fase {$paso['numero_fase']}</strong><br><small>{$paso['fase_nombre']}</small></td>";
        echo "<td><strong>{$paso['paso_nombre']}</strong><br><small>" . substr($paso['descripcion'], 0, 50) . "...</small></td>";
        echo "<td style='background-color: " . ($estado_color[$paso['estado']] ?? '#ffffff') . "; text-align: center;'>{$paso['estado']}</td>";
        echo "<td style='text-align: center;'>" . ($paso['tiempo_real_horas'] ?? '0') . "h</td>";
        echo "<td style='text-align: center;'>{$paso['total_archivos']}</td>";
        echo "<td style='text-align: center;'>{$paso['total_comentarios']}</td>";
        echo "<td><small>{$paso['fecha_actualizacion']}</small></td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    
    echo "<h2>🎯 CONCLUSIONES</h2>\n";
    echo "<div style='background-color: #d1ecf1; padding: 15px; border-left: 4px solid #bee5eb;'>\n";
    echo "<h4>Sistema de Auditorías - Funcionalidades Demostradas:</h4>\n";
    echo "<ul>\n";
    echo "<li>✅ <strong>Creación de auditorías</strong> asociadas a clientes y consultores</li>\n";
    echo "<li>✅ <strong>Asignación automática de pasos</strong> basada en plantillas por fase</li>\n";
    echo "<li>✅ <strong>Gestión de estados</strong> (pendiente, en progreso, completado, etc.)</li>\n";
    echo "<li>✅ <strong>Registro de datos específicos</strong> en formato JSON por cada paso</li>\n";
    echo "<li>✅ <strong>Control de tiempo</strong> real invertido en cada paso</li>\n";
    echo "<li>✅ <strong>Sistema de comentarios</strong> para comunicación y seguimiento</li>\n";
    echo "<li>✅ <strong>Gestión de archivos</strong> asociados a cada paso</li>\n";
    echo "<li>✅ <strong>Seguimiento de progreso</strong> y métricas de la auditoría</li>\n";
    echo "</ul>\n";
    echo "</div>\n";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>\n";
}
?>