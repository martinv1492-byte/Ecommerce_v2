<?php

$paginaActual = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 180px; min-height: 100vh;">
    
    <a href="productos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Panel Vinoteca</span>
    </a>
    <hr>
    
    
    <ul class="nav nav-pills flex-column mb-auto">
        
        <li class="nav-item mb-1">
            <a href="/ecommerce/views/admin/productos.php" class="nav-link text-white <?php echo ($paginaActual == 'productos.php') ? 'active bg-primary' : ''; ?>">
                📦 Productos
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="/ecommerce/views/admin/producto_nuevo.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'producto_nuevo.php') ? 'text-white fw-bold' : ''; ?>">
                + Nuevo Producto
            </a>
        </li>

        
        <li class="nav-item mb-1">
            <a href="/ecommerce/views/admin/categorias.php" class="nav-link text-white <?php echo ($paginaActual == 'categorias.php') ? 'active bg-primary' : ''; ?>">
                📂 Categorías
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="/ecommerce/views/admin/categoria_nueva.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'categoria_nueva.php') ? 'text-white fw-bold' : ''; ?>">
                + Nueva Categoría
            </a>
        </li>

        
        <li class="nav-item mb-1">
            <a href="/ecommerce/views/admin/proveedores.php" class="nav-link text-white <?php echo ($paginaActual == 'proveedores.php') ? 'active bg-primary' : ''; ?>">
                🏢 Proveedores
            </a>
        </li>
        <li class="nav-item ms-3 mb-2">
            <a href="/ecommerce/views/admin/proveedor_nuevo.php" class="nav-link text-white-50 small <?php echo ($paginaActual == 'proveedor_nuevo.php') ? 'text-white fw-bold' : ''; ?>">
                + Nuevo Proveedor
            </a>
        </li>
    

        <li class="nav-item">
            <a class="nav-link text-white" href="/ecommerce/views/admin/ventas.php">
                <i class="bi bi-cart-check me-2"></i> 📂 Ventas
            </a>
        </li>
    </ul>
    <hr>
    
    <div class="dropdown">
    <span class="text-white-50 small">Panel de Control</span>
    <?php if (isset($_SESSION['usuario_id']) && ($_SESSION['usuario_rol'] ?? '') === 'admin'): ?>
            <span class="text-white big d-none d-md-inline"><strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Administrador'); ?></strong></span>
            <a href="/ecommerce/index.php" class="btn btn-outline-danger btn-sm rounded-0 text-uppercase fw-semibold" style="font-size: 0.7rem;">
                Volver al sitio
            </a>
    <?php endif; ?>
    </div>
    </hr>
</div>