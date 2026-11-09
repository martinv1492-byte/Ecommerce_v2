<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Control de mayoría de edad (Tu lógica idéntica)
if (isset($_GET['verificado']) && $_GET['verificado'] === 'si') {
    $_SESSION['mayor_edad'] = true; 
}

if (!isset($_SESSION['mayor_edad'])) {
    include_once __DIR__ . '/views/tienda/inicio.php';
    exit(); 
}

require_once __DIR__ . '/config/config.php'; 
require_once __DIR__ . '/models/producto.php'; 

// 2. CAPTURA Y TRADUCTOR DE CATEGORÍAS (Esto soluciona los warnings de la pantalla)
$categoriaUrl = isset($_GET['categoria']) ? strtolower(trim($_GET['categoria'])) : 'inicio';
$terminoBusqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

if (!empty($terminoBusqueda)) {
    $categoriaSeleccionada = 'busqueda';
    $idFiltrado = 'todas'; // Para que traiga los productos latentes que va a filtrar el LIKE
} else {
    if ($categoriaUrl === 'inicio') {
        $categoriaSeleccionada = 'inicio';
        $idFiltrado = 'todas'; 
    } elseif ($categoriaUrl === 'todas') {
        $categoriaSeleccionada = 'todas'; 
        $idFiltrado = 'todas';
    } elseif ($categoriaUrl === 'bebida-sin-alcohol' || $categoriaUrl === 'sin-alcohol') {
        $categoriaSeleccionada = 'bebida-sin-alcohol';
        $idFiltrado = 'bebida-sin-alcohol'; 
    } else {
        $categoriaSeleccionada = $categoriaUrl;
        $idFiltrado = $categoriaUrl; 
    }
}

// 3. TRAEMOS LOS DATOS INICIALES DE MYSQL
$categorias = obtenerCategorias($conexion); 

// Si el usuario buscó por palabra, usamos la función del buscador. Si no, la tradicional de categoría.
if ($categoriaSeleccionada === 'busqueda') {
    $productos = buscarProductosPorTexto($conexion, $terminoBusqueda);
} else {
    $productos = obtenerProductosPorNombreCategoria($conexion, $idFiltrado);
}
// =========================================================================
// =========================================================================
// 🚀 4. RUTEADOR DE DETALLE INTELIGENTE BLINDADO (REEMPLAZÁ ESTE BLOQUE)
// =========================================================================
$productoUrl = isset($_GET['producto']) ? strtolower(trim($_GET['producto'])) : '';

if (!empty($productoUrl)) {
    
    // Traemos todo el catálogo de la cava para comparar de forma segura
    $todosLosProductos = obtenerProductosPorNombreCategoria($conexion, 'todas');
    
    $producto = null;
    foreach ($todosLosProductos as $p) {
        // 🔍 LIMPIEZA EXTREMA: Quitamos espacios dobles ocultos y espacios al inicio/final
        $nombreLimpioBD = preg_replace('/\s+/', ' ', trim($p['nombre']));
        $nombreFormateado = str_replace(' ', '-', strtolower($nombreLimpioBD));
        
        if ($nombreFormateado === $productoUrl) {
            $producto = $p;
            break;
        }
    }

    if ($producto) {
        // Si hay match, inyectamos tu vista de detalle grande y frenamos el index
        include_once __DIR__ . '/views/tienda/producto_detalle.php';
        exit(); 
    } else {
        echo "<h2 class='text-center my-5'>El producto solicitado no se encuentra disponible.</h2>";
        exit();
    }
}
// =========================================================================


// =========================================================================
// 5. INCLUDES DE LA CABECERA (Se cargan abajo para que ya conozcan las variables limpias)
include_once 'views/includes/tienda/head.php'; 
include_once 'views/includes/tienda/header.php';
?>
<?php if (isset($_GET['status']) && $_GET['status'] === 'compra_exitosa'): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-0 m-4 shadow-sm" role="alert">
        <h4 class="alert-heading fw-bold text-uppercase fs-6 mb-1">¡Compra realizada con éxito!</h4>
        <p class="mb-0 small">
            Tu pedido <strong>#<?= htmlspecialchars($_GET['orden']); ?></strong> ha sido registrado correctamente y el stock ha sido actualizado. ¡Gracias por tu compra en la vinoteca!
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
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

                <!-- Cortina flotante con clases de Bootstrap (Se abre solo si está filtrando) -->
                <!-- Cambiá la etiqueta del div colapsable por esta: -->
                <div class="collapse <?= ($categoriaSeleccionada !== 'inicio' && $categoriaSeleccionada !== 'todas' && $categoriaSeleccionada !== 'busqueda') ? 'show' : ''; ?> position-absolute start-0 w-100 bg-white shadow-lg border" id="cortinaCategorias" style="z-index: 1050; top: 100%;">
                    <div class="list-group list-group-flush">
                        
                        <a href="index.php?categoria=todas" class="list-group-item list-group-item-action <?= $categoriaSeleccionada === 'todas' ? 'active bg-dark border-dark' : ''; ?> fw-semibold py-2.5">
                            Ver todos los productos
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

        <!-- 🍷 COLUMNA DERECHA: SECCIÓN DINÁMICA -->
        <section class="col-md-9">
            
            <?php if ($categoriaSeleccionada === 'inicio'): ?>
                
                <!-- 🏛️ PORTADA DE BIENVENIDA -->
                <div class="p-5 mb-4 bg-white border text-center shadow-sm rounded-0">
                    <h1 class="display-4 fw-bold mb-3" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                        Bienvenido a Vinoteca El Barba
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

            <?php else: ?>
                
                <!-- Título del Catálogo Dinámico sin guiones -->
                <h2 class="mb-4 fw-bold text-uppercase pb-2 border-bottom text-dark" style="font-family: 'Times New Roman', serif; letter-spacing: 1px; font-size: 1.75rem;">
                    <?php 
                    if ($categoriaSeleccionada === 'todas') {
                        echo "Nuestro Catálogo Completo";
                    } elseif ($categoriaSeleccionada === 'busqueda') {
                        echo "Resultados para: '" . htmlspecialchars($terminoBusqueda) . "'";
                    } elseif ($categoriaSeleccionada === 'bebida-sin-alcohol') {
                        echo "Bebidas sin alcohol";
                    } else {
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
                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">No se encontraron resultados.</p>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        </section>
    </div>
</main>

<?php 
include_once 'views/includes/tienda/footer.php'; 
?>