# Screenshots de la Auditoría

Esta carpeta contiene las capturas de pantalla utilizadas en la auditoría.

## Instrucciones para capturar screenshots

### Método 1: Manual (Navegador)

1. Abre el sitio web en el navegador (tamaño ventana: 1440x900px)
2. Presiona F12 para abrir DevTools
3. Click en el icono de dispositivo móvil (responsive mode)
4. Configura: 1440 x 900
5. Captura: Ctrl+Shift+P → "Capture screenshot"
6. Guarda como: `ibizavilla_home.jpg`

### Método 2: Automático (Chrome DevTools Protocol)

```bash
# Usando Puppeteer o similar
node capture_screenshot.js
```

### Método 3: Herramienta Online

Usa: https://www.screenshotmachine.com/
- URL: https://ibizavilla.com
- Dimensiones: 1440 x 900
- Formato: JPG
- Descargar y guardar como: `ibizavilla_home.jpg`

## Screenshots Necesarios

- [X] `ibizavilla_home.jpg` - Página principal (1440x900)
- [ ] `ibizavilla_property.jpg` - Página de propiedad (opcional)
- [ ] `ibizavilla_mobile.jpg` - Vista mobile (opcional)

## Ubicación en JSON

El path se configura en:
```
data/seccion_01_situacion_actual.json
→ paginas[0].contenido.datos.screenshot
```

## Formato Recomendado

- **Dimensiones**: 1440 x 900 px (16:10 ratio)
- **Formato**: JPG
- **Calidad**: 85-90%
- **Peso máximo**: 500 KB

## Notas

- Si no hay screenshot, se muestra un placeholder automático
- El sistema soporta JPG, PNG y WebP
- Las rutas son relativas a la carpeta `WEB_AUDITORIA/`
