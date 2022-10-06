<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$affiliate_member_id = $_GET['id'];
$count_orders_number = 0;
$count_register_number = 0;

$count_register = select_where("user_credentials", "affiliate_id", $affiliate_member_id, $connection, 2);
if (!empty($count_register)) {
    $count_register_number = count($count_register);
}

$count_orders = select_where("ordered_products", "affiliate_user_id", $affiliate_member_id, $connection, 2);
if (!empty($count_orders)) {
    $count_orders_number = count($count_orders);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/28530d02a0.js" crossorigin="anonymous"></script>
    <?php

    include "commonADMIN/head.php"
    ?>
    <style>
        th {
            white-space: nowrap;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        require_once "commonADMIN/sidebar.php"
        ?>
        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">


            <div class="container table-responsive py-5">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Description</th>
                            <th scope="col">Total numbers</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Total number of registered users</td>
                            <td><?php echo $count_register_number; ?></td>
                            <td><a href="detail_affiliate_register_table.php?id=<?php echo $affiliate_member_id ?>" class="btn btn-success">Details</a></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Total number of Product sell with affiliate id</td>
                            <td><?php echo $count_orders_number; ?></td>
                            <td><a href="detail_affiliate_order_table.php?id=<?php echo $affiliate_member_id ?>" class="btn btn-success">Details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php
    require_once "commonADMIN/footer.php";
    ?>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>