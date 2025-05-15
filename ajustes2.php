<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['codigo'])) {
    die("Error: No se ha encontrado el código de usuario en la sesión.");
}

$codigo = $_SESSION['codigo'];
$tema = $_SESSION['tema'] ?? 'azul';

$usuario = "Invitado";
$saldo = 0;
$fecha_nacimiento = "sin configurar";
$genero = "sin configurar";
$correo = "sin configurar";
$telefono = "sin configurar";
$direccion = "sin configurar";
$foto_perfil = "usuario.png";

// Obtener los datos del usuario
$query = "SELECT usuario, saldo, fecha_nacimiento, genero, correo, telefono, direccion, foto_perfil FROM usuario WHERE codigo = '$codigo'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $usuario = $row['usuario'];
    $saldo = $row['saldo'];
    $fecha_nacimiento = $row['fecha_nacimiento'] ?: "sin configurar";
    $genero = $row['genero'] ?: "sin configurar";
    $correo = $row['correo'] ?: "sin configurar";
    $telefono = $row['telefono'] ?: "sin configurar";
    $direccion = $row['direccion'] ?: "sin configurar";
    $foto_perfil = $row['foto_perfil'] ?: "usuario.png";
}

// Obtener el nombre de la foto actual
$query = "SELECT foto_perfil FROM usuario WHERE codigo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $foto_actual = $row['foto_perfil'] ?: "usuario.png"; // Si está vacío, usar 'usuario.png'
} else {
    $foto_actual = "usuario.png"; // Si no hay resultados, usar por defecto
}

// Procesar nueva foto si se sube
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    $nombre_archivo = $_FILES['foto_perfil']['name'];
    $ruta_destino = 'fotos/' . $nombre_archivo;

    if ($foto_actual != "usuario.png" && file_exists('fotos/' . $foto_actual)) {
        unlink('fotos/' . $foto_actual);
    }

    if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta_destino)) {
        $query = "UPDATE usuario SET foto_perfil = '$nombre_archivo' WHERE codigo = '$codigo'";
        if (mysqli_query($conn, $query)) {
            header("Location: ajustes2.php");
            exit();
        } else {
            echo "Error al actualizar la foto de perfil: " . mysqli_error($conn);
        }
    } else {
        echo "Error al cargar la imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="ajustes.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f3f3;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main-content {
            width: 600px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .cuadro {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .foto-perfil-container img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s;
            margin-top: 10px;
        }

        .foto-perfil-container img:hover {
            transform: scale(1.1);
        }

        .btn-cambiar-foto {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-cambiar-foto:hover {
            background-color: #0056b3;
        }

        /* Estilos para la imagen ampliada */
        .img-ampliada {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .img-ampliada img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 10px;
        }

        .cerrar {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-volver {
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-volver:hover {
            background-color: #218838;
        }
    </style>
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="sidebar">
        <h2>General</h2>
        <ul>
            <li><a href="ajustes.php">Ajustes de Apariencia</a></li>
            <li><a href="#">Saldo y Cuenta</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header class="main-header">Ajustes</header>

        <div class="cuadro">
            <h3>Información de Cuenta</h3>
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario); ?></p>
            <div class="foto-perfil-container">
                <img src="fotos/<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de perfil" onclick="ampliarFoto(this)">
            </div>
            <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($fecha_nacimiento); ?></p>
            <p><strong>Género:</strong> <?php echo htmlspecialchars($genero); ?></p>
            <p><strong>Saldo Disponible:</strong> $<?php echo number_format($saldo, 0, ',', '.'); ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="foto_perfil" accept="image/*" required>
                <button type="submit" class="btn-cambiar-foto">Cambiar Foto de Perfil</button>
            </form>
        </div>

        <div class="cuadro">
            <h4>Información de Contacto</h4>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></p>
        </div>

        <!-- Botón Volver -->
        <div class="cuadro">
            <a href="index.php" class="btn-volver">Volver</a>
        </div>
    </div>

    <!-- Imagen ampliada -->
    <div class="img-ampliada" id="imgAmpliada">
        <span class="cerrar" onclick="cerrarFoto()">×</span>
        <img src="fotos/<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto ampliada" id="imgExpandida">
    </div>

    <script>
        // Función para ampliar la foto de perfil
        function ampliarFoto(img) {
            var imgAmpliada = document.getElementById('imgAmpliada');
            var imgExpandida = document.getElementById('imgExpandida');
            imgExpandida.src = img.src; // Asignar la misma fuente de la imagen
            imgAmpliada.style.display = 'flex'; // Mostrar la imagen ampliada
        }

        // Función para cerrar la imagen ampliada
        function cerrarFoto() {
            var imgAmpliada = document.getElementById('imgAmpliada');
            imgAmpliada.style.display = 'none'; // Ocultar la imagen ampliada
        }
    </script>
</body>
</html>