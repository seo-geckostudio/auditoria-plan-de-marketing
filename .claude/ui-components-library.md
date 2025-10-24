# UI Components Library - Marketing Control Panel

**Purpose:** Reusable UI components for consistent design across MCP
**Framework:** Limitless Admin Template + Bootstrap 5
**Style Guide:** Modern, professional, gradient-based

---

## 🎨 Design System

### Color Palette

```css
/* Primary Colors */
--primary: #2563eb;           /* Blue - Main actions */
--primary-dark: #1e40af;      /* Blue dark - Hover states */
--primary-light: #60a5fa;     /* Blue light - Backgrounds */

/* Semantic Colors */
--success: #10b981;           /* Green - Success states */
--warning: #f59e0b;           /* Orange - Warnings */
--danger: #ef4444;            /* Red - Errors */
--info: #3b82f6;              /* Light blue - Info */

/* Neutral Colors */
--gray-50: #f9fafb;
--gray-100: #f3f4f6;
--gray-200: #e5e7eb;
--gray-300: #d1d5db;
--gray-700: #374151;
--gray-900: #111827;

/* Gradients */
--gradient-primary: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
--gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
--gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
```

### Typography

```css
/* Font Family */
--font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
--font-mono: 'Fira Code', 'Courier New', monospace;

/* Font Sizes */
--text-xs: 0.75rem;    /* 12px */
--text-sm: 0.875rem;   /* 14px */
--text-base: 1rem;     /* 16px */
--text-lg: 1.125rem;   /* 18px */
--text-xl: 1.25rem;    /* 20px */
--text-2xl: 1.5rem;    /* 24px */
--text-3xl: 1.875rem;  /* 30px */

/* Font Weights */
--font-normal: 400;
--font-medium: 500;
--font-semibold: 600;
--font-bold: 700;
```

### Spacing

```css
/* Spacing Scale (Tailwind-inspired) */
--space-1: 0.25rem;   /* 4px */
--space-2: 0.5rem;    /* 8px */
--space-3: 0.75rem;   /* 12px */
--space-4: 1rem;      /* 16px */
--space-6: 1.5rem;    /* 24px */
--space-8: 2rem;      /* 32px */
--space-12: 3rem;     /* 48px */
```

---

## 📦 Component Library

### 1. Page Header

**Use:** Top of every page for title and actions

```php
<!-- components/page-header.php -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h1><?= $pageTitle ?></h1>
            <?php if (isset($subtitle)): ?>
                <p class="text-muted"><?= $subtitle ?></p>
            <?php endif; ?>
        </div>

        <div class="page-actions">
            <?= $headerActions ?? '' ?>
        </div>
    </div>

    <?php if (isset($breadcrumbs)): ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $crumb): ?>
                    <li class="breadcrumb-item">
                        <?php if (isset($crumb['url'])): ?>
                            <a href="<?= $crumb['url'] ?>"><?= $crumb['label'] ?></a>
                        <?php else: ?>
                            <?= $crumb['label'] ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
    <?php endif; ?>
</div>

<style>
.page-header {
    background: var(--gradient-primary);
    color: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.page-title h1 {
    font-size: var(--text-3xl);
    font-weight: var(--font-bold);
    margin: 0;
}

.page-title .text-muted {
    color: rgba(255, 255, 255, 0.8);
    margin-top: 0.5rem;
}
</style>
```

**Usage:**
```php
<?php
$pageTitle = "Clientes";
$subtitle = "Gestión de clientes y auditorías";
$breadcrumbs = [
    ['label' => 'Home', 'url' => '/'],
    ['label' => 'Clientes']
];
$headerActions = '<a href="/clientes/nuevo" class="btn btn-light">
    <i class="fa fa-plus"></i> Nuevo Cliente
</a>';

include 'components/page-header.php';
?>
```

---

### 2. Stat Cards (Tarjetas de Métricas)

**Use:** Dashboard metrics, KPIs

