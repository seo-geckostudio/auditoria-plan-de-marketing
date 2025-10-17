## Sección 09 — SEO Moderno: E-E-A-T, IA y Nuevas Tendencias (páginas 134–140)

### Página 134 — E-E-A-T: Experience, Expertise, Authoritativeness, Trust

- Fuente: Análisis Manual, Ahrefs, Google Search Console
- Acción: auditar señales de E-E-A-T en el sitio; evaluar experiencia y expertise demostrada; analizar autoridad y confianza; identificar mejoras específicas para contenido YMYL (Your Money Your Life).
- Evidencias: checklist E-E-A-T por tipo de contenido, matriz de señales implementadas vs faltantes, propuestas de mejora priorizadas.
- Opcional CSV: `eeat_audit.csv` con columnas: `url,tipo_contenido,experience_score,expertise_score,authoritativeness_score,trust_score,mejoras_requeridas,prioridad`.

**Los 4 Pilares de E-E-A-T:**

**1. Experience (Experiencia)**
- Contenido creado por personas con experiencia práctica en el tema
- Señales: testimonios de primera mano, casos de estudio propios, reviews basadas en uso real
- Evidencias: "Probé este producto durante 6 meses", "En mi experiencia como..."
- Aplicable especialmente en: reviews, comparativas, tutoriales, recomendaciones

**2. Expertise (Pericia/Conocimiento)**
- Conocimiento profundo y especializado del tema
- Señales: credenciales verificables, formación académica, certificaciones profesionales
- Evidencias: títulos, años de experiencia, publicaciones académicas, reconocimientos
- Aplicable especialmente en: contenido médico, legal, financiero, técnico

**3. Authoritativeness (Autoridad)**
- Reconocimiento como fuente de referencia en la industria
- Señales: citas en medios respetables, menciones de marca, backlinks de autoridad
- Evidencias: "reconocido por...", "citado en...", colaboraciones con instituciones
- Medible con: menciones de marca, domain rating, calidad de backlinks

**4. Trustworthiness (Confiabilidad)**
- Información precisa, actualizada, transparente y segura
- Señales: HTTPS, políticas claras, contacto visible, referencias verificables
- Evidencias: transparencia editorial, correcciones visibles, fuentes citadas
- Crítico para: transacciones, datos sensibles, consejos que afectan bienestar

**Auditoría E-E-A-T por Elementos:**

**Autores y Contributors**
- [ ] Páginas de autor con biografías detalladas
- [ ] Credenciales y experiencia relevante documentada
- [ ] Enlaces a perfiles sociales profesionales (LinkedIn)
- [ ] Historial de publicaciones del autor visible
- [ ] Fotos reales de autores (no stock photos)
- [ ] Bylines consistentes en todo el contenido

**Contenido y Transparencia**
- [ ] Fechas de publicación y actualización visibles
- [ ] Fuentes y referencias citadas apropiadamente
- [ ] Proceso editorial documentado
- [ ] Política de correcciones y actualizaciones
- [ ] Divulgación de conflictos de interés
- [ ] Diferenciación clara entre contenido editorial y patrocinado

**Sobre Nosotros y Contacto**
- [ ] Página "About Us" detallada y actualizada
- [ ] Información de contacto real y visible
- [ ] Dirección física si es negocio local
- [ ] Equipo y liderazgo documentado
- [ ] Historia y trayectoria de la empresa
- [ ] Premios, reconocimientos, certificaciones

**Señales de Confianza Técnicas**
- [ ] HTTPS en todo el sitio
- [ ] Políticas de privacidad y términos claros
- [ ] Información de cookies y GDPR compliance
- [ ] Sellos de seguridad y certificaciones
- [ ] Reviews y testimonios verificables
- [ ] Presencia en redes sociales activa

**Para Contenido YMYL (salud, finanzas, legal):**
- [ ] Autores con credenciales verificables relevantes
- [ ] Revisión por expertos documentada
- [ ] Fuentes médicas/financieras/legales citadas
- [ ] Disclaimers apropiados
- [ ] Actualización frecuente del contenido
- [ ] Proceso de fact-checking documentado

- Explicación: E-E-A-T es un concepto fundamental en los Quality Rater Guidelines de Google y crítico para el posicionamiento, especialmente en contenido YMYL donde la exactitud puede impactar salud, finanzas o seguridad de usuarios.
- Análisis: revisar manualmente páginas clave evaluando presencia de señales E-E-A-T; identificar páginas YMYL que requieren mayor rigor; analizar contenido de competidores bien posicionados para identificar estándares; evaluar autoridad de autores actuales vs requerida; medir señales de confianza técnicas y editoriales.
- Solución: crear programa de author profiles con biografías completas; implementar schema "Author" y "Organization"; establecer proceso editorial con revisión por expertos; añadir sección de actualización de contenido; implementar citas y referencias; crear página About Us robusta; obtener backlinks de sitios autoritativos en el sector; implementar señales de confianza técnicas faltantes.
- Prioridad: A para sitios YMYL (salud, finanzas, legal); A para contenido comercial de alto valor; B para contenido informacional general.
- Definición de Hecho: auditoría E-E-A-T completa, plan de mejoras implementado, señales medibles de autoridad incrementadas (citas, menciones, backlinks de calidad), contenido de autores con credenciales verificables.

