<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
if (isset($_POST['submit'])) {
    if (empty($_POST['parent_cat'])) {
        $_POST['parent_cat'] = 0;
    }
    $main_array = array(
        "name" => $_POST['cat_name'],
        "parent_id" => $_POST['parent_cat'],
    );

    insert_func("category", $main_array, $connection);
    header("location: category.php");
}
$all_cat = select_all("category", $connection);
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
                <form action="addcategory.php" method="POST">
                    <div class="form-group">
                        <label for="">Enter category</label>
                        <input id="" class="form-control" type="text" name="cat_name" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <label for="">Parent Category</label>
                        <div class="form-group">
                            <select class="custom-select" name="parent_cat" id="">
                                <option selected>Parent Category</option>
                                <?php
                                foreach ($all_cat as $detail_Cat) {
                                ?>
                                    <option value="<?php echo $detail_Cat['id']; ?>"><?php echo $detail_Cat['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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