<?php
/**
 * API: Detectar CLIs de IA Instaladas
 * ====================================
 *
 * Detecta si Claude CLI o Gemini CLI están instaladas en el sistema
 * y devuelve información sobre las versiones disponibles
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
$clientes = $input['clientes'] ?? ['ollama', 'claude', 'gemini'];

$disponibles = [];
$errores = [];

/**
 * Ejecutar comando de forma segura
 */
function ejecutarComandoSeguro($comando, $timeout = 5) {
    $output = [];
    $returnValue = 0;

    // Usar exec() que es más simple y confiable
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
 * Detectar Ollama (LOCAL - SIN API)
 */
function detectarOllama() {
    // Intentar comandos Ollama
    $comandosPosibles = [
        'ollama --version',
        'ollama list'  // Lista modelos disponibles
    ];

    foreach ($comandosPosibles as $comando) {
        $resultado = ejecutarComandoSeguro($comando, 5);

        if ($resultado['success'] && !empty($resultado['stdout'])) {
            // Extraer versión
            preg_match('/(\d+\.\d+\.\d+)/', $resultado['stdout'], $matches);
            $version = $matches[1] ?? 'desconocida';

            // Obtener modelos disponibles
            $resultadoModelos = ejecutarComandoSeguro('ollama list', 5);
            $modelos = [];

            if ($resultadoModelos['success']) {
                $lineas = explode("\n", $resultadoModelos['stdout']);
                foreach ($lineas as $linea) {
                    if (preg_match('/^(\S+)/', $linea, $match)) {
                        if ($match[1] !== 'NAME') { // Skip header
                            $modelos[] = $match[1];
                        }
                    }
                }
            }

            return [
                'instalado' => true,
                'version' => $version,
                'comando' => 'ollama',
                'modelos' => $modelos,
                'tipo' => 'local',
                'requiere_api' => false,
                'output' => $resultado['stdout']
            ];
        }
    }

    return ['instalado' => false];
}

/**
 * Detectar Claude CLI
 */
function detectarClaudeCLI() {
    // Intentar varios comandos posibles
    $comandosPosibles = [
        'claude --version',
        'claude-cli --version',
        'npx -y @anthropics/claude-cli --version'
    ];

    foreach ($comandosPosibles as $comando) {
        $resultado = ejecutarComandoSeguro($comando, 3);

        if ($resultado['success'] && !empty($resultado['stdout'])) {
            // Extraer versión del output
            preg_match('/(\d+\.\d+\.\d+)/', $resultado['stdout'], $matches);
            $version = $matches[1] ?? 'desconocida';

            return [
                'instalado' => true,
                'version' => $version,
                'comando' => explode(' ', $comando)[0],
                'output' => $resultado['stdout']
            ];
        }
    }

    return ['instalado' => false];
}

/**
 * Detectar Gemini CLI
 */
function detectarGeminiCLI() {
    // Intentar varios comandos posibles
    $comandosPosibles = [
        'gemini --version',
        'gemini-cli --version',
        'gcloud gemini --version'
    ];

    foreach ($comandosPosibles as $comando) {
        $resultado = ejecutarComandoSeguro($comando, 3);

        if ($resultado['success'] && !empty($resultado['stdout'])) {
            // Extraer versión del output
            preg_match('/(\d+\.\d+\.\d+)/', $resultado['stdout'], $matches);
            $version = $matches[1] ?? 'desconocida';

            return [
                'instalado' => true,
                'version' => $version,
                'comando' => explode(' ', $comando)[0],
                'output' => $resultado['stdout']
            ];
        }
    }

    return ['instalado' => false];
}

/**
 * Verificar configuración/API keys
 */
function verificarConfiguracion($cli) {
    if ($cli === 'claude') {
        // Verificar si hay API key de Anthropic configurada
        $apiKey = getenv('ANTHROPIC_API_KEY') ?: getenv('CLAUDE_API_KEY');
        return [
            'configurado' => !empty($apiKey),
            'mensaje' => $apiKey ? 'API key encontrada' : 'No se encontró ANTHROPIC_API_KEY o CLAUDE_API_KEY'
        ];
    }

    if ($cli === 'gemini') {
        // Verificar si hay API key de Google configurada
        $apiKey = getenv('GOOGLE_API_KEY') ?: getenv('GEMINI_API_KEY');
        return [
            'configurado' => !empty($apiKey),
            'mensaje' => $apiKey ? 'API key encontrada' : 'No se encontró GOOGLE_API_KEY o GEMINI_API_KEY'
        ];
    }

    return ['configurado' => false, 'mensaje' => 'CLI desconocida'];
}

// Detectar cada CLI solicitada
foreach ($clientes as $cliente) {
    try {
        if ($cliente === 'ollama') {
            $deteccion = detectarOllama();

            if ($deteccion['instalado']) {
                $disponibles['ollama'] = [
                    'version' => $deteccion['version'],
                    'comando' => $deteccion['comando'],
                    'modelos' => $deteccion['modelos'],
                    'tipo' => 'local',
                    'requiere_api' => false,
                    'configurado' => true,
                    'mensaje_config' => '✅ 100% Local - No requiere API key'
                ];
            }
        }

        if ($cliente === 'claude') {
            $deteccion = detectarClaudeCLI();

            if ($deteccion['instalado']) {
                $config = verificarConfiguracion('claude');
                $disponibles['claude'] = [
                    'version' => $deteccion['version'],
                    'comando' => $deteccion['comando'],
                    'tipo' => 'api',
                    'requiere_api' => true,
                    'configurado' => $config['configurado'],
                    'mensaje_config' => $config['mensaje']
                ];
            }
        }

        if ($cliente === 'gemini') {
            $deteccion = detectarGeminiCLI();

            if ($deteccion['instalado']) {
                $config = verificarConfiguracion('gemini');
                $disponibles['gemini'] = [
                    'version' => $deteccion['version'],
                    'comando' => $deteccion['comando'],
                    'tipo' => 'api',
                    'requiere_api' => true,
                    'configurado' => $config['configurado'],
                    'mensaje_config' => $config['mensaje']
                ];
            }
        }
    } catch (Exception $e) {
        $errores[$cliente] = $e->getMessage();
    }
}

// Respuesta
$respuesta = [
    'disponibles' => $disponibles,
    'total' => count($disponibles),
    'errores' => $errores
];

if (empty($disponibles)) {
    $respuesta['mensaje'] = 'No se detectaron CLIs de IA instaladas. Instala Claude CLI o Gemini CLI para usar esta funcionalidad.';
    $respuesta['ayuda'] = [
        'claude' => [
            'instalacion' => 'npm install -g @anthropics/claude-cli',
            'configuracion' => 'Configura ANTHROPIC_API_KEY en variables de entorno',
            'docs' => 'https://docs.anthropic.com/claude/docs/cli'
        ],
        'gemini' => [
            'instalacion' => 'pip install google-generativeai',
            'configuracion' => 'Configura GOOGLE_API_KEY en variables de entorno',
            'docs' => 'https://ai.google.dev/tutorials/setup'
        ]
    ];
}

echo json_encode($respuesta, JSON_PRETTY_PRINT);
