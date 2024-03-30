<?php
$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['ad'];
$contact = $_POST['contact'];
$gen = $_POST['g'];
$pw = $_POST['pw'];
echo '<script>alert("' . $name . '");</script>';
$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "INSERT INTO customer (name, age, gender, password, address, contact) VALUES ('$name', '$age', '$gen', '$pw', '$address', '$contact')";
if ($conn->query($sql) === TRUE) {
    echo '<script>alert("ADDED SUCCESSFULLY");</script>';
    header('Location: homepage.html');
    exit();
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
