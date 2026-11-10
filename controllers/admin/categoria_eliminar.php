<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php';


if (isset($_GET['id'])) {
    $idCategoria = (int) $_GET['id'];

    try {
        
        $datos = [':idCategoria' => $idCategoria];

        
        if (eliminarCategoria($conexion, $datos)) {
            
            header("Location: /ecommerce/views/admin/categorias.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/views/admin/categorias.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        
        header("Location: /ecommerce/views/admin/categorias.php?status=error_relacion");
        exit();
    }
} else {
    
    header("Location: /ecommerce/views/admin/categorias.php");
    exit();
}