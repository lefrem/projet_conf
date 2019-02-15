<?php
error_reporting(0);

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


$CheckComment = CheckComment();
$CheckComment->bindParam(':id', $UserId);
$CheckComment->execute();


if ($connection === 0) {
    # code...
}
else {
    $Datas = $CheckComment->fetchAll();

    foreach ($Datas as $value) {
        $idUser = $value['idUser'];
    }

    if ($UserId == $idUser && isset($idUser)) {
        echo "Vous avez deja voté";
    }
    else {
        ?>
        <form method="post" action="newcomment.php">
        <label>votre commentaire</label>
        <label>votre note</label>
        <input type="text" name="comment">
        <div>
        <input type="radio" name="note" value="1" checked>
        <label>1</label>
        </div>
        <div>
        <input type="radio" name="note" value="2" checked>
        <label>2</label>
        </div>
        <div>
        <input type="radio" name="note" value="3" checked>
        <label>3</label>
        </div>
        <div>
        <input type="radio" name="note" value="4" checked>
        <label>4</label>
        </div>
        <div>
        <input type="radio" name="note" value="5" checked>
        <label>5</label>
        </div>
        <input type="hidden" name="user" value="<?php echo $UserId; ?>">
        <input type="hidden" name="conf" value="<?php echo $IdConf; ?>">
        <input type="submit" value="ok">
        </form>
        <?php
    }
    
}
?>