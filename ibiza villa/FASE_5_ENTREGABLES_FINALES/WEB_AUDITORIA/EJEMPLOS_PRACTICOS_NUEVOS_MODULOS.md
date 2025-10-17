# Ejemplos Prácticos: Cómo Completar los Nuevos Módulos

Este documento proporciona ejemplos paso a paso de cómo extraer datos reales y completar cada uno de los nuevos módulos añadidos a la auditoría SEO.

---

## Tabla de Contenidos

1. [Brief del Cliente (Página 001)](#brief-del-cliente)
2. [Keyword Research (Páginas 020-024)](#keyword-research)
3. [E-E-A-T Audit (Página 134)](#e-e-a-t-audit)
4. [Optimización para IA/SGE (Página 135)](#ia-sge-optimization)
5. [Voice Search (Página 136)](#voice-search)
6. [Video SEO (Página 137)](#video-seo)
7. [SEO Local (Página 138)](#seo-local)

---

## Brief del Cliente (Página 001) {#brief-del-cliente}

### Paso 1: Reunión Inicial con Cliente

**Template de reunión:**
```
AGENDA DE KICK-OFF MEETING

1. Presentaciones (10 min)
2. Contexto del negocio (15 min)
3. Objetivos y expectativas (15 min)
4. Recursos y accesos (10 min)
5. Timeline y próximos pasos (10 min)

PREGUNTAS CLAVE:
- ¿Cuál es el principal objetivo de negocio para los próximos 12 meses?
- ¿Qué considerarían un éxito rotundo en esta auditoría?
- ¿Han trabajado con agencias SEO anteriormente? ¿Qué funcionó/no funcionó?
- ¿Quiénes son sus 3 principales competidores?
- ¿Qué recursos internos tienen disponibles para implementaciones?
```

### Paso 2: Completar Brief Estructurado

**Ejemplo Real - Empresa SaaS B2B:**

```markdown
## BRIEF PROYECTO SEO - ACME CRM

### 1. Información del Negocio
- **Empresa**: ACME CRM Solutions, S.L.
- **Dominio**: acmecrm.com
- **Sector**: SaaS B2B - Software de gestión de relaciones con clientes
- **Productos principales**:
  1. ACME CRM Core (gestión clientes básica)
  2. ACME Marketing Automation (email marketing + automation)
  3. ACME Sales Intelligence (IA para predicción de ventas)
- **USP**: Única solución CRM con IA nativa en español

### 2. Contexto SEO Actual
- **Historial previo**:
  - Agencia XYZ (2020-2022): enfoque en link building
  - In-house (2023): optimizaciones on-page básicas
  - No penalizaciones conocidas
- **Competidores principales**:
  1. CompetitorCRM.com (líder mercado español)
  2. SalesManager.es (enfoque pymes)
  3. CloudCRM.io (player internacional)
- **Posicionamiento actual**:
  - Posiciones 15-25 para keywords comerciales principales
  - Página 1 solo para keywords branded
  - Tráfico orgánico: ~5,000 visitas/mes
- **Recursos internos**:
  - 1 desarrollador full-stack (20% disponibilidad)
  - 1 content writer (tiempo completo)
  - CMO con conocimiento básico SEO

### 3. Objetivos de Negocio

**Cuantitativos:**
- Incrementar tráfico orgánico de 5K a 15K visitas/mes (+200%)
- Aumentar leads cualificados de SEO de 50 a 150/mes (+200%)
- Revenue atribuible a SEO: €50K/mes en 12 meses

**Cualitativos:**
- Posicionar marca como líder de pensamiento en CRM español
- Mejorar share of voice vs competidores principales
- Reducir dependencia de paid ads (actualmente 70% del tráfico)

**Timeline:**
- Quick wins visibles: 3 meses
- Resultados significativos: 6 meses
- Objetivos principales: 12 meses

**Budget implementación:** €30,000 (desarrollo + contenido + link building)

### 4. Mercado Objetivo

**Geografías:**
- Principal: España (70% del negocio)
- Secundario: México, Colombia, Argentina (30% creciente)
- Idiomas: Español (100% actualmente)

**Público objetivo:**
- Rol: CMOs, Marketing Directors, Sales Directors
- Empresa: 50-500 empleados
- Industrias: tecnología, servicios profesionales, e-commerce
- Pain points: CRMs complejos, falta de integración, costos altos

**Estacionalidad:**
- Q1: alto (planificación anual)
- Q2-Q3: medio
- Q4: bajo (cierre año fiscal, no compran)

**Canales actuales:**
- Google Ads: 50%
- Orgánico: 15%
- Directo: 20%
- Social/referral: 15%

### 5. Infraestructura Técnica

**CMS:** WordPress 6.4
- Theme: Custom child theme de Astra
- Builder: Elementor Pro
- Plugins críticos: Yoast SEO, WP Rocket, Rank Math

**Stack tecnológico:**
- Hosting: AWS (EC2 t3.large)
- CDN: Cloudflare Pro
- SSL: Let's Encrypt (auto-renovable)
- Framework: PHP 8.1, MySQL 8.0

**Integraciones:**
- GA4 ✓
- GSC ✓
- HubSpot CRM (leads)
- Intercom (chat)
- Stripe (payments)

**Limitaciones conocidas:**
- No tienen staging environment
- Deploy manual (no CI/CD)
- Backup solo semanal
- Elementor puede generar código pesado

### 6. Checklist de Accesos

**Verificado el 2024-01-15:**

✅ Google Analytics 4
- Email: analytics@acmecrm.com
- Rol: Editor
- Property ID: 123456789
- Vista verificada: producción correcta

✅ Google Search Console
- Email: webmaster@acmecrm.com
- Rol: Owner
- Property: https://acmecrm.com/
- Verificación: DNS TXT record

✅ Google Tag Manager
- Email: analytics@acmecrm.com
- Container ID: GTM-XXXX123

✅ Ahrefs
- Cuenta corporativa
- Login compartido (credenciales en LastPass)
- Plan: Agency ($999/mes)

✅ WordPress Admin
- Rol: Administrator
- URL: acmecrm.com/wp-admin
- 2FA configurado

✅ AWS Console
- IAM user creado: seo-auditor
- Permisos: S3 read, CloudFront read, CloudWatch read

✅ Cloudflare
- Email: devops@acmecrm.com
- Rol: Analytics
- Zone: acmecrm.com

⏳ Screaming Frog
- Instalar versión paid (€149/año)
- Pendiente: aprobar purchase order

❌ Server Logs
- Pendiente: solicitar acceso SSH
- Alternativa: usar Cloudflare analytics

❌ Google Business Profile
- No tienen - negocio puramente online
- N/A para esta auditoría
```

### Paso 3: Validación con Stakeholders

**Email de confirmación:**
```
Asunto: [ACME CRM] Brief de Proyecto SEO - Validación requerida

Hola equipo ACME,

Adjunto el brief completo del proyecto SEO que hemos elaborado basado en nuestra reunión inicial.

Por favor, revisar y confirmar:

1. ✓ Objetivos están alineados con expectativas (págs. 2-3)
2. ✓ Recursos internos son correctos (pág. 4)
3. ✓ Timeline es realista para sus procesos (pág. 3)
4. ✓ Limitaciones técnicas están documentadas (pág. 5)

⚠️ Pendientes identificados:
- Screaming Frog license (PO #XYZ)
- SSH access a servidor (ticket abierto con DevOps)

Próximos pasos:
- Una vez confirmado → Inicio FASE 1 (22-ene-2024)
- Kick-off técnico: 22-ene 10:00 CET

¿Alguna corrección o comentario?

Saludos,
[Tu nombre]
```

---

## Keyword Research (Páginas 020-024) {#keyword-research}

### PÁGINA 020: Keyword Discovery y Extracción

#### Método 1: Google Search Console

**Paso a paso:**

1. **Acceder a GSC** → Performance
2. **Configurar filtros:**
   ```
   Fechas: Últimos 6 meses
   Tipo: Web
   Filtro: +50 impresiones
   Métricas: Total clicks, Total impressions, Average CTR, Average position
   ```
3. **Exportar a CSV:**
   - Click "Export" → Google Sheets o Download CSV
   - Seleccionar "Queries" tab
   - Datos incluyen: query, clicks, impressions, CTR, position

4. **Limpiar datos en Excel/Google Sheets:**
   ```
   - Eliminar queries branded (nombre empresa)
   - Eliminar queries con <10 impresiones/mes (ruido)
   - Categorizar por intención (manual o con fórmulas)
   - Calcular potencial de mejora
   ```

**Ejemplo de fórmula para categorizar por posición:**
```excel
=IF(D2<=3,"Top_3",IF(D2<=10,"Top_10",IF(D2<=20,"Page_1",IF(D2<=30,"Page_2","Page_3+"))))
```

#### Método 2: Ahrefs Organic Keywords

**Paso a paso:**

1. **Site Explorer** → acmecrm.com
2. **Organic Keywords** (sidebar)
3. **Configurar:**
   ```
   Database: Spain
   Mode: Prefix (para ver variaciones)
   Filters:
     - Volume: >100
     - Position: 1-50
     - Traffic share: >0.1%
   ```

4. **Exportar con columnas:**
   - Keyword
   - Volume
   - KD (Keyword Difficulty)
   - CPC
   - Position
   - Traffic
   - Traffic %
   - URL

5. **Análisis de tendencias:**
   - Click en keyword individual
   - Ver "SERP history" → identificar tendencias
   - Documentar: creciente/estable/decreciente

#### Consolidación de Datos

**Combinar GSC + Ahrefs en Google Sheets:**

```
=VLOOKUP(A2,AhrefsData!A:D,3,FALSE)
```

Esto añade volumen de Ahrefs a datos de GSC.

**Ejemplo de CSV final: keywords_actuales.csv**

```csv
keyword,posicion_actual,volumen_busqueda,dificultad,url_ranking,impresiones,clics,ctr,tendencia
software crm empresarial,15,2400,68,/productos/crm,8500,320,3.76,estable
mejor crm para pymes,23,1800,55,/blog/mejores-crm,3200,85,2.66,creciente
crm marketing automation,8,1200,72,/productos/marketing,4800,380,7.92,creciente
precio crm empresarial,31,950,45,/pricing,1800,35,1.94,estable
crm integrado con salesforce,19,680,58,/integraciones/salesforce,1200,48,4.00,creciente
```

### PÁGINA 021: Análisis Competitivo de Keywords

#### Usando Ahrefs Content Gap

**Paso a paso detallado:**

1. **Ahrefs → Site Explorer** → tu dominio
2. **Content Gap** en sidebar
3. **Añadir competidores:**
   ```
   Competidor 1: competitorcrm.com
   Competidor 2: salesmanager.es
   Competidor 3: cloudcrm.io
   ```

4. **Show keywords that:**
   ```
   ☑️ At least 2 of your competitors rank for
   ☐ Your target ranks for
   ```
   (Esto muestra keywords donde NO rankeas pero competencia sí)

5. **Filtros adicionales:**
   ```
   - Volume: 300+
   - KD: <70 (keywords alcanzables)
   - Position: 1-10 (competencia en top 10)
   - Word count: 2-5 (long-tail comerciales)
   ```

6. **Exportar resultados**

7. **Análisis manual de SERPs:**
   - Abrir top 10 keywords en pestañas
   - Analizar tipo de contenido que rankea:
     * Landing page producto ✓
     * Guía comparativa ✓
     * Review detallada ✓
     * Case study ✓
   - Documentar en columna "tipo_contenido_ganador"

**Ejemplo visual de análisis:**

```
Keyword: "crm para equipos remotos"
Volumen: 720 | KD: 48

Competidor 1 (Pos 3): Landing con video demo + testimonios
Competidor 2 (Pos 5): Guía + comparativa con otras tools
Competidor 3 (Pos 8): Case study de empresa remota

✓ Nuestra estrategia: Crear landing híbrida
  - Video demo (como C1)
  - Sección comparativa (como C2)
  - 2-3 case studies (como C3)
  - Plus: Guía PDF descargable (diferenciador)
```

#### Calcular Share of Voice

**Fórmula:**
```
SOV = (Tu tráfico orgánico de categoría / Tráfico total de categoría) × 100
```

**Ejemplo en Google Sheets:**

1. Filtrar keywords por categoría (ej: "CRM Empresarial")
2. Sumar tráfico estimado por competidor
3. Calcular porcentaje

```
Categoría: CRM Empresarial
Tu tráfico: 850 visitas/mes
Comp1: 3,200 visitas/mes
Comp2: 2,100 visitas/mes
Comp3: 1,500 visitas/mes
Total mercado: 7,650 visitas/mes

Tu SOV = (850/7650) × 100 = 11.1%
```

### PÁGINA 022: Clasificación por Intención

#### Método automatizado con fórmulas

**En Google Sheets, usar esta lógica:**

```javascript
=IF(
  OR(
    REGEXMATCH(A2,"qué es|que es|cómo|como|por qué|guía|tutorial"),
    REGEXMATCH(A2,"definición|significa|ejemplos")
  ),
  "Informacional",
  IF(
    OR(
      REGEXMATCH(A2,"mejor|mejores|top|vs|comparar|comparativa|review"),
      REGEXMATCH(A2,"opiniones|diferencia entre")
    ),
    "Comercial",
    IF(
      OR(
        REGEXMATCH(A2,"precio|comprar|contratar|planes|cuanto cuesta"),
        REGEXMATCH(A2,"trial|demo|prueba gratis")
      ),
      "Transaccional",
      "Manual_Review"
    )
  )
)
```

#### Análisis manual de SERPs Features

**Checklist por keyword:**

Para cada keyword top 20, documenta:

```
Keyword: "mejor crm para pymes"

SERP Features presentes:
☑️ People Also Ask (4 preguntas)
☑️ Featured Snippet (lista)
☐ Local Pack
☐ Shopping results
☐ Video carousel
☑️ Related searches

Intención identificada: COMERCIAL (por "mejor" + PAA comparan)
Funnel stage: CONSIDERATION
Tipo contenido ideal: Comparativa detallada con tabla
Oportunidad: Featured snippet capturable con lista optimizada
```

### PÁGINA 023: Keyword Mapping

#### Proceso de 4 pasos

**Paso 1: Inventario de URLs**

Usar Screaming Frog:
```
1. Spider Configuration → Mode: Spider
2. Crawl: tu dominio completo
3. Export: Internal > HTML
4. Filtrar: Status Code 200
```

Esto te da lista completa de URLs indexables.

**Paso 2: Match Automático**

En Google Sheets, hacer VLOOKUP entre:
- Keywords prioritarias (Sheet 1)
- URLs con mejor relevancia (Sheet 2)

```excel
=IF(
  ISNUMBER(SEARCH(A2,URLs!B:B)),
  INDEX(URLs!A:A,MATCH(TRUE,ISNUMBER(SEARCH(A2,URLs!B:B)),0)),
  "SIN_URL"
)
```

**Paso 3: Detección de Canibalizaciones**

Buscar keywords con múltiples URLs:

```sql
SELECT keyword, COUNT(DISTINCT url) as url_count
FROM keyword_rankings
GROUP BY keyword
HAVING url_count > 1
ORDER BY volumen DESC
```

En Sheets: usar tabla dinámica
- Filas: Keywords
- Valores: COUNT of URLs
- Filtrar: >1 URL

**Paso 4: Decisiones de Acción**

Para cada keyword decidir:

```
SI: URL existe Y es apropiada
  → ACCIÓN: Optimizar existente

SI: Múltiples URLs compitiendo
  → ACCIÓN: Consolidar
  → Elegir URL principal
  → Redirect otras con 301

SI: NO hay URL apropiada
  → ACCIÓN: Crear nuevo
  → Definir tipo de página
  → Priorizar por volumen×comercialidad

SI: URL existe pero es inapropiada
  → ACCIÓN: Reasignar
  → Encontrar mejor URL
  → Actualizar internal linking
```

**Ejemplo de decisión compleja:**

```
Keyword: "crm gratis español"
Volumen: 1,500 | Intención: Transaccional

URLs actualmente rankeando:
1. /blog/crm-gratis-2023 (posición 42)
2. /pricing (posición 38)

Análisis:
- Blog post: contenido informacional, no optimizado para conversión
- Pricing: no menciona "gratis" ni "español" específicamente

Decisión: CREAR_NUEVO
Nueva URL: /crm-gratis-prueba
Tipo: Landing page de trial signup
Prioridad: A (alto volumen, transaccional)

Acciones adicionales:
- 301 redirect: /blog/crm-gratis-2023 → /crm-gratis-prueba
- Internal links: actualizar menciones en blog
- CTA en /pricing hacia /crm-gratis-prueba
```

### PÁGINA 024: Quick Wins

#### Framework de Priorización RICE

**Fórmula:**
```
RICE Score = (Reach × Impact × Confidence) / Effort

Reach = Volumen de búsqueda mensual
Impact = Mejora potencial en posición (0-3: 3=alto)
Confidence = % confianza de éxito (0.5-1.0)
Effort = Horas estimadas de trabajo
```

**Ejemplo de cálculo:**

```
Keyword: "crm marketing automation"
Posición actual: 8
Volumen: 1,200

Reach = 1,200
Impact = 2 (mejorar a posición 3-5)
Confidence = 0.8 (alta, ya estamos en top 10)
Effort = 8 horas (optimización on-page + internal links)

RICE = (1200 × 2 × 0.8) / 8 = 240

---

Keyword: "mejor crm pymes"
Posición actual: 23
Volumen: 1,800

Reach = 1,800
Impact = 3 (potencial de llegar a top 5)
Confidence = 0.6 (media, requiere contenido nuevo)
Effort = 40 horas (crear comparativa completa)

RICE = (1800 × 3 × 0.6) / 40 = 81
```

El primer keyword tiene mayor score → prioridad más alta.

#### Identificar Featured Snippet Opportunities

**En Ahrefs:**

1. Organic Keywords → tu dominio
2. Filtrar:
   ```
   Position: 1-5
   SERP Features: "Featured snippet" (No match)
   ```

Esto muestra keywords donde rankeas bien PERO no tienes snippet.

3. Click en cada keyword
4. Ver qué formato tiene el snippet actual:
   - Paragraph (40-60 palabras)
   - List (pasos o items)
   - Table (comparación)

5. Optimizar tu contenido con ese formato

**Ejemplo:**

```
Keyword: "qué es un crm"
Posición actual: 4
Featured snippet: Párrafo de definición (58 palabras)

Acción:
1. Añadir heading "¿Qué es un CRM?"
2. Párrafo inmediatamente después:
   "Un CRM (Customer Relationship Management) es un software que permite
    a las empresas gestionar y analizar las interacciones con clientes
    actuales y potenciales. El objetivo es mejorar las relaciones
    comerciales, retener clientes y aumentar las ventas mediante la
    centralización de información de contactos, historial de compras
    y comunicaciones en una única plataforma accesible."
   (56 palabras - longitud óptima)
3. Implementar FAQPage schema
```

---

## E-E-A-T Audit (Página 134) {#e-e-a-t-audit}

### Audit de Autor: Before & After

#### BEFORE (Score: 4/10)

```html
<!-- Byline básico -->
<div class="author">
  Por: Juan Pérez
</div>
```

**Problemas:**
- Sin biografía
- Sin credenciales
- Sin foto
- Sin enlaces a perfil
- Sin schema

#### AFTER (Score: 9/10)

```html
<!-- Author Box completo -->
<div class="author-box" itemscope itemtype="https://schema.org/Person">
  <img src="/authors/juan-perez.jpg"
       alt="Juan Pérez"
       itemprop="image"
       class="author-photo">

  <div class="author-info">
    <h3 itemprop="name">Juan Pérez</h3>
    <p itemprop="jobTitle">Senior SEO Consultant</p>

    <p itemprop="description">
      Juan tiene más de 10 años de experiencia en SEO técnico y ha trabajado
      con más de 100 empresas B2B. Es Google Analytics Certified y ponente
      regular en MozCon y SearchLove. Anteriormente fue SEO Lead en
      <span itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">
        <span itemprop="name">Salesforce</span>
      </span>.
    </p>

    <div class="author-credentials">
      <strong>Credenciales:</strong>
      <ul>
        <li>Google Analytics Individual Qualification</li>
        <li>Master en Marketing Digital - IE Business School</li>
        <li>10+ años experiencia SEO</li>
        <li>50+ proyectos completados</li>
      </ul>
    </div>

    <div class="author-social">
      <a href="https://linkedin.com/in/juanperez"
         itemprop="sameAs"
         rel="nofollow">LinkedIn</a>
      <a href="https://twitter.com/juanperez"
         itemprop="sameAs"
         rel="nofollow">Twitter</a>
      <a href="/author/juan-perez"
         itemprop="url">Ver todos los artículos</a>
    </div>
  </div>
</div>

<!-- Schema adicional -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Guía Completa de CRM para Empresas 2024",
  "author": {
    "@type": "Person",
    "name": "Juan Pérez",
    "url": "https://acmecrm.com/author/juan-perez",
    "jobTitle": "Senior SEO Consultant",
    "alumniOf": {
      "@type": "Organization",
      "name": "IE Business School"
    },
    "sameAs": [
      "https://linkedin.com/in/juanperez",
      "https://twitter.com/juanperez"
    ]
  },
  "publisher": {
    "@type": "Organization",
    "name": "ACME CRM",
    "logo": {
      "@type": "ImageObject",
      "url": "https://acmecrm.com/logo.png"
    }
  },
  "datePublished": "2024-01-15",
  "dateModified": "2024-01-15"
}
</script>
```

### Audit About Us Page

#### Checklist de completitud:

**Contenido requerido:**

```markdown
✅ Historia de la empresa
  - Cuándo se fundó
  - Por qué se fundó (problema que resuelve)
  - Hitos importantes

✅ Equipo y liderazgo
  - Fundadores con fotos y biografías
  - Equipo ejecutivo con roles
  - Fotos reales (NO stock photos)
  - Enlaces a LinkedIn

✅ Logros y reconocimientos
  - Premios de industria
  - Certificaciones (ISO, SOC2, etc.)
  - Clientes destacados (con logos)
  - Media coverage

✅ Valores y cultura
  - Mission statement
  - Valores corporativos
  - Compromiso con clientes

✅ Contacto y transparencia
  - Dirección física (si aplica)
  - Múltiples formas de contacto
  - Mapa de oficinas
  - Información legal (CIF/NIF)

✅ Señales de autoridad
  - Menciones en prensa
  - Partnerships estratégicos
  - Membresías de asociaciones
  - Casos de éxito documentados
```

**Ejemplo de sección de equipo:**

```html
<section class="team" itemscope itemtype="https://schema.org/Organization">
  <h2>Nuestro Equipo</h2>

  <div class="team-member" itemscope itemtype="https://schema.org/Person">
    <img src="maria-garcia.jpg" alt="María García" itemprop="image">
    <h3 itemprop="name">María García</h3>
    <p itemprop="jobTitle">CEO & Co-founder</p>
    <p itemprop="description">
      María tiene 15 años de experiencia en SaaS B2B. Anteriormente fue VP
      de Producto en HubSpot donde lideró el equipo de CRM. MBA por IESE
      Business School.
    </p>
    <a href="https://linkedin.com/in/mariagarcia" itemprop="sameAs">LinkedIn</a>
  </div>

  <!-- Repetir para cada miembro clave -->
</section>
```

### Scoring E-E-A-T

**Rubrica de evaluación (0-10):**

**Experience (Experiencia práctica)**
```
0-2: Sin evidencia de experiencia
3-4: Menciones vagas de experiencia
5-6: Experiencia mencionada pero sin detalles
7-8: Experiencia detallada con ejemplos
9-10: Experiencia demostrable con casos, datos, resultados

Ejemplo de 9/10:
"He auditado más de 50 sitios e-commerce en los últimos 3 años.
 En mi último proyecto con [Cliente], aumentamos el tráfico orgánico
 de 10K a 45K visitas/mes en 8 meses (captura de GSC adjunta)."
```

**Expertise (Conocimiento especializado)**
```
0-2: Sin credenciales ni demostración de conocimiento
3-4: Conocimiento general sin especialización
5-6: Alguna especialización mencionada
7-8: Credenciales verificables + especialización
9-10: Expert reconocido con credenciales + publicaciones

Ejemplo de 9/10:
- Google Analytics Certified Professional
- Master en Marketing Digital (universidad reconocida)
- Ponente en 3+ conferencias de industria
- Autor de 20+ artículos publicados en Search Engine Journal
```

**Authoritativeness (Autoridad reconocida)**
```
0-2: Desconocido, sin menciones externas
3-4: Presencia básica online
5-6: Algunas menciones en sitios del sector
7-8: Múltiples menciones en sitios autoritativos
9-10: Reconocido como thought leader, citado frecuentemente

Ejemplo de 9/10:
- Citado en 10+ artículos de Search Engine Land
- Perfil en Wikipedia
- 50+ backlinks de sitios DR>70
- Entrevistas en podcasts del sector
```

**Trustworthiness (Confiabilidad)**
```
0-2: Señales de baja confianza (contenido dudoso, spam)
3-4: Confianza neutral, sin señales claras
5-6: Señales básicas (HTTPS, contacto)
7-8: Múltiples señales de confianza
9-10: Máxima transparencia y señales de trust

Ejemplo de 9/10:
✅ HTTPS con certificado válido
✅ Política de privacidad detallada
✅ Términos de servicio claros
✅ Contacto múltiple (email, phone, dirección)
✅ Información legal completa
✅ Reviews verificadas (Google, Trustpilot)
✅ Proceso editorial documentado
✅ Política de correcciones visible
✅ Fuentes citadas en todo el contenido
✅ Transparencia de afiliaciones/sponsors
```

---

## IA/SGE Optimization (Página 135) {#ia-sge-optimization}

### Detectar apariciones en AI Overviews

**Herramientas:**
- BrightEdge Data Cube (enterprise)
- SEMrush SGE tracking (beta)
- Manual testing con diferentes queries

**Proceso manual:**

1. Abrir navegador en modo incógnito
2. Google.com (NOT local version si quieres US results)
3. Buscar keywords informacionales prioritarias
4. Documentar si aparece AI Overview

**Ejemplo de tracking:**

```
Keyword: "cómo elegir un crm para mi empresa"
Fecha: 2024-01-15
SGE presente: SÍ

Contenido del AI Overview:
"Para elegir un CRM adecuado, considere:
 1. Tamaño de su equipo
 2. Presupuesto disponible
 3. Integraciones necesarias
 4. Facilidad de uso
 5. Soporte técnico"

Fuentes citadas en SGE:
1. softwareadvice.com
2. capterra.com
3. hubspot.com
← Nuestra web NO aparece

Oportunidad: Crear contenido más estructurado con este formato
```

### Optimizar contenido para citación en IA

**Formato Answer-First:**

#### BEFORE (no optimizado para IA)
```markdown
# Cómo Elegir un CRM

Los CRMs son herramientas esenciales en el mundo moderno. Hay muchas
opciones en el mercado y elegir puede ser confuso. En este artículo
vamos a explorar diferentes aspectos...

[400 palabras más antes de llegar al punto]
```

#### AFTER (optimizado para IA extraction)
```markdown
# Cómo Elegir un CRM para Tu Empresa: Guía 2024

## Respuesta Directa

Para elegir el CRM correcto para tu empresa, evalúa estos 5 factores clave:

1. **Tamaño del equipo**: CRMs para 1-10 usuarios vs 50+ usuarios tienen features distintos
2. **Presupuesto**: Rangos desde €10/usuario/mes (básicos) hasta €150+ (enterprise)
3. **Integraciones**: Verifica compatibilidad con tu email, calendario y otras herramientas
4. **Facilidad de uso**: Solicita demos y prueba la curva de aprendizaje
5. **Soporte técnico**: Evalúa horarios de soporte y canales disponibles

---

## Guía Detallada por Tipo de Empresa

### Para Empresas Pequeñas (1-10 empleados)
[Detalles específicos...]

### Para Empresas Medianas (11-50 empleados)
[Detalles específicos...]

### Para Empresas Grandes (50+ empleados)
[Detalles específicos...]
```

**¿Por qué funciona mejor?**
- Respuesta directa en primeros 50-75 palabras
- Formato de lista numerada (fácil de extraer)
- Estructura clara con headings
- Información específica y accionable
- Extensión apropiada (no demasiado corto ni largo)

### Implementar schema FAQ optimizado

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Cuánto cuesta un CRM para mi empresa?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<p>Los CRMs cuestan entre €10-150 por usuario al mes, dependiendo de features:<ul><li><strong>Básicos (€10-30/usuario):</strong> gestión de contactos, tareas, calendar</li><li><strong>Profesionales (€30-80/usuario):</strong> automation, reporting, integraciones</li><li><strong>Enterprise (€80-150+/usuario):</strong> AI, personalización, soporte dedicado</li></ul><p>La mayoría ofrece trials gratuitos de 14-30 días para evaluar antes de comprar.</p>"
      }
    },
    {
      "@type": "Question",
      "name": "¿Qué CRM es mejor para pequeñas empresas?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<p>Para pequeñas empresas (1-10 personas), los mejores CRMs son:<ul><li><strong>HubSpot CRM:</strong> Gratuito, fácil de usar, buenas integraciones</li><li><strong>Pipedrive:</strong> Enfoque en ventas, UI simple, €12.50/usuario</li><li><strong>Zoho CRM:</strong> Completo y económico, desde €14/usuario</li></ul><p>Criterio clave: simplicidad de setup (< 1 hora) y curva de aprendizaje corta.</p>"
      }
    }
  ]
}
</script>
```

**Best practices para FAQ schema:**
- 5-10 preguntas por página (no spam)
- Respuestas 40-300 palabras (sweet spot: 80-150)
- HTML básico en respuestas (<p>, <ul>, <strong>)
- Preguntas reales que usuarios hacen (usar PAA, Answer The Public)
- Respuestas completas y útiles (no "Contáctanos para saber más")

---

## Voice Search (Página 136) {#voice-search}

### Identificar queries conversacionales en GSC

**Paso 1: Filtrar queries por longitud**

En GSC Performance, no hay filtro directo por longitud, pero puedes exportar y analizar:

1. Export full data (16 meses máximo)
2. En Excel/Sheets, añadir columna:
   ```excel
   =LEN(A2)-LEN(SUBSTITUTE(A2," ",""))+1
   ```
   (Cuenta número de palabras)

3. Filtrar queries con 5+ palabras
4. Buscar patterns conversacionales:
   ```
   - Comienzan con: cómo, qué, cuándo, dónde, por qué, cuál
   - Incluyen: mejor, mejores, para, hacer, usar
   - Son preguntas completas
   ```

**Ejemplo de análisis:**

```csv
Query,Words,Type,Impressions,Clicks,CTR,Position
qué es un crm,4,Question,2400,85,3.54,8
cómo funciona un crm para empresas,6,Conversational,890,28,3.15,12
cuál es el mejor crm para pequeñas empresas,8,Conversational,720,18,2.50,15
crm,1,Short,15000,450,3.00,5

Insights:
- Queries conversacionales (5+ palabras) = 18% del tráfico
- CTR de conversacionales ligeramente menor (posiciones más bajas)
- Oportunidad: optimizar para subir posiciones en conversacionales
```

### Optimizar para featured snippets (voz)

**Structure perfecto para Voice:**

```markdown
## ¿Cuánto tiempo tarda implementar un CRM?

La implementación de un CRM toma entre 1 semana y 3 meses, dependiendo del tamaño de tu empresa y complejidad requerida.

**Timeline típico por tamaño:**
- **Pequeñas empresas (1-10 usuarios):** 1-2 semanas
- **Medianas empresas (11-50 usuarios):** 3-6 semanas
- **Grandes empresas (50+ usuarios):** 2-3 meses

**Factores que afectan el tiempo:**
1. Migraciones de datos existentes
2. Integraciones con otras herramientas
3. Customizaciones y workflows
4. Training del equipo

La mayoría de CRMs modernos permiten un setup básico en menos de 1 hora, con optimizaciones graduales después.
```

**¿Por qué funciona para voice?**
- Primera oración = respuesta directa (29 palabras - ideal para leer)
- Lista con bullets (fácil de navegar por voz)
- Información completa pero concisa
- Responde follow-up questions anticipadas

### Google Business Profile optimization (para local voice)

Si tienes ubicación física:

**Q&A optimization:**

```
Pregunta seedeada: "¿Están abiertos los fines de semana?"
Respuesta: "Sí, estamos abiertos sábados de 10:00-14:00.
Domingos cerrado. Puedes agendar cita online en
acmecrm.com/agendar o llamarnos al +34-XXX-XXX-XXX."

Pregunta seedeada: "¿Cuánto cuesta una demo del CRM?"
Respuesta: "Las demos son completamente gratuitas y duran 30 minutos.
Puedes agendarla online sin compromiso en acmecrm.com/demo-gratis
o contactarnos directamente."
```

**Posts frecuentes con lenguaje natural:**

```
Post tipo "Update":
🎉 Nuevas funcionalidades de IA en nuestro CRM

Ahora puedes automatizar tus seguimientos de ventas con inteligencia
artificial. La nueva función predice qué leads tienen mayor probabilidad
de conversión y sugiere el mejor momento para contactarlos.

Perfecto para equipos de ventas que buscan aumentar eficiencia.

👉 Agenda una demo gratuita para verlo en acción
[CTA Button: Agendar Demo]
```

---

## Video SEO (Página 137) {#video-seo}

### YouTube Title Optimization

**Formula ganadora:**

```
[Keyword Principal] | [Beneficio/Hook] | [Brand]
Max 60 caracteres (se trunca después)
```

**Ejemplos:**

❌ MAL:
```
Video sobre CRM
```
(Sin keywords, vago, sin hook)

✅ BUENO:
```
Tutorial CRM 2024: Guía Completa en Español | ACME CRM
```
(Keyword + año + diferenciador + marca)

✅ EXCELENTE:
```
Cómo Implementar un CRM en 1 Hora [Paso a Paso] | ACME
```
(Keyword + promesa específica + formato + marca)

### Description Template

```
[Hook primeros 157 caracteres - se muestran en preview]

⏱️ TIMESTAMPS:
00:00 - Introducción
01:30 - ¿Qué es un CRM?
03:45 - Beneficios principales
07:20 - Cómo elegir el correcto
12:10 - Demo en vivo
18:45 - Preguntas frecuentes
22:30 - Próximos pasos

📚 RECURSOS MENCIONADOS:
→ Checklist de selección CRM: https://acmecrm.com/checklist
→ Comparativa CRMs 2024: https://acmecrm.com/comparativa
→ Prueba gratis 30 días: https://acmecrm.com/trial

❓ PREGUNTAS DEL VIDEO:
- ¿Cuánto cuesta un CRM? [03:45]
- ¿Necesito conocimientos técnicos? [09:15]
- ¿Funciona para mi sector? [15:30]

---

🎯 SOBRE ACME CRM:
ACME CRM es la solución de gestión de clientes #1 para empresas españolas.
Más de 5,000 empresas confían en nuestra plataforma para automatizar
ventas y mejorar relaciones con clientes.

🔗 Visita: https://acmecrm.com
📧 Email: hola@acmecrm.com
💼 LinkedIn: https://linkedin.com/company/acmecrm

#CRM #GestionDeClientes #SoftwareEmpresarial #Ventas #MarketingAutomation
```

### Video Schema Implementation

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "VideoObject",
  "name": "Cómo Implementar un CRM en 1 Hora - Tutorial Completo",
  "description": "Aprende a implementar un CRM desde cero en tu empresa en menos de 1 hora. Incluye demo práctica, mejores prácticas y errores comunes a evitar.",
  "thumbnailUrl": [
    "https://acmecrm.com/videos/thumbnail-480.jpg",
    "https://acmecrm.com/videos/thumbnail-720.jpg",
    "https://acmecrm.com/videos/thumbnail-1080.jpg"
  ],
  "uploadDate": "2024-01-15T08:00:00+01:00",
  "duration": "PT23M30S",
  "contentUrl": "https://acmecrm.com/videos/implementar-crm.mp4",
  "embedUrl": "https://youtube.com/embed/VIDEO_ID_HERE",
  "interactionStatistic": {
    "@type": "InteractionCounter",
    "interactionType": "http://schema.org/WatchAction",
    "userInteractionCount": 5647
  },
  "publisher": {
    "@type": "Organization",
    "name": "ACME CRM",
    "logo": {
      "@type": "ImageObject",
      "url": "https://acmecrm.com/logo.png",
      "width": 600,
      "height": 60
    }
  }
}
</script>
```

### Transcript for SEO

**Añadir transcript completo en página:**

```html
<article class="video-page">
  <h1>Cómo Implementar un CRM en 1 Hora - Tutorial</h1>

  <!-- Video embed -->
  <div class="video-container">
    <iframe src="https://youtube.com/embed/VIDEO_ID" ...></iframe>
  </div>

  <!-- Transcript completo -->
  <section class="transcript">
    <h2>Transcripción Completa del Video</h2>

    <p><strong>[00:00]</strong> Hola, soy María de ACME CRM y en este
    video te voy a enseñar cómo implementar un CRM en tu empresa en
    menos de una hora...</p>

    <p><strong>[01:30]</strong> Primero, ¿qué es exactamente un CRM?
    CRM significa Customer Relationship Management, o gestión de relaciones
    con clientes...</p>

    <!-- Continuar con transcript completo -->
  </section>

  <!-- Timestamps navegables -->
  <section class="video-chapters">
    <h3>Capítulos</h3>
    <ul>
      <li><a href="#t=0m00s">00:00 - Introducción</a></li>
      <li><a href="#t=1m30s">01:30 - ¿Qué es un CRM?</a></li>
      <li><a href="#t=3m45s">03:45 - Beneficios principales</a></li>
      <!-- ... -->
    </ul>
  </section>
</article>
```

**Beneficios del transcript:**
✅ Google puede "leer" contenido del video
✅ Accesibilidad (usuarios sordos, preferencia lectura)
✅ Keywords adicionales indexadas
✅ Usuarios pueden search-in-page (Ctrl+F)
✅ Mejor engagement (facilita skipping a secciones)

---

## SEO Local (Página 138) {#seo-local}

### Google Business Profile: Completar al 100%

**Checklist de optimización completa:**

```
INFORMACIÓN BÁSICA [15 puntos]
✅ Business name correcto (sin keywords spam)
✅ Primary category específica y precisa
✅ 3+ Secondary categories relevantes
✅ Description completa (750 chars, keywords natural)
✅ Website URL
✅ Phone (local, rastreable)
✅ Address verificada con Google postcard
✅ Service area definido (si aplica)
✅ Hours actualizado (+ special hours festivos)
✅ Opening date
✅ Attributes (women-led, online appointments, etc.)

MULTIMEDIA [20 puntos]
✅ Logo alta resolución (1200×1200px)
✅ Cover photo profesional (1024×576px)
✅ 10+ photos del negocio (exterior, interior, equipo)
✅ 5+ photos de productos/servicios
✅ Photos actualizadas últimos 3 meses
✅ Video del negocio (90 segundos, mostrar ventajas)
✅ Virtual tour (si aplica - Google Street View trusted)

ENGAGEMENT [30 puntos]
✅ Google Posts (mínimo 1 por semana)
✅ Products/Services añadidos con descriptions
✅ Q&A seeded (10+ preguntas frecuentes respondidas)
✅ Reviews (objetivo: 4.5+ rating, 50+ reviews)
✅ Response a 100% de reviews (<48hrs)
✅ Mensajería activada (responder <1 hora)

AVANZADO [35 puntos]
✅ Appointments/Bookings integrados
✅ Menu/Catalog completamente cargado
✅ Promociones/Offers activos
✅ COVID-19 info actualizado (si relevante)
✅ Accessibility features documentadas
✅ Payment methods listados
✅ Parking info
✅ Popular times verificado
✅ FAQs seeded

TOTAL: ___ / 100 puntos
```

### NAP Consistency Audit

**Script para verificar NAP:**

```python
# Pseudo-código del proceso

locations_to_check = [
    "Google Business Profile",
    "Website footer",
    "Website contact page",
    "Facebook Business",
    "LinkedIn Company",
    "Yelp",
    "Yellow Pages",
    "Bing Places",
    "Apple Maps",
    "TripAdvisor"
]

for location in locations_to_check:
    extract_nap(location)
    compare_with_master()
    flag_discrepancies()

# Output ejemplo:
{
    "name": {
        "master": "ACME CRM Solutions, S.L.",
        "discrepancies": [
            {"location": "Yelp", "value": "ACME CRM"},
            {"location": "Yellow Pages", "value": "Acme CRM Solutions"}
        ]
    },
    "address": {
        "master": "Calle Gran Vía 45, 3º B, 28013 Madrid",
        "discrepancies": [
            {"location": "Bing", "value": "C/ Gran Via 45 3B Madrid"}
        ]
    },
    "phone": {
        "master": "+34 91 123 4567",
        "discrepancies": [
            {"location": "Facebook", "value": "+34-911-234-567"},
            {"location": "TripAdvisor", "value": "911234567"}
        ]
    }
}
```

**Correcciones prioritarias:**

1. **Establecer formato master:**
   ```
   Name: ACME CRM Solutions, S.L.
   Address: Calle Gran Vía 45, 3º B, 28013 Madrid, España
   Phone: +34 91 123 4567
   ```

2. **Actualizar en orden:**
   - Google Business Profile (más importante)
   - Website (todas las menciones)
   - Social media profiles
   - Top directories (Yelp, Yellow Pages, etc.)
   - Long tail directories

3. **Documentar en spreadsheet:**
   ```csv
   Platform,URL,NAP_Status,Last_Updated,Notes
   Google Business Profile,g.page/acmecrm,CORRECTO,2024-01-15,Verificado
   Yelp,yelp.com/biz/acme,INCORRECTO,2024-01-15,Falta piso
   ```

### Local Content Strategy

**Local Landing Pages Structure:**

Para multi-location businesses:

```
/ubicaciones/ (hub page)
  ├── /ubicaciones/madrid/
  ├── /ubicaciones/barcelona/
  └── /ubicaciones/valencia/
```

**Template de página local:**

```markdown
# [Servicio] en [Ciudad] | ACME CRM

## CRM para Empresas en Madrid - Expertos Locales

ACME CRM es el proveedor líder de software CRM para empresas en Madrid.
Con oficina en el corazón de la capital, servimos a más de 500 empresas
madrileñas desde 2015.

### Por Qué Empresas de Madrid Eligen ACME CRM

- ✅ **Soporte local**: Equipo en Madrid disponible en horario de oficina
- ✅ **Implementación presencial**: Visitamos tu oficina para setup
- ✅ **Eventos locales**: Webinars y workshops mensuales en Madrid
- ✅ **Casos de éxito**: 150+ empresas en Madrid confían en nosotros

### Clientes en Madrid [Social Proof Local]

[Logos de 6-8 clientes de Madrid con permiso]

"ACME CRM transformó nuestra gestión de clientes. El soporte local
es invaluable cuando necesitamos ayuda rápida."
- Juan Pérez, Director de Ventas en [Empresa Madrid]

### Oficina de Madrid

**Dirección:** Calle Gran Vía 45, 3º B, 28013 Madrid
**Teléfono:** +34 91 123 4567
**Email:** madrid@acmecrm.com
**Horario:** Lunes-Viernes 9:00-18:00

[Google Maps embed]

### Eventos y Workshops en Madrid

[Lista de próximos 3 eventos locales]

### Empresas de Madrid que Usan CRM

Sectores principales en Madrid usando ACME CRM:
- Startups tecnológicas (35%)
- Agencias de marketing (28%)
- Consultorías (22%)
- E-commerce (15%)

### Recursos para Empresas de Madrid

- 📄 [Caso de Estudio: Startup Madrid aumenta ventas 150%]
- 🎥 [Video: Implementación en Cliente de Madrid]
- 📊 [Guía: Elegir CRM para PyMEs Madrileñas]

### Preguntas Frecuentes - Madrid

**¿Ofrecen implementación presencial en Madrid?**
Sí, nuestro equipo de Madrid puede visitarte para implementación y training.

**¿Cuántas empresas de Madrid usan ACME CRM?**
Más de 500 empresas en Madrid confían en nuestra plataforma.

[6-8 FAQs específicas con términos locales]
```

**Schema LocalBusiness:**

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "ACME CRM Solutions - Madrid",
  "image": "https://acmecrm.com/oficina-madrid.jpg",
  "@id": "https://acmecrm.com/ubicaciones/madrid",
  "url": "https://acmecrm.com/ubicaciones/madrid",
  "telephone": "+34911234567",
  "priceRange": "€€",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Calle Gran Vía 45, 3º B",
    "addressLocality": "Madrid",
    "addressRegion": "Madrid",
    "postalCode": "28013",
    "addressCountry": "ES"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 40.4200,
    "longitude": -3.7050
  },
  "openingHoursSpecification": [{
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "09:00",
    "closes": "18:00"
  }],
  "sameAs": [
    "https://facebook.com/acmecrm",
    "https://twitter.com/acmecrm",
    "https://linkedin.com/company/acmecrm"
  ],
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "127"
  },
  "areaServed": {
    "@type": "GeoCircle",
    "geoMidpoint": {
      "@type": "GeoCoordinates",
      "latitude": 40.4200,
      "longitude": -3.7050
    },
    "geoRadius": "50000"
  }
}
</script>
```

---

## Resumen de Implementación

### Priorización de Implementación (90 días)

**Mes 1: Fundaciones**
- ✅ Completar brief y validar con cliente
- ✅ Keyword research completo (páginas 020-024)
- ✅ Quick wins identificados y comenzar implementación
- ✅ E-E-A-T audit básico (author profiles, about us)

**Mes 2: Optimizaciones Principales**
- ✅ Implementar schema markup (E-E-A-T, FAQ, VideoObject)
- ✅ Optimizar top 20 páginas para voice search
- ✅ Video SEO si hay contenido existente
- ✅ Local SEO setup (si aplica)

**Mes 3: Contenido Nuevo y Refinamiento**
- ✅ Crear contenido nuevo basado en keyword mapping
- ✅ Optimizar para SGE/AI (formato answer-first)
- ✅ Implementar monitoring continuo
- ✅ Medir resultados y ajustar estrategia

### KPIs por Módulo

**Keyword Research:**
- Keywords top 10: +25% en 3 meses
- Keywords posiciones 11-20 → top 10: 30% de ellas
- New keywords rankeando: +100 en 90 días

**E-E-A-T:**
- Author profiles completados: 100% en 30 días
- E-E-A-T score promedio: >7/10 en 60 días
- Menciones en sitios DR>70: +5 en 90 días

**Voice/SGE:**
- Featured snippets capturados: +10 en 90 días
- FAQ schema implementado: 20 páginas top en 45 días

**Video SEO:**
- VideoObject schema: 100% videos en 15 días
- Transcripts completos: 100% en 30 días

**Local (si aplica):**
- GBP completion: 100% en 7 días
- NAP consistency: 100% en 14 días
- Reviews nuevas: +20 en 90 días

---

*Este documento debe usarse como referencia práctica durante la implementación. Adaptar ejemplos al contexto específico de cada proyecto.*

**Última actualización:** 2024-01-15
**Versión:** 1.0
