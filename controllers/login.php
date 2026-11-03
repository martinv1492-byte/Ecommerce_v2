<?php
require_once '../config/config.php'; 
require_once '../models/usuario.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=vacio");
        exit();
    }

    $usuario = obtenerUsuarioPorEmail($conexion, $email);


    if ($usuario && password_verify($password, $usuario['password'])) {
        
        session_start();
        $_SESSION['usuario_id'] = $usuario['idUsuario']; 
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_rol'] = $usuario['rol']; 

        if ($_SESSION['usuario_rol'] === 'admin') {
            header("Location: ../views/admin/productos.php"); 
        } else {
            header("Location: ../index.php");
        }
        exit();
        
    } else {
        header("Location: ../login.php?error=incorrecto");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>