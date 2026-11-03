<?php

require_once '../../config/config.php';  
require_once '../../models/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = isset($_POST['idProducto']) ? intval($_POST['idProducto']) : 0;

    $resultado = eliminarProducto($conexion, $idProducto);

    if ($resultado) {
        header("Location: /ecommerce/views/admin/productos.php?status=deleted");
    } else {
        header("Location: /ecommerce/views/admin/productos.php?status=error");
    }
    exit;

} else {
    echo "Acceso no permitido.";
}