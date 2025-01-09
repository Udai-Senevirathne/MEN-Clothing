<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    // SQL injection prevention (optional)
    $uname = stripslashes($uname);
    $pass = stripslashes($pass);
    $uname = mysqli_real_escape_string($conn, $uname);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Query to check user credentials
    $sql = "SELECT * FROM login WHERE userid='$uname' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        header("Location: admin.html");
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
}
?>

