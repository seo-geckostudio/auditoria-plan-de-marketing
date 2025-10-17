<?php
/**
 * Test: Ejecutar Ollama con prompt de Brief
 */

// Simular un brief simple
$promptTest = <<<'PROMPT'
# TAREA: Extraer información del Brief de Cliente SEO

## INFORMACIÓN DEL CLIENTE
Empresa: ACME Digital Solutions
Contacto: Juan Pérez, Director de Marketing
Email: juan.perez@acmedigital.com
Teléfono: +34 600 123 456

Descripción del negocio:
Somos una agencia de marketing digital especializada en e-commerce.
Trabajamos principalmente con tiendas online de moda y tecnología.
Nuestro sitio web es www.acmedigital.com

Objetivos SEO:
- Aumentar el tráfico orgánico en un 50% en 6 meses
- Mejorar posicionamiento para palabras clave de "agencia marketing digital Madrid"
- Incrementar conversiones de contactos desde búsquedas orgánicas

Competidores principales:
- digitalmarketingpro.com
- agenciaonline.es
- marketingsoluciones.com

Presupuesto: Entre 2000-3000€/mes
Timeline: Necesitamos resultados en 6 meses

## OUTPUT ESPERADO
Devuelve un JSON válido con esta estructura:
{
  "info_general": {
    "nombre_empresa": "",
    "persona_contacto": "",
    "email": "",
    "telefono": "",
    "cargo": ""
  },
  "website": {
    "url_principal": "",
    "otras_urls": []
  },
  "modelo_negocio": {
    "descripcion": "",
    "tipo_negocio": "",
    "sector": ""
  },
  "objetivos_seo": {
    "objetivo_principal": "",
    "objetivos_secundarios": [],
    "kpis_principales": []
  },
  "competidores": {
    "competidores_principales": []
  },
  "presupuesto": {
    "rango_presupuesto": "",
    "timeline": ""
  }
}
PROMPT;

echo "=== TEST OLLAMA: Extracción de Brief ===\n\n";

// Guardar prompt temporal
$tempFile = sys_get_temp_dir() . '/ollama_test_' . uniqid() . '.txt';
file_put_contents($tempFile, $promptTest);

echo "1. Prompt guardado en: $tempFile\n";
echo "2. Tamaño del prompt: " . strlen($promptTest) . " caracteres\n\n";

// Probar con llama3.1
$modelo = 'llama3.1';
echo "3. Ejecutando Ollama con modelo: $modelo\n";
echo "   Comando: ollama run $modelo < \"$tempFile\"\n\n";

$inicio = microtime(true);

// Ejecutar Ollama
$comando = "ollama run $modelo < \"$tempFile\"";
exec($comando . ' 2>&1', $output, $return);

$tiempoTotal = round(microtime(true) - $inicio, 2);

echo "4. Tiempo de ejecución: {$tiempoTotal}s\n";
echo "5. Código de retorno: $return\n\n";

if ($return === 0) {
    echo "✅ Ejecución exitosa\n\n";

    $respuesta = implode("\n", $output);

    echo "6. Respuesta completa (primeros 500 caracteres):\n";
    echo "---\n";
    echo substr($respuesta, 0, 500) . "...\n";
    echo "---\n\n";

    // Intentar extraer JSON
    if (preg_match('/\{[\s\S]*\}/', $respuesta, $matches)) {
        echo "7. JSON encontrado:\n";
        echo "---\n";
        echo $matches[0] . "\n";
        echo "---\n\n";

        // Validar JSON
        $json = json_decode($matches[0], true);
        if ($json !== null) {
            echo "✅ JSON válido extraído\n";
            echo "   Claves encontradas: " . implode(', ', array_keys($json)) . "\n\n";

            // Mostrar algunos datos extraídos
            if (isset($json['info_general'])) {
                echo "8. Datos extraídos (ejemplo):\n";
                echo "   Empresa: " . ($json['info_general']['nombre_empresa'] ?? 'N/A') . "\n";
                echo "   Contacto: " . ($json['info_general']['persona_contacto'] ?? 'N/A') . "\n";
                echo "   Email: " . ($json['info_general']['email'] ?? 'N/A') . "\n";
            }
        } else {
            echo "❌ JSON inválido\n";
            echo "   Error: " . json_last_error_msg() . "\n";
        }
    } else {
        echo "⚠️ No se encontró JSON en la respuesta\n";
        echo "   Respuesta completa:\n";
        echo $respuesta . "\n";
    }

} else {
    echo "❌ Error en la ejecución\n";
    echo "   Output: " . implode("\n", $output) . "\n";
}

// Limpiar
@unlink($tempFile);

echo "\n=== FIN DEL TEST ===\n";
