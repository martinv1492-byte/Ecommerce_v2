<?php

require_once '../../views/includes/admin/proteger.php'; 
require_once '../../config/config.php';   
require_once '../../models/producto.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Recibir y limpiar datos del formulario (lo que ya teníamos controlado)
    $name        = isset($_POST['name']) ? trim($_POST['name']) : '';
    $code        = isset($_POST['code']) ? trim($_POST['code']) : '';
    $category    = isset($_POST['category']) ? trim($_POST['category']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $cost        = isset($_POST['cost']) ? trim($_POST['cost']) : 0;
    $price       = isset($_POST['price']) ? trim($_POST['price']) : 0;
    $photo       = isset($_POST['photo']) ? trim($_POST['photo']) : 'Sin imagen disponible';
    $supplier    = isset($_POST['supplier']) ? trim($_POST['supplier']) : '';
    $stock       = isset($_POST['s_tock']) ? trim($_POST['s_tock']) : 0;
    $brand       = isset($_POST['brand']) ? trim($_POST['brand']) : '';

    // Validar campos obligatorios mínimos
    if (empty($name) || empty($code) || empty($category) || empty($price)) {
        echo "Error: Faltan campos obligatorios.";
        exit;
    }

    // 2. Armar el array con los marcadores idénticos a los del Modelo
    $datosProducto = [
        ':name'        => $name,
        ':code'        => $code,
        ':category'    => $category,
        ':description' => $description,
        ':cost'        => $cost,
        ':price'       => $price,
        ':photo'       => $photo,
        ':supplier'    => $supplier,
        ':stock'       => $stock,
        ':brand'       => $brand
    ];

    // 3. LLAMAR A TU FUNCIÓN DEL MODELO
    // Le pasamos la conexión que viene de config.php y los datos limpios
    $resultado = crearProducto($conexion, $datosProducto);

    // 4. Redireccionar al listado de productos
    if ($resultado) {
        // Redirige con un mensaje de éxito en la URL
        header("Location: ../../views/admin/productos.php?status=success");
    } else {
        // Redirige con un mensaje de error en la URL
        header("Location: ../../views/admin/productos.php?status=error");
    }
    exit;

} else {
    echo "Acceso no permitido.";
}
