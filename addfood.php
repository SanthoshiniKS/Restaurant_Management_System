<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$food = $_POST['food'];
$type = $_POST['type'];
$amt = $_POST['amt'];
$count = $_POST['count'];
$sql = "INSERT INTO food (food, type, amount, availability) VALUES ('$food','$type','$amt','$count')";
if ($conn->query($sql) === TRUE){

        echo json_encode(['success' => true]);
}
else{
    echo json_encode(['success' => false, 'error' => $conn->error]);
}
}
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $sql = "DELETE FROM food WHERE food='$delete'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
