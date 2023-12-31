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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];
    // $product_image = $_POST["images"];


    do{
        if(empty($product_name) || empty($product_description) || empty($product_price) || empty($product_quantity) ){
            $errorMessage = "All the fields are required";
            break;
        }
        if($_FILES["image"]["error"] === 4){
            echo
            "<script>alert('Image Does Not Exist'); </script>";
        }
        else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tpmName = $_FILES["image"]["tpm_name"];

            $validImageExtension = ['jpg','jpeg','png'];
            // $imageExtension = explode ('.', $fileName);
            // $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtension)){
                echo
                "<script> alert('Invalid Image Extension');</script>";
            }
            else if($fileSize> 1000000){
                echo
                "<script> alert('Image Size Is Too Large');</script>";
            }
                $newImageName = uniqid() . "-" . $fileName;

                move_uploaded_file($tpmName, 'uploads/' . $newImageName);
        

        }
        $sql = "INSERT INTO products (product_name, product_description, product_price, product_quantity, images) " .
                "VALUES ('$product_name', '$product_description', '$product_price', '$product_quantity', '$newImageName')";
        $result = $conn->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $clientusername = "";
        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";
        header("location: /website/products/products.php");
        exit;
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
        <h2>New Product</h2>
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
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" value="">
                </div>
            </div>
            <br>
            <div class="row mb-3" >
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/website/products/products.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</html>