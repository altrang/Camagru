<?php
header("Content-type: image/png");
header("Content-type: image/jpeg");

$image_64 = file_get_contents('php://input');
$image_64 = substr($image_64, strpos($image_64, ",")+1);
$image = base64_decode($image_64);
$im = imagecreatefromstring($image);
$src = $_GET['filter'] . ".png";
ob_start();
$filtre = imagecreatefrompng($src);
list($largeur, $hauteur) = getimagesize($src);
if ($_GET['filter'] == "barbee")
	imagecopy($im, $filtre, 100, 120, 0, 0, $largeur, $hauteur);
elseif($_GET['filter'] == "chapeauu")
{
	imagecopy($im, $filtre, 120, 8, 0, 0, $largeur, $hauteur);
}
elseif($_GET['filter'] == "palmierr")
{
	imagecopy($im, $filtre, 120, 8, 0, 0, $largeur, $hauteur);
}
imagepng($im);
$contents = ob_get_contents();
ob_end_clean();
echo "data:image/png;base64,".base64_encode($contents)."";
?>
