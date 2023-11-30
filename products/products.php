<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/website/index.php" role="button">Clients</a>
        <h2>List of Products</h2>
        <a class="btn btn-primary" href="/website/products/createProducts.php" role="button">New Product</a>
        <br>
        <h1>List of Products</h1>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Image</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    // include 'createProducts.php';
                    $servername = 'localhost';
                    $username = 'root';
                    $password = '';
                    $database = 'website';

                    $conn = new mysqli($servername, $username, $password, $database);
                    if($conn->connect_error){
                        die("Connection error: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);
                    if($result ->num_rows >0){
                    while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_description']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['product_quantity']; ?></td>
                            <td>
                                <?php if($row['images'] > 0){ ?>
                                <img src="data:image/png;charset=utf-8;base64, <?php echo base64_encode($row['images']); ?>" width="100" height="100">
                                <?php }?>
                            </td>
                        <td><a class="btn btn-warning btn-sm" href="/website/cart.php?id=<?php echo $row['product_id']; ?>" >Add to Cart </a></td>
                        <td><a class="btn btn-primary btn-sm" href="/website/products/editProducts.php?id=<?php echo $row['product_id']; ?>">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" href="/website/products/deleteProducts.php?id=<?php echo $row["product_id"]; ?>">Delete</a></td>                             
                        </tr>       
                    <?php
                    }
                }
                    ?>                
            </tbody>
        </table>
    </div>
</body>
</html>

