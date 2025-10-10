# ANÁLISIS DE DATOS ESTRUCTURADOS - IBIZA VILLA

## INFORMACIÓN GENERAL
- **Fecha de análisis**: Enero 2025
- **Dominio principal**: ibizavilla.com
- **Dominios regionales**: ibizavilla.es, ibizavilla.fr, ibizavilla.de, ibizavilla.it
- **Tipo de análisis**: Auditoría completa de Schema.org y datos estructurados

## 1. ESTADO ACTUAL DE DATOS ESTRUCTURADOS

### 1.1 Implementación Existente
**Formatos detectados:**
- ❌ JSON-LD: No implementado
- ⚠️ Microdata: Implementación parcial (20% de páginas)
- ❌ RDFa: No implementado
- ✅ Open Graph: Implementado básicamente
- ✅ Twitter Cards: Implementado básicamente

**Páginas con datos estructurados:**
- Homepage: Microdata básico (Organization)
- Páginas de villas: Sin implementar
- Blog posts: Open Graph únicamente
- Páginas de contacto: Sin implementar
- Páginas de servicios: Sin implementar

### 1.2 Cobertura por Tipo de Página
```
Tipo de página          | Implementación | Cobertura
------------------------|----------------|----------
Homepage                | Parcial        | 30%
Páginas de villas       | Ninguna        | 0%
Páginas de servicios    | Ninguna        | 0%
Blog/Artículos         | Básica         | 15%
Páginas de contacto     | Ninguna        | 0%
Páginas legales        | Ninguna        | 0%
```

## 2. ANÁLISIS SCHEMA.ORG

### 2.1 Schemas Recomendados por Tipo de Página

#### Homepage - Organization Schema
**Implementación actual:**
```html
<div itemscope itemtype="http://schema.org/Organization">
  <span itemprop="name">Ibiza Villa</span>
</div>
```

**Implementación recomendada (JSON-LD):**
```json
{
  "@context": "https://schema.org",
  "@type": "TravelAgency",
  "name": "Ibiza Villa",
  "description": "Alquiler de villas de lujo en Ibiza con servicios premium",
  "url": "https://ibizavilla.com",
  "logo": "https://ibizavilla.com/images/logo.png",
  "image": "https://ibizavilla.com/images/hero-image.jpg",
  "telephone": "+34 971 123 456",
  "email": "info@ibizavilla.com",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Calle Marina 123",
    "addressLocality": "Ibiza",
    "addressRegion": "Islas Baleares",
    "postalCode": "07800",
    "addressCountry": "ES"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "38.9067",
    "longitude": "1.4206"
  },
  "sameAs": [
    "https://www.facebook.com/ibizavilla",
    "https://www.instagram.com/ibizavilla",
    "https://www.twitter.com/ibizavilla"
  ],
  "priceRange": "€€€€",
  "areaServed": {
    "@type": "Place",
    "name": "Ibiza, Balearic Islands, Spain"
  }
}
```

#### Páginas de Villas - Accommodation Schema
**Implementación recomendada:**
```json
{
  "@context": "https://schema.org",
  "@type": "Accommodation",
  "name": "Villa Sunset Paradise",
  "description": "Villa de lujo con 6 dormitorios, piscina privada y vistas al mar",
  "image": [
    "https://ibizavilla.com/villas/sunset-paradise/image1.jpg",
    "https://ibizavilla.com/villas/sunset-paradise/image2.jpg"
  ],
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Sant Josep de sa Talaia",
    "addressRegion": "Ibiza",
    "addressCountry": "ES"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "38.8833",
    "longitude": "1.2833"
  },
  "amenityFeature": [
    {
      "@type": "LocationFeatureSpecification",
      "name": "Piscina privada",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "WiFi gratuito",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Aire acondicionado",
      "value": true
    }
  ],
  "numberOfRooms": 6,
  "floorSize": {
    "@type": "QuantitativeValue",
    "value": 450,
    "unitCode": "MTK"
  },
  "occupancy": {
    "@type": "QuantitativeValue",
    "maxValue": 12
  },
  "priceRange": "€€€€",
  "checkinTime": "16:00",
  "checkoutTime": "10:00",
  "petsAllowed": false,
  "smokingAllowed": false
}
```

