<?php
// models/categoria.php

// Función para obtener todas las categorías (usada en el select de filtros)
function obtenerCategorias(PDO $conexion) {
    $sql = "SELECT idCategoria, nombre FROM categorias";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para insertar una nueva categoría en la base de datos
function crearCategoria(PDO $conexion, array $datosCategoria) {
    $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosCategoria);
}