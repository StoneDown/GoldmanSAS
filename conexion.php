<?php
$servername = "localhost";
$username = "root"; // Cambia si usas otro usuario
$password = ""; // Cambia si tienes una contraseña
$dbname = "Clientes_9a"; //Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>