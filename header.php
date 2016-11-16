<?php
session_start();

 ?>

 <!DOCTYPE html>
 <html>
 	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
 		<meta charset="utf-8">
		<title>CAMAGRU</title>
		<div class="header">
			<ul>
			<li id="accueil"><a href="index.php">Camagru</a></li>
			<?php if($_SESSION['login'] !== "" AND !empty($_SESSION['login'])){?>
				<li id="gallerie"><a href="cam.php">Members</a></li>
			 <li id="gallerie"><a href="profil.php">Profil</a></li>
			 <li id="gallerie"><a href="gallery.php">Galerie</a></li>
			 <li id="logout"><a href="deco.php">Logout</a></li>
			 <?php }
			 else
				?>
			<li id="gallerie" style="display:none;"><a href="cam.php">Members</a></li>
			<li id="gallerie" style="display:none;"><a href="gallery.php">Galerie</a></li>
			 <li id="gallerie" style="display: none;"><a href="/connection/profil.php">Profil</a></li>
			 <li id="logout" style="display:none;"><a href="deco.php">Logout</a></li>

			 <?php?>
</ul>

	</div>
	<footer>© 2016 atrang</footer>
 	</head>
 </html>
