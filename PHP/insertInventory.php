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
    $Origin = $_POST["Origin"];
    $Status = $_POST["Status"];
    $chasis = $_POST["chasis"];
    $currency = $_POST["Currency"];
    $registration = $_POST["Registration"];


    $sql = "INSERT INTO inventory (Make, Model, Year, Price, Color, Mileage, Cond, Location, chasis, Status, delStat, currencyID, registration)
    VALUES ('$Make', '$Model', $Year, $Price, '$Color', $Mileage, '$Condition', '$Origin', '$chasis', '$Status', 0, $currency, '$registration')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>