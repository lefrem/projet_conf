<?php

include('navbar.php');

$IdConf = (int) $_POST['conference'];

$ConfById = ConfById();
$ConfById->bindParam(':id', $IdConf);
$ConfById->execute();

while ($Data = $ConfById->fetch()) {

    $image = (String) $Data['image'];
}

if($image != NULL) {
unlink($image);
}

$RemoveConf = RemoveConf();
$RemoveConf->bindParam(':id', $IdConf);
$RemoveConf->execute();

header("Location: ./list_conf.php");

?>