<?php
include 'header.php';   // Incluye solo el header con logo
include 'navbar.php';   // Incluye el navbar con el fondo azul y texto negro
?>

<main class="container my-5">
    <?php include $vista; ?>  <!-- Incluye la vista correspondiente -->
</main>

<?php include 'footer.php'; ?>
