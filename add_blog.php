
<?php

session_start();

include('includes/functions.php');

if( isset( $_POST["newBlog"] ) ) {
//	echo 'Blog added';
	
	include('includes/connection.php');
	
	$blog_title = $blog_topic = $blog = "";
	$blog_title = validateFormData( $_POST["blogTitle"] );
	$blog_topic = validateFormData( $_POST["blogTopic"] );
	$blog		= validateFormData( $_POST["blog"] );
	
	$user_id	= $_SESSION["user_id"];
	
	if( !$_POST["public"] ) {
		$public = "public";
	} else {
		$public	= $_POST["public"];
	}
	
	if( $blog_title && $blog_topic && $blog ) {
		// add blog to db
		$query = "INSERT INTO blog_posts (id, user_id, blog_title,
				  blog_category, public, favorite, blog_post, date_created)
				  VALUES (NULL, '$user_id', '$blog_title', '$blog_topic', '$public', NULL, '$blog', CURRENT_TIMESTAMP)";
		
		//if(!mysqli_query( $conn, $query ) ) { printf(mysqli_error($conn)); }
		
		if( mysqli_query( $conn, $query ) ) {
			header( "Location: blogs.php" );
		}		
	}
	// close connection to db
	mysqli_close( $conn );
}

if( isset( $_POST['cancel'] ) ) {
	header( "Location: blogs.php" );
}

include('includes/header.php');
?>

<?php  ?>


<!--<script type="text/javascript">
	$('div.alert').css('display','none');
</script>-->


<h3 class="text-center add_blog">Add your new blog!</h3>

<form action="" class="col-sm-8 col-sm-offset-2" method="post">
	
	<small class="text-danger titleError">* </small>
	<small class="text-danger titleError">Please enter a title <br/></small>
	<div class="form-group input-group">
		<label for="blogTitle" class="input-group-addon"><strong>Title:</strong></label>
		<input type="text" class="form-control input-lg" name="blogTitle" id="blogTitle" maxlength="150"> <br/>  <!--placeholder="Title"-->
	</div>
	<br/>
	
	<small class="text-danger topicError">* </small>
	<small class="text-danger topicError">Please enter a blog topic <br/></small>
	
	<div class="form-group input-group">
		<label for="blogTopic" class="input-group-addon"><strong>Topic:</strong></label>
		<input type="text" class="form-control input-lg" name="blogTopic" id="blogTopic" maxlength="100"> <!--<br/>-->  <!--placeholder="Tags"-->
	</div>
	<!--<br/>-->
	
	<div class="form-group">
		<label for="blog" class="sr-only">Write your content below:</label>
		<small class="text-danger blogError">* </small>
		<small class="text-danger blogError">Did you forget to write a blog?</small> <br/>
		<textarea name="blog" class="form-control input-lg" id="blog" cols="30" rows="15" placeholder="Start writing your blog here..."></textarea>
	</div>
	
	<div class="col-xs-12">
		<label for="public" class="radio"><input type="radio" name="public" id="public" value="public">Make public <small class="text-danger">(Default if none selected)</small></label>
		<label for="private" class="radio"><input type="radio" name="public" id="private" value="private">Make private</label>
	</div>
	
	<br/><br/><br><br>
	
	<input type="submit" name="newBlog" id="newBlog" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1"><!--Submit</button>-->
	<input type="reset"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>











<?php include('includes/footer.php'); ?>