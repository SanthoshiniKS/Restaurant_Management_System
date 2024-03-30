<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["CONTENT_TYPE"]) && $_SERVER["CONTENT_TYPE"] === "application/json") {
    $json_data = file_get_contents("php://input");
    $order_data = json_decode($json_data, true);

    if (!empty($order_data['customer_id']) && !empty($order_data['foodList'])) {
        //$customer_id = $order_data['customer_id'];
        $customer_id =1;
        $foodList = $order_data['foodList'];

        // Connect to the database
        $conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare a statement to insert data into the cart table
        $stmt = $conn->prepare("INSERT INTO cart (customer_id, food_name, quantity, price, datetime) VALUES (?, ?, ?, ?, NOW())");

        // Bind parameters to the prepared statement
        $stmt->bind_param("issd", $customer_id, $foodName, $quantity, $price);

        // Loop through each food item
        foreach ($foodList as $foodItem) {
            $foodName = $foodItem['name'];
            $quantity = $foodItem['quantity'];
            $price = $foodItem['price'];

            // Execute the prepared statement
            $stmt->execute();
        }

        // Close the prepared statement
        $stmt->close();

        // Close the database connection
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
