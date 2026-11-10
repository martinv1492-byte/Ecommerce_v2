<?php

require_once __DIR__ . '/config/config.php'; 


require_once __DIR__ . '/models/producto.php'; 

$productos = obtenerProductos($conexion); 

require_once __DIR__ . '/index.php';
