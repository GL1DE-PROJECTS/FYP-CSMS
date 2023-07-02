<?php

    function getHash($strVal)
    {
        $hashedString = hash('sha256', $strVal);
        return $hashedString;
    }

    // Database connection
    require("config.php");

    // Check connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    //Position array
    $data = array(
        array("0","Select Role"),
        array("1","Administrator"),
        array("2","Management"),
        array("2","Sales Admin"),
        array("3","Employee"),
        array("3","Store Admin"),
    );

    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = getHash($_POST['password']);
    $level = $data[$_POST["position"]][0];
    $position = $data[$_POST["position"]][1];


    // Insert the data into the database
    $sql = "INSERT INTO users (name, email, password, Level, status, position, delStat) VALUES ('$name', '$email', '$password', $level, 0, '$position', 0)";
    echo $sql;
    if (mysqli_query($conn, $sql)) {
        ob_clean();
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>