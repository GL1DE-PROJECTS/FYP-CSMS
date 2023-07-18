<?php
session_start();

if ($_SESSION["Login"] != "YES")
    header("Location: ../index.html");

function displayCurrentDateTime() {
        $currentDateTime = date('Y-m-d');
        echo "Current date: $currentDateTime";
        }
        
require("config.php");

if (!$conn) {
    echo 'failure';
    die('Connection failed: ' . mysqli_connect_error());
}

$id = $_SESSION["ID"];

$strsql = "SELECT * FROM users Where id = $id";
echo $strsql;
$result = mysqli_query($conn, $strsql);
$rows = mysqli_fetch_assoc($result);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        mysqli_close($conn);
        ob_clean();
        $name = $rows["name"];
        $email = $rows["email"];
        $password = $rows["password"];
        $phone = $rows["phone"];
        if($phone == null || $phone == "")
        {
            $phone = "NA";
        }
        $lname = $rows["Last_Name"];
        if($lname == null || $lname == "")
        {
            $lname = "NA";
        }
        $pos = $rows["position"];
        $fullname = $name . " " . $lname;
    } else {
        mysqli_close($conn);
        ob_clean();
        echo "fail";
    }
} else {
    mysqli_close($conn);
    die('Query failed: ' . mysqli_error($conn));
}

require("config.php");

if (!$conn) {
    echo 'failure';
    die('Connection failed: ' . mysqli_connect_error());
}

// $query = "SELECT * FROM inventory WHERE delStat <> 1";
// $result = mysqli_query($conn, $query);
// $intCount = 0;

for ($month = 1; $month <= 12; $month++) {
    // SQL query to fetch the total sales for each month
    $sql = "SELECT SUM(unit_price) AS total_sales
            FROM carsales
            WHERE MONTH(sales_date) = $month AND delStat = 0";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the total sales value
        $row = $result->fetch_assoc();
        $totalSales = $row['total_sales'];

        // Add the total sales to the data array
        $data[] = $totalSales + 0;
    } else {
        // If no sales data found for the month, set the value to 0
        $data[] = 0;
    }
}

// Close the connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
?>