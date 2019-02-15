<?php
 
include('navbar.php');

$user = $_POST['rmuser'];

$RemoveUser = RemoveUser();
$RemoveUser->bindParam(':id', $user);
$RemoveUser->execute();

header("Location: ./index.php");
exit;