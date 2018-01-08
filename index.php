<?php
session_start();

// connect to the database
include('includes/connection.php');
include('includes/functions.php');
$avatar = 'userAvatarDefault.png';

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
	
//////////////////////////////////





 
//else {
//	echo "<p class='text-danger'>No results found!</p>";
//}










//////////////////////////////




// check for query string
if( isset( $_GET['alert'] ) ) {
	// User logged in successfully
	if( $_GET['alert'] == 'logged_in') {
//		$alertMessage = "<div class='alert alert-success'>You are logged in! <a class='close' data-dismiss='alert'>&times;</a></div>";
		$alertMessage = "<div class='alert alert-success'>Welcome " . $_SESSION['loggedInUser'] . "! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

include('includes/header.php');
echo $alertMessage; 
?>


<?php //echo $alertMessage; ?>

<!--<div class="row"></div>-->

<br/><br/>

<div class="row text-right"> <!--  js 373  -->
	<small class="text-danger slide_text">Most Recent Blog Posts...</small>
</div>

<main class="row">

	<!-- aside>nav.blogTopics>ul>li*8>a[href=#] -->
	<aside id="blogTopics" class="col-md-3 hidden-sm"><!--  col-sm-3 -->
		<nav>
			<h4 class="text-center">Popular Topics</h4><!-- Most -->
			<?php
			
			$query = "SELECT blog_category 
			FROM blog_posts
			WHERE public = 'public'
			GROUP BY blog_category
			HAVING COUNT(*) > 1";
			//HAVING COUNT(*) >= 2 ";
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
				echo "<ul>";
				while( $row = mysqli_fetch_assoc($result) ) {
					//$date_created = $row['date_created']; /// $row['date_created']
					//$date = date_format($date_created, 'd-m-Y');
					

					echo "<li><a href='index.php?topic=" . $row['blog_category'] . "'>" . $row['blog_category'] . "</a></li>";
								
				}
				echo "</ul>";
				mysqli_free_result( $result );
			}
			
				//}
				
			?>
		</nav>
	</aside> <!-- End of Blog Topics Section -->
	
	<!-- Main Blog Article Content -->
	<section id="blogSection" class="col-sm-12 col-md-8 col-md-offset-1">
		
<!--		<small class="text-danger">Most Recent Blog Posts...</small>-->
		
			
	<?php
	///////	FALL BACK CODE FOR USERS WITH JAVASCRIPT DISABLED /////////
	//////  FOR BOTH POPULAR TOPICS ASIDE BAR, AND SEARCH    /////////
	if(isset($_GET['topic'])) {
		$topic = $_GET['topic'];
		//$query 		= "SELECT * FROM blog_posts WHERE blog_category = '$topic'";
//		$query 	= "SELECT blog_title, blog_post, blog_category,
//				   date_format(date_created, '%m/%d/%Y') date_created
//				   FROM blog_posts 
//				   WHERE public = 'public'
//				   AND blog_category = '$topic'
//				   ORDER BY date_created DESC";
		$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
				   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
				   blog_posts.blog_category, blog_posts.id AS blog_id,
				   blog_posts.user_id, blog_posts.likes,
				   blog_posts.dislikes, blog_posts.total_comments,
				   users.avatar, users.id,
				   users.email, users.user_name
				   FROM blog_posts
				   LEFT JOIN users ON blog_posts.user_id = users.id
				   WHERE public = 'public'
				   AND blog_category = '$topic'
				   ORDER BY blog_posts.date_created DESC";
		
		queryCaller($conn, $query);
		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
		/*$blogs 	= mysqli_query($conn, $query);

		while( $row = mysqli_fetch_assoc($blogs) ) {
			if (!$row['avatar']) {
				$avatar = 'userAvatarDefault.png';
			} else {
				$avatar = $row['avatar'];
			}
			echo "<article>";
			echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
			echo "</article>";			
		}*/
	}
		
	if(isset($_GET['search'])) {
		$search_query 	= $_GET['search'];
//		$query			= "SELECT blog_title, blog_post, blog_category,
//						   date_format(date_created, '%m/%d/%Y') date_created
//						   FROM blog_posts 
//						   WHERE public = 'public'
//						   AND (blog_title = '$search_query'
//						   OR blog_post = '$search_query'
//						   OR blog_category = '$search_query')
//						   ORDER BY date_created DESC";
		
		
//		SELECT blog_posts.blog_title, blog_posts.blog_post,
//			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
//			   blog_posts.blog_category, blog_posts.id AS blog_id,
//			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
//			   blog_posts.total_comments, users.avatar, users.id,
//			   users.email, users.user_name
//			   FROM blog_posts
//			   LEFT JOIN users ON blog_posts.user_id = users.id
		
		
		$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
				   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
				   blog_posts.blog_category, blog_posts.id AS blog_id,
				   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
				   blog_posts.total_comments, users.avatar, users.id,
				   users.email, users.user_name
				   FROM blog_posts
				   LEFT JOIN users ON blog_posts.user_id = users.id
				   WHERE public = 'public'
				   AND (blog_title = '$search_query'
				   OR blog_post = '$search_query'
				   OR blog_category = '$search_query')
				   ORDER BY blog_posts.date_created DESC";

		queryCaller($conn, $query);
		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
		/*$blogs 	= mysqli_query($conn, $query);

		while( $row = mysqli_fetch_assoc($blogs) ) {
			if (!$row['avatar']) {
				$avatar = 'userAvatarDefault.png';
			} else {
				$avatar = $row['avatar'];
			}
			echo "<article>";
			echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
			echo "</article>";			
		}*/
	} // END OF FALLBACK CODE FOR DISABLED JAVASCRIPT USERS
		
		
//	$query = "SELECT blog_title, blog_post, blog_category,
//		date_format(date_created, '%m/%d/%Y') date_created
//		FROM blog_posts 
//		WHERE public = 'public'
//		ORDER BY date_created DESC
//		LIMIT 10";
	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   ORDER BY blog_posts.date_created DESC
			   LIMIT 10;";
	
		//. "$_SESSION[" . 'id' . "]"		// %W 
		
		queryCaller($conn, $query);
		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
	/*$result = mysqli_query( $conn, $query );
	mysqli_close( $conn );

	if( mysqli_num_rows( $result ) > 0 ) {
	
		// we have data
		// output the data
			
		//while( mysqli_next_result( $conn ) ) {
		while( $row = mysqli_fetch_assoc($result) ) {
			if (!$row['avatar']) {
				$avatar = 'userAvatarDefault.png';
			} else {
				$avatar = $row['avatar'];
			}
			echo "<article>";
			echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
			echo "</article>";			
		}

	} else {
		echo "<div class='alert alert-danger'>You have no blog posts!</div>";
	}*/
	
//	mysqli_close($conn);
	
	?>	
			



	</section>
</main>




<?php // include('blogs.php'); ?>
<?php include('includes/footer.php'); ?>