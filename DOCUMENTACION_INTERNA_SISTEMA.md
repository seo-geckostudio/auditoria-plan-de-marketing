# DOCUMENTACIÓN INTERNA DEL SISTEMA DE AUDITORÍAS SEO
## Versión 1.0 - Septiembre 2025

---

## 1. VISIÓN GENERAL DEL SISTEMA

El Sistema de Gestión de Auditorías SEO es una plataforma integral diseñada para facilitar la creación, gestión y seguimiento de auditorías SEO para diferentes clientes. El sistema está estructurado en 5 fases principales que representan el flujo de trabajo completo de una auditoría SEO profesional.

### 1.1 Arquitectura del Sistema

- **Tipo de aplicación**: Aplicación web PHP
- **Base de datos**: SQLite 3.x
- **Patrón de diseño**: MVC simplificado
- **Autenticación**: Sistema propio de usuarios y roles

### 1.2 Componentes Principales

- **Módulo de Clientes**: Gestión de información de clientes
- **Módulo de Auditorías**: Creación y seguimiento de auditorías
- **Módulo de Pasos**: Gestión de pasos específicos dentro de cada fase
- **Módulo de Archivos**: Gestión de documentos y archivos asociados
- **Módulo de Formularios**: Gestión de formularios personalizados para cada paso

---

## 2. ESTRUCTURA DE LA BASE DE DATOS

### 2.1 Tablas Principales

#### 2.1.1 Tabla: `clientes`
Almacena la información de los clientes para los que se realizan auditorías.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `nombre_empresa` | TEXT | Nombre de la empresa cliente |
| `contacto_nombre` | TEXT | Nombre del contacto principal |
| `contacto_email` | TEXT | Email del contacto |
| `contacto_telefono` | TEXT | Teléfono del contacto |
| `direccion` | TEXT | Dirección de la empresa |
| `activo` | INTEGER | Estado activo (1=activo, 0=inactivo) |
| `fecha_creacion` | DATETIME | Fecha de creación |
| `fecha_actualizacion` | DATETIME | Fecha de última actualización |

#### 2.1.2 Tabla: `auditorias`
Registro central de todas las auditorías SEO realizadas o en proceso.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `nombre` | TEXT | Nombre de la auditoría |
| `descripcion` | TEXT | Descripción detallada |
| `url_principal` | TEXT | URL principal a auditar |
| `cliente_id` | INTEGER | FK a tabla clientes |
| `usuario_id` | INTEGER | FK a tabla usuarios |
| `fase_id` | INTEGER | FK a tabla fases |
| `estado` | TEXT | Estado de la auditoría |
| `prioridad` | TEXT | Prioridad (alta/media/baja) |
| `fecha_creacion` | DATETIME | Fecha de creación |
| `fecha_inicio` | DATETIME | Fecha de inicio |
| `fecha_fin` | DATETIME | Fecha de finalización |

#### 2.1.3 Tabla: `fases`
Define las fases metodológicas del proceso de auditoría.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `nombre` | TEXT | Nombre de la fase |
| `descripcion` | TEXT | Descripción de la fase |
| `orden` | INTEGER | Orden de ejecución |
| `activo` | INTEGER | Estado activo |

#### 2.1.4 Tabla: `pasos`
Pasos específicos dentro de cada fase de la auditoría.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `fase_id` | INTEGER | FK a tabla fases |
| `nombre` | TEXT | Nombre del paso |
| `descripcion` | TEXT | Descripción del paso |
| `orden` | INTEGER | Orden dentro de la fase |
| `activo` | INTEGER | Estado activo |

#### 2.1.5 Tabla: `usuarios`
Gestión de usuarios del sistema.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `nombre` | TEXT | Nombre del usuario |
| `email` | TEXT | Email único del usuario |
| `password` | TEXT | Contraseña hasheada |
| `rol` | TEXT | Rol del usuario |
| `activo` | INTEGER | Estado activo |
| `fecha_creacion` | DATETIME | Fecha de creación |

