# Marketing Control Panel - Claude Code Configuration

This `.claude/` directory contains the complete development environment configuration for building the Marketing Control Panel with Claude Code.

---

## 📁 Directory Structure

```
.claude/
├── settings.json              # Main project configuration
├── README.md                  # This file
├── agents/                    # Specialized AI agents
│   ├── php-architect.md
│   ├── module-generator.md
│   ├── database-designer.md
│   ├── api-integrator.md
│   └── code-reviewer.md
├── workflows/                 # Development workflows
│   ├── create-module.md
│   └── setup-api-integration.md
├── commands/                  # Slash commands
│   ├── generate-module.md
│   ├── review-code.md
│   └── run-tests.md
└── mcp/                       # MCP servers configuration
    └── mcp-config.json
```

---

## 🤖 Available Agents

### Development Agents

#### 1. **php-architect**
- **Purpose:** Design and architect PHP code following PSR-12 and PHP 8.1+ standards
- **Use when:** Creating new classes, refactoring, architectural decisions
- **Expertise:** MVC patterns, typed properties, dependency injection, SOLID principles

**Example usage:**
```
@php-architect

Design a service class for handling email notifications with:
- Queue support
- Template system
- Multiple providers (SMTP, SendGrid)
- Error handling and retry logic
```

#### 2. **module-generator**
- **Purpose:** Generate complete MVC modules with all boilerplate
- **Use when:** Creating new features or modules
- **Generates:** Controllers, Services, Models, Validators, Views, Migrations

**Example usage:**
```
@module-generator

Create PlanMarketing module with CRUD operations for marketing plans
```

#### 3. **database-designer**
- **Purpose:** Design optimized MySQL 8.0 schemas
- **Use when:** Creating tables, indexes, migrations
- **Expertise:** Normalization, indexing strategy, foreign keys, performance

**Example usage:**
```
@database-designer

Design schema for multi-tenant audit system with soft deletes and full audit trail
```

#### 4. **api-integrator**
- **Purpose:** Integrate external APIs (Google, Ahrefs, WordPress, Odoo)
- **Use when:** Adding new API integrations
- **Expertise:** OAuth 2.0, rate limiting, caching, error handling

**Example usage:**
```
@api-integrator

Integrate Google Analytics 4 API with OAuth 2.0 authentication and automatic token refresh
```

#### 5. **code-reviewer**
- **Purpose:** Comprehensive code review against project standards
- **Use when:** Before committing, after significant changes
- **Reviews:** Security, performance, style, documentation, testing

**Example usage:**
```
@code-reviewer

Review src/Modules/Cliente/Services/ClienteService.php focusing on security
```

---

## 🔄 Available Workflows

### 1. create-module.md
**Complete module creation workflow**

Steps:
1. Gather requirements
2. Design database schema
3. Generate module files
4. Register routes
5. Run migrations
6. Test manually
7. Write tests
8. Document

**Time:** ~30 minutes
**Result:** Production-ready module

### 2. setup-api-integration.md
**External API integration workflow**

Steps:
1. Obtain credentials
2. Store securely
3. Create wrapper service
4. Implement auth
5. Add rate limiting
6. Implement caching
7. Test integration
8. Update UI

**Time:** ~45 minutes
**Result:** Secure, robust API integration

---

## ⚡ Available Commands

### /generate-module {ModuleName}
Generate complete MVC module with interactive prompts

**Example:**
```
/generate-module PlanMarketing
```

Generates:
- Controllers, Services, Models, Validators, Views
- Database migration
- Route registration
- Test stubs

---

### /review-code [path]
Comprehensive code review with actionable feedback

**Example:**
```
/review-code src/Modules/Cliente/
```

Reviews:
- Security vulnerabilities
- Performance issues
- PSR-12 compliance
- Documentation
- Testing coverage

---

### /run-tests [pattern]
Execute PHPUnit tests with detailed results

**Example:**
```
/run-tests Cliente --coverage
```

Shows:
- Pass/fail summary
- Coverage report
- Failure analysis
- Fix suggestions

---

## 🔧 MCP Servers

### Enabled by Default

#### filesystem
- **Purpose:** Read/write code files
- **Permissions:** Read all, write to src/, database/, tests/
- **Security:** Denies .env and credentials

#### git
- **Purpose:** Version control operations
- **Usage:** Commits, branches, diffs, logs

#### brave-search
- **Purpose:** Web search for documentation and solutions
- **Use cases:** API docs, error solutions, best practices

#### puppeteer
- **Purpose:** Browser automation for testing
- **Use cases:** Screenshots, E2E tests, responsive testing

#### sequential-thinking
- **Purpose:** Step-by-step reasoning for complex problems
- **Use cases:** Architecture decisions, debugging

