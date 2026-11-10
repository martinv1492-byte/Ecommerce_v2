<?php

if (!isset($producto)) {
    $producto = ['idProducto' => 0, 'nombre' => '', 'precio' => 0, 'stock' => 0, 'marca' => '', 'nombre_categoria' => ''];
}
?>
<div class="card h-100 border-light-subtle shadow-sm rounded-0">
    
    <div class="bg-light p-4 d-flex align-items-center justify-content-center" style="height: 280px;">
        <?php 
        
            $nombreFoto = "producto_" . $producto['idProducto'] . ".jpg";
            
            $imagenVino = file_exists("assets/img/" . $nombreFoto) ? $nombreFoto : 'botella_generica.jpg';

            $slugCategoria = str_replace(' ', '-', strtolower($producto['nombre_categoria']));
        ?>
        
        <a href="index.php?categoria=<?= $slugCategoria; ?>&producto=<?= str_replace(' ', '-', strtolower($producto['nombre'])); ?>" 
            class="d-flex align-items-center justify-content-center h-100 w-100 text-decoration-none">
                <img src="assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= $producto['nombre']; ?>" style="max-height: 100%; max-width: 100%; object-fit: contain;">
        </a>
    </div>
    
    <div class="card-body d-flex flex-column text-center px-3 pb-3">
        
        <span class="text-muted text-uppercase tracking-wider fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            <?= $producto['marca']; ?>
        </span>
        
        <a href="index.php?categoria=<?= $slugCategoria; ?>&producto=<?= str_replace(' ', '-', strtolower($producto['nombre'])); ?>" 
            class="text-decoration-none text-dark">
                <h5 class="card-title fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 1.15rem;">
                    <?= $producto['nombre']; ?>
                </h5>
        </a>

        <p class="text-secondary small mb-3"><?= $producto['nombre_categoria'];  ?></p>

        <div class="mt-auto mb-3">
            <span class="fs-5 fw-bold text-dark">$<?= number_format($producto['precio'], 2, ',', '.'); ?></span>
        </div>

        <form action="/ecommerce/controllers/carrito_agregar.php" method="POST">

            <input type="hidden" name="id" value="<?= $producto['idProducto']; ?>">

            <input type="hidden" name="cantidad" value="1">
    
            <button type="submit" class="btn btn-outline-dark rounded-0 w-100 py-2 text-uppercase fw-semibold" style="font-size: 0.8rem; letter-spacing: 0.5px;">
            Añadir al carrito
            </button>
        </form>
    </div>
</div>