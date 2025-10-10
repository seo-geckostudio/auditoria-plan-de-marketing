@echo off
echo ========================================
echo PRUEBA DE CONEXION - SERVIDOR SCREAMING FROG
echo IP: 192.168.1.100
echo ========================================
echo.

echo Probando conectividad de red...
ping -n 4 192.168.1.100

echo.
echo Probando acceso a carpeta compartida...
echo Intentando acceder a: \\192.168.1.100\temporal seo
echo.

dir "\\192.168.1.100\temporal seo" 2>nul
if %errorlevel%==0 (
    echo.
    echo ✓ CONEXION EXITOSA
    echo ==================
    echo - Servidor accesible
    echo - Carpeta compartida funcional
    echo - Listo para descargar archivos CSV
    echo.
    echo Ejecuta: python screaming_frog_remote_export.py
) else (
    echo.
    echo ✗ ERROR DE CONEXION
    echo ===================
    echo La carpeta compartida no es accesible.
    echo.
    echo POSIBLES SOLUCIONES:
    echo 1. Verificar que el servidor este encendido
    echo 2. Configurar carpeta compartida en el servidor:
    echo    - Crear: D:\temporal seo
    echo    - Compartir como: "temporal seo"
    echo    - Permisos: Lectura/Escritura
    echo 3. Verificar firewall y permisos de red
    echo 4. Probar con credenciales: net use "\\192.168.1.100\temporal seo"
)

echo.
echo Presiona cualquier tecla para continuar...
pause >nul