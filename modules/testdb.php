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
	/*$db->prepareQuery('create table users(id INT NOT NULL, user_name character varying(20) NOT NULL, user_password character varying(20) NOT NULL, CONSTRAINT user_pkey PRIMARY KEY (id))');
	$db->executeQuery();
	echo '<br>table created';*/
	
	$db->prepareQuery('INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)');
	$db->bindQueryValue(':user_name', 'John');
	$db->bindQueryValue(':user_password', 'Smith');
	$db->executeQuery();
	echo '<br>lastInsertId=' . $db->lastInsertId();
	
	$db->prepareQuery('SELECT user_name, user_password FROM users WHERE user_name = :user_name');
	$db->bindQueryValue(':user_name', 'John');
	$row = $db->fetchSingleRow();
	echo "<br>row=<pre>";print_r($row);echo "</pre>";
} 
catch(PDOException $e) 
{
    echo 'error: ' . $e->getMessage();
}
