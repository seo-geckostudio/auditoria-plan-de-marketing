# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

This is a dual-purpose repository containing:
1. **SEO Audit Methodology Documentation** (Spanish): Comprehensive structured guidance for professional technical and content SEO audits
2. **PHP Web Application**: A complete audit management system built with PHP and SQLite for tracking and managing SEO audit workflows

## System Architecture

### Backend: PHP Application
- **Pattern**: Simplified MVC architecture
- **Database**: SQLite 3.x (portable, file-based at `data/auditoria_seo.sqlite`)
- **Entry Point**: `index.php` - Front controller with URL-based routing (`?modulo=X&accion=Y`)
- **Core Structure**:
  - `config/` - Database configuration (supports both MySQL and SQLite)
  - `includes/` - Shared functions, initialization, forms, notifications
  - `modules/` - Feature modules (auditorias, clientes, pasos, archivos, ayuda)
  - `views/` - Presentation layer templates
  - `data/` - SQLite database files

### Database Schema (SQLite)
Key tables representing the 5-phase audit workflow:
- `fases` - The 5 audit methodology phases (0-4)
- `pasos_plantilla` - Template steps for each phase
- `auditorias` - Main audit records
- `auditoria_pasos` - Instance of steps for specific audits
- `clientes` - Client information
- `usuarios` - User/consultant accounts
- `archivos` - File uploads associated with audit steps
- `historial_cambios` - Change tracking log

### Frontend
- **Framework**: Bootstrap 5.3 with Font Awesome icons
- **Charts**: Chart.js for visualizations
- **Style**: Modern gradient-based UI with CSS custom properties
- **JavaScript**: Vanilla JS with AJAX for dynamic updates (CSRF-protected)

## Starting the Development Server

**IMPORTANT:** This project uses **port 8095** for the development server.

### Option 1: Automatic Startup (Windows)
```bash
# For Ibiza Villa Web Audit System:
cd "ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA"
iniciar_auditoria.bat

# For main system (if different):
iniciar_sistema.bat
```
This verifies PHP installation, checks/creates database, and starts server on port 8095.

### Option 2: Manual Startup
```bash
# Using bundled PHP
.\php\php.exe -S localhost:8095

# Or system PHP
php -S localhost:8095
```

Access the system at: **http://localhost:8095**

## Running Tests

The project uses Playwright for end-to-end testing:

```bash
# Run all tests
npm test

# Run tests with UI
npm run test:ui

# Run tests in headed mode (visible browser)
npm run test:headed

# View test report
npm run test:report

# Type checking
npm run typecheck
```

Test files are in `tests/*.spec.ts` and configured via `playwright.config.ts` with base URL `http://localhost:8095`.

## Key PHP Functions (includes/functions.php)

### Database Operations
- `ejecutarConsulta($sql, $params)` - Execute prepared SQL queries
- `obtenerRegistro($sql, $params)` - Fetch single record
- `insertarRegistro($tabla, $datos)` - Insert with auto-generated ID
- `actualizarRegistro($tabla, $id, $datos)` - Update by ID
- `eliminarRegistro($tabla, $id)` - Delete by ID

### Audit Management
- `obtenerAuditorias($filtros)` - List audits with filters
- `obtenerAuditoria($auditoriaId)` - Get single audit details
- `crearAuditoria($datos)` - Create new audit
- `obtenerPasosPorFase($auditoriaId)` - Get steps organized by phase
- `actualizarEstadoPaso($auditoriaId, $pasoId, $nuevoEstado, $usuarioId)` - Update step status
- `generarDescripcionPaso($paso, $todosPasos)` - Dynamic step descriptions with dependency checking

### Security & Utilities
- `generarTokenCSRF()` / `verificarTokenCSRF($token)` - CSRF protection
- `sanitizar($data)` - XSS protection via htmlspecialchars
- `registrarCambio($auditoriaId, $usuarioId, $tipoCambio, $descripcion)` - Audit trail
- `registrarError($mensaje)` - Error logging to files
- `subirArchivo($auditoriaId, $pasoId, $archivo, $usuarioId)` - Secure file uploads

## Module System

Modules are in `modules/*.php` and handle specific features:
- **auditorias.php** - Create, list, view, update audit records
- **clientes.php** - Client management CRUD operations
- **pasos.php** - Step templates and audit step management
- **archivos.php** - File upload/download handling
- **ayuda.php** - Help/documentation system

Each module exports a `manejar{Module}()` function called from the router in `index.php`.

## SEO Audit Methodology (5 Phases)

The system implements this structured workflow:

**Phase 0: Marketing Digital** (Optional)
- Market analysis, competitor research, buyer personas, content strategy

**Phase 1: Preparación**
- Access checklist, client brief (12-field form), audit roadmap

