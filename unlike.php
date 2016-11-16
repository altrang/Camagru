<?php
session_start();
require_once('config/startup.php');

if (!$sql_co = startup())
	echo "ERROR";


$img_id = $_SESSION['img_id'];
$user_id = $_SESSION['user_id'];

$req = $sql_co->prepare("SELECT * FROM likes WHERE user_id = ? AND img_id = ? ");
$req->execute(array($user_id, $img_id));
$result = $req->rowCount();

$req = $sql_co->prepare("DELETE FROM likes WHERE user_id = ?");
$req->execute(array($_SESSION['user_id']));
echo $result;
?>
