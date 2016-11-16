<?php
session_start();

function caramail2($mail){
$array = explode("/", $_SERVER['REQUEST_URI']);
$path = $array[1];


$recipient = $mail;
$link = 'http://localhost:8080/'.$path.'/solo.php?id=' .$_SESSION['img_id'];
$subject = 'Votre photo a recu un commentaire !';
$header = "From camagru@42.fr";
$msg = 	'Hey Bro !
		Your photo received a new comment !.'."\n".$link.'
		-------------
		Do not reply.';
		mail($recipient, $subject, $msg, $header);
}
?>
