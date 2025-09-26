# 📊 DOCUMENTACIÓN DEL SISTEMA DE BASE DE DATOS
## Sistema de Gestión de Auditorías SEO

---

## 🔧 CONFIGURACIÓN GENERAL

### Motor de Base de Datos
- **Tipo**: SQLite
- **Versión**: SQLite 3.x
- **Conexión**: PDO (PHP Data Objects)
- **Archivo Principal**: `data/auditoria_seo.sqlite`

### Archivos de Base de Datos
```
📁 data/
├── auditoria_seo.sqlite    ← Base de datos principal (ACTIVA)
└── auditoria.db           ← Base de datos secundaria
```

### Configuración de Conexión
- **Archivo de configuración**: `config/database.php`
- **DSN**: `sqlite:data/auditoria_seo.sqlite`
- **Opciones PDO**:
  - `ATTR_ERRMODE`: `PDO::ERRMODE_EXCEPTION`
  - `ATTR_DEFAULT_FETCH_MODE`: `PDO::FETCH_ASSOC`
  - `ATTR_EMULATE_PREPARES`: `false`

---

## 🗂️ ESTRUCTURA DE TABLAS

### Función de Conexión
```php
function obtenerConexion() {
    global $dsn, $options;
    return new PDO($dsn, null, null, $options);
}
```

### Tablas del Sistema

#### 📋 Tabla: `clientes`
**Propósito**: Almacena información de los clientes del sistema

| Campo | Tipo | Nulo | Defecto | PK | Descripción |
|-------|------|------|---------|----|-----------| 
| `id` | INTEGER | No | NULL | Sí | Identificador único |
| `nombre_empresa` | TEXT | Sí | NULL | No | Nombre de la empresa cliente |
| `contacto_nombre` | TEXT | Sí | NULL | No | Nombre del contacto principal |
| `contacto_email` | TEXT | Sí | NULL | No | Email del contacto |
| `contacto_telefono` | TEXT | Sí | NULL | No | Teléfono del contacto |
| `direccion` | TEXT | Sí | NULL | No | Dirección de la empresa |
| `activo` | INTEGER | Sí | 1 | No | Estado activo (1=activo, 0=inactivo) |
| `fecha_creacion` | DATETIME | Sí | CURRENT_TIMESTAMP | No | Fecha de creación |
| `fecha_actualizacion` | DATETIME | Sí | CURRENT_TIMESTAMP | No | Fecha de última actualización |

#### 📋 Tabla: `usuarios`
**Propósito**: Gestión de usuarios del sistema

| Campo | Tipo | Nulo | Defecto | PK | Descripción |
|-------|------|------|---------|----|-----------| 
| `id` | INTEGER | No | NULL | Sí | Identificador único |
| `nombre` | TEXT | No | NULL | No | Nombre del usuario |
| `email` | TEXT | No | NULL | No | Email único del usuario |
| `password` | TEXT | No | NULL | No | Contraseña hasheada |
| `rol` | TEXT | Sí | 'usuario' | No | Rol del usuario |
| `activo` | INTEGER | Sí | 1 | No | Estado activo |
| `fecha_creacion` | DATETIME | Sí | CURRENT_TIMESTAMP | No | Fecha de creación |

#### 📋 Tabla: `auditorias`
**Propósito**: Registro de auditorías SEO

| Campo | Tipo | Nulo | Defecto | PK | Descripción |
|-------|------|------|---------|----|-----------| 
| `id` | INTEGER | No | NULL | Sí | Identificador único |
| `nombre` | TEXT | No | NULL | No | Nombre de la auditoría |
| `descripcion` | TEXT | Sí | NULL | No | Descripción detallada |
| `url_principal` | TEXT | No | NULL | No | URL principal a auditar |
| `cliente_id` | INTEGER | No | NULL | No | FK a tabla clientes |
| `usuario_id` | INTEGER | No | NULL | No | FK a tabla usuarios |
| `fase_id` | INTEGER | Sí | NULL | No | FK a tabla fases |
| `estado` | TEXT | Sí | 'pendiente' | No | Estado de la auditoría |
| `prioridad` | TEXT | Sí | 'media' | No | Prioridad (alta/media/baja) |
| `fecha_creacion` | DATETIME | Sí | CURRENT_TIMESTAMP | No | Fecha de creación |
| `fecha_inicio` | DATETIME | Sí | NULL | No | Fecha de inicio |
| `fecha_fin` | DATETIME | Sí | NULL | No | Fecha de finalización |

#### 📋 Tabla: `fases`
**Propósito**: Definición de fases de auditoría

| Campo | Tipo | Nulo | Defecto | PK | Descripción |
|-------|------|------|---------|----|-----------| 
| `id` | INTEGER | No | NULL | Sí | Identificador único |
| `nombre` | TEXT | No | NULL | No | Nombre de la fase |
| `descripcion` | TEXT | Sí | NULL | No | Descripción de la fase |
| `orden` | INTEGER | Sí | 0 | No | Orden de ejecución |
| `activo` | INTEGER | Sí | 1 | No | Estado activo |