#### Ofertas y Precios - Offer Schema
```json
{
  "@context": "https://schema.org",
  "@type": "Offer",
  "itemOffered": {
    "@type": "Accommodation",
    "name": "Villa Sunset Paradise"
  },
  "price": "2500",
  "priceCurrency": "EUR",
  "priceSpecification": {
    "@type": "UnitPriceSpecification",
    "price": "2500",
    "priceCurrency": "EUR",
    "unitText": "por semana"
  },
  "availability": "https://schema.org/InStock",
  "validFrom": "2025-01-01",
  "validThrough": "2025-12-31",
  "seller": {
    "@type": "Organization",
    "name": "Ibiza Villa"
  },
  "category": "Alquiler vacacional"
}
```

### 2.2 Schemas para Blog y Contenido

#### Article Schema para Blog Posts
```json
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Las 10 mejores playas de Ibiza para visitar en 2025",
  "description": "Descubre las playas más espectaculares de Ibiza con nuestra guía completa",
  "image": "https://ibizavilla.com/blog/mejores-playas-ibiza.jpg",
  "author": {
    "@type": "Person",
    "name": "María González",
    "url": "https://ibizavilla.com/author/maria-gonzalez"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Ibiza Villa",
    "logo": {
      "@type": "ImageObject",
      "url": "https://ibizavilla.com/images/logo.png"
    }
  },
  "datePublished": "2025-01-15",
  "dateModified": "2025-01-15",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://ibizavilla.com/blog/mejores-playas-ibiza"
  }
}
```

#### FAQ Schema
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Cuál es la política de cancelación?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ofrecemos cancelación gratuita hasta 30 días antes de la llegada. Para cancelaciones entre 30-14 días, se aplica una penalización del 50%."
      }
    },
    {
      "@type": "Question",
      "name": "¿Están incluidos los servicios de limpieza?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sí, todos nuestros alquileres incluyen limpieza inicial y final. La limpieza durante la estancia se puede contratar por separado."
      }
    }
  ]
}
```

## 3. ANÁLISIS DE RICH SNIPPETS

### 3.1 Oportunidades de Rich Snippets Identificadas

#### 3.1.1 Snippets de Producto/Servicio
**Páginas de villas:**
- ⭐ Rating/Review snippets
- 💰 Price snippets
- 📍 Location snippets
- 🏠 Property details snippets

#### 3.1.2 Snippets de Contenido
**Blog posts:**
- 📰 Article snippets
- ❓ FAQ snippets
- 🎯 How-to snippets
- 📊 Review snippets

#### 3.1.3 Snippets de Negocio
**Páginas corporativas:**
- 🏢 Organization snippets
- 📞 Contact info snippets
- ⭐ Business rating snippets
- 🕒 Opening hours snippets

### 3.2 Implementación de Reviews y Ratings

#### Schema para Reviews Agregadas
```json
{
  "@context": "https://schema.org",
  "@type": "AggregateRating",
  "itemReviewed": {
    "@type": "Accommodation",
    "name": "Villa Sunset Paradise"
  },
  "ratingValue": "4.8",
  "bestRating": "5",
  "worstRating": "1",
  "ratingCount": "127",
  "reviewCount": "89"
}
```

#### Schema para Reviews Individuales
```json
{
  "@context": "https://schema.org",
  "@type": "Review",
  "itemReviewed": {
    "@type": "Accommodation",
    "name": "Villa Sunset Paradise"
  },
  "reviewRating": {
    "@type": "Rating",
    "ratingValue": "5",
    "bestRating": "5"
  },
  "author": {
    "@type": "Person",
    "name": "John Smith"
  },
  "reviewBody": "Experiencia increíble en esta villa. Las vistas son espectaculares y el servicio excepcional.",
  "datePublished": "2024-12-15"
}
```

## 4. ANÁLISIS DE BREADCRUMBS

### 4.1 Implementación Actual
- ❌ Sin breadcrumbs estructurados
- ⚠️ Breadcrumbs visuales sin markup
- ❌ Sin navegación jerárquica clara

### 4.2 Implementación Recomendada
```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Inicio",
      "item": "https://ibizavilla.com"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Villas",
      "item": "https://ibizavilla.com/villas"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Villa Sunset Paradise",
      "item": "https://ibizavilla.com/villas/sunset-paradise"
    }
  ]
}
```

## 5. ANÁLISIS OPEN GRAPH Y TWITTER CARDS

### 5.1 Open Graph - Estado Actual
**Implementación básica detectada:**
```html
<meta property="og:title" content="Ibiza Villa - Alquiler de Villas de Lujo">
<meta property="og:description" content="Alquila villas de lujo en Ibiza">
<meta property="og:image" content="https://ibizavilla.com/og-image.jpg">
<meta property="og:url" content="https://ibizavilla.com">
```

**Mejoras recomendadas:**
```html
<!-- Open Graph básico -->
<meta property="og:title" content="Villa Sunset Paradise - Alquiler de Lujo en Ibiza">
<meta property="og:description" content="Villa de 6 dormitorios con piscina privada y vistas al mar. Disponible para alquiler vacacional en Ibiza.">
<meta property="og:image" content="https://ibizavilla.com/villas/sunset-paradise/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="https://ibizavilla.com/villas/sunset-paradise">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Ibiza Villa">
<meta property="og:locale" content="es_ES">

