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
        $sql = "SELECT p.*, pr.nombre AS nombre_proveedor, c.nombre AS nombre_categoria 
                FROM productos p 
                LEFT JOIN proveedores pr ON p.idProveedor = pr.idProveedor 
                LEFT JOIN categorias c ON p.idCategoria = c.idCategoria 
                WHERE p.idCategoria = :idCategoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':idCategoria' => $idCategoria]);
    } else {
        $sql = "SELECT p.*, pr.nombre AS nombre_proveedor, c.nombre AS nombre_categoria 
                FROM productos p 
                LEFT JOIN proveedores pr ON p.idProveedor = pr.idProveedor
                LEFT JOIN categorias c ON p.idCategoria = c.idCategoria";
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

function obtenerProductosPorNombreCategoria(PDO $conexion, $categoriaSeleccionada = 'todas') {
    if ($categoriaSeleccionada !== 'todas' && $categoriaSeleccionada !== 'inicio' && !empty($categoriaSeleccionada)) {
        
        if (is_numeric($categoriaSeleccionada)) {
            $condicion = "p.idProducto = :categoriaSeleccionada";
        } else {
            
            $condicion = "LOWER(TRIM(c.nombre)) = :categoriaSeleccionada";
        }

        $sql = "SELECT p.*, pr.nombre AS nombre_proveedor, c.nombre AS nombre_categoria 
                FROM productos p 
                LEFT JOIN proveedores pr ON p.idProveedor = pr.idProveedor 
                LEFT JOIN categorias c ON p.idCategoria = c.idCategoria 
                WHERE $condicion";
                
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':categoriaSeleccionada' => strtolower(trim($categoriaSeleccionada))]);
    } else {
        $sql = "SELECT p.*, pr.nombre AS nombre_proveedor, c.nombre AS nombre_categoria 
                FROM productos p 
                LEFT JOIN proveedores pr ON p.idProveedor = pr.idProveedor
                LEFT JOIN categorias c ON p.idCategoria = c.idCategoria";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function buscarProductosPorTexto(PDO $conexion, $termino) {
    
    $busquedaConComodines = "%" . $termino . "%";
    
    $sql = "SELECT p.*, pr.nombre AS nombre_proveedor, c.nombre AS nombre_categoria 
            FROM productos p 
            LEFT JOIN proveedores pr ON p.idProveedor = pr.idProveedor 
            LEFT JOIN categorias c ON p.idCategoria = c.idCategoria 
            WHERE LOWER(p.nombre) LIKE :busqueda 
               OR LOWER(p.marca) LIKE :busqueda 
               OR LOWER(c.nombre) LIKE :busqueda";
               
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':busqueda' => strtolower($busquedaConComodines)]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>