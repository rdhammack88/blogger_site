<?php
$page_title = "Edit User Account";
session_start();

if(!isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id'])) { 
	header("Location: login.php");
}

include('includes/connection.php');
include('includes/functions.php');
$user_name = $_SESSION['loggedInUser'];
$user_id = $_SESSION['user_id'];
$uploadError = '';
$current_password_error = '';
$new_password_error = '';

if( isset( $_POST["cancel"] ) ) {
	header("Location: blogs.php");
}

if( isset( $_POST["delete_user_profile"] ) ) {
	$query 	= "DELETE
			  FROM users
			  WHERE id = '$user_id'";
	$result = mysqli_query( $conn, $query );
	
	header("Location: logout.php?deleted_user=true");
}

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

if( !$avatar ) {
	$avatar = 'userAvatarDefault.png';
//	$avatar = 'images/Male_User_Filled.png';
} else {
	$avatar = $avatar;
}

if( isset( $_POST['save'] ) ) {
//	var_dump($_POST);
//	var_dump($_FILES);
	$first_name	= validateFormData( $_POST['first_name'] );
	$last_name	= validateFormData( $_POST['last_name'] );
	$email		= validateFormData( $_POST['email'] );
	$user_name	= validateFormData( $_POST['user_name'] );
//	$avatar		= validateFormData( $_POST['avatar'] );
	$bio		= validateFormData( $_POST['bio'] );
	
	if( isset( $_FILES['avatar'] ) && !empty($_FILES['avatar']['name'])) {
		include('image_upload.php');
		// CHECK TO VERIFY UPLOADED FILE HAS PASSED ALL TESTS
		if( $uploadPass == 0 ) {
			$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
			echo $uploadError;
//		} elseif ( !$_POST['avatar'] ) {
//			$uploadPass = 1;
		} else {	// UPLOAD PASSED ALL TESTS
			if( move_uploaded_file( $_FILES['avatar']['tmp_name'], $target_path ) ) {
				$path = 'images/user_profile_images/';
				$image = $path . $user_image;
				rotateImage($image);
				createThumbnail($image, $path);
//				$avatar = $_FILES['avatar']['name'];
				
				$user_image	= "user" . $user_id . '-md.' . $image_type;
//				$image_ext = pathinfo( $user_image, PATHINFO_EXTENSION );
				$avatar = $user_image;
				unset($_SESSION['avatar']);
				$_SESSION['avatar']	= $avatar;
//				$query 	= "UPDATE users
//						  SET avatar = '$avatar'
//						  WHERE id = '$user_id'";
//				$result = mysqli_query( $conn, $query );
			} else {
				$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
				echo $uploadError;
			}
		}
	}
	
	if( isset( $_POST['new_password'] ) && $_POST['new_password'] != '' || isset( $_POST['new_password_repeat'] ) && $_POST['new_password_repeat'] != '' ) {
		$email_check 	= validateFormData( $_POST['email'] );
		$old_password = validateFormData( $_POST['current_password'] );
		$new_password = validateFormData( $_POST['new_password']);
		$new_password_repeat = validateFormData($_POST['new_password_repeat']);	
		
		
//		echo "New Password = " . $new_password;
//		echo "<br>";
//		echo "Old Password = " . $old_password;
//		echo "<br>";
//		echo "New Password Repeated = " . $new_password_repeat;
//		echo "<br>";
//		exit();
		
		if(!$old_password) {
			$current_password_error = "* Please enter your current password before making changes to it";
		}
		if($new_password !== $new_password_repeat) {
			$new_password_error = "* Please make sure both New Password fields match exactly";
		}
		if(($old_password && $new_password == '') || ($old_password && $new_password_repeat == '')) {
			$new_password_error = "* Please fill in both New Password fields";
		} 
		if($old_password !== '' && $new_password === $new_password_repeat) {

			$query = "SELECT email, password
					  FROM users
					  WHERE email='$email_check'";
			// store the result
			$result = mysqli_query( $conn, $query );

			// verify if result is returned
			if( mysqli_num_rows($result) > 0 ) {
				// store basic user data in variables
				while( $row = mysqli_fetch_assoc($result) ) {
					$storedHashedPass = $row['password'];
				}
			}

			/* verify hashed password with submitted password */
			if( password_verify( $old_password, $storedHashedPass ) ) {

				$new_password = password_hash( $new_password, PASSWORD_DEFAULT );
				$query	= "UPDATE users
						   SET password = '$new_password'
						   WHERE id = '$user_id'";
				$result	= mysqli_query( $conn, $query );

			} else {
				$current_password_error = "* Please correct your current password";
			}
		}
	}
	
//	avatar	  = '$avatar',
	
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
	
	if( $result && (isset($uploadPass) && $uploadPass === 1 )) {
		//echo $user_avatar;
//		header("Location: blogs.php");
	}
}

include("includes/header.php");
?>
<!-- Modal -->
<div id="deleteUserAccountModal" class="modal fade" role="dialog">
  <form class="modal-dialog" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm deletion of user account</h4>
      </div>
      <div class="modal-body">
		<p>Are you sure you want to delete this user account?</p>
     	<p> <strong class="text-danger">This cannot be undone!</strong></p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="delete_user_profile">Confirm Delete</button>
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
<div class="user-info-edit-container">

<br><br>

<h3 class="text-center add_blog clearfix">User Info for <?php echo $first_name . ' ' . $last_name; ?> </h3>

