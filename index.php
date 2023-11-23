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
        <a class="btn btn-primary" href="/website/products/products.php" role="button">List of Products</a>
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/website/create.php" role="button">New Client</a>
        <br>
        <h1>List of Users</h1>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Sign-Up-Date</td>
                    <td>Name</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = 'localhost';
                    $username = 'root';
                    $password = '';
                    $database = 'website';

                    $conn = new mysqli($servername, $username, $password, $database);
                    if($conn->connect_error){
                        die("Connection error: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if(!$result){
                        die("Invalid query: " . $conn->error);
                    }
                    
                    while($row = $result->fetch_assoc()){                
                echo "<tr>
                        <td>".$row["user_id"]."</td>
                        <td>".$row["username"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["sign_up_date"]."</td>
                        <td>".$row["name"]."</td>
                        <td>".$row["phone"]."</td>
                        <td>".$row["address"]."</td>
                        <td><a class='btn btn-primary btn-sm' href='/website/edit.php?id=$row[user_id]'>Edit</a></td>
                        <td><a class='btn btn-danger btn-sm' href='/website/delete.php?id=$row[user_id]'>Delete</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>