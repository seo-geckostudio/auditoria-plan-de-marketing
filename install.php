<?php
/**
 * INSTALADOR DEL SISTEMA DE AUDITORÍAS SEO
 * ========================================
 * 
 * Este archivo se encarga de:
 * - Verificar requisitos del sistema
 * - Crear la base de datos
 * - Importar el esquema inicial
 * - Configurar el usuario administrador
 * - Importar pasos desde archivos .md
 */

session_start();

// Configuración de errores para instalación
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Variables de configuración
$requisitos = [
    'php_version' => '7.4.0',
    'extensions' => ['pdo', 'pdo_sqlite', 'json', 'mbstring', 'fileinfo'],
    'directories' => ['uploads', 'logs', 'temp', 'data']
];

$pasos_instalacion = [
    'verificar_requisitos' => 'Verificar requisitos del sistema',
    'configurar_bd' => 'Configurar base de datos',
    'crear_esquema' => 'Crear esquema de base de datos',
    'crear_admin' => 'Crear usuario administrador',
    'importar_pasos' => 'Importar pasos desde archivos .md',
    'finalizar' => 'Finalizar instalación'
];

$paso_actual = $_GET['paso'] ?? 'verificar_requisitos';
$errores = [];
$mensajes = [];

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($paso_actual) {
        case 'configurar_bd':
            $resultado = procesarConfiguracionBD();
            if ($resultado['success']) {
                header('Location: install.php?paso=crear_esquema');
                exit;
            } else {
                $errores = $resultado['errores'];
            }
            break;
            
        case 'crear_admin':
            $resultado = procesarCreacionAdmin();
            if ($resultado['success']) {
                header('Location: install.php?paso=importar_pasos');
                exit;
            } else {
                $errores = $resultado['errores'];
            }
            break;
            
        case 'importar_pasos':
            $resultado = procesarImportacionPasos();
            if ($resultado['success']) {
                header('Location: install.php?paso=finalizar');
                exit;
            } else {
                $errores = $resultado['errores'];
            }
            break;
    }
}

/**
 * Verifica los requisitos del sistema
 */
function verificarRequisitos() {
    global $requisitos;
    $resultados = [];
    
    // Verificar versión de PHP
    $resultados['php_version'] = [
        'nombre' => 'Versión de PHP >= ' . $requisitos['php_version'],
        'estado' => version_compare(PHP_VERSION, $requisitos['php_version'], '>='),
        'valor' => PHP_VERSION
    ];
    
    // Verificar extensiones
    foreach ($requisitos['extensions'] as $extension) {
        $resultados['ext_' . $extension] = [
            'nombre' => 'Extensión ' . $extension,
            'estado' => extension_loaded($extension),
            'valor' => extension_loaded($extension) ? 'Instalada' : 'No instalada'
        ];
    }
    
    // Verificar directorios escribibles
    foreach ($requisitos['directories'] as $directory) {
        $path = __DIR__ . '/' . $directory;
        $escribible = is_dir($path) ? is_writable($path) : @mkdir($path, 0755, true);
        
        $resultados['dir_' . $directory] = [
            'nombre' => 'Directorio ' . $directory . ' escribible',
            'estado' => $escribible,
            'valor' => $escribible ? 'Escribible' : 'No escribible'
        ];
    }
    
    return $resultados;
}

/**
 * Procesa la configuración de la base de datos
 */
