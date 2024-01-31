<?php

// se till att sessioner används på sidan
session_start();

require_once "_includes/database-connection.php";
include_once("_includes/global-functions.php");


setup_user($pdo);
setup_page($pdo);
createImageTable($pdo);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Register</title>
</head>

<body>

    <?php
    include "_includes/header.php";
    ?>

<div class="flex justify-center items-center h-screen bg-gray-100">
    <form action="" method="post" class="max-w-md mx-auto bg-white p-12 rounded-lg shadow-md mb-16">
        <h1 class="text-5xl font-bold mb-8 text-center">Register</h1>
        <div class="mb-6">
            <label for="username" class="block text-gray-700 font-semibold mb-2">Username:</label>
            <input type="text" name="username" id="username" class="w-full border border-gray-300 rounded-md py-4 px-5 text-xl focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-md py-4 px-5 text-xl focus:outline-none focus:border-blue-500" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-semibold py-4 px-8 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 w-full">Register</button>
    </form>
</div>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get user data from form
        $form_username = $_POST['username'];
        $form_hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        // send to database
        $sql_statement = "INSERT INTO `user` (`username`, `password`) VALUES ('$form_username', '$form_hashed_password')";

        try {
            $result = $pdo->query($sql_statement);
            if ($result->rowCount() == 1) {
                // if OK redirect to login page
                header("location: login.php");
            }
        } catch (PDOException $err) {
            echo "There was a problem: " . $err->getMessage();
        }
    }

    ?>


    <?php
    include "_includes/footer.php";
    ?>

</body>

</html>