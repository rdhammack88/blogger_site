<?php
$page_title = "Signup"; 
session_start();

include('includes/functions.php');
$avatar = 'userAvatarDefault.png';
$nameError = $usernameError = $emailError = $passwordError = "";

if( isset( $_POST["signup"] ) ) {
	include("includes/connection.php");
	
	if( !$_POST["first_name"] ) {
		$nameError = "Please enter a first name";
	} else {
		$first_name = validateFormData( $_POST["first_name"] );
	}

	if( $_POST["last_name"] ) {
		$last_name = validateFormData( $_POST["last_name"] );
	} else {
		$last_name = NULL;
	}

	if( !$_POST["email"] ) {
		$emailError = "Please enter your email";
		$email = $emailError;
	} else {
		if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
			$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
			$email = validateFormData($email);
		}
	}
	
	if( !$_POST["user_name"] ) {
		$$usernameError = "Please enter a username";
	} else {
		$user_name = validateFormData( $_POST["user_name"] );
	}

	if( !$_POST["password"] ) {
		$passwordError = "Please enter a password";
	} else {
		$password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
	}

	if( $_POST["biography"] ) {
		$biography = validateFormData( $_POST["biography"] );
	} else {
		$biography = NULL;
	}
	
	/* CHECK TO SEE IF EACH VARIABLE HAS DATA */
	if( $first_name && $user_name && $email && $password ) {
		/* Test for availability of Email && Username */
		$query 	= "SELECT email, user_name
				   FROM users
				   WHERE email = '$email'
				   OR user_name = '$user_name'";
		$result	= mysqli_query( $conn, $query );
		
		if(mysqli_num_rows($result) >= 1) { /* Email && Username not available */
			$emailError = "That email is already in use. Please use another email address";
		} else { /* If Email && Username available, INSERT user info into DB */
			$query = "INSERT INTO users (id, first_name, last_name, email, user_name, password, avatar, biography, signup_date) VALUES (NULL, '$first_name', '$last_name', '$email', '$user_name', '$password', '$avatar', '$biography', CURRENT_TIMESTAMP)";

			/* If user info has been accepted and inserted into DB */
			if( $result = mysqli_query( $conn, $query ) )	{
				$user_id = mysqli_insert_id($conn);
				$_SESSION['user_id'] = $user_id;
				$_SESSION['loggedInUser'] = $first_name;
				$_SESSION['user_last_name']	= $last_name;
				$_SESSION['user_name'] = $user_name;

				/* If user has set to upload user avatar photo */
				if( isset( $_FILES['avatar'] ) && !empty($_FILES['avatar']['name']) ) {
					include('image_upload.php');
					/* CHECK TO VERIFY UPLOADED FILE HAS PASSED ALL TESTS */
					if( $uploadPass == 0 ) {
						$uploadError .= "<br/>File could not be uploaded. Upload Pass == 0";
					} else {	/* UPLOAD PASSED ALL TESTS */
						if( move_uploaded_file( $_FILES['avatar']['tmp_name'], $target_path ) ) {
							 /* Rotate image if needed */
							$path = 'images/user_profile_images/';
							$image = $path . $user_image;
							rotateImage($image);
							
							 /* Rename user avatar image to include user_id */
							$avatar = "user$user_id.$image_type";
							$query	= "UPDATE users
									   SET avatar = '$avatar'
									   WHERE id = '$user_id'";
							mysqli_query($conn, $query);
							$_SESSION['avatar']	= $avatar;
						} else {
							$avatar = 'userAvatarDefault.png';
							$_SESSION['avatar']	= $avatar;
							$uploadError .= "<br/>File could not be uploaded. Move file failed";
						}
					}
				}

				/* If success of Inserted user info, email user */
				$email_subject = "Welcome to Blogster.com";
				$email_message = "Welcome to Blogster.com" . $first_name . "!\r You can now start telling the world about your thoughts.\r\n\t Your email: " . $email . "\r Your username: " . $user_name . "\r Your password: " . $_POST['password'] . "\r\r\r\n Thank you for using Blogster.com!";
				mail($email, $email_subject, $email_message);

				/* Redirect user to index page upon completion of signup */
				header( "Location: index.php?alert=logged_in" );
			} else { /* Inserted user info failed */
				echo "Error: " . $query . "<br/>" . mysqli_error( $conn );
			}
		}
	}
}

