<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

$pdo = obtenerConexion();
$auditoria_id = $_GET['id'] ?? null;

if (!$auditoria_id) {
    header('Location: gestionar.php');
    exit;
}

// Obtener información de la auditoría
$stmt = $pdo->prepare("
    SELECT a.*, c.nombre_empresa, u.nombre as consultor_nombre
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    WHERE a.id = ?
");
$stmt->execute([$auditoria_id]);
$auditoria = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$auditoria) {
    header('Location: gestionar.php');
    exit;
}

// Obtener pasos de la auditoría agrupados por fase
$stmt = $pdo->prepare("
    SELECT 
        ap.*,
        pp.nombre as paso_nombre,
        pp.descripcion,
        pp.tiempo_estimado_horas,
        f.nombre as fase_nombre,
        f.numero_fase,
        f.descripcion as fase_descripcion,
        COUNT(c.id) as total_comentarios,
        COUNT(ar.id) as total_archivos,
        u.nombre as usuario_asignado_nombre
    FROM auditoria_pasos ap
    JOIN pasos_plantilla pp ON ap.paso_plantilla_id = pp.id
    JOIN fases f ON pp.fase_id = f.id
    LEFT JOIN comentarios c ON ap.id = c.auditoria_paso_id
    LEFT JOIN archivos ar ON ap.id = ar.auditoria_paso_id
    LEFT JOIN usuarios u ON ap.usuario_asignado_id = u.id
    WHERE ap.auditoria_id = ?
    GROUP BY ap.id
    ORDER BY f.numero_fase, pp.orden_en_fase
");
$stmt->execute([$auditoria_id]);
$pasos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar pasos por fase
$pasos_por_fase = [];
foreach ($pasos as $paso) {
    $fase_key = $paso['numero_fase'];
    if (!isset($pasos_por_fase[$fase_key])) {
        $pasos_por_fase[$fase_key] = [
            'info' => [
                'numero' => $paso['numero_fase'],
                'nombre' => $paso['fase_nombre'],
                'descripcion' => $paso['fase_descripcion']
            ],
            'pasos' => []
        ];
    }
    $pasos_por_fase[$fase_key]['pasos'][] = $paso;
}

// Calcular estadísticas
$total_pasos = count($pasos);
$completados = array_filter($pasos, fn($p) => $p['estado'] === 'completado');
$en_progreso = array_filter($pasos, fn($p) => $p['estado'] === 'en_progreso');
$progreso_general = $total_pasos > 0 ? round((count($completados) / $total_pasos) * 100, 1) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pasos - <?= htmlspecialchars($auditoria['titulo']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .breadcrumb {
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .audit-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
        }

        .info-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info-label {
            color: #666;
            font-size: 0.9rem;
        }

        .progress-overview {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e9ecef;
            border-radius: 6px;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .phase-section {
            background: white;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .phase-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 25px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .phase-header:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        .phase-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .phase-stats {
            display: flex;
            gap: 20px;
            font-size: 0.9rem;
        }

        .phase-content {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .phase-content.active {
            max-height: 2000px;
            padding: 25px;
        }

        .steps-grid {
            display: grid;
            gap: 20px;
        }

        .step-card {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .step-card:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        }

        .step-card.completado {
            border-color: #28a745;
            background: #f8fff9;
        }

        .step-card.en_progreso {
            border-color: #ffc107;
            background: #fffef8;
        }

        .step-card.pendiente {
            border-color: #dc3545;
            background: #fff8f8;
        }

        .step-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .step-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .step-status {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completado {
            background: #d4edda;
            color: #155724;
        }

        .status-en_progreso {
            background: #fff3cd;
            color: #856404;
        }

        .status-pendiente {
            background: #f8d7da;
            color: #721c24;
        }

        .step-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }

        .step-description {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .step-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary { background: #667eea; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-info { background: #17a2b8; color: white; }
        .btn-secondary { background: #6c757d; color: white; }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .toggle-icon {
            transition: transform 0.3s ease;
        }

        .toggle-icon.rotated {
            transform: rotate(180deg);
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .audit-info {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .phase-stats {
                flex-direction: column;
                gap: 5px;
            }
            
            .step-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="breadcrumb">
                <a href="gestionar.php">← Volver a Auditorías</a>
            </div>
            <h1>📋 Gestión de Pasos</h1>
            <h2><?= htmlspecialchars($auditoria['titulo']) ?></h2>
            <p><strong>Cliente:</strong> <?= htmlspecialchars($auditoria['nombre_empresa'] ?? 'Sin asignar') ?> | 
               <strong>Consultor:</strong> <?= htmlspecialchars($auditoria['consultor_nombre'] ?? 'Sin asignar') ?></p>
        </div>

        <!-- Información general -->
        <div class="audit-info">
            <div class="info-card">
                <div class="info-number" style="color: #3498db;"><?= $total_pasos ?></div>
                <div class="info-label">Total Pasos</div>
            </div>
            <div class="info-card">
                <div class="info-number" style="color: #27ae60;"><?= count($completados) ?></div>
                <div class="info-label">Completados</div>
            </div>
            <div class="info-card">
                <div class="info-number" style="color: #f39c12;"><?= count($en_progreso) ?></div>
                <div class="info-label">En Progreso</div>
            </div>
            <div class="info-card">
                <div class="info-number" style="color: #e74c3c;"><?= $total_pasos - count($completados) - count($en_progreso) ?></div>
                <div class="info-label">Pendientes</div>
            </div>
        </div>

        <!-- Progreso general -->
        <div class="progress-overview">
            <h3>📊 Progreso General: <?= $progreso_general ?>%</h3>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= $progreso_general ?>%"></div>
            </div>
            <p>Has completado <?= count($completados) ?> de <?= $total_pasos ?> pasos</p>
        </div>

        <!-- Pasos por fase -->
        <?php foreach ($pasos_por_fase as $fase): 
            $pasos_fase = $fase['pasos'];
            $completados_fase = array_filter($pasos_fase, fn($p) => $p['estado'] === 'completado');
            $progreso_fase = count($pasos_fase) > 0 ? round((count($completados_fase) / count($pasos_fase)) * 100, 1) : 0;
        ?>
        <div class="phase-section">
            <div class="phase-header" onclick="togglePhase(<?= $fase['info']['numero'] ?>)">
                <div>
                    <div class="phase-title">
                        Fase <?= $fase['info']['numero'] ?>: <?= htmlspecialchars($fase['info']['nombre']) ?>
                    </div>
                    <div style="font-size: 0.9rem; opacity: 0.9; margin-top: 5px;">
                        <?= htmlspecialchars($fase['info']['descripcion']) ?>
                    </div>
                </div>
                <div class="phase-stats">
                    <div><?= count($completados_fase) ?>/<?= count($pasos_fase) ?> completados</div>
                    <div><?= $progreso_fase ?>%</div>
                    <div class="toggle-icon" id="toggle-<?= $fase['info']['numero'] ?>">▼</div>
                </div>
            </div>
            
            <div class="phase-content" id="phase-<?= $fase['info']['numero'] ?>">
                <div class="steps-grid">
                    <?php foreach ($pasos_fase as $paso): ?>
                    <div class="step-card <?= $paso['estado'] ?>">
                        <div class="step-header">
                            <div class="step-title"><?= htmlspecialchars($paso['paso_nombre']) ?></div>
                            <div class="step-status status-<?= $paso['estado'] ?>">
                                <?= ucfirst(str_replace('_', ' ', $paso['estado'])) ?>
                            </div>
                        </div>

                        <div class="step-meta">
                            <div><strong>⏱️ Tiempo estimado:</strong> <?= $paso['tiempo_estimado_horas'] ?>h</div>
                            <div><strong>⏰ Tiempo real:</strong> <?= $paso['tiempo_real_horas'] ?? '0' ?>h</div>
                            <div><strong>👤 Asignado:</strong> <?= htmlspecialchars($paso['usuario_asignado_nombre'] ?? 'Sin asignar') ?></div>
                            <div><strong>📎 Archivos:</strong> <?= $paso['total_archivos'] ?></div>
                            <div><strong>💬 Comentarios:</strong> <?= $paso['total_comentarios'] ?></div>
                            <?php if ($paso['fecha_completado']): ?>
                            <div><strong>✅ Completado:</strong> <?= date('d/m/Y H:i', strtotime($paso['fecha_completado'])) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="step-description">
                            <?= nl2br(htmlspecialchars($paso['descripcion'])) ?>
                        </div>

                        <div class="step-actions">
                            <button class="btn btn-primary" onclick="editStep(<?= $paso['id'] ?>)">
                                ✏️ Editar
                            </button>
                            
                            <?php if ($paso['estado'] === 'pendiente'): ?>
                            <button class="btn btn-warning" onclick="startStep(<?= $paso['id'] ?>)">
                                ▶️ Iniciar
                            </button>
                            <?php endif; ?>
                            
                            <?php if ($paso['estado'] === 'en_progreso'): ?>
                            <button class="btn btn-success" onclick="completeStep(<?= $paso['id'] ?>)">
                                ✅ Completar
                            </button>
                            <?php endif; ?>
                            
                            <button class="btn btn-info" onclick="viewDetails(<?= $paso['id'] ?>)">
                                👁️ Detalles
                            </button>
                            
                            <button class="btn btn-secondary" onclick="addComment(<?= $paso['id'] ?>)">
                                💬 Comentar
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal para editar paso -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editModal')">&times;</span>
            <h2>✏️ Editar Paso</h2>
            <form id="editStepForm">
                <input type="hidden" id="stepId" name="step_id">
                
                <div class="form-group">
                    <label class="form-label">Estado:</label>
                    <select class="form-control" id="stepStatus" name="estado">
                        <option value="pendiente">Pendiente</option>
                        <option value="en_progreso">En Progreso</option>
                        <option value="completado">Completado</option>
                        <option value="bloqueado">Bloqueado</option>
                        <option value="omitido">Omitido</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tiempo Real (horas):</label>
                    <input type="number" class="form-control" id="stepTime" name="tiempo_real_horas" step="0.5" min="0">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Notas:</label>
                    <textarea class="form-control" id="stepNotes" name="notas" rows="4"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Datos Completados (JSON):</label>
                    <textarea class="form-control" id="stepData" name="datos_completados" rows="6" placeholder='{"ejemplo": "valor"}'></textarea>
                </div>
                
                <div style="text-align: right; margin-top: 20px;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle de fases
        function togglePhase(phaseNumber) {
            const content = document.getElementById(`phase-${phaseNumber}`);
            const icon = document.getElementById(`toggle-${phaseNumber}`);
            
            content.classList.toggle('active');
            icon.classList.toggle('rotated');
        }

        // Abrir todas las fases por defecto
        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($pasos_por_fase as $fase): ?>
            togglePhase(<?= $fase['info']['numero'] ?>);
            <?php endforeach; ?>
        });

        // Funciones de gestión de pasos
        function editStep(stepId) {
            // Aquí cargarías los datos del paso y mostrarías el modal
            document.getElementById('stepId').value = stepId;
            document.getElementById('editModal').style.display = 'block';
        }

        function startStep(stepId) {
            if (confirm('¿Iniciar este paso?')) {
                updateStepStatus(stepId, 'en_progreso');
            }
        }

        function completeStep(stepId) {
            if (confirm('¿Marcar este paso como completado?')) {
                updateStepStatus(stepId, 'completado');
            }
        }

        function updateStepStatus(stepId, status) {
            // Aquí harías la petición AJAX para actualizar el estado
            fetch('update_step.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    step_id: stepId,
                    estado: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al actualizar el paso');
                }
            });
        }

        function viewDetails(stepId) {
            window.open(`detalle_paso.php?id=${stepId}`, '_blank');
        }

        function addComment(stepId) {
            const comment = prompt('Agregar comentario:');
            if (comment) {
                // Aquí harías la petición para agregar el comentario
                console.log('Agregar comentario al paso', stepId, ':', comment);
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Envío del formulario de edición
        document.getElementById('editStepForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            fetch('update_step.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeModal('editModal');
                    location.reload();
                } else {
                    alert('Error al actualizar el paso: ' + data.message);
                }
            });
        });
    </script>
</body>
</html>