<?php
/* Database Variables */
$server 	= "localhost";
$username 	= "#########";
$password 	= "########";
$db 		= "blogger";

/* create connection */
$conn = mysqli_connect( $server, $username, $password, $db );

/* check connection */
if( !$conn ) {
	die( "Connection failed: " . mysqli_connect_error() ) ;
}
?>
