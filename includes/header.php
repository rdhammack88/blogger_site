<?php //include('./connection.php'); ?>
<!DOCTYPE html>
<html>
<head lang="en">
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

	<!--<meta name="theme-color" content="#000000">-->
	<!--<link rel="shortcut icon" href="favicon.ico">-->
	
	<title>Blogger.com - <?php echo $page_title; ?></title>
	
	<!-- Site Fonts Loaded from Google Fonts -->
	<!--<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
	<!--<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">-->
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Nosifer|Shadows+Into+Light" rel="stylesheet">
	
	<!-- Minified Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/styles.css">
	
	<!-- Internet Explorer Backwards Compatibility -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body data-offset-top="80px">
	<!-- Navigation Bar -->
	<nav class="navbar navbar-default">
        <div class="container-fluid">
			<div class="container">
				<!-- Navbar Header -->
				<div class="navbar-header">
					<a class="navbar-brand homeLink" href="index.php"><strong>BLOGGER</strong>.com</a>
					<!-- Mobile Devices Navbar Hamburger Icon -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> <!-- End of .navbar-header -->
				<div class="collapse navbar-collapse" id="navbar-collapse">
				<?php
				/* If user is logged in, display user navigation */
				if( isset( $_SESSION['loggedInUser'] ) ) :
					if(isset($_SESSION['avatar'])){
						$profile_avatar = $_SESSION['avatar'];
					} else {
						$profile_avatar = 'userAvatarDefault.png';
					}
					if(isset($_SESSION['user_name'])) {
						$user_name		= $_SESSION['user_name'];
					}
					if(isset($_SESSION['last_name']) && $_SESSION['last_name'] != NULL) {
						$user_full_name	= $_SESSION['loggedInUser'] . $_SESSION['last_name'];
					} else {
						$user_full_name = $_SESSION['loggedInUser'];
					}							
				?>
					<p class="navbar-text hidden">Welcome, <?php echo ucfirst($_SESSION['loggedInUser']);?></p> 
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php" class="homeLink"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
						<li><a href="blogs.php" class="blogsLink">My Blogs</a></li>
						<!-- User account dropdown menu -->
						<li class="account"><a role='listitem'>Account</a>
							<ul class='hidden account-dropdown'>
								<a href="user_profile.php"><li>
								<img class="image-border header-profile-image" src="./images/user_profile_images/<?= $profile_avatar; ?>" alt="User <?php $user_name; ?> profile image">
									<p id="navUserInfo">
										<span class="nav-full-name">
										<?= $user_full_name ?>
										</span>
										<span class="nav-user-name"><strong><em>
										<?= $user_name?>
										</strong></em></span>
									</p>
								</li></a>
								<a href="blog_manager.php"><li>Manage Blogs</li></a>
								<a href="user_account.php"><li>Edit Profile</li></a>
								<a href="logout.php"><li>Log out</li></a>
							</ul> <!-- End of .account-dropdown -->
						</li> <!-- End of .account -->
					</ul> <!-- End of .navbar-right for user navigation -->
				<?php
				else :
				/* If user is not logged in, display default navigation */
				?> <!--  class="activeLink" -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php"><span class="homeLink glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
						<li><a href="login.php">Log In</a></li>
						<li id="signupButton"><a href="signup.php">Sign Up</a></li>
					</ul> <!-- End of .navbar-right for default navigation -->
				<?php endif; ?>
				</div> <!-- End of .navbar-collapse -->
            </div> <!-- End of .container -->
        </div> <!-- End of container-fluid -->

		<!-- Search Form -->
   		<div class="row">
			<form class=" col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3" id="searchForm" method="get" autocomplete="off">
			<!-- action="includes/ajax.php?search=" -->
				<div class="form-group">
					<label for="search" class="sr-only">Search site by blog title, blog category, blog post, username, or user email</label>
					<div class="input-group">
						<input type="search" name="search" id="search" class="form-control input-lg" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default btn-lg" id="searchButton" name="searchButton"><span class="glyphicon glyphicon-search"></span></button>
						</span> <!-- End of .input-group-btn -->
					</div> <!-- End of .input-group -->
					<!-- Search list dropdown -->
					<ul class="search-list list-group hidden"></ul>
				</div> <!-- End of .form-group -->
			</form> <!-- End of .searchForm -->
		</div> <!-- End of .row -->
    </nav> <!-- End of Navigation Menu -->
	<!-- Main div for body content -->
	<div class="container body-container clearfix">