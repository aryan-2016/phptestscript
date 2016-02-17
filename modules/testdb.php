<?php
// Redirect if this page was accessed directly:
if(!defined('BASE_URL'))
{
	// Need the BASE_URL, defined in the config file:
	include('../includes/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL . 'index.php';
	header("Location : $url");
	exit;
}

$db = new DbPdoClass();

try 
{
	/*$db->prepareQuery('DROP TABLE users');
	$db->executeQuery();
	echo '<br>table droped';
	
	$db->prepareQuery('CREATE TABLE users(id SERIAL NOT NULL, user_name character varying(20) NOT NULL, user_password character varying(20) NOT NULL, CONSTRAINT users_pkey PRIMARY KEY (id))');
	$db->executeQuery();
	echo '<br>table created';*/
	
	/*$db->prepareQuery('INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)');
	$db->bindQueryValue(':user_name', 'John');
	$db->bindQueryValue(':user_password', 'Smith');*/
	/*$db->prepareQuery("INSERT INTO users (user_name, user_password) VALUES ('John', 'Smith')");
	$db->executeQuery();
	echo '<br>lastInsertId=' . $db->lastInsertId();*/
	
	/*$db->prepareQuery('SELECT user_name, user_password FROM users WHERE user_name = :user_name');
	$db->bindQueryValue(':user_name', 'John');
	//$db->prepareQuery("SELECT user_name, user_password FROM users WHERE user_name = 'John'");
	$row = $db->fetchSingleRow();
	//$rows = $db->fetchResultset();
	echo "<br>row=<pre>";
	print_r($row);
	//var_dump($rows);
	echo "</pre>";*/
	
	// google map integration
	$createmaptable = 'CREATE TABLE IF NOT EXISTS maps (
							ID int AUTO_INCREMENT,
							PRIMARY KEY (ID),
							centerLat decimal (5,3),
							centerLong decimal (6,3),
							zoom  tinyint
						);';
	$db->prepareQuery($createmaptable);
	$db->executeQuery();
	echo '<br>maptable created';
	
	$createmappointtable = 'CREATE TABLE IF NOT EXISTS mappoints (
								ID int AUTO_INCREMENT,
								PRIMARY KEY (ID),
								mapID int, 
								pointLat decimal (5,3),
								pointLong decimal (6,3),
								pointText text
							);';
	$db->prepareQuery($createmappointtable);
	$db->executeQuery();
	echo '<br>mappointtable created';
	
	$maps = array(
					array(1, 45.52, -122.682, 9), 
					array(2, -33.98, 18.424, 10), 
					array(3, 57.48, -4.225, 12)
				); 
	 
	$mappoints = array(
						  array(1, 45.249, -122.897, "Champoeg State Park"), 
						  array(1, 45.374, -121.696, "Mount Hood"), 
						  array(2, -33.807, 18.366, "Robben Island"), 
						  array(2, -33.903, 18.411, "Cape Town Stadium"), 
						  array(3, 57.481, -4.225, "Inverness Bus Station"), 
						  array(3, 57.476, -4.226, "Inverness Castle"), 
						  array(3, 57.487, -4.139, "The Barn Church") 
					);
	 
	foreach ($maps as $ind) 
	{
		$newline = "INSERT INTO maps (ID, centerLat, centerLong, zoom) VALUES ($ind[0], $ind[1], $ind[2], $ind[3])";
		$db->prepareQuery($newline);
		$db->executeQuery();
		echo '<br>maps record inserted';
	}
	 
	foreach ($mappoints as $indpt) 
	{
		$newline = "INSERT INTO mappoints (mapID, pointLat, pointLong, pointText) VALUES ($indpt[0], $indpt[1], $indpt[2], '$indpt[3]')";
		$db->prepareQuery($newline);
		$db->executeQuery();
		echo '<br>mappoints record inserted';
	}
} 
catch(PDOException $e) 
{
    echo '<br>error: <pre>' . $e->getMessage();
}
