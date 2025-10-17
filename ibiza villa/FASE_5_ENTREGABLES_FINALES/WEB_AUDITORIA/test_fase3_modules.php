<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Módulos Fase 3 - Arquitectura</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-header {
            background: #54a34a;
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .test-header h1 {
            margin: 0 0 10px 0;
        }
        .module-test {
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .module-test h2 {
            margin: 0 0 15px 0;
            color: #333;
            border-bottom: 2px solid #54a34a;
            padding-bottom: 10px;
        }
        .test-result {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
        }
        .test-result.success {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .test-result.error {
            background: #ffebee;
            color: #c62828;
        }
        .test-result.info {
            background: #e3f2fd;
            color: #1565c0;
        }
        .test-icon {
            font-size: 20px;
            font-weight: bold;
        }
        .test-details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
        }
        .module-preview {
            margin-top: 15px;
            padding: 15px;
            background: #fafafa;
            border-left: 3px solid #54a34a;
        }
    </style>
</head>
<body>
    <div class="test-header">
        <h1>Test de Módulos Fase 3: Arquitectura</h1>
        <p>Verificación de módulos PHP y archivos JSON de datos</p>
    </div>

    <?php
    $baseDir = __DIR__;

    $modules = [
        [
            'id' => 'm3.1',
            'nombre' => 'Análisis de Arquitectura Actual',
            'php_file' => 'modulos/fase3_arquitectura/00_analisis_arquitectura.php',
            'json_file' => 'data/fase3/arquitectura_actual.json'
        ],
        [
            'id' => 'm3.2',
            'nombre' => 'Keyword-to-Architecture Mapping',
            'php_file' => 'modulos/fase3_arquitectura/01_keyword_architecture_mapping.php',
            'json_file' => 'data/fase3/keyword_architecture_mapping.json'
        ],
        [
            'id' => 'm3.3',
            'nombre' => 'Propuestas de Arquitectura',
            'php_file' => 'modulos/fase3_arquitectura/02_propuestas_arquitectura.php',
            'json_file' => 'data/fase3/propuestas_arquitectura.json'
        ]
    ];

    foreach ($modules as $module) {
        echo '<div class="module-test">';
        echo '<h2>' . htmlspecialchars($module['nombre']) . ' (' . htmlspecialchars($module['id']) . ')</h2>';

        // Test PHP file
        $phpPath = $baseDir . '/' . $module['php_file'];
        if (file_exists($phpPath)) {
            $phpSize = filesize($phpPath);
            echo '<div class="test-result success">';
            echo '<span class="test-icon">✓</span>';
            echo '<span>Archivo PHP encontrado: ' . htmlspecialchars($module['php_file']) . ' (' . number_format($phpSize) . ' bytes)</span>';
            echo '</div>';

            // Check if file is readable
            if (is_readable($phpPath)) {
                echo '<div class="test-result success">';
                echo '<span class="test-icon">✓</span>';
                echo '<span>Archivo PHP es legible</span>';
                echo '</div>';

                // Try to get first lines
                $content = file_get_contents($phpPath, false, null, 0, 500);
                if ($content !== false) {
                    echo '<div class="test-details">';
                    echo 'Primeras líneas del archivo PHP:<br>';
                    echo htmlspecialchars(substr($content, 0, 300)) . '...';
                    echo '</div>';
                }
            } else {
                echo '<div class="test-result error">';
                echo '<span class="test-icon">✗</span>';
                echo '<span>Archivo PHP no es legible</span>';
                echo '</div>';
            }
        } else {
            echo '<div class="test-result error">';
            echo '<span class="test-icon">✗</span>';
            echo '<span>Archivo PHP NO encontrado: ' . htmlspecialchars($phpPath) . '</span>';
            echo '</div>';
        }

        // Test JSON file
        $jsonPath = $baseDir . '/' . $module['json_file'];
        if (file_exists($jsonPath)) {
            $jsonSize = filesize($jsonPath);
            echo '<div class="test-result success">';
            echo '<span class="test-icon">✓</span>';
            echo '<span>Archivo JSON encontrado: ' . htmlspecialchars($module['json_file']) . ' (' . number_format($jsonSize) . ' bytes)</span>';
            echo '</div>';

            // Try to parse JSON
            $jsonContent = file_get_contents($jsonPath);
            $datosModulo = json_decode($jsonContent, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                echo '<div class="test-result success">';
                echo '<span class="test-icon">✓</span>';
                echo '<span>JSON es válido y se puede parsear correctamente</span>';
                echo '</div>';

                // Show some data preview
                echo '<div class="module-preview">';
                echo '<strong>Vista previa de datos:</strong><br>';
                if (isset($datosModulo['resumen_ejecutivo'])) {
                    echo '<div style="margin-top:10px">';
                    echo '<em>Resumen ejecutivo encontrado:</em><br>';
                    foreach ($datosModulo['resumen_ejecutivo'] as $key => $value) {
                        if (is_scalar($value)) {
                            echo '- ' . htmlspecialchars($key) . ': ' . htmlspecialchars($value) . '<br>';
                        }
                    }
                    echo '</div>';
                }

                // Count main sections
                $sections = array_keys($datosModulo);
                echo '<div class="test-result info">';
                echo '<span class="test-icon">ℹ</span>';
                echo '<span>Secciones principales: ' . count($sections) . ' (' . implode(', ', array_slice($sections, 0, 5)) . (count($sections) > 5 ? '...' : '') . ')</span>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="test-result error">';
                echo '<span class="test-icon">✗</span>';
                echo '<span>ERROR al parsear JSON: ' . json_last_error_msg() . '</span>';
                echo '</div>';
            }
        } else {
            echo '<div class="test-result error">';
            echo '<span class="test-icon">✗</span>';
            echo '<span>Archivo JSON NO encontrado: ' . htmlspecialchars($jsonPath) . '</span>';
            echo '</div>';
        }

        // Summary
        echo '<hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">';
        $phpExists = file_exists($phpPath);
        $jsonExists = file_exists($jsonPath);

        if ($phpExists && $jsonExists) {
            echo '<div class="test-result success">';
            echo '<span class="test-icon">✓</span>';
            echo '<span><strong>Módulo ' . htmlspecialchars($module['id']) . ' COMPLETO y funcional</strong></span>';
            echo '</div>';
        } else {
            echo '<div class="test-result error">';
            echo '<span class="test-icon">✗</span>';
            echo '<span><strong>Módulo ' . htmlspecialchars($module['id']) . ' INCOMPLETO</strong></span>';
            echo '</div>';
        }

        echo '</div>';
    }
    ?>

    <div class="test-header" style="background: #333; margin-top: 40px;">
        <h2 style="margin: 0;">Resumen Final</h2>
        <?php
        $totalModules = count($modules);
        $completedModules = 0;
        foreach ($modules as $module) {
            $phpPath = $baseDir . '/' . $module['php_file'];
            $jsonPath = $baseDir . '/' . $module['json_file'];
            if (file_exists($phpPath) && file_exists($jsonPath)) {
                $completedModules++;
            }
        }
        ?>
        <p style="margin: 10px 0 0 0; font-size: 18px;">
            <strong><?php echo $completedModules; ?> de <?php echo $totalModules; ?> módulos completados</strong>
            (<?php echo number_format(($completedModules / $totalModules) * 100, 1); ?>%)
        </p>
    </div>
</body>
</html>
