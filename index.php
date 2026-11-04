<?php
// 1. Forzamos a que muestre errores por si algo de la base de datos falla
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Traemos la conexión y el modelo directamente aquí
require_once __DIR__ . '/config/config.php'; // (Ajustá el nombre de tu archivo de conexión real)
require_once __DIR__ . '/models/producto.php'; // (Ajustá al nombre de tu modelo real)

// 3. Traemos los productos usando la variable de conexión de tu proyecto
// Recordá cambiar '$conexion' por el nombre exacto de tu variable de PDO si se llama distinto (ej: $db o $pdo)
$productos = obtenerProductos($conexion); 

// 1. Cargamos el head (abre el HTML, el <head> y el <body>)
include_once __DIR__ . '/views/includes/tienda/head.php';

// 2. Cargamos la barra de navegación que acabamos de hacer
include_once __DIR__ . '/views/includes/tienda/header.php';
?>

<main class="container my-5">
    <h2 class="text-center mb-5 fw-bold" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">Nuestra Selección</h2>
    
    <!-- Creamos la grilla responsiva de Bootstrap -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        
        <?php 
        // Suponiendo que tu controlador te envía los vinos en una variable llamada $productos
        // El bucle "fabrica" un $producto individual por cada vuelta
        if (!empty($productos)): 
            foreach ($productos as $producto): 
        ?>
                <div class="col">
                    <!-- Ahora sí, cada tarjeta sabe qué es '$producto' porque está dentro del bucle -->
                    <?php include __DIR__ . '/views/includes/tienda/tarjeta_producto.php'; ?>
                </div>
        <?php 
            endforeach; 
        else: 
        ?>
            <!-- Mensaje por si la base de datos está vacía o no conectó -->
            <div class="col-12 text-center">
                <p class="text-muted">No hay vinos disponibles en este momento.</p>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php 
include_once __DIR__ . '/views/includes/tienda/footer.php'; ?>
?>