<?php
//session_start();
//include('includes/connection.php');

$user_image_dir = "images/user_profile_images/";
$user_avatar	= $user_image_dir . basename( $_FILES['avatar']['name'] );
$uploadPass 	= 1;
$uploadError	= '';
$imageType		= pathinfo( $user_avatar, PATHINFO_EXTENSION );
echo $imageType;
//if( isset( $_POST['avatar'] ) ) {
	$verifyImage	= getimagesize( $_FILES['avatar']['tmp_name'] );
	if( $verifyImage !== false ) {
		//echo "File is an image - " . $verifyImage["mime"] . ".";
		//echo "File name is " . basename( $_FILES['avatar']['name']);
		//echo "File temp name is " . basename( $_FILES['avatar']['tmp_name']);
		$uploadPass	= 1;
	} else {
//		echo "File is not an image.";
		$uploadPass 	= 0;
		$uploadError 	.= "<br/>Please only use image file types ('jpg', 'jpeg', 'png', 'gif). Line: " . __LINE__;
		//echo $uploadError;
	}
//}

// CHECK FILE SIZE
if( $_FILES['avatar']['size'] > 9000000 ) {
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