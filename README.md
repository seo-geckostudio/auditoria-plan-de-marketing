# Sistema de Auditorías SEO - Plan de Marketing

Sistema completo de gestión de auditorías SEO con interfaz web moderna, diseñado para consultores y agencias de marketing digital.

## 🚀 Características Principales

### ✨ Gestión Completa de Auditorías
- **6 Fases estructuradas**: Desde análisis inicial hasta entregables finales
- **34+ pasos predefinidos**: Plantillas importadas desde documentación técnica
- **Seguimiento de progreso**: Estados automáticos y visualización en tiempo real
- **Gestión de archivos**: Subida, organización y descarga de documentos

### 📊 Sistema de Fases
1. **Fase 0**: Contexto Marketing Digital (opcional)
2. **Fase 1**: Análisis Inicial
3. **Fase 2**: Análisis de Contenido  
4. **Fase 3**: Análisis de Competencia
5. **Fase 4**: Análisis Técnico
6. **Fase 5**: Entregables Finales

### 🛠️ Funcionalidades Avanzadas
- **Editor JSON integrado**: Para introducción manual de datos
- **Importación de archivos**: CSV, JSON, Excel con mapeo automático
- **Sistema de plantillas**: Reutilización de configuraciones
- **Generación de informes**: Reportes completos en HTML y PDF
- **Gestión de comentarios**: Notas y observaciones por paso
- **Historial de cambios**: Trazabilidad completa de modificaciones

## 🏗️ Arquitectura del Sistema

### Base de Datos
- **SQLite**: Base de datos ligera y portable
- **9 tablas principales**: Usuarios, clientes, auditorías, fases, pasos, archivos, etc.
- **Relaciones normalizadas**: Estructura escalable y eficiente

### Estructura de Archivos
```
├── config/           # Configuración de base de datos
├── includes/         # Funciones y utilidades PHP
├── modules/          # Módulos principales (auditorías, clientes, pasos)
├── views/            # Vistas e interfaces de usuario
├── FASE_X_*/         # Documentación de fases (Markdown)
└── data/             # Base de datos SQLite
```

## 🚀 Instalación y Configuración

### Requisitos
- PHP 7.4 o superior
- Extensiones: PDO, SQLite3, JSON, FileInfo
- Servidor web (Apache, Nginx, o PHP built-in)

### Instalación Rápida
1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/seo-geckostudio/auditoria-plan-de-marketing.git
   cd auditoria-plan-de-marketing
   ```

2. **Configurar la base de datos**:
   ```bash
   php create_sqlite_simple.php
   ```

3. **Importar plantillas de pasos**:
   ```bash
   php import_pasos.php
   ```

4. **Iniciar el servidor**:
   ```bash
   php -S localhost:8000
   ```

5. **Acceder al sistema**:
   - URL: `http://localhost:8000`
   - Usuario por defecto: `admin@sistema.com`
   - Contraseña: `password`

## 📖 Guía de Uso

### Crear Nueva Auditoría
1. Ir a **Auditorías > Nueva Auditoría**
2. Completar información básica del cliente
3. Seleccionar fases a incluir
4. El sistema creará automáticamente todos los pasos

### Introducir Datos
1. Acceder a la auditoría desde la lista
2. Hacer clic en **"Introducir Datos"** en cualquier paso
3. Opciones disponibles:
   - **Editor JSON**: Introducción manual
   - **Importar archivo**: CSV, JSON, Excel
   - **Usar plantilla**: Configuraciones guardadas

### Generar Informe Final
1. Completar todos los pasos críticos
2. Hacer clic en **"Generar Informe Final"**
3. El sistema creará un reporte completo con:
   - Resumen ejecutivo
   - Datos por fases
   - Archivos adjuntos
   - Comentarios y observaciones

## 🔧 Configuración Avanzada

### Variables de Entorno
Crear archivo `config/local_config.php`:
```php
<?php
// Configuración personalizada
define('DB_PATH', '/ruta/personalizada/auditoria.sqlite');
define('UPLOAD_MAX_SIZE', '10M');
define('DEBUG_MODE', true);
?>
```

### Personalización de Fases
Las fases se pueden personalizar editando los archivos Markdown en las carpetas `FASE_X_*/`:
- Agregar nuevos pasos
- Modificar descripciones
- Ajustar tiempos estimados
- Definir criticidad

## 🧪 Testing

### Tests Automatizados
```bash
# Instalar dependencias de testing
npm install

# Ejecutar tests de Playwright
npx playwright test
```

### Tests Manuales
- `test_sistema.php`: Verificación completa del sistema
- `test_5_phases.php`: Validación de estructura de fases
- `debug_*.php`: Scripts de depuración específicos

## 📁 Estructura de Datos

### Flujo de Trabajo
1. **Cliente** → Información de la empresa
2. **Auditoría** → Proyecto específico para el cliente
3. **Fases** → Etapas del proceso de auditoría
4. **Pasos** → Tareas específicas dentro de cada fase
5. **Archivos** → Documentos y evidencias
6. **Comentarios** → Notas y observaciones

### Estados de Pasos
- `pendiente`: Sin iniciar
- `en_progreso`: En desarrollo
- `completado`: Finalizado
- `bloqueado`: Requiere acción externa

## 🤝 Contribución

### Reportar Issues
- Usar el sistema de issues de GitHub
- Incluir pasos para reproducir
- Adjuntar logs si es necesario

### Desarrollo
1. Fork del repositorio
2. Crear rama feature: `git checkout -b feature/nueva-funcionalidad`
3. Commit cambios: `git commit -am 'Agregar nueva funcionalidad'`
4. Push a la rama: `git push origin feature/nueva-funcionalidad`
5. Crear Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 🆘 Soporte

- **Documentación**: Ver carpetas `FASE_X_*` para guías detalladas
- **Issues**: https://github.com/seo-geckostudio/auditoria-plan-de-marketing/issues
- **Email**: soporte@geckostudio.com

## 🔄 Changelog

### v1.0.0 (2025-01-26)
- ✅ Sistema completo de 6 fases
- ✅ 34+ plantillas de pasos
- ✅ Interfaz web moderna
- ✅ Importación de archivos
- ✅ Generación de informes
- ✅ Sistema de plantillas
- ✅ Gestión de comentarios
- ✅ Historial de cambios

---

**Desarrollado con ❤️ para consultores SEO y agencias de marketing digital**