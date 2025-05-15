<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Habilitar la visualización de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $genero = trim($_POST['genero']);

    // Validar que todos los campos estén llenos
    if (empty($nombre) || empty($apellido) || empty($usuario) || empty($contraseña) || empty($correo) || empty($telefono) || empty($fecha_nacimiento) || empty($genero)) {
        $mensaje = '<p class="error">Campo(s) vacio(s), recuerda que son obligatorios para el correcto registro...</p>';
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO usuario (nombre, apellido, usuario, contraseña, correo, telefono, fecha_nacimiento, genero) 
                VALUES ('$nombre','$apellido','$usuario','$contraseña','$correo','$telefono','$fecha_nacimiento','$genero')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = '<p class="success">Señor Usuari@ se ha suscrito correctamente.</p>';
        } else {
            $mensaje = '<p class="error">Error al guardar los datos: ' . $conn->error . '</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción - Compañía GoldmanSAS</title>
    <link rel="stylesheet" href="styles6.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>GoldmanSAS</h1>
    </header>
    <main>
        <div class="subscription-box">
            <h1>Regístrate</h1>
            <form method="POST" action="">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellidos:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="contraseña">Contraseña:</label>
                <input type="text" id="contraseña" name="contraseña" required>

                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>

                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

                <label for="genero">Género:</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecciona...</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>

                <button type="submit" title="Oprima para suscribirse">Enviar</button>
            </form>
            <?php
            if (isset($mensaje)) {
                echo $mensaje;
            }
            ?>
        </div>
    </main>
</body>
</html>