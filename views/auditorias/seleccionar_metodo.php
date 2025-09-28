<?php
/**
 * VISTA: SELECTOR DE MÉTODO DE ENTRADA
 * ====================================
 *
 * Vista que permite al usuario elegir cómo introducir datos para un paso específico:
 * - Formulario dinámico
 * - Upload de archivo
 * - Importar CSV
 */

// Verificar que se ha incluido desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

require_once __DIR__ . '/../../modules/formularios.php';

// Obtener parámetros
$auditoria_id = (int)($_GET['auditoria_id'] ?? 0);
$paso_id = (int)($_GET['paso_id'] ?? 0);

if (!$auditoria_id || !$paso_id) {
    echo '<div class="alert alert-danger">Parámetros incorrectos</div>';
    return;
}

// Obtener información del paso
$sql_paso = "
    SELECT
        ap.*,
        pp.nombre as paso_nombre,
        pp.descripcion as paso_descripcion,
        pp.codigo_paso,
        pp.metodos_entrada,
        a.titulo as nombre_auditoria,
        c.nombre_empresa
    FROM auditoria_pasos ap
    JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
    JOIN auditorias a ON ap.auditoria_id = a.id
    JOIN clientes c ON a.cliente_id = c.id
    WHERE ap.id = ? AND ap.auditoria_id = ?
";

$paso_info = obtenerRegistro($sql_paso, [$paso_id, $auditoria_id]);

if (!$paso_info) {
    echo '<div class="alert alert-danger">Paso no encontrado</div>';
    return;
}

// Obtener métodos permitidos
$metodos_permitidos = json_decode($paso_info['metodos_entrada'] ?? '["formulario"]', true);

// Verificar qué datos ya existen
$tiene_formulario = false;
$tiene_archivos = false;
$tiene_csv = false;

// Verificar datos de formulario
if (in_array('formulario', $metodos_permitidos)) {
    $sql_form = "SELECT COUNT(*) as count FROM paso_datos WHERE auditoria_paso_id = ?";
    $resultado_form = obtenerRegistro($sql_form, [$paso_id]);
    $tiene_formulario = $resultado_form && $resultado_form['count'] > 0;
}

// Verificar archivos subidos
if (in_array('archivo', $metodos_permitidos)) {
    $sql_arch = "SELECT COUNT(*) as count FROM archivos WHERE auditoria_paso_id = ?";
    $resultado_arch = obtenerRegistro($sql_arch, [$paso_id]);
    $tiene_archivos = $resultado_arch && $resultado_arch['count'] > 0;
}

// Verificar datos CSV
if (in_array('csv', $metodos_permitidos)) {
    $sql_csv = "SELECT COUNT(*) as count FROM csv_datos WHERE auditoria_paso_id = ?";
    $resultado_csv = obtenerRegistro($sql_csv, [$paso_id]);
    $tiene_csv = $resultado_csv && $resultado_csv['count'] > 0;
}