### 2.2 Tablas de Formularios

El sistema utiliza formularios dinámicos para cada paso de la auditoría. Estos formularios se definen en las siguientes tablas:

#### 2.2.1 Tabla: `formularios`
Define los formularios disponibles en el sistema.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `nombre` | TEXT | Nombre del formulario |
| `descripcion` | TEXT | Descripción del formulario |
| `paso_id` | INTEGER | FK a tabla pasos |
| `activo` | INTEGER | Estado activo |

#### 2.2.2 Tabla: `campos_formulario`
Define los campos específicos de cada formulario.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `formulario_id` | INTEGER | FK a tabla formularios |
| `nombre` | TEXT | Nombre del campo |
| `tipo` | TEXT | Tipo de campo (texto, número, select, etc.) |
| `requerido` | INTEGER | Si es obligatorio (1) o no (0) |
| `orden` | INTEGER | Orden de aparición |
| `opciones` | TEXT | Opciones para campos tipo select (JSON) |

#### 2.2.3 Tabla: `respuestas_formulario`
Almacena las respuestas de los formularios completados.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INTEGER | Identificador único |
| `auditoria_id` | INTEGER | FK a tabla auditorias |
| `paso_id` | INTEGER | FK a tabla pasos |
| `campo_id` | INTEGER | FK a tabla campos_formulario |
| `valor` | TEXT | Valor de la respuesta |
| `fecha_creacion` | DATETIME | Fecha de creación |

---

## 3. FASES DEL PROCESO DE AUDITORÍA

El sistema está estructurado en 5 fases principales que representan el flujo de trabajo completo de una auditoría SEO:

### 3.1 FASE 0: Marketing Digital
Análisis preliminar del contexto de marketing digital del cliente.

**Pasos principales:**
- Análisis de mercado completo
- Análisis de competencia 360°
- Definición de buyer personas
- Estrategia de contenidos
- Análisis de canales digitales
- Plan de marketing digital ejecutivo

### 3.2 FASE 1: Preparación
Recopilación de información inicial y planificación de la auditoría.

**Pasos principales:**
- Checklist de accesos
- Brief inicial del cliente (12 campos - formulario)
- Roadmap de auditoría

### 3.3 FASE 2: Keyword Research
Investigación y análisis de palabras clave.

**Pasos principales:**
- Análisis de keywords actuales
- Análisis de competencia
- Identificación de oportunidades de keywords
- Keyword mapping

### 3.4 FASE 3: Arquitectura
Análisis y propuesta de arquitectura web.

**Pasos principales:**
- Análisis de arquitectura actual
- Mapping de keywords a arquitectura
- Propuesta de arquitectura
- Configuración de tracking

### 3.5 FASE 4: Recopilación de Datos
Análisis técnico detallado del sitio web.

**Pasos principales:**
- Situación general SEO
- Posicionamiento orgánico
- Análisis SEO OnPage
- Navegación y arquitectura
- Enlazado interno
- Análisis de contenido
- Optimización de meta tags
- Optimización de imágenes
- Análisis de blog y contenido
- Datos estructurados
- Configuración hreflang
- Evaluación E-E-A-T
- Errores técnicos
- Mobile y Core Web Vitals
- Rendimiento WPO
- Perfil de enlaces
- Indexación y aspectos técnicos

### 3.6 FASE 5: Entregables Finales
Generación de informes y recomendaciones finales.

**Pasos principales:**
- Informe ejecutivo
- Informe técnico detallado
- Plan de acción
- Presentación de resultados

---

## 4. HISTORIAS DE CLIENTE

### 4.1 Proceso de Onboarding de Cliente

1. **Registro inicial del cliente**
   - Captura de datos básicos de la empresa
   - Asignación de usuario de contacto
   - Creación de credenciales de acceso

