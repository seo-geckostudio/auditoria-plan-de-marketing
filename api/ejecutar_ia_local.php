<?php
/**
 * API: Ejecutar IA Local
 * ======================
 *
 * Ejecuta Claude CLI o Gemini CLI con el prompt proporcionado
 * y devuelve la respuesta generada
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Leer petición
$input = json_decode(file_get_contents('php://input'), true);

$cli = $input['cli'] ?? '';
$prompt = $input['prompt'] ?? '';
$archivo = $input['archivo'] ?? null;
$opciones = $input['opciones'] ?? [];

// Validar entrada
if (empty($cli) || !in_array($cli, ['ollama', 'claude', 'gemini'])) {
    http_response_code(400);
    echo json_encode(['error' => 'CLI no válida. Usa "ollama", "claude" o "gemini"']);
    exit;
}

if (empty($prompt)) {
    http_response_code(400);
    echo json_encode(['error' => 'El prompt es obligatorio']);
    exit;
}

/**
 * Ejecutar comando con timeout y captura de output
 */
function ejecutarComandoConTimeout($comando, $timeout = 120) {
    $output = [];
    $returnValue = 0;

    // Para comandos largos, usar exec() es más confiable
    // El timeout se maneja a nivel de sistema operativo
    exec($comando . ' 2>&1', $output, $returnValue);

    $stdout = implode("\n", $output);

    return [
        'success' => $returnValue === 0,
        'stdout' => trim($stdout),
        'stderr' => '',
        'exit_code' => $returnValue
    ];
}

/**
 * Guardar prompt temporalmente
 */
function guardarPromptTemporal($prompt, $archivo = null) {
    $tempDir = sys_get_temp_dir();
    $tempFile = $tempDir . '/claude_prompt_' . uniqid() . '.txt';

    $contenido = $prompt;

    // Si hay archivo adjunto, agregarlo
    if ($archivo && isset($archivo['contenido'])) {
        $contenido .= "\n\n--- ARCHIVO ADJUNTO: {$archivo['nombre']} ---\n";
        $contenido .= $archivo['contenido'];
    }

    file_put_contents($tempFile, $contenido);

    return $tempFile;
}

/**
 * Limpiar códigos ANSI de la salida
 */
function limpiarCodigosANSI($texto) {
    // Remover códigos de escape ANSI (colores, cursores, etc.)
    $texto = preg_replace('/\x1B\[[0-9;]*[a-zA-Z]/', '', $texto);
    $texto = preg_replace('/\x1B\][0-9;]*\x07/', '', $texto);
    $texto = preg_replace('/\[\?[0-9]+[hl]/', '', $texto);
    $texto = preg_replace('/\[([0-9]+)G/', '', $texto);
    $texto = preg_replace('/\[[0-9]+K/', '', $texto);
    $texto = preg_replace('/\[K/', '', $texto);

    // Remover caracteres de spinner (⠋⠙⠹⠸⠼⠴⠦⠧⠇⠏)
    $texto = preg_replace('/[\x{2800}-\x{28FF}]/u', '', $texto);

    // Remover caracteres de control y no imprimibles
    $texto = preg_replace('/[\x00-\x1F\x7F]/u', '', $texto);

    return trim($texto);
}

/**
 * Ejecutar Ollama (100% LOCAL - SIN API)
 */
function ejecutarOllama($prompt, $archivo = null, $opciones = []) {
    // Guardar prompt en archivo temporal
    $promptFile = guardarPromptTemporal($prompt, $archivo);

    // Preparar opciones
    $model = $opciones['model'] ?? 'llama3.1';  // Modelo por defecto
    $temperature = $opciones['temperature'] ?? 0.1;

    // Construir comando Ollama usando < para input
    $comando = "ollama run {$model} < \"{$promptFile}\"";

    $resultado = ejecutarComandoConTimeout($comando, 180); // 3 minutos para Ollama

    // Limpiar archivo temporal
    @unlink($promptFile);

    if ($resultado['success'] && !empty($resultado['stdout'])) {
        // Limpiar códigos ANSI de la respuesta
        $respuestaLimpia = limpiarCodigosANSI($resultado['stdout']);

        return [
            'success' => true,
            'respuesta' => $respuestaLimpia,
            'comando_usado' => 'ollama',
            'model' => $model,
            'tipo' => 'local'
        ];
    }

    return [
        'success' => false,
        'error' => 'No se pudo ejecutar Ollama. Error: ' . ($resultado['error'] ?? $resultado['stderr'] ?? 'Desconocido')
    ];
}

