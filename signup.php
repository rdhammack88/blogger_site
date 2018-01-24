<?php
$page_title = "Signup"; 
session_start();

include('includes/functions.php');
$avatar = 'userAvatarDefault.png';

if( isset( $_POST["signup"] ) ) {
	include("includes/connection.php");
	
	// check to see if inputs are empty
	// create variables with form data
	// wrap the data with our function
	$first_name = $email = $password = "";

	if( !$_POST["first_name"] ) {
		$nameError = "Please enter your first name <br/>";
	} else {
		$first_name = validateFormData( $_POST["first_name"] );
		$_SESSION['loggedInUser'] = $first_name;
	}

	if( $_POST["last_name"] ) {
		$last_name = validateFormData( $_POST["last_name"] );
	} else {
		$last_name = NULL;
	}

	if( $_POST["user_name"] ) {
		$user_name = validateFormData( $_POST["user_name"] );
	} else {
		$user_name = NULL;
	}

	if( !$_POST["email"] ) {
		$emailError = "Please enter your email <br/>";
	} else {
		$user_selected_email = validateFormData($_POST['email']); //$_POST["email"];
		$user_selected_email = filter_input(INPUT_POST, $_POST['email'], FILTER_SANITIZE_EMAIL);
		$user_selected_email = filter_input(INPUT_POST, $_POST['email'], FILTER_VALIDATE_EMAIL);
		$query 	= "SELECT *
				   FROM users
				   WHERE email = $user_selected_email";
		$result	= mysqli_query( $conn, $query );
		
		if( $result ) {
			$emailError = "That email is already in use. Please use another email address";
		} else {		
			$email = validateFormData( $_POST["email"] );
			$email =  filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		}
	}

	if( !$_POST["password"] ) {
		$passwordError = "Please enter a password <br/>";
	} else {
		$password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
	}

	if( $_POST["biography"] ) {
		$biography = validateFormData( $_POST["biography"] );
	} else {
		$biography = NULL;
	}
	
	if( isset( $_FILES['avatar'] ) && !empty($_FILES['avatar']['name']) ) {
		require_once('image_upload.php');
		// CHECK TO VERIFY UPLOADED FILE HAS PASSED ALL TESTS
		if( $uploadPass == 0 ) {
			$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
			echo $uploadError;
		} else {	// UPLOAD PASSED ALL TESTS
			if( move_uploaded_file( $_FILES['avatar']['tmp_name'], $target_path ) ) {
				$avatar = $user_image;
			} else {
				$avatar = 'userAvatarDefault.png';
				$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
				echo $uploadError;
			}
		}
	}
	
	/* CHECK TO SEE IF EACH VARIABLE HAS DATA */
	if( $first_name && $email && $password ) {
		$query = "INSERT INTO users (id, first_name, last_name, email, user_name, password, avatar, biography, signup_date) VALUES (NULL, '$first_name', '$last_name', '$email', '$user_name', '$password', '$avatar', '$biography', CURRENT_TIMESTAMP)";

		if( $result = mysqli_query( $conn, $query ) )	{
			$user_id = mysqli_insert_id($conn);
//			$uploadPass = 1;
			/* When image uploaded, change the name of the image in DB */
			if(isset($uploadPass) && $uploadPass != 0) {
//				$row = mysqli_fetch_assoc( $result );
				//$user_id = mysqli_insert_id($conn); //$row['id']; //mysqli_insert_id();
				$query	= "UPDATE users
						   SET avatar = 'user$user_id.$image_type'
						   WHERE id = '$user_id'
						   LIMIT 1";
				$avatar = "user$user_id.$image_type";
			}
			
			if( !$avatar ) {
				$avatar = 'userAvatarDefault.png';
			} 
//			mysqli_free_result($result);
			/* Get the new users user-id */
			$query = "SELECT * FROM users WHERE username = $email";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			
			/* Set $_SESSION variables */
			$_SESSION['user_id']		= $user_id;
			$_SESSION['loggedInUser'] 	= $first_name;
			$_SESSION['user_last_name']	= $row['last_name'];
			$_SESSION['avatar']			= $avatar;
			$_SESSION['user_name']		= $row['user_name'];
			
			mysqli_free_result($result);
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

include('includes/header.php');
?>
		
<p class="text-danger col-sm-4 col-sm-offset-4">* Required fields</p>

<form class="col-sm-4 col-sm-offset-4" id="signupForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" enctype="multipart/form-data">

	<label for="first_name" class="sr-only">First Name</label>
	<input type="text" name="first_name" id="first_name" placeholder="First Name" autofocus>
	<small class="text-danger">* </small> <br/>
	<small class="text-danger nameError">Please enter your first name <br/></small> <br/>

	<label for="last_name" class="sr-only">Last Name</label>
	<input type="text" name="last_name" placeholder="Last Name"> <br/><br/>

	<!--<small class="text-danger">* <?php //echo $nameError; ?></small>-->
	<label for="user_name" class="sr-only">Username</label>
	<input type="text" name="user_name" id="username" placeholder="Username"> <br/><br/>	

	<label for="email" class="sr-only">Email</label>
	<input type="text" name="email" id="email" placeholder="Email">
	<small class="text-danger">*</small> <br/>
	<small class="text-danger emailError">Please enter your email <br/></small> <br/>

	<label for="password" class="sr-only">Password</label>
	<input type="password" name="password" id="password" placeholder="Password">
	<small class="text-danger">*</small> <br/>
	<small class="text-danger passwordError">Please enter a password <br/></small> <br/>

<!--			<input type="file" name="avatar"> <br/><br/>-->

	<img src="images/user_profile_images/<?php echo $avatar ?>" alt="User profile avatar" height="100px" width="100px" style='border-radius=40%;' class='user_avatar_preview'> <br/><br/>
	<label for="avatar">Bio picture:</label>
	<input type="file" name="avatar">
	<small class="text-danger imageTypeError hidden"> Please only use image file types ('jpg', 'jpeg', 'png', 'gif).</small>
	<small class="text-danger imageSizeError hidden"> File size too large. (Max 5Mb)</small> <br/>
	<!--<button type="submit" name="avatarUpload" class="btn btn-info btn-sm">Upload Avatar</button>-->
	<br/><br/>


	<label for="biography">Biography:</label> <br/>
	<textarea name="biography" id="biography" cols="30" rows="10"></textarea>
	<br/><br/>
	<input type="submit" class="btn-lg" name="signup" value="Signup">
</form>
		
<?php include('includes/footer.php');