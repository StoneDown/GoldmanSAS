<?php
session_start();
$tema = $_SESSION['tema'] ?? 'azul';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="styles2.css?v=123">
        <link rel="stylesheet" href="styles3.css">
        <link rel="stylesheet" href="styles4.css">
        <link rel="stylesheet" href="styles5.css">
        <title>GoldManSAS</title>
    </head>
    <body class="tema-<?php echo $tema; ?>">
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
            const dropdowns = document.querySelectorAll(".menu-dropdown");
            dropdowns.forEach(d => {
                if (d.id === id) {
                    d.style.display = d.style.display === "block" ? "none" : "block";
                } else {
                    d.style.display = "none";
                }
            });
        }
    
        // Si usas PHP embebido en HTML, este bloque mostrará el nombre de usuario
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            $nombreUsuario = $_SESSION['usuario'];
            echo "document.getElementById('usuario-nombre').innerText = 'Bienvenido, " . $nombreUsuario . "';";
        }
        ?>
    </script>
    
    <body>
        <header class="main-header">
            <a href="index.php" class="logo2">
                <img src="GoldmanSASIcon.png" alt="Goldman Sachs logo" class="logo-img" width="80" height="80">
                <img src="GoldmanSAStext.png" alt="Goldman Sachs text logo" class="logo-img" width="300" height="150">
            </a>
            
            <!-- Barra de búsqueda añadida aquí -->
            <div class="search-container">
                <input type="text" placeholder="Rechercher..." class="search-bar">
            </div>

            <nav>
                <a href="inicio.php" class="nav-link">se connecter</a>
                <!-- Enlace de Menu, que abrirá el menú desplegable -->
                <a href="javascript:void(0);" class="nav-link" id="menu-link">
                    <img src="menu.png" width="20" height="20" alt="Menu icon">
                    Menu
                </a>
                <!-- Enlace de Idioma, que abrirá el menú de idiomas -->
                <a href="javascript:void(0);" class="nav-link" id="idioma-link">
                    <img src="Francais.png" width="20" height="20" alt="Idioma icon">
                    Langue
                </a>
                <div class="nav-link" aria-label="Carrito" id="carrito-icon" style="cursor:pointer;">
                    <img src="carrito.png" width="20" height="20" alt="Shop icon">
                </div>
                <div class="nav-link" aria-label="Usuario" id="usuario-icon" style="cursor:pointer;">
                    <img src="usuario.png" width="60" height="60" alt="User icon">
                </div>
            </nav>
        </header>

        <!-- Menú desplegable para Idiomas -->
        <div id="idioma-dropdown" class="menu-dropdown">
            <h3>Sélectionnez une langue
                <span class="arrow" onclick="toggleSubMenu('idiomas')">↓</span>
            </h3>
            <div id="idiomas" class="submenu">
                <p><a href="index.php">Espagnol</a></p>
                <p><a href="index_en.php">Anglais</a></p>
                <p><a href="index_fr.php">Français</a></p>
                <p><a href="index_pt.php">portugais</a></p>
            </div>
        </div>

        <!-- Menú desplegable para Menu (Precio y Artículos) -->
        <div id="menu-dropdown" class="menu-dropdown">
            <div class="menu-section">
                <h3>Prix</h3>
                <label for="min-price">Min:</label>
                <input type="number" id="min-price" name="min-price" placeholder="Prix ​​minimum">
                <label for="max-price">Max:</label>
                <input type="number" id="max-price" name="max-price" placeholder="Prix ​​maximum">
            </div>
            <div class="menu-section">
                <h3>Articles
                    <span class="arrow" onclick="toggleSubMenu('articulos')">↓</span>
                </h3>
                <div id="articulos" class="submenu">
                    <p><a href="cocina.php">Cuisine</a></p>
                    <p><a href="exteriores.php">Affaires étrangères</a></p>
                    <p><a href="dormitorio.php">Chambre à coucher</a></p>
                    <p><a href="muebles.php">Meubles</a></p>
                </div>
            </div>
        </div>
        <!-- Menú desplegable para Usuario -->
        <div id="usuario-dropdown" class="menu-dropdown">
            <h3 id="usuario-nombre">Utilisateur</h3>
            <p><a href="ajustes.php">Paramètres</a></p>
            <p><a href="confirmar_correo.php">Confirmez votre email</a></p>
        </div>

        <!-- Menú desplegable para Carrito -->
        <div id="carrito-dropdown" class="menu-dropdown">
            <h3>Panier</h3>
            <p><a href="carrito.php">Voir les produits</a></p>
        </div>

        <div class="carousel">
            <button class="prev" onclick="prevImage()">&#10094;</button>
            <div class="carousel-images">
                <img src="img.png" width="1000" height="500">
                <img src="img2.jpg" width="1000" height="500">
                <img src="img3.png" width="1000" height="500">
                <img src="img4.png" width="1000" height="500">
                <img src="img5.avif" width="1000" height="500">
                <img src="img6.png" width="1000" height="500">
            </div>
            <button class="next" onclick="nextImage()">&#10095;</button>
        </div>

        <script src="script.js"></script>
        <h6>Page réalisée par Samuel Felipe Uribe</h6>
    </body>
</html>

