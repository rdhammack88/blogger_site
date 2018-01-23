<?php
include('includes/connection.php');
include('includes/functions.php');
include('includes/header.php');
$error_message = '';

if(isset($_POST['reset'])) {
	$email = validateFormData($_POST['email']);
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	echo $email . '<br/>';
	
	$query = "SELECT first_name, last_name
			  FROM users
			  WHERE email = '$email'";
	$user_name_result = mysqli_query($conn, $query);
	echo "<pre>";
	print_r($user_name_result);
	echo "</pre>";
	
	if(mysqli_num_rows($user_name_result) > 0) {
		$row 	= mysqli_fetch_assoc($user_name_result);
		$first_name = $row['first_name'];
		$last_name	= $row['last_name'];
		echo $first_name . ' ' . $last_name . '<br/>';

		$to = $first_name . ' ' . $last_name . '<' . $email . '>';
		$subject = 'Password Recovery!';
		$headers = [];
		$headers[] = 'From: directconnect@dustinhammack.com';
		$headers[] = 'Content-type: text/html; charset=utf-8';
		$authorized = '-fdirectconnect@dustinhammack.com';
		
		$message = "<h1>Resetting your password is simple</h1>";
		$message .= "<p>Just click the link below and you will be redirected to reset your password.</p>";
		$message .= "<p><a href='https://www.dustinhammack.com/projects/blogger/account_recovery.php?reset=$email'>Click here to be redirected!</a></p>";
		
		$message = wordwrap($message, 70);
		
		$headers = implode("\r\n", $headers);

		$mail_sent = mail($to, $subject, $message, $headers, $authorized);

		if($mail_sent) {
//			header("Location: login.php");
//			exit();
		}
	} else {
		$error_message = "There seems to be a problem... <br/> No user with such email exists in our database. Please try again!";
	}	
}
?>

<p class="lead text-center">Reset your password</p>

<p class="text-center"><small class="text-danger"><?php echo $error_message; ?></small></p>

<form class="" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <div class="form-group col-sm-4 col-sm-offset-4">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php //echo $formEmail; ?>" autocomplete="username" autofocus>
    </div>
    <div class="form-group col-sm-4 col-sm-offset-4">
    	<button type="submit" class="btn btn-primary col-xs-6 col-xs-offset-6" name="reset">Reset</button>
	</div>
</form>
<?php
include('includes/footer.php');
?>