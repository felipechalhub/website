<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website';

    $conn = new mysqli($servername, $username, $password, $database);

$id = "";
$product_name = "";
$product_description = "";
$product_price = "";
$product_quantity = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])){
        header("location : /website/products.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE product_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location : /website/products.php");
        exit;
    }

    $product_name = $row["product_name"];
    $product_description = $row["product_description"];
    $product_price = $row["product_price"];
    $product_quantity = $row["product_quantity"];
}
else{
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];

    do{
        if(empty($product_name) || empty($product_description) || empty($product_price) || empty($product_quantity)){
            $errorMessage = "All the fields are required";
            break;
        }
        $sql = "UPDATE products " .
        "SET product_name = '$product_name', product_description = '$product_description', product_price = '$product_price', product_quantity = '$product_quantity' " . 
        "WHERE product_id = $id";

        $result = $conn->query($sql);
        if(!$result){
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "Client updated correctly";
        header("location: /website/products.php");

    } while(false);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if(!empty($errorMessage)){
            echo "
            <div class= 'alert alert-warning alert-dismissible fade show'role='alert'>
                <strong>$errorMessage</strong>
                <button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Product</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_name" value="<?php echo $product_name;?>">
                </div>
            </div>
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_description" value="<?php echo $product_description;?>">
                </div>
            </div>
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_price" value="<?php echo $product_price;?>">
                </div>
            </div>
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product_quantity" value="<?php echo $product_quantity;?>">
                </div>
            </div>
            <br>
            <div class="row mb-3">
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/website/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</html>