# SISTEMA DE IA LOCAL - GUÍA COMPLETA
## Asistencia Automática con Claude CLI y Gemini CLI

---

## 📋 ¿Qué es?

Un sistema que permite usar **Claude CLI** o **Gemini CLI** directamente desde tu máquina para:
1. Procesar documentos del cliente (PDFs, DOCs, emails, etc.)
2. Generar automáticamente el JSON del Brief
3. Importar los datos directamente al formulario
4. **Todo sin enviar información a terceros** (se ejecuta localmente)

---

## 🚀 Instalación

### Opción 1: Claude CLI (Recomendado)

#### 1.1. Instalar Node.js (si no lo tienes)
```bash
# Descargar desde: https://nodejs.org/
# O con chocolatey en Windows:
choco install nodejs
```

#### 1.2. Instalar Claude CLI
```bash
npm install -g @anthropics/claude-cli
```

#### 1.3. Configurar API Key
```bash
# Obtén tu API key desde: https://console.anthropic.com/account/keys

# En Windows (PowerShell):
[System.Environment]::SetEnvironmentVariable('ANTHROPIC_API_KEY', 'tu-api-key-aqui', 'User')

# En Windows (CMD):
setx ANTHROPIC_API_KEY "tu-api-key-aqui"

# En Linux/Mac:
export ANTHROPIC_API_KEY="tu-api-key-aqui"
# Agregar a ~/.bashrc o ~/.zshrc para que sea permanente
```

#### 1.4. Verificar instalación
```bash
claude --version
```

---

### Opción 2: Gemini CLI

#### 2.1. Instalar Python (si no lo tienes)
```bash
# Descargar desde: https://www.python.org/
```

#### 2.2. Instalar la librería
```bash
pip install google-generativeai
```

#### 2.3. Configurar API Key
```bash
# Obtén tu API key desde: https://makersuite.google.com/app/apikey

# En Windows (PowerShell):
[System.Environment]::SetEnvironmentVariable('GOOGLE_API_KEY', 'tu-api-key-aqui', 'User')

# En Windows (CMD):
setx GOOGLE_API_KEY "tu-api-key-aqui"

# En Linux/Mac:
export GOOGLE_API_KEY="tu-api-key-aqui"
```

#### 2.4. Verificar instalación
```bash
python -c "import google.generativeai as genai; print('OK')"
```

---

## 💡 Cómo Usar

### 1. Desde el Formulario del Brief

1. Ve a una auditoría
2. Abre el paso "Brief Inicial del Cliente"
3. Haz clic en **"Asistencia con Inteligencia Artificial"**
4. Selecciona **"IA Local (Claude)"**
5. Haz clic en **"Buscar Automáticamente"**

### 2. El Sistema Detectará Automáticamente

- Si tienes Claude CLI instalado
- Si tienes Gemini CLI instalado
- Si las API keys están configuradas

### 3. Proporciona Información

Puedes proporcionar la información de **3 formas**:

#### Opción A: Pegar texto
```
Pega emails, conversaciones, notas de reunión, etc.
```

#### Opción B: Subir archivo
```
Formatos soportados: .txt, .doc, .docx, .pdf, .md
```

#### Opción C: Combinación
```
Pegar texto general + subir documento específico
```

### 4. La IA Procesará Automáticamente

- Analizará toda la información
- Extraerá los datos relevantes
- Generará el JSON estructurado
- Te mostrará una vista previa

### 5. Aplicar al Formulario

- Revisa el JSON generado
- Haz clic en **"Aplicar al Formulario"**
- ¡Los datos se mapean automáticamente!

---

## 🔧 Configuración Avanzada

### Variables de Entorno Disponibles

```bash
# Claude
ANTHROPIC_API_KEY=sk-ant-xxxxx
CLAUDE_API_KEY=sk-ant-xxxxx  # Alternativa

# Gemini
GOOGLE_API_KEY=AIzaSyXXXXX
GEMINI_API_KEY=AIzaSyXXXXX  # Alternativa
```

### Archivos de Configuración

El sistema usa estos archivos:
- `api/detectar_cli_ia.php` - Detecta qué CLIs están instaladas
- `api/ejecutar_ia_local.php` - Ejecuta los comandos CLI
- `js/ia_local_integration.js` - Interfaz frontend

### Timeout y Límites

Por defecto:
- **Timeout:** 120 segundos (2 minutos)
- **Max tokens:** 4000
- **Temperature:** 0.1 (precisión máxima)

Puedes modificar estos valores en `api/ejecutar_ia_local.php`:
```php
$maxTokens = $opciones['max_tokens'] ?? 4000;
$temperature = $opciones['temperature'] ?? 0.1;
```

---

## 🛠️ Troubleshooting

### Problema: "No se detectaron CLIs instaladas"

