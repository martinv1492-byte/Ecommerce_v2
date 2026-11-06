<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Cargar Nuevo Proveedor - Panel Admin</title>
</head>
<body class="bg-light">

<div class="d-flex" style="min-height: 100vh;">
    
    <div class="bg-dark flex-shrink-0">
        <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
    </div>

    <div class="flex-grow-1 p-4 overflow-auto">
        
        <div class="container" style="max-width: 700px;">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold">Cargar Nuevo Proveedor</h4>
                </div>
                <div class="card-body p-4">

                    <?php if (isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>¡Atención!</strong> Todos los campos son obligatorios. Por favor, completa la información.
                        </div>
                    <?php endif; ?>

                    <form action="/ecommerce/controllers/admin/proveedor_guardar.php" method="POST">
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre del Proveedor</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Distribuidora Carmen" required>
                        </div>

                        <div class="mb-3">
                            <label for="cuit" class="form-label fw-bold">CUIT</label>
                            <input type="text" class="form-control" id="cuit" name="cuit" placeholder="Ej: 30123456789" required>
                        </div>

                        <div class="mb-4">
                            <label for="razonSocial" class="form-label fw-bold">Razón Social</label>
                            <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Ej: Distribuidora Carmen S.R.L." required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="proveedores.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>