<?php
require_once "./core/database.php";
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$que = "SELECT id,name,email_num,password FROM user_credentials WHERE email_num = '$email' AND password = '$password'";
$result = mysqli_query($connection, $que);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_login'] = $row['id'];
    if (isset($_POST['s_remember'])) {
        setcookie("remember_me", $row['id'], time() + (86400 * 30), "/");
    }
    $main_results = array(
        "num" => 1,
        "name" => $row['name'],
    );
    print_r(json_encode($main_results));
} else {
    $main_results = array(
        "num" => 0,
    );
    print_r(json_encode($main_results));
}
