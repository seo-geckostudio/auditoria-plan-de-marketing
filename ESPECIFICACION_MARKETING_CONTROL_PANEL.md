# Marketing Control Panel - Especificación Funcional Completa

**Proyecto:** Marketing Control Panel (MCP)
**Versión:** 1.0
**Fecha:** 2025-01-15
**Para:** Migue (Dios)
**Propósito:** Especificación funcional end-to-end + Sistema .claude para desarrollo

---

## 📋 Índice

1. [Visión General del Sistema](#visión-general-del-sistema)
2. [Stack Técnico](#stack-técnico)
3. [Arquitectura del Sistema](#arquitectura-del-sistema)
4. [Módulos Funcionales](#módulos-funcionales)
5. [Historias de Usuario](#historias-de-usuario)
6. [Flujos de Trabajo](#flujos-de-trabajo)
7. [Base de Datos](#base-de-datos)
8. [APIs e Integraciones](#apis-e-integraciones)
9. [Sistema .claude para Desarrollo](#sistema-claude-para-desarrollo)
10. [Roadmap de Implementación](#roadmap-de-implementación)

---

## 1. Visión General del Sistema

### 1.1. ¿Qué es Marketing Control Panel?

**Marketing Control Panel (MCP)** es una plataforma integral de gestión de marketing digital que centraliza y automatiza todas las operaciones de marketing para múltiples clientes.

**Metáfora:** "El cockpit del piloto de marketing"
- Desde un único lugar controlas todo
- Dashboard con todos los indicadores clave
- Automatizaciones que se ejecutan en piloto automático
- Intervención manual cuando lo necesitas

### 1.2. Alcance del Sistema

```
┌─────────────────────────────────────────────────────────────┐
│           MARKETING CONTROL PANEL (MCP)                     │
└─────────────────────────────────────────────────────────────┘
                           │
        ┌──────────────────┼──────────────────┐
        │                  │                  │
   ┌────▼────┐      ┌─────▼──────┐    ┌─────▼──────┐
   │ CLIENTES│      │  PLANIFIC. │    │  EJECUCIÓN │
   └────┬────┘      └─────┬──────┘    └─────┬──────┘
        │                 │                  │
   ┌────▼────────┐   ┌────▼────────┐   ┌────▼────────┐
   │ Alta cliente│   │ Plan Mkt    │   │ SEO Audit   │
   │ Onboarding  │   │ Estrategia  │   │ Arquitectura│
   │ Brief       │   │ Objetivos   │   │ Implementar │
   └─────────────┘   └─────────────┘   └─────────────┘
                                             │
                     ┌───────────────────────┼───────────────────┐
                     │                       │                   │
              ┌──────▼──────┐       ┌───────▼────────┐   ┌──────▼─────┐
              │ WORDPRESS   │       │ EMAIL MARKETING│   │ REPORTING  │
              │ Automation  │       │ Link Building  │   │ Analytics  │
              │ Content Pub │       │ Outreach       │   │ Dashboards │
              └─────────────┘       └────────────────┘   └────────────┘
```

### 1.3. Usuarios del Sistema

**1. Gestor de Marketing (tú - Migue)**
- Acceso total al sistema
- Gestiona múltiples clientes
- Supervisa automatizaciones
- Toma decisiones estratégicas

**2. Cliente** (acceso limitado - futuro)
- Ve su dashboard específico
- Aprueba/rechaza propuestas
- Consulta reportes

**3. Sistema (automatizado)**
- Ejecuta tareas programadas
- Genera reportes automáticos
- Notifica cuando requiere atención humana

### 1.4. Principios de Diseño

1. **Modularidad:** Cada área es un módulo independiente
2. **Escalabilidad:** Fácil añadir nuevos clientes y módulos
3. **Automatización con control:** El sistema hace, tú supervisas
4. **Drip mode:** Ejecución progresiva, no todo de golpe
5. **Trazabilidad:** TODO queda registrado
6. **Reversibilidad:** Puedes deshacer acciones críticas

---

## 2. Stack Técnico

### 2.1. Core

```yaml
Backend:
  Lenguaje: PHP 8.1+
  Arquitectura: Modular (sin frameworks pesados)
  Patrón: MVC adaptado

Frontend:
  Template: Limitless Admin Template (licencia comprada)
  CSS Framework: Bootstrap 5 (incluido en Limitless)
  JavaScript: Vanilla JS + jQuery (incluido en Limitless)
  Charts: Chart.js / ApexCharts (incluido en Limitless)

Base de Datos:
  Principal: MySQL 8.0 (para producción escalable)
  Alternativa: SQLite (para desarrollo/demos)
  ORM: Ninguno (queries directas con PDO)

Contenedorización:
  Docker: Docker Compose
  Servicios:
    - PHP 8.1-FPM
    - Nginx
    - MySQL 8.0
    - Python 3.11 (para scripts auxiliares)
    - Screaming Frog (headless si es posible)

Servidor:
  OS: Windows 11 (desarrollo) / Linux (producción Docker)
  Web Server: Nginx

Herramientas del Sistema:
  Python: Scripts de procesamiento datos
  Screaming Frog: Crawling técnico
  Curl/wget: HTTP requests

APIs Externas:
  Google Search Console API
  Google Analytics 4 API
  Ahrefs API (opcional)
  WordPress REST API

Control de Versiones:
  Git
  GitHub/GitLab
```

### 2.2. Estructura Docker

```dockerfile
# docker-compose.yml
version: '3.8'

services:
  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/var/www/html
      - ./docker/nginx/conf.d:/etc/nginx/conf.d
    depends_on:
      - php

  php:
    build: ./docker/php
    volumes:
      - ./:/var/www/html
    environment:
      - PHP_MEMORY_LIMIT=512M

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: marketing_control_panel
      MYSQL_USER: ${DB_USER}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    volumes:
      - mysql_data:/var/lib/mysql
      - ./docker/mysql/init:/docker-entrypoint-initdb.d

  python:
    build: ./docker/python
    volumes:
      - ./:/app
    command: tail -f /dev/null  # Keep alive para ejecutar scripts on-demand

volumes:
  mysql_data:
```

### 2.3. Estructura de Carpetas

```
marketing-control-panel/
├── docker/                       # Configuración Docker
│   ├── nginx/
│   ├── php/
│   ├── mysql/
│   └── python/
│
├── public/                       # Document root
│   ├── index.php                 # Entry point
│   ├── assets/                   # Limitless template assets
│   │   ├── css/
│   │   ├── js/
│   │   ├── images/
│   │   └── fonts/
│   └── uploads/                  # Archivos subidos por usuarios
│
├── src/                          # Código fuente modular
│   ├── Core/                     # Core del sistema
│   │   ├── Router.php
│   │   ├── Database.php
│   │   ├── Auth.php
│   │   ├── Session.php
│   │   └── Config.php
│   │
│   ├── Modules/                  # Módulos funcionales
│   │   ├── Cliente/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   ├── Views/
│   │   │   └── Services/
│   │   │
│   │   ├── PlanMarketing/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   ├── Views/
│   │   │   └── Services/
│   │   │
│   │   ├── AuditoriaSEO/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   ├── Views/
│   │   │   ├── Services/
│   │   │   └── Agents/           # Agentes SEO (Analista, Arquitecto, Operador)
│   │   │
│   │   ├── EmailMarketing/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   ├── Views/
│   │   │   └── Services/
│   │   │
│   │   └── Automatizaciones/
│   │       ├── Controllers/
│   │       ├── Models/
│   │       ├── Services/
│   │       └── Jobs/             # Tareas programadas
│   │
│   ├── Shared/                   # Código compartido
│   │   ├── Utils/
│   │   ├── Validators/
│   │   ├── Mailers/
│   │   └── API/                  # Wrappers de APIs externas
│   │
│   └── CLI/                      # Scripts de línea de comandos
│       ├── cron.php              # Tareas programadas
│       ├── import_data.php
│       └── generate_reports.php
│
├── data/                         # Datos del sistema
│   ├── clientes/                 # Datos por cliente
│   │   └── {cliente_id}/
│   │       ├── brief.json
│   │       ├── plan_marketing.json
│   │       ├── auditoria_seo.json
│   │       ├── arquitectura.json
│   │       └── logs/
│   │
│   ├── templates/                # Plantillas
│   │   ├── brief_template.json
│   │   ├── plan_template.json
│   │   └── email_templates/
│   │
│   └── imports/                  # Datos importados
│       ├── gsc/                  # Google Search Console
│       ├── ga4/                  # Google Analytics
│       ├── ahrefs/
│       └── screaming_frog/
│
├── scripts/                      # Scripts Python auxiliares
│   ├── process_gsc_data.py
│   ├── process_ga4_data.py
│   ├── run_screaming_frog.py
│   └── requirements.txt
│
├── config/                       # Configuración
│   ├── database.php
│   ├── api_credentials.php
│   ├── mcp_config.php
│   └── modules.php               # Registro de módulos
│
├── database/                     # Migraciones y seeds
│   ├── migrations/
│   │   ├── 001_create_clientes.sql
│   │   ├── 002_create_auditorias.sql
│   │   └── ...
│   └── seeds/
│       └── demo_data.sql
│
├── tests/                        # Tests
│   ├── Unit/
│   ├── Integration/
│   └── E2E/
│
├── .claude/                      # Sistema de desarrollo
│   ├── agents/
│   ├── commands/
│   ├── sessions/
│   └── doc/
│
├── .env.example                  # Variables de entorno ejemplo
├── .env                          # Variables de entorno (no subir a Git)
├── CLAUDE.md                     # Instrucciones para Claude
├── docker-compose.yml
├── README.md
└── composer.json                 # Dependencias PHP mínimas
```

---

## 3. Arquitectura del Sistema

### 3.1. Arquitectura Modular

```
┌──────────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                         │
│  (Limitless Template - Views)                                │
│                                                               │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐    │
│  │Dashboard │  │ Clientes │  │   SEO    │  │  Email   │    │
│  │  Views   │  │  Views   │  │  Views   │  │  Views   │    │
│  └──────────┘  └──────────┘  └──────────┘  └──────────┘    │
└────────────────────────┬─────────────────────────────────────┘
                         │
┌────────────────────────▼─────────────────────────────────────┐
│                   CONTROLLER LAYER                            │
│  (PHP Controllers - Routing & Business Logic)                │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Cliente    │  │ PlanMarketing│  │ AuditoriaSEO │      │
│  │  Controller  │  │  Controller  │  │  Controller  │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└────────────────────────┬─────────────────────────────────────┘
                         │
┌────────────────────────▼─────────────────────────────────────┐
│                    SERVICE LAYER                              │
│  (Business Logic - Orchestration)                            │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Cliente    │  │ PlanMarketing│  │ AuditoriaSEO │      │
│  │   Service    │  │   Service    │  │   Service    │      │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘      │
│         │                  │                  │              │
│  ┌──────▼──────────────────▼──────────────────▼───────┐     │
│  │          Agentes SEO (Analista, Arquitecto,        │     │
│  │               Operador - MCP Integration)           │     │
│  └─────────────────────────────────────────────────────┘     │
└────────────────────────┬─────────────────────────────────────┘
                         │
┌────────────────────────▼─────────────────────────────────────┐
│                     MODEL LAYER                               │
│  (Data Access - PDO)                                         │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Cliente    │  │ PlanMarketing│  │ AuditoriaSEO │      │
│  │    Model     │  │    Model     │  │    Model     │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└────────────────────────┬─────────────────────────────────────┘
                         │
┌────────────────────────▼─────────────────────────────────────┐
│                  DATA PERSISTENCE                             │
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │    MySQL     │  │  JSON Files  │  │   Logs       │      │
│  │   Database   │  │  (data/*)    │  │ (data/logs)  │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└───────────────────────────────────────────────────────────────┘
```

### 3.2. Patrón de Módulos

Cada módulo sigue esta estructura:

```php
// Ejemplo: src/Modules/Cliente/

Cliente/
├── Controllers/
│   └── ClienteController.php
│       - index()          # Listar clientes
│       - create()         # Formulario alta cliente
│       - store()          # Guardar cliente
│       - show($id)        # Ver detalle cliente
│       - edit($id)        # Formulario editar
│       - update($id)      # Actualizar cliente
│       - delete($id)      # Eliminar cliente
│
├── Models/
│   └── Cliente.php
│       - all()            # Obtener todos
│       - find($id)        # Obtener por ID
│       - create($data)    # Crear
│       - update($id, $data)
│       - delete($id)
│       - search($criteria)
│
├── Services/
│   ├── ClienteService.php
│   │   - crearCliente($datos)
│   │   - generarBrief($clienteId)
│   │   - notificarAlta($clienteId)
│   │
│   └── BriefService.php
│       - procesarRespuestas($datos)
│       - generarJSON($datos)
│       - validarCompletitud($brief)
│
└── Views/
    ├── index.php          # Lista clientes
    ├── create.php         # Form alta
    ├── show.php           # Detalle cliente
    └── partials/
        ├── form.php       # Form reutilizable
        └── card.php       # Card cliente
```

---

## 4. Módulos Funcionales

### 4.1. Módulo: CLIENTE

**Propósito:** Gestión del ciclo de vida del cliente

#### Funcionalidades:

**1. Alta de Cliente**
- Formulario de registro con datos básicos
- Generación automática de carpeta cliente
- Asignación de ID único
- Estado inicial: "Onboarding"

**2. Brief Inicial**
- Cuestionario guiado (basado en tus templates)
- Guardado progresivo (puede pausar y continuar)
- Generación de `brief.json`
- Validación de completitud

**3. Gestión de Clientes**
- Dashboard con todos los clientes
- Filtros: activos, en pausa, completados
- Búsqueda por nombre, dominio, etc.
- Acciones rápidas: ver, editar, archivar

**4. Perfil de Cliente**
- Información completa
- Historial de acciones
- Módulos activos
- Enlaces directos a auditorías, planes, etc.

#### Base de Datos:

```sql
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    empresa VARCHAR(255),
    dominio VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    estado ENUM('onboarding', 'activo', 'pausado', 'completado', 'archivado') DEFAULT 'onboarding',
    brief_completo BOOLEAN DEFAULT FALSE,
    brief_path VARCHAR(500),  -- data/clientes/{id}/brief.json
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_estado (estado),
    INDEX idx_dominio (dominio)
);
```

---

### 4.2. Módulo: PLAN DE MARKETING

**Propósito:** Definir estrategia y objetivos de marketing

#### Funcionalidades:

**1. Creación de Plan**
- Basado en brief del cliente
- Definición de objetivos SMART
- Selección de canales (SEO, SEM, Email, Social)
- Asignación de presupuesto
- Timeline del proyecto

**2. Estrategia de Contenidos**
- Definir pilares de contenido
- Keyword research inicial
- Calendario editorial
- Tipos de contenido (blog, landing, recursos)

**3. KPIs y Métricas**
- Definir métricas objetivo
- Benchmarks actuales
- Metas mensuales/trimestrales
- Dashboard de seguimiento

**4. Aprobación del Plan**
- Previsualización
- Generación de PDF
- Envío al cliente (opcional)
- Tracking de aprobación

#### Base de Datos:

```sql
CREATE TABLE planes_marketing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    objetivo_principal TEXT,
    objetivos_secundarios JSON,
    canales JSON,  -- ['seo', 'sem', 'email', 'social']
    presupuesto_total DECIMAL(10,2),
    duracion_meses INT,
    kpis JSON,
    estado ENUM('borrador', 'pendiente_aprobacion', 'aprobado', 'en_ejecucion', 'completado') DEFAULT 'borrador',
    plan_path VARCHAR(500),  -- data/clientes/{cliente_id}/plan_marketing.json
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);
```

---

### 4.3. Módulo: AUDITORÍA SEO

**Propósito:** Diagnóstico SEO completo con arquitectura propuesta

Este es el módulo más complejo y el primero a desarrollar completamente.

#### Funcionalidades:

**1. Recopilación de Datos**

**a) Importación Manual:**
- Google Search Console (CSV export)
- Google Analytics 4 (CSV export)
- Ahrefs (CSV export si tienen licencia)
- Screaming Frog (CSV/Excel export)

**b) Importación Automática (fase 2):**
- API Google Search Console
- API Google Analytics 4
- Ejecutar Screaming Frog headless

**c) Procesamiento:**
- Scripts Python procesan CSVs
- Normalizan datos
- Generan JSON consolidado
- Almacenan en `data/clientes/{id}/imports/`

**2. Auditoría Automática (Agente: Analista)**

Basado en `prompt_maestro_claude.md`, el Analista:

**Fase 0 - Contexto:**
- Lee brief del cliente
- Analiza competencia
- Define objetivos SEO

**Fase 1 - Keywords:**
- Procesa keyword research
- Identifica quick wins
- Detecta long tail
- Agrupa por intención

**Fase 2 - Datos Técnicos:**
- Analiza GSC: CTR, posiciones, queries
- Analiza GA4: tráfico, conversiones, bounce
- Analiza Ahrefs: backlinks, DR, competencia
- Analiza ScreamingFrog: errores, metas, velocidad

**Fase 3 - Arquitectura Actual:**
- Mapea estructura URLs actual
- Identifica problemas arquitectura
- Detecta canibalización keywords

**Fase 4 - Contenidos:**
- Inventario de contenido actual
- Gaps de contenido
- Oportunidades de optimización

**Output:** `data/clientes/{id}/auditoria_seo.json`

**3. Propuesta de Arquitectura (Agente: Arquitecto)**

El Arquitecto lee la auditoría y propone:

**a) Arquitectura de Información:**
- Estructura de URLs optimizada
- Mapeo keyword → URL
- Jerarquía de contenido
- Siloing temático

**b) Plan de Redirects:**
- URLs a migrar (301)
- URLs temporales (302)
- Priorización por tráfico/backlinks

**c) Plan de Contenidos:**
- Contenido a crear
- Contenido a optimizar
- Contenido a eliminar/consolidar

**d) Plan de Enlaces Internos:**
- Estrategia de enlazado
- Anchor texts
- Distribución de autoridad

**Output:** `data/clientes/{id}/arquitectura_propuesta.json`

**4. Plan de Ejecución**

Basado en la arquitectura aprobada:

**a) Fases del Plan:**
- Fase 1: Quick Wins (1 mes)
- Fase 2: Contenido Prioritario (2-3 meses)
- Fase 3: Expansión (3-6 meses)

**b) Tareas Detalladas:**
- Tipo: crear_contenido, optimizar_meta, configurar_redirect, etc.
- Prioridad: alta, media, baja
- Estimación horas
- Dependencias

**c) Drip Mode:**
- Max tareas por día/semana
- Configuración de lotes
- Aprobaciones requeridas

