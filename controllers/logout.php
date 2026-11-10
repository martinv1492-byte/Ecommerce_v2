<?php

session_start(); 
session_unset(); 
session_destroy(); 


header("Location: /ecommerce/index.php?mensaje=Sesión cerrada correctamente");
exit();