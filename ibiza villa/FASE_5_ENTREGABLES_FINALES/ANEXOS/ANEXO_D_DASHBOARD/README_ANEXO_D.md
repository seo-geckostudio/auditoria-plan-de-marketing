# ANEXO D: DASHBOARD DE SEGUIMIENTO Y KPIs
## AUDITORÍA SEO IBIZA VILLA - MONITOREO Y MÉTRICAS

**Referencia:** Documento Maestro Ejecutivo  
**Fecha:** Noviembre 2025  
**Versión:** 1.0 Final  

---

## 📋 ÍNDICE DEL DASHBOARD

### CONFIGURACIÓN DE MONITOREO
- 📊 **dashboard_kpis_principales.html** - Dashboard KPIs principales
- 📊 **alertas_automaticas.json** - Configuración alertas automáticas
- 📊 **reportes_mensuales.xlsx** - Template reportes mensuales
- 📊 **tracking_objetivos.csv** - Seguimiento objetivos específicos

### MÉTRICAS Y KPIs
- 📊 **kpis_seo_tecnicos.json** - KPIs SEO técnicos
- 📊 **kpis_performance.json** - KPIs performance y UX
- 📊 **kpis_contenido.json** - KPIs contenido y engagement
- 📊 **kpis_conversiones.json** - KPIs conversiones y revenue

### HERRAMIENTAS DE ANÁLISIS
- 📊 **google_analytics_config.js** - Configuración GA4
- 📊 **search_console_api.py** - Scripts API Search Console
- 📊 **ahrefs_monitoring.js** - Monitoreo automático Ahrefs
- 📊 **core_web_vitals_tracker.html** - Tracker Core Web Vitals

---

## 🎯 KPIs PRINCIPALES - DASHBOARD EJECUTIVO

### MÉTRICAS PRIMARIAS (SEGUIMIENTO DIARIO)

#### 1. TRÁFICO ORGÁNICO
- **Objetivo 6 meses:** +25-40% vs baseline
- **Objetivo 12 meses:** +50-75% vs baseline
- **Fuente:** Google Analytics 4 + Search Console
- **Frecuencia:** Diaria
- **Alerta:** -10% semanal vs promedio

#### 2. CONVERSIONES ORGÁNICAS
- **Objetivo 6 meses:** +15-25% vs baseline
- **Objetivo 12 meses:** +30-50% vs baseline
- **Fuente:** Google Analytics 4 (Enhanced Ecommerce)
- **Frecuencia:** Diaria
- **Alerta:** -15% semanal vs promedio

#### 3. REVENUE ORGÁNICO
- **Objetivo 6 meses:** +30-50% vs baseline
- **Objetivo 12 meses:** +60-100% vs baseline
- **Fuente:** Google Analytics 4 + CRM integration
- **Frecuencia:** Diaria
- **Alerta:** -20% semanal vs promedio

#### 4. CORE WEB VITALS
- **LCP Objetivo:** <2.5s (90% URLs)
- **FID Objetivo:** <100ms (90% URLs)
- **CLS Objetivo:** <0.1 (90% URLs)
- **Fuente:** Google Search Console + PageSpeed Insights
- **Frecuencia:** Semanal
- **Alerta:** <80% URLs cumpliendo objetivos

### MÉTRICAS SECUNDARIAS (SEGUIMIENTO SEMANAL)

#### 5. POSICIONAMIENTO KEYWORDS
- **Top 3 Objetivo:** +40-60% keywords
- **Top 10 Objetivo:** +25-35% keywords
- **Fuente:** Ahrefs + Search Console
- **Frecuencia:** Semanal
- **Alerta:** -5% keywords top 10

#### 6. CTR ORGÁNICO
- **Objetivo:** +2-3% vs baseline
- **Benchmark:** >5% promedio
- **Fuente:** Google Search Console
- **Frecuencia:** Semanal
- **Alerta:** <4% CTR promedio

#### 7. PÁGINAS INDEXADAS
- **Objetivo:** 95%+ páginas importantes indexadas
- **Fuente:** Google Search Console
- **Frecuencia:** Semanal
- **Alerta:** <90% indexación

---

## 📊 DASHBOARD INTERACTIVO - CONFIGURACIÓN

