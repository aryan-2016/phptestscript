<?php
$db = new DbPdoClass();
$db->prepareQuery('INSERT INTO users (user_name, user_password) VALUES (:user_name, :user_password)');
$db->bindQueryValue(':user_name', 'John');
$db->bindQueryValue(':user_password', 'Smith');
$db->executeQuery();
echo '<br>lastInsertId=' . $db->lastInsertId();
$db->prepareQuery('SELECT user_name, user_password FROM users WHERE user_name = :user_name');
$db->bindQueryValue(':user_name', 'John');
$row = $db->fetchSingleRow();
echo "<br>row=<pre>";print_r($row);echo "</pre>";
