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
	
	//$db->prepareQuery('CREATE TABLE users(id SERIAL NOT NULL, user_name character varying(20) NOT NULL, user_password character varying(20) NOT NULL, CONSTRAINT users_pkey PRIMARY KEY (id))');
	$db->prepareQuery('CREATE TABLE users(id SERIAL NOT NULL, user_name character varying(128) NOT NULL, user_password character varying(128) NOT NULL, user_email character varying(128) NOT NULL, user_role character varying(64) NOT NULL, created_time timestamp DEFAULT current_timestamp, last_modified_time timestamp DEFAULT current_timestamp, status  smallint NOT NULL DEFAULT 1, CONSTRAINT users_pkey PRIMARY KEY (id))');
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
	
	$db->prepareQuery('DELETE FROM users WHERE user_name = :user_name');
	$db->bindQueryValue(':user_name', 'aryan');
	$db->executeQuery();
	echo '<br>record deleted';
	
	// google map integration
	/*$createmaptable = 'CREATE TABLE IF NOT EXISTS maps (
							id SERIAL,
							center_lat numeric(5,3),
							center_long numeric(6,3),
							zoom  smallint,
							CONSTRAINT maps_pkey PRIMARY KEY (id)
						);';
	$db->prepareQuery($createmaptable);
	$db->executeQuery();
	echo '<br>maptable created';
	
	$createmappointtable = 'CREATE TABLE IF NOT EXISTS mappoints (
								id SERIAL,
								map_id int, 
								point_lat numeric(5,3),
								point_long numeric(6,3),
								point_text text,
								CONSTRAINT mappoints_pkey PRIMARY KEY (id)
							);';
	$db->prepareQuery($createmappointtable);
	$db->executeQuery();
	echo '<br>mappointtable created';*/
	
	/*$maps = array(
			array(45.52, -122.682, 9), 
			array(-33.98, 18.424, 10), 
			array(57.48, -4.225, 12)
		);
				
	foreach ($maps as $ind) 
	{
		$newline = "INSERT INTO maps (center_lat, center_long, zoom) VALUES ($ind[0], $ind[1], $ind[2])";
		$db->prepareQuery($newline);
		$db->executeQuery();
		echo '<br>maps record inserted';
	}*/
	 
	/*$mappoints = array(
			  array(1, 45.249, -122.897, "Champoeg State Park"), 
			  array(1, 45.374, -121.696, "Mount Hood"), 
			  array(2, -33.807, 18.366, "Robben Island"), 
			  array(2, -33.903, 18.411, "Cape Town Stadium"), 
			  array(3, 57.481, -4.225, "Inverness Bus Station"), 
			  array(3, 57.476, -4.226, "Inverness Castle"), 
			  array(3, 57.487, -4.139, "The Barn Church") 
			);
	 
	foreach ($mappoints as $indpt) 
	{
		$newline = "INSERT INTO mappoints (map_id, point_lat, point_long, point_text) VALUES ($indpt[0], $indpt[1], $indpt[2], '$indpt[3]')";
		$db->prepareQuery($newline);
		$db->executeQuery();
		echo '<br>mappoints record inserted';
	}*/
} 
catch(PDOException $e) 
{
    echo '<br>error: <pre>' . $e->getMessage();
}
