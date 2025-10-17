<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - Sistema Modular de Auditoría SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container my-5">
    <h1 class="mb-4">
        <i class="fas fa-cogs"></i> Test del Sistema Modular de Auditoría SEO
    </h1>

    <?php
    // Incluir el ModuleLoader
    require_once 'includes/module_loader.php';

    // Inicializar el loader
    $loader = new ModuleLoader('./config/');

    // Verificar si hay errores en la carga
    if ($loader->tieneErrores()) {
        echo '<div class="alert alert-danger">';
        echo '<h4><i class="fas fa-exclamation-triangle"></i> Errores detectados:</h4>';
        echo '<ul>';
        foreach ($loader->obtenerErrores() as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    // Obtener configuración del proyecto
    $config = $loader->obtenerConfiguracionCliente();
    $perfil = $loader->obtenerPerfilActual();
    $validacion = $loader->validarDependencias();
    $estadisticas = $loader->calcularEstadisticas();
    ?>

    <!-- Información del Proyecto -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0"><i class="fas fa-project-diagram"></i> Información del Proyecto</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($config['proyecto']['nombre'] ?? 'N/A'); ?></p>
                    <p><strong>Cliente:</strong> <?php echo htmlspecialchars($config['proyecto']['cliente'] ?? 'N/A'); ?></p>
                    <p><strong>URL:</strong> <a href="<?php echo htmlspecialchars($config['proyecto']['url'] ?? '#'); ?>" target="_blank"><?php echo htmlspecialchars($config['proyecto']['url'] ?? 'N/A'); ?></a></p>
                    <p><strong>Tipo de Perfil:</strong> <span class="badge bg-info"><?php echo htmlspecialchars($config['proyecto']['tipo_perfil'] ?? 'N/A'); ?></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha Inicio:</strong> <?php echo htmlspecialchars($config['proyecto']['fecha_inicio'] ?? 'N/A'); ?></p>
                    <p><strong>Fecha Entrega:</strong> <?php echo htmlspecialchars($config['proyecto']['fecha_entrega'] ?? 'N/A'); ?></p>
                    <p><strong>Duración:</strong> <?php echo htmlspecialchars($config['proyecto']['duracion_semanas'] ?? 'N/A'); ?> semanas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Perfil del Proyecto -->
    <?php if ($perfil): ?>
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h2 class="h5 mb-0">
                <span style="font-size: 1.5em;"><?php echo $perfil['icono'] ?? ''; ?></span>
                <?php echo htmlspecialchars($perfil['nombre'] ?? 'Perfil'); ?>
            </h2>
        </div>
        <div class="card-body">
            <p class="lead"><?php echo htmlspecialchars($perfil['descripcion'] ?? ''); ?></p>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="text-center p-3 bg-light rounded">
                        <h3 class="h4 text-primary"><?php echo $perfil['tiempo_total_min_horas'] ?? 0; ?>-<?php echo $perfil['tiempo_total_max_horas'] ?? 0; ?>h</h3>
                        <small>Tiempo estimado</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-light rounded">
                        <h3 class="h4 text-success"><?php echo $perfil['paginas_estimadas'] ?? 0; ?></h3>
                        <small>Páginas estimadas</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-light rounded">
                        <h3 class="h4 text-info"><?php echo $perfil['precio_referencia_min'] ?? 0; ?>€</h3>
                        <small>Precio mínimo</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-light rounded">
                        <h3 class="h4 text-warning"><?php echo $perfil['duracion_semanas'] ?? 'N/A'; ?></h3>
                        <small>Duración</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Validación de Dependencias -->
    <div class="card mb-4">
        <div class="card-header <?php echo $validacion['valido'] ? 'bg-success' : 'bg-danger'; ?> text-white">
            <h2 class="h5 mb-0">
                <i class="fas fa-<?php echo $validacion['valido'] ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                Validación de Dependencias
            </h2>
        </div>
        <div class="card-body">
            <?php if ($validacion['valido']): ?>
                <p class="text-success"><i class="fas fa-check"></i> Todas las dependencias están correctamente configuradas.</p>
            <?php else: ?>
                <p class="text-danger"><strong>Se encontraron problemas de dependencias:</strong></p>
                <ul class="text-danger">
                    <?php foreach ($validacion['errores'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- Estadísticas del Proyecto -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h2 class="h5 mb-0"><i class="fas fa-chart-bar"></i> Estadísticas del Proyecto</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center p-3 border rounded">
                        <h3 class="h2 text-primary"><?php echo $estadisticas['total_modulos'] ?? 0; ?></h3>
                        <p class="mb-0">Módulos Activos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 border rounded">
                        <h3 class="h2 text-success"><?php echo $estadisticas['total_paginas'] ?? 0; ?></h3>
                        <p class="mb-0">Páginas Totales</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 border rounded">
                        <h3 class="h2 text-warning"><?php echo $estadisticas['total_horas'] ?? 0; ?></h3>
                        <p class="mb-0">Horas Totales</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 border rounded">
                        <h3 class="h2 text-info"><?php echo count($estadisticas['herramientas_requeridas'] ?? []); ?></h3>
                        <p class="mb-0">Herramientas</p>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="h6">Distribución por Fase:</h3>
                <div class="row">
                    <?php
                    $nombresFases = [
                        0 => 'Marketing Digital',
                        1 => 'Preparación',
                        2 => 'Keyword Research',
                        3 => 'Arquitectura',
                        4 => 'Recopilación de Datos',
                        5 => 'Entregables Finales'
                    ];
                    foreach ($estadisticas['modulos_por_fase'] ?? [] as $fase => $cantidad):
                        if ($cantidad > 0):
                    ?>
                    <div class="col-md-4 mb-2">
                        <div class="bg-light p-2 rounded">
                            <strong>Fase <?php echo $fase; ?>:</strong> <?php echo $nombresFases[$fase]; ?>
                            <span class="badge bg-primary float-end"><?php echo $cantidad; ?> módulo(s)</span>
                        </div>
                    </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>

            <?php if (!empty($estadisticas['herramientas_requeridas'])): ?>
            <div class="mt-4">
                <h3 class="h6">Herramientas Requeridas:</h3>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($estadisticas['herramientas_requeridas'] as $herramienta): ?>
                        <span class="badge bg-secondary"><?php echo htmlspecialchars($herramienta); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Módulos Organizados por Fase -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2 class="h5 mb-0"><i class="fas fa-list"></i> Módulos Activos por Fase</h2>
        </div>
        <div class="card-body">
            <?php
            $fases = $loader->obtenerModulosPorFase();
            foreach ($fases as $numFase => $fase):
            ?>
            <div class="mb-4">
                <h3 class="h5 border-bottom pb-2">
                    <i class="fas fa-folder"></i> Fase <?php echo $numFase; ?>: <?php echo htmlspecialchars($fase['nombre']); ?>
                    <span class="badge bg-primary float-end"><?php echo count($fase['modulos']); ?> módulos</span>
                </h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Páginas</th>
                                <th>Horas</th>
                                <th>Dependencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fase['modulos'] as $modulo): ?>
                            <tr>
                                <td><code><?php echo htmlspecialchars($modulo['id']); ?></code></td>
                                <td><strong><?php echo htmlspecialchars($modulo['nombre']); ?></strong></td>
                                <td><?php echo htmlspecialchars($modulo['descripcion'] ?? ''); ?></td>
                                <td class="text-center"><?php echo $modulo['paginas_generadas'] ?? 0; ?></td>
                                <td class="text-center"><?php echo $modulo['tiempo_estimado_horas'] ?? 0; ?>h</td>
                                <td>
                                    <?php if (!empty($modulo['dependencias'])): ?>
                                        <?php foreach ($modulo['dependencias'] as $dep): ?>
                                            <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($dep); ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Exportar Configuración -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h2 class="h5 mb-0"><i class="fas fa-download"></i> Exportar Configuración</h2>
        </div>
        <div class="card-body">
            <p>Descarga la configuración completa del proyecto en formato JSON:</p>
            <button class="btn btn-primary" onclick="descargarJSON()">
                <i class="fas fa-file-download"></i> Descargar JSON
            </button>
        </div>
    </div>

</div>

<script>
function descargarJSON() {
    const config = <?php echo $loader->exportarConfiguracion(); ?>;
    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(config, null, 2));
    const downloadAnchorNode = document.createElement('a');
    downloadAnchorNode.setAttribute("href", dataStr);
    downloadAnchorNode.setAttribute("download", "configuracion_proyecto.json");
    document.body.appendChild(downloadAnchorNode);
    downloadAnchorNode.click();
    downloadAnchorNode.remove();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
