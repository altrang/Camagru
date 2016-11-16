<?php

function caramail(){
$array = explode("/", $_SERVER['REQUEST_URI']);
$path = $array[1];
$recipient = $_POST['mail'];
$link = 'http://localhost:8080/'.$path.'/confirmation.php?login='.urlencode($_POST['login']).'&key='.$GLOBALS['key'];
$subject = 'activez votre account';
$header = "From camagru@42.fr";
$msg = 	'Welcome to Camagru!
		To activate your account, please click on the link below.'."\n".$link.'
		-------------
		Do not reply.';
		mail($recipient, $subject, $msg, $header);
		echo "<script>alert('Account was successfully created. Click the link in email for validation');location.href='login.php';</script>";
}
?>
