<?php
session_start();
unset($_SESSION['uid']);
setcookie("remember_me", $row['id'], time() - (86400 * 30), "/");
header("location: ./login.php");
exit();
