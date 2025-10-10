# CONFIGURACIÓN TRACKING - IBIZA VILLA

## INFORMACIÓN DEL PROYECTO
- **Cliente:** Ibiza Villa (Ibiza 1998 S.L.)
- **Sitio web:** https://www.ibizavilla.com/
- **Fecha análisis:** 01/10/2025
- **Modalidad:** Premium Estratégico

---

## ESTADO ACTUAL TRACKING

### Google Analytics 4 (Verificado)
**Configuración actual:**
- **Property ID:** G-XXXXXXXXXX (confirmado acceso)
- **Data stream:** Web (ibizavilla.com)
- **Conexión GSC:** Activa y funcionando
- **Enhanced ecommerce:** No configurado
- **Custom events:** Configuración básica únicamente

**Limitations detectadas:**
- No tracking events conversión específicos
- Ausencia goals lead generation
- Missing tracking interactions villa específicas
- No attribution modeling configurado

### Google Search Console (Verificado)
**Configuración actual:**
- **Property:** https://ibizavilla.com (propiedad verificada)
- **Verification method:** HTML file upload
- **Data available:** Desde enero 2023
- **Sitemaps submitted:** 1 sitemap básico

**Data gaps identificados:**
- Sitemap no actualizado arquitectura nueva
- Missing performance data páginas nuevas
- No indexing status monitoring
- Limited click/impression data segmentation

### Tag Manager Status
**Current status:** No implementado
**Recommendation:** Implementación crítica para tracking avanzado

---

## TRACKING STRATEGY NUEVA ARQUITECTURA

### Enhanced Analytics 4 Setup

#### Event Tracking Configuration

**Villa Interest Events:**
```javascript
// Villa Page View
gtag('event', 'villa_view', {
  'villa_name': 'Milano Santa Eulalia',
  'villa_zone': 'Santa Eulalia',
  'villa_capacity': 8,
  'villa_type': 'Luxury',
  'page_location': window.location.href
});

// Villa Gallery Interaction
gtag('event', 'villa_gallery_engagement', {
  'villa_name': 'Milano Santa Eulalia',
  'interaction_type': 'image_view',
  'image_position': 3
});

// Availability Check
gtag('event', 'availability_check', {
  'villa_name': 'Milano Santa Eulalia',
  'check_in_date': '2025-07-15',
  'check_out_date': '2025-07-22',
  'guests': 8
});
```

**Conversion Events:**
```javascript
// Contact Form Submission
gtag('event', 'contact_form_submit', {
  'form_type': 'villa_inquiry',
  'villa_name': 'Milano Santa Eulalia',
  'inquiry_type': 'booking_request'
});

// Phone Click
gtag('event', 'phone_click', {
  'phone_number': '+34XXXXXXXXX',
  'page_type': 'villa_page',
  'villa_name': 'Milano Santa Eulalia'
});

// Email Click
gtag('event', 'email_click', {
  'email_address': 'consultas@ibizavilla.com',
  'page_type': 'contact_page'
});
```

**User Journey Events:**
```javascript
// Zone Navigation
gtag('event', 'zone_navigation', {
  'zone_selected': 'Santa Eulalia',
  'previous_page': document.referrer
});

// Villa Comparison
gtag('event', 'villa_comparison', {
  'villas_compared': ['Milano', 'Paris', 'Sunset'],
  'comparison_duration': 120
});

// Filter Usage
gtag('event', 'filter_usage', {
  'filter_type': 'capacity',
  'filter_value': '8_persons',
  'results_shown': 5
});
```

#### Custom Dimensions Setup

**Villa-Specific Dimensions:**
- **Villa Name:** Custom dimension tracking villa específica viewed
- **Villa Zone:** Geographic area categorization
- **Villa Capacity:** Number of guests accommodation
- **Villa Type:** Luxury/Family/Group categorization
- **Booking Season:** High/Medium/Low season classification

**User Behavior Dimensions:**
- **User Type:** New visitor vs returning
- **Traffic Source:** Organic/Paid/Direct/Referral granular
- **Device Category:** Mobile/Desktop/Tablet
- **Geographic Location:** Country/Region visitor origin
- **Language Preference:** ES/EN/Other

#### Goals Configuration

**Macro Conversions:**
1. **Booking Request Submitted**
   - Event: contact_form_submit
   - Value: €50 (average inquiry value)
   - Attribution: Last-click

2. **Phone Call Initiated**
   - Event: phone_click
   - Value: €30 (phone inquiry value)
   - Attribution: First-touch

3. **Email Inquiry Sent**
   - Event: email_click
   - Value: €25 (email inquiry value)
   - Attribution: Linear

**Micro Conversions:**
1. **Villa Detail Page View**
   - Event: villa_view
   - Value: €5 (engagement value)

