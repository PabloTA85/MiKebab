document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Evitamos el comportamiento por defecto del formulario

    const usuario = document.getElementById('loginUsuario').value.trim();
    const password = document.getElementById('loginPassword').value.trim();

    if (!usuario || !password) {
        alert('Por favor, ingresa el usuario y la contraseña');
        return;
    }

    // Log para verificar los datos enviados
    console.log('Datos enviados al servidor:', { usuario, pass: password });

    try {
        const response = await fetch('http://localhost/WorkSpace/MiKebab/Api/usuarios.php?action=loginUsuario', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ usuario, pass: password })
        });

        const data = await response.json();
        console.log('Respuesta de la API:', data);

        if (!data.error) {
            alert('Usuario autenticado con éxito');
            sessionStorage.setItem('usuario', usuario);
            window.location.href = 'index.php?ruta=inicio';
        } else {
            alert('Error: ' + data.error);
        }
    } catch (error) {
        console.error('Error durante la petición:', error);
        alert('Hubo un error al intentar iniciar sesión. Intenta nuevamente.');
    }
});
