<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$key = $_GET['id'];
$already_data = select_where("category", "id", $key, $connection, 1);
$new_key = $already_data['parent_id'];
$all_cat = select_all("category", $connection);
if (isset($_POST['update'])) {
    if (empty($_POST['parent_cat'])) {
        $_POST['parent_cat'] = 0;
    }
    $main_data = array(
        "name" => $_POST['catname'],
        "parent_id" => $_POST['parent_cat'],
    );

    $id_data = array(
        "id" => $key
    );

    update("category", $main_data, $id_data, $connection);
    header("location: category.php");
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

            <div class="container pt-4">
                <form action="edit_category.php?id=<?php echo $key; ?>" method="post">
                    <div class="form-group">
                        <label for="">Edit Category Name</label>
                        <input id="" class="form-control" type="text" name="catname" placeholder="Category name" value="<?php echo $already_data['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Parent Category</label>
                        <div class="form-group">
                            <select class="custom-select" name="parent_cat" id="">
                                <option>Parent Category</option>
                                <?php
                                foreach ($all_cat as $detail_Cat) {
                                ?>
                                    <option <?php if ($detail_Cat['id'] == $new_key) {
                                                echo "selected";
                                            } ?> value="<?php echo $detail_Cat['id']; ?>"><?php echo $detail_Cat['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
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