2. **Availability Check Performed**
   - Event: availability_check
   - Value: €15 (high-intent action)

3. **Multiple Villa Views Session**
   - Condition: villa_view count ≥ 3
   - Value: €10 (comparison behavior)

### Enhanced Ecommerce for Villa Rentals

#### Product Catalog Setup
```javascript
// Villa as Product
gtag('event', 'view_item', {
  'currency': 'EUR',
  'value': 2500,
  'items': [{
    'item_id': 'villa_milano_santa_eulalia',
    'item_name': 'Villa Milano Santa Eulalia',
    'item_category': 'Villa Luxury',
    'item_category2': 'Santa Eulalia',
    'item_variant': '8_persons',
    'price': 2500,
    'quantity': 1
  }]
});

// Add to Wishlist (Interest Expression)
gtag('event', 'add_to_wishlist', {
  'currency': 'EUR',
  'value': 2500,
  'items': [{
    'item_id': 'villa_milano_santa_eulalia',
    'item_name': 'Villa Milano Santa Eulalia',
    'price': 2500
  }]
});

// Begin Checkout (Booking Request)
gtag('event', 'begin_checkout', {
  'currency': 'EUR',
  'value': 17500, // Week rental
  'items': [{
    'item_id': 'villa_milano_santa_eulalia',
    'item_name': 'Villa Milano Santa Eulalia',
    'price': 2500,
    'quantity': 7 // nights
  }]
});
```

---

## GOOGLE TAG MANAGER IMPLEMENTATION

### Container Structure

**Workspace Organization:**
```
GTM Container: ibizavilla.com
├── Tags/
│   ├── GA4 Configuration Tag
│   ├── GA4 Villa View Event
│   ├── GA4 Conversion Events
│   ├── Meta Pixel Base Code
│   └── LinkedIn Insight Tag
│
├── Triggers/
│   ├── Page View Triggers
│   ├── Click Triggers (CTA, Phone, Email)
│   ├── Form Submission Triggers
│   ├── Scroll Depth Triggers
│   └── Timer Triggers (Engagement)
│
├── Variables/
│   ├── GA4 Configuration Variables
│   ├── Custom JavaScript Variables
│   ├── Data Layer Variables
│   └── URL/Page Variables
│
└── Built-in Variables/
    ├── Click Element, Click URL
    ├── Form Element, Form Classes
    ├── Page URL, Page Path
    └── Referrer
```

### Critical Tags Configuration

**GA4 Configuration Tag:**
```javascript
// Config Tag Settings
Google Analytics: GA4 Configuration
Measurement ID: G-XXXXXXXXXX

Custom Parameters:
- custom_map.villa_name: villa_name
- custom_map.villa_zone: villa_zone
- custom_map.user_type: user_type
- custom_map.booking_season: booking_season

Trigger: All Pages
```

**Villa View Event Tag:**
```javascript
// Villa Page Event
Google Analytics: GA4 Event
Event Name: villa_view

Event Parameters:
- villa_name: {{DLV - Villa Name}}
- villa_zone: {{DLV - Villa Zone}}
- villa_capacity: {{DLV - Villa Capacity}}
- villa_type: {{DLV - Villa Type}}
- page_title: {{Page Title}}

Trigger: Villa Page View
```

**Contact Form Event Tag:**
```javascript
// Form Submission Conversion
Google Analytics: GA4 Event
Event Name: contact_form_submit

Event Parameters:
- form_type: {{DLV - Form Type}}
- villa_name: {{DLV - Villa Name}}
- inquiry_type: booking_request
- form_location: {{Page Path}}

Trigger: Contact Form Submit
```

### Data Layer Implementation

**Homepage Data Layer:**
```javascript
window.dataLayer = window.dataLayer || [];
dataLayer.push({
  'event': 'page_view',
  'page_type': 'homepage',
  'user_type': 'new_visitor', // or 'returning_visitor'
  'content_group1': 'Commercial',
  'content_group2': 'Homepage'
});
```

**Villa Page Data Layer:**
```javascript
dataLayer.push({
  'event': 'villa_page_view',
  'page_type': 'villa_individual',
  'villa_name': 'Milano Santa Eulalia',
  'villa_zone': 'Santa Eulalia',
  'villa_capacity': 8,
  'villa_type': 'Luxury',
  'villa_price_night': 350,
  'content_group1': 'Villa Pages',
  'content_group2': 'Santa Eulalia'
});
```

**Category Page Data Layer:**
```javascript
dataLayer.push({
  'event': 'category_page_view',
  'page_type': 'zona_category',
  'category_name': 'Santa Eulalia',
  'category_type': 'zona',
  'villas_available': 6,
  'content_group1': 'Category Pages',
  'content_group2': 'Zona Pages'
});
```

