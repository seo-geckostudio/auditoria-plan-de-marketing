<?php
/**
 * INSTALADOR DEL SISTEMA DE AUDITORÍAS SEO
 * ========================================
 * 
 * Script de instalación que crea la base de datos SQLite
 * y las tablas necesarias para el funcionamiento del sistema.
 */

// Definir constante de seguridad
define('SISTEMA_INICIADO', true);

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir configuración de base de datos
require_once __DIR__ . '/config/database.php';

// Variables de instalación
$mensajes = [];
$errores = [];
$instalacionCompleta = false;

// Procesar instalación si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['instalar'])) {
    try {
        // Crear directorio de datos si no existe
        $dataDir = dirname(DB_PATH);
        if (!is_dir($dataDir)) {
            if (!mkdir($dataDir, 0755, true)) {
                throw new Exception('No se pudo crear el directorio de datos: ' . $dataDir);
            }
            $mensajes[] = 'Directorio de datos creado: ' . $dataDir;
        }
        
        // Crear base de datos
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $mensajes[] = 'Base de datos SQLite creada: ' . DB_PATH;
        
        // Leer y ejecutar el esquema de la base de datos
        $schemaFile = __DIR__ . '/database_schema.sql';
        if (!file_exists($schemaFile)) {
            throw new Exception('Archivo de esquema no encontrado: ' . $schemaFile);
        }
        
        $schema = file_get_contents($schemaFile);
        $pdo->exec($schema);
        $mensajes[] = 'Esquema de base de datos ejecutado correctamente';
        
        // Insertar datos iniciales
        $pdo->exec("
            INSERT OR IGNORE INTO usuarios (id, nombre, email, password, rol, activo, fecha_creacion) 
            VALUES (1, 'Administrador', 'admin@sistema.com', 'password', 'admin', 1, datetime('now'))
        ");
        $mensajes[] = 'Usuario administrador creado';
        
        // Insertar fases por defecto
        $fases = [
            [0, 'Contexto Marketing Digital', 'Análisis del contexto de marketing digital (opcional)', 0],
            [1, 'Análisis Inicial', 'Preparación y configuración inicial de la auditoría', 1],
            [2, 'Análisis de Contenido', 'Investigación de palabras clave y contenido', 1],
            [3, 'Análisis de Competencia', 'Arquitectura de información y estructura del sitio', 1],
            [4, 'Análisis Técnico', 'Recopilación y análisis de datos técnicos', 1],
            [5, 'Entregables Finales', 'Generación de informes y entregables', 1]
        ];
        
        $stmt = $pdo->prepare("
            INSERT OR IGNORE INTO fases (numero_fase, nombre, descripcion, activa) 
            VALUES (?, ?, ?, ?)
        ");
        
        foreach ($fases as $fase) {
            $stmt->execute($fase);
        }
        $mensajes[] = 'Fases por defecto insertadas';
        
        $instalacionCompleta = true;
        $mensajes[] = '¡Instalación completada exitosamente!';
        
    } catch (Exception $e) {
        $errores[] = 'Error durante la instalación: ' . $e->getMessage();
    }
}

// Verificar si ya está instalado
$yaInstalado = file_exists(DB_PATH);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación - Sistema de Auditorías SEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .install-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            text-align: center;
            padding: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
        }
        .btn-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
        }
        .alert {
            border: none;
            border-radius: 10px;
        }
        .list-group-item {
            border: none;
            border-left: 4px solid #3498db;
            margin-bottom: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container install-container">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    Instalación del Sistema
                </h2>
                <p class="mb-0 mt-2">Sistema de Gestión de Auditorías SEO</p>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Errores encontrados:</h5>
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($mensajes)): ?>
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle me-2"></i>Progreso de instalación:</h5>
                        <ul class="list-group list-group-flush mt-3">
                            <?php foreach ($mensajes as $mensaje): ?>
                                <li class="list-group-item">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <?= htmlspecialchars($mensaje) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if ($instalacionCompleta): ?>
                    <div class="text-center mt-4">
                        <h4 class="text-success mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            ¡Instalación Completada!
                        </h4>
                        <p class="mb-4">El sistema ha sido instalado correctamente y está listo para usar.</p>
                        <a href="index.php" class="btn btn-success btn-lg">
                            <i class="fas fa-arrow-right me-2"></i>
                            Acceder al Sistema
                        </a>
                    </div>
                <?php elseif ($yaInstalado): ?>
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Sistema ya instalado</h5>
                        <p class="mb-0">El sistema ya ha sido instalado previamente.</p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>
                            Ir al Sistema
                        </a>
                        <button type="button" class="btn btn-outline-warning ms-2" data-bs-toggle="collapse" data-bs-target="#reinstalar">
                            <i class="fas fa-redo me-2"></i>
                            Reinstalar
                        </button>
                    </div>
                    
                    <div class="collapse mt-3" id="reinstalar">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Advertencia</h6>
                            <p class="mb-3">Reinstalar el sistema eliminará todos los datos existentes. Esta acción no se puede deshacer.</p>
                            <form method="post">
                                <button type="submit" name="instalar" class="btn btn-warning" onclick="return confirm('¿Estás seguro? Se perderán todos los datos.')">
                                    <i class="fas fa-redo me-2"></i>
                                    Confirmar Reinstalación
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="mb-4">
                        <h5><i class="fas fa-info-circle me-2"></i>Información del Sistema</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><strong>PHP:</strong> <?= PHP_VERSION ?></li>
                                    <li><strong>SQLite:</strong> <?= SQLite3::version()['versionString'] ?></li>
                                    <li><strong>Base de datos:</strong> <?= DB_PATH ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><strong>Directorio:</strong> <?= __DIR__ ?></li>
                                    <li><strong>Permisos:</strong> 
                                        <?php if (is_writable(__DIR__)): ?>
                                            <span class="text-success"><i class="fas fa-check"></i> Escritura OK</span>
                                        <?php else: ?>
                                            <span class="text-danger"><i class="fas fa-times"></i> Sin permisos</span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5><i class="fas fa-list-check me-2"></i>Componentes a instalar</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-database text-primary me-2"></i>
                                Base de datos SQLite
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-table text-primary me-2"></i>
                                Tablas del sistema (9 tablas)
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-shield text-primary me-2"></i>
                                Usuario administrador por defecto
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-layer-group text-primary me-2"></i>
                                Fases de auditoría (6 fases)
                            </li>
                        </ul>
                    </div>
                    
                    <form method="post" class="text-center">
                        <button type="submit" name="instalar" class="btn btn-primary btn-lg">
                            <i class="fas fa-play me-2"></i>
                            Iniciar Instalación
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-white-50">
                <i class="fas fa-code me-1"></i>
                Sistema de Auditorías SEO v1.0
            </p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>