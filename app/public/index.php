<?php
session_start();

$title = "Create Your Own Page";

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
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="output.css">
</head>

<body class="font-sans">

    <?php include "_includes/header.php"; ?>
    
    <div class="container mx-auto flex">
        <div class="main-content w-3/4">
            <h1 class="text-3xl font-bold mb-4">Create Your Own Page</h1>

            <p>Welcome to my website! Here, you can create your own pages and share your content with the world.If you wanna see others content u can simply click the links on the right side
                "All page titles".
             Follow these simple steps to get started:</p>

            <ol class="list-decimal ml-6 mt-8">
                <li class="my-4">Register for an account: If you're new here, click on the "Register" button in the navigation bar and fill out the registration form.</li>
                <li class="my-4">Log in to your account: Once registered, log in using your credentials.</li>
                <li class="my-4">Click on "Add new page": After logging in, you'll have access to the option to create your own page. Click on "Create Page" in the navigation bar.</li>
                <li class="my-4">Fill out the form: You'll be directed to a page creation form where you can enter a title, content, and optionally upload an image for your page.</li>
                <li class="my-4">Submit your page: Once you've filled out the form, click on the "Add Page" button to create your page.</li>
                <li class="my-4">View your page: Congratulations! Your page is now live. You can view it by clicking on its title in the navigation bar.</li>
            </ol>

            <p>Start sharing your thoughts, ideas, and creations with the world today!</p>
        </div>
        
        <?php include "_includes/all-pages-nav.php"; ?>
    </div>
    
    <?php include "_includes/footer.php"; ?>

</body>

</html>
