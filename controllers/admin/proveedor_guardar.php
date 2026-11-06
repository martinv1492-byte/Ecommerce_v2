<?php

require_once __DIR__ . '/../../config/config.php';


require_once __DIR__ . '/../../models/proveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $cuit = trim($_POST['cuit'] ?? '');
    $razonSocial = trim($_POST['razonSocial'] ?? '');

    if (empty($nombre) || empty($cuit) || empty($razonSocial)) {
        header('Location: ../../views/admin/proveedor_nuevo.php?error=empty');
        exit;
    }

    $datosProveedor = [
        ':nombre'      => $nombre,
        ':cuit'        => $cuit,
        ':razonSocial' => $razonSocial
    ];

    try {
        $resultado = crearProveedor($conexion, $datosProveedor);

        if ($resultado) {
            header('Location: ../../views/admin/proveedores.php?status=success');
            exit;
        } else {
            header('Location: ../../views/admin/proveedor_nuevo.php?error=db');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: ../../views/admin/proveedor_nuevo.php?error=exception');
        exit;
    }
} else {
    header('Location: ../../views/admin/proveedores.php');
    exit;
}
?>