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

//if( isset( $_POST['add'] ) ) {
//	header("Location: add_blog.php");
//}




//// query & results
//$query = "SELECT user_id, blog_title, blog_post, blog_category,
//	date_format(date_created, '%m/%d/%Y') date_created
//	FROM blog_posts WHERE user_id='$user_id'
//	ORDER BY date_created DESC"; 
//	//. "$_SESSION[" . 'id' . "]"		// %W 
//$result = mysqli_query( $conn, $query );

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
//
//// close the connection
//mysqli_close( $conn );

include('includes/header.php');
echo $alertMessage; 
?>

<!--<h1>Your recent blogs</h1>-->

<?php //echo $alertMessage; ?>

<div class="row">
	<!--<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">-->
		<!--<button type="submit" class="" name="add">-->
		<span class="sr-only">Add new blog</span><a href="add_blog.php" class="glyphicon glyphicon-plus"></a>
		<!--</button>-->
	<!--	<input type="submit" class="glyphicon glyphicon-plus">-->
	<!--</form>-->
</div>

<br/>

<main class="row">
	<?php
	$query 	= "SELECT blog_posts
			  FROM blog_posts
			  WHERE user_id='$user_id'";
	$result = mysqli_query( $conn, $query );
	if( $result ) {
	echo '<aside id="blogTopics" class="col-sm-3 col-md-3">
		<nav>
			<h4 class="text-center">Your most written about topics</h4>';
			
				$query = "SELECT blog_category 
				FROM blog_posts
				WHERE user_id='$user_id'
				GROUP BY blog_category
				HAVING COUNT(*) >= 2";

				$result = mysqli_query( $conn, $query );


				if(!$result) { printf(mysqli_error($conn)); }
				if( mysqli_num_rows( $result ) > 0 ) {
							// we have data
							// output the data

					while( $row = mysqli_fetch_assoc($result) ) {
						echo "<ul>";

						echo "<li><a>" . $row['blog_category'] . "</a></p>";
						echo "</ul>";			
					}

					mysqli_free_result( $result );
				}
			
			
		echo '</nav></aside>';
	}
	?>
	
<?php
		
		
//if( isset( $_POST['addblog'] ) ) {
//	header('Location: add_blog.php');
//}

?>
	<!-- Main Blog Article Content -->
	<section id="blogSection" class="col-sm-8 col-sm-offset-1">

		<small class="text-danger no-blogs">Most Recent Blog Posts...</small>
		
    
    <?php
	// query & results
	$query = "SELECT user_id, blog_title, blog_post, blog_category,
		date_format(date_created, '%m/%d/%Y') date_created
		FROM blog_posts WHERE user_id='$user_id'
		ORDER BY date_created DESC"; 
	$result = mysqli_query( $conn, $query );
	
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
	
	// close the connection
	mysqli_close( $conn );
//	mysqli_close($conn);
	
//include('includes/header.php');
	?>
    
    <!--<tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>-->

		












<?php include('includes/footer.php'); ?>
