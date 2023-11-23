<?php

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website';

    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM users WHERE user_id = $id";
    $conn->query($sql);

    header("location: /website/index.php");
    exit();
}


?>