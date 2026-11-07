<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Venta.php';


if (!isset($_SESSION['idUsuario']) && !isset($_SESSION['usuario'])) {

    header("Location: /ecommerce/views/tienda/iniciosesion.php?error=debe_iniciar_sesion");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['carrito'])) {
    

    $idUsuario = $_SESSION['idUsuario'] ?? $_SESSION['usuario']['id']; 

    $ventaModel = new Venta($conexion);
    $idVenta = $ventaModel->registrarCompra($idUsuario, $_SESSION['carrito']);

    if ($idVenta) {
        unset($_SESSION['carrito']);
        header("Location: /ecommerce/index.php?status=compra_exitosa&orden=" . $idVenta);
        exit();
    } else {
        header("Location: /ecommerce/views/tienda/carrito.php?error=error_transaccion");
        exit();
    }
} else {
    header("Location: /ecommerce/index.php");
    exit();
}