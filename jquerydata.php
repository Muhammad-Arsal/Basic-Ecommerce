<?php
session_start();
if (isset($_POST['product_id'])) {
    $_SESSION['cart_items'][] = $_POST['product_id'];
    echo count($_SESSION['cart_items']);
}
