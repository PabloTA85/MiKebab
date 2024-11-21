<nav class="navbar navbar-expand-lg navbar-light bg-intermediategray">
    <div class="container">
        <button class="navbar-toggler" type="button" id="menuButton">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ruta=inicio">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown">Menú</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?ruta=kebabsCasa">Kebabs de la Casa</a>
                        <a class="dropdown-item" href="index.php?ruta=kebabGusto">Kebabs al Gusto</a>
                    </div>
                </li>
            </ul>

        </div>
        <ul class="navbar-nav ml-auto">
            <div id="userLinks" style="display: none;">
                <li class="nav-item me-3">
                    <span class="nav-link noPointer" id="userName"></span>
                </li>
                <li class="nav-item">
                    <button class="btn btn-danger" id="logoutBtn">Cerrar sesión</button>
                </li>
            </div>
            <div id="authLinks">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ruta=login">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?ruta=registro">Registrarse</a>
                </li>
            </div>
        </ul>
    </div>
</nav>


<!-- JavaScript para el funcionamiento del menú -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuButton = document.getElementById('menuButton'); // Botón de la hamburguesa
        const navbarCollapse = document.querySelector('.navbar-collapse'); // Contenedor del menú
        const dropdownToggle = document.getElementById('menuDropdown'); // Elemento de la opción "Menú"
        const dropdownMenu = document.querySelector('.dropdown-menu'); // Menú desplegable
        const usuario = sessionStorage.getItem('usuario');
        const logoutBtn = document.getElementById('logoutBtn'); // Botón de logout

        // Evento para mostrar u ocultar el menú en dispositivos móviles
        menuButton.addEventListener('click', function () {
            navbarCollapse.classList.toggle('show'); // Alternar la visibilidad del menú
        });

        // Evento para manejar el menú desplegable
        dropdownToggle.addEventListener('click', function (event) {
            event.preventDefault(); // Evita que el enlace se siga
            dropdownMenu.classList.toggle('show'); // Alternar el menú desplegable
        });

        // Cerrar el menú desplegable si se hace clic fuera de él
        document.addEventListener('click', function (event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show'); // Ocultar el menú si se hace clic fuera
            }
        });

        // Verificar si el usuario está logueado
        if (usuario) {
            // Mostrar el nombre del usuario
            document.getElementById('userName').textContent = `Hola, ${usuario}`;
            document.getElementById('authLinks').style.display = 'none'; // Ocultar enlaces de login y registro
            document.getElementById('userLinks').style.display = 'flex'; // Mostrar nombre de usuario
        } else {
            // Mostrar los enlaces de login y registro si no hay usuario
            document.getElementById('authLinks').style.display = 'flex'; // Mostrar enlaces de login y registro
            document.getElementById('userLinks').style.display = 'none'; // Ocultar nombre de usuario
        }

        // Evento para el botón de logout
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function () {
                // Eliminar el usuario del localStorage
                sessionStorage.removeItem('usuario');
                // Refrescar la página
                location.reload();
            });
        }
    });

</script>