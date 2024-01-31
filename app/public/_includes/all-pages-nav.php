<aside class="bg-gray-500 text-gray-800 p-4 w-1/4 ">
    <h2 class="text-4xl font-bold mb-4">All Page Titles</h2>
    <nav>
        <ul>
            <?php
            // Fetch page titles and creator usernames from the database
            $sql = "SELECT p.id, p.title, u.username 
                    FROM page p 
                    JOIN user u ON p.user_id = u.id"; // Join to fetch creator username
            $stmt = $pdo->query($sql);
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Generate navigation links for each page along with creator username
            foreach ($pages as $page) {
                echo "<li><a href='page.php?id={$page['id']}' class='block py-2 px-4 text-blue-700 hover:bg-blue-100 hover:text-blue-900 rounded-md'>";
                echo "<span class='font-bold'>{$page['title']}</span>";
                echo "<span class='text-sm'> - Creator: {$page['username']}</span></a></li>";
            }
            ?>
        </ul>
    </nav>
</aside>
