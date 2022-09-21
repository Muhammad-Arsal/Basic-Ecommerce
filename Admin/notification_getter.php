<?php
require_once "../core/database.php";
$notification = select_where("notification", "status", 0, $connection, 2);
$number_of_notification = 0;
if (!empty($notification)) {
    $number_of_notification = count($notification);
}
echo $number_of_notification;
