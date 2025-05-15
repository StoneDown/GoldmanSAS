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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldManSAS - Tienda</title>
    <link rel="stylesheet" href="styles8.css">
    <link rel="stylesheet" href="styles5.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    header{
        height: 100px;
    }
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
            <a href="javascript:void(0);" class="nav-link" id="menu-link">
                <img src="menu.png" width="20" height="20" alt="Menu icon"> Menu
            </a>
            <a href="javascript:void(0);" class="nav-link" id="idioma-link">
                <img src="colombia.png" width="20" height="20" alt="Idioma icon"> Idioma
            </a>
            <div class="nav-link" id="carrito-icon" style="cursor:pointer;">
                <img src="carrito.png" width="20" height="20" alt="Shop icon">
            </div>
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
            <input type="number" id="min-price" name="min-price" placeholder="Precio mínimo">
            <label for="max-price">Máximo:</label>
            <input type="number" id="max-price" name="max-price" placeholder="Precio máximo">
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
        <!-- Producto 1 -->
        <div class="producto">
            <img src="SillaMaderaP.jpeg" alt="Silla de madera elegante" class="producto-img">
            <div class="producto-info">
                <h3>Silla de Madera Premium</h3>
                <p>$180,000</p>
                <button class="agregar" onclick="agregarAlCarritoAnimado(this, 1, 'Silla de Madera Premium', 180000)">Agregar al carrito</button>
            </div>
        </div>

        <!-- Producto 2 -->
        <div class="producto">
            <img src="MesaCentroM.jpeg" alt="Mesa de centro moderna" class="producto-img">
            <div class="producto-info">
                <h3>Mesa de Centro Moderna</h3>
                <p>$350,000</p>
                <button class="agregar" onclick="agregarAlCarritoAnimado(this, 2, 'Mesa de Centro Moderna', 350000)">Agregar al carrito</button>
            </div>
        </div>

        <!-- Producto 3 -->
        <div class="producto">
            <img src="LamparaContem.jpg" alt="Lámpara de diseño contemporáneo" class="producto-img">
            <div class="producto-info">
                <h3>Lámpara Contemporánea</h3>
                <p>$120,000</p>
                <button class="agregar" onclick="agregarAlCarritoAnimado(this, 3, 'Lámpara Contemporánea', 120000)">Agregar al carrito</button>
            </div>
        </div>

        <!-- Producto 4 -->
        <div class="producto">
            <img src="EstanteriaMin.jpeg" alt="Estantería blanca minimalista" class="producto-img">
            <div class="producto-info">
                <h3>Estantería Minimalista</h3>
                <p>$400,000</p>
                <button class="agregar" onclick="agregarAlCarritoAnimado(this, 4, 'Estantería Minimalista', 400000)">Agregar al carrito</button>
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