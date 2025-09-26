# DOCUMENTACIÓN DE FUNCIONES DEL PROYECTO
## Sistema de Gestión de Auditorías SEO

### RESUMEN EJECUTIVO

El proyecto está organizado con una arquitectura modular que separa las funciones en:
- **1 archivo genérico** (`includes/functions.php`) con funciones reutilizables
- **4 archivos por departamento** en `modules/` para funcionalidades específicas
- **1 archivo de formularios** (`includes/forms.php`) para procesamiento de datos

**Estado actual**: ✅ **ORGANIZACIÓN CORRECTA** - No se requiere consolidación

---

## 📁 ESTRUCTURA DE ARCHIVOS Y FUNCIONES

### 1. ARCHIVO GENÉRICO - `includes/functions.php`
**Propósito**: Funciones reutilizables en todo el sistema
**Total de funciones**: 25

#### Categorías de funciones:

**🗄️ Base de Datos (4 funciones)**
- `ejecutarConsulta($sql, $params = [])`
- `obtenerRegistro($sql, $params = [])`
- `insertarRegistro($tabla, $datos)`
- `actualizarRegistro($tabla, $id, $datos)`

**📊 Auditorías Generales (8 funciones)**
- `obtenerAuditorias($filtros = [])`
- `obtenerAuditoria($auditoriaId)`
- `crearAuditoria($datos)`
- `calcularPorcentajeAuditoria($auditoriaId)`
- `obtenerPasosPorFase($auditoriaId)`
- `actualizarEstadoPaso($auditoriaId, $pasoId, $nuevoEstado, $usuarioId)`
- `obtenerAuditoriasRecientes($limite = 5)`
- `obtenerPasosCriticosPendientes($limite = 10)`

**📁 Archivos (2 funciones)**
- `subirArchivo($auditoriaId, $pasoId, $archivo, $usuarioId)`
- `validarArchivo($archivo)`

**🔒 Seguridad y Utilidades (6 funciones)**
- `generarTokenCSRF()`
- `verificarTokenCSRF($token)`
- `sanitizar($data)`
- `registrarCambio($auditoriaId, $usuarioId, $tipoCambio, $descripcion, $detalles = null)`
- `registrarError($mensaje)`
- `verificarInstalacion()`

**🎨 Presentación y Formato (5 funciones)**
- `formatearFecha($fecha, $incluirHora = false)`
- `obtenerNombreEstado($estado, $tipo = 'auditoria')`
- `obtenerClaseEstado($estado)`
- `obtenerClaseCSS($estado)`
- `obtenerEstadisticasSistema()`

---

### 2. ARCHIVOS POR DEPARTAMENTO - `modules/`

#### 2.1 `modules/clientes.php` - GESTIÓN DE CLIENTES
**Total de funciones**: 21

**🎛️ Controlador Principal (1)**
- `manejarClientes()`

**👁️ Vistas (4)**
- `listarClientes()`
- `crearCliente()`
- `editarCliente()`
- `verCliente()`

**⚙️ Procesamiento (4)**
- `eliminarCliente()`
- `activarCliente()`
- `procesarCrearCliente()`
- `procesarEditarCliente($clienteId)`

**🔍 Consultas y Datos (12)**
- `validarDatosCliente($datos, $clienteId = null)`
- `obtenerClientesFiltrados($filtros = [])`
- `obtenerClientePorId($clienteId)`
- `existeClienteConEmail($email, $excluirId = null)`
- `obtenerAuditoriasPorCliente($clienteId)`
- `contarAuditoriasActivasCliente($clienteId)`
- `obtenerEstadisticasCliente($clienteId)`
- `desactivarCliente($clienteId)`
- `activarClientePorId($clienteId)`
- `obtenerSectoresUnicos()`
- `obtenerPaisesUnicos()`

#### 2.2 `modules/auditorias.php` - GESTIÓN DE AUDITORÍAS
**Total de funciones**: 12

**🎛️ Controlador Principal (1)**
- `manejarAuditorias()`

**👁️ Vistas (5)**
- `mostrarListaAuditorias()`
- `mostrarDetalleAuditoria()`
- `mostrarFormularioCrear()`
- `mostrarFormularioEditar()`
- `mostrarDashboard()`

**🔍 Consultas y Datos (6)**
- `obtenerArchivosAuditoria($auditoriaId)`
- `obtenerComentariosAuditoria($auditoriaId)`
- `obtenerHistorialAuditoria($auditoriaId, $limite = 20)`
- `obtenerEstadisticasAuditorias()`
- `exportarAuditoriaCSV($auditoriaId)`
- `duplicarAuditoria($auditoriaId, $nuevosDatos)`

#### 2.3 `modules/pasos.php` - GESTIÓN DE PASOS
**Total de funciones**: 21

**🎛️ Controlador Principal (1)**
- `manejarPasos()`

**👁️ Vistas (4)**
- `mostrarListaPasos()`
- `mostrarDetallePaso()`
- `mostrarPlantillasPasos()`
- `mostrarImportarPasos()`

**⚙️ Procesamiento (6)**
- `procesarActualizacionPaso()`
- `procesarPlantillaPaso()`
- `crearPlantillaPaso()`
- `actualizarPlantillaPaso()`
- `eliminarPlantillaPaso()`
- `procesarImportacionPasos()`

