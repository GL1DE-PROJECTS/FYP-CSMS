<?php

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    $id = $_GET['id'];
    $delStat = 1;

    $stmt = $conn->prepare("UPDATE inventory SET delstat = ? WHERE ID = ?");
    $stmt->bind_param("si", $delStat,$id);

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Update failed
        echo "failure";
    }
?>
