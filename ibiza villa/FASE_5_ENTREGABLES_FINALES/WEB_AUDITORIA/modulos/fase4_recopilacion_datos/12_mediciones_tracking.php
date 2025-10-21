<?php
/**
 * Módulo: Sistema de Mediciones y Tracking
 *
 * Define métodos de medición, eventos GTM/GA4, conversiones y microconversiones
 * para todo el embudo de venta, incluyendo integración con sistemas externos.
 */

// Datos del módulo
$datosModulo = [
    'titulo' => 'Sistema de Mediciones y Tracking',
    'descripcion' => 'Framework completo de mediciones para embudo de conversión: GA4, GTM, eventos personalizados y sistemas externos',

    // Métodos de medición disponibles
    'metodos_medicion' => [
        'principal' => [
            'herramienta' => 'Google Analytics 4',
            'cobertura' => '80-95% del embudo',
            'eventos' => 'Automáticos + Personalizados + Enhanced Ecommerce',
            'limitaciones' => 'No captura conversiones en sistemas externos (CRM, PMS, ERPs)'
        ],
        'gtm' => [
            'herramienta' => 'Google Tag Manager',
            'cobertura' => '100% del embudo web',
            'eventos' => 'Custom events, form submissions, scroll depth, video, clicks',
            'limitaciones' => 'Requiere configuración técnica, no captura backend'
        ],
        'externos' => [
            'herramienta' => 'APIs + Webhooks + Server-side tracking',
            'cobertura' => 'Conversiones finales fuera del sitio web',
            'eventos' => 'Reservas completadas, pagos procesados, check-ins',
            'limitaciones' => 'Requiere integración técnica con sistemas terceros'
        ],
        'crm' => [
            'herramienta' => 'CRM/PMS Integration',
            'cobertura' => 'Post-conversión y lifecycle completo',
            'eventos' => 'Lead scoring, pipeline stages, customer lifetime value',
            'limitaciones' => 'Depende del CRM/PMS usado'
        ]
    ],

    // Embudo de conversión completo
    'embudo_conversion' => [
        'awareness' => [
            'fase' => 'Descubrimiento',
            'microconversiones' => [
                'page_view' => ['evento' => 'page_view', 'automatico' => true, 'prioridad' => 'baja'],
                'session_start' => ['evento' => 'session_start', 'automatico' => true, 'prioridad' => 'media'],
                'scroll_50' => ['evento' => 'scroll', 'automatico' => false, 'prioridad' => 'media', 'gtm' => true],
                'time_on_page_30s' => ['evento' => 'user_engagement', 'automatico' => true, 'prioridad' => 'media']
            ],
            'metricas' => ['Sesiones', 'Usuarios', 'Páginas/sesión', 'Tiempo promedio'],
            'objetivo' => 'Captar atención y generar interés'
        ],
        'consideration' => [
            'fase' => 'Consideración',
            'microconversiones' => [
                'villa_view' => ['evento' => 'view_item', 'automatico' => false, 'prioridad' => 'alta', 'ecommerce' => true],
                'gallery_interaction' => ['evento' => 'select_content', 'automatico' => false, 'prioridad' => 'media', 'gtm' => true],
                'amenities_expand' => ['evento' => 'select_content', 'automatico' => false, 'prioridad' => 'baja', 'gtm' => true],
                'reviews_read' => ['evento' => 'select_content', 'automatico' => false, 'prioridad' => 'media', 'gtm' => true],
                'availability_check' => ['evento' => 'search', 'automatico' => false, 'prioridad' => 'alta', 'gtm' => true],
                'price_calculator_use' => ['evento' => 'add_payment_info', 'automatico' => false, 'prioridad' => 'alta', 'gtm' => true]
            ],
            'metricas' => ['Villas vistas', 'Profundidad navegación', 'Checks disponibilidad'],
            'objetivo' => 'Evaluar opciones y comparar villas'
        ],
        'intent' => [
            'fase' => 'Intención',
            'microconversiones' => [
                'add_to_wishlist' => ['evento' => 'add_to_wishlist', 'automatico' => false, 'prioridad' => 'alta', 'ecommerce' => true],
                'inquiry_form_start' => ['evento' => 'begin_checkout', 'automatico' => false, 'prioridad' => 'crítica', 'gtm' => true],
                'phone_click' => ['evento' => 'generate_lead', 'automatico' => false, 'prioridad' => 'crítica', 'gtm' => true],
                'whatsapp_click' => ['evento' => 'generate_lead', 'automatico' => false, 'prioridad' => 'crítica', 'gtm' => true],
                'email_click' => ['evento' => 'generate_lead', 'automatico' => false, 'prioridad' => 'alta', 'gtm' => true],
                'booking_form_field_complete' => ['evento' => 'add_shipping_info', 'automatico' => false, 'prioridad' => 'alta', 'gtm' => true]
            ],
            'metricas' => ['Formularios iniciados', 'Leads generados', 'Tasa abandono formulario'],
            'objetivo' => 'Capturar intención de reserva'
        ],
        'conversion' => [
            'fase' => 'Conversión Web',
            'conversiones' => [
                'inquiry_submit' => ['evento' => 'generate_lead', 'automatico' => false, 'prioridad' => 'crítica', 'valor' => 'alto', 'gtm' => true],
                'booking_request_submit' => ['evento' => 'purchase', 'automatico' => false, 'prioridad' => 'crítica', 'valor' => 'muy alto', 'ecommerce' => true],
                'quote_request' => ['evento' => 'generate_lead', 'automatico' => false, 'prioridad' => 'alta', 'valor' => 'medio', 'gtm' => true],
                'newsletter_signup' => ['evento' => 'sign_up', 'automatico' => false, 'prioridad' => 'media', 'valor' => 'bajo', 'gtm' => true]
            ],
            'metricas' => ['Formularios enviados', 'Solicitudes reserva', 'Tasa conversión'],
            'objetivo' => 'Generar leads cualificados'
        ],
        'conversion_externa' => [
            'fase' => 'Conversión Externa (Fuera GA4)',
            'conversiones_externas' => [
                'booking_confirmed' => [
                    'evento' => 'booking_confirmed',
                    'sistema' => 'PMS/CRM externo',
                    'metodo' => 'Server-side tracking / API',
                    'prioridad' => 'crítica',
                    'valor' => 'muy alto',
                    'datos' => ['booking_id', 'villa_id', 'check_in', 'check_out', 'total_value', 'commission']
                ],
                'payment_received' => [
                    'evento' => 'payment_received',
                    'sistema' => 'Stripe/PayPal/Banking',
                    'metodo' => 'Webhook',
                    'prioridad' => 'crítica',
                    'valor' => 'muy alto',
                    'datos' => ['transaction_id', 'amount', 'currency', 'booking_id']
                ],
                'contract_signed' => [
                    'evento' => 'contract_signed',
                    'sistema' => 'DocuSign/HelloSign',
                    'metodo' => 'Webhook',
                    'prioridad' => 'alta',
                    'valor' => 'alto',
                    'datos' => ['contract_id', 'booking_id', 'signed_date']
                ]
            ],
            'metricas' => ['Reservas confirmadas', 'Pagos recibidos', 'Valor total'],
            'objetivo' => 'Cerrar venta y procesar pago',
            'tracking_method' => 'Measurement Protocol API + Server-side GTM'
        ],
        'retention' => [
            'fase' => 'Post-Conversión',
            'eventos_retention' => [
                'check_in_completed' => ['evento' => 'check_in', 'sistema' => 'PMS', 'prioridad' => 'media'],
                'review_submitted' => ['evento' => 'review_submit', 'sistema' => 'Web/Google', 'prioridad' => 'alta'],
                'repeat_booking' => ['evento' => 'repeat_purchase', 'sistema' => 'CRM', 'prioridad' => 'crítica'],
                'referral_made' => ['evento' => 'referral', 'sistema' => 'CRM', 'prioridad' => 'alta']
            ],
            'metricas' => ['CLV', 'Repeat rate', 'Reviews', 'NPS'],
            'objetivo' => 'Fidelizar y generar recurrencia'
        ]
    ],

    // Eventos GTM específicos para Ibiza Villa
    'eventos_gtm_ibiza_villa' => [
        // Navegación y descubrimiento
        'villa_card_click' => [
            'trigger' => 'Click - All Elements',
            'variables' => ['Click Classes: .villa-card', 'Click Text', 'Click URL'],
            'tag_ga4' => 'select_item',
            'parametros' => ['item_id' => '{{Villa ID}}', 'item_name' => '{{Villa Name}}', 'item_category' => 'villa'],
            'prioridad' => 'alta'
        ],
        'filter_applied' => [
            'trigger' => 'Click - Just Links | URL contains ?filter',
            'variables' => ['Page URL', 'Filter Type', 'Filter Value'],
            'tag_ga4' => 'search',
            'parametros' => ['search_term' => '{{Filter Value}}'],
            'prioridad' => 'media'
        ],
        'map_view_toggle' => [
            'trigger' => 'Click - All Elements | ID: #map-toggle',
            'variables' => ['Click Text'],
            'tag_ga4' => 'select_content',
            'parametros' => ['content_type' => 'map', 'item_id' => 'map_view'],
            'prioridad' => 'baja'
        ],

        // Interacción con villa
        'gallery_photo_view' => [
            'trigger' => 'Click - All Elements | Class: .gallery-image',
            'variables' => ['Image Source', 'Image Alt', 'Villa ID'],
            'tag_ga4' => 'select_content',
            'parametros' => ['content_type' => 'image', 'item_id' => '{{Villa ID}}', 'item_name' => '{{Image Alt}}'],
            'prioridad' => 'media'
        ],
        'virtual_tour_start' => [
            'trigger' => 'Click - All Elements | ID: #virtual-tour-btn',
            'variables' => ['Villa ID', 'Villa Name'],
            'tag_ga4' => 'select_content',
            'parametros' => ['content_type' => 'virtual_tour', 'item_id' => '{{Villa ID}}'],
            'prioridad' => 'alta'
        ],
        'amenity_filter_click' => [
            'trigger' => 'Click - All Elements | Class: .amenity-checkbox',
            'variables' => ['Checkbox Value', 'Checkbox Label'],
            'tag_ga4' => 'search',
            'parametros' => ['search_term' => '{{Checkbox Label}}'],
            'prioridad' => 'media'
        ],

        // Formularios y conversión
        'availability_form_submit' => [
            'trigger' => 'Form Submission - Form ID: #availability-form',
            'variables' => ['Check-in Date', 'Check-out Date', 'Guests', 'Villa ID'],
            'tag_ga4' => 'search',
            'parametros' => ['search_term' => 'availability_{{Villa ID}}'],
            'prioridad' => 'crítica'
        ],
        'inquiry_form_start' => [
            'trigger' => 'Form Visibility - Form ID: #inquiry-form',
            'variables' => ['Villa ID', 'Form Type'],
            'tag_ga4' => 'begin_checkout',
            'parametros' => ['item_id' => '{{Villa ID}}', 'value' => 'potential_booking'],
            'prioridad' => 'crítica'
        ],
        'inquiry_form_submit' => [
            'trigger' => 'Form Submission - Form ID: #inquiry-form',
            'variables' => ['Villa ID', 'Lead Type', 'Form Fields'],
            'tag_ga4' => 'generate_lead',
            'parametros' => ['item_id' => '{{Villa ID}}', 'currency' => 'EUR', 'value' => '150'],
            'prioridad' => 'crítica',
            'conversion' => true
        ],
        'booking_request_submit' => [
            'trigger' => 'Form Submission - Form ID: #booking-form',
            'variables' => ['Villa ID', 'Total Nights', 'Total Guests', 'Total Value'],
            'tag_ga4' => 'purchase',
            'parametros' => [
                'transaction_id' => '{{Booking ID}}',
                'value' => '{{Total Value}}',
                'currency' => 'EUR',
                'items' => '[{item_id: {{Villa ID}}, item_name: {{Villa Name}}, quantity: {{Total Nights}}}]'
            ],
            'prioridad' => 'crítica',
            'conversion' => true
        ],

        // Leads alternativos
        'phone_click' => [
            'trigger' => 'Click - All Elements | Matches CSS: a[href^="tel:"]',
            'variables' => ['Click URL', 'Page URL', 'Villa ID'],
            'tag_ga4' => 'generate_lead',
            'parametros' => ['method' => 'phone', 'item_id' => '{{Villa ID}}', 'value' => '100'],
            'prioridad' => 'crítica',
            'conversion' => true
        ],
        'whatsapp_click' => [
            'trigger' => 'Click - All Elements | URL contains wa.me',
            'variables' => ['Click URL', 'Villa ID'],
            'tag_ga4' => 'generate_lead',
            'parametros' => ['method' => 'whatsapp', 'item_id' => '{{Villa ID}}', 'value' => '120'],
            'prioridad' => 'crítica',
            'conversion' => true
        ],
        'email_click' => [
            'trigger' => 'Click - All Elements | Matches CSS: a[href^="mailto:"]',
            'variables' => ['Click URL', 'Villa ID'],
            'tag_ga4' => 'generate_lead',
            'parametros' => ['method' => 'email', 'item_id' => '{{Villa ID}}', 'value' => '80'],
            'prioridad' => 'alta',
            'conversion' => true
        ],

        // Scroll depth
        'scroll_depth_25' => [
            'trigger' => 'Scroll Depth - 25%',
            'variables' => ['Page URL', 'Scroll Depth Threshold'],
            'tag_ga4' => 'scroll',
            'parametros' => ['percent_scrolled' => '25'],
            'prioridad' => 'baja'
        ],
        'scroll_depth_50' => [
            'trigger' => 'Scroll Depth - 50%',
            'variables' => ['Page URL'],
            'tag_ga4' => 'scroll',
            'parametros' => ['percent_scrolled' => '50'],
            'prioridad' => 'media'
        ],
        'scroll_depth_90' => [
            'trigger' => 'Scroll Depth - 90%',
            'variables' => ['Page URL'],
            'tag_ga4' => 'scroll',
            'parametros' => ['percent_scrolled' => '90'],
            'prioridad' => 'alta'
        ],

        // Salida
        'exit_intent' => [
            'trigger' => 'Custom Event - Mouse Leave Viewport',
            'variables' => ['Page URL', 'Time on Page', 'Villa ID'],
            'tag_ga4' => 'select_content',
            'parametros' => ['content_type' => 'exit_intent', 'item_id' => '{{Villa ID}}'],
            'prioridad' => 'media'
        ]
    ],

    // Integración con sistemas externos
    'integracion_externa' => [
        'pms_cloudbeds' => [
            'sistema' => 'Cloudbeds PMS',
            'eventos_disponibles' => ['reservation_created', 'reservation_modified', 'reservation_cancelled', 'check_in', 'check_out', 'payment_received'],
            'metodo_integracion' => 'Webhook → Zapier/Make → GA4 Measurement Protocol',
            'datos_capturados' => ['reservation_id', 'property_id', 'guest_name', 'check_in_date', 'check_out_date', 'total_amount', 'booking_source'],
            'evento_ga4' => 'booking_confirmed',
            'valor_evento' => 'total_amount'
        ],
        'pms_guesty' => [
            'sistema' => 'Guesty',
            'eventos_disponibles' => ['listing_inquiry', 'reservation_confirmed', 'payment_captured', 'review_received'],
            'metodo_integracion' => 'Webhook → Server-side GTM → GA4',
            'datos_capturados' => ['listing_id', 'guest_id', 'total_price', 'nights', 'source'],
            'evento_ga4' => 'booking_confirmed'
        ],
        'crm_hubspot' => [
            'sistema' => 'HubSpot CRM',
            'eventos_disponibles' => ['contact_created', 'deal_stage_changed', 'deal_won', 'deal_lost'],
            'metodo_integracion' => 'HubSpot Workflows → Webhook → GA4 MP',
            'datos_capturados' => ['contact_id', 'deal_value', 'deal_stage', 'source', 'villa_interest'],
            'evento_ga4' => 'crm_deal_won'
        ],
        'payment_stripe' => [
            'sistema' => 'Stripe',
            'eventos_disponibles' => ['payment_intent.succeeded', 'charge.succeeded', 'invoice.paid'],
            'metodo_integracion' => 'Stripe Webhook → Cloud Function → GA4 MP',
            'datos_capturados' => ['payment_id', 'amount', 'currency', 'customer_id', 'metadata.booking_id'],
            'evento_ga4' => 'payment_received'
        ],
        'docusign' => [
            'sistema' => 'DocuSign',
            'eventos_disponibles' => ['envelope_sent', 'envelope_completed', 'envelope_declined'],
            'metodo_integracion' => 'DocuSign Connect → Webhook → GA4 MP',
            'datos_capturados' => ['envelope_id', 'status', 'completed_date', 'metadata.booking_id'],
            'evento_ga4' => 'contract_signed'
        ]
    ],

    // Comparativa ANTES/DESPUÉS
    'comparativa' => [
        'situacion_actual' => [
            'eventos_configurados' => 3,
            'eventos_detalle' => 'Solo page_view, session_start, scroll (automáticos)',
            'conversiones_trackeadas' => 0,
            'microconversiones_trackeadas' => 0,
            'integracion_externa' => 'No existe',
            'visibilidad_embudo' => '5-10%',
            'atribucion_conversiones' => 'Imposible',
            'valor_leads' => 'Desconocido',
            'tasa_abandono_visible' => 'No',
            'roi_marketing' => 'No cuantificable'
        ],
        'situacion_propuesta' => [
            'eventos_configurados' => 28,
            'eventos_detalle' => '25 custom GTM + 3 automáticos GA4',
            'conversiones_trackeadas' => 7,
            'microconversiones_trackeadas' => 18,
            'integracion_externa' => '5 sistemas (PMS, CRM, Payment, DocuSign, Reviews)',
            'visibilidad_embudo' => '95-100%',
            'atribucion_conversiones' => 'Completa multi-touch',
            'valor_leads' => 'Cuantificado (€80-150/lead según método)',
            'tasa_abandono_visible' => 'Sí, por fase embudo',
            'roi_marketing' => '100% cuantificable con conversiones externas'
        ]
    ],

    // Implementación técnica
    'implementacion_tecnica' => [
        'fase1_gtm_setup' => [
            'pasos' => [
                '1. Crear cuenta GTM e instalar container',
                '2. Configurar variables built-in: Click Classes, Click Text, Click URL, Page URL, Form ID',
                '3. Crear variables personalizadas: Villa ID (DOM/dataLayer), Villa Name, Total Value',
                '4. Configurar triggers para cada evento (28 triggers)',
                '5. Crear tags GA4 para cada evento (28 tags)',
                '6. Configurar conversiones en GA4 (7 conversiones)',
                '7. Testing y debugging con Preview mode',
                '8. Publicar container'
            ],
            'tiempo_estimado' => '80-120 horas',
            'complejidad' => 'Media-Alta'
        ],
        'fase2_datalayer' => [
            'pasos' => [
                '1. Definir estructura dataLayer para cada página',
                '2. Implementar dataLayer en templates PHP',
                '3. Push events personalizados (form submissions, clicks)',
                '4. Enhanced Ecommerce dataLayer (view_item, purchase)',
                '5. Testing dataLayer con GTM Preview'
            ],
            'ejemplo_codigo' => [
                'villa_page' => "
<script>
dataLayer.push({
    'event': 'villa_view',
    'ecommerce': {
        'items': [{
            'item_id': 'villa_{{id}}',
            'item_name': '{{villa_name}}',
            'item_category': 'luxury_villa',
            'price': {{base_price}},
            'quantity': 1
        }]
    },
    'villa_data': {
        'villa_id': '{{id}}',
        'villa_name': '{{name}}',
        'bedrooms': {{bedrooms}},
        'location': '{{location}}',
        'availability': '{{status}}'
    }
});
</script>",
                'form_submit' => "
<script>
document.getElementById('inquiry-form').addEventListener('submit', function(e) {
    dataLayer.push({
        'event': 'generate_lead',
        'lead_type': 'inquiry',
        'villa_id': '{{villa_id}}',
        'value': 150,
        'currency': 'EUR'
    });
});
</script>"
            ],
            'tiempo_estimado' => '40-60 horas',
            'complejidad' => 'Media'
        ],
        'fase3_server_side' => [
            'pasos' => [
                '1. Configurar Server-side GTM container (Google Cloud)',
                '2. Implementar Measurement Protocol API endpoints',
                '3. Crear Cloud Functions para procesar webhooks',
                '4. Configurar webhooks en sistemas externos (PMS, Stripe, etc)',
                '5. Mapear datos externos → GA4 events',
                '6. Testing end-to-end',
                '7. Monitoreo y logging'
            ],
            'ejemplo_codigo' => [
                'cloud_function' => "
// Cloud Function: Stripe Webhook → GA4
exports.stripeToGA4 = functions.https.onRequest(async (req, res) => {
    const event = req.body;

    if (event.type === 'payment_intent.succeeded') {
        const payload = {
            client_id: event.data.object.metadata.ga_client_id,
            events: [{
                name: 'payment_received',
                params: {
                    transaction_id: event.data.object.id,
                    value: event.data.object.amount / 100,
                    currency: event.data.object.currency.toUpperCase(),
                    booking_id: event.data.object.metadata.booking_id
                }
            }]
        };

        await sendToGA4(payload);
    }

    res.sendStatus(200);
});",
                'measurement_protocol' => "
// Send to GA4 via Measurement Protocol
async function sendToGA4(payload) {
    const GA4_MEASUREMENT_ID = 'G-XXXXXXXXXX';
    const API_SECRET = 'your_api_secret';

    await fetch(`https://www.google-analytics.com/mp/collect?measurement_id=${GA4_MEASUREMENT_ID}&api_secret=${API_SECRET}`, {
        method: 'POST',
        body: JSON.stringify(payload)
    });
}"
            ],
            'tiempo_estimado' => '60-100 horas',
            'complejidad' => 'Alta'
        ],
        'fase4_dashboards' => [
            'pasos' => [
                '1. Crear exploraciones personalizadas GA4',
                '2. Configurar embudos de conversión',
                '3. Setup attribution models',
                '4. Crear alertas personalizadas',
                '5. Looker Studio dashboards (opcional)'
            ],
            'tiempo_estimado' => '20-40 horas',
            'complejidad' => 'Media'
        ]
    ],

    // Métricas clave
    'metricas_principales' => [
        'discovery' => [
            'sesiones_total' => 'Total sessions',
            'usuarios_nuevos' => 'New users',
            'paginas_vistas' => 'Page views',
            'scroll_50_rate' => '% usuarios scroll >50%',
            'engagement_rate' => 'Engagement rate'
        ],
        'consideration' => [
            'villas_vistas' => 'Item views',
            'availability_checks' => 'Availability searches',
            'gallery_interactions' => 'Gallery engagement',
            'tiempo_villa_page' => 'Avg time on villa page'
        ],
        'intent' => [
            'forms_iniciados' => 'Form starts',
            'leads_phone' => 'Phone click conversions',
            'leads_whatsapp' => 'WhatsApp conversions',
            'leads_email' => 'Email conversions',
            'tasa_abandono_form' => 'Form abandonment rate'
        ],
        'conversion' => [
            'inquiries_enviados' => 'Inquiry submissions',
            'booking_requests' => 'Booking requests',
            'tasa_conversion' => 'Conversion rate (session → lead)',
            'valor_conversion_promedio' => 'Avg lead value'
        ],
        'external_conversion' => [
            'bookings_confirmados' => 'Confirmed bookings (PMS)',
            'pagos_recibidos' => 'Payments received (Stripe)',
            'contratos_firmados' => 'Contracts signed (DocuSign)',
            'valor_total_bookings' => 'Total booking value',
            'tasa_lead_to_booking' => 'Lead → Booking rate'
        ],
        'retention' => [
            'repeat_bookings' => 'Repeat booking rate',
            'clv' => 'Customer lifetime value',
            'nps' => 'Net promoter score',
            'reviews_submitted' => 'Review submission rate'
        ]
    ]
];

