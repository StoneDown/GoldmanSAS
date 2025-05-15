<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['codigo'])) {
    header("Location: login.php");
    exit;
}

$codigo = $_SESSION['codigo'];

if ($_FILES['nueva_foto']['error'] === UPLOAD_ERR_OK) {
    $nombreTmp = $_FILES['nueva_foto']['tmp_name'];
    $nombreArchivo = basename($_FILES['nueva_foto']['name']);
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $nombreFinal = 'foto_' . $codigo . '.' . strtolower($extension);
    $rutaDestino = 'fotos/' . $nombreFinal;

    // Validar que sea imagen
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($extension), $tiposPermitidos)) {
        die("Formato de imagen no permitido.");
    }

    // Mover archivo
    if (move_uploaded_file($nombreTmp, $rutaDestino)) {
        // Actualizar en la base de datos
        $query = "UPDATE usuario SET foto_perfil = '$nombreFinal' WHERE codigo = $codigo";
        mysqli_query($conn, $query);
        header("Location: ajustes.php");
        exit;
    } else {
        echo "Error al mover la imagen.";
    }
} else {
    echo "Error al subir la imagen.";
}
?>
