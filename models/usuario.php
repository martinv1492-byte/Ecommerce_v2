<?php

function obtenerUsuarioPorEmail($conexion, $email) {
    
    $sql = "SELECT idUsuario, nombre, password, email, rol FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $conexion->prepare($sql);
    
    if ($stmt) {
        
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $usuario ? $usuario : null;
    }
    
    return null;
}

function registrarUsuario($conexion, $nombre, $email, $password, $rol = 'cliente') {
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        
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