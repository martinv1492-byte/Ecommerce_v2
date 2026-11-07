<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Incluimos los layouts (Ajustá las rutas de carpetas tradicionales)
include_once 'views/includes/tienda/head.php';
include_once 'views/includes/tienda/header.php';
?>

<!-- CONTENIDO PRINCIPAL DE LA PORTADA -->
<main class="container my-5 text-center" style="min-height: 55vh;">
    <div class="row justify-content-center align-items-center py-5">
        <div class="col-md-8 bg-white p-5 border shadow-sm rounded-0">
            <!-- Logo o Marca -->
            <h1 class="display-3 fw-bold mb-4" style="font-family: 'Times New Roman', serif; letter-spacing: 2px;">
                VINOTECA LA BARBA
            </h1>
            <p class="fs-5 text-muted mb-4">
                Bienvenidos a nuestra cava digital. Una curaduría exclusiva de las mejores bodegas boutique y destilados premium de la región.
            </p>
            <hr class="my-4 border-secondary-subtle mx-auto" style="max-width: 100px;">
            
            <!-- Botón principal para ingresar a la tienda real -->
            <a href="../../index.php" class="btn btn-dark rounded-0 px-5 py-3 text-uppercase fw-semibold" style="font-size: 0.9rem; letter-spacing: 1px;">
                Ingresar a la Tienda
            </a>
        </div>
    </div>
</main>


<!-- 🔒 VENTANA EMERGENTE OBLIGATORIA (MODAL DE MAYORÍA DE EDAD) -->
<!-- El atributo 'data-bs-backdrop="static"' impide que el usuario cierre el cartel haciendo clic afuera -->
<div class="modal fade" id="modalEdad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border-0 shadow-lg p-4 text-center">
            
            <div class="modal-body">
                <!-- Icono de advertencia o escudo -->
                <div class="mb-3 text-dark">
                    <svg xmlns="http://w3.org" width="45" height="45" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                      <path d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 2.861-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793z"/>
                    </svg>
                </div>
                
                <h4 class="fw-bold mb-3 text-uppercase" style="font-family: 'Times New Roman', serif; letter-spacing: 1px;">
                    Verificación de Edad
                </h4>
                
                <p class="text-muted small mb-4">
                    Para ingresar a este sitio web debés ser mayor de 18 años. <br>
                    <strong>¿Cumplís con este requisito legal?</strong>
                </p>

                <!-- Botones rectos estilo vinoteca -->
                <div class="d-grid gap-2">
                    <!-- El atributo 'data-bs-dismiss="modal"' es nativo de Bootstrap y cierra el cartel de inmediato -->
                    <a href="index.php?verificado=si" class="btn btn-dark rounded-0 py-2.5 text-uppercase fw-semibold w-100" style="font-size: 0.85rem;">
                        Sí, soy mayor de 18 años
                    </a>
                    
                    <!-- Si hace clic en No, lo saca del sitio mandándolo a Google -->
                    <a href="https://google.com" class="btn btn-outline-secondary rounded-0 py-2.5 text-uppercase fw-semibold" style="font-size: 0.85rem;">
                        No, soy menor
                    </a>
                </div>
            </div>

            <!-- Leyenda legal sutil al pie del cartel -->
            <div class="text-center text-muted mt-3" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                BEBER CON MODERACIÓN. PROHIBIDA LA VENTA A MENORES DE 18 AÑOS.
            </div>
            
        </div>
    </div>
</div>

<!-- ⚙️ CÓDIGO JS NATIVO DE BOOTSTRAP PARA HACER QUE EL CARTEL APAREZCA SOLO AL CARGAR LA PÁGINA -->
<script>
    // Este código se ejecuta automáticamente apenas termina de cargar el HTML de la página
    document.addEventListener("DOMContentLoaded", function() {
        // Inicializamos el modal nativo de Bootstrap usando su ID
        var miModal = new bootstrap.Modal(document.getElementById('modalEdad'));
        // Forzamos a que aparezca de inmediato en la pantalla
        miModal.show();
    });
</script>

<?php
// 2. Incluimos el pie de página tradicional
include_once 'views/includes/tienda/footer.php';
?>