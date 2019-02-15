<?php

declare(strict_types=1);

function Connection()
{
	$Server = (String) "localhost";
	$DataBase = (String) "projet_conf";
	$SQLUser = (String) "root";
	$SQLPassword = (String) "";
	$bdd = new PDO('mysql:host='.$Server.';
		dbname='.$DataBase.';
		charset=utf8', 
		"$SQLUser", 
		"$SQLPassword"
	);
    return $bdd;
}

function AddUser ()
{
	$bdd = connection();
	$AddData = $bdd->prepare("
		INSERT INTO `user` (id,email,password,name,last_name,role) 
		VALUE (NULL, :email, :password, :name, :last_name, :role)
	");
	return $AddData;
}

function CheckEmail ()
{
	$bdd = connection();
	$CheckUser = $bdd->prepare("
		SELECT COUNT(*) 
		FROM `user` 
		WHERE `email` = (:email)
	");
	return $CheckUser;
}

function CheckPassword ()
{
	$bdd = connection();
	$CheckPass = $bdd->prepare("
		SELECT `password` 
		FROM `user` 
		WHERE `email` = (:email)
	");
	return $CheckPass;
}

function AllConf ()
{
	$bdd = connection();
	$AllConf = $bdd->prepare("
		SELECT * 
		FROM `conference`
		ORDER by 1 DESC
	");
	return $AllConf;
}

function ConfByUser ()
{
	$bdd = connection();
	$ConfByUser = $bdd->prepare("
		SELECT * 
		FROM `conference`
		WHERE `author` = (:IdUser)
		ORDER by 1 DESC
	");
	return $ConfByUser;
}

function ConfById ()
{
	$bdd = connection();
	$ConfById = $bdd->prepare("
		SELECT * 
		FROM `conference`
		WHERE `id` = (:id)

	");
	return $ConfById;
}

function RemoveConf ()
{
	$bdd = connection();
	$RemoveConf = $bdd->prepare("
	DELETE FROM `conference`
	WHERE `id` = (:id)
	");
	return $RemoveConf;
}

function ResearchUser () 
{
	$bdd = connection();
	$SearchUser = $bdd->prepare("
		SELECT `last_name`
		FROM `user`
		WHERE `id` = (:IdUser)
	");
	return $SearchUser;
}

function SaveConf ()
{
	$bdd = connection();
	$Saveconf = $bdd->prepare("
		INSERT INTO `conference` (id,title,content,date,image,mark,author) 
		VALUE (NULL,:title, :content, :date, :image, NULL, :author)
	");
	return $Saveconf;
}

function CheckIdUser ()
{
	$bdd = connection();
	$IdUser = $bdd->prepare("
		SELECT `id` 
		FROM `user` 
		WHERE `email` = (:email)
	");
	return $IdUser;
}

function CheckRoleUser ()
{
	$bdd = connection();
	$CheckRoleUser = $bdd->prepare("
		SELECT `role` 
		FROM `user` 
		WHERE `id` = (:id)
	");
	return $CheckRoleUser;
}

function GetConf () 
{
	$bdd = connection();
	$GetConf = $bdd->prepare("
		SELECT * 
		FROM `conference`
		WHERE `id` = (:id)
	");
	return $GetConf;
}

function ConfNote () 
{
	$bdd = connection();
	$ConfNote = $bdd->prepare("
		SELECT * 
		FROM `conference`
		WHERE `mark` IS NOT NULL
	");
	return $ConfNote;
}

function ConfNonNote () 
{
	$bdd = connection();
	$ConfNonNote = $bdd->prepare("
		SELECT * 
		FROM `conference`
		WHERE `mark` IS NULL
	");
	return $ConfNonNote;
}

function UpdadeConf ()
{
	$bdd = connection();
	$UpdadeConf = $bdd->prepare("
	UPDATE `conference`
	SET `title` = :title, `content` = :content, `image` = :image, `date` = :date
	WHERE `id` = (:id)
	");
	return $UpdadeConf;
}

function AllUser ()
{
	$bdd = connection();
	$AllUser = $bdd->prepare("
		SELECT *
		FROM `user`
	");
	return $AllUser;
}

function TopTen ()
{
	$bdd = connection();
	$TopTen = $bdd->prepare("
		SELECT * 
		FROM `conference`
		ORDER by 6 DESC
		LIMIT 10
	");
	return $TopTen;
}

function CheckComment ()
{
	$bdd = connection();
	$CheckComment = $bdd->prepare("
		SELECT * 
		FROM `commentary`
		WHERE `idUser` = :id
	");
	return $CheckComment;
}

function UpdadeRole ()
{
	$bdd = connection();
	$UpdadeRole = $bdd->prepare("
	UPDATE `user`
	SET `role` = :role
	WHERE `id` = (:id)
	");
	return $UpdadeRole;
}

function RemoveUser ()
{
	$bdd = connection();
	$RemoveUser = $bdd->prepare("
	DELETE FROM `user`
	WHERE `id` = (:id)
	");
	return $RemoveUser;
}