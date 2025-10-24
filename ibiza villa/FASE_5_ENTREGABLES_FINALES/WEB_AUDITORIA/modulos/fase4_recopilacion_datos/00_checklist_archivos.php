<?php
/**
 * Módulo: Checklist de Archivos y Export

aciones (m4.1)
 * Fase: 4 - Recopilación de Datos
 *
 * Este módulo muestra todos los archivos CSV/JSON necesarios para la auditoría,
 * organizados por herramienta, con estado, instrucciones y links.
 */

// Cargar datos del JSON
$jsonPath = __DIR__ . '/../../data/fase4/checklist_archivos.json';
$jsonContent = file_get_contents($jsonPath);
$datosModulo = json_decode($jsonContent, true);

$categorias = $datosModulo['categorias'] ?? [];
$resumen = $datosModulo['resumen'] ?? [];
$herramientas = $datosModulo['herramientas_requeridas'] ?? [];
$notas = $datosModulo['notas_importantes'] ?? [];
?>

<div class="audit-page checklist-archivos-page">

    <!-- HEADER -->
    <div class="page-header" style="background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); color: white; padding: 40px; border-radius: 12px; margin-bottom: 40px;">
        <h1 class="page-title" style="color: white; margin: 0 0 10px 0;">
            <?php echo htmlspecialchars($datosModulo['titulo']); ?>
        </h1>
        <p class="page-subtitle" style="color: white; opacity: 0.95; margin: 0; font-size: 1.1rem;">
            <?php echo htmlspecialchars($datosModulo['subtitulo']); ?>
        </p>
        <div class="page-date" style="color: white; margin-top: 15px; opacity: 0.9;">
            📅 Última verificación: <?php echo htmlspecialchars($datosModulo['fecha_verificacion']); ?>
        </div>
    </div>

    <!-- RESUMEN GENERAL -->
    <div class="resumen-archivos" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #2d3748; font-size: 1.5rem;">📊 Resumen General</h2>

        <div class="progress-stats" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 25px 0;">
            <div class="stat-card" style="background: linear-gradient(135deg, #88B04B 0%, #6d8f3c 100%); padding: 20px; border-radius: 10px; text-align: center; color: white;">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700;"><?php echo $resumen['total_archivos']; ?></div>
                <div class="stat-label" style="font-size: 0.9rem; opacity: 0.95;">Total Archivos</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); padding: 20px; border-radius: 10px; text-align: center; color: white;">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700;"><?php echo $resumen['completados']; ?></div>
                <div class="stat-label" style="font-size: 0.9rem; opacity: 0.95;">Completados ✓</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 20px; border-radius: 10px; text-align: center; color: white;">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700;"><?php echo $resumen['pendientes']; ?></div>
                <div class="stat-label" style="font-size: 0.9rem; opacity: 0.95;">Pendientes ⏳</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 20px; border-radius: 10px; text-align: center; color: white;">
                <div class="stat-value" style="font-size: 2.5rem; font-weight: 700;"><?php echo $resumen['porcentaje_completado']; ?>%</div>
                <div class="stat-label" style="font-size: 0.9rem; opacity: 0.95;">Progreso</div>
            </div>
        </div>

        <div class="progress-bar-container" style="background: #e5e7eb; border-radius: 10px; height: 20px; overflow: hidden; margin-top: 20px;">
            <div class="progress-bar-fill" style="background: linear-gradient(90deg, #88B04B 0%, #6d8f3c 100%); height: 100%; width: <?php echo $resumen['porcentaje_completado']; ?>%; transition: width 0.5s ease;"></div>
        </div>
    </div>

    <!-- CATEGORÍAS DE ARCHIVOS -->
    <?php foreach ($categorias as $index => $categoria): ?>
    <div class="categoria-archivos" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

        <div class="categoria-header" style="margin-bottom: 25px;">
            <h2 style="color: #2d3748; margin: 0 0 10px 0; font-size: 1.6rem;">
                <?php echo $categoria['nombre']; ?>
            </h2>
            <p style="color: #6b7280; margin: 0 0 15px 0;">
                <?php echo htmlspecialchars($categoria['descripcion']); ?>
            </p>
            <?php if ($categoria['herramienta_url']): ?>
            <a href="<?php echo htmlspecialchars($categoria['herramienta_url']); ?>" target="_blank"
               style="display: inline-block; background: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;">
                🔗 Abrir Herramienta
            </a>
            <?php endif; ?>
        </div>

        <div class="archivos-tabla" style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; border: 1px solid #e5e7eb; border-radius: 8px;">
                <thead>
                    <tr style="background: #f9fafb;">
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600; width: 40px;">Estado</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600;">Archivo</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600;">Descripción</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600;">Columnas Clave</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600; width: 100px;">Prioridad</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid #e5e7eb; color: #374151; font-weight: 600; width: 300px;">Instrucciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categoria['items'] as $item): ?>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 15px; text-align: center;">
                            <?php if ($item['estado'] === 'completado'): ?>
                                <span style="font-size: 1.5rem;" title="Completado">✅</span>
                            <?php else: ?>
                                <span style="font-size: 1.5rem;" title="Pendiente">⏳</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 15px;">
                            <strong style="color: #1f2937; display: block; margin-bottom: 4px;">
                                <?php echo htmlspecialchars($item['archivo']); ?>
                            </strong>
                            <small style="color: #6b7280;">
                                📁 <?php echo htmlspecialchars($item['ruta_esperada']); ?>
                            </small>
                            <?php if ($item['filas_aproximadas']): ?>
                            <br><small style="color: #9ca3af;">
                                ~<?php echo number_format($item['filas_aproximadas']); ?> filas
                            </small>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 15px; color: #4b5563;">
                            <?php echo htmlspecialchars($item['descripcion']); ?>
                            <?php if ($item['fecha_obtencion']): ?>
                            <br><small style="color: #10b981; font-weight: 600;">
                                ✓ Obtenido: <?php echo $item['fecha_obtencion']; ?>
                            </small>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                <?php foreach (array_slice($item['columnas_clave'], 0, 3) as $col): ?>
                                <span style="background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; font-family: monospace;">
                                    <?php echo htmlspecialchars($col); ?>
                                </span>
                                <?php endforeach; ?>
                                <?php if (count($item['columnas_clave']) > 3): ?>
                                <span style="color: #6b7280; font-size: 0.75rem;">
                                    +<?php echo count($item['columnas_clave']) - 3; ?> más
                                </span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="padding: 15px;">
                            <?php
                            $prioridadColors = [
                                'alta' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                'media' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                'baja' => ['bg' => '#dbeafe', 'text' => '#1e40af']
                            ];
                            $colors = $prioridadColors[$item['prioridad']] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            ?>
                            <span style="background: <?php echo $colors['bg']; ?>; color: <?php echo $colors['text']; ?>; padding: 4px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                <?php echo htmlspecialchars($item['prioridad']); ?>
                            </span>
                        </td>
                        <td style="padding: 15px; font-size: 0.85rem; color: #4b5563; line-height: 1.6;">
                            <?php echo htmlspecialchars($item['instrucciones']); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- NOTAS IMPORTANTES -->
    <div class="notas-importantes" style="background: #fffbeb; border-left: 5px solid #f59e0b; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
        <h3 style="margin-top: 0; color: #92400e; display: flex; align-items: center; gap: 10px;">
            ⚠️ Notas Importantes
        </h3>
        <ul style="margin: 15px 0 0 0; padding-left: 20px; color: #78350f;">
            <?php foreach ($notas as $nota): ?>
            <li style="margin-bottom: 8px;"><?php echo htmlspecialchars($nota); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- HERRAMIENTAS REQUERIDAS -->
    <div class="herramientas-requeridas" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #2d3748; font-size: 1.5rem;">🛠️ Herramientas Requeridas</h2>

        <div class="herramientas-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px;">
            <?php foreach ($herramientas as $key => $herramienta): ?>
            <div class="herramienta-card" style="background: #f9fafb; border: 2px solid #e5e7eb; border-radius: 10px; padding: 20px;">
                <h4 style="margin: 0 0 12px 0; color: #1f2937; text-transform: capitalize;">
                    <?php echo str_replace('_', ' ', $key); ?>
                </h4>
                <div style="margin-bottom: 8px;">
                    <strong style="color: #6b7280; font-size: 0.85rem;">Tipo de cuenta:</strong>
                    <span style="color: #374151; margin-left: 8px;"><?php echo htmlspecialchars($herramienta['tipo_cuenta']); ?></span>
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: #6b7280; font-size: 0.85rem;">Costo:</strong>
                    <span style="color: #374151; margin-left: 8px;"><?php echo htmlspecialchars($herramienta['creditos_necesarios']); ?></span>
                </div>
                <a href="<?php echo htmlspecialchars($herramienta['url']); ?>" target="_blank"
                   style="display: inline-block; background: #88B04B; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;">
                    Visitar →
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<style>
.checklist-archivos-page {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.checklist-archivos-page a:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

.checklist-archivos-page table {
    font-size: 0.9rem;
}

.checklist-archivos-page tbody tr:hover {
    background: #f9fafb;
}

@media print {
    .checklist-archivos-page a {
        color: #3b82f6;
        text-decoration: underline;
    }
}
</style>
