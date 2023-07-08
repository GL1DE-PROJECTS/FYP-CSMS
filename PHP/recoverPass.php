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

    // Get the form data
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = getHash($_POST['password']);
    $confirm = getHash($_POST["confirm"]);
    $id = 0;

    $strSql = "SELECT * FROM users WHERE name = '$name' AND email = '$email'";
    $result = mysqli_query($conn, $strSql);
    $rows = mysqli_fetch_assoc($result);
    if($result)
    {
        if(mysqli_num_rows($result)== 1)
        {
            $id = $rows["id"];
            if ($password <> $confirm)
            {
                die("Password does not match");
            }
            ob_clean();
            echo "success";
            $stmt = $conn->prepare("UPDATE users 
            SET password = ? WHERE id = $id");
            $stmt->bind_param("s", $password);

            if ($stmt->execute()) {
                // Update successful
                ob_clean();
                echo "success";
            } else {
                // Update failed
                ob_clean();
                echo "fail";
            }
        }
        else
        {
            mysqli_close($conn);
            ob_clean();
            echo "No user";
        }
    }
    else
    {
        mysqli_close($conn);
        echo $result." ".$strSql.$password;
        die('Query failed: ' . mysqli_error($conn));
    }
?>