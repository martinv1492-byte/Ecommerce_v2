<?php

session_start();

require_once '../config/config.php';
require_once '../models/usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Definimos un rol por defecto ('cliente'). Si el admin registra usuarios desde su panel, podría venir por POST.
    $rol = isset($_POST['rol']) ? $_POST['rol'] : 'cliente';

    if (!empty($nombre) && !empty($email) && !empty($password)) {
        
        // 2. Verificar si el email ya se encuentra registrado en la base de datos
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
            // Error inesperado en la base de datos
            header("Location: ../views/registro.php?error=fallo_bd");
            exit();
        }

    } else {
        // Error por campos vacíos
        header("Location: ../views/registro.php?error=campos+vacios");
        exit();
    }
} else {

    header("Location: ../views/registro.php");
    exit();
}
?>