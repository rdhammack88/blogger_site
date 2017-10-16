<?php
session_start();

include("includes/functions.php");

// if login form was submitted
if( isset( $_POST['login'] ) ) {
	
	// create variables
	// wrap data with validate function
	$formEmail = validateFormData( $_POST['email'] );
	$formPass = validateFormData( $_POST['password'] );

	// connect to database
	include('includes/connection.php');

	// create query
	$query = "SELECT first_name, password FROM users WHERE email='$formEmail'";

	// store the result
	$result = mysqli_query( $conn, $query );
	
	// verify if result is returned
	if( mysqli_num_rows($result) > 0 ) {
		
		// store basic user data in variables
		while( $row = mysqli_fetch_assoc($result) ) {
			$id			= $row['id'];
			$first_name = $row['first_name'];
			$hashedPass = $row['password'];
		}
		
		// verify hashed password with submitted password
		if( password_verify( $formPass, $hashedPass ) ) {
			
			// correct login details!
			// store data in SESSION variables
			$_SESSION['loggedInUser'] = $first_name;
			
			// redirect user to clients page
			header( "Location: blogs.php?alert=logged in" );
		} else { // hashed password didn't verify
			
			// error message
			$loginError = "<div class='alert alert-danger'>Wrong username / password combination. Please try again!</div>";
		}
		
	} else { // there are no results in the database
		
		// error message
		$loginError = "<div class='alert alert-danger'>No such user in database. Please try again! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}

}

// close connection to database
mysqli_close($conn);

include('includes/header.php');

//$password = password_hash( "abc123", PASSWORD_DEFAULT );
//echo $password;

?>

<p class="lead text-center">Log in to your account.</p>

<?php echo $loginError; ?>

<form class="" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <div class="form-group col-sm-4 col-sm-offset-4">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo $formEmail; ?>">
    </div>
    <div class="form-group col-sm-4 col-sm-offset-4">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>