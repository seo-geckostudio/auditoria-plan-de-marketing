# ANEXO C: TEMPLATES Y HERRAMIENTAS
## AUDITORÍA SEO IBIZA VILLA - PLANTILLAS DE IMPLEMENTACIÓN

**Referencia:** Documento Maestro Ejecutivo  
**Fecha:** Noviembre 2025  
**Versión:** 1.0 Final  

---

## 📋 ÍNDICE DE TEMPLATES Y HERRAMIENTAS

### TEMPLATES DE METADATOS
- 📄 **template_meta_titles.html** - Plantillas títulos optimizados
- 📄 **template_meta_descriptions.html** - Plantillas meta descriptions
- 📄 **template_canonical_tags.html** - Tags canonical correctos
- 📄 **template_hreflang.html** - Implementación hreflang internacional
- 📄 **template_open_graph.html** - Meta tags Open Graph
- 📄 **template_twitter_cards.html** - Twitter Cards optimization

### SCHEMA MARKUP JSON-LD
- 📄 **schema_organization.json** - Schema Organization
- 📄 **schema_product.json** - Schema Product (villas)
- 📄 **schema_review.json** - Schema Review y ratings
- 📄 **schema_faq.json** - Schema FAQ pages
- 📄 **schema_breadcrumb.json** - Schema Breadcrumb
- 📄 **schema_local_business.json** - Schema Local Business
- 📄 **schema_real_estate.json** - Schema Real Estate específico

### CONFIGURACIONES TÉCNICAS
- 📄 **robots_txt_optimized.txt** - Robots.txt optimizado
- 📄 **htaccess_seo.txt** - .htaccess con optimizaciones SEO
- 📄 **sitemap_xml_template.xml** - Template sitemap XML
- 📄 **security_headers.txt** - Headers de seguridad
- 📄 **pwa_manifest.json** - Web App Manifest PWA
- 📄 **service_worker.js** - Service Worker PWA

### HERRAMIENTAS DE DESARROLLO
- 📄 **seo_audit_checklist.xlsx** - Checklist auditoría SEO
- 📄 **keyword_mapping_template.xlsx** - Template keyword mapping
- 📄 **content_optimization_guide.pdf** - Guía optimización contenido
- 📄 **technical_seo_checklist.pdf** - Checklist SEO técnico

---

## 🎯 TEMPLATES DE METADATOS

### TÍTULOS OPTIMIZADOS (template_meta_titles.html)

```html
<!-- PÁGINA PRINCIPAL -->
<title>Alquiler Villas de Lujo Ibiza | +25 Años Experiencia | Ibiza Villa</title>

<!-- PÁGINAS DE CATEGORÍA -->
<title>Villas {CATEGORIA} Ibiza | Alquiler Lujo | Ibiza Villa</title>
<!-- Ejemplo: Villas con Piscina Ibiza | Alquiler Lujo | Ibiza Villa -->

<!-- PÁGINAS DE VILLA INDIVIDUAL -->
<title>{NOMBRE_VILLA} | Villa Lujo Ibiza | {UBICACION} | Ibiza Villa</title>
<!-- Ejemplo: Villa Sunset Paradise | Villa Lujo Ibiza | Es Vedra | Ibiza Villa -->

<!-- PÁGINAS DE UBICACIÓN -->
<title>Villas Alquiler {UBICACION} Ibiza | Lujo y Exclusividad | Ibiza Villa</title>
<!-- Ejemplo: Villas Alquiler Cala Jondal Ibiza | Lujo y Exclusividad | Ibiza Villa -->

<!-- PÁGINAS DE SERVICIOS -->
<title>{SERVICIO} Villas Ibiza | Experiencias Únicas | Ibiza Villa</title>
<!-- Ejemplo: Chef Privado Villas Ibiza | Experiencias Únicas | Ibiza Villa -->

<!-- BLOG POSTS -->
<title>{TITULO_POST} | Guía Ibiza | Blog Ibiza Villa</title>
<!-- Ejemplo: Mejores Playas Ibiza 2025 | Guía Ibiza | Blog Ibiza Villa -->
```

### META DESCRIPTIONS OPTIMIZADAS (template_meta_descriptions.html)

```html
<!-- PÁGINA PRINCIPAL -->
<meta name="description" content="✅ Alquiler villas de lujo en Ibiza. +25 años experiencia, +200 villas exclusivas, servicio 24/7. Reserva tu villa perfecta en Ibiza. ¡Consulta disponibilidad!">

<!-- PÁGINAS DE CATEGORÍA -->
<meta name="description" content="🏖️ Villas {CATEGORIA} Ibiza | {NUMERO} villas disponibles | Piscina privada, vistas al mar, servicio completo. Reserva tu villa de lujo en Ibiza.">

<!-- PÁGINAS DE VILLA INDIVIDUAL -->
<meta name="description" content="🌟 {NOMBRE_VILLA} - Villa lujo {UBICACION} Ibiza | {DORMITORIOS} dorm, {HUESPEDES} huéspedes | Piscina, vistas {VISTAS} | Desde €{PRECIO}/noche. ¡Reserva ya!">

<!-- PÁGINAS DE UBICACIÓN -->
<meta name="description" content="🏝️ Villas alquiler {UBICACION} Ibiza | Las mejores villas de lujo en {UBICACION} | Piscina privada, acceso playa, servicios VIP. Descubre tu villa perfecta.">

<!-- PÁGINAS DE SERVICIOS -->
<meta name="description" content="✨ {SERVICIO} para villas Ibiza | Experiencias exclusivas y personalizadas | +25 años creando momentos únicos. Solicita tu presupuesto personalizado.">
```

