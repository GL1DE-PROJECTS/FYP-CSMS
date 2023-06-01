<?php
    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $Make = $_POST["Make"];
    $Model = $_POST["Model"];
    $Year = $_POST["Year"];
    $Price = $_POST["Price"];
    $Color = $_POST["Color"];
    $Mileage = $_POST["Mileage"];
    $Condition = $_POST["Condition"];
    $Location = $_POST["Location"];
    $Status = $_POST["Status"];

    $sql = "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, Status, delStat)
    VALUES ('$Make', '$Model', $Year, $Price, '$Color', $Mileage, '$Condition', '$Location', '$Status', 0)";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>