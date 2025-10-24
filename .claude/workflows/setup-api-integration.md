# Workflow: Setup API Integration

**Purpose:** Integrate external API into MCP
**Time:** ~45 minutes
**Agents Used:** api-integrator, php-architect

---

## Overview

This workflow guides you through integrating an external API (Google, Ahrefs, WordPress, Odoo) into the Marketing Control Panel.

## Prerequisites

- API credentials obtained
- API documentation available
- Understanding of API rate limits
- .env file configured

---

## Workflow Steps

### Step 1: Obtain Credentials (varies by API)

**Google APIs (OAuth 2.0):**
1. Go to Google Cloud Console
2. Create project or select existing
3. Enable APIs (Search Console, Analytics)
4. Create OAuth 2.0 credentials
5. Note: client_id, client_secret, redirect_uri

**Ahrefs:**
1. Login to Ahrefs account
2. Go to Account Settings → API
3. Generate API token
4. Note rate limits

**WordPress:**
1. Install Application Passwords plugin (or WordPress 5.6+)
2. Generate application password
3. Note: username, application_password

**Odoo:**
1. Get Odoo URL
2. Note: database name, username, password

### Step 2: Store Credentials Securely (5 min)

**File:** `.env` (NEVER commit this)

```env
# Google APIs
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URI=https://yourdomain.com/oauth/google/callback

# Ahrefs
AHREFS_API_TOKEN=your_ahrefs_token

# WordPress (per-client, stored in database)

# Odoo
ODOO_URL=https://yourcompany.odoo.com
ODOO_DATABASE=production
ODOO_USERNAME=admin
ODOO_PASSWORD=your_password
```

**File:** `config/api.php`

```php
<?php

return [
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
    ],
    'ahrefs' => [
        'api_token' => env('AHREFS_API_TOKEN'),
        'rate_limit' => 500,  // per day
    ],
    // ...
];
```

### Step 3: Create API Wrapper Service (15 min)

**Use: api-integrator agent**

Prompt:
```
Create API wrapper for [API_NAME] with:
- Authentication handling
- Error handling
- Rate limiting
- Caching
- Methods: [list key methods needed]
```

**Output:**
`src/Shared/API/{Provider}/{Provider}API.php`

**Example for Google Search Console:**
```php
<?php
namespace App\Shared\API\Google;

class GoogleSearchConsoleAPI {
    public function __construct(
        private string $accessToken,
        private CacheService $cache,
        private Logger $logger
    ) {}

    public function getSearchAnalytics(string $siteUrl, array $params): array {
        // Implementation
    }
}
```

### Step 4: Implement Authentication (OAuth if needed) (10 min)

**For OAuth 2.0 (Google):**

**Create:** `src/Shared/API/Google/GoogleOAuthService.php`

**Create OAuth controller:**
`src/Modules/OAuth/Controllers/GoogleOAuthController.php`

```php
public function redirect(): void {
    $authUrl = $this->oauthService->getAuthorizationUrl([
        'https://www.googleapis.com/auth/webmasters.readonly',
        'https://www.googleapis.com/auth/analytics.readonly'
    ]);

    header("Location: $authUrl");
    exit;
}

public function callback(): void {
    $code = $_GET['code'];
    $tokens = $this->oauthService->getAccessToken($code);

    // Store tokens in database
    $this->storeTokens($clienteId, $tokens);

    header("Location: /clientes/{$clienteId}");
    exit;
}
```

**Add routes:**
```php
$router->get('/oauth/google', 'OAuth\Controllers\GoogleOAuthController@redirect');
$router->get('/oauth/google/callback', 'OAuth\Controllers\GoogleOAuthController@callback');
```

### Step 5: Create Database Tables for Tokens (if OAuth) (5 min)

**Migration:** `database/migrations/015_create_api_tokens.sql`

```sql
CREATE TABLE api_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    provider ENUM('google', 'wordpress', 'odoo'),
    access_token TEXT,
    refresh_token TEXT,
    expires_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_cliente_provider (cliente_id, provider),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);
```

### Step 6: Implement Rate Limiting (5 min)

**Use existing RateLimiter or create new:**

```php
// In your API wrapper
public function makeRequest(string $endpoint): array {
    $key = "api_{$this->provider}_client_{$this->clientId}";

    if (!$this->rateLimiter->attempt($key, 100, 86400)) {
        throw new RateLimitException("API quota exceeded");
    }

    // Make request
}
```

### Step 7: Add Caching Layer (5 min)

```php
public function getSearchAnalytics(string $siteUrl, array $params): array {
    $cacheKey = "gsc_{$siteUrl}_" . md5(serialize($params));

    if ($cached = $this->cache->get($cacheKey)) {
        return $cached;
    }

    $data = $this->fetchFromAPI($siteUrl, $params);

    // Cache for 1 hour
    $this->cache->set($cacheKey, $data, 3600);

    return $data;
}
```

### Step 8: Test Integration (5 min)