---

## 🔧 SCHEMA MARKUP JSON-LD

### SCHEMA ORGANIZATION (schema_organization.json)

```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Ibiza Villa",
  "legalName": "Ibiza 1998 S.L.",
  "url": "https://www.ibizavilla.com",
  "logo": "https://www.ibizavilla.com/images/logo-ibiza-villa.png",
  "description": "Líder en alquiler de villas de lujo en Ibiza con más de 25 años de experiencia. Ofrecemos las mejores villas exclusivas con servicios personalizados.",
  "foundingDate": "1998",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Carrer de la Marina, 15",
    "addressLocality": "Ibiza",
    "addressRegion": "Islas Baleares",
    "postalCode": "07800",
    "addressCountry": "ES"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+34-971-123-456",
    "contactType": "customer service",
    "availableLanguage": ["Spanish", "English", "German", "French", "Italian"]
  },
  "sameAs": [
    "https://www.facebook.com/ibizavilla",
    "https://www.instagram.com/ibizavilla",
    "https://www.linkedin.com/company/ibizavilla"
  ]
}
```

### SCHEMA PRODUCT - VILLA (schema_product.json)

```json
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "{NOMBRE_VILLA}",
  "description": "{DESCRIPCION_VILLA}",
  "image": [
    "{URL_IMAGEN_1}",
    "{URL_IMAGEN_2}",
    "{URL_IMAGEN_3}"
  ],
  "brand": {
    "@type": "Brand",
    "name": "Ibiza Villa"
  },
  "category": "Villa Rental",
  "offers": {
    "@type": "Offer",
    "price": "{PRECIO_NOCHE}",
    "priceCurrency": "EUR",
    "priceValidUntil": "{FECHA_VALIDEZ}",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Ibiza Villa"
    }
  },
  "additionalProperty": [
    {
      "@type": "PropertyValue",
      "name": "Dormitorios",
      "value": "{NUMERO_DORMITORIOS}"
    },
    {
      "@type": "PropertyValue", 
      "name": "Huéspedes",
      "value": "{NUMERO_HUESPEDES}"
    },
    {
      "@type": "PropertyValue",
      "name": "Piscina",
      "value": "{SI/NO}"
    }
  ]
}
```

### SCHEMA FAQ (schema_faq.json)

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
        "text": "Ofrecemos cancelación gratuita hasta 30 días antes de la llegada. Para cancelaciones entre 15-30 días, se aplica un 50% del importe. Menos de 15 días, no hay reembolso."
      }
    },
    {
      "@type": "Question",
      "name": "¿Incluyen las villas servicios adicionales?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sí, todas nuestras villas incluyen limpieza, cambio de ropa de cama y toallas. Servicios adicionales como chef privado, transfer y actividades están disponibles bajo petición."
      }
    },
    {
      "@type": "Question",
      "name": "¿Cuándo puedo hacer el check-in?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "El check-in estándar es a las 16:00h y el check-out a las 10:00h. Horarios flexibles disponibles según disponibilidad y con suplemento."
      }
    }
  ]
}
```

---

## ⚙️ CONFIGURACIONES TÉCNICAS

### ROBOTS.TXT OPTIMIZADO (robots_txt_optimized.txt)

```txt
User-agent: *
Allow: /

# Bloquear archivos y directorios no necesarios
Disallow: /admin/
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /wp-content/plugins/
Disallow: /wp-content/themes/
Disallow: /search/
Disallow: /*?s=
Disallow: /*?p=
Disallow: /tag/
Disallow: /author/

# Permitir crawling de recursos importantes
Allow: /wp-content/uploads/
Allow: /wp-content/themes/*/css/
Allow: /wp-content/themes/*/js/
Allow: /wp-content/themes/*/images/

# Sitemaps
Sitemap: https://www.ibizavilla.com/sitemap.xml
Sitemap: https://www.ibizavilla.com/sitemap-images.xml
Sitemap: https://www.ibizavilla.com/sitemap-news.xml

# Crawl-delay para bots específicos
User-agent: Bingbot
Crawl-delay: 1

User-agent: Slurp
Crawl-delay: 1
```

### HEADERS DE SEGURIDAD (security_headers.txt)

```apache
# Headers de Seguridad Críticos
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"
Header always set Permissions-Policy "geolocation=(), microphone=(), camera=()"

# Content Security Policy
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.google.com *.googleapis.com; style-src 'self' 'unsafe-inline' *.googleapis.com; img-src 'self' data: *.google.com *.googleapis.com; font-src 'self' *.googleapis.com *.gstatic.com;"

# HSTS (HTTP Strict Transport Security)
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"

