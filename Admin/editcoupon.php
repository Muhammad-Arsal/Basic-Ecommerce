<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$id = $_GET['id'];
$previous_data = select_where("coupon", "id", $id, $connection, 1);

if (isset($_POST['update'])) {
    $main_array = array(
        "orders" => $_POST['order'],
        "reduce_percentage" => $_POST['percentage'],
        "status" => $_POST['status'],
        "coupon_number" => $_POST['coupon_number'],
    );
    $id_array = array(
        "id" => $id,
    );
    update("coupon", $main_array, $id_array, $connection);
    header("location: coupon.php");
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
            <div class="container pt-5">
                <form action="editcoupon.php?id=<?php echo $id ?>" method="post">
                    <div class="form-group">
                        <label for="">On how many orders?</label>
                        <input id="" class="form-control" type="text" name="order" value="<?php echo $previous_data['orders'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Reduce Percentage</label>
                        <input id="" class="form-control" type="text" name="percentage" value="<?php echo $previous_data['reduce_percentage'] ?>">
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <select class="custom-select" name="status" id="">
                            <option value="">Select Coupon Status</option>
                            <option <?php if ($previous_data['status'] == 1) {
                                        echo "selected";
                                    } ?> value="1">Enabled</option>
                            <option <?php if ($previous_data['status'] == 0) {
                                        echo "selected";
                                    } ?> value="0">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Coupon Number</label>
                        <input id="" value="<?php echo $previous_data['coupon_number'] ?>" class="form-control" type="text" name="coupon_number" readonly>
                    </div>

                    <button name="update" type="submit" class="btn btn-primary">Update</button>
                </form>
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