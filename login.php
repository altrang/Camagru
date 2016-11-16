<?php
require_once('config/startup.php');
session_start();
include("header.php");
require_once('redirect.php');

if(!$sql_co = startup())
	echo "ERROR";
if($_SESSION['login'] !== "" AND !empty($_SESSION['login']))
	redirect('gallery.php');
else {
	if($_POST['ok'] !== "" AND !empty($_POST['ok']))
	{
		$login = htmlspecialchars($_POST['login']);
		$passwd = hash('whirlpool', $_POST['passwd']);
		if(!empty($login) AND !empty($passwd))
		{
			$requser = $sql_co->prepare("SELECT * FROM users WHERE login = ? AND passwd = ? AND confirme = 1");
			$requser->execute(array($login, $passwd));
			$userexist = $requser->rowCount();
			if($userexist == 1)
			{
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['login'] = $userinfo['login'];
				$_SESSION['mail'] = $userinfo['mail'];
				$_SESSION['test'] = "test";
				redirect('cam.php');
			}
			else{
				$erreur = "Mauvais login ou mot de passe, ou votre compte n'a pas ete verifie";
			}
		}
		else{
			$erreur = "tous les champs remplis";
		}
	}
}

 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container1">
			<form method="post">
	      <label><b>Username</b><br /></label>
	      <input type="text" placeholder="Enter Username" name="login" required>

	      <label><br /><b>Password</b><br /></label>
	      <input type="password" placeholder="Enter Password" name="passwd" required>
		  <?php
		  if($erreur !== "") {
			  echo '<font color="#C23B22" font size="4px">'.$erreur."</font>";
		  }
		  ?>
		  <input type="submit" name="ok" />
	  </form>

	  </div>
		</div>
	</body>
</html>
