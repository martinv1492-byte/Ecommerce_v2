<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validar que exista el rol y que sea admin
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
    // Si no es admin, lo expulsa a la raíz donde está el login
    header("Location: ../../login.php?error=acceso_denegado");
    exit();
}
