<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Jm8XkMDb3kGxtnI3QcqRDnRnIk1EFN4u7AY1LSfahGZj3zRM4nX4wBiJmZ9TwKf9" crossorigin="anonymous">

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoAJ9zY7C2il6Dk7gIeiwixmKEe37hu6b9hFi9Rxv2MNj8/"
    crossorigin="anonymous"></script>

<link rel="stylesheet" href="../css/kebabCasa.css">

<h1>Kebabs de la Casa</h1>

<div class="contenedor">
    <div class="fila" id="kebab-container">
        <!-- Los kebabs se cargarán dinámicamente aquí -->
    </div>
</div>

<!-- Modal personalizado -->
<div class="modal" id="modalKebab">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modificar Kebab</h5>
                <button type="button" class="cerrar-modal" onclick="cerrarModal()">×</button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body container">
                <div class="row">
                    <!-- Columna izquierda con imagen del Kebab -->
                    <div class="col-md-6 text-center">
                        <div class="kebab-image">
                            <img id="modalImage" src="ruta_a_la_imagen.jpg" alt="Imagen del Kebab"
                                class="img-fluid rounded shadow-sm">
                        </div>
                        <h5 id="modalName" class="mt-3 fw-bold text-primary"></h5> <!-- Nombre del Kebab -->
                        <p id="modalPrice" class="text-muted fs-5"></p> <!-- Precio del Kebab -->
                    </div>

                    <!-- Columna derecha con ingredientes -->
                    <div class="col-md-6">
                        <!-- Ingredientes actuales -->
                        <div class="ingredients-container mt-3">
                            <h4 class="text-secondary">Ingredientes actuales</h4>
                            <div id="ingredientesList" class="ingredients-list">
                                <!-- Ingredientes actuales se agregarán aquí -->
                            </div>
                        </div>

                        <!-- Ingredientes disponibles -->
                        <div class="ingredients-container mt-3">
                            <h4 class="text-secondary">Ingredientes disponibles</h4>
                            <div id="todosIngredientesList" class="ingredients-list">
                                <!-- Ingredientes disponibles se agregarán aquí -->
                            </div>
                        </div>

                        <!-- Precio del Kebab -->
                        <div class="mt-3">
                            <label for="price" class="fw-bold text-dark">Precio del Kebab:</label>
                            <span id="price" class="badge bg-success fs-5">5.00 €</span>
                        </div>

                        <!-- Botones -->
                        <div class="mt-4 text-center">
                            <button class="btn btn-outline-secondary me-2" onclick="cerrarModal()">Cancelar</button>
                            <button class="btn btn-primary" onclick="añadirAlCarrito()">Añadir al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
    // Función para obtener los kebabs desde la API
    function obtenerKebabs() {
        fetch("http://localhost/WorkSpace/MiKebab/Api/kebab.php?action=obtenerKebabs")
            .then(response => response.json()) // Convierte la respuesta en JSON
            .then(kebabs => {
                const container = document.getElementById("kebab-container");
                // Limpiar el contenedor antes de agregar nuevos elementos
                container.innerHTML = '';

                // Recorrer cada kebab y agregarlo al contenedor
                kebabs.forEach(kebab => {
                    const kebabItem = document.createElement("div");
                    kebabItem.classList.add("col-sm-6", "col-12", "kebab-item", "mb-3");

                    // Crear el contenido del kebab
                    kebabItem.innerHTML = `
                    <div class="card">
                        <img src="../Fotos/Kebabs/${kebab.foto}" alt="${kebab.nombre}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">${kebab.nombre}</h5>
                            <p class="card-text">Precio: €${kebab.precio}</p>
                            <button onclick="mostrarModal(${kebab.idKebab})" class="btn btn-primary">Modificar</button>
                            <a href="javascript:void(0)" onclick="añadirAlCarrito(${kebab.idKebab})" class="btn btn-success">Añadir</a>
                        </div>
                    </div>
                `;
                    container.appendChild(kebabItem);
                });
            })
            .catch(error => console.error("Error al obtener los kebabs:", error));
    }

    // Función para mostrar el modal con los detalles del kebab
    function mostrarModal(idKebab) {
        fetch(`http://localhost/WorkSpace/MiKebab/Api/kebab.php?action=obtenerKebab&id=${idKebab}`)
            .then(response => response.json())
            .then(kebab => {
                // Rellenar la información del modal
                document.getElementById("modalTitle").innerText = `Modificar Kebab`;
                document.getElementById("modalImage").src = `../Fotos/Kebabs/${kebab.foto}`;
                document.getElementById("modalPrice").innerText = `Precio: €${kebab.precio}`; // Cambiado a €
                document.getElementById("modalName").innerText = kebab.nombre; // Nombre debajo del precio

                // Mostrar los ingredientes del kebab seleccionado
                obtenerIngredientes(idKebab);

                // Obtener todos los ingredientes disponibles
                obtenerTodosIngredientes();

                // Mostrar el modal
                const modal = document.getElementById('modalKebab');
                modal.classList.add('abierto');
            })
            .catch(error => console.error("Error al obtener el kebab:", error));
    }


    // Función para obtener los ingredientes de un kebab
    function obtenerIngredientes(idKebab) {
        fetch(`http://localhost/WorkSpace/MiKebab/Api/kebab.php?action=obtenerIngredientes&idKebab=${idKebab}`)
            .then(response => response.json())
            .then(ingredientes => {
                const ingredientesContainer = document.getElementById("ingredientesList");
                ingredientesContainer.innerHTML = ''; // Limpiar cualquier ingrediente anterior

                // Recorrer los ingredientes y agregarlos al modal
                ingredientes.forEach(ingrediente => {
                    const ingredienteItem = document.createElement("li");
                    ingredienteItem.classList.add("list-group-item");

                    ingredienteItem.innerHTML = `
                    <strong>${ingrediente.nombre}</strong> - €${ingrediente.precio} <!-- Cambio de $ a € -->
                    <img src="../Fotos/Ingredientes/${ingrediente.foto}" alt="${ingrediente.nombre}" class="img-thumbnail" style="width: 50px;">
                `;
                    ingredientesContainer.appendChild(ingredienteItem);
                });
            })
            .catch(error => console.error("Error al obtener los ingredientes:", error));
    }

    // Función para obtener todos los ingredientes disponibles de la base de datos
    function obtenerTodosIngredientes() {
        fetch("http://localhost/WorkSpace/MiKebab/Api/ingredientes.php?action=obtenerIngredientes")
            .then(response => response.json())
            .then(ingredientes => {
                const todosIngredientesContainer = document.getElementById("todosIngredientesList");
                todosIngredientesContainer.innerHTML = ''; // Limpiar cualquier ingrediente anterior

                // Recorrer los ingredientes y agregarlos al modal
                ingredientes.forEach(ingrediente => {
                    const ingredienteItem = document.createElement("li");
                    ingredienteItem.classList.add("list-group-item");

                    ingredienteItem.innerHTML = `
                    <strong>${ingrediente.nombre}</strong> - €${ingrediente.precio} <!-- Cambio de $ a € -->
                    <img src="../Fotos/Ingredientes/${ingrediente.foto}" alt="${ingrediente.nombre}" class="img-thumbnail" style="width: 50px;">
                `;
                    todosIngredientesContainer.appendChild(ingredienteItem);
                });
            })
            .catch(error => console.error("Error al obtener todos los ingredientes:", error));
    }

    // Función para añadir el kebab al carrito
    function añadirAlCarrito(idKebab) {
        // Obtener los detalles del kebab
        fetch(`http://localhost/WorkSpace/MiKebab/Api/kebab.php?action=obtenerKebab&id=${idKebab}`)
            .then(response => response.json())
            .then(kebab => {
                // Crear un objeto con los detalles del kebab
                const kebabItem = {
                    id: kebab.idKebab,
                    nombre: kebab.nombre,
                    precio: kebab.precio,
                    foto: kebab.foto,
                    ingredientes: kebab.ingredientes,
                    cantidad: 1  // Inicializamos la cantidad en 1
                };

                // Obtener el carrito actual desde localStorage
                let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

                // Verificar si el kebab ya está en el carrito
                const index = carrito.findIndex(item => item.id === kebab.idKebab);
                if (index !== -1) {
                    // Si el kebab ya está en el carrito, aumentar la cantidad
                    carrito[index].cantidad++;
                } else {
                    // Si no está en el carrito, agregarlo
                    carrito.push(kebabItem);
                }

                // Guardar el carrito actualizado en localStorage
                localStorage.setItem("carrito", JSON.stringify(carrito));

                // Mostrar el mensaje de éxito
                alert("¡Kebab añadido al carrito!");
            })
            .catch(error => console.error("Error al añadir el kebab al carrito:", error));
    }


    // Función para cerrar el modal
    function cerrarModal() {
        const modal = document.getElementById('modalKebab');
        modal.classList.remove('abierto');
    }

    // Cerrar el modal si el usuario hace clic fuera del área del modal
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('modalKebab');
        if (event.target === modal) {
            cerrarModal();
        }
    });


    // Llamamos a la función para cargar los kebabs cuando la página se carga
    document.addEventListener("DOMContentLoaded", function () {
        obtenerKebabs();
    });
</script>