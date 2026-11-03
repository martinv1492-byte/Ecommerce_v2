<?php

$idProducto = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nombre     = isset($_GET['nombre']) && $_GET['nombre'] !== '' ? urldecode($_GET['nombre']) : 'Producto sin nombre';
$marca      = isset($_GET['marca']) && $_GET['marca'] !== '' ? urldecode($_GET['marca']) : 'Sin marca';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Confirmar Eliminación</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">!! Confirmar Eliminación</h4>
                    </div>
                    <div class="card-body text-center py-4">
                        <h5 class="card-title text-danger mb-3">¿Estás absolutamente seguro?</h5>

                        <div class="alert alert-secondary text-start my-4">
                            <p class="mb-1"><strong>ID del Registro:</strong> #<?php echo $idProducto; ?></p>
                            <p class="mb-1"><strong>Producto:</strong> <?php echo $nombre; ?></p>
                            <p class="mb-0"><strong>Marca:</strong> <?php echo $marca; ?></p>
                        </div>

                        <p class="card-text text-muted">
                            Estás a punto de eliminar permanentemente el producto con el <strong>ID #<?php echo $idProducto; ?></strong>.<br>
                            Esta acción borrará el registro de la base de datos y no se puede deshacer.
                        </p>
                        
                        <form action="/ecommerce/controllers/admin/producto_eliminar.php" method="POST" class="mt-4">
                            
                            
                            <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">
                            
                            <div class="d-flex justify-content-center gap-3">
                                
                                <a href="productos.php" class="btn btn-secondary">
                                    Cancelar y Volver
                                </a>
                                
                                <button type="submit" class="btn btn-dangerfw-bold">
                                    Sí, Eliminar Producto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>