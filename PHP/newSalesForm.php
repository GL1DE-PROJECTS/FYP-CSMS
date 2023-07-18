<?php
session_start();

if ($_SESSION["Login"] != "YES")
    header("Location: ../index.html");

function displayCurrentDateTime() {
        $currentDateTime = date('Y-m-d');
        echo "Current date: $currentDateTime";
        }
        
require("config.php");

if (!$conn) {
    echo 'failure';
    die('Connection failed: ' . mysqli_connect_error());
}

$id = $_SESSION["ID"];

$strsql = "SELECT * FROM users Where id = $id";
echo $strsql;
$result = mysqli_query($conn, $strsql);
$rows = mysqli_fetch_assoc($result);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        mysqli_close($conn);
        ob_clean();
        $name = $rows["name"];
        $email = $rows["email"];
        $password = $rows["password"];
        $phone = $rows["phone"];
        if($phone == null || $phone == "")
        {
            $phone = "NA";
        }
        $lname = $rows["Last_Name"];
        if($lname == null || $lname == "")
        {
            $lname = "NA";
        }
        $pos = $rows["position"];
        $fullname = $name . " " . $lname;
    } else {
        mysqli_close($conn);
        ob_clean();
        echo "fail";
    }
} else {
    mysqli_close($conn);
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FYP-CSMS -Charts</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- Custom styles for this template-->
    <link href="../CSS/sb-admin-2.min.css" rel="stylesheet">
    <link href="../CSS/newSales.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FYP CSMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../PHP/Main.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

              

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../PHP/charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../PHP/Sales.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Sales</span></a>
            </li>

            <?php
                if ($_SESSION["Level"] == 2)
                {
                    ?>
                        <!-- Nav Item - Tables -->
                        <li class="nav-item" hidden>
                            <a class="nav-link" href="../PHP/getInventory.php">
                                <i class="fas fa-fw fa-table"></i>
                                <span>Tables</span></a>
                        </li>
                    <?php
                }
                else
                {
                    ?>
                        <!-- Nav Item - Tables -->
                        <li class="nav-item">
                            <a class="nav-link" href="../PHP/getInventory.php">
                                <i class="fas fa-fw fa-table"></i>
                                <span>Tables</span></a>
                        </li>
                    <?php
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fullname  ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../PHP/userSettings.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div>
                        <h2>Sales Registration Form</h2>
                        <form action="insert_sales.php" method="POST" id="newSales">
                            <div class="form-group" id="date">
                                <label for="sales_date">Sales Date:</label>
                                <input type="datetime-local" id="sales_date" name="sales_date" required>
                            </div>

                            <div class="form-group" id="nama">
                                <label for="Name">Customer Name:</label>
                                <input type="text" id="Name" name="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="ic">Customer IC:</label>
                                <input type="text" id="ic" name="ic" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Customer phone:</label>
                                <input type="text" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Customer email:</label>
                                <input type="text" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="product_id">Product ID:</label>
                                <?php
                                require("config.php");

                                if (!$conn) {
                                    echo 'failure';
                                    die('Connection failed: ' . mysqli_connect_error());
                                }

                                $query = "SELECT * FROM inventory WHERE delStat <> 1 ORDER BY Make ASC";
                                $result = mysqli_query($conn, $query);
                                $intCount = 0;
                                $product = "";
                                ?>
                                <select id="product_id" name="product_id" required>
                                        <option value="">Select a product</option>
                                    <?php
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                        if($rows["Status"] != "Unavailable")
                                        {
                                            $product = $rows["Make"] . " " . $rows["Model"] . " " . $rows["chasis"];
                                            ?>
                                                <option value=<?php echo $rows["ID"]; ?> style="font-weight: bold"><?php echo $product; ?></option>
                                            <?php
                                        }
                                        $intCount++;
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="total_price">Sold Price in MYR:</label>
                                <input type="number" step="0.01" id="total_price" name="total_price" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Payment Method:</label>
                                <select name="payment_method" id="payment_method">
                                    <option value="">Select a product</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Paypal">Paypal</option>
                                </select >
                            </div>

                            <div class="form-group">
                                <label for="discount">Discount:</label>
                                <input type="number" step="0.01" id="discount" name="discount" required>
                            </div>

                            <div class="form-group">
                                <label for="tax">Tax:</label>
                                <input type="number" step="0.01" id="tax" name="tax" required>
                            </div>

                            <div class="form-group">
                                <label for="order_status">Order Status:</label>
                                <select name="order_status" id="order_status">
                                    <option value="">Select a product</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_status">Payment Status:</label>
                                <select name="payment_status" id="payment_status">
                                    <option value="">Select a product</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit">Credit</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shipping_address">Shipping Address:</label>
                                <input type="text" id="shipping_address" name="shipping_address" required>
                            </div>

                            <div class="form-group">
                                <label for="registration">Registration No.:</label>
                                <input type="text" id="registration" name="registration" required>
                            </div>

                            <div class="form-group">
                                <label for="fee">Shipping Fee</label>
                                <input type="number" id="fee" name="fee" required>
                            </div>

                            <?php
                                if ($_SESSION["Level"] == 2)
                                {
                                    ?>
                                        <!-- Nav Item - Tables -->
                                        <div class="form-group-Remarks">
                                            <label for="payment_status">Remarks:</label>
                                            <input type="text" id="remarks" name="remarks">
                                        </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <!-- Nav Item - Tables -->
                                        <div class="form-group-Remarks">
                                            <label for="payment_status" hidden>Remarks:</label>
                                            <input type="text" id="remarks" name="remarks"hidden>
                                        </div>
                                    <?php
                                }
                            ?>

                            <div class="form-group">
                                <label for="">...</label>
                                <input type="submit" value="Register Sale" >
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; FYP CSMS 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" onclick="logout()">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../JS/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../JS/Sales.js"></script>
    <script src="../JS/logout.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.js"></script>

    <!-- JavaScript -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</body>

</html>