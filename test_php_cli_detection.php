<?php
/**
 * Test: Detectar si PHP puede ejecutar los comandos CLI
 */

echo "=== TEST DE DETECCIÓN DE CLIs ===\n\n";

// Test 1: Claude
echo "1. Testing Claude CLI...\n";
exec('claude --version 2>&1', $output1, $return1);
echo "   Output: " . implode("\n   ", $output1) . "\n";
echo "   Return code: $return1\n";
echo "   Status: " . ($return1 === 0 ? "✅ OK" : "❌ FAIL") . "\n\n";

// Test 2: Ollama
echo "2. Testing Ollama...\n";
exec('ollama --version 2>&1', $output2, $return2);
echo "   Output: " . implode("\n   ", $output2) . "\n";
echo "   Return code: $return2\n";
echo "   Status: " . ($return2 === 0 ? "✅ OK" : "❌ FAIL") . "\n\n";

// Test 3: Ollama list
echo "3. Testing Ollama list...\n";
exec('ollama list 2>&1', $output3, $return3);
echo "   Output: " . implode("\n   ", $output3) . "\n";
echo "   Return code: $return3\n";
echo "   Status: " . ($return3 === 0 ? "✅ OK" : "❌ FAIL") . "\n\n";

// Test 4: Which/Where commands
echo "4. Testing PATH...\n";
exec('where claude 2>&1', $output4, $return4);
echo "   Claude location: " . implode("\n   ", $output4) . "\n";

exec('where ollama 2>&1', $output5, $return5);
echo "   Ollama location: " . implode("\n   ", $output5) . "\n\n";

// Test 5: Environment PATH
echo "5. PHP Environment PATH:\n";
echo "   " . (getenv('PATH') ?: 'No PATH found') . "\n\n";

// Test 6: Proc_open test (como usa el código real)
echo "6. Testing proc_open (método real)...\n";
$descriptorspec = [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w']
];

$process = proc_open('claude --version', $descriptorspec, $pipes);
if (is_resource($process)) {
    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $return = proc_close($process);

    echo "   stdout: $stdout\n";
    echo "   stderr: $stderr\n";
    echo "   return: $return\n";
    echo "   Status: " . ($return === 0 ? "✅ OK" : "❌ FAIL") . "\n";
} else {
    echo "   ❌ Could not open process\n";
}
