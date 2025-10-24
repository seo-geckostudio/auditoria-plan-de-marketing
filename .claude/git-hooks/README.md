# Git Hooks - Installation Guide

**Descripción:** Git hooks automáticos para mantener calidad de código

---

## 📋 Hooks Disponibles

1. **pre-commit** - Validación antes de commit
2. **commit-msg** - Validación de mensaje de commit
3. **pre-push** - Tests antes de push

---

## 🚀 Instalación

### Opción 1: Instalación Manual

```bash
# Copiar hooks a .git/hooks/
cp .claude/git-hooks/pre-commit .git/hooks/pre-commit
cp .claude/git-hooks/commit-msg .git/hooks/commit-msg
cp .claude/git-hooks/pre-push .git/hooks/pre-push

# Dar permisos de ejecución (Unix/Mac)
chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/commit-msg
chmod +x .git/hooks/pre-push
```

### Opción 2: Script de Instalación

```bash
# Ejecutar script de instalación
bash .claude/git-hooks/install.sh
```

### Opción 3: Composer Script (Recomendado)

Añadir a `composer.json`:

```json
{
  "scripts": {
    "post-install-cmd": [
      "bash .claude/git-hooks/install.sh"
    ],
    "post-update-cmd": [
      "bash .claude/git-hooks/install.sh"
    ]
  }
}
```

Entonces:
```bash
composer install
# Hooks se instalan automáticamente
```

---

## 🔍 Qué Hace Cada Hook

### pre-commit

Ejecuta antes de crear el commit. Verifica:

1. ✅ **PHP Lint** - Sintaxis PHP válida
2. ✅ **PSR-12** - Estilo de código consistente
3. ✅ **PHPStan** - Análisis estático (nivel 8)
4. ✅ **Debug code** - Sin var_dump, dd, console.log
5. ✅ **Secrets** - No commitear .env, .key, credentials
6. ✅ **TODO comments** - Advertencia si hay TODOs

**Si falla:** El commit se cancela. Debes corregir los errores.

**Bypass (NO recomendado):**
```bash
git commit --no-verify -m "mensaje"
```

### commit-msg

Valida el mensaje del commit. Requiere formato:

```
tipo: descripción breve

Descripción detallada opcional

Refs: #123
```

**Tipos válidos:**
- `feat`: Nueva funcionalidad
- `fix`: Corrección de bug
- `docs`: Cambios en documentación
- `style`: Cambios de formato (no afectan código)
- `refactor`: Refactorización de código
- `test`: Añadir o modificar tests
- `chore`: Tareas de mantenimiento

**Ejemplos válidos:**
```bash
git commit -m "feat: añadir autenticación con OAuth 2.0"
git commit -m "fix: corregir SQL injection en ClienteService"
git commit -m "docs: actualizar README con instrucciones de deploy"
```

**Ejemplos inválidos:**
```bash
git commit -m "cambios"              # Tipo faltante
git commit -m "feature: nueva cosa"  # Tipo incorrecto (usar 'feat')
git commit -m "fix"                  # Descripción faltante
```

### pre-push

Ejecuta antes de hacer push. Verifica:

1. ✅ **All tests** - PHPUnit completo
2. ✅ **Coverage** - Mínimo 70% coverage
3. ✅ **Security audit** - composer audit
4. ✅ **No .only tests** - Sin tests .only() olvidados

**Si falla:** El push se cancela. Debes corregir.

**Bypass (NO recomendado):**
```bash
git push --no-verify
```

---

## ⚙️ Configuración

### Variables de Entorno

Crear archivo `.git/hooks/.env` (opcional):

```bash
# Nivel de verificación
HOOK_LEVEL=strict  # strict, normal, loose

# Requerir tests en pre-push
REQUIRE_TESTS=true

# Mínimo coverage requerido
MIN_COVERAGE=70

# Ejecutar PHPStan
RUN_PHPSTAN=true
PHPSTAN_LEVEL=8

# Ejecutar PHP_CodeSniffer
RUN_PHPCS=true
```

