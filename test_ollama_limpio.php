<?php
/**
 * Test: Ollama con limpieza de códigos ANSI
 */

// Función de limpieza (igual que en el backend)
function limpiarCodigosANSI($texto) {
    $texto = preg_replace('/\x1B\[[0-9;]*[a-zA-Z]/', '', $texto);
    $texto = preg_replace('/\x1B\][0-9;]*\x07/', '', $texto);
    $texto = preg_replace('/\[\?[0-9]+[hl]/', '', $texto);
    $texto = preg_replace('/\[([0-9]+)G/', '', $texto);
    $texto = preg_replace('/\[K/', '', $texto);
    return trim($texto);
}

$promptTest = <<<'PROMPT'
Extract the following information and return ONLY a valid JSON:
- Company name: ACME Digital
- Contact: Juan Pérez
- Email: juan@acme.com

JSON format:
{
  "nombre_empresa": "",
  "contacto": "",
  "email": ""
}
PROMPT;

echo "=== TEST OLLAMA CON LIMPIEZA ANSI ===\n\n";

$tempFile = sys_get_temp_dir() . '/ollama_clean_test.txt';
file_put_contents($tempFile, $promptTest);

echo "1. Ejecutando Ollama...\n";
$inicio = microtime(true);

$comando = "ollama run llama3.1 < \"$tempFile\"";
exec($comando . ' 2>&1', $output, $return);

$tiempo = round(microtime(true) - $inicio, 2);

$respuesta = implode("\n", $output);

echo "2. Tiempo: {$tiempo}s\n";
echo "3. Return code: $return\n\n";

echo "4. Respuesta RAW (primeros 200 chars):\n";
echo substr($respuesta, 0, 200) . "...\n\n";

// Limpiar códigos ANSI
$respuestaLimpia = limpiarCodigosANSI($respuesta);

echo "5. Respuesta LIMPIA (primeros 200 chars):\n";
echo substr($respuestaLimpia, 0, 200) . "...\n\n";

// Extraer JSON
if (preg_match('/\{[\s\S]*?\}/', $respuestaLimpia, $matches)) {
    echo "6. JSON extraído:\n";
    echo $matches[0] . "\n\n";

    $json = json_decode($matches[0], true);
    if ($json !== null) {
        echo "✅ JSON VÁLIDO\n";
        echo "Datos: " . print_r($json, true) . "\n";
    } else {
        echo "❌ JSON inválido: " . json_last_error_msg() . "\n";
    }
} else {
    echo "❌ No se encontró JSON\n";
}

@unlink($tempFile);
