<?php
session_start();
$tema = $_SESSION['tema'] ?? 'azul';
?>
<?php
include 'conexion.php';

$foto_perfil = "usuario.png"; // valor por defecto

if (isset($_SESSION['codigo'])) {
    $codigo = $_SESSION['codigo'];
    $query = "SELECT foto_perfil FROM usuario WHERE codigo = $codigo";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $foto = $row['foto_perfil'];
        if (!empty($foto) && file_exists("fotos/" . $foto)) {
            $foto_perfil = $foto;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GoldManSAS - Exteriores</title>
    <link rel="stylesheet" href="styles8.css"/>
    <link rel="stylesheet" href="styles5.css"/>
    <link rel="stylesheet" href="styles.css">
    <style>
        header { height: 100px; }
    </style>
</head>
    <style>
    .perfil-circular {
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc; /* opcional para borde */
    }
    header{
        height: 90px;
    }
    </style>
<body class="tema-<?php echo $tema; ?>">
<body>
<header class="main-header">
    <a href="index.php" class="logo2">
        <img src="GoldmanSASIcon.png" alt="Goldman Sachs logo" class="logo-img" width="80" height="80">
        <img src="GoldmanSAStext.png" alt="Goldman Sachs text logo" class="logo-img" width="300" height="150">
    </a>

            <!-- Barra de búsqueda añadida aquí -->
            <div class="search-container">
            <input type="text" placeholder="Buscar..." class="search-bar" id="search-input">
            </div>

    <nav>
        <a href="inicio.php" class="nav-link">Inicio</a>
        <a href="javascript:void(0);" class="nav-link" id="menu-link"><img src="menu.png" width="20" height="20"> Menu</a>
        <a href="javascript:void(0);" class="nav-link" id="idioma-link"><img src="colombia.png" width="20" height="20"> Idioma</a>
        <div class="nav-link" id="carrito-icon" style="cursor:pointer;"><img src="carrito.png" width="20" height="20"></div>
        <div class="nav-link" aria-label="Usuario" id="usuario-icon" style="cursor:pointer;">
            <img src="fotos/<?php echo htmlspecialchars($foto_perfil); ?>" class="perfil-circular" width="60" height="60" alt="User icon">
        </div>
    </nav>
</header>

<div id="idioma-dropdown" class="menu-dropdown">
    <h3>Seleccione un Idioma <span class="arrow" onclick="toggleSubMenu('idiomas')">↓</span></h3>
    <div id="idiomas" class="submenu">
        <p><a href="index.php">Español</a></p>
        <p><a href="index_en.php">Inglés</a></p>
        <p><a href="index_fr.php">Francés</a></p>
        <p><a href="index_pt.php">Portugués</a></p>
    </div>
</div>

<div id="menu-dropdown" class="menu-dropdown">
    <div class="menu-section">
        <h3>Precio</h3>
        <label for="min-price">Mínimo:</label>
        <input type="number" id="min-price" placeholder="Precio mínimo">
        <label for="max-price">Máximo:</label>
        <input type="number" id="max-price" placeholder="Precio máximo">
    </div>
    <div class="menu-section">
        <h3>Artículos <span class="arrow" onclick="toggleSubMenu('articulos')">↓</span></h3>
        <div id="articulos" class="submenu">
            <p><a href="cocina.php">Cocina</a></p>
            <p><a href="exteriores.php">Exteriores</a></p>
            <p><a href="dormitorio.php">Dormitorio</a></p>
            <p><a href="muebles.php">Muebles</a></p>
        </div>
    </div>
</div>

<div id="usuario-dropdown" class="menu-dropdown">
    <h3 id="usuario-nombre">Usuario</h3>
    <p><a href="ajustes.php">Ajustes</a></p>
    <p><a href="confirmar_correo.php">Confirmar correo electrónico</a></p>
</div>

<div id="carrito-dropdown" class="menu-dropdown">
    <h3>Carrito</h3>
    <p><a href="carrito.php">Ver carrito</a></p>
</div>

<div class="productos">
    <div class="producto">
        <img src="SillaExt.jpeg" alt="Silla exterior con cojines" class="producto-img">
        <div class="producto-info">
            <h3>Silla Exterior con Cojín</h3>
            <p>$300,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 9, 'Silla Exterior con Cojín', 300000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto">
        <img src="MesaJardRd.jpeg" alt="Mesa de jardín redonda" class="producto-img">
        <div class="producto-info">
            <h3>Mesa de Jardín Redonda</h3>
            <p>$400,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 10, 'Mesa de Jardín Redonda', 400000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto">
        <img src="SofaTer.jpeg" alt="Sofá exterior para terraza" class="producto-img">
        <div class="producto-info">
            <h3>Sofá para Terraza</h3>
            <p>$2,000,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 11, 'Sofá para Terraza', 2000000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto">
        <img src="HamacaJard.jpeg" alt="Hamaca de jardín" class="producto-img">
        <div class="producto-info">
            <h3>Hamaca de Jardín</h3>
            <p>$520,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 12, 'Hamaca de Jardín', 520000)">Agregar al carrito</button>
        </div>
    </div>
</div>

<h6>Página diseñada por Samuel Felipe Uribe © 2023 GoldManSAS. Todos los derechos reservados.</h6>

<script>
    
        // Mostrar/Ocultar menús desplegables
        document.getElementById("menu-link").addEventListener("click", () => {
            toggleDropdown("menu-dropdown");
        });
    
        document.getElementById("idioma-link").addEventListener("click", () => {
            toggleDropdown("idioma-dropdown");
        });
    
        document.getElementById("usuario-icon").addEventListener("click", () => {
    toggleDropdown("usuario-dropdown");
});

document.getElementById("carrito-icon").addEventListener("click", () => {
    toggleDropdown("carrito-dropdown");
});


    function toggleDropdown(id) {
        document.querySelectorAll(".menu-dropdown").forEach(d => {
            d.style.display = d.id === id && d.style.display !== "block" ? "block" : "none";
        });
    }

    function toggleSubMenu(id) {
        const submenu = document.getElementById(id);
        const arrow = submenu.previousElementSibling.querySelector('.arrow');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        arrow.textContent = submenu.style.display === 'block' ? '↑' : '↓';
    }

    function agregarAlCarritoAnimado(button, id, nombre, precio) {
        // Animación del botón (verde -> agregado -> azul -> agregar al carrito)
        button.textContent = 'Agregado al carrito';
        button.style.backgroundColor = '#4CAF50';  // Color verde
        button.style.color = 'white';  // Texto blanco

        // Volver a azul después de un tiempo
        setTimeout(() => {
            button.textContent = 'Agregar al carrito';
            button.style.backgroundColor = '#2196F3';  // Color azul
            button.style.color = 'white';  // Texto blanco
        }, 2000);

        // Guardar en localStorage
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        const index = carrito.findIndex(p => p.id === id);
        if (index !== -1) {
            carrito[index].cantidad++;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }
        localStorage.setItem('carrito', JSON.stringify(carrito));
    }
</script>
<script src="script3.js?v=1234"></script>

</body>
</html>