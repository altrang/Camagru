<?php
require_once('config/startup.php');
session_start();

if(!$sql_co = startup())
	echo "ERROR";
$data = file_get_contents('php://input');
$login = htmlspecialchars($_SESSION['login']);
$mail = $_SESSION['mail'];
$requete = $sql_co->prepare("INSERT INTO images(img, login, mail) VALUES(?, ?, ?)");
$requete->execute(array($data, $login, $mail));
 ?>
