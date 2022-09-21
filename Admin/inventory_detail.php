<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include "commonADMIN/head.php"
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        require_once "commonADMIN/sidebar.php"
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">
                <div class="container table-responsive py-5">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Cost price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Worth</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_products = select_all("seller_products", $connection);
                            $i = 1;
                            $total = 0;
                            foreach ($all_products as $showing_all) {
                                $product_id = $showing_all['product_id'];
                                $product_name = select_where("products", "id", $product_id, $connection, 1);
                                $now_name = $product_name['product_name'];
                                $total += $showing_all['stock'] * $showing_all['cost_price'];

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $now_name; ?></td>
                                    <td><?php echo $showing_all['cost_price']; ?></td>
                                    <td><?php echo $showing_all['stock']; ?></td>
                                    <td><?php echo $showing_all['stock'] * $showing_all['cost_price'] . " $"; ?></td>
                                    <td><a href="" class="btn btn-success">Details</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr class="bg-dark">
                                <td colspan="5">Total</td>
                                <td><?php echo $total; ?> $</td>
                            </tr>
                        </tbody>
                    </table>
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
    require_once "commonADMIN/footer.php";
    ?>
    <?php
    require_once "commonADMIN/commonfooter.php";
    ?>
</body>

</html>