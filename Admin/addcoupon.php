<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 7; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}

if (isset($_POST['submit'])) {
    $main_array = array(
        "orders" => $_POST['order'],
        "reduce_percentage" => $_POST['percentage'],
        "status" => $_POST['status'],
        "coupon_number" => $_POST['coupon_number'],
    );

    insert_func("coupon", $main_array, $connection);
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
                <form action="addcoupon.php" method="post">
                    <div class="form-group">
                        <label for="">On how many orders?</label>
                        <input id="" class="form-control" type="text" name="order">
                    </div>
                    <div class="form-group">
                        <label for="">Reduce Percentage</label>
                        <input id="" class="form-control" type="text" name="percentage">
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <select class="custom-select" name="status" id="">
                            <option value="">Select Coupon Status</option>
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Coupon Number</label>
                        <input id="" value="<?php echo $randomString ?>" class="form-control" type="text" name="coupon_number" readonly>
                    </div>

                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
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