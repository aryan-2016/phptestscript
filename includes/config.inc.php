<?php
// Errors are emailed here:
$contact_email = '';

// Determine whether we're working on a local server
$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if(in_array($host, array('local', '17.0', '19.1')))
{
	$local = TRUE;
}
else
{
	$local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if($local)
{
	// Always debug when running locally:
	$debug = TRUE;
	
	// Define the constants:
	define('BASE_URI', '/path/to/html/folder/');
	define('BASE_URL', 'http://localhost/directory/');
	define('DB', '/path/to/mysql.inc.php');
}
else
{
	define('BASE_URI', 'app/');
	define('BASE_URL', 'https://phptestscript.herokuapp.com/');
	define('DB', 'DbPdoClass.class.php');
}

/*
 * Most important setting!
 * The $debug variable is used to set error management.
 * To debug a specific page, add this to the index.php page:

 if ($p == 'thismodule') $debug = TRUE;
 require('./includes/config.inc.php');

 * To debug the entire site, do

 $debug = TRUE;

 * before this next conditional.
 */
 
 // Assume debugging is off.
 if(!isset($debug))
	$debug = FALSE;
	
# ***** SETTINGS ***** #

# ***** ERROR MANAGEMENT ***** #
// Create the error handler:
/*function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{
	global $debug, $contact_email;
	
	// Build the error message:
	$message = 'An error occurred in script "' . $e_file . '" on line ' . $e_line . ': ' . $e_message;
	
	// Append $e_vars to the $message:
	$message .= print_r($e_vars, 1);
	
	if($debug)
	{
		// Show the error.
		echo '<div class="error">' . $message . '</div>';
		debug_print_backtrace();
	}
	else
	{
		// Log the error:
		error_log($message, 1, $contact_email); // Send email.
		
		// Only print an error message if the error isn't a notice or strict.
		if(($e_number != E_NOTICE) && ($e_number < 2048))
		{
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
		}
	} // End of $debug IF.
} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');*/

# ***** ERROR MANAGEMENT ***** #
