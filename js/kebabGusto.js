document.addEventListener('DOMContentLoaded', function () {
    const availableIngredientsContainer = document.getElementById('available-ingredients');
    const selectedIngredientsContainer = document.getElementById('selected-ingredients');
    const priceElement = document.getElementById('price');
    let basePrice = 5.00;
    let totalPrice = basePrice;

    // Función para actualizar el precio
    function updatePrice() {
        priceElement.textContent = totalPrice.toFixed(2) + ' €';
    }

    // Función para crear el botón del ingrediente seleccionado
    function createSelectedButton(ingredient) {
        const button = document.createElement('button');
        button.classList.add('selected-ingredient-btn', 'me-1','mb-1');
        button.textContent = `${ingredient.name} (×)`;

        // Eliminar ingrediente al hacer clic
        button.addEventListener('click', function () {
            // Resta el precio
            totalPrice -= parseFloat(ingredient.price);
            updatePrice();

            // Desmarca el botón en la lista de disponibles
            const ingredientButton = document.querySelector(`[data-id="${ingredient.id}"]`);
            ingredientButton.classList.remove('active');

            // Elimina el botón del contenedor de seleccionados
            button.remove();
        });

        selectedIngredientsContainer.appendChild(button);

        // Suma el precio
        totalPrice += parseFloat(ingredient.price);
        updatePrice();
    }

    // Función para manejar el clic en un ingrediente
    function handleIngredientClick(event) {
        const ingredientButton = event.target;
        const ingredientId = ingredientButton.getAttribute('data-id');

        // Si el ingrediente ya está seleccionado, no hacer nada
        if (ingredientButton.classList.contains('active')) {
            return;
        }

        // Marca el botón como activo
        ingredientButton.classList.add('active');

        // Crear el botón de ingrediente seleccionado
        const ingredient = {
            id: ingredientId,
            name: ingredientButton.textContent,
            price: ingredientButton.getAttribute('data-price')
        };
        createSelectedButton(ingredient);
    }

    // Fetch ingredientes desde la API
    fetch('http://localhost/WorkSpace/MiKebab/Api/ingredientes.php?action=obtenerIngredientes')
        .then(response => response.json())
        .then(ingredients => {
            ingredients.forEach(ingredient => {
                const ingredientButton = document.createElement('div');
                ingredientButton.classList.add('ingredient');
                ingredientButton.textContent = ingredient.nombre;
                ingredientButton.setAttribute('data-id', ingredient.idIngrediente);
                ingredientButton.setAttribute('data-price', ingredient.precio);
                ingredientButton.addEventListener('click', handleIngredientClick);

                availableIngredientsContainer.appendChild(ingredientButton);
            });
        });
});
