<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluimos la cabecera (escribimos la ruta desde la carpeta 'views/' si se incluye en el index, 
// o con '../' si entran directo. Dejamos la ruta estructural limpia)
include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container my-5 py-4" style="min-height: 65vh;">
    <!-- Botón sutil para volver al catálogo -->
    <div class="mb-4">
        <a href="/ecommerce/index.php" class="text-dark text-decoration-none small fw-semibold text-uppercase tracking-wider">
            <i class="bi bi-arrow-left me-1"></i> Volver a la selección
        </a>
    </div>

    <div class="row g-5">
        <!-- 🍷 COLUMNA 1: IMAGEN DEL VINO GIGANTE (Ancho 5 de 12) -->
        <div class="col-md-5">
            <div class="bg-light p-5 d-flex align-items-center justify-content-center border shadow-sm style-card" style="height: 450px;">
                <?php 
                    $nombreFoto = "producto_" . $producto['idProducto'] . ".jpg";
                    $imagenVino = file_exists("assets/img/" . $nombreFoto) ? $nombreFoto : 'botella_generica.jpg'; 
                ?>
                <img src="assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= $producto['nombre']; ?>" style="max-height: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- 📜 COLUMNA 2: DETALLES Y SELECTOR DE CANTIDAD (Ancho 7 de 12) -->
        <div class="col-md-7 d-flex flex-column">
            
            <!-- Bodega / Marca -->
            <span class="text-muted text-uppercase tracking-widest fw-bold mb-2" style="font-size: 0.8rem; letter-spacing: 1.5px;">
                <?= $producto['marca']; ?>
            </span>
            
            <!-- Nombre del Vino Premium -->
            <h1 class="fw-bold mb-3 text-dark" style="font-family: 'Times New Roman', serif; font-size: 2.5rem; letter-spacing: 0.5px;">
                <?= $producto['nombre']; ?>
            </h1>
            
            <!-- Nombre de la Categoría Traducida (La que trae tu LEFT JOIN) -->
            <span class="badge bg-dark rounded-0 align-self-start px-3 py-2 text-uppercase mb-4" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                <?= $producto['nombre_categoria']; ?>
            </span>

            <!-- Precio destacado pero sobrio -->
            <div class="mb-4 py-2 border-top border-bottom border-light-subtle">
                <span class="fs-2 fw-bold text-dark">$<?= number_format($producto['precio'], 2, ',', '.'); ?></span>
                <span class="text-muted small ms-2">/ Unidad 750ml</span>
            </div>

            <!-- Notas de Cata / Descripción completa -->
            <div class="mb-5">
                <h6 class="text-uppercase fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 0.9rem; letter-spacing: 0.5px;">Notas de Cata</h6>
                <p class="text-secondary lh-base">
                    <?= !empty($producto['descripcion']) ? $producto['descripcion'] : 'Una expresión elegante y equilibrada de nuestro terruño. Ideal para acompañar carnes rojas, pastas con salsas estructuradas y momentos memorables.'; ?>
                </p>
            </div>

            <!-- 🛒 SECCIÓN DE COMPRA: MODIFICAR CANTIDAD Y AÑADIR (Al final de la columna) -->
            <div class="mt-auto">
                <!-- El formulario envía los datos al controlador del carrito mediante POST -->
                <form action="controladores/carrito_agregar.php" method="POST" class="row g-3 align-items-center">
                    
                    <!-- Campo oculto para mandar el ID del vino que está comprando -->
                    <input type="hidden" name="idProducto" value="<?= $producto['idProducto']; ?>">

                    <!-- Selector de Cantidad Estilo Vinoteca (Líneas rectas) -->
                    <div class="col-auto">
                        <label for="cantidad" class="visually-hidden">Cantidad</label>
                        <div class="input-group" style="max-width: 140px;">
                            <!-- Botones tradicionales que cambian el número (pueden darles vida con JS en clase después) -->
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="document.getElementById('cantidad').value = Math.max(1, parseInt(document.getElementById('cantidad').value) - 1)">-</button>
                            
                            <input type="number" id="cantidad" name="cantidad" class="form-control text-center border-dark bg-white fw-bold rounded-0" value="1" min="1" max="<?= $producto['stock']; ?>" readonly style="font-size: 0.95rem;">
                            
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="document.getElementById('cantidad').value = Math.min(<?= $producto['stock']; ?>, parseInt(document.getElementById('cantidad').value) + 1)">+</button>
                        </div>
                    </div>
                </form>
                
                <!-- Aviso sutil de Stock disponible -->
                <div class="mt-2 text-muted small">
                    <i class="bi bi-box-seam me-1"></i> Stock disponible: <strong class="text-dark"><?= $producto['stock']; ?> unidades</strong>
                </div>
            </div>

        </div>
    </div>
</main>

<?php
// Incluimos el pie de página
include_once '/../views/includes/tienda/footer.php';
?>