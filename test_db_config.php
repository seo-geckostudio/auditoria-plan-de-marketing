<?php
// Script para configurar la base de datos automáticamente
$url = 'http://localhost:8000/install.php?paso=configurar_bd';

$data = [
    'host' => 'localhost',
    'puerto' => '3306',
    'nombre_bd' => 'auditoria_seo',
    'usuario' => 'root',
    'password' => ''
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo "Error al configurar la base de datos\n";
} else {
    echo "Configuración de base de datos enviada\n";
    // Buscar errores en la respuesta
    if (strpos($result, 'error') !== false || strpos($result, 'Error') !== false) {
        echo "Posibles errores encontrados en la respuesta:\n";
        // Extraer líneas que contengan error
        $lines = explode("\n", $result);
        foreach ($lines as $line) {
            if (stripos($line, 'error') !== false) {
                echo "- " . trim(strip_tags($line)) . "\n";
            }
        }
    } else {
        echo "Configuración completada exitosamente\n";
    }
}
?>