<?
// Ejemplo de inserción de productos en la base de datos
session_start();
include 'conexion.php';

$codigo = $_SESSION['codigo'] ?? null;
$total = $_SESSION['total_carrito'] ?? 0;

if (!$codigo || $total <= 0) {
    header("Location: index.php?mensaje=Falta información de usuario o total no válido");
    exit;
}

// Obtener el carrito de compras
$carrito = json_decode(file_get_contents('php://input'), true) ?? [];

if (empty($carrito)) {
    header("Location: index.php?mensaje=El carrito está vacío");
    exit;
}

// Consultar saldo
$stmt = $conn->prepare("SELECT saldo FROM usuario WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$result = $stmt->get_result();
$saldo = $result->fetch_assoc()['saldo'];

if ($saldo >= $total) {
    // Descontar el saldo
    $nuevo_saldo = $saldo - $total;
    $update_stmt = $conn->prepare("UPDATE usuario SET saldo = ? WHERE codigo = ?");
    $update_stmt->bind_param("ii", $nuevo_saldo, $codigo);
    $update_stmt->execute();

    // Insertar la compra
    $insert_stmt = $conn->prepare("INSERT INTO compras (codigo_usuario, total, fecha_pago) VALUES (?, ?, NOW())");
    $insert_stmt->bind_param("ii", $codigo, $total);
    $insert_stmt->execute();
    $compra_id = $insert_stmt->insert_id;

    // Insertar los productos comprados
    foreach ($carrito as $producto) {
        $insert_producto_stmt = $conn->prepare("INSERT INTO productos_comprados (compra_id, producto_nombre, cantidad, precio) VALUES (?, ?, ?, ?)");
        $insert_producto_stmt->bind_param("isid", $compra_id, $producto['nombre'], $producto['cantidad'], $producto['precio']);
        $insert_producto_stmt->execute();
    }

    header("Location: recibo.php?compra_id=$compra_id");
    exit;
} else {
    // Si el saldo no es suficiente
    header("Location: index.php?mensaje=Saldo insuficiente");
    exit;
}

$stmt->close();
$conn->close();
?>