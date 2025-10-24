# Workflow: Create New Module

**Purpose:** Generate a complete, production-ready module for MCP
**Time:** ~30 minutes
**Agents Used:** module-generator, database-designer, php-architect

---

## Overview

This workflow guides you through creating a new module from scratch, including database schema, business logic, views, and tests.

## Prerequisites

- MCP project structure exists
- Database connection configured
- Understanding of module requirements

---

## Workflow Steps

### Step 1: Gather Requirements (5 min)

**Questions to answer:**
1. What is the module name? (singular, PascalCase)
2. What is the main entity? (e.g., Cliente, Auditoria, Plan)
3. What are the main fields and their types?
4. Any special relationships? (1-to-many, many-to-many)
5. Any enums needed?
6. Any special business logic?

**Example:**
```
Module: PlanMarketing
Entity: Plan
Table: planes_marketing
Fields:
  - nombre: VARCHAR(255)
  - cliente_id: INT (FK to clientes)
  - objetivo_principal: TEXT
  - presupuesto_total: DECIMAL(10,2)
  - duracion_meses: INT
  - estado: ENUM('borrador', 'aprobado', 'en_ejecucion')
```

### Step 2: Design Database Schema (10 min)

**Use: database-designer agent**

Prompt:
```
Design database schema for PlanMarketing module with these requirements:
[paste requirements from Step 1]
```

**Output:**
- Migration SQL file
- Indexes strategy
- Foreign key constraints

**Action:**
- Review generated SQL
- Save to `database/migrations/00X_create_planes_marketing.sql`
- Note any special indexes needed

### Step 3: Generate Module Structure (10 min)

**Use: module-generator agent**

Prompt:
```
Generate complete PlanMarketing module with:
- Table: planes_marketing
- Fields: [list fields]
- CRUD operations
- Validation rules: [list validations]
```

**Output:**
- Controllers/PlanMarketingController.php
- Services/PlanMarketingService.php
- Models/PlanMarketing.php
- Validators/PlanMarketingValidator.php
- Views/index.php, show.php, create.php, edit.php
- Enums/EstadoPlan.php (if applicable)

**Action:**
- Review all generated files
- Customize validation rules if needed
- Add any custom business logic

### Step 4: Register Routes (2 min)

**File:** `config/routes.php`

```php
// Add to routes.php
$router->resource('/planes-marketing', 'PlanMarketing\Controllers\PlanMarketingController');
```

**This creates:**
```
GET    /planes-marketing           -> index()
GET    /planes-marketing/{id}      -> show($id)
GET    /planes-marketing/nuevo     -> create()
POST   /planes-marketing           -> store()
GET    /planes-marketing/{id}/editar -> edit($id)
PUT    /planes-marketing/{id}      -> update($id)
DELETE /planes-marketing/{id}      -> destroy($id)
```

### Step 5: Run Migration (1 min)

```bash
php cli/migrate.php
```

**Verify:**
- Table created successfully
- Indexes exist
- Foreign keys work

### Step 6: Update Navigation (2 min)

**File:** `src/Shared/Views/layouts/sidebar.php`

```php
<li class="nav-item">
    <a href="/planes-marketing" class="nav-link">
        <i class="fas fa-clipboard-list"></i>
        <span>Planes de Marketing</span>
    </a>
</li>
```

### Step 7: Test Manually (5 min)

**Test each route:**
- [ ] `/planes-marketing` - List loads
- [ ] `/planes-marketing/nuevo` - Form displays
- [ ] Create new plan - Saves successfully
- [ ] `/planes-marketing/{id}` - Detail view works
- [ ] `/planes-marketing/{id}/editar` - Edit form works
- [ ] Update plan - Saves changes
- [ ] Delete plan - Soft deletes

### Step 8: Write Tests (Optional, 15 min)

**File:** `tests/Modules/PlanMarketing/PlanMarketingServiceTest.php`

```php
<?php

namespace Tests\Modules\PlanMarketing;

use PHPUnit\Framework\TestCase;
use App\Modules\PlanMarketing\Services\PlanMarketingService;

class PlanMarketingServiceTest extends TestCase {
    public function test_create_plan() {
        $service = new PlanMarketingService($this->mockDb(), $this->mockLogger());

        $id = $service->crear([
            'nombre' => 'Plan Test',
            'cliente_id' => 1,
            'presupuesto_total' => 5000.00
        ]);

        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
    }
}
```

**Run tests:**
```bash
vendor/bin/phpunit tests/Modules/PlanMarketing/
```

### Step 9: Document (3 min)

**Create:** `docs/modules/plan-marketing.md`

```markdown
# PlanMarketing Module

## Purpose
Manages marketing plans for clients.

## Routes
- GET /planes-marketing - List all plans
- POST /planes-marketing - Create new plan
- ...

## Database
Table: `planes_marketing`

## Business Logic
- Plans belong to clients (1-to-many)
- States: borrador → aprobado → en_ejecucion
- Budget validation: must be > 0
```

---

## Completion Checklist

- [ ] Database migration created and run
- [ ] All module files generated
- [ ] Routes registered
- [ ] Navigation updated
- [ ] Manual testing completed
- [ ] Unit tests written (optional)
- [ ] Documentation created
- [ ] Code reviewed (use code-reviewer agent)
- [ ] Committed to git

---

## Common Issues & Solutions

### Issue: Foreign key constraint fails
**Solution:** Ensure referenced table exists first. Check migration order.

### Issue: Route not found
**Solution:** Clear route cache: `php cli/cache-clear.php routes`

### Issue: View not rendering
**Solution:** Check view path matches convention: `Views/{module}/action.php`

### Issue: Validation not working
**Solution:** Ensure validator is called in service before insert/update

---

## Example: Full Module Creation

**Prompt sequence:**

1. **To database-designer:**
```
Design schema for PlanMarketing with fields:
- cliente_id (FK)
- nombre
- objetivo_principal
- presupuesto_total (DECIMAL)
- estado (ENUM: borrador, aprobado, en_ejecucion)
```

2. **To module-generator:**
```
Generate PlanMarketing module with:
- Table: planes_marketing
- All standard CRUD
- Custom validation: presupuesto_total > 0
```

3. **To php-architect (for custom logic):**
```
Add method to PlanMarketingService:
- aprobarPlan(int $id): bool
- Should change estado to 'aprobado'
- Should log the approval
- Should send email notification
```

4. **To code-reviewer:**
```
Review the PlanMarketing module I just created.
Focus on security and validation.
```

---

## Time Breakdown

- Requirements: 5 min
- Database design: 10 min
- Module generation: 10 min
- Routes & nav: 4 min
- Migration: 1 min
- Testing: 5 min
- **Total: ~35 min**

With practice, you can create a complete module in under 30 minutes! 🚀

---

## Next Steps

After creating a module:
1. Add to API endpoints if needed
2. Create relationships with other modules
3. Add to dashboards/widgets
4. Create background jobs if needed
5. Add permissions/authorization
