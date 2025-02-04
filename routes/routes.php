<?php
session_start();
error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Configura la URL de la aplicación desde el archivo .env
define('APP_URL', $_ENV['APP_URL'] ?? die('APP_URL not set in .env'));

// Redirigir a la página de inicio si la sesión no está establecida o está vacía
if (empty($_SESSION["uname"])) {
    header('Location: ' . APP_URL);  // Usando APP_URL para la redirección
    exit;
}

// Manejar la acción de cierre de sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['msatg']);
    session_destroy();
    header('Location: ' . APP_URL . '/index.php');
    exit;
}
