<?php

include('navbar.php');

$x = (int) 0;

$IdConf = array();
$TitleConf = array();

$ConfByUser = ConfByUser();
$ConfByUser->bindParam(':IdUser', $UserId);
$ConfByUser->execute();

while ($Data = $ConfByUser->fetch()) {

	$IdConf[$x] = (String) $Data['id'];
    $TitleConf[$x] = (String) $Data['title'];


    $html = <<<HTML
    <div class='content'>
    --------------------------------------------------
    <br>
    <label>{$TitleConf[$x]}</label>
    
    <form action='remove_conf.php' method='post'>
    <input type='hidden' name='conference' value='{$IdConf[$x]}'>
    <input type='submit' value='remove'>
    </form>        

    <form action='edit_conf.php' method='post'>
    <input type='hidden' name='conference' value='{$IdConf[$x]}'>
    <input type='submit' value='modifier'>
    </form>

    </div>
HTML;

        
    echo $html;
        
    
	$x++;
}

?>