<?php
session_start();

$title = "About PHP";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");
setup_user($pdo);
setup_page($pdo);
createImageTable($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="font-sans">

    <?php include "_includes/header.php"; ?>
    <div class="container mx-auto flex">
        <div class="main-content w-3/4">
            <h1 class="text-3xl font-bold ">Hello world</h1>

            <p>
                This is a simple example of a PHP page with basic Tailwind CSS styling.
            </p>
        </div>
        <?php include "_includes/all-pages-nav.php"; ?>
    </div>
    <?php include "_includes/footer.php"; ?>

</body>

</html>