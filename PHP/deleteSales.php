<?php

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $delStat = 1;



    $stmt = $conn->prepare("UPDATE CarSales SET delstat = ? WHERE sales_id = ?");
    $stmt->bind_param("si", $delStat,$id);

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }

    $strSql = "SELECT * FROM users WHERE name = '$username' AND password = '$password' AND delstat <> 1 AND status = 1";
    $result = mysqli_query($conn, $strSql);
    $rows = mysqli_fetch_assoc($result);
    if($result)
    {
        $id = $rows["customer_id"];
    }
    else
    {
        mysqli_close($conn);
        die('Query failed: ' . mysqli_error($conn));
    }

    $stmt2 = $conn->prepare("UPDATE customers SET delstat = ? WHERE sales_id = ?");
    $stmt2->bind_param("si", $delStat,$id);

    if ($stmt2->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }
?>
