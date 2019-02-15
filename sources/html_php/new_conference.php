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
                $_FILES["file"] = NULL;
            }
        
            if (strlen($Title) > 0) {
                if (strlen($Title) < 256) {
                    if (strlen($Content) > 0) {
                        if (strlen($Content) < 65536) {
                            
                            move_uploaded_file($_FILES['file']['tmp_name'], 
                            "../ressources/imageconf/".$_FILES['file']['name']);
                            
                            $Saveconf =Saveconf();
                            $Saveconf->bindParam(':title', $Title);
                            $Saveconf->bindParam(':content', $Content);
                            $Saveconf->bindParam(':date', $Date);
                            $Saveconf->bindParam(':image', $Link);
                            $Saveconf->bindParam(':author', $UserId);
                            $Saveconf->execute();

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
            ?>
            <form action="new_conference.php" method="POST" enctype="multipart/form-data">
                <label>Titre de la conférence : </label>
                <textarea 
                    name="title" 
                    rows="1" 
                    cols="20" 
                    required></textarea>
                <label>Description de la conférence : </label>
                <textarea 
                    name="content" 
                    rows="10" 
                    cols="40" 
                    required></textarea>
                <label>Image de présentation : <label>
                <input type="file" name="file">
                <label>Date de la conférence : </label>
                <input type="date" name="date" required>
                <input type="submit" name="save">
            </form>
            <?php
        }
    }
}
?>