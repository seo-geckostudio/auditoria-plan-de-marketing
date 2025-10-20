#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para expandir las personas 2 y 3 con toda la información detallada
como la persona 1 (Marco)
"""

import json
import sys

# Configurar encoding para Windows
sys.stdout.reconfigure(encoding='utf-8')

# Leer el JSON actual
with open('data/fase0/buyer_personas.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

# Página 3: Sofia - Madre Organizadora (detallada completa)
data['paginas'][2] = {
    "id": "pagina-003",
    "numero": 3,
    "titulo": "Persona 2: Sofia - La Madre Organizadora Familiar",
    "subtitulo": "50% del tráfico objetivo | Revenue: €800-2,000 por booking",
    "contenido": {
        "tipo": "buyer_persona_seo",
        "datos": {
            "persona": {
                "nombre": "Sofia Martinez",
                "foto_emoji": "👩‍👧‍👦",
                "edad": "42 años",
                "ubicacion": "Madrid, España",
                "ocupacion": "Directora RRHH",
                "ingresos_anuales": "€95,000",
                "estado_civil": "Casada, 2 hijos (8 y 11 años)"
            },
            "keywords_por_intencion": [
                {
                    "tipo_intencion": "Informacional",
                    "keywords_principales": [
                        "villas ibiza seguras para niños",
                        "mejores villas familiares ibiza"
                    ],
                    "volumen_mes": 890,
                    "momento_journey": "Awareness",
                    "prioridad_seo": "Alta"
                },
                {
                    "tipo_intencion": "Navegacional",
                    "keywords_principales": [
                        "villa ibiza piscina vallada",
                        "villa familiar ibiza equipamiento niños"
                    ],
                    "volumen_mes": 720,
                    "momento_journey": "Consideration",
                    "prioridad_seo": "Alta"
                },
                {
                    "tipo_intencion": "Comercial",
                    "keywords_principales": [
                        "precio villa familiar ibiza",
                        "comparar villas niños ibiza"
                    ],
                    "volumen_mes": 560,
                    "momento_journey": "Consideration",
                    "prioridad_seo": "Media"
                },
                {
                    "tipo_intencion": "Transaccional",
                    "keywords_principales": [
                        "reservar villa familiar ibiza",
                        "alquiler villa niños ibiza verano"
                    ],
                    "volumen_mes": 940,
                    "momento_journey": "Decision",
                    "prioridad_seo": "Alta"
                }
            ],
            "keywords_longtail": [
                "villa ibiza con equipamiento completo para bebes y niños",
                "family villa ibiza safe pool fenced garden",
                "villa familiar ibiza actividades niños incluidas"
            ],
            "customer_journey": {
                "awareness": {
                    "busca": [
                        "mejores destinos vacaciones familia mediterráneo",
                        "ibiza vs mallorca familias niños"
                    ],
                    "necesita_contenido": [
                        "Guías destinos familiares",
                        "Blog actividades niños"
                    ],
                    "tiempo_fase": "4-6 meses antes del viaje"
                },
                "consideration": {
                    "busca": [
                        "villa ibiza 6-8 personas con niños",
                        "equipamiento infantil incluido"
                    ],
                    "necesita_contenido": [
                        "Fichas villas family-friendly",
                        "Fotos seguridad piscinas"
                    ],
                    "tiempo_fase": "2-3 meses antes"
                },
                "decision": {
                    "busca": [
                        "disponibilidad villa familiar [fechas]",
                        "política cancelación familias"
                    ],
                    "necesita_contenido": [
                        "Calendario disponibilidad",
                        "Garantías seguridad niños"
                    ],
                    "tiempo_fase": "4-6 semanas antes"
                }
            },
            "preguntas_frecuentes": [
                {
                    "pregunta": "¿Qué villas de Ibiza son más seguras para niños pequeños?",
                    "volumen_mes": 420,
                    "oportunidad_featured_snippet": "Lista con checklist seguridad"
                },
                {
                    "pregunta": "¿Incluye equipamiento infantil el alquiler de villa en Ibiza?",
                    "volumen_mes": 310,
                    "oportunidad_featured_snippet": "Tabla equipamiento por edad"
                },
                {
                    "pregunta": "¿Cuánto cuesta alquilar villa familiar en Ibiza en agosto?",
                    "volumen_mes": 380,
                    "oportunidad_featured_snippet": "Rango precios + factores"
                }
            ],
            "demografia": {
                "edad": "35-48 años",
                "ubicacion": "Madrid, Barcelona, Valencia, grandes ciudades España",
                "ingresos_anuales": "€60K-120K (hogar combinado)",
                "educacion": "Universitaria",
                "estado_civil": "Casada/pareja con hijos (6-14 años)",
                "tamaño_grupo": "4-8 personas (familia + abuelos)"
            },
            "psicografia": {
                "valores": [
                    "Seguridad y bienestar familiar",
                    "Calidad tiempo en familia",
                    "Educación experiencial para hijos",
                    "Equilibrio trabajo-vida personal"
                ],
                "estilo_vida": [
                    "Vacaciones familiares 2-3 veces al año",
                    "Actividades culturales y educativas con niños",
                    "Rutinas saludables y ejercicio moderado",
                    "Planificación detallada de viajes"
                ],
                "intereses": [
                    "Actividades acuáticas familiares",
                    "Gastronomía saludable mediterránea",
                    "Fotografía familiar y recuerdos",
                    "Naturaleza y playas tranquilas"
                ]
            },
            "comportamiento_compra": {
                "frecuencia_compra": "1-2 veces al año",
                "presupuesto_promedio": "€800-2,000 por semana",
                "proceso_decision": "Investiga exhaustivamente (4-6 semanas), lee reviews familias, consulta pareja",
                "influenciadores": "Reviews de otras familias, blogs maternidad, recomendaciones amigas"
            },
            "pain_points": [
                "Seguridad de los niños (piscinas, escaleras, balcones)",
                "Necesidad de equipamiento infantil (cunas, tronas, etc.)",
                "Presupuesto limitado con familia numerosa",
                "Temor a que niños se aburran o no haya actividades",
                "Logística compleja con niños pequeños"
            ],
            "goals": [
                "Tiempo de calidad en familia sin estrés",
                "Experiencia educativa y divertida para niños",
                "Descanso real y desconexión",
                "Crear recuerdos familiares duraderos"
            ],
            "mensajes_clave": [
                "Villas 100% seguras certificadas para niños",
                "Equipamiento infantil completo incluido sin coste extra",
                "Actividades familiares personalizadas por edad",
                "Presupuesto transparente con todo incluido"
            ],
            "keywords_interes": [
                "villa ibiza segura niños",
                "alquiler villa familiar piscina vallada",
                "villa ibiza equipamiento infantil incluido",
                "reservar villa familia ibiza",
                "villa ibiza actividades niños"
            ],
            "comportamiento_redes": {
                "plataformas_activas": [
                    {
                        "plataforma": "Instagram",
                        "nivel": "Medio",
                        "uso": "Inspiración viajes familia, recuerdos"
                    },
                    {
                        "plataforma": "Facebook",
                        "nivel": "Alto",
                        "uso": "Grupos maternidad, recomendaciones"
                    },
                    {
                        "plataforma": "Pinterest",
                        "nivel": "Alto",
                        "uso": "Ideas actividades niños, planificación"
                    }
                ],
                "horarios_activos": [
                    "7-9AM",
                    "9-11PM"
                ],
                "dispositivo_preferido": "Mobile durante día, Tablet por noche"
            },
            "canales_comunicacion": [
                {
                    "canal": "Email",
                    "uso": "Información detallada",
                    "expectativa_respuesta": "<48 horas"
                },
                {
                    "canal": "WhatsApp",
                    "uso": "Consultas rápidas",
                    "expectativa_respuesta": "Mismo día"
                }
            ],
            "motivadores_compra": [
                "Seguridad garantizada - Certificaciones y fotos detalladas",
                "Todo incluido - Sin sorpresas ni costes ocultos",
                "Familia-friendly - Testimoniales otras familias"
            ],
            "objeciones_principales": [
                "Precio para familia - Mostrar valor incluido",
                "Seguridad real - Videos y certificados",
                "Equipamiento suficiente - Lista detallada por edad"
            ]
        }
    }
}

# Insertar nueva Página 4: James - Británico Celebrante (detallada completa)
nueva_pagina_james = {
    "id": "pagina-004",
    "numero": 4,
    "titulo": "Persona 3: James - El Británico Celebrante",
    "subtitulo": "25% del tráfico objetivo | Revenue: €600-1,500 por persona",
    "contenido": {
        "tipo": "buyer_persona_seo",
        "datos": {
            "persona": {
                "nombre": "James Thompson",
                "foto_emoji": "🎉",
                "edad": "29 años",
                "ubicacion": "Manchester, UK",
                "ocupacion": "Account Manager",
                "ingresos_anuales": "£45,000",
                "estado_civil": "Soltero"
            },
            "keywords_por_intencion": [
                {
                    "tipo_intencion": "Informacional",
                    "keywords_principales": [
                        "best party villas ibiza",
                        "ibiza stag do villas"
                    ],
                    "volumen_mes": 1100,
                    "momento_journey": "Awareness",
                    "prioridad_seo": "Alta"
                },
                {
                    "tipo_intencion": "Navegacional",
                    "keywords_principales": [
                        "villa ibiza near clubs",
                        "party villa ibiza walking distance"
                    ],
                    "volumen_mes": 850,
                    "momento_journey": "Consideration",
                    "prioridad_seo": "Alta"
                },
                {
                    "tipo_intencion": "Comercial",
                    "keywords_principales": [
                        "villa ibiza group price",
                        "compare party villas ibiza"
                    ],
                    "volumen_mes": 620,
                    "momento_journey": "Consideration",
                    "prioridad_seo": "Media"
                },
                {
                    "tipo_intencion": "Transaccional",
                    "keywords_principales": [
                        "book villa ibiza group",
                        "rent party villa ibiza"
                    ],
                    "volumen_mes": 780,
                    "momento_journey": "Decision",
                    "prioridad_seo": "Alta"
                }
            ],
            "keywords_longtail": [
                "villa ibiza stag party near pacha and ushuaia",
                "party villa ibiza with sound system and pool",
                "villa ibiza split payment group booking"
            ],
            "customer_journey": {
                "awareness": {
                    "busca": [
                        "best destinations stag do europe",
                        "ibiza vs magaluf party"
                    ],
                    "necesita_contenido": [
                        "Guías destinos party",
                        "Comparativas clubs"
                    ],
                    "tiempo_fase": "2-4 meses antes"
                },
                "consideration": {
                    "busca": [
                        "villa ibiza 10-12 people party",
                        "location near clubs ibiza"
                    ],
                    "necesita_contenido": [
                        "Mapas distancias clubs",
                        "Videos villas party"
                    ],
                    "tiempo_fase": "1-2 meses antes"
                },
                "decision": {
                    "busca": [
                        "availability villa ibiza [dates]",
                        "split payment options"
                    ],
                    "necesita_contenido": [
                        "Booking fácil",
                        "Opciones pago grupo"
                    ],
                    "tiempo_fase": "1-3 semanas antes"
                }
            },
            "preguntas_frecuentes": [
                {
                    "pregunta": "What are the best party villas near Ibiza clubs?",
                    "volumen_mes": 520,
                    "oportunidad_featured_snippet": "Map with distances to clubs"
                },
                {
                    "pregunta": "Can we split payment for group villa booking in Ibiza?",
                    "volumen_mes": 340,
                    "oportunidad_featured_snippet": "Payment options table"
                },
                {
                    "pregunta": "What noise rules apply to villa rentals in Ibiza?",
                    "volumen_mes": 280,
                    "oportunidad_featured_snippet": "Rules summary + tips"
                }
            ],
            "demografia": {
                "edad": "25-35 años",
                "ubicacion": "UK (Manchester, London, Birmingham), Irlanda",
                "ingresos_anuales": "£30K-60K",
                "educacion": "Universitaria o formación profesional",
                "estado_civil": "Soltero o pareja sin hijos",
                "tamaño_grupo": "8-14 amigos"
            },
            "psicografia": {
                "valores": [
                    "Diversión y experiencias memorables",
                    "Estatus social y reconocimiento grupo",
                    "Libertad y ausencia de responsabilidades",
                    "Lealtad al grupo de amigos"
                ],
                "estilo_vida": [
                    "Viajes de fiesta 2-3 veces al año",
                    "Clubbing regular fines de semana",
                    "Deportes en equipo y competición",
                    "Uso intensivo redes sociales"
                ],
                "intereses": [
                    "Música electrónica y DJ sets",
                    "Deportes acuáticos extremos",
                    "Fotografía y contenido viral",
                    "Gastronomía casual y BBQ"
                ]
            },
            "comportamiento_compra": {
                "frecuencia_compra": "2-3 veces al año",
                "presupuesto_promedio": "€600-1,500 por persona",
                "proceso_decision": "Rápida 1-2 semanas, muy influenciado por precio y ubicación clubs",
                "influenciadores": "Amigos que han ido, influencers party, Instagram de clubs"
            },
            "pain_points": [
                "Coordinación de pago entre 10+ personas",
                "Encontrar ubicación walking distance a clubs",
                "Restricciones y multas por ruido",
                "Balance precio-calidad con presupuesto ajustado",
                "Comunicación lenta con propietarios"
            ],
            "goals": [
                "Celebración épica que el grupo recuerde siempre",
                "Impresionar al grupo con buena organización",
                "Maximizar tiempo de fiesta minimizando desplazamientos",
                "Contenido viral para Instagram y redes sociales"
            ],
            "mensajes_clave": [
                "Villas party-friendly con políticas claras sin sorpresas",
                "Walking distance a Pacha, Ushuaia y principales clubs",
                "Pago fraccionado fácil para grupos grandes",
                "Sound system profesional y BBQ área exterior incluidos"
            ],
            "keywords_interes": [
                "villa ibiza party near clubs",
                "stag do villa ibiza",
                "group villa ibiza split payment",
                "villa ibiza sound system pool",
                "book party villa ibiza"
            ],
            "comportamiento_redes": {
                "plataformas_activas": [
                    {
                        "plataforma": "Instagram",
                        "nivel": "Muy Alto",
                        "uso": "Contenido party, stories daily, influencers clubs"
                    },
                    {
                        "plataforma": "Facebook",
                        "nivel": "Medio",
                        "uso": "Grupos stag do, eventos"
                    },
                    {
                        "plataforma": "TikTok",
                        "nivel": "Alto",
                        "uso": "Videos party, trends, club content"
                    }
                ],
                "horarios_activos": [
                    "12-2PM",
                    "6PM-1AM"
                ],
                "dispositivo_preferido": "Mobile 95% del tiempo"
            },
            "canales_comunicacion": [
                {
                    "canal": "WhatsApp",
                    "uso": "Todo",
                    "expectativa_respuesta": "Inmediata (<2 horas)"
                },
                {
                    "canal": "Instagram DM",
                    "uso": "Consultas iniciales",
                    "expectativa_respuesta": "<24 horas"
                }
            ],
            "motivadores_compra": [
                "Ubicación clubs - Mapa distancias exactas",
                "Precio competitivo - Comparativa transparente",
                "Pago fácil - Split payment sin complicaciones"
            ],
            "objeciones_principales": [
                "Precio alto grupo - Mostrar coste por persona",
                "Restricciones ruido - Políticas claras y realistas",
                "Desconfianza pago adelantado - Garantías y reviews"
            ]
        }
    }
}

# Añadir la nueva página 4
data['paginas'].append(nueva_pagina_james)

# Guardar el JSON actualizado
with open('data/fase0/buyer_personas.json', 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

print('OK: JSON expandido con personas 2 y 3 detalladas')
print('- Pagina 3: Sofia con formato completo (psicografia, comportamiento, etc.)')
print('- Pagina 4: James con formato completo (psicografia, comportamiento, etc.)')
