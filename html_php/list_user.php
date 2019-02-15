<?php
 
include('navbar.php');

$id = array();
$email = array();
$name = array();
$role = array();

$x = (Int) 0;

if($connection === 0){
    header("Location: ./index.php");
    exit;
}
else {
    if($UserRole === 0) {
        header("Location: ./index.php");
        exit;
    }
    if ($UserRole === 1) {

        $AllUser = AllUser();
        $AllUser->execute();

        $Data = $AllUser->fetchAll();
        
        foreach ($Data as $value) {

            if ($value['id'] != $UserId) {

                if($value['role'] == 0){

                    $html = <<<HTML
                    <div class='content'>
                    --------------------------------------------------
                    <br>
                    <label>{$value['last_name']}</label>
                    <label>{$value['email']}</label>
                    <form action='remove_user.php' method='post'>
                    <input type='hidden' name='rmuser' value="{$value['id']}">
                    <input type='submit' value='remove'>
                    </form>
                    </div>
HTML;

                    echo $html;
                }
            }
        }
    }

    if ($UserRole === 2) {
        $AllUser = AllUser();
        $AllUser->execute();

        $Data = $AllUser->fetchAll();
        
        foreach ($Data as $value) {

            if ($value['id'] != $UserId) {

                if($value['role'] != 2){

                    if($value['role'] == 0){

                    $html = <<<HTML
                    <div class='content'>
                    --------------------------------------------------
                    <br>
                    <label>{$value['last_name']}</label>
                    <label>{$value['email']}</label>

                    <form action='remove_user.php' method='post'>
                    <input type='hidden' name='rmuser' value="{$value['id']}">
                    <input type='submit' value='remove'>
                    </form>

                    <form action='up_user.php' method='post'>
                    <input type='hidden' name='upuser' value="{$value['id']}">
                    <input type='submit' value='up en admin'>
                    </form>       

                    </div>
HTML;
                    echo $html;

                    }
                    if($value['role'] == 1){

                    $html = <<<HTML
                    <div class='content'>
                    --------------------------------------------------
                    <br>
                    <label>{$value['last_name']}</label>
                    <label>{$value['email']}</label>

                    <form action='remove_user.php' method='post'>
                    <input type='hidden' name='rmuser' value="{$value['id']}">
                    <input type='submit' value='remove'>
                    </form>

                    <form action='down_user.php' method='post'>
                    <input type='hidden' name='dwuser' value="{$value['id']}">
                    <input type='submit' value='down en simple user'>
                    </form>       

                    </div>
HTML;
                    echo $html;
                    }

                    
                }
            }
        }

    }

}

?>