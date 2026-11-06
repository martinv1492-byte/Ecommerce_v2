<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCategoria = isset($_POST['idCategoria']) ? (int) $_POST['idCategoria'] : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

    if ($idCategoria > 0 && !empty($nombre)) {
        try {

            $datosCategoria = [
                ':nombre' => $nombre
            ];


            if (modificarCategoria($conexion, $datosCategoria, $idCategoria)) {
                header("Location: /ecommerce/views/admin/categorias.php?status=success");
                exit();
            } else {
                header("Location: /ecommerce/views/admin/categorias.php?status=error");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: /ecommerce/views/admin/categorias.php?status=error");
            exit();
        }
    } else {
        header("Location: /ecommerce/views/admin/categorias.php?status=error");
        exit();
    }
} else {

    header("Location: /ecommerce/views/admin/categorias.php");
    exit();
}