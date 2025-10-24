# /review-code Command

**Description:** Comprehensive code review using code-reviewer agent
**Usage:** `/review-code [file_path or module_name]`

---

## Command Execution

When you invoke `/review-code`, I will:

1. Load the file(s) to review
2. Activate code-reviewer agent
3. Perform multi-dimensional analysis
4. Provide detailed feedback
5. Suggest improvements

---

## Usage Patterns

### Review Single File
```
/review-code src/Modules/Cliente/Services/ClienteService.php
```

### Review Entire Module
```
/review-code Cliente
```
This reviews all files in `src/Modules/Cliente/`

### Review Recent Changes
```
/review-code --recent
```
Reviews files changed in last commit

### Focus on Security
```
/review-code --security src/Modules/Auth/
```

### Focus on Performance
```
/review-code --performance src/Modules/Auditoria/
```

---

## Review Output Format

```markdown
# Code Review: {File/Module Name}

## 📊 Overall Score: X/10

**Breakdown:**
- Readability: X/10
- Security: X/10
- Performance: X/10
- Maintainability: X/10
- Testing: X/10

---

## ✅ Good Practices Found

1. **Excellent use of typed properties** (lines 15-20)
   - All properties have explicit types
   - Constructor property promotion used effectively

2. **Proper error handling** (lines 45-55)
   - Try-catch blocks around risky operations
   - Custom exceptions used
   - Errors logged appropriately

3. **Good separation of concerns** (entire file)
   - Service layer cleanly separated from controller
   - Single Responsibility Principle followed

---

## 🔴 Critical Issues (Must Fix)

### 1. SQL Injection Vulnerability (line 67)
**Severity:** CRITICAL
**Current code:**
```php
$sql = "SELECT * FROM clientes WHERE id = {$id}";
$result = $this->db->query($sql);
```

**Problem:**
Direct interpolation of user input creates SQL injection risk.

**Fix:**
```php
$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = $this->db->prepare($sql);
$stmt->execute([$id]);
$result = $stmt->fetch();
```

**Impact:** Security vulnerability that could lead to data breach

---

### 2. Missing Input Validation (line 34)
**Severity:** CRITICAL
**Current code:**
```php
public function create(array $data): int {
    return $this->db->insert('clientes', $data);  // No validation!
}
```

**Problem:**
No validation before database insert.

**Fix:**
```php
public function create(array $data): int {
    $errors = $this->validator->validate($data);
    if (!empty($errors)) {
        throw new ValidationException('Invalid data', $errors);
    }

    return $this->db->insert('clientes', $data);
}
```

---

## 🟡 Important Issues (Should Fix)

### 1. No Type Hints on Method Parameters (line 23)
**Severity:** IMPORTANT
**Current code:**
```php
public function getData($id) {
    // ...
}
```

**Fix:**
```php
public function getData(int $id): ?array {
    // ...
}
```

**Benefit:** Better IDE support, catches type errors at compile time

---

### 2. Missing Documentation (lines 10-50)
**Severity:** IMPORTANT

**Add PHPDoc:**
```php
/**
 * Get client data by ID
 *
 * @param int $id Client ID
 * @return array|null Client data or null if not found
 * @throws DatabaseException If query fails
 */
public function getData(int $id): ?array {
    // ...
}
```

---

## 🔵 Suggestions (Nice to Have)

### 1. Consider Caching (line 78)
**Current:**
```php
public function getStats(): array {
    return $this->db->query("SELECT COUNT(*) as total FROM clientes");
}
```

**Suggestion:**
This query runs frequently. Add caching:
```php
public function getStats(): array {
    return $this->cache->remember('cliente_stats', 3600, function() {
        return $this->db->query("SELECT COUNT(*) as total FROM clientes");
    });
}
```

**Benefit:** Reduce database load

---

### 2. Extract Magic Numbers (line 92)
**Current:**
```php
if ($score > 75) {  // What is 75?
    // ...
}
```

**Suggestion:**
```php
private const SCORE_THRESHOLD_EXCELLENT = 75;

