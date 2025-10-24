# Quality Checklist - Pre-Commit & Deployment

**Descripción:** Checklist completo de calidad para asegurar código production-ready

---

## 📋 Índice

1. [Pre-Commit Checklist](#pre-commit-checklist)
2. [Pre-Deploy Checklist](#pre-deploy-checklist)
3. [Security Audit Checklist](#security-audit-checklist)
4. [Performance Checklist](#performance-checklist)
5. [Automated Checks](#automated-checks)

---

## Pre-Commit Checklist

### ✅ Código y Estilo

- [ ] **PSR-12 compliance**
  - Indentación de 4 espacios
  - Apertura de llaves en misma línea para métodos
  - Líneas máximo 120 caracteres
  - Sin espacios en blanco al final de línea

- [ ] **PHP 8.1+ features**
  - Propiedades tipadas en todas las clases
  - Constructor property promotion donde sea posible
  - Enums en lugar de constantes de clase
  - Match expressions en lugar de switch cuando sea apropiado
  - Named arguments en funciones complejas

- [ ] **Type hints**
  - Todos los parámetros tienen tipo
  - Todos los métodos tienen return type
  - Nullable types con `?` cuando sea necesario
  - Union types cuando tenga sentido

- [ ] **Naming conventions**
  - Clases en PascalCase
  - Métodos y variables en camelCase
  - Constantes en UPPER_SNAKE_CASE
  - Nombres descriptivos, no abreviaturas

### ✅ Documentación

- [ ] **PHPDoc en todas las clases**
  ```php
  /**
   * Descripción breve de la clase
   *
   * Descripción detallada si es necesario
   *
   * @package App\Modules\{Module}
   */
  ```

- [ ] **PHPDoc en métodos públicos**
  ```php
  /**
   * Descripción del método
   *
   * @param int $id ID del recurso
   * @param array $datos Datos a actualizar
   * @return bool True si se actualizó correctamente
   * @throws NotFoundException Si no existe el recurso
   * @throws ValidationException Si datos inválidos
   */
  ```

- [ ] **ABOUTME.md actualizado**
  - Propósito del módulo
  - Dependencias
  - Ejemplos de uso
  - API pública

- [ ] **README.md actualizado** (si aplica)
  - Cambios en instalación
  - Nuevas dependencias
  - Breaking changes

### ✅ Seguridad

- [ ] **SQL Injection prevention**
  - Todas las queries usan prepared statements
  - Ninguna concatenación de input en SQL
  - Validación de tipos en parámetros

- [ ] **XSS prevention**
  - Output escapado con `htmlspecialchars()`
  - Atributo `ENT_QUOTES` en escapes
  - Content Security Policy headers configurados

- [ ] **CSRF protection**
  - Tokens CSRF en todos los formularios
  - Verificación de tokens en POST/PUT/DELETE
  - Tokens únicos por sesión

- [ ] **Input validation**
  - Validación en backend (nunca solo frontend)
  - Whitelist de valores permitidos
  - Sanitización de input antes de uso

- [ ] **Authentication/Authorization**
  - Verificación de autenticación en rutas protegidas
  - Verificación de permisos antes de acciones
  - Sesiones con timeout configurado
  - Logout destruye sesión completamente

- [ ] **Secrets management**
  - Credenciales en `.env`, nunca en código
  - `.env` en `.gitignore`
  - Verificación de que no se commitean secrets

### ✅ Testing

- [ ] **Unit tests**
  - Al menos 80% coverage en Services
  - Tests para casos happy path
  - Tests para casos edge cases
  - Tests para manejo de errores

- [ ] **Integration tests** (si aplica)
  - Tests de flujos completos
  - Tests de integración con APIs
  - Tests de transacciones de base de datos

- [ ] **Tests pasan**
  ```bash
  vendor/bin/phpunit
  # O
  /run-tests
  ```

- [ ] **Fixtures y mocks**
  - No se usan datos reales en tests
  - Mocks para APIs externas
  - Database transactions en tests

### ✅ Base de Datos

- [ ] **Migrations**
  - Migration creada para cambios de schema
  - Migration tiene `up()` y `down()`
  - Tested migration en local

- [ ] **Indexes**
  - Índices en foreign keys
  - Índices en campos de búsqueda frecuente
  - Índices compuestos donde sean necesarios

- [ ] **Soft deletes**
  - `deleted_at` campo presente
  - Queries filtran por `deleted_at IS NULL`
  - Restauración implementada si es necesario

- [ ] **Timestamps**
  - `created_at` y `updated_at` presentes
  - `updated_at` se actualiza automáticamente

### ✅ Performance

- [ ] **N+1 queries**
  - No hay N+1 problems identificados
  - Eager loading donde sea necesario
  - Queries optimizadas

- [ ] **Caching**
  - Datos frecuentes están cacheados
  - Cache invalidation implementado
  - TTL configurado apropiadamente

- [ ] **Queries complejas**
  - Queries lentas optimizadas
  - EXPLAIN ejecutado para queries pesadas
  - Paginación implementada en listados

- [ ] **Memory usage**
  - No se cargan grandes datasets sin límite
  - Streaming para archivos grandes
  - Límites configurados

### ✅ Error Handling

- [ ] **Try-catch blocks**
  - Operaciones riesgosas en try-catch
  - Catch de excepciones específicas
  - No se captura `\Exception` genérica sin re-throw

- [ ] **Custom exceptions**
  - Excepciones específicas usadas
  - Mensajes de error descriptivos
  - Códigos de error consistentes

- [ ] **Logging**
  - Errores se logean apropiadamente
  - Logs incluyen contexto (user, action, etc.)
  - Información sensible no en logs

- [ ] **User feedback**
  - Mensajes amigables al usuario
  - Detalles técnicos solo en dev
  - Instrucciones de recuperación cuando sea posible

### ✅ Code Quality

- [ ] **DRY principle**
  - Sin código duplicado
  - Lógica común extraída a funciones/clases
  - Constantes usadas para valores repetidos

- [ ] **SOLID principles**
  - Single Responsibility: clases con un propósito
  - Open/Closed: extensible sin modificar
  - Liskov Substitution: herencia correcta
  - Interface Segregation: interfaces específicas
  - Dependency Injection: dependencias inyectadas

- [ ] **Complexity**
  - Métodos con complejidad ciclomática < 10
  - Funciones < 50 líneas generalmente
  - Nesting depth < 4 niveles

- [ ] **Dead code**
  - Código comentado eliminado
  - Imports no usados eliminados
  - Funciones no usadas eliminadas

### ✅ Git

- [ ] **Commit message**
  - Formato: `tipo: descripción breve`
  - Tipos: feat, fix, docs, refactor, test, chore
  - Descripción clara y concisa
  - Referencia a issue si aplica

- [ ] **Branch strategy**
  - Feature branch desde develop
  - Nombre descriptivo: `feature/nombre-funcionalidad`
  - Branch actualizado con develop

- [ ] **Conflicts resolved**
  - Sin conflictos de merge
  - Cambios revisados tras resolver conflictos
  - Tests pasan tras merge

---

## Pre-Deploy Checklist

### 🚀 Preparación

- [ ] **Environment**
  - `.env` configurado para producción
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - Credenciales de producción configuradas

- [ ] **Dependencies**
  - `composer install --no-dev --optimize-autoloader`
  - Vendor actualizado
  - No hay vulnerabilidades en dependencias

- [ ] **Assets**
  - CSS/JS minificados
  - Imágenes optimizadas
  - Archivos estáticos comprimidos

- [ ] **Configuration**
  - Cache configurado (Redis/Memcached)
  - Queue workers configurados
  - Cron jobs configurados
  - Logs configurados

### 🔒 Seguridad

- [ ] **SSL/TLS**
  - Certificado SSL válido
  - HTTPS forzado
  - HSTS headers configurados

- [ ] **Headers**
  - Content Security Policy
  - X-Frame-Options
  - X-Content-Type-Options
  - X-XSS-Protection

- [ ] **Firewall**
  - Puertos no necesarios cerrados
  - Solo SSH key authentication
  - Rate limiting configurado
  - Fail2ban configurado

- [ ] **Database**
  - Usuario DB con permisos mínimos
  - Conexiones DB encriptadas
  - Backups automáticos configurados
  - Database password fuerte

### 📊 Monitoring

- [ ] **Logging**
  - Logs centralizados configurados
  - Log rotation configurado
  - Alertas para errores críticos

- [ ] **Uptime monitoring**
  - Health check endpoint
  - Uptime monitor configurado
  - Alertas configuradas

- [ ] **Performance monitoring**
  - APM configurado (New Relic, etc.)
  - Database query monitoring
  - Alertas de performance

- [ ] **Error tracking**
  - Sentry o similar configurado
  - Notificaciones de errores
  - Error grouping configurado

### 🧪 Testing

- [ ] **Smoke tests**
  - Funcionalidades críticas testeadas
  - Login funciona
  - CRUD operations funcionan
  - Integraciones funcionan

- [ ] **Load testing**
  - Tested con carga esperada
  - Response times aceptables
  - Sin memory leaks

- [ ] **Database migrations**
  - Migrations ejecutadas en staging
  - Rollback plan preparado
  - Backup previo a migrations

### 📝 Documentation

- [ ] **Deploy notes**
  - Cambios documentados
  - Breaking changes listados
  - Migration notes

- [ ] **Rollback plan**
  - Procedimiento de rollback documentado
  - Tested en staging
  - Responsables identificados

---

## Security Audit Checklist

### 🔐 Authentication

- [ ] **Password policy**
  - Mínimo 8 caracteres
  - Complejidad requerida
  - Password hashing con bcrypt/argon2
  - No se almacenan passwords en plaintext

- [ ] **Session management**
  - Session IDs seguros
  - Session timeout configurado
  - Session regeneration tras login
  - Logout destruye sesión

- [ ] **Multi-factor authentication** (si aplica)
  - MFA implementado para usuarios admin
  - Backup codes generados
  - Recovery flow implementado

- [ ] **Rate limiting**
  - Login attempts limitados
  - API calls limitadas
  - Brute force protection

### 🛡️ Authorization

- [ ] **Access control**
  - RBAC implementado correctamente
  - Permisos verificados en backend
  - Principle of least privilege aplicado

- [ ] **Resource ownership**
  - Verificación de ownership en operaciones
  - No acceso directo por ID manipulable
  - Autorización en cada endpoint

- [ ] **API security**
  - Authentication en todos los endpoints
  - Authorization verificada
  - API keys seguras (si aplica)

### 🔍 Data Protection

- [ ] **Encryption**
  - Data at rest encriptada (si necesario)
  - Data in transit encriptada (SSL/TLS)
  - Encryption keys almacenadas de forma segura

- [ ] **PII handling**
  - Datos personales identificados
  - Minimización de datos
  - Derecho al olvido implementado (GDPR)
  - Consentimiento capturado

- [ ] **File uploads**
  - Validación de tipo de archivo
  - Tamaño máximo configurado
  - Archivos almacenados fuera de webroot
  - Virus scanning (si aplica)

### 🚨 Vulnerabilities

- [ ] **OWASP Top 10**
  - [x] A01: Broken Access Control
  - [x] A02: Cryptographic Failures
  - [x] A03: Injection (SQL, XSS)
  - [x] A04: Insecure Design
  - [x] A05: Security Misconfiguration
  - [x] A06: Vulnerable Components
  - [x] A07: Authentication Failures
  - [x] A08: Data Integrity Failures
  - [x] A09: Logging Failures
  - [x] A10: SSRF

- [ ] **Dependency vulnerabilities**
  - `composer audit` ejecutado
  - Vulnerabilidades conocidas resueltas
  - Dependencias actualizadas

---

## Performance Checklist

### ⚡ Database

- [ ] **Query optimization**
  - Queries lentas identificadas
  - EXPLAIN ejecutado
  - Índices creados donde sea necesario
  - N+1 problems resueltos

- [ ] **Connection pooling**
  - Pooling configurado
  - Límites apropiados
  - Connection reuse

- [ ] **Database tuning**
  - Buffer pools configurados
  - Query cache configurado
  - Slow query log habilitado

### 🗄️ Caching

- [ ] **Application cache**
  - Redis/Memcached configurado
  - Cache hit rate monitoreado
  - Cache invalidation strategy

- [ ] **HTTP caching**
  - Cache headers configurados
  - ETags implementados
  - Browser caching optimizado

- [ ] **OPcache**
  - PHP OPcache habilitado
  - Configuración optimizada
  - Preloading configurado (PHP 7.4+)

### 🌐 Frontend

- [ ] **Assets**
  - CSS/JS minificados
  - Gzip/Brotli compression
  - CDN para assets estáticos
  - Lazy loading de imágenes

- [ ] **Critical rendering path**
  - CSS crítico inline
  - JavaScript async/defer
  - Font loading optimizado

- [ ] **Images**
  - Formato moderno (WebP, AVIF)
  - Responsive images
  - Comprimidas apropiadamente
  - Lazy loading implementado

### 🔧 Infrastructure

- [ ] **Web server**
  - Nginx/Apache tuneado
  - Worker processes optimizados
  - Keepalive configurado
  - Timeouts apropiados

- [ ] **PHP-FPM**
  - Pool configurado apropiadamente
  - Max children configurado
  - Process manager configurado

- [ ] **Load balancing** (si aplica)
  - Load balancer configurado
  - Health checks configurados
  - Sticky sessions si es necesario

---

## Automated Checks

### 🤖 CI/CD Pipeline

```yaml
# Ejemplo: .github/workflows/quality.yml

name: Quality Checks

on: [push, pull_request]

jobs:
  quality:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v2

      # Composer install
      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      # PHP Lint
      - name: PHP Lint
        run: find . -name "*.php" -print0 | xargs -0 -n1 php -l

      # PHP_CodeSniffer (PSR-12)
      - name: PHP_CodeSniffer
        run: vendor/bin/phpcs --standard=PSR12 src/

      # PHPStan (Static Analysis)
      - name: PHPStan
        run: vendor/bin/phpstan analyse src/ --level=8

      # PHPUnit (Tests)
      - name: PHPUnit
        run: vendor/bin/phpunit --coverage-clover coverage.xml

      # Security check
      - name: Security Audit
        run: composer audit

      # Upload coverage
      - name: Upload coverage
        uses: codecov/codecov-action@v2
        with:
          files: ./coverage.xml
```

### 📝 Pre-commit Hook

```bash
#!/bin/bash
# .git/hooks/pre-commit

echo "Running pre-commit checks..."

# PHP Lint
echo "1. PHP Lint..."
git diff --cached --name-only --diff-filter=ACM | grep '\.php$' | while read file; do
    php -l "$file"
    if [ $? -ne 0 ]; then
        echo "Fix PHP syntax errors before committing."
        exit 1
    fi
done

# PHP_CodeSniffer
echo "2. PSR-12 Style Check..."
vendor/bin/phpcs --standard=PSR12 $(git diff --cached --name-only --diff-filter=ACM | grep '\.php$')
if [ $? -ne 0 ]; then
    echo "Fix code style errors (PSR-12) before committing."
    echo "You can run: vendor/bin/phpcbf to auto-fix"
    exit 1
fi

# PHPStan
echo "3. Static Analysis..."
vendor/bin/phpstan analyse $(git diff --cached --name-only --diff-filter=ACM | grep '\.php$') --level=8
if [ $? -ne 0 ]; then
    echo "Fix static analysis errors before committing."
    exit 1
fi

# PHPUnit
echo "4. Running tests..."
vendor/bin/phpunit
if [ $? -ne 0 ]; then
    echo "Tests must pass before committing."
    exit 1
fi

# Check for var_dump, dd, console.log
echo "5. Checking for debug code..."
git diff --cached --name-only --diff-filter=ACM | while read file; do
    if grep -E '(var_dump|dd\(|console\.log)' "$file" > /dev/null; then
        echo "Remove debug code (var_dump, dd, console.log) from $file"
        exit 1
    fi
done

# Check for .env commits
echo "6. Checking for secrets..."
git diff --cached --name-only --diff-filter=ACM | grep -E '(\.env|\.key|credentials)' > /dev/null
if [ $? -eq 0 ]; then
    echo "Attempting to commit sensitive files (.env, .key, credentials)"
    exit 1
fi

echo "✅ All checks passed!"
exit 0
```

### 🎯 Quality Score Script

```bash
#!/bin/bash
# scripts/quality-score.sh

echo "=========================================="
echo "  CODE QUALITY SCORE"
echo "=========================================="

total=0
score=0

# PSR-12 Compliance (25 points)
echo "1. PSR-12 Compliance (25 pts)..."
vendor/bin/phpcs --standard=PSR12 --report=summary src/ > /dev/null 2>&1
if [ $? -eq 0 ]; then
    score=$((score + 25))
    echo "   ✅ 25/25"
else
    errors=$(vendor/bin/phpcs --standard=PSR12 src/ | grep -c "FOUND")
    points=$((25 - errors > 0 ? 25 - errors : 0))
    score=$((score + points))
    echo "   ⚠️  $points/25 ($errors violations)"
fi
total=$((total + 25))

# Static Analysis (25 points)
echo "2. Static Analysis (25 pts)..."
vendor/bin/phpstan analyse src/ --level=8 --no-progress > /dev/null 2>&1
if [ $? -eq 0 ]; then
    score=$((score + 25))
    echo "   ✅ 25/25"
else
    errors=$(vendor/bin/phpstan analyse src/ --level=8 | grep -c "Error")
    points=$((25 - errors > 0 ? 25 - errors : 0))
    score=$((score + points))
    echo "   ⚠️  $points/25 ($errors errors)"
fi
total=$((total + 25))

# Test Coverage (30 points)
echo "3. Test Coverage (30 pts)..."
coverage=$(vendor/bin/phpunit --coverage-text | grep "Lines:" | awk '{print $2}' | sed 's/%//')
if [ -z "$coverage" ]; then
    echo "   ❌ 0/30 (no coverage)"
else
    points=$(echo "$coverage * 0.3" | bc | awk '{print int($1)}')
    score=$((score + points))
    echo "   ✅ $points/30 ($coverage% coverage)"
fi
total=$((total + 30))

# Documentation (10 points)
echo "4. Documentation (10 pts)..."
undocumented=$(grep -r "public function" src/ | wc -l)
documented=$(grep -r "/\*\*" src/ | wc -l)
if [ $documented -ge $undocumented ]; then
    score=$((score + 10))
    echo "   ✅ 10/10"
else
    ratio=$(echo "$documented / $undocumented * 10" | bc)
    score=$((score + ratio))
    echo "   ⚠️  $ratio/10"
fi
total=$((total + 10))

# Security (10 points)
echo "5. Security Audit (10 pts)..."
composer audit > /dev/null 2>&1
if [ $? -eq 0 ]; then
    score=$((score + 10))
    echo "   ✅ 10/10"
else
    echo "   ❌ 0/10 (vulnerabilities found)"
fi
total=$((total + 10))

# Final score
echo "=========================================="
percentage=$((score * 100 / total))
echo "FINAL SCORE: $score/$total ($percentage%)"
echo "=========================================="

if [ $percentage -ge 90 ]; then
    echo "🎉 EXCELLENT! Production ready."
    exit 0
elif [ $percentage -ge 75 ]; then
    echo "✅ GOOD! Minor improvements needed."
    exit 0
elif [ $percentage -ge 60 ]; then
    echo "⚠️  ACCEPTABLE. Several improvements needed."
    exit 1
else
    echo "❌ POOR. Significant improvements required."
    exit 1
fi
```

---

## 💡 Usage Tips

### Integrar en tu workflow:

1. **Pre-commit:** Copia el hook a `.git/hooks/pre-commit` y da permisos de ejecución
2. **CI/CD:** Usa el workflow de ejemplo en tu `.github/workflows/`
3. **Quality score:** Ejecuta `bash scripts/quality-score.sh` antes de deploy
4. **Code review:** Usa este checklist en tus PRs

### Configurar Composer scripts:

```json
{
  "scripts": {
    "test": "phpunit",
    "lint": "phpcs --standard=PSR12 src/",
    "fix": "phpcbf --standard=PSR12 src/",
    "analyse": "phpstan analyse src/ --level=8",
    "audit": "composer audit",
    "quality": "bash scripts/quality-score.sh"
  }
}
```

Entonces puedes ejecutar:
```bash
composer test
composer lint
composer analyse
composer quality
```

---

**Este checklist asegura que tu código cumple con los más altos estándares de calidad, seguridad y rendimiento antes de llegar a producción!**
