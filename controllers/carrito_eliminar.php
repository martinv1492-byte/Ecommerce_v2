<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_GET['id'])) {
    $idProducto = (int) $_GET['id'];

    // Si el producto existe en la sesión, lo eliminamos por completo
    if (isset($_SESSION['carrito'][$idProducto])) {
        unset($_SESSION['carrito'][$idProducto]);
    }
}


header("Location: /ecommerce/views/tienda/carrito.php");
exit();