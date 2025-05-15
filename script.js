let currentIndex = 0;

function showImage(index) {
    const images = document.querySelector('.carousel-images');
    const totalImages = images.children.length;

    // Asegura que las imágenes no se desborden o se repitan
    if (index >= totalImages) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = totalImages - 1;
    } else {
        currentIndex = index;
    }

    // Desplazamos las imágenes
    images.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextImage() {
    showImage(currentIndex + 1);
}

function prevImage() {
    showImage(currentIndex - 1);
}

// Mostrar la primera imagen al cargar la página
document.addEventListener("DOMContentLoaded", () => {
    showImage(0);
});



// === MENU DESPLEGABLE ===
document.getElementById('menu-link').addEventListener('click', function(event) {
    event.preventDefault();
    const menuDropdown = document.getElementById('menu-dropdown');
    const rect = event.target.getBoundingClientRect();
    menuDropdown.style.top = rect.bottom + window.scrollY + 'px';
    menuDropdown.style.left = rect.left + 'px';
    menuDropdown.style.display = menuDropdown.style.display === 'block' ? 'none' : 'block';
});


// === FUNCIONES PARA SUBMENÚS ===
function toggleSubMenu(menuId) {
    const submenu = document.getElementById(menuId);
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
}


// === IDIOMA DESPLEGABLE ===
document.getElementById('idioma-link').addEventListener('click', function(event) {
    event.preventDefault();
    const idiomaDropdown = document.getElementById('idioma-dropdown');
    const rect = event.target.getBoundingClientRect();
    idiomaDropdown.style.top = rect.bottom + window.scrollY + 'px';
    idiomaDropdown.style.left = rect.left + 'px';
    idiomaDropdown.style.display = idiomaDropdown.style.display === 'block' ? 'none' : 'block';
});


function changeLanguage(language) {
    alert('Idioma cambiado a: ' + language);
}


// === SUBMENÚS DE FLECHAS ===
document.querySelectorAll('.submenu .arrow').forEach((arrow) => {
    arrow.addEventListener('click', function() {
        const submenuId = this.getAttribute('data-submenu-id');
        toggleSubMenu(submenuId);
    });
});


// === USUARIO Y CARRITO DESPLEGABLE ===
document.getElementById("usuario-icon").addEventListener("click", () => {
    toggleDropdown("usuario-dropdown");
});


document.getElementById("carrito-icon").addEventListener("click", () => {
    toggleDropdown("carrito-dropdown");
});


// === FUNCION GENERAL PARA TOGGLE DE MENÚS ===
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
