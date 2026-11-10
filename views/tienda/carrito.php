<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$subtotalGeneral = 0;
$cantidadTotalItems = 0;

foreach ($_SESSION['carrito'] as $item) {
    $subtotalGeneral += $item['precio'] * $item['cantidad'];
    $cantidadTotalItems += $item['cantidad'];
}


include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container my-5" style="min-height: 65vh;">

    <?php if (isset($_GET['error']) && $_GET['error'] === 'stock_insuficiente'): ?>
        <div class="alert alert-danger rounded-0 alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> 
            Lo sentimos, uno o más productos de tu canasta se quedaron sin stock suficiente. Por favor, ajusta las cantidades para continuar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <h2 class="mb-5 fw-bold text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
        Tu Carrito de Compras
    </h2>

    <?php if (empty($_SESSION['carrito'])): ?>
        <div class="text-center py-5">
            <p class="text-muted fs-5 mb-4">Tu carrito está vacío.</p>
            <a href="/ecommerce/index.php?categoria=todas" class="btn btn-dark rounded-0 text-uppercase fw-semibold px-4 py-3" style="font-size: 0.8rem; letter-spacing: 1px;">
                Ver Catálogo de Vinos
            </a>
        </div>
    <?php else: ?>
        <div class="row">

            <div class="col-lg-8 mb-4">
                <div class="card border-light-subtle shadow-sm rounded-0 p-3 bg-white">
                    
                    <?php foreach ($_SESSION['carrito'] as $idProducto => $item): ?>

                        <div class="row align-items-center py-3 border-bottom g-3">

                            <div class="col-3 col-md-2 text-center bg-light p-2" style="height: 100px;">
                                <?php
                                    $nombreFoto = "producto_" . $idProducto . ".jpg";
                                    $rutaFisica = __DIR__ . "/../../assets/img/" . $nombreFoto;
                                    $imagenVino = file_exists($rutaFisica) ? $nombreFoto : 'botella_generica.jpg';
                                ?>
                                <img src="/ecommerce/assets/img/<?= $imagenVino; ?>" class="img-fluid" alt="<?= htmlspecialchars($item['nombre']); ?>" style="max-height: 100%; object-fit: contain;">
                            </div>
                            

                            <div class="col-9 col-md-5">
                                <span class="text-muted text-uppercase tracking-wider small d-block" style="font-size: 0.7rem;"><?= htmlspecialchars($item['bodega'] ?? 'Vinoteca'); ?></span>
                                <h5 class="fw-bold mb-1" style="font-family: 'Times New Roman', serif; font-size: 1.1rem;"><?= htmlspecialchars($item['nombre']); ?></h5>
                                <p class="text-secondary small m-0"><?= htmlspecialchars($item['presentacion'] ?? '750ml'); ?></p>
                            </div>
                            

                            <div class="col-6 col-md-3">
                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                    <a href="/ecommerce/controllers/carrito_actualizar.php?id=<?= $idProducto; ?>&accion=restar" class="btn btn-outline-dark rounded-0">-</a>
                                    <input type="text" class="form-control text-center border-dark bg-white" value="<?= $item['cantidad']; ?>" readonly>
                                    <a href="/ecommerce/controllers/carrito_actualizar.php?id=<?= $idProducto; ?>&accion=sumar" class="btn btn-outline-dark rounded-0">+</a>
                                </div>
                            </div>
                            
                            <div class="col-6 col-md-2 text-end">
                                <span class="fw-bold d-block mb-2">$<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.'); ?></span>
                                <a href="/ecommerce/controllers/carrito_eliminar.php?id=<?= $idProducto; ?>" class="text-danger text-decoration-none small">
                                    <i class="bi bi-trash3 me-1"></i> Quitar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="mt-4">
                    <a href="/ecommerce/index.php" class="btn btn-outline-dark rounded-0 text-uppercase fw-semibold" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        <i class="bi bi-arrow-left me-2"></i> Seguir Comprando
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-light-subtle shadow-sm rounded-0 p-4 bg-white">
                    <h4 class="fw-bold mb-4 text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; font-size: 1.25rem; letter-spacing: 0.5px;">
                        Resumen del Pedido
                    </h4>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal (<?= $cantidadTotalItems; ?> productos)</span>
                        <span class="fw-semibold text-dark">$<?= number_format($subtotalGeneral, 0, ',', '.'); ?></span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Envío</span>
                        <span class="text-success fw-semibold">Gratis</span>
                    </div>

                    <hr class="border-secondary my-3">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5" style="font-family: 'Times New Roman', serif;">Total</span>
                        <span class="fw-bold fs-4 text-dark">$<?= number_format($subtotalGeneral, 0, ',', '.'); ?></span>
                    </div>


                    <?php if (isset($_SESSION['usuario_id'])): ?>

                        <form action="/ecommerce/views/tienda/checkout.php" method="POST">
                            <button type="submit" class="btn btn-dark rounded-0 w-100 py-3 text-uppercase fw-semibold text-center" style="font-size: 0.85rem; letter-spacing: 1px;">
                                Iniciar Finalización de Compra
                            </button>
                        </form>
                    <?php else: ?>

                        <div class="alert alert-warning text-center small rounded-0 mb-3 py-2" role="alert">
                            Debes iniciar sesión para finalizar tu compra.
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/ecommerce/views/tienda/iniciosesion.php" class="btn btn-dark rounded-0 w-50 py-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Iniciar Sesión
                            </a>
                            <a href="/ecommerce/views/tienda/registro.php" class="btn btn-outline-dark rounded-0 w-50 py-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                Registrarse
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <p class="text-center text-muted small mt-3 m-0">
                        <i class="bi bi-shield-check me-1"></i> Compra 100% protegida y segura
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php
include_once '../includes/tienda/footer.php';
?>