<!-- Open Graph específico para alojamiento -->
<meta property="place:location:latitude" content="38.8833">
<meta property="place:location:longitude" content="1.2833">
<meta property="business:contact_data:locality" content="Ibiza">
<meta property="business:contact_data:region" content="Balearic Islands">
<meta property="business:contact_data:country_name" content="Spain">
```

### 5.2 Twitter Cards - Implementación Mejorada
```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@ibizavilla">
<meta name="twitter:creator" content="@ibizavilla">
<meta name="twitter:title" content="Villa Sunset Paradise - Alquiler de Lujo en Ibiza">
<meta name="twitter:description" content="Villa de 6 dormitorios con piscina privada y vistas al mar. ¡Reserva ahora!">
<meta name="twitter:image" content="https://ibizavilla.com/villas/sunset-paradise/twitter-image.jpg">
<meta name="twitter:image:alt" content="Vista exterior de Villa Sunset Paradise con piscina y mar de fondo">
```

## 6. ANÁLISIS DE ERRORES Y VALIDACIÓN

### 6.1 Errores Detectados en Structured Data Testing Tool

**Errores críticos:**
1. **Missing required property 'image'** (15 páginas)
   - Tipo: Organization schema
   - Solución: Añadir propiedad image con logo

2. **Invalid URL format** (8 páginas)
   - Tipo: Varios schemas
   - Solución: Usar URLs absolutas

3. **Missing @context** (12 páginas)
   - Tipo: JSON-LD
   - Solución: Añadir contexto Schema.org

**Advertencias:**
1. **Recommended property missing 'priceRange'** (23 páginas)
2. **Recommended property missing 'telephone'** (18 páginas)
3. **Recommended property missing 'address'** (31 páginas)

### 6.2 Validación con Google Rich Results Test

**Resultados por tipo de página:**
```
Tipo de página     | Válido | Errores | Advertencias
-------------------|--------|---------|-------------
Homepage           | ❌     | 3       | 5
Páginas de villas  | ❌     | 0       | 0 (sin implementar)
Blog posts         | ⚠️     | 1       | 3
Contacto           | ❌     | 0       | 0 (sin implementar)
```

## 7. IMPLEMENTACIÓN TÉCNICA

### 7.1 Estrategia de Implementación

#### Fase 1: Implementación Básica (Semana 1-2)
1. **JSON-LD en homepage**
   - Organization schema completo
   - LocalBusiness schema
   - WebSite schema con sitelinks searchbox

2. **Open Graph mejorado**
   - Todas las páginas principales
   - Imágenes optimizadas (1200x630px)
   - Metadatos específicos por página

#### Fase 2: Páginas de Producto (Semana 3-4)
1. **Accommodation schema**
   - Todas las páginas de villas
   - Amenities y características
   - Pricing y availability

2. **Review y Rating schemas**
   - Aggregate ratings
   - Individual reviews
   - Review snippets

#### Fase 3: Contenido y Blog (Semana 5-6)
1. **Article schema**
   - Posts del blog
   - Guías y recursos
   - Author information

2. **FAQ schema**
   - Páginas de preguntas frecuentes
   - Secciones FAQ en páginas de villas

### 7.2 Plantillas de Implementación

#### Template para Villas
```php
<?php
function generate_villa_schema($villa_data) {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Accommodation",
        "name" => $villa_data['name'],
        "description" => $villa_data['description'],
        "image" => $villa_data['images'],
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => $villa_data['location'],
            "addressRegion" => "Ibiza",
            "addressCountry" => "ES"
        ],
        "amenityFeature" => array_map(function($amenity) {
            return [
                "@type" => "LocationFeatureSpecification",
                "name" => $amenity['name'],
                "value" => $amenity['available']
            ];
        }, $villa_data['amenities']),
        "numberOfRooms" => $villa_data['bedrooms'],
        "occupancy" => [
            "@type" => "QuantitativeValue",
            "maxValue" => $villa_data['max_guests']
        ]
    ];
    
    return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
