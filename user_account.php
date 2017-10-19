<?php
session_start();
$user_name = $_SESSION['loggedInUser'];

include('includes/functions.php');
include('includes/connection.php');
$user_id = $_SESSION['user_id'];
//echo $_SESSION['user_id'];

$query 	= "SELECT *
		  FROM users
		  WHERE id = '$user_id'";
$result = mysqli_query( $conn, $query );

if( $result ) {
	$row 		= mysqli_fetch_assoc( $result );
	$first_name = $row['first_name'];
	$last_name	= $row['last_name'];
	$email		= $row['email'];
	$user_name	= $row['user_name'];
	$avatar		= $row['avatar'];
	$bio		= $row['biography'];
}

if( isset( $_POST['save'] ) ) {
	$first_name	= validateFormData( $_POST['first_name'] );
	$last_name	= validateFormData( $_POST['last_name'] );
	$email		= validateFormData( $_POST['email'] );
	$user_name	= validateFormData( $_POST['user_name'] );
	$avatar		= validateFormData( $_POST['avatar'] );
	$bio		= validateFormData( $_POST['bio'] );
	
	$query	= "UPDATE users
			   SET first_name = '$first_name',
				   last_name  = '$last_name',
				   email	  = '$email',
				   user_name  = '$user_name',
				   avatar	  = '$avatar',
				   biography  = '$bio'
			  WHERE id = '$user_id'";
	$result	= mysqli_query( $conn, $query );
	
	if(!$result ) { printf(mysqli_error($conn)); }
	
	if( $result ){
		header("Location: blogs.php");
	}
}

if( isset( $_POST['cancel'] ) ) {
	header("Location: blogs.php");
}

mysqli_close( $conn );
include("includes/header.php");
?>





<h3 class="text-center add_blog"><?php echo $user_name ?>'s User Info </h3>

<form action="" class="col-sm-8 col-sm-offset-2" method="post">
	
	<small class="text-danger nameError">* </small>
	<small class="text-danger nameError">Please enter your first name<br/></small>
	
	<div class="form-group input-group">
		<label for="first_name" class="input-group-addon"><strong>First Name:</strong></label>
		<input type="text" class="form-control input-lg" name="first_name" id="first_name" maxlength="150" value="<?php echo $first_name; ?>"> <br/>
	</div>
	<br/>
	
	<div class="form-group input-group">
		<label for="last_name" class="input-group-addon"><strong>Last Name:</strong></label>
		<input type="text" class="form-control input-lg" name="last_name" id="last_name" maxlength="150" value="<?php echo $last_name; ?>"> <br/>
	</div>
	<br/>
	
	<small class="text-danger emailError">* </small>
	<small class="text-danger emailError">Please enter your email <br/></small>
	
	<div class="form-group input-group">
		<label for="email" class="input-group-addon"><strong>Email:</strong></label>
		<input type="text" class="form-control input-lg" name="email" id="email" maxlength="150" value="<?php echo $email; ?>"> <br/>
	</div>
	<br/>
	
	<div class="form-group input-group">
		<label for="user_name" class="input-group-addon"><strong>User name:</strong></label>
		<input type="text" class="form-control input-lg" name="user_name" id="user_name" maxlength="100" value="<?php echo $user_name; ?>"> <!--<br/>-->
	</div>
	<br/>
	
	<input type="file" name="avatar"> <br/><br/>
	
	<div class="form-group">
		<label for="bio" class="sr-only">Current user biography says - <?php echo $bio; ?></label>
		<textarea name="bio" class="form-control input-lg" id="bio" cols="30" rows="15" placeholder="Start writing your bio here..."><?php echo $bio; ?></textarea>
	</div>
		
	<br/><br/><br><br>
	
	<input type="submit" name="save" id="save" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1" value="Save"><!--Submit</button>-->
	<input type="submit"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>


<small class="text-danger blogError">* </small>
<small class="text-danger blogError">Did you forget to write a blog?</small> <br/>



<?php require('includes/footer.php'); ?>