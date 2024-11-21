<link rel="stylesheet" href="../css/kebabGusto.css">
<script src="../js/kebabGusto.js" defer></script>

<div class="container mt-4">
    <h1 class="text-center mb-4">Crear un Kebab al Gusto</h1>
    <div class="row">
        <!-- Columna izquierda con imagen del Kebab -->
        <div class="col-md-6 text-center">
            <div class="kebab-image">
                <img src="../Fotos/Kebabs/KebabAlGusto.jpg" alt="Imagen del Kebab" id="kebab-img" class="img-fluid">
            </div>
        </div>

        <!-- Columna derecha con ingredientes y precio -->
        <div class="col-md-6">
            <!-- Ingredientes Seleccionados -->
            <div class="selected-ingredients-container mt-3">
                <h4>Ingredientes Seleccionados</h4>
                <div class="selected-ingredients-list" id="selected-ingredients">
                    <!-- Los ingredientes seleccionados se agregarán aquí -->
                </div>
            </div>

            <!-- Ingredientes Disponibles -->
            <div class="ingredients-container mt-3">
                <h4>Ingredientes Disponibles</h4>
                <div class="ingredients-list" id="available-ingredients">
                    <!-- Los ingredientes se cargarán dinámicamente aquí -->
                </div>
            </div>

            <!-- Precio del Kebab -->
            <div class="mt-3">
                <label for="price" style="font-weight: bold;">Precio del Kebab:</label>
                <span id="price">5.00 €</span>
            </div>

            <!-- Botones -->
            <div class="mt-3 text-center">
                <a href="router.php?ruta=menu" class="btn btn-secondary">Cancelar</a>
                <a href="carrito.php" id="add-to-cart" class="btn btn-primary">Añadir al Carrito</a>
            </div>
        </div>
    </div>
</div>
