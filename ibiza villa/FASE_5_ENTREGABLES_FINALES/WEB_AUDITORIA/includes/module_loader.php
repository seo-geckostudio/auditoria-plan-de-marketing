<?php
/**
 * ModuleLoader - Sistema de carga dinámica de módulos de auditoría
 *
 * Gestiona la carga, validación y renderizado de módulos según el perfil del proyecto
 * y la configuración del cliente.
 *
 * @version 1.0
 * @author Miguel Ángel García
 * @date 2025-10-11
 */

class ModuleLoader {

    private $configPath;
    private $modulosDisponibles;
    private $perfilesProyecto;
    private $configuracionCliente;
    private $modulosActivos;
    private $errores;

    /**
     * Constructor
     *
     * @param string $configPath Ruta al directorio de configuración
     */
    public function __construct($configPath = './config/') {
        $this->configPath = rtrim($configPath, '/') . '/';
        $this->errores = [];
        $this->cargarConfiguraciones();
    }

    /**
     * Carga todos los archivos de configuración JSON
     */
    private function cargarConfiguraciones() {
        try {
            // Cargar módulos disponibles
            $modulosFile = $this->configPath . 'modulos_disponibles.json';
            if (!file_exists($modulosFile)) {
                throw new Exception("Archivo modulos_disponibles.json no encontrado");
            }
            $this->modulosDisponibles = json_decode(file_get_contents($modulosFile), true);

            // Cargar perfiles de proyecto
            $perfilesFile = $this->configPath . 'perfiles_proyecto.json';
            if (!file_exists($perfilesFile)) {
                throw new Exception("Archivo perfiles_proyecto.json no encontrado");
            }
            $this->perfilesProyecto = json_decode(file_get_contents($perfilesFile), true);

            // Cargar configuración del cliente
            $clienteFile = $this->configPath . 'configuracion_cliente.json';
            if (!file_exists($clienteFile)) {
                throw new Exception("Archivo configuracion_cliente.json no encontrado");
            }
            $this->configuracionCliente = json_decode(file_get_contents($clienteFile), true);

            // Inicializar módulos activos
            $this->modulosActivos = $this->configuracionCliente['modulos_activos'] ?? [];

        } catch (Exception $e) {
            $this->errores[] = "Error al cargar configuraciones: " . $e->getMessage();
            error_log($this->errores[count($this->errores) - 1]);
        }
    }

    /**
     * Obtiene el perfil del proyecto actual
     *
     * @return array|null Datos del perfil o null si no existe
     */
    public function obtenerPerfilActual() {
        $tipoPerfil = $this->configuracionCliente['proyecto']['tipo_perfil'] ?? null;

        if (!$tipoPerfil) {
            $this->errores[] = "No se ha definido tipo_perfil en configuracion_cliente.json";
            return null;
        }

        if (!isset($this->perfilesProyecto['perfiles'][$tipoPerfil])) {
            $this->errores[] = "Perfil '$tipoPerfil' no encontrado en perfiles_proyecto.json";
            return null;
        }

        return $this->perfilesProyecto['perfiles'][$tipoPerfil];
    }

    /**
     * Obtiene información de un módulo específico
     *
     * @param string $moduloId ID del módulo (ej: "m1.1")
     * @return array|null Datos del módulo o null si no existe
     */
    public function obtenerModulo($moduloId) {
        foreach ($this->modulosDisponibles['modulos'] as $modulo) {
            if ($modulo['id'] === $moduloId) {
                return $modulo;
            }
        }

        $this->errores[] = "Módulo '$moduloId' no encontrado";
        return null;
    }

    /**
     * Valida que todos los módulos activos tengan sus dependencias cumplidas
     *
     * @return array Array con 'valido' (bool) y 'errores' (array)
     */
    public function validarDependencias() {
        $erroresDependencias = [];

        foreach ($this->modulosActivos as $moduloId) {
            $modulo = $this->obtenerModulo($moduloId);

            if (!$modulo) {
                $erroresDependencias[] = "Módulo activo '$moduloId' no existe";
                continue;
            }

            // Verificar dependencias
            $dependencias = $modulo['dependencias'] ?? [];
            foreach ($dependencias as $dependenciaId) {
                if (!in_array($dependenciaId, $this->modulosActivos)) {
                    $dependencia = $this->obtenerModulo($dependenciaId);
                    $nombreDependencia = $dependencia['nombre'] ?? $dependenciaId;
                    $erroresDependencias[] = "El módulo '{$modulo['nombre']}' ({$moduloId}) requiere '{$nombreDependencia}' ({$dependenciaId})";
                }
            }
        }

        return [
            'valido' => empty($erroresDependencias),
            'errores' => $erroresDependencias
        ];
    }

    /**
     * Obtiene módulos organizados por fase
     *
     * @return array Array de fases con sus módulos
     */
    public function obtenerModulosPorFase() {
        $fases = [
            0 => ['nombre' => 'Marketing Digital', 'modulos' => []],
            1 => ['nombre' => 'Preparación', 'modulos' => []],
            2 => ['nombre' => 'Keyword Research', 'modulos' => []],
            3 => ['nombre' => 'Arquitectura', 'modulos' => []],
            4 => ['nombre' => 'Recopilación de Datos', 'modulos' => []],
            5 => ['nombre' => 'Entregables Finales', 'modulos' => []]
        ];

        foreach ($this->modulosActivos as $moduloId) {
            $modulo = $this->obtenerModulo($moduloId);
            if ($modulo) {
                $fase = $modulo['fase'];
                $fases[$fase]['modulos'][] = $modulo;
            }
        }

        // Eliminar fases vacías
        return array_filter($fases, function($fase) {
            return !empty($fase['modulos']);
        });
    }

