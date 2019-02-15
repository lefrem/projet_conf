<?php

session_start();
include('requete_sql.php');

$html = <<<HTML


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>    



<ul class='nav justify-content-end'>

<li class='nav-item'>
    <a class='btn btn-dark nav-link' href='./confnote.php'>conf notée</a>
</li>

<li class='nav-item'>
    <a class='btn btn-dark nav-link' href='./confnonnote.php'>conf non notée</a>
</li>

<div class='nav justify-content-center'>
    <form action="search.php" method="GET">
        <input type="text" name="query" />
        <input type="submit" value="Search" />
    </form>
</div>


HTML;

if (isset($_SESSION['email'])) {

    $UserEmail = $_SESSION['email'];

    $IdUser = CheckIdUser();
	$IdUser->bindParam(':email', $UserEmail);
	$IdUser->execute();
	while ($Data = $IdUser->fetch()) {
		$UserId = (int) $Data['id'];
    }

    $CheckRoleUser = CheckRoleUser();
	$CheckRoleUser->bindParam(':id', $UserId);
	$CheckRoleUser->execute();
	while ($Data = $CheckRoleUser->fetch()) {
		$UserRole = (int) $Data['role'];
    }
    
    $connection = (int) 1;

    switch ($UserRole) {
        case '0':
            $html .= <<<HTML

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='#'>Mon profile</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./logout.php'>se déconnecter</a>
            </li>

            </ul>

HTML;
            break;
        
        case '1':
            $html .= <<<HTML

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./new_conference.php'>creer conférence</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./logout.php'>se déconnecter</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./list_conf.php'>Ma liste de conf</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./list_user.php'>liste des users</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='#'>Mon profile</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='top_ten.php'>top 10</a>
            </li>

            </ul>
    
HTML;
            break;
        
        case '2':
            $html .= <<<HTML

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./logout.php'>se déconnecter</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./list_conf.php'>Ma liste de conf</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='#'>liste de toute les conf</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./list_user.php'>liste des users</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='./new_conference.php'>creer conférence</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='#'>Mon profile</a>
            </li>

            <li class='nav-item'>
                <a class='btn btn-dark nav-link' href='top_ten.php'>top 10</a>
            </li>

            </ul>

HTML;

            break;

        default:
            # code...
            break;
    }

}
else {

    $connection = (int) 0;

    $html .= <<<HTML

    <li class='nav-item'>
        <a class='btn btn-dark nav-link' href='./register.php'>s'enregister</a>
    </li>

    <li class='nav-item'>
        <a class='btn btn-dark nav-link' href='./login.php'>se connecter</a>
    </li>

    </ul>

HTML;

}

echo $html;
