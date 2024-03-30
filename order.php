<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM food";
$result = $conn->query($sql);

$foodItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $foodItems[] = [
            'food' => $row['food'],
            'type' => $row['type'],
            'amount' => $row['amount'],
            'availability' => $row['availability']
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
    <title>Place order</title>
    <style>
        .top {
            padding: 40px;
            background-color: grey;
            color: white;
            font-size: 30px;
            text-align: center;
        }
        .container {
            background-color: darkgrey;
        }
        .employee-block {
            margin: 20px;
            padding: 5px;
            width: 500px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            border-radius: 3px;
            background-color: grey;
            border: none;
            padding: 4px;
        }
    </style>
</head>
<body>
    <div class="top">DELICIOUS CORNER</div>
    <div class="container">
    <?php foreach ($foodItems as $food): ?>
        <div class="employee-block">
            <h2><?php echo $food['food']; ?></h2>
            <p>Type: <?php echo $food['type']; ?></p>
            <p>Amount: <?php echo $food['amount']; ?></p>
            <p>Availability: <?php echo $food['availability']; ?></p>
            <center><button onclick="addtocart('<?php echo $food['food']; ?>', <?php echo $food['availability']; ?>)">Add to Cart</button></center>
        </div>
    <?php endforeach; ?>
    </div>
    <center><button onclick="submitOrder()">Order</button></center>
    <script>
        var clickedFoods = [];

        function addtocart(food, availability) {
            var quantity = prompt("Enter the quantity for " + food + ":");
            if (quantity !== null && quantity.trim() !== "") {
                quantity = parseInt(quantity);
                if (quantity > 0 && quantity <= availability) {
                    var foodItem = {
                        name: food,
                        quantity: quantity
                    };
                    clickedFoods.push(foodItem);
                } else {
                    alert("Please enter a valid quantity between 1 and " + availability);
                }
            }
        }

        function submitOrder() {
            // Convert the clickedFoods array to a JSON string
            var foodList = JSON.stringify(clickedFoods);

            // Send the JSON string to the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send(foodList);
        }
    </script>
</body>
</html>