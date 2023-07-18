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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    

    <!-- Custom styles for this template-->
    <link href="../CSS/sb-admin-2.min.css" rel="stylesheet">

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
            if ($_SESSION["Level"] == 2) {
            ?> <!-- Nav Item - Tables -->
                <li class="nav-item" hidden>
                    <a class="nav-link" href="../PHP/getInventory.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span></a>
                </li>
            <?php
            } else {
            ?> <!-- Nav Item - Tables -->
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Sales</h1>
                    <p class="mb-4">Car sales involve the buying and selling of vehicles for commercial purposes.
                        The charts below have been customized - for further customization options, please visit the <a target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js
                            documentation</a>.</p>

                    <!-- Content Row -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php displayCurrentDateTime() ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>...</th>
                                            <th>Sales Date</th>
                                            <th hidden>Customer ID</th>
                                            <th hidden>Product ID</th>
                                            <th>Customer Name</th>
                                            <th>Contact No.</th>
                                            <th>Original Price</th>
                                            <th>Sold Price</th>
                                            <th>Profit</th>
                                            <th hidden>Seller ID</th>
                                            <th>Payment Method</th>
                                            <th>Discount</th>
                                            <th>Tax</th>
                                            <th>Shipping Fee</th>
                                            <th>Shipping City</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Remarks</th>
                                            <th>---</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require("config.php");

                                        if (!$conn) {
                                            echo 'failure';
                                            die('Connection failed: ' . mysqli_connect_error());
                                        }

                                        $query = "SELECT * FROM carsales WHERE delStat <> 1";
                                        $result = mysqli_query($conn, $query);
                                        $intCount = 0;
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                            $id = $rows["product_id"];
                                            $cid = $rows["customer_id"];

                                            $sqli = "SELECT * FROM inventory WHERE delStat <> 1 AND ID = $id";
                                            $result1 = mysqli_query($conn, $sqli);
                                            $rows1 = mysqli_fetch_assoc($result1);
                                            $profit = $rows["unit_price"] - $rows1["Price"] ;

                                            $sqlc = "SELECT * FROM customers WHERE delStat <> 1 AND id = $cid";
                                            $resultc = mysqli_query($conn, $sqlc);
                                            $rowsc = mysqli_fetch_assoc($resultc);
                                        ?>
                                            <tr>
                                                <td hidden><?php echo $rows["sales_id"]; ?></td>
                                                <td><?php echo $intCount + 1 ?></td>
                                                <td><?php echo $rows["sales_date"]; ?></td>
                                                <td hidden><?php echo $rows["customer_id"]; ?></td>
                                                <td hidden><?php echo $rows["product_id"]; ?></td>
                                                <td><?php echo $rowsc["name"]; ?></td>
                                                <td><?php echo $rowsc["phone"]; ?></td>
                                                <td><?php echo $rows1["Price"]; ?></td>
                                                <td><?php echo $rows["unit_price"]; ?></td>
                                                <?php
                                                    if($profit < 0)
                                                    {
                                                        ?> <td style="color: red;"><?php echo $profit; ?></td> <?php
                                                    }
                                                    else
                                                    {
                                                        ?> <td style="color: green;"><?php echo $profit; ?></td> <?php
                                                    }
                                                ?>
                                                <td hidden><?php echo $rows["salesperson_id"]; ?></td>
                                                <td><?php echo $rows["payment_method"]; ?></td>
                                                <td><?php echo $rows["discount"]; ?></td>
                                                <td><?php echo $rows["tax"]; ?></td>
                                                <td><?php echo $rows["shipFee"]; ?></td>
                                                <td><?php echo $rows["shipping_address"]; ?></td>
                                                <td><?php echo $rows["order_status"]; ?></td>
                                                <td><?php echo $rows["payment_status"]; ?></td>
                                                <td><?php echo $rows["remarks"]; ?></td>
                                                <td><button class="btnDel" onclick="deleteRow(this)">Delete</button></td>
                                            </tr>
                                        <?php
                                            $intCount++;
                                        }
                                        mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table>
                            <td>
                                <a id="myBtn" href="../PHP/newSalesForm.php" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-plus-sign"></span> New Sales
                                </a>
                            </td>
                        </table>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

</html>