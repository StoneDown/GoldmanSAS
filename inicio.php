<?php
session_start(); // Iniciar sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Compañía GoldmanSAS</title>
    <link rel="stylesheet" href="styles6.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1>GoldmanSAS</h1>
        <!-- Muestra el nombre de usuario o "predeterminado" -->
        <p style="font-size: 1rem;">
            Usuario: <strong>
                <?php
                // Verificar si el usuario está logueado
                echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'predeterminado';
                ?>
            </strong>
        </p>

        <!-- Si el usuario está logueado, mostrar un botón para cerrar sesión -->
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="logout.php" style="color: #f00;">Cerrar sesión</a>
        <?php endif; ?>
    </header>

    <main>
        <div class="subscription-box">
            <h1>Bienvenido a GoldmanSAS</h1>
            <!-- Si no estás logueado, muestra el formulario de login -->
            <?php if (!isset($_SESSION['usuario'])): ?>
                <form method="POST" action="">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>

                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required>

                    <button type="submit">Iniciar Sesión</button>
                </form>
                <a href="registro.php" class="register">No tienes cuenta?</a>
                <!-- Botón de inicio con Google -->
<form method="POST" action="GoldmanSAS/google_login.php">
    <div id="g_id_onload"
         data-client_id="557038238567-pmrf4ambnfmoohagefi7ldpqn7eegir7.apps.googleusercontent.com"
         data-login_uri="GoldmanSAS/google_login.php"
         data-auto_prompt="false">
    </div>

    <div class="g_id_signin"
         data-type="standard"
         data-size="large"
         data-theme="outline"
         data-text="sign_in_with"
         data-shape="rectangular"
         data-logo_alignment="left">
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</form>

                <?php
                // Conexión y lógica de login
                include 'conexion.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $usuario = $_POST['usuario'];
                    $contraseña = $_POST['contraseña'];

                    // Consulta preparada para evitar inyección SQL
                    $stmt = $conn->prepare("SELECT * FROM usuario WHERE usuario = ? AND contraseña = ?");
                    $stmt->bind_param("ss", $usuario, $contraseña);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($resultado->num_rows === 1) {
                        $fila = $resultado->fetch_assoc();
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['codigo'] = $fila['codigo']; // Guarda el ID del usuario en la sesión
                        echo "<p style='color: green;'>Inicio de sesión exitoso. Redirigiendo...</p>";
                        echo "<script>
                                setTimeout(function() {
                                    window.location.href = 'index.php';
                                }, 3000);
                              </script>";
                    } else {
                        echo "<p style='color: red;'>Usuario o contraseña incorrectos.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                }
                ?>
            <?php else: ?>
                <p style="color: green;">Ya has iniciado sesión. ¡Bienvenido de nuevo!</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>

