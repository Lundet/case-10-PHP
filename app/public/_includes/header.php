<header class="mb-4 mt-4 text-center">
    <nav class="mb-4 flex justify-center text-3xl">
        <a href="/" class="mx-2 text-blue-500 hover:underline">Start</a> | 
        <?php if(!isset($_SESSION['username'])): ?>
            <a href="login.php" class="mx-2 text-blue-500 hover:underline">Logga in</a> | 
        <?php endif; ?>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="logout.php" class="mx-2 text-blue-500 hover:underline">Logga ut</a> | 
        <?php endif; ?>
        <?php if(!isset($_SESSION['username'])): ?>
            <a href="register.php" class="mx-2 text-blue-500 hover:underline">Registrera</a> | 
        <?php endif; ?>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="add-page.php" class="mx-2 text-blue-500 hover:underline">Add New Page</a> | 
        <?php endif; ?>
        <span class="ml-auto mr-2"><?= isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></span>
    </nav>
    <hr class="mb-4">
</header>
