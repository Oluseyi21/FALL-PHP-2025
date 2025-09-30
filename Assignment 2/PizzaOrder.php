<?php
class PizzaOrder {
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save($customer_name, $email, $phone, $pizza_size, $toppings, $instructions) {
        $sql = "INSERT INTO orders (customer_name, email, phone, pizza_size, toppings, instructions)   VALUES (:customer_name, :email, :phone, :pizza_size, :toppings, :instructions)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":customer_name" => $customer_name,
            ":email" => $email,
            ":phone" => $phone,
            ":pizza_size" => $pizza_size,
            ":toppings" => $toppings,
            ":instructions" => $instructions
        ]);
    }
}
?>