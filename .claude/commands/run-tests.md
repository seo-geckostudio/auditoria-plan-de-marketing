# /run-tests Command

**Description:** Execute PHPUnit tests and show results
**Usage:** `/run-tests [pattern]`

---

## Command Execution

When you invoke `/run-tests`, I will:

1. Execute PHPUnit test suite
2. Parse test results
3. Show summary and details
4. Suggest fixes for failures

---

## Usage Patterns

### Run All Tests
```
/run-tests
```

### Run Specific Module Tests
```
/run-tests Cliente
```
Runs: `tests/Modules/Cliente/**/*Test.php`

### Run Single Test File
```
/run-tests tests/Modules/Cliente/ClienteServiceTest.php
```

### Run Tests Matching Pattern
```
/run-tests --filter=create
```
Runs only tests with "create" in the name

### Run with Coverage
```
/run-tests --coverage
```
Shows code coverage report

---

## Output Format

```
🧪 Running Tests...

=================================================================================
PHPUnit Test Results
=================================================================================

📊 Summary
----------
Tests:     45 total
✅ Passed:  42 (93.3%)
❌ Failed:  2 (4.4%)
⚠️  Skipped: 1 (2.2%)

Time:      2.34 seconds
Memory:    18 MB

=================================================================================

✅ PASSED TESTS (42)
-------------------
✓ ClienteServiceTest::test_create_cliente
✓ ClienteServiceTest::test_update_cliente
✓ ClienteServiceTest::test_delete_cliente
✓ ClienteServiceTest::test_list_clientes_with_filters
✓ AuditoriaServiceTest::test_create_auditoria
... (37 more)

=================================================================================

❌ FAILED TESTS (2)
-------------------

1. ClienteServiceTest::test_create_with_invalid_data
   Location: tests/Modules/Cliente/ClienteServiceTest.php:45

   Expected exception: ValidationException
   Actual: No exception thrown

   Stack trace:
   #1 ClienteServiceTest.php(45): test_create_with_invalid_data()

   💡 Suggestion:
   The service is not validating input. Add validation before insert:

   ```php
   public function create(array $data): int {
       $errors = $this->validator->validate($data);
       if (!empty($errors)) {
           throw new ValidationException('Invalid data', $errors);
       }
       // ... rest of code
   }
   ```

2. AuditoriaServiceTest::test_get_auditorias_for_client
   Location: tests/Modules/Auditoria/AuditoriaServiceTest.php:78

   Expected: 3 auditorias
   Actual: 2 auditorias

   Stack trace:
   #1 AuditoriaServiceTest.php(78): assertEquals(3, 2)

   💡 Suggestion:
   Check if test data is being properly seeded. The test expects 3 records
   but only 2 exist in the database.

=================================================================================

⚠️  SKIPPED TESTS (1)
---------------------
⊘ ExternalAPITest::test_google_api_integration
  Reason: Requires live API credentials

  💡 To run: Set GOOGLE_API_KEY in .env.testing

=================================================================================

📈 CODE COVERAGE
----------------
Overall Coverage: 78.5%

By Module:
├─ Cliente:     85.2% ✅
├─ Auditoria:   72.3% ⚠️
├─ Plan:        65.8% ⚠️
└─ Auth:        91.4% ✅

Files Needing Coverage:
❌ src/Modules/Auditoria/Services/ArchitectoAgent.php (0%)
❌ src/Modules/Plan/Services/PlanGeneratorService.php (45%)

=================================================================================

🎯 ACTION ITEMS
--------------
1. Fix 2 failing tests (estimated 30 min)
2. Add tests for ArchitectoAgent.php
3. Improve coverage in Plan module (target: 80%)
4. Consider adding integration tests

=================================================================================

Run specific failing test:
  vendor/bin/phpunit tests/Modules/Cliente/ClienteServiceTest.php::test_create_with_invalid_data

Re-run with verbose output:
  vendor/bin/phpunit --verbose

Generate HTML coverage report:
  vendor/bin/phpunit --coverage-html coverage/

=================================================================================
```

