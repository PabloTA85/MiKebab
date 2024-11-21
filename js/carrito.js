document.addEventListener("DOMContentLoaded", function() {
    verificarSesion(); // Verifica si el usuario está logueado
    cargarCarrito(); // Cargar el carrito cuando se carga la página
});

function verificarSesion() {
    const usuarioLogueado = sessionStorage.getItem('usuario');
    if (usuarioLogueado) {
        // Si ya está logueado, ocultar el modal o realizar acciones específicas
        console.log("Usuario logueado:", JSON.parse(usuarioLogueado).usuario);
    } else {
        // Si no está logueado, mostrar el modal
        console.log("No hay usuario logueado.");
    }
}


// Función para cargar los kebabs del carrito desde localStorage
function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    const carritoContenido = document.getElementById("carritoContenido");
    const totalCarrito = document.getElementById("totalCarrito");

    // Limpio el carrito antes de cargar los nuevos datos
    carritoContenido.innerHTML = ""; 

    let total = 0;
    carrito.forEach(item => {
        total += item.precio * item.cantidad;

        const fila = document.createElement("tr");

        fila.innerHTML = `
            <td><img src="../Fotos/Kebabs/${item.foto}" alt="${item.nombre}" class="img-thumbnail" style="width: 50px;"></td>
            <td>${item.nombre}</td>
            <td>€${item.precio}</td>
            <td>
                <span class="btn-cantidad" onclick="modificarCantidad(${item.id}, -1)">&#8722;</span> <!-- Símbolo - -->
                <span id="cantidad-${item.id}">${item.cantidad}</span>
                <span class="btn-cantidad" onclick="modificarCantidad(${item.id}, 1)">&#43;</span> <!-- Símbolo + -->
            </td>
            <td>€${(item.precio * item.cantidad).toFixed(2)}</td>
            <td><button class="btn btn-danger" onclick="eliminarDelCarrito(${item.id})">Eliminar</button></td>
        `;

        carritoContenido.appendChild(fila);
    });

    totalCarrito.innerHTML = `Total: €${total.toFixed(2)}`;
}

// Función para modificar la cantidad de un kebab
function modificarCantidad(id, cambio) {
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    const item = carrito.find(kebab => kebab.id === id);
    if (item) {
        item.cantidad += cambio;
        // No permito que haya cantidades negativas
        if (item.cantidad < 1) item.cantidad = 1; 
        // Guardamo los cambios en localStorage
        localStorage.setItem("carrito", JSON.stringify(carrito)); 
        // Recargo el carrito con la cantidad actualizada
        cargarCarrito(); 
    }
}

// Función para eliminar un kebab del carrito
function eliminarDelCarrito(idKebab) {
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    // Filtro el kebab por id
    carrito = carrito.filter(item => item.id !== idKebab); 
    localStorage.setItem("carrito", JSON.stringify(carrito));
    // Recargo el carrito después de eliminar el artículo
    cargarCarrito(); 
}

// Función para vaciar el carrito
function vaciarCarrito() {
    localStorage.removeItem("carrito");
    // Recargamos el carrito después de vaciarlo
    cargarCarrito(); 
}

// Función para realizar la compra
function realizarCompra() {
    // Verifico si el usuario está logueado
    const usuarioLogueado = sessionStorage.getItem('usuario'); 

    if (!usuarioLogueado) {
        // Si el usuario no está logueado, muestro el modal
        abreModal(); 

        // Agregar los eventos para redirigir
        document.getElementById("loginBtn").addEventListener("click", function() {
            // Redirijo al login
            window.location.href = 'index.php?ruta=login';  
        });

        document.getElementById("registerBtn").addEventListener("click", function() {
            // Redirijo al registro
            window.location.href = 'index.php?ruta=registro';  
        });

        return;
    }

    // Si el usuario está logueado, se procede con la compra
    alert('Compra realizada con éxito');
    const carrito  = localStorage.getItem('carrito');
    console.log(carrito)
    // Se vacía el carrito después de realizar la compra
   // vaciarCarrito(); 
}

// Función para mostrar el modal
function abreModal() {
    const modal = document.getElementById("modal");
    // Mostramos el modal
    modal.style.display = "block";  
    // Añadir la clase show para que haya visibilidad
    modal.classList.add('show'); 
}

// Función para ocultar el modal
function cierraModal() {
    const modal = document.getElementById("modal");
    // Oculto el modal
    modal.style.display = "none"; 
    // Quito la clase show 
    modal.classList.remove('show'); 
}



// Cargo el carrito cuando la página se cargue
document.addEventListener("DOMContentLoaded", function() {
    cargarCarrito();
    // Verifico si el usuario está logueado al cargar la página
    verificarSesion();  
});