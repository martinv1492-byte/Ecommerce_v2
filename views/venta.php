<?php class Venta {
    private $conexion;

    public function __construct($conexionDB) {
        $conexion = $conexionDB;
    }

    public function registrarCompra($idUsuario, $carrito) {
        try {
            global $conexion; // o usando la instancia que pases
            $conexion->beginTransaction();

            $totalGeneral = 0;
            foreach ($carrito as $item) {
                $totalGeneral += $item['precio'] * $item['cantidad'];
            }

            // 1. Insertar venta
            $sqlVenta = "INSERT INTO ventas (fecha, idUsuario, total, estadoPago, estadoEnvio) 
                        VALUES (NOW(), :idUsuario, :total, 'P', 'P')";
            $stmtVenta = $conexion->prepare($sqlVenta);
            $stmtVenta->execute([':idUsuario' => $idUsuario, ':total' => $totalGeneral]);
            $idVenta = $conexion->lastInsertId();

            // 2. Insertar ítems y descontar stock
            foreach ($carrito as $idProducto => $item) {
                $subtotal = $item['cantidad'] * $item['precio'];
                
                $stmtItem = $conexion->prepare("INSERT INTO items (idVenta, idProducto, cantidad, precio, subtotal) VALUES (:idVenta, :idProducto, :cantidad, :precio, :subtotal)");
                $stmtItem->execute([
                    ':idVenta' => $idVenta,
                    ':idProducto' => $idProducto,
                    ':cantidad' => $item['cantidad'],
                    ':precio' => $item['precio'],
                    ':subtotal' => $subtotal
                ]);

                $stmtStock = $conexion->prepare("UPDATE productos SET stock = stock - :cantidad WHERE idProducto = :idProducto");
                $stmtStock->execute([':cantidad' => $item['cantidad'], ':idProducto' => $idProducto]);
            }

            $conexion->commit();
            return $idVenta;

        } catch (Exception $e) {
            $conexion->rollBack();
            return false;
        }
    }
}
?>