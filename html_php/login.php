<?php
include('navbar.php');

if (isset($_POST['Email']) && isset($_POST['Password'])) {

	$Email = (String) $_POST['Email'];
    $Password = (String) $_POST['Password'];
    
    $Email = htmlspecialchars($Email, ENT_COMPAT,'ISO-8859-1', true);
    
    $_SESSION['Email'] = $Email;
    
	$CheckUser = CheckEmail();
	$CheckUser->bindParam(':email', $Email);
	$CheckUser->execute();
	while ($Data = $CheckUser->fetch()) {
		$Number = (int) $Data["COUNT(*)"];
	}
	if ($Number == 1) {
		$CheckPass = CheckPassword();
		$CheckPass->bindParam(':email', $Email);
		$CheckPass->execute();
		while ($Data = $CheckPass->fetch()) {
		$Pass = (String) $Data['password'];
		}
		if (hash_equals($Pass, (String) crypt($Password,$Pass))) {
			$_SESSION['email'] = $Email;
            header("Location: ./index.php");
            exit;
		}
		else {
			echo "Error in your password retry : ";
			echo "<a href='login.php'>Login</a>";
		}
	}
	else {
		echo "Error in your username retry : ";
		echo "<a href='login.php'>Login</a>";
	}
}
else {
	?>
	<form action="login.php" method="post">
		<label>Emai : </label>
		<input type="text" 
		name="Email" 
		placeholder="Votre email" 
		maxlength="255" 
		minlength="1" 
		required>
		<br>
		<label>Mor de passe : </label>
		<input type="Password" 
		name="Password" 
		placeholder="Votre mot de passe" 
		maxlength="255" 
		minlength="1" 
		required>
		<br>
		<input type="submit" value="Validation">
	</form>
	<?php
}

?>