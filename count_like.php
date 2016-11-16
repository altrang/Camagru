<?php

session_start();
require_once('config/startup.php');

if (!$sql_co = startup())
	echo "ERROR";

$req = $sql_co->prepare("SELECT * FROM likes WHERE img_id = ? ");
$req->execute(array($img_id));
$result = $req->rowCount();
echo $result;


 ?>
