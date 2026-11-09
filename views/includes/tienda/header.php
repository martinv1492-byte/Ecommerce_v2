<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$esPaginaCarrito = basename($_SERVER['PHP_SELF']) === 'carrito.php';

$cantidadTotalCarrito = 0;
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $cantidadTotalCarrito += $item['cantidad'];
    }
}
?>

<div class="bg-white py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="d-none d-lg-block" style="width: 150px;"></div>

        <a class="navbar-brand text-dark fs-1 fw-bold tracking-wider m-0" href="/ecommerce/index.php" style="font-family: 'Times New Roman', serif;">
            VINOTECA <span class="text-secondary">EL BARBA</span>
        </a>

        <div class="d-flex align-items-center gap-3" style="justify-content: flex-end;">
            
            <!-- 👤 ZONA DINÁMICA DE USUARIO / SESIÓN -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <span class="text-muted small d-none d-md-inline">Hola, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario'); ?></strong></span>
                <a href="/ecommerce/controllers/logout.php" class="btn btn-outline-danger btn-sm rounded-0 text-uppercase fw-semibold" style="font-size: 0.7rem;">
                    Salir
                </a>
            <?php else: ?>
                <a href="/ecommerce/views/tienda/iniciosesion.php" class="text-dark text-decoration-none small fw-semibold">Iniciar Sesión</a>
                <a href="/ecommerce/views/tienda/registro.php" class="text-muted text-decoration-none small d-none d-sm-inline">Registrarse aquí</a>
            <?php endif; ?>

            <!-- 🛒 ICONO DE CARRITO -->
            <?php if (!$esPaginaCarrito): ?>
                <a href="/ecommerce/views/tienda/carrito.php" class="text-dark position-relative text-decoration-none ms-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-basket3 me-1" viewBox="0 0 16 16" style="vertical-align: middle;">
                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-.538-6h10.288l-.538 6H3.394zm1.12-5l.429 4h7.114l.429-4H4.514z"/>
                    </svg>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 0.65rem;">
                        <?= $cantidadTotalCarrito; ?>
                    </span>
                </a>
            <?php endif; ?>

        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
    <div class="container">
        <!-- Botón móvil para colapsar la barra negra en celulares -->
        <button class="navbar-toggler my-1" type="button" data-bs-toggle="collapse" data-bs-target="#menuCategorias">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable (Categorías + Buscador) -->
        <div class="collapse navbar-collapse" id="menuCategorias">
            <!-- Links en mayúscula hacia la izquierda -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                <li class="nav-item">
                    <a class="nav-link text-white me-2" href="/ecommerce/views/tienda/proximamente.php">Novedades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 me-2" href="/ecommerce/index.php?categoria=vino" 
                        onclick="window.location.href=this.href;">Vinos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 me-2" href="/ecommerce/index.php?categoria=espumante" 
                        onclick="window.location.href=this.href;">Espumantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 me-2" href="/ecommerce/index.php?categoria=bebida-sin-alcohol" 
                    onclick="window.location.href=this.href;">Sin alcohol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger fw-bold" href="/ecommerce/views/tienda/proximamente.php">Ofertas</a>
                </li>
            </ul>

            <form action="/ecommerce/index.php" method="GET" class="d-flex my-2 my-lg-0" role="search" style="max-width: 300px;">
                <input type="text" name="busqueda" class="form-control rounded-0 border-0 px-3" placeholder="Buscar productos..." value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
        
                <button type="submit" class="btn btn-danger rounded-0 px-3 d-flex align-items-center justify-content-center" style="background-color: #dc3545;">
                    <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </form>

        </div>
    </div>
</nav>