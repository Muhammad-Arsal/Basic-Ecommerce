<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$all_members = select_all("affiliate_member", $connection);
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
                <form action="">
                    <div class="form-group">
                        <label for="">Select Affiliate Member</label>
                        <select class="custom-select selectName" name="" id="">
                            <option value="">Select one</option>
                            <?php foreach ($all_members as $all) { ?>
                                <option value="<?php echo $all['id']; ?>"><?php echo $all['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Generated URL</label>
                        <input id="" value="" class="form-control url" type="text" name="" readonly>
                    </div>
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
    <script>
        $(function() {
            $(".selectName").on("change", function() {
                var current_val = $(".selectName").val();
                var new_url = "http://localhost/Ecommerce/register_affiliate.php?id=" + current_val;
                console.log(new_url);
                $(".url").val(new_url);
            })
        });
    </script>
</body>

</html>