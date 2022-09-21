<?php
require_once "../core/database.php";
if (isset($_POST['seller_id'])) {
    $main_id = $_POST['seller_id'];
    $main_array = select_where("products", "seller", $main_id, $connection, 2);
    print_r(json_encode($main_array));
}
