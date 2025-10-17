<?php
/**
 * Test final de Ollama con limpieza mejorada
 */

function limpiarCodigosANSI($texto) {
    $texto = preg_replace('/\x1B\[[0-9;]*[a-zA-Z]/', '', $texto);
    $texto = preg_replace('/\x1B\][0-9;]*\x07/', '', $texto);
    $texto = preg_replace('/\[\?[0-9]+[hl]/', '', $texto);
    $texto = preg_replace('/\[([0-9]+)G/', '', $texto);
    $texto = preg_replace('/\[[0-9]+K/', '', $texto);
    $texto = preg_replace('/\[K/', '', $texto);
    $texto = preg_replace('/[\x{2800}-\x{28FF}]/u', '', $texto);
    $texto = preg_replace('/[\x00-\x1F\x7F]/u', '', $texto);
    return trim($texto);
}

$promptTest = <<<'PROMPT'
Return ONLY a valid JSON with this data:
Company: ACME Corp
Contact: John Doe
Email: john@acme.com

Format:
{"company": "ACME Corp", "contact": "John Doe", "email": "john@acme.com"}
PROMPT;

echo "=== TEST FINAL OLLAMA ===\n\n";

$tempFile = sys_get_temp_dir() . '/ollama_final.txt';
file_put_contents($tempFile, $promptTest);

$inicio = microtime(true);
$comando = "ollama run llama3.1 < \"$tempFile\"";
exec($comando . ' 2>&1', $output, $return);
$tiempo = round(microtime(true) - $inicio, 2);

$respuesta = implode("\n", $output);
$respuestaLimpia = limpiarCodigosANSI($respuesta);

echo "Tiempo: {$tiempo}s\n";
echo "Return: $return\n\n";

echo "Respuesta limpia:\n";
echo "---\n$respuestaLimpia\n---\n\n";

if (preg_match('/\{[^{}]*\}/', $respuestaLimpia, $matches)) {
    echo "JSON encontrado: " . $matches[0] . "\n\n";
    $json = json_decode($matches[0], true);

    if ($json !== null) {
        echo "✅ JSON VÁLIDO!\n";
        print_r($json);
    } else {
        echo "❌ JSON inválido: " . json_last_error_msg() . "\n";
    }
} else {
    echo "❌ No se encontró JSON\n";
}

@unlink($tempFile);
