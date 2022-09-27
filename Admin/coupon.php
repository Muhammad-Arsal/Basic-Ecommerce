<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}

$how_many_coupons = select_all("coupon", $connection);

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
            <div class="container">
                <a href="addcoupon.php"> <button class="btn btn-primary float-right my-3">Add new Coupon</button></a>
            </div>

            <div class="container table-responsive py-2">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Coupon Number</th>
                            <th scope="col">% of reduction</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($how_many_coupons)) {

                            foreach ($how_many_coupons as $all_details) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $all_details['coupon_number'] ?></td>
                                    <td><?php echo $all_details['reduce_percentage'] . "% off" ?></td>
                                    <td><?php if ($all_details['status'] == 1) {
                                            echo "Enabled";
                                        } else {
                                            echo "Disabled";
                                        } ?></td>
                                    <td>
                                        <a href="editcoupon.php?id=<?php echo $all_details['id']; ?>"> <i class="fa fa-pencil"></i></a>
                                        <a href="deletecoupon.php?id=<?php echo $all_details['id']; ?>"><i class="fa fa-trash"></i></a>
                                    </td>
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