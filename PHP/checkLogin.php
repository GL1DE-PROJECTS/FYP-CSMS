<?php

    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    // $username = str_replace("'","''", $_POST["username"]);
    // $password = str_replace("'","''", $_POST["password"]);

    $username = $_POST["username"];
    $password = $_POST["password"];


    $strSql = "SELECT * FROM Users WHERE name = '$username' AND password = '$password'";
    echo "test";
    echo $strSql;
    $result = mysqli_query($conn, $strSql);

    if($result)
    {
        if(mysqli_num_rows($result)== 1)
        {
            mysqli_close($conn);
            echo "success";
        }
        else
        {
            mysqli_close($conn);
            echo "fail";
        }
    }
    else
    {
        mysqli_close($conn);
        die('Query failed: ' . mysqli_error($conn));
    }
?>