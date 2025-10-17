<?php
/**
 * Sistema de Auditoría SEO Modular
 * Versión: 2.0 - Sistema Modular
 * Proyecto: Ibiza Villa
 *
 * Este archivo reemplaza al index.html estático con un sistema modular dinámico
 * que carga módulos según la configuración del cliente.
 */

// Incluir el ModuleLoader
require_once 'includes/module_loader.php';

// Inicializar el loader
$loader = new ModuleLoader('./config/');

// Obtener configuración
$config = $loader->obtenerConfiguracionCliente();
$proyecto = $config['proyecto'] ?? [];
$stats = $loader->calcularEstadisticas();
$fases = $loader->obtenerModulosPorFase();

// Verificar si hay errores críticos
if ($loader->tieneErrores()) {
    die('<div style="padding: 40px; background: #fee; border: 2px solid #c00; color: #600;">
        <h2>Error en el Sistema Modular</h2>
        <ul>' . implode('', array_map(function($e) { return '<li>' . htmlspecialchars($e) . '</li>'; }, $loader->obtenerErrores())) . '</ul>
        </div>');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Auditoría SEO — <?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/print.css" media="print" />
  <link rel="stylesheet" href="css/admin-panel.css" />
  <link rel="stylesheet" href="css/module-system.css" />
  <!-- Chart.js para gráficas profesionales -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <!-- Scripts del sistema -->
  <script defer src="js/data-loader.js"></script>
  <script defer src="js/image-checker.js"></script>
  <script defer src="js/admin-panel.js"></script>
  <script defer src="js/app.js"></script>
</head>
<body>

  <!-- Sidebar de navegación -->
  <aside class="sidebar" aria-label="Menú lateral">
    <div class="brand"><?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?> — Auditoría SEO</div>
    <nav class="nav">
      <ul>
        <li><a href="#portada">Portada</a></li>
        <li><a href="#indice">Índice General</a></li>

        <?php
        // Generar navegación dinámica por fases
        $nombresFases = [
            0 => 'Marketing Digital',
            1 => 'Preparación',
            2 => 'Keyword Research',
            3 => 'Arquitectura',
            4 => 'Situación Actual',
            5 => 'Análisis de Demanda',
            6 => 'SEO On-Page',
            7 => 'SEO Off-Page',
            8 => 'SEO Moderno',
            9 => 'Entregables Finales'
        ];

        foreach ($fases as $numFase => $fase):
            $nombreFase = $nombresFases[$numFase] ?? $fase['nombre'];
        ?>
        <li class="nav-section">
          <button class="section-toggle" data-section="fase-<?php echo $numFase; ?>">
            <span class="section-icon">▼</span>
            <span class="section-title"><?php echo $numFase; ?>. <?php echo htmlspecialchars($nombreFase); ?></span>
          </button>
          <ul class="subsection-list" id="subsection-fase-<?php echo $numFase; ?>">
            <?php foreach ($fase['modulos'] as $modulo): ?>
            <li>
              <a href="#modulo-<?php echo htmlspecialchars($modulo['id']); ?>">
                <?php echo htmlspecialchars($modulo['nombre']); ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php endforeach; ?>

        <!-- Enlace a versión HTML estática (respaldo) -->
        <li class="nav-section">
          <a href="index.html" class="nav-link-static" style="color: #999; font-size: 0.9em;">
            <span class="section-icon">📄</span>
            Ver versión estática
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Contenido principal -->
  <main class="main-content content">

    <!-- Panel de administración (solo visible con Ctrl+Shift+A) -->
    <div id="admin-panel" class="admin-panel" style="display: none;">
      <div class="admin-header">
        <h3>Panel de Administración - Sistema Modular</h3>
        <button class="admin-close" onclick="document.getElementById('admin-panel').style.display='none'">×</button>
      </div>
      <div class="admin-body">
        <div class="admin-stats">
          <div class="stat-item">
            <strong>Módulos Activos:</strong>
            <span><?php echo $stats['total_modulos']; ?></span>
          </div>
          <div class="stat-item">
            <strong>Páginas Totales:</strong>
            <span><?php echo $stats['total_paginas']; ?></span>
          </div>
          <div class="stat-item">
            <strong>Tiempo Estimado:</strong>
            <span><?php echo $stats['total_horas']; ?>h</span>
          </div>
        </div>
        <div class="admin-actions">
          <a href="test_module_loader.php" class="btn-admin" target="_blank">Ver Test del Sistema</a>
          <a href="demo_modulo.php" class="btn-admin" target="_blank">Ver Demo de Módulo</a>
          <a href="index.html" class="btn-admin">Versión HTML Estática</a>
        </div>
      </div>
    </div>

    <!-- PORTADA -->
    <section id="portada" class="audit-page cover-page">
      <div class="cover-content">
        <div class="cover-logo">
          <img src="assets/logo_ibizavilla.png" alt="<?php echo htmlspecialchars($proyecto['nombre'] ?? 'Logo'); ?>"
               onerror="this.style.display='none'" />
        </div>
        <h1 class="cover-title">Auditoría SEO</h1>
        <h2 class="cover-subtitle"><?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?></h2>
        <div class="cover-meta">
          <div class="cover-date">
            <?php
            $fecha = $proyecto['fecha_inicio'] ?? date('d/m/Y');
            echo htmlspecialchars($fecha);
            ?>
          </div>
          <div class="cover-consultant">
            Consultor SEO: <?php echo htmlspecialchars($config['equipo']['consultor_principal']['nombre'] ?? 'Consultor'); ?>
          </div>
        </div>
        <div class="cover-footer">
          <p class="system-badge">
            🧩 Generado con Sistema Modular v2.0 |
            <?php echo $stats['total_modulos']; ?> módulos |
            <?php echo $stats['total_paginas']; ?> páginas
          </p>
        </div>
      </div>
    </section>

    <!-- ÍNDICE GENERAL -->
    <section id="indice" class="audit-page index-page">
      <div class="page-header">
        <h1 class="page-title">Índice General</h1>
        <p class="page-subtitle">Estructura de la auditoría SEO</p>
      </div>
      <div class="page-body">
        <div class="index-content">
          <?php foreach ($fases as $numFase => $fase): ?>
          <div class="index-section">
            <h2 class="index-section-title">
              Fase <?php echo $numFase; ?>: <?php echo htmlspecialchars($nombresFases[$numFase] ?? $fase['nombre']); ?>
            </h2>
            <ul class="index-list">
              <?php foreach ($fase['modulos'] as $modulo): ?>
              <li class="index-item">
                <a href="#modulo-<?php echo htmlspecialchars($modulo['id']); ?>">
                  <span class="index-number"><?php echo htmlspecialchars($modulo['id']); ?></span>
                  <span class="index-title"><?php echo htmlspecialchars($modulo['nombre']); ?></span>
                  <span class="index-pages"><?php echo $modulo['paginas_generadas']; ?> pág.</span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Auditoría SEO | <?php echo date('Y'); ?></div>
        <div class="footer-right">Página 2</div>
      </div>
    </section>

    <!-- RENDERIZAR TODOS LOS MÓDULOS ACTIVOS -->
    <?php
    $paginaActual = 3; // La portada e índice ya ocupan 2 páginas

    foreach ($fases as $numFase => $fase):
        // Separador de fase (opcional, solo si quieres visual entre fases)
        ?>
        <div id="fase-<?php echo $numFase; ?>" class="fase-separator" style="page-break-before: always; padding: 40px; background: linear-gradient(135deg, #54a34a 0%, #6ab85e 100%); color: white; text-align: center;">
            <h1 style="font-size: 3em; margin: 0;">Fase <?php echo $numFase; ?></h1>
            <h2 style="font-size: 2em; margin: 20px 0 0 0; font-weight: 400;">
                <?php echo htmlspecialchars($nombresFases[$numFase] ?? $fase['nombre']); ?>
            </h2>
            <p style="margin-top: 20px; font-size: 1.2em; opacity: 0.9;">
                <?php echo count($fase['modulos']); ?> módulos |
                <?php echo array_sum(array_column($fase['modulos'], 'paginas_generadas')); ?> páginas
            </p>
        </div>
        <?php

        foreach ($fase['modulos'] as $modulo):
            // Ancla para navegación
            echo '<div id="modulo-' . htmlspecialchars($modulo['id']) . '"></div>';

            // Renderizar el módulo
            echo $loader->renderizarModulo($modulo['id']);

            $paginaActual += $modulo['paginas_generadas'];
        endforeach;
    endforeach;
    ?>

    <!-- PÁGINA FINAL -->
    <section class="audit-page final-page" style="page-break-before: always;">
      <div class="cover-content">
        <h1 class="cover-title">Gracias</h1>
        <h2 class="cover-subtitle">¿Alguna pregunta?</h2>
        <div class="cover-meta" style="margin-top: 60px;">
          <div class="contact-info">
            <p><strong><?php echo htmlspecialchars($config['equipo']['consultor_principal']['nombre'] ?? 'Consultor SEO'); ?></strong></p>
            <p><?php echo htmlspecialchars($config['equipo']['consultor_principal']['email'] ?? ''); ?></p>
          </div>
        </div>
        <div class="cover-footer" style="margin-top: 100px;">
          <p class="system-badge">
            🧩 Sistema Modular de Auditoría SEO v2.0<br>
            Desarrollado con <?php echo $stats['total_modulos']; ?> módulos personalizados<br>
            <?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?> — <?php echo date('Y'); ?>
          </p>
        </div>
      </div>
    </section>

  </main>

  <!-- Scripts adicionales -->
  <script>
  // Atajar Ctrl+Shift+A para mostrar panel de administración
  document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.shiftKey && e.key === 'A') {
      e.preventDefault();
      const panel = document.getElementById('admin-panel');
      panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
    }
  });

  // Numeración automática de páginas en impresión
  window.addEventListener('DOMContentLoaded', function() {
    const pageNumbers = document.querySelectorAll('.page-number');
    pageNumbers.forEach((el, index) => {
      el.textContent = index + 1;
    });
  });
  </script>

</body>
</html>
