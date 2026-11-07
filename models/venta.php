<?php
class Venta {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

        public function registrarCompra($idUsuario, $carrito) {
        try {

            $this->conexion->beginTransaction();


            $totalGeneral = 0;
            foreach ($carrito as $item) {
                $totalGeneral += $item['precio'] * $item['cantidad'];
            }

            $sqlVenta = "INSERT INTO ventas (fecha, idUsuario, total, estadoPago, estadoEnvio) 
                        VALUES (NOW(), :idUsuario, :total, :estadoPago, :estadoEnvio)";
            $stmtVenta = $this->conexion->prepare($sqlVenta);
            $stmtVenta->execute([
                ':idUsuario'   => $idUsuario,
                ':total'       => $totalGeneral,
                ':estadoPago'  => 'P', 
                ':estadoEnvio' => 'P'  
            ]);

            // Obtener el ID de la venta recién insertada
            $idVenta = $this->conexion->lastInsertId();

            // 3. Insertar en la tabla 'items' y descontar stock en 'productos'
            foreach ($carrito as $idProducto => $item) {
                $cantidad = $item['cantidad'];
                $precioUnitario = $item['precio'];
                $subtotal = $cantidad * $precioUnitario;

                // Insertar ítem de la venta
                $sqlItem = "INSERT INTO items (idVenta, idProducto, cantidad, precio, subtotal) 
                            VALUES (:idVenta, :idProducto, :cantidad, :precio, :subtotal)";
                $stmtItem = $this->conexion->prepare($sqlItem);
                $stmtItem->execute([
                    ':idVenta'    => $idVenta,
                    ':idProducto' => $idProducto,
                    ':cantidad'   => $cantidad,
                    ':precio'     => $precioUnitario,
                    ':subtotal'   => $subtotal
                ]);

                // Descontar stock del producto
                $sqlStock = "UPDATE productos SET stock = stock - :cantidad WHERE idProducto = :idProducto";
                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([
                    ':cantidad'   => $cantidad,
                    ':idProducto' => $idProducto
                ]);
            }

            // Si todo salió bien, confirmamos los cambios en la base de datos
            $this->conexion->commit();
            return $idVenta;

        } catch (Exception $e) {
            // Si ocurre cualquier error, revertimos todo
            $this->conexion->rollBack();
            return false;
        }
    }
}