<?php
require_once "../core/database.php";
$products = select_all("products", $connection);

if (isset($_POST['submit'])) {
    $which_one = $_POST['which_product'];
    $how_many = $_POST['how_many'];

    $already_stock_query = select_where("seller_products", "product_id", $which_one, $connection, 1);
    $already_stock = $already_stock_query['stock'];

    $details_array = array(
        "stock" => $already_stock - $how_many,
    );
    $id_array = array(
        "product_id" => $which_one,
    );

    update("seller_products", $details_array, $id_array, $connection);
    header("location: index.php");
}
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
            <div class="container">
                <h2 class="pt-3 mb-5">Defective Pieces</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Text</label>
                        <select id="" class="form-control" name="which_product">
                            <option value="">Select Product</option>
                            <?php
                            foreach ($products as $sell) {
                            ?>
                                <option value="<?php echo $sell['id']; ?>"><?php echo $sell['product_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Enter how many defective pieces</label>
                        <input id="" class="form-control" type="text" name="how_many">
                    </div>
                    <button class="btn btn-success" name="submit">Submit</button>
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