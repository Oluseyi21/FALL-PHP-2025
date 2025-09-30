<?php

use Week4\Database;
use Week4\Post;

    require_once "config.php";
    require_once "Database.php";
    require_once "order.php";
    // connect to our database
    $db = new Database();
    $pdo = $db->getConnection();
    $orderModel = new PizzaOrder($pdo);

    $success = false;
    $error = "";

    //on form submission
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Store data into variables
        $customer_name = trim($_POST["customer_name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $pizza_size = $_POST["pizza_size"] ?? "";
        $toppings = $_POST["toppings"] ?? [];
        $instructions = trim($_POST["instructions"] ?? "");

        try {
            $orderModel->create($customer_name, $email, $phone, $pizza_size, $toppings, $instructions);
            $success = true;
        } catch(Exception $e) {
            $error = "Could not save order. " . $e->getMessage();
        }
    }
    // load templates
    include "templates/header.php";
    include "order.php"; //This file contains the form
    include "templates/footer.php";
?>