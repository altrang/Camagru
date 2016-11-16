<?php

session_start();
require_once('config/startup.php');

if (!$sql_co = startup())
	echo "ERROR";

$req = $sql_co->prepare("INSERT INTO likes(user_id, img_id) VALUES(?,?)");
$req->execute(array($_SESSION['user_id'], $_SESSION['img_id']));



$img_id = $_SESSION['img_id'];
$user_id = $_SESSION['user_id'];

$req = $sql_co->prepare("SELECT * FROM likes WHERE user_id = ? AND img_id = ? ");
$req->execute(array($user_id, $img_id));
$result = $req->rowCount();
echo $result;


 ?>
