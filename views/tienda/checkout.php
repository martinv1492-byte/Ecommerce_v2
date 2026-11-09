<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['carrito'])) {
    header("Location: /ecommerce/views/tienda/carrito.php");
    exit();
}

include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container my-5" style="min-height: 65vh;">
    <h2 class="mb-4 fw-bold text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
        Finalizar Compra
    </h2>

    <form action="/ecommerce/controllers/procesar_checkout.php" method="POST">
        <div class="row">
            <!-- Datos de Envío -->
            <div class="col-lg-7 mb-4">
                <div class="card border-light-subtle shadow-sm rounded-0 p-4 bg-white">
                    <h5 class="fw-bold mb-3 text-uppercase" style="font-family: 'Times New Roman', serif;">Datos de Envío y Contacto</h5>
                    
                    <div class="mb-3">
                        <label class="form-label small text-uppercase">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control rounded-0 border-dark" value="<?= htmlspecialchars($_SESSION['usuario_nombre'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-uppercase">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control rounded-0 border-dark" value="<?= htmlspecialchars($_SESSION['usuario_email'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-uppercase">Dirección de Entrega</label>
                        <input type="text" name="direccion" class="form-control rounded-0 border-dark" value="<?= htmlspecialchars($_SESSION['usuario_direccion'] ?? ''); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-uppercase">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control rounded-0 border-dark" value="<?= htmlspecialchars($_SESSION['usuario_ciudad'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-uppercase">Código Postal</label>
                            <input type="text" name="cp" class="form-control rounded-0 border-dark" value="<?= htmlspecialchars($_SESSION['usuario_cp'] ?? ''); ?>" required>
                        </div>

                        <hr class="border-secondary my-4">
                        <h5 class="fw-bold mb-3 text-uppercase" style="font-family: 'Times New Roman', serif;">Método de Pago</h5>           
                        
                        <div class="mb-3">
                            <label class="form-label small text-uppercase">Número de Tarjeta</label>
                            <input type="text" name="tarjeta_numero" class="form-control rounded-0 border-dark" placeholder="0000 0000 0000 0000" maxlength="19" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-uppercase">Vencimiento</label>
                                <input type="text" name="tarjeta_vence" class="form-control rounded-0 border-dark" placeholder="MM/AA" maxlength="5" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-uppercase">CVV</label>
                                <input type="password" name="tarjeta_cvv" class="form-control rounded-0 border-dark" placeholder="123" maxlength="3" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen y Confirmación -->
            <div class="col-lg-5">
                <div class="card border-light-subtle shadow-sm rounded-0 p-4 bg-white">
                    <h5 class="fw-bold mb-3 text-uppercase" style="font-family: 'Times New Roman', serif;">Tu Pedido</h5>
                    
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $item): 
                        $total += $item['precio'] * $item['cantidad'];
                    ?>
                        <div class="d-flex justify-content-between small mb-2">
                            <span><?= $item['nombre']; ?> (x<?= $item['cantidad']; ?>)</span>
                            <span>$<?= number_format($item['precio'] * $item['cantidad'], 0, ',', '.'); ?></span>
                        </div>
                    <?php endforeach; ?>

                    <hr class="border-secondary my-3">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total a Pagar</span>
                        <span class="fw-bold fs-5 text-dark">$<?= number_format($total, 0, ',', '.'); ?></span>
                    </div>

                    <button type="submit" class="btn btn-dark rounded-0 w-100 py-3 text-uppercase fw-semibold" style="letter-spacing: 1px;">
                        Confirmar y Pagar Pedido
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>

<?php include_once '../includes/tienda/footer.php'; ?>