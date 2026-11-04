<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');

    if (!empty($nombre)) {
        // Empaquetamos los datos para enviarlos a la función del modelo
        $datos = [':nombre' => $nombre];

        if (crearCategoria($conexion, $datos)) {
            header("Location: /ecommerce/views/admin/productos.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/views/admin/categoria_nueva.php?error=db");
            exit();
        }
    } else {
        header("Location: /ecommerce/views/admin/categoria_nueva.php?error=empty");
        exit();
    }
}
?>