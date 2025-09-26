<?php
/**
 * SCRIPT DE IMPORTACIÓN DE PASOS DESDE DOCUMENTOS .MD
 * ===================================================
 * 
 * Este script lee los documentos .md existentes en las carpetas de fases
 * y los importa automáticamente a la tabla pasos_plantilla de la base de datos.
 * 
 * Uso: php import_pasos.php
 * 
 * @author Sistema de Auditorías SEO
 * @version 1.0
 */

require_once 'config/database.php';

class ImportadorPasos {
    
    private $pdo;
    private $basePath;
    private $fases = [
        0 => 'FASE_0_MARKETING_DIGITAL',
        1 => 'FASE_1_PREPARACION',
        2 => 'FASE_2_KEYWORD_RESEARCH', 
        3 => 'FASE_3_ARQUITECTURA',
        4 => 'FASE_4_RECOPILACION_DATOS',
        5 => 'FASE_5_ENTREGABLES_FINALES'
    ];
    
    public function __construct($pdo, $basePath = __DIR__) {
        $this->pdo = $pdo;
        $this->basePath = $basePath;
    }
    
    /**
     * Ejecuta la importación completa de todas las fases
     */
    public function importarTodo() {
        echo "🚀 INICIANDO IMPORTACIÓN DE PASOS DESDE DOCUMENTOS .MD\n";
        echo "=" . str_repeat("=", 60) . "\n\n";
        
        $totalImportados = 0;
        
        foreach ($this->fases as $numeroFase => $carpetaFase) {
            echo "📁 Procesando {$carpetaFase}...\n";
            
            $rutaFase = $this->basePath . DIRECTORY_SEPARATOR . $carpetaFase;
            
            if (!is_dir($rutaFase)) {
                echo "   ❌ Carpeta no encontrada: {$rutaFase}\n";
                continue;
            }
            
            $pasosImportados = $this->importarFase($numeroFase, $rutaFase);
            $totalImportados += $pasosImportados;
            
            echo "   ✅ {$pasosImportados} pasos importados\n\n";
        }
        
        echo "🎉 IMPORTACIÓN COMPLETADA\n";
        echo "Total de pasos importados: {$totalImportados}\n";
        
        return $totalImportados;
    }
    
    /**
     * Importa los pasos de una fase específica
     */
    private function importarFase($numeroFase, $rutaFase) {
        $archivos = $this->obtenerArchivosMarkdown($rutaFase);
        $pasosImportados = 0;
        
        // Obtener ID de la fase
        $stmt = $this->pdo->prepare("SELECT id FROM fases WHERE numero_fase = ?");
        $stmt->execute([$numeroFase]);
        $faseId = $stmt->fetchColumn();
        
        if (!$faseId) {
            echo "   ❌ Fase {$numeroFase} no encontrada en base de datos\n";
            return 0;
        }
        
        foreach ($archivos as $archivo) {
            if ($this->esArchivoInstrucciones($archivo)) {
                continue; // Saltar archivos de instrucciones
            }
            
            $datosPaso = $this->extraerDatosPaso($archivo, $rutaFase);
            
            if ($datosPaso) {
                if ($this->insertarPaso($faseId, $datosPaso)) {
                    $pasosImportados++;
                    echo "   📝 Importado: {$datosPaso['nombre']}\n";
                } else {
                    echo "   ⚠️  Ya existe: {$datosPaso['nombre']}\n";
                }
            }
        }
        
        return $pasosImportados;
    }
    
    /**
     * Obtiene lista de archivos .md de una carpeta
     */
    private function obtenerArchivosMarkdown($rutaCarpeta) {
        $archivos = [];
        $items = scandir($rutaCarpeta);
        
        foreach ($items as $item) {
            if (pathinfo($item, PATHINFO_EXTENSION) === 'md') {
                $archivos[] = $item;
            }
        }
        
        sort($archivos); // Ordenar alfabéticamente
        return $archivos;
    }
    
    /**
     * Verifica si es un archivo de instrucciones (no es un paso)
     */
    private function esArchivoInstrucciones($nombreArchivo) {
        return strpos(strtoupper($nombreArchivo), 'INSTRUCCIONES') !== false;
    }
    
