# Sistema de Auditoría SEO

Sistema web para gestión de auditorías SEO desarrollado en PHP con base de datos SQLite.

## 🚀 Inicio Rápido

### Opción 1: Script de Inicio Automático (Recomendado)
1. Haz doble clic en `iniciar_sistema.bat`
2. El script verificará automáticamente:
   - Existencia de PHP
   - Base de datos (la creará si no existe)
   - Iniciará el servidor en http://localhost:8000

### Opción 2: Inicio Manual
```bash
# Desde la carpeta del proyecto
.\php\php.exe -S localhost:8000
```

## 📋 Requisitos del Sistema

- Windows (para el script .bat)
- PHP 8.0 o superior (incluido en la carpeta `php/`)
- SQLite (incluido con PHP)

## 🏗️ Estructura del Proyecto

```
├── iniciar_sistema.bat     # Script de inicio automático
├── index.php              # Punto de entrada principal
├── install.php            # Instalador de base de datos
├── config/                # Configuración
├── data/                  # Base de datos SQLite
├── includes/              # Funciones y formularios comunes
├── modules/               # Módulos por departamento
├── views/                 # Vistas del sistema
└── php/                   # PHP portable
```

## 🔧 Módulos Disponibles

- **Clientes**: Gestión de clientes y contactos
- **Auditorías**: Creación y seguimiento de auditorías
- **Pasos**: Gestión de pasos de auditoría por fases
- **Archivos**: Gestión de documentos y archivos

## 🌐 Acceso al Sistema

Una vez iniciado el servidor, accede a:
- **URL Principal**: http://localhost:8000
- **Dashboard**: http://localhost:8000/?modulo=dashboard
- **Clientes**: http://localhost:8000/?modulo=clientes&accion=listar
- **Auditorías**: http://localhost:8000/?modulo=auditorias&accion=listar

## 🛠️ Solución de Problemas

### Error: "No se encontró PHP"
- Asegúrate de que la carpeta `php/` existe y contiene `php.exe`

### Error: "Base de datos no encontrada"
- El script creará automáticamente la base de datos
- Si persiste el error, ejecuta manualmente: `php install.php`

### Error: "Puerto 8000 en uso"
- Cambia el puerto en el script: `-S localhost:8001`
- O detén otros servicios que usen el puerto 8000

## 📝 Notas de Desarrollo

- El sistema usa tokens CSRF para seguridad
- Base de datos SQLite para portabilidad
- Arquitectura modular por departamentos
- Funciones centralizadas en `includes/functions.php`

## 🔒 Seguridad

- Validación CSRF en formularios
- Sanitización de datos de entrada
- Validación de tipos de archivo en uploads
- Sesiones seguras para autenticación