// Calcular progreso general
$porcentaje_completado = calcularCompletitudFormulario($paso_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Entrada: <?= htmlspecialchars($paso_info['paso_nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .metodo-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .metodo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-color: #007bff;
        }
        .metodo-disponible {
            opacity: 1;
        }
        .metodo-no-disponible {
            opacity: 0.6;
            background-color: #f8f9fa;
        }
        .metodo-con-datos {
            border-color: #28a745;
            background-color: #f8fff9;
        }
        .progress-ring {
            width: 60px;
            height: 60px;
        }
        .progress-circle {
            fill: none;
            stroke: #e9ecef;
            stroke-width: 4;
        }
        .progress-circle.active {
            stroke: #28a745;
            stroke-dasharray: 188.5; /* 2 * PI * 30 */
            stroke-dashoffset: calc(188.5 - (188.5 * var(--progress)) / 100);
            transition: stroke-dashoffset 0.3s;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="?modulo=auditorias&accion=listar">Auditorías</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="?modulo=auditorias&accion=ver&id=<?= $auditoria_id ?>">
                                <?= htmlspecialchars($paso_info['nombre_auditoria']) ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= htmlspecialchars($paso_info['paso_nombre']) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Información del paso -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">
                                    <i class="fas fa-tasks text-primary"></i>
                                    <?= htmlspecialchars($paso_info['paso_nombre']) ?>
                                </h4>
                                <small class="text-muted">
                                    Cliente: <?= htmlspecialchars($paso_info['nombre_empresa']) ?> |
                                    Código: <?= htmlspecialchars($paso_info['codigo_paso']) ?>
                                </small>
                            </div>
                            <div class="text-center">
                                <svg class="progress-ring" style="--progress: <?= $porcentaje_completado ?>">
                                    <circle class="progress-circle" cx="30" cy="30" r="30"></circle>
                                    <circle class="progress-circle active" cx="30" cy="30" r="30"></circle>
                                </svg>
                                <div><small><?= round($porcentaje_completado, 1) ?>%</small></div>
                            </div>
                        </div>
                    </div>

                    <?php if ($paso_info['paso_descripcion']): ?>
                    <div class="card-body">
                        <p class="mb-0"><?= nl2br(htmlspecialchars($paso_info['paso_descripcion'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Selector de métodos -->
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3">
                    <i class="fas fa-route"></i>
                    Selecciona cómo introducir los datos:
                </h5>
            </div>
        </div>

        <div class="row g-4">
            <!-- Método: Formulario -->
            <?php if (in_array('formulario', $metodos_permitidos)): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card metodo-card metodo-disponible <?= $tiene_formulario ? 'metodo-con-datos' : '' ?>"
                     onclick="window.location.href='?modulo=auditorias&accion=formulario&auditoria_id=<?= $auditoria_id ?>&paso_id=<?= $paso_id ?>'">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-edit fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Formulario Dinámico</h5>
                        <p class="card-text text-muted">
                            Introduce los datos paso a paso usando campos inteligentes
                        </p>

                        <?php if ($tiene_formulario): ?>
                            <div class="alert alert-success alert-sm mt-3">
                                <i class="fas fa-check-circle"></i>
                                Datos guardados
                            </div>
                        <?php endif; ?>

                        <div class="mt-3">
                            <div class="badge bg-primary">Recomendado</div>
                            <div class="badge bg-secondary">Interactivo</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Método: Upload de archivo -->
            <?php if (in_array('archivo', $metodos_permitidos)): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card metodo-card metodo-disponible <?= $tiene_archivos ? 'metodo-con-datos' : '' ?>"
                     onclick="window.location.href='?modulo=auditorias&accion=upload&auditoria_id=<?= $auditoria_id ?>&paso_id=<?= $paso_id ?>'">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-upload fa-3x text-success"></i>
                        </div>
                        <h5 class="card-title">Subir Archivo</h5>
                        <p class="card-text text-muted">
                            Sube documentos existentes (PDF, Word, Excel)
                        </p>

                        <?php if ($tiene_archivos): ?>
                            <div class="alert alert-success alert-sm mt-3">
                                <i class="fas fa-check-circle"></i>
                                Archivos subidos
                            </div>
                        <?php endif; ?>

                        <div class="mt-3">
                            <div class="badge bg-success">Rápido</div>
                            <div class="badge bg-secondary">PDF/Word/Excel</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Método: Importar CSV -->
            <?php if (in_array('csv', $metodos_permitidos)): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card metodo-card metodo-disponible <?= $tiene_csv ? 'metodo-con-datos' : '' ?>"
                     onclick="window.location.href='?modulo=auditorias&accion=importar_csv&auditoria_id=<?= $auditoria_id ?>&paso_id=<?= $paso_id ?>'">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-file-csv fa-3x text-warning"></i>
                        </div>
                        <h5 class="card-title">Importar CSV</h5>
                        <p class="card-text text-muted">
                            Importa datos desde GSC, Ahrefs, Screaming Frog
                        </p>

                        <?php if ($tiene_csv): ?>
                            <div class="alert alert-success alert-sm mt-3">
                                <i class="fas fa-check-circle"></i>
                                CSV importado
                            </div>
                        <?php endif; ?>

                        <div class="mt-3">
                            <div class="badge bg-warning">Masivo</div>
                            <div class="badge bg-secondary">GSC/Ahrefs</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Información adicional y acciones -->
        <div class="row mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-lightbulb"></i> Recomendaciones</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <?php if (in_array('formulario', $metodos_permitidos)): ?>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <strong>Formulario:</strong> Ideal para datos básicos, brief del cliente, objetivos
                                </li>
                            <?php endif; ?>

                            <?php if (in_array('csv', $metodos_permitidos)): ?>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <strong>CSV:</strong> Perfecto para exports de GSC, Ahrefs, Screaming Frog
                                </li>
                            <?php endif; ?>

                            <?php if (in_array('archivo', $metodos_permitidos)): ?>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <strong>Archivo:</strong> Útil para informes previos, capturas, documentos del cliente
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-cog"></i> Acciones</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-sm" onclick="verProgreso()">
                                <i class="fas fa-chart-line"></i> Ver Progreso Detallado
                            </button>

                            <?php if ($porcentaje_completado > 0): ?>
                                <button class="btn btn-outline-success btn-sm" onclick="exportarDatos()">
                                    <i class="fas fa-download"></i> Exportar Datos
                                </button>
                            <?php endif; ?>

                            <button class="btn btn-outline-info btn-sm me-2" onclick="mostrarAyuda()">
                                <i class="fas fa-question-circle"></i> Ayuda
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="volverAuditoria()">
                                <i class="fas fa-arrow-left"></i> Volver a Auditoría
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function verProgreso() {
            // TODO: Implementar modal con progreso detallado
            alert('Funcionalidad de progreso detallado - próximamente');
        }

        function exportarDatos() {
            window.open('api/exportar_formulario.php?paso_id=<?= $paso_id ?>&formato=json', '_blank');
        }

        function volverAuditoria() {
            window.location.href = '?modulo=auditorias&accion=ver&id=<?= $auditoria_id ?>';
        }

        function mostrarAyuda() {
            const url = `?modulo=ayuda&accion=paso&paso_id=<?= $paso_id ?>`;
            window.open(url, 'ayuda', 'width=1200,height=800,scrollbars=yes,resizable=yes');
        }
    </script>
</body>
</html>