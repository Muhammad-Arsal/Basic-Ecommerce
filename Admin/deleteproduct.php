<?php
require_once "../core/database.php";
$post_id = $_GET['id'];

$required_detail = select_where("products", "id", $post_id, $connection, 1);
$del_image = $required_detail['product_image'];

if (file_exists("../productimages/" . $del_image)) {
    unlink("../productimages/" . $del_image);
}

delete_func("products", $post_id, $connection);
header("location: products.php");
