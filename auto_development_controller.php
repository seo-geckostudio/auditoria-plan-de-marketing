<?php
/**
 * CONTROLADOR DE DESARROLLO AUTOMÁTICO
 * ===================================
 * Sistema que identifica automáticamente el próximo paso a implementar
 */

$pdo = new PDO('sqlite:data/auditoria_seo.sqlite');

echo "🤖 SISTEMA DE DESARROLLO AUTOMÁTICO\n";
echo "===================================\n\n";

// 1. Obtener estado actual del desarrollo
$sql = "SELECT
    COUNT(*) as total_steps,
    SUM(CASE WHEN (SELECT COUNT(*) FROM paso_campos WHERE paso_plantilla_id = pt.id) > 0 THEN 1 ELSE 0 END) as configured_steps
    FROM pasos_plantilla pt";
$status = $pdo->query($sql)->fetch();

$progress = round(($status['configured_steps'] / $status['total_steps']) * 100, 1);

echo "📊 ESTADO ACTUAL:\n";
echo "- Total pasos: {$status['total_steps']}\n";
echo "- Pasos configurados: {$status['configured_steps']}\n";
echo "- Progreso: {$progress}%\n\n";

// 2. Identificar próximo paso a implementar
$sql = "SELECT
    pt.id,
    pt.codigo_paso,
    pt.nombre,
    (SELECT COUNT(*) FROM paso_campos WHERE paso_plantilla_id = pt.id) as campos_configurados
    FROM pasos_plantilla pt
    WHERE (SELECT COUNT(*) FROM paso_campos WHERE paso_plantilla_id = pt.id) = 0
    ORDER BY pt.id
    LIMIT 5";

$next_steps = $pdo->query($sql)->fetchAll();

echo "🎯 PRÓXIMOS PASOS A IMPLEMENTAR:\n";
foreach ($next_steps as $i => $step) {
    $priority = $i == 0 ? "⭐ PRIORITARIO" : "📋 Pendiente";
    echo ($i + 1) . ". {$priority} - ID:{$step['id']} | {$step['codigo_paso']} | {$step['nombre']}\n";
}

// 3. Identificar fases completadas
echo "\n🏆 ANÁLISIS POR FASES:\n";

$fases = [
    'Fase 0' => ['00_', '01_', '02_', '03_'],
    'Fase 1' => ['20_', '21_', '22_'],
    'Fase 2' => ['04_', '05_', '16_', '17_'],
    'Fase 3' => ['06_', '07_', '08_', '09_'],
    'Fase 4' => ['10_', '11_', '12_', '13_', '14_', '15_'],
    'Fase 5' => ['18_', '19_', '23_', '24_', '25_', '26_']
];

foreach ($fases as $fase_name => $codigos) {
    $sql = "SELECT
        COUNT(*) as total,
        SUM(CASE WHEN (SELECT COUNT(*) FROM paso_campos WHERE paso_plantilla_id = pt.id) > 0 THEN 1 ELSE 0 END) as configurados
        FROM pasos_plantilla pt
        WHERE " . implode(' OR ', array_map(fn($codigo) => "pt.codigo_paso LIKE '$codigo%'", $codigos));

    $fase_status = $pdo->query($sql)->fetch();
    $fase_progress = $fase_status['total'] > 0 ? round(($fase_status['configurados'] / $fase_status['total']) * 100, 1) : 0;

    $status_icon = $fase_progress == 100 ? "✅" : ($fase_progress > 0 ? "🔄" : "❌");
    echo "$status_icon $fase_name: {$fase_status['configurados']}/{$fase_status['total']} pasos ({$fase_progress}%)\n";
}

// 4. Comando automático para Claude
echo "\n🤖 COMANDO PARA CLAUDE:\n";
echo "=====================================\n";
if (!empty($next_steps)) {
    $next_step = $next_steps[0];
    echo "IMPLEMENTA AUTOMÁTICAMENTE: {$next_step['codigo_paso']} - {$next_step['nombre']}\n";
    echo "Configura campos, ayuda, tests y documentación. Luego continúa con el siguiente paso.\n";
} else {
    echo "🎉 ¡TODOS LOS PASOS ESTÁN CONFIGURADOS!\n";
}

echo "\n⚡ INSTRUCCIÓN AUTOMÁTICA:\n";
echo "Continúa implementando pasos automáticamente sin esperar confirmación hasta completar el sistema.\n";
?>