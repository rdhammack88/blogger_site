<?php $page_title = "User blogs"; ?>
<?php

session_start();

$alertMessage = '';

if( !isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id']) ) {
	// send them to the login page
	header("Location: login.php");
}

// connect to the database
include('includes/connection.php');

// Incluce Functions
include('includes/functions.php');

$user_id = $_SESSION['user_id'];

// check for query string
if( isset( $_GET['alert'] ) ) {
	// User logged in successfully
	if( $_GET['alert'] == 'logged_in') {
		$alertMessage = "<div class='alert alert-success'>Welcome " . $_SESSION['loggedInUser'] . "! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

include('includes/header.php');
echo $alertMessage;
?>

<br/>

<?php
mainCaller($conn);
echo '<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">';
?>

<!--BLOG TOPICS ASIDE BAR FULL CODE HERE-->

<!-- Main Blog Article Content -->

<noscript>
<!-- Blog Section for user blogss -->
<?php
// query & results if user has Javascript disabled
$query = "SELECT blog_posts.blog_title, blog_posts.blog_post,
		  date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
		  blog_posts.blog_category, blog_posts.id AS blog_id,
		  blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
		  blog_posts.total_comments, users.avatar, users.id,
		  users.email, users.user_name
		  FROM blog_posts
		  LEFT JOIN users ON blog_posts.user_id = users.id
		  WHERE user_id='$user_id'
		  ORDER BY blog_posts.id DESC"; 
queryCaller($conn, $query);

//echo '</section></main>';
?>
</noscript>

</section>
</main>
<?php include('includes/footer.php'); ?>