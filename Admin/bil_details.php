<?php
require_once "../core/database.php";
session_start();
if (!isset($_SESSION['uid']) && !isset($_COOKIE['remember_me'])) {

    header("location: login.php");
}
$getted_string = $_GET['id'];
$que = "SELECT * FROM billing_details WHERE bill_no = '$getted_string'";
$result = mysqli_query($connection, $que);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include "commonADMIN/head.php"
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        require_once "commonADMIN/sidebar.php"
        ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="page-content container">
                    <div class="page-header text-blue-d2">
                        <h1 class="page-title text-secondary-d1">
                            Bill No.
                            <small class="page-info">
                                <i class="fa fa-angle-double-right text-80"></i>
                                ID: <?php echo $getted_string; ?>
                            </small>
                        </h1>


                    </div>

                    <div class="container px-0">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center text-150">
                                            <h3>Supplier:
                                                <?php
                                                foreach ($data as $new_data) {
                                                    $prod_name = $new_data['product_name'];

                                                    $id_of_supplier = select_where_string("products", "product_name", $prod_name, $connection, 1);

                                                    $name_of_supplier = $id_of_supplier['seller'];

                                                    $main_data = select_where("seller", "id", $name_of_supplier, $connection, 1);

                                                ?>
                                                    <span class="text-warning"><?php echo $main_data['seller_name']; ?></span>
                                                <?php break;
                                                } ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- .row -->

                                <hr class="row brc-default-l1 mx-n1 mb-4" />

                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <!-- /.col -->

                                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                        <hr class="d-sm-none" />
                                        <div class="text-grey-m2">
                                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                                Bill no.
                                            </div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #<?php echo $getted_string; ?></div>

                                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span><?php
                                                                                                                                                                        foreach ($data as $date) {
                                                                                                                                                                            echo date('d M Y', strtotime($date['created_on']));
                                                                                                                                                                            break;
                                                                                                                                                                        }
                                                                                                                                                                        ?></div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="mt-4">
                                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                                        <div class="d-none d-sm-block col-1">#</div>
                                        <div class="col-9 col-sm-5">Product Name</div>
                                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                                        <div class="col-2">Amount</div>
                                    </div>

                                    <div class="text-95 text-secondary-d3">
                                        <?php $i = 1;
                                        $total_of_all = 0;
                                        foreach ($data as $bills) {
                                            $total_of_each = $bills['stock'] * $bills['cost_price'];
                                            $total_of_all += $total_of_each; ?>
                                            <div class="row mb-2 mb-sm-0 py-25">
                                                <div class="d-none d-sm-block col-1"><?php echo $i++; ?></div>
                                                <div class="col-9 col-sm-5"><?php echo $bills['product_name']; ?></div>
                                                <div class="d-none d-sm-block col-2"><?php echo $bills['stock']; ?></div>
                                                <div class="d-none d-sm-block col-2 text-95">$<?php echo $bills['cost_price'] ?></div>
                                                <div class="col-2 text-secondary-d2">$<?php echo $total_of_each; ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row border-b-2 brc-default-l2"></div>


                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        </div>

                                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    SubTotal
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-120 text-secondary-d1">$<?php echo $total_of_all; ?></span>
                                                </div>
                                            </div>
                                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                                <div class="col-7 text-right">
                                                    Total Amount
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-150 text-success-d3 opacity-2">$<?php echo $total_of_all; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr />

                                    <div>
                                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Content Wrapper. Contains page content -->
        <!-- <div class="content-wrapper">
            <div class="container">
                <h2 class="pt-4 text-primary">Bill Number: <?php echo $getted_string; ?></h2>

                
                <div class="container table-responsive py-2">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Cost price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $total_of_all = 0;
                            foreach ($data as $bills) {
                                $total_of_each = $bills['stock'] * $bills['cost_price'];
                                $total_of_all += $total_of_each;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>

                                    <td><?php echo $bills['product_name']; ?></td>

                                    <td><?php echo $bills['stock']; ?></td>

                                    <td><?php echo $bills['cost_price'] ?></td>

                                    <td><?php echo $total_of_each; ?></td>
                                </tr>

                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4">Sub Total</td>
                                <td><?php echo $total_of_all; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div> -->
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
</body>

</html>