function procesarConfiguracionBD() {
    // Para SQLite, solo necesitamos verificar que el directorio data existe
    $data_dir = __DIR__ . '/data';
    
    if (!is_dir($data_dir)) {
        if (!mkdir($data_dir, 0755, true)) {
            return ['success' => false, 'errores' => ['No se pudo crear el directorio data']];
        }
    }
    
    if (!is_writable($data_dir)) {
        return ['success' => false, 'errores' => ['El directorio data no es escribible']];
    }
    
    try {
        // Crear configuración para SQLite
        $config = "<?php\n";
        $config .= "// Configuración de base de datos generada automáticamente\n";
        $config .= "define('DB_HOST', 'localhost');\n";
        $config .= "define('DB_PORT', '3306');\n";
        $config .= "define('DB_NAME', 'auditoria_seo');\n";
        $config .= "define('DB_USER', 'root');\n";
        $config .= "define('DB_PASS', '');\n";
        $config .= "define('DB_CHARSET', 'utf8mb4');\n\n";
        $config .= "// Configuración SQLite como alternativa\n";
        $config .= "define('USE_SQLITE', true);\n";
        $config .= "define('SQLITE_DB_PATH', __DIR__ . '/../data/auditoria_seo.sqlite');\n";
        
        file_put_contents(__DIR__ . '/config/database_config.php', $config);
        
        return ['success' => true];
        
    } catch (Exception $e) {
        return ['success' => false, 'errores' => ['Error de configuración: ' . $e->getMessage()]];
    }
}

/**
 * Crea el esquema de la base de datos
 */
function crearEsquema() {
    try {
        // Usar la conexión SQLite directamente
        $sqlite_path = __DIR__ . '/data/auditoria_seo.sqlite';
        $dsn = "sqlite:$sqlite_path";
        
        $pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        
        // Verificar si las tablas ya existen
        $result = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
        $existing_tables = [];
        while ($row = $result->fetch()) {
            $existing_tables[] = $row['name'];
        }
        
        // Si ya hay tablas principales, considerar que el esquema ya está creado
        $required_tables = ['usuarios', 'clientes', 'fases', 'pasos_plantilla', 'auditorias'];
        $tables_exist = array_intersect($required_tables, $existing_tables);
        
        if (count($tables_exist) >= 3) {
            // La mayoría de las tablas ya existen, considerar exitoso
            return ['success' => true, 'message' => 'El esquema ya existe y está configurado correctamente.'];
        }
        
        // Leer y ejecutar el archivo SQL
        $sql = file_get_contents(__DIR__ . '/database_schema.sql');
        
        // Dividir en declaraciones individuales
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^\s*--/', $statement)) {
                try {
                    $pdo->exec($statement);
                } catch (PDOException $e) {
                    // Ignorar errores de tabla ya existe
                    if (strpos($e->getMessage(), 'already exists') === false) {
                        throw $e;
                    }
                }
            }
        }
        
        return ['success' => true, 'message' => 'Esquema de base de datos creado exitosamente.'];
        
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

/**
 * Procesa la creación del usuario administrador
 */
