<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// 2. Si el usuario acaba de hacer clic en el "SÍ" del cartel de inicio.php
if (isset($_GET['verificado']) && $_GET['verificado'] === 'si') {
    $_SESSION['mayor_edad'] = true; // Guardamos el pase libre en la sesión
}

// 3. CONTROL DE ACCESO: Si NO está verificado en la sesión, frenamos el index aquí
// y le clavamos la pantalla de inicio con el cartel obligatoriamente.
if (!isset($_SESSION['mayor_edad'])) {
    // Cargamos el archivo de inicio (ajustá la ruta según dónde lo guardaron)
    include_once __DIR__ . '/views/tienda/inicio.php';
    exit(); // Matamos la ejecución del resto del index para que no se vean los vinos por detrás
}
// 1. Forzamos a que muestre errores por si algo de la base de datos falla
require_once __DIR__ . '/config/config.php'; 
require_once __DIR__ . '/models/producto.php'; 

// 1. CAPTURA VISUAL: Guardamos la palabra tal cual viene de la URL para el diseño (ej: 'bebida-sin-alcohol')
$categoriaSeleccionada = isset($_GET['categoria']) ? strtolower(trim($_GET['categoria'])) : 'todas';

// 2. TRADUCTOR PARA LA BASE DE DATOS: Creamos una variable auxiliar para el motor MySQL
if ($categoriaSeleccionada === 'bebida-sin-alcohol' || $categoriaSeleccionada === 'sin-alcohol') {
    $idFiltrado = 10; // Si es la rebelde, le mandamos el número a la BD
} else {
    $idFiltrado = $categoriaSeleccionada; // Para las demás, le mandamos el texto (ej: 'ron')
}

// 3. Traemos las categorías reales para el menú aside
$categorias = obtenerCategorias($conexion); 

// 🔥 CAMBIO AQUÍ: Le pasamos la variable auxiliar '$idFiltrado' al modelo
$productos = obtenerProductosPorNombreCategoria($conexion, $idFiltrado);