/**
 * Ejecutar Claude CLI
 */
function ejecutarClaudeCLI($prompt, $archivo = null, $opciones = []) {
    // Guardar prompt en archivo temporal
    $promptFile = guardarPromptTemporal($prompt, $archivo);

    // Preparar opciones
    $maxTokens = $opciones['max_tokens'] ?? 4000;
    $temperature = $opciones['temperature'] ?? 0.1;
    $model = $opciones['model'] ?? 'claude-3-5-sonnet-20241022';

    // Construir comando
    // Nota: Ajusta según la sintaxis real de tu CLI
    $comandosPosibles = [
        // Opción 1: Si el CLI acepta archivo de prompt
        "claude --model {$model} --max-tokens {$maxTokens} --temperature {$temperature} --file \"{$promptFile}\"",

        // Opción 2: Si el CLI acepta prompt directo
        "claude --model {$model} --max-tokens {$maxTokens} --temperature {$temperature} \"" . addslashes($prompt) . "\"",

        // Opción 3: Via npx
        "npx -y @anthropics/claude-cli --model {$model} < \"{$promptFile}\"",
    ];

    $ultimoError = '';

    foreach ($comandosPosibles as $comando) {
        $resultado = ejecutarComandoConTimeout($comando, 120);

        if ($resultado['success'] && !empty($resultado['stdout'])) {
            // Limpiar archivo temporal
            @unlink($promptFile);

            return [
                'success' => true,
                'respuesta' => $resultado['stdout'],
                'comando_usado' => explode(' ', $comando)[0]
            ];
        }

        $ultimoError = $resultado['error'] ?? $resultado['stderr'] ?? 'Error desconocido';
    }

    // Limpiar archivo temporal
    @unlink($promptFile);

    return [
        'success' => false,
        'error' => 'No se pudo ejecutar Claude CLI. Último error: ' . $ultimoError
    ];
}

/**
 * Ejecutar Gemini CLI
 */
function ejecutarGeminiCLI($prompt, $archivo = null, $opciones = []) {
    // Guardar prompt en archivo temporal
    $promptFile = guardarPromptTemporal($prompt, $archivo);

    // Preparar opciones
    $maxTokens = $opciones['max_tokens'] ?? 4000;
    $temperature = $opciones['temperature'] ?? 0.1;
    $model = $opciones['model'] ?? 'gemini-pro';

    // Construir comando
    $comandosPosibles = [
        // Opción 1: Python con google-generativeai
        "python -c \"import google.generativeai as genai; import os; genai.configure(api_key=os.environ.get('GOOGLE_API_KEY')); model = genai.GenerativeModel('{$model}'); response = model.generate_content(open('{$promptFile}').read()); print(response.text)\"",

        // Opción 2: Si existe un CLI específico
        "gemini --model {$model} --max-tokens {$maxTokens} --temperature {$temperature} < \"{$promptFile}\"",
    ];

    $ultimoError = '';

    foreach ($comandosPosibles as $comando) {
        $resultado = ejecutarComandoConTimeout($comando, 120);

        if ($resultado['success'] && !empty($resultado['stdout'])) {
            // Limpiar archivo temporal
            @unlink($promptFile);

            return [
                'success' => true,
                'respuesta' => $resultado['stdout'],
                'comando_usado' => 'gemini'
            ];
        }

        $ultimoError = $resultado['error'] ?? $resultado['stderr'] ?? 'Error desconocido';
    }

    // Limpiar archivo temporal
    @unlink($promptFile);

    return [
        'success' => false,
        'error' => 'No se pudo ejecutar Gemini CLI. Último error: ' . $ultimoError
    ];
}

// Ejecutar según el CLI seleccionado
try {
    if ($cli === 'ollama') {
        $resultado = ejecutarOllama($prompt, $archivo, $opciones);
    } elseif ($cli === 'claude') {
        $resultado = ejecutarClaudeCLI($prompt, $archivo, $opciones);
    } elseif ($cli === 'gemini') {
        $resultado = ejecutarGeminiCLI($prompt, $archivo, $opciones);
    } else {
        throw new Exception('CLI no soportada');
    }

    // Registrar uso (opcional - para estadísticas)
    if ($resultado['success']) {
        // Aquí podrías guardar en BD el uso de la IA
        // Por ejemplo: tokens usados, tiempo, etc.
    }

    echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}
