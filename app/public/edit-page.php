<?php
session_start();

$title = "Edit Page";

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the page ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to an error page if ID is not provided
    header("Location: error.php");
    exit();
}

// Fetch page details from the database based on the ID
$page_id = $_GET['id'];
$sql = "SELECT * FROM page WHERE id = :page_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':page_id' => $page_id]);
$page = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the page exists
if (!$page) {
    // Redirect to an error page if page does not exist
    header("Location: error.php");
    exit();
}

// Check if the logged-in user is the creator of the page
if ($_SESSION['user_id'] !== $page['user_id']) {
    // Redirect to an error page if not authorized to edit
    header("Location: error.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data
    $new_title = $_POST["title"];
    $new_content = $_POST["content"];
    $new_image = $_FILES["image"];

    // Save updated data to the database
    try {
        // Check if a new image is uploaded
        if ($new_image["error"] === 0) {
            // Handle image upload
            $image_url = uploadImage($new_image);
            if (!$image_url) {
                // Handle image upload failure
                echo "Error uploading image.";
                exit();
            }

            // Update image URL in the database
            $sql_update_image = "UPDATE image SET url = :image_url WHERE page_id = :page_id";
            $stmt_update_image = $pdo->prepare($sql_update_image);
            $stmt_update_image->execute([
                ':image_url' => $image_url,
                ':page_id' => $page_id
            ]);
        }

        // Update page data
        $sql_update = "UPDATE page SET title = :title, content = :content WHERE id = :page_id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            ':title' => $new_title,
            ':content' => $new_content,
            ':page_id' => $page_id
        ]);

        // Redirect to the edited page
        header("Location: page.php?id={$page_id}");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Function to upload image and return its URL
function uploadImage($file)
{
    // Directory where uploaded images will be stored
    $target_dir = "uploads/";

    // Uploaded file name
    $fileName = $file["name"];

    // Full path for the uploaded file
    $fullPath = $target_dir . $fileName;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($file["tmp_name"], $fullPath)) {
        // Return the URL of the uploaded image
        return $fullPath;
    } else {
        return false;
    }
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

    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Edit Page</h1>

        <form action="edit-page.php?id=<?php echo $page_id; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="border rounded-md px-4 py-2 w-full"
                    value="<?php echo $page['title']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
                <textarea id="content" name="content" class="border rounded-md px-4 py-2 w-full"
                    rows="6"><?php echo $page['content']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                <input type="file" id="image" name="image" class="border rounded-md px-4 py-2" accept="image/*">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Save Changes</button>
        </form>
    </div>

    <?php include "_includes/footer.php"; ?>

</body>

</html>