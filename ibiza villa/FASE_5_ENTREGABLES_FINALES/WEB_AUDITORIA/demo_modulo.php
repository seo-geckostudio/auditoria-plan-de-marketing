<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo - Módulo Brief del Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/print.css">
</head>
<body style="background: #f5f5f5;">

<div class="container-fluid p-4">
    <div class="alert alert-info mb-4">
        <h4><i class="fas fa-info-circle"></i> Demo - Módulo Brief del Cliente (m1.1)</h4>
        <p class="mb-0">
            Esta página muestra cómo funciona un módulo completo del sistema modular.
            El módulo carga datos desde <code>data/fase1/brief_cliente.json</code> y los renderiza usando
            <code>modulos/fase1_preparacion/00_brief_cliente.php</code>
        </p>
    </div>

    <?php
    // Incluir el ModuleLoader
    require_once 'includes/module_loader.php';

    // Inicializar el loader
    $loader = new ModuleLoader('./config/');

    // Obtener configuración
    $configuracionCliente = $loader->obtenerConfiguracionCliente();

    // Verificar si hay errores
    if ($loader->tieneErrores()) {
        echo '<div class="alert alert-danger">';
        echo '<h5>Errores detectados:</h5>';
        echo '<ul>';
        foreach ($loader->obtenerErrores() as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    // Renderizar el módulo m1.1 (Brief del Cliente)
    echo $loader->renderizarModulo('m1.1');
    ?>

    <div class="alert alert-success mt-4">
        <h5><i class="fas fa-check-circle"></i> ¿Cómo funciona?</h5>
        <ol class="mb-0">
            <li><strong>ModuleLoader</strong> lee la configuración de <code>config/configuracion_cliente.json</code></li>
            <li>Busca el módulo <code>m1.1</code> en <code>config/modulos_disponibles.json</code></li>
            <li>Carga los datos desde <code>data/fase1/brief_cliente.json</code></li>
            <li>Incluye el archivo PHP <code>modulos/fase1_preparacion/00_brief_cliente.php</code></li>
            <li>El módulo PHP recibe <code>$datosModulo</code> y <code>$configuracionCliente</code> como variables</li>
            <li>Renderiza el HTML usando los datos JSON</li>
        </ol>
    </div>

    <div class="text-center mt-4">
        <a href="test_module_loader.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Volver al Test del Sistema
        </a>
        <a href="index.html" class="btn btn-secondary">
            <i class="fas fa-home"></i> Ver Auditoría Completa
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
