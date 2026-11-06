<?php
// Obtenemos el nombre del archivo actual para activar la pestaña correspondiente
$paginaActual = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 180px; min-height: 100vh;">
    <!-- Título / Marca del Panel -->
    <a href="productos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Panel Vinoteca</span>
    </a>
    <hr>
    
    <!-- Menú de Navegación Principal -->
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Sección Productos -->
        <li class="nav-item mb-1">
            <a href="productos.php" class="nav-link text-white <?php echo ($paginaActual == 'productos.php') ? 'active bg-primary' : ''; ?>">
                📦 Productos
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="producto_nuevo.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'producto_nuevo.php') ? 'text-white fw-bold' : ''; ?>">
                + Nuevo Producto
            </a>
        </li>

        <!-- Sección Categorías -->
        <li class="nav-item mb-1">
            <a href="categorias.php" class="nav-link text-white <?php echo ($paginaActual == 'categorias.php') ? 'active bg-primary' : ''; ?>">
                📂 Categorías
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="categoria_nueva.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'categoria_nueva.php') ? 'text-white fw-bold' : ''; ?>">
                + Nueva Categoría
            </a>
        </li>

        <!-- Sección Proveedores -->
        <li class="nav-item mb-1">
            <a href="proveedores.php" class="nav-link text-white <?php echo ($paginaActual == 'proveedores.php') ? 'active bg-primary' : ''; ?>">
                🏢 Proveedores
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="proveedor_nuevo.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'proveedor_nuevo.php') ? 'text-white fw-bold' : ''; ?>">
                + Nuevo Proveedor
            </a>
        </li>
    </ul>

    <hr>
    
    <div class="dropdown">
        <span class="text-white-50 small">Sesión Activa</span>
    </div>
    </hr>
</div>