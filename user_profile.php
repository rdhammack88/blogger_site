<?php
$TITLE = "User Profile";
require_once("includes/connection.php");
require_once("includes/functions.php");
session_start();

if(!isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id'])) { 
	header("Location: login.php");
}




require_once("includes/header.php");

//if(isset($_SESSION['loggedInUser'])) {
	$user_id = $_SESSION['user_id'];
	
	$query = "SELECT * FROM blog_posts
			  WHERE user_id = $user_id
			  ORDER BY date_created DESC";
	$result = mysqli_query($conn, $query);
//}
modalCaller();
//echo '<br/><main class="row">';
//
//echo '<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">';
?>


<br/><main class="row">
<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">






</section>
</main>