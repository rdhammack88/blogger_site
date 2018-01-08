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
			$class 	= '';
		} else {
			$avatar = $row['avatar'];
			$class 	= 'image-border';
		}
		
		if (!isset($row['user_name'])) {
			$name = $row['email'];
		} else {
			$name = $row['user_name'];
		}
		
		if (!$row['likes']) {
			$likes = 0;
		} else {
			$likes = $row['likes'];
		}
		
		if (!$row['dislikes']) {
			$dislikes = 0;
		} else {
			$dislikes = $row['dislikes'];
		}
		
		if (!$row['total_comments']) {
			$total_comments = 0;
		} else {
			$total_comments = $row['total_comments'];
		}
		
		echo "<article>"; //<div class='col-xs-10'></div><div class='col-xs-2'></div>
		//col-xs-3 col-xs-4  col-xs-5
		echo "<div class='blog_title row'><a href='#' class='avatar '><img class='" . $class . "' src='images/user_profile_images/" . $avatar . "'/></a><a href='#' class='name' ><h4 class='user_name '>" . $name . "</h4></a><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><div class='row blogPost'><a href='index.php' class='title'><h3 class='title col-xs-12'>" . $row['blog_title'] . "</h3></a><p class='post col-xs-12'>". $row['blog_post'] . "</p><p class='text-right likes-and-comments col-xs-12'><span class='total-likes'>" . $likes . " Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-dislikes'>" . $dislikes . "  Dislikes</span> &nbsp;&nbsp;&nbsp;<span class='total-comments'>" . $total_comments . "  Comments</span></p></div>";
		
		echo "<div class='row blog-footer-row'> <form class='blog_footer' action='./includes/ajax.php' method='POST'><p class='col-xs-12'><span class='sr-only'>Like this blog</span><button type='submit' class='btn' name='like'><span class='glyphicon glyphicon-heart-empty'></span> Like</button><span class='sr-only'>Dislike this blog</span><button type='submit' class='btn' name='dislike'><span class='glyphicon glyphicon-thumbs-down'></span> Dislike</button><button type='submit' class='comment-link btn' name='comment'><span class=' glyphicon glyphicon-comment'></span> Comment</button></p><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'><input type='text' value='" . $row['blog_category'] . "' class='blog_category hidden'></form></div>";
		echo "</article>";			
	}
}

function user_blogs($data) {
	
}
?>

	<!-- <div class='row'> </div> -->
<!--<p class='text-right'><span class='total-likes'>5 Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-likes'>5 Comments</span></p>-->