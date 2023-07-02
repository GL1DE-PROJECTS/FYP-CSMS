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

    $id = $_SESSION["ID"];
    $old = getHash($_POST["oldPass"]);
    $new = getHash($_POST["newPass"]);
    $conf = getHash($_POST["confPass"]);

    $strsql = "SELECT * FROM users WHERE password = $old AND id = $id";
    $result = mysqli_query($conn, $strsql);
    $rows = mysqli_fetch_assoc($result);

    if($result)
    {
        if(mysqli_num_rows($result)== 1)
        {
            if ($new <> $conf)
            {
                die("Password does not match");
            }
            ob_clean();
            echo "success";
            $stmt = $conn->prepare("UPDATE users 
            SET password = ? WHERE id = $id");
            $stmt->bind_param("s", $new);

            if ($stmt->execute()) {
                // Update successful
                echo "success";
            } else {
                // Update failed
                echo "failure";
            }
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
