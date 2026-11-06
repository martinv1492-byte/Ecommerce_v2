<?php
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Nueva Categoria - Vinoteca</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Cargar Nueva Categoría</h4>
            </div>
            <div class="card-body">
                <form action="/ecommerce/controllers/admin/categoria_crear.php" method="POST" class="row g-3">
            
                    <div class="col-12">
                        <label for="nombre" class="form-label fw-bold">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ej: Vinos Tintos, Espumantes...">
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                        <a href="productos.php" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-dark px-4">
                            Guardar Categoría
                        </button>
                    </div>
                </form>
            </div> 
        </div> 
    </div>             
</body>
</html>