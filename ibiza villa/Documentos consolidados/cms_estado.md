# Estado de CMS y PHP – Ibiza Villa

- Sistema: WordPress (sitio: Ibiza Villa)
- Estado PHP: Versión obsoleta (End Of Life). Riesgo de seguridad.
  - Acción recomendada: actualizar PHP a versión soportada (8.2/8.3) y validar compatibilidad de plugins/tema.
  - Revisar `php.ini` y extensiones necesarias; probar en entorno de staging.
- Estado WordPress: instalación desactualizada.
  - Acción recomendada: actualizar WordPress de 6.8.2 a 6.8.3.
  - Mantener temas al día; verificar integridad de WordPress.
- Seguridad: aplicar medidas críticas y mitigar vulnerabilidades.
  - Revisar plugins: actualizaciones pendientes y posibles vulnerabilidades.
  - Endurecer configuración (autenticación, permisos de archivos, backups regulares).
  - Considerar WP-CLI para ejecutar comprobaciones y actualizaciones controladas.
- Operativa y mantenimiento:
  - Copias de seguridad antes de cambios (ficheros y base de datos).
  - Crear punto de restauración y plan de rollback.

Fuente de hallazgos: Panel de gestión del sitio indicando “Outdated PHP version detected” y necesidad de actualizar WordPress; se recomienda “Mitigate vulnerabilities” y aplicar medidas críticas de seguridad.