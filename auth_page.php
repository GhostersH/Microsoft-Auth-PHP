<?php
include 'routes/routes.php';

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/.');
$dotenv->load();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center">
<div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
    <img src="<?php echo $_SESSION['user_image'] ?? 'default-avatar.png'; ?>" alt="User Image" class="rounded-full w-20 h-20 mx-auto border-4 border-white">
    <h2 class="text-2xl font-bold mt-4">Bienvenido, <?php echo $_SESSION['uname'] ?? 'Usuario'; ?>!</h2>
    <p class="text-gray-400 mt-2">Email: <?php echo $_SESSION['email'] ?? 'No disponible'; ?></p>
    <a href="?action=logout" class="mt-4 inline-block bg-red-600 px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">Cerrar sesión</a>
</div>
</body>
</html>
