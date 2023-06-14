<?php

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $approve = 1;

    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $approve,$id);

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }
?>
