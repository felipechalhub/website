<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'website';

    $conn = new mysqli($servername, $username, $password, $database);

$clientusername = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $clientusername = $_POST["clientusername"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];


    do{
        if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($clientusername)){
            $errorMessage = "All the fields are required";
            break;
        }
        $sql = "INSERT INTO users (username, name, email, phone, address, sign_up_date) " .
                "VALUES ('$clientusername', '$name', '$email', '$phone', '$address', current_timestamp)";
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
        header("location: /website/index.php");
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
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="clientusername" value="<?php echo $clientusername;?>">
                </div>
            </div>
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row-mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="col-mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="col-mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>

            <?php
                if(!empty($successMessage)){
                    echo "
                    <div class = 'row mb-3>
                        <div> class= 'offset-sm-3 col-sm-6'
                            <div class = 'alert alert-success alert-dismissible fade show' role= 'alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Back to the page'>Back to the page></button>
                            </div>
                        </div>
                    </div>                    
                    ";
                }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/website/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</html>