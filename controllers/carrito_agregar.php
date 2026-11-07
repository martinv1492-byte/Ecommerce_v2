<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 1;

    if ($idProducto > 0 && $cantidad > 0) {

        $producto = obtenerProductoPorId($conexion, $idProducto);

        if ($producto) {
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if (isset($_SESSION['carrito'][$idProducto])) {
                $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$idProducto] = [
                    'idProducto' => $producto['idProducto'],
                    'nombre'     => $producto['nombre'],
                    'precio'     => $producto['precio'],
                    'cantidad'   => $cantidad
                ];
            }

            header("Location: /ecommerce/views/tienda/carrito.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/index.php?error=producto_no_encontrado");
            exit();
        }
    } else {
        header("Location: /ecommerce/index.php?error=datos_invalidos");
        exit();
    }
} else {
    header("Location: /ecommerce/index.php");
    exit();
}