<?php
function startup()
{
	require_once('database.php');
	try {
		$sql_co = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$sql_co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $error) {
		return (NULL);
	}
	return ($sql_co);
}
?>
