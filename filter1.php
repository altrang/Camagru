<?php
header("Content-type: image/png");
header("Content-type: image/jpeg");


$image_64 = file_get_contents('php://input');
file_put_contents('img.png', base64_decode($image_64));
$image_64 = substr($image_64, strpos($image_64, ",")+1);
$image = base64_decode($image_64);
$source = imagecreatefromstring($image);
$src = $_GET['filter'] . ".png";
ob_start();
$filtre = imagecreatefrompng($src);
list($largeur, $hauteur) = getimagesize($src);
$thumb = imagecreatetruecolor(400, 300);
imagecopyresized($thumb, $source, 0, 0, 0, 0, 400, 300, $largeur, $hauteur);
if ($_GET['filter'] == "barbee")
	imagecopy($thumb, $filtre, 100, 120, 0, 0, $largeur, $hauteur);
elseif($_GET['filter'] == "palmierr")
{
	imagecopy($thumb, $filtre, 120, 8, 0, 0, $largeur, $hauteur);
}
elseif($_GET['filter'] == "chapeauu")
{
	imagecopy($thumb, $filtre, 120, 4, 0, 0, $largeur, $hauteur);
}

imagejpeg($thumb);
$contents = ob_get_contents();
ob_end_clean();
echo "data:image/png;base64,".base64_encode($contents)."";



 ?>
