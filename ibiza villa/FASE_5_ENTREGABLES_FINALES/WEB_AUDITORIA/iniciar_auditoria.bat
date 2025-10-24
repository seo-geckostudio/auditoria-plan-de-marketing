@echo off
chcp 65001 >nul
title Auditoría SEO - Ibiza Villa
color 0A

cls
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.
echo       █████╗ ██╗   ██╗██████╗ ██╗████████╗ ██████╗ ██████╗ ██╗ █████╗
echo      ██╔══██╗██║   ██║██╔══██╗██║╚══██╔══╝██╔═══██╗██╔══██╗██║██╔══██╗
echo      ███████║██║   ██║██║  ██║██║   ██║   ██║   ██║██████╔╝██║███████║
echo      ██╔══██║██║   ██║██║  ██║██║   ██║   ██║   ██║██╔══██╗██║██╔══██║
echo      ██║  ██║╚██████╔╝██████╔╝██║   ██║   ╚██████╔╝██║  ██║██║██║  ██║
echo      ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ ╚═╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚═╝╚═╝  ╚═╝
echo.
echo                          AUDITORÍA SEO PROFESIONAL
echo                               Cliente: Ibiza Villa
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.

:: Cambiar al directorio del script
cd /d "%~dp0"

:: Verificar si existe PHP
echo [1/4] Verificando instalación de PHP...
if not exist "..\..\..\..\php\php.exe" (
    color 0C
    echo.
    echo ❌ ERROR: No se encontró PHP en la ruta esperada.
    echo.
    echo    Ruta buscada: ..\..\..\..\php\php.exe
    echo.
    echo    Por favor, asegúrate de que el servidor PHP portable esté en la carpeta 'php'
    echo    o instala PHP en tu sistema: https://windows.php.net/download/
    echo.
    pause
    exit /b 1
)
echo    ✓ PHP encontrado correctamente
timeout /t 1 /nobreak >nul

:: Verificar puerto disponible
echo.
echo [2/4] Verificando disponibilidad del puerto 8095...
netstat -ano | findstr :8095 >nul
if %errorlevel% equ 0 (
    echo.
    echo ⚠ ADVERTENCIA: El puerto 8095 ya está en uso.
    echo.
    echo    El sistema intentará usar el puerto 8096 como alternativa.
    echo.
    set PORT=8096
) else (
    echo    ✓ Puerto 8095 disponible
    set PORT=8095
)
timeout /t 1 /nobreak >nul

:: Iniciar servidor
echo.
echo [3/4] Iniciando servidor web local...
echo    ✓ Servidor iniciándose en puerto %PORT%
timeout /t 2 /nobreak >nul

:: Abrir navegador automáticamente
echo.
echo [4/4] Abriendo navegador web...
start http://localhost:%PORT%
echo    ✓ Sistema listo
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.
echo    🌐 URL del sistema: http://localhost:%PORT%
echo.
echo    📊 Navegación disponible:
echo       • Fase 0: Marketing Digital (Competencia, Buyer Personas)
echo       • Fase 1: Preparación (Brief, Checklist, Roadmap)
echo       • Fase 2: Keyword Research (Análisis completo)
echo       • Fase 3: Arquitectura Web
echo       • Fase 5: Entregables Finales
echo.
echo    📁 Recursos adicionales disponibles en carpeta 'recursos/'
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.
echo    ⚠️  IMPORTANTE: NO CIERRES ESTA VENTANA
echo        El servidor se detendrá si cierras esta ventana.
echo.
echo    ⏹  Para detener el servidor: Presiona Ctrl+C o cierra esta ventana
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.

:: Iniciar servidor PHP
"..\..\..\..\php\php.exe" -S localhost:%PORT%

:: Si el servidor se detiene
cls
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.
echo    ✓ Servidor detenido correctamente
echo.
echo    Gracias por usar el Sistema de Auditoría SEO
echo.
echo ═══════════════════════════════════════════════════════════════════
echo.
timeout /t 3 /nobreak >nul