### Página 135 — Optimización para IA Generativa y SGE (Search Generative Experience)

- Fuente: Análisis Manual, experimentación con AI Overviews
- Acción: preparar contenido para AI Overviews y resultados generativos de Google; optimizar para citación en respuestas de IA; estructurar información para extracción por LLMs.
- Evidencias: análisis de apariciones en AI Overviews, optimizaciones implementadas, ejemplos de citaciones obtenidas.

**Estrategias para SGE/AI Optimization:**

**1. Structured Content for AI Extraction**
- Usar formateo claro con headings jerárquicos
- Incluir respuestas directas en primeros párrafos
- Implementar listas, tablas y definiciones claras
- Crear secciones FAQ optimizadas
- Usar schema markup extensivo (FAQPage, HowTo, Article)

**2. Source Attribution and Credibility**
- Citar fuentes originales y autorizadas
- Incluir datos con fechas específicas
- Referenciar estudios y estadísticas verificables
- Mantener información actualizada
- Establecer authorship claro

**3. Comprehensive Coverage**
- Cubrir temas en profundidad
- Responder preguntas relacionadas (People Also Ask)
- Incluir contexto y matices
- Proporcionar múltiples perspectivas cuando sea relevante
- Anticipar follow-up questions

**4. Natural Language and Conversational Queries**
- Optimizar para preguntas completas ("¿Cómo puedo...?")
- Incluir variaciones conversacionales
- Responder a intención implícita
- Usar lenguaje natural sin keyword stuffing
- Formatear contenido pregunta-respuesta

**5. Multi-modal Content**
- Incluir imágenes con alt text descriptivo
- Añadir videos con transcripciones
- Crear infografías con datos estructurados
- Implementar schema ImageObject y VideoObject
- Asegurar que contenido visual sea accesible

**Elementos Técnicos para IA:**

```html
<!-- Schema para facilitar extracción por IA -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "¿Qué es E-E-A-T en SEO?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "E-E-A-T (Experience, Expertise, Authoritativeness, Trust) es..."
    }
  }]
}
</script>

<!-- Structured content -->
<article itemscope itemtype="https://schema.org/Article">
  <h1 itemprop="headline">Título del artículo</h1>
  <div itemprop="author" itemscope itemtype="https://schema.org/Person">
    <span itemprop="name">Nombre del Autor</span>
  </div>
  <time itemprop="datePublished" datetime="2024-01-15">15 de enero, 2024</time>
</article>
```

**Monitoring AI Overviews:**
- Usar herramientas especializadas para detectar apariciones en SGE
- Documentar queries que activan AI Overviews para el sitio
- Analizar competidores citados en AI Overviews
- Medir impacto en CTR cuando SGE está presente
- Ajustar estrategia basada en tipos de queries que generan SGE

- Explicación: la Search Generative Experience de Google y los AI Overviews están cambiando la forma en que se presenta información en búsquedas, requiriendo optimización específica para ser citado como fuente en respuestas generativas.
- Análisis: identificar queries donde SGE/AI Overviews están activos en tu sector; analizar qué sitios son citados como fuentes; evaluar formato y estructura de contenido citado; experimentar con diferentes formatos para maximizar citaciones; medir impacto en tráfico de queries con SGE activo.
- Solución: reestructurar contenido prioritario con formato FAQ; implementar schema markup extensivo; crear "answer boxes" al inicio de contenido; optimizar para conversational queries; establecer autoridad clara de autores; implementar monitoreo de apariciones en SGE; crear contenido específicamente optimizado para AI extraction.
- Prioridad: B para preparación a futuro; A si tu sector ya tiene SGE activo en queries importantes.
- Definición de Hecho: contenido optimizado para SGE implementado, apariciones en AI Overviews documentadas, estrategia de adaptación establecida.

### Página 136 — Búsqueda por Voz y Queries Conversacionales

- Fuente: Google Search Console, Answer The Public, análisis de queries conversacionales
- Acción: optimizar para búsquedas por voz y asistentes virtuales; crear contenido que responda queries conversacionales; implementar schema específico para voice search.
- Evidencias: inventario de queries conversacionales, contenido optimizado para voz, implementación de schema SpecialAnnouncement y SpeakableSpecification.
- Opcional CSV: `voice_search_keywords.csv` con columnas: `query_conversacional,volumen,intent,contenido_actual,contenido_propuesto,prioridad`.

**Características de Voice Search:**

