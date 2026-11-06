<?php
// Iniciamos la sesión para poder leer los productos guardados en el carrito
session_start();
require_once __DIR__ . '/../../config/config.php';

// Supongamos que los productos del carrito se guardan en un array dentro de la sesión
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$totalGeneral = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Carrito de Compras - Vinoteca</title>
</head>
<body class="bg-light">

    <div class="container py-5">
        <h1 class="mb-4">🛒 Carrito de Compras</h1>

        <?php if (!empty($carrito)): ?>
            <div class="table-responsive bg-white p-4 rounded shadow-sm">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $id => $item): 
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $totalGeneral += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                                <td><?php echo $item['cantidad']; ?></td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <a href="controllers/eliminar_del_carrito.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h3>Total a Pagar: $<?php echo number_format($totalGeneral, 2); ?></h3>
                    <div>
                        <a href="index.php" class="btn btn-secondary">Seguir Comprando</a>
                        <a href="checkout.php" class="btn btn-success">Finalizar Compra</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center p-4">
                <h4>Tu carrito está vacío</h4>
                <p class="mb-3">Explora nuestro catálogo y añade algunos productos para empezar.</p>
                <a href="index.php" class="btn btn-primary">Ver Catálogo</a>
            </div>
        <?php endif; ?>
    </div>

<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>