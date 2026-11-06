<?php
// controllers/admin/categoria_eliminar.php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/categoria.php';

// Verificamos que llegue el ID por la URL
if (isset($_GET['id'])) {
    $idCategoria = (int) $_GET['id'];

    try {
        // Empaquetamos el ID en un array para que coincida con el modelo
        $datos = [':idCategoria' => $idCategoria];

        // Llamamos a la función de eliminación del modelo pasando el array
        if (eliminarCategoria($conexion, $datos)) {
            // Redireccionamos a la vista de gestión de categorías con éxito
            header("Location: /ecommerce/views/admin/categorias.php?status=success");
            exit();
        } else {
            header("Location: /ecommerce/views/admin/categorias.php?status=error");
            exit();
        }
    } catch (PDOException $e) {
        // Capturamos el error si choca con la clave foránea (productos asociados)
        header("Location: /ecommerce/views/admin/categorias.php?status=error_relacion");
        exit();
    }
} else {
    // Si no llega el ID, redirigimos por seguridad
    header("Location: /ecommerce/views/admin/categorias.php");
    exit();
}