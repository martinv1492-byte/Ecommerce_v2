<div class="card h-100 border-light-subtle shadow-sm rounded-0">
    <!-- 1. Imagen Dinámica (Ahora con la ruta correcta de assets) -->
    <div class="bg-light p-4 d-flex align-items-center justify-content-center" style="height: 280px;">
        <?php 
            // 1. Armamos el nombre que le dio el script de descarga
            $nombreFoto = "producto_" . $producto['idProducto'] . ".jpg";
            
            // 2. Verificamos si el archivo existe en tu carpeta assets. Si no existe, usa una genérica.
            $imagenVino = file_exists("assets/img/" . $nombreFoto) ? $nombreFoto : 'botella_generica.jpg';

            // 🔥 LA SOLUCIÓN: Convertimos el nombre de la categoría REAL de este producto en el slug
            // (ej: si el producto es un Malbec, va a leer "Vino" de la BD y lo transformará a "vino")
            $slugCategoria = str_replace(' ', '-', strtolower($producto['nombre_categoria']));
        ?>
        <!-- 🔥 MODIFICACIÓN 1: Convertimos el enlace en un contenedor Flexbox centrado al 100% de la caja gris -->
        <a href="index.php?categoria=<?= $slugCategoria; ?>&producto=<?= str_replace(' ', '-', strtolower($producto['nombre'])); ?>" 
            class="d-flex align-items-center justify-content-center h-100 w-100 text-decoration-none">
                <img src="assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= $producto['nombre']; ?>" style="max-height: 100%; max-width: 100%; object-fit: contain;">
        </a>
    </div>
    <!-- 2. Información Dinámica -->
    <div class="card-body d-flex flex-column text-center px-3 pb-3">
        <!-- Bodega -->
        <span class="text-muted text-uppercase tracking-wider fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
            <?= $producto['marca']; ?>
        </span>
        
        <!-- Nombre del Vino -->
        <!-- Buscá los enlaces href en tu tarjeta y dejalos configurados así: -->
        <a href="index.php?categoria=<?= $slugCategoria; ?>&producto=<?= str_replace(' ', '-', strtolower($producto['nombre'])); ?>" 
            class="text-decoration-none text-dark">
                <h5 class="card-title fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 1.15rem;">
                    <?= $producto['nombre']; ?>
                </h5>
        </a>

        <!-- Cepa / Variedad y Tamaño -->
        <p class="text-secondary small mb-3"><?= $producto['nombre_categoria'];  ?></p>

        <!-- Precio con formato de moneda -->
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