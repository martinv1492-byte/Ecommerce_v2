<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Venta.php';

if (!isset($_SESSION['usuario_id'])) {

    header("Location: /ecommerce/login.php?error=debe_iniciar_sesion");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['carrito'])) {
    

    $idUsuario = $_SESSION['usuario_id']; 

    $ventaModel = new Venta($conexion);
    $idVenta = $ventaModel->registrarCompra($idUsuario, $_SESSION['carrito']);

    if ($idVenta) {

        unset($_SESSION['carrito']);
        header("Location: /ecommerce/index.php?status=compra_exitosa&orden=" . $idVenta);
        exit();
    } else {

        header("Location: /ecommerce/views/tienda/carrito.php?error=stock_insuficiente");
        exit();
    }
} else {

    header("Location: /ecommerce/index.php");
    exit();
}