---

## CONVERSION TRACKING SETUP

### Lead Scoring System

**Lead Quality Scoring:**
```javascript
// Lead Value Calculation
function calculateLeadValue(actions) {
  let score = 0;

  // Base actions
  if (actions.villa_view) score += 5;
  if (actions.availability_check) score += 15;
  if (actions.multiple_villas_viewed) score += 10;
  if (actions.filter_usage) score += 8;

  // High-intent actions
  if (actions.contact_form_submit) score += 50;
  if (actions.phone_click) score += 40;
  if (actions.email_click) score += 30;

  // Time-based scoring
  if (actions.session_duration > 300) score += 12; // 5+ minutes
  if (actions.pages_per_session > 5) score += 8;

  return score;
}

// Send Lead Score
gtag('event', 'lead_score_calculated', {
  'lead_score': calculateLeadValue(userActions),
  'lead_quality': score > 50 ? 'high' : score > 25 ? 'medium' : 'low'
});
```

### Attribution Modeling

**Custom Attribution Setup:**
```javascript
// First-Touch Attribution
gtag('event', 'attribution_first_touch', {
  'source': sessionStorage.getItem('first_source'),
  'medium': sessionStorage.getItem('first_medium'),
  'campaign': sessionStorage.getItem('first_campaign'),
  'conversion_value': 50
});

// Last-Touch Attribution
gtag('event', 'attribution_last_touch', {
  'source': 'organic',
  'medium': 'google_search',
  'keyword': document.referrer.includes('google') ? 'villa_ibiza' : 'direct',
  'conversion_value': 50
});
```

---

## HEATMAP AND USER BEHAVIOR TRACKING

### Hotjar Implementation

**Hotjar Tracking Code:**
```javascript
(function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:XXXXXXX,hjsv:6};
    a=o.getElementsByTagName('head')[0];
    r=o.createElement('script');r.async=1;
    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
    a.appendChild(r);
})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
```

**Hotjar Events Tracking:**
```javascript
// Villa Interest Event
hj('event', 'villa_interest', {
  'villa_name': 'Milano Santa Eulalia',
  'action': 'gallery_view'
});

// Booking Intent Event
hj('event', 'booking_intent', {
  'villa_name': 'Milano Santa Eulalia',
  'action': 'availability_check'
});

// Conversion Event
hj('event', 'conversion', {
  'type': 'contact_form',
  'villa_interest': 'Milano Santa Eulalia'
});
```

### User Session Recording Goals

**Priority Recording Scenarios:**
1. **Villa page sessions >3 minutes:** High engagement identification
2. **Contact form abandonment:** UX improvement opportunities
3. **Mobile navigation issues:** Mobile optimization insights
4. **Filter usage patterns:** Search functionality optimization

---

## SOCIAL MEDIA TRACKING

### Meta Pixel Configuration

**Base Pixel Code:**
```javascript
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', 'XXXXXXXXXXXXXX');
fbq('track', 'PageView');
```

**Custom Events Meta:**
```javascript
// Villa View Event
fbq('track', 'ViewContent', {
  content_name: 'Villa Milano Santa Eulalia',
  content_category: 'Villa Luxury',
  content_ids: ['villa_milano_santa_eulalia'],
  content_type: 'accommodation',
  value: 2500,
  currency: 'EUR'
});

// Lead Event
fbq('track', 'Lead', {
  content_name: 'Villa Booking Inquiry',
  content_category: 'Villa Rental',
  value: 50,
  currency: 'EUR'
});

// Custom Audience Building
fbq('track', 'Villa_Interest', {
  villa_zone: 'Santa Eulalia',
  villa_type: 'Luxury',
  user_intent: 'high'
});
```

### LinkedIn Insight Tag

**Implementation for B2B tracking:**
```javascript
_linkedin_partner_id = "XXXXXXX";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);

// LinkedIn Conversion Tracking
lintrk('track', { conversion_id: XXXXXXX });
```

---

## SEARCH CONSOLE OPTIMIZATION

### Enhanced Sitemap Strategy

**New Sitemap Structure:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <!-- Homepage -->
  <url>
    <loc>https://ibizavilla.com/</loc>
    <lastmod>2025-10-01</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

  <!-- Zona Category Pages -->
  <url>
    <loc>https://ibizavilla.com/zona/santa-eulalia/</loc>
    <lastmod>2025-10-01</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Villa Individual Pages -->
  <url>
    <loc>https://ibizavilla.com/villa/milano-santa-eulalia/</loc>
    <lastmod>2025-10-01</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>

  <!-- Blog Articles -->
  <url>
    <loc>https://ibizavilla.com/blog/mejores-zonas-villa-ibiza/</loc>
    <lastmod>2025-10-01</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>

