<?php
// Database connection
require("config.php");

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

function generateRandomPhrase() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $phrase = '';

    for ($i = 0; $i < 6; $i++) {
        $randomIndex = mt_rand(0, strlen($characters) - 1);
        $phrase .= $characters[$randomIndex];
    }

    return $phrase;
}

$date = $_POST["sales_date"];
$customer_id = $_POST["customer_id"];
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];
$total_price = $_POST["total_price"];
$salesperson_id = $_POST["salesperson_id"];
$payment_method = $_POST["payment_method"];
$discount = $_POST["discount"];
$tax = $_POST["tax"];
$address = $_POST["shipping_address"];
$order_status = $_POST["order_status"];
$payment_status = $_POST["payment_status"];
$remarks = $_POST["remarks"];
$salesRef = generateRandomPhrase();



$sql = "INSERT INTO carsales (sales_date, customer_id, product_id, quantity,total_price, salesperson_id, payment_method, discount, tax, shipping_address, order_status, payment_status, delStat, salesRef, remarks)
VALUES ('$date', '$customer_id', $product_id, $quantity, $total_price, '$salesperson_id', '$payment_method', $discount, $tax, '$address', '$order_status', '$payment_method', 0, '$salesRef', '$remarks');";
if (mysqli_query($conn, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$stmt = $conn->prepare("UPDATE inventory 
SET Status = 'Unavailable' WHERE id = $product_id");

if ($stmt->execute()) {
    // Update successful
    echo "success";
} else {
    // Update failed
    echo "failure";
}

// Close the database connection
mysqli_close($conn);

?>