<?php
 
include('navbar.php');

$x = (int) 0;
$y = (int) 0;

$IdConf = array();
$TitleConf = array();
$DateConf = array();
$AuthordConf = array();
$IdAuthorConf = array();
$ImageConf = array();

$TopTen = TopTen();
$TopTen->execute();

$SearchUser = ResearchUser();

while ($Data = $TopTen->fetch()) {

	$IdConf[$x] = (String) $Data['id'];
    $TitleConf[$x] = (String) $Data['title'];
    $DateConf[$x] = (String) $Data['date'];
    $IdAuthorConf[$x] = (String) $Data['author'];
    $ImageConf[$x] = (String) $Data['image'];
    $ContentConf[$x] = (String) $Data['content'];
    $NoteConf[$x] = (int) $Data['mark'];
    
	$SearchUser->bindParam(':IdUser', $IdAuthorConf[$x]);
    $SearchUser->execute();

    
	while ($Datas = $SearchUser->fetch()) {

        $AuthordConf[$y] = (String) $Datas['last_name'];

        $html = <<<HTML
        <div class='content'>
        --------------------------------------------------
		<form action='conference.php' method='post' target='_blank'>
        <input type='hidden' name='conference' value='{$IdConf[$x]}'>
        <input type='submit' value={$TitleConf[$x]}>
        </form>
        <p>par</p>
        <form action='author.php' method='post' target='_blank'>
        <input type='hidden' name='author' value='{$IdAuthorConf[$x]}'>
        <input type='submit' value='{$AuthordConf[$y]}'>
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
        $y++;
        
    }
    
	$x++;
}