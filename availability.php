<?php

if (isset($_GET['food'])) {
    $food = $_GET['food'];
    $conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $sql = "UPDATE food SET availability = availability - 1 WHERE food = '$food'";
    if ($conn->query($sql) === TRUE) {
        echo "Availability updated successfully";
    } else {
        echo "Error updating availability: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Error: Food name not provided";
}
?>

?>