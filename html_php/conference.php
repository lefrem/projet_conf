<?php

include('navbar.php');

$IdConf = (int) $_POST['conference'];

$GetConf = GetConf();
$GetConf->bindParam(':id', $IdConf);
$GetConf->execute();

while ($Data = $GetConf->fetch()) {

	$Title = (String) $Data['title'];
	$Content = (String) $Data['content'];
    $Image = (String) $Data['image'];
    $Date = (string) $Data['date'];
    $Mark = (int) $Data['mark'];
    $IdAuthor = (int) $Data['author'];
    
}

$SearchUser = ResearchUser();
$SearchUser->bindParam(':IdUser', $IdAuthor);
$SearchUser->execute();

while ($Datas = $SearchUser->fetch()) {
    $AuthordConf = (String) $Datas['last_name'];;
}

if($Image != NULL){
    echo $Title."<br>"."<img src='$Image'>"."<br>".$Content."<br>".$Mark." /5 "."<br>".$Date;
    echo "<form action='author.php' method='post' target='_blank'>";
    echo "<input type='hidden' name='author' value='$IdAuthor'>";
    echo "<input type='submit' value='$AuthordConf'>";
    echo "</form>";
}
else {
    echo $Title."<br>".$Content."<br>".$Mark." /5 "."<br>".$Date;
    echo "<form action='author.php' method='post' target='_blank'>";
    echo "<input type='hidden' name='author' value='$IdAuthor'>";
    echo "<input type='submit' value='$AuthordConf'>";
    echo "</form>";
}
?>