<?php
require_once "../core/database.php";

$existing_id = $_GET['id'];
delete_func("coupon", $existing_id, $connection);
header("location: coupon.php");
