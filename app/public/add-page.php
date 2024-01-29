<?php
session_start();

$title = "Add Page";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Upload image file and get its URL
    $image_url = uploadImage($_FILES["image"]); // Implement the uploadImage function

    // Save data to database
    try {
        // Insert page data
        $sql_page = "INSERT INTO `page` (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)";
        $stmt_page = $pdo->prepare($sql_page);
        $stmt_page->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $_SESSION['user_id'] // Assuming you have a logged-in user
        ]);

        // Get the ID of the inserted page
        $page_id = $pdo->lastInsertId();

        // Insert image data
        $sql_image = "INSERT INTO `image` (`url`, `page_id`) VALUES (:url, :page_id)";
        $stmt_image = $pdo->prepare($sql_image);
        $stmt_image->execute([
            ':url' => $image_url,
            ':page_id' => $page_id
        ]);

        // Redirect to a success page or show a success message
        // header("Location: success.php");
        // exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Function to upload image and return its URL
function uploadImage($file)
{
    // Implement your image upload logic here
    // Example: move_uploaded_file(), generate unique filename, save to server, return URL
    // Ensure proper security measures for file uploads
    // For demonstration purposes, you can simply return a placeholder URL
    return "path/to/uploaded/image.jpg";
}
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

    <div class="container mx-auto flex flex-wrap">
        <div class="main-content  w-1/4">

            <h1 class="text-3xl font-bold mb-4">Add a New Page</h1>

            <form action="add-page.php" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                    <input type="text" id="title" name="title" class="border rounded-md px-4 py-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
                    <textarea id="content" name="content" class="border rounded-md px-4 py-2 w-full" rows="6"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" id="image" name="image" class="border rounded-md px-4 py-2" accept="image/*"
                        required>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Add Page</button>
            </form>
        </div>
        <?php include "_includes/all-pages.php"; ?>
    </div>

    <?php include "_includes/footer.php"; ?>

</body>

</html>