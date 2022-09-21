<?php
require_once "./core/database.php";
session_start();
$name = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

$main_array = array(
    'name' => $name,
    'email_num' => $email,
    'password' => $password
);
insert_func("user_credentials", $main_array, $connection);
$last_id = mysqli_insert_id($connection);
$_SESSION['user_login'] = $last_id;
$from_db = select_where("user_credentials", "id", $last_id, $connection, 1);
echo $from_db['name'];
