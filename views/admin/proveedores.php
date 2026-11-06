<?php
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';

$proveedores = obtenerProveedores($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Gestión de Proveedores - Vinoteca</title>
</head>
<!-- Bloque de Alertas Dinámicas -->
<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] === 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Proveedor eliminado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['status'] === 'error_relacion'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error de integridad:</strong> No se puede eliminar este proveedor porque tiene productos asociados en el sistema.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($_GET['status'] === 'error'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Ocurrió un error inesperado al intentar eliminar el proveedor.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Columna del Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>

            <!-- Columna del Contenido Principal -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Proveedores</h1>
                    <a href="proveedor_nuevo.php" class="btn btn-success">Nuevo Proveedor</a>
                </div>

                <!-- Tabla para listar los proveedores -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>CUIT</th>
                                <th>Razón Social</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proveedores)): ?>
                                <?php foreach ($proveedores as $prov): ?>
                                    <tr>
                                        <td><?php echo $prov['idProveedor']; ?></td>
                                        <td><?php echo htmlspecialchars($prov['nombre']); ?></td>
                                        <td><?php echo htmlspecialchars($prov['cuit']); ?></td>
                                        <td><?php echo htmlspecialchars($prov['razonSocial']); ?></td>
                                        
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                            <a href="../../controllers/admin/proveedor_eliminar.php?id=<?php echo $prov['idProveedor']; ?>" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar este proveedor?');">
                                            Eliminar
                                            </a>
                                        
                                        
                                            <a href="proveedor_modificar.php?id=<?php echo $prov['idProveedor']; ?>"
                                            class="btn btn-sm btn-outline-secondary"
                                            onclick="return confirm('¿Estás seguro de modificar este proveedor?');">
                                            Modificar
                                            </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No hay proveedores registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>