**Output:** `data/clientes/{id}/plan_ejecucion_seo.json`

**5. Dashboard de Auditoría**

Visualización en Limitless template:

**a) Resumen Ejecutivo:**
- Salud SEO (0-100)
- Hallazgos clave (3-5 bullets)
- Oportunidades (3-5 bullets)
- Potencial tráfico estimado

**b) Métricas por Fase:**
- Fase 0: Objetivos vs realidad
- Fase 1: Keywords (volumen, dificultad, oportunidades)
- Fase 2: Técnico (errores, velocidad, backlinks)
- Fase 3: Arquitectura (problemas detectados)
- Fase 4: Contenidos (gaps, thin content)

**c) Visualizaciones:**
- Chart CTR promedio vs benchmark
- Chart distribución keywords por intención
- Chart salud técnica (radar chart)
- Chart top páginas con oportunidad

**d) Plan Propuesto:**
- Timeline visual (Gantt simple)
- Nodos prioritarios
- Redirects necesarios
- Estimación impacto/esfuerzo

#### Base de Datos:

```sql
CREATE TABLE auditorias_seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    plan_marketing_id INT,
    nombre VARCHAR(255),
    fecha_auditoria DATE NOT NULL,
    fuentes JSON,  -- ['GSC', 'GA4', 'Ahrefs', 'ScreamingFrog']
    auditoria_path VARCHAR(500),  -- data/clientes/{id}/auditoria_seo.json
    arquitectura_path VARCHAR(500),
    plan_ejecucion_path VARCHAR(500),
    salud_seo_score INT,  -- 0-100
    potencial_trafico INT,
    estado ENUM('pendiente', 'en_progreso', 'completada', 'aprobada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_marketing_id) REFERENCES planes_marketing(id) ON DELETE SET NULL,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);

CREATE TABLE hallazgos_seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditoria_id INT NOT NULL,
    fase VARCHAR(50),  -- 'F0', 'F1', 'F2', 'F3', 'F4'
    tipo VARCHAR(50),  -- 'problema', 'oportunidad', 'recomendacion'
    severidad ENUM('critica', 'alta', 'media', 'baja'),
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    metricas JSON,  -- Datos cuantitativos asociados

    FOREIGN KEY (auditoria_id) REFERENCES auditorias_seo(id) ON DELETE CASCADE,
    INDEX idx_auditoria (auditoria_id),
    INDEX idx_fase (fase),
    INDEX idx_severidad (severidad)
);
```

---

### 4.4. Módulo: AUTOMATIZACIONES (MCP)

**Propósito:** Ejecutar acciones en WordPress y otros sistemas

Este módulo implementa la capa de ejecución del prompt_maestro.

#### Funcionalidades:

**1. Agente: Operador MCP**

Responsabilidades:
- Ejecutar tareas del plan aprobado
- Integración con WordPress REST API
- Logging obligatorio de toda acción
- Garantizar reversibilidad

**2. Tareas Automatizables:**

**a) WordPress:**
- Crear posts/páginas (como DRAFT)
- Actualizar posts existentes
- Crear redirects (plugin Redirection)
- Actualizar meta tags (Yoast SEO)
- Gestionar categorías/tags
- Programar publicaciones

**b) Google My Business:**
- Crear/actualizar fichas
- Publicar posts GMB
- Responder reseñas (con aprobación)

**c) Email Marketing:**
- Enviar campañas outreach
- Seguimiento de respuestas
- Gestión de contactos

**3. Drip Mode de Ejecución:**

```
Plan de Ejecución Aprobado
    ↓
Lote 1 (3 tareas)
    ↓
Ejecutar como DRAFT
    ↓
Mostrar preview al usuario
    ↓
¿Aprobar?
    ↓ SÍ
Publicar
    ↓
Log acción
    ↓
Siguiente lote
```

**4. Logging y Reversibilidad:**

Cada acción genera log:
```json
{
  "log_id": "LOG-2025-001",
  "timestamp": "2025-01-15T10:30:00Z",
  "tarea_id": "T001",
  "accion": "crear_post",
  "destino": "wordpress:cliente123",
  "params": {...},
  "resultado": {
    "ok": true,
    "post_id": 456,
    "url": "https://cliente.com/?p=456&preview=true"
  },
  "reversible": true,
  "comando_reversion": "DELETE /wp/v2/posts/456"
}
```

**5. Dashboard de Automatizaciones:**

- Tareas programadas (calendario)
- Tareas en ejecución
- Historial de acciones
- Logs de errores
- Queue de tareas pendientes aprobación

#### Base de Datos:

```sql
CREATE TABLE automatizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    tipo VARCHAR(50),  -- 'wordpress', 'gmb', 'email'
    accion VARCHAR(100),  -- 'crear_post', 'actualizar_meta', etc.
    estado ENUM('pendiente', 'en_progreso', 'completada', 'error', 'cancelada') DEFAULT 'pendiente',
    requiere_aprobacion BOOLEAN DEFAULT TRUE,
    aprobada BOOLEAN DEFAULT FALSE,
    aprobada_por VARCHAR(255),
    fecha_aprobacion TIMESTAMP NULL,
    params JSON,  -- Parámetros de la acción
    resultado JSON,  -- Resultado de la ejecución
    reversible BOOLEAN DEFAULT TRUE,
    comando_reversion TEXT,
    log_path VARCHAR(500),  -- data/clientes/{id}/logs/automatizaciones.json
    programada_para TIMESTAMP NULL,
    ejecutada_en TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado),
    INDEX idx_programada (programada_para)
);
```

---

### 4.5. Módulo: EMAIL MARKETING

**Propósito:** Captación de enlaces, outreach, newsletters

#### Funcionalidades:

**1. Gestión de Contactos:**
- Importar listas
- Categorizar (blogger, periodista, webmaster, etc.)
- Segmentación
- Campos personalizados

**2. Plantillas de Email:**
- Templates para outreach link building
- Templates para guest posting
- Templates para partnerships
- Variables dinámicas {nombre}, {sitio}, etc.

**3. Campañas de Outreach:**
- Crear campaña
- Seleccionar contactos
- Programar envíos (drip)
- Seguimiento automático
- Gestión de respuestas

**4. Tracking:**
- Emails enviados
- Tasa de apertura
- Tasa de respuesta
- Enlaces conseguidos
- ROI de campaña

**5. Dashboard:**
- Campañas activas
- Rendimiento
- Top contactos respondedores
- Enlaces conseguidos por campaña

#### Base de Datos:

```sql
CREATE TABLE contactos_email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    sitio_web VARCHAR(500),
    categoria VARCHAR(100),  -- 'blogger', 'periodista', 'webmaster'
    autoridad_dominio INT,
    notas TEXT,
    tags JSON,
    estado ENUM('activo', 'inactivo', 'bounced', 'spam') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_categoria (categoria),
    INDEX idx_email (email)
);

CREATE TABLE campanas_email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    objetivo VARCHAR(100),  -- 'link_building', 'guest_post', 'partnership'
    plantilla_id INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado ENUM('borrador', 'programada', 'activa', 'pausada', 'completada') DEFAULT 'borrador',
    total_contactos INT DEFAULT 0,
    emails_enviados INT DEFAULT 0,
    emails_abiertos INT DEFAULT 0,
    respuestas_recibidas INT DEFAULT 0,
    enlaces_conseguidos INT DEFAULT 0,
    drip_config JSON,  -- {dias_entre_envios: 2, max_por_dia: 10}
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);

CREATE TABLE emails_enviados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campana_id INT NOT NULL,
    contacto_id INT NOT NULL,
    asunto VARCHAR(255),
    cuerpo TEXT,
    enviado_en TIMESTAMP,
    abierto BOOLEAN DEFAULT FALSE,
    abierto_en TIMESTAMP NULL,
    respondido BOOLEAN DEFAULT FALSE,
    respondido_en TIMESTAMP NULL,
    enlace_conseguido BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (campana_id) REFERENCES campanas_email(id) ON DELETE CASCADE,
    FOREIGN KEY (contacto_id) REFERENCES contactos_email(id) ON DELETE CASCADE,
    INDEX idx_campana (campana_id),
    INDEX idx_contacto (contacto_id)
);
```

---

## 5. Historias de Usuario

### 5.1. Módulo Cliente

