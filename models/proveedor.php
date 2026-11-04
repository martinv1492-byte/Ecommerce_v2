<?php

function obtenerProveedores(PDO $conexion) {
    $sql = "SELECT idProveedor, nombre, cuit, razonSocial FROM proveedores";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function crearProveedor(PDO $conexion, array $datosProveedor) {
    $sql = "INSERT INTO proveedores (nombre, cuit, razonSocial) VALUES (:nombre, :cuit, :razonSocial)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosProveedor);
}


function eliminarProveedor(PDO $conexion, array $datosProveedor) {
    $sql = "DELETE FROM proveedores WHERE idProveedor = :idProveedor";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosProveedor);
}

?>