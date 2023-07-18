<?php
    function getHash($strVal)
    {
        $hashedString = hash('sha256', $strVal);
        return $hashedString;
    }

    session_start();
    require("config.php");

    if (!$conn) {
        echo 'failure';
        die('Connection failed: ' . mysqli_connect_error());
    }

    // $username = str_replace("'","''", $_POST["username"]);
    // $password = str_replace("'","''", $_POST["password"]);

    $username = str_replace("'", "' '",$_POST["username"]);
    $password = getHash($_POST["password"]);


    $strSql = "SELECT * FROM users WHERE name = '$username' AND password = '$password' AND delstat <> 1 AND status = 1";
    $result = mysqli_query($conn, $strSql);
    $rows = mysqli_fetch_assoc($result);
    if($result)
    {
        if(mysqli_num_rows($result)== 1)
        {
            if ($rows["Level"] == 0 || $rows["Level"] == null)
            {
                mysqli_close($conn);
                ob_clean();
                echo $password;
                exit;
            }
            else if ($rows["Level"] == 1)
            {  
                mysqli_close($conn);
                ob_clean();
                echo "success1";
            }
            else if ($rows["Level"] == 2)
            {  
                mysqli_close($conn);
                ob_clean();
                echo "success2";
            }
            else if ($rows["Level"] == 3)
            {  
                mysqli_close($conn);
                ob_clean();
                echo "success3";
            }
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = $rows["name"];
            $_SESSION["ID"] = $rows["id"];
            $_SESSION["Level"] = $rows["Level"];
        }
        else
        {
            mysqli_close($conn);
            ob_clean();
            echo $password;
        }
    }
    else
    {
        mysqli_close($conn);
        die('Query failed: ' . mysqli_error($conn));
    }
?>