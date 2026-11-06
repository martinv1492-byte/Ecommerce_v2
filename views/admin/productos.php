<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
include(__DIR__ . '/../../models/producto.php');

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
$listado = obtenerProductos($conexion, $categoriaSeleccionada);
$categorias = obtenerCategorias($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Panel de Productos - Vinoteca</title>
</head>
<body>

    <!-- Contenedor general que divide la pantalla en dos columnas fijas sin desborde -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            
            <!-- Sidebar con ancho fijo para proteger el espacio de la tabla -->
            <div class="col-auto px-0 bg-dark" style="width: 220px; min-height: 100vh;">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>

            <!-- Contenido Principal -->
            <div class="col px-md-4 py-4 overflow-hidden">
                
                <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Excelente!</strong> El producto se ha guardado correctamente en la base de datos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hubo un problema.</strong> No se pudo guardar el producto. Revisa los datos e intenta nuevamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Gestión de Productos</h1>
                </div>

                <form method="GET" action="" class="row g-3 align-items-center mb-4 bg-light p-3 rounded border">
                    <div class="col-auto">
                        <label for="categoria" class="col-form-label fw-bold">Filtrar por Categoría:</label>
                    </div>
                    <div class="col-auto">
                        <select name="categoria" id="categoria" class="form-select" onchange="this.form.submit()">
                            <option value="todas">-- Todas las categorías --</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat['idCategoria']; ?>" 
                                    <?php echo ($categoriaSeleccionada == $cat['idCategoria']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if (!empty($categoriaSeleccionada) && $categoriaSeleccionada !== 'todas'): ?>
                        <div class="col-auto">
                            <a href="productos.php" class="btn btn-outline-secondary btn-sm">Limpiar filtro</a>
                        </div>
                    <?php endif; ?>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle table-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center d-none d-md-table-cell">Codigo</th>
                                <th scope="col" class="text-center">Categoria</th>
                                <th scope="col" class="text-center d-none d-xl-table-cell">Descripcion</th>
                                <th scope="col" class="text-center d-none d-lg-table-cell">Costo</th>
                                <th scope="col" class="text-center">Precio</th>
                                <th scope="col" class="text-center d-none d-sm-table-cell">Foto</th>
                                <th scope="col" class="text-center">Proveedor</th>
                                <th scope="col" class="text-center">Stock</th>
                                <th scope="col" class="text-center d-none d-lg-table-cell">Marca</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listado)): ?>
                                <?php foreach ($listado as $producto): ?>
                                <tr>
                                    <td><?php echo $producto["idProducto"]; ?></td>
                                    <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                                    <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($producto["codigo"]); ?></td>
                                    <td><?php echo htmlspecialchars($producto["nombre_categoria"] ?? 'Sin categoría'); ?></td>
                                    <td class="d-none d-xl-table-cell"><?php echo htmlspecialchars($producto["descripcion"]); ?></td>
                                    <td class="d-none d-lg-table-cell">$<?php echo number_format($producto["costo"], 2); ?></td>
                                    <td>$<?php echo number_format($producto["precio"], 2); ?></td>
                                    <td class="text-center d-none d-sm-table-cell">
                                        <img src="<?php echo htmlspecialchars($producto["foto"]); ?>" style="width: 40px; height: 40px; object-fit: cover;" alt="Foto producto">
                                    </td>
                                    <td><?php echo htmlspecialchars($producto["nombre_proveedor"] ?? 'Sin proveedor'); ?></td>
                                    <td><?php echo $producto["stock"]; ?></td>
                                    <td class="d-none d-lg-table-cell"><?php echo htmlspecialchars($producto["marca"]); ?></td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="producto_actualizar.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-sm btn-outline-secondary" title="Modificar">✏️</a>
                                            <a href="producto_eliminado.php?id=<?php echo $producto['idProducto']; ?>&nombre=<?php echo urlencode($producto['nombre']); ?>&marca=<?php echo urlencode($producto['marca']);?>" class="btn btn-sm btn-outline-danger" title="Eliminar">🗑️</a>
                                        </div>
                                    </td>                                       
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center">No hay productos registrados en esta categoría.</td>
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