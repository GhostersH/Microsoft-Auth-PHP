<?php
include 'controllers/auth.php';

// Configura los recursos según la URL actual
$favicon = '';
$background = '';
$logo = '';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="robots" content="noindex">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login MS AZURE</title>
    <link rel="icon" href="" sizes="192x192"/>
</head>

<body class="h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image:;">
<div class="bg-black bg-opacity-40 absolute inset-0"></div>

<div class="relative z-10 bg-white p-8 rounded-lg shadow-lg max-w-md w-[370px]">
    <div class="text-center mb-6">
        <h1 class="uppercase font-bold text-2xl text-[#223449]">Login</h1>

    </div>
    <div class="text-center">
        <a href="?action=login" class="inline-block mb-4">
            <img src="images/ms-symbollockup_signin_light.svg" alt="Sign in with Microsoft"/>
        </a>
        <p class="text-gray-600">
            <a href="https://passwordreset.microsoftonline.com/" target="_blank"
               class="text-sm text-gray-400 hover:underline">Forgot your password?</a>
        </p>
    </div>
</div>
</body>
</html>