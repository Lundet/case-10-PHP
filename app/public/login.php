<?php
// Ensure sessions are used on the page
session_start();

include_once("_includes/database-connection.php");
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
    <title>Login</title>
</head>

<body>

    <?php include "_includes/header.php"; ?>

    <h1>Login</h1>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username">

        <label for="password">Password: </label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user data from form
        $form_username = $_POST['username'];
        $form_password = $_POST['password'];

        // Send query to database
        $sql_statement = "SELECT * FROM `user` WHERE `username` = '$form_username'";

        try {
            $result = $pdo->query($sql_statement);

            $user = $result->fetch();

            // No user found with these credentials
            if (!$user) {
                header("location: login.php");
                exit();
            }

            // Verify password
            $is_correct_password = password_verify($form_password, $user['password']);
            if (!$is_correct_password) {
                header("location: login.php");
                exit();
            }

            // Store user data in session
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id']; // Store user ID

            // Redirect to start page
            header("location: add-page.php");
        } catch (PDOException $err) {
            echo "There was a problem: " . $err->getMessage();
        }

    }
    ?>

    <?php include "_includes/footer.php"; ?>

</body>

</html>
