<?php

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $id = $_SESSION["ID"];$name = $_POST["name"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];

    $stmt = $conn->prepare("UPDATE users 
    SET name = ?, Last_Name = ?, email = ?, phone = ?,position = ? WHERE id = $id");
    $stmt->bind_param("sssss", $name, $lname, $email, $phone,$position);

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }
?>
