<?php

require_once('config/startup.php');
require_once('redirect.php');
session_start();
include('header.php');
include('connection/sendmail2.php');
if (!$sql_co = startup())
	echo "ERROR";
else
{
	if($_GET['section'] !== "")
	{
		$section = htmlspecialchars($_GET['section']);
	}
	else {
		$section == "";
	}
	if($_POST['validation'] !== "" AND $_POST['recup_mail'] !== "")
	{
		if(!empty($_POST['recup_mail']))
		{
			$recup_mail = htmlspecialchars($_POST['recup_mail']);
			if(filter_var($recup_mail, FILTER_VALIDATE_EMAIL))
			{
				$mailexist = $sql_co->prepare('SELECT id,login FROM users WHERE mail = ?');
				$mailexist->execute(array($recup_mail));
				$mailexist_count = $mailexist->rowCount();
				if($mailexist_count == 1)
				{
					$login = $mailexist->fetch();
					$login = $login['login'];
					$_SESSION['recup_mail'] = $recup_mail;
					$recup_code = "";
					for ($i=0; $i < 8 ; $i++) {
						$GLOBALS['recup_code'] .= mt_rand(0, 9);
					}
					$_SESSION['recup_code'] = $recup_code;
					$mail_recup_exist = $sql_co->prepare("SELECT id FROM recup WHERE MAIL = ?");
					$mail_recup_exist->execute(array($recup_mail));
					$mail_recup_exist = $mail_recup_exist->rowCount();
					if($mail_recup_exist == 1){
						$insert = $sql_co->prepare("UPDATE recup SET code = ? WHERE mail = ?");
						$insert->execute(array($recup_code, $recup_mail));
					}
					else{
						$insert = $sql_co->prepare("INSERT INTO recup(mail, code) VALUES (?, ?)");
						$insert->execute(array($recup_mail, $recup_code));
					}
					caramail1();
					redirect('recup_mail.php?section=code');

				}
				else {
					$error = "Cette adresse n'existe pas";
			}
		}
			else{
				$error = "Adresse mail invalide";
			}
		}

	}
	else {
		$error = "Veuillez entrer votre adresse mail";
	}
	if ($_POST['code_submit'] !== "" AND !empty($_POST['code_submit']))
	{
		if ($_POST['code_verif'] !== "")
		{
			$verif_code = htmlspecialchars($_POST['code_verif']);
			$verif_req = $sql_co->prepare('SELECT * from recup WHERE mail = ? and code = ?');
			$verif_req->execute(array($_SESSION['recup_mail'], $verif_code));
			$verif_req = $verif_req->rowCount();
			if ($verif_req == 1)
			{
				$del_req = $sql_co->prepare("DELETE FROM recup WHERE mail = ?");
				$del_req->execute(array($_SESSION['recup_mail']));
				redirect('recup_mail.php?section=changemdp');

			}
			else {
				$error = "Code invalide";
			}
		}
		else {
			$error = "veuillez entrer votre code de confirmation";
		}
	}
	if ($_POST['passwd_submit'] !== "" AND !empty($_POST['passwd_submit']))
	{
		if ($_POST['change_pass'] !== "" AND $_POST['change_pass2'] !== "")
		{
			$mdp = htmlspecialchars($_POST['change_pass']);
			$mdp1 = htmlspecialchars($_POST['change_pass2']);
			if(!empty($mdp) AND !empty($mdp1))
			{
				if($mdp == $mdp1)
				{
					$mdp = hash('whirlpool', $mdp);
					$ins_mdp = $sql_co->prepare('UPDATE users SET passwd = ? WHERE mail = ?');
					$ins_mdp->execute(array($mdp, $_SESSION['recup_mail']));
					redirect('login.php');
				}
				else {
					$error = "Les mots de passe ne correspondent pas";
				}
			}
			else {
				$error = "Veuillee23e21ez remplir tous les champs";
			}
		}
		else {
			$error = "Veuillez remplir tous les champs";
		}
	}
}


 ?>

 <!DOCTYPE html>
 <html>
 	<head>
 		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">

 		<title></title>
 	</head>
 	<body>
		<div id="change">
		<?php if($section == 'code') {?>
			<br /><br />
			<form method="post" name="recup">
				<p>Recuperation de mot de passe pour <?= $_SESSION['recup_mail'];?></p>
				<input type="text" placeholder="Code de verification" name="code_verif">
				<input type="submit" name="code_submit">
			</form>
		<?php } elseif($section == "changemdp"){ ?>
			<form method="post" name="recup1">
				<p>Nouveau mot de passe pour <?= $_SESSION['recup_mail'];?></p>
				<input type="password" placeholder="Nouveau mot de passe" name="change_pass">
				<input type="password" placeholder="Confirmez votre pass" name="change_pass2">
				<input type="submit" name="passwd_submit" >
			</form>
			<?php } else { ?>
		<form method="post" name="recup2">
			<input type="email" placeholder="Votre mail" name="recup_mail">
			<?php
			if($error !== "")
			 	echo '<font color="#C23B22" font size="4px">'.$error."</font>";?>
			<input type="submit" name="validation" >
		</form>
		<?php } ?>

		</div>
 	</body>
 </html>
