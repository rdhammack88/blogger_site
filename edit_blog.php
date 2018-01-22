<?php
$TITLE = "Edit Blog"; 
session_start();

include('includes/functions.php');
//	echo substr(strrchr($_SERVER['HTTP_REFERER'], '/'), 1 );
//	$reference_page = substr(strrchr($_SERVER['HTTP_REFERER'], '/'), 1);

if(!isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id'])) { 
	header("Location: login.php");
}

	if(isset($_SESSION['reference_page'])) {
		$reference_page = $_SESSION['reference_page'];
//		echo $reference_page;
		$query_removed = strpos($_SERVER['HTTP_REFERER'], '?');
//		echo $query_removed;
		//	$reference_page = substr($reference_page, 1, $query_removed);
		//	$reference_page = substr($reference_page, 1, strpos($_SERVER['HTTP_REFERER'], '?'));
//		echo $reference_page;
	}

if( isset( $_GET['id'] ) ) {
	
	include('includes/connection.php');
	
	$_SESSION['reference_page'] = substr(strrchr($_SERVER['HTTP_REFERER'], '/'), 1);
//	echo $reference_page;

	$blog_id = $_GET['id'];
//	echo $blog_id;
	$query 	= "SELECT * 
			  FROM blog_posts
			  WHERE id='$blog_id'";

	$result = mysqli_query( $conn, $query );
	
	if( $result ) {
		//if( mysqli_num_rows( $result ) > 0 ) {

			$row 	= mysqli_fetch_assoc($result); 
			$title 	= $row['blog_title'];
			$topic 	= $row['blog_category'];
			$public = $row['public'];
			$post 	= $row['blog_post'];
			//echo $title . ' ' . $topic . ' ' . $public;
		//}
	}
}

if( isset( $_POST['save'] ) ) {
	
	$blog_title = $blog_topic = $blog = "";
	$blog_title = validateFormData( $_POST["blogTitle"] );
	$blog_topic = validateFormData( $_POST["blogTopic"] );
	$blog		= validateFormData( $_POST["blog"] );
	
	if( !$_POST["public"] ) {
		$public = "public";
	} else {
		$public	= $_POST["public"];
	}
	
	
	
	// update blog to db
	$query = "UPDATE blog_posts 
			  SET blog_title = '$blog_title',
				  blog_category = '$blog_topic',
				  public = '$public',
				  blog_post = '$blog',
				  date_updated = CURRENT_TIMESTAMP
			  WHERE id = '$blog_id'";
	$result = mysqli_query( $conn, $query );

	if(!$result ) { printf(mysqli_error($conn)); }

	if( $result ) {
//		header( "Location: blogs.php" );
		if($reference_page == 'index.php') {
			header("Location: index.php#$blog_id");
			exit();
		} elseif($reference_page == 'blogs.php') {
			header("Location: blogs.php#$blog_id");
			exit();
		} elseif($reference_page == 'blog_manager.php') {
			header("Location: blog_manager.php");
			exit();
		}
	}
}

if( isset( $_POST['cancel'] ) ) {
//	header("Location: blogs.php");
		if($reference_page == 'index.php') {
			header("Location: index.php#$blog_id");
			exit();
		} elseif($reference_page == 'blogs.php') {
			header("Location: blogs.php#$blog_id");
			exit();
		} elseif($reference_page == 'blog_manager.php') {
			header("Location: blog_manager.php");
			exit();
		}
}




mysqli_close( $conn );
include('includes/header.php');
?>



<h3 class="text-center add_blog">Edit blog!</h3>

<form action="" class="col-sm-8 col-sm-offset-2" method="post">
	
	<small class="text-danger titleError">* Please enter a blog title <br/></small>
<!--	<small class="text-danger titleError">Please enter a blog title <br/></small>-->
	<div class="form-group input-group">
		<label for="blogTitle" class="input-group-addon"><strong>Title:</strong></label>
		<input type="text" class="form-control input-lg" name="blogTitle" id="blogTitle" maxlength="150" value="<?php echo $title; ?>"> <br/>  <!--placeholder="Title"-->
	</div>
<!--	<br/>-->
	
	<small class="text-danger topicError">* Please enter a blog topic <br/></small>
<!--	<small class="text-danger topicError">Please enter a blog topic <br/></small>-->
	
	<div class="form-group input-group">
		<label for="blogTopic" class="input-group-addon"><strong>Topic:</strong></label>
		<input type="text" class="form-control input-lg" name="blogTopic" id="blogTopic" maxlength="100" value="<?php echo $topic; ?>"> <!--<br/>-->  <!--placeholder="Tags"-->
	</div>
	<!--<br/>-->
	
	<div class="form-group">
		<label for="blog" class="sr-only">Current post says - <?php echo $post; ?></label>
		<small class="text-danger blogError">* Did you forget to write a blog?</small>
<!--		<small class="text-danger blogError">Did you forget to write a blog?</small> <br/>-->
	
		<textarea name="blog" class="form-control input-lg" id="blog" cols="30" rows="15" placeholder="Start writing your blog here..."><?php echo $post; ?></textarea>
	</div>
	
	<div class="col-xs-12">
		<label for="public" class="radio"><input type="radio" name="public" id="public" value="public" <?php if($public == 'public') {echo 'checked';} ?> >Make public <small class="text-danger">(Default if none selected)</small></label>
		<label for="private" class="radio"><input type="radio" name="public" id="private" value="private" <?php if($public == 'private') {echo 'checked';} ?> >Make private</label>
	</div>
	
	<br/><br/><br><br>
	
	<input type="submit" name="save" id="newBlog" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1" value="Save"><!--Submit</button>-->
	<input type="submit"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>








<?php require('includes/footer.php'); ?>