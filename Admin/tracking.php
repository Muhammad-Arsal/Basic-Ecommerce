<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$customer_name = select_all("ordered_products", $connection);
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

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
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
                <div class="container table-responsive py-5">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Ordered Product</th>
                                <th scope="col">Dispatched</th>
                                <th scope="col">On the way</th>
                                <th scope="col">Delivered</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($customer_name as $all_data) {
                                $products_id = $all_data['product_id'];
                                $product_name = select_where("products", "id", $products_id, $connection, 1);
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo "O-" . $all_data['order_id']; ?></td>
                                    <td><?php echo $product_name['product_name']; ?></td>
                                    <div class="main">
                                        <td>
                                            <label class="switch">
                                                <input class="status" data-id="<?php echo $all_data['product_id']; ?>" value="<?php echo 0; ?>" type="checkbox" <?php if ($all_data['status'] == 0) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input class="status" data-id="<?php echo $all_data['product_id']; ?>" value="<?php echo 1; ?>" type="checkbox" <?php if ($all_data['status'] == 1) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input class="status" data-id="<?php echo $all_data['product_id']; ?>" value="<?php echo 2; ?>" type="checkbox" <?php if ($all_data['status'] == 2) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

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
    require_once "commonADMIN/commonfooter.php";
    ?>
    <script>
        $(function() {

            $(".status").click(function() {
                var this_checkbox = $(this);
                var main_class = $(this_checkbox).parent().parent().parent().find(".status");
                console.log(main_class);
                var id = $(this).val();
                var product_id = $(this).data('id');
                $.ajax({
                    type: 'post',
                    url: "track_record.php",
                    data: {
                        status: id,
                        existing_product: product_id,
                    },
                    success: function(response) {
                        console.log(response);
                        $(main_class).each(function() {
                            $(main_class).prop('checked', false);
                        })
                        $(this_checkbox).prop('checked', true);
                    }
                })
            })
        });
    </script>
</body>

</html>