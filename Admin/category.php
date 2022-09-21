<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}

$all_data = select_all("category", $connection);

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
                <a href="addcategory.php"> <button class="btn btn-primary float-right my-3">Add new Category</button></a>
            </div>
            <div class="container table-responsive py-2">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Parent Category</th>
                            <th scope="col">Created on</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($all_data as $cat_data) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $cat_data['name']; ?></td>
                                <td><?php
                                    $cat_id = $cat_data['parent_id'];
                                    if ($cat_id != 0) {
                                        $now = select_where("category", "id", $cat_id, $connection, 1);
                                        echo $now['name'];
                                    } elseif ($cat_id == 0) {
                                        $now = "No parent";
                                        echo $now;
                                    } ?></td>
                                <td><?php echo $cat_data['created_at']; ?></td>
                                <td>
                                    <a href="edit_category.php?id=<?php echo $cat_data['id']; ?>"> <i class="fa fa-pencil"></i></a>
                                    <a href="delete_category.php?id=<?php echo $cat_data['id']; ?>"><i class="fa fa-trash"></i></a>
                                </td>
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