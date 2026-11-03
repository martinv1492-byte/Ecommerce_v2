<?php

require_once __DIR__ . '/../includes/admin/proteger.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/producto.php';

$categorias = obtenerCategorias($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="/ecommerce/assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Cargar Nuevo Producto</h4>
            </div>
            <div class="card-body">
            <form action='/ecommerce/controllers/admin/producto_crear.php' method='POST' class="row g-3">
        
                <div class="col-md-8">
                    <label for="nombre" class="form-label">Cargar producto</label>
                    <input type="text" class="form-control" id="nombre" name="name" placeholder="Escriba aqui...">
                </div>

                <div class="col-md-8">
                    <label for="codigo" class="form-label">Cargar codigo</label>
                    <input type="text" class="form-control" id="codigo" name="code" placeholder="Escriba aqui...">
                </div>
                
                <div>
                    <label for="categoria" class="form-label">Cargar categoria...</label>
                    <select id="categoria" class="form-select" name="category">
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['idCategoria']; ?>">
                                <?php echo htmlspecialchars($cat['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            
                <div class="col-12">
                    <label for="descripcion" class="form-label">Cargar descripcion</label>
                    <textarea class="form-control" id="descripcion" name="description" placeholder="Escriba aqui..."></textarea>
                </div>
            
                <div class="col-md-4">
                    <label for="costo" class="form-label">Cargar costo</label>
                    <input type="number" class="form-control" min=0 step="0.01" id="costo" name="cost" placeholder="Escriba aqui...">
                </div>

                <div class="col-md-4">
                    <label for="precio" class="form-label">Cargar precio</label>
                    <input type="number" class="form-control" min=0 step="0.01" id="precio" name="price" placeholder="Escriba aqui...">
                </div>
                
                <div class="col-12">
                    <label for="foto" class="form-label">Cargar foto</label>
                    <input type="url" class="form-control" id="foto" name="photo" placeholder="https://ejemplo.com">
                </div>
                
                <div class="col-md-6">
                    <label for="proveedor" class="form-label">Cargar proveedor</label>
                    <select id="proveedor" class="form-select" name="supplier">
                        <option value="" disabled selected>Seleccione proveedor...</option>
                        <option value="1">Distribuidora Carmen</option>
                        <option value="2">Beco Distribuciones</option>
                        <option value="3">Distribuidora Gold</option>
                        <option value="4">Promark Distribuciones</option>
                        <option value="5">Maxiconsumo</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="stock" class="form-label">Cargar stock</label>
                    <input type="number" class="form-control" min=0 id="stock" name="s_tock" placeholder="Escriba aqui..."> 
                </div>
            
                <div class="col-md-4">
                    <label for="marca" class="form-label">Cargar marca</label>
                    <input type="text" class="form-control" id="marca" name="brand" placeholder="Escriba aqui...">
                </div>

                <button type="submit" class="btn btn-info w-100 text-dark fw-bold mb-3">Cargar</button>
            </form>
            </div> 
        </div> 
    </div>                    
</body>
</html>