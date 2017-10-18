<?php


session_start();

// connect to the database
include('includes/connection.php');

//if( !$_SESSION['loggedInUser'] ) {
	$alertMessage = '';
	
//echo "This is line " . __LINE__ . " in file " . __FILE__;
	// query & results

//$query = "SELECT blog_category 
//		FROM blog_posts 
//		HAVING COUNT(blog_catefory) >= 2";
//	
//$query .= "SELECT blog_title, blog_post, blog_category,
//	date_format(date_created, '%m/%d/%Y') date_created
//	FROM blog_posts 
//	LIMIT 10"; 

	//. "$_SESSION[" . 'id' . "]"		// %W 
//$result = mysqli_query( $conn, $query );
	

//$result = mysqli_multi_query( $conn, $query );
//mysqli_close( $conn );



//	$topic_query = "SELECT blog_category 
//		FROM blog_posts 
//		HAVING COUNT(blog_catefory) >= 2 ";

	//close the connection
	//mysqli_close( $conn );
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

<div class="row"></div>

<br/><br/>

<div class="row text-right">
	<small class="text-danger">Most Recent Blog Posts...</small>
</div>

<main class="row">

	<!-- aside>nav.blogTopics>ul>li*8>a[href=#] -->
	<aside id="blogTopics" class="col-sm-3 col-md-3">
		<nav>
			<h4 class="text-center">Most Popular Topics</h4>
			<?php
			
			$query = "SELECT blog_category 
			FROM blog_posts
			GROUP BY blog_category
			HAVING COUNT(*) >= 2";
			//HAVING COUNT(*) > 2 ";
			$result = mysqli_query( $conn, $query );
			//mysqli_close( $conn );

			
			/*if ($result = mysqli_query($conn, $query)) { printf("Select returned %d rows.\n", mysqli_num_rows($result));}*/
			
			
			if(!$result) { printf(mysqli_error($conn)); }
			
			
			
			//if( mysqli_multi_query( $conn, $query) ) {
			if( mysqli_num_rows( $result ) > 0 ) {
				//while ($row = mysqli_fetch_assoc($result) ) {
//				do {
//					if( $result = mysqli_store_result( $conn ) ) {

						// we have data
						// output the data

				while( $row = mysqli_fetch_assoc($result) ) {
					//$date_created = $row['date_created']; /// $row['date_created']
					//$date = date_format($date_created, 'd-m-Y');
					echo "<ul>";

					echo "<li><a>" . $row['blog_category'] . "</a></p>";
					echo "</ul>";			
				}

				mysqli_free_result( $result );
			}
			
				//}
				
			?>
<!--
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
-->
		</nav>
	</aside>
	
	<!-- Main Blog Article Content -->
	<section id="blogSection" class="col-sm-8 col-sm-offset-1">
		
<!--		<small class="text-danger">Most Recent Blog Posts...</small>-->
		
			
	<?php
	$query = "SELECT blog_title, blog_post, blog_category,
		date_format(date_created, '%m/%d/%Y') date_created
		FROM blog_posts 
		ORDER BY date_created DESC
		LIMIT 10"; 
		//. "$_SESSION[" . 'id' . "]"		// %W 
	$result = mysqli_query( $conn, $query );
	mysqli_close( $conn );

	if( mysqli_num_rows( $result ) > 0 ) {
	
		// we have data
		// output the data
			
		//while( mysqli_next_result( $conn ) ) {
		while( $row = mysqli_fetch_assoc($result) ) {
			echo "<article>";
			echo "<div class='blog_title'><h2>" . $row['blog_title'] . "</h2><a><p class='date_posted'>". $row['date_created'] . "</p></a></div><p>". $row['blog_post'] . "</p>";
			echo "</article>";			
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