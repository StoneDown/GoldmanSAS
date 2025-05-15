<?php
session_start();
$tema = $_SESSION['tema'] ?? 'azul';

if (isset($_GET['mensaje'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['mensaje']) . "');</script>";
}

include 'conexion.php';

$foto_perfil = "usuario.png";

if (isset($_SESSION['codigo'])) {
    $codigo = $_SESSION['codigo'];
    $query = "SELECT foto_perfil FROM usuario WHERE codigo = '$codigo'";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldManSAS</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles2.css">
    <link rel="stylesheet" href="styles3.css">
    <link rel="stylesheet" href="styles4.css">
    <link rel="stylesheet" href="styles5.css">
    <link rel="stylesheet" href="styles9.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        .perfil-circular {
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }
        header {
            height: 50px;
        }
        section {
            padding: 0px;
        }
    </style>
</head>
<script>
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function () {
    navigator.serviceWorker.register('offline.js')
      .then(function (registration) {
        console.log('ServiceWorker registrado con scope: ', registration.scope);
      }, function (err) {
        console.log('Error al registrar el ServiceWorker:', err);
      });
  });
}

</script>
<script>
  window.addEventListener('load', () => {
    if (!navigator.onLine) {
      // Redirige directamente si está offline
      window.location.href = 'pacman.html';
    }

    // Escucha cuando pierdes conexión en tiempo real
    window.addEventListener('offline', () => {
      window.location.href = 'pacman.html';
    });
  });
</script>


<body class="tema-<?php echo $tema; ?>">
<!-- Barra de pestañas -->
<div style="display: flex; align-items: center; background-color: #f0f0f0; padding: 5px 15px; border-bottom: 2px solid #ccc;">
    <!-- Botón GoldmanSAS activo -->
    <a href="#" style="margin-right: 10px; padding: 5px 10px; background-color: #ddd; border-radius: 8px; display: flex; align-items: center;">
        <img src="GoldmanSAStexticon.png" alt="Goldman SAS" style="height: 40px; transform: scale(1.2);">
    </a>
    <!-- Botón DanseCorporation inactivo -->
    <a href="https://stonedown.github.io/DanseCorporation/" style="margin-right: 10px; padding: 5px 10px; display: flex; align-items: center;">
        <img src="DanseCorporationtext.png" alt="Danse Corporation" style="height: 40px; transform: scale(1.2);">
    </a>
</div>


<header class="main-header">
    <a href="#" class="logo2">
        <img src="GoldmanSASIcon.png" alt="Goldman Sachs logo" class="logo-img" width="80" height="80">
        <img src="GoldmanSAStext.png" alt="Goldman Sachs text logo" class="logo-img" width="300" height="150">
    </a>

    <a href="buscar.php" class="search-link">
        <input type="text" placeholder="Buscar..." class="search-bar" id="search-input">
    </a>

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
        <div class="nav-link" id="usuario-icon" style="cursor:pointer;">
            <img src="fotos/<?php echo htmlspecialchars($foto_perfil); ?>" class="perfil-circular" width="60" height="60" alt="User icon">
        </div>
    </nav>
</header>

<!-- MENÚS DESPLEGABLES -->
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
        <h3>Navegación</h3>
        <p><a href="#seccion-inicio">Inicio</a></p>
        <p><a href="#seccion-sobre-nosotros">Sobre Nosotros</a></p>
        <p><a href="#seccion-contacto">Contáctanos</a></p>
    </div>
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

<!-- CARRUSEL -->
<section id="seccion-inicio" class="carousel">
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
</section>
<style>
.tema-azul #seccion-sobre-nosotros {
    background-color: aquamarine;
}
.tema-azul #seccion-contacto {
    background-color: aquamarine;
}
.tema-azul #seccion-sobre-nosotros h2, #seccion-sobre-nosotros h3{
    color: rgb(129, 126, 126);
}
.tema-azul #seccion-contacto h2{
    color: rgb(129, 126, 126);
}


.tema-oscuro #seccion-sobre-nosotros {
background-color: rgb(56, 55, 55);
}
.tema-oscuro #seccion-contacto {
    background-color: rgb(56, 55, 55);
}
.tema-oscuro #seccion-sobre-nosotros h2, #seccion-sobre-nosotros h3{
    color: rgb(131, 129, 129);
}
.tema-oscuro #seccion-contacto h2{
    color: rgb(131, 129, 129);
}

.tema-claro #seccion-sobre-nosotros {
background-color: rgb(163, 160, 160);
}
.tema-claro #seccion-contacto {
    background-color: rgb(163, 160, 160);
}
.tema-claro #seccion-sobre-nosotros h2 {
    color: rgb(238, 237, 237);
}
.tema-claro #seccion-contacto h2{
    color: rgb(238, 237, 237);
}
</style>

<!-- SOBRE NOSOTROS -->
<section id="seccion-sobre-nosotros">
    <h2>Sobre Nosotros</h2>
    <p><strong>GoldmanSAS</strong> es una empresa de mobiliario que envía productos a distintas partes del mundo. Nuestros productos incluyen muebles de sala, dormitorio, cocina y exteriores. Ofrecemos al cliente varias opciones de pago y una experiencia personalizada en nuestra página.</p>
    
    <h3>Misión</h3>
    <p>Garantizar el envío seguro y una experiencia satisfactoria al cliente, brindando accesibilidad a nuestros productos y múltiples métodos de pago para su comodidad.</p>
    
    <h3>Visión</h3>
    <p>Brindar un excelente servicio al cliente mostrando nuestra amplia variedad de productos mobiliarios, ayudándole a transformar sus espacios con estilo, confianza y calidad.</p>
</section>

<!-- CONTACTO -->
<section id="seccion-contacto">
    <h2>Contáctanos</h2>
    <p>Puedes escribirnos al correo <strong>dansecorporation@gmail.com</strong> o llamarnos al <strong>+57 317 186 2054</strong>. También puedes seguirnos en redes sociales.</p>
</section>

<h6>Página hecha por Samuel Felipe Uribe</h6>

<script src="script.js?v=1234"></script>
<script src="script3.js?v=1234"></script>
<script>
    function toggleDropdown(id) {
        const dropdowns = document.querySelectorAll(".menu-dropdown");
        dropdowns.forEach(d => {
            d.style.display = (d.id === id && d.style.display !== "block") ? "block" : "none";
        });
    }

    function toggleSubMenu(id) {
        const sub = document.getElementById(id);
        if (sub) {
            sub.style.display = sub.style.display === "block" ? "none" : "block";
        }
    }

    // Mostrar nombre del usuario si está conectado
    <?php if (isset($_SESSION['usuario'])): ?>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('usuario-nombre').innerText = 'Bienvenido, <?php echo $_SESSION['usuario']; ?>';
        });
    <?php endif; ?>
</script>
</body>
</html>