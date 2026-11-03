<?php

function obtenerUsuarioPorEmail($conexion, $email) {
    // Preparar la consulta usando la lógica de PDO
    $sql = "SELECT idUsuario, nombre, password, email, rol FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        // Enlazar el parámetro de forma segura con PDO
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Obtener el resultado como un array asociativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $usuario ? $usuario : null;
    }
    
    return null;
}
?>