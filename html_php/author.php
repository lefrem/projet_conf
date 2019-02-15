<?php

include('navbar.php');

$IdAuthorConf = (int) $_POST['author'];

$x = (int) 0;

$IdConf = array();
$TitleConf = array();
$DateConf = array();
$ImageConf = array();

$ConfByUser = ConfByUser();
$ConfByUser->bindParam(':IdUser', $IdAuthorConf);
$ConfByUser->execute();

while ($Data = $ConfByUser->fetch()) {

	$IdConf[$x] = (String) $Data['id'];
    $TitleConf[$x] = (String) $Data['title'];
    $DateConf[$x] = (String) $Data['date'];
    $ImageConf[$x] = (String) $Data['image'];
    $ContentConf[$x] = (String) $Data['content'];
    $NoteConf[$x] = (int) $Data['mark'];


    $html = <<<HTML
    <div class='content'>
    --------------------------------------------------
	<form action='conference.php' method='post' target='_blank'>
    <input type='hidden' name='conference' value='{$IdConf[$x]}'>
    <input type='submit' value={$TitleConf[$x]}>
    </form>        
    <p>le</p> $DateConf[$x]

HTML;
    if($NoteConf[$x] == NULL) {
    $html .= <<<HTML
    <p>Non notée</p>
HTML;
    }
    else {
        $html .= <<<HTML
        <br>
        $NoteConf[$x]
HTML;
    }
    if($ImageConf[$x] != NULL){
        $html .= <<<HTML
        <img src="{$ImageConf[$x]}" alt="image-conf">
HTML;
    }
    else{
        $html .= <<<HTML
        <br>
        $ContentConf[$x]
HTML;
    }
    $html .= <<<HTML
    </div>
HTML;

        
    echo $html;
        
    
	$x++;
}

?>