<?php
include('navbar.php');

if (
    isset($_POST['Email']) && 
	isset($_POST['Userlastname']) && 
	isset($_POST['Password']) && 
	isset($_POST['PasswordConfimation'])
) {
    $Userlastname = (String) $_POST['Userlastname'];
    $Username = (String) $_POST['Username'];
	$Password = (String) $_POST['Password'];
    $PassConf = (String) $_POST['PasswordConfimation'];
    $Email = (String) $_POST['Email'];
    $role = (int) 0;
    
    $Username = htmlspecialchars($Username, ENT_COMPAT,'ISO-8859-1', true);
    $Userlastname = htmlspecialchars($Userlastname, ENT_COMPAT,'ISO-8859-1', true);
	$Password = htmlspecialchars($Password, ENT_COMPAT,'ISO-8859-1', true);
    $PassConf = htmlspecialchars($PassConf, ENT_COMPAT,'ISO-8859-1', true);
    
    if (strlen($Email) > 0) {
	    if (strlen($Userlastname) > 0) {
            if (strlen($Username) >= 0) {
                if(strlen($Username) == 0){
                    $Username = NULL;
                }
		            if (strlen($Password) > 0) {
			            if (strlen($PassConf) > 0) {
                            if (strlen($Email) < 256) {
                                if (strlen($Username) < 256) {
				                    if (strlen($Userlastname) < 256) {
				    	                if (strlen($Password) < 256) {
				    		                if (strlen($PassConf) < 256) {
				    			                if ($PassConf === $Password) {
				    				                try {
                                                        $bdd = connection();
				    					                if ($bdd == TRUE) {
				    						                $CheckUser = CheckEmail();
				    						                $CheckUser->bindParam(':email', $Email);
                                                            $CheckUser->execute();
				    						                while ($Data = $CheckUser->fetch()) {
                                                                $Number = (int) $Data["COUNT(*)"];
				    						                }
				    						                if ($Number == 0) {
				    						                	$Hashing = (String) crypt($Password, '$5$rounds=5000$lziyelieugcpaeziukhghgdk$');
				    						                	$Hashing = htmlspecialchars($Hashing, ENT_COMPAT,'ISO-8859-1', true);
                                                                $AddData = AddUser();
                                                                $AddData->bindParam(':email', $Email);
				    						                	$AddData->bindParam(':password', $Hashing);
                                                                $AddData->bindParam(':name', $Username);
                                                                $AddData->bindParam(':last_name', $Userlastname);
                                                                $AddData->bindParam(':role', $role);
				    						                	$AddData->execute();
				    						                	header("Location: ./login.php");
                                                                exit;
				    						                }
				    						                else {
				    						                	echo "Votre email : \"".$Email."\" est déjà utilisé";
				    						                	echo "<a href='register.php'>Essayer avec un autre</a>";
				    						                }
				    					                }
				    				                } catch (Exception $e) {
				    					                echo "Error ! : ".$bdd."<br>".$e->getMessage();
				    					                echo "<a href='register.php'>Veuillez réessayer</a>";
				    					                die();
                                                    }
                                                }
                                                else {
                                                    echo "Aie aie aie, vos mot de passe ne smash pas entre eux 🤐<br>
                                                    <a href='register.php'>Veuillez réessayer</a>";
                                                }
                                            }
                                            else {
                                                echo "Aie aie aie, on ne gere pas autant de caracteres pour votre confirmation de mot de passe 😵<br>
                                                <a href='register.php'>Veuillez réessayer</a>";
                                            }
                                        }
                                        else {
                                            echo "Aie aie aie, on ne gere pas autant de caracteres pour votre mot de passe 😵<br>
                                            <a href='register.php'>Veuillez réessayer</a>";
                                        }
                                    }
                                    else {
                                        echo "Aie aie aie, on ne gere pas autant de caracteres pour votre nom 😵<br>
                                        <a href='register.php'>Veuillez réessayer</a>";
                                    }
                                }
                                else {
                                    echo "Aie aie aie, on ne gere pas autant de caracteres pour votre prénom 😵<br>
                                    <a href='register.php'>Veuillez réessayer</a>";
                                }
                            }
                            else {
                                echo "Aie aie aie, on ne gere pas autant de caracteres pour votre email 😵<br>
                                <a href='register.php'>Veuillez réessayer</a>";
                            }
                        }
                        else {
                            echo "Oups je crois que vous avez oubliez votre votre mot de passe de confirmation 😝,<br>
                            <a href='register.php'>Veuillez réessayer</a>";
                        }
                    }
                    else {
                        echo "Oups je crois que vous avez oubliez votre un mot de passe 😝,<br>
                        <a href='register.php'>Veuillez réessayer</a>";
                    }
            }
            else {
                echo "Un problème est survenu avec votre prénom,<br>
                <a href='register.php'>Veuillez réessayer</a>";
            }
        }
        else {
            echo "Oups je crois que vous avez oubliez votre nom 😝,<br>
            <a href='register.php'>Veuillez réessayer</a>";
        }
    }
    else {
        echo "Oups je crois que vous avez oubliez votre email 😝<br>
        <a href='register.php'>Veuillez réessayer</a>";
    }
}							
else {
	?>
	<form action="register.php" method="post">
		<label>Votre nom : </label>
		<input type="text" 
		name="Userlastname" 
		placeholder="Votre nom" 
		maxlength="255" 
		minlength="1" 
		required>
		<br>
        <label>Votre prénom : </label>
		<input type="text" 
		name="Username" 
		placeholder="Votre nom" 
		maxlength="255" 
		minlength="0">
		<br>
        <label>Votre email : </label>
		<input type="email" 
		name="Email" 
		placeholder="Votre email" 
		maxlength="255" 
		minlength="1" 
		required>
		<br>
		<label>Password : </label>
		<input type="Password" 
		name="Password" 
		placeholder="Your Password" 
        maxlength="255" 
        minlength="1" 
		required>
		<br>
		<label>Confirmation of Password : </label>
		<input type="Password" 
		name="PasswordConfimation" 
		placeholder="Your Password" 
		maxlength="255" 
		minlength="1" 
		required>
		<br>
		<input type="submit" value="Validation">
	</form>
	<?php
}
?>