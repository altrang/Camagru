<?php
require_once('config/startup.php');
session_start();
require_once('redirect.php');
//include('header.php');

if (!$sql_co = startup())
	echo "ERROR";

$i = 0;
$req = $sql_co->prepare("SELECT img from images ORDER BY id desc LIMIT 3");
$req->execute(array());
echo '	   <div class="side" id="side">Dernieres Photos
<br /><br />';
while ($photo = $req->fetch())
{
	echo '<a href="gallery.php"><img src="'.$photo[0].'" id="last" alt="last">';
}
echo '</div>';

 ?>
