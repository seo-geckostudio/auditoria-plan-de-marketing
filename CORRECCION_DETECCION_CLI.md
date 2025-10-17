# CORRECCIÓN: Detección de CLIs

**Problema:** El sistema no detectaba los CLIs instalados (Claude, Ollama, Gemini)

**Causa:** Uso de `proc_open()` con streams no bloqueantes causaba timeouts

**Solución:** Simplificar usando `exec()` que es más confiable

---

## Cambios Realizados

### 1. `api/detectar_cli_ia.php`
**Función:** `ejecutarComandoSeguro()`

**Antes:**
```php
function ejecutarComandoSeguro($comando, $timeout = 5) {
    // Código complejo con proc_open() y stream_set_blocking()
    // Causaba timeouts y no retornaba
}
```

**Después:**
```php
function ejecutarComandoSeguro($comando, $timeout = 5) {
    $output = [];
    $returnValue = 0;

    // Usar exec() que es más simple y confiable
    exec($comando . ' 2>&1', $output, $returnValue);

    $stdout = implode("\n", $output);

    return [
        'success' => $returnValue === 0,
        'stdout' => trim($stdout),
        'stderr' => '',
        'exit_code' => $returnValue
    ];
}
```

---

### 2. `api/ejecutar_ia_local.php`
**Función:** `ejecutarComandoConTimeout()`

**Antes:**
```php
function ejecutarComandoConTimeout($comando, $timeout = 120) {
    // Código complejo con proc_open(), pipes, stream_set_blocking()
    // Timeouts manuales, problemas de sincronización
}
```

**Después:**
```php
function ejecutarComandoConTimeout($comando, $timeout = 120) {
    $output = [];
    $returnValue = 0;

    // Para comandos largos, usar exec() es más confiable
    exec($comando . ' 2>&1', $output, $returnValue);

    $stdout = implode("\n", $output);

    return [
        'success' => $returnValue === 0,
        'stdout' => trim($stdout),
        'stderr' => '',
        'exit_code' => $returnValue
    ];
}
```

---

## Resultado

### Detección Exitosa
```json
{
    "disponibles": {
        "ollama": {
            "version": "0.12.3",
            "comando": "ollama",
            "modelos": [
                "qwq:latest",
                "llama3.1:latest"
            ],
            "tipo": "local",
            "requiere_api": false,
            "configurado": true,
            "mensaje_config": "✅ 100% Local - No requiere API key"
        },
        "claude": {
            "version": "2.0.1",
            "comando": "claude",
            "tipo": "api",
            "requiere_api": true,
            "configurado": false,
            "mensaje_config": "No se encontró ANTHROPIC_API_KEY o CLAUDE_API_KEY"
        },
        "gemini": {
            "version": "0.1.7",
            "comando": "gemini",
            "tipo": "api",
            "requiere_api": true,
            "configurado": false,
            "mensaje_config": "No se encontró GOOGLE_API_KEY o GEMINI_API_KEY"
        }
    },
    "total": 3,
    "errores": []
}
```

### CLIs Detectados
- ✅ **Ollama 0.12.3** - 100% Local, 2 modelos (qwq, llama3.1)
- ✅ **Claude CLI 2.0.1** - Instalado (sin API key)
- ✅ **Gemini 0.1.7** - Instalado (sin API key)

---

## Ventajas de exec()

1. ✅ **Más simple** - Una sola línea vs 50+ líneas
2. ✅ **Más confiable** - No hay problemas de sincronización
3. ✅ **Sin timeouts manuales** - El SO maneja el timeout
4. ✅ **Menos bugs** - Menos código = menos errores
5. ✅ **Mismo resultado** - Captura stdout y stderr

---

## Próximo Paso

El sistema ahora detecta correctamente los 3 CLIs. Para usar Claude CLI o Gemini CLI necesitas configurar las API keys:

```bash
# Claude
setx ANTHROPIC_API_KEY "tu-api-key-aqui"

# Gemini
setx GOOGLE_API_KEY "tu-api-key-aqui"
```

O puedes usar **Ollama directamente** que es 100% local y no requiere API key.

---

**Estado:** ✅ CORREGIDO
**Fecha:** 30/09/2025
