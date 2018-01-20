<?php

	$user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : 'tmp';
	$user_image_dir = "images/user_profile_images/";
	$user_image		= basename( $_FILES['avatar']['name'] );
	$imageType		= pathinfo( $user_image, PATHINFO_EXTENSION );
	$imageType		= strtolower($imageType);
	$user_image		= "user" . $user_id . '.' . $imageType;
	$target_path	= $user_image_dir . $user_image;
	$uploadPass 	= 1;
	$uploadError	= '';

//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";
//var_dump($_FILES);

	$verifyImage	= getimagesize( $_FILES['avatar']['tmp_name'] );
//	print_r( $verifyImage );
//	echo "<br>";
//	var_dump($verifyImage);
//	echo "<br>";
//	print_r( $_FILES['avatar'] );
	if( $verifyImage !== false ) {
		$uploadPass	= 1;
	} else {
		$uploadPass 	= 0;
		$uploadError 	.= "<br/>" . $verifyImage["mime"];
	}

	// CHECK FILE SIZE
	if( $_FILES['avatar']['size'] > 5242881 ) { //5242880
		$uploadError .= "<br/>File size too large. (Max 5Mb)";
		$uploadPass  = 0;
	}

	// VERIFY FILE TYPE IS IMAGE
	if( $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'jpg' && $imageType != 'gif' ) {
		$uploadError 	.= "<br/>Please only use image file types ('jpg', 'jpeg', 'png', 'gif).";
		$uploadPass 	= 0;
	}
?>