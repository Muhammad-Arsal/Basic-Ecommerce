<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: ../index.php");
}
if (isset($_SESSION['user_login'])) {
    $current_id = $_SESSION['user_login'];
}

$avail = select_where("user_coupon", "user_id", $current_id, $connection, 2);
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
            <div class="container table-responsive py-5">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Coupon Number</th>
                            <th scope="col">Relaxation</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($avail)) {
                            foreach ($avail as $all) {
                                $coupon_id = $all['coupon_id'];
                                $all_details_coupon = select_where("coupon", "id", $coupon_id, $connection, 1);
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $all_details_coupon['coupon_number']; ?></td>
                                    <td><?php echo $all_details_coupon['reduce_percentage'] . " % off"; ?></td>
                                    <td><?php if ($all_details_coupon['status'] == 1) {
                                            echo "Available";
                                        } else {
                                            echo "Expired";
                                        } ?></td>
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