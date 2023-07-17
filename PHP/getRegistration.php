<?php
// Database connection
require("config.php");

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$remarks = $_POST["selectedIndex"];

$query = "SELECT * FROM inventory WHERE ID = $remarks";
$result = mysqli_query($conn, $query);


if($result)
{
    $rows = mysqli_fetch_assoc($result);
    echo $rows["registration"];
}
else
{
    echo "Fail";
}

// Close the database connection
mysqli_close($conn);
