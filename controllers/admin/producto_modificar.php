<?php
require_once '../../config/config.php';
require_once '../../models/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Obtener el ID del producto que se quiere editar
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    // 2. Recibir los datos del formulario
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

    // 3. Validar los campos obligatorios
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

    // 4. Preparar los datos para el modelo
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

    // 5. Ejecutar la actualización
    $resultado = editarProducto(
        $conexion,
        $id,
        $datosProducto
    );

    // 6. Redireccionar según el resultado
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