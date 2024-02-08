<header class="mb-4 bg-blue-500 text-white py-6">
    <div class="container mx-auto flex justify-between items-center">
        <nav class="text-3xl flex-grow text-center">
            <a href="/" class="mx-2 hover:underline">Start</a> |
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="login.php" class="mx-2 hover:underline">Log in</a> |
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="mx-2 hover:underline">Log out</a> |
            <?php endif; ?>
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="register.php" class="mx-2 hover:underline">Register</a> |
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="add-page.php" class="mx-2 hover:underline">Add New Page</a> |
            <?php endif; ?>
        </nav>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="flex items-center">
                <span class="text-4xl font-bold">
                    <?php echo $_SESSION['username']; ?>
                </span>
                <?php
                // Fetch profile picture URL from the database based on user_id
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT url FROM profile_picture WHERE user_id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':user_id' => $user_id]);
                $profile_pic_row = $stmt->fetch(PDO::FETCH_ASSOC);
                $profile_pic_url = $profile_pic_row['url'] ?? null;

                if ($profile_pic_url): ?>
                    <img src="<?php echo $profile_pic_url; ?>" alt="Profile Picture" class="rounded-full w-10 h-10 ml-2">
                <?php else: ?>
                    <form action="add-profile-pic.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" accept="image/*">
                        <input type="submit" value="Upload">
                    </form>

                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</header>