**Solución:**
1. Verifica que el CLI esté instalado: `claude --version` o `gemini --version`
2. Verifica que esté en el PATH del sistema
3. Reinicia el servidor PHP después de instalar

### Problema: "API Key no encontrada"

**Solución:**
1. Verifica que la variable de entorno esté configurada
2. Reinicia tu terminal/PowerShell
3. Reinicia el servidor PHP
4. Verifica con: `echo %ANTHROPIC_API_KEY%` (Windows) o `echo $ANTHROPIC_API_KEY` (Linux/Mac)

### Problema: "Timeout - La IA tardó demasiado"

**Solución:**
1. Reduce la cantidad de texto/documento
2. Aumenta el timeout en `api/ejecutar_ia_local.php`
3. Usa un modelo más rápido (cambia el parámetro `model`)

### Problema: "No se pudo extraer un JSON válido"

**Solución:**
1. La IA a veces incluye explicaciones adicionales
2. El sistema intenta extraer el JSON automáticamente
3. Si falla, copia manualmente el JSON de la respuesta
4. Usa "Importar JSON" directamente

---

## 📊 Comparación Claude vs Gemini

| Característica | Claude CLI | Gemini CLI |
|---|---|---|
| **Calidad** | ⭐⭐⭐⭐⭐ Excelente | ⭐⭐⭐⭐ Muy buena |
| **Velocidad** | ⭐⭐⭐⭐ Rápido | ⭐⭐⭐⭐⭐ Muy rápido |
| **Precio** | $$ Medio | $ Económico |
| **Idiomas** | ⭐⭐⭐⭐⭐ Excelente | ⭐⭐⭐⭐ Muy bueno |
| **Documentos largos** | ⭐⭐⭐⭐⭐ Hasta 200k tokens | ⭐⭐⭐ Limitado |
| **Instalación** | ⭐⭐⭐⭐ Fácil (npm) | ⭐⭐⭐⭐ Fácil (pip) |

**Recomendación:** Usa **Claude** para briefs complejos o documentos largos, y **Gemini** para consultas rápidas.

---

## 🔐 Seguridad y Privacidad

### ✅ Ventajas de IA Local

1. **Los datos no salen de tu máquina** (excepto la API call a Claude/Gemini)
2. **No se almacenan en servidores de terceros**
3. **Control total sobre qué se envía**
4. **No depende de servicios externos** (solo la API)

### ⚠️ Consideraciones

1. Las API calls se envían a Anthropic o Google
2. Anthropic/Google procesan el texto según sus términos
3. No envíes información ultra-confidencial sin revisar
4. Cumple con GDPR/normativa de protección de datos

### 🛡️ Mejores Prácticas

1. **Anonimiza datos sensibles** antes de procesar
2. **Revisa el JSON generado** antes de aplicarlo
3. **No incluyas** contraseñas, API keys del cliente, etc.
4. **Usa Claude** si la privacidad es crítica (mejor política)

---

## 💰 Costos Estimados

### Claude (Anthropic)

- **Modelo:** claude-3-5-sonnet-20241022
- **Costo:** ~$3 por millón de tokens input, $15 por millón output
- **Brief típico:** ~2000 tokens input + 1500 output = **$0.03 por brief**

### Gemini (Google)

- **Modelo:** gemini-pro
- **Costo:** Gratis hasta 60 peticiones/min
- **Tier pagado:** ~$0.50 por millón de tokens
- **Brief típico:** ~$0.002 por brief

---

## 🎯 Casos de Uso

### ✅ Ideal Para:

- Procesar emails largos del cliente
- Extraer info de documentos PDF/Word
- Conversaciones de WhatsApp/Slack
- Notas de reuniones
- Presentaciones del cliente

### ❌ No Recomendado Para:

- Información ultra-confidencial (usa entrada manual)
- Datos médicos/legales sensibles
- Formularios simples (más rápido manual)

---

## 📚 Referencias

- **Claude CLI:** https://docs.anthropic.com/claude/docs/cli
- **Gemini API:** https://ai.google.dev/tutorials/setup
- **Node.js:** https://nodejs.org/
- **Python:** https://www.python.org/

---

## 🆘 Soporte

Si tienes problemas:

1. Revisa los logs en `api/ejecutar_ia_local.php`
2. Verifica las variables de entorno
3. Comprueba que el CLI funciona desde terminal
4. Abre una issue en el repositorio

---

## 🔄 Actualizaciones

**Versión:** 1.0.0
**Fecha:** 30/09/2025
**Estado:** ✅ Funcional y probado

### Próximas Mejoras

- [ ] Soporte para más formatos de documento (Excel, PowerPoint)
- [ ] Cache de respuestas para evitar costos duplicados
- [ ] Modo batch para procesar múltiples briefs
- [ ] Integración con MCP (Model Context Protocol)
- [ ] Soporte para Ollama (100% local, sin API)
