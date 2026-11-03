<?php
require_once '../../config/config.php';
require_once '../../models/producto.php';

// 1. Obtener el ID enviado por la URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// 2. Verificar que el ID sea válido
if ($id <= 0) {
    exit('Error: ID de producto no válido.');
}

// 3. Buscar el producto en la base de datos
$producto = obtenerProductoPorId($conexion, $id);

// 4. Verificar que el producto exista
if (!$producto) {
    exit('Error: el producto no existe.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Editar producto</title>
</head>
<body>
    <form action="/ecommerce/controllers/admin/producto_modificar.php" method="POST">
        
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-8">

                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-dark text-white p-4 rounded-top-4">
                            <h1 class="h3 mb-1">Editar producto</h1>
                            <p class="mb-0 text-white-50">
                                Modificá los datos del producto seleccionado.
                            </p>
                        </div>

                        <div class="card-body p-4 p-md-5">

                            <form action="../../controllers/admin/editar_producto.php"
                                method="POST">

                                <input type="hidden" name="id"
                                    value="<?= htmlspecialchars((string)$producto['idProducto']) ?>">

                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Nombre
                                        </label>
                                        <input type="text" id="name" name="name"
                                            class="form-control"
                                            value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="code" class="form-label fw-semibold">
                                            Código
                                        </label>
                                        <input type="text" id="code" name="code"
                                            class="form-control"
                                            value="<?= htmlspecialchars($producto['codigo'] ?? '') ?>"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category" class="form-label fw-semibold">
                                            ID de categoría
                                        </label>
                                        <input type="number" id="category" name="category"
                                            class="form-control"
                                            value="<?= htmlspecialchars((string)$producto['idCategoria']) ?>"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="brand" class="form-label fw-semibold">
                                            Marca
                                        </label>
                                        <input type="text" id="brand" name="brand"
                                            class="form-control"
                                            value="<?= htmlspecialchars($producto['marca'] ?? '') ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="description" class="form-label fw-semibold">
                                            Descripción
                                        </label>
                                        <textarea id="description" name="description"
                                                class="form-control" rows="3"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cost" class="form-label fw-semibold">
                                            Costo
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" min="0"
                                                id="cost" name="cost"
                                                class="form-control"
                                                value="<?= htmlspecialchars((string)$producto['costo']) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price" class="form-label fw-semibold">
                                            Precio de venta
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" min="0"
                                                id="price" name="price"
                                                class="form-control"
                                                value="<?= htmlspecialchars((string)$producto['precio']) ?>"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="supplier" class="form-label fw-semibold">
                                            ID de proveedor
                                        </label>
                                        <input type="number" id="supplier" name="supplier"
                                            class="form-control"
                                            value="<?= htmlspecialchars((string)($producto['idProveedor'] ?? '')) ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="stock" class="form-label fw-semibold">
                                            Stock disponible
                                        </label>
                                        <input type="number" min="0" id="stock" name="stock"
                                            class="form-control"
                                            value="<?= htmlspecialchars((string)$producto['stock']) ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="photo" class="form-label fw-semibold">
                                            Foto (URL o ruta)
                                        </label>
                                        <input type="text" id="photo" name="photo"
                                            class="form-control"
                                            value="<?= htmlspecialchars($producto['foto'] ?? 'Sin imagen disponible') ?>">
                                    </div>

                                </div>

                                <hr class="my-4">

                                <div class="d-flex flex-column flex-sm-row
                                            justify-content-end gap-2">

                                    <a href="productos.php"
                                    class="btn btn-outline-secondary px-4">
                                        Cancelar
                                    </a>

                                    <button type="submit"
                                            class="btn btn-dark px-4">
                                        Guardar cambios
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>