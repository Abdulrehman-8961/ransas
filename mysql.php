<?php
ini_set('display_errors',1);
$con = new mysqli("localhost",'swim-crm','s!!!hOkK1232tchV6JE%**w5n69Zu','swim-crm');


 mysqli_query($con,"
 ALTER TABLE `events` ADD `other_type` VARCHAR(255) NULL DEFAULT NULL AFTER `booking_type`;
");

 echo mysqli_error($con);
?>
