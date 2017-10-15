<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">        
	<meta name="author" content="Dustin Hammack">
	<meta name="description" content="A personal Blogging site!">

	<!-- Mobile Stuff -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-tap-highlight" content="no">

	<!-- Chrome on Android -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="application-name" content="A personal Blogging site!">
	<!--<link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon.png">-->

	<!-- Safari on iOS -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="A personal Blogging site!">
	<link rel="apple-touch-icon" href="images/touch/apple-touch-icon.png">

	<!-- Windows 8 -->
	<meta name="msapplication-TileImage" content="images/touch/ms-touch-icon.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">


	<meta name="theme-color" content="#000000">

	<!--<link rel="shortcut icon" href="favicon.ico">-->
	

	<title>Blogger.com</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<!-- Minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>    
	
	<div class="container">
		<header class="row">
			<h1 class="col-sm-5"><a href="index.php">Blogger.com</a></h1>
			
		<form class="form-inline col-sm-4 col-sm-offset-3" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
		   <!--<p class="lead">Log in to your account.</p>-->
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
			
		</header>

		<!--<div class="clearfix"></div>-->

		<nav id="mainNav" class="row">
			<ul class="col-sm-7 col-xs-12">
				<li><a href="#">Home</a><span>|</span></li>
				<li><a href="blogs.php">Blogs</a><span>|</span></li>
				<li><a href="aboutus.php">About</a></li>
				<!--<li><a href="#"></a> | </li>-->
			</ul>
			
			<form class="col-sm-4 col-sm-offset-1 col-xs-12">
				<!--<div class="form-group">-->
					<label for="search" class="sr-only">Search site</label>
					<div class="input-group">
						<input type="search" name="search" id="search" class="form-control" placeholder="Search Site">
						<span class="input-group-btn">	<!--input-sm col-sm-6 col-sm-offset-4 -->
							<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>	<!--Go! col-sm-1 btn btn-success-->
						</span>
					</div> <!-- End of .input-group -->
				<!--</div>-->
			</form>
		</nav>