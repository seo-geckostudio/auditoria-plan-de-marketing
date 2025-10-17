@echo off
echo ========================================
echo   BACKUP SIMPLIFICADO DEL PROYECTO
echo ========================================
echo.

SET BACKUP_NAME=backup_proyecto_%date:~-4,4%%date:~-10,2%%date:~-7,2%
SET PROYECTO_DIR=%cd%

echo [1/3] Commiteando cambios pendientes...
git add .
git commit -m "backup: estado antes de migracion %date% %time%"

echo.
echo [2/3] Creando archivo ZIP del proyecto...
echo (Esto puede tardar 1-2 minutos)
echo.

powershell -Command "Compress-Archive -Path '%PROYECTO_DIR%\*' -DestinationPath '%USERPROFILE%\Desktop\%BACKUP_NAME%.zip' -Force -CompressionLevel Optimal"

if errorlevel 1 (
    echo ERROR al crear ZIP en Desktop, intentando en Documentos...
    powershell -Command "Compress-Archive -Path '%PROYECTO_DIR%\*' -DestinationPath '%USERPROFILE%\Documents\%BACKUP_NAME%.zip' -Force -CompressionLevel Optimal"
)

echo.
echo [3/3] Copiando configuracion Claude Code...
if exist "%USERPROFILE%\.claude" (
    powershell -Command "Compress-Archive -Path '%USERPROFILE%\.claude\*' -DestinationPath '%USERPROFILE%\Desktop\claude_config_%date:~-4,4%%date:~-10,2%%date:~-7,2%.zip' -Force"
    if errorlevel 1 (
        powershell -Command "Compress-Archive -Path '%USERPROFILE%\.claude\*' -DestinationPath '%USERPROFILE%\Documents\claude_config_%date:~-4,4%%date:~-10,2%%date:~-7,2%.zip' -Force"
    )
    echo Claude config exportado
) else (
    echo No se encontro configuracion Claude
)

echo.
echo ========================================
echo   BACKUP COMPLETADO
echo ========================================
echo.
echo Archivos creados:
echo.
dir "%USERPROFILE%\Desktop\backup_proyecto_*.zip" 2>nul
dir "%USERPROFILE%\Desktop\claude_config_*.zip" 2>nul
dir "%USERPROFILE%\Documents\backup_proyecto_*.zip" 2>nul
dir "%USERPROFILE%\Documents\claude_config_*.zip" 2>nul
echo.
echo SIGUIENTE PASO:
echo   1. Copiar estos archivos ZIP a USB/nube
echo   2. En nuevo PC: usar restaurar_proyecto.bat
echo.
pause
