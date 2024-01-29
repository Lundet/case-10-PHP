<nav>
    <a href="/">Start</a> | 
    <?php if(!isset($_SESSION['username'])): ?>
        <a href="login.php">Logga in</a> | 
    <?php endif; ?>
    <?php if(isset($_SESSION['username'])): ?>
        <a href="logout.php">Logga ut</a> | 
    <?php endif; ?>
    <?php if(!isset($_SESSION['username'])): ?>
        <a href="register.php">Registrera</a> | 
    <?php endif; ?>
</nav>
<hr>
<header>
    <?php if(isset($_SESSION['username'])): ?>
        <?= $_SESSION['username']; ?> | <a href="add-page.php">Add New Page</a>
    <?php endif; ?>
</header>
