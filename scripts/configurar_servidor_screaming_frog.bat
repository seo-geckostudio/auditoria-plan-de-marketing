@echo off
echo ========================================
echo CONFIGURACION SERVIDOR SCREAMING FROG
echo IP: 192.168.1.100
echo ========================================
echo.

echo PASO 1: Configurar carpeta compartida en el servidor (192.168.1.100)
echo -----------------------------------------------------------------------
echo En el servidor de Screaming Frog, necesitas:
echo.
echo 1. Crear carpeta: D:\temporal seo
echo 2. Clic derecho en la carpeta ^> Propiedades ^> Compartir
echo 3. Compartir como: "temporal seo" 
echo 4. Permisos: Lectura/Escritura para tu usuario
echo.
echo RUTA COMPARTIDA RESULTANTE: \\192.168.1.100\temporal seo
echo.

echo PASO 2: Configurar Screaming Frog para exportar a esa carpeta
echo -------------------------------------------------------------
echo En Screaming Frog (servidor):
echo 1. Configuration ^> System ^> Export
echo 2. Cambiar ruta de exportacion a: D:\temporal seo
echo 3. Guardar configuracion
echo.

echo PASO 3: Probar conexion desde tu PC
echo ------------------------------------
echo Ejecuta este comando para probar:
echo.
echo dir "\\192.168.1.100\temporal seo"
echo.
echo Si funciona, veras el contenido de la carpeta compartida.
echo.

echo PASO 4: Ejecutar descarga automatica
echo -------------------------------------
echo Una vez configurado el servidor, ejecuta:
echo.
echo python screaming_frog_remote_export.py
echo.
echo Esto descargara automaticamente todos los CSV necesarios.
echo.

pause
echo.
echo ¿Quieres probar la conexion ahora? (S/N)
set /p respuesta=
if /i "%respuesta%"=="S" (
    echo Probando conexion...
    dir "\\192.168.1.100\temporal seo" 2>nul
    if %errorlevel%==0 (
        echo ✓ CONEXION EXITOSA - Carpeta compartida accesible
    ) else (
        echo ✗ ERROR - No se puede acceder a la carpeta compartida
        echo Verifica que:
        echo - El servidor este encendido
        echo - La carpeta este compartida correctamente
        echo - Tengas permisos de acceso
    )
) else (
    echo Configuracion guardada. Ejecuta este script cuando hayas configurado el servidor.
)

echo.
echo Presiona cualquier tecla para continuar...
pause >nul