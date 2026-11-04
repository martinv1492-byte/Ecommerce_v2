<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProveedor = isset($_POST['idProveedor']) ? (int) $_POST['idProveedor'] : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

    if ($idProveedor > 0 && !empty($nombre)) {
        try {

            $datosProveedor = [
                ':nombre' => $nombre
            ];


            if (modificarProveedor($conexion, $datosProveedor, $idProveedor)) {
                header("Location: /ecommerce/views/admin/proveedores.php?status=success");
                exit();
            } else {
                header("Location: /ecommerce/views/admin/proveedores.php?status=error");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: /ecommerce/views/admin/proveedores.php?status=error");
            exit();
        }
    } else {
        header("Location: /ecommerce/views/admin/proveedores.php?status=error");
        exit();
    }
} else {

    header("Location: /ecommerce/views/admin/proveedores.php");
    exit();
}