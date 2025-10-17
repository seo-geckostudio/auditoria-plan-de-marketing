<?php
/**
 * Generador Automático de CSVs Entregables
 *
 * Esta clase genera dinámicamente los archivos CSV entregables
 * a partir de los datos reales de cada auditoría.
 *
 * USO:
 * $generator = new EntregablesGenerator($auditoriaId);
 * $csvPath = $generator->generarCSV('urls_huerfanas', $datos);
 *
 * @author Sistema de Auditoría SEO
 * @version 1.0
 */

class EntregablesGenerator {

    private $auditoriaId;
    private $basePath;

    /**
     * Constructor
     *
     * @param int $auditoriaId ID de la auditoría
     */
    public function __construct($auditoriaId) {
        $this->auditoriaId = $auditoriaId;
        $this->basePath = __DIR__ . '/../entregables/auditoria_' . $auditoriaId;

        // Crear directorio de entregables si no existe
        if (!file_exists($this->basePath)) {
            mkdir($this->basePath, 0755, true);
            mkdir($this->basePath . '/arquitectura', 0755, true);
            mkdir($this->basePath . '/keywords', 0755, true);
            mkdir($this->basePath . '/on_page', 0755, true);
            mkdir($this->basePath . '/contenido', 0755, true);
            mkdir($this->basePath . '/enlaces', 0755, true);
            mkdir($this->basePath . '/tecnico', 0755, true);
        }
    }

    /**
     * Genera un CSV desde un array de datos
     *
     * @param string $tipo Tipo de entregable (urls_huerfanas, paginas_sin_h1, etc)
     * @param array $datos Datos a incluir en el CSV
     * @param string $categoria Categoría (arquitectura, keywords, on_page, etc)
     * @return array Resultado con 'success', 'file_path', 'url', 'count'
     */
    public function generarCSV($tipo, $datos, $categoria = 'arquitectura') {
        try {
            // Validar datos
            if (empty($datos) || !is_array($datos)) {
                return [
                    'success' => false,
                    'message' => 'No hay datos para generar el CSV',
                    'count' => 0
                ];
            }

            // Ruta del archivo
            $fileName = $tipo . '.csv';
            $filePath = $this->basePath . '/' . $categoria . '/' . $fileName;
            $fileUrl = '/entregables/auditoria_' . $this->auditoriaId . '/' . $categoria . '/' . $fileName;

            // Abrir archivo para escritura
            $handle = fopen($filePath, 'w');
            if ($handle === false) {
                throw new Exception('No se pudo crear el archivo CSV');
            }

            // Escribir BOM para UTF-8 (necesario para Excel)
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Obtener headers del primer elemento
            $headers = array_keys($datos[0]);
            fputcsv($handle, $headers);

            // Escribir filas de datos
            foreach ($datos as $row) {
                fputcsv($handle, array_values($row));
            }

            fclose($handle);

            return [
                'success' => true,
                'file_path' => $filePath,
                'file_url' => $fileUrl,
                'file_name' => $fileName,
                'count' => count($datos),
                'message' => 'CSV generado exitosamente'
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al generar CSV: ' . $e->getMessage(),
                'count' => 0
            ];
        }
    }

