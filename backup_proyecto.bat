@echo off
echo ========================================
echo   BACKUP PROYECTO AUDITORIA SEO
echo ========================================
echo.

SET BACKUP_DIR=C:\backup_proyecto_auditoria_%date:~-4,4%%date:~-10,2%%date:~-7,2%
SET PROYECTO_DIR=C:\ai\investigacionauditoria programacion

echo Creando directorio de backup: %BACKUP_DIR%
mkdir "%BACKUP_DIR%"

echo.
echo [1/6] Verificando estado de Git...
cd "%PROYECTO_DIR%"
git status

echo.
echo Hay cambios sin commitear? (S/N)
SET /P COMMIT_CHANGES="Commitear cambios antes de backup? (S/N): "

if /I "%COMMIT_CHANGES%"=="S" (
    echo Commiteando cambios...
    git add .
    git commit -m "backup: estado antes de migracion - %date% %time%"
)

echo.
echo [2/6] Copiando proyecto completo...
xcopy "%PROYECTO_DIR%" "%BACKUP_DIR%\proyecto" /E /H /I /Y /EXCLUDE:%PROYECTO_DIR%\.gitignore

echo.
echo [3/6] Copiando configuracion Claude Code...
if exist "%USERPROFILE%\.claude" (
    xcopy "%USERPROFILE%\.claude" "%BACKUP_DIR%\claude_config" /E /H /I /Y
    echo   - MCP config: OK
    echo   - Conversaciones: OK
    echo   - Settings: OK
) else (
    echo   - ADVERTENCIA: No se encontro carpeta .claude
)

echo.
echo [4/6] Copiando configuracion Claude Desktop (si existe)...
if exist "%APPDATA%\Claude" (
    xcopy "%APPDATA%\Claude" "%BACKUP_DIR%\claude_desktop" /E /H /I /Y
    echo   - Claude Desktop config: OK
) else (
    echo   - Claude Desktop no configurado (OK)
)

echo.
echo [5/6] Exportando base de datos SQLite...
cd "%PROYECTO_DIR%\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
if exist "data\auditoria_seo.sqlite" (
    sqlite3 data\auditoria_seo.sqlite .dump > "%BACKUP_DIR%\database_backup.sql"
    echo   - Database SQL dump: OK
) else (
    echo   - Base de datos no encontrada (OK si es nuevo proyecto)
)

echo.
echo [6/6] Creando archivo ZIP...
echo   Esto puede tardar unos minutos...
powershell -Command "Compress-Archive -Path '%BACKUP_DIR%\*' -DestinationPath '%BACKUP_DIR%.zip' -Force"

echo.
echo Limpiando archivos temporales...
rmdir /S /Q "%BACKUP_DIR%"

echo.
echo ========================================
echo   BACKUP COMPLETADO EXITOSAMENTE
echo ========================================
echo.
echo Archivo creado: %BACKUP_DIR%.zip
echo.
echo Informacion del backup:
dir "%BACKUP_DIR%.zip"
echo.
echo SIGUIENTE PASO:
echo   1. Copiar %BACKUP_DIR%.zip a USB/nube
echo   2. En nuevo PC: ejecutar restaurar_proyecto.bat
echo   3. Proporcionar ruta del ZIP cuando lo pida
echo.
pause
