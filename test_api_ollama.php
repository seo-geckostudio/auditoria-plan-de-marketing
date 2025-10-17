<?php
/**
 * Test: API completa de ejecución con Ollama
 */

echo "=== TEST API EJECUTAR_IA_LOCAL.PHP CON OLLAMA ===\n\n";

$payload = [
    'cli' => 'ollama',
    'prompt' => 'Extract company info and return JSON: Company is ACME Solutions, contact is Maria Garcia, email maria@acme.com. Return format: {"company": "", "contact": "", "email": ""}',
    'opciones' => [
        'model' => 'llama3.1',
        'temperature' => 0.1
    ]
];

$ch = curl_init('http://localhost:8000/api/ejecutar_ia_local.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

echo "1. Enviando request a API...\n";
echo "   Modelo: {$payload['opciones']['model']}\n\n";

$inicio = microtime(true);
$response = curl_exec($ch);
$tiempo = round(microtime(true) - $inicio, 2);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "2. Respuesta recibida en {$tiempo}s\n";
echo "   HTTP Code: $httpCode\n\n";

if ($response) {
    $data = json_decode($response, true);

    if ($data) {
        echo "3. Datos de respuesta:\n";
        echo "   Success: " . ($data['success'] ? '✅ Sí' : '❌ No') . "\n";

        if ($data['success']) {
            echo "   CLI usado: " . ($data['comando_usado'] ?? 'N/A') . "\n";
            echo "   Modelo: " . ($data['model'] ?? 'N/A') . "\n";
            echo "   Tipo: " . ($data['tipo'] ?? 'N/A') . "\n\n";

            echo "4. Respuesta (primeros 200 chars):\n";
            echo "   " . substr($data['respuesta'], 0, 200) . "...\n\n";

            // Intentar extraer JSON
            if (preg_match('/\{[^{}]*\}/', $data['respuesta'], $matches)) {
                $json = json_decode($matches[0], true);
                if ($json) {
                    echo "5. ✅ JSON EXTRAÍDO Y VÁLIDO:\n";
                    print_r($json);
                } else {
                    echo "5. ❌ JSON encontrado pero inválido\n";
                }
            } else {
                echo "5. ⚠️ No se encontró JSON en la respuesta\n";
            }
        } else {
            echo "   Error: " . ($data['error'] ?? 'Desconocido') . "\n";
        }
    } else {
        echo "❌ No se pudo decodificar JSON de respuesta\n";
        echo "Response raw: $response\n";
    }
} else {
    echo "❌ No se recibió respuesta\n";
}

echo "\n=== FIN DEL TEST ===\n";
