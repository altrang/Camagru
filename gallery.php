<?php
require_once('config/startup.php');
session_start();
include('header.php');
if (!$sql_co = startup())
	echo "ERROR";

$req = $sql_co->prepare("SELECT COUNT(*) as nbrImage FROM images");
$req->execute(array());
$res = $req->fetch();

$perpage = 4;
$nbrImage = $res['nbrImage'];
$nbrPage = ceil($nbrImage / $perpage);

if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbrPage)
{
	$cPage = $_GET['p'];
}
else {
	$cPage = 1;
}

$pp = ($cPage - 1) * $perpage;
$req1 = $sql_co->prepare('SELECT id,img FROM images ORDER BY id DESC LIMIT '.$pp.', '.$perpage.'');
$req1->execute(array());
while ($photo = $req1->fetch())
echo '<div id="galphoto"> <a href="solo.php?id='.$photo[0].'"><img src="' .  $photo[1] . '" id="gallery" alt="gallery"></div>';


for($i = 1; $i <= $nbrPage; $i++)
{
	if ($i == $cPage)
	{
		echo "<div id='galerie'>$i /</div>";
	}
	else
		echo "<div id='galerie' class='galerie'><a href=\"gallery.php?p=$i\">$i </a></div>	";
}
?>