**HU-C01: Alta de Cliente**
```
Como gestor de marketing
Quiero dar de alta un nuevo cliente
Para comenzar a gestionar su marketing

Criterios de Aceptación:
- Formulario con campos: nombre, empresa, dominio, email, teléfono
- Validación de dominio (único, formato correcto)
- Creación automática de carpeta data/clientes/{id}/
- Redirección a brief inicial tras creación
- Mensaje de confirmación "Cliente {nombre} creado exitosamente"

Notas Técnicas:
- Controller: ClienteController::store()
- Validar dominio no duplicado
- Generar ID único
- Crear estructura carpetas
- Estado inicial: "onboarding"
```

**HU-C02: Brief Inicial**
```
Como gestor de marketing
Quiero completar el brief del cliente
Para entender sus necesidades y objetivos

Criterios de Aceptación:
- Cuestionario multi-paso (5-8 secciones)
- Guardado progresivo (AJAX)
- Indicador de progreso visual
- Poder pausar y continuar después
- Generación de data/clientes/{id}/brief.json al completar
- Validación de campos obligatorios antes de finalizar

Secciones del Brief:
1. Información de la empresa
2. Objetivos de marketing
3. Público objetivo
4. Competencia
5. Situación actual (web, SEO, SEM)
6. Presupuesto y recursos
7. Timeline esperado

Notas Técnicas:
- Controller: ClienteController::brief($id)
- Service: BriefService::guardarProgreso()
- Service: BriefService::generarJSON()
- AJAX para guardado automático cada sección
- Usar JSON schema para validación
```

**HU-C03: Dashboard de Clientes**
```
Como gestor de marketing
Quiero ver todos mis clientes en un dashboard
Para tener visión general y acceder rápidamente

Criterios de Aceptación:
- Tabla con clientes (nombre, empresa, dominio, estado, última actividad)
- Filtros: por estado, búsqueda por texto
- Ordenación por columnas
- Paginación (20 por página)
- Acciones rápidas: ver, editar, archivar
- Indicador visual de brief completado
- Indicador de módulos activos

Notas Técnicas:
- Controller: ClienteController::index()
- Vista: Limitless DataTables
- AJAX para filtros sin reload
- Iconos estado (Limitless icons)
```

---

### 5.2. Módulo Plan de Marketing

**HU-PM01: Crear Plan de Marketing**
```
Como gestor de marketing
Quiero crear un plan de marketing basado en el brief
Para definir la estrategia del cliente

Criterios de Aceptación:
- Wizard multi-paso (4-6 pasos)
- Paso 1: Objetivo principal + objetivos secundarios
- Paso 2: Selección de canales (checkboxes: SEO, SEM, Email, Social)
- Paso 3: Definición de KPIs por canal
- Paso 4: Presupuesto y distribución
- Paso 5: Timeline (duración en meses, hitos)
- Paso 6: Resumen y confirmación
- Generación de plan_marketing.json
- Previsualización PDF (opcional)

Notas Técnicas:
- Controller: PlanMarketingController::create()
- Service: PlanMarketingService::generarPlan()
- Usar wizard de Limitless template
- Validación progresiva
```

**HU-PM02: Dashboard de Plan**
```
Como gestor de marketing
Quiero ver el resumen del plan de marketing
Para supervisar el progreso vs objetivos

Criterios de Aceptación:
- Cards con KPIs principales
- Progress bars de objetivos (% completado)
- Timeline visual con hitos
- Alertas si hay desviaciones
- Botón "Ver plan completo" (PDF o modal)
- Botón "Editar plan" (solo si no está en ejecución)

Notas Técnicas:
- Vista: dashboard con charts (ApexCharts)
- Datos desde plan_marketing.json
- Calcular % completado en base a tareas completadas
```

---

### 5.3. Módulo Auditoría SEO

**HU-SEO01: Importar Datos para Auditoría**
```
Como gestor de marketing
Quiero importar datos de fuentes externas
Para realizar la auditoría SEO

Criterios de Aceptación:
- Form upload múltiples archivos
- Soportar: CSV, Excel, JSON
- Validar formato de cada fuente:
  * GSC: columnas query, impressions, clicks, ctr, position
  * GA4: columnas page, pageviews, users, bounce_rate
  * Ahrefs: columnas backlink_url, domain_rating, anchor_text
  * ScreamingFrog: columnas url, status_code, title, meta_description
- Procesamiento en background (Python scripts)
- Barra de progreso durante procesamiento
- Notificación al completar
- Almacenar en data/clientes/{id}/imports/

Notas Técnicas:
- Controller: AuditoriaController::importar()
- Service: ImportService::procesarCSV($fuente, $archivo)
- Scripts Python en scripts/process_*_data.py
- Queue de jobs (tabla jobs en BD)
- WebSocket o polling para progress bar
```

**HU-SEO02: Ejecutar Auditoría Automática**
```
Como gestor de marketing
Quiero ejecutar la auditoría SEO automáticamente
Para obtener el diagnóstico sin intervención manual

Criterios de Aceptación:
- Botón "Ejecutar Auditoría" (solo si datos importados)
- Modal de confirmación
- Ejecución en background
- Indicador de progreso por fase:
  * Fase 0: Contexto ✅
  * Fase 1: Keywords ⏳
  * Fase 2: Datos Técnicos ⏸️
  * etc.
- Al completar:
  * Generar auditoria_seo.json
  * Calcular salud_seo_score (0-100)
  * Identificar hallazgos clave
  * Redirigir a dashboard de auditoría
- Notificación: "Auditoría completada para {cliente}"

Notas Técnicas:
- Service: AuditoriaService::ejecutarAuditoria($clienteId)
- Agente Analista (lógica en Service)
- Leer datos de imports/
- Procesar según prompt_maestro_claude.md
- Guardar en auditoria_seo.json
- Actualizar tabla auditorias_seo
```

**HU-SEO03: Visualizar Dashboard de Auditoría**
```
Como gestor de marketing
Quiero ver el dashboard de auditoría SEO
Para entender el estado del sitio del cliente

Criterios de Aceptación:
- Hero section con "Salud SEO" (gauge chart 0-100)
- Card "Hallazgos Clave" (3-5 bullets con iconos)
- Card "Oportunidades" (3-5 bullets con estimación impacto)
- Tabs por fase:
  * Tab Contexto: objetivos, competencia
  * Tab Keywords: tabla keywords prioritarias, charts volumen/dificultad
  * Tab Técnico: errores críticos, charts CTR/velocidad
  * Tab Arquitectura: mapa sitio visual, problemas detectados
  * Tab Contenidos: inventario, gaps, thin content
- Botón "Generar Propuesta de Arquitectura" (si auditoría completada)
- Botón "Exportar PDF"

Notas Técnicas:
- Vista: Limitless dashboard layout
- Charts: ApexCharts
- Datos desde auditoria_seo.json
- Tabla keywords con DataTables (sorting, filtering)
```

**HU-SEO04: Generar Propuesta de Arquitectura**
```
Como gestor de marketing
Quiero generar automáticamente la propuesta de arquitectura
Para tener un plan de acción concreto

Criterios de Aceptación:
- Botón en dashboard auditoría
- Modal confirmación (mostrando inputs: auditoría + brief)
- Ejecución en background
- Al completar:
  * Generar arquitectura_propuesta.json
  * Incluir:
    - Arquitectura de información (diagrama textual)
    - Nodos propuestos (landing/hub/spoke)
    - Mapeo keyword → URL
    - Redirects 301/302 necesarios
    - Plan de enlaces internos
    - Fases de implementación
  * Redirigir a vista de arquitectura propuesta
- Notificación: "Arquitectura propuesta generada"

Notas Técnicas:
- Service: ArquitecturaService::generarPropuesta($auditoriaId)
- Agente Arquitecto (lógica en Service)
- Leer auditoria_seo.json + brief.json
- Algoritmos según prompt_maestro_claude.md
- Guardar en arquitectura_propuesta.json
```

**HU-SEO05: Visualizar y Aprobar Arquitectura**
```
Como gestor de marketing
Quiero revisar la arquitectura propuesta
Para aprobarla o hacer ajustes antes de ejecutar

Criterios de Aceptación:
- Vista con secciones:
  * Resumen: estrategia seleccionada, razonamiento
  * Nodos: tabla con nodos (URL, keyword, tipo, prioridad)
  * Redirects: tabla con redirects (from, to, tipo, tráfico afectado)
  * Plan de fases: timeline visual con tareas por fase
  * Métricas: potencial tráfico, horas estimadas, impacto
- Cada nodo expandible (ver detalles: contenido requerido, enlaces)
- Poder editar JSON directamente (modal editor JSON)
- Botón "Aprobar Arquitectura"
- Botón "Generar Plan de Ejecución" (solo si aprobada)

Notas Técnicas:
- Vista: layout con tabs
- Tabla nodos: DataTables expandible
- Editor JSON: CodeMirror o Monaco Editor
- Validar JSON al guardar ediciones
- Marcar arquitectura.estado = 'aprobada'
```

**HU-SEO06: Generar Plan de Ejecución**
```
Como gestor de marketing
Quiero convertir la arquitectura en plan ejecutable
Para organizar la implementación en fases

Criterios de Aceptación:
- Input: arquitectura_propuesta.json aprobada
- Configuración drip mode:
  * Max tareas por día
  * Requiere aprobación por lote
  * Auto-publicar (sí/no)
- Output: plan_ejecucion_seo.json con:
  * Fases (1, 2, 3...)
  * Lotes por fase
  * Tareas detalladas (tipo, params, estimación, prioridad)
  * Dependencias entre tareas
  * Timeline programado
- Vista timeline Gantt (simple)
- Botón "Comenzar Ejecución" (si plan generado)

Notas Técnicas:
- Service: PlanEjecucionService::generar($arquitecturaId, $config)
- Convertir nodos en tareas
- Convertir redirects en tareas
- Aplicar priorización
- Distribuir en lotes según drip_config
- Guardar en plan_ejecucion_seo.json
```

---

### 5.4. Módulo Automatizaciones

**HU-AUTO01: Ejecutar Lote de Tareas (Drip Mode)**
```
Como gestor de marketing
Quiero ejecutar un lote de tareas del plan SEO
Para ir implementando progresivamente

Criterios de Aceptación:
- Vista: Lista de lotes pendientes
- Seleccionar lote a ejecutar
- Modal confirmación mostrando tareas del lote:
  * T001: Crear página /hotel-boutique/
  * T002: Redirect 301 /old-url/ → /new-url/
  * T003: Optimizar meta tags página X
- Botón "Ejecutar Lote"
- Ejecución:
  * Para cada tarea:
    - Ejecutar acción (ej: llamada WordPress API)
    - Si es contenido: crear como DRAFT
    - Generar log
    - Mostrar resultado en tiempo real
  * Al finalizar tarea: mostrar preview si aplicable
  * Pedir aprobación para publicar
- Al completar lote:
  * Actualizar progreso_plan.json
  * Notificación: "Lote 1 completado: 3/3 tareas OK"
  * Mostrar siguiente lote disponible

Notas Técnicas:
- Controller: AutomatizacionController::ejecutarLote($loteId)
- Service: MCPService::ejecutarTarea($tarea)
- Para WordPress:
  * Usar WP REST API
  * POST /wp/v2/posts (crear draft)
  * POST /wp/v2/posts/{id} (publish si aprobado)
- Logging en tabla automatizaciones + JSON
- WebSocket para updates en tiempo real (opcional)
```

**HU-AUTO02: Previsualizar Borrador Antes de Publicar**
```
Como gestor de marketing
Quiero ver el preview del contenido creado como draft
Para aprobarlo antes de publicar

Criterios de Aceptación:
- Después de crear draft en WordPress
- Mostrar card con:
  * Título del post
  * URL preview (WordPress preview link)
  * Botón "Ver Preview" (abre en nueva pestaña)
  * Extracto del contenido (primeros 200 chars)
  * Estadísticas: palabras, H2s, imágenes
- Opciones:
  * ✅ Aprobar y Publicar
  * ✏️ Editar en WordPress (abrir editor WP)
  * ❌ Rechazar (eliminar draft)
  * ⏸️ Pausar (dejar como draft, revisar después)
- Si aprueba:
  * Cambiar status a "publish" vía API
  * Generar log de publicación
  * Marcar tarea como completada
  * Continuar con siguiente tarea

Notas Técnicas:
- Vista: modal o página dedicada
- Obtener preview_link desde WP API response
- AJAX para aprobar/rechazar
- Si rechaza: DELETE /wp/v2/posts/{id}?force=true
```

**HU-AUTO03: Visualizar Logs de Automatizaciones**
```
Como gestor de marketing
Quiero ver el historial de automatizaciones ejecutadas
Para auditar y troubleshooting

Criterios de Aceptación:
- Vista: tabla logs
- Columnas: fecha/hora, cliente, tipo acción, destino, estado, detalles
- Filtros:
  * Por cliente
  * Por tipo acción
  * Por estado (ok/error)
  * Por rango fechas
- Cada log expandible:
  * Params ejecutados (JSON colapsado)
  * Resultado detallado
  * Comando de reversión (si aplica)
- Acciones:
  * Ver detalles completos (modal)
  * Revertir acción (si reversible y confirmación)
  * Re-ejecutar (si error)
- Exportar logs (CSV, JSON)

Notas Técnicas:
- Controller: AutomatizacionController::logs()
- Vista: DataTables con row expansion
- Leer de tabla automatizaciones
- Para revertir: ejecutar comando_reversion
- Generar nuevo log de reversión
```

---

### 5.5. Módulo Email Marketing

