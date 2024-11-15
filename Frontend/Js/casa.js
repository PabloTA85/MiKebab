// Funcionalidad de arrastrar y soltar
document.querySelectorAll('.ingredient-item').forEach(item => {
    item.addEventListener('dragstart', (e) => {
        e.dataTransfer.setData('text', e.target.innerText);
    });
});

document.querySelectorAll('.ingredient-list').forEach(list => {
    list.addEventListener('dragover', (e) => {
        e.preventDefault();
    });

    list.addEventListener('drop', (e) => {
        const draggedIngredient = e.dataTransfer.getData('text');
        if (list.id === 'currentIngredients') {
            // Si es la lista de ingredientes actuales, añades el ingrediente
            let newIngredient = document.createElement('li');
            newIngredient.classList.add('ingredient-item');
            newIngredient.textContent = draggedIngredient;
            list.appendChild(newIngredient);
        } else if (list.id === 'availableIngredients') {
            // Si es la lista de ingredientes disponibles, lo puedes quitar de la lista
            let draggedItem = Array.from(list.children).find(item => item.textContent === draggedIngredient);
            list.removeChild(draggedItem);
        }
    });
});
