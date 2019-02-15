<?php
 
include('navbar.php');

$user = $_POST['dwuser'];
$role = 0;

$UpdadeRole = UpdadeRole();
$UpdadeRole->bindParam(':id', $user);
$UpdadeRole->bindParam(':role', $role);
$UpdadeRole->execute();

header("Location: ./index.php");
exit;