**1. Queries Conversacionales y Completas**
- Más largas que text search (>3 palabras típicamente)
- Formuladas como preguntas completas
- Uso de palabras como: quién, qué, dónde, cuándo, por qué, cómo
- Lenguaje natural y coloquial
- Ejemplos:
  - Text: "restaurante italiano madrid"
  - Voice: "¿Dónde hay un buen restaurante italiano cerca de mí?"

**2. Intención Local Fuerte**
- Alta proporción de búsquedas "cerca de mí"
- Consultas específicas de ubicación
- Necesidad de respuestas inmediatas y prácticas
- Móvil como dispositivo primario

**3. Featured Snippets Critical**
- Asistentes leen featured snippets como respuesta
- Posición 0 es objetivo principal
- Respuestas concisas de 29-40 palabras ideales
- Formato párrafo para respuestas directas

**Estrategias de Optimización:**

**1. Content Optimization**
- Escribir en tono conversacional y natural
- Incluir preguntas como headings (H2, H3)
- Proporcionar respuestas directas en primeros 2-3 párrafos
- Usar lenguaje simple y accesible
- Incluir variaciones de preguntas relacionadas

**2. FAQ Content**
- Crear secciones FAQ extensas
- Una pregunta = un heading
- Respuestas concisas (20-50 palabras para voice)
- Implementar FAQPage schema
- Cubrir preguntas de long-tail

**3. Local Optimization (si aplica)**
- Optimizar Google Business Profile completamente
- Mantener NAP (Name, Address, Phone) consistente
- Incluir información de ubicación en contenido
- Schema LocalBusiness completamente implementado
- Reviews activas y respondidas

**4. Schema Markup para Voice**

```html
<!-- FAQPage para asistentes -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "¿Cuál es el mejor momento para hacer SEO?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "El mejor momento para hacer SEO es ahora mismo, ya que los resultados tardan 3-6 meses en materializarse."
    }
  }]
}
</script>

<!-- Speakable para contenido hablable -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebPage",
  "speakable": {
    "@type": "SpeakableSpecification",
    "cssSelector": ["#introduction", "#summary"]
  }
}
</script>
```

**5. Technical Optimizations**
- Velocidad de carga crítica (mobile especialmente)
- HTTPS obligatorio
- Mobile-first design perfecto
- Structured data sin errores
- Schema breadcrumbs para navegación

**6. Long-tail Question Keywords**
- Buscar questions en Answer The Public
- Analizar "People Also Ask" en SERPs
- Usar herramientas de question mining
- Identificar patterns: "cómo", "por qué", "qué es"
- Crear contenido específico por question cluster

**Medición y Optimización:**
- Identificar queries conversacionales en GSC
- Analizar comportamiento mobile vs desktop
- Medir featured snippet captures
- Tracking de "near me" queries performance
- A/B testing de formatos de respuesta

- Explicación: las búsquedas por voz representan una proporción creciente del search traffic, especialmente en mobile, y requieren optimización específica para queries más largas y conversacionales.
- Análisis: extraer queries conversacionales de GSC (filtrar por longitud >5 palabras); usar Answer The Public para identificar questions populares; analizar People Also Ask en SERPs objetivo; evaluar featured snippets actuales obtenidos; identificar queries "cerca de mí" si aplica; benchmarcar contenido FAQ de competidores.
- Solución: crear comprehensive FAQ pages por categoría; reestructurar contenido con preguntas como headings; escribir respuestas concisas y directas; implementar schema FAQPage y Speakable; optimizar para local si aplica; mejorar velocidad mobile; crear contenido específico para question clusters; establecer monitoring de featured snippets.
- Prioridad: A si hay alto tráfico mobile o negocio local; B para preparación general.
- Definición de Hecho: contenido FAQ optimizado implementado, incremento en featured snippets capturados, aumento medible en tráfico de queries conversacionales.

### Página 137 — SEO para Video

- Fuente: YouTube Analytics, Google Search Console, análisis de video SERPs
- Acción: optimizar contenido de video para búsqueda; implementar video schema; crear estrategia de video content; optimizar YouTube channel si aplica.
- Evidencias: inventario de videos, optimizaciones implementadas, video schema validado, performance tracking.
- Opcional CSV: `video_seo.csv` con columnas: `video_url,titulo,descripcion_optimizada,keywords_target,schema_implementado,thumbnails,transcripcion,engagement,prioridad`.

**Video SEO Elements:**

**1. Video Hosting y Technical**
- YouTube como plataforma primaria (second largest search engine)
- Self-hosting para control total (con CDN)
- Video sitemap específico
- Implementar VideoObject schema
- Thumbnails optimizadas y atractivas
- Formatos modernos (MP4, WebM)

**2. On-Page Video Optimization**
```html
<!-- VideoObject Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "VideoObject",
  "name": "Título del Video",
  "description": "Descripción completa del video...",
  "thumbnailUrl": "https://example.com/thumbnail.jpg",
  "uploadDate": "2024-01-15T08:00:00+00:00",
  "duration": "PT5M30S",
  "contentUrl": "https://example.com/video.mp4",
  "embedUrl": "https://youtube.com/embed/VIDEO_ID",
  "interactionStatistic": {
    "@type": "InteractionCounter",
    "interactionType": "http://schema.org/WatchAction",
    "userInteractionCount": 5647
  }
}
</script>
```

