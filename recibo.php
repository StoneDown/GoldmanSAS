<?php
session_start();
include 'conexion.php';

$codigo = $_SESSION['codigo'] ?? null;
if (!$codigo) {
    echo "Usuario no identificado.";
    exit;
}

$conn->select_db('clientes_9a');

// Obtener el total de la última compra
$stmt = $conn->prepare("
    SELECT producto_nombre, producto_cantidad, producto_precio, fecha_compra 
    FROM compras 
    WHERE codigo_usuario = ? 
    ORDER BY fecha_compra DESC LIMIT 1
");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$result = $stmt->get_result();

$total = $_SESSION['total_carrito'] ?? 0;

// Obtener el saldo actual del usuario
$querySaldo = "SELECT saldo FROM usuario WHERE codigo = $codigo";
$resultSaldo = mysqli_query($conn, $querySaldo);
$saldo = ($rowSaldo = mysqli_fetch_assoc($resultSaldo)) ? $rowSaldo['saldo'] : 0;

// Vaciar el carrito después de obtener los datos
unset($_SESSION['carrito']);
unset($_SESSION['total_carrito']);

// Restar el total del saldo del usuario si tiene suficiente saldo
if ($saldo >= $total) {
    $nuevoSaldo = $saldo - $total;
    $updateSaldo = $conn->prepare("UPDATE usuario SET saldo = ? WHERE codigo = ?");
    $updateSaldo->bind_param("ii", $nuevoSaldo, $codigo);
    $updateSaldo->execute();
} else {
    echo "<script>alert('No tienes suficiente saldo para completar la compra.'); window.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo de Compra</title>
    <style>
        body { font-family: sans-serif; background-color: #f3f3f3; padding: 30px; }
        .recibo { background: #fff; padding: 25px; border-radius: 12px; max-width: 600px; margin: auto; box-shadow: 0 0 15px rgba(0,0,0,0.1); text-align: center; }
        h2 { margin-bottom: 20px; }
        .producto { display: flex; justify-content: space-between; margin: 10px 0; }
        .producto strong { flex: 1; }
        .continuar-btn { background-color: #007bff; color: #fff; border: none; padding: 10px 15px; font-size: 16px; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .continuar-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<div class="recibo">
    <h2>Recibo de Compra</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <?php $subtotal = $row['producto_precio'] * $row['producto_cantidad']; ?>
        <div class="producto">
            <strong><?= htmlspecialchars($row['producto_nombre']) ?> x<?= $row['producto_cantidad'] ?></strong>
            <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
        </div>
    <?php endwhile; ?>
    <hr>
    <h3>Total: $<?= number_format($total, 0, ',', '.') ?></h3>
    <h3>Nuevo Saldo: $<?= number_format($nuevoSaldo, 0, ',', '.') ?></h3>

    <!-- Botón para continuar -->
    <button class="continuar-btn" onclick="window.location.href='index.php'">Continuar</button>
</div>
</body>
</html>