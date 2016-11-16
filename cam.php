<?php
require_once('config/startup.php');
session_start();
require_once('redirect.php');
include('header.php');

if (!$sql_co = startup())
	echo "ERROR";
if ($_SESSION['login'] == "" || empty($_SESSION['login']))
{
	redirect('erreur.php');
}
$req = $sql_co->prepare("SELECT login FROM users WHERE login = ? AND confirme = '1'");
$req->execute(array($_SESSION['login']));
$count = $req->rowCount();
if ($count == 0)
redirect('erreur.php');

 ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">

  </head>
   <body>
	   <div class="side" id="side">Dernieres Photos
		 <br /><br />
		 <?php
		 	$i = 0;
		 	$req = $sql_co->prepare("SELECT img from images ORDER BY id desc LIMIT 3");
			$req->execute(array());
			while ($photo = $req->fetch())
			{
				echo '<a href="gallery.php"><img src="'.$photo[0].'" id="last" alt="last"></a>';
			}

		  ?>
	   </div>
	   <img src="barbee.png" id="barbe">
	   <img src="chapeauu.png" id="chapeau">
	   <img src="palmierr.png" id="palmier">
	   <video id="video">salut</video>
	   <canvas id="canvas">salut</canvas>
	   <img src="kitten.jpg" id="photo" alt="photo">
	   <div class="filter">
		   Palmier : <input type="radio" onclick="preview(this.id)" id="palmierr" name="filter" value="palmierr">
		   Barbe : <input type="radio" onclick="preview(this.id)" id="barbee" name="filter" value="barbee">
		   Chapeau : <input type="radio" onclick="preview(this.id)" id="chapeauu" name="filter" value="chapeauu">

	   </div>
	   <button id="startbutton">Prendre une photo</button>
	   <div id="upload"> Or upload pic
		   <input  id="file" type="file" onchange="previewFile()" ><br>
		   <button  value="prendre une photo" onclick="takepicture1()" name="Prendre une Photo Upload">Prendre une Photo Upload</button>
	   </div>
	   <script src="js/cam.js"></script>
	   <script src="js/upload.js"></script>
	   <script>
	   function preview(id)
	   {
		   if (id == "barbee")
		   {
		   		var obj = document.querySelector('#barbe');
				obj.style.display = "block";
				document.querySelector('#chapeau').style.display = "none";
				document.querySelector('#palmier').style.display = "none";
			}
		   else if (id == "chapeauu")
		   {
		   		var obj = document.querySelector('#chapeau');
				obj.style.display = "block";
				document.querySelector('#palmier').style.display = "none";
				document.querySelector('#barbe').style.display = "none";
		   }
		   else if (id == "palmierr")
		   {
		   		var obj = document.querySelector('#palmier');
				obj.style.display = "block";
				document.querySelector('#barbe').style.display = "none";
				document.querySelector('#chapeau').style.display = "none";
		   }
	   }
	   </script>

   </body>
</html>