<!--<div class="row">
	<form action="" class="col-sm-8 col-sm-offset-2" method="post" enctype="multipart/form-data">
		<img src="<?php //echo $avatar ?>" alt="User profile avatar" id="userAvatar"> <br/><br/>
		<label for="avatar">Bio picture:</label>
		<input type="file" name="avatar"> <br/>
		<button type="submit" name="avatarUpload" class="btn btn-info btn-sm">Upload Avatar</button>

	</form>
</div>-->



<!-- Trigger the modal with a button -->
<button type="button" class="btn  btn-sm btn-danger col-xs-offset-9" data-toggle="modal" data-target="#deleteUserAccountModal">Delete Account</button>


<br/><br/>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" class="col-sm-8 col-sm-offset-2" method="post" enctype="multipart/form-data">

	<div class="form-group input-group">
		<img src="images/user_profile_images/<?php echo $avatar; ?>" alt="User profile avatar" id="userAvatar" class="user_avatar_preview"> <br/><br/>
		<label for="avatar">Bio picture:</label>
		<input type="file" name="avatar">
		<p class="text-danger"><?php echo $uploadError; ?> </p>
		<small class="text-danger imageTypeError hidden"> Please only use image file types ('jpg', 'jpeg', 'png', 'gif).</small>
		<small class="text-danger imageSizeError hidden"> File size too large. (Max 5Mb)</small> <br/>
		<!--<button type="submit" name="avatarUpload" class="btn btn-info btn-sm">Upload Avatar</button>-->
	</div>
	
	<small class="text-danger nameEditError">* Please enter your first name<br/></small>
<!--	<small class="text-danger inputError">Please enter your first name<br/></small>-->
	
	<div class="form-group input-group has-feedback">
		<label for="first_name" class="input-group-addon"><strong>First Name:</strong></label>
		<input type="text" class="form-control input-lg" name="first_name" id="first_name_edit" maxlength="100" value="<?php echo $first_name; ?>" required>
    	<span class="glyphicon form-control-feedback"></span>
	</div>
	<br/>
	
	<div class="form-group input-group">
		<label for="last_name" class="input-group-addon"><strong>Last Name:</strong></label>
		<input type="text" class="form-control input-lg" name="last_name" id="last_name" maxlength="100" value="<?php echo $last_name; ?>"> <br/>
	</div>
	<br/>
	
	<small class="text-danger emailEditError">* Please enter your email <br/></small>
<!--	<small class="text-danger inputError">Please enter your email <br/></small>-->
	
	<div class="form-group input-group has-feedback">
		<label for="email" class="input-group-addon"><strong>Email:</strong></label>
		<input type="text" class="form-control input-lg" name="email" id="email_edit" maxlength="100" value="<?php echo $email; ?>" required>
    	<span class="glyphicon form-control-feedback"></span>
	</div>
	<br/>
	
	<div class="form-group input-group has-feedback">
		<label for="user_name" class="input-group-addon"><strong>User Name:</strong></label>
		<input type="text" class="form-control input-lg" name="user_name" id="user_name" maxlength="100" value="<?php echo $user_name; ?>" required> <!--<br/>-->
	</div>
	<br/>
	
	<?php if($current_password_error != '' || $new_password_error != '') : ?>
		<fieldset>
	<?php elseif($current_password_error == '' || $new_password_error == '') : ?>
	
		<button type="button" class="btn btn-danger password-edit-button hidden">Change password</button>
		<fieldset class="password-fieldset">
	<?php endif; ?>
	
<!--	<fieldset class="password-fieldset">-->
	<!--	<button class="btn btn-sm btn-danger">Change password</button> <br/><br/>-->
<!--
		
		<small class="text-danger passwordErrorRepeat">* Please enter your current password again <br/></small>
-->
	
		<small class="text-danger passwordError">* Please enter your current password <br/></small>
		<small class="text-danger current-password-error"><?php  echo $current_password_error; ?></small>
		<div class="form-group input-group">
			<label for="current_password" class="input-group-addon"><strong>Current Password</strong></label>
			<input type="password" name="current_password" id="current_password" class="form-control input-lg">
		</div>
		<small class="text-danger passwordErrorBoth">* Please enter your current password twice <br/></small>
		<small class="text-danger new-password-error"><?php  echo $new_password_error; ?></small>
		<div class="form-group input-group">
			<label for="new_password" class="input-group-addon"><strong>New Password</strong>
			<input type="password" name="new_password" id="new_password" class="form-control input-sm"></label>
			<label for="new_password_repeat" class="input-group-addon"><strong>New Password Again</strong>
			<input type="password" name="new_password_repeat" id="new_password_repeat" class="form-control input-sm"></label> 
		</div>

	</fieldset>
	<br/>
		
	<div class="form-group input-group">
		<label for="bio" class="input-group-addon"><span id="bioTextEdit">Biography</span></label>
		<textarea name="bio" class="form-control input-lg" id="bio" cols="30" rows="7" placeholder="Start writing your bio here..."><?php echo $bio; ?></textarea>
	</div>
		
	<br/><br/><br><br>
	
	<input type="submit" name="save" id="saveInfo" class="btn btn-success btn-lg col-xs-4 col-xs-offset-1" value="Save"><!--Submit</button>-->
	<input type="submit"  name="cancel" class="btn btn-danger btn-lg col-xs-4 col-xs-offset-2" value="Cancel"><!--Cancel</button>-->
	
</form>
</div>

<?php// mysqli_close($conn); ?>
<?php require_once('includes/footer.php'); ?>