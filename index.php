<?php 
if (isset($_GET['error'])){
    $error = urldecode($_GET['error']) ;
    echo "<script> alert ('$error');</script>";
};
?>

<?php


require_once  '../views/includes/tienda/head.php';
require_once  '../views/includes/admin/proteger.php';
require_once  '../config/config.php';
require_once  '../models/producto.php';

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
$listado = obtenerProductos($conexion, $categoriaSeleccionada);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
</head>
</html>
<?php foreach ($listado as $prod): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 text-light border-secondary shadow-sm" style="background-color: darkslategray;">

                    <img src="<?= !empty($prod['foto']) ? $prod['foto'] : 'https://asdlib.org/wp-content/uploads/2021/11/no-image.jpg' ?>" 
                    class="card-img-top bg-white object-fit-contain" style="height: 200px; width: 100%;" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                    
                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <div>
                            <h5 class="card-title fw-bold text-info mb-1"><?= htmlspecialchars($prod['nombre']) ?></h5>
                            <p class="card-text text-white-50 small mb-3"><?= htmlspecialchars(substr($prod['descripcion'], 0, 80)) ?>...</p>
                        </div>
                        
                        <div>
                            <h4 class="text-white fw-bold mb-3">$<?= number_format($prod['precio'], 2, ',', '.') ?></h4>
                            
                            <a href="index.php?controller=producto&action=detalle&id=<?= $prod['id'] ?>" class="btn btn-info w-100 text-dark fw-bold">Ver Detalle</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
