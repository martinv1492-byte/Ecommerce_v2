<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluimos la cabecera visual de tu tienda (con tus rutas de layouts)
include_once __DIR__ . '/../includes/tienda/head.php';
include_once __DIR__ . '/../includes/tienda/header.php';

// POR AHORA: Creamos un vino de simulación fijo para que veas el diseño sin romper nada
$productoSimulado = [
    'idProducto' => 1,
    'marca' => 'SUR DE LOS ANDES',
    'nombre' => 'Gran Reserva Malbec',
    'categoria' => 'Vino',
    'precio' => 8900.00,
    'stock' => 12,
    'descripcion' => 'De un color rojo profundo con reflejos violáceos. En nariz presenta aromas complejos de frutos rojos maduros, ciruelas y sutiles notas de vainilla aportadas por su paso en roble. En boca es equilibrado, de buen cuerpo y con taninos suaves que garantizan un final largo y memorable.'
];
?>

<main class="container my-5 py-4" style="min-height: 65vh;">
    <!-- Botón sutil para volver -->
    <div class="mb-5">
        <a href="../../index.php?categoria=todas" class="text-dark text-decoration-none small fw-semibold text-uppercase tracking-wider">
            <i class="bi bi-arrow-left me-1"></i> ← Volver al Catálogo
        </a>
    </div>

    <div class="row g-5">
        <!-- 🍷 COLUMNA 1: IMAGEN DEL VINO GIGANTE (Ancho 5 de 12) -->
        <div class="col-md-5">
            <div class="bg-light p-5 d-flex align-items-center justify-content-center border shadow-sm rounded-0" style="height: 480px;">
                <!-- Usamos la primera imagen de tu base de datos local como simulación visual -->
                <img src="../../assets/img/producto_1.jpg" class="img-fluid" alt="Vino Gigante" style="max-height: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- 📜 COLUMNA 2: DETALLES, SELECTOR Y BOTÓN (Ancho 7 de 12) -->
        <div class="col-md-7 d-flex flex-column">
            
            <span class="text-muted text-uppercase tracking-widest fw-bold mb-2" style="font-size: 0.8rem; letter-spacing: 1.5px;">
                <?= $productoSimulado['marca']; ?>
            </span>
            
            <h1 class="fw-bold mb-3 text-dark" style="font-family: 'Times New Roman', serif; font-size: 2.6rem; letter-spacing: 0.5px;">
                <?= $productoSimulado['nombre']; ?>
            </h1>
            
            <span class="badge bg-dark rounded-0 align-self-start px-3 py-2 text-uppercase mb-4" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                <?= $productoSimulado['categoria']; ?>
            </span>

            <div class="mb-4 py-2 border-top border-bottom border-light-subtle">
                <span class="fs-2 fw-bold text-dark">$<?= number_format($productoSimulado['precio'], 2, ',', '.'); ?></span>
                <span class="text-muted small ms-2">/ Unidad 750ml</span>
            </div>

            <div class="mb-5">
                <h6 class="text-uppercase fw-bold mb-2" style="font-family: 'Times New Roman', serif; font-size: 0.9rem; letter-spacing: 0.5px;">Notas de Cata</h6>
                <p class="text-secondary lh-base">
                    <?= $productoSimulado['descripcion']; ?>
                </p>
            </div>

            <!-- 🛒 CONTROLES DE COMPRA POR CLIC NATIVO (Por ahora solo estéticos para Views) -->
            <div class="mt-auto">
                <div class="row g-3 align-items-center">
                    
                    <!-- Selector de Cantidad de muestra -->
                    <div class="col-auto">
                        <div class="input-group" style="max-width: 140px;">
                            <!-- Botones en línea que cambian el valor visual del input al clickear -->
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="var input = document.getElementById('cant'); input.value = Math.max(1, parseInt(input.value) - 1)">-</button>
                            <input type="text" id="cant" class="form-control text-center border-dark bg-white fw-bold rounded-0" value="1" readonly style="font-size: 0.95rem;">
                            <button class="btn btn-outline-dark rounded-0 px-3" type="button" onclick="var input = document.getElementById('cant'); input.value = Math.min(<?= $productoSimulado['stock']; ?>, parseInt(input.value) + 1)">+</button>
                        </div>
                    </div>

                    <!-- Botón Añadir a la Canasta Estilo Premium -->
                    <div class="col">
                        <button type="button" class="btn btn-dark rounded-0 w-100 py-3 text-uppercase fw-bold" style="font-size: 0.85rem; letter-spacing: 1px;">
                            Añadir a la canasta
                        </button>
                    </div>

                </div>
                
                <!-- Información de Stock Simulada -->
                <div class="mt-2 text-muted small">
                    <i class="bi bi-box-seam me-1"></i> Stock disponible: <strong class="text-dark"><?= $productoSimulado['stock']; ?> unidades</strong>
                </div>
            </div>

        </div>
    </div>
</main>

<?php
include_once __DIR__ . '/../includes/tienda/footer.php';
?>