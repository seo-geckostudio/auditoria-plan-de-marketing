@echo off
chcp 65001 >nul
echo.
echo 🕷️ CONFIGURACIÓN SCREAMING FROG REMOTO
echo ======================================
echo.
echo Este script te ayudará a configurar el acceso remoto a Screaming Frog
echo en tu red local.
echo.

:: Verificar si Python está instalado
python --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Python no está instalado o no está en el PATH
    echo 💡 Instala Python desde https://python.org
    pause
    exit /b 1
)

echo ✅ Python detectado
echo.

:: Instalar dependencias
echo 📦 Instalando dependencias...
pip install -r requirements_remote.txt
if %errorlevel% neq 0 (
    echo ❌ Error instalando dependencias
    pause
    exit /b 1
)

echo ✅ Dependencias instaladas
echo.

:: Crear carpetas necesarias
echo 📁 Creando estructura de carpetas...
if not exist "datos_screaming_frog" mkdir "datos_screaming_frog"
if not exist "datos_screaming_frog\exports_csv" mkdir "datos_screaming_frog\exports_csv"
if not exist "datos_screaming_frog\graficos_visuales" mkdir "datos_screaming_frog\graficos_visuales"

echo ✅ Carpetas creadas
echo.

echo 🔧 CONFIGURACIÓN NECESARIA
echo ===========================
echo.
echo Ahora necesitas configurar la conexión remota:
echo.
echo 1. Edita el archivo: remote_config.json
echo 2. Configura los siguientes parámetros:
echo.
echo    📍 IP del servidor: "ip": "192.168.1.XXX"
echo    👤 Usuario: "username": "tu_usuario"  
echo    🔐 Contraseña: "password": "tu_contraseña"
echo    📁 Ruta remota: "remote_path": "\\\\IP\\carpeta_compartida"
echo.
echo 💡 OPCIONES DE CONEXIÓN:
echo.
echo    🗂️  CARPETA COMPARTIDA (Recomendado - Más fácil)
echo       - Comparte una carpeta en el servidor de Screaming Frog
echo       - Configura "connection_type": "shared_folder"
echo       - Ejemplo: "\\\\192.168.1.100\\ScreamingFrog\\exports"
echo.
echo    🔐 SSH (Avanzado)
echo       - Requiere servidor SSH en Windows/Linux
echo       - Configura "connection_type": "ssh"
echo       - Puerto por defecto: 22
echo.
echo 📝 PASOS SIGUIENTES:
echo.
echo 1. Edita remote_config.json con tus datos
echo 2. Ejecuta: python screaming_frog_remote_export.py
echo 3. El script descargará automáticamente todos los CSV
echo.

:: Abrir archivo de configuración para editar
echo ¿Quieres abrir el archivo de configuración ahora? (S/N)
set /p choice=
if /i "%choice%"=="S" (
    notepad remote_config.json
)

echo.
echo ✅ CONFIGURACIÓN COMPLETADA
echo.
echo Para usar el sistema:
echo   python screaming_frog_remote_export.py
echo.
pause