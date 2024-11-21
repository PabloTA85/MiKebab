<link rel="stylesheet" href="../css/carrito.css">

<h1 class="mb-4">Carrito de Compras</h1>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="carritoContenido">
            <!-- Los productos del carrito se cargarán dinámicamente aquí -->
        </tbody>
    </table>
</div>

<div class="text-end">
    <h3 id="totalCarrito">Total: €0.00</h3>
    <button class="btn btn-danger" onclick="vaciarCarrito()">Vaciar Carrito</button>
    <button class="btn btn-primary" onclick="realizarCompra()">Realizar Compra</button>
</div>

<!-- Modal para elegir entre login o registro -->
<div id="modal" class="modal" style="display:none;">
    <div class="modal-content">
        <h4>Debe estar registrado e iniciar sesión para realizar la compra. ¿Qué desea hacer?</h4>
        <div class="button-container">
            <button id="loginBtn" class="btn btn-login">Iniciar sesión</button>
            <button id="registerBtn" class="btn btn-register">Registrarse</button>
        </div>
    </div>
</div>

<script src="../js/carrito.js"></script>

