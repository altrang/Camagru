<?php

session_start();
include("header.php");
require_once('config/startup.php');
require_once('redirect.php');

if (!$sql_co = startup())
	echo "ERROR";
$id = $_SESSION['img_id'];
if($_SESSION['delete'] == 0)
redirect('index.php');
$req = $sql_co->prepare("DELETE FROM images WHERE id = ? ");
$req->execute(array($id));
redirect('gallery.php');
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="erreur">Photo supprimee !</div>
	</body>
</html>
