<?php
session_start();
if (isset($_POST['plus'])) {
    $_SESSION['cart_items'][] = $_POST['plus'];
    $key = $_SESSION['cart_items'];
    $counting = array_count_values($key);
    $product_id = $_POST['plus'];
    $product_count = $counting[$product_id];
    $main_array = array(
        "cart_count" => count($_SESSION['cart_items']),
        "quantity" => $product_count,
    );
    print_r(json_encode($main_array));
}

if (isset($_POST['minus'])) {
    $index = $_POST['minus'];
    $arr = array_search($index, $_SESSION['cart_items']);
    unset($_SESSION['cart_items'][$arr]);
    echo count($_SESSION['cart_items']);
}
