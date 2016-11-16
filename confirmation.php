<?php
require_once('./config/startup.php');
require_once('./redirect.php');
session_start();
include('header.php');
include('connection/sendmail.php');
if (!$sql_co = startup())
	echo "ERROR";
else{
if($_GET['login'] !== "" AND $_GET['key'] !== "" AND !empty($_GET['login']) AND !empty($_GET['key']))
{
	$pseudo = htmlspecialchars(urldecode($_GET['login']));
	$key = $_GET['key'];
	$requser = $sql_co->prepare("SELECT * FROM users WHERE login = ?");
	$requser->execute(array($pseudo));
	$userexist = $requser->rowCount();
	if($userexist == 1)
	{
		$user = $requser->fetch();
		if($user['confirme'] == 0)
		{
			$updateuser = $sql_co->prepare("UPDATE users SET confirme = 1 WHERE login = ? AND confirmkey = ?");
			$updateuser->execute(array($pseudo, $key));
			echo "votre compte a bien ete confirme";
			$_SESSION['login'] = $pseudo;
			redirect('profil.php');
		}
		else
		{
			echo "Votre compte a deja ete confirme";
			redirect('profil.php');
		}
	}
	else {
		echo "l'utilisateur na pas ete cool";
	}
}
}
 ?>