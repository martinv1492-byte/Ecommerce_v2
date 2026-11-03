<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - E-commerce</title>
    
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow" style="width: 100%; max-width: 400px;">
    <div class="card-body p-4">
        <h3 class="card-title text-center mb-4">Panel de Administración</h3>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center py-2" role="alert">
                <?php 
                    if ($_GET['error'] == 'vacio') echo 'Por favor, llena todos los campos.';
                    if ($_GET['error'] == 'incorrecto') echo 'Correo o contraseña incorrectos.';
                    if ($_GET['error'] == 'acceso_denegado') echo 'Debes iniciar sesión como administrador.';
                ?>
            </div>
        <?php endif; ?>

        <form action="controllers/login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="admin@ecommerce.com">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">Ingresar</button>
        </form>
    </div>
</div>

</body>
</html>
