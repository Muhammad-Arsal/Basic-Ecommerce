<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$affiliate_member_id = $_GET['id'];

$count_orders = select_where("ordered_products", "affiliate_user_id", $affiliate_member_id, $connection, 2);


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
                            <th scope="col">Customer Name</th>
                            <th scope="col">Product Purchased</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($count_orders)) {
                            foreach ($count_orders as $all_orders) {
                                $product_id = $all_orders['product_id'];
                                $name_of_product = select_where("products", "id", $product_id, $connection, 1);

                                $user_id = $all_orders['user_id'];
                                $name_of_customer = select_where("user_credentials", "id", $user_id, $connection, 1);
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $name_of_customer['name']; ?></td>
                                    <td><?php echo $name_of_product['product_name'] ?></td>
                                    <td><?php echo $all_orders['quantity']; ?></td>
                                </tr>
                        <?php }
                        } ?>
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