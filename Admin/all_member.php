<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$all_affiliate_member = select_all("affiliate_member", $connection);
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
                <div class="col-12">
                    <div class="row float-right pt-3">
                        <a href="generate_affiliate.php" class="btn btn-primary">Generate URL</a>
                        <a href="addmember.php" class="ml-2 btn bg-gradient-primary">Add Affiliate Member</a>
                    </div>
                </div>
            </div>

            <div class="container table-responsive py-2">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_affiliate_member)) {
                            foreach ($all_affiliate_member as $all) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><a href=""><?php echo $all['name'] ?></a></td>
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