<?php
require_once('redirect.php');

session_start();
session_destroy();
include('header.php');
redirect('index.php');

 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title></title>
	</head>
	<body>
		<h2>Vous venez de vous deconnecter</h2>
	</body>
</html>
