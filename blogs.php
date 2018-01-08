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
//echo $user_id;

//if( isset( $_POST['add'] ) ) {
//	header("Location: add_blog.php");
//}

/* Edit user Blog */
if( isset( $_POST['edit'] ) ) {
	$blog_id = $_POST['blog_id'];
	header("Location: edit_blog.php?id=$blog_id");
}

/* Delete user Blog */
if( isset( $_POST['delete'] ) ) {
	$blog_id = $_POST['blogid'];
	
	$query 	= "DELETE
			   FROM blog_posts
			   WHERE id='$blog_id'";
	$result = mysqli_query( $conn, $query );
	
	echo "Post $blog_id has been deleted!";
}

/* Favorite user Blog */
if( isset( $_POST['favorite'] ) ) {
	$blog_id = $_POST['blog_id'];
	$query 	= "SELECT favorite 
			  FROM blog_posts
			  WHERE id='$blog_id'";

	$result = mysqli_query( $conn, $query );
	
	if( $result ) {
		$row	 	= mysqli_fetch_assoc($result);
		$favorite 	= $row['favorite'];
		
		if( !$favorite ) {
			$favorite = 1;
		} else {
			$favorite = 0;
		}
		// update blog favorite 
		$query = "UPDATE blog_posts 
				  SET favorite = '$favorite'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );

		if(!$result ) { printf(mysqli_error($conn)); }

//		echo "Post $blog_id has been favorited!";
	}
}








//// query & results
//$query = "SELECT user_id, blog_title, blog_post, blog_category,
//	date_format(date_created, '%m/%d/%Y') date_created
//	FROM blog_posts WHERE user_id='$user_id'
//	ORDER BY date_created DESC"; 
//	//. "$_SESSION[" . 'id' . "]"		// %W 
//$result = mysqli_query( $conn, $query );

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

<div class="row text-right">
		<span class="sr-only">Add new blog</span><a href="add_blog.php" class="glyphicon glyphicon-plus btn btn-primary add-btn"> New</a>
</div>

<br/>



<!-- Modal -->
<div id="deleteBlogModal" class="modal fade" role="dialog">
  <form class="modal-dialog" method="post">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm deletion of blog post</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this blog post? <strong class="text-danger">This cannot be undone!</strong></p>
        <input type='number' value='<?php //echo $_SESSION["user_id"] ?>' id="blogID" name='blogid' class='hidden'><!-- hidden -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="delete">Confirm Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </form>
</div>



<main class="row">
	<?php
	$query 	= "SELECT blog_post
			  FROM blog_posts
			  WHERE user_id='$user_id'";
	$result = mysqli_query( $conn, $query );
	
	if(!$result) { printf(mysqli_error($conn)); }
	
	if( $result ) {
		$query = "SELECT blog_category 
				FROM blog_posts
				WHERE user_id='$user_id'
				GROUP BY blog_category
				HAVING COUNT(*) >= 2";

		$result = mysqli_query( $conn, $query );
		
//echo "This is line " . __LINE__ . " in file " . __FILE__;
		
		if( $result ) {
			echo '<aside id="blogTopics" class="col-sm-3 col-md-3">
				  <nav>
				  <h4 class="text-center">Your most written about topics</h4>';


			if(!$result) { printf(mysqli_error($conn)); }

			if( mysqli_num_rows( $result ) > 0 ) {
				// we have data
				// output the data
				echo "<ul>";
				while( $row = mysqli_fetch_assoc($result) ) {
					

					echo "<li><a>" . $row['blog_category'] . "</a>";
				
				}
				echo "</ul>";			
	//			mysqli_free_result( $result );
			}

//echo "This is line " . __LINE__ . " in file " . __FILE__;
			
			echo '</nav></aside>';
		}
		if( !$result ) {
			$query = "SELECT blog_category 
			FROM blog_posts
			WHERE user_id='$user_id'
			GROUP BY blog_category
			HAVING COUNT(*) >= 1";

			$result = mysqli_query( $conn, $query );
			echo '<aside id="blogTopics" class="col-sm-3 col-md-3">
				  <nav>
				  <h4 class="text-center">Your most written about topics</h4>';

//echo "This is line " . __LINE__ . " in file " . __FILE__;
			if(!$result) { printf(mysqli_error($conn)); }

			if( mysqli_num_rows( $result ) > 0 ) {
				// we have data
				// output the data

				while( $row = mysqli_fetch_assoc($result) ) {
					echo "<ul>";

					echo "<li><a>" . $row['blog_category'] . "</a></p>";
					echo "</ul>";			
				}

	//			mysqli_free_result( $result );
	
			}
		}
	}
	?>
	
