<?php
/**
 * Sistema de Auditoría SEO Modular
 * Versión: 2.0 - Sistema Modular
 * Proyecto: Ibiza Villa
 *
 * Este archivo reemplaza al index.html estático con un sistema modular dinámico
 * que carga módulos según la configuración del cliente.
 */

// Habilitar reporte de errores para diagnóstico
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

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
  <!-- Fuentes Google: Roboto (corporativo Gecko Studio) + Hanken Grotesk (sistema) -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Hanken+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- CSS Sistema -->
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/print.css" media="print" />
  <link rel="stylesheet" href="css/admin-panel.css" />
  <link rel="stylesheet" href="css/module-system.css" />
  <!-- CSS Corporativo Gecko Studio (colores, tipografía, estilos de impresión) -->
  <link rel="stylesheet" href="css/gecko-corporate.css" />
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
        <li><a href="#documentos-descargables">Documentos Descargables</a></li>

        <!-- RESUMEN EJECUTIVO - DESTACADO -->
        <li class="nav-section nav-destacado">
          <a href="00_resumen_ejecutivo.php" target="_blank" class="btn-sidebar-cta">
            Resumen Ejecutivo
          </a>
        </li>

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
          <!-- CTA Resumen Ejecutivo -->
          <div style="margin: 30px 0 20px 0;">
            <a href="00_resumen_ejecutivo.php" target="_blank" class="btn-cta-primary">
              Ver Resumen Ejecutivo (Vista Rápida)
            </a>
          </div>

          <div style="text-align: center; margin-top: 30px;">
            <img src="assets/logo_gecko.svg" alt="Gecko Studio" style="width: 200px; height: auto; margin-bottom: 20px;">
            <p style="font-size: 0.85rem; color: #787878; margin: 0;">
              Sistema Profesional de Auditoría SEO
            </p>
            <p style="font-size: 0.85rem; color: #787878; margin-top: 5px;">
              <?php echo $stats['total_modulos']; ?> módulos | <?php echo $stats['total_paginas']; ?> páginas
            </p>
          </div>
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

    <!-- ACCESO RÁPIDO A DOCUMENTOS -->
    <section id="documentos-descargables" class="audit-page" style="page-break-before: always;">
      <div class="page-header">
        <h1 class="page-title">Acceso Rápido a Documentos</h1>
        <p class="page-subtitle">Documentación descargable para esta auditoría</p>
      </div>
      <div class="page-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">

          <!-- Documentos para el Cliente -->
          <div style="background: #f8fafc; border-left: 4px solid var(--brand-color); padding: 20px; border-radius: 8px;">
            <h3 style="color: var(--brand-color); margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
              <span>📄</span> Documentos para el Cliente
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/01_resumen_ejecutivo.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: var(--brand-color);">→</span> Resumen Ejecutivo (PDF)
                </a>
              </li>
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/03_plan_accion_seo.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: var(--brand-color);">→</span> Plan de Acción SEO (PDF)
                </a>
              </li>
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/00_presentacion_resultados.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: var(--brand-color);">→</span> Presentación de Resultados (PDF)
                </a>
              </li>
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/06_recursos_adicionales.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: var(--brand-color);">→</span> Recursos Adicionales
                </a>
              </li>
            </ul>
          </div>

          <!-- Documentos para el Equipo de Dev -->
          <div style="background: #f1f5f9; border-left: 4px solid #2563eb; padding: 20px; border-radius: 8px;">
            <h3 style="color: #2563eb; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
              <span>🔧</span> Documentos para el Equipo Dev
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/02_informe_tecnico.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: #2563eb;">→</span> Informe Técnico Completo (PDF)
                </a>
              </li>
              <li style="margin-bottom: 10px;">
                <a href="modulos/fase5_entregables_finales/04_sistema_mediciones.php" target="_blank" style="color: var(--text-color); text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  <span style="color: #2563eb;">→</span> Sistema de Mediciones y Tracking
                </a>
              </li>
            </ul>
          </div>

          <!-- CSV y Datos Exportables -->
          <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 20px; border-radius: 8px; grid-column: span 2;">
            <h3 style="color: #f59e0b; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
              <span>📊</span> CSV y Datos Exportables
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
              <div>
                <h4 style="font-size: 14px; color: #78350f; margin-bottom: 10px;">Google Search Console</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px;">
                  <li style="margin-bottom: 6px;">
                    <a href="datos/gsc_queries.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Queries (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/gsc_pages.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Pages (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/gsc_devices.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Devices (CSV)
                    </a>
                  </li>
                </ul>
              </div>
              <div>
                <h4 style="font-size: 14px; color: #78350f; margin-bottom: 10px;">Google Analytics 4</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px;">
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ga4_traffic.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Organic Traffic (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ga4_conversions.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Conversions (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ga4_landing_pages.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Landing Pages (CSV)
                    </a>
                  </li>
                </ul>
              </div>
              <div>
                <h4 style="font-size: 14px; color: #78350f; margin-bottom: 10px;">Ahrefs</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px;">
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ahrefs_keywords.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Organic Keywords (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ahrefs_backlinks.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Backlinks (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/ahrefs_anchors.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Anchor Texts (CSV)
                    </a>
                  </li>
                </ul>
              </div>
              <div>
                <h4 style="font-size: 14px; color: #78350f; margin-bottom: 10px;">Screaming Frog</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 13px;">
                  <li style="margin-bottom: 6px;">
                    <a href="datos/sf_internal_all.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> All Internal (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/sf_page_titles.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Page Titles (CSV)
                    </a>
                  </li>
                  <li style="margin-bottom: 6px;">
                    <a href="datos/sf_meta_description.csv" download style="color: var(--text-secondary); text-decoration: none;">
                      <span style="color: #f59e0b;">↓</span> Meta Descriptions (CSV)
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="page-footer">
        <div class="footer-left"><?php echo htmlspecialchars($proyecto['nombre'] ?? 'Proyecto'); ?></div>
        <div class="footer-center">Auditoría SEO | <?php echo date('Y'); ?></div>
        <div class="footer-right">Página 3</div>
      </div>
    </section>

    <!-- RENDERIZAR TODOS LOS MÓDULOS ACTIVOS -->
    <?php
    $paginaActual = 4; // La portada, índice y documentos ocupan 3 páginas

    foreach ($fases as $numFase => $fase):
        // Separador de fase (opcional, solo si quieres visual entre fases)
        ?>
        <div id="fase-<?php echo $numFase; ?>" class="fase-separator gecko-fase-separator" style="page-break-before: always;">
            <h1 class="fase-numero">Fase <?php echo $numFase; ?></h1>
            <h2 class="fase-nombre">
                <?php echo htmlspecialchars($nombresFases[$numFase] ?? $fase['nombre']); ?>
            </h2>
            <p class="fase-meta">
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
            Sistema Modular de Auditoría SEO v2.0<br>
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

    // =========================================================================
    // FIX: Force white text on all green backgrounds (Gecko Studio green #88B04B)
    // =========================================================================
    function fixGreenBackgroundTextColors() {
      const allElements = document.querySelectorAll('*');

      allElements.forEach(element => {
        const computed = window.getComputedStyle(element);
        const bgColor = computed.backgroundColor;
        const bgImage = computed.backgroundImage;

        // Check if element has green background (#88B04B = rgb(136, 176, 75))
        const hasGreenBg = bgColor.includes('136, 176, 75') ||
                          bgColor.includes('#88B04B') ||
                          bgImage.includes('88B04B') ||
                          bgImage.includes('136, 176, 75');

        if (hasGreenBg) {
          // Get current text color
          const textColor = computed.color;

          // Parse RGB values
          const rgb = textColor.match(/\d+/g);
          if (rgb) {
            const r = parseInt(rgb[0]);
            const g = parseInt(rgb[1]);
            const b = parseInt(rgb[2]);

            // Calculate luminance (dark colors have low luminance)
            const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

            // If text is dark (luminance < 0.6), force it to white
            if (luminance < 0.6) {
              element.style.color = '#ffffff';

              // Also fix child text elements
              const textElements = element.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, div, a, strong, em');
              textElements.forEach(child => {
                const childColor = window.getComputedStyle(child).color;
                const childRgb = childColor.match(/\d+/g);
                if (childRgb) {
                  const cr = parseInt(childRgb[0]);
                  const cg = parseInt(childRgb[1]);
                  const cb = parseInt(childRgb[2]);
                  const childLuminance = (0.299 * cr + 0.587 * cg + 0.114 * cb) / 255;
                  if (childLuminance < 0.6) {
                    child.style.color = '#ffffff';
                  }
                }
              });
            }
          }
        }
      });
    }

    // Run fix on page load
    fixGreenBackgroundTextColors();

    // Run fix again after a short delay to catch any dynamically loaded content
    setTimeout(fixGreenBackgroundTextColors, 500);
  });
  </script>

</body>
</html>