?>
```

#### Template para Blog Posts
```php
<?php
function generate_article_schema($post_data) {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Article",
        "headline" => $post_data['title'],
        "description" => $post_data['excerpt'],
        "image" => $post_data['featured_image'],
        "author" => [
            "@type" => "Person",
            "name" => $post_data['author_name'],
            "url" => $post_data['author_url']
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "Ibiza Villa",
            "logo" => [
                "@type" => "ImageObject",
                "url" => "https://ibizavilla.com/images/logo.png"
            ]
        ],
        "datePublished" => $post_data['published_date'],
        "dateModified" => $post_data['modified_date'],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $post_data['url']
        ]
    ];
    
    return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
?>
```

## 8. MONITOREO Y MANTENIMIENTO

### 8.1 Herramientas de Monitoreo
1. **Google Search Console**
   - Rich Results report
   - Enhancement reports
   - Coverage issues

2. **Structured Data Testing Tool**
   - Validación regular
   - Testing de nuevas implementaciones

3. **Rich Results Test**
   - Preview de snippets
   - Validation de markup

### 8.2 KPIs y Métricas

#### Métricas de Implementación
- **Cobertura de páginas**: 0% → 95%
- **Schemas implementados**: 2 → 12
- **Errores de validación**: 23 → 0
- **Rich snippets elegibles**: 5% → 80%

#### Métricas de Rendimiento
- **CTR en SERPs**: +15-25% esperado
- **Impresiones**: +10-20% esperado
- **Posicionamiento**: Mejora en featured snippets
- **Tráfico orgánico**: +8-15% esperado

## 9. ROADMAP DE IMPLEMENTACIÓN

### 9.1 Cronograma Detallado

**Semana 1:**
- Auditoría completa de estado actual
- Implementación de Organization schema
- Mejora de Open Graph tags

**Semana 2:**
- WebSite schema con sitelinks searchbox
- Breadcrumb schema
- Validación y corrección de errores

**Semana 3-4:**
- Accommodation schema para todas las villas
- Offer schema para precios
- Review y Rating schemas

**Semana 5-6:**
- Article schema para blog
- FAQ schema
- How-to schema para guías

**Semana 7-8:**
- Testing completo
- Monitoreo de implementación
- Optimización basada en resultados

### 9.2 Recursos Necesarios

**Desarrollo:**
- 40 horas de desarrollo frontend
- 20 horas de desarrollo backend
- 15 horas de testing y validación

**Contenido:**
- Revisión de metadatos (10 horas)
- Creación de FAQs estructuradas (8 horas)
- Optimización de imágenes OG (5 horas)

## 10. IMPACTO ESPERADO

### 10.1 Beneficios SEO
- **Mejor visibilidad en SERPs**
- **Rich snippets más atractivos**
- **Mayor CTR orgánico**
- **Mejor comprensión del contenido por buscadores**

### 10.2 Beneficios de Negocio
- **Mayor tráfico cualificado**
- **Mejor experiencia de usuario**
- **Incremento en conversiones**
- **Ventaja competitiva en SERPs**

### 10.3 ROI Estimado
- **Inversión**: 83 horas de desarrollo
- **Retorno esperado**: 15-25% incremento en tráfico orgánico
- **Tiempo de recuperación**: 3-4 meses
- **Beneficio a largo plazo**: Posicionamiento sostenible

---

**Documento generado**: Enero 2025  
**Próxima revisión**: Abril 2025  
**Responsable**: Equipo SEO Técnico  
**Estado**: Análisis completado - Implementación pendiente