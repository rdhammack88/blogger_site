<?php
$page_title = 'Home';
session_start();

include('includes/connection.php');
include('includes/functions.php');
$avatar = 'userAvatarDefault.png';
$alertMessage = '';

/* Check if HTTP GET parameter is equal to alert */
if( isset( $_GET['alert'] ) ) {
	/* User logged in successfully */
	if( $_GET['alert'] == 'logged_in') {
		if(!isset($_SESSION['loggedInUser'])) {
			header("Location: login.php");
		}
		$alertMessage = "<div class='alert alert-success'>Welcome " . ucfirst($_SESSION['loggedInUser']) . "! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
	/* User logged out successfully */
	if($_GET['alert'] == 'logged_out') {
		$page_title = "Home - User Logged Out"; 
		$alertMessage = "<div class='alert alert-success'>You have successfully logged out! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
	/* User deleted account */
	if($_GET['alert'] == 'deleted_user') {
		$page_title = "Account Deleted"; 
		$alertMessage = "<div class='alert alert-success'>Thank you for using our services! If you ever have a change of heart, we will still be here for you. <a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

include('includes/header.php');
echo $alertMessage;

mainCaller($conn);
/* BLOG TOPICS ASIDE BAR */
//sidebarCaller($conn);

/* Main Blog Article Content */
echo '<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">';

?>
<noscript>
<?php
/* Select the last 10 publicly posted blog posts and display them */
$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
		   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
		   blog_posts.blog_category, blog_posts.id AS blog_id,
		   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
		   blog_posts.total_comments, users.avatar, users.id,
		   users.email, users.user_name
		   FROM blog_posts
		   LEFT JOIN users ON blog_posts.user_id = users.id
		   WHERE public = 'public'
		   ORDER BY blog_posts.id DESC
		   LIMIT 5;";
queryCaller($conn, $query);
?>
</noscript>
</section>
</main>
<?php
//echo '</section></main>';
include('includes/footer.php');
?>