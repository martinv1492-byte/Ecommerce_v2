<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow rounded-0 border-0" style="width: 100%; max-width: 400px;">
    <div class="card-body p-4">
        <h3 class="card-title text-center mb-4 fw-bold" style="font-family: 'Times New Roman', serif;">Iniciar Sesión</h3>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center py-2 small rounded-0" role="alert">
                <?php 
                    if ($_GET['error'] == 'vacio') echo 'Por favor, llena todos los campos.';
                    if ($_GET['error'] == 'incorrecto') echo 'Correo o contraseña incorrectos.';
                    if ($_GET['error'] == 'acceso_denegado') echo 'Debes iniciar sesión como administrador.';
                ?>
            </div>
        <?php endif; ?>

        <form action="controllers/login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label small text-uppercase fw-semibold">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control rounded-0" required placeholder="admin@ecommerce.com">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label small text-uppercase fw-semibold">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control rounded-0" required placeholder="********">
            </div>

            <button type="submit" class="btn btn-dark rounded-0 w-100 mt-2 py-2 text-uppercase fw-semibold" style="letter-spacing: 1px;">Ingresar</button>
        </form>
    </div>
</div>
</body>
</html>