    /**
     * Extrae los datos de un paso desde un archivo .md
     */
    private function extraerDatosPaso($nombreArchivo, $rutaCarpeta) {
        $rutaCompleta = $rutaCarpeta . DIRECTORY_SEPARATOR . $nombreArchivo;
        
        if (!file_exists($rutaCompleta)) {
            return null;
        }
        
        $contenido = file_get_contents($rutaCompleta);
        
        // Extraer código del paso (parte antes del primer _)
        $codigoPaso = pathinfo($nombreArchivo, PATHINFO_FILENAME);
        
        // Extraer título principal (primera línea con #)
        $titulo = $this->extraerTitulo($contenido);
        
        // Extraer descripción (texto después del título)
        $descripcion = $this->extraerDescripcion($contenido);
        
        // Determinar orden basado en el número al inicio del archivo
        $orden = $this->extraerOrden($nombreArchivo);
        
        // Determinar si es crítico basado en contenido
        $esCritico = $this->determinarCriticidad($contenido);
        
        // Estimar tiempo basado en contenido
        $tiempoEstimado = $this->estimarTiempo($contenido);
        
        return [
            'codigo_paso' => $codigoPaso,
            'nombre' => $titulo ?: $codigoPaso,
            'descripcion' => $descripcion,
            'instrucciones' => $contenido,
            'orden_en_fase' => $orden,
            'es_critico' => $esCritico,
            'tiempo_estimado_horas' => $tiempoEstimado,
            'archivo_origen' => $nombreArchivo
        ];
    }
    
    /**
     * Extrae el título principal del documento
     */
    private function extraerTitulo($contenido) {
        $lineas = explode("\n", $contenido);
        
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if (preg_match('/^#\s+(.+)/', $linea, $matches)) {
                // Limpiar emojis y caracteres especiales del título
                $titulo = preg_replace('/[\x{1F600}-\x{1F64F}]|[\x{1F300}-\x{1F5FF}]|[\x{1F680}-\x{1F6FF}]|[\x{1F1E0}-\x{1F1FF}]|[\x{2600}-\x{26FF}]|[\x{2700}-\x{27BF}]/u', '', $matches[1]);
                return trim($titulo);
            }
        }
        
