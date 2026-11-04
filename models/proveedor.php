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

function modificarProveedor(PDO $conexion, int $idProveedor, array $datosProveedor) {
    $sql = "UPDATE proveedores SET
                idProveedor = :idProveedor,
                nombre = :nombre,
                cuit = :cuit,
                razonSocial = :razonSocial,
            WHERE idProveedor = :id";
    $stmt = $conexion->prepare($sql);
    $datosProveedor[':id'] = $idProveedor;
    return $stmt->execute($datosProveedor);
}

function obtenerProveedorPorId($conexion, $idProveedor) {
    $sql = "SELECT * FROM proveedores WHERE idProveedor = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id' => $idProveedor]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>