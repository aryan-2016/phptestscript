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
echo '<br>c1...';
$db = new DbPdoClass();echo '<br>c2...';
$db->prepareQuery('INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)');echo '<br>c3...';
$db->bindQueryValue(':user_name', 'John');echo '<br>c4...';
$db->bindQueryValue(':user_password', 'Smith');
$db->executeQuery();echo '<br>c5...';
echo '<br>lastInsertId=' . $db->lastInsertId();echo '<br>c6...';
$db->prepareQuery('SELECT user_name, user_password FROM users WHERE user_name = :user_name');echo '<br>c7...';
$db->bindQueryValue(':user_name', 'John');
$row = $db->fetchSingleRow();echo '<br>c8...';
echo "<br>row=<pre>";print_r($row);echo "</pre>";