**3. YouTube SEO (si aplica)**

**Elementos del Video:**
- Título optimizado (60 caracteres, keyword principal al inicio)
- Descripción detallada (primeros 157 caracteres críticos)
- Tags relevantes (mezcla de broad y specific)
- Thumbnail custom y de alta calidad
- Closed captions/subtítulos (upload manual mejor que auto)
- Cards y end screens estratégicos

**Descripción optimizada:**
```
Aprende SEO técnico en 2024 [Keyword principal]

En este video completo cubrimos:
⏱️ 00:00 - Introducción
⏱️ 02:15 - Core Web Vitals
⏱️ 05:30 - Structured Data
[... timestamps completos]

🔗 Recursos mencionados:
- Herramienta X: https://...
- Guía completa: https://...

📈 Sobre nosotros: [breve descripción]

#SEO #TechnicalSEO #WebDevelopment
```

**Channel Optimization:**
- About page completa con keywords
- Channel trailer efectivo
- Playlists organizadas por tema
- Consistent branding (banner, logo)
- Enlaces a sitio web y redes
- Publicación consistente (schedule)

**4. Transcripciones y Accesibilidad**
- Transcript completo en página
- Subtítulos en múltiples idiomas si aplica
- Descripción de elementos visuales
- Mejora SEO y accesibilidad simultáneamente
- Permite a Google "leer" contenido del video

**5. Engagement Signals**
- Watch time (métrica más importante)
- Click-through rate en SERPs/sugeridos
- Likes, comentarios, shares
- Suscripciones generadas
- Responder a comentarios activamente

**6. Video Content Strategy**

**Tipos de video para SEO:**
- **Tutoriales/How-to**: excelente para featured videos
- **Product reviews**: captura intent transaccional
- **Comparativas**: alto engagement
- **FAQs en video**: optimiza para voice/conversational
- **Case studies**: fortalece E-E-A-T
- **Webinars/interviews**: construye autoridad

**7. Video Sitemap**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  <url>
    <loc>https://example.com/page-with-video</loc>
    <video:video>
      <video:thumbnail_loc>https://example.com/thumb.jpg</video:thumbnail_loc>
      <video:title>Video Title</video:title>
      <video:description>Video description</video:description>
      <video:content_loc>https://example.com/video.mp4</video:content_loc>
      <video:duration>600</video:duration>
      <video:publication_date>2024-01-15T08:00:00+00:00</video:publication_date>
    </video:video>
  </url>
</urlset>
```

**8. Video Performance Tracking**
- Impressions en video search (GSC)
- CTR de video thumbnails
- Watch time y retention rate
- Tráfico generado a sitio web
- Conversiones desde video
- Rankings en YouTube search

- Explicación: el contenido de video es cada vez más prominente en SERPs y YouTube es el segundo motor de búsqueda más grande, requiriendo estrategia específica de optimización.
- Análisis: auditar videos existentes y su optimización; identificar opportunities en video SERPs para keywords objetivo; analizar performance de videos en YouTube Analytics; evaluar video schema implementation; revisar competencia en video content; identificar gaps de contenido video.
- Solución: crear/optimizar video sitemap; implementar VideoObject schema en todas las páginas con video; optimizar títulos y descripciones en YouTube; añadir transcripciones completas; crear thumbnails optimizadas; establecer calendario de publicación de video; optimizar channel si aplica; medir y optimizar basado en engagement metrics.
- Prioridad: A si el sector tiene alta presencia de video en SERPs; B para preparación estratégica.
- Definición de Hecho: video strategy documentada, todos los videos con schema y optimización completa, incremento en tráfico de video search.

### Página 138 — SEO Local

- Fuente: Google Business Profile, Google Search Console, análisis local
- Acción: optimizar para búsquedas locales; completar y optimizar Google Business Profile; implementar local schema; gestionar citations y reviews; optimizar para local pack.
- Evidencias: GBP completo y optimizado, local schema implementado, NAP consistency verificada, strategy de reviews.
- Opcional CSV: `local_seo.csv` con columnas: `location,gbp_status,nap_consistency,citations_count,reviews_count,avg_rating,local_pack_appearances,prioridad`.

**Google Business Profile (GBP) Optimization:**

**1. Información Básica (100% completion obligatorio)**
- [ ] Business name (exacto, sin keywords stuffing)
- [ ] Primary category (específica y precisa)
- [ ] Secondary categories (relevantes, max 9)
- [ ] Business description (750 caracteres, keywords natural)
- [ ] Address exacta y verificada
- [ ] Phone number (local, rastreable)
- [ ] Website URL
- [ ] Hours de operación (actualizar días festivos)
- [ ] Service area (si aplica)
- [ ] Atributos relevantes del negocio

**2. Content y Multimedia**
- [ ] Logo de alta calidad
- [ ] Cover photo profesional
- [ ] 10+ photos del negocio/productos
- [ ] Video del negocio (90 segundos ideal)
- [ ] Virtual tour (si aplica)
- [ ] Photos actualizadas regularmente (mensual)

**3. Products y Services**
- [ ] Listar productos principales
- [ ] Descripciones completas con keywords
- [ ] Precios transparentes
- [ ] Photos por producto
- [ ] Categorización apropiada

**4. Google Posts (1-2 por semana)**
- Events
- Offers/promociones
- Updates
- Products destacados
- Call-to-action fuerte
- Keywords en primer párrafo

**5. Reviews Management**

**Strategy:**
- Solicitar reviews activamente (email, SMS, in-person)
- Responder a TODAS las reviews (24-48hrs ideal)
- Template responses personalizadas
- Gestión de negative reviews proactiva
- Incentivos éticos para reviews (no violar policies)

**Response Template Structure:**
```
Positive Review:
"Hola [Nombre], ¡Muchas gracias por tu review y por confiar en [Negocio]!
Nos alegra mucho que [específico sobre su experiencia].
[Invitación personalizada a volver].
¡Saludos! - [Tu Nombre], [Título]"

