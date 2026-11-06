<?php
// 1. Forzamos a que muestre errores por si algo de la base de datos falla
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Traemos la conexión y el modelo directamente aquí
require_once __DIR__ . '/config/config.php'; // (Ajustá el nombre de tu archivo de conexión real)
require_once __DIR__ . '/models/producto.php'; // (Ajustá al nombre de tu modelo real)

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
// 3. Traemos los productos usando la variable de conexión de tu proyecto
// Recordá cambiar '$conexion' por el nombre exacto de tu variable de PDO si se llama distinto (ej: $db o $pdo)
$productos = obtenerProductos($conexion, $categoriaSeleccionada); 

$categorias = obtenerCategorias($conexion); 

// 1. Cargamos el head (abre el HTML, el <head> y el <body>)
include_once __DIR__ . '/views/includes/tienda/head.php';

// 2. Cargamos la barra de navegación que acabamos de hacer
include_once __DIR__ . '/views/includes/tienda/header.php';
?>

<main class="container my-5">
    <div class="row">
        <aside class="col-md-3 mb-4">
            <div class="p-3 border bg-white shadow-sm">
                <h5 class="fw-bold mb-3 text-uppercase pb-2 border-bottom" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                    Categorías
                </h5>
                <div class="list-group list-group-flush">
                    <a href="index.php" class="list-group-item list-group-item-action <?= $categoriaSeleccionada === 'todas' ? 'active bg-dark border-dark' : ''; ?> fw-semibold">
                        Ver todas las categorías
                    </a>

                    <?php foreach ($categorias as $cat): ?>
                        <a href="index.php?categoria=<?= $cat['idCategoria']; ?>" 
                           class="list-group-item list-group-item-action <?= $categoriaSeleccionada == $cat['idCategoria'] ? 'active bg-dark border-dark' : ''; ?>">
                            <?= $cat['nombre']; ?>
                        </a>
                    <?php endforeach; ?>

                </div>
            </div>
        </aside>
    
        <section class="col-md-9">
            <h2 class="mb-4 fw-bold" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                <?php 
                    // Título dinámico según lo seleccionado
                    echo $categoriaSeleccionada === 'todas' ? 'Nuestra Selección' : 'Productos Filtrados'; 
                ?>
            </h2>
            
            <!-- Reducimos a un máximo de 3 tarjetas por fila para que entren bien al lado del aside -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="col">
                            <?php include __DIR__ . '/views/includes/tienda/tarjeta_producto.php'; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted fs-5">No hay vinos disponibles en esta categoría en este momento.</p>
                    </div>
                <?php endif; ?>

            </div>
        </section>
    </div>
</main>

<?php 
include_once __DIR__ . '/views/includes/tienda/footer.php'; ?>
?>