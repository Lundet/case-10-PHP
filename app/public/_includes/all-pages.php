<aside class="bg-gray-300 text-gray-800 p-4 w-1/4">
    <h2 class="text-xl font-bold mb-4">All Page Titles</h2>
    <nav>
        <ul>
            <?php
            // Fetch all page titles and IDs from the database
            $sql = "SELECT `title`, `id` FROM `page`"; // Using the 'page' table
            $stmt = $pdo->query($sql);
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Generate navigation links for each page
            foreach ($pages as $page) {
                echo "<li><a href='page.php?id={$page['id']}' class='text-blue-500 hover:underline'>{$page['title']}</a></li>";
            }
            ?>
        </ul>
    </nav>
</aside>