    /**
     * Genera CSV de URLs huérfanas desde datos de Screaming Frog
     *
     * @param array $datosScreamingFrog Datos del crawl
     * @return array Resultado de la generación
     */
    public function generarURLsHuerfanas($datosScreamingFrog) {
        // Filtrar URLs huérfanas (sin enlaces entrantes internos)
        $huerfanas = array_filter($datosScreamingFrog['internal'] ?? [], function($url) {
            return ($url['inlinks'] ?? 0) == 0
                && ($url['status_code'] ?? 0) == 200
                && ($url['indexability'] ?? '') !== 'Noindex';
        });

        // Formatear datos para CSV
        $csvData = [];
        foreach ($huerfanas as $url) {
            $csvData[] = [
                'URL' => $url['address'] ?? '',
                'Profundidad_Actual' => $url['crawl_depth'] ?? 0,
                'Trafico_Mensual' => $url['ga_sessions'] ?? 0,
                'Prioridad' => $this->calcularPrioridad($url),
                'Pagina_Desde_Enlazar' => $this->sugerirPaginaEnlazado($url),
                'Accion_Recomendada' => $this->generarAccionURLHuerfana($url)
            ];
        }

        // Ordenar por prioridad y tráfico
        usort($csvData, function($a, $b) {
            $prioridades = ['Crítica' => 4, 'Muy Alta' => 3, 'Alta' => 2, 'Media' => 1, 'Baja' => 0];
            $prioA = $prioridades[$a['Prioridad']] ?? 0;
            $prioB = $prioridades[$b['Prioridad']] ?? 0;

            if ($prioA == $prioB) {
                return $b['Trafico_Mensual'] - $a['Trafico_Mensual'];
            }
            return $prioB - $prioA;
        });

        return $this->generarCSV('urls_huerfanas_corregir', $csvData, 'arquitectura');
    }

    /**
     * Genera CSV de URLs profundas que necesitan reducir profundidad
     *
     * @param array $datosScreamingFrog Datos del crawl
     * @return array Resultado de la generación
     */
    public function generarURLsProfundas($datosScreamingFrog) {
        // Filtrar URLs con profundidad > 4 clics
        $profundas = array_filter($datosScreamingFrog['internal'] ?? [], function($url) {
            return ($url['crawl_depth'] ?? 0) > 4
                && ($url['status_code'] ?? 0) == 200
                && ($url['ga_sessions'] ?? 0) > 10; // Solo si tiene algo de tráfico
        });

        $csvData = [];
        foreach ($profundas as $url) {
            $csvData[] = [
                'URL' => $url['address'] ?? '',
                'Profundidad_Actual' => $url['crawl_depth'] ?? 0,
                'Profundidad_Objetivo' => min(3, ($url['crawl_depth'] ?? 5) - 2),
                'Trafico_Mensual' => $url['ga_sessions'] ?? 0,
                'Prioridad' => $this->calcularPrioridad($url),
                'Accion_Reducir_Profundidad' => $this->generarAccionReducirProfundidad($url),
                'Desde_Donde_Enlazar' => $this->sugerirPaginaEnlazado($url)
            ];
        }

        // Ordenar por tráfico descendente
        usort($csvData, function($a, $b) {
            return $b['Trafico_Mensual'] - $a['Trafico_Mensual'];
        });

        return $this->generarCSV('urls_profundas_reducir', $csvData, 'arquitectura');
    }

    /**
     * Genera CSV de páginas sin H1
     *
     * @param array $datosScreamingFrog Datos del crawl
     * @return array Resultado de la generación
     */
    public function generarPaginasSinH1($datosScreamingFrog) {
        // Filtrar páginas HTML sin H1 o con H1 duplicado/vacío
        $sinH1 = array_filter($datosScreamingFrog['internal'] ?? [], function($url) {
            $tieneH1 = !empty($url['h1_1'] ?? '');
            $esHTML = ($url['content_type'] ?? '') === 'text/html';
            $es200 = ($url['status_code'] ?? 0) == 200;

            return $esHTML && $es200 && !$tieneH1;
        });

        $csvData = [];
        foreach ($sinH1 as $url) {
            $csvData[] = [
                'URL' => $url['address'] ?? '',
                'Trafico_Mensual' => $url['ga_sessions'] ?? 0,
                'Keyword_Objetivo' => $this->extraerKeywordObjetivo($url),
                'H1_Recomendado' => $this->generarH1Recomendado($url),
                'Prioridad' => $this->calcularPrioridad($url),
                'Notas' => $this->generarNotasH1($url)
            ];
        }

        // Ordenar por tráfico descendente
        usort($csvData, function($a, $b) {
            return $b['Trafico_Mensual'] - $a['Trafico_Mensual'];
        });

        return $this->generarCSV('paginas_sin_h1', $csvData, 'on_page');
    }

