@echo off
echo ========================================
echo   RESTAURAR PROYECTO AUDITORIA SEO
echo ========================================
echo.

echo Este script restaurara el proyecto completo desde un backup.
echo.
echo REQUISITOS PREVIOS:
echo   [1] Git instalado: git --version
echo   [2] Node.js instalado: node --version
echo   [3] PHP instalado: php --version
echo   [4] Claude Code instalado
echo.
echo Verificando requisitos...

git --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Git no esta instalado
    echo Descargar desde: https://git-scm.com/download/win
    pause
    exit /b
)

node --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Node.js no esta instalado
    echo Descargar desde: https://nodejs.org/
    pause
    exit /b
)

php --version >nul 2>&1
if errorlevel 1 (
    echo ADVERTENCIA: PHP no esta instalado
    echo El proyecto incluye PHP portable, pero se recomienda instalarlo
    echo Descargar desde: https://windows.php.net/download/
)

echo.
echo Requisitos verificados: OK
echo.

SET /P BACKUP_ZIP="Ruta completa del archivo ZIP de backup: "

echo.
echo Verificando archivo...
if not exist "%BACKUP_ZIP%" (
    echo ERROR: Archivo no encontrado: %BACKUP_ZIP%
    echo.
    echo Asegurate de escribir la ruta completa, ejemplo:
    echo C:\Users\Usuario\Downloads\backup_proyecto_auditoria_20251017.zip
    pause
    exit /b
)

echo Archivo encontrado: OK
echo.

echo [1/7] Creando estructura de directorios...
if not exist "C:\ai" mkdir C:\ai
mkdir "C:\ai\temp_restore"

echo.
echo [2/7] Extrayendo backup...
echo   Esto puede tardar unos minutos...
powershell -Command "Expand-Archive -Path '%BACKUP_ZIP%' -DestinationPath 'C:\ai\temp_restore' -Force"

echo.
echo [3/7] Restaurando proyecto...
if exist "C:\ai\investigacionauditoria programacion" (
    echo ADVERTENCIA: Ya existe un proyecto en C:\ai\investigacionauditoria programacion
    SET /P OVERWRITE="Sobrescribir? (S/N): "
    if /I not "%OVERWRITE%"=="S" (
        echo Cancelando restauracion...
        rmdir /S /Q "C:\ai\temp_restore"
        pause
        exit /b
    )
    rmdir /S /Q "C:\ai\investigacionauditoria programacion"
)

move "C:\ai\temp_restore\proyecto" "C:\ai\investigacionauditoria programacion"
echo   - Proyecto restaurado: OK

echo.
echo [4/7] Restaurando configuracion Claude Code...
if exist "C:\ai\temp_restore\claude_config" (
    xcopy "C:\ai\temp_restore\claude_config\.claude" "%USERPROFILE%\.claude" /E /H /I /Y
    echo   - MCP config: OK
    echo   - Conversaciones: OK
) else (
    echo   - No se encontro configuracion Claude Code en el backup
)

echo.
echo [5/7] Restaurando configuracion Claude Desktop (si existe)...
if exist "C:\ai\temp_restore\claude_desktop" (
    xcopy "C:\ai\temp_restore\claude_desktop\Claude" "%APPDATA%\Claude" /E /H /I /Y
    echo   - Claude Desktop config: OK
) else (
    echo   - No se encontro configuracion Claude Desktop (OK)
)

echo.
echo [6/7] Instalando dependencias npm...
cd "C:\ai\investigacionauditoria programacion"
call npm install
if errorlevel 1 (
    echo ADVERTENCIA: Hubo errores al instalar dependencias
    echo Puedes intentar manualmente: npm install --legacy-peer-deps
)

echo.
echo [7/7] Limpiando archivos temporales...
rmdir /S /Q "C:\ai\temp_restore"

echo.
echo ========================================
echo   RESTAURACION COMPLETADA
echo ========================================
echo.
echo Proyecto restaurado en: C:\ai\investigacionauditoria programacion
echo.
echo SIGUIENTES PASOS:
echo.
echo   1. Verificar base de datos:
echo      cd "C:\ai\investigacionauditoria programacion\ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
echo      php check_database.php
echo.
echo   2. Iniciar servidor:
echo      iniciar_sistema.bat
echo.
echo   3. Abrir en navegador:
echo      http://localhost:8000
echo.
echo   4. Ejecutar tests (opcional):
echo      npm test
echo.
echo   5. Abrir Claude Code:
echo      - File ^> Open Folder
echo      - Seleccionar: C:\ai\investigacionauditoria programacion
echo      - Verificar que reconoce CLAUDE.md y MCP servers
echo.
pause
