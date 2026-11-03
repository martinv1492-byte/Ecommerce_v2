<?php
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../models/producto.php";

$listado = obtenerProductos($conexion);

header("Location:/../../views/admin/productos.php");
?>