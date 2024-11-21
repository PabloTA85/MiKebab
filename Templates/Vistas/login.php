<div class="container">
    <h2 class="text-center">Iniciar Sesión</h2>
    <form id="loginForm">
        <div class="mb-3">
            <label for="loginUsuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="loginUsuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="loginPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="loginPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="window.location.href='router.php?ruta=inicio'">Cancelar</button>
    </form>
</div>

<!-- Incluir el archivo JS -->
<script src="../js/login.js"></script>
</body>
