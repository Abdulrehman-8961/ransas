<?php
ini_set('display_errors',1);
$con = new mysqli("localhost",'swim-crm','s!!!hOkK1232tchV6JE%**w5n69Zu','swim-crm');


 mysqli_query($con,"
 UPDATE `events` SET `booking_type`='Swimming Course' WHERE id = '172';
");

 echo mysqli_error($con);
?>