    /**
     * Renderiza un módulo específico
     *
     * @param string $moduloId ID del módulo
     * @return string HTML renderizado o mensaje de error
     */
    public function renderizarModulo($moduloId) {
        $modulo = $this->obtenerModulo($moduloId);

        if (!$modulo) {
            return $this->renderizarError("Módulo '$moduloId' no encontrado");
        }

        // Verificar que el módulo esté activo
        if (!in_array($moduloId, $this->modulosActivos)) {
            return $this->renderizarError("Módulo '$moduloId' no está activo para este proyecto");
        }

        // Verificar que el archivo PHP del módulo existe
        $archivoModulo = $modulo['archivo_php'];
        if (!file_exists($archivoModulo)) {
            return $this->renderizarError("Archivo de módulo no encontrado: $archivoModulo");
        }

        // Cargar datos del módulo si existen
        $datosModulo = [];
        $archivoDatos = $modulo['archivo_datos'] ?? null;
        if ($archivoDatos && file_exists($archivoDatos)) {
            $datosModulo = json_decode(file_get_contents($archivoDatos), true);
        }

        // Renderizar módulo
        ob_start();
        include $archivoModulo;
        $html = ob_get_clean();

        return $html;
    }

    /**
     * Renderiza todos los módulos activos
     *
     * @return string HTML completo con todos los módulos
     */
    public function renderizarTodosModulos() {
        $html = '';
        $fases = $this->obtenerModulosPorFase();

        foreach ($fases as $numFase => $fase) {
            $html .= $this->renderizarSeparadorFase($numFase, $fase['nombre']);

            foreach ($fase['modulos'] as $modulo) {
                $html .= $this->renderizarModulo($modulo['id']);
            }
        }

        return $html;
    }

    /**
     * Renderiza separador visual de fase
     *
     * @param int $numFase Número de fase (0-5)
     * @param string $nombreFase Nombre de la fase
     * @return string HTML del separador
     */
    private function renderizarSeparadorFase($numFase, $nombreFase) {
        return <<<HTML
        <div class="audit-page fase-separator">
            <div class="page-header">
                <h1>Fase {$numFase}: {$nombreFase}</h1>
            </div>
        </div>
        HTML;
    }

    /**
     * Renderiza mensaje de error
     *
     * @param string $mensaje Mensaje de error
     * @return string HTML del error
     */
    private function renderizarError($mensaje) {
        $this->errores[] = $mensaje;
        return <<<HTML
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong> {$mensaje}
        </div>
        HTML;
    }

    /**
     * Calcula estadísticas del proyecto
     *
     * @return array Estadísticas del proyecto
     */
    public function calcularEstadisticas() {
        $totalPaginas = 0;
        $totalHoras = 0;
        $herramientasRequeridas = [];
        $modulosPorFase = array_fill(0, 10, 0); // Fases 0-9

        foreach ($this->modulosActivos as $moduloId) {
            $modulo = $this->obtenerModulo($moduloId);
            if ($modulo) {
                $totalPaginas += $modulo['paginas_generadas'] ?? 0;
                $totalHoras += $modulo['tiempo_estimado_horas'] ?? 0;
                $modulosPorFase[$modulo['fase']]++;

                $herramientas = $modulo['herramientas_requeridas'] ?? [];
                foreach ($herramientas as $herramienta) {
                    if (!in_array($herramienta, $herramientasRequeridas)) {
                        $herramientasRequeridas[] = $herramienta;
                    }
                }
            }
        }

        return [
            'total_modulos' => count($this->modulosActivos),
            'total_paginas' => $totalPaginas,
            'total_horas' => $totalHoras,
            'herramientas_requeridas' => $herramientasRequeridas,
            'modulos_por_fase' => $modulosPorFase
        ];
    }

    /**
     * Genera reporte de configuración del proyecto
     *
     * @return array Reporte completo
     */
    public function generarReporteConfiguracion() {
        $perfil = $this->obtenerPerfilActual();
        $validacion = $this->validarDependencias();
        $estadisticas = $this->calcularEstadisticas();

        return [
            'proyecto' => $this->configuracionCliente['proyecto'] ?? [],
            'perfil' => $perfil,
            'validacion' => $validacion,
            'estadisticas' => $estadisticas,
            'modulos_activos' => $this->modulosActivos,
            'errores' => $this->errores
        ];
    }

    /**
     * Exporta configuración como JSON
     *
     * @return string JSON formateado
     */
    public function exportarConfiguracion() {
        return json_encode($this->generarReporteConfiguracion(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Obtiene la configuración del cliente
     *
     * @return array Configuración completa del cliente
     */
    public function obtenerConfiguracionCliente() {
        return $this->configuracionCliente;
    }

    /**
     * Obtiene todos los errores acumulados
     *
     * @return array Array de mensajes de error
     */
    public function obtenerErrores() {
        return $this->errores;
    }

    /**
     * Verifica si hay errores
     *
     * @return bool True si hay errores
     */
    public function tieneErrores() {
        return !empty($this->errores);
    }
}
