<?php
require_once "./core/database.php";

if (isset($_POST['coupon_number'])) {
    $existed_number = $_POST['coupon_number'];

    $check_wether_exist = select_where_string("coupon", "coupon_number", $existed_number, $connection, 1);

    if (!empty($check_wether_exist)) {
        if ($check_wether_exist['status'] == 1) {
            $new = $check_wether_exist['reduce_percentage'];
            echo $new;
        } else {
            echo 0;
        }
    }
}
