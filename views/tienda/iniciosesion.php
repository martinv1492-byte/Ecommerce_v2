<?php
// 1. Cargamos el head y el header de la Vinoteca (Mantiene las rutas locales seguras)
include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<!-- El fondo gris claro de Bootstrap combina genial para hacer resaltar la tarjeta -->
<div class="bg-light py-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <!-- Eliminamos bordes redondeados con rounded-0 y sumamos sombra sutil -->
                <div class="card shadow-sm border-light-subtle rounded-0">
                    <div class="card-body p-4">
                        
                        <!-- Título con la tipografía elegante de la vinoteca -->
                        <h3 class="text-center mb-4 fw-bold text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                            Iniciar Sesión
                        </h3>

                        <!-- BLOQUE PARA MOSTRAR ALERTAS (Agregamos rounded-0 para mantener la estética recta) -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show rounded-0 small" role="alert">
                                <?php 
                                    if ($_GET['error'] === 'email_duplicado') {
                                        echo "El correo electrónico ya se encuentra registrado.";
                                    } elseif ($_GET['error'] === 'campos_vacios') {
                                        echo "Por favor, completa todos los campos obligatorios.";
                                    } else {
                                        echo "Ocurrió un error al procesar el registro.";
                                    }
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- FORMULARIO DE REGISTRO (Ajustá la ruta del action según tus controladores estructurales) -->
                        <form action="../../controllers/login.php" method="POST">
                            
                            <!-- Todos los inputs ahora llevan la clase rounded-0 para un look recto y moderno -->
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-semibold text-uppercase tracking-wider text-muted" style="font-size: 0.75rem;">Correo Electrónico</label>
                                <input type="email" class="form-control rounded-0" id="email" name="email" required placeholder="correo@ejemplo.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label small fw-semibold text-uppercase tracking-wider text-muted" style="font-size: 0.75rem;">Contraseña</label>
                                <input type="password" class="form-control rounded-0" id="password" name="password" required placeholder="Mínimo 6 caracteres">
                            </div>

                            <!-- Cambiamos btn-primary por btn-dark y sumamos rounded-0 + text-uppercase -->
                            <button type="submit" class="btn btn-dark rounded-0 w-100 py-2 mb-3 text-uppercase fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                Iniciar Sesión
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
// 2. Cargamos el footer de la Vinoteca (Cierra automáticamente el main, body y HTML, e incluye los JS locales)
include_once '../includes/tienda/footer.php';
?>