**Create test script:** `tests/API/GoogleSearchConsoleAPITest.php`

```php
public function test_fetch_search_analytics() {
    $api = new GoogleSearchConsoleAPI($accessToken, $cache, $logger);

    $data = $api->getSearchAnalytics('https://example.com', [
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-31'
    ]);

    $this->assertIsArray($data);
    $this->assertArrayHasKey('rows', $data);
}
```

**Manual test:**
- Call API with valid credentials
- Verify data returned
- Test error handling (invalid token)
- Test rate limiting
- Test caching

### Step 9: Create Service Integration (5 min)

**Integrate API into existing services:**

```php
// In AuditoriaService.php
public function recopilarDatosGSC(int $clienteId): array {
    $tokens = $this->obtenerTokensAPI($clienteId, 'google');

    if (!$tokens) {
        throw new APIException("Cliente no tiene tokens de Google configurados");
    }

    $gscAPI = new GoogleSearchConsoleAPI(
        accessToken: $tokens['access_token'],
        cache: $this->cache,
        logger: $this->logger
    );

    return $gscAPI->getSearchAnalytics($cliente->dominio);
}
```

### Step 10: Update UI (5 min)

**Add configuration UI for clients:**

**View:** `Views/Cliente/api-settings.php`

```php
<h2>Integraciones API</h2>

<!-- Google -->
<div class="api-integration">
    <h3>Google (Search Console + Analytics)</h3>
    <?php if ($hasGoogleTokens): ?>
        <span class="badge bg-success">Conectado</span>
        <a href="/oauth/google/disconnect?cliente_id=<?= $cliente['id'] ?>">Desconectar</a>
    <?php else: ?>
        <a href="/oauth/google?cliente_id=<?= $cliente['id'] ?>" class="btn btn-primary">
            Conectar Google
        </a>
    <?php endif; ?>
</div>
```

---

## Completion Checklist

- [ ] Credentials obtained and stored in .env
- [ ] API wrapper service created
- [ ] Authentication implemented (OAuth if needed)
- [ ] Database tables for tokens (if needed)
- [ ] Rate limiting configured
- [ ] Caching implemented
- [ ] Error handling tested
- [ ] Integration tests written
- [ ] Service integration completed
- [ ] UI for configuration added
- [ ] Documentation created

---

## Common Issues & Solutions

### Issue: OAuth redirect not working
**Solution:** Ensure redirect_uri matches exactly in Google Console and .env

### Issue: Token expired errors
**Solution:** Implement automatic token refresh using refresh_token

### Issue: Rate limit exceeded
**Solution:** Check RateLimiter configuration, increase cache TTL

### Issue: API returns empty data
**Solution:** Verify site verification in GSC/GA, check date ranges

---

## API-Specific Notes

### Google Search Console
- Requires site verification
- OAuth scopes: `webmasters.readonly`
- Rate limit: 200 requests per user per day
- Data lag: 2-3 days

### Google Analytics 4
- Requires GA4 property access
- OAuth scopes: `analytics.readonly`
- Rate limit: 10 queries per second
- Use Measurement Protocol for events

### Ahrefs
- Simple token authentication
- Rate limit: varies by plan (usually 500/day)
- Endpoints: backlinks, keywords, metrics
- Response format: JSON

### WordPress REST API
- Application passwords (WP 5.6+)
- No OAuth needed
- Rate limit: typically unlimited (self-hosted)
- Endpoints: posts, pages, media, users

### Odoo XML-RPC
- Username/password auth
- No rate limit (self-hosted)
- Methods: create, read, write, search
- Returns: Python-style data structures

---

## Example: Complete Google GSC Integration

**1. Get credentials (Google Console)**
**2. Add to .env:**
```env
GOOGLE_CLIENT_ID=123456.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-abc123
GOOGLE_REDIRECT_URI=https://mcp.local/oauth/google/callback
```

**3. Create service:**
```bash
# Use api-integrator agent
"Create GoogleSearchConsoleAPI wrapper with methods:
- getSearchAnalytics()
- getSitemaps()
- getUrlInspection()"
```

**4. Create OAuth flow:**
- GoogleOAuthController with redirect() and callback()
- Routes for /oauth/google and /oauth/google/callback
- Token storage in database

**5. Test:**
```php
$api = new GoogleSearchConsoleAPI($token);
$data = $api->getSearchAnalytics('https://ibizavilla.com');
// Should return array with queries, clicks, impressions
```

**6. Integrate:**
```php
// In AuditoriaService
$gscData = $this->recopilarDatosGSC($clienteId);
```

---

## Time Breakdown

- Obtain credentials: varies (10-30 min)
- Setup .env and config: 5 min
- Create API wrapper: 15 min
- Authentication: 10 min (OAuth) or 0 min (token)
- Database tables: 5 min
- Rate limiting: 5 min
- Caching: 5 min
- Testing: 5 min
- Integration: 5 min
- UI: 5 min
- **Total: ~45-60 min**

---

You now have a production-ready API integration! 🔌
