<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../includes/tienda/head.php';
include_once '../includes/tienda/header.php';
?>

<main class="container d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 65vh;">
    <div class="p-5 border border-light-subtle shadow-sm bg-white rounded-0" style="max-width: 600px;">
        
        <div class="mb-4 text-dark fs-1">
            <i class="bi bi-hourglass-split animate-pulse"></i>
        </div>
        
        <h2 class="mb-3 fw-bold text-uppercase pb-2 border-bottom text-dark" style="font-family: 'Times New Roman', serif; letter-spacing: 2px;">
            Próximamente
        </h2>
        
        <p class="text-secondary lh-base mb-4 small text-uppercase" style="letter-spacing: 0.5px;">
            Estamos preparando una selección exclusiva para esta sección. Nuestro equipo está trabajando para traerte las mejores opciones muy pronto.
        </p>
        
        <a href="/ecommerce/index.php" class="btn btn-dark rounded-0 px-4 py-2.5 text-uppercase fw-semibold btn-sm" style="letter-spacing: 1px; font-size: 0.75rem;">
            Volver al Catálogo
        </a>
    </div>
</main>

<style>
    
    @keyframes pulse {
        0% { opacity: 0.6; }
        50% { opacity: 1; }
        100% { opacity: 0.6; }
    }
    .animate-pulse {
        animation: pulse 2s infinite ease-in-out;
    }
</style>

<?php include_once '../includes/tienda/footer.php'; ?>