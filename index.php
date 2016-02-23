<?php 
# Script 2.4 - index.php

/*
 * This is the main page.
 * This page includes the configuration file,
 * the templates, and any content-specific modules.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require the configuration file before any PHP code:
require('/app/includes/config.inc.php');

// the db file:
require('/app/includes/DbPdoClass.class.php');

// Validate what page to show:
if(isset($_GET['p']))
{
	$p = $_GET['p'];
}
elseif(isset($_POST['p']))
{
	$p = $_POST['p'];
}
else
{
	$p = NULL;
}

// Determine what page to display:
switch($p)
{
	case 'about':
		$page = 'about.inc.php';
		$page_title = 'About This Site';
		break;
		
	case 'contact':
		$page = 'contact.inc.php';
		$page_title = 'Contact Us';
		break;
		
	case 'search':
		$page = 'search.inc.php';
		$page_title = 'Search Results';
		break;
		
	default:
		//$page = 'main.inc.php';
		//$page_title = 'Site Home Page';
		$page = 'testdb.php';
		//$page = 'testmap.php';
		$page_title = 'Testing Page';
		break;
}

// Make sure the file exists:
if(!file_exists('/app/modules/' . $page))
{
	$page = 'main.inc.php';
	$page_title = 'Site Home Page';
}

// Include the header file:
include('/app/includes/header.inc.html');

// Include the content-specific module:
// $page is determined from the above switch.
include('/app/modules/' . $page);

// Include the footer file to complete the template:
include('/app/includes/footer.inc.html');
