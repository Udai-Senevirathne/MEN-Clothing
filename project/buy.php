<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product-checkout</title>

    <?php 
        
        $conn = new mysqli("localhost", "root", "", "admin");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {

           
            if($_SERVER['REQUEST_METHOD']=="POST"){

                $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            

                $sql = "INSERT INTO product (pname, price, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $name, $price, $quantity);

            if ($stmt->execute() === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();

            }
            

            }

            
        
    ?>

    <style>
        body{
            background: url('images/login.jpg');
            background-size: cover;
        }

        .wrapper{
            position: relative;
            width: 60vw;
            height: 50vh;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 60px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .wrapper input{
            background: transparent;
            font-weight: 600;
        }
        


    </style>

    <!--Bootrstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid" style="display:flex;justify-content:center;align-items:center;height:100vh">
        <div class="wrapper">
            <form action="buy.php" method="POST">
                <input class="form-control mb-2" name="name" type="text" placeholder="Enter your name" aria-label="default input example" required>
                <input class="form-control mb-2" name="quantity" type="text" placeholder="Enter the quantity" aria-label="default input example" required>
                <input class="form-control mb-2" name="price" type="text" placeholder="Enter the price" aria-label="default input example" required>
    
                <div class="buttons">
                    <button class="btn btn-dark" type="submit">Checkout</button>
                    <button class="btn btn-secondary" type="reset"> Clear</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>