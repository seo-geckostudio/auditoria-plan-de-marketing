<?php
require_once '../../config/database.php';
require_once '../../includes/functions.php';

$pdo = obtenerConexion();

// Obtener auditorías con información relacionada
$stmt = $pdo->query("
    SELECT 
        a.*,
        c.nombre_empresa,
        u.nombre as consultor_nombre,
        COUNT(ap.id) as total_pasos,
        SUM(CASE WHEN ap.estado = 'completado' THEN 1 ELSE 0 END) as pasos_completados,
        SUM(CASE WHEN ap.estado = 'en_progreso' THEN 1 ELSE 0 END) as pasos_en_progreso,
        ROUND(AVG(ap.tiempo_real_horas), 2) as tiempo_promedio
    FROM auditorias a
    LEFT JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN usuarios u ON a.usuario_id = u.id
    LEFT JOIN auditoria_pasos ap ON a.id = ap.auditoria_id
    GROUP BY a.id
    ORDER BY a.fecha_creacion DESC
");
$auditorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener estadísticas generales
$stmt = $pdo->query("
    SELECT 
        COUNT(*) as total_auditorias,
        SUM(CASE WHEN estado = 'completada' THEN 1 ELSE 0 END) as completadas,
        SUM(CASE WHEN estado = 'en_progreso' THEN 1 ELSE 0 END) as en_progreso,
        SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes
    FROM auditorias
");
$estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Auditorías SEO</title>
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

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card.total { border-left: 5px solid #3498db; }
        .stat-card.total .stat-number { color: #3498db; }

        .stat-card.completed { border-left: 5px solid #27ae60; }
        .stat-card.completed .stat-number { color: #27ae60; }

        .stat-card.progress { border-left: 5px solid #f39c12; }
        .stat-card.progress .stat-number { color: #f39c12; }

        .stat-card.pending { border-left: 5px solid #e74c3c; }
        .stat-card.pending .stat-number { color: #e74c3c; }

        .actions-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .search-filter {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-control {
            padding: 10px 15px;
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

        .audits-grid {
            display: grid;
            gap: 25px;
        }

        .audit-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 5px solid #667eea;
        }

        .audit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .audit-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .audit-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .audit-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .audit-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completada {
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

        .audit-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-icon {
            width: 20px;
            height: 20px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
        }

        .progress-section {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .audit-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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
            max-width: 600px;
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

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .actions-bar {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-filter {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔍 Gestión de Auditorías SEO</h1>
            <p>Panel de control para gestionar todas las auditorías y su progreso</p>
        </div>

        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-number"><?= $estadisticas['total_auditorias'] ?></div>
                <div class="stat-label">Total Auditorías</div>
            </div>
            <div class="stat-card completed">
                <div class="stat-number"><?= $estadisticas['completadas'] ?></div>
                <div class="stat-label">Completadas</div>
            </div>
            <div class="stat-card progress">
                <div class="stat-number"><?= $estadisticas['en_progreso'] ?></div>
                <div class="stat-label">En Progreso</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-number"><?= $estadisticas['pendientes'] ?></div>
                <div class="stat-label">Pendientes</div>
            </div>
        </div>

        <!-- Barra de acciones -->
        <div class="actions-bar">
            <div class="search-filter">
                <input type="text" class="form-control" placeholder="🔍 Buscar auditorías..." id="searchInput">
                <select class="form-control" id="statusFilter">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en_progreso">En Progreso</option>
                    <option value="completada">Completada</option>
                </select>
            </div>
            <div>
                <a href="crear.php" class="btn btn-primary">
                    ➕ Nueva Auditoría
                </a>
                <button class="btn btn-secondary" onclick="exportData()">
                    📊 Exportar
                </button>
            </div>
        </div>

        <!-- Lista de auditorías -->
        <div class="audits-grid" id="auditsContainer">
            <?php foreach ($auditorias as $auditoria): 
                $progreso = $auditoria['total_pasos'] > 0 ? 
                    round(($auditoria['pasos_completados'] / $auditoria['total_pasos']) * 100, 1) : 0;
            ?>
            <div class="audit-card" data-status="<?= $auditoria['estado'] ?>" data-title="<?= strtolower($auditoria['titulo']) ?>">
                <div class="audit-header">
                    <div>
                        <div class="audit-title"><?= htmlspecialchars($auditoria['titulo']) ?></div>
                        <div class="audit-meta">
                            Cliente: <strong><?= htmlspecialchars($auditoria['nombre_empresa'] ?? 'Sin asignar') ?></strong> | 
                            Consultor: <strong><?= htmlspecialchars($auditoria['consultor_nombre'] ?? 'Sin asignar') ?></strong>
                        </div>
                    </div>
                    <div class="audit-status status-<?= $auditoria['estado'] ?>">
                        <?= ucfirst(str_replace('_', ' ', $auditoria['estado'])) ?>
                    </div>
                </div>

                <div class="audit-info">
                    <div class="info-item">
                        <div class="info-icon">📅</div>
                        <div>
                            <strong>Inicio:</strong><br>
                            <?= date('d/m/Y', strtotime($auditoria['fecha_inicio'] ?? $auditoria['fecha_creacion'])) ?>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">📋</div>
                        <div>
                            <strong>Pasos:</strong><br>
                            <?= $auditoria['pasos_completados'] ?>/<?= $auditoria['total_pasos'] ?> completados
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">⏱️</div>
                        <div>
                            <strong>Tiempo promedio:</strong><br>
                            <?= $auditoria['tiempo_promedio'] ?? '0' ?>h por paso
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">🔄</div>
                        <div>
                            <strong>En progreso:</strong><br>
                            <?= $auditoria['pasos_en_progreso'] ?> pasos activos
                        </div>
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <span><strong>Progreso General</strong></span>
                        <span><strong><?= $progreso ?>%</strong></span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?= $progreso ?>%"></div>
                    </div>
                </div>

                <div class="audit-actions">
                    <a href="gestionar_pasos.php?id=<?= $auditoria['id'] ?>" class="btn btn-primary btn-sm">
                        📋 Gestionar Pasos
                    </a>
                    <a href="detalle.php?id=<?= $auditoria['id'] ?>" class="btn btn-secondary btn-sm">
                        👁️ Ver Detalle
                    </a>
                    <a href="editar.php?id=<?= $auditoria['id'] ?>" class="btn btn-warning btn-sm">
                        ✏️ Editar
                    </a>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $auditoria['id'] ?>)">
                        🗑️ Eliminar
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($auditorias)): ?>
        <div style="text-align: center; padding: 60px; color: #666;">
            <h3>📋 No hay auditorías registradas</h3>
            <p>Comienza creando tu primera auditoría SEO</p>
            <a href="crear.php" class="btn btn-primary" style="margin-top: 20px;">
                ➕ Crear Primera Auditoría
            </a>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Funcionalidad de búsqueda y filtrado
        document.getElementById('searchInput').addEventListener('input', filterAudits);
        document.getElementById('statusFilter').addEventListener('change', filterAudits);

        function filterAudits() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const auditCards = document.querySelectorAll('.audit-card');

            auditCards.forEach(card => {
                const title = card.dataset.title;
                const status = card.dataset.status;
                
                const matchesSearch = title.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;
                
                card.style.display = matchesSearch && matchesStatus ? 'block' : 'none';
            });
        }

        // Confirmación de eliminación
        function confirmDelete(auditId) {
            if (confirm('¿Estás seguro de que deseas eliminar esta auditoría? Esta acción no se puede deshacer.')) {
                window.location.href = `eliminar.php?id=${auditId}`;
            }
        }

        // Exportar datos
        function exportData() {
            window.location.href = 'exportar.php';
        }

        // Actualizar datos cada 30 segundos
        setInterval(() => {
            location.reload();
        }, 30000);
    </script>
</body>
</html>