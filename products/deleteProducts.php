<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website';

    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM products WHERE product_id = $id";
    $conn->query($sql);

    header("location: /website/products/products.php");
    exit();
}


?>