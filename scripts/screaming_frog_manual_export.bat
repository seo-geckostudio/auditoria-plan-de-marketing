@echo off
chcp 65001 >nul
echo.
echo 🕷️ SCREAMING FROG - EXPORTACIÓN RÁPIDA
echo =====================================
echo.
echo Este script te guiará para exportar RÁPIDAMENTE todos los datos necesarios
echo de Screaming Frog en castellano.
echo.
echo REQUISITOS PREVIOS:
echo ✅ Screaming Frog debe estar abierto
echo ✅ El crawl debe estar completado
echo ✅ Todas las pestañas deben estar cargadas
echo.
pause

:: Crear estructura de carpetas
echo 📁 Creando estructura de carpetas...
if not exist "datos_previos_a_la_auditoria\exports_csv\general" mkdir "datos_previos_a_la_auditoria\exports_csv\general"
if not exist "datos_previos_a_la_auditoria\exports_csv\seo_onpage" mkdir "datos_previos_a_la_auditoria\exports_csv\seo_onpage"
if not exist "datos_previos_a_la_auditoria\exports_csv\contenido" mkdir "datos_previos_a_la_auditoria\exports_csv\contenido"
if not exist "datos_previos_a_la_auditoria\exports_csv\arquitectura" mkdir "datos_previos_a_la_auditoria\exports_csv\arquitectura"
if not exist "datos_previos_a_la_auditoria\exports_csv\imagenes" mkdir "datos_previos_a_la_auditoria\exports_csv\imagenes"
if not exist "datos_previos_a_la_auditoria\graficos_visuales" mkdir "datos_previos_a_la_auditoria\graficos_visuales"

echo ✅ Carpetas creadas
echo.

echo 🚀 PROCESO DE EXPORTACIÓN RÁPIDA
echo ================================
echo.
echo Sigue estos pasos EN ORDEN en Screaming Frog:
echo.

echo 📊 PASO 1: DATOS GENERALES
echo ---------------------------
echo 1. Pestaña "Interno" ^> Botón derecho ^> "Exportar" ^> Guardar como: SF_internal_all.csv
echo 2. Pestaña "Códigos de respuesta" ^> "Exportar" ^> Guardar como: SF_response_codes.csv
echo.
pause

echo 📝 PASO 2: TÍTULOS DE PÁGINA
echo ------------------------------
echo 3. Pestaña "Títulos de página" ^> Subpestaña "Todos" ^> Exportar ^> SF_page_titles_all.csv
echo 4. Subpestaña "Faltantes" ^> Exportar ^> SF_page_titles_missing.csv
echo 5. Subpestaña "Duplicados" ^> Exportar ^> SF_page_titles_duplicate.csv
echo 6. Subpestaña "Muy largos" ^> Exportar ^> SF_page_titles_too_long.csv
echo 7. Subpestaña "Muy cortos" ^> Exportar ^> SF_page_titles_too_short.csv
echo.
pause

echo 📄 PASO 3: META DESCRIPTIONS
echo ------------------------------
echo 8. Pestaña "Descripciones meta" ^> Subpestaña "Todos" ^> Exportar ^> SF_meta_descriptions_all.csv
echo 9. Subpestaña "Faltantes" ^> Exportar ^> SF_meta_descriptions_missing.csv
echo 10. Subpestaña "Duplicados" ^> Exportar ^> SF_meta_descriptions_duplicate.csv
echo 11. Subpestaña "Muy largos" ^> Exportar ^> SF_meta_descriptions_too_long.csv
echo 12. Subpestaña "Muy cortos" ^> Exportar ^> SF_meta_descriptions_too_short.csv
echo.
pause

echo 🏷️ PASO 4: HEADERS (H1, H2)
echo -----------------------------
echo 13. Pestaña "H1" ^> Subpestaña "Todos" ^> Exportar ^> SF_h1_all.csv
echo 14. Subpestaña "Faltantes" ^> Exportar ^> SF_h1_missing.csv
echo 15. Subpestaña "Múltiples" ^> Exportar ^> SF_h1_multiple.csv
echo 16. Subpestaña "Duplicados" ^> Exportar ^> SF_h1_duplicate.csv
echo 17. Pestaña "H2" ^> Subpestaña "Todos" ^> Exportar ^> SF_h2_all.csv
echo.
pause

echo 📝 PASO 5: CONTENIDO
echo ---------------------
echo 18. Pestaña "Contenido" ^> Subpestaña "Duplicados cercanos" ^> Exportar ^> SF_content_duplicates.csv
echo 19. Subpestaña "Recuento de palabras" ^> Exportar ^> SF_word_count.csv
echo.
pause

echo 🖼️ PASO 6: IMÁGENES
echo --------------------
echo 20. Pestaña "Imágenes" ^> Subpestaña "Alt text faltante" ^> Exportar ^> SF_images_missing_alt.csv
echo 21. Subpestaña "Más de 100kb" ^> Exportar ^> SF_images_large.csv
echo.
pause

echo 🔗 PASO 7: ARQUITECTURA
echo ------------------------
echo 22. Pestaña "Enlaces internos" ^> Exportar ^> SF_internal_links.csv
echo 23. Pestaña "Páginas huérfanas" ^> Exportar ^> SF_orphan_pages.csv
echo.
pause

echo.
echo ✅ EXPORTACIÓN COMPLETADA
echo =========================
echo.
echo Todos los archivos CSV deben estar guardados en:
echo 📁 %CD%\datos_screaming_frog\exports_csv\
echo.
echo Los archivos exportados son:
dir /b datos_screaming_frog\exports_csv\*.csv 2>nul
echo.
echo 🎉 ¡Proceso completado! Ahora puedes procesar estos datos.
echo.
pause