**Phase 2: Keyword Research**
- Current keywords analysis, competitor analysis, opportunities, keyword mapping

**Phase 3: Arquitectura**
- Current architecture analysis, keyword-to-architecture mapping, proposals

**Phase 4: Recopilación de Datos** (Most comprehensive)
- 17+ steps covering: General SEO status, organic positioning, on-page SEO, navigation, internal linking, content analysis, meta tags, images, structured data, hreflang, E-E-A-T, technical errors, mobile/Core Web Vitals, performance, link profile, indexing

**Phase 5: Entregables Finales**
- Executive report, technical report, action plan, results presentation

## SEO Tools Integration

The methodology incorporates data from:
- **Google Search Console**: 15+ CSV exports
- **Google Analytics 4 (GA4)**: Editor access required
- **Ahrefs**: 18+ CSV exports + 3 PDF reports
- **Screaming Frog SEO Spider**: 25+ CSV exports across modules

## Database Installation

If database doesn't exist, the system redirects to `install.php` which creates all tables, default data (phases, admin user), and sample records.

Check installation status:
```php
// Via included function
if (!verificarInstalacion()) {
    // Redirects to install.php
}
```

## Common Development Patterns

### Creating a New Module
1. Create `modules/nuevo_modulo.php`
2. Export `function manejarNuevoModulo() { /* routing logic */ }`
3. Add case to `index.php` router
4. Create views in `views/nuevo_modulo/`
5. Update sidebar navigation in `index.php`

### Adding Form Processing
```php
// In module file
function procesarFormularioNuevo() {
    // Verify CSRF token
    if (!verificarTokenCSRF($_POST['csrf_token'])) {
        return ['success' => false, 'message' => 'Token inválido'];
    }

    // Sanitize and validate
    $datos = sanitizar($_POST);

    // Insert/update
    $id = insertarRegistro('tabla', $datos);

    // Return result
    return ['success' => true, 'id' => $id];
}
```

### AJAX Endpoint Pattern
```php
// Return JSON for AJAX calls
header('Content-Type: application/json');
echo json_encode(['success' => true, 'data' => $resultado]);
exit;
```

## Important File Paths

- Database: `data/auditoria_seo.sqlite`
- Uploads: `uploads/{auditoria_id}/` (created dynamically)
- Logs: `logs/errores_{YYYY-MM}.log`
- Config: `config/database_config.php` (gitignored, use template)
- Portable PHP: `php/php.exe` (Windows only)

## Security Considerations

- All forms MUST include `generarTokenCSRF()` and verify on submission
- All user input MUST be sanitized via `sanitizar()` before display
- Database queries MUST use prepared statements (automatically handled by helper functions)
- File uploads are validated for type, size, and stored with unique names
- Session management handled in `includes/init.php`

## Code Style

- Spanish language for user-facing content
- English for technical code comments
- Professional consulting tone in documentation
- Emoji section headers in markdown docs (🔧, 🧩, 🔹, etc.)
- Consistent naming: `obtener*`, `crear*`, `actualizar*`, `eliminar*` for CRUD

## MCP Servers Available

The project has MCP (Model Context Protocol) servers configured:
- `@playwright/mcp` - Browser automation for testing
- `@modelcontextprotocol/server-memory` - Persistent memory across sessions
- `@modelcontextprotocol/server-sequential-thinking` - Complex reasoning
- `@upstash/context7-mcp` - Additional context management

These are configured in `trae-mcp-config.json` and `claude_desktop_config.json`.

## Troubleshooting

### Database Issues
```bash
# Check database structure
php check_database.php
php check_auditorias_table.php
php check_pasos_plantilla_structure.php
```

### Server Won't Start
- Verify PHP is in `php/` directory or in system PATH
- Check port 8000 isn't in use: `netstat -ano | findstr :8000`
- Verify SQLite extension is enabled: `php -m | grep sqlite3`

### Session Issues
Sessions are initialized in `includes/init.php`. If having auth issues, check:
- PHP session.save_path is writable
- `$_SESSION['usuario_id']` and `$_SESSION['usuario_nombre']` are set
- Clear browser cookies if session appears corrupt

## Documentation Structure

Methodology docs follow this pattern:
- `FASE_X_NOMBRE/` directories contain phase-specific templates
- `INSTRUCCIONES_FASE_X.md` files provide implementation guidance
- Naming convention: `[number]_[description].[extension]`
- Each phase includes both planning docs and execution templates

## Related Documentation

- `README.md` - User-facing quick start guide
- `DOCUMENTACION_INTERNA_SISTEMA.md` - Detailed internal system documentation
- `documentacion_base_datos.md` - Database architecture and design decisions
- `CHANGELOG.md` - Version history and changes