Negative Review:
"Hola [Nombre], lamentamos mucho tu experiencia.
[Reconocimiento específico del problema].
Nos gustaría resolver esto directamente.
Por favor contáctanos en [email/phone] para encontrar una solución.
Gracias por tu feedback. - [Tu Nombre], [Título]"
```

**6. Q&A Section**
- Seed con preguntas frecuentes
- Monitorear y responder rápidamente
- Keywords en respuestas naturalmente
- Actualizar información obsoleta

**7. Local Schema Implementation**

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Nombre del Negocio",
  "image": "https://example.com/logo.jpg",
  "@id": "https://example.com",
  "url": "https://example.com",
  "telephone": "+34-XXX-XXX-XXX",
  "priceRange": "$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Calle Example 123",
    "addressLocality": "Madrid",
    "addressRegion": "MD",
    "postalCode": "28001",
    "addressCountry": "ES"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 40.4168,
    "longitude": -3.7038
  },
  "openingHoursSpecification": [{
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
    "opens": "09:00",
    "closes": "18:00"
  }],
  "sameAs": [
    "https://facebook.com/business",
    "https://twitter.com/business",
    "https://instagram.com/business"
  ],
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "127"
  }
}
</script>
```

**8. NAP Consistency (Name, Address, Phone)**

**Criterios:**
- Formato EXACTAMENTE igual en todos lados
- Incluir/excluir suite/floor consistentemente
- Phone format consistente (+34-XXX vs +34 XXX XXX XXX)
- Business name sin variaciones

**Locations to Verify:**
- Google Business Profile
- Website (footer, contact page)
- Facebook, Instagram, LinkedIn
- Directorios locales (Yelp, TripAdvisor, etc.)
- Citations (Yellow Pages, etc.)
- Apple Maps
- Bing Places

**9. Local Citations**

**Top Priority Citations (España):**
- Google Business Profile
- Bing Places
- Apple Maps
- Facebook Business
- Páginas Amarillas
- Yelp
- TripAdvisor (si aplica)
- Sector-specific directories

**Citation Building:**
- Priorizar high-authority directories
- Verificar NAP consistency
- Completar profiles 100%
- Actualizar información regularmente
- Remover duplicates y citations incorrectas

**10. Local Content Strategy**

- Blog posts sobre eventos locales
- Local landing pages por ubicación (si multi-location)
- Contenido con references a la ciudad/área
- Sponsorships y eventos locales
- Colaboraciones con businesses locales
- Local news coverage y PR

**11. Local Link Building**

**Estrategias:**
- Chambers of commerce
- Local business associations
- Sponsorships de eventos locales
- Partnerships con businesses complementarios
- Local media y blogs
- Universidades y organizaciones locales

**12. Tracking y Metrics**

**KPIs Locales:**
- Local pack rankings por keyword
- GBP views (search vs maps)
- Direction requests
- Phone calls
- Website clicks desde GBP
- Review velocity y rating promedio
- Local organic traffic (GSC filtered by query)

- Explicación: el SEO local es crítico para negocios con presencia física o que sirven áreas geográficas específicas, ya que las búsquedas locales tienen alta intención de conversión.
- Análisis: auditar completitud de GBP actual; verificar NAP consistency across the web; analizar local pack rankings para keywords principales; benchmarkar reviews vs competencia local; identificar citation opportunities; evaluar local content actual; analizar search queries con intent local en GSC.
- Solución: optimizar GBP completamente; implementar review solicitation strategy; corregir NAP inconsistencies; construir/actualizar citations en directorios principales; implementar local schema markup; crear local content strategy; establecer local link building program; implementar tracking de local metrics.
- Prioridad: A para negocios con ubicación física o servicio geográfico específico; N/A para negocios puramente online sin componente local.
- Definición de Hecho: GBP 100% optimizado, NAP 100% consistente, 50+ quality citations, review strategy activa, local pack rankings mejorados.

