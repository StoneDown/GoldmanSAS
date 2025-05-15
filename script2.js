document.querySelectorAll('.agregar').forEach(button => {
    button.addEventListener('click', function() {
        // Obtener el nombre y precio del producto
        const producto = this.getAttribute('data-producto');
        const precio = this.getAttribute('data-precio');

        // Redirigir a otro PHP para manejar el carrito
        window.location.href = `agregar_carrito.php?producto=${encodeURIComponent(producto)}&precio=${precio}`;
    });
});
