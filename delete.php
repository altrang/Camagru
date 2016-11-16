<?php

require_once('config/startup.php');
session_start();
include ("header.php");
require_once('redirect.php');


if (!$sql_co = startup())
	echo "Error BDD";
if ($_SESSION['login'] == "" || empty($_SESSION['login']))
redirect("index.php");
$login = $_SESSION['login'];

$req = $sql_co->prepare("DELETE from users WHERE login = ?");
$req->execute(array($login));
session_destroy();
redirect("index.php");

 ?>