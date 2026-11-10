<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: /ecommerce/index.php?error=acceso_denegado");
    exit();
}

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/venta.php';


$ventaObj = new Venta($conexion);
$ventas = $ventaObj->obtenerTodasLasVentas();


include_once __DIR__ . '/../../views/admin/ventas.php';
?>