<?php
session_start();
require_once('config/startup.php');
include("header.php");
require_once('redirect.php');

if(!$sql_co = startup())
	echo "ERROR";
sleep(2);
if($_SESSION['login'] == "")
	redirect('index.php');

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<!-- <div>
		<div class="menu">
			 <a href="recup_mail.php"><input type="button" value="Changer de pass" name="change mdp"></a>
			 <a href="delete.php"><input type="button" value="Supprimer le compte" name="delete"></a>
			<a href="user_photo.php"><input type="button" value="Voir ses photos" name="photo"></a>
		</div>
		</div> -->
		<div class="container2">
			<br /><br /><br />

			<form method="post">
	      <input type="button" placeholder="Enter Username" value="Change Password"  onclick="window.location='recup_mail.php';">
	      <input type="button" placeholder="Enter Password" value="Delete Account"  onclick="check()">
		  <input type="button" placeholder="Enter Password" value="My Pictures"  onclick="window.location='user_photo.php';" >

	  </form>
<script>

function check(){
if (confirm('Are You Sure?')){
   window.location = "delete.php";
}else{
   alert("Delete canceled")
}
}
</script>
	  </div>
	</body>
</html>
