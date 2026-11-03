<?php 
require_once __DIR__ . "/../config/config.php";

function obtenerCategorias(PDO $conexion) {
    $sql = "SELECT idCategoria, nombre FROM categorias";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerProductos(PDO $conexion, $idCategoria = 'todas') {
    if ($idCategoria !== 'todas' && !empty($idCategoria)) {
        $sql = "SELECT * FROM productos WHERE idCategoria = :idCategoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':idCategoria' => $idCategoria]);
    } else {
        $sql = "SELECT * FROM productos";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function crearProducto(PDO $conexion, array $datosProducto){
    $sql = "INSERT INTO `productos`(`nombre`, `codigo`, `idCategoria`, `descripcion`, `costo`, `precio`, `foto`, `idProveedor`, `stock`, `marca`) 
    VALUES (:name, :code, :category, :description, :cost, :price, :photo, :supplier, :stock, :brand)";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute($datosProducto);
}

function editarProducto(PDO $conexion, int $idProducto, array $datosProducto) {
    $sql = "UPDATE productos SET
                nombre = :nombre,
                codigo = :codigo,
                idCategoria = :idCategoria,
                descripcion = :descripcion,
                costo = :costo,
                precio = :precio,
                foto = :foto,
                idProveedor = :idProveedor,
                stock = :stock,
                marca = :marca
            WHERE idProducto = :id";

    $stmt = $conexion->prepare($sql);

    $datosProducto[':id'] = $idProducto;

    return $stmt->execute($datosProducto);
}

function obtenerProductoPorId(PDO $conexion, int $idProducto) {
    $sql = "SELECT * FROM productos WHERE idProducto = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->bindValue(':id', $idProducto, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function eliminarProducto(PDO $conexion, int $idProducto){
    $sql = "DELETE FROM productos WHERE idProducto = :id";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([ ':id' => $idProducto ]);
}
?>