### Desactivar Hooks Temporalmente

```bash
# Desactivar un hook específico
mv .git/hooks/pre-commit .git/hooks/pre-commit.disabled

# Reactivar
mv .git/hooks/pre-commit.disabled .git/hooks/pre-commit
```

### Desactivar Todos los Hooks

```bash
# Crear archivo .git/hooks/disabled
touch .git/hooks/disabled

# Los hooks verifican este archivo y se saltan si existe
```

---

## 🛠️ Troubleshooting

### Hook no se ejecuta

**Problema:** Git no ejecuta el hook

**Solución:**
```bash
# Verificar permisos (Unix/Mac)
ls -la .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit

# Verificar que no tiene extensión .sample
mv .git/hooks/pre-commit.sample .git/hooks/pre-commit
```

### Composer commands not found

**Problema:** `vendor/bin/phpcs` no encontrado

**Solución:**
```bash
# Instalar dependencias de desarrollo
composer install

# Verificar vendor/bin existe
ls vendor/bin/
```

### Hook muy lento

**Problema:** Hook tarda mucho en ejecutar

**Solución:**
```bash
# Reducir verificaciones en .git/hooks/.env
echo "HOOK_LEVEL=loose" > .git/hooks/.env
echo "RUN_PHPSTAN=false" >> .git/hooks/.env

# O usar bypass ocasionalmente
git commit --no-verify -m "wip: trabajo en progreso"
```

### Tests fallan en hook pero pasan manualmente

**Problema:** Tests pasan con `vendor/bin/phpunit` pero fallan en hook

**Solución:**
```bash
# Verificar variables de entorno
# Hook usa .env.testing, manual usa .env

# Copiar .env a .env.testing
cp .env .env.testing

# O especificar en hook
export APP_ENV=testing
```

---

## 📝 Customización

### Añadir Verificaciones Personalizadas

Editar `.claude/git-hooks/pre-commit` y añadir:

```bash
# Custom check: Verificar que no hay console.log en PHP
echo "X. Checking console.log in PHP..."
git diff --cached --name-only --diff-filter=ACM | grep '\.php$' | while read file; do
    if grep -n "console\.log" "$file"; then
        echo "❌ Found console.log in PHP file: $file"
        exit 1
    fi
done
```

### Hook Para Equipo Completo

Commitear los hooks al repositorio:

```bash
# Hooks ya están en .claude/git-hooks/
git add .claude/git-hooks/
git commit -m "chore: añadir git hooks para calidad"
git push

# Cada desarrollador ejecuta
composer install  # Si configurado en composer.json
# O
bash .claude/git-hooks/install.sh
```

---

## 🚫 Cuando NO Usar --no-verify

**❌ NUNCA:**
- Para saltarse tests que fallan
- Para commitear código con errores
- Para pushear sin verificar seguridad

**✅ OK para:**
- WIP commits en branch personal
- Commits de documentación simple
- Revert commits urgentes
- Cuando el hook tiene un bug

---

## 🔄 Actualizar Hooks

```bash
# Pull últimos cambios
git pull

# Reinstalar hooks
bash .claude/git-hooks/install.sh

# Verificar versión
cat .git/hooks/pre-commit | head -n 5
```

---

## 📊 Estadísticas de Hooks

Ver cuántas veces se han ejecutado:

```bash
# Añadir a cada hook al final
echo "$(date): Hook ejecutado" >> .git/hooks/stats.log

# Ver stats
cat .git/hooks/stats.log | wc -l
```

---

## 💡 Tips

1. **Commits frecuentes:** Hooks rápidos con cambios pequeños
2. **Tests locales:** Ejecuta tests antes del commit, no esperes al hook
3. **Auto-fix:** Usa `composer fix` para auto-corregir estilo
4. **Comunicación:** Si desactivas hooks, avisa al equipo

---

**Los hooks mantienen la calidad del código automáticamente, ahorrando tiempo en code reviews!**
