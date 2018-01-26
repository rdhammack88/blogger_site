<?php
$page_title = "Signup"; 
session_start();

include('includes/functions.php');
$avatar = 'userAvatarDefault.png';
$nameError = $usernameError = $emailError = $passwordError = "";

if( isset( $_POST["signup"] ) ) {
	include("includes/connection.php");
	
//	var_dump($_POST);
	
	// check to see if inputs are empty
	// create variables with form data
	// wrap the data with our function
//	$first_name = $user_name = $email = $password = "";
	
	if( !$_POST["first_name"] ) {
		$nameError = "Please enter a first name";
	} else {
		$first_name = validateFormData( $_POST["first_name"] );
//		$_SESSION['loggedInUser'] = $first_name;
	}

	if( $_POST["last_name"] ) {
		$last_name = validateFormData( $_POST["last_name"] );
//		$_SESSION['user_last_name']	= $last_name;
	} else {
		$last_name = NULL;
	}

	if( !$_POST["email"] ) {
		$emailError = "Please enter your email";
		$email = $emailError;
	} else {
		
		if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
			$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
			$email = validateFormData($email); //$_POST['email']);
		}
		
//		$query 	= "SELECT *
//				   FROM users
//				   WHERE email = '$email'";
//		$result	= mysqli_query( $conn, $query );
//		
//		if( mysqli_num_rows($result) >= 1 ) {
//			$emailError = "That email is already in use. Please use another email address";
//		} else {
//			$email = $email;
//		}
	}
	
	if( !$_POST["user_name"] ) {
		$$usernameError = "Please enter a username";
//		$user_name = NULL;
//		$_SESSION['user_name'] = $email;
	} else {
		$user_name = validateFormData( $_POST["user_name"] );
//		$_SESSION['user_name'] = $user_name;
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
	
//	$pos = strrpos($user_image, '.');
////	$image_type = substr($user_image, $pos + 1);
//	var_dump($_FILES);
//	echo $user_image;
//	echo $avatar . "<br>";
//	echo $image_type . "<br>";
//	echo $_FILES['avatar']['mime'];
	echo $first_name . "<br>";
	echo $last_name . "<br>";
	echo $user_name . "<br>";
	echo $email . "<br>";
	echo $_POST['password'] . "<br>";
	echo $biography . "<br>";
//	exit();
	
	/* CHECK TO SEE IF EACH VARIABLE HAS DATA */
	if( $first_name && $user_name && $email && $password ) {
		
		$query 	= "SELECT email, user_name
				   FROM users
				   WHERE email = '$email'
				   OR user_name = '$user_name'";
		$result	= mysqli_query( $conn, $query );
		
		if(mysqli_num_rows($result) >= 1) {
//		if($result) { //DOESNT work right, returns regardless
			$emailError = "That email is already in use. Please use another email address";
		} else {
			$query = "INSERT INTO users (id, first_name, last_name, email, user_name, password, avatar, biography, signup_date) VALUES (NULL, '$first_name', '$last_name', '$email', '$user_name', '$password', '$avatar', '$biography', CURRENT_TIMESTAMP)";

			if( $result = mysqli_query( $conn, $query ) )	{
				$user_id = mysqli_insert_id($conn);
				$_SESSION['user_id'] = $user_id;
				$_SESSION['loggedInUser'] = $first_name;
				$_SESSION['user_last_name']	= $last_name;
				$_SESSION['user_name'] = $user_name;


				if( isset( $_FILES['avatar'] ) && !empty($_FILES['avatar']['name']) ) {
					include('image_upload.php');
					// CHECK TO VERIFY UPLOADED FILE HAS PASSED ALL TESTS
					if( $uploadPass == 0 ) {
						$uploadError .= "<br/>File could not be uploaded. Upload Pass == 0";
						echo $uploadError;
					} else {	// UPLOAD PASSED ALL TESTS
						if( move_uploaded_file( $_FILES['avatar']['tmp_name'], $target_path ) ) { //'user$user_id.$image_type'
							$avatar = "user$user_id.$image_type";
							$query	= "UPDATE users
									   SET avatar = '$avatar'
									   WHERE id = '$user_id'";
							mysqli_query($conn, $query);
	//						$avatar = "user$user_id.$image_type";
							$_SESSION['avatar']	= $avatar;
	//						$avatar = $user_image;
			//				$_SESSION['avatar']	= $avatar;
						} else {
							$avatar = 'userAvatarDefault.png';
							$_SESSION['avatar']	= $avatar;
							$uploadError .= "<br/>File could not be uploaded. Move file failed";
							echo $uploadError;
						}
					}
				}

	//			$uploadPass = 1;
				/* When image uploaded, change the name of the image in DB */
	//			if($uploadPass == 1) { //isset($uploadPass) && 
	////				$row = mysqli_fetch_assoc( $result );
	//				//$user_id = mysqli_insert_id($conn); //$row['id']; //mysqli_insert_id();
	//				$query	= "UPDATE users
	//						   SET avatar = 'user$user_id.$image_type'
	//						   WHERE id = '$user_id'
	//						   LIMIT 1";
	//				$avatar = "user$user_id.$image_type";
	//				$_SESSION['avatar']	= $avatar;
	//			}

	//			echo "Upload Pass = " . $uploadPass . "<br>";
	//			echo $user_id;
	//			exit();

	//			if( !$avatar ) {
	//				$avatar = 'userAvatarDefault.png';
	//				$_SESSION['avatar']	= $avatar;
	//			} 
	//			echo $avatar;
	//			exit();
	//			mysqli_free_result($result);
				/* Get the new users user-id */
	//			$query = "SELECT * FROM users WHERE username = '$email'";
	//			$result = mysqli_query($conn, $query);
	//			$row = mysqli_fetch_assoc($result);
	//			
	//			/* Set $_SESSION variables */
	////			$_SESSION['user_id']		= $user_id;
	////			$_SESSION['loggedInUser'] 	= $first_name;
	////			$_SESSION['user_last_name']	= $row['last_name'];
	////			$_SESSION['avatar']			= $avatar;
	////			$_SESSION['user_name']		= $row['user_name'];
	//			
	//			mysqli_free_result($result);
				/* Send signup conformation email */
	//		$send_to = $email;
	//		$subject = 'Your signed up!';
	//		$message = "Dear $first_name, \n\tThank you for signing up to Blogger.com";
	//		mail( $send_to, $subject, $message );


				$email_subject = "Welcome to Blogster.com";
				$email_message = "Welcome to Blogster.com" . $first_name . "!\r You can now start telling the world about your thoughts.\r\n\t Your email: " . $email . "\r Your username: " . $user_name . "\r Your password: " . $_POST['password'] . "\r\r\r\n Thank you for using Blogster.com!";
				mail($email, $email_subject, $email_message);

				/* redirect user to index page upon completion of signup */
				header( "Location: index.php?alert=logged_in" );
			} else {
				echo "Error: " . $query . "<br/>" . mysqli_error( $conn );
			}
		}
	}
}

include('includes/header.php');
?>
		
<!--<p class="text-danger text-right col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">* Required fields</p>-->

<form class="form-horizontal col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" id="signupForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" enctype="multipart/form-data">

<!--	<div class="row">-->
	
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