</urlset>
```

### Performance Monitoring Setup

**Core Web Vitals Tracking:**
```javascript
// CLS Monitoring
new PerformanceObserver((entryList) => {
  for (const entry of entryList.getEntries()) {
    if (!entry.hadRecentInput) {
      gtag('event', 'cls_issue', {
        'cls_value': entry.value,
        'page_url': window.location.href,
        'element': entry.sources[0]?.node
      });
    }
  }
}).observe({type: 'layout-shift', buffered: true});

// LCP Monitoring
new PerformanceObserver((entryList) => {
  const entries = entryList.getEntries();
  const lastEntry = entries[entries.length - 1];

  gtag('event', 'lcp_timing', {
    'lcp_value': lastEntry.startTime,
    'page_url': window.location.href,
    'element': lastEntry.element
  });
}).observe({type: 'largest-contentful-paint', buffered: true});
```

---

## REPORTING DASHBOARD SETUP

### Google Analytics 4 Custom Reports

**Villa Performance Report:**
```
Report Name: Villa Performance Analysis
Dimensions:
- Villa Name
- Villa Zone
- Villa Type
- Traffic Source

Metrics:
- Villa Page Views
- Villa Engagement Time
- Villa Conversion Rate
- Villa Revenue Attribution
```

**Conversion Funnel Report:**
```
Report Name: Booking Funnel Analysis
Steps:
1. Homepage Visit
2. Category Page Visit (Zona/Tipo)
3. Villa Page Visit
4. Availability Check
5. Contact Form Submit

Metrics:
- Conversion Rate per Step
- Drop-off Rate per Step
- Time to Convert
```

**SEO Performance Report:**
```
Report Name: Organic Traffic Performance
Dimensions:
- Landing Page
- Search Query (GSC Integration)
- Device Category
- Geographic Location

Metrics:
- Organic Sessions
- Organic Conversion Rate
- Average Position (GSC)
- Click-through Rate (GSC)
```

### Data Studio Integration

**Automated Reporting Setup:**
```
Data Sources:
├── Google Analytics 4
├── Google Search Console
├── Google Ads (future)
├── Meta Ads (future)
└── Manual Data (competitor tracking)

Report Sections:
├── Executive Summary (KPIs overview)
├── SEO Performance (organic traffic + rankings)
├── Conversion Analysis (lead generation)
├── Villa-Specific Performance
└── Competitive Benchmarking
```

---

## PRIVACY AND COMPLIANCE

### GDPR Compliance Setup

**Cookie Consent Management:**
```javascript
// Cookie Consent Implementation
window.addEventListener('load', function() {
  if (!localStorage.getItem('cookie_consent')) {
    showCookieConsent();
  } else {
    initializeTracking();
  }
});

function acceptCookies() {
  localStorage.setItem('cookie_consent', 'accepted');
  gtag('consent', 'update', {
    'analytics_storage': 'granted',
    'ad_storage': 'granted'
  });
  initializeTracking();
}
```

**Data Retention Policy:**
```
Analytics Data Retention: 26 months
User Data Storage: 2 years maximum
Cookie Expiration: 1 year
Local Storage: Manual clear option provided
```

---

## IMPLEMENTATION TIMELINE

### Week 1: Foundation Setup
- Google Tag Manager installation
- GA4 enhanced configuration
- Basic event tracking implementation
- Cookie consent integration

### Week 2: Advanced Tracking
- Villa-specific event tracking
- Conversion tracking setup
- Meta Pixel implementation
- Hotjar installation

### Week 3: Reporting Setup
- Custom reports creation GA4
- Data Studio dashboard
- GSC optimization
- Attribution modeling

### Week 4: Testing & Optimization
- Event tracking validation
- Conversion funnel testing
- Cross-platform tracking verification
- Performance monitoring setup

---

## MAINTENANCE AND MONITORING

### Weekly Tasks
- Event tracking validation
- Conversion data review
- Core Web Vitals monitoring
- Privacy compliance check

### Monthly Tasks
- Custom reports analysis
- Attribution model review
- Heat map insights review
- Performance optimization

### Quarterly Tasks
- Full tracking audit
- Compliance review update
- Tool integration assessment
- Strategy refinement

---

## ARCHIVOS DE SOPORTE

**Technical Implementation:**
- GTM container export file
- GA4 configuration backup
- Event tracking implementation guide
- Data layer specifications

**Documentation:**
- Tracking strategy complete guide
- Event taxonomy reference
- Custom dimension definitions
- Conversion setup instructions

**Compliance:**
- Privacy policy tracking section
- Cookie consent configuration
- Data retention policy document
- GDPR compliance checklist

**Responsable:** Miguel Angel Jiménez
**Fecha:** 01/10/2025
**Estado:** Completado