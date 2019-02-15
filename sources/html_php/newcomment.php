<?php

include('navbar.php');

$content = (String) $_POST['comment'];
$mark = (int) $_POST['note'];
$user = (int) $_POST['user'];
$conf = (int) $_POST['conf'];

echo $content.$mark.$user.$conf;

$AddComment =AddComment();
$AddComment->bindParam(':idUser', $user);
$AddComment->bindParam(':idConf', $conf);
$AddComment->bindParam(':content', $Date);
$AddComment->bindParam(':mark', $mark);
$AddComment->execute();

