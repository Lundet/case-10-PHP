<?php
session_start();

$title = "Add Page";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

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
    <link href="output.css" rel="stylesheet">
</head>

<body>

    <?php include "_includes/header.php"; ?>

    <div class="container mx-auto flex">
        <div class="main-content w-3/4">

            <h1 class="text-3xl font-bold mb-4">Add a New Page</h1>

            <form action="handle-upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="border rounded-md px-4 py-2 w-3/4" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
                    <textarea id="content" name="content" class="border rounded-md px-4 py-2 w-3/4"
                        rows="6"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" id="image" name="image" class="border rounded-md px-4 py-2" accept="image/*">
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Add Page</button>
            </form>
        </div>
        <?php include "_includes/all-pages-nav.php"; ?>
    </div>

    <?php include "_includes/footer.php"; ?>

</body>

</html>