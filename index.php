<?php
require_once('config/startup.php');
session_start();
include('header.php');
if (!$sql_co = startup())
	echo "ERROR";
?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
	</head>
	<body>
		<div class="container2">
			<br /><br /><br />
			<form method="post">
	      <input type="button" value="Create Account"  onclick="window.location='connec.php';">
	      <input type="button" value="Login"  onclick="window.location='login.php'">
		  <input type="button" value="Members Area"  onclick="window.location='cam.php';" >
		  <input type="button" value="Gallery"  onclick="window.location='gallery.php';" >

	  </form>
		<!-- <div class="menu">
			<div class="round-button"><div class="round-button-circle"><a href="connec.php" class="round-button">Create account</a></div></div>
			<div class="round-button"><div class="round-button-circle"><a href="login.php" class="round-button">Login</a></div></div>
			<div class="round-button"><div class="round-button-circle"><a href="cam.php" class="round-button">Acces Membres</a></div></div>
		</div> -->
		<!-- </div> -->
	</body>
</html>
