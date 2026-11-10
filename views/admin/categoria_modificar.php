<?php 
require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';

require_once __DIR__ . '/../../models/categoria.php';

$idCategoria = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($idCategoria <= 0) {
    header("Location: categorias.php?status=error");
    exit();
}

$categoria = obtenerCategoriaPorId($conexion, $idCategoria);

if (!$categoria) {
    header("Location: categorias.php?status=error");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Modificar Categoria - Vinoteca</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>

            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <h1 class="mb-4">Modificar Categoria</h1>

                <form action="../../controllers/admin/categoria_modificar.php" method="POST" class="bg-light p-4 rounded border shadow-sm">
                    
                    <input type="hidden" name="idCategoria" value="<?php echo $categoria['idCategoria']; ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre de la Categoria:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre']); ?>" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>