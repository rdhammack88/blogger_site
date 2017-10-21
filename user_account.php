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
	$row 			= mysqli_fetch_assoc( $result );
	$first_name 	= $row['first_name'];
	$last_name		= $row['last_name'];
	$email			= $row['email'];
	$user_name		= $row['user_name'];
	$avatar			= $row['avatar'];
	$bio			= $row['biography'];
	$hashed_pass 	= $row['password'];
}

if( isset( $_POST['save'] ) ) {
	$first_name	= validateFormData( $_POST['first_name'] );
	$last_name	= validateFormData( $_POST['last_name'] );
	$email		= validateFormData( $_POST['email'] );
	$user_name	= validateFormData( $_POST['user_name'] );
	$avatar		= validateFormData( $_POST['avatar'] );
	$bio		= validateFormData( $_POST['bio'] );
	
	if( isset( $_POST['newpassword'] ) ) {
		
		$password_check = validateFormData( $_POST['current_password'] );
		
		if( !$password_check ) {
			return FALSE;
		} else {
			// verify hashed password with submitted password
			if( password_verify( $password_check, $hashed_pass ) ) {
				$newpassword = password_hash( $_POST['newpassword'], PASSWORD_DEFAULT );
				$query	= "UPDATE users
						   SET password = '$newpassword'
						   WHERE id = '$user_id'";
				$result	= mysqli_query( $conn, $query );
			}
		}		
	}
	
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

if( isset( $_POST["cancel"] ) ) {
	header("Location: blogs.php");
}

if( isset( $_POST["delete"] ) ) {
	$query 	= "DELETE
			  FROM users
			  WHERE id = '$user_id'";
	$result = mysqli_query( $conn, $query );
	
	header("Location: logout.php");
}

mysqli_close( $conn );
include("includes/header.php");
?>



<!-- Trigger the modal with a button -->
<button type="button" class="btn  btn-sm btn-danger col-sm-offset-9" data-toggle="modal" data-target="#myModal">Delete Account</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <form class="modal-dialog" method="post">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm deletion of user account</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user account? <strong class="text-danger">This cannot be undone!</strong></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="delete">Confirm Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </form>
</div>










<!--
<form action="" method="post">
<button type="submit" name="delete" class="btn btn-sm btn-danger col-sm-offset-9">Delete Account</button>
</form>
-->

<h3 class="text-center add_blog clearfix">User Info for <?php echo $first_name ?> </h3>

<form action="" class="col-sm-8 col-sm-offset-2" method="post">
	
	<small class="text-danger nameEditError">* Please enter your first name<br/></small>
<!--	<small class="text-danger inputError">Please enter your first name<br/></small>-->
	
	<div class="form-group input-group">
		<label for="first_name" class="input-group-addon"><strong>First Name:</strong></label>
		<input type="text" class="form-control input-lg" name="first_name" id="first_name_edit" maxlength="150" value="<?php echo $first_name; ?>"> <br/>
	</div>
	<br/>
	
	<div class="form-group input-group">
		<label for="last_name" class="input-group-addon"><strong>Last Name:</strong></label>
		<input type="text" class="form-control input-lg" name="last_name" id="last_name" maxlength="150" value="<?php echo $last_name; ?>"> <br/>
	</div>
	<br/>
	
	<small class="text-danger emailEditError">* Please enter your email <br/></small>
<!--	<small class="text-danger inputError">Please enter your email <br/></small>-->
	
	<div class="form-group input-group">
		<label for="email" class="input-group-addon"><strong>Email:</strong></label>
		<input type="text" class="form-control input-lg" name="email" id="email_edit" maxlength="150" value="<?php echo $email; ?>"> <br/>
	</div>
	<br/>
	
	<div class="form-group input-group">
		<label for="user_name" class="input-group-addon"><strong>User Name:</strong></label>
		<input type="text" class="form-control input-lg" name="user_name" id="user_name" maxlength="100" value="<?php echo $user_name; ?>"> <!--<br/>-->
	</div>
	<br/>
	
	
	<fieldset>
	<!--	<button class="btn btn-sm btn-danger">Change password</button> <br/><br/>-->
		<small class="text-danger passwordError">* Please enter your current password <br/></small>
		<small class="text-danger passwordErrorRepeat">* Please enter your current password again <br/></small>
		<small class="text-danger passwordErrorBoth">* Please enter your current password twice <br/></small>

		<div class="form-group input-group">
			<label for="current_password" class="input-group-addon"><strong>Current Password</strong>
			<input type="password" name="current_password" id="current_password" class="form-control input-sm"></label>
			<label for="current_password_repeat" class="input-group-addon"><strong>Current Password Again</strong>
			<input type="password" name="current_password_repeat" id="current_password_repeat" class="form-control input-sm"></label> 
		</div>

		<div class="form-group input-group">
			<label for="new_password" class="input-group-addon"><strong>New Password</strong></label>
			<input type="password" name="newpassword" id="new_password" class="form-control input-lg">
		</div>
	</fieldset>
	<br/>
	
	<label for="avatar">Bio picture:</label>
	<input type="file" name="avatar" > <br/><br/>
	
	<div class="form-group">
		<label for="bio" class="sr-only">Current user biography says - <?php echo $bio; ?></label>
		<textarea name="bio" class="form-control input-lg" id="bio" cols="30" rows="15" placeholder="Start writing your bio here..."><?php echo $bio; ?></textarea>
	</div>
		
	<br/><br/><br><br>
	
	<input type="submit" name="save" id="saveInfo" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1" value="Save"><!--Submit</button>-->
	<input type="submit"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>


<small class="text-danger blogError">* </small>
<small class="text-danger blogError">Did you forget to write a blog?</small> <br/>



<?php require('includes/footer.php'); ?>