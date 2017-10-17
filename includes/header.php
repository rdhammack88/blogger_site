<?php  //define( "TITLE", "Home" ); ?>
<?php //session_start(); ?>
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
	

	<title>Blogger.com - <?php echo $title; ?></title>
	<!--<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
	<!--<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">-->
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Nosifer|Shadows+Into+Light" rel="stylesheet">
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

	<nav class="navbar navbar-default ">

        <div class="container-fluid">

            <div class="navbar-header">
            	<a class="navbar-brand" href="index.php"><strong>BLOGGER</strong>.com</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
            </div>
			
            <div class="collapse navbar-collapse" id="navbar-collapse">

               	<?php
				//$_SESSION['loggedInUser'] = '';
                if( $_SESSION['loggedInUser'] ) { // if user is logged in
                ?>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="blogs.php">My Blogs</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <p class="navbar-text">Welcome, <?php echo $_SESSION['loggedInUser'];?></p> 
                    <!--$_POST[$name]-->

                    <li><a href="user_account.php">Account</a></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
                <?php
                } else {
                ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Home</a></li>
                    <!--<li><a href="blogs.php">Blogs</a></li>-->
					<li><a href="login.php">Log In</a></li>
					<li><a href="signup.php">Sign Up</a></li>
                </ul>
                
                <?php
                }
                ?>

           		
            </div>

        </div>

   		<div class="row">
			<!--<h1 class="col-sm-6"><a href="index.php">BLOGGER.com</a></h1>-->
			
			<!--<form class="col-sm-4 col-sm-offset-2 col-xs-12 searchForm" >-->
			<form class="col-md-6 col-md-offset-3" >
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
			
		</div>
   
   
    </nav>
	
	<div class="container">
		
	<br/>