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

function registrarUsuario($conexion, $nombre, $email, $password, $rol = 'cliente') {
    // Encriptar la contraseña de forma segura
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        // Ejecutamos pasando un array asociativo con los valores protegidos
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':email'    => $email,
            ':password' => $passwordHash,
            ':rol'      => $rol
        ]);
    }

    return false;
}
?>