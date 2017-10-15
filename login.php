<?php include('includes/header.php'); ?>
  

<form class="col-sm-4 col-sm-offset-4" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
<p class="lead">Log in to your account.</p>
	<div class="form-group">
		<label for="login-email" class="sr-only">Email</label>
		<input type="text" class="form-control" id="login-email" placeholder="Email/Username" name="email" value="<?php echo $formEmail; ?>">
	</div>
	<div class="form-group">
		<label for="login-password" class="sr-only">Password</label>
		<input type="password" class="form-control" id="login-password" placeholder="Password" name="password">
	</div>
	<button type="submit" class="btn btn-primary" name="login">Login</button>
</form>


<?php // include('includes/footer.php'); ?>