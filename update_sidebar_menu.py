import json
import os

def actualizar_menu_lateral():
    """Actualiza el menú lateral con las 131 páginas reales del PDF"""
    
    # Cargar datos convertidos
    json_path = "analisis_pdf_auditoria/analisis_estructura.json"
    with open(json_path, 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    # Generar elementos del menú
    menu_items = []
    
    for i, pagina in enumerate(data['paginas']):
        page_id = pagina['id']
        titulo = pagina['titulo']
        
        # Formatear número de página
        if page_id == "portada":
            numero = "0"
            titulo_menu = "Portada"
        elif page_id == "indice":
            numero = "0"
            titulo_menu = "Índice interactivo"
        else:
            numero = str(i - 1)  # Restar 2 por portada e índice, pero i ya empieza en 0
            titulo_menu = titulo
        
        # Crear elemento del menú
        menu_item = f'        <li><a href="#{page_id}">{numero}. {titulo_menu}</a></li>'
        menu_items.append(menu_item)
    
    # Leer el archivo index.html actual
    index_path = "ibiza villa/FASE_5_ENTREGABLES_FINALES/WEB_AUDITORIA/index.html"
    with open(index_path, 'r', encoding='utf-8') as f:
        html_content = f.read()
    
    # Encontrar la sección del menú
    nav_start = html_content.find('<nav class="nav">')
    nav_end = html_content.find('</nav>')
    
    if nav_start != -1 and nav_end != -1:
        # Encontrar el <ul> dentro del nav
        ul_start = html_content.find('<ul>', nav_start)
        ul_end = html_content.find('</ul>', ul_start)
        
        if ul_start != -1 and ul_end != -1:
            # Reemplazar el contenido del <ul>
            new_menu = '<ul>\n' + '\n'.join(menu_items) + '\n      </ul>'
            
            new_html = html_content[:ul_start] + new_menu + html_content[ul_end + 5:]
            
            # Guardar el archivo actualizado
            with open(index_path, 'w', encoding='utf-8') as f:
                f.write(new_html)
            
            print(f"✅ Menú lateral actualizado con {len(menu_items)} páginas")
            print(f"📄 Archivo actualizado: {index_path}")
            
            return len(menu_items)
        else:
            print("❌ Error: No se encontró la estructura <ul> en el menú")
            return 0
    else:
        print("❌ Error: No se encontró la estructura nav en index.html")
        return 0

if __name__ == "__main__":
    actualizar_menu_lateral()