<?php
session_start();

// Log out the user by destroying the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="output.css" rel="stylesheet">
    <title>Log Out</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <p class="text-lg text-gray-800">You are now logged out.</p>
        <a href="login.php" class="text-blue-500 hover:underline mt-4 block">Return to Log In</a>
    </div>
</body>
</html>
