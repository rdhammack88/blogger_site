<?php define( "TITLE", "User blogs" ); ?>
<?php

session_start();

$alertMessage = '';

if( !$_SESSION['loggedInUser'] ) {
	/*echo 'not logged in!';*/
	// send them to the login page
	header("Location: login.php");
} //else {
	/*echo 'logged in';*/

// connect to the database
include('includes/connection.php');

$user_id = $_SESSION['user_id'];

// query & results
$query = "SELECT user_id, blog_title, blog_post, blog_category,
	date_format(date_created, '%m/%d/%Y') date_created
	FROM blog_posts WHERE user_id='$user_id'"; 
	//. "$_SESSION[" . 'id' . "]"		// %W 
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {

	// new client added
	if( $_GET['alert'] == 'logged_in' || $_GET['alert'] == 'success' ) {
		$alertMessage = "<div class='alert alert-success'>You are logged in! <a class='close' data-dismiss='alert'>&times;</a></div>";
	} 
	// client updated
	elseif( $_GET['alert'] == 'updatesuccess' ) {
		$alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
	// client deleted
	elseif( $_GET['alert'] == 'deleted' ) {
		$alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}
//}

// close the connection
mysqli_close( $conn );

include('includes/header.php');
echo $alertMessage; 
?>

<!--<h1>Your recent blogs</h1>-->

<?php //echo $alertMessage; ?>

<main class="row">
	
	<!-- aside>nav.blogTopics>ul>li*8>a[href=#] -->
	<aside id="blogTopics" class="col-sm-3 col-md-3">
		<nav>
			<h4 class="">Most Popular Topics</h4>
			<ul>
				<li><a href="#">Lorem</a></li>
				<li><a href="#">Hic</a></li>
				<li><a href="#">Cum</a></li>
				<li><a href="#">Esse</a></li>
				<li><a href="#">Fugiat</a></li>
				<li><a href="#">Quibusdam</a></li>
				<li><a href="#">Totam</a></li>
				<li><a href="#">Soluta</a></li>
			</ul>
		</nav>
	</aside>
	
	<!-- Main Blog Article Content -->
	<section id="blogSection" class="col-sm-8 col-sm-offset-1">

		<small class="text-danger no-blogs">Most Recent Blog Posts...</small>
		
    
    <?php
	
	if( mysqli_num_rows( $result ) > 0 ) {
		
		// we have data
		// output the data
		
		while( $row = mysqli_fetch_assoc($result) ) {
			//$date_created = $row['date_created']; /// $row['date_created']
			//$date = date_format($date_created, 'd-m-Y');
			echo "<article>";
			
			echo "<div class='blog-title'><h2>" . $row['blog_title'] . "</h2><a><p class='date_posted'>". $row['date_created'] . "</p></a></div><p>". $row['blog_post'] . "</p>";
			echo "</article>";			
				//$row['date_created']
		}
	} else {
		echo "<div class='alert alert-danger'>You have no blog posts!</div>";
	}
	
//	mysqli_close($conn);
	
include('includes/header.php');
	?>
    
    <!--<tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>-->














<?php include('includes/footer.php'); ?>
