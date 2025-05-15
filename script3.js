    // Esperar a que se cargue la página
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const productos = document.querySelectorAll('.producto');  // Asegúrate de que las clases de los productos sean correctas

        // Función para filtrar productos según lo que se ingresa en la barra de búsqueda
        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();  // Obtener el valor de búsqueda y convertirlo a minúsculas
            productos.forEach(producto => {
                const nombreProducto = producto.querySelector('h3').textContent.toLowerCase(); // Obtener el nombre del producto (suponiendo que está en un <h3>)

                // Verificar si el término de búsqueda está presente en el nombre del producto
                if (nombreProducto.includes(searchTerm)) {
                    producto.style.display = 'block'; // Mostrar producto si coincide
                } else {
                    producto.style.display = 'none'; // Ocultar producto si no coincide
                }
            });
        });
    });