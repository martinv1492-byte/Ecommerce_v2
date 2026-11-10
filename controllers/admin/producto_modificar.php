<?php
require_once '../../config/config.php';
require_once '../../models/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    $name        = trim($_POST['name'] ?? '');
    $code        = trim($_POST['code'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $cost        = trim($_POST['cost'] ?? '0');
    $price       = trim($_POST['price'] ?? '');
    $photo       = trim($_POST['photo'] ?? 'Sin imagen disponible');
    $supplier    = trim($_POST['supplier'] ?? '');
    $stock       = trim($_POST['stock'] ?? '0');
    $brand       = trim($_POST['brand'] ?? '');

    if (
        $id <= 0 ||
        $name === '' ||
        $code === '' ||
        $category === '' ||
        $price === ''
    ) {
        echo "Error: faltan datos obligatorios o el ID no es válido.";
        exit;
    }

    $datosProducto = [
        ':nombre'        => $name,
        ':codigo'        => $code,
        ':idCategoria'    => $category,
        ':descripcion' => $description,
        ':costo'        => $cost,
        ':precio'       => $price,
        ':foto'       => $photo,
        ':idProveedor'    => $supplier,
        ':stock'       => $stock,
        ':marca'       => $brand
    ];

    $resultado = editarProducto(
        $conexion,
        $id,
        $datosProducto
    );

    if ($resultado) {
        header(
            "Location: ../../views/admin/productos.php?status=updated"
        );
    } else {
        header(
            "Location: ../../views/admin/productos.php?status=error"
        );
    } exit;
} else {
    echo "Acceso no permitido.";
}
?>