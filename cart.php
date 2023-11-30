<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website';

    $conn = new mysqli($servername, $username, $password, $database);

    $price = "SELECT product_price FROM products WHERE product_id = $id";

    $sql = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES (1, '$id', 1, '$price')" ;
    $conn->query($sql);

    $successMessage = "Item added to Cart";
    header("location: /website/products/products.php");
    exit();
}


?>