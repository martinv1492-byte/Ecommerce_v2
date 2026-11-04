<?php
// controllers/admin/proveedor_eliminar.php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/proveedor.php';

// Verificamos que llegue el ID por la URL
if (isset($_GET['id'])) {
    $idProveedor = (int) $_GET['id'];

    try {
        // Empaquetamos el ID en un array asociativo para PDO
        $datos = [':idProveedor' => $idProveedor];

        // Ejecutamos la función de eliminación del modelo
        if (eliminarProveedor($conexion, $datos)) {
            // Redireccionamos a la vista de proveedores con estado de éxito
            header("Location: /ecommerce/views/admin/proveedores.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/views/admin/proveedores.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        // Captura el error si el proveedor tiene productos relacionados (Clave Foránea)
        header("Location: /ecommerce/views/admin/proveedores.php?status=error_relacion");
        exit();
    }
} else {
    // Si no viene el ID, redirigimos por seguridad
    header("Location: /ecommerce/views/admin/proveedores.php");
    exit();
}