    /**
     * Genera CSV de imágenes sin atributo alt
     *
     * @param array $datosScreamingFrog Datos del crawl de imágenes
     * @return array Resultado de la generación
     */
    public function generarImagenesSinAlt($datosScreamingFrog) {
        // Filtrar imágenes sin alt
        $sinAlt = array_filter($datosScreamingFrog['images'] ?? [], function($img) {
            return empty($img['alt_text'] ?? '');
        });

        $csvData = [];
        foreach ($sinAlt as $img) {
            $csvData[] = [
                'URL_Pagina' => $img['source'] ?? '',
                'URL_Imagen' => $img['destination'] ?? '',
                'Tipo_Imagen' => $this->determinarTipoImagen($img),
                'Alt_Recomendado' => $this->generarAltRecomendado($img),
                'Prioridad' => $this->calcularPrioridadImagen($img),
                'Contexto' => $this->extraerContextoImagen($img)
            ];
        }

        // Ordenar por prioridad
        usort($csvData, function($a, $b) {
            $prioridades = ['Crítica' => 4, 'Muy Alta' => 3, 'Alta' => 2, 'Media' => 1, 'Baja' => 0];
            $prioA = $prioridades[$a['Prioridad']] ?? 0;
            $prioB = $prioridades[$b['Prioridad']] ?? 0;
            return $prioB - $prioA;
        });

        return $this->generarCSV('imagenes_sin_alt', $csvData, 'on_page');
    }

    /**
     * Genera CSV de oportunidades de keywords
     *
     * @param array $datosAhrefs Datos de Ahrefs
     * @param array $datosGSC Datos de Google Search Console
     * @return array Resultado de la generación
     */
    public function generarOportunidadesKeywords($datosAhrefs, $datosGSC) {
        $oportunidades = [];

        // Analizar keywords de Ahrefs (competidores rankeando que tú no)
        foreach ($datosAhrefs['keyword_gap'] ?? [] as $kw) {
            if (($kw['your_position'] ?? 0) == 0 && ($kw['volume'] ?? 0) > 100) {
                $oportunidades[] = [
                    'Keyword' => $kw['keyword'] ?? '',
                    'Volumen_Busqueda' => $kw['volume'] ?? 0,
                    'Dificultad' => $kw['difficulty'] ?? 0,
                    'Posicion_Actual' => 'Sin ranking',
                    'Posicion_Objetivo' => $this->determinarPosicionObjetivo($kw),
                    'URL_Destino' => $this->sugerirURLDestino($kw),
                    'Accion_Recomendada' => $this->generarAccionKeyword($kw),
                    'Prioridad' => $this->calcularPrioridadKeyword($kw),
                    'Trafico_Potencial_Mensual' => $this->estimarTraficoPotencial($kw)
                ];
            }
        }

        // Ordenar por volumen * (1 / dificultad) para priorizar quick wins
        usort($oportunidades, function($a, $b) {
            $scoreA = $a['Volumen_Busqueda'] / max(1, $a['Dificultad']);
            $scoreB = $b['Volumen_Busqueda'] / max(1, $b['Dificultad']);
            return $scoreB <=> $scoreA;
        });

        // Limitar a top 50 oportunidades
        $oportunidades = array_slice($oportunidades, 0, 50);

        return $this->generarCSV('oportunidades_priorizadas', $oportunidades, 'keywords');
    }

    /**
     * Genera todos los CSVs de arquitectura desde datos de Screaming Frog
     *
     * @param array $datosScreamingFrog Datos completos del crawl
     * @return array Resultados de todas las generaciones
     */
    public function generarTodosArquitectura($datosScreamingFrog) {
        $resultados = [];

        $resultados['urls_huerfanas'] = $this->generarURLsHuerfanas($datosScreamingFrog);
        $resultados['urls_profundas'] = $this->generarURLsProfundas($datosScreamingFrog);

        return $resultados;
    }