---

## Auto-Fix Mode

```
/run-tests --fix
```

I will:
1. Run tests
2. Analyze failures
3. Suggest fixes
4. Optionally apply fixes automatically

**Example:**
```
Found failing test: test_create_with_invalid_data

Analysis:
- Service method lacks input validation
- Expected exception not thrown

Suggested fix:
Add validation before insert in ClienteService::create()

Apply fix automatically? (yes/no)
> yes

✅ Fix applied!
✨ Re-running test...
✅ Test now passing!
```

---

## Test Categories

### Unit Tests
```
/run-tests unit
```
Tests isolated units (Services, Models, Validators)

### Integration Tests
```
/run-tests integration
```
Tests interaction between components

### Feature Tests
```
/run-tests feature
```
Tests full features end-to-end

---

## Continuous Feedback

As tests run, I provide real-time updates:

```
🧪 Running Tests...

[=====>                    ] 25% (10/40)

Current: ClienteServiceTest
✓ test_create_cliente
✓ test_update_cliente
✗ test_delete_cliente (FAILED)

Analyzing failure...
```

---

## Coverage Analysis

When `--coverage` flag used:

```
📊 Detailed Coverage Report

src/Modules/Cliente/Services/ClienteService.php
================================================================================
Lines:      45/50    (90.0%) ✅
Functions:  8/10     (80.0%) ⚠️
Branches:   12/15    (80.0%) ⚠️

Uncovered Lines:
  Line 67: Error handling branch never tested
  Line 89: Edge case validation
  Lines 120-125: Delete cascade logic

💡 Suggested Tests:
1. Test error scenario at line 67
2. Test edge case with invalid ID
3. Test cascade delete with related records

Would you like me to generate these tests? (yes/no)
```

---

## Performance Testing

```
/run-tests --performance
```

Shows performance metrics:

```
⚡ Performance Metrics

Slowest Tests:
1. AuditoriaServiceTest::test_full_audit_generation    (2.45s) 🐌
2. ClienteServiceTest::test_bulk_import               (1.23s) 🐌
3. PlanServiceTest::test_complex_query                (0.89s) ⚠️

💡 Optimization Suggestions:
- Test #1: Consider mocking external API calls
- Test #2: Use database transactions for cleanup
- Test #3: Add index on client_id for faster queries
```

---

## Integration with CI/CD

The command outputs in format compatible with CI/CD:

```
/run-tests --ci
```

Produces:
- JUnit XML report
- Coverage report (Clover XML)
- Exit code (0 = pass, 1 = fail)

---

## Watch Mode

```
/run-tests --watch
```

Automatically re-runs tests when files change:

```
👀 Watching for changes...

File changed: src/Modules/Cliente/Services/ClienteService.php
🔄 Re-running related tests...

✅ All tests passing!
```

---

## Command Options

```
/run-tests [options] [pattern]

Options:
  --filter=PATTERN     Run tests matching pattern
  --coverage           Show coverage report
  --performance        Show performance metrics
  --fix                Auto-fix simple failures
  --watch              Watch mode (re-run on changes)
  --ci                 CI/CD output format
  --verbose            Detailed output
  --quick              Skip slow tests

Examples:
  /run-tests Cliente
  /run-tests --coverage --filter=create
  /run-tests --fix --verbose
  /run-tests --watch --filter=Service
```

---

## Test Generation Helper

If tests don't exist:

```
/run-tests Cliente

No tests found for Cliente module.

Would you like me to generate test suite? (yes/no)
> yes

Generating tests for:
- ClienteService
- ClienteController
- ClienteValidator

✨ Generated 15 test cases!

Run tests now? (yes/no)
```

---

This command ensures code quality through automated testing! 🧪✨
