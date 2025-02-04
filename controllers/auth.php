<?php

use Random\RandomException;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Configura la URL de la aplicación desde el archivo .env
define('APP_URL', $_ENV['APP_URL'] ?? die('APP_URL not set in .env'));

define('APP_ID', $_ENV['APP_ID'] ?? die('APP_ID not set in .env'));
define('TENANT_ID', $_ENV['TENANT_ID'] ?? die('TENANT_ID not set in .env'));
define('SECRET', $_ENV['SECRET'] ?? die('SECRET not set in .env'));

const LOGIN_URL = "https://login.microsoftonline.com/" . TENANT_ID . "/oauth2/v2.0/authorize";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configura la cookie de sesión para expirar en 1 día
ini_set('session.cookie_lifetime', 86400);
session_start();

// Regenerar la ID de sesión cada vez que se inicia la sesión para mejorar la seguridad
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Inicialización de estado
if (!isset($_SESSION['state'])) {
    try {
        $_SESSION['state'] = bin2hex(random_bytes(32));
    } catch (RandomException $e) {
        die('Error generating session state');
    }
}

// Redirección si ya está autenticado
if (isset($_SESSION['msatg'])) {
    header('Location: auth_page.php');
    exit();
}

// Manejo de acciones
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $params = [
                'client_id' => APP_ID,
                'redirect_uri' => APP_URL . '/index.php',
                'response_type' => 'token',
                'scope' => 'https://graph.microsoft.com/User.Read',
                'state' => $_SESSION['state'],
                'prompt' => 'select_account'
            ];
            header('Location: ' . LOGIN_URL . '?' . http_build_query($params));
            exit();

        case 'logout':
            session_unset();
            session_destroy();
            setcookie(session_name(), '', time() - 3600, '/');
            session_regenerate_id(true);
            header('Location: https://login.microsoftonline.com/' . TENANT_ID . '/oauth2/v2.0/logout?post_logout_redirect_uri=' . APP_URL . '/index.php');
            exit();
    }
}

// Script para modificar el hash en la URL por query string
echo '<script>
    if (window.location.hash) {
        window.location.href = window.location.href.replace("#", "?");
    }
</script>';

// Procesamiento del token de acceso
if (isset($_GET['access_token'])) {
    $_SESSION['t'] = $_GET['access_token'];

    $ch = curl_init("https://graph.microsoft.com/v1.0/me/");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['t'],
        'Content-type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch), true);

    if (isset($response['error'])) {
        curl_close($ch);
        die('Error in API Call');
    } else {
        $_SESSION['msatg'] = 1;
        $_SESSION['uname'] = $response['displayName'] ?? 'Unknown';
        $_SESSION['email'] = $response['mail'] ?? 'Unknown';
        $_SESSION['id'] = $response['id'] ?? 'Unknown';

        curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/photo/\$value");
        $imageData = curl_exec($ch);
        $_SESSION['user_image'] = $imageData ? 'data:image/jpeg;base64,' . base64_encode($imageData) : 'path/to/default/image.jpg';
        curl_close($ch);

        header('Location: ' . APP_URL . '/index.php');
        exit();
    }
}