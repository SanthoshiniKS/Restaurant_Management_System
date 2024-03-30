<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM employee ORDER BY id DESC";
$result = $conn->query($sql);

$employee= [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employee[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'age' => $row['age'],
            'year_of_experience'=>$row['yearofexp']
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
<title>Employee Details</title>
<style>
    .container{
        background-color:black;
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
<div class="container">
<?php foreach ($employee as $employee): ?>
    <div class="employee-block">
        <h2><?php echo $employee['name']; ?></h2>
        <p>ID: <?php echo $employee['id']; ?></p>
        <p>Age: <?php echo $employee['age']; ?></p>
        <p>Year of Experience: <?php echo $employee['year_of_experience']; ?></p>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>