**HU-EMAIL01: Importar Contactos**
```
Como gestor de marketing
Quiero importar una lista de contactos
Para gestionar campañas de outreach

Criterios de Aceptación:
- Form upload CSV
- Formato esperado: nombre, email, sitio_web, categoria
- Validación:
  * Email válido
  * Email no duplicado (update si existe)
- Categorización automática si sitio_web presente:
  * Analizar DA (si API Moz/Ahrefs disponible)
  * Inferir categoría por TLD o contenido
- Preview antes de confirmar import
- Importar en background si >100 contactos
- Notificación al completar

Notas Técnicas:
- Controller: ContactoController::importar()
- Service: ContactoService::procesarCSV($archivo)
- Validación email: filter_var FILTER_VALIDATE_EMAIL
- Check duplicados: query por email
- API Moz para DA (opcional)
```

**HU-EMAIL02: Crear Campaña de Outreach**
```
Como gestor de marketing
Quiero crear una campaña de link building
Para conseguir enlaces para el cliente

Criterios de Aceptación:
- Wizard campaña:
  * Paso 1: Nombre, cliente, objetivo (link_building/guest_post)
  * Paso 2: Seleccionar plantilla email
  * Paso 3: Seleccionar contactos (filtros + búsqueda)
  * Paso 4: Configurar drip:
    - Días entre envíos
    - Max emails por día
    - Horario envío (mañana/tarde)
  * Paso 5: Previsualización email con variables sustituidas
  * Paso 6: Programar inicio
- Guardar campaña (estado: programada)
- Cron ejecutará envíos según config

Criterios de Aceptación (continuación):
- Variables soportadas en template:
  * {{nombre}} - nombre contacto
  * {{sitio}} - sitio web contacto
  * {{cliente_nombre}} - nombre cliente
  * {{cliente_sitio}} - sitio cliente
  * {{recurso_url}} - URL del recurso a promocionar
- Preview renderiza variables con datos reales de muestra

Notas Técnicas:
- Controller: CampanaController::create()
- Service: EmailTemplateService::renderizar($template, $variables)
- Validar sintaxis variables: {{ }}
- Guardar en campanas_email
```

**HU-EMAIL03: Envío Automático Drip**
```
Como sistema
Quiero enviar emails de campaña automáticamente
Para ejecutar outreach sin intervención manual

Criterios de Aceptación:
- Cron ejecuta cada hora (o configurado)
- Por cada campaña activa:
  * Verificar si toca envío (según drip_config)
  * Obtener próximos contactos a enviar (max_por_dia)
  * Por cada contacto:
    - Renderizar email (sustituir variables)
    - Enviar vía PHPMailer/SMTP
    - Registrar en emails_enviados
    - Marcar timestamp enviado_en
  * Actualizar campaña.emails_enviados
- Si todos enviados: cambiar estado a "completada"
- Log de actividad

Notas Técnicas:
- Script: src/CLI/cron.php
- Function: procesarCampanas()
- Usar PHPMailer con SMTP configurado
- Rate limiting: max X por hora para evitar spam
- Manejar bounces (webhook SMTP provider)
```

**HU-EMAIL04: Tracking de Apertura y Respuesta**
```
Como gestor de marketing
Quiero saber qué contactos abrieron el email
Para hacer seguimiento

Criterios de Aceptación:
- Pixel tracking para apertura:
  * Insertar <img> 1x1 en email
  * URL: /track/open/{email_enviado_id}/pixel.gif
  * Al cargar imagen: marcar abierto=true, abierto_en=now()
- Tracking de respuesta (manual o automático):
  * Manual: botón "Marcar como respondido" en dashboard
  * Automático: parsing de IMAP inbox (fase 2)
- Dashboard campaña muestra:
  * Total enviados
  * % abiertos
  * % respondidos
  * Top contactos (más activos)

Notas Técnicas:
- Route: /track/open/{id}/pixel.gif
- Controller: TrackingController::pixel($id)
- Actualizar emails_enviados.abierto = 1
- Para respuestas automáticas: PHP IMAP extension
```

---

## 6. Flujos de Trabajo

### 6.1. Flujo Completo: Onboarding → Ejecución

```
[INICIO] Usuario da de alta cliente
    ↓
1. ALTA CLIENTE
   - Form con datos básicos
   - Crear registro en DB
   - Crear carpeta data/clientes/{id}/
   - Estado: "onboarding"
    ↓
2. BRIEF INICIAL
   - Cuestionario multi-paso
   - Guardado progresivo
   - Generar brief.json
   - Estado: "brief_completado"
    ↓
3. PLAN DE MARKETING
   - Wizard plan
   - Definir objetivos, canales, KPIs
   - Generar plan_marketing.json
   - Estado: "plan_creado"
    ↓
4. AUDITORÍA SEO (si SEO en canales)
   ├─> 4.1. IMPORTAR DATOS
   │   - Upload CSVs (GSC, GA4, Ahrefs, SF)
   │   - Procesar con Python
   │   - Almacenar en imports/
   │
   ├─> 4.2. EJECUTAR AUDITORÍA (Agente Analista)
   │   - Procesar datos importados
   │   - Analizar F0, F1, F2, F3, F4
   │   - Generar auditoria_seo.json
   │   - Calcular salud_seo_score
   │
   ├─> 4.3. GENERAR ARQUITECTURA (Agente Arquitecto)
   │   - Leer auditoría + brief
   │   - Diseñar arquitectura objetivo
   │   - Proponer nodos, redirects, plan
   │   - Generar arquitectura_propuesta.json
   │
   ├─> 4.4. APROBAR ARQUITECTURA (Usuario)
   │   - Revisar propuesta
   │   - Editar si necesario
   │   - Marcar como aprobada
   │
   └─> 4.5. GENERAR PLAN EJECUCIÓN
       - Convertir arquitectura en tareas
       - Configurar drip mode
       - Generar plan_ejecucion_seo.json
    ↓
5. EJECUCIÓN (Agente Operador MCP)
   ├─> 5.1. Ejecutar Lote 1
   │   - Seleccionar próximo lote
   │   - Por cada tarea:
   │     * Ejecutar acción (WordPress API, etc)
   │     * Crear como DRAFT
   │     * Mostrar preview
   │     * Esperar aprobación
   │     * Publicar si aprobado
   │     * Generar log
   │   - Actualizar progreso
   │
   ├─> 5.2. Ejecutar Lote 2
   │   [Repetir proceso]
   │
   └─> 5.N. Hasta completar plan
    ↓
6. SEGUIMIENTO Y REPORTING
   - Dashboard con métricas
   - Comparar objetivos vs resultados
   - Ajustar estrategia si necesario
    ↓
[FIN] Cliente con marketing gestionado y optimizado
```

### 6.2. Flujo: Auditoría SEO Detallado

```
[INICIO] Usuario en dashboard cliente
    ↓
Click "Nueva Auditoría SEO"
    ↓
┌─────────────────────────────────────────┐
│    PASO 1: IMPORTAR DATOS               │
│                                         │
│  [Upload CSV Google Search Console]    │
│  [Upload CSV Google Analytics 4]       │
│  [Upload CSV Ahrefs] (opcional)        │
│  [Upload CSV Screaming Frog]           │
│                                         │
│  Botón: "Procesar Datos"               │
└─────────────────┬───────────────────────┘
                  ↓
        Procesamiento Background
        (Python scripts)
                  ↓
        Datos guardados en:
        data/clientes/{id}/imports/
                  ↓
        Notificación: "Datos procesados OK"
                  ↓
┌─────────────────────────────────────────┐
│    PASO 2: EJECUTAR AUDITORÍA           │
│                                         │
│  Botón: "Ejecutar Auditoría"           │
│                                         │
│  [Progress Bar]                         │
│  ▓▓▓▓▓▓░░░░ 60%                        │
│  Analizando Fase 2: Datos Técnicos...  │
└─────────────────┬───────────────────────┘
                  ↓
        Agente Analista procesa:
        ├─> Fase 0: Contexto
        ├─> Fase 1: Keywords
        ├─> Fase 2: Técnico
        ├─> Fase 3: Arquitectura
        └─> Fase 4: Contenidos
                  ↓
        Genera: auditoria_seo.json
        Calcula: salud_seo_score
                  ↓
        Notificación: "Auditoría completada"
        Redirect a: /auditoria/{id}/dashboard
                  ↓
┌─────────────────────────────────────────┐
│    DASHBOARD AUDITORÍA                  │
│                                         │
│  ┌─────────────────┐                   │
│  │ Salud SEO: 67/100│ [Gauge Chart]    │
│  └─────────────────┘                   │
│                                         │
│  Hallazgos Clave:                       │
│  • 127 errores 404                      │
│  • CTR 2.1% vs 3.5% benchmark          │
│  • 15 keywords posiciones 11-20         │
│                                         │
│  [Tab Contexto][Tab Keywords][...]     │
│                                         │
│  Botón: "Generar Arquitectura"         │
└─────────────────┬───────────────────────┘
                  ↓
        Click "Generar Arquitectura"
                  ↓
┌─────────────────────────────────────────┐
│    PASO 3: GENERAR ARQUITECTURA         │
│                                         │
│  Modal confirmación                     │
│  Botón: "Generar"                      │
└─────────────────┬───────────────────────┘
                  ↓
        Agente Arquitecto procesa:
        ├─> Lee auditoria_seo.json
        ├─> Lee brief.json
        ├─> Diseña arquitectura
        ├─> Propone nodos
        ├─> Propone redirects
        └─> Crea plan de fases
                  ↓
        Genera: arquitectura_propuesta.json
                  ↓
        Notificación: "Arquitectura generada"
        Redirect a: /arquitectura/{id}
                  ↓
┌─────────────────────────────────────────┐
│    VISTA ARQUITECTURA PROPUESTA         │
│                                         │
│  Estrategia: Hub & Spoke               │
│  Razonamiento: [...]                    │
│                                         │
│  [Tab Nodos][Tab Redirects][Tab Plan]  │
│                                         │
│  Nodos (25):                            │
│  [DataTable con nodos]                  │
│                                         │
│  Botones:                               │
│  [Editar JSON] [Aprobar] [Exportar PDF]│
└─────────────────┬───────────────────────┘
                  ↓
        Click "Aprobar"
                  ↓
        arquitectura.estado = 'aprobada'
                  ↓
        Habilita: "Generar Plan Ejecución"
                  ↓
┌─────────────────────────────────────────┐
│    PASO 4: PLAN DE EJECUCIÓN            │
│                                         │
│  Config Drip Mode:                      │
│  Max tareas/día: [3]                    │
│  Requiere aprobación: [✓]              │
│  Auto-publicar: [ ]                     │
│                                         │
│  Botón: "Generar Plan"                 │
└─────────────────┬───────────────────────┘
                  ↓
        Genera: plan_ejecucion_seo.json
        Con:
        ├─> Fase 1: 15 tareas
        ├─> Fase 2: 30 tareas
        └─> Fase 3: 20 tareas
                  ↓
        Vista Timeline (Gantt)
                  ↓
        Habilita: "Comenzar Ejecución"
                  ↓
[LISTO PARA EJECUTAR]
```

---

## 7. Base de Datos

### 7.1. Schema Completo

