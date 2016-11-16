<?php
require_once('config/startup.php');
require_once('redirect.php');
session_start();
include('header.php');
include('connection/sendmail.php');


function digit($passwd)
{
	$digit = 0;
	$pass = strlen($passwd);

	$alpha = 0;
	$i = 0;
	while($i < $pass)
	{
		$passwd[$i];
		if (is_numeric($passwd[$i]))
			$digit = 1;
		if ($passwd[$i] >= 'a' && $passwd[$i] <= 'z')
			$alpha = 1;
		if ($passwd[$i] >= 'A' && $passwd[$i] <= 'Z')
			$alpha = 1;
		$i++;
	}
	if ($digit == 1 && $alpha == 1)
		return TRUE;
	else
		return FALSE;
}

if (!$sql_co = startup())
	echo "ERROR";
if ($_SESSION['login'] !== "" AND !empty($_SESSION['login']))
redirect('cam.php');
if($_POST['forminscription'] !== "" AND !empty($_POST['forminscription']))
{
	$login = htmlspecialchars($_POST['login']);
	$passwd = hash('whirlpool', $_POST['passwd']);
	$passwd2 = hash('whirlpool', $_POST['passwd2']);
	$mail = htmlspecialchars($_POST['mail']);
	if(!empty($_POST['login']) AND !empty($_POST['mail']) AND !empty($_POST['passwd']) AND !empty($_POST['passwd2']))
	{
		$loginlength = strlen($login);
		if($loginlength <= 255)
		{
			if(filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$reqmail = $sql_co->prepare("SELECT * FROM users WHERE mail = ?");
				$reqmail->execute(array($mail));
				$mailexist = $reqmail->rowCount();
				if($mailexist == 0)
				{
					if($passwd === $passwd2)
					{
						if(digit($_POST['passwd']))
						{
							$reqlogin = $sql_co->prepare("SELECT * FROM users WHERE login = ?");
							$reqlogin->execute(array($login));
							$loginexist = $reqlogin->rowCount();
							if($loginexist == 0)
							{
								$longueurkey = 12;
								$key = "";
								for($i = 1; $i < $longueurkey; $i++)
								{
									$GLOBALS['key'] .= mt_rand(0, 9);
								}
								caramail();
								$insertmbr = $sql_co->prepare("INSERT INTO users(login, passwd, mail, confirmkey) VALUES(?, ?, ?, ?)");
								$insertmbr->execute(array($login, $passwd, $mail, $key));
								$erreur = "Votre compte a bien ete cree ! ";
								redirect('login.php');
							}
							else{$erreur = "Desole le login existe deja";}
						}
						else{$erreur = "Mot de passe pas securise";}
					}
					else{$erreur = "Les mdp ne correspondent pas";}
				}
				else{$erreur = "le mail existe deja";}
			}
			else{$erreur = "Le mail nest pas valide";}
		}
		else{$erreur = "Le login est trop long";}
	}
	else{$erreur = "Merci de remplir les champs";}
}
 ?>
 <!DOCTYPE html>
 <html>
 	<head>
 		<meta charset="utf-8">
 	</head>
 	<body>
		<div class="avatar">
			<img src="avatar.png">
		</div>
		<div class="form" align="center">
			<form method="post" action="connec.php">
  <div class="imgcontainer">
  </div>

  <div class="container">
    <label><b>Username</b><br /></label>
    <input type="text" placeholder="Enter Username" name="login" required>

    <label><br /><b>Password</b><br /></label>
    <input type="password" placeholder="Enter Password" name="passwd" required>

	<label><br /><b>Confirm Password</b><br /></label>
    <input type="password" placeholder="Confirm Password" name="passwd2" required>

	<label><br /><b>Email</b><br /></label>
    <input type="email" placeholder="Your Email" name="mail" required><br /><br />

    <input type="submit" name="forminscription">

	<br /><br /><br />
  </div>
  <?php
  if($erreur !== "")
  	echo '<font color="black" font size="5px">' .$erreur. "</font>";?>
	<br /><br /><br />
  <div class="container" style="background-color:#f1f1f1">
    <span class="psw">Forgot <a href="recup_mail.php">password?</a></span>
  </div>
</form>

		</div>
 	</body>
 </html>
