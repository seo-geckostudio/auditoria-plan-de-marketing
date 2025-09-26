@echo off
echo ========================================
echo    SISTEMA DE AUDITORIA SEO
echo ========================================
echo.
echo Iniciando servidor PHP en localhost:8000...
echo.

REM Cambiar al directorio del proyecto
cd /d "%~dp0"

REM Verificar que PHP existe
if not exist "php\php.exe" (
    echo ERROR: No se encontro PHP en la carpeta php\
    echo Por favor, asegurate de que PHP este instalado en la carpeta php\
    pause
    exit /b 1
)

REM Verificar que la base de datos existe
if not exist "data\auditoria_seo.sqlite" (
    echo AVISO: No se encontro la base de datos. Ejecutando instalacion...
    php\php.exe install.php
    if errorlevel 1 (
        echo ERROR: Fallo la instalacion de la base de datos
        pause
        exit /b 1
    )
)

echo Servidor iniciado correctamente!
echo.
echo Accede al sistema en: http://localhost:8000
echo.
echo Para detener el servidor, presiona Ctrl+C
echo ========================================
echo.

REM Iniciar el servidor PHP
php\php.exe -S localhost:8000

echo.
echo Servidor detenido.
pause