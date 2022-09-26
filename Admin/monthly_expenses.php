<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
if (isset($_POST['submit'])) {

    $expenses_array = array(
        "bills" => $_POST['bills'],
        "miscellaneous_expense" => $_POST['m_expenses'],
        "tax" => $_POST['tax'],
        "transport" => $_POST['transport'],
    );

    insert_func("monthly_expenses", $expenses_array, $connection);
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
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Bills</label>
                        <input id="" class="form-control" type="text" name="bills">
                    </div>
                    <div class="form-group">
                        <label for="">Miscellaneous expense</label>
                        <input id="" class="form-control" type="text" name="m_expense">
                    </div>
                    <div class="form-group">
                        <label for="Taxes">Taxes Paid</label>
                        <input id="Taxes" class="form-control" type="text" name="tax">
                    </div>
                    <div class="form-group">
                        <label for="">Transportation</label>
                        <input id="" class="form-control" type="text" name="transport">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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