if ($score > self::SCORE_THRESHOLD_EXCELLENT) {
    // Clear intent!
}
```

---

## 🧪 Testing Recommendations

**Missing test coverage for:**
- [ ] `create()` method with invalid data
- [ ] `update()` method with non-existent ID
- [ ] `delete()` method cascade behavior
- [ ] Error handling paths

**Suggested tests:**
```php
public function test_create_with_invalid_data_throws_exception() {
    $this->expectException(ValidationException::class);
    $this->service->create(['invalid' => 'data']);
}
```

---

## 📈 Performance Analysis

### Database Queries
- **Total queries in file:** 5
- **N+1 risk:** Found in `getWithAuditorias()` method (line 120)
- **Missing indexes:** Consider index on `cliente_id` if not exists

### Memory Usage
- **Potential memory issue:** Loading all records without limit (line 45)
- **Suggestion:** Add pagination

---

## 🔒 Security Checklist

- [ ] ✅ CSRF protection in forms
- [ ] ❌ SQL injection prevention (FAILED - line 67)
- [ ] ✅ XSS prevention (output escaped)
- [ ] ✅ Password hashing
- [ ] ⚠️  Input validation (PARTIAL)
- [ ] ✅ Authentication checks
- [ ] ✅ Authorization checks

---

## 📝 Style & Conventions

**PSR-12 Compliance:** 8/10

**Issues:**
- Line 34: Opening brace should be on same line
- Line 89: Line exceeds 120 characters
- Line 102: Missing blank line before return

**Naming Conventions:** ✅ Good
- Methods: camelCase ✓
- Classes: PascalCase ✓
- Constants: UPPER_SNAKE_CASE ✓

---

## 🎯 Action Items (Prioritized)

### Priority 1 (Critical - Fix Now)
1. Fix SQL injection on line 67
2. Add input validation on line 34

### Priority 2 (Important - Fix Soon)
1. Add type hints to all methods
2. Add PHPDoc documentation
3. Fix N+1 query problem

### Priority 3 (Enhancements - Nice to Have)
1. Add caching layer
2. Extract magic numbers
3. Add pagination
4. Improve test coverage

---

## 💡 Refactoring Suggestions

**Consider splitting this class:**

Current: `ClienteService` has 15 methods

Suggested split:
- `ClienteService` - Core CRUD (5 methods)
- `ClienteQueryService` - Complex queries (5 methods)
- `ClienteReportService` - Reports and stats (5 methods)

**Benefits:**
- Better SRP adherence
- Easier to test
- Easier to maintain

---

## 📊 Metrics

- **Lines of Code:** 250
- **Cyclomatic Complexity:** 8 (Good - under 10)
- **Method Count:** 15
- **Average Method Length:** 16 lines (Good - under 20)
- **Comment Ratio:** 5% (Low - aim for 15-20%)

---

## ✨ Summary

**Overall Assessment:**
This is a solid service class with good structure, but has some critical security issues that need immediate attention. The code follows most best practices but could benefit from better documentation and more comprehensive testing.

**Must Fix Before Production:**
1. SQL injection vulnerability (line 67)
2. Input validation (line 34)

**Estimated Time to Fix:**
- Critical issues: 30 minutes
- Important issues: 1 hour
- Suggestions: 2 hours

---

Would you like me to:
1. Fix the critical issues automatically?
2. Show detailed examples of the refactoring?
3. Generate unit tests for this class?
4. Review another file?
```

---

## Review Modes

### Standard Review
Covers all aspects: security, performance, style, documentation

### Security-Focused Review
Deep dive into:
- SQL injection risks
- XSS vulnerabilities
- CSRF protection
- Authentication/Authorization
- Sensitive data exposure

### Performance-Focused Review
Analyzes:
- Query optimization
- N+1 problems
- Caching opportunities
- Memory usage
- Algorithm efficiency

### Quick Review
Fast scan for:
- Obvious bugs
- Critical security issues
- PSR-12 violations

---

## Command Options

```
/review-code [options] [path]

Options:
  --security      Focus on security issues
  --performance   Focus on performance
  --quick         Quick scan (5 min)
  --full          Full deep review (30 min)
  --fix           Auto-fix simple issues
  --recent        Review recent changes only

Examples:
  /review-code --security src/Modules/Auth/
  /review-code --performance --fix src/Modules/Auditoria/
  /review-code --quick src/Modules/Cliente/Services/ClienteService.php
```

---

This command ensures code quality before deployment! 🔍✨
