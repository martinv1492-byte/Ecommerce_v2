<?php

require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/venta.php';


$ventaObj = new Venta($conexion);
$ventas = $ventaObj->obtenerTodasLasVentas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Historial de Ventas - Vinoteca</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-lg-2 px-0 bg-dark">
                <?php include __DIR__ . '/../includes/admin/sidebar.php'; ?>
            </div>
            
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Historial de Ventas</h1>
                </div>
                
                <div class="table-responsive bg-white p-3 shadow-sm border">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col"># ID</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Total</th>
                                <th scope="col">Pago</th>
                                <th scope="col">Envío</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ventas)): ?>
                                <?php foreach ($ventas as $venta): ?>
                                    <tr>
                                        <td><?php echo $venta['idVenta']; ?></td>
                                        <td><?php echo $venta['fecha']; ?></td>
                                        <td>
                                            <?php echo htmlspecialchars($venta['cliente_nombre']); ?><br>
                                            <small class="text-muted"><?php echo htmlspecialchars($venta['cliente_email']); ?></small>
                                        </td>
                                        <td>$<?php echo number_format($venta['total'], 2, ',', '.'); ?></td>
                                        <td>
                                            <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($venta['estadoPago']); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark"><?php echo htmlspecialchars($venta['estadoEnvio']); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No se registran ventas en el sistema.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>