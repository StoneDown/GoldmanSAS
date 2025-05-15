<?php
session_start();

include 'conexion.php';

// Si se envió una nueva dirección, actualizarla
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['direccion']) && isset($_SESSION['codigo'])) {
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $codigo = $_SESSION['codigo'];
    $updateQuery = "UPDATE usuario SET direccion = '$direccion' WHERE codigo = $codigo";
    mysqli_query($conn, $updateQuery);
}

// Obtener saldo del usuario
$total = $_SESSION['total_carrito'] ?? 0;
$saldo = 0;
$direccion_actual = '';
if (isset($_SESSION['codigo'])) {
    $codigo = $_SESSION['codigo'];
    $query = "SELECT saldo, direccion FROM usuario WHERE codigo = $codigo";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $saldo = $row['saldo'];
        $direccion_actual = $row['direccion'] ?? '';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opciones de Pago - GoldmanSAS</title>
    <link rel="stylesheet" href="styles6.css">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f3f3f3; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .payment-box { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        .saldo { margin-bottom: 20px; font-size: 18px; }
        .productos { margin: 20px 0; font-size: 16px; }
        .payment-buttons { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
        .payment-buttons button { width: 100%; padding: 12px; font-size: 16px; border: none; border-radius: 8px; color: #fff; font-weight: bold; cursor: pointer; transition: background-color 0.2s; }
        .pse { background-color: #0070ba; }
        .pse:hover { background-color: #005f99; }
        .efecty { background-color: #f5a623; }
        .efecty:hover { background-color: #d48f1c; }
        .direccion-input { margin-bottom: 10px; }
        .direccion-input input { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="payment-box">
        <h2>Opciones de Pago</h2>
        <div class="saldo">Saldo disponible: $<?php echo number_format($saldo, 0, ',', '.'); ?></div>
        <div class="productos">Total de la compra: $<?php echo number_format($total, 0, ',', '.'); ?></div>

        <!-- Formulario para dirección y botón PSE -->
        <form method="POST" action="">
            <div class="direccion-input">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required value="<?php echo htmlspecialchars($direccion_actual); ?>">
            </div>
            <button class="pse" type="submit">Pagar con PSE</button>
        </form></br>

        <!-- Otros botones de pago -->
        <form method="GET" action="https://www.efectyvirtual.com/PortalEcommerce/Account/Register" target="_blank">
            <button class="efecty" type="submit">Pagar con Efecty</button>
        </form></br>

        <form method="POST" action="procesando_compra.php">
            <input type="hidden" name="total_carrito" value="<?php echo htmlspecialchars($total); ?>">
            <button class="pse" type="submit">Pago Directo</button>
        </form>
    </div>
</body>
</html>