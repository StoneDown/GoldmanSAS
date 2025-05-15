<?php
session_start();
include 'conexion.php';

$codigo = $_SESSION['codigo'] ?? null;
$nombres = $_POST['producto_nombre'] ?? [];
$cantidades = $_POST['producto_cantidad'] ?? [];
$precios = $_POST['producto_precio'] ?? [];

if (!$codigo || count($nombres) === 0) {
    header("Location: carrito.php?mensaje=Error en la compra");
    exit;
}

$conn->select_db('clientes_9a');

$total = 0;
foreach ($nombres as $i => $nombre) {
    $cantidad = (int) $cantidades[$i];
    $precio = (float) $precios[$i];
    $total += $cantidad * $precio;

    $stmt = $conn->prepare("INSERT INTO compras (codigo_usuario, producto_nombre, producto_cantidad, producto_precio, fecha_compra) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isid", $codigo, $nombre, $cantidad, $precio);
    $stmt->execute();
}

$_SESSION['total_carrito'] = $total;
header("Location: opciones_pago.php");
exit;
?>