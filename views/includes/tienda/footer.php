<!-- Cierre del contenedor principal (del index) -->
</main>

<footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row text-center text-md-start">
            
            <div class="container py-4">
            <div class="row">
                <!-- Columna 1: Sobre Nosotros -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-white text-uppercase fw-bold mb-3 fs-6" style="letter-spacing: 1px;">Sobre Nosotros</h5>
                    <p class="text-white-50 small lh-base">Selección exclusiva de bodegas boutique, ediciones limitadas y los mejores destilados para tus momentos especiales.</p>
                </div>

                <!-- Columna 2: Información (Enlaces con el Modal) -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-white text-uppercase fw-bold mb-3 fs-6" style="letter-spacing: 1px;">Información</h5>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="text-white-50 small text-decoration-none footer-link" data-bs-toggle="modal" data-bs-target="#infoModal" data-bs-title="Cómo Comprar" data-bs-body="1. Selecciona tus productos y agrégalos al carrito.<br>2. Una vez en el carrito, deberás registrarte o iniciar sesión para seguir con tu compra.<br>3. Sigue las instrucciones en pantalla para completar el pago.">Cómo Comprar</a>
                        <a href="#" class="text-white-50 small text-decoration-none footer-link" data-bs-toggle="modal" data-bs-target="#infoModal" data-bs-title="Envíos y Entregas" data-bs-body="Realizamos envíos a todo el país a través de Correo Argentino. El tiempo estimado de entrega es de 3 a 5 días hábiles una vez confirmado el pago. Podrás realizar el seguimiento de tu pedido con el código enviado a tu correo.">Envíos y Entregas</a>
                    </div>
                </div>

                <!-- Columna 3: Contacto -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-white text-uppercase fw-bold mb-3 fs-6" style="letter-spacing: 1px;">Contacto</h5>
                    <ul class="list-unstyled text-white-50 small lh-base p-0 m-0">
                        <li class="mb-2">Dirección:  Calle 14 N° 742, B1900 La Plata, Buenos Aires</li>
                        <li class="mb-2">Email: contacto@elbarba.com</li>
                        <li class="mb-2">Teléfono: +54 221 456-7890</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Estilo opcional para que los enlaces cambien a blanco brillante al pasar el mouse (Hover) -->
        <style>
            .footer-link:hover {
                color: #fff !important;
                transition: color 0.2s ease-in-out;
            }
        </style>

        </div>

        <hr class="border-secondary my-4">

        <!-- LEYENDA LEGAL OBLIGATORIA PARA VENTA DE ALCOHOL -->
        <div class="row">
            <div class="col-12 text-center text-white-50 mb-3">
                <p class="small fw-bold tracking-widest text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #c58080;">
                    Beber con moderación. Prohibida la venta a menores de 18 años.
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row">
            <div class="col-12 text-center text-white-50" style="font-size: 0.8rem;">
                <p class="m-0">&copy; 2026 ElBarba Vinoteca. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Único de Información -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header bg-dark text-white border-0 py-3">
                <h5 class="modal-title fw-semibold text-uppercase tracking-wider fs-6" id="infoModalLabel">Información</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-secondary lh-base p-4" id="infoModalBody">
                <!-- El contenido se cargará de manera dinámica aquí -->
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-dark btn-sm rounded-0 text-uppercase fw-semibold" data-bs-dismiss="modal" style="font-size: 0.75rem;">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Script Dinámico -->
<script>
    const infoModal = document.getElementById('infoModal');
    if (infoModal) {
        infoModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            // Extraer la información de los atributos data-bs-*
            const title = button.getAttribute('data-bs-title');
            const body = button.getAttribute('data-bs-body');
            
            // Actualizar el contenido del modal
            const modalTitle = infoModal.querySelector('.modal-title');
            const modalBody = infoModal.querySelector('#infoModalBody');

            modalTitle.textContent = title;
            modalBody.innerHTML = body; // Usamos innerHTML por si incluyen saltos de línea <br>
        });
    }
</script>

<!-- VINCULAR EL ARCHIVO JAVASCRIPT DE BOOTSTRAP (Local, igual a como hicieron con el CSS) -->
<script src="/ecommerce/assets/js/bootstrap.bundle.min.js"></script>
<!-- (Ajustá la ruta 'js/' según la carpeta real donde tengan guardado su script de Bootstrap) -->

</body>
</html>