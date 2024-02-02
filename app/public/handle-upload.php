<?php
session_start();

include_once("_includes/database-connection.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Check if an image was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Upload image file and get its URL
        $image_url = uploadImage($_FILES["image"]);
    } else {
        // If no image uploaded, set image URL to null
        $image_url = null;
    }

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

        // Insert image data if an image was uploaded
        if ($image_url) {
            $sql_image = "INSERT INTO `image` (`url`, `page_id`) VALUES (:url, :page_id)";
            $stmt_image = $pdo->prepare($sql_image);
            $stmt_image->execute([
                ':url' => $image_url,
                ':page_id' => $page_id
            ]);
        }

        // Redirect to the newly added page
        header("Location: page.php?id=$page_id");
        exit();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
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
