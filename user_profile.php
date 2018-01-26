<?php
$page_title = "User Profile";
require_once("includes/connection.php");
require_once("includes/functions.php");
session_start();

if(!isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id'])) { 
	header("Location: login.php");
}

$first_name = '';
$last_name = '';
$email = '';
$user_name = '';
$avatar = '';
$bio = '';

//$query = "SELECT * FROM users
//		  WHERE user_id = $user_id
//		  ORDER BY date_created DESC";
//$result = mysqli_query($conn, $query);


//if(isset($_SESSION['loggedInUser'])) {
	$user_id = $_SESSION['user_id'];
	
	$query = "SELECT * FROM users
			  WHERE id = $user_id";
	$result = mysqli_query($conn, $query);

	if($result) {
		while($row = mysqli_fetch_assoc($result)) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$user_name = $row['user_name'];
			$avatar = $row['avatar'];
			$bio = $row['biography'];
		}
	}
//}
require_once("includes/header.php");
modalCaller();
//echo '<br/><main class="row">';
//
//echo '<section id="blogSection" class="col-xs-12 col-md-8 col-md-offset-1">';
?>


<br/><main class="row">
<aside id="userInfo" class="col-xs-12 col-md-5">
	<img src="images/user_profile_images/<?=  $avatar; ?>" alt="User <?=  $user_name;?> profile avatar" id="userAvatar">
	<br><br>
	<ul>
		<li>Name:&nbsp;&nbsp;<?= $first_name . ' ' . $last_name; ?></li>
		<li>Username: &nbsp;&nbsp;<?= $user_name; ?></li>
		<li>Email: &nbsp;&nbsp;<?= $email; ?></li>
		<li>Biography: &nbsp;&nbsp;<?= $bio; ?></li>
	</ul>
</aside>

<!--<span class="align-left"></span> 
<span class="align-right"></span>
<span class="align-left"></span>
<span class="align-right"></span>
<span class="align-left"></span>
<span class="align-right"></span>
<span class="align-left"></span>
<span class="align-right"></span>-->

<section id="blogSection" class="col-xs-12 col-md-6 col-md-offset-1">



</section>
</main>
<?php include('./includes/footer.php'); ?>

</section>
</main>