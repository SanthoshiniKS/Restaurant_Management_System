<?php
$name = $_POST['name'];
$pw = $_POST['pw'];

$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT password FROM customer WHERE name='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    if ($pw == $stored_password) {
        header("Location: homepage.html");
        exit();
    } else {
        echo '<script>alert("Invalid Password");</script>';
        header("Location: customerlogin.html");
        exit();
    }
} else {
    echo '<script>alert("Invalid ID");</script>';
    header("Location: customerlogin.html");
    exit();
}

$conn->close();
?>