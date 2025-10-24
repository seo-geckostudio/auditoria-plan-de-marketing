# UX Patterns Guide

**Descripción:** Patrones de experiencia de usuario para interfaces consistentes y profesionales

---

## 📋 Índice

1. [Loading States](#loading-states)
2. [Error States](#error-states)
3. [Empty States](#empty-states)
4. [Success Feedback](#success-feedback)
5. [Progressive Disclosure](#progressive-disclosure)
6. [Form Validation UX](#form-validation-ux)
7. [Confirmation Dialogs](#confirmation-dialogs)
8. [Infinite Scroll & Pagination](#infinite-scroll--pagination)
9. [Search UX](#search-ux)
10. [Responsive Tables](#responsive-tables)

---

## Loading States

### 1. Spinner Básico

**Cuándo usar:** Operaciones rápidas (< 2 segundos)

```html
<div class="loading-spinner">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="mt-2 text-muted">Cargando datos...</p>
</div>
```

```css
.loading-spinner {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 200px;
}
```

### 2. Skeleton Screens

**Cuándo usar:** Listados y tarjetas (mejora percepción de velocidad)

```html
<div class="skeleton-loader">
    <!-- Card skeleton -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="skeleton skeleton-title"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text short"></div>
        </div>
    </div>
</div>
```

```css
.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: skeleton-loading 1.5s ease-in-out infinite;
    border-radius: 4px;
}

.skeleton-title {
    height: 24px;
    width: 60%;
    margin-bottom: 12px;
}

.skeleton-text {
    height: 16px;
    width: 100%;
    margin-bottom: 8px;
}

.skeleton-text.short {
    width: 70%;
}

@keyframes skeleton-loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}
```

### 3. Progress Bar

**Cuándo usar:** Operaciones largas con progreso determinado

```html
<div class="progress-container">
    <div class="progress-header">
        <span>Procesando auditoría...</span>
        <span class="progress-percentage">45%</span>
    </div>
    <div class="progress" style="height: 8px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated"
             role="progressbar"
             style="width: 45%"
             aria-valuenow="45"
             aria-valuemin="0"
             aria-valuemax="100"></div>
    </div>
    <p class="progress-detail mt-2 text-muted small">
        Paso 3 de 5: Analizando keywords...
    </p>
</div>
```

```javascript
// Update progress
function updateProgress(percent, step, total, message) {
    document.querySelector('.progress-percentage').textContent = percent + '%';
    document.querySelector('.progress-bar').style.width = percent + '%';
    document.querySelector('.progress-bar').setAttribute('aria-valuenow', percent);
    document.querySelector('.progress-detail').textContent =
        `Paso ${step} de ${total}: ${message}`;
}
```

### 4. Button Loading State

**Cuándo usar:** Acciones de botones

```html
<button class="btn btn-primary" id="saveBtn" type="submit">
    <span class="btn-text">Guardar</span>
    <span class="btn-spinner d-none">
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        Guardando...
    </span>
</button>
```

```javascript
// Show loading
function setButtonLoading(button, loading) {
    if (loading) {
        button.disabled = true;
        button.querySelector('.btn-text').classList.add('d-none');
        button.querySelector('.btn-spinner').classList.remove('d-none');
    } else {
        button.disabled = false;
        button.querySelector('.btn-text').classList.remove('d-none');
        button.querySelector('.btn-spinner').classList.add('d-none');
    }
}

// Usage
document.getElementById('saveBtn').addEventListener('click', async function() {
    setButtonLoading(this, true);
    try {
        await saveData();
        showSuccess('Datos guardados correctamente');
    } catch (e) {
        showError('Error al guardar');
    } finally {
        setButtonLoading(this, false);
    }
});
```

---

## Error States

### 1. Inline Form Error

**Cuándo usar:** Errores de validación de campo

```html
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email"
           class="form-control is-invalid"
           id="email"
           value="usuario@invalido"
           aria-describedby="emailError">
    <div class="invalid-feedback" id="emailError">
        <i class="fa fa-exclamation-circle me-1"></i>
        El formato del email no es válido
    </div>
</div>
```

### 2. Alert Banner

**Cuándo usar:** Errores de operación general

```html
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fa fa-exclamation-triangle fa-2x me-3"></i>
        <div>
            <strong>Error al guardar los datos</strong>
            <p class="mb-0">No se pudo conectar con el servidor. Por favor, intenta nuevamente.</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
```

### 3. Error Page Component

**Cuándo usar:** Errores de carga de página completa

```html
<div class="error-state">
    <div class="error-icon">
        <i class="fa fa-exclamation-circle text-danger" style="font-size: 4rem;"></i>
    </div>
    <h2 class="error-title mt-3">No se pudo cargar la auditoría</h2>
    <p class="error-message text-muted">
        Ocurrió un error al intentar cargar los datos. Esto puede deberse a:
    </p>
    <ul class="error-reasons text-start text-muted">
        <li>La auditoría no existe o fue eliminada</li>
        <li>No tienes permisos para acceder a esta auditoría</li>
        <li>Problemas de conexión con el servidor</li>
    </ul>
    <div class="error-actions mt-4">
        <button class="btn btn-primary" onclick="location.reload()">
            <i class="fa fa-refresh me-2"></i>Reintentar
        </button>
        <a href="/auditorias" class="btn btn-outline-secondary ms-2">
            <i class="fa fa-arrow-left me-2"></i>Volver al listado
        </a>
    </div>
</div>
```

```css
.error-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    padding: 2rem;
}

.error-reasons {
    max-width: 500px;
    list-style-position: inside;
}
```

### 4. Toast Notification (Error)

**Cuándo usar:** Errores no críticos, feedback temporal

```html
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa fa-times-circle me-2"></i>
                Error al eliminar el archivo
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
```

```javascript
function showErrorToast(message) {
    const toastHTML = `
        <div class="toast align-items-center text-bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa fa-times-circle me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    const container = document.querySelector('.toast-container');
    container.insertAdjacentHTML('beforeend', toastHTML);

    const toastEl = container.lastElementChild;
    const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
}
```

---

## Empty States

### 1. Empty List

**Cuándo usar:** No hay registros para mostrar

```html
<div class="empty-state">
    <div class="empty-icon">
        <i class="fa fa-folder-open text-muted" style="font-size: 4rem;"></i>
    </div>
    <h3 class="empty-title mt-3">No hay auditorías todavía</h3>
    <p class="empty-message text-muted">
        Comienza creando tu primera auditoría SEO para analizar un cliente.
    </p>
    <a href="/auditorias/crear" class="btn btn-primary mt-3">
        <i class="fa fa-plus me-2"></i>Crear Primera Auditoría
    </a>
</div>
```

```css
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    padding: 3rem 1rem;
    text-align: center;
}

.empty-icon {
    opacity: 0.5;
}

.empty-title {
    font-size: 1.5rem;
    color: var(--bs-secondary);
}

.empty-message {
    max-width: 500px;
}
```

### 2. Empty Search Results

**Cuándo usar:** Búsqueda sin resultados

```html
<div class="empty-search-state">
    <i class="fa fa-search text-muted" style="font-size: 3rem;"></i>
    <h4 class="mt-3">No se encontraron resultados para "<?= htmlspecialchars($busqueda) ?>"</h4>
    <p class="text-muted">Intenta con otros términos de búsqueda o:</p>
    <ul class="search-suggestions text-muted">
        <li>Verifica la ortografía</li>
        <li>Usa términos más generales</li>
        <li>Prueba con sinónimos</li>
    </ul>
    <button class="btn btn-outline-secondary mt-3" onclick="clearSearch()">
        <i class="fa fa-times me-2"></i>Limpiar búsqueda
    </button>
</div>
```

### 3. Empty Filters

**Cuándo usar:** Filtros aplicados sin resultados

```html
<div class="empty-filter-state">
    <i class="fa fa-filter text-muted" style="font-size: 3rem;"></i>
    <h4 class="mt-3">No hay resultados con los filtros aplicados</h4>
    <p class="text-muted">
        Filtros activos:
        <span class="badge bg-secondary mx-1">Estado: Completada</span>
        <span class="badge bg-secondary mx-1">Cliente: Ibiza Villa</span>
    </p>
    <button class="btn btn-outline-primary mt-3" onclick="clearFilters()">
        <i class="fa fa-times me-2"></i>Limpiar filtros
    </button>
</div>
```

---

## Success Feedback

### 1. Success Toast

**Cuándo usar:** Confirmación de acciones exitosas

```javascript
function showSuccessToast(message) {
    const toastHTML = `
        <div class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa fa-check-circle me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    const container = document.querySelector('.toast-container');
    container.insertAdjacentHTML('beforeend', toastHTML);

    const toastEl = container.lastElementChild;
    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
}

// Usage
showSuccessToast('Auditoría guardada correctamente');
```

### 2. Success Banner

**Cuándo usar:** Éxito de operación importante

```html
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fa fa-check-circle fa-2x me-3"></i>
        <div>
            <strong>¡Auditoría completada!</strong>
            <p class="mb-0">Se generó el informe completo y se notificó al cliente.</p>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

### 3. Success Page

**Cuándo usar:** Confirmación de proceso completo

```html
<div class="success-page">
    <div class="success-icon">
        <i class="fa fa-check-circle text-success" style="font-size: 5rem;"></i>
    </div>
    <h2 class="success-title mt-3">¡Auditoría creada exitosamente!</h2>
    <p class="success-message text-muted">
        La auditoría se creó correctamente y está lista para comenzar.
    </p>
    <div class="success-details card mt-4" style="max-width: 500px;">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Auditoría:</dt>
                <dd class="col-sm-8">#AUD-2024-001</dd>

                <dt class="col-sm-4">Cliente:</dt>
                <dd class="col-sm-8">Ibiza Villa</dd>

                <dt class="col-sm-4">Consultor:</dt>
                <dd class="col-sm-8">Juan Pérez</dd>

                <dt class="col-sm-4">Estado:</dt>
                <dd class="col-sm-8"><span class="badge bg-info">En Progreso</span></dd>
            </dl>
        </div>
    </div>
    <div class="success-actions mt-4">
        <a href="/auditorias/123" class="btn btn-primary">
            <i class="fa fa-eye me-2"></i>Ver Auditoría
        </a>
        <a href="/auditorias" class="btn btn-outline-secondary ms-2">
            <i class="fa fa-list me-2"></i>Ver Todas
        </a>
    </div>
</div>
```

```css
.success-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 3rem 1rem;
    text-align: center;
}
```

---

## Progressive Disclosure

### 1. Accordion

**Cuándo usar:** Información organizada por secciones

```html
<div class="accordion" id="auditoriaAccordion">
    <!-- Fase 1 -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button"
                    data-bs-toggle="collapse" data-bs-target="#fase1">
                <i class="fa fa-check-circle text-success me-2"></i>
                Fase 1: Preparación
                <span class="badge bg-success ms-2">3/3 completados</span>
            </button>
        </h2>
        <div id="fase1" class="accordion-collapse collapse show"
             data-bs-parent="#auditoriaAccordion">
            <div class="accordion-body">
                <!-- Pasos de la fase -->
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fa fa-check text-success me-2"></i>
                            Checklist de accesos
                        </span>
                        <span class="badge bg-success">Completado</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fa fa-check text-success me-2"></i>
                            Brief de cliente
                        </span>
                        <span class="badge bg-success">Completado</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Fase 2 -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#fase2">
                <i class="fa fa-clock text-warning me-2"></i>
                Fase 2: Keyword Research
                <span class="badge bg-warning ms-2">2/4 completados</span>
            </button>
        </h2>
        <div id="fase2" class="accordion-collapse collapse"
             data-bs-parent="#auditoriaAccordion">
            <div class="accordion-body">
                <!-- Contenido -->
            </div>
        </div>
    </div>
</div>
```

### 2. Tabs

**Cuándo usar:** Vistas alternativas del mismo contexto

```html
<ul class="nav nav-tabs" id="auditoriaTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="resumen-tab"
                data-bs-toggle="tab" data-bs-target="#resumen" type="button">
            <i class="fa fa-chart-line me-2"></i>Resumen
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pasos-tab"
                data-bs-toggle="tab" data-bs-target="#pasos" type="button">
            <i class="fa fa-tasks me-2"></i>Pasos
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="archivos-tab"
                data-bs-toggle="tab" data-bs-target="#archivos" type="button">
            <i class="fa fa-folder me-2"></i>Archivos
        </button>
    </li>
</ul>

<div class="tab-content mt-3" id="auditoriaTabsContent">
    <div class="tab-pane fade show active" id="resumen" role="tabpanel">
        <!-- Contenido resumen -->
    </div>
    <div class="tab-pane fade" id="pasos" role="tabpanel">
        <!-- Contenido pasos -->
    </div>
    <div class="tab-pane fade" id="archivos" role="tabpanel">
        <!-- Contenido archivos -->
    </div>
</div>
```

### 3. Collapsible Sections

**Cuándo usar:** Detalles opcionales

```html
<div class="card">
    <div class="card-header">
        <button class="btn btn-link text-decoration-none w-100 text-start"
                type="button" data-bs-toggle="collapse" data-bs-target="#detalles">
            <i class="fa fa-chevron-down me-2"></i>
            Más detalles
        </button>
    </div>
    <div id="detalles" class="collapse">
        <div class="card-body">
            <!-- Contenido detallado -->
        </div>
    </div>
</div>
```

---

## Form Validation UX

### 1. Real-time Validation

```html
<div class="mb-3">
    <label for="dominio" class="form-label">Dominio del cliente</label>
    <input type="text"
           class="form-control"
           id="dominio"
           placeholder="ejemplo.com"
           aria-describedby="dominioHelp dominioError">
    <div class="form-text" id="dominioHelp">
        Ingresa el dominio sin http:// o https://
    </div>
    <div class="invalid-feedback" id="dominioError">
        <!-- Error dinámico aquí -->
    </div>
</div>
```

```javascript
const dominioInput = document.getElementById('dominio');

dominioInput.addEventListener('blur', function() {
    const value = this.value.trim();
    const errorDiv = document.getElementById('dominioError');

    // Clear previous state
    this.classList.remove('is-valid', 'is-invalid');

    if (value === '') {
        this.classList.add('is-invalid');
        errorDiv.textContent = 'El dominio es obligatorio';
        return;
    }

    // Validate domain format
    const domainRegex = /^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,}$/i;
    if (!domainRegex.test(value)) {
        this.classList.add('is-invalid');
        errorDiv.textContent = 'Formato de dominio inválido';
        return;
    }

    // Check if domain has http/https
    if (value.startsWith('http')) {
        this.classList.add('is-invalid');
        errorDiv.textContent = 'No incluyas http:// o https://';
        return;
    }

    // Valid
    this.classList.add('is-valid');
});
```

### 2. Multi-step Form

```html
<div class="multi-step-form">
    <!-- Progress indicator -->
    <div class="form-progress mb-4">
        <div class="form-step active">
            <div class="step-number">1</div>
            <div class="step-label">Información Básica</div>
        </div>
        <div class="form-step-connector"></div>
        <div class="form-step">
            <div class="step-number">2</div>
            <div class="step-label">Configuración</div>
        </div>
        <div class="form-step-connector"></div>
        <div class="form-step">
            <div class="step-number">3</div>
            <div class="step-label">Confirmación</div>
        </div>
    </div>

    <!-- Step content -->
    <form id="multiStepForm">
        <div class="form-step-content active" data-step="1">
            <!-- Step 1 fields -->
        </div>
        <div class="form-step-content" data-step="2">
            <!-- Step 2 fields -->
        </div>
        <div class="form-step-content" data-step="3">
            <!-- Step 3 fields -->
        </div>

        <!-- Navigation -->
        <div class="form-navigation d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-secondary" id="prevBtn" disabled>
                <i class="fa fa-arrow-left me-2"></i>Anterior
            </button>
            <button type="button" class="btn btn-primary" id="nextBtn">
                Siguiente<i class="fa fa-arrow-right ms-2"></i>
            </button>
            <button type="submit" class="btn btn-success d-none" id="submitBtn">
                <i class="fa fa-check me-2"></i>Finalizar
            </button>
        </div>
    </form>
</div>
```

```css
.form-progress {
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-step {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-bottom: 8px;
}

.form-step.active .step-number {
    background: var(--primary);
    color: white;
}

.form-step.completed .step-number {
    background: var(--success);
    color: white;
}

.step-label {
    font-size: 0.875rem;
    color: #6c757d;
}

.form-step.active .step-label {
    color: var(--primary);
    font-weight: 600;
}

.form-step-connector {
    width: 80px;
    height: 2px;
    background: #e9ecef;
    margin: 0 1rem 24px;
}

.form-step-content {
    display: none;
}

.form-step-content.active {
    display: block;
}
```

---

## Confirmation Dialogs

### 1. Delete Confirmation

```html
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>¿Estás seguro de que deseas eliminar esta auditoría?</strong></p>
                <p class="text-muted">Esta acción no se puede deshacer. Se eliminarán:</p>
                <ul class="text-muted">
                    <li>Todos los pasos completados</li>
                    <li>Archivos adjuntos</li>
                    <li>Historial de cambios</li>
                </ul>
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle me-2"></i>
                    <strong>Tip:</strong> Puedes archivar en lugar de eliminar para mantener el historial.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-outline-warning" onclick="archiveItem()">
                    <i class="fa fa-archive me-2"></i>Archivar
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteItem()">
                    <i class="fa fa-trash me-2"></i>Eliminar Definitivamente
                </button>
            </div>
        </div>
    </div>
</div>
```

```javascript
function confirmDelete(id, nombre) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    // Store ID for later use
    document.getElementById('deleteModal').dataset.itemId = id;
    modal.show();
}

function deleteItem() {
    const modal = document.getElementById('deleteModal');
    const id = modal.dataset.itemId;

    // Show loading
    const deleteBtn = modal.querySelector('.btn-danger');
    const originalText = deleteBtn.innerHTML;
    deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Eliminando...';
    deleteBtn.disabled = true;

    // Perform delete
    fetch(`/api/auditorias/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-Token': getCsrfToken()
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(modal).hide();
            showSuccessToast('Auditoría eliminada correctamente');
            // Refresh or redirect
            location.reload();
        } else {
            showErrorToast('Error al eliminar');
            deleteBtn.innerHTML = originalText;
            deleteBtn.disabled = false;
        }
    })
    .catch(error => {
        showErrorToast('Error de conexión');
        deleteBtn.innerHTML = originalText;
        deleteBtn.disabled = false;
    });
}
```

---

## Infinite Scroll & Pagination

### 1. Classic Pagination

```html
<nav aria-label="Paginación">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentPage - 1 ?>">
                <i class="fa fa-chevron-left"></i>
            </a>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentPage + 1 ?>">
                <i class="fa fa-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>

<div class="text-center text-muted small">
    Mostrando <?= $showing ?> de <?= $total ?> resultados
</div>
```

### 2. Load More Button

```html
<div id="itemsList">
    <!-- Items here -->
</div>

<div class="text-center my-4" id="loadMoreContainer">
    <button class="btn btn-outline-primary" id="loadMoreBtn" onclick="loadMore()">
        <i class="fa fa-plus me-2"></i>Cargar más
    </button>
    <p class="text-muted small mt-2">
        Mostrando <span id="showingCount">10</span> de <span id="totalCount">45</span>
    </p>
</div>
```

```javascript
let currentPage = 1;
const perPage = 10;

async function loadMore() {
    const btn = document.getElementById('loadMoreBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Cargando...';

    try {
        currentPage++;
        const response = await fetch(`/api/auditorias?page=${currentPage}&per_page=${perPage}`);
        const data = await response.json();

        // Append items
        const container = document.getElementById('itemsList');
        data.items.forEach(item => {
            container.insertAdjacentHTML('beforeend', renderItem(item));
        });

        // Update counts
        document.getElementById('showingCount').textContent =
            container.children.length;

        // Hide button if no more
        if (data.hasMore === false) {
            document.getElementById('loadMoreContainer').style.display = 'none';
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-plus me-2"></i>Cargar más';

    } catch (error) {
        showErrorToast('Error al cargar más resultados');
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-plus me-2"></i>Cargar más';
    }
}
```

### 3. Infinite Scroll

```javascript
let loading = false;
let hasMore = true;
let currentPage = 1;

// Intersection Observer for infinite scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !loading && hasMore) {
            loadMoreItems();
        }
    });
}, {
    rootMargin: '100px' // Load before reaching bottom
});

// Observe sentinel element
const sentinel = document.getElementById('scrollSentinel');
if (sentinel) {
    observer.observe(sentinel);
}

async function loadMoreItems() {
    if (loading || !hasMore) return;

    loading = true;
    showLoadingIndicator();

    try {
        currentPage++;
        const response = await fetch(`/api/items?page=${currentPage}`);
        const data = await response.json();

        appendItems(data.items);
        hasMore = data.hasMore;

        if (!hasMore) {
            observer.disconnect();
            showEndMessage();
        }
    } catch (error) {
        showErrorToast('Error al cargar más resultados');
    } finally {
        loading = false;
        hideLoadingIndicator();
    }
}
```

```html
<!-- HTML structure -->
<div id="itemsList">
    <!-- Items rendered here -->
</div>

<!-- Sentinel element for intersection observer -->
<div id="scrollSentinel"></div>

<!-- Loading indicator -->
<div id="scrollLoading" class="text-center py-4 d-none">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>

<!-- End message -->
<div id="scrollEnd" class="text-center py-4 text-muted d-none">
    <i class="fa fa-check-circle me-2"></i>
    Has visto todos los resultados
</div>
```

---

## Search UX

### 1. Search with Debounce

```html
<div class="search-box mb-4">
    <div class="input-group">
        <span class="input-group-text">
            <i class="fa fa-search"></i>
        </span>
        <input type="text"
               class="form-control"
               id="searchInput"
               placeholder="Buscar auditorías..."
               autocomplete="off">
        <button class="btn btn-outline-secondary" type="button" id="clearSearch"
                style="display: none;">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div id="searchResults" class="search-results mt-2"></div>
</div>
```

```javascript
// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), wait);
    };
}

const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
const clearBtn = document.getElementById('clearSearch');

// Search handler with debounce
const handleSearch = debounce(async function(query) {
    if (query.length < 2) {
        searchResults.innerHTML = '';
        searchResults.classList.remove('show');
        return;
    }

    searchResults.innerHTML = '<div class="text-center py-3"><div class="spinner-border spinner-border-sm"></div></div>';
    searchResults.classList.add('show');

    try {
        const response = await fetch(`/api/search?q=${encodeURIComponent(query)}`);
        const data = await response.json();

        if (data.results.length === 0) {
            searchResults.innerHTML = `
                <div class="search-no-results py-3 px-3 text-center text-muted">
                    <i class="fa fa-search me-2"></i>
                    No se encontraron resultados para "${query}"
                </div>
            `;
        } else {
            searchResults.innerHTML = data.results.map(item => `
                <a href="${item.url}" class="search-result-item">
                    <div class="result-title">${highlightMatch(item.title, query)}</div>
                    <div class="result-meta text-muted small">${item.meta}</div>
                </a>
            `).join('');
        }
    } catch (error) {
        searchResults.innerHTML = '<div class="alert alert-danger m-2">Error al buscar</div>';
    }
}, 300);

searchInput.addEventListener('input', function() {
    const query = this.value.trim();
    clearBtn.style.display = query ? 'block' : 'none';
    handleSearch(query);
});

clearBtn.addEventListener('click', function() {
    searchInput.value = '';
    searchResults.innerHTML = '';
    searchResults.classList.remove('show');
    this.style.display = 'none';
    searchInput.focus();
});

function highlightMatch(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
}
```

```css
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    max-height: 400px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-results.show {
    display: block;
}

.search-result-item {
    display: block;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f0f0f0;
    text-decoration: none;
    color: inherit;
    transition: background 0.2s;
}

.search-result-item:hover {
    background: #f8f9fa;
}

.search-result-item:last-child {
    border-bottom: none;
}

.result-title mark {
    background: yellow;
    padding: 0 2px;
}
```

---

## Responsive Tables

### 1. Stacked on Mobile

```html
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Auditoría</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Progreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Auditoría">AUD-2024-001</td>
                <td data-label="Cliente">Ibiza Villa</td>
                <td data-label="Estado">
                    <span class="badge bg-info">En Progreso</span>
                </td>
                <td data-label="Progreso">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar" style="width: 45%"></div>
                    </div>
                    <span class="small text-muted">45%</span>
                </td>
                <td data-label="Acciones">
                    <button class="btn btn-sm btn-primary">Ver</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
```

```css
@media (max-width: 768px) {
    .table-responsive table {
        border: 0;
    }

    .table-responsive thead {
        display: none;
    }

    .table-responsive tbody tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
    }

    .table-responsive td {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #f0f0f0;
    }

    .table-responsive td:last-child {
        border-bottom: none;
    }

    .table-responsive td::before {
        content: attr(data-label);
        font-weight: 600;
        margin-right: 1rem;
    }
}
```

---

## 💡 Tips de Implementación

### 1. Principios Generales

- **Feedback inmediato:** Usuario debe saber qué está pasando
- **Consistencia:** Mismo patrón para misma acción
- **Claridad:** Mensajes descriptivos, no técnicos
- **Recuperabilidad:** Siempre ofrecer forma de recuperarse
- **Prevención:** Evitar errores antes que corregirlos

### 2. Accesibilidad

```html
<!-- Siempre incluir -->
- aria-label en iconos sin texto
- aria-describedby en errores de formulario
- role="status" en mensajes dinámicos
- role="alert" en errores críticos

<!-- Ejemplo -->
<button aria-label="Eliminar auditoría">
    <i class="fa fa-trash" aria-hidden="true"></i>
</button>

<div role="alert" class="alert alert-danger">
    Error crítico que requiere atención
</div>
```

### 3. Performance

- Usar skeleton screens en lugar de spinners cuando sea posible
- Debounce en búsquedas (300ms)
- Lazy load de imágenes
- Virtual scrolling para listas muy largas

---

**Estos patrones crean experiencias consistentes, predecibles y profesionales que mejoran la satisfacción del usuario!**
