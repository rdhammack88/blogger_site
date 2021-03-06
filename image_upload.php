<?php
	$user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : 'tmp';
	$user_image_dir = "images/user_profile_images/";
	$user_image		= basename( $_FILES['avatar']['name'] );
	$image_type		= pathinfo( $user_image, PATHINFO_EXTENSION );
	$image_type		= strtolower($image_type);
	$user_image		= "user" . $user_id . '.' . $image_type;
	$target_path	= $user_image_dir . $user_image;
	$uploadPass 	= 1;
	$uploadError	= '';
	$verifyImage	= getimagesize( $_FILES['avatar']['tmp_name'] );

	if( $verifyImage !== false ) {
		$uploadPass	= 1;
	} else {
		$uploadPass 	= 0;
		$uploadError 	.= "<br/>" . $verifyImage["mime"];
	}

	// CHECK FILE SIZE
	if( $_FILES['avatar']['size'] > 6242880 ) { //5242880
		$uploadError .= "<br/>File size too large. (Max 6Mb)";
		$uploadPass  = 0;
	}

	// VERIFY FILE TYPE IS IMAGE
	if( $image_type != 'png' && $image_type != 'jpeg' && $image_type != 'jpg' && $image_type != 'gif' ) {
		$uploadError 	.= "<br/>Please only use image file types ('jpg', 'jpeg', 'png', 'gif).";
		$uploadPass 	= 0;
	}
?>