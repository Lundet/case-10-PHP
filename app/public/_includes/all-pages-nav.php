<aside class="bg-indigo-600 text-white p-4 w-1/4 rounded-md shadow-md">
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
                echo "<li><a href='page.php?id={$page['id']}' class='block py-2 px-4 hover:bg-indigo-700 hover:text-white rounded-md'>";
                echo "<span class='font-bold'>{$page['title']}</span>";
                echo "<span class='text-sm text-gray-300'> - Creator: {$page['username']}</span></a></li>";
            }
            ?>
        </ul>
    </nav>
</aside>
