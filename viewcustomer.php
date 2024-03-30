<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM customer ORDER BY id DESC";
$result = $conn->query($sql);
$customer= [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customer[] = [
            'name' => $row['name'],
            'age' => $row['age'],
            'contact'=>$row['contact']
        ];
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Details</title>
<style>
        .top{
        padding:40px;
        background-color: grey;
        color:white;
        font-size:30px;
        text-align:center;
    }
    .container{
        background-color:black;
        pading-top:30px;
    }
    .employee-block {
    margin: 10px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}
</style>
</head>
<body>
    <div class="top"></div>
<div class="container">
<?php foreach ($customer as $customer): ?>
    <div class="employee-block">
        <h2><?php echo $customer['name']; ?></h2>
        <p>ID: <?php echo $customer['age']; ?></p>
        <p>Age: <?php echo $customer['contact']; ?></p>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>