<?php
//session_start();
//include('includes/connection.php');

isset( $_SESSION['user_id'] ) ? $user_id = $_SESSION['user_id'] : $user_id = 'tmp';

$user_image_dir = "images/user_profile_images/";
//$user_avatar	= $user_image_dir . basename( $_FILES['avatar']['name'] );
$user_image		= basename( $_FILES['avatar']['name'] );
$uploadPass 	= 1;
$uploadError	= '';
$imageType		= pathinfo( $user_image, PATHINFO_EXTENSION );
$imageType		= strtolower($imageType);
$user_image		= "user" . $user_id . '.' . $imageType;
$target_path	= $user_image_dir . $user_image;
//echo $imageType;
//echo $_FILES['avatar']['size'];
//if( isset( $_POST['avatar'] ) ) {
	$verifyImage	= getimagesize( $_FILES['avatar']['tmp_name'] );
	print_r( $verifyImage );
	print_r( $_FILES['avatar'] );
	//echo basename( $_FILES['avatar']['name'] );
	if( $verifyImage !== false ) {
		//echo "File is an image - " . $verifyImage["mime"] . ".";
		//echo "File name is " . basename( $_FILES['avatar']['name']);
		//echo "File temp name is " . basename( $_FILES['avatar']['tmp_name']);
		$uploadPass	= 1;
	} else {
//		echo "File is not an image.";
		$uploadPass 	= 0;
//		$uploadError 	.= "<br/>Please only use image file types ('jpg', 'jpeg', 'png', 'gif). Line: " . __LINE__;
		$uploadError 	.= "<br/>" . $verifyImage["mime"] . ". Line: " . __LINE__;
		//echo $uploadError;
	}
//}

// CHECK FILE SIZE
if( $_FILES['avatar']['size'] > 5242880 ) {
	$uploadError .= "<br/>File size too large. (Max 5Mb)";
	$uploadPass  = 0;
	//echo $uploadError;
}

// VERIFY FILE TYPE IS IMAGE
if( $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'jpg' && $imageType != 'gif' ) {
	$uploadError 	.= "<br/>Please only use image file types ('jpg', 'jpeg', 'png', 'gif). Line: " . __LINE__;
	$uploadPass 	= 0;
	//echo $uploadError;
}



?>














