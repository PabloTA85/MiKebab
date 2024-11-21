function crearUsuario(event) {
    // Evitar el comportamiento por defecto (recargar la página)
    event.preventDefault();

    // Obtén los valores de los campos del formulario
    const nombre = document.getElementById('nombre').value;
    const apellidos = document.getElementById('apellidos').value;
    const telefono = document.getElementById('telefono').value;
    const usuario = document.getElementById('usuario').value;
    const pass = document.getElementById('password').value;
    const email = document.getElementById('email').value;
    const direccion = document.getElementById('direccion').value;

    // Verifica si todos los campos están completos
    if (!nombre || !apellidos || !telefono || !usuario || !pass || !email || !direccion) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Crea el objeto de usuario para enviar a la API
    const usuarioData = {
        nombre: nombre,
        apellidos: apellidos,
        telefono: telefono,
        usuario: usuario,
        pass: pass,
        correo: email,
        direccion: direccion,
        tipo: "regular"  // Puedes ajustar esto según tus necesidades
    };

    // Enviar los datos al backend usando fetch
    fetch('http://localhost/WorkSpace/MiKebab/Api/usuarios.php?action=crearUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuarioData)
    })
    .then(response => response.json())
    .then(data => {
        // Verificar si la respuesta contiene un mensaje de éxito o error
        if (data.message) {
            // Mostrar el mensaje de éxito
            alert('Usuario registrado con éxito');

            // Redirigir a la página de inicio después de 1 segundos (para mostrar el mensaje de éxito)
            setTimeout(() => {
                window.location.href = 'index.php?ruta=inicio';
            }, 1000);
        } else {
            // Si hay un error, mostrarlo
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error al registrar el usuario:', error);
        alert('Hubo un problema con la solicitud.');
    });
}
