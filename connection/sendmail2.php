<?php

function caramail1(){
$array = explode("/", $_SERVER['REQUEST_URI']);
$path = $array[1];
$recipient = $_POST['recup_mail'];
$link = 'http://localhost:8080/'.$path.'/recup_mail.php?section=code&code='.$GLOBALS['recup_code'];
$subject = 'Change your password';
$msg = 	'You asked for password change!
		Voici votre code de recuperation : '.$GLOBALS['recup_code'].'
		To modify your password, please click on the link below.'."\n".$link.'
		-------------
		Do not reply.';
		mail($recipient, $subject, $message, $header);
		echo "<script>alert('A code has been sent to your mail, please check it');</script>";
$header = "From camagru@42.fr";
mail($recipient, $subject, $msg, $header);
}
?>
