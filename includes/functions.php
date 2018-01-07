<?php

// FUNCTIONS.php

// clean the form data to prevent injections

/*	Built in functions used:
	trim()
	stripslashes()
	htmlspecialchars()
	strip_tags()
	str_replace()
*/

function validateFormData($formData) {
	$formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')' ), '', $formData ) ), ENT_QUOTES ) ) );	
	return $formData;
}

function queryCaller($conn, $query) {
	$blogs 	= mysqli_query($conn, $query);
	
//	$avatar = 'userAvatarDefault.png';

	while( $row = mysqli_fetch_assoc($blogs) ) {
//		if (!isset($row['avatar'])) {
		if ($row['avatar'] == null) {
			$avatar = 'userAvatarDefault.png';
		} else {
			$avatar = $row['avatar'];
		}
		
		if (!isset($row['user_name'])) {
			$name = $row['email'];
		} else {
			$name = $row['user_name'];
		}
		echo "<article>";
		echo "<div class='blog_title'><a href='#' class='avatar'><img src='images/user_profile_images/" . $avatar . "'/></a><a href='#' class='name' ><h4 class='user_name'>" . $name . "</h4></a><br/><a href='index.php' class='title'><h2 class='title'>" . $row['blog_title'] . "</h2></a><a href='index.php?date=" . $row['date_created'] . "' class='date'>- <p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
		echo "<form class='blog_footer' action='./includes/ajax.php' method='POST'><span class='sr-only'>Like this blog</span><button type='submit' class='glyphicon glyphicon-heart-empty btn btn-lg' name='like'></button><span class='sr-only'>Dislike this blog</span><button type='submit' class='glyphicon glyphicon-thumbs-down btn btn-lg' name='dislike'></button><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'></form>";
		echo "</article>";			
	}
}
?>