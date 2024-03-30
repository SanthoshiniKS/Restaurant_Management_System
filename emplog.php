<?php
$id = $_POST['eid'];
$pw = $_POST['pw'];

$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$sql = "SELECT password FROM employee WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    if ($pw == $stored_password) {
        header("Location: homepage.html");
        exit();
    } else {
        echo '<script>alert("Invalid Password");</script>';
    }
} else {
    echo '<script>alert("Invalid ID");</script>';
}

$conn->close();
?>