// Métricas de comparación
$metricas_comparacion = [
    ['metrica' => 'Eventos Configurados', 'antes' => '3 automáticos', 'despues' => '28 eventos (25 custom + 3 auto)', 'mejora' => '+833%', 'impacto' => 'Visibilidad completa del comportamiento usuario'],
    ['metrica' => 'Conversiones Trackeadas', 'antes' => '0 conversiones', 'despues' => '7 conversiones (4 web + 3 externas)', 'mejora' => '+∞', 'impacto' => 'ROI marketing 100% cuantificable'],
    ['metrica' => 'Microconversiones', 'antes' => '0 micro', 'despues' => '18 microconversiones', 'mejora' => '+∞', 'impacto' => 'Optimización embudo fase por fase'],
    ['metrica' => 'Visibilidad Embudo', 'antes' => '5-10%', 'despues' => '95-100%', 'mejora' => '+900-1900%', 'impacto' => 'Identificar cuellos de botella exactos'],
    ['metrica' => 'Integración Sistemas Externos', 'antes' => '0 integraciones', 'despues' => '5 sistemas (PMS/CRM/Payment)', 'mejora' => '+500%', 'impacto' => 'Cierre loop completo: tráfico → revenue real', 'destacada' => true],
    ['metrica' => 'Atribución Conversiones', 'antes' => 'Imposible', 'despues' => 'Multi-touch attribution completa', 'mejora' => '+100%', 'impacto' => 'Saber qué canales generan bookings reales'],
    ['metrica' => 'Tiempo Implementación', 'antes' => 'N/A', 'despues' => '200-320 horas (4-6 semanas)', 'mejora' => 'N/A', 'impacto' => 'Inversión única, beneficio perpetuo']
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $datosModulo['titulo']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --info-color: #16a085;
            --light-bg: #ecf0f1;
            --dark-text: #2c3e50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }

        .tracking-page {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .header-section h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .header-section p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Secciones principales */
        .content-section {
            background: white;
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary-color);
        }

        .section-subtitle {
            color: var(--secondary-color);
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* Cards de métodos */
        .method-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            color: white;
        }

        .method-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .method-card .method-detail {
            background: rgba(255,255,255,0.15);
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 10px;
        }

        .method-detail strong {
            display: inline-block;
            width: 140px;
            color: #fff;
        }

        /* Embudo de conversión */
        .funnel-stage {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 5px solid var(--secondary-color);
        }

        .funnel-stage.critical {
            border-left-color: var(--accent-color);
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
        }

        .funnel-stage h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .funnel-stage .stage-label {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Eventos */
        .event-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 12px;
            border-left: 4px solid #3498db;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .event-item.priority-critical {
            border-left-color: #e74c3c;
            background: #fff5f5;
        }

        .event-item.priority-high {
            border-left-color: #f39c12;
            background: #fffbf0;
        }

        .event-item.priority-medium {
            border-left-color: #3498db;
        }

        .event-item.priority-low {
            border-left-color: #95a5a6;
            background: #f8f9fa;
        }

        .event-name {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .event-type {
            font-size: 0.85rem;
            color: #666;
            margin-top: 3px;
        }

        .event-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .badge-gtm {
            background: #667eea;
            color: white;
        }

        .badge-ecommerce {
            background: #27ae60;
            color: white;
        }

        .badge-automatic {
            background: #95a5a6;
            color: white;
        }

        .badge-conversion {
            background: #e74c3c;
            color: white;
        }

        /* GTM Events */
        .gtm-event {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border: 2px solid #e9ecef;
        }

        .gtm-event:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .gtm-event-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .gtm-event-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .gtm-event-priority {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .gtm-event-priority.critical {
            background: #e74c3c;
            color: white;
        }

        .gtm-event-priority.alta {
            background: #f39c12;
            color: white;
        }

        .gtm-event-priority.media {
            background: #3498db;
            color: white;
        }

        .gtm-event-priority.baja {
            background: #95a5a6;
            color: white;
        }

        .gtm-event-detail {
            background: white;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 10px;
        }

        .gtm-event-detail strong {
            color: var(--secondary-color);
            display: block;
            margin-bottom: 5px;
        }

        .gtm-event-detail code {
            background: #2c3e50;
            color: #2ecc71;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        /* Sistemas externos */
        .external-system {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            color: white;
        }

        .external-system h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .external-event {
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 12px;
        }

        .external-event strong {
            color: #fff;
        }

        /* Implementación técnica */
        .implementation-phase {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--success-color);
        }

        .implementation-phase h4 {
            color: var(--success-color);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .implementation-step {
            background: white;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-left: 3px solid var(--info-color);
        }

        .code-block {
            background: #2c3e50;
            color: #2ecc71;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            white-space: pre;
        }

        .time-estimate {
            display: inline-block;
            background: var(--warning-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 10px;
        }

        .complexity-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .complexity-media {
            background: #3498db;
            color: white;
        }

        .complexity-alta {
            background: #e74c3c;
            color: white;
        }

        /* Comparativa ANTES/DESPUÉS */
        .comparison-container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 30px;
            margin: 30px 0;
            align-items: center;
        }

        .comparison-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
        }

        .comparison-card.before {
            border: 3px solid #e74c3c;
        }

        .comparison-card.after {
            border: 3px solid #27ae60;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        }

        .comparison-card h3 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .comparison-card.before h3 {
            color: #e74c3c;
        }

        .comparison-card.after h3 {
            color: #27ae60;
        }

        .comparison-arrow {
            text-align: center;
            font-size: 3rem;
            color: var(--secondary-color);
        }

        .comparison-item {
            margin-bottom: 15px;
            padding: 12px;
            background: white;
            border-radius: 8px;
        }

        .comparison-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .comparison-value {
            color: #555;
            font-size: 0.95rem;
        }

        /* Tabla de métricas */
        .metrics-table {
            width: 100%;
            margin-top: 20px;
        }

        .metrics-table th {
            background: var(--primary-color);
            color: white;
            padding: 15px;
            font-weight: 600;
        }

        .metrics-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .metrics-table tr:hover {
            background: #f8f9fa;
        }

        .mejora-positiva {
            color: var(--success-color);
            font-weight: 700;
        }

        .destacada {
            background: #fff3cd !important;
            border-left: 4px solid var(--warning-color);
        }

        /* Alert boxes */
        .alert-box {
            background: #fff3cd;
            border-left: 5px solid #f39c12;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .alert-box.info {
            background: #d1ecf1;
            border-left-color: #17a2b8;
        }

        .alert-box.success {
            background: #d4edda;
            border-left-color: #28a745;
        }

        .alert-box h4 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .comparison-container {
                grid-template-columns: 1fr;
            }

            .comparison-arrow {
                transform: rotate(90deg);
            }
        }
    </style>
</head>
<body>
    <div class="tracking-page">
        <!-- Header -->
        <div class="header-section">
            <h1><i class="fas fa-chart-line"></i> <?php echo $datosModulo['titulo']; ?></h1>
            <p><?php echo $datosModulo['descripcion']; ?></p>
        </div>

        <!-- Tabla de Comparación de Métricas -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-balance-scale"></i> Comparativa: Tracking Actual vs Propuesto</h2>

            <table class="table metrics-table">
                <thead>
                    <tr>
                        <th>Métrica</th>
                        <th>Situación Actual</th>
                        <th>Situación Propuesta</th>
                        <th>Mejora</th>
                        <th>Impacto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($metricas_comparacion as $metrica): ?>
                        <tr class="<?php echo isset($metrica['destacada']) && $metrica['destacada'] ? 'destacada' : ''; ?>">
                            <td><strong><?php echo $metrica['metrica']; ?></strong></td>
                            <td><?php echo $metrica['antes']; ?></td>
                            <td><?php echo $metrica['despues']; ?></td>
                            <td class="mejora-positiva"><?php echo $metrica['mejora']; ?></td>
                            <td><?php echo $metrica['impacto']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Comparativa ANTES/DESPUÉS Visual -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-exchange-alt"></i> ANTES vs DESPUÉS - Sistema de Mediciones</h2>

            <div class="comparison-container">
                <!-- ANTES -->
                <div class="comparison-card before">
                    <h3>❌ ANTES - Sin Sistema de Mediciones</h3>

                    <?php foreach ($datosModulo['comparativa']['situacion_actual'] as $key => $value): ?>
                        <div class="comparison-item">
                            <div class="comparison-label"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></div>
                            <div class="comparison-value"><?php echo $value; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- FLECHA -->
                <div class="comparison-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- DESPUÉS -->
                <div class="comparison-card after">
                    <h3>✅ DESPUÉS - Sistema Completo de Tracking</h3>

                    <?php foreach ($datosModulo['comparativa']['situacion_propuesta'] as $key => $value): ?>
                        <div class="comparison-item">
                            <div class="comparison-label"><?php echo ucfirst(str_replace('_', ' ', $key)); ?></div>
                            <div class="comparison-value"><?php echo $value; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="alert-box success">
                <h4><i class="fas fa-check-circle"></i> Resultado</h4>
                <p><strong>Visibilidad del embudo: 5-10% → 95-100% (+900-1900%)</strong></p>
                <p>Con tracking completo puedes identificar exactamente dónde pierdes usuarios, qué canales generan bookings reales, y cuantificar ROI de cada acción de marketing.</p>
            </div>
        </div>

        <!-- Métodos de Medición -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-tools"></i> Métodos de Medición Disponibles</h2>

            <?php foreach ($datosModulo['metodos_medicion'] as $key => $metodo): ?>
                <div class="method-card">
                    <h3><i class="fas fa-chart-bar"></i> <?php echo $metodo['herramienta']; ?></h3>

                    <div class="method-detail">
                        <strong>Cobertura:</strong> <?php echo $metodo['cobertura']; ?>
                    </div>

                    <div class="method-detail">
                        <strong>Eventos:</strong> <?php echo $metodo['eventos']; ?>
                    </div>

                    <div class="method-detail">
                        <strong>Limitaciones:</strong> <?php echo $metodo['limitaciones']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Embudo de Conversión -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-filter"></i> Embudo de Conversión Completo</h2>

            <?php foreach ($datosModulo['embudo_conversion'] as $stage_key => $stage): ?>
                <div class="funnel-stage <?php echo in_array($stage_key, ['conversion', 'conversion_externa']) ? 'critical' : ''; ?>">
                    <span class="stage-label"><?php echo strtoupper($stage_key); ?></span>
                    <h3><?php echo $stage['fase']; ?></h3>
                    <p><strong>Objetivo:</strong> <?php echo $stage['objetivo']; ?></p>

                    <?php if (isset($stage['microconversiones'])): ?>
                        <h4 class="section-subtitle">Microconversiones a Trackear</h4>
                        <?php foreach ($stage['microconversiones'] as $event_name => $event_data): ?>
                            <div class="event-item priority-<?php echo $event_data['prioridad']; ?>">
                                <div>
                                    <div class="event-name"><?php echo str_replace('_', ' ', ucfirst($event_name)); ?></div>
                                    <div class="event-type">Evento GA4: <code><?php echo $event_data['evento']; ?></code></div>
                                </div>
                                <div>
                                    <?php if ($event_data['automatico']): ?>
                                        <span class="event-badge badge-automatic">Automático</span>
                                    <?php else: ?>
                                        <span class="event-badge badge-gtm">GTM Custom</span>
                                    <?php endif; ?>
                                    <?php if (isset($event_data['ecommerce']) && $event_data['ecommerce']): ?>
                                        <span class="event-badge badge-ecommerce">Ecommerce</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (isset($stage['conversiones'])): ?>
                        <h4 class="section-subtitle">Conversiones Principales</h4>
                        <?php foreach ($stage['conversiones'] as $conv_name => $conv_data): ?>
                            <div class="event-item priority-<?php echo $conv_data['prioridad']; ?>">
                                <div>
                                    <div class="event-name"><?php echo str_replace('_', ' ', ucfirst($conv_name)); ?></div>
                                    <div class="event-type">Evento GA4: <code><?php echo $conv_data['evento']; ?></code> | Valor: <?php echo $conv_data['valor']; ?></div>
                                </div>
                                <div>
                                    <span class="event-badge badge-conversion">CONVERSIÓN</span>
                                    <?php if (isset($conv_data['ecommerce']) && $conv_data['ecommerce']): ?>
                                        <span class="event-badge badge-ecommerce">Ecommerce</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (isset($stage['conversiones_externas'])): ?>
                        <h4 class="section-subtitle">Conversiones Externas (Fuera GA4)</h4>
                        <?php foreach ($stage['conversiones_externas'] as $ext_name => $ext_data): ?>
                            <div class="event-item priority-<?php echo $ext_data['prioridad']; ?>">
                                <div>
                                    <div class="event-name"><?php echo str_replace('_', ' ', ucfirst($ext_name)); ?></div>
                                    <div class="event-type">
                                        Sistema: <strong><?php echo $ext_data['sistema']; ?></strong> |
                                        Método: <strong><?php echo $ext_data['metodo']; ?></strong>
                                    </div>
                                    <div class="event-type">Datos: <?php echo implode(', ', $ext_data['datos']); ?></div>
                                </div>
                                <div>
                                    <span class="event-badge badge-conversion">CONVERSIÓN EXTERNA</span>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="alert-box info" style="margin-top: 15px;">
                            <h4><i class="fas fa-info-circle"></i> Método de Tracking</h4>
                            <p><?php echo $stage['tracking_method']; ?></p>
                        </div>
                    <?php endif; ?>

                    <div style="margin-top: 20px; padding: 15px; background: rgba(255,255,255,0.9); border-radius: 10px;">
                        <strong>Métricas Clave:</strong> <?php echo implode(', ', $stage['metricas']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Eventos GTM Específicos -->
        <div class="content-section">
            <h2 class="section-title"><i class="fab fa-google"></i> Eventos GTM Específicos para Ibiza Villa</h2>
            <p>Configuración detallada de los 28 eventos personalizados en Google Tag Manager:</p>

            <div class="row">
                <?php
                $event_count = 1;
                foreach ($datosModulo['eventos_gtm_ibiza_villa'] as $event_name => $event_data):
                ?>
                    <div class="col-md-6">
                        <div class="gtm-event">
                            <div class="gtm-event-header">
                                <div class="gtm-event-name">
                                    <?php echo $event_count++; ?>. <?php echo str_replace('_', ' ', ucwords($event_name)); ?>
                                </div>
                                <div class="gtm-event-priority <?php echo $event_data['prioridad']; ?>">
                                    <?php echo strtoupper($event_data['prioridad']); ?>
                                </div>
                            </div>

                            <div class="gtm-event-detail">
                                <strong>Trigger:</strong>
                                <div><?php echo $event_data['trigger']; ?></div>
                            </div>

                            <div class="gtm-event-detail">
                                <strong>Variables:</strong>
                                <div><?php echo implode(', ', $event_data['variables']); ?></div>
                            </div>

                            <div class="gtm-event-detail">
                                <strong>Tag GA4:</strong>
                                <code><?php echo $event_data['tag_ga4']; ?></code>
                            </div>

                            <div class="gtm-event-detail">
                                <strong>Parámetros:</strong>
                                <div>
                                    <?php foreach ($event_data['parametros'] as $param_key => $param_value): ?>
                                        <div><code><?php echo $param_key; ?>: <?php echo $param_value; ?></code></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <?php if (isset($event_data['conversion']) && $event_data['conversion']): ?>
                                <div style="margin-top: 10px;">
                                    <span class="event-badge badge-conversion">MARCAR COMO CONVERSIÓN EN GA4</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Integración con Sistemas Externos -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-plug"></i> Integración con Sistemas Externos</h2>
            <p>Cómo trackear conversiones que ocurren fuera de Google Analytics (PMS, CRM, Payment gateways):</p>

            <?php foreach ($datosModulo['integracion_externa'] as $system_key => $system): ?>
                <div class="external-system">
                    <h4><i class="fas fa-server"></i> <?php echo $system['sistema']; ?></h4>

                    <div class="external-event">
                        <strong>Eventos Disponibles:</strong><br>
                        <?php echo implode(', ', $system['eventos_disponibles']); ?>
                    </div>

                    <div class="external-event">
                        <strong>Método de Integración:</strong><br>
                        <?php echo $system['metodo_integracion']; ?>
                    </div>

                    <div class="external-event">
                        <strong>Datos Capturados:</strong><br>
                        <?php echo implode(', ', $system['datos_capturados']); ?>
                    </div>

                    <div class="external-event">
                        <strong>Evento GA4 Resultante:</strong><br>
                        <code style="background: rgba(255,255,255,0.3); padding: 5px 10px; border-radius: 5px;">
                            <?php echo $system['evento_ga4']; ?>
                        </code>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="alert-box info">
                <h4><i class="fas fa-lightbulb"></i> Importancia de Tracking Externo</h4>
                <p>El 80-90% del valor real de conversión ocurre FUERA de Google Analytics (reservas confirmadas, pagos procesados). Sin integración con sistemas externos, no puedes atribuir revenue real a tus canales de marketing.</p>
                <p><strong>Ejemplo:</strong> GA4 te dice "100 formularios enviados", pero sin integración PMS no sabes cuántos se convirtieron en reservas reales ni cuánto revenue generaron. Con integración: "100 formularios → 23 reservas confirmadas → valor total mejora".</p>
            </div>
        </div>

        <!-- Implementación Técnica -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-code"></i> Implementación Técnica</h2>

            <?php foreach ($datosModulo['implementacion_tecnica'] as $phase_key => $phase): ?>
                <div class="implementation-phase">
                    <h4><?php echo str_replace('_', ' ', ucwords($phase_key)); ?></h4>

                    <div style="margin-bottom: 15px;">
                        <span class="time-estimate">
                            <i class="fas fa-clock"></i> <?php echo $phase['tiempo_estimado']; ?>
                        </span>
                        <span class="complexity-badge complexity-<?php echo strtolower(str_replace('-', '', $phase['complejidad'])); ?>">
                            Complejidad: <?php echo $phase['complejidad']; ?>
                        </span>
                    </div>

                    <h5 style="margin-top: 20px; margin-bottom: 15px;">Pasos:</h5>
                    <?php foreach ($phase['pasos'] as $step): ?>
                        <div class="implementation-step"><?php echo $step; ?></div>
                    <?php endforeach; ?>

                    <?php if (isset($phase['ejemplo_codigo'])): ?>
                        <h5 style="margin-top: 25px; margin-bottom: 15px;">Ejemplos de Código:</h5>
                        <?php foreach ($phase['ejemplo_codigo'] as $example_name => $code): ?>
                            <h6 style="margin-top: 15px; color: var(--info-color);">
                                <?php echo str_replace('_', ' ', ucwords($example_name)); ?>:
                            </h6>
                            <div class="code-block"><?php echo htmlspecialchars($code); ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="alert-box success">
                <h4><i class="fas fa-check-circle"></i> Tiempo Total de Implementación</h4>
                <p><strong>200-320 horas (4-6 semanas)</strong></p>
                <p>Desglose:</p>
                <ul>
                    <li>Fase 1 - GTM Setup: 80-120 horas</li>
                    <li>Fase 2 - DataLayer: 40-60 horas</li>
                    <li>Fase 3 - Server-side: 60-100 horas</li>
                    <li>Fase 4 - Dashboards: 20-40 horas</li>
                </ul>
                <p><strong>Resultado:</strong> Sistema de mediciones completo con visibilidad 95-100% del embudo, incluyendo conversiones externas. Inversión única, beneficio perpetuo.</p>
            </div>
        </div>

        <!-- Métricas Principales por Fase -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-chart-pie"></i> Métricas Principales a Trackear</h2>

            <?php foreach ($datosModulo['metricas_principales'] as $phase_name => $metrics): ?>
                <div class="funnel-stage">
                    <h3><?php echo ucfirst($phase_name); ?></h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; margin-top: 15px;">
                        <?php foreach ($metrics as $metric_key => $metric_name): ?>
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid var(--secondary-color);">
                                <div style="font-weight: 700; color: var(--primary-color); margin-bottom: 5px;">
                                    <?php echo ucfirst(str_replace('_', ' ', $metric_key)); ?>
                                </div>
                                <div style="color: #666; font-size: 0.9rem;">
                                    <?php echo $metric_name; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Conclusión -->
        <div class="content-section">
            <h2 class="section-title"><i class="fas fa-trophy"></i> Conclusión y Próximos Pasos</h2>

            <div class="alert-box success">
                <h4><i class="fas fa-bullseye"></i> Beneficio Principal</h4>
                <p><strong>Pasar de 5-10% de visibilidad del embudo a 95-100%</strong></p>
                <p>Con este sistema completo de mediciones puedes:</p>
                <ul>
                    <li>✅ Identificar exactamente dónde pierdes usuarios en el embudo</li>
                    <li>✅ Saber qué canales de marketing generan reservas reales (no solo leads)</li>
                    <li>✅ Cuantificar ROI de cada acción de marketing</li>
                    <li>✅ Optimizar basado en datos, no intuiciones</li>
                    <li>✅ Atribuir valor real a conversiones externas (PMS, CRM, Payments)</li>
                    <li>✅ Tomar decisiones estratégicas con confianza</li>
                </ul>
            </div>

            <div class="alert-box info">
                <h4><i class="fas fa-road"></i> Roadmap de Implementación</h4>
                <ol>
                    <li><strong>Semana 1-2:</strong> Setup GTM, configurar 28 eventos custom, testing</li>
                    <li><strong>Semana 3:</strong> Implementar dataLayer en templates PHP, enhanced ecommerce</li>
                    <li><strong>Semana 4-5:</strong> Server-side GTM, integración webhooks externos (PMS, Stripe, DocuSign)</li>
                    <li><strong>Semana 6:</strong> Dashboards, alertas, documentación, training</li>
                </ol>
                <p><strong>Resultado en 6 semanas:</strong> Visibilidad completa del embudo con conversiones externas trackeadas.</p>
            </div>

            <div class="alert-box">
                <h4><i class="fas fa-exclamation-triangle"></i> Consideraciones Importantes</h4>
                <ul>
                    <li><strong>GDPR/Privacidad:</strong> Asegurar consentimiento usuario antes de tracking. Implementar Cookie Consent Manager.</li>
                    <li><strong>Client ID Preservation:</strong> Para conectar eventos web con conversiones externas, preservar <code>ga_client_id</code> en formularios.</li>
                    <li><strong>Testing:</strong> Siempre probar en GTM Preview mode antes de publicar. Verificar eventos lleguen a GA4.</li>
                    <li><strong>Documentación:</strong> Documentar cada evento, trigger, variable para futuro mantenimiento.</li>
                    <li><strong>Mantenimiento:</strong> Revisar eventos mensualmente, ajustar según cambios en sitio web.</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
