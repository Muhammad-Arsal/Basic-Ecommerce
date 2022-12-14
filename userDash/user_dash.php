<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: ../index.php");
}
$user_id = $_SESSION['user_login'];
$ordered_details = select_where("ordered_products", "user_id", $user_id, $connection, 2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include "commonADMIN/head.php"
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Assistant');

        body {
            background: #eee;
            font-family: Assistant, sans-serif;
        }

        .cell-1 {
            border-collapse: separate;
            border-spacing: 0 4em;
            background: #fff;
            border-bottom: 5px solid transparent;
            /*background-color: gold;*/
            background-clip: padding-box;
        }

        thead {
            background: #dddcdc;
        }

        .toggle-btn {
            width: 40px;
            height: 21px;
            background: grey;
            border-radius: 50px;
            padding: 3px;
            cursor: pointer;
            -webkit-transition: all 0.3s 0.1s ease-in-out;
            -moz-transition: all 0.3s 0.1s ease-in-out;
            -o-transition: all 0.3s 0.1s ease-in-out;
            transition: all 0.3s 0.1s ease-in-out;
        }

        .toggle-btn>.inner-circle {
            width: 15px;
            height: 15px;
            background: #fff;
            border-radius: 50%;
            -webkit-transition: all 0.3s 0.1s ease-in-out;
            -moz-transition: all 0.3s 0.1s ease-in-out;
            -o-transition: all 0.3s 0.1s ease-in-out;
            transition: all 0.3s 0.1s ease-in-out;
        }

        .toggle-btn.active {
            background: blue !important;
        }

        .toggle-btn.active>.inner-circle {
            margin-left: 19px;
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
            <div class="container">
                <h2 class="text-center pt-4"><u>Ordered Products Tracking</u></h2>
                <div class="mt-5">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-10">
                            <div class="rounded">
                                <div class="table-responsive table-borderless">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Company name</th>
                                                <th>status</th>
                                                <th>Total</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                            <?php
                                            if (!empty($ordered_details)) {

                                                foreach ($ordered_details as $all_details) {
                                                    $products_id = $all_details['product_id'];
                                                    $seller_id = select_where("products", "id", $products_id, $connection, 1);
                                                    $seller_updated_id = $seller_id['seller'];
                                                    $seller_name = select_where("seller", "id", $seller_updated_id, $connection, 1);
                                            ?>
                                                    <tr class="cell-1">
                                                        <td>#U-<?php echo $all_details['order_number'] ?></td>
                                                        <td><?php echo $seller_name['seller_name']; ?></td>
                                                        <td><span class="badge badge-success"><?php if ($all_details['status'] == 0) {
                                                                                                    echo "Dispatched";
                                                                                                } elseif ($all_details['status'] == 1) {
                                                                                                    echo "On the way";
                                                                                                } elseif ($all_details['status'] == 2) {
                                                                                                    echo "Delivered";
                                                                                                } ?></span>
                                                        </td>
                                                        <td>$<?php echo $all_details['total_price'] ?></td>
                                                        <td><?php echo $all_details['created_on'] ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>