### Página 139 — Entidades y Knowledge Graph

- Fuente: Análisis Manual, herramientas de entities, Google Search
- Acción: optimizar para reconocimiento como entidad; establecer presencia en Knowledge Graph; implementar entity schema; construir connections entre entidades.
- Evidencias: Knowledge Graph panel (si existe), entity schema implementado, SameAs relationships documentadas.

**Conceptos de Entidades:**

**¿Qué es una Entidad?**
- Una "cosa" única y distinguible (persona, lugar, organización, concepto)
- Tiene atributos y relaciones definibles
- Reconocida y catalogada por knowledge bases (Wikipedia, Wikidata, etc.)
- No depende de keywords sino de significado semántico

**Tipos de Entidades:**
- **Person**: individuos, autores, expertos, celebridades
- **Organization**: empresas, instituciones, marcas
- **Place**: ubicaciones, ciudades, landmarks
- **Product**: productos específicos con características únicas
- **Event**: acontecimientos con fecha, lugar, participantes
- **CreativeWork**: libros, películas, artículos, obras

**Entity Schema Implementation:**

**1. Organization Schema**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Nombre de la Empresa",
  "alternateName": "Nombre Alternativo",
  "url": "https://example.com",
  "logo": "https://example.com/logo.png",
  "description": "Descripción de la organización...",
  "foundingDate": "2015",
  "founders": [{
    "@type": "Person",
    "name": "Fundador 1"
  }],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Calle 123",
    "addressLocality": "Madrid",
    "addressRegion": "MD",
    "postalCode": "28001",
    "addressCountry": "ES"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+34-XXX-XXX-XXX",
    "contactType": "customer service",
    "availableLanguage": ["Spanish", "English"]
  },
  "sameAs": [
    "https://www.facebook.com/empresa",
    "https://www.twitter.com/empresa",
    "https://www.linkedin.com/company/empresa",
    "https://www.instagram.com/empresa",
    "https://en.wikipedia.org/wiki/Empresa"
  ]
}
</script>
```

**2. Person Schema (para autores, expertos)**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Nombre del Autor",
  "url": "https://example.com/author/name",
  "image": "https://example.com/author-photo.jpg",
  "jobTitle": "SEO Expert",
  "worksFor": {
    "@type": "Organization",
    "name": "Empresa"
  },
  "alumniOf": {
    "@type": "Organization",
    "name": "Universidad"
  },
  "sameAs": [
    "https://www.linkedin.com/in/persona",
    "https://twitter.com/persona",
    "https://github.com/persona"
  ],
  "knowsAbout": ["SEO", "Digital Marketing", "Technical SEO"]
}
</script>
```

**3. SameAs Relationships**

El atributo `sameAs` conecta la entidad en tu sitio con perfiles verificables en otras plataformas autoritativas:

**Hierarchy de Autoridad:**
1. Wikipedia/Wikidata (máxima autoridad)
2. LinkedIn, Crunchbase (para organizations)
3. Redes sociales verificadas
4. Directorios industry-specific
5. Menciones en medios autoritativos

**Strategy:**
- Crear/optimizar Wikipedia page si cumples notability guidelines
- Establecer Wikidata entry
- Verificar redes sociales
- Mantener profiles consistentes
- Obtener menciones en knowledge bases del sector

**Knowledge Graph Optimization:**

**1. Criteria para Knowledge Panel**
- Wikipedia page (ideal pero no siempre requerido)
- Strong entity signals across the web
- Consistent NAP/information
- Menciones en sitios autoritativos
- Volumen significativo de búsquedas branded
- Schema markup apropiado

**2. Building Entity Authority**
- Obtener mentions en sitios autoritativos
- Co-mentions con otras entidades establecidas
- Construir relationships entre entidades
- Crear contenido que establece expertise
- Aparecer en knowledge bases del sector
- Conseguir coverage en medios

**3. Entity-Based Content**
- Mencionar y link a entidades relacionadas
- Crear relationships explícitas
- Usar nombres oficiales de entidades
- Implementar entity schema cuando mencionas otras entities
- Construir topical authority a través de entity coverage

**4. Monitoring Entity Presence**

**Tools:**
- Google Search Console (queries branded)
- Google Alerts para entity mentions
- Brand24 o similares para monitoring
- Manual search de "site:wikipedia.org [tu marca]"
- Búsqueda de Knowledge Panel directa

**Metrics:**
- Volumen de búsquedas branded
- Knowledge Panel presente (sí/no)
- Completitud de información en KP
- Entities relacionadas mostradas
- "People Also Search For" analysis

**5. Entity SEO Strategy**

