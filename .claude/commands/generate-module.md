# /generate-module Command

**Description:** Generate a complete MVC module with CRUD operations
**Usage:** `/generate-module {ModuleName}`

---

## Command Execution

When you invoke `/generate-module {ModuleName}`, I will:

1. Ask for requirements
2. Use module-generator agent
3. Use database-designer agent
4. Create all necessary files
5. Generate migration
6. Provide next steps

---

## Interactive Prompts

### Question 1: Module Details
```
I'll help you create the {ModuleName} module.

1. Entity name (singular): ___
2. Table name (plural): ___
3. Brief description: ___
```

### Question 2: Fields
```
What fields does this entity have? (one per line)

Format: field_name:type:constraints

Example:
nombre:VARCHAR(255):NOT NULL
email:VARCHAR(255):UNIQUE
precio:DECIMAL(10,2):NOT NULL
estado:ENUM:borrador,activo,completado
descripcion:TEXT:NULL

Enter fields (empty line when done):
```

### Question 3: Relationships
```
Any relationships with other entities?

1. cliente_id (foreign key to clientes) - Yes/No
2. Other foreign keys? (empty if none): ___
```

### Question 4: Special Features
```
Any special features needed?

- [ ] Soft deletes (deleted_at)
- [ ] File uploads
- [ ] JSON metadata field
- [ ] Scheduled tasks
- [ ] Email notifications
- [ ] API endpoints

Select (comma-separated, e.g., "1,3,5"): ___
```

---

## Generated Output

After gathering info, I will create:

### 1. Database Migration
**File:** `database/migrations/00X_create_{table_name}.sql`

```sql
CREATE TABLE {table_name} (
    id INT AUTO_INCREMENT PRIMARY KEY,
    -- your fields --
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### 2. Model
**File:** `src/Modules/{ModuleName}/Models/{ModelName}.php`

### 3. Controller
**File:** `src/Modules/{ModuleName}/Controllers/{ModuleName}Controller.php`

### 4. Service
**File:** `src/Modules/{ModuleName}/Services/{ModuleName}Service.php`

### 5. Validator
**File:** `src/Modules/{ModuleName}/Validators/{ModelName}Validator.php`

### 6. Views
**Files:**
- `src/Modules/{ModuleName}/Views/index.php`
- `src/Modules/{ModuleName}/Views/show.php`
- `src/Modules/{ModuleName}/Views/create.php`
- `src/Modules/{ModuleName}/Views/edit.php`

### 7. Routes Registration
**Added to:** `config/routes.php`

### 8. Enum (if applicable)
**File:** `src/Modules/{ModuleName}/Enums/{EnumName}.php`

---

## Next Steps Provided

After generation:

```
✅ Module {ModuleName} generated successfully!

📁 Files created:
   - Migration: database/migrations/00X_create_{table}.sql
   - Model: src/Modules/{ModuleName}/Models/{Model}.php
   - Controller: src/Modules/{ModuleName}/Controllers/{Module}Controller.php
   - Service: src/Modules/{ModuleName}/Services/{Module}Service.php
   - Validator: src/Modules/{ModuleName}/Validators/{Model}Validator.php
   - Views: src/Modules/{ModuleName}/Views/*.php

🔧 Routes registered:
   GET    /{route}
   GET    /{route}/{id}
   POST   /{route}
   PUT    /{route}/{id}
   DELETE /{route}/{id}

⏭️  Next steps:
   1. Run migration: php cli/migrate.php
   2. Test routes: http://localhost:8000/{route}
   3. Update navigation: add link to sidebar
   4. Write tests: tests/Modules/{ModuleName}/
   5. Review code: use /review-code command

Ready to proceed with next steps? (yes/no)
```

---

## Example Usage

**User:** `/generate-module PlanMarketing`

**Claude:**
```
I'll help you create the PlanMarketing module.

1. Entity name (singular): Plan
2. Table name (plural): planes_marketing
3. Brief description: Marketing plans for clients
```

**User:**
```
1. Plan
2. planes_marketing
3. Manages marketing plans with objectives and budget
```

**Claude:**
```
What fields does this entity have?

Enter fields (empty line when done):
```

**User:**
```
nombre:VARCHAR(255):NOT NULL
cliente_id:INT:NOT NULL
objetivo_principal:TEXT:NOT NULL
presupuesto_total:DECIMAL(10,2):NOT NULL
duracion_meses:INT:NOT NULL
estado:ENUM:borrador,aprobado,en_ejecucion,completado

```

**Claude proceeds to generate all files...**

---

## Customization Options

After generation, I can help with:

- Adding custom methods to Service
- Modifying validation rules
- Adding complex queries
- Implementing business logic
- Creating API endpoints
- Adding background jobs

Just ask!

---

## Aliases

- `/new-module` - same as /generate-module
- `/create-module` - same as /generate-module
- `/gen-mod` - short version

---

This command dramatically speeds up development by automating the boilerplate! 🚀