2. **Brief inicial del cliente**
   - Formulario de 12 campos con información clave
   - Objetivos de negocio y SEO
   - Competidores principales
   - Público objetivo
   - Recursos disponibles
   - Expectativas de resultados
   - Plazos deseados
   - Presupuesto asignado
   - Historial de acciones SEO previas
   - Acceso a herramientas y plataformas
   - Restricciones técnicas
   - Información adicional relevante

3. **Planificación de la auditoría**
   - Definición de alcance
   - Asignación de recursos
   - Establecimiento de cronograma
   - Configuración de accesos y herramientas

### 4.2 Flujo de Trabajo de Auditoría

1. **Creación de la auditoría**
   - Selección del cliente
   - Definición de URL principal
   - Asignación de responsable
   - Establecimiento de prioridad y plazos

2. **Progreso por fases**
   - Avance secuencial por las 5 fases
   - Posibilidad de trabajo en paralelo en ciertos pasos
   - Seguimiento de estado por paso (pendiente, en progreso, completado)
   - Notificaciones de cambios de estado

3. **Gestión de entregables**
   - Generación automática de informes
   - Exportación de datos en diferentes formatos
   - Presentación visual de resultados
   - Almacenamiento de versiones históricas

### 4.3 Casos de Uso Comunes

1. **Auditoría SEO Completa**
   - Recorrido por todas las fases
   - Análisis exhaustivo de todos los aspectos
   - Generación de informe completo

2. **Auditoría SEO Técnica**
   - Enfoque en Fase 4
   - Análisis de aspectos técnicos específicos
   - Informe técnico detallado

3. **Keyword Research Independiente**
   - Enfoque en Fase 2
   - Análisis de palabras clave
   - Entregable de estrategia de keywords

4. **Análisis de Arquitectura**
   - Enfoque en Fase 3
   - Propuesta de reestructuración
   - Plan de implementación

---

## 5. FUNCIONALIDADES CLAVE DEL SISTEMA

### 5.1 Gestión de Clientes
- Registro y actualización de datos de clientes
- Visualización de historial de auditorías por cliente
- Gestión de contactos asociados

### 5.2 Gestión de Auditorías
- Creación de nuevas auditorías
- Seguimiento de estado y progreso
- Asignación de responsables
- Gestión de plazos y prioridades

### 5.3 Gestión de Pasos
- Configuración de pasos por fase
- Personalización de formularios por paso
- Seguimiento de estado de cada paso
- Registro de comentarios y observaciones

### 5.4 Gestión de Archivos
- Carga y descarga de documentos
- Asociación de archivos a pasos específicos
- Versionado de documentos
- Previsualización de archivos comunes

### 5.5 Generación de Informes
- Informes ejecutivos
- Informes técnicos detallados
- Exportación en diferentes formatos
- Personalización de plantillas

---

## 6. CONSIDERACIONES TÉCNICAS

### 6.1 Requisitos del Sistema
- PHP 7.4 o superior
- SQLite 3.x
- Extensiones PHP: pdo, pdo_sqlite, sqlite3, mbstring, fileinfo
- Permisos de escritura en directorios data/, uploads/, temp/ y logs/

### 6.2 Seguridad
- Uso de PDO con prepared statements
- Validación de datos de entrada
- Filtrado por estado activo
- Manejo de excepciones
- Tokens CSRF en formularios

### 6.3 Mantenimiento
- Backup automático recomendado
- Monitoreo de tamaño de base de datos
- Logs de acceso y modificaciones
- Validación periódica de integridad

---

## 7. PRÓXIMAS MEJORAS PLANIFICADAS

### 7.1 Mejoras Funcionales
- Integración con herramientas SEO externas
- Sistema de notificaciones por email
- Dashboard personalizable
- Comparativa de auditorías históricas

### 7.2 Mejoras Técnicas
- Migración a MySQL para mayor escalabilidad
- API REST para integración con otros sistemas
- Sistema de caché para mejorar rendimiento
- Mejoras en la interfaz de usuario

---

*Documento generado: Septiembre 2025*
*Sistema: Gestión de Auditorías SEO v1.0*