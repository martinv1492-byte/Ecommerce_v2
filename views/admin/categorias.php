<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php'; 

$categorias = obtenerCategorias($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Gestión de Categorías - Vinoteca</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>
            
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">

                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ¡Operación realizada con éxito!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Ocurrió un error inesperado al procesar la categoría.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Categorías</h1>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre de la Categoría</th>
                                <th scope="col" class="text-center" style="width: 150px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categorias)): ?>
                                <?php foreach ($categorias as $cat): ?>
                                    <tr>
                                        <td><?php echo $cat["idCategoria"]; ?></td>
                                        <td><?php echo htmlspecialchars($cat["nombre"]); ?></td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                            <a href="../../controllers/admin/categoria_eliminar.php?id=<?php echo $cat['idCategoria']; ?>" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                            Eliminar
                                            </a>
                                            <a href="categoria_modificar.php?id=<?php echo $cat['idCategoria']; ?>"
                                            class="btn btn-sm btn-outline-secondary">
                                            Modificar
                                            </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay categorías registradas.</td>
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