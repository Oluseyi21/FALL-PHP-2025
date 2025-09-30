<?php

namespace Assignment2;
use PDO;

class database{
    // This stores the base information
    // It as been defined in the config.php

    private $host = DB_HOST;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    // This will hold the pdo object
    private $pdo;

    // create our method to return the database
    public function getConnection(){
    if ($this->pdo === null) {
        try {
            $dsn = "mysql:host={$this->host}; dbname= {$this->db}; charset=utf8mb4";
            // create a new pdo object
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("Datbase connection failed: " . $e->getMessage());
            }
         }
    return $this->pdo;
    }
}
?>