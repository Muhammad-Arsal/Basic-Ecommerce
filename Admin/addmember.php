<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
if (isset($_POST['save'])) {
    $main_array_member = array(
        "name" => $_POST['newname'],
    );


    insert_func("affiliate_member", $main_array_member, $connection);
    header("location: all_member.php");
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
                <div>
                    <h3 class="pb-5 text-center"><u>Add new member</u></h3>
                </div>
                <form action="addmember.php" method="POST">
                    <div class="form-group">
                        <label for="">Name of new Affiliate member</label>
                        <input id="" class="form-control" type="text" name="newname">
                    </div>
                    <button name="save" type="submit" class="btn btn-primary">Save</button>
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