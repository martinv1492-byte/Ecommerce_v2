<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
include(__DIR__ . '/../../models/producto.php');

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
$listado = obtenerProductos($conexion, $categoriaSeleccionada);
$categorias = obtenerCategorias($conexion);


if (isset($_GET['status']) && $_GET['status'] === 'success'): 
?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡Excelente!</strong> El producto se ha guardado correctamente en la base de datos.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 
elseif (isset($_GET['status']) && $_GET['status'] === 'error'): 
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hubo un problema.</strong> No se pudo guardar el producto. Revisa los datos e intenta nuevamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Panel de Productos - Vinoteca</title>
</head>
<body>
    <div>
        <div class="table-responsive">
            <h1>Vinoteca</h1>
            <div class="text-end mb-3">  
                <button onclick="window.location.href='proveedor_nuevo.php'" class="btn btn-sm text-light" style="background-color: blue">Cargar nuevo proveedor</button>    
                <button onclick="window.location.href='producto_nuevo.php?'" class="btn btn-sm text-light" style="background-color: green">Cargar producto nuevo</button>
                <button onclick="window.location.href='categoria_nueva.php'" class="btn btn-sm text-light" style="background-color: orange">Cargar nueva categoria</button>
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

            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Codigo</th>
                        <th scope="col" class="text-center">Categoria</th>
                        <th scope="col" class="text-center">Descripcion</th>
                        <th scope="col" class="text-center">Costo</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Foto</th>
                        <th scope="col" class="text-center">Proveedor</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col" class="text-center">Marca</th>
                        <th scope="col" colspan="2" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listado as $producto) { ?>
                    <tr>
                        <td><?php echo $producto["idProducto"]; ?></td>
                        <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($producto["codigo"]); ?></td>
                        <!-- Aquí va la categoría -->
                        <td><?php echo htmlspecialchars($producto["nombre_categoria"] ?? 'Sin categoría'); ?></td>
                        <!-- Aquí va la descripción (separada de la categoría) -->
                        <td><?php echo htmlspecialchars($producto["descripcion"]); ?></td>
                        <td>$<?php echo number_format($producto["costo"], 2); ?></td>
                        <td>$<?php echo number_format($producto["precio"], 2); ?></td>
                        <td><img src="<?php echo htmlspecialchars($producto["foto"]); ?>" style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <!-- Aquí va el proveedor -->
                        <td><?php echo htmlspecialchars($producto["nombre_proveedor"] ?? 'Sin proveedor'); ?></td>
                        <td><?php echo $producto["stock"]; ?></td>
                        <td><?php echo htmlspecialchars($producto["marca"]); ?></td>
                        <td><a href="producto_actualizar.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-sm text-light" style="background-color: grey;">Modificar</a></td>
                        <td><a href="producto_eliminado.php?id=<?php echo $producto['idProducto']; ?>&nombre=<?php echo urlencode($producto['nombre']); ?>&marca=<?php echo urlencode($producto['marca']);?>" class="btn btn-sm text-light" style="background-color: grey;">Eliminar</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>         
        </div>
    </div>
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>