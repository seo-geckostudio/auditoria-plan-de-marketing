<?php
/**
 * VISTA: Editar Cliente
 * 
 * Formulario para editar un cliente existente.
 */

// Verificar que se incluya desde el sistema
if (!defined('SISTEMA_INICIADO')) {
    die('Acceso directo no permitido');
}

// Obtener errores de validación si existen
$errores = $_SESSION['errores_validacion'] ?? [];
$datos_formulario = $_SESSION['datos_formulario'] ?? $cliente;
unset($_SESSION['errores_validacion'], $_SESSION['datos_formulario']);
?>

<div class="container-fluid">
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-edit"></i>
                Editar Cliente
            </h1>
            <p class="mb-0 text-muted">
                Modificar información de: <strong><?= htmlspecialchars($cliente['nombre_empresa']) ?></strong>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="?modulo=clientes&accion=ver&id=<?= $cliente['id'] ?>" class="btn btn-outline-info me-2">
                <i class="fas fa-eye"></i>
                Ver Detalles
            </a>
            <a href="?modulo=clientes&accion=listar" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i>
                Volver a la Lista
            </a>
        </div>
    </div>

    <!-- Errores de validación -->
    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><i class="fas fa-exclamation-triangle"></i> Por favor, corrige los siguientes errores:</h6>
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información del Cliente
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="processor.php" novalidate>
                        <?= generarCampoCSRF() ?>
                        <input type="hidden" name="form_name" value="clientes_editar">
                        <input type="hidden" name="cliente_id" value="<?= $cliente['id'] ?>">
                        
                        <!-- Información de la Empresa -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-building"></i>
                                    Información de la Empresa
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre_empresa" class="form-label">
                                        Nombre de la Empresa <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= isset($errores['nombre_empresa']) ? 'is-invalid' : '' ?>" 
                                           id="nombre_empresa" 
                                           name="nombre_empresa" 
                                           value="<?= htmlspecialchars($datos_formulario['nombre_empresa'] ?? '') ?>"
                                           required
                                           maxlength="255"
                                           placeholder="Ej: Empresa ABC S.L.">
                                    <?php if (isset($errores['nombre_empresa'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['nombre_empresa']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="url_principal" class="form-label">
                                        Sitio Web Principal
                                    </label>
                                    <input type="url" 
                                           class="form-control <?= isset($errores['url_principal']) ? 'is-invalid' : '' ?>" 
                                           id="url_principal" 
                                           name="url_principal" 
                                           value="<?= htmlspecialchars($datos_formulario['url_principal'] ?? '') ?>"
                                           maxlength="500"
                                           placeholder="https://www.ejemplo.com">
                                    <?php if (isset($errores['url_principal'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['url_principal']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sector" class="form-label">
                                        Sector
                                    </label>
                                    <select class="form-select <?= isset($errores['sector']) ? 'is-invalid' : '' ?>" 
                                            id="sector" 
                                            name="sector">
                                        <option value="">Seleccionar sector...</option>
                                        <option value="Tecnología" <?= ($datos_formulario['sector'] ?? '') === 'Tecnología' ? 'selected' : '' ?>>Tecnología</option>
                                        <option value="E-commerce" <?= ($datos_formulario['sector'] ?? '') === 'E-commerce' ? 'selected' : '' ?>>E-commerce</option>
                                        <option value="Salud" <?= ($datos_formulario['sector'] ?? '') === 'Salud' ? 'selected' : '' ?>>Salud</option>
                                        <option value="Educación" <?= ($datos_formulario['sector'] ?? '') === 'Educación' ? 'selected' : '' ?>>Educación</option>
                                        <option value="Finanzas" <?= ($datos_formulario['sector'] ?? '') === 'Finanzas' ? 'selected' : '' ?>>Finanzas</option>
                                        <option value="Inmobiliario" <?= ($datos_formulario['sector'] ?? '') === 'Inmobiliario' ? 'selected' : '' ?>>Inmobiliario</option>
                                        <option value="Turismo" <?= ($datos_formulario['sector'] ?? '') === 'Turismo' ? 'selected' : '' ?>>Turismo</option>
                                        <option value="Retail" <?= ($datos_formulario['sector'] ?? '') === 'Retail' ? 'selected' : '' ?>>Retail</option>
                                        <option value="Servicios" <?= ($datos_formulario['sector'] ?? '') === 'Servicios' ? 'selected' : '' ?>>Servicios</option>
                                        <option value="Manufactura" <?= ($datos_formulario['sector'] ?? '') === 'Manufactura' ? 'selected' : '' ?>>Manufactura</option>
                                        <option value="Otro" <?= ($datos_formulario['sector'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                    </select>
                                    <?php if (isset($errores['sector'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['sector']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pais" class="form-label">
                                        País
                                    </label>
                                    <select class="form-select <?= isset($errores['pais']) ? 'is-invalid' : '' ?>" 
                                            id="pais" 
                                            name="pais">
                                        <option value="">Seleccionar país...</option>
                                        <option value="España" <?= ($datos_formulario['pais'] ?? '') === 'España' ? 'selected' : '' ?>>España</option>
                                        <option value="México" <?= ($datos_formulario['pais'] ?? '') === 'México' ? 'selected' : '' ?>>México</option>
                                        <option value="Argentina" <?= ($datos_formulario['pais'] ?? '') === 'Argentina' ? 'selected' : '' ?>>Argentina</option>
                                        <option value="Colombia" <?= ($datos_formulario['pais'] ?? '') === 'Colombia' ? 'selected' : '' ?>>Colombia</option>
                                        <option value="Chile" <?= ($datos_formulario['pais'] ?? '') === 'Chile' ? 'selected' : '' ?>>Chile</option>
                                        <option value="Perú" <?= ($datos_formulario['pais'] ?? '') === 'Perú' ? 'selected' : '' ?>>Perú</option>
                                        <option value="Venezuela" <?= ($datos_formulario['pais'] ?? '') === 'Venezuela' ? 'selected' : '' ?>>Venezuela</option>
                                        <option value="Ecuador" <?= ($datos_formulario['pais'] ?? '') === 'Ecuador' ? 'selected' : '' ?>>Ecuador</option>
                                        <option value="Uruguay" <?= ($datos_formulario['pais'] ?? '') === 'Uruguay' ? 'selected' : '' ?>>Uruguay</option>
                                        <option value="Paraguay" <?= ($datos_formulario['pais'] ?? '') === 'Paraguay' ? 'selected' : '' ?>>Paraguay</option>
                                        <option value="Bolivia" <?= ($datos_formulario['pais'] ?? '') === 'Bolivia' ? 'selected' : '' ?>>Bolivia</option>
                                        <option value="Estados Unidos" <?= ($datos_formulario['pais'] ?? '') === 'Estados Unidos' ? 'selected' : '' ?>>Estados Unidos</option>
                                        <option value="Otro" <?= ($datos_formulario['pais'] ?? '') === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                    </select>
                                    <?php if (isset($errores['pais'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['pais']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-user"></i>
                                    Información de Contacto
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contacto_nombre" class="form-label">
                                        Nombre del Contacto
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= isset($errores['contacto_nombre']) ? 'is-invalid' : '' ?>" 
                                           id="contacto_nombre" 
                                           name="contacto_nombre" 
                                           value="<?= htmlspecialchars($datos_formulario['contacto_nombre'] ?? '') ?>"
                                           maxlength="255"
                                           placeholder="Ej: Juan Pérez">
                                    <?php if (isset($errores['contacto_nombre'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['contacto_nombre']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contacto_email" class="form-label">
                                        Email de Contacto
                                    </label>
                                    <input type="email" 
                                           class="form-control <?= isset($errores['contacto_email']) ? 'is-invalid' : '' ?>" 
                                           id="contacto_email" 
                                           name="contacto_email" 
                                           value="<?= htmlspecialchars($datos_formulario['contacto_email'] ?? '') ?>"
                                           maxlength="255"
                                           placeholder="contacto@empresa.com">
                                    <?php if (isset($errores['contacto_email'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['contacto_email']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contacto_telefono" class="form-label">
                                        Teléfono de Contacto
                                    </label>
                                    <input type="tel" 
                                           class="form-control <?= isset($errores['contacto_telefono']) ? 'is-invalid' : '' ?>" 
                                           id="contacto_telefono" 
                                           name="contacto_telefono" 
                                           value="<?= htmlspecialchars($datos_formulario['contacto_telefono'] ?? '') ?>"
                                           maxlength="20"
                                           placeholder="+34 600 123 456">
                                    <?php if (isset($errores['contacto_telefono'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['contacto_telefono']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Notas Adicionales -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary border-bottom pb-2 mb-3">
                                    <i class="fas fa-sticky-note"></i>
                                    Información Adicional
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="notas" class="form-label">
                                        Notas
                                    </label>
                                    <textarea class="form-control <?= isset($errores['notas']) ? 'is-invalid' : '' ?>" 
                                              id="notas" 
                                              name="notas" 
                                              rows="4"
                                              maxlength="1000"
                                              placeholder="Información adicional sobre el cliente, objetivos, características especiales, etc."><?= htmlspecialchars($datos_formulario['notas'] ?? '') ?></textarea>
                                    <div class="form-text">
                                        Máximo 1000 caracteres. <span id="contador-notas">0</span>/1000
                                    </div>
                                    <?php if (isset($errores['notas'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['notas']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="activo" class="form-label">
                                        Estado del Cliente
                                    </label>
                                    <select class="form-select <?= isset($errores['activo']) ? 'is-invalid' : '' ?>" 
                                            id="activo" 
                                            name="activo">
                                        <option value="1" <?= ($datos_formulario['activo'] ?? $cliente['activo'] ?? '1') == '1' ? 'selected' : '' ?>>Activo</option>
                                        <option value="0" <?= ($datos_formulario['activo'] ?? $cliente['activo'] ?? '1') == '0' ? 'selected' : '' ?>>Inactivo</option>
                                    </select>
                                    <div class="form-text">
                                        Los clientes inactivos no aparecerán en los listados de selección
                                    </div>
                                    <?php if (isset($errores['activo'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errores['activo']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="?modulo=clientes&accion=ver&id=<?= $cliente['id'] ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Panel de información -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Información del Cliente
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="text-primary mb-0"><?= $estadisticas['total_auditorias'] ?></h5>
                                <small class="text-muted">Auditorías</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success mb-0"><?= $estadisticas['auditorias_completadas'] ?></h5>
                            <small class="text-muted">Completadas</small>
                        </div>
                    </div>
                    <hr>
                    <div class="small">
                        <p class="mb-1">
                            <strong>Creado:</strong> 
                            <?= date('d/m/Y H:i', strtotime($cliente['fecha_creacion'])) ?>
                        </p>
                        <?php if ($cliente['fecha_actualizacion']): ?>
                            <p class="mb-1">
                                <strong>Última actualización:</strong> 
                                <?= date('d/m/Y H:i', strtotime($cliente['fecha_actualizacion'])) ?>
                            </p>
                        <?php endif; ?>
                        <p class="mb-0">
                            <strong>Estado:</strong> 
                            <?php if ($cliente['activo'] ?? 1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb"></i>
                        Consejos de Edición
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Mantén actualizada la información de contacto</li>
                        <li>Verifica que la URL del sitio web sea correcta</li>
                        <li>Las notas pueden incluir objetivos específicos del cliente</li>
                        <li>Si cambias información crítica, considera notificar al equipo</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contador de caracteres para notas
    const notasTextarea = document.getElementById('notas');
    const contadorNotas = document.getElementById('contador-notas');
    
    function actualizarContador() {
        const longitud = notasTextarea.value.length;
        contadorNotas.textContent = longitud;
        
        if (longitud > 900) {
            contadorNotas.className = 'text-warning';
        } else if (longitud > 950) {
            contadorNotas.className = 'text-danger';
        } else {
            contadorNotas.className = '';
        }
    }
    
    notasTextarea.addEventListener('input', actualizarContador);
    actualizarContador(); // Inicializar contador
    
    // Validación del formulario
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        let esValido = true;
        
        // Validar nombre de empresa
        const nombreEmpresa = document.getElementById('nombre_empresa');
        if (!nombreEmpresa.value.trim()) {
            nombreEmpresa.classList.add('is-invalid');
            esValido = false;
        } else {
            nombreEmpresa.classList.remove('is-invalid');
        }
        
        // Validar URL si se proporciona
        const urlPrincipal = document.getElementById('url_principal');
        if (urlPrincipal.value && !isValidURL(urlPrincipal.value)) {
            urlPrincipal.classList.add('is-invalid');
            esValido = false;
        } else {
            urlPrincipal.classList.remove('is-invalid');
        }
        
        // Validar email si se proporciona
        const contactoEmail = document.getElementById('contacto_email');
        if (contactoEmail.value && !isValidEmail(contactoEmail.value)) {
            contactoEmail.classList.add('is-invalid');
            esValido = false;
        } else {
            contactoEmail.classList.remove('is-invalid');
        }
        
        if (!esValido) {
            e.preventDefault();
            alert('Por favor, corrige los errores en el formulario antes de continuar.');
        }
    });
    
    // Funciones de validación
    function isValidURL(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }
    
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
</script>