### DASHBOARD KPIs PRINCIPALES (dashboard_kpis_principales.html)

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SEO - Ibiza Villa</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .kpi-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #0066cc;
        }
        .kpi-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #0066cc;
        }
        .kpi-label {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }
        .kpi-change {
            font-size: 0.8em;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .positive { background: #d4edda; color: #155724; }
        .negative { background: #f8d7da; color: #721c24; }
        .chart-container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Dashboard SEO - Ibiza Villa</h1>
        <p>Última actualización: <span id="lastUpdate"></span></p>
        
        <!-- KPIs Principales -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">Tráfico Orgánico (30 días)</div>
                <div class="kpi-value" id="organic-traffic">45,678</div>
                <div class="kpi-change positive" id="traffic-change">+12.3% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-label">Conversiones Orgánicas</div>
                <div class="kpi-value" id="organic-conversions">234</div>
                <div class="kpi-change positive" id="conversions-change">+18.7% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-label">Revenue Orgánico</div>
                <div class="kpi-value" id="organic-revenue">€89,456</div>
                <div class="kpi-change positive" id="revenue-change">+25.4% vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-label">Core Web Vitals (Good)</div>
                <div class="kpi-value" id="cwv-good">67%</div>
                <div class="kpi-change negative" id="cwv-change">Objetivo: 90%</div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-label">Keywords Top 10</div>
                <div class="kpi-value" id="keywords-top10">234</div>
                <div class="kpi-change positive" id="keywords-change">+15 vs mes anterior</div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-label">CTR Promedio</div>
                <div class="kpi-value" id="avg-ctr">5.12%</div>
                <div class="kpi-change positive" id="ctr-change">+0.3% vs mes anterior</div>
            </div>
        </div>
        
        <!-- Gráficos -->
        <div class="chart-container">
            <h3>Evolución Tráfico Orgánico (6 meses)</h3>
            <canvas id="trafficChart" width="400" height="200"></canvas>
        </div>
        
        <div class="chart-container">
            <h3>Core Web Vitals - Evolución</h3>
            <canvas id="cwvChart" width="400" height="200"></canvas>
        </div>
        
        <div class="chart-container">
            <h3>Keywords por Posición</h3>
            <canvas id="keywordsChart" width="400" height="200"></canvas>
        </div>
    </div>
    
    <script>
        // Actualizar timestamp
        document.getElementById('lastUpdate').textContent = new Date().toLocaleString('es-ES');
        
        // Configurar gráficos
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        const trafficChart = new Chart(trafficCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Tráfico Orgánico',
                    data: [38000, 41000, 39500, 42300, 44100, 45678],
                    borderColor: '#0066cc',
                    backgroundColor: 'rgba(0, 102, 204, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
        
        const cwvCtx = document.getElementById('cwvChart').getContext('2d');
        const cwvChart = new Chart(cwvCtx, {
            type: 'bar',
            data: {
                labels: ['LCP', 'FID', 'CLS'],
                datasets: [{
                    label: 'URLs Good (%)',
                    data: [45, 78, 56],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
        
        const keywordsCtx = document.getElementById('keywordsChart').getContext('2d');
        const keywordsChart = new Chart(keywordsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Top 3', 'Top 10', 'Top 50', 'Top 100', '+100'],
                datasets: [{
                    data: [89, 145, 298, 456, 259],
                    backgroundColor: [
                        '#28a745',
                        '#17a2b8',
                        '#ffc107',
                        '#fd7e14',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
```

---

## 🚨 ALERTAS AUTOMÁTICAS - CONFIGURACIÓN

### ALERTAS CRÍTICAS (alertas_automaticas.json)

```json
{
  "alertas_criticas": {
    "trafico_organico": {
      "metrica": "organic_traffic",
      "umbral": "-10%",
      "periodo": "7_dias",
      "frecuencia": "diaria",
      "destinatarios": ["seo@ibizavilla.com", "director@ibizavilla.com"],
      "mensaje": "⚠️ ALERTA: Tráfico orgánico ha bajado más del 10% en los últimos 7 días"
    },
    "core_web_vitals": {
      "metrica": "cwv_good_urls",
      "umbral": "<80%",
      "periodo": "semanal",
      "frecuencia": "semanal",
      "destinatarios": ["tech@ibizavilla.com", "seo@ibizavilla.com"],
      "mensaje": "🚨 CRÍTICO: Menos del 80% de URLs cumplen Core Web Vitals"
    },
    "conversiones": {
      "metrica": "organic_conversions",
      "umbral": "-15%",
      "periodo": "7_dias",
      "frecuencia": "diaria",
      "destinatarios": ["marketing@ibizavilla.com", "director@ibizavilla.com"],
      "mensaje": "📉 ALERTA: Conversiones orgánicas han bajado más del 15%"
    },
    "indexacion": {
      "metrica": "indexed_pages",
      "umbral": "<90%",
      "periodo": "semanal",
      "frecuencia": "semanal",
      "destinatarios": ["tech@ibizavilla.com", "seo@ibizavilla.com"],
      "mensaje": "🔍 ALERTA: Menos del 90% de páginas importantes están indexadas"
    }
  },
  "alertas_informativas": {
    "keywords_top10": {
      "metrica": "keywords_top10",
      "umbral": "+10",
      "periodo": "mensual",
      "frecuencia": "semanal",
      "destinatarios": ["seo@ibizavilla.com"],
      "mensaje": "🎉 ÉXITO: +10 nuevas keywords en top 10 este mes"
    },
    "ctr_mejora": {
      "metrica": "avg_ctr",
      "umbral": "+0.5%",
      "periodo": "mensual",
      "frecuencia": "mensual",
      "destinatarios": ["seo@ibizavilla.com", "marketing@ibizavilla.com"],
      "mensaje": "📈 MEJORA: CTR promedio ha mejorado +0.5% este mes"
    }
  }
}
```

---

## 📈 REPORTES AUTOMÁTICOS

### REPORTE MENSUAL EJECUTIVO

#### Estructura del Reporte:
1. **Resumen Ejecutivo**
   - KPIs principales vs objetivos
   - Highlights del mes
   - Issues críticos identificados

2. **Performance Detallado**
   - Tráfico orgánico por canal
   - Conversiones por fuente
   - Revenue attribution

3. **SEO Técnico**
   - Core Web Vitals status
   - Issues técnicos resueltos
   - Nuevos issues identificados

4. **Contenido y Keywords**
   - Nuevas keywords posicionadas
   - Content performance
   - Oportunidades identificadas

5. **Competencia**
   - Análisis competitivo
   - Market share evolution
   - Nuevas amenazas/oportunidades

6. **Próximos Pasos**
   - Acciones recomendadas
   - Prioridades siguiente mes
   - Recursos necesarios

---

## 🔧 CONFIGURACIÓN TÉCNICA

### GOOGLE ANALYTICS 4 - EVENTOS PERSONALIZADOS

```javascript
// Configuración GA4 para Ibiza Villa
gtag('config', 'GA_MEASUREMENT_ID', {
  // Enhanced Ecommerce
  send_page_view: true,
  // Custom dimensions
  custom_map: {
    'dimension1': 'villa_type',
    'dimension2': 'location',
    'dimension3': 'price_range',
    'dimension4': 'booking_source'
  }
});

// Evento: Villa View
gtag('event', 'villa_view', {
  'villa_id': 'villa_123',
  'villa_name': 'Villa Sunset Paradise',
  'location': 'Es Vedra',
  'price_per_night': 850,
  'bedrooms': 4,
  'max_guests': 8
});

// Evento: Booking Request
gtag('event', 'booking_request', {
  'villa_id': 'villa_123',
  'check_in': '2025-07-15',
  'check_out': '2025-07-22',
  'guests': 6,
  'total_value': 5950
});

// Evento: Booking Confirmation
gtag('event', 'purchase', {
  'transaction_id': 'booking_456',
  'value': 5950,
  'currency': 'EUR',
  'items': [{
    'item_id': 'villa_123',
    'item_name': 'Villa Sunset Paradise',
    'category': 'Villa Rental',
    'quantity': 7,
    'price': 850
  }]
});
```

### SEARCH CONSOLE API - MONITOREO AUTOMÁTICO

```python
# Script Python para monitoreo automático GSC
import requests
import json
from datetime import datetime, timedelta

class SearchConsoleMonitor:
    def __init__(self, site_url, credentials):
        self.site_url = site_url
        self.credentials = credentials
        
    def get_performance_data(self, days=30):
        """Obtener datos de performance de los últimos N días"""
        end_date = datetime.now().date()
        start_date = end_date - timedelta(days=days)
        
        request_body = {
            'startDate': start_date.strftime('%Y-%m-%d'),
            'endDate': end_date.strftime('%Y-%m-%d'),
            'dimensions': ['query', 'page', 'device'],
            'rowLimit': 1000
        }
        
        # Llamada a la API (requiere autenticación)
        response = self.call_api('searchanalytics/query', request_body)
        return response
    
    def get_core_web_vitals(self):
        """Obtener estado Core Web Vitals"""
        request_body = {
            'category': 'WEB_VITALS'
        }
        
        response = self.call_api('urlTestingTools/mobileFriendlyTest', request_body)
        return response
    
    def check_indexation_status(self):
        """Verificar estado de indexación"""
        request_body = {
            'inspectionUrl': self.site_url,
            'siteUrl': self.site_url
        }
        
        response = self.call_api('urlInspection/index:inspect', request_body)
        return response
    
    def generate_alert(self, metric, current_value, threshold):
        """Generar alerta si se supera umbral"""
        if current_value < threshold:
            alert = {
                'timestamp': datetime.now().isoformat(),
                'metric': metric,
                'current_value': current_value,
                'threshold': threshold,
                'severity': 'critical' if current_value < threshold * 0.8 else 'warning'
            }
            self.send_alert(alert)
    
    def send_alert(self, alert):
        """Enviar alerta por email/Slack"""
        # Implementar envío de alertas
        pass

# Uso del monitor
monitor = SearchConsoleMonitor('https://www.ibizavilla.com', credentials)
performance_data = monitor.get_performance_data(30)
cwv_data = monitor.get_core_web_vitals()
```

---

## 📊 KPIs POR ÁREA DE NEGOCIO

### SEO TÉCNICO
- **Páginas indexadas:** 95%+ objetivo
- **Errores 404:** <1% del total URLs
- **Tiempo carga promedio:** <3s objetivo
- **Mobile-friendly score:** 100% objetivo
- **Security score:** 95%+ objetivo

### CONTENIDO Y UX
- **Bounce rate orgánico:** <45% objetivo
- **Tiempo en página:** >2min objetivo
- **Páginas por sesión:** >2.5 objetivo
- **CTR promedio:** >5% objetivo
- **Featured snippets:** +25 nuevos objetivo

### CONVERSIONES Y REVENUE
- **Conversion rate orgánico:** >2.5% objetivo
- **Revenue per visitor:** >€15 objetivo
- **Average order value:** >€2,500 objetivo
- **Customer lifetime value:** >€5,000 objetivo
- **Return on ad spend (ROAS):** >400% objetivo

---

## 🎯 OBJETIVOS Y BENCHMARKS

### OBJETIVOS 6 MESES
- **Tráfico orgánico:** +25-40%
- **Conversiones:** +15-25%
- **Revenue orgánico:** +30-50%
- **Core Web Vitals:** 90%+ URLs good
- **Keywords top 10:** +40-60%

### OBJETIVOS 12 MESES
- **Tráfico orgánico:** +50-75%
- **Conversiones:** +30-50%
- **Revenue orgánico:** +60-100%
- **Market share:** Líder absoluto Ibiza
- **Expansión internacional:** 5 mercados activos

### BENCHMARKS INDUSTRIA
- **CTR promedio:** 3-5% (objetivo: >5%)
- **Conversion rate:** 1-3% (objetivo: >2.5%)
- **Bounce rate:** 40-60% (objetivo: <45%)
- **Page load time:** <3s (objetivo: <2.5s)
- **Mobile score:** >85 (objetivo: >90)

---

## 📞 CONTACTO Y SOPORTE

**Consultor SEO:** Miguel Angel Jiménez  
**Proyecto:** Auditoría SEO Ibiza Villa  
**Fecha:** Noviembre 2025  
**Versión:** 1.0 Final  

---

*Este anexo proporciona un sistema completo de monitoreo y seguimiento para garantizar el éxito de la implementación SEO y el cumplimiento de objetivos establecidos.*