        return null;
    }
    
    /**
     * Extrae descripción del documento
     */
    private function extraerDescripcion($contenido) {
        $lineas = explode("\n", $contenido);
        $descripcion = '';
        $encontroTitulo = false;
        $contadorLineas = 0;
        
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            
            if (preg_match('/^#\s+/', $linea)) {
                $encontroTitulo = true;
                continue;
            }
            
            if ($encontroTitulo && !empty($linea) && !preg_match('/^[-=]+$/', $linea)) {
                $descripcion .= $linea . ' ';
                $contadorLineas++;
                
                // Limitar descripción a primeras 3 líneas significativas
                if ($contadorLineas >= 3) {
                    break;
                }
            }
        }
        
        return trim($descripcion);
    }
    
    /**
     * Extrae el orden basado en el número al inicio del nombre del archivo
     */
    private function extraerOrden($nombreArchivo) {
        if (preg_match('/^(\d+)_/', $nombreArchivo, $matches)) {
            return (int)$matches[1];
        }
        
        return 99; // Orden por defecto para archivos sin número
    }
    
    /**
     * Determina si un paso es crítico basado en su contenido
     */
    private function determinarCriticidad($contenido) {
        $palabrasCriticas = [
            'crítico', 'critico', 'CRÍTICO', 'CRITICO',
            'obligatorio', 'OBLIGATORIO', 'imprescindible',
            'bloquea', 'bloquean', 'NO avanzar'
        ];
        
        foreach ($palabrasCriticas as $palabra) {
            if (strpos($contenido, $palabra) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Estima tiempo necesario basado en la complejidad del contenido
     */
    private function estimarTiempo($contenido) {
        $longitud = strlen($contenido);
        $numeroLineas = substr_count($contenido, "\n");
        
        // Estimación básica basada en longitud y complejidad
        if ($longitud < 1000) {
            return 0.5; // 30 minutos
        } elseif ($longitud < 3000) {
            return 1.0; // 1 hora
        } elseif ($longitud < 5000) {
            return 2.0; // 2 horas
        } else {
            return 3.0; // 3 horas
        }
    }
    
    /**
     * Inserta un paso en la base de datos
     */
    private function insertarPaso($faseId, $datosPaso) {
        // Verificar si ya existe
        $stmt = $this->pdo->prepare("SELECT id FROM pasos_plantilla WHERE fase_id = ? AND codigo_paso = ?");
        $stmt->execute([$faseId, $datosPaso['codigo_paso']]);
        
        if ($stmt->fetchColumn()) {
            return false; // Ya existe
        }
        
        // Insertar nuevo paso
        $sql = "INSERT INTO pasos_plantilla 
                (fase_id, codigo_paso, nombre, titulo, descripcion, instrucciones, orden, orden_en_fase, 
                 es_critico, tiempo_estimado_horas, archivo_origen, activo, fecha_creacion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, datetime('now'))";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $faseId,
            $datosPaso['codigo_paso'],
            $datosPaso['nombre'],
            $datosPaso['nombre'], // Usar nombre como titulo también
            $datosPaso['descripcion'],
            $datosPaso['instrucciones'],
            $datosPaso['orden_en_fase'], // Usar orden_en_fase como orden también
            $datosPaso['orden_en_fase'],
            $datosPaso['es_critico'] ? 1 : 0,
            $datosPaso['tiempo_estimado_horas'],
            $datosPaso['archivo_origen']
        ]);
    }
    
    /**
     * Limpia todos los pasos existentes (usar con precaución)
     */
    public function limpiarPasosExistentes() {
        echo "🗑️  Limpiando pasos existentes...\n";
        
        $stmt = $this->pdo->prepare("DELETE FROM pasos_plantilla");
        $stmt->execute();
        
        echo "✅ Pasos limpiados\n\n";
    }
    
    /**
     * Muestra estadísticas de los pasos importados
     */
    public function mostrarEstadisticas() {
        echo "\n📊 ESTADÍSTICAS DE IMPORTACIÓN\n";
        echo "=" . str_repeat("=", 40) . "\n";
        
        $stmt = $this->pdo->query("
            SELECT 
                f.nombre as fase,
                COUNT(pt.id) as total_pasos,
                SUM(CASE WHEN pt.es_critico = 1 THEN 1 ELSE 0 END) as pasos_criticos,
                ROUND(AVG(pt.tiempo_estimado_horas), 2) as tiempo_promedio
            FROM fases f
            LEFT JOIN pasos_plantilla pt ON f.id = pt.fase_id
            GROUP BY f.id, f.nombre
            ORDER BY f.numero_fase
        ");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "📁 {$row['fase']}\n";
            echo "   • Total pasos: {$row['total_pasos']}\n";
            echo "   • Pasos críticos: {$row['pasos_criticos']}\n";
            echo "   • Tiempo promedio: {$row['tiempo_promedio']} horas\n\n";
        }
    }
}

// =====================================================
// EJECUCIÓN DEL SCRIPT
// =====================================================

try {
    // Conectar a la base de datos SQLite (no requiere username/password)
    $pdo = new PDO($dsn, null, null, $options);
    
    // Crear importador
    $importador = new ImportadorPasos($pdo);
    
    // Verificar argumentos de línea de comandos
    $limpiar = in_array('--clean', $argv ?? []);
    $estadisticas = in_array('--stats', $argv ?? []);
    
    if ($limpiar) {
        $importador->limpiarPasosExistentes();
    }
    
    if (!$estadisticas) {
        // Ejecutar importación
        $totalImportados = $importador->importarTodo();
        
        if ($totalImportados > 0) {
            $importador->mostrarEstadisticas();
        }
    } else {
        // Solo mostrar estadísticas
        $importador->mostrarEstadisticas();
    }
    
} catch (PDOException $e) {
    echo "❌ Error de base de datos: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n✨ Proceso completado exitosamente\n";

/**
 * INSTRUCCIONES DE USO:
 * 
 * 1. Importación normal:
 *    php import_pasos.php
 * 
 * 2. Limpiar pasos existentes e importar:
 *    php import_pasos.php --clean
 * 
 * 3. Solo mostrar estadísticas:
 *    php import_pasos.php --stats
 * 
 * REQUISITOS:
 * - Archivo config/database.php configurado
 * - Base de datos creada con el esquema
 * - Carpetas de fases con archivos .md
 */
?>