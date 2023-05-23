<?php
    session_start();

    if($_SESSION["Login"]!="YES")
        header("Location: ../html/index.html")
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/inventory.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="/JS/inventory.js"></script>
    <script>
    </script>

    <title>INVENTORY</title>
</head>

<body>
    <h1>Car Sales Inventory</h1>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Color</th>
                <th>Mileage</th>
                <th>Condition</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require("config.php");

            if (!$conn) {
                echo 'failure';
                die('Connection failed: ' . mysqli_connect_error());
            }

            $query = "SELECT * FROM inventory";
            $result = mysqli_query($conn, $query);
            $intCount = 0;
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $intCount + 1 ?></td>
                    <td><?php echo $rows["Make"]; ?></td>
                    <td><?php echo $rows["Model"]; ?></td>
                    <td><?php echo $rows["Year"]; ?></td>
                    <td><?php echo $rows["Price"]; ?></td>
                    <td><?php echo $rows["Color"]; ?></td>
                    <td><?php echo $rows["Mileage"]; ?></td>
                    <td><?php echo $rows["Cond"]; ?></td>
                    <td><?php echo $rows["Location"]; ?></td>
                    <td><?php echo $rows["Status"]; ?></td>
                </tr>
            <?php
                $intCount++;
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <div class="add-button-container">
        <!-- <button class="add-button">+</button> -->
        <form action="">
            <table class="table" id="mainTable">
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <table class="table" id="leftTable">
                                    <tr>
                                        <h1>Kiri</h1>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div>
                                <table class="table" id="rightTable">
                                    <tr>
                                        <h1>kanan</h1>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>