```sql
-- ============================================
-- CORE: CLIENTES
-- ============================================

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    empresa VARCHAR(255),
    dominio VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    logo_url VARCHAR(500),
    estado ENUM('onboarding', 'activo', 'pausado', 'completado', 'archivado') DEFAULT 'onboarding',
    brief_completo BOOLEAN DEFAULT FALSE,
    brief_path VARCHAR(500),
    notas TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_estado (estado),
    INDEX idx_dominio (dominio),
    INDEX idx_created (created_at)
);

-- ============================================
-- MÓDULO: PLAN DE MARKETING
-- ============================================

CREATE TABLE planes_marketing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    objetivo_principal TEXT,
    objetivos_secundarios JSON,
    canales JSON,
    presupuesto_total DECIMAL(10,2),
    duracion_meses INT,
    fecha_inicio DATE,
    fecha_fin_estimada DATE,
    kpis JSON,
    estado ENUM('borrador', 'pendiente_aprobacion', 'aprobado', 'en_ejecucion', 'completado') DEFAULT 'borrador',
    plan_path VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);

CREATE TABLE kpis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_marketing_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    valor_actual DECIMAL(10,2),
    valor_objetivo DECIMAL(10,2),
    unidad VARCHAR(50),  -- 'visitas', 'conversiones', '%', etc
    canal VARCHAR(50),  -- 'seo', 'sem', 'email', etc
    frecuencia_medicion ENUM('diaria', 'semanal', 'mensual', 'trimestral'),

    FOREIGN KEY (plan_marketing_id) REFERENCES planes_marketing(id) ON DELETE CASCADE,
    INDEX idx_plan (plan_marketing_id)
);

CREATE TABLE mediciones_kpi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kpi_id INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    fecha_medicion DATE NOT NULL,
    notas TEXT,

    FOREIGN KEY (kpi_id) REFERENCES kpis(id) ON DELETE CASCADE,
    INDEX idx_kpi_fecha (kpi_id, fecha_medicion)
);

-- ============================================
-- MÓDULO: AUDITORÍA SEO
-- ============================================

CREATE TABLE auditorias_seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    plan_marketing_id INT,
    nombre VARCHAR(255),
    fecha_auditoria DATE NOT NULL,
    fuentes JSON,
    auditoria_path VARCHAR(500),
    arquitectura_path VARCHAR(500),
    plan_ejecucion_path VARCHAR(500),
    salud_seo_score INT,
    potencial_trafico INT,
    estado ENUM('pendiente', 'datos_importados', 'auditoria_completada', 'arquitectura_generada', 'arquitectura_aprobada', 'plan_generado', 'en_ejecucion', 'completada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (plan_marketing_id) REFERENCES planes_marketing(id) ON DELETE SET NULL,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);

CREATE TABLE hallazgos_seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditoria_id INT NOT NULL,
    fase VARCHAR(50),
    tipo VARCHAR(50),
    severidad ENUM('critica', 'alta', 'media', 'baja'),
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    metricas JSON,
    recomendacion TEXT,

    FOREIGN KEY (auditoria_id) REFERENCES auditorias_seo(id) ON DELETE CASCADE,
    INDEX idx_auditoria (auditoria_id),
    INDEX idx_fase (fase),
    INDEX idx_severidad (severidad)
);

CREATE TABLE keywords_auditoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditoria_id INT NOT NULL,
    keyword VARCHAR(255) NOT NULL,
    volumen INT,
    dificultad INT,
    cpc DECIMAL(5,2),
    intencion VARCHAR(50),  -- 'transaccional', 'informacional', 'navegacional'
    prioridad ENUM('alta', 'media', 'baja'),
    posicion_actual INT,
    url_actual VARCHAR(500),

    FOREIGN KEY (auditoria_id) REFERENCES auditorias_seo(id) ON DELETE CASCADE,
    INDEX idx_auditoria (auditoria_id),
    INDEX idx_prioridad (prioridad)
);

CREATE TABLE nodos_arquitectura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auditoria_id INT NOT NULL,
    tipo VARCHAR(50),  -- 'landing', 'hub', 'spoke', 'support'
    url_propuesta VARCHAR(500) NOT NULL,
    titulo_propuesto VARCHAR(255),
    keyword_principal VARCHAR(255),
    keywords_secundarias JSON,
    prioridad ENUM('alta', 'media', 'baja'),
    contenido_requerido JSON,
    estado ENUM('pendiente', 'en_progreso', 'completado') DEFAULT 'pendiente',

    FOREIGN KEY (auditoria_id) REFERENCES auditorias_seo(id) ON DELETE CASCADE,
    INDEX idx_auditoria (auditoria_id),
    INDEX idx_prioridad (prioridad),
    INDEX idx_estado (estado)
);

-- ============================================
-- MÓDULO: AUTOMATIZACIONES (MCP)
-- ============================================

CREATE TABLE automatizaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    auditoria_id INT,
    tipo VARCHAR(50),
    accion VARCHAR(100),
    destino VARCHAR(255),  -- 'wordpress:cliente123', 'gmb:cliente456'
    params JSON,
    estado ENUM('pendiente', 'en_progreso', 'completada', 'error', 'cancelada') DEFAULT 'pendiente',
    requiere_aprobacion BOOLEAN DEFAULT TRUE,
    aprobada BOOLEAN DEFAULT FALSE,
    aprobada_por VARCHAR(255),
    fecha_aprobacion TIMESTAMP NULL,
    resultado JSON,
    reversible BOOLEAN DEFAULT TRUE,
    comando_reversion TEXT,
    log_path VARCHAR(500),
    programada_para TIMESTAMP NULL,
    ejecutada_en TIMESTAMP NULL,
    error_mensaje TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (auditoria_id) REFERENCES auditorias_seo(id) ON DELETE SET NULL,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado),
    INDEX idx_programada (programada_para)
);

-- ============================================
-- MÓDULO: EMAIL MARKETING
-- ============================================

CREATE TABLE contactos_email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    sitio_web VARCHAR(500),
    categoria VARCHAR(100),
    autoridad_dominio INT,
    notas TEXT,
    tags JSON,
    estado ENUM('activo', 'inactivo', 'bounced', 'spam', 'desuscrito') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_categoria (categoria),
    INDEX idx_email (email),
    INDEX idx_estado (estado)
);

CREATE TABLE campanas_email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    objetivo VARCHAR(100),
    plantilla_id INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado ENUM('borrador', 'programada', 'activa', 'pausada', 'completada') DEFAULT 'borrador',
    total_contactos INT DEFAULT 0,
    emails_enviados INT DEFAULT 0,
    emails_abiertos INT DEFAULT 0,
    respuestas_recibidas INT DEFAULT 0,
    enlaces_conseguidos INT DEFAULT 0,
    drip_config JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_cliente (cliente_id),
    INDEX idx_estado (estado)
);

CREATE TABLE plantillas_email (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    cuerpo TEXT NOT NULL,
    variables JSON,  -- ['nombre', 'sitio', 'cliente_nombre']
    categoria VARCHAR(100),  -- 'link_building', 'guest_post', 'partnership'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_categoria (categoria)
);

CREATE TABLE emails_enviados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campana_id INT NOT NULL,
    contacto_id INT NOT NULL,
    asunto VARCHAR(255),
    cuerpo TEXT,
    enviado_en TIMESTAMP,
    abierto BOOLEAN DEFAULT FALSE,
    abierto_en TIMESTAMP NULL,
    clicks INT DEFAULT 0,
    respondido BOOLEAN DEFAULT FALSE,
    respondido_en TIMESTAMP NULL,
    enlace_conseguido BOOLEAN DEFAULT FALSE,
    notas TEXT,

    FOREIGN KEY (campana_id) REFERENCES campanas_email(id) ON DELETE CASCADE,
    FOREIGN KEY (contacto_id) REFERENCES contactos_email(id) ON DELETE CASCADE,
    INDEX idx_campana (campana_id),
    INDEX idx_contacto (contacto_id),
    INDEX idx_enviado (enviado_en)
);

-- ============================================
-- CORE: USUARIOS Y AUTH (para futuro multi-user)
-- ============================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'gestor', 'cliente') DEFAULT 'gestor',
    activo BOOLEAN DEFAULT TRUE,
    ultimo_acceso TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_email (email),
    INDEX idx_rol (rol)
);

-- Usuario admin por defecto (password: admin123 - cambiar en producción)
INSERT INTO usuarios (nombre, email, password, rol)
VALUES ('Admin', 'admin@mcp.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- ============================================
-- CORE: ACTIVIDAD Y LOGS
-- ============================================

CREATE TABLE actividad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    cliente_id INT,
    modulo VARCHAR(50),  -- 'cliente', 'auditoria', 'email', etc
    accion VARCHAR(100),
    descripcion TEXT,
    datos JSON,  -- Datos adicionales de la acción
    ip VARCHAR(45),
    user_agent VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_usuario (usuario_id),
    INDEX idx_cliente (cliente_id),
    INDEX idx_modulo (modulo),
    INDEX idx_created (created_at)
);

-- ============================================
-- CORE: JOBS QUEUE (para tareas background)
-- ============================================

CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(50) DEFAULT 'default',
    tipo VARCHAR(100) NOT NULL,
    payload JSON NOT NULL,
    intentos INT DEFAULT 0,
    max_intentos INT DEFAULT 3,
    estado ENUM('pendiente', 'procesando', 'completado', 'fallido') DEFAULT 'pendiente',
    disponible_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ejecutado_en TIMESTAMP NULL,
    completado_en TIMESTAMP NULL,
    error TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_queue_estado (queue, estado),
    INDEX idx_disponible (disponible_en)
);
```

---

## 8. APIs e Integraciones

### 8.1. Google Search Console API

**Propósito:** Obtener datos de queries, impresiones, clicks automáticamente

**Autenticación:** OAuth 2.0

**Endpoints usados:**
- `searchanalytics.query` - Obtener datos de búsquedas

**Wrapper PHP:**
```php
// src/Shared/API/GoogleSearchConsoleAPI.php

class GoogleSearchConsoleAPI {
    private $client;

    public function __construct($credentials) {
        $this->client = new Google_Client();
        $this->client->setAuthConfig($credentials);
        $this->client->addScope(Google_Service_SearchConsole::WEBMASTERS_READONLY);
    }

    public function getQueries($siteUrl, $startDate, $endDate, $dimension = 'query') {
        $service = new Google_Service_SearchConsole($this->client);

        $request = new Google_Service_SearchConsole_SearchAnalyticsQueryRequest();
        $request->setStartDate($startDate);
        $request->setEndDate($endDate);
        $request->setDimensions([$dimension]);
        $request->setRowLimit(25000);

        $response = $service->searchanalytics->query($siteUrl, $request);

        return $response->getRows();
    }

    public function exportToCSV($siteUrl, $startDate, $endDate, $outputPath) {
        $rows = $this->getQueries($siteUrl, $startDate, $endDate);

        $fp = fopen($outputPath, 'w');
        fputcsv($fp, ['query', 'clicks', 'impressions', 'ctr', 'position']);

        foreach ($rows as $row) {
            fputcsv($fp, [
                $row->getKeys()[0],
                $row->getClicks(),
                $row->getImpressions(),
                $row->getCtr(),
                $row->getPosition()
            ]);
        }

        fclose($fp);
    }
}
```

### 8.2. Google Analytics 4 API

**Propósito:** Obtener datos de tráfico, conversiones, comportamiento

**Autenticación:** OAuth 2.0

**Wrapper PHP:**
```php
// src/Shared/API/GoogleAnalytics4API.php

class GoogleAnalytics4API {
    private $client;

    public function __construct($credentials) {
        $this->client = new Google_Client();
        $this->client->setAuthConfig($credentials);
        $this->client->addScope('https://www.googleapis.com/auth/analytics.readonly');
    }

    public function getPageData($propertyId, $startDate, $endDate) {
        $service = new Google_Service_AnalyticsData($this->client);

        $request = new Google_Service_AnalyticsData_RunReportRequest();
        $request->setDateRanges([
            new Google_Service_AnalyticsData_DateRange([
                'startDate' => $startDate,
                'endDate' => $endDate
            ])
        ]);
        $request->setDimensions([
            new Google_Service_AnalyticsData_Dimension(['name' => 'pagePath'])
        ]);
        $request->setMetrics([
            new Google_Service_AnalyticsData_Metric(['name' => 'screenPageViews']),
            new Google_Service_AnalyticsData_Metric(['name' => 'sessions']),
            new Google_Service_AnalyticsData_Metric(['name' => 'bounceRate'])
        ]);

        $response = $service->properties->runReport('properties/' . $propertyId, $request);

        return $response->getRows();
    }
}
```

### 8.3. WordPress REST API

**Propósito:** Crear/actualizar contenido, gestionar redirects

**Autenticación:** Application Passwords

**Wrapper PHP:**
```php
// src/Shared/API/WordPressAPI.php

class WordPressAPI {
    private $siteUrl;
    private $username;
    private $password;  // Application Password

    public function __construct($siteUrl, $username, $password) {
        $this->siteUrl = rtrim($siteUrl, '/');
        $this->username = $username;
        $this->password = $password;
    }

    private function request($method, $endpoint, $data = []) {
        $url = $this->siteUrl . '/wp-json/wp/v2/' . ltrim($endpoint, '/');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 400) {
            throw new Exception("WordPress API Error: HTTP $httpCode - $response");
        }

        return json_decode($response, true);
    }

    public function createPost($title, $content, $status = 'draft', $postType = 'post') {
        return $this->request('POST', '/posts', [
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'type' => $postType
        ]);
    }

    public function updatePost($postId, $data) {
        return $this->request('PUT', "/posts/$postId", $data);
    }

    public function deletePost($postId, $force = true) {
        $endpoint = "/posts/$postId" . ($force ? '?force=true' : '');
        return $this->request('DELETE', $endpoint);
    }

    // Yoast SEO meta (requiere Yoast REST API activo)
    public function updateYoastMeta($postId, $metaTitle, $metaDescription, $focusKeyword) {
        // Implementación dependiendo de la versión de Yoast
        // Puede requerir plugin adicional o custom endpoint
    }
}
```

### 8.4. Screaming Frog (Headless)

**Propósito:** Crawling técnico automático

**Método:** Ejecutar SF en línea de comandos

**Script Python:**
```python
# scripts/run_screaming_frog.py

import subprocess
import json
import sys

def run_screaming_frog_crawl(url, output_dir, max_urls=10000):
    """
    Ejecuta Screaming Frog en modo headless y exporta resultados

    Requiere: Screaming Frog CLI license
    """

    sf_path = r"C:\Program Files (x86)\Screaming Frog SEO Spider\ScreamingFrogSEOSpiderCli.exe"

    # Configuración del crawl
    config = {
        "url": url,
        "maxUrls": max_urls,
        "respectRobotsTxt": True,
        "followRedirects": True
    }

    # Ejecutar crawl
    cmd = [
        sf_path,
        "--crawl", url,
        "--headless",
        "--output-folder", output_dir,
        "--export-tabs", "Internal:All,Response Codes:All,Page Titles:All,Meta Description:All",
        "--export-format", "csv"
    ]

    process = subprocess.run(cmd, capture_output=True, text=True)

    if process.returncode != 0:
        print(f"Error: {process.stderr}", file=sys.stderr)
        sys.exit(1)

    print(json.dumps({
        "status": "success",
        "output_dir": output_dir,
        "message": "Crawl completado"
    }))

if __name__ == "__main__":
    if len(sys.argv) < 3:
        print("Usage: python run_screaming_frog.py <url> <output_dir>")
        sys.exit(1)

    url = sys.argv[1]
    output_dir = sys.argv[2]

    run_screaming_frog_crawl(url, output_dir)
```

---

## 9. Sistema .claude para Desarrollo

Esta sección define el ecosistema de agentes y workflows que usarás en Claude Code para **desarrollar** el Marketing Control Panel de forma incremental y organizada.

### 9.1. Concepto Fundamental

**IMPORTANTE:** El sistema .claude NO es la aplicación. El sistema .claude es tu "equipo virtual de desarrollo" que te ayuda a CONSTRUIR la aplicación.

