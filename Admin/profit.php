<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {
    header("location: login.php");
}

$total_orders_add_up = 0;
$total_of_all = 0;
$total_of_bills = 0;
$already_sale_items = 0;

$total = select_all("seller_products", $connection);
$total_bills = select_all("ordered_products", $connection);
$total_expenses = select_all("monthly_expenses", $connection);

if (!empty($total)) {
    foreach ($total as $all_total) {
        $total_of_all += $all_total['cost_price'] * $all_total['stock'];
    }
}

if (!empty($total_bills)) {
    foreach ($total_bills as $bills) {
        $products_id = $bills['product_id'];

        $cp = select_where("seller_products", "product_id", $products_id, $connection, 1);

        $actual_cost_price = $cp['cost_price'];

        $already_sale_items += $actual_cost_price;

        $total_orders_add_up += $bills['total_price'];
    }
}

if (!empty($total_expenses)) {
    foreach ($total_expenses as $all_expenses) {
        $total_of_bills += $all_expenses['bills'] + $all_expenses['miscellaneous_expense'] + $all_expenses['tax'] + $all_expenses['transport'];
    }
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
            <div class="container-fluid">
                <h2 class="pt-5"><u>Profit Ratio Till Now</u></h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Expenses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Worth of Inventory</td>
                            <td><?php echo $total_of_all; ?> $</td>
                        </tr>
                        <tr>
                            <td>Bills Paid Till now</td>
                            <td><?php echo $total_of_bills;  ?> $</td>
                        </tr>
                        <tr>
                            <td>Sales till Now</td>
                            <td><?php echo $already_sale_items;  ?> $</td>
                        </tr>
                        <tr>
                            <td>Total Net Profit</td>
                            <td><?php echo ($total_orders_add_up - $already_sale_items - $total_of_bills);   ?> $</td>
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