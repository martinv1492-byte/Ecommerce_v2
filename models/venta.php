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


            $idVenta = $this->conexion->lastInsertId();

            foreach ($carrito as $idProducto => $item) {
                $cantidad = $item['cantidad'];
                $precioUnitario = $item['precio'];
                $subtotal = $cantidad * $precioUnitario;

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

                
                $sqlStock = "UPDATE productos SET stock = stock - :cantidad 
                            WHERE idProducto = :idProducto AND stock >= :cantidad";
                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([
                    ':cantidad'   => $cantidad,
                    ':idProducto' => $idProducto
                ]);

                
                if ($stmtStock->rowCount() === 0) {
                    throw new Exception("Stock insuficiente para el producto ID: " . $idProducto);
                }
            }

            
            $this->conexion->commit();
            return $idVenta;

        } catch (Exception $e) {
            
            $this->conexion->rollBack();
            return false;
        }
    }
}