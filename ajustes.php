<?php
session_start();
$tema = $_SESSION['tema'] ?? 'azul';
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

        label {
            margin: 10px;
            font-weight: bold;
        }

        button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="tema-<?php echo $tema; ?>">
    <div class="sidebar">
        <h2>General</h2>
        <ul>
            <li><a href="#">Ajustes de Apariencia</a></li>
            <li><a href="ajustes2.php">Saldo y Cuenta</a></li> <!-- Redirige a ajustes2.php -->
        </ul>
    </div>

    <div class="main-content">
        <header class="main-header">Ajustes</header>

        <div class="cuadro">
            <h3>Selecciona un tema</h3>
            <form method="post" action="guardar_tema.php">
                <label><input type="radio" name="tema" value="azul" <?php if ($tema == 'azul') echo 'checked'; ?>> Azul</label><br>
                <label><input type="radio" name="tema" value="oscuro" <?php if ($tema == 'oscuro') echo 'checked'; ?>> Oscuro</label><br>
                <label><input type="radio" name="tema" value="claro" <?php if ($tema == 'claro') echo 'checked'; ?>> Claro</label><br><br>
                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>
</body>
</html>
