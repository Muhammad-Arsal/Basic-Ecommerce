<?php
require_once "../core/database.php";
$key = $_GET['id'];
$que = "DELETE FROM category WHERE parent_id = $key";
$new_que = "DELETE FROM category WHERE id = $key";


mysqli_query($connection, $que);
mysqli_query($connection, $new_que);
header("location: category.php");
