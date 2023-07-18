<?php

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $delStat = 1;

    $sql = "SELECT * FROM carsales WHERE sales_id = $id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $pid = $row["product_id"];
    $cid = $row["customer_id"];

    $stmt = $conn->prepare("UPDATE CarSales SET delstat = ? WHERE sales_id = ?");
    $stmt->bind_param("si", $delStat,$id);

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }

    $stmt = $conn->prepare("UPDATE inventory 
    SET Status = 'Available' WHERE id = $pid");

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }

    $stmt2 = $conn->prepare("UPDATE customers SET delstat = ? WHERE id = ?");
    $stmt2->bind_param("si", $delStat,$cid);

    if ($stmt2->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }
?>
