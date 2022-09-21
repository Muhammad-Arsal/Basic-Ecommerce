<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}

$prodVal = select_all("products", $connection);

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
                <a href="addproduct.php"> <button class="btn btn-primary float-right my-3">Add new Products</button></a>
            </div>


            <div class="container table-responsive py-1">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Category</th>
                            <th scope="col">Cost price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($prodVal as $values) {

                            $prod_id = $values['category_id'];
                            $catVal = select_where("category", "id", $prod_id, $connection, 1);
                            $current_id = $values['id'];
                            $new_seller_values = select_where("seller_products","product_id",$current_id,$connection,1);

                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><img src="<?php echo '../productimages/' . $values['product_image']; ?>" style="width: 100px; height: 100px;" alt=""></td>
                                <td><?php echo $values['product_name']; ?></td>
                                <td><?php echo $values['product_description']; ?></td>
                                <td><?php if(!empty($new_seller_values['stock'])){echo $new_seller_values['stock'];}else{
                                    echo 0;
                                }  ?></td>
                                <td><?php echo $catVal['name']; ?></td>
                                <td><?php if(!empty($new_seller_values['cost_price'])){echo $new_seller_values['cost_price']; }else{
                                    echo 0;
                                } ?></td>
                                <td>
                                    <a href="editproducts.php?id=<?php echo $values['id']; ?>"> <i class="fa fa-pencil"></i></a>
                                    <a href="deleteproduct.php?id=<?php echo $values['id']; ?>"><i class="fa fa-trash"></i></a>
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