- **Paso 1**: Establecer entity presence
  - Crear Wikipedia page (si notable)
  - Wikidata entry
  - Schema markup completo

- **Paso 2**: Build entity authority
  - Media coverage y menciones
  - Backlinks de calidad
  - Co-mentions con autoridades

- **Paso 3**: Expand entity relationships
  - Conectar con related entities
  - Topic cluster strategy
  - Internal entity linking

- **Paso 4**: Maintain y optimize
  - Actualizar información
  - Monitorear menciones
  - Corregir inconsistencias

- Explicación: el entity-based SEO ayuda a Google comprender tu negocio, marca y expertise a través de relaciones semánticas más que keywords, mejorando relevancia y autoridad.
- Análisis: verificar si existe Knowledge Panel; analizar entity recognition en búsquedas branded; evaluar SameAs relationships existentes; identificar entity connections oportunas; revisar schema markup de entities; benchmarkar entity presence vs competidores.
- Solución: implementar comprehensive entity schema; establecer SameAs relationships con plataformas autoritativas; crear/optimizar Wikipedia page si aplica; construir entity authority through mentions y coverage; implementar entity-based internal linking; monitorear entity recognition.
- Prioridad: B como estrategia de long-term authority building; A para marcas establecidas que deberían tener Knowledge Panel.
- Definición de Hecho: entity schema completamente implementado, SameAs relationships establecidos con 5+ plataformas, incremento en búsquedas branded, Knowledge Panel presente (si realista).

### Página 140 — Monitoreo de Algoritmo y Adaptación Continua

- Fuente: Tools de tracking de algoritmo, Google Search Console, Analytics
- Acción: establecer sistema de monitoreo de actualizaciones de algoritmo; crear proceso de análisis de impacto; implementar strategy de adaptación rápida.
- Evidencias: sistema de alertas configurado, dashboard de monitoreo, playbook de respuesta a actualizaciones.

**Sistema de Monitoreo:**

**1. Herramientas de Tracking**
- **Google Search Status Dashboard**: updates oficiales
- **SEMrush Sensor**: volatilidad de SERPs
- **Moz Cast**: weather report de SERPs
- **Algoroo**: algorithm volatility index
- **RankRanger Rank Risk Index**
- **Accuranker Grump Rating**

**2. Internal Monitoring**
- Rankings diarios de keywords críticas
- Tráfico orgánico diario (GA4)
- Impresiones y posición promedio (GSC)
- Visibility index (SISTRIX/SEMrush)
- Alertas automáticas de cambios >10%

**3. Google Official Channels**
- Google Search Central Blog
- @searchliaison en Twitter
- Google Search Status Dashboard
- Google Search Central YouTube
- Documentation updates

**Tipos de Core Updates:**

**1. Core Algorithm Updates** (3-4 por año)
- Impacto amplio en rankings
- Foco en calidad y relevancia
- E-E-A-T signals críticos
- Requiere análisis profundo de impacto

**2. Spam Updates**
- Target prácticas manipulativas
- Pueden incluir penalizaciones
- Devaluation de links spam
- Site-level o page-level

**3. Product Reviews Updates**
- Específico para review content
- Favorece reviews in-depth con experiencia
- Penaliza thin affiliate reviews
- Rewards E-E-A-T en reviews

**4. Helpful Content Updates**
- Evalúa si contenido es "people-first"
- Penaliza contenido creado solo para rankings
- Site-wide classifier signal
- Recovery puede tomar meses

**5. Page Experience Updates**
- Core Web Vitals
- Mobile usability
- Safe browsing
- HTTPS
- Intrusive interstitials

**Playbook de Respuesta:**

**Fase 1: Detection (Día 1-2)**
1. Verificar si hay update oficial anunciado
2. Revisar rankings de keywords críticas
3. Analizar cambios en tráfico orgánico
4. Comparar con competidores (subieron/bajaron?)
5. Identificar páginas más afectadas
6. Documentar magnitud del impacto

**Fase 2: Analysis (Día 3-7)**
1. Categorizar páginas afectadas (ganaron/perdieron)
2. Identificar patterns (tipo de contenido, keywords, etc.)
3. Analizar páginas de competidores que ganaron
4. Revisar comunicaciones oficiales de Google
5. Consultar community (Twitter, Reddit, foros)
6. Formular hipótesis del cambio

**Fase 3: Action Plan (Semana 2)**
1. Priorizar páginas críticas afectadas
2. Identificar quick fixes vs mejoras profundas
3. Crear roadmap de recuperación
4. Asignar recursos y responsables
5. Establecer timeline realista
6. Definir métricas de éxito

**Fase 4: Implementation (Semanas 3-8)**
1. Ejecutar mejoras priorizadas
2. Documentar cambios implementados
3. Monitorear impacto de cambios
4. Ajustar strategy basado en resultados
5. Comunicar progreso a stakeholders