# Feature Policy
Header always set Feature-Policy "geolocation 'none'; microphone 'none'; camera 'none'"
```

### HREFLANG INTERNACIONAL (template_hreflang.html)

```html
<!-- Implementación Hreflang para SEO Internacional -->
<link rel="alternate" hreflang="es" href="https://www.ibizavilla.com/" />
<link rel="alternate" hreflang="en" href="https://www.ibizavilla.com/en/" />
<link rel="alternate" hreflang="de" href="https://www.ibizavilla.com/de/" />
<link rel="alternate" hreflang="fr" href="https://www.ibizavilla.com/fr/" />
<link rel="alternate" hreflang="it" href="https://www.ibizavilla.com/it/" />
<link rel="alternate" hreflang="nl" href="https://www.ibizavilla.com/nl/" />
<link rel="alternate" hreflang="x-default" href="https://www.ibizavilla.com/" />

<!-- Para páginas específicas -->
<link rel="alternate" hreflang="es" href="https://www.ibizavilla.com/villas/{villa-name}" />
<link rel="alternate" hreflang="en" href="https://www.ibizavilla.com/en/villas/{villa-name}" />
<link rel="alternate" hreflang="de" href="https://www.ibizavilla.com/de/villas/{villa-name}" />
<link rel="alternate" hreflang="fr" href="https://www.ibizavilla.com/fr/villas/{villa-name}" />
<link rel="alternate" hreflang="it" href="https://www.ibizavilla.com/it/villas/{villa-name}" />
<link rel="alternate" hreflang="nl" href="https://www.ibizavilla.com/nl/villas/{villa-name}" />
```

---

## 🛠️ HERRAMIENTAS DE DESARROLLO

### PWA MANIFEST (pwa_manifest.json)

```json
{
  "name": "Ibiza Villa - Alquiler Villas Lujo",
  "short_name": "Ibiza Villa",
  "description": "Alquiler de villas de lujo en Ibiza. Más de 25 años de experiencia.",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#0066cc",
  "orientation": "portrait-primary",
  "icons": [
    {
      "src": "/images/icons/icon-72x72.png",
      "sizes": "72x72",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-96x96.png", 
      "sizes": "96x96",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-128x128.png",
      "sizes": "128x128", 
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-144x144.png",
      "sizes": "144x144",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-384x384.png",
      "sizes": "384x384",
      "type": "image/png"
    },
    {
      "src": "/images/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ]
}
```

### SERVICE WORKER BÁSICO (service_worker.js)

```javascript
const CACHE_NAME = 'ibiza-villa-v1';
const urlsToCache = [
  '/',
  '/css/main.css',
  '/js/main.js',
  '/images/logo-ibiza-villa.png',
  '/offline.html'
];

// Instalación del Service Worker
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        return cache.addAll(urlsToCache);
      })
  );
});

// Interceptar requests
self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Devolver desde cache si existe
        if (response) {
          return response;
        }
        return fetch(event.request);
      }
    )
  );
});

// Actualización del Service Worker
self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
```

---

## 📊 CHECKLIST DE IMPLEMENTACIÓN

### METADATOS Y SEO BÁSICO ✅
- [x] Templates títulos optimizados
- [x] Templates meta descriptions
- [x] Canonical tags implementation
- [x] Open Graph meta tags
- [x] Twitter Cards optimization

### SCHEMA MARKUP ✅
- [x] Organization schema
- [x] Product schema (villas)
- [x] Review schema
- [x] FAQ schema
- [x] Breadcrumb schema
- [x] Local Business schema

### CONFIGURACIONES TÉCNICAS ✅
- [x] Robots.txt optimizado
- [x] Headers de seguridad
- [x] Hreflang internacional
- [x] PWA manifest
- [x] Service Worker básico

### HERRAMIENTAS DE DESARROLLO ✅
- [x] Checklist auditoría SEO
- [x] Template keyword mapping
- [x] Guía optimización contenido
- [x] Checklist SEO técnico

---

## 🎯 INSTRUCCIONES DE USO

### IMPLEMENTACIÓN METADATOS
1. **Copiar templates** en el CMS/tema activo
2. **Personalizar variables** según cada página
3. **Validar implementación** con herramientas SEO
4. **Monitorear resultados** en GSC

### SCHEMA MARKUP
1. **Insertar JSON-LD** en `<head>` de páginas
2. **Personalizar datos** según contenido específico
3. **Validar con Google Rich Results Test**
4. **Monitorear rich snippets** en SERPs

### CONFIGURACIONES TÉCNICAS
1. **Implementar en servidor** (Apache/Nginx)
2. **Validar headers** con herramientas seguridad
3. **Testear funcionalidad** en diferentes dispositivos
4. **Monitorear performance** post-implementación

---

## 📞 SOPORTE TÉCNICO

**Consultor SEO:** Miguel Angel Jiménez  
**Proyecto:** Auditoría SEO Ibiza Villa  
**Fecha:** Noviembre 2025  
**Versión:** 1.0 Final  

---

*Este anexo proporciona todas las plantillas y herramientas necesarias para implementar las recomendaciones de la auditoría SEO de manera eficiente y efectiva.*