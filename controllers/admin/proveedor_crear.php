<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $cuit = trim($_POST['cuit'] ?? '');
    $razonSocial = trim($_POST['razonSocial'] ?? '');

    if (!empty($nombre) && !empty($cuit)) {
        // Empaquetamos los datos para enviarlos a la función del modelo
        $datos = [
            ':nombre' => $nombre,
            ':cuit' => $cuit,
            ':razonSocial' => $razonSocial
        ];

        if (crearProveedor($conexion, $datos)) {
            // Éxito al guardar
            header("Location: /ecommerce/views/admin/productos.php?status=success");
            exit();
        } else {
            // Error en la inserción
            header("Location: /ecommerce/views/admin/proveedor_nuevo.php?error=db");
            exit();
        }
    } else {
        // Faltan campos obligatorios
        header("Location: /ecommerce/views/admin/proveedor_nuevo.php?error=empty");
        exit();
    }
}
?>