#### 📋 Tabla: `pasos`
**Propósito**: Pasos específicos dentro de cada fase

| Campo | Tipo | Nulo | Defecto | PK | Descripción |
|-------|------|------|---------|----|-----------| 
| `id` | INTEGER | No | NULL | Sí | Identificador único |
| `fase_id` | INTEGER | No | NULL | No | FK a tabla fases |
| `nombre` | TEXT | No | NULL | No | Nombre del paso |
| `descripcion` | TEXT | Sí | NULL | No | Descripción del paso |
| `orden` | INTEGER | Sí | 0 | No | Orden dentro de la fase |
| `activo` | INTEGER | Sí | 1 | No | Estado activo |

---

## ⚙️ FUNCIONES DEL SISTEMA

### Funciones de Formularios (`includes/forms.php`)

#### `obtenerOpcionesClientes()`
```php
function obtenerOpcionesClientes() {
    $pdo = obtenerConexion();
    $stmt = $pdo->query("SELECT id, nombre_empresa as nombre, contacto_nombre 
                         FROM clientes 
                         WHERE activo = 1 
                         ORDER BY nombre_empresa");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

#### `obtenerOpcionesUsuarios()`
```php
function obtenerOpcionesUsuarios() {
    $pdo = obtenerConexion();
    $stmt = $pdo->query("SELECT id, nombre, email 
                         FROM usuarios 
                         WHERE activo = 1 
                         ORDER BY nombre");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

#### `obtenerOpcionesFases()`
```php
function obtenerOpcionesFases() {
    $pdo = obtenerConexion();
    $stmt = $pdo->query("SELECT id, nombre, descripcion 
                         FROM fases 
                         WHERE activo = 1 
                         ORDER BY orden, nombre");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

---

## 🔍 DIAGNÓSTICO DE PROBLEMAS

### Problema Identificado: Clientes No Aparecen

#### Causa Raíz
El sistema filtra clientes por el campo `activo = 1`, pero los clientes en la base de datos tienen `activo = 0`.

#### Solución Aplicada
```sql
UPDATE clientes SET activo = 1 WHERE activo = 0;
```

#### Verificación
```php
// Verificar clientes activos
$activos = $pdo->query("SELECT COUNT(*) FROM clientes WHERE activo = 1")->fetchColumn();
```

---

## 📈 ESTADÍSTICAS DEL SISTEMA

### Estado de Tablas
- **clientes**: Contiene datos de empresas cliente
- **usuarios**: Gestión de acceso al sistema  
- **auditorias**: Registro de auditorías SEO
- **fases**: Definición de metodología
- **pasos**: Detalle de procesos

### Integridad Referencial
- `auditorias.cliente_id` → `clientes.id`
- `auditorias.usuario_id` → `usuarios.id`  
- `auditorias.fase_id` → `fases.id`
- `pasos.fase_id` → `fases.id`

---

## 🛠️ MANTENIMIENTO

### Comandos Útiles

#### Verificar Conexión
```php
try {
    $pdo = obtenerConexion();
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Contar Registros
```sql
SELECT 
    'clientes' as tabla, COUNT(*) as total FROM clientes
UNION ALL
SELECT 
    'usuarios' as tabla, COUNT(*) as total FROM usuarios
UNION ALL  
SELECT 
    'auditorias' as tabla, COUNT(*) as total FROM auditorias;
```

#### Activar Todos los Clientes
```sql
UPDATE clientes SET activo = 1;
```

---

## 📝 NOTAS TÉCNICAS

### Extensiones PHP Requeridas
- ✅ `pdo` - PHP Data Objects
- ✅ `pdo_sqlite` - Driver SQLite para PDO
- ✅ `sqlite3` - Extensión SQLite3 nativa
- ✅ `mbstring` - Manejo de cadenas multibyte
- ✅ `fileinfo` - Información de archivos

### Configuración php.ini
```ini
extension=pdo
extension=pdo_sqlite
extension=sqlite3
extension=mbstring
extension=fileinfo
```

### Permisos de Archivos
- Base de datos: Lectura/Escritura
- Directorio `data/`: Lectura/Escritura
- Directorio `temp/`: Lectura/Escritura

---

## 🔐 SEGURIDAD

### Buenas Prácticas Implementadas
- ✅ Uso de PDO con prepared statements
- ✅ Manejo de excepciones
- ✅ Validación de datos de entrada
- ✅ Filtrado por estado activo

### Recomendaciones
- Implementar backup automático
- Monitoreo de tamaño de base de datos
- Logs de acceso y modificaciones
- Validación adicional en formularios

---

*Documentación generada: 2025-01-26*
*Sistema: Gestión de Auditorías SEO v1.0*