```php
<!-- components/stat-card.php -->
<div class="stat-card stat-card-<?= $variant ?? 'primary' ?>">
    <div class="stat-icon">
        <i class="<?= $icon ?>"></i>
    </div>
    <div class="stat-content">
        <span class="stat-label"><?= $label ?></span>
        <span class="stat-value"><?= $value ?></span>
        <?php if (isset($change)): ?>
            <span class="stat-change stat-change-<?= $change >= 0 ? 'up' : 'down' ?>">
                <i class="fa fa-<?= $change >= 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                <?= abs($change) ?>%
            </span>
        <?php endif; ?>
    </div>
</div>

<style>
.stat-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    border-color: var(--primary);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-card-primary .stat-icon {
    background: var(--gradient-primary);
    color: white;
}

.stat-card-success .stat-icon {
    background: var(--gradient-success);
    color: white;
}

.stat-content {
    flex: 1;
}

.stat-label {
    display: block;
    font-size: var(--text-sm);
    color: var(--gray-700);
    margin-bottom: 0.25rem;
}

.stat-value {
    display: block;
    font-size: var(--text-2xl);
    font-weight: var(--font-bold);
    color: var(--gray-900);
}

.stat-change {
    display: inline-block;
    font-size: var(--text-sm);
    font-weight: var(--font-semibold);
    margin-top: 0.25rem;
}

.stat-change-up {
    color: var(--success);
}

.stat-change-down {
    color: var(--danger);
}
</style>
```

**Usage:**
```php
<div class="row">
    <div class="col-md-3">
        <?php
        $icon = 'fa fa-users';
        $label = 'Total Clientes';
        $value = '24';
        $change = 12.5;
        $variant = 'primary';
        include 'components/stat-card.php';
        ?>
    </div>
    <div class="col-md-3">
        <?php
        $icon = 'fa fa-chart-line';
        $label = 'Auditorías Completadas';
        $value = '156';
        $change = 8.3;
        $variant = 'success';
        include 'components/stat-card.php';
        ?>
    </div>
</div>
```

---

### 3. Data Table (Tabla de Datos)

**Use:** List views, reports

```php
<!-- components/data-table.php -->
<div class="data-table-wrapper">
    <?php if (!empty($filters)): ?>
        <div class="data-table-filters">
            <?= $filters ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table data-table">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th <?= isset($column['sortable']) && $column['sortable'] ? 'class="sortable"' : '' ?>>
                            <?= $column['label'] ?>
                            <?php if (isset($column['sortable']) && $column['sortable']): ?>
                                <i class="fa fa-sort"></i>
                            <?php endif; ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr>
                        <td colspan="<?= count($columns) ?>" class="text-center text-muted py-5">
                            <i class="fa fa-inbox fa-3x mb-3 d-block"></i>
                            <?= $emptyMessage ?? 'No hay datos para mostrar' ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td>
                                    <?php if (isset($column['render'])): ?>
                                        <?= $column['render']($row) ?>
                                    <?php else: ?>
                                        <?= $row[$column['field']] ?? '-' ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($pagination)): ?>
        <div class="data-table-pagination">
            <?= $pagination ?>
        </div>
    <?php endif; ?>
</div>

<style>
.data-table-wrapper {
    background: white;
    border-radius: 0.75rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.data-table-filters {
    padding: 1.5rem;
    border-bottom: 1px solid var(--gray-200);
    background: var(--gray-50);
}

.data-table {
    margin: 0;
}

.data-table thead {
    background: var(--gradient-primary);
    color: white;
}

.data-table th {
    font-weight: var(--font-semibold);
    padding: 1rem;
    border: none;
}

.data-table th.sortable {
    cursor: pointer;
    user-select: none;
}

.data-table th.sortable:hover {
    background: rgba(255, 255, 255, 0.1);
}

.data-table tbody tr {
    transition: background 0.2s ease;
}

.data-table tbody tr:hover {
    background: var(--gray-50);
}

.data-table td {
    padding: 1rem;
    vertical-align: middle;
}

.data-table-pagination {
    padding: 1.5rem;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
```

---

### 4. Form Components

**Modern form fields with validation states**

```php
<!-- components/form-input.php -->
<div class="form-group <?= isset($error) ? 'has-error' : '' ?>">
    <label for="<?= $id ?>" class="form-label">
        <?= $label ?>
        <?php if ($required ?? false): ?>
            <span class="text-danger">*</span>
        <?php endif; ?>
    </label>

    <input
        type="<?= $type ?? 'text' ?>"
        class="form-control <?= isset($error) ? 'is-invalid' : '' ?>"
        id="<?= $id ?>"
        name="<?= $name ?>"
        value="<?= htmlspecialchars($value ?? '') ?>"
        <?= ($required ?? false) ? 'required' : '' ?>
        <?= isset($placeholder) ? 'placeholder="' . htmlspecialchars($placeholder) . '"' : '' ?>
    >

    <?php if (isset($helpText)): ?>
        <small class="form-text text-muted"><?= $helpText ?></small>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="invalid-feedback d-block">
            <?= $error ?>
        </div>
    <?php endif; ?>
</div>

<style>
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: var(--font-medium);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border-radius: 0.5rem;
    border: 2px solid var(--gray-200);
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

.form-control.is-invalid {
    border-color: var(--danger);
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}
</style>
```

