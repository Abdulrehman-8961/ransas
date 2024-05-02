<?php
ini_set('display_errors',1);
$con = new mysqli("localhost",'swim-crm','s!!!hOkK1232tchV6JE%**w5n69Zu','swim-crm');


 mysqli_query($con,"
 ALTER TABLE `message_template` ADD `template` INT NULL DEFAULT NULL AFTER `pool_id`;
");

 echo mysqli_error($con);
?>