**🔍 Consultas y Datos (10)**
- `obtenerDetallePaso($pasoId, $auditoriaId)`
- `obtenerArchivosPaso($pasoId)`
- `obtenerComentariosPaso($pasoId)`
- `obtenerHistorialPaso($pasoId)`
- `obtenerEstadisticasPasos($auditoriaId)`
- `obtenerPlantillasPasos()`
- `obtenerEstadisticasPlantillas()`
- `obtenerSiguienteOrdenFase($faseId)`
- `validarDatosPlantillaPaso($datos, $plantillaId = null)`
- `reordenarPasosFase($faseId, $nuevoOrden)`

#### 2.4 `modules/archivos.php` - GESTIÓN DE ARCHIVOS
**Total de funciones**: 18

**🎛️ Controlador Principal (1)**
- `manejarArchivos()`

**👁️ Vistas (3)**
- `mostrarListaArchivos()`
- `mostrarGaleriaArchivos()`
- `verArchivo()`

**⚙️ Procesamiento (4)**
- `procesarSubidaArchivo()`
- `descargarArchivo()`
- `eliminarArchivo()`
- `eliminarArchivoLogicamente($archivoId, $usuarioId)`

**🔍 Consultas y Datos (10)**
- `obtenerInformacionArchivo($archivoId)`
- `obtenerEstadisticasArchivos($auditoriaId)`
- `obtenerImagenesAuditoria($auditoriaId)`
- `registrarDescargaArchivo($archivoId, $usuarioId)`
- `registrarVisualizacionArchivo($archivoId, $usuarioId)`
- `generarMiniatura($rutaOriginal, $rutaMiniatura, $ancho = 200, $alto = 200)`
- `limpiarArchivosHuerfanos($diasAntiguedad = 30)`
- `obtenerUsoEspacioDisco()`
- `validarArchivoDetallado($archivo)`
- `formatearTamaño($bytes)`

---

### 3. ARCHIVO DE FORMULARIOS - `includes/forms.php`
**Total de funciones**: 12

**⚙️ Procesamiento Principal (6)**
- `procesarFormulario()`
- `procesarCrearAuditoria()`
- `procesarActualizarAuditoria()`
- `procesarActualizarPaso()`
- `procesarSubirArchivo()`
- `procesarAgregarComentario()`

**✅ Validación (3)**
- `validarDatosAuditoria($datos, $auditoriaId = null)`
- `validarDatosCliente($datos)`
- `validarFecha($fecha)`

**🎨 Generación de UI (3)**
- `generarCampo($tipo, $nombre, $valor = '', $opciones = [])`
- `generarCampoCSRF()`
- `obtenerOpcionesClientes()`
- `obtenerOpcionesUsuarios()`
- `obtenerOpcionesFases()`

---

## ⚠️ ANÁLISIS DE CONFLICTOS

### CONFLICTOS IDENTIFICADOS Y RESUELTOS:

1. **✅ RESUELTO**: `procesarCrearCliente()`
   - **Antes**: Duplicado en `modules/clientes.php` y `includes/forms.php`
   - **Solución**: Eliminado de `includes/forms.php`, centralizado en `modules/clientes.php`

### CONFLICTOS POTENCIALES MONITOREADOS:

1. **⚠️ MONITOREADO**: `actualizarEstadoPaso()`
   - **PHP**: `includes/functions.php` (línea 255)
   - **JavaScript**: `index.php` (línea 434)
   - **Estado**: ✅ Sin conflicto (diferentes lenguajes)

2. **⚠️ MONITOREADO**: `validarDatosCliente()`
   - **Genérico**: `includes/forms.php` (línea 369)
   - **Específico**: `modules/clientes.php` (línea 333)
   - **Estado**: ✅ Sin conflicto (diferentes propósitos y parámetros)

---

## 📊 ESTADÍSTICAS DEL PROYECTO

| Archivo | Funciones | Propósito |
|---------|-----------|-----------|
| `includes/functions.php` | 25 | Funciones genéricas reutilizables |
| `modules/clientes.php` | 21 | Gestión específica de clientes |
| `modules/pasos.php` | 21 | Gestión específica de pasos |
| `modules/archivos.php` | 18 | Gestión específica de archivos |
| `modules/auditorias.php` | 12 | Gestión específica de auditorías |
| `includes/forms.php` | 12 | Procesamiento de formularios |
| **TOTAL** | **109** | **Funciones en el sistema** |

---

## ✅ RECOMENDACIONES

### ESTADO ACTUAL: **ORGANIZACIÓN ÓPTIMA**

1. **✅ NO se requiere consolidación** - La arquitectura actual es correcta
2. **✅ Separación clara** entre funciones genéricas y específicas
3. **✅ Sin conflictos críticos** de nombres de funciones
4. **✅ Modularidad adecuada** para mantenimiento

### MEJORES PRÁCTICAS IMPLEMENTADAS:

- ✅ **Separación de responsabilidades**
- ✅ **Nomenclatura consistente**
- ✅ **Documentación en código**
- ✅ **Validación de acceso directo**
- ✅ **Manejo de errores**

---

## 🔧 MANTENIMIENTO FUTURO

### Para agregar nuevas funciones:

1. **Funciones genéricas** → `includes/functions.php`
2. **Funciones específicas de módulo** → `modules/[modulo].php`
3. **Procesamiento de formularios** → `includes/forms.php`

### Verificar antes de agregar:
- ✅ Nombre único en todo el proyecto
- ✅ Documentación PHPDoc
- ✅ Manejo de errores
- ✅ Validación de parámetros

---

*Documentación generada automáticamente - Fecha: $(date)*
*Sistema de Gestión de Auditorías SEO v1.0*