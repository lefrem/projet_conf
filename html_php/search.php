<?php

    include('navbar.php');

    $query = $_GET['query'];

    $x = (int) 0;
    $y = (int) 0;

    $IdConf = array();
    $TitleConf = array();
    $DateConf = array();
    $AuthordConf = array();
    $IdAuthorConf = array();
    $ImageConf = array();

    $AllConf = AllConf();
    $AllConf ->execute();


    $SearchUser = ResearchUser();


    while ($Data = $AllConf->fetch()) {
        
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
        if ($query == $TitleConf[$x])
        {
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
	    $x++;
    }
$y++;
        
}
}
   




       

    // $query = $_GET['query']; 
     
    // $min_length = 1;
     
    // if(strlen($query) >= $min_length){ 
         
    //     $query = htmlspecialchars($query); 
         
    //     $query = mysql_real_escape_string($query);
         
    //     $raw_results = mysql_query("SELECT * FROM conference
    //         WHERE (`title` LIKE '%".$query."%')") or die(mysql_error());
         
    //     if(mysql_num_rows($raw_results) > 0){
             
    //         while($results = mysql_fetch_array($raw_results)){
             
    //             echo "<p><h3>".$results['title']."</h3></p>";
    //         }
             
    //     }
    //     else{
    //         echo "No results";
    //     }
         
    // }
    // else{
    //     echo "Minimum length is ".$min_length;
    // }
?>