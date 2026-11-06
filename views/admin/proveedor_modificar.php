<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';

$idProveedor = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($idProveedor <= 0) {
    header("Location: proveedores.php?status=error");
    exit();
}

$proveedor = obtenerProveedorPorId($conexion, $idProveedor);

if (!$proveedor) {
    header("Location: proveedores.php?status=error");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Modificar Proveedor - Vinoteca</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>

            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <h1 class="mb-4">Modificar Proveedor</h1>

                <form action="../../controllers/admin/proveedor_modificar.php" method="POST" class="bg-light p-4 rounded border shadow-sm">

                    <input type="hidden" name="idProveedor" value="<?php echo $proveedor['idProveedor']; ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre del Proveedor:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($proveedor['nombre']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cuit" class="form-label fw-bold">CUIT del Proveedor:</label>
                        <input type="text" class="form-control" id="cuit" name="cuit" value="<?php echo htmlspecialchars($proveedor['cuit']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="razonSocial" class="form-label fw-bold">Razon Social del Proveedor:</label>
                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" value="<?php echo htmlspecialchars($proveedor['razonSocial']); ?>" required>
                    </div>
                    

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="proveedores.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>