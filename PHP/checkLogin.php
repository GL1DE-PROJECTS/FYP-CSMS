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
    $result = mysqli_query($conn, $strSql);
    $rows = mysqli_fetch_assoc($result);

    if($result)
    {
        if(mysqli_num_rows($result)== 1)
        {
            mysqli_close($conn);
            ob_clean();
            echo "success";
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = $rows["name"];
            $_SESSION["ID"] = $rows["id"];
        }
        else
        {
            mysqli_close($conn);
            ob_clean();
            echo "fail";
        }
    }
    else
    {
        mysqli_close($conn);
        die('Query failed: ' . mysqli_error($conn));
    }
?>