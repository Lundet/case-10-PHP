<?php
session_start();
include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the page ID is provided
if (!isset($_GET['id'])) {
    // Redirect or handle error
    header("Location: error.php");
    exit();
}

// Retrieve the page ID from the URL parameter
$page_id = $_GET['id'];

// Fetch page details from the database
$sql = "SELECT * FROM page WHERE id = :page_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':page_id' => $page_id]);
$page = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the page exists
if (!$page) {
    // Page not found, handle error or redirect
    header("Location: error.php");
    exit();
}

// Check if the logged-in user is the owner of the page
if ($_SESSION['user_id'] != $page['user_id']) {
    // User is not authorized to delete this page, handle error or redirect
    header("Location: error.php");
    exit();
}

// If the user confirms the deletion, proceed with deleting the page
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirm_delete'])) {
    //delete image
    $sql_delete_images = "DELETE FROM image WHERE page_id = :page_id";
    $stmt_delete_images = $pdo->prepare($sql_delete_images);
    $stmt_delete_images->execute([':page_id' => $page_id]);
   
   
    // Delete the page
    $sql = "DELETE FROM page WHERE id = :page_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':page_id' => $page_id]);

    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Page</title>
    <link href="output.css" rel="stylesheet">
</head>

<body>

    <?php include "_includes/header.php"; ?>

    <div class="container mx-auto flex">
        <div class="main-content mt-10 w-3/4 flex flex-col items-center">
            <h1 class="text-3xl font-bold mb-4">Delete Page</h1>
            <p>Are you sure you want to delete the page "<?php echo $page['title']; ?>"?</p>
            <form action="remove-page.php?id=<?php echo $page_id; ?>" method="post">
                <button type="submit" name="confirm_delete" class="bg-red-500 text-white font-bold py-2 px-4 rounded-full mt-4">Confirm Delete</button>
                <a href="page.php?id=<?php echo $page_id; ?>" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-full mt-4 ml-4">Cancel</a>
            </form>
        </div>
        <?php include "_includes/all-pages-nav.php"; ?>
    </div>

    <?php include "_includes/footer.php"; ?>

</body>

</html>
