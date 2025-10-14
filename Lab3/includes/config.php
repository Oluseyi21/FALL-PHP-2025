<?php
    //Database connection

    //define our connection information
    define('DB_HOST', '172.31.22.43');
    define('DB_USER', 'Oluseyi200616929');
    define('DB_PASS', '0GppqdnJwS');
    define('DB_NAME', 'Oluseyi200616929');

    try{
        //new PDO
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        //Set PDO error mode to exception for debugging
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        // stop the script and display the error if connection fails
        die("Connection failed: " . $e->getMessage());
    }
?>