```
┌─────────────────────────────────────────────────────────┐
│   SISTEMA .claude (DESARROLLO - ORQUESTACIÓN)           │
│                                                          │
│   ┌──────────────┐  ┌──────────────┐  ┌─────────────┐  │
│   │php-architect │  │php-developer │  │ db-architect│  │
│   │ (diseña)     │→ │ (implementa) │→ │ (migra DB)  │  │
│   └──────────────┘  └──────────────┘  └─────────────┘  │
│                                                          │
└─────────────────────┬────────────────────────────────────┘
                      │ CONSTRUYE
                      ↓
┌─────────────────────────────────────────────────────────┐
│   MARKETING CONTROL PANEL (APLICACIÓN PHP)              │
│                                                          │
│   ┌──────────────┐  ┌──────────────┐  ┌─────────────┐  │
│   │ Módulo       │  │ Módulo       │  │ Módulo      │  │
│   │ Cliente      │  │ AuditoriaSEO │  │ Email Mkt   │  │
│   └──────────────┘  └──────────────┘  └─────────────┘  │
│                                                          │
│   DENTRO de AuditoriaSEO está el Agente Analista/       │
│   Arquitecto/Operador (PARTE DE LA APLICACIÓN)          │
└─────────────────────────────────────────────────────────┘
```

### 9.2. Agentes de Desarrollo

Los agentes son especialistas que te ayudan a desarrollar diferentes aspectos del sistema.

#### 9.2.1. php-architect (Arquitecto PHP)

**Archivo:** `.claude/agents/php-architect.md`

```markdown
# PHP Architect Agent

## Rol
Especialista en diseño de arquitectura modular PHP para el Marketing Control Panel.

## Responsabilidades
- Diseñar estructura de módulos siguiendo patrón MVC
- Definir interfaces entre capas (Controller → Service → Model)
- Garantizar separación de responsabilidades
- Diseñar flujos de datos y dependencias
- Proponer patrones de diseño apropiados
- Revisar arquitectura existente y proponer mejoras

## Principios
1. **Modularidad**: Cada módulo es independiente
2. **SOLID**: Especialmente Single Responsibility y Dependency Inversion
3. **DRY**: Código compartido en src/Shared/
4. **Simplicidad**: Soluciones simples sobre complejas
5. **PSR-4**: Autoloading estándar

## Inputs Esperados
- Especificación funcional de un módulo
- Historias de usuario relacionadas
- Diagramas de flujo (si existen)
- Contexto del proyecto (CLAUDE.md, ESPECIFICACION_MARKETING_CONTROL_PANEL.md)

## Outputs Generados
- Estructura de carpetas propuesta
- Definición de clases (interfaces, no implementación completa)
- Diagrama de dependencias (textual o mermaid)
- Documento de decisiones arquitectónicas
- Recomendaciones para implementación

## Workflow Típico
1. Lee especificación del módulo a diseñar
2. Identifica entidades del dominio
3. Define controllers necesarios (routes)
4. Define services (lógica de negocio)
5. Define models (acceso a datos)
6. Propone estructura de carpetas
7. Documenta decisiones
8. Genera checklist para php-developer

## Ejemplo de Output

### Módulo: Cliente

**Entidades del Dominio:**
- Cliente (tabla: clientes)
- Brief (JSON file)

**Controllers:**
- ClienteController
  * index() → Lista clientes
  * create() → Form alta
  * store() → Guardar nuevo cliente
  * show($id) → Ver detalle
  * edit($id) → Form edición
  * update($id) → Actualizar
  * delete($id) → Eliminar
  * brief($id) → Form brief
  * storeBrief($id) → Guardar brief

**Services:**
- ClienteService
  * crearCliente($data): Cliente
  * validarDominio($dominio): bool
  * crearEstructuraCarpetas($clienteId): void
  * notificarAlta($clienteId): void

- BriefService
  * guardarProgreso($clienteId, $seccion, $data): void
  * obtenerProgreso($clienteId): array
  * generarJSON($clienteId, $data): string
  * validarCompletitud($brief): bool

**Models:**
- Cliente
  * all(): array
  * find($id): ?Cliente
  * create($data): Cliente
  * update($id, $data): bool
  * delete($id): bool
  * findByDominio($dominio): ?Cliente

**Estructura Propuesta:**
```
src/Modules/Cliente/
├── Controllers/
│   └── ClienteController.php
├── Services/
│   ├── ClienteService.php
│   └── BriefService.php
├── Models/
│   └── Cliente.php
└── Views/
    ├── index.php
    ├── create.php
    ├── show.php
    ├── edit.php
    └── brief.php
```

**Decisiones Arquitectónicas:**
1. Brief se guarda como JSON (no DB) para flexibilidad
2. Validación de dominio en Service, no Controller
3. Creación de carpetas delegada a Service
4. Brief multi-paso usa AJAX para guardado progresivo

## Comandos Relacionados
- `/design-module {nombre}` → Invoca este agente
```

#### 9.2.2. php-developer (Desarrollador PHP)

**Archivo:** `.claude/agents/php-developer.md`

```markdown
# PHP Developer Agent

## Rol
Implementa código PHP siguiendo las especificaciones del php-architect.

## Responsabilidades
- Escribir código PHP limpio y mantenible
- Implementar controllers, services, models según diseño
- Seguir estándares PSR-1, PSR-12
- Escribir código autodocumentado
- Manejar errores apropiadamente
- Validar inputs
- Implementar logging cuando necesario

## Principios
1. **Clean Code**: Nombres descriptivos, funciones pequeñas
2. **Error Handling**: Try-catch, validaciones, mensajes claros
3. **Security**: Escapar outputs, validar inputs, prepared statements
4. **Testing**: Código testeable (dependency injection)
5. **ABOUTME Comments**: Todos los archivos empiezan con ABOUTME

## Inputs Esperados
- Diseño arquitectónico (del php-architect)
- Historias de usuario específicas
- Especificación funcional

## Outputs Generados
- Archivos PHP implementados
- Comentarios ABOUTME en cada archivo
- TODO comments si algo queda pendiente
- Sugerencias de testing

## Convenciones de Código

### Estructura de Controller

```php
<?php
// ABOUTME: Controller para gestión de clientes
// ABOUTME: Maneja CRUD y brief inicial

namespace App\Modules\Cliente\Controllers;

use App\Core\Controller;
use App\Modules\Cliente\Services\ClienteService;
use App\Modules\Cliente\Services\BriefService;

class ClienteController extends Controller {
    private ClienteService $clienteService;
    private BriefService $briefService;

    public function __construct() {
        $this->clienteService = new ClienteService();
        $this->briefService = new BriefService();
    }

    public function index() {
        try {
            $clientes = $this->clienteService->obtenerTodos();
            $this->render('cliente/index', ['clientes' => $clientes]);
        } catch (\Exception $e) {
            $this->handleError($e);
        }
    }

    public function store() {
        try {
            $data = $this->request->post();
            $cliente = $this->clienteService->crearCliente($data);
            $this->flash('success', "Cliente {$cliente->nombre} creado exitosamente");
            $this->redirect("/clientes/{$cliente->id}/brief");
        } catch (\Exception $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('/clientes/create');
        }
    }
}
```

### Estructura de Service

```php
<?php
// ABOUTME: Servicio de lógica de negocio para clientes
// ABOUTME: Orquesta creación, validación y configuración inicial

namespace App\Modules\Cliente\Services;

use App\Modules\Cliente\Models\Cliente;

class ClienteService {
    private Cliente $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    public function crearCliente(array $data): object {
        // Validar
        $this->validarDatos($data);

        // Verificar dominio único
        if ($this->clienteModel->findByDominio($data['dominio'])) {
            throw new \Exception("El dominio {$data['dominio']} ya existe");
        }

        // Crear cliente
        $cliente = $this->clienteModel->create($data);

        // Crear estructura de carpetas
        $this->crearEstructuraCarpetas($cliente->id);

        // Notificar (email, log, etc)
        $this->notificarAlta($cliente->id);

        return $cliente;
    }

    private function validarDatos(array $data): void {
        $required = ['nombre', 'dominio', 'email'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new \Exception("El campo $field es obligatorio");
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Email inválido");
        }

        // Validar formato dominio
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/', $data['dominio'])) {
            throw new \Exception("Formato de dominio inválido");
        }
    }

    private function crearEstructuraCarpetas(int $clienteId): void {
        $basePath = __DIR__ . "/../../../../data/clientes/$clienteId";

        $dirs = [
            $basePath,
            "$basePath/imports",
            "$basePath/imports/gsc",
            "$basePath/imports/ga4",
            "$basePath/imports/ahrefs",
            "$basePath/imports/screaming_frog",
            "$basePath/logs"
        ];

        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    private function notificarAlta(int $clienteId): void {
        // TODO: Implementar notificación email
        // TODO: Log en tabla actividad
        error_log("Cliente $clienteId creado exitosamente");
    }
}
```

### Estructura de Model

```php
<?php
// ABOUTME: Modelo de datos para clientes
// ABOUTME: Acceso a tabla clientes con PDO

namespace App\Modules\Cliente\Models;

use App\Core\Database;

class Cliente {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all(): array {
        $stmt = $this->db->query("
            SELECT * FROM clientes
            WHERE estado != 'archivado'
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find(int $id): ?object {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        return $result ?: null;
    }

    public function create(array $data): object {
        $stmt = $this->db->prepare("
            INSERT INTO clientes (nombre, empresa, dominio, email, telefono, estado)
            VALUES (?, ?, ?, ?, ?, 'onboarding')
        ");

        $stmt->execute([
            $data['nombre'],
            $data['empresa'] ?? null,
            $data['dominio'],
            $data['email'],
            $data['telefono'] ?? null
        ]);

        return $this->find($this->db->lastInsertId());
    }

    public function update(int $id, array $data): bool {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }

        $values[] = $id;

        $sql = "UPDATE clientes SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($values);
    }

    public function findByDominio(string $dominio): ?object {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE dominio = ?");
        $stmt->execute([$dominio]);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        return $result ?: null;
    }
}
```

## Comandos Relacionados
- `/implement-module {nombre}` → Invoca este agente
```

#### 9.2.3. database-architect (Arquitecto de Base de Datos)

**Archivo:** `.claude/agents/database-architect.md`

```markdown
# Database Architect Agent

## Rol
Especialista en diseño de esquemas de base de datos y migraciones.

## Responsabilidades
- Diseñar tablas y relaciones
- Crear migraciones SQL
- Optimizar índices
- Garantizar integridad referencial
- Documentar decisiones de diseño

## Principios
1. **Normalización**: Al menos 3NF
2. **Naming**: snake_case para tablas y columnas
3. **Timestamps**: created_at, updated_at en todas las tablas
4. **Foreign Keys**: Siempre con ON DELETE/ON UPDATE
5. **Índices**: En columnas de búsqueda/filtrado frecuente

## Inputs Esperados
- Diseño arquitectónico del módulo
- Entidades identificadas
- Relaciones entre módulos

## Outputs Generados
- Archivos de migración SQL
- Diagramas ER (textual)
- Documentación de decisiones
- Scripts de rollback

## Template de Migración

```sql
-- ============================================
-- Migration: 001_create_clientes.sql
-- Descripción: Tabla principal de clientes
-- Autor: database-architect
-- Fecha: 2025-01-15
-- ============================================

-- UP Migration
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    empresa VARCHAR(255),
    dominio VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    estado ENUM('onboarding', 'activo', 'pausado', 'completado', 'archivado') DEFAULT 'onboarding',
    brief_completo BOOLEAN DEFAULT FALSE,
    brief_path VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Índices
    INDEX idx_estado (estado),
    INDEX idx_dominio (dominio),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Comentarios
ALTER TABLE clientes COMMENT = 'Almacena información de clientes del Marketing Control Panel';

-- ============================================
-- DOWN Migration (Rollback)
-- ============================================

DROP TABLE IF EXISTS clientes;
```

## Comandos Relacionados
- `/create-migration {nombre}` → Invoca este agente
```

#### 9.2.4. frontend-developer (Desarrollador Frontend)

**Archivo:** `.claude/agents/frontend-developer.md`

```markdown
# Frontend Developer Agent

## Rol
Implementa vistas usando Limitless Admin Template.

## Responsabilidades
- Crear vistas PHP usando Limitless components
- Implementar JavaScript para interactividad
- Integrar charts (ApexCharts/Chart.js)
- Implementar formularios con validación
- AJAX para acciones sin reload
- Responsive design (Bootstrap 5)

## Principios
1. **Template First**: Usar componentes de Limitless
2. **Progressive Enhancement**: Funciona sin JS, mejor con JS
3. **Accessibility**: Labels, ARIA, keyboard navigation
4. **Mobile First**: Responsive por defecto
5. **No reinventar rueda**: Usar plugins de Limitless

## Inputs Esperados
- Wireframes o descripción de la UI
- Datos que debe mostrar la vista
- Acciones que debe permitir

## Outputs Generados
- Archivos PHP de vistas
- JavaScript asociado
- Configuraciones de charts/datatables

## Template de Vista

```php
<?php
// ABOUTME: Vista index de clientes - lista todos los clientes
// ABOUTME: Usa DataTables de Limitless para tabla interactiva
?>

<?php include __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Clientes
            </h4>
        </div>

        <div class="d-lg-block my-lg-auto ms-lg-auto">
            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                <a href="/clientes/create" class="btn btn-primary">
                    <i class="ph-plus me-2"></i>
                    Nuevo Cliente
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Todos los Clientes</h5>
        </div>

