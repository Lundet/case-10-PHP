<?php
session_start();
// Include database connection and setup functions if needed
include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Retrieve the page ID from the URL parameter
$page_id = $_GET['id'];

// Fetch page details from the database
$sql = "SELECT p.title, p.content, p.date_created, u.username
        FROM page p
        JOIN user u ON p.user_id = u.id
        WHERE p.id = :page_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':page_id' => $page_id]);
$page = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if page exists
if (!$page) {
    // Page not found, handle error or redirect to error page
    header("Location: error.php");
    exit();
}

// Display page details
$title = $page['title'];
$content = $page['content'];
$date_created = $page['date_created'];
$creator_username = $page['username'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="output.css" rel="stylesheet">
</head>

<body>

    <?php
    // Include header
    include "_includes/header.php";
    ?>

    <div class="container mx-auto flex">
        <div class="main-content w-3/4">
            <h1 class="text-3xl font-bold mb-4">
                <?php echo $title; ?>
            </h1>
            <p>Content:
                <?php echo $content; ?>
            </p>
            <p>Date Created:
                <?php echo $date_created; ?>
            </p>
            <p>Creator:
                <?php echo $creator_username; ?>
            </p>
        </div>
        <?php include "_includes/all-pages-nav.php"; ?>
    </div>
    

    <?php
    // Include footer
    include "_includes/footer.php";
    ?>
</body>

</html>