**Fase 5: Recovery Monitoring (Meses 2-6)**
1. Tracking continuo de rankings y tráfico
2. Evaluar efectividad de cambios
3. Identificar lecciones aprendidas
4. Actualizar best practices
5. Preparar para próximo update

**Common Recovery Strategies:**

**Para Content Quality Issues:**
- Enriquecer contenido thin con información valiosa
- Añadir experiencia y expertise demostrable
- Mejorar E-E-A-T signals
- Consolidar contenido duplicado/similar
- Actualizar contenido obsoleto
- Añadir multimedia y engagement elements

**Para Technical Issues:**
- Mejorar Core Web Vitals
- Optimizar mobile experience
- Corregir errores de indexación
- Resolver problemas de estructura
- Mejorar velocidad de carga

**Para Link/Spam Issues:**
- Disavow links spam
- Remove/nofollow links problemáticos
- Limpieza de anchor text over-optimization
- Enfocarse en link quality vs quantity

**Dashboard de Monitoreo Continuo:**

```
Metrics Diarias:
- Visibility index
- Rankings keywords top 20
- Tráfico orgánico
- Impresiones/CTR promedio

Metrics Semanales:
- Share of voice por categoría
- Nuevas keywords posicionando
- Keywords perdidas
- Backlinks nuevos/perdidos

Metrics Mensuales:
- E-E-A-T score assessment
- Technical health score
- Content quality audit
- Competitor benchmarking
```

**Documentation y Learning:**
- Mantener log de todos los updates y su impacto
- Documentar recovery strategies que funcionaron
- Crear knowledge base interna
- Entrenar equipo en adaptación rápida
- Establecer processes para futuros updates

- Explicación: los algoritmos de Google evolucionan constantemente, requiriendo monitoreo continuo y capacidad de adaptación rápida para mantener o recuperar rankings tras updates.
- Análisis: establecer baseline metrics antes de updates; implementar alertas automáticas para cambios significativos; analizar patterns de impacto histórico; identificar vulnerabilidades del sitio ante diferentes tipos de updates; benchmarkar resilience vs competidores.
- Solución: implementar comprehensive monitoring system; crear playbook documentado de response; establecer equipo de response; configurar alertas automáticas; mantener comunicación proactiva con stakeholders; desarrollar capacidad de análisis rápido; construir resilience a través de diversificación de traffic sources.
- Prioridad: A como actividad crítica de maintenance continuo.
- Definición de Hecho: sistema de monitoreo automatizado implementado, playbook de response documentado y tested, equipo entrenado en response protocols, time-to-response <24hrs para updates mayores.

## Sección 10 — Módulos Específicos por Sector (páginas 141–150)

Esta sección proporciona guidance específico para diferentes tipos de negocios. Implementar los módulos relevantes según el sector del cliente.

### Página 141 — E-commerce SEO

**[Contenido específico para e-commerce incluyendo: product page optimization, category structure, faceted navigation, duplicate content management, schema para productos, user-generated content, seasonal optimization, etc.]**

### Página 142 — SaaS/B2B SEO

**[Contenido específico para SaaS incluyendo: product-led content, integration pages, comparison pages, ROI calculators, free tools, feature pages, use case content, etc.]**

### Página 143 — News/Media SEO

**[Contenido específico para news incluyendo: freshness signals, NewsArticle schema, Google News optimization, AMP, author authority, fact-checking, etc.]**

### Página 144 — Healthcare/YMYL SEO

**[Contenido específico para healthcare incluyendo: medical review process, credentials verification, YMYL considerations, medical disclaimers, E-E-A-T critical, etc.]**

### Página 145 — Real Estate SEO

**[Contenido específico para real estate incluyendo: property listings, location pages, schema para propiedades, virtual tours, IDX integration, etc.]**

---

## Referencias credenciales/entorno

- `GA4_PROPERTY_ID`, `GSC_SITE_URL`, `AHREFS_TOKEN`, `SEMRUSH_TOKEN`, `SISTRIX_TOKEN`
- `YOUTUBE_CHANNEL_ID` (si aplica video SEO)
- `GOOGLE_BUSINESS_PROFILE_ID` (si aplica local SEO)
- Mantener tokens en entorno seguro; no incluir credenciales en CSV

## Validación y control de calidad

- Confirmar que los módulos manuales incluyen evidencias claras y accionables
- Si se usan CSVs de apoyo, ubicarlos en `WEB_AUDITORIA/data/` y documentar encabezados
- Mantener consistencia de nomenclatura y filtros con las secciones anteriores
- Validar implementation de schema markup con herramientas oficiales
- Testear en múltiples dispositivos y browsers
- Documentar todas las optimizaciones y cambios realizados

## Notas Finales

Este documento extendido proporciona una metodología completa y actualizada para auditorías SEO en 2025, incluyendo tanto fundamentos técnicos como las tendencias más recientes en search. La implementación debe adaptarse al tipo específico de negocio, recursos disponibles y objetivos prioritarios del cliente.
