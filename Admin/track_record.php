<?php
require_once "../core/database.php";

if (isset($_POST['status']) && isset($_POST['existing_product'])) {
    $status = $_POST['status'];
    $product_val = $_POST['existing_product'];


    $status_array = array(
        "status" => $_POST['status']
    );

    $product_id_array = array(
        "product_id" => $_POST['existing_product']
    );
    update("ordered_products", $status_array, $product_id_array, $connection);
    echo "hello";
}
