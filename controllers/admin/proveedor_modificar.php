<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProveedor = isset($_POST['idProveedor']) ? (int) $_POST['idProveedor'] : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $cuit         = isset($_POST['cuit']) ? trim($_POST['cuit']) : '';
    $razonSocial  = isset($_POST['razonSocial']) ? trim($_POST['razonSocial']) : '';

    if ($idProveedor > 0 && !empty($nombre)&& !empty($cuit) && !empty($razonSocial)) {
        try {

            $datosProveedor = [
                ':nombre' => $nombre,
                ':cuit' => $cuit,
                ':razonSocial' => $razonSocial,
            ];


            if (modificarProveedor($conexion, $idProveedor, $datosProveedor)) {
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