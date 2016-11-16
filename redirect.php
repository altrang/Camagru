<?php
function redirect($url)
{
	$rootpath = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1);
	echo '<META HTTP-EQUIV="Refresh" Content="1; URL=/' . $rootpath[1] ."/". $url . '">';
}
?>