<?php
		
		
//if( isset( $_POST['addblog'] ) ) {
//	header('Location: add_blog.php');
//}

?>
	
		
<!--
			,
			  date_format(date_created, '%m/%d/%Y') date_created
				ORDER BY date_created DESC

			ORDER BY date_created DESC
-->
    <!-- Blog Section for user blogss -->
    <?php
	// query & results
	$query = "SELECT *
			  FROM blog_posts
			  WHERE user_id='$user_id'
			  ORDER BY date_created DESC"; 
	$result = mysqli_query( $conn, $query );
	
	if( mysqli_num_rows( $result ) > 0 ) {
		
		echo "<!-- Main Blog Article Content -->
		<section id='blogSection' class='col-sm-8 col-sm-offset-1'>
		<small class='text-danger no-blogs'>Most Recent Blog Posts...</small>";
		
		// we have data
		// output the data
		
		while( $row = mysqli_fetch_assoc($result) ) {
			$date_created = date_create($row['date_created']); /// $row['date_created']
			$date = date_format($date_created, 'm/d/Y');
			//$blog_id = $row['id'];
			
//			$favorite = $row['favorite'];
//			echo $favorite;
			
			echo "<article>";//$row['date_created']
			
			echo "<div class='blog_title'><h2>" . $row['blog_title'] . "</h2>
							
			<a><p class='date_posted'>". $date . "</p></a></div>";
			echo "<p>". $row['blog_post'] . "</p>";
			
			echo "<form class='blog_footer' action='";
				
			echo htmlspecialchars( $_SERVER['PHP_SELF'] ) . "' method='POST'>	
			<span class='sr-only'>Edit this blog</span><button type='submit' class='glyphicon glyphicon-pencil btn btn-lg' name='edit'></button>";
			
			echo "<span class='sr-only'>Delete this blog</span><button type='button' class='glyphicon glyphicon-trash btn btn-lg' id='" . $row['id'] . "'  name='deletePost' data-toggle='modal' data-target='#deleteBlogModal'></button>";
			
			if($row['favorite']) {
				echo "<span class='sr-only'>Favorite this blog</span><button type='submit' class='glyphicon glyphicon-bookmark btn btn-lg favorite' id='favorite' name='favorite'></button>";
			} else {
				echo "<span class='sr-only'>Favorite this blog</span><button type='submit' class='glyphicon glyphicon-bookmark btn btn-lg' id='favorite' name='favorite'></button>";
			}
						
			echo "<input type='number' value='" . $row['id'] . "' name='blog_id' class='hidden'>";
			
			echo "</form></article>";			
				//$row['date_created']
		}
	} else {
		echo "<div class='container'><p class='alert alert-danger col-md-8 col-md-offset-1'>You have no blog posts!</p></div>";
	}
	
	// close the connection
	mysqli_close( $conn );
//	mysqli_close($conn);
	
//include('includes/header.php');
	?>
    
    <!--<tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>-->

<!--		
<span class='sr-only'>Add new blog</span><a href='add_blog.php' class='glyphicon glyphicon-plus'></a>
-->




<!--<a href='edit_blog.php'></a>-->







<?php include('includes/footer.php'); ?>
