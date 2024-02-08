<?php
session_start();

include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Check if the form was submitted and the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    // Process form data
    $profile_pic = uploadProfilePicture($_FILES["image"]);

    // Ensure that the profile picture was uploaded successfully
    if ($profile_pic) {
        // Update the session variable with the new profile picture URL
        $_SESSION['profile_pic'] = $profile_pic;

        // Insert the profile picture URL into the database
        $user_id = $_SESSION['user_id']; // Assuming you have the user ID stored in the session
        $sql = "INSERT INTO profile_picture (user_id, url) VALUES (:user_id, :profile_pic)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id, ':profile_pic' => $profile_pic]);

        // Redirect back to the user's profile page or any other appropriate page
        header("Location: index.php");
        exit();
    } else {
        echo "Error uploading profile picture.";
    }
} else {
    // If the request method is not POST or no file was uploaded, show an error message
    echo "Invalid request.";
}

// Function to upload profile picture and return its URL
function uploadProfilePicture($file)
{
    // Directory where uploaded profile pictures will be stored
    $target_dir = "profile_pics/";

    // Uploaded file name
    $fileName = $file["name"];

    // Full path for the uploaded file
    $fullPath = $target_dir . $fileName;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($file["tmp_name"], $fullPath)) {
        // Return the URL of the uploaded profile picture
        return $fullPath;
    } else {
        return false;
    }
}
?>
