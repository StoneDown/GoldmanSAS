<?php
session_start(); // Inicia la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: index.php");
exit;
?>
