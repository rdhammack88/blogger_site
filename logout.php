<?php
session_start();
// did the user's browser send a cookie for the session?
if( isset( $_COOKIE[ session_name() ] ) ) {
	
	// empty the cookie
	setcookie( session_name(), '', time()-86400, '/');
}

// clear all session variables
session_unset();

// destroy the session
session_destroy();

if(isset($_GET['deleted_user'])) {
	header("Location: index.php?alert=deleted_user");
} else {
	header("Location: index.php?alert=logged_out");
}

//echo "<h1>Logged out</h1>
//<p class='lead'>You've been logged out. See you next time!</p>";

//include('includes/footer.php');
?>