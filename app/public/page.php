<?php
session_start();
// Include database connection and setup functions if needed
include_once("_includes/database-connection.php");
include_once("_includes/global-functions.php");

// Retrieve the page ID from the URL parameter
$page_id = $_GET['id'];

// Fetch page details from the database
$sql = "SELECT p.id, p.title, p.content, p.date_created, p.user_id, u.username, i.url as image_url
        FROM page p
        JOIN user u ON p.user_id = u.id
        LEFT JOIN image i ON p.id = i.page_id
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
$user_id = $page['user_id'];
$image_url = $page['image_url'];

// Check if the logged-in user is the creator of the page
$is_owner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?>
    </title>
    <link href="output.css" rel="stylesheet">
</head>

<body>

    <?php
    // Include header
    include "_includes/header.php";
    ?>

    <div class="container mx-auto flex">
        <div class="main-content w-3/4 flex flex-col mt-12 items-center">
            <h1 class="text-3xl font-bold mb-4">
                <?php echo $title; ?>
            </h1>
            
            <p>Content:
                <?php echo $content; ?>
            </p>
            <?php if ($image_url): ?>
                <img src="<?php echo $image_url; ?>" alt="Page Image" class=" h-40 w-40">
            <?php endif; ?>

            <p>Date Created:
                <?php echo $date_created; ?>
            </p>
            <p>Creator:
                <?php echo $creator_username; ?>
            </p>
            <?php if ($is_owner): ?>
                <div class="mt-4">
                    <a href="edit-page.php?id=<?php echo $page_id; ?>"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Edit Page</a>
                    <a href="remove-page.php?id=<?php echo $page_id; ?>"
                        class="bg-red-500 text-white font-bold py-2 px-4 rounded-full">Delete Page</a>
                </div>
            <?php endif; ?>
        </div>

        <?php include "_includes/all-pages-nav.php"; ?>
    </div>


    <?php
    // Include footer
    include "_includes/footer.php";
    ?>
</body>

</html>