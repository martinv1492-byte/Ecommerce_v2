<?php

require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
// Nota: Si llegas a tener un modelo para proveedores, lo puedes requerir aquí:
// require_once __DIR__ . '/../../models/proveedor.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Nuevo Proveedor</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Cargar Nuevo Proveedor</h4>
            </div>
            <div class="card-body">
                <form action="/ecommerce/controllers/admin/proveedor_crear.php" method="POST" class="row g-3">
            
                    <div class="col-md-8">
                        <label for="nombre" class="form-label">Nombre del proveedor / Empresa</label>
                        <input type="text" class="form-control" id="nombre" name="name" required placeholder="Escriba aqui...">
                    </div>

                    <div class="col-md-4">
                        <label for="contacto" class="form-label">Nombre de contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contact" placeholder="Escriba aqui...">
                    </div>

                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="phone" placeholder="Escriba aqui...">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com">
                    </div>
                
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="address" placeholder="Escriba aqui...">
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                        <a href="productos.php" class="btn btn-outline-secondary px-4">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-dark px-4">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div> 
        </div> 
    </div>                    
</body>
</html>
