<?php
session_start();
include 'conexion.php'; // Asegúrate de que $conn está definido correctamente

// Verificar conexión a la base de datos
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Cargar las dependencias de Composer
require_once 'vendor/autoload.php';

// Configuración del cliente de Google
$client = new Google_Client();
$client->setClientId('557038238567-pmrf4ambnfmoohagefi7ldpqn7eegir7.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/GoldmanSAS/google_login.php');
$client->addScope('email');
$client->addScope('profile');

// Obtener el código de autenticación si está presente
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        die("Error al obtener el token: " . htmlspecialchars($token['error']));
    }

    $client->setAccessToken($token['access_token']);

    // Obtener información del usuario
    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

    $email = filter_var($userInfo->email, FILTER_SANITIZE_EMAIL);
    $nombre = $userInfo->name;
    $foto_perfil = $userInfo->picture;

    // Verificar si el usuario ya existe en la base de datos
    $stmt = $conn->prepare("SELECT codigo FROM usuario WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $nombre;
        $_SESSION['codigo'] = $row['codigo'];
    } else {
        // Crear nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuario (usuario, correo, foto_perfil) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $foto_perfil);


        if ($stmt_insert->execute()) {
            $_SESSION['usuario'] = $nombre;
            $_SESSION['codigo'] = $codigo;
        } else {
            die("Error al guardar el usuario: " . $stmt_insert->error);
        }

        $stmt_insert->close();
    }

    $stmt->close();

    // Redirigir al panel o ajustes
    header("Location: ajustes.php");
    exit();

} else {
    // No se recibió código, redirigir al login de Google
    $authUrl = $client->createAuthUrl();
    header("Location: " . $authUrl);
    exit();
}

?>