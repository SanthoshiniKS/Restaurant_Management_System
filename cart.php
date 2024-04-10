<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === "application/json") {
    $json_data = file_get_contents("php://input");
    $order_data = json_decode($json_data, true);

    if (!empty($order_data['customer_id']) && !empty($order_data['foodList'])) {
        //$customer_id = $order_data['customer_id'];
        $customer_id =1;
        $foodList = $order_data['foodList'];

        $conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO cart (customer_id, food_name, quantity, price, datetime) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("issd", $customer_id, $foodName, $quantity, $price);
        foreach ($foodList as $foodItem) {
            $foodName = $foodItem['name'];
            $quantity = $foodItem['quantity'];
            $price = $foodItem['price'];
            $stmt->execute();
        }
        $stmt->close();
        $conn->close();
        echo "Order placed successfully.";
    } else {
        echo "Invalid request data.";
    }
} else {
    http_response_code(400); // Bad request
    echo "Invalid request.";
}
?>
