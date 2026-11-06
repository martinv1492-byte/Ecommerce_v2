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
<body class="bg-light">

<!-- Contenedor principal con Flexbox puro sin columnas forzadas -->
<div class="d-flex" style="min-height: 100vh;">
    
    <!-- Sidebar fijo a la izquierda -->
    <div class="bg-dark flex-shrink-0">
        <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
    </div>

    <!-- Contenido principal que ocupa todo el ancho restante -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
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
            <h1 class="h3 mb-0 fw-bold">Gestión de Productos</h1>
        </div>

        <form method="GET" action="" class="row g-3 align-items-center mb-4 bg-white p-3 rounded border shadow-sm">
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

        <div class="table-responsive bg-white rounded border shadow-sm p-2">
            <table class="table table-striped table-bordered table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Precio</th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Marca</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listado)): ?>
                        <?php foreach ($listado as $producto): ?>
                        <tr>
                            <td><?php echo $producto["idProducto"]; ?></td>
                            <td class="fw-semibold"><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                            <td><code><?php echo htmlspecialchars($producto["codigo"]); ?></code></td>
                            <td><?php echo htmlspecialchars($producto["nombre_categoria"] ?? 'Sin categoría'); ?></td>
                            <td class="text-muted small" style="max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($producto["descripcion"]); ?>">
                                <?php echo htmlspecialchars($producto["descripcion"]); ?>
                            </td>
                            <td>$<?php echo number_format($producto["costo"], 2, ',', '.'); ?></td>
                            <td>$<?php echo number_format($producto["precio"], 2, ',', '.'); ?></td>
                            <td class="text-center">
                                <img src="<?php echo htmlspecialchars($producto["foto"]); ?>" style="width: 35px; height: 35px; object-fit: cover;" class="rounded border" alt="Foto">
                            </td>
                            <td><?php echo htmlspecialchars($producto["nombre_proveedor"] ?? 'Sin proveedor'); ?></td>
                            <td><span class="badge bg-secondary"><?php echo $producto["stock"]; ?></span></td>
                            <td class="small" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo htmlspecialchars($producto["marca"]); ?></td>
                            <td class="text-nowrap text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="producto_actualizar.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-sm btn-outline-secondary px-2 py-1" title="Modificar">✏️</a>
                                    <a href="producto_eliminado.php?id=<?php echo $producto['idProducto']; ?>&nombre=<?php echo urlencode($producto['nombre']); ?>&marca=<?php echo urlencode($producto['marca']);?>" class="btn btn-sm btn-outline-danger px-2 py-1" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">🗑️</a>
                                </div>
                            </td>                        
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center py-4 text-muted">No hay productos registrados en esta categoría.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table> 
        </div>

    </div>
</div>

<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>