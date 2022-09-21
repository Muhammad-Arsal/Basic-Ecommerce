<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}

$que = "SELECT products.product_name, order_details.first_name, order_details.last_name, order_details.phone_number, order_details.email, 
order_details.country_id,order_details.address,order_details.postal_code,order_details.city, ordered_products.order_number, ordered_products.quantity,
ordered_products.total_price 
FROM order_details 
INNER JOIN ordered_products ON ordered_products.order_id = order_details.id 
INNER JOIN products ON ordered_products.product_id = products.id;";

$result = mysqli_query($connection, $que);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
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

            <div class="container table-responsive py-5">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Id</th>
                            <th scope="col">Ordered Products</th>
                            <th scope="col">Prices</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">City</th>
                            <th scope="col">Address</th>
                            <th scope="col">Postal code</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $all_details) {
                            $keyy = $all_details['country_id'];
                            $name = select_where("country_name", "id", $keyy, $connection, 1);
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $all_details['order_number']; ?></td>
                                <td><?php echo $all_details['product_name']; ?></td>
                                <td><?php echo $all_details['total_price']; ?></td>
                                <td><?php echo $all_details['quantity']; ?></td>
                                <th><?php echo $all_details['first_name'] . ' ' . $all_details['last_name']; ?></th>
                                <th><?php echo $name['name']; ?></th>
                                <th><?php echo $all_details['city'] ?></th>
                                <th><?php echo $all_details['address']; ?></th>
                                <th><?php echo $all_details['postal_code']; ?></th>
                            </tr>
                        <?php
                        }
                        ?>
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