    /**
     * Genera todos los CSVs de On-Page desde datos de Screaming Frog
     *
     * @param array $datosScreamingFrog Datos completos del crawl
     * @return array Resultados de todas las generaciones
     */
    public function generarTodosOnPage($datosScreamingFrog) {
        $resultados = [];

        $resultados['paginas_sin_h1'] = $this->generarPaginasSinH1($datosScreamingFrog);
        $resultados['imagenes_sin_alt'] = $this->generarImagenesSinAlt($datosScreamingFrog);

        return $resultados;
    }

    // ==========================================
    // MÉTODOS AUXILIARES (IA/LÓGICA DE NEGOCIO)
    // ==========================================

    private function calcularPrioridad($url) {
        $trafico = $url['ga_sessions'] ?? 0;
        $profundidad = $url['crawl_depth'] ?? 0;

        if ($trafico > 500) return 'Crítica';
        if ($trafico > 200) return 'Muy Alta';
        if ($trafico > 50 || $profundidad > 5) return 'Alta';
        if ($trafico > 10) return 'Media';
        return 'Baja';
    }

    private function calcularPrioridadKeyword($kw) {
        $volumen = $kw['volume'] ?? 0;
        $dificultad = $kw['difficulty'] ?? 100;

        if ($volumen > 1000 && $dificultad < 50) return 'Crítica';
        if ($volumen > 500 && $dificultad < 60) return 'Muy Alta';
        if ($volumen > 200) return 'Alta';
        if ($volumen > 50) return 'Media';
        return 'Baja';
    }

    private function calcularPrioridadImagen($img) {
        $urlPagina = $img['source'] ?? '';

        // Imágenes en home o páginas principales
        if (strpos($urlPagina, '/index') !== false || $urlPagina === '/' || substr_count($urlPagina, '/') <= 2) {
            return 'Crítica';
        }

        // Imágenes en páginas de producto/servicio
        if (strpos($urlPagina, '/product') !== false || strpos($urlPagina, '/villa') !== false) {
            return 'Muy Alta';
        }

        // Imágenes principales (hero, featured)
        if (strpos($img['destination'] ?? '', 'hero') !== false || strpos($img['destination'] ?? '', 'featured') !== false) {
            return 'Alta';
        }

        return 'Media';
    }

    private function sugerirPaginaEnlazado($url) {
        $urlPath = parse_url($url['address'] ?? '', PHP_URL_PATH);
        $segments = array_filter(explode('/', $urlPath));

        // Sugerir enlazar desde la categoría padre
        if (count($segments) > 1) {
            array_pop($segments); // Quitar último segmento
            return '/' . implode('/', $segments) . '/';
        }

        return '/';
    }

    private function generarAccionURLHuerfana($url) {
        $path = parse_url($url['address'] ?? '', PHP_URL_PATH);

        if (strpos($path, '/blog/') !== false) {
            return 'Añadir en sidebar de artículos relacionados';
        }
        if (strpos($path, '/villa') !== false) {
            return 'Añadir en listado de villas disponibles';
        }
        if (strpos($path, '/zona') !== false) {
            return 'Añadir en guía de zonas de Ibiza';
        }

        return 'Enlazar desde página relevante de categoría superior';
    }

    private function generarAccionReducirProfundidad($url) {
        return 'Enlazar desde home o categoría principal + añadir en menú si es página importante';
    }

    private function extraerKeywordObjetivo($url) {
        // Extraer keyword del título de la página o de la URL
        $title = $url['title'] ?? '';
        $path = parse_url($url['address'] ?? '', PHP_URL_PATH);

        // Limpiar y extraer keyword principal
        $keyword = str_replace(['-', '_'], ' ', basename($path));

        return trim($keyword);
    }

