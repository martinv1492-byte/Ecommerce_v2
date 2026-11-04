<?php



function obtenerCategorias(PDO $conexion) {
    $sql = "SELECT idCategoria, nombre FROM categorias";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function crearCategoria(PDO $conexion, array $datosCategoria) {
    $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosCategoria);
}


function eliminarCategoria(PDO $conexion, array $datosCategoria) {
    $sql = "DELETE FROM categorias WHERE idCategoria = :idCategoria";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosCategoria);
}