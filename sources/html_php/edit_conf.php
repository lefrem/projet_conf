<?php
include('navbar.php');

if($connection === 0){
    header("Location: ./index.php");
    exit;
}
else {
    if($UserRole === 0) {
        header("Location: ./index.php");
        exit;
    }
    else {

if (
    isset($_POST['date']) && 
    isset($_POST['title']) && 
    isset($_POST['content'])
) {


    $Title = (String) $_POST['title'];
    $Date = $_POST['date'];
    $Content = (String) $_POST['content'];

    $Title = htmlspecialchars($Title, ENT_COMPAT,'ISO-8859-1', true);
    $Date = htmlspecialchars($Date, ENT_COMPAT,'ISO-8859-1', true);
    $Content = htmlspecialchars($Content, ENT_COMPAT,'ISO-8859-1', true);

    if($_FILES['file']['type'] != "")
    {
        $id = uniqid();
        $target_dir = "image/";
        $new_name = explode(".",$_FILES["file"]["name"]);
        $new_name = array_reverse($new_name);
        $ext = $new_name[0];
        if (
            $_FILES['file']['type'] == "image/jpeg" || 
            $_FILES['file']['type'] == "image/jpg" || 
            $_FILES['file']['type'] == "image/png"
        ) {
            if ($_FILES['file']['size'] < 2097152) {
                $_FILES["file"]["name"] = $id.".".$ext;
                $Link = (String) "../ressources/imageconf/".$_FILES['file']['name'];
                $Link = htmlspecialchars($Link, ENT_COMPAT,'ISO-8859-1', true);
            }
            else {
                echo"L'image dépasse 2Mo";
                die();
            }
        }
        else {
            $_FILES["file"] = NULL;
        }
    }
    else {
        $Link = $_POST['lastImage'];
    }

    if (strlen($Title) > 0) {
        if (strlen($Title) < 256) {
            if (strlen($Content) > 0) {
                if (strlen($Content) < 65536) {
                    
                    move_uploaded_file($_FILES['file']['tmp_name'], 
                    "../ressources/imageconf/".$_FILES['file']['name']);

                    $id = $_POST['idArticle'];

                    // var_dump($id);
                    // var_dump($Title);
                    // var_dump($Content);
                    // var_dump($Date);
                    // var_dump($Link);
                    // die();
                    
                    $UpdadeConf =UpdadeConf();
                    $UpdadeConf->bindParam(':title', $Title);
                    $UpdadeConf->bindParam(':content', $Content);
                    $UpdadeConf->bindParam(':date', $Date);
                    $UpdadeConf->bindParam(':image', $Link);
                    $UpdadeConf->bindParam(':id', $id);
                    $UpdadeConf->execute();

                    header("Location: ./index.php");
                    exit;

                }
                else {
                    echo"On s'endort en lisant ta description essaye de la rétrécir un peu mon ami";
                }
            }
            else {
                echo"Comment veux-tu que les gens participent à ta conférence si tu ne la décrit pas";
            }
        }
    }

}
else {

    $IdConf = (int) $_POST['conference'];

    $ConfById = ConfById();
    $ConfById->bindParam(':id', $IdConf);
    $ConfById->execute();

    while ($Data = $ConfById->fetch()) {

        $image = (String) $Data['image'];
        $titles = (String) $Data['title'];
        $contents = (String) $Data['content'];
        $dates = (String) $Data['date'];
    }

    ?>

    <form action="edit_conf.php" method="POST" enctype="multipart/form-data">
        <label>Titre de la conférence : </label>
        <textarea 
            name="title" 
            rows="1" 
            cols="20"><?php echo $titles; ?></textarea>
        <label>Description de la conférence : </label>
        <textarea 
            name="content" 
            rows="10" 
            cols="40"><?php echo $contents; ?></textarea>
        <?php
        if ($image != "")
        {
            echo "votre image actuelle : ";
            echo "<img src='$image' alt='image_conf'>";

        }
        else {
            echo "Vous n'avez pas mis d'image";
        }
        ?>
        <label>Image de présentation : <label>
        <input type="file" name="file">
        <label>Date de la conférence : </label>
        <input type="date" name="date" value="<?php echo $dates; ?>">
        <input type="hidden" name="lastImage" value="<?php echo $image; ?>">
        <input type="hidden" name="idArticle" value="<?php echo $IdConf ; ?>">
        <input type="submit" name="save">
    </form>

    <?php
    }
}
}

?>