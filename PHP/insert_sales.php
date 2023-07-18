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

$counter = 1;

$date = $_POST["sales_date"];
$name = $_POST["Name"];
$ic = $_POST["ic"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$product_id = $_POST["product_id"];
$total_price = $_POST["total_price"];
$payment_method = $_POST["payment_method"];
$discount = $_POST["discount"];
$tax = $_POST["tax"];
$order_status = $_POST["order_status"];
$payment_status = $_POST["payment_status"];
$address = $_POST["shipping_address"];
$remarks = $_POST["remarks"];
$registration = $_POST["registration"];
$fee = $_POST["fee"];
$salesRef = generateRandomPhrase();

$sqlCust = "INSERT INTO customers (name, phone, email, delStat, IC) VALUES ('$name', '$phone', '$email', 0, '$ic')";
if (mysqli_query($conn, $sqlCust)) {
    $customer_id = mysqli_insert_id($conn);
    // echo "success ".$counter;
    $counter++;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


$sql = "INSERT INTO carsales (sales_date, customer_id, product_id,unit_price, payment_method, discount, tax, shipping_address, order_status, payment_status, delStat, salesRef, remarks, shipFee)
VALUES ('$date', '$customer_id', $product_id, $total_price, '$payment_method', $discount, $tax, '$address', '$order_status', '$payment_method', 0, '$salesRef', '$remarks', $fee);";
if (mysqli_query($conn, $sql)) {
    // echo "success ".$counter;
    $counter++;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$stmt = $conn->prepare("UPDATE inventory 
SET Status = 'Unavailable', registration = '$registration' WHERE id = $product_id");

if ($stmt->execute()) {
    // Update successful
    echo "success ".$counter;
} else {
    // Update failed
    echo "failure";
}

// Close the database connection
mysqli_close($conn);

?>