@echo off
echo Iniciando servidor para Auditoria Web...
echo.
echo Servidor corriendo en: http://localhost:8000
echo Presiona Ctrl+C para detener el servidor
echo.
cd /d "%~dp0"
"..\..\..\..\php\php.exe" -S localhost:8000
