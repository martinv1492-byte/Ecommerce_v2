<?php
// logout.php
session_start(); // Reanudamos la sesión existente
session_unset(); // Limpiamos todas las variables de sesión
session_destroy(); // Destruimos la sesión por completo

// Redirigimos al usuario al login con un mensaje opcional
header("Location: views/login.php?mensaje=logout+exitoso");
exit();