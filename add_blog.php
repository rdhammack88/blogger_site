
<?php

session_start();

if( isset( $_POST['newBlog'] ) ) {
//	echo 'Blog added';
}
elseif( isset( $_POST['cancel'] ) ) {
	header( "Location: blogs.php" );
}

include('includes/header.php');
?>

<?php  ?>


<!--<script type="text/javascript">
	$('div.alert').css('display','none');
</script>-->


<!--<h1 class="text-center add_blog">Add your new blog!</h1>-->

<form action="" class="col-sm-8 col-sm-offset-2" method="post">
	
	<label for="blogTitle" class="">Title:</label>
	<small class="text-danger titleError"> <br/>* </small>
	<small class="text-danger titleError">Please enter a title <br/></small>
	<input type="text" class="form-control input-lg" name="blogTitle" id="blogTitle" maxlength="150" placeholder="Title"> <br/>
	
	<label for="blogTopic" class="">Topic:</label>
	<small class="text-danger topicError"> <br/>* </small>
	<small class="text-danger topicError">Please enter a blog topic <br/></small>
	<input type="text" class="form-control input-lg" name="blogTopic" id="blogTopic" maxlength="100" placeholder="Tags"> <br/>
	
	<label for="blog" class="sr-only">Write your content below:</label>
	<small class="text-danger blogError">* </small>
	<small class="text-danger blogError">Did you forget to write a blog?</small> <br/>
	<textarea name="blog" class="form-control input-lg" id="blog" cols="30" rows="15" placeholder="Start writing your blog here..."></textarea> <br/>
	
	<div class="col-xs-12">
		<label for="public" class="radio-inline"><input type="radio" name="public">Make public</label>
		<label for="private" class="radio-inline"><input type="radio" name="private">Make private</label>
	</div>
	
	<br/><br/>
	
	<input type="submit" name="newBlog" id="newBlog" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1"><!--Submit</button>-->
	<input type="reset"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>











<?php include('includes/footer.php'); ?>