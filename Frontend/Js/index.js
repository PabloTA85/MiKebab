// Función para mostrar el formulario de registro
function showRegisterForm() {
    document.getElementById("registerForm").style.display = 'block';
    document.getElementById("loginForm").style.display = 'none';
    document.getElementById("mainContent").style.display = 'none';
}

// Función para mostrar el formulario de login
function showLoginForm() {
    document.getElementById("registerForm").style.display = 'none';
    document.getElementById("loginForm").style.display = 'block';
    document.getElementById("mainContent").style.display = 'none';
}

// Función para volver al contenido principal
function showMainContent() {
    document.getElementById("registerForm").style.display = 'none';
    document.getElementById("loginForm").style.display = 'none';
    document.getElementById("mainContent").style.display = 'block';
}