include_once 'views/includes/tienda/head.php'; // Ajustá el nombre de tu carpeta si es layout o includes
include_once 'views/includes/tienda/header.php';
?>
<main class="container my-5">
    <div class="row">
        <!-- 🏛️ COLUMNA IZQUIERDA: EL ASIDE DESPLEGABLE POR CLIC -->
        <aside class="col-md-3 mb-4">
            <div class="p-0 border bg-white shadow-sm rounded-0 position-relative">
                
                <!-- Botón oficial de Bootstrap -->
                <button class="btn btn-dark w-100 rounded-0 text-uppercase fw-bold py-3 d-flex align-items-center justify-content-between px-3" 
                        type="button"
                        data-bs-toggle="collapse" 
                        data-bs-target="#cortinaCategorias">
                    <span><i class="bi bi-filter-left me-2 fs-5"></i> Explorar nuestra cava</span>
                    <i class="bi bi-chevron-down small"></i>
                </button>

                <!-- Cortina flotante con clases de Bootstrap -->
                <!-- Modificá la etiqueta del div colapsable para que quede así: -->
                <div class="collapse <?= $categoriaSeleccionada !== 'todas' ? 'show' : ''; ?> position-absolute start-0 w-100 bg-white shadow-lg border" id="cortinaCategorias" style="z-index: 1050; top: 100%;">

                    <div class="list-group list-group-flush">
                        
                        <a href="index.php" class="list-group-item list-group-item-action <?= $categoriaSeleccionada === 'todas' ? 'active bg-dark border-dark' : ''; ?> fw-semibold py-2.5">
                            Ver todas las categorías
                        </a>

                        <?php foreach ($categorias as $cat): 
                            $slugCategoria = str_replace(' ', '-', strtolower($cat['nombre'])); 
                        ?>
                            <a href="index.php?categoria=<?= $slugCategoria; ?>" 
                            class="list-group-item list-group-item-action <?= $categoriaSeleccionada === $slugCategoria ? 'active bg-dark border-dark' : ''; ?> py-2.5">
                                <?= $cat['nombre']; ?>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>
        </aside>

        <!-- 🍷 COLUMNA DERECHA: SECCIÓN DINÁMICA (Ancho de 9 de 12 columnas) -->
        <section class="col-md-9">
            
            <?php 
            // Evaluamos: Si el usuario NO eligió ninguna categoría todavía, mostramos la Portada
            if ($categoriaSeleccionada === 'todas'): 
            ?>
                
                <!-- 🏛️ PORTADA DE BIENVENIDA (Esto es lo primero que verán al entrar) -->
                <div class="p-5 mb-4 bg-white border text-center shadow-sm rounded-0">
                    <h1 class="display-4 fw-bold mb-3" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                        Bienvenido a Vinoteca La Barba
                    </h1>
                    <p class="fs-5 text-muted max-w-2xl mx-auto">
                        Descubrí nuestra exclusiva selección de cosechas premiadas, bodegas boutique e historias embotelladas. 
                    </p>
                    <hr class="my-4 border-secondary-subtle" style="max-width: 100px; margin: 0 auto;">
                    <p class="small text-uppercase tracking-wider fw-semibold text-secondary mt-3">
                        ← Seleccioná una categoría en el menú lateral para explorar nuestro catálogo
                    </p>
                </div>

                <!-- Bloque estético extra: Características de la vinoteca -->
                <div class="row text-center mt-5 g-4">
                    <div class="col-md-4">
                        <div class="p-3">
                            <h6 class="fw-bold text-uppercase" style="font-family: 'Times New Roman', serif;">Envíos a todo el país</h6>
                            <p class="small text-muted">Cuidamos cada botella para que llegue intacta a tu mesa.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <h6 class="fw-bold text-uppercase" style="font-family: 'Times New Roman', serif;">Selección Premium</h6>
                            <p class="small text-muted">Catas previas por sommeliers para asegurar la máxima calidad.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <h6 class="fw-bold text-uppercase" style="font-family: 'Times New Roman', serif;">Compra Segura</h6>
                            <p class="small text-muted">Tus transacciones y datos están 100% protegidos.</p>
                        </div>
                    </div>
                </div>

            <?php 
            else: 
            // SI EL USUARIO HIZO CLIC EN UNA CATEGORÍA: Ocultamos la portada y dibujamos el catálogo
            ?>
                
                <!-- Título del Catálogo que muestra el nombre de la categoría elegida -->
                <h2 class="mb-4 fw-bold text-uppercase pb-2 border-bottom text-dark" style="font-family: 'Times New Roman', serif; letter-spacing: 1px; font-size: 1.75rem;">
                    <?php 
        // Filtramos de forma manual cada palabra de la URL para poner el título lindo
                        if ($categoriaSeleccionada === 'todas') {
                            echo "Nuestra Selección";
                        } elseif ($categoriaSeleccionada === 'bebida-sin-alcohol' || $categoriaSeleccionada === 'sin-alcohol') {
                            echo "Bebidas sin alcohol";
                        } elseif ($categoriaSeleccionada === 'vino') {
                            echo "Vinos";
                        } elseif ($categoriaSeleccionada === 'espumante') {
                            echo "Espumantes";
                        } elseif ($categoriaSeleccionada === 'vodka') {
                            echo "Vodkas";
                        } elseif ($categoriaSeleccionada === 'ron') {
                            echo "Rones";
                        } else {
                            // Por si hay otra categoría, muestra el texto de la URL suelto
                            echo htmlspecialchars($categoriaSeleccionada);
                        }
                    ?>
                </h2>
                
                <!-- Grilla de Tarjetas -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <div class="col">
                                <?php include __DIR__ . '/views/includes/tienda/tarjeta_producto.php'; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Mensaje de alerta por si esa categoría justa está vacía en MySQL -->
                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">No hay vinos disponibles en la categoría <strong><?= htmlspecialchars($categoriaSeleccionada); ?></strong> en este momento.</p>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        </section>
    </div>
</main>

<?php 
include_once 'views/includes/tienda/footer.php'; ?>
?>