        <table class="table datatable-basic" id="clientes-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Dominio</th>
                    <th>Estado</th>
                    <th>Brief</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente->id ?></td>
                    <td><?= htmlspecialchars($cliente->nombre) ?></td>
                    <td><?= htmlspecialchars($cliente->empresa ?? '-') ?></td>
                    <td>
                        <a href="https://<?= htmlspecialchars($cliente->dominio) ?>" target="_blank">
                            <?= htmlspecialchars($cliente->dominio) ?>
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-<?= getEstadoBadgeColor($cliente->estado) ?>">
                            <?= ucfirst($cliente->estado) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($cliente->brief_completo): ?>
                            <i class="ph-check-circle text-success"></i> Completo
                        <?php else: ?>
                            <i class="ph-circle text-muted"></i> Pendiente
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-inline-flex">
                            <a href="/clientes/<?= $cliente->id ?>" class="text-body me-2" title="Ver">
                                <i class="ph-eye"></i>
                            </a>
                            <a href="/clientes/<?= $cliente->id ?>/edit" class="text-body me-2" title="Editar">
                                <i class="ph-pencil"></i>
                            </a>
                            <a href="/clientes/<?= $cliente->id ?>/delete"
                               class="text-danger"
                               title="Archivar"
                               onclick="return confirm('¿Archivar este cliente?')">
                                <i class="ph-archive"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    // Inicializar DataTable
    $('.datatable-basic').DataTable({
        language: {
            url: '/assets/js/datatables-es.json'
        },
        order: [[0, 'desc']],  // Ordenar por ID desc
        pageLength: 25
    });
});

function getEstadoBadgeColor(estado) {
    const colors = {
        'onboarding': 'info',
        'activo': 'success',
        'pausado': 'warning',
        'completado': 'primary',
        'archivado': 'secondary'
    };
    return colors[estado] || 'secondary';
}
</script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>
```

## Comandos Relacionados
- `/implement-view {modulo} {vista}` → Invoca este agente
```

#### 9.2.5. api-integration-specialist (Especialista en APIs)

**Archivo:** `.claude/agents/api-integration-specialist.md`

```markdown
# API Integration Specialist Agent

## Rol
Crea wrappers para APIs externas (Google, WordPress, Ahrefs, etc).

## Responsabilidades
- Implementar clientes de APIs externas
- Manejar autenticación (OAuth, API keys)
- Gestionar rate limiting
- Implementar retry logic
- Logging de llamadas API
- Cachear respuestas cuando apropiado

## Principios
1. **Abstracción**: Wrapper oculta complejidad de API
2. **Error Handling**: Manejo robusto de errores de red/API
3. **Rate Limiting**: Respetar límites de API
4. **Caching**: Cachear datos que no cambian frecuentemente
5. **Logging**: Log todas las llamadas para debugging

## Comandos Relacionados
- `/integrate-api {service}` → Invoca este agente
```

#### 9.2.6. testing-specialist (Especialista en Testing)

**Archivo:** `.claude/agents/testing-specialist.md`

```markdown
# Testing Specialist Agent

## Rol
Crea tests unitarios y de integración para el código PHP.

## Responsabilidades
- Escribir tests con PHPUnit
- Tests unitarios para Services y Models
- Tests de integración para Controllers
- Mocking de dependencias
- Garantizar coverage razonable

## Principios
1. **Test First** (cuando posible)
2. **AAA Pattern**: Arrange, Act, Assert
3. **Mock External Dependencies**: APIs, filesystem, etc
4. **Meaningful Assertions**: No solo que no explote
5. **Test Edge Cases**: Happy path + edge cases

## Comandos Relacionados
- `/test-module {nombre}` → Invoca este agente
```

### 9.3. Comandos de Workflow

Los comandos orquestan a los agentes para completar tareas complejas.

#### 9.3.1. /setup-project

**Archivo:** `.claude/commands/setup-project.md`

```markdown
# Comando: /setup-project

## Descripción
Inicializa la estructura completa del proyecto Marketing Control Panel.

## Workflow
1. Crear estructura de carpetas (src/, public/, config/, etc)
2. Crear docker-compose.yml
3. Crear Dockerfiles
4. Crear .env.example
5. Crear composer.json
6. Crear CLAUDE.md
7. Crear README.md
8. Inicializar git
9. Crear .gitignore
10. Crear database/migrations/000_initial_schema.sql

## Agentes Involucrados
- database-architect (para schema inicial)
- php-architect (para estructura base)

## Output
Proyecto listo para comenzar desarrollo modular.
```

#### 9.3.2. /design-module

**Archivo:** `.claude/commands/design-module.md`

```markdown
# Comando: /design-module {nombre}

## Descripción
Diseña la arquitectura de un nuevo módulo del sistema.

## Parámetros
- `nombre`: Nombre del módulo (Cliente, AuditoriaSEO, EmailMarketing, etc)

## Workflow
1. Leer especificación del módulo (ESPECIFICACION_MARKETING_CONTROL_PANEL.md)
2. Invocar `php-architect` con contexto del módulo
3. php-architect genera:
   - Estructura de carpetas
   - Definición de Controllers
   - Definición de Services
   - Definición de Models
   - Diagrama de flujo
4. Invocar `database-architect` para diseñar tablas
5. database-architect genera:
   - Migraciones SQL
   - Diagrama ER
6. Guardar diseño en `.claude/doc/{modulo}/architecture.md`
7. Crear checklist de implementación

## Output
- `.claude/doc/{modulo}/architecture.md`
- `database/migrations/00X_create_{modulo}.sql`
- Checklist en `.claude/sessions/context_session_{modulo}.md`

## Ejemplo de Uso
```
/design-module Cliente
```
```

#### 9.3.3. /implement-module

**Archivo:** `.claude/commands/implement-module.md`

```markdown
# Comando: /implement-module {nombre}

## Descripción
Implementa el código de un módulo previamente diseñado.

## Prerequisitos
- Módulo debe estar diseñado (`/design-module` ejecutado)
- Migraciones de BD deben estar creadas

## Workflow
1. Leer diseño en `.claude/doc/{modulo}/architecture.md`
2. Ejecutar migraciones de BD
3. Invocar `php-developer` para cada componente:
   - Implementar Models
   - Implementar Services
   - Implementar Controllers
4. Invocar `frontend-developer` para vistas:
   - Implementar vistas principales
   - Implementar formularios
   - Integrar DataTables/Charts si necesario
5. Invocar `testing-specialist`:
   - Crear tests unitarios
   - Crear tests de integración
6. Actualizar routing (config/routes.php o similar)
7. Ejecutar tests
8. Actualizar documentación

## Output
- Código implementado en `src/Modules/{nombre}/`
- Vistas en `src/Modules/{nombre}/Views/`
- Tests en `tests/Modules/{nombre}/`
- Routing actualizado

## Ejemplo de Uso
```
/implement-module Cliente
```
```

#### 9.3.4. /create-migration

**Archivo:** `.claude/commands/create-migration.md`

```markdown
# Comando: /create-migration {nombre}

## Descripción
Crea una nueva migración de base de datos.

## Workflow
1. Invocar `database-architect`
2. Generar número secuencial (próximo número libre)
3. Crear archivo `database/migrations/00X_{nombre}.sql`
4. Incluir UP y DOWN migrations
5. Documentar cambios

## Output
- `database/migrations/00X_{nombre}.sql`

## Ejemplo de Uso
```
/create-migration add_column_prioridad_to_nodos
```
```

#### 9.3.5. /integrate-api

**Archivo:** `.claude/commands/integrate-api.md`

```markdown
# Comando: /integrate-api {service}

## Descripción
Integra una API externa creando un wrapper PHP.

## Services Soportados
- google-search-console
- google-analytics-4
- wordpress
- ahrefs

## Workflow
1. Invocar `api-integration-specialist`
2. Crear `src/Shared/API/{Service}API.php`
3. Implementar autenticación
4. Implementar métodos principales
5. Implementar error handling
6. Crear tests de integración
7. Documentar uso

## Output
- `src/Shared/API/{Service}API.php`
- `tests/Shared/API/{Service}APITest.php`
- `.claude/doc/apis/{service}.md` (documentación)

## Ejemplo de Uso
```
/integrate-api google-search-console
```
```

#### 9.3.6. /test-module

**Archivo:** `.claude/commands/test-module.md`

```markdown
# Comando: /test-module {nombre}

## Descripción
Ejecuta (o crea si no existen) tests para un módulo.

## Workflow
1. Verificar si existen tests en `tests/Modules/{nombre}/`
2. Si NO existen:
   - Invocar `testing-specialist`
   - Crear tests unitarios
   - Crear tests de integración
3. Ejecutar tests con PHPUnit
4. Generar reporte de coverage
5. Identificar gaps de cobertura
6. Sugerir tests adicionales

## Output
- Tests ejecutados
- Reporte de coverage
- Sugerencias de mejora

## Ejemplo de Uso
```
/test-module Cliente
```
```

### 9.4. Sesiones de Desarrollo

**Template:** `.claude/sessions/context_session_{feature}.md`

```markdown
# Sesión: {Feature Name}

## Contexto
Breve descripción de qué se está desarrollando en esta sesión.

## Objetivos
- [ ] Objetivo 1
- [ ] Objetivo 2
- [ ] Objetivo 3

## Progreso

### 2025-01-15 - Inicio
- Diseñada arquitectura del módulo Cliente
- Creadas migraciones de BD
- Estado: Listo para implementación

### 2025-01-16 - Implementación
- Implementados Models
- Implementados Services
- Implementados Controllers
- Estado: Falta frontend

### 2025-01-17 - Frontend
- Implementadas vistas index, create, show
- Integrado DataTables
- Estado: Falta testing

### 2025-01-18 - Testing
- Creados tests unitarios
- Coverage: 85%
- Estado: COMPLETADO

## Decisiones Tomadas
1. **Decisión**: Brief se guarda como JSON, no en BD
   - **Razón**: Mayor flexibilidad para cambios en estructura
   - **Trade-off**: No se puede buscar por campos del brief directamente

2. **Decisión**: Validación de dominio solo en backend
   - **Razón**: Seguridad
   - **Trade-off**: UX ligeramente peor (espera submit)

## Problemas Encontrados
1. **Problema**: PDO no disponible en Docker
   - **Solución**: Añadir ext-pdo a Dockerfile
   - **Commit**: abc123

## Próximos Pasos
- Diseñar módulo PlanMarketing
- Integrar brief del cliente en diseño de plan
```

### 9.5. Documentación de Decisiones

**Template:** `.claude/doc/{modulo}/architecture.md`

```markdown
# Arquitectura: {Módulo}

## Overview
Descripción del propósito del módulo.

## Entidades del Dominio
- Entidad 1: Descripción
- Entidad 2: Descripción

## Componentes

### Controllers
Lista de controllers con sus responsabilidades.

### Services
Lista de services con su lógica de negocio.

### Models
Lista de models con acceso a datos.

### Views
Lista de vistas principales.

## Flujos de Datos
Diagramas o descripciones de flujos.

## Decisiones Arquitectónicas
Lista de decisiones tomadas y razones.

## Dependencias
- Internas: Otros módulos de los que depende
- Externas: APIs, librerías

## Testing
Estrategia de testing para este módulo.
```

---

## 10. Roadmap de Implementación

### 10.1. Visión General

Implementación incremental en **12 semanas**, módulo por módulo.

```
Semanas 1-2:  Core + Módulo Cliente
Semanas 3-5:  Módulo AuditoriaSEO (más complejo)
Semanas 6-7:  Módulo Automatizaciones
Semanas 8-9:  Módulo EmailMarketing
Semanas 10:   Módulo PlanMarketing
Semanas 11:   Integración y Testing E2E
Semana 12:    Deployment y Documentación
```

### 10.2. Fase 0: Preparación (Semana 1)

**Objetivo:** Proyecto inicializado y listo para desarrollo

#### Tareas

**T001: Setup Docker**
```bash
/setup-project
```
- Crear docker-compose.yml
- Dockerfiles para php, nginx, mysql, python
- Configurar volúmenes
- Configurar redes

**T002: Estructura Base**
- Crear estructura de carpetas completa
- Crear Core (Router, Database, Auth, Session, Config)
- Crear layouts base (header, footer, sidebar)

**T003: Database Inicial**
```bash
/create-migration initial_schema
```
- Crear todas las tablas del schema (Section 7)
- Crear usuario admin
- Seed data de prueba (opcional)

**T004: Configuración**
- .env.example con todas las variables
- config/database.php
- config/modules.php
- config/api_credentials.php

**T005: Limitless Template**
- Integrar assets de Limitless en public/assets/
- Crear layouts/header.php con navegación
- Crear layouts/sidebar.php con menú modular
- Crear dashboard home básico

**Entregables:**
- ✅ Docker levantando todos los servicios
- ✅ BD inicializada con schema completo
- ✅ Login admin funcional
- ✅ Dashboard home con Limitless template

---

### 10.3. Fase 1: Módulo Cliente (Semana 2)

**Objetivo:** Gestión completa de clientes operativa

#### Tareas

**T006: Diseñar Módulo Cliente**
```bash
/design-module Cliente
```
- Arquitectura detallada
- Verificar migración de BD

**T007: Implementar Backend**
```bash
/implement-module Cliente
```
- ClienteController (CRUD + brief)
- ClienteService (lógica negocio)
- BriefService (brief multi-paso)
- Cliente Model

**T008: Implementar Frontend**
- Vista index (lista clientes con DataTables)
- Vista create/edit (formulario)
- Vista show (detalle cliente)
- Vista brief (wizard multi-paso con AJAX)

**T009: Testing**
```bash
/test-module Cliente
```
- Tests unitarios Services
- Tests integración Controllers
- Coverage mínimo 80%

**T010: Validación Manual**
- Crear 3 clientes de prueba
- Completar brief de cada uno
- Verificar carpetas creadas
- Verificar datos en BD

