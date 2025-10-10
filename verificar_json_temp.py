import json

try:
    with open('analisis_pdf_auditoria/analisis_estructura.json', 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    print("Total páginas:", data['total_paginas'])
    print("Estructura correcta:", 'paginas' in data)
    print("Primera página campos:", list(data['paginas'][0].keys()))
    print("Campos requeridos presentes:")
    print("- numero:", 'numero' in data['paginas'][0])
    print("- titulo_principal:", 'titulo_principal' in data['paginas'][0])
    print("- fuente_datos:", 'fuente_datos' in data['paginas'][0])
    print("- subtitulos:", 'subtitulos' in data['paginas'][0])
    
    print("\nEjemplo primera página:")
    print("Número:", data['paginas'][0].get('numero'))
    print("Título:", data['paginas'][0].get('titulo_principal'))
    print("Fuentes:", data['paginas'][0].get('fuente_datos'))
    
except Exception as e:
    print("Error:", e)