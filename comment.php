<?php
include('connection/sendmail3.php');
require_once('config/startup.php');
session_start();

if(!$sql_co = startup())
	echo "Error BDD";

$text = file_get_contents('php://input');
$img_id = $_SESSION['img_id'];
$login = $_SESSION['login'];



$comment = htmlspecialchars($text);
$req1 = $sql_co->prepare("INSERT INTO comment(img_id, login, comment, date_creation) VALUES (?, ?, ?, NOW())");
$req1->execute(array($img_id, $login, $comment));
$mail = $sql_co->prepare("SELECT mail FROM images WHERE id = ? ");
$mail->execute(array($_SESSION['img_id']));
$mail1 = $mail->fetch();
caramail2($mail1[0]);
echo $img_id;
 ?>
