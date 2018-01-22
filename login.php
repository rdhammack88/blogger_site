<?php $TITLE = "Login"; ?>
<?php
session_start();

include("includes/functions.php");

$loginError = "";

// if login form was submitted
if( isset( $_POST['login'] ) ) {
	
	// create variables
	// wrap data with validate function
	$formEmail	= validateFormData( $_POST['email'] );
	$formPass	= validateFormData( $_POST['password'] );

	// connect to database
	include('includes/connection.php');

	// create query
	$query = "SELECT id, first_name, last_name, 
			  email, user_name, password, avatar 
			  FROM users
			  WHERE email='$formEmail' 
			  OR user_name='$formEmail'";

	// store the result
	$result = mysqli_query( $conn, $query );
	
	// verify if result is returned
	if( mysqli_num_rows($result) > 0 ) {
		
		// store basic user data in variables
		while( $row = mysqli_fetch_assoc($result) ) {
			$user_id	= $row['id'];
			$first_name = $row['first_name'];
//			$avatar		= $row['avatar'];
			$hashedPass = $row['password'];
						
			if ($row['last_name'] == null) {
				$last_name = NULL;
			} else {
				$last_name 	= $row['last_name'];
			}
			
			if ($row['avatar'] == null) {
				$avatar = 'userAvatarDefault.png';
				$class 	= '';
			} else {
				$avatar = $row['avatar'];
				$class 	= 'image-border';
			}
			
			if ($row['user_name'] == null) {
				$user_name = $row['email'];
			} else {
				$user_name = $row['user_name'];
			}
		}
		
		// verify hashed password with submitted password
		if( password_verify( $formPass, $hashedPass ) ) {
			
			// correct login details!
			// store data in SESSION variables
			$_SESSION['user_id']		= $user_id;
			$_SESSION['loggedInUser'] 	= $first_name;
			$_SESSION['user_last_name']	= $last_name;
			$_SESSION['avatar']			= $avatar;
			$_SESSION['user_name']		= $user_name;
			
			
			// redirect user to blogs page
//			header( "Location: blogs.php?alert=logged_in" );
			header( "Location: index.php?alert=logged_in" );
			
		} else { // hashed password didn't verify
			
			// error message
			$loginError = "<div class='alert alert-danger'>Wrong username / password combination. Please try again!</div>";
		}
		
	} else { // there are no results in the database
		
		// error message
		$loginError = "<div class='alert alert-danger'>No such user in database. Please try again! <a class='close' data-dismiss='alert'>&times;</a></div>";
	}

	// close connection to database
	mysqli_close($conn);
	
}



include('includes/header.php');

//$password = password_hash( "abc123", PASSWORD_DEFAULT );
//echo $password;

?>

<p class="lead text-center">Log in to your account</p>

<?php echo $loginError; ?>

<form class="" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <div class="form-group col-sm-4 col-sm-offset-4">
        <label for="login-email" class="sr-only">Enter email or username to login</label>
        <input type="text" class="form-control" id="login-email" placeholder="email / username" name="email" value="<?php //echo $formEmail; ?>" autocomplete="username" autofocus>
    </div>
    <div class="form-group col-sm-4 col-sm-offset-4">
        <label for="login-password" class="sr-only">Enter password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password" autocomplete="current-password">
    </div>
    <div class="form-group col-sm-4 col-sm-offset-4">
    	<button type="submit" class="btn btn-primary col-xs-6 col-xs-offset-6" name="login">Login</button>
	</div>
</form>
<div class="col-sm-4 col-sm-offset-4">
	<br><br>
	<div class="row">
		<p class="text-center">Don't have an account? <a href="signup.php">Create one</a></p>
	</div>
	<div class="row">
		<p class="text-center">Forgot <a href="account_recovery.php">username/password?</a></p>
	</div>
</div>

<?php
include('includes/footer.php');
?>