**Entregables:**
- ✅ CRUD clientes completo
- ✅ Brief multi-paso funcional
- ✅ Tests pasando
- ✅ 3 clientes de prueba con brief completo

---

### 10.4. Fase 2: Módulo Auditoría SEO (Semanas 3-5)

**Objetivo:** Auditorías SEO automatizadas con arquitectura propuesta

Este es el módulo más complejo - 3 semanas.

#### Semana 3: Importación y Procesamiento

**T011: Diseñar Módulo AuditoriaSEO**
```bash
/design-module AuditoriaSEO
```

**T012: Implementar Importación de Datos**
- Controller para upload CSVs
- Services para validación de formatos
- Scripts Python para procesamiento
- Queue de jobs para background processing

**T013: Procesadores de Datos**
- `scripts/process_gsc_data.py`
- `scripts/process_ga4_data.py`
- `scripts/process_ahrefs_data.py`
- `scripts/process_screaming_frog_data.py`

**T014: Vistas de Importación**
- Form multi-upload
- Progress bars
- Validación de formatos
- Previsualización de datos

**T015: Testing Importación**
- Tests con CSVs de ejemplo
- Tests de validación de formatos
- Tests de procesamiento Python

#### Semana 4: Auditoría Automática

**T016: Implementar Agente Analista**
- AuditoriaService::ejecutarAuditoria()
- Lógica de análisis Fase 0-4 (según prompt_maestro)
- Generación de auditoria_seo.json
- Cálculo de salud_seo_score

**T017: Dashboard de Auditoría**
- Vista resumen ejecutivo
- Gauge chart salud SEO
- Cards hallazgos/oportunidades
- Tabs por fase (F0, F1, F2, F3, F4)
- Charts (ApexCharts):
  * CTR vs benchmark
  * Distribución keywords por intención
  * Radar chart salud técnica

**T018: Tablas de Hallazgos**
- DataTables de keywords prioritarias
- Tabla de errores técnicos
- Tabla de oportunidades de contenido

**T019: Testing Auditoría**
- Tests con datos reales de un cliente
- Validar JSON generado
- Validar cálculos de score

#### Semana 5: Arquitectura y Plan

**T020: Implementar Agente Arquitecto**
- ArquitecturaService::generarPropuesta()
- Algoritmos de diseño de arquitectura
- Mapeo keyword → URL
- Generación de plan de redirects
- Generación arquitectura_propuesta.json

**T021: Vista Arquitectura Propuesta**
- Resumen estrategia
- Tabla de nodos (expandible)
- Tabla de redirects
- Timeline de fases
- Editor JSON para ajustes manuales

**T022: Plan de Ejecución**
- PlanEjecucionService::generar()
- Conversión arquitectura → tareas
- Configuración drip mode
- Generación plan_ejecucion_seo.json
- Vista Gantt simple

**T023: Testing Completo Módulo SEO**
```bash
/test-module AuditoriaSEO
```
- Tests E2E: import → auditoría → arquitectura → plan
- Validar JSON generados
- Coverage mínimo 75%

**T024: Validación Manual**
- Auditoría completa de 1 cliente real
- Generar arquitectura
- Aprobar arquitectura
- Generar plan de ejecución

**Entregables:**
- ✅ Importación de datos funcional
- ✅ Auditoría automática generando insights
- ✅ Dashboard visual completo
- ✅ Arquitectura propuesta generada
- ✅ Plan de ejecución listo para MCP

---

### 10.5. Fase 3: Módulo Automatizaciones (Semanas 6-7)

**Objetivo:** Ejecución automatizada de tareas con MCP

#### Semana 6: Infraestructura MCP

**T025: Integrar WordPress API**
```bash
/integrate-api wordpress
```
- WordPressAPI wrapper
- Autenticación Application Passwords
- Métodos: createPost, updatePost, deletePost
- Tests de integración

**T026: Diseñar Módulo Automatizaciones**
```bash
/design-module Automatizaciones
```

**T027: Implementar MCPService**
- MCPService::ejecutarTarea()
- Lógica de ejecución por tipo (wordpress, gmb, email)
- Logging obligatorio
- Generación de comandos reversión

**T028: Sistema de Aprobaciones**
- Vista queue de tareas pendientes
- Modal de preview (draft WordPress)
- Botones aprobar/rechazar/pausar
- AJAX para acciones

#### Semana 7: Ejecución y Logs

**T029: Ejecución de Lotes (Drip Mode)**
- AutomatizacionController::ejecutarLote()
- Por cada tarea:
  * Ejecutar como DRAFT
  * Generar preview
  * Esperar aprobación
  * Publicar si aprobado
  * Log completo
- Progress en tiempo real (WebSocket o polling)

**T030: Dashboard de Automatizaciones**
- Calendario de tareas programadas
- Queue de pendientes aprobación
- Historial de ejecuciones
- Logs con filtros

**T031: Vista de Logs**
- DataTables de logs
- Filtros: cliente, tipo, estado, fechas
- Expandible con detalles JSON
- Acción "Revertir" (si reversible)

**T032: Testing MCP**
```bash
/test-module Automatizaciones
```
- Tests con WordPress de prueba
- Mocking de WP API
- Tests de reversión
- Coverage mínimo 80%

**T033: Validación Manual**
- Ejecutar lote de 3 tareas en WordPress de prueba
- Verificar drafts creados
- Aprobar y publicar
- Verificar logs
- Revertir una acción

**Entregables:**
- ✅ WordPress API integrado
- ✅ Sistema de ejecución drip funcional
- ✅ Aprobaciones operativas
- ✅ Logging completo
- ✅ Reversión de acciones operativa

---

### 10.6. Fase 4: Módulo Email Marketing (Semanas 8-9)

**Objetivo:** Campañas de outreach automatizadas

#### Semana 8: Gestión de Contactos y Plantillas

**T034: Diseñar Módulo EmailMarketing**
```bash
/design-module EmailMarketing
```

**T035: Implementar Backend**
- ContactoController/Service/Model
- PlantillaController/Service/Model
- CampanaController/Service/Model

**T036: Importación de Contactos**
- Upload CSV
- Validación emails
- Detección duplicados
- Categorización automática

**T037: Gestión de Plantillas**
- CRUD plantillas
- Editor con variables {{nombre}}, {{sitio}}
- Preview con datos de muestra
- Categorías (link_building, guest_post, etc)

**T038: Frontend Contactos**
- Lista contactos (DataTables)
- Filtros: categoría, estado
- CRUD contactos

#### Semana 9: Campañas y Envío

**T039: Creación de Campañas**
- Wizard campaña:
  * Paso 1: Info básica
  * Paso 2: Selección plantilla
  * Paso 3: Selección contactos
  * Paso 4: Config drip
  * Paso 5: Preview
  * Paso 6: Programar

**T040: Sistema de Envío Drip**
- Cron job (src/CLI/cron.php)
- Procesamiento de campañas activas
- Envío vía PHPMailer
- Rate limiting
- Manejo de bounces

**T041: Tracking**
- Pixel de apertura (/track/open/{id}/pixel.gif)
- Registro de aperturas
- Marcar respuestas (manual)

**T042: Dashboard Campañas**
- Lista campañas
- Métricas: enviados, abiertos, respondidos
- Charts de rendimiento
- Top contactos

**T043: Testing Email**
```bash
/test-module EmailMarketing
```
- Tests de envío (mocking SMTP)
- Tests de tracking
- Tests de cron
- Coverage mínimo 80%

**T044: Validación Manual**
- Importar 20 contactos
- Crear plantilla
- Crear campaña para 5 contactos
- Ejecutar cron y verificar envíos
- Simular apertura (pixel)
- Marcar respuesta

**Entregables:**
- ✅ Gestión de contactos operativa
- ✅ Plantillas con variables funcionando
- ✅ Campañas drip enviando automáticamente
- ✅ Tracking de aperturas funcional
- ✅ Dashboard de métricas operativo

---

### 10.7. Fase 5: Módulo Plan de Marketing (Semana 10)

**Objetivo:** Planificación estratégica por cliente

**T045: Diseñar Módulo PlanMarketing**
```bash
/design-module PlanMarketing
```

**T046: Implementar Backend**
- PlanMarketingController/Service/Model
- KPIController/Service/Model

**T047: Wizard de Creación**
- 6 pasos según HU-PM01
- Guardado progresivo
- Generación plan_marketing.json

**T048: Dashboard de Plan**
- Cards KPIs principales
- Progress bars objetivos
- Timeline visual
- Charts de progreso (ApexCharts)

**T049: Gestión de KPIs**
- CRUD KPIs
- Mediciones periódicas
- Charts de evolución

**T050: Integración con Auditoría**
- Al crear plan, sugerir canal SEO si no existe auditoría
- Vincular auditoría con plan
- Mostrar progreso SEO en dashboard plan

**T051: Testing Plan Marketing**
```bash
/test-module PlanMarketing
```

**T052: Validación Manual**
- Crear plan completo para 1 cliente
- Definir 5 KPIs
- Registrar 3 mediciones
- Ver dashboard de progreso

**Entregables:**
- ✅ Creación de planes funcional
- ✅ Dashboard de seguimiento operativo
- ✅ KPIs y mediciones funcionando
- ✅ Integración con módulo SEO

---

### 10.8. Fase 6: Integración y Testing E2E (Semana 11)

**Objetivo:** Sistema completo integrado y testeado

**T053: Testing E2E - Flujo Completo**
- Test: Onboarding → Ejecución
  1. Alta cliente
  2. Brief completo
  3. Crear plan marketing
  4. Importar datos SEO
  5. Ejecutar auditoría
  6. Generar arquitectura
  7. Aprobar arquitectura
  8. Generar plan ejecución
  9. Ejecutar lote de tareas
  10. Verificar publicación en WP

**T054: Testing de Seguridad**
- SQL Injection tests
- XSS tests
- CSRF protection
- Authentication tests
- Authorization tests

**T055: Testing de Performance**
- Load testing (simulación 100 clientes)
- Query optimization (EXPLAIN queries lentas)
- Caching strategy
- Asset optimization

**T056: Bugs y Fixes**
- Recolectar bugs de testing
- Priorizar y fixear
- Re-testing

**T057: Documentation**
- Actualizar README.md
- Documentar instalación
- Documentar uso de cada módulo
- Screenshots/GIFs de flujos

**Entregables:**
- ✅ Test E2E completo pasando
- ✅ Seguridad validada
- ✅ Performance aceptable
- ✅ Bugs críticos resueltos
- ✅ Documentación completa

---

### 10.9. Fase 7: Deployment (Semana 12)

**Objetivo:** Sistema en producción

**T058: Preparación para Producción**
- Configurar .env de producción
- Cambiar contraseñas por defecto
- Configurar HTTPS (SSL)
- Configurar backups automáticos BD

**T059: Docker Production Build**
- Optimizar Dockerfiles para producción
- Multi-stage builds
- Minimizar tamaños de imágenes

**T060: Deployment**
- Deploy a servidor (Windows 11 + Docker)
- Configurar dominio/subdominio
- SSL con Let's Encrypt
- Configurar crons

**T061: Monitoring**
- Logs centralizados
- Alertas de errores
- Monitoring de uptime
- Backup automático

**T062: Handoff**
- Training session (si aplica)
- Entregar credenciales
- Entregar documentación
- Plan de mantenimiento

**Entregables:**
- ✅ Sistema en producción
- ✅ HTTPS configurado
- ✅ Backups automáticos
- ✅ Monitoring activo
- ✅ Documentación entregada

---

### 10.10. Métricas de Éxito

Al final de las 12 semanas, el sistema debe cumplir:

**Funcionales:**
- ✅ 5 módulos operativos (Cliente, Plan, Auditoría, Auto, Email)
- ✅ Flujo completo E2E funcional
- ✅ Al menos 3 clientes reales gestionados
- ✅ Al menos 1 auditoría SEO completa ejecutada
- ✅ Al menos 1 lote de automatizaciones ejecutado

**Técnicos:**
- ✅ Test coverage > 75%
- ✅ Todos los tests pasando
- ✅ Sin errores críticos de seguridad
- ✅ Performance: página carga < 2s
- ✅ Docker deployment funcional

**Documentación:**
- ✅ README completo
- ✅ Documentación de API
- ✅ Guías de uso por módulo
- ✅ Decisiones arquitectónicas documentadas

---

## 11. Próximos Pasos Inmediatos

Migue, con este documento completo tienes TODO lo necesario:

### 1. Revisar y Aprobar Especificación
- Lee este documento completo
- Valida que cubre tus necesidades
- Marca ajustes si necesario

### 2. Preparar Entorno
- Asegúrate de tener Docker instalado
- Asegúrate de tener Git
- Ten listo acceso a:
  * Limitless Admin Template (licencia)
  * WordPress de prueba (para testing MCP)
  * Credenciales Google APIs (GSC, GA4)

### 3. Comenzar Desarrollo
Cuando estés listo, ejecuta en Claude Code:

```bash
# En el directorio del proyecto (C:\ai\investigacionauditoria programacion\)
/setup-project
```

Esto iniciará la Fase 0 (Preparación) creando toda la infraestructura base.

### 4. Desarrollo Incremental
Sigue el roadmap semana por semana:
- Semana 1: Fase 0 (Setup)
- Semana 2: Módulo Cliente
- Semanas 3-5: Módulo Auditoría SEO
- Y así sucesivamente...

---

**¿Preguntas? ¿Ajustes necesarios?**

Este documento es tu guía maestra. Guárdalo, revísalo, ajústalo según necesites. Es el "plano de construcción" de tu Marketing Control Panel.