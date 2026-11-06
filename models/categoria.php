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

function modificarCategoria(PDO $conexion, int $idCategoria, array $datosCategoria) {
    $sql = "UPDATE categorias SET
                idCategoria = :idCategoria,
                nombre = :nombre,
                cuit = :cuit,
                razonSocial = :razonSocial,
            WHERE idCategoria = :id";
    $stmt = $conexion->prepare($sql);
    $datosCategoria[':id'] = $idCategoria;
    return $stmt->execute($datosCategoria);
}

function obtenerCategoriaPorId($conexion, $idCategoria) {
    $sql = "SELECT * FROM categorias WHERE idCategoria = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id' => $idCategoria]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