function procesarCreacionAdmin() {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmar_password = $_POST['confirmar_password'] ?? '';
    
    $errores = [];
    
    if (empty($nombre)) {
        $errores[] = 'El nombre es requerido';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email es requerido y debe ser válido';
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres';
    }
    
    if ($password !== $confirmar_password) {
        $errores[] = 'Las contraseñas no coinciden';
    }
    
    if (!empty($errores)) {
        return ['success' => false, 'errores' => $errores];
    }
    
    try {
        // Usar la conexión SQLite directamente
        $sqlite_path = __DIR__ . '/data/auditoria_seo.sqlite';
        $dsn = "sqlite:$sqlite_path";
        
        $pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        
        // Actualizar el usuario admin existente
        $stmt = $pdo->prepare("
            UPDATE usuarios 
            SET nombre = ?, email = ?, password = ?, fecha_actualizacion = datetime('now') 
            WHERE id = 1
        ");
        
        $stmt->execute([
            $nombre,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
        
        return ['success' => true];
        
    } catch (Exception $e) {
        return ['success' => false, 'errores' => ['Error al crear administrador: ' . $e->getMessage()]];
    }
}

/**
 * Procesa la importación de pasos
 */
function procesarImportacionPasos() {
    try {
        require_once __DIR__ . '/config/database_config.php';
        require_once __DIR__ . '/import_pasos.php';
        
        // Ejecutar importación usando la clase ImportadorPasos
        $dsn = "sqlite:" . __DIR__ . "/data/auditoria_seo.sqlite";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];
        
        $pdo = new PDO($dsn, null, null, $options);
        $importador = new ImportadorPasos($pdo);
        $totalImportados = $importador->importarTodo();
        
        return ['success' => true, 'mensaje' => "Importación completada. Total de pasos importados: $totalImportados"];
        
    } catch (Exception $e) {
        return ['success' => false, 'errores' => ['Error en importación: ' . $e->getMessage()]];
    }
}

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
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .install-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .install-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .install-body {
            padding: 2rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }
        
        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }
        
        .step.completed:not(:last-child)::after {
            background: #28a745;
        }
        
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
            margin-bottom: 0.5rem;
        }
        
        .step.active .step-circle {
            background: #007bff;
            color: white;
        }
        
        .step.completed .step-circle {
            background: #28a745;
            color: white;
        }
        
        .step-label {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .step.active .step-label {
            color: #007bff;
            font-weight: bold;
        }
        
        .step.completed .step-label {
            color: #28a745;
        }
        
        .requirement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .requirement-item:last-child {
            border-bottom: none;
        }
        
        .status-icon {
            width: 20px;
            text-align: center;
        }
        
        .btn-install {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-install:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
        
        .alert {
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-card">
            <div class="install-header">
                <h1><i class="fas fa-search-dollar me-2"></i>Sistema de Auditorías SEO</h1>
                <p class="mb-0">Asistente de Instalación</p>
            </div>
            
            <div class="install-body">
                <!-- Indicador de pasos -->
                <div class="step-indicator">
                    <?php 
                    $pasos_array = array_keys($pasos_instalacion);
                    $indice_actual = array_search($paso_actual, $pasos_array);
                    
                    foreach ($pasos_array as $i => $paso): 
                        $clase = '';
                        if ($i < $indice_actual) $clase = 'completed';
                        elseif ($i === $indice_actual) $clase = 'active';
                    ?>
                        <div class="step <?= $clase ?>">
                            <div class="step-circle">
                                <?php if ($clase === 'completed'): ?>
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <?= $i + 1 ?>
                                <?php endif; ?>
                            </div>
                            <div class="step-label"><?= $pasos_instalacion[$paso] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Mensajes de error -->
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Errores encontrados:</h6>
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <!-- Contenido del paso actual -->
                <?php switch ($paso_actual): 
                    case 'verificar_requisitos': 
                        $requisitos_resultado = verificarRequisitos();
                        $todos_ok = !in_array(false, array_column($requisitos_resultado, 'estado'));
                ?>
                    <h3><i class="fas fa-clipboard-check me-2"></i>Verificación de Requisitos</h3>
                    <p class="text-muted">Verificando que el sistema cumple con todos los requisitos necesarios.</p>
                    
                    <div class="mt-4">
                        <?php foreach ($requisitos_resultado as $req): ?>
                            <div class="requirement-item">
                                <div>
                                    <strong><?= $req['nombre'] ?></strong>
                                    <br>
                                    <small class="text-muted"><?= $req['valor'] ?></small>
                                </div>
                                <div class="status-icon">
                                    <?php if ($req['estado']): ?>
                                        <i class="fas fa-check-circle text-success"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-danger"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="text-center mt-4">
                        <?php if ($todos_ok): ?>
                            <a href="install.php?paso=configurar_bd" class="btn btn-install">
                                <i class="fas fa-arrow-right me-2"></i>Continuar
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Por favor, resuelve los requisitos faltantes antes de continuar.
                            </div>
                            <button onclick="location.reload()" class="btn btn-outline-primary">
                                <i class="fas fa-sync me-2"></i>Verificar Nuevamente
                            </button>
                        <?php endif; ?>
                    </div>
                    
                <?php break; case 'configurar_bd': ?>
                    <h3><i class="fas fa-database me-2"></i>Configuración de Base de Datos</h3>
                    <p class="text-muted">Configurando la base de datos SQLite para el sistema.</p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Este sistema utiliza SQLite como base de datos. No se requiere configuración adicional.
                        La base de datos se creará automáticamente en el directorio <code>data/</code>.
                    </div>
                    
                    <form method="POST" class="mt-4">
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-install">
                                <i class="fas fa-database me-2"></i>Configurar SQLite y Continuar
                            </button>
                        </div>
                    </form>
                    
                <?php break; case 'crear_esquema': 
                    $resultado_esquema = crearEsquema();
                ?>
                    <h3><i class="fas fa-cogs me-2"></i>Creación del Esquema</h3>
                    <p class="text-muted">Creando las tablas y estructura de la base de datos.</p>
                    
                    <?php if ($resultado_esquema['success']): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            El esquema de la base de datos se ha creado exitosamente.
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="install.php?paso=crear_admin" class="btn btn-install">
                                <i class="fas fa-arrow-right me-2"></i>Continuar
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Error al crear el esquema: <?= htmlspecialchars($resultado_esquema['error']) ?>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="install.php?paso=configurar_bd" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Volver a Configuración
                            </a>
                        </div>
                    <?php endif; ?>
                    
                <?php break; case 'crear_admin': ?>
                    <h3><i class="fas fa-user-shield me-2"></i>Crear Usuario Administrador</h3>
                    <p class="text-muted">Configura la cuenta del administrador del sistema.</p>
                    
                    <form method="POST" class="mt-4">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?= $_POST['nombre'] ?? '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= $_POST['email'] ?? '' ?>" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           minlength="6" required>
                                    <div class="form-text">Mínimo 6 caracteres.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirmar_password" 
                                           name="confirmar_password" minlength="6" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-install">
                                <i class="fas fa-user-plus me-2"></i>Crear Administrador
                            </button>
                        </div>
                    </form>
                    
                <?php break; case 'importar_pasos': ?>
                    <h3><i class="fas fa-file-import me-2"></i>Importar Pasos de Auditoría</h3>
                    <p class="text-muted">Importando los pasos de auditoría desde los archivos .md existentes.</p>
                    
                    <form method="POST" class="mt-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Este proceso buscará archivos .md en las carpetas de fases y los importará como plantillas de pasos.
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-install">
                                <i class="fas fa-download me-2"></i>Importar Pasos
                            </button>
                        </div>
                    </form>
                    
                <?php break; case 'finalizar': ?>
                    <h3><i class="fas fa-check-circle me-2"></i>Instalación Completada</h3>
                    <p class="text-muted">¡El sistema se ha instalado exitosamente!</p>
                    
                    <div class="alert alert-success">
                        <h6><i class="fas fa-thumbs-up me-2"></i>¡Felicitaciones!</h6>
                        <p class="mb-0">El Sistema de Auditorías SEO está listo para usar.</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-tachometer-alt fa-3x text-primary mb-3"></i>
                                    <h5>Acceder al Sistema</h5>
                                    <p class="text-muted">Inicia sesión y comienza a gestionar auditorías.</p>
                                    <a href="index.php" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Ir al Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-book fa-3x text-info mb-3"></i>
                                    <h5>Documentación</h5>
                                    <p class="text-muted">Consulta la documentación de la base de datos.</p>
                                    <a href="documentacion_base_datos.md" class="btn btn-info" target="_blank">
                                        <i class="fas fa-external-link-alt me-2"></i>Ver Documentación
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-shield-alt me-2"></i>
                        <strong>Importante:</strong> Por seguridad, elimina o renombra el archivo <code>install.php</code> 
                        después de completar la instalación.
                    </div>
                    
                <?php break; endswitch; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación de formularios
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
                    }
                });
            });
            
            // Validación de contraseñas
            const password = document.getElementById('password');
            const confirmarPassword = document.getElementById('confirmar_password');
            
            if (password && confirmarPassword) {
                function validarPasswords() {
                    if (password.value !== confirmarPassword.value) {
                        confirmarPassword.setCustomValidity('Las contraseñas no coinciden');
                    } else {
                        confirmarPassword.setCustomValidity('');
                    }
                }
                
                password.addEventListener('input', validarPasswords);
                confirmarPassword.addEventListener('input', validarPasswords);
            }
        });
    </script>
</body>
</html>