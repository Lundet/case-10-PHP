<header class="mb-4 bg-blue-500 text-white py-6">
    <div class="container mx-auto flex justify-between items-center">
        <nav class="text-3xl flex-grow text-center">
            <a href="/" class="mx-2 hover:underline">Start</a> | 
            <?php if(!isset($_SESSION['username'])): ?>
                <a href="login.php" class="mx-2 hover:underline">Log in</a> | 
            <?php endif; ?>
            <?php if(isset($_SESSION['username'])): ?>
                <a href="logout.php" class="mx-2 hover:underline">Log out</a> | 
            <?php endif; ?>
            <?php if(!isset($_SESSION['username'])): ?>
                <a href="register.php" class="mx-2 hover:underline">Register</a> | 
            <?php endif; ?>
            <?php if(isset($_SESSION['username'])): ?>
                <a href="add-page.php" class="mx-2 hover:underline">Add New Page</a> | 
            <?php endif; ?>
        </nav>
        <span class="text-lg font-bold"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></span>
    </div>
</header>
