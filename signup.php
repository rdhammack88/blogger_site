<?php $TITLE = "Signup"; ?>

<?php 
session_start();

include('includes/functions.php');
$avatar = 'userAvatarDefault.png';

if( isset( $_POST["signup"] ) ) {
		
		
	include("includes/connection.php");
	
	// build a function that validates data
//	function validateFormData( $formData ) {
//		$formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
//		return $formData;
//	}

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
	} /*else {
		$last_name = NULL;
	}*/

	if( $_POST["user_name"] ) {
		$user_name = validateFormData( $_POST["user_name"] );
	} /*else {
		$user_name = NULL;
	}*/

	if( !$_POST["email"] ) {
		$emailError = "Please enter your email <br/>";
	} else {
		$user_selected_email = validateFormData($_POST['email']); //$_POST["email"];
		$user_selected_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
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
//
//	if( $_POST["avatar"] ) {
//		$avatar = validateFormData( $_POST["avatar"] );
//	} /*else {
//		$avatar = "NULL";
//	}*/

	if( $_POST["biography"] ) {
		$biography = validateFormData( $_POST["biography"] );
	} /*else {
		$biography = NULL;
	}*/
	
	
//	if( isset( $_POST['avatar'] ) ) {
		require('image_upload.php');
		// CHECK TO VERIFY UPLOADED FILE HAS PASSED ALL TESTS
		if( $uploadPass == 0 ) {
			$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
			echo $uploadError;
		} else {	// UPLOAD PASSED ALL TESTS
			if( move_uploaded_file( $_FILES['avatar']['tmp_name'], $target_path ) ) {
				$avatar = $user_image;
				/*$query 	= "UPDATE users
						  SET avatar = '$avatar'
						  WHERE id = '$user_id'";
				$result = mysqli_query( $conn, $query );*/
			} else {
				//$avatar = 'userAvatarDefault.png';
				$uploadError .= "<br/>File could not be uploaded. Line: " . __LINE__;
				echo $uploadError;
			}
		}
//	} else {
//		$avatar = 'userAvatarDefault.png';
//	}

	if( !$avatar ) {
		$avatar = 'userAvatarDefault.png';
	//	$avatar = 'images/Male_User_Filled.png';
	} 
//	else {
//		$avatar = 'images/user_profile_images/' . $avatar;
//	}


	// CHECK TO SEE IF EACH VARIABLE HAS DATA
	if( $first_name && $email && $password ) {
//		$send_to = $email;
//		$subject = 'Your signed up!';
//		$message = "Dear $first_name, \n\tThank you for signing up to Blogger.com";
//		mail( $send_to, $subject, $message );
		
		

		$query = "INSERT INTO users (id, first_name, last_name, email, user_name, password, avatar, biography, signup_date) VALUES (NULL, '$first_name', '$last_name', '$email', '$user_name', '$password', '$avatar', '$biography', CURRENT_TIMESTAMP)";

//			echo "This is line " . __LINE__ . " in file " . __FILE__;

		if( $result = mysqli_query( $conn, $query ) )	{
//				echo "This is line " . __LINE__ . " in file " . __FILE__;
			/*$row 		= mysqli_fetch_assoc($result);
			$user_id	= $row['id'];
			$first_name = $row['first_name'];*/
			// redirect user to blogs page
			//////header( "Location: blogs.php?alert=new_user" );
			
			/* When image uploaded, change the name of the image in DB */
			$row = mysqli_fetch_assoc( $result );
			$user_id = $row['id'];
			$query	= "UPDATE users
					   SET avatar = 'user$user_id.$image_type',
					   WHERE id = '$user_id'";
			
//			header( "Location: login.php" );  ---- use this here
			
			
			
//				header( "Location: blogs.php?alert=success");
//				echo "<div class='alert alert-success'>New record in database!</div>";
			
			/* Send signup conformation email */
			$email_subject = "Welcome to Blogster.com";
			$email_message = "Welcome to Blogster.com" . $first_name . "!\r You can now start telling the world about your thoughts.\r\n\t Your email: " . $email . "\r Your username: " . $user_name . "\r Your password: " . $_POST['password'] . "\r\r\r\n Thank you for using Blogster.com!";
			mail($email, $email_subject, $email_message);
			
			
			
//			$query = "SELECT comments.id AS comment_id, comments.user_id,
//					  users.id, users.email,
//					  users.user_name, users.avatar
//					  FROM comments
//					  LEFT JOIN users ON comments.user_id = users.id
//					  WHERE user_id = $user_id
//					  AND comment = '$comment'";
////					  AND user_id = (SELECT MAX(id) FROM comments
////					  WHERE user_id = $user_id)";
//			$result = mysqli_query($conn, $query);
//			$row = mysqli_fetch_assoc($result);
			
			
			/* Get the new users user-id */
			$query = "SELECT id FROM users WHERE username = $user_name";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			
			$_SESSION['user_id']		= $row['id'];
			$_SESSION['loggedInUser'] 	= $first_name;
			
			// redirect user to blogs page
//			header( "Location: blogs.php?alert=logged_in" );
			header( "Location: index.php?alert=logged_in" );
			
			
		} else {
			echo "Error: " . $query . "<br/>" . mysqli_error( $conn );
		}

	/*} else {
		if( !$first_name ) {
			echo "<span class='text-danger'>$nameError</span>";
		}
		if( !$email ) {
			echo "<span class='text-danger'>$emailError</span>"; 
		}
		if( !$password ) {
			echo "<span class='text-danger'>$passwordError</span>"; 
		}*/

	}

		mysqli_close( $conn );	


}

/*if( isset( $_POST['avatar'] ) ) {
	
	if( !$avatar ) {
		$avatar = 'images/userAvatarDefault.png';
	//	$avatar = 'images/Male_User_Filled.png';
	} else {
		$avatar = 'images/user_profile_images/' . $avatar;
	}
}*/



/*$query = INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `user_name`, `password`, `avatar`, `biography`, `signup_date`) VALUES (NULL, 'Brutus', 'Hammack', 'brutus@email.com', 'brutusthedog', 'rusty', NULL, 'This is a section all about Brutus the dog!', CURRENT_TIMESTAMP);*/

//$query = "INSERT INTO users (id, username, password, email, signup_date, biography)
//VALUES (NULL, 'jacksonsmith', 'abc123', 'jackson@email.com', CURRENT_TIMESTAMP, 'Hello! My name is Jackson, and this is my bio!!')";


/*

MYSQL INSERT QUERY

INSERT INTO users (id, username, password, email, signup_date, biography)
VALUES (NULL, 'jacksonsmith', 'abc123', 'jackson@email.com', CURRENT_TIMESTAMP, 'Hello! My name is Jackson, and this is my bio!!');

*/

//mysqli_close( $conn );	

include('includes/header.php');

?>



<?php
		
//			if( mysqli_query( $conn, $query ) )	{
//				echo "New record in database!";
//			} else {
//				echo "Error: " . $query . "<br/>" . mysqli_error( $conn );
//			}

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