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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles8.css">
        <link rel="stylesheet" href="styles5.css">
        <link rel="stylesheet" href="styles.css">
        <title>GoldManSAS</title>
    </head>

    <body class="tema-<?php echo $tema; ?>">
    
    <style>
        /* Estilo de la barra de búsqueda */
    .search-container {
    width: 100%;         /* Asegura que el contenedor ocupe el 100% del espacio disponible */
    max-width: 1000px;    /* Ajusta el ancho máximo si lo deseas */
    margin: 0 auto;      /* Centra la barra en su contenedor */
    }

    .search-bar {
    width: 100%;         /* Asegura que el campo de texto ocupe todo el espacio disponible */
    padding: 10px;       /* Espaciado interno para que se vea bien */
    font-size: 16px;     /* Tamaño de la fuente */
    border: 1px solid #ccc;  /* Borde para hacerla visible */
    border-radius: 5px;  /* Bordes redondeados */
    }
    </style>
    <style>
    .perfil-circular {
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc; /* opcional para borde */
    }
    </style>
    <style>
        header{
            height: 90px;
        }
    </style>

    <header class="main-header">
            <a href="index.php" class="logo2">
                <img src="GoldmanSASIcon.png" alt="Goldman Sachs logo" class="logo-img" width="80" height="80">
                <img src="GoldmanSAStext.png" alt="Goldman Sachs text logo" class="logo-img" width="300" height="150">
            </a>
            
            <!-- Barra de búsqueda añadida aquí -->
            <div class="search-container" class="search-link">
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
    <div class="producto" id="productos-container">
        <img src="CamaDobleC.jpeg" alt="Cama doble clásica" class="producto-img">
        <div class="producto-info">
            <h3>Cama Doble Clásica</h3>
            <p>$1,200,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 5, 'Cama Doble Clásica', 1200000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="VeladorMin.jpeg" alt="Velador minimalista" class="producto-img">
        <div class="producto-info">
            <h3>Velador Minimalista</h3>
            <p>$250,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 6, 'Velador Minimalista', 250000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="Armario3P.jpg" alt="Armario de 3 puertas" class="producto-img">
        <div class="producto-info">
            <h3>Armario de 3 Puertas</h3>
            <p>$1,300,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 7, 'Armario de 3 Puertas', 1300000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="ComodaC.jpeg" alt="Cómoda con cajones" class="producto-img">
        <div class="producto-info">
            <h3>Cómoda con Cajones</h3>
            <p>$650,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 8, 'Cómoda con Cajones', 650000)">Agregar al carrito</button>
        </div>
    </div>
</div>

<div class="productos" id="productos-container">
    <div class="producto">
        <img src="SillaExt.jpeg" alt="Silla exterior con cojines" class="producto-img">
        <div class="producto-info">
            <h3>Silla Exterior con Cojín</h3>
            <p>$300,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 9, 'Silla Exterior con Cojín', 300000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="MesaJardRd.jpeg" alt="Mesa de jardín redonda" class="producto-img">
        <div class="producto-info">
            <h3>Mesa de Jardín Redonda</h3>
            <p>$400,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 10, 'Mesa de Jardín Redonda', 400000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="SofaTer.jpeg" alt="Sofá exterior para terraza" class="producto-img">
        <div class="producto-info">
            <h3>Sofá para Terraza</h3>
            <p>$2,000,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 11, 'Sofá para Terraza', 2000000)">Agregar al carrito</button>
        </div>
    </div>

    <div class="producto" id="productos-container">
        <img src="HamacaJard.jpeg" alt="Hamaca de jardín" class="producto-img">
        <div class="producto-info">
            <h3>Hamaca de Jardín</h3>
            <p>$520,000</p>
            <button class="agregar" onclick="agregarAlCarritoAnimado(this, 12, 'Hamaca de Jardín', 520000)">Agregar al carrito</button>
        </div>
    </div>
</div>

  <div class="productos" id="productos-container">
    <!-- Producto 1 -->
    <div class="producto">
      <img src="SofaMod.jpg" alt="Sofá modular para sala" class="producto-img" />
      <div class="producto-info">
        <h3>Sofá Modular de Sala</h3>
        <p>$2,500,000</p>
        <button class="agregar" data-producto="Sofá Modular de Sala" data-precio="2500000" onclick="agregarAlCarrito(13, 'Sofá Modular de Sala', 2500000)">Agregar al carrito</button>
      </div>
    </div>

    <!-- Producto 2 -->
    <div class="producto" id="productos-container">
      <img src="MesaCom6P.jpg" alt="Mesa de comedor 6 puestos" class="producto-img" />
      <div class="producto-info">
        <h3>Mesa de Comedor 6 Puestos</h3>
        <p>$1,800,000</p>
        <button class="agregar" data-producto="Mesa de Comedor 6 Puestos" data-precio="1800000" onclick="agregarAlCarrito(14, 'Mesa de Comedor 6 Puestos', 1800000)">Agregar al carrito</button>
      </div>
    </div>

    <!-- Producto 3 -->
    <div class="producto" id="productos-container">
      <img src="EstanteriaMad.webp" alt="Estantería para libros" class="producto-img" />
      <div class="producto-info">
        <h3>Estantería de Madera</h3>
        <p>$500,000</p>
        <button class="agregar" data-producto="Estantería de Madera" data-precio="500000" onclick="agregarAlCarrito(15, 'Estantería de Madera', 500000)">Agregar al carrito</button>
      </div>
    </div>

    <!-- Producto 4 -->
    <div class="producto" id="productos-container">
      <img src="MesaCenClas.jpeg" alt="Mesa de centro clásica" class="producto-img" />
      <div class="producto-info">
        <h3>Mesa de Centro Clásica</h3>
        <p>$350,000</p>
        <button class="agregar" data-producto="Mesa de Centro" data-precio="350000" onclick="agregarAlCarrito(16, 'Mesa de Centro', 350000)">Agregar al carrito</button>
      </div>
    </div>
  </div>

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

    document.addEventListener('click', (e) => {
    const isMenuClick = e.target.closest('.menu-dropdown') || e.target.closest('.nav-link');
    if (!isMenuClick) {
        document.querySelectorAll('.menu-dropdown').forEach(d => d.style.display = 'none');
    }
    });


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
<script>
document.getElementById('min-price').addEventListener('input', filtrarProductos);
document.getElementById('max-price').addEventListener('input', filtrarProductos);

function filtrarProductos() {
    const min = parseInt(document.getElementById('min-price').value) || 0;
    const max = parseInt(document.getElementById('max-price').value) || Infinity;

    const productos = document.querySelectorAll('.producto');

    productos.forEach(producto => {
        const precioTexto = producto.querySelector('.producto-info p').textContent;
        const precio = parseInt(precioTexto.replace(/[^0-9]/g, '')); // Elimina símbolos como $ y comas

        if (precio >= min && precio <= max) {
            producto.style.display = 'block';
        } else {
            producto.style.display = 'none';
        }
    });
}
</script>

        <script src="script3.js?v=1234"></script>
    </body>
</html>