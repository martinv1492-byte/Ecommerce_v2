<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php'; // Incluimos el modelo aquí

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
            <!-- Columna del Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>

            <!-- Columna del Contenido Principal -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Categorías</h1>
                    <a href="categoria_nueva.php" class="btn btn-success">Nueva Categoría</a>
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
                                            <a href="../../controllers/admin/categoria_eliminar.php?id=<?php echo $cat['idCategoria']; ?>" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">
                                            Eliminar
                                            </a>
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