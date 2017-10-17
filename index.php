<?php


session_start();

// connect to the database
include('includes/connection.php');

//if( !$_SESSION['loggedInUser'] ) {
	$alertMessage = '';
	
//echo "This is line " . __LINE__ . " in file " . __FILE__;
	// query & results
	$query = "SELECT blog_title, blog_post, blog_category,
		date_format(date_created, '%m/%d/%Y') date_created
		FROM blog_posts LIMIT 10"; 
		//. "$_SESSION[" . 'id' . "]"		// %W 
	$result = mysqli_query( $conn, $query );

//echo "This is line " . __LINE__ . " in file " . __FILE__;
	// close the connection
	mysqli_close( $conn );
//} 

/*if( $_SESSION['loggedInUser']) {
	
	$user_id = $_SESSION['user_id'];

	// query & results
	$query = "SELECT user_id, blog_title, blog_post, blog_category,
		date_format(date_created, '%m/%d/%Y') date_created
		FROM blog_posts WHERE user_id='$user_id'"; 
		//. "$_SESSION[" . 'id' . "]"		// %W 
	$result = mysqli_query( $conn, $query );

	// check for query string
	if( isset( $_GET['alert'] ) ) {

		// user signed in
		if( $_GET['alert'] == 'logged_in' ) {
			$alertMessage = "<div class='alert alert-success'>You are logged in! <a class='close' data-dismiss='alert'>&times;</a></div>";
		} 
		// user logged out
		elseif( $_GET['alert'] == 'logged_out' ) {
			$alertMessage = "<div class='alert alert-success'>You have been logged out! <a class='close' data-dismiss='alert'>&times;</a></div>";
		}
		// new user added
		elseif( $_GET['alert'] == 'new_user' ) {
			$send_to = $email;
			$subject = 'Your signed up!';
			$message = "Dear $first_name, \n\tThank you for signing up to Blogger.com";
			mail( $send_to, $subject, $message );
		}
	}

}*/
	

include('includes/header.php');
?>


<?php echo $alertMessage; ?>

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

		<small class="text-danger">Most Recent Blog Posts...</small>
		
			
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
	
	?>	
			



	</section>
</main>




<?php // include('blogs.php'); ?>
<?php include('includes/footer.php'); ?>