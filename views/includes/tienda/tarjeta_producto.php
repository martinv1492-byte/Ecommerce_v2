<?php 
    $hayStock = isset($producto['stock']) && $producto['stock'] > 0;
?>

<div class="card border-light-subtle shadow-sm rounded-0 p-3 bg-white h-100 d-flex flex-column">

    <div class="text-center bg-light p-3 mb-3" style="height: 200px;">
        <?php 
            $idProd = $producto['idProducto'] ?? $producto['id'] ?? 0;
            $nombreFoto = "producto_" . $idProd . ".jpg";
            $rutaFisica = __DIR__ . "/../../../assets/img/" . $nombreFoto;
            $imagenVino = file_exists($rutaFisica) ? $nombreFoto : 'botella_generica.jpg'; 
        ?>
        <a href="/ecommerce/views/tienda/producto_detalle.php?id=<?= $idProd; ?>" class="d-block h-100 text-decoration-none">
            <img src="/ecommerce/assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= htmlspecialchars($producto['nombre']); ?>" style="max-height: 100%; object-fit: contain;">
        </a>
    </div>
    
    <span class="text-muted text-uppercase tracking-wider small d-block mb-1" style="font-size: 0.65rem;"><?= htmlspecialchars($producto['marca'] ?? 'Vinoteca'); ?></span>
    <h5 class="fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 1.05rem;">
        <a href="/ecommerce/views/tienda/producto_detalle.php?id=<?= $idProd; ?>" class="text-dark text-decoration-none">
            <?= htmlspecialchars($producto['nombre']); ?>
        </a>
    </h5>
    
    <div class="mb-3">
        <span class="fw-bold text-dark fs-5">$<?= number_format($producto['precio'], 0, ',', '.'); ?></span>
    </div>

    <div class="mt-auto">
        <?php if ($hayStock): ?>
            <form action="/ecommerce/controllers/carrito_agregar.php" method="POST">
                <input type="hidden" name="id" value="<?= $idProd; ?>">
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="btn btn-dark rounded-0 w-100 py-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <i class="bi bi-bag-plus me-1"></i> Agregar al Carrito
                </button>
            </form>
        <?php else: ?>
            <button type="button" class="btn btn-outline-secondary rounded-0 w-100 py-2 text-uppercase fw-semibold disabled" style="font-size: 0.75rem; letter-spacing: 0.5px;" disabled>
                <i class="bi bi-exclamation-circle me-1"></i> Sin Stock
            </button>
        <?php endif; ?>
    </div>
</div>