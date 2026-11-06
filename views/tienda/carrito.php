<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluimos la cabecera de la Vinoteca
include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container my-5" style="min-height: 65vh;">
    <!-- Título de la sección -->
    <h2 class="mb-5 fw-bold text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
        Tu Canasta de Compras
    </h2>

    <div class="row">
        <!-- 🍷 COLUMNA 1: LISTADO DE PRODUCTOS (Ancho 8 de 12) -->
        <div class="col-lg-8 mb-4">
            <div class="card border-light-subtle shadow-sm rounded-0 p-3 bg-white">
                
                <!-- PRODUCTO 1 DE MUESTRA -->
                <div class="row align-items-center py-3 border-bottom g-3">
                    <!-- Imagen chica del vino -->
                    <div class="col-3 col-md-2 text-center bg-light p-2" style="height: 100px;">
                        <?php
                            $nombreFoto = "producto_" . $item['idProducto'] . ".jpg"; // Aquí deberías usar el ID real del producto
                            $imagenVino = file_exists("/../../assets/img/" . $nombreFoto) ? $nombreFoto : 'botella_generica.jpg';
                        ?>
                        <img src="/../../assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= $item['nombre']; ?>" style="max-height: 100%; object-fit: contain;">
                    </div>
                    <!-- Detalles del vino -->
                    <div class="col-9 col-md-5">
                        <span class="text-muted text-uppercase tracking-wider small d-block" style="font-size: 0.7rem;">Catena Zapata</span>
                        <h5 class="fw-bold mb-1" style="font-family: 'Times New Roman', serif; font-size: 1.1rem;">D.V. Catena Malbec</h5>
                        <p class="text-secondary small m-0">750ml</p>
                    </div>
                    <!-- Control de Cantidad (+ / -) -->
                    <div class="col-6 col-md-3">
                        <div class="input-group input-group-sm" style="max-width: 120px;">
                            <button class="btn btn-outline-dark rounded-0" type="button">-</button>
                            <input type="text" class="form-control text-center border-dark bg-white" value="1" readonly>
                            <button class="btn btn-outline-dark rounded-0" type="button">+</button>
                        </div>
                    </div>
                    <!-- Precio y Botón Eliminar -->
                    <div class="col-6 col-md-2 text-end">
                        <span class="fw-bold d-block mb-2">$14.500</span>
                        <a href="#" class="text-danger text-decoration-none small">
                            <i class="bi bi-trash3 me-1"></i> Quitar
                        </a>
                    </div>
                </div>

                <!-- PRODUCTO 2 DE MUESTRA -->
                <div class="row align-items-center py-3 g-3">
                    <div class="col-3 col-md-2 text-center bg-light p-2" style="height: 100px;">
                        <img src="assets/img/producto_2.jpg" class="img-fluid" alt="Vino" style="max-height: 100%; object-fit: contain;">
                    </div>
                    <div class="col-9 col-md-5">
                        <span class="text-muted text-uppercase tracking-wider small d-block" style="font-size: 0.7rem;">Rutini Wines</span>
                        <h5 class="fw-bold mb-1" style="font-family: 'Times New Roman', serif; font-size: 1.1rem;">Rutini Cabernet Malbec</h5>
                        <p class="text-secondary small m-0">750ml</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="input-group input-group-sm" style="max-width: 120px;">
                            <button class="btn btn-outline-dark rounded-0" type="button">-</button>
                            <input type="text" class="form-control text-center border-dark bg-white" value="2" readonly>
                            <button class="btn btn-outline-dark rounded-0" type="button">+</button>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 text-end">
                        <span class="fw-bold d-block mb-2">$36.400</span>
                        <a href="#" class="text-danger text-decoration-none small">
                            <i class="bi bi-trash3 me-1"></i> Quitar
                        </a>
                    </div>
                </div>

            </div>

            <!-- Botón para seguir comprando -->
            <div class="mt-4">
                <a href="/ecommerce/index.php" class="btn btn-outline-dark rounded-0 text-uppercase fw-semibold" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                    <i class="bi bi-arrow-left me-2"></i> Seguir Comprando
                </a>
            </div>
        </div>

        <!-- 🧾 COLUMNA 2: RESUMEN DE LA COMPRA (Ancho 4 de 12) -->
        <div class="col-lg-4">
            <div class="card border-light-subtle shadow-sm rounded-0 p-4 bg-white">
                <h4 class="fw-bold mb-4 text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; font-size: 1.25rem; letter-spacing: 0.5px;">
                    Resumen del Pedido
                </h4>
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal (3 productos)</span>
                    <span class="fw-semibold text-dark">$50.900</span>
                </div>
                
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Envío</span>
                    <span class="text-success fw-semibold">Gratis</span>
                </div>

                <hr class="border-secondary my-3">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold fs-5" style="font-family: 'Times New Roman', serif;">Total</span>
                    <span class="fw-bold fs-4 text-dark">$50.900</span>
                </div>

                <!-- Botón principal de checkout estilo premium -->
                <button class="btn btn-dark rounded-0 w-100 py-3 text-uppercase fw-semibold" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Iniciar Finalización de Compra
                </button>
                
                <p class="text-center text-muted small mt-3 m-0">
                    <i class="bi bi-shield-check me-1"></i> Compra 100% protegida y segura
                </p>
            </div>
        </div>
    </div>
</main>

<?php
// Incluimos el pie de página que cierra las etiquetas
include_once '../includes/tienda/footer.php';
?>