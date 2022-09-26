<?php
require_once "../core/config.php";
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$products = select_all("products", $connection);
$sellers = select_all("seller", $connection);

$billing = "SELECT * FROM `billing_details` ORDER BY `id` DESC";
$results = mysqli_query($connection, $billing);
if (mysqli_num_rows($results) > 0) {
    while ($main_row = mysqli_fetch_assoc($results)) {
        $data_array[] = $main_row;
    }
    $data_array = array_shift($data_array);
}
if ($data_array['bill_no']) {
    $bill_noo = $data_array['bill_no'];
    $last_number = substr($bill_noo, 6);
    $new_lastnumber = ++$last_number;
    $bill_number = $COMPANY_NAME . "_" . "00" . $new_lastnumber;
} else {
    $bill_number = $COMPANY_NAME . "_" . "001";
}


if (isset($_POST['submit'])) {
    $i = 0;
    foreach ($_POST['seller_id'] as $item) {
        $seller_products_array = array(
            "seller_id" => $item,
            "product_id" => $_POST['product_id'][$i],
            "stock" => $_POST['stock'][$i],
            "cost_price" => $_POST['cp'][$i],
            "sale_price" => $_POST['cp'][$i] * $_POST['tax'][$i] / 100,
        );

        $iid = $_POST['product_id'][$i];

        $p_name = select_where("products", "id", $iid, $connection, 1);
        $existing_name = $p_name['product_name'];

        $already_stock = select_where("seller_products", "product_id", $iid, $connection, 1);
        $new_already_stock = $already_stock['stock'];

        $billing_array = array(
            "product_name" => $existing_name,
            "stock" => $_POST['stock'][$i],
            "bill_no" => $bill_number,
            "cost_price" => $_POST['cp'][$i],
        );

        if ($already_stock) {
            $update_array = array(
                "stock" => $new_already_stock + $_POST['stock'][$i],
            );
            $id_array = array(
                "product_id" => $iid,
            );

            $already_name = select_where("products", "id", $iid, $connection, 1);
            $nameee = $already_name['product_name'];

            $product_name = array(
                "product_name" => $nameee
            );
            update("seller_products", $update_array, $id_array, $connection);
            insert_func("billing_details", $billing_array, $connection);
        } else {
            insert_func("seller_products", $seller_products_array, $connection);
            insert_func("billing_details", $billing_array, $connection);
        }

        $i++;
    }
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
                <h2 class="pt-3 mb-5">Supplier Dashboard</h2>
                <form action="" method="post" class="supplier_form">
                    <div class="main_wrapper">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Supplier</label>
                                    <select class="custom-select seller_selection" name="seller_id[]">
                                        <option value="">Choose Supplier</option>
                                        <?php
                                        foreach ($sellers as $sell) {
                                        ?>
                                            <option value="<?php echo $sell['id']; ?>"><?php echo $sell['seller_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Bill Number</label>
                                    <input id="" class="form-control" type="text" name="" readonly value="<?php echo $bill_number; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row copied_form">
                            <div class="col-3 ">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <select class="custom-select custom2" name="product_id[]" id="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="Stock">Stock</label>
                                    <input id="Stock" class="form-control stock" type="text" name="stock[]">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group ">
                                    <label for="cost_price">Cost Price</label>
                                    <input id="cost_price" class="form-control cp" type="text" name="cp[]">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Tax %</label>
                                    <input id="" class="form-control" type="text" name="tax[]">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Total</label>
                                    <input id="" class="form-control total" type="text" name="total" readonly>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label class="">Action</label>
                                    <br>
                                    <i style="display: block;" class="fas fa-plus add_button"></i><i style="display: none;" class="fas fa-trash trash_button"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row subs">
                            <div class="col-8">
                                <h3 class="float-right">Sub total</h3>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input id="" class="form-control sub_total" type="text" name="sub_total" readonly value="-">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success float-right" name="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- <div class="container">
                <div class="main_wrapper">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <select class="custom-select seller_selection" name="seller_id[]">
                                    <option value="">Choose Supplier</option>
                                    <?php
                                    foreach ($sellers as $sell) {
                                    ?>
                                        <option value="<?php echo $sell['id']; ?>"><?php echo $sell['seller_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Bill Number</label>
                                <input id="" class="form-control" type="text" name="" readonly value="<?php echo $bill_number; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <select class="custom-select custom2" name="product_id[]" id="">
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="Stock">Stock</label>
                                <input id="Stock" class="form-control stock" type="text" name="stock[]">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group ">
                                <label for="cost_price">Cost Price</label>
                                <input id="cost_price" class="form-control cp" type="text" name="cp[]">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input id="" class="form-control" type="text" name="total">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label class="">Action</label>
                                <br>
                                <i style="display: block;" class="fas fa-plus"></i><i style="display: none;" class="fas fa-trash"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h3 class="float-right">Sub total</h3>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input id="" class="form-control" type="text" name="sub_total" readonly value="8978789">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success float-right">Save</button>
                    </div>
                </div>
            </div> -->
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
        $(document).ready(function() {
            var button = $(".form-button").clone(true, true);
            $(".seller_selection").on('change', function() {
                var value = $(this).val();
                var man = $(this).parent().parent().parent().next().find("select.custom2");
                $(man).empty();
                $.ajax({
                    type: 'post',
                    url: 'seller_products.php',
                    data: {
                        seller_id: value,
                    },
                    success: function(response) {
                        const obj = JSON.parse(response);
                        $(obj).each(function(index, element) {
                            $(man).append(
                                '<option value=' + element.id + '>' + element.product_name + '</option>'
                            );
                        })
                    }
                })
            })

            $(".add_button").click(function() {
                var this_button = $(this);
                var trash = $(this_button).siblings();

                var distinct_form = $(this_button).parent().parent().parent();

                var form_html = $(distinct_form).clone(true, true);

                var stock = $(form_html).find(".stock");
                var cp = $(form_html).find(".cp");
                var total = $(form_html).find(".total");


                $(stock).val('');
                $(cp).val('');
                $(total).val('');

                $(".subs").before(form_html);
                $(this_button).css("display", "none");
                $(trash).css("display", "block");
            })

            $(".trash_button").click(function() {
                var this_button = $(this);
                var distinct_form = $(this_button).parent().parent().parent();


                var delete_main = $(this_button).parent().parent().parent().find(".total");
                var delete_value = $(delete_main).val();
                var parsed_delete_value = parseInt(delete_value);

                var sub_main = $(this_button).parent().parent().parent().parent().find(".sub_total");
                var sub_value = $(sub_main).val();
                var parsed_sub_value = parseInt(sub_value);

                $(".sub_total").val(parsed_sub_value - parsed_delete_value);

                $(distinct_form).remove();
            })


            $(".stock").on('input', function() {
                var this_stock = $(this);
                var current_value = $(this_stock).val();

                var cost_price_val = $(this).parent().parent().next().find(".cp");
                var value_cp = $(cost_price_val).val();


                if ($.isNumeric(current_value) && $.isNumeric(value_cp)) {
                    var total_price_val = $(this).parent().parent().next().next().next().find(".total");
                    $(total_price_val).val(value_cp * current_value);
                } else {
                    var total_price_val = $(this).parent().parent().next().next().next().find(".total");
                    $(total_price_val).val('');
                }

                var sum = 0;
                $(".total").each(function(index, element) {
                    var man = parseInt($(element).val());
                    if ($.isNumeric(man)) {
                        sum += man;
                        $(".sub_total").val(sum);
                    } else {
                        $(".sub_total").val('');

                    }
                })
            })

            $(".cp").on('input', function() {
                var this_cp = $(this);
                var current_value = $(this_cp).val();

                var stock = $(this).parent().parent().prev().find(".stock");
                var stock_value = $(stock).val();

                if ($.isNumeric(current_value) && $.isNumeric(stock_value)) {
                    var total_price_val = $(this).parent().parent().next().next().find(".total");
                    console.log(total_price_val);
                    $(total_price_val).val(stock_value * current_value);
                } else {
                    var total_price_val = $(this).parent().parent().next().next().find(".total");
                    $(total_price_val).val('');
                }
                var sum = 0;
                $(".total").each(function(index, element) {
                    var man = parseInt($(element).val());
                    if ($.isNumeric(man)) {
                        sum += man;
                        $(".sub_total").val(sum);
                    } else {
                        $(".sub_total").val('');

                    }
                })
            })


        });
    </script>
</body>

</html>