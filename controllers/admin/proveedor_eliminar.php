<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';


if (isset($_GET['id'])) {
    $idProveedor = (int) $_GET['id'];

    try {
        
        $datos = [':idProveedor' => $idProveedor];

        
        if (eliminarProveedor($conexion, $datos)) {
            
            header("Location: /ecommerce/views/admin/proveedores.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/views/admin/proveedores.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        
        header("Location: /ecommerce/views/admin/proveedores.php?status=error_relacion");
        exit();
    }
} else {
    
    header("Location: /ecommerce/views/admin/proveedores.php");
    exit();
}