---

### 5. Alert/Notification Component

```php
<!-- components/alert.php -->
<div class="alert alert-<?= $type ?? 'info' ?> alert-dismissible fade show" role="alert">
    <div class="alert-icon">
        <i class="fa fa-<?= $icons[$type] ?? 'info-circle' ?>"></i>
    </div>
    <div class="alert-content">
        <?php if (isset($title)): ?>
            <strong class="alert-title"><?= $title ?></strong>
        <?php endif; ?>
        <div class="alert-message"><?= $message ?></div>
    </div>
    <?php if ($dismissible ?? true): ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <?php endif; ?>
</div>

<?php
$icons = [
    'success' => 'check-circle',
    'danger' => 'exclamation-circle',
    'warning' => 'exclamation-triangle',
    'info' => 'info-circle'
];
?>

<style>
.alert {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: 0.75rem;
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.alert-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
}

.alert-title {
    display: block;
    margin-bottom: 0.25rem;
}

.alert-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
}

.alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
}

.alert-warning {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
}

.alert-info {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1e40af;
}
</style>
```

---

### 6. Badge Component

```php
<!-- components/badge.php -->
<span class="badge badge-<?= $variant ?? 'primary' ?> badge-<?= $size ?? 'md' ?>">
    <?php if (isset($icon)): ?>
        <i class="<?= $icon ?>"></i>
    <?php endif; ?>
    <?= $text ?>
</span>

<style>
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-weight: var(--font-semibold);
    border-radius: 0.375rem;
    white-space: nowrap;
}

.badge-sm {
    padding: 0.25rem 0.5rem;
    font-size: var(--text-xs);
}

.badge-md {
    padding: 0.375rem 0.75rem;
    font-size: var(--text-sm);
}

.badge-lg {
    padding: 0.5rem 1rem;
    font-size: var(--text-base);
}

.badge-primary {
    background: var(--primary);
    color: white;
}

.badge-success {
    background: var(--success);
    color: white;
}

.badge-warning {
    background: var(--warning);
    color: white;
}

.badge-danger {
    background: var(--danger);
    color: white;
}

.badge-secondary {
    background: var(--gray-200);
    color: var(--gray-700);
}
</style>
```

---

### 7. Modal Component

```php
<!-- components/modal.php -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1">
    <div class="modal-dialog modal-<?= $size ?? 'md' ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= $content ?>
            </div>
            <?php if (isset($footer)): ?>
                <div class="modal-footer">
                    <?= $footer ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.modal-content {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
    background: var(--gradient-primary);
    color: white;
    border-radius: 1rem 1rem 0 0;
    padding: 1.5rem;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    padding: 2rem;
}

.modal-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--gray-200);
}
</style>
```

---

## 🎯 Usage Patterns

### Dashboard Layout

```php
<!-- views/dashboard/index.php -->
<?php
$pageTitle = "Dashboard";
$subtitle = "Resumen general de actividad";
include 'components/page-header.php';
?>

<!-- Stats Grid -->
<div class="row mb-4">
    <div class="col-md-3">
        <?php
        $icon = 'fa fa-users';
        $label = 'Total Clientes';
        $value = '24';
        $change = 12.5;
        $variant = 'primary';
        include 'components/stat-card.php';
        ?>
    </div>
    <!-- More stats... -->
</div>

<!-- Recent Activity Table -->
<?php
$columns = [
    ['label' => 'Cliente', 'field' => 'nombre', 'sortable' => true],
    ['label' => 'Acción', 'field' => 'accion'],
    ['label' => 'Fecha', 'field' => 'fecha', 'sortable' => true],
    ['label' => 'Estado', 'field' => 'estado', 'render' => function($row) {
        $variant = $row['estado'] === 'completado' ? 'success' : 'warning';
        $text = ucfirst($row['estado']);
        include 'components/badge.php';
    }]
];

$rows = $actividades; // From controller
include 'components/data-table.php';
?>
```

---

## ✅ Component Checklist

When creating new components:

- [ ] Follows design system colors and spacing
- [ ] Responsive design (mobile-first)
- [ ] Accessible (ARIA labels, keyboard navigation)
- [ ] Has hover/focus states
- [ ] Has loading/disabled states
- [ ] Supports dark mode (future)
- [ ] Documented with usage examples
- [ ] Tested on Chrome, Firefox, Safari
- [ ] Supports RTL (future)

---

This component library ensures **consistency, speed, and quality** across the MCP! 🎨
