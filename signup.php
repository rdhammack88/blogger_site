<?php include('includes/header.php'); ?>
<?php 

include("includes/connection.php"); 

if( isset( $_POST["add"] ) ) {
		
		// build a function that validates data
		function validateFormData( $formData ) {
			$formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
			return $formData;
		}
		
		// check to see if inputs are empty
		// create variables with form data
		// wrap the data with our function
		
		$first_name = $email = $password = "";
	
		if( !$_POST["first_name"] ) {
			$nameError = "Please enter your first name <br/>";
		} else {
			$first_name = validateFormData( $_POST["first_name"] );
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
		
		/*if( !$_POST["username"] ) {
			$nameError = "Please enter your username <br/>";
		} else {
			$username = validateFormData( $_POST["username"] );
		}*/
			
		if( !$_POST["email"] ) {
			$emailError = "Please enter your email <br/>";
		} else {
			$email = validateFormData( $_POST["email"] );
		}
	
		if( !$_POST["password"] ) {
			$passwordError = "Please enter your password <br/>";
		} else {
//			$password = validateFormData( $_POST["password"] );
			$password = password_hash( $_POST['password'], PASSWORD_DEFAULT );
		}
	
		if( $_POST["avatar"] ) {
			$avatar = validateFormData( $_POST["avatar"] );
		} else {
			$avatar = NULL;
		}
	
		if( $_POST["biography"] ) {
			$biography = validateFormData( $_POST["biography"] );
		} else {
			$biography = NULL;
		}
	
		// CHECK TO SEE IF EACH VARIABLE HAS DATA
		if( $first_name && $email && $password ) {
	
			$query = "INSERT INTO users (id, first_name, last_name, email, user_name, password, avatar, biography, signup_date) VALUES (NULL, '$first_name', '$last_name', '$email', '$user_name', '$password', '$avatar', '$biography', CURRENT_TIMESTAMP)";

			if( mysqli_query( $conn, $query ) )	{
				header( "Location: index.php?alert=success");
				echo "<div class='alert alert-success'>New record in database!</div>";
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
	
//		mysqli_close( $conn );	

	
	}


/*$query = INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `user_name`, `password`, `avatar`, `biography`, `signup_date`) VALUES (NULL, 'Brutus', 'Hammack', 'brutus@email.com', 'brutusthedog', 'rusty', NULL, 'This is a section all about Brutus the dog!', CURRENT_TIMESTAMP);*/

//$query = "INSERT INTO users (id, username, password, email, signup_date, biography)
//VALUES (NULL, 'jacksonsmith', 'abc123', 'jackson@email.com', CURRENT_TIMESTAMP, 'Hello! My name is Jackson, and this is my bio!!')";


/*

MYSQL INSERT QUERY

INSERT INTO users (id, username, password, email, signup_date, biography)
VALUES (NULL, 'jacksonsmith', 'abc123', 'jackson@email.com', CURRENT_TIMESTAMP, 'Hello! My name is Jackson, and this is my bio!!');

*/

mysqli_close( $conn );	

?>




<?php
		
//			if( mysqli_query( $conn, $query ) )	{
//				echo "New record in database!";
//			} else {
//				echo "Error: " . $query . "<br/>" . mysqli_error( $conn );
//			}

		?>
		
		<p class="text-danger col-sm-4 col-sm-offset-4">* Required fields</p>
		
		<form class="col-sm-4 col-sm-offset-4" id="signupForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
			
			<label for="first_name" class="sr-only">First Name</label>
			<input type="text" name="first_name" id="first_name" placeholder="First Name">
			<small class="text-danger">* </small> <br/>
			<small class="text-danger"><?php echo $nameError; ?></small> <br/>
			
			<label for="last_name" class="sr-only">Last Name</label>
			<input type="text" name="last_name" placeholder="Last Name"> <br/><br/>
			
			<!--<small class="text-danger">* <?php //echo $nameError; ?></small>-->
			<label for="user_name" class="sr-only">Username</label>
			<input type="text" name="user_name" placeholder="Username"> <br/><br/>	
			
			<label for="email" class="sr-only">Email</label>
			<input type="text" name="email" id="first_name" placeholder="Email">
			<small class="text-danger">*</small> <br/>
			<small class="text-danger"><?php echo $emailError; ?></small> <br/>
			
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="password" id="first_name" placeholder="Password">
			<small class="text-danger">*</small> <br/>
			<small class="text-danger"> <?php echo $passwordError; ?></small> <br/>
			
			<!--<input type="file" name="avatar"> <br/><br/>-->
			
			<label for="biography">Biography:</label> <br/>
			<textarea name="biography" id="biography" cols="30" rows="10"></textarea>
			<br/><br/>
			<input type="submit" name="add" value="Add Entry">
		</form>