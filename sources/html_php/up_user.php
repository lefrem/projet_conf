<?php
 
include('navbar.php');

$user = $_POST['upuser'];
$role = 1;

$UpdadeRole = UpdadeRole();
$UpdadeRole->bindParam(':id', $user);
$UpdadeRole->bindParam(':role', $role);
$UpdadeRole->execute();

header("Location: ./index.php");
exit;