    private function generarH1Recomendado($url) {
        $keyword = $this->extraerKeywordObjetivo($url);
        $title = $url['title'] ?? '';

        // Si hay título, usarlo como base
        if (!empty($title)) {
            return $title;
        }

        // Capitalizar keyword y hacer H1 atractivo
        return ucwords($keyword) . ' - Guía Completa 2025';
    }

    private function generarNotasH1($url) {
        $trafico = $url['ga_sessions'] ?? 0;

        if ($trafico > 200) {
            return 'Página con alto tráfico - prioridad alta';
        }
        if ($trafico > 50) {
            return 'Página institucional importante';
        }

        return 'Optimización básica recomendada';
    }

    private function determinarTipoImagen($img) {
        $urlImagen = strtolower($img['destination'] ?? '');

        if (strpos($urlImagen, 'hero') !== false) return 'Hero';
        if (strpos($urlImagen, 'logo') !== false) return 'Logo';
        if (strpos($urlImagen, 'featured') !== false) return 'Principal';
        if (strpos($urlImagen, 'gallery') !== false || strpos($urlImagen, 'galeria') !== false) return 'Galería';

        return 'Contenido';
    }

    private function generarAltRecomendado($img) {
        $urlPagina = $img['source'] ?? '';
        $urlImagen = $img['destination'] ?? '';
        $nombreImagen = basename($urlImagen);

        // Extraer contexto de la página
        $contexto = basename(parse_url($urlPagina, PHP_URL_PATH));
        $contexto = str_replace(['-', '_'], ' ', $contexto);

        // Generar alt descriptivo
        return ucwords($contexto) . ' - ' . ucwords(str_replace(['-', '_', '.jpg', '.png', '.webp'], ' ', $nombreImagen));
    }

    private function extraerContextoImagen($img) {
        $tipo = $this->determinarTipoImagen($img);
        $urlPagina = $img['source'] ?? '';

        if ($tipo === 'Hero') {
            return 'Imagen principal de la página';
        }
        if ($tipo === 'Galería') {
            return 'Imagen de galería de propiedad';
        }

        return 'Imagen de contenido en ' . basename($urlPagina);
    }

    private function determinarPosicionObjetivo($kw) {
        $dificultad = $kw['difficulty'] ?? 50;

        if ($dificultad < 30) return 'Top 3';
        if ($dificultad < 50) return 'Top 5';
        return 'Top 10';
    }

    private function sugerirURLDestino($kw) {
        $keyword = strtolower($kw['keyword'] ?? '');

        if (strpos($keyword, 'villa') !== false || strpos($keyword, 'alquiler') !== false) {
            return '/villas/';
        }
        if (strpos($keyword, 'zona') !== false || strpos($keyword, 'playa') !== false) {
            return '/zonas/';
        }
        if (strpos($keyword, 'mejor') !== false || strpos($keyword, 'guia') !== false) {
            return '/blog/';
        }

        return '/';
    }

    private function generarAccionKeyword($kw) {
        $dificultad = $kw['difficulty'] ?? 50;
        $volumen = $kw['volume'] ?? 0;

        if ($dificultad < 30 && $volumen > 500) {
            return 'Quick win: Crear landing específica optimizada';
        }
        if ($dificultad < 50) {
            return 'Crear página de categoría o artículo de blog';
        }

        return 'Optimizar contenido existente + mejorar enlaces internos';
    }

    private function estimarTraficoPotencial($kw) {
        $volumen = $kw['volume'] ?? 0;
        $posicionObjetivo = $this->determinarPosicionObjetivo($kw);

        // CTR estimado por posición
        $ctr = [
            'Top 3' => 0.35,
            'Top 5' => 0.20,
            'Top 10' => 0.10
        ];

        $ctrEstimado = $ctr[$posicionObjetivo] ?? 0.05;
        $traficoMin = round($volumen * $ctrEstimado * 0.8);
        $traficoMax = round($volumen * $ctrEstimado * 1.2);

        return $traficoMin . '-' . $traficoMax;
    }
}
