<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id']) && isset($_GET['accion'])) {
    $idProducto = (int) $_GET['id'];
    $accion = $_GET['accion'];


    if (isset($_SESSION['carrito'][$idProducto])) {
        if ($accion === 'sumar') {
            $_SESSION['carrito'][$idProducto]['cantidad']++;
        } elseif ($accion === 'restar') {
            $_SESSION['carrito'][$idProducto]['cantidad']--;

            if ($_SESSION['carrito'][$idProducto]['cantidad'] <= 0) {
                unset($_SESSION['carrito'][$idProducto]);
            }
        }
    }
}

header("Location: /ecommerce/views/tienda/carrito.php");
exit();