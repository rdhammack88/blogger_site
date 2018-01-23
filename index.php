<?php
$TITLE = 'Home';
session_start();

// connect to the database
include('includes/connection.php');
include('includes/functions.php');
$avatar = 'userAvatarDefault.png';
$alertMessage = '';

// check for query string
if( isset( $_GET['alert'] ) ) {
	// User logged in successfully
	if( $_GET['alert'] == 'logged_in') {
//		$alertMessage = "<div class='alert alert-success'>You are logged in! <a class='close' data-dismiss='alert'>&times;</a></div>";
		$alertMessage = "<div class='alert alert-success'>Welcome " . ucfirst($_SESSION['loggedInUser']) . "! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
	
	if($_GET['alert'] == 'logged_out') {
		$TITLE = "Log Out"; 
	}
}

include('includes/header.php');
echo $alertMessage;

/*BLOG TOPICS ASIDE BAR FULL CODE HERE*/
sidebarCaller($conn);

/*Main Blog Article Content*/
echo '<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">';
///////	FALL BACK CODE FOR USERS WITH JAVASCRIPT DISABLED /////////
//////  FOR BOTH POPULAR TOPICS ASIDE BAR, AND SEARCH    /////////
if(isset($_GET['topic'])) {
	$topic = $_GET['topic'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.favorite, blog_posts.likes,
			   blog_posts.dislikes, blog_posts.total_comments,
			   users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND blog_category = '$topic'
			   ORDER BY blog_posts.date_created DESC";
	queryCaller($conn, $query);
}
		
if(isset($_GET['search'])) {
	$search_query 	= $_GET['search'];	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
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
} // END OF FALLBACK CODE FOR DISABLED JAVASCRIPT USERS
		

$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
		   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
		   blog_posts.blog_category, blog_posts.id AS blog_id,
		   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
		   blog_posts.total_comments, users.avatar, users.id,
		   users.email, users.user_name
		   FROM blog_posts
		   LEFT JOIN users ON blog_posts.user_id = users.id
		   WHERE public = 'public'
		   ORDER BY blog_posts.date_created DESC
		   LIMIT 10;";

	//. "$_SESSION[" . 'id' . "]"		// %W 

queryCaller($conn, $query);
	
/*else {
	echo "<div class='alert alert-danger'>You have no blog posts!</div>";
}*/
	
//	mysqli_close($conn);

echo '</section></main>';
include('includes/footer.php');
?>