include('includes/header.php');
?>
		
<!--<p class="text-danger text-right col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">* Required fields</p>-->

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" enctype="multipart/form-data" id="signupForm" class="form-horizontal col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
	<p class="text-danger text-right requiredMessage">* Required fields</p>
	<div class="form-group">		
		<img src="images/user_profile_images/<?php echo $avatar ?>" alt="User profile avatar" class='user_avatar_preview'>
		<label for="avatar" class="control-label ">User Avatar</label><br>
		<p class="text-danger imageTypeError hidden"><small> Please only use image file types ('jpg', 'jpeg', 'png', 'gif).</small></p>
		<p class="text-danger imageSizeError hidden"><small> File size too large. (Max 5Mb)</small></p>
		<input type="file" name="avatar">
		<p class="help-block">(Image files only, max size 5Mb)</p>
		<!--<button type="submit" name="avatarUpload" class="btn btn-info btn-sm">Upload Avatar</button>-->
	</div>
	
	<div class="form-group has-feedback">
		<label for="first_name" class="control-label">First Name <span class="text-danger asterisk">&nbsp;&nbsp;* </span></label>
		<small class="text-danger nameError">Please enter a first name</small>
		<small class="text-danger nameError"><?= $nameError; ?></small>
		<input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" max="100" aria-describedby="nameErrorStatus" autofocus required>
    	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    	<span class="sr-only" id="nameErrorStatus"></span>
	</div>
	
	<div class="form-group">
		<label for="last_name" class="control-label">Last Name</label>
		<input type="text" name="last_name" class="form-control" placeholder="Last Name" max="100">
	</div>

	<div class="form-group has-feedback">
		<label for="user_name" class="control-label">Username <span class="text-danger asterisk">&nbsp;&nbsp;* </span></label>
		<small class="text-danger usernameError">Please enter a username</small>
		<small class="text-danger usernameError"><?= $usernameError; ?></small>
		<input type="text" name="user_name" class="form-control" id="username" placeholder="Username" max="100" aria-describedby="usernameErrorStatus" required>
    	<span class="glyphicon form-control-feedback"  aria-hidden="true"></span>
		
		<small class="text-danger usernameExistsError">** Username already in use. Please choose a different username</small>
    	<span class="sr-only" id="usernameErrorStatus"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="email" class="control-label">Email <span class="text-danger asterisk">&nbsp;&nbsp;* </span></label>
		<small class="text-danger emailError">Please enter your email</small>
		<small class="text-danger emailError"><?= $emailError; ?></small>
		<input type="text" name="email" class="form-control" id="email" placeholder="Email" max="100" aria-describedby="emailExistsError" required>
    	<span class="glyphicon form-control-feedback"></span>
		<small class="text-danger emailExistsError"  aria-hidden="true">** Email already in use. Please use a different email</small>
    	<span class="sr-only" id="emailErrorStatus"></span>
	</div>
	
	<div class="form-group has-feedback">
		<label for="password" class="control-label">Password <span class="text-danger asterisk">&nbsp;&nbsp;* </span></label>
		<small class="text-danger passwordError">Please enter a password</small>
		<small class="text-danger passwordError"><?= $emailError; ?></small>
		<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
    	<span class="glyphicon form-control-feedback"></span>
	</div>

	<div class="form-group">
		<label for="biography" class="control-label">Biography:</label> <br/>
		<textarea name="biography" class="form-control" id="biography" cols="20" rows="3"></textarea>
		<br/><br/>
		<input type="submit" class="btn-lg btn-success" name="signup" value="Signup">
	</div>
</form>
		
<?php include('includes/footer.php');