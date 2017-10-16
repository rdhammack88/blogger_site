<?php

$server 	= "localhost";
$username 	= "Dustin";
$password 	= "rusty";
$db 		= "blogger";

// create connection
$conn = mysqli_connect( $server, $username, $password, $db );

// check connection
if( !$conn ) {
	die( "Connection failed: " . mysqli_connect_error() ) ;
} /*else {
	echo "Connected to $db!<br/>";
}*/

?>

<!--
$users = "SELECT * FROM users";
$blogs = "SELECT * FROM blog_posts";-->