<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = $_POST['direccion'];
    $id = $_SESSION['codigo'];

    $query = "UPDATE cliente SET direccion = ? WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $direccion, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>
            alert('Dirección registrada');
            setTimeout(() => window.location.href = 'http://localhost/GoldManSAS/index.php', 3000);
          </script>";
}

?>

<form method="POST">
    <label>Ingrese su dirección:</label><br>
    <input type="text" name="direccion" required><br><br>
    <button type="submit">Guardar</button>
</form>

