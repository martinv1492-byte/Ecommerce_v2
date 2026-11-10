<?php

require_once '../../views/includes/admin/proteger.php'; 
require_once '../../config/config.php';   
require_once '../../models/producto.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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


    if (empty($name) || empty($code) || empty($category) || empty($price)) {
        echo "Error: Faltan campos obligatorios.";
        exit;
    }

    
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

    $resultado = crearProducto($conexion, $datosProducto);

    if ($resultado) {
        
        header("Location: ../../views/admin/productos.php?status=success");
    } else {
        
        header("Location: ../../views/admin/productos.php?status=error");
    }
    exit;

} else {
    echo "Acceso no permitido.";
}
