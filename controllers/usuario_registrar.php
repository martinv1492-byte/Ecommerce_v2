<?php

session_start();

require_once '../config/config.php';
require_once '../models/usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    
    $rol = isset($_POST['rol']) ? $_POST['rol'] : 'cliente';

    if (!empty($nombre) && !empty($email) && !empty($password)) {
        
        
        $usuarioExistente = obtenerUsuarioPorEmail($conexion, $email);
        if ($usuarioExistente) {
            header("Location: ../views/registro.php?error=email+duplicado");
            exit();
        }

        $resultado = registrarUsuario($conexion, $nombre, $email, $password, $rol);

        if ($resultado) {

            header("Location: ../login.php?registro=exitoso");
            exit();
        } else {
            
            header("Location: ../views/registro.php?error=fallo_bd");
            exit();
        }

    } else {
        
        header("Location: ../views/registro.php?error=campos+vacios");
        exit();
    }
} else {

    header("Location: ../views/registro.php");
    exit();
}
?>