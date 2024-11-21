<!-- Puedes colocar tu CSS aquí -->
<style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 2.5rem;
        text-align: center;
        margin-top: 20px;
        color: #34495e;
    }

    /* Contenedor de los botones */
    .menu-button-container {
        margin: 20px;
    }

    /* Estilo de los botones grandes */
    .menu-button-container .btn {
        font-size: 1.5rem;
        padding: 20px;
        text-align: center;
        background-color: #34495e;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        display: block;
    }

    .menu-button-container .btn:hover {
        background-color: #e67e22;
        /* Naranja suave al pasar el ratón */
    }

    /* Estilo de los botones en fila */
    .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


<h1 class="mb-4">Menú</h1>

<div class="d-flex">
    <!-- Botón Kebabs de la Casa -->
    <div class="menu-button-container mx-3">
        <a href="index.php?ruta=kebabsCasa" class="btn btn-lg btn-primary w-100">Kebabs de la Casa</a>

    </div>

    <!-- Botón Kebabs al Gusto -->
    <div class="menu-button-container mx-3">
        <a href="index.php?ruta=kebabGusto" class="btn btn-lg btn-primary w-100">Kebabs al Gusto</a>
    </div>
</div>