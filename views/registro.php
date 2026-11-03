<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Nuevo Usuario - E-commerce</title>
    <!-- Enlace a Bootstrap usando tu estructura de assets -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center py-5" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 fw-bold">Crear Cuenta</h3>

                        <!-- BLOQUE PARA MOSTRAR ALERTAS SEGÚN EL ERROR O ÉXITO -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                        <!-- FORMULARIO DE REGISTRO -->
                        <form action="../controllers/usuario_registrar.php" method="POST">
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ej: Juan Pérez">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="correo@ejemplo.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Mínimo 6 caracteres">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Registrarse</button>
                        </form>

                        <div class="text-center">
                            <a href="login.php" class="text-decoration-none small">¿Ya tienes una cuenta? Inicia sesión aquí</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script de Bootstrap para el cierre de alertas -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>