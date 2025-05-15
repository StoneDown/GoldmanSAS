<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $temaSeleccionado = $_POST['tema'];
    $_SESSION['tema'] = $temaSeleccionado;

    // Redirigir a index.php después de guardar los cambios
    header("Location: index.php");
    exit;
}
?>
