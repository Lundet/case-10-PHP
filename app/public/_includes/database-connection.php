<?php

// credentials
$servername = "mysql";
$database = "db_lecture";
$username = "db_user";
$password = "db_password";

// data source name
$dsn = "mysql:host=$servername;dbname=$database";

try {

    // connect to database
    $pdo = new PDO($dsn, $username, $password);

    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



// funktion för att skapa tabellen user
function setup_user($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
        `id` INT AUTO_INCREMENT,
        `username` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) NOT NULL, 
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);
}

function setup_page($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `page` (
        `id` INT AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `content` TEXT,
        `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `user_id` INT,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE NO ACTION
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);
}


function createImageTable($pdo) {
    $sql = "CREATE TABLE IF NOT EXISTS `image` (
        `id` INT AUTO_INCREMENT,
        `url` VARCHAR(255) NOT NULL,
        `page_id` INT,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`page_id`) REFERENCES `page`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($sql);
}





?>
