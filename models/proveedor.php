<?php
// models/proveedor.php

// Función para listar todos los proveedores (ideal para selects o tablas)
function obtenerProveedores(PDO $conexion) {
    $sql = "SELECT idProveedor, nombre, cuit, razonSocial FROM proveedores";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para registrar un nuevo proveedor
function crearProveedor(PDO $conexion, array $datosProveedor) {
    $sql = "INSERT INTO proveedores (nombre, cuit, razonSocial) VALUES (:nombre, :cuit, :razonSocial)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosProveedor);
}
?>