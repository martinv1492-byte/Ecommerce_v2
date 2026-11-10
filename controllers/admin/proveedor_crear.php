<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $cuit = trim($_POST['cuit'] ?? '');
    $razonSocial = trim($_POST['razonSocial'] ?? '');

    if (!empty($nombre) && !empty($cuit)) {
        
        $datos = [
            ':nombre' => $nombre,
            ':cuit' => $cuit,
            ':razonSocial' => $razonSocial
        ];

        if (crearProveedor($conexion, $datos)) {
            
            header("Location: /ecommerce/views/admin/productos.php?status=success");
            exit();
        } else {
            
            header("Location: /ecommerce/views/admin/proveedor_nuevo.php?error=db");
            exit();
        }
    } else {
        
        header("Location: /ecommerce/views/admin/proveedor_nuevo.php?error=empty");
        exit();
    }
}
?>