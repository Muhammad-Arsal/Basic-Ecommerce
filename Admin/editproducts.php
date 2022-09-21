<?php
$p_id = $_GET['id'];
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$categories = select_all("category", $connection);
$sellers = select_all("seller", $connection);

$product_detail = select_where("products", "id", $p_id, $connection, 1);

$error = true;
if (isset($_POST['update'])) {

    $image = $_FILES['image']['name'];
    $directory = "../productimages/";


    if ($image && $product_detail['product_image']) {
        $temp = explode(".", $image);
        $newfilename = time() . "." . end($temp);
        unlink("../productimages/" . $product_detail['product_image']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $directory . $newfilename)) {
            $error =  false;
        }
    } else {
        $newfilename = $product_detail['product_image'];
    }
    $det = array(
        "product_name" => $_POST['name'],
        "product_image" => $newfilename,
        "product_description" => $_POST['description'],
        "product_details" => $_POST['details'],
        "category_id" => $_POST['cat'],
        "seller" => $_POST['seller'],
    );

    $condidtion = array("id" => $p_id);
    if ($error) {
        update("products", $det, $condidtion, $connection);
        header("location: products.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/28530d02a0.js" crossorigin="anonymous"></script>
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
                <form action="editproducts.php?id=<?php echo $p_id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input id="" class="form-control" type="text" name="name" value="<?php echo $product_detail['product_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="custom-select" name="cat">
                            <option value="">Select Category</option>
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $val) {
                            ?>

                                    <option <?php if ($val['id'] == $product_detail['category_id']) {
                                                print "selected";
                                            } ?> value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Select Supplier</label>
                        <select class="custom-select" name="seller">
                            <option value="">Select Supplier</option>
                            <?php
                            if (!empty($sellers)) {
                                foreach ($sellers as $new_val) {
                            ?>

                                    <option <?php if ($new_val['id'] == $product_detail['seller']) {
                                                print "selected";
                                            } ?> value="<?php echo $new_val['id']; ?>"><?php echo $new_val['seller_name']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input id="" class="form-control" type="file" name="image">
                        <img src="<?php echo "../productimages/" . $product_detail['product_image'] ?>" alt="" style="width: 100px; height: 100px;" class="mt-2">
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <input id="" class="form-control" type="text" name="description" value="<?php echo $product_detail['product_description']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Product Details</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="details"><?php echo $product_detail['product_details']; ?></textarea>
                    </div>

                    <button class="btn btn-primary" name="update">Update</button>
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