#### memory
- **Purpose:** Persistent memory across sessions
- **Stores:** Project context, decisions, common issues

#### fetch
- **Purpose:** HTTP requests to APIs and web pages
- **Use cases:** Test APIs, fetch documentation

### Disabled by Default (Enable When Needed)

#### database
- **Purpose:** Direct MySQL access
- **⚠️ Security:** Enable only when needed, never in production

#### github
- **Purpose:** GitHub API access
- **Usage:** Issues, PRs, code search

---

## 🚀 Quick Start

### 1. Initialize Project

The `.claude/` configuration is ready to use. Just start coding!

### 2. Create First Module

```
/generate-module Cliente
```

Follow the interactive prompts to create your first module.

### 3. Review Generated Code

```
/review-code src/Modules/Cliente/
```

Verify quality before committing.

### 4. Run Tests

```
/run-tests Cliente
```

Ensure everything works.

### 5. Commit Changes

```
I'll use git MCP to commit with a good message
```

---

## 📚 Best Practices

### When to Use Which Agent

**Architecture Decisions:**
- Use `@php-architect` for high-level design
- Use `@sequential-thinking` MCP for complex reasoning
- Use `@memory` MCP to store decisions

**Creating Features:**
- Use `/generate-module` command for quick scaffolding
- Use `create-module` workflow for guided process
- Use `@module-generator` agent for custom requirements

**API Integration:**
- Follow `setup-api-integration` workflow
- Use `@api-integrator` agent for custom APIs
- Use `fetch` MCP to test endpoints first

**Code Quality:**
- Use `/review-code` before every commit
- Use `@code-reviewer` for detailed analysis
- Use `/run-tests` to verify functionality

### Development Flow

```
1. Plan feature → @php-architect
2. Design schema → @database-designer
3. Generate module → /generate-module
4. Integrate APIs (if needed) → @api-integrator
5. Review code → /review-code
6. Run tests → /run-tests
7. Commit → git MCP
8. Document → Update docs/
```

---

## 🔒 Security Notes

### Critical Rules

1. **NEVER commit credentials**
   - Use `.env` for all secrets
   - `.env` is in `.gitignore`
   - Verify before every commit

2. **NEVER enable database MCP in production**
   - Only use for local development
   - Disable when not actively using

3. **ALWAYS review generated code**
   - AI is smart but not perfect
   - Check for security issues
   - Verify business logic

4. **ALWAYS use prepared statements**
   - Never concatenate user input in SQL
   - PHP Architect enforces this

---

## 🐛 Troubleshooting

### Agent not responding

**Problem:** Agent doesn't activate with `@agent-name`

**Solution:**
- Verify agent file exists in `.claude/agents/`
- Check file name matches exactly
- Restart Claude Code

### MCP server fails to start

**Problem:** MCP server initialization error

**Solution:**
- Check Node.js installed (14+)
- Verify npx available
- Check `mcp-config.json` syntax
- Review paths are absolute

### Generated code has errors

**Problem:** Module generation produces invalid code

**Solution:**
- Review requirements provided
- Check database migration syntax
- Use `/review-code` to find issues
- Manually fix and commit

---

## 📖 Documentation

### Project Documentation
- Main: `README.md`
- Analysis: `ANALISIS_INTEGRACION_MCP_AUDITORIA.md`
- Specifications: `ESPECIFICACION_MARKETING_CONTROL_PANEL.md`
- Architecture: `ARQUITECTURA_IA_INTEGRADA.md`
- Improvements: `MEJORAS_FUNCIONALES_RECOMENDADAS.md`

### Code Documentation
- API Docs: `docs/api/` (generated)
- Module Docs: `docs/modules/`
- Database Schema: `docs/database/`

---

## 🎯 Next Steps

1. **Read the specifications**
   - ESPECIFICACION_MARKETING_CONTROL_PANEL.md
   - ARQUITECTURA_IA_INTEGRADA.md

2. **Understand the architecture**
   - Review ANALISIS_INTEGRACION_MCP_AUDITORIA.md
   - Decide implementation approach (Hybrid recommended)

3. **Start development**
   - Use `/generate-module Cliente` to create first module
   - Follow workflows for consistency
   - Leverage agents for quality

4. **Iterate and improve**
   - Review code frequently
   - Run tests regularly
   - Document decisions

---

## 💬 Getting Help

### Within Claude Code
- Ask agents directly: `@php-architect how do I...`
- Use `/help` command
- Search web with brave-search MCP

### External Resources
- PHP Documentation: https://php.net
- PSR-12: https://www.php-fig.org/psr/psr-12/
- MySQL Docs: https://dev.mysql.com/doc/
- Composer: https://getcomposer.org

---

**Ready to build amazing software with AI assistance! 🚀**

*Last updated: 2025-10-24*
*Version: 1.0.0*
