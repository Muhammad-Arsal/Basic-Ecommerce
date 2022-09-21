<?php
require_once "./core/database.php";
session_start();
if (isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_login'];
    $product_id = $_POST['product_id'];
    $main_array = array(
        "user_id" => $user_id,
        "product_id" => $product_id
    );
    $single = select_where('wishlist', 'product_id', $product_id, $connection, 1);
    if (!$single) {
        insert_func("wishlist", $main_array, $connection);
        echo true;
    } else {
        echo false;
    }
}

if (isset($_POST['which_product'])) {
    $_SESSION['cart_items'][] = $_POST['which_product'];
    echo true;
}


if (isset($_POST['delete_product'])) {
    $user_id = $_SESSION['user_login'];
    $product_id = $_POST['delete_product'];

    $que = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
    if (mysqli_query($connection, $que)) {
        echo true;
    } else {
        echo false;
    }
}
