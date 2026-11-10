<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container my-5 py-4" style="min-height: 65vh;">
    
    <div class="mb-4">
        <a href="/ecommerce/index.php" class="text-dark text-decoration-none small fw-semibold text-uppercase tracking-wider">
            <i class="bi bi-arrow-left me-1"></i> Volver a la selección
        </a>
    </div>

    <div class="row g-5">
        
        <div class="col-md-5">
            <div class="bg-light p-5 d-flex align-items-center justify-content-center border shadow-sm style-card" style="height: 450px;">
                <?php 
                    $nombreFoto = "producto_" . $producto['idProducto'] . ".jpg";
                    $imagenVino = file_exists("assets/img/" . $nombreFoto) ? $nombreFoto : 'botella_generica.jpg'; 
                ?>
                <img src="assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= $producto['nombre']; ?>" style="max-height: 100%; object-fit: contain;">
            </div>
        </div>

        <div class="col-md-7 d-flex flex-column">
            
            <span class="text-muted text-uppercase tracking-widest fw-bold mb-2" style="font-size: 0.8rem; letter-spacing: 1.5px;">
                <?= $producto['marca']; ?>
            </span>
            
            <h1 class="fw-bold mb-3 text-dark" style="font-family: 'Times New Roman', serif; font-size: 2.5rem; letter-spacing: 0.5px;">
                <?= $producto['nombre']; ?>
            </h1>
            
            <span class="badge bg-dark rounded-0 align-self-start px-3 py-2 text-uppercase mb-4" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                <?= $producto['nombre_categoria']; ?>
            </span>

            <div class="mb-4 py-2 border-top border-bottom border-light-subtle">
                <span class="fs-2 fw-bold text-dark">$<?= number_format($producto['precio'], 2, ',', '.'); ?></span>
                <span class="text-muted small ms-2">/ Unidad 750ml</span>
            </div>

            <div class="mb-5">
                <h6 class="text-uppercase fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 0.9rem; letter-spacing: 0.5px;">Notas de Cata</h6>
                <p class="text-secondary lh-base">
                    <?= !empty($producto['descripcion']) ? $producto['descripcion'] : 'Una expresión elegante y equilibrada de nuestro terruño. Ideal para acompañar carnes rojas, pastas con salsas estructuradas y momentos memorables.'; ?>
                </p>
            </div>

            <div class="mt-auto">
                <form action="controladores/carrito_agregar.php" method="POST" class="row g-3 align-items-center">
                    
                    <input type="hidden" name="idProducto" value="<?= $producto['idProducto']; ?>">

                    <div class="col-auto">
                        <label for="cantidad" class="visually-hidden">Cantidad</label>
                        <div class="input-group" style="max-width: 140px;">
                            
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="document.getElementById('cantidad').value = Math.max(1, parseInt(document.getElementById('cantidad').value) - 1)">-</button>
                            
                            <input type="number" id="cantidad" name="cantidad" class="form-control text-center border-dark bg-white fw-bold rounded-0" value="1" min="1" max="<?= $producto['stock']; ?>" readonly style="font-size: 0.95rem;">
                            
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="document.getElementById('cantidad').value = Math.min(<?= $producto['stock']; ?>, parseInt(document.getElementById('cantidad').value) + 1)">+</button>
                        </div>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-dark rounded-0 w-100 py-3 text-uppercase fw-bold" style="font-size: 0.85rem; letter-spacing: 1px;">
                            <i class="bi bi-basket3 me-2"></i> Añadir a la canasta
                        </button>
                    </div>

                </form>
                
                <div class="mt-2 text-muted small">
                    <i class="bi bi-box-seam me-1"></i> Stock disponible: <strong class="text-dark"><?= $producto['stock']; ?> unidades</strong>
                </div>
            </div>

        </div>
    </div>
</main>

<?php

include_once '/../views/includes/tienda/footer.php';
?>