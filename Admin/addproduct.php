<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $temp = explode(".", $image);
    $newfilename = time() . "." . end($temp);
    $directory = "../productimages/";

    $date = date('Y-m-d H:i:s');


    $det = array(
        "product_name" => $_POST['name'],
        "product_image" => $newfilename,
        "product_description" => $_POST['description'],
        "product_details" => $_POST['details'],
        "arrived_at" => $date,
        "category_id" => $_POST['cat'],
        "seller" => $_POST['seller'],
    );

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $directory . $newfilename)) {
        insert_func("products", $det, $connection);
        header("location: products.php");
    }
}

$categories = select_all("category", $connection);
$sellers = select_all("seller", $connection);

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
            <div class="container pt-2 pb-5">
                <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input id="" class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="custom-select" name="cat">
                            <option value="">Select Category</option>
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $val) {
                            ?>

                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Select Supplier</label>
                        <select class="custom-select" name="seller" id="">
                            <option value="">Select Supplier</option>
                            <?php
                            if (!empty($sellers)) {
                                foreach ($sellers as $new_val) {
                            ?>
                                    <option value="<?php echo $new_val['id'] ?>"><?php echo $new_val['seller_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input id="" class="form-control" type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <input id="" class="form-control" type="text" name="description">
                    </div>
                    <div class="form-group">
                        <label for="">Product Details</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="details"></textarea>
                    </div>


                    <button class="btn btn-primary" name="submit">Submit</button>
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