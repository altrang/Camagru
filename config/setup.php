<?php
	require_once('database.php');
	try {
		$sql_co = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$sql_co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $error) {
		echo "FAIL " . $error->getMessage();
	}

	//creation de la table USERS
	$query = $sql_co->prepare("CREATE TABLE IF NOT EXISTS users (
								id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
								login VARCHAR(20) NOT NULL,
								passwd VARCHAR(255),
								mail VARCHAR(255),
								confirme INT(1),
								confirmkey VARCHAR(255));");
	$ret = $query->execute();

	//creation de la table recuperation de mail
	$query1 = $sql_co->prepare("CREATE TABLE IF NOT EXISTS recup (
								id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
								mail VARCHAR(255),
								code INT);");
	$ret1 = $query1->execute();

	//creation de la table images
	$query2 = $sql_co->prepare("CREATE TABLE IF NOT EXISTS images (
								id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
								img MEDIUMTEXT,
								login VARCHAR(20),
								mail VARCHAR(255));");
	$ret2 = $query2->execute();

	//creation de la table LIKE
	$query2 = $sql_co->prepare("CREATE TABLE IF NOT EXISTS likes (
								id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
								user_id INT,
								img_id INT);");
	$ret2 = $query2->execute();

	//creation de la table comment
	$query3 = $sql_co->prepare("CREATE TABLE IF NOT EXISTS comment (
								id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
								img_id INT NOT NULL,
								login VARCHAR(20) NOT NULL,
								comment TEXT,
								date_creation DATETIME);");
	$ret3 = $query3->execute();


	if (!ret)
		die("ERROR");
	/*$query = $sql_co->prepare("INSERT INTO users (login)
												VALUES (
												:login)");
	$query->execute(array('login' => 'admin'));

	$query = $sql_co->prepare("INSERT INTO users(login) VALUES (:login)");
	$query->execute(array('login' => 'admin'));*/

?>
