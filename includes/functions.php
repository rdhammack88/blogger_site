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
		
		$blog_id = $row['blog_id'];
		$date_created = $row['date_created'];
		
		if(isset($_SESSION['loggedInUser'])) {
			$user_id = $_SESSION['user_id'];
			$query = "SELECT * 
					  FROM blog_post_likes
					  WHERE user_id = $user_id
					  AND blog_id = $blog_id";
			$likes = mysqli_query($conn, $query);

			$query = "SELECT *
					  FROM blog_post_dislikes
					  WHERE user_id = $user_id
					  AND blog_id = $blog_id";
			$dislikes = mysqli_query($conn, $query);

			$query = "SELECT *
					  FROM user_favorites
					  WHERE user_id = $user_id
					  AND blog_id = $blog_id";
			$favorites = mysqli_query($conn, $query);
		}
		
		
		
		
		
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
			$like_count = 0;
		} else {
			$like_count = $row['likes'];
		}
		
		if (!$row['dislikes']) {
			$dislike_count = 0;
		} else {
			$dislike_count = $row['dislikes'];
		}
		
		if (!$row['total_comments']) {
			$total_comments = 0;
		} else {
			$total_comments = $row['total_comments'];
		}
		
		echo "<article id='" . $row['blog_id'] . "'>"; //<div class='col-xs-10'></div><div class='col-xs-2'></div>
		//col-xs-3 col-xs-4  col-xs-5
		/*echo "<div class='blog_title row'><div class='col-xs-8'><a href='#' class='avatar '><img class='" . $class . "' src='images/user_profile_images/" . $avatar . "'/></a><a href='#' class='name' ><h4 class='user_name '>" . $name . "</h4></a></div><div class='date_and_settings col-xs-4'><p class='settings row'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-lg'><small class='glyphicon glyphicon-chevron-down down-arrow'></small></button></p><a href='index.php?date=" . $row['date_created'] . "' class='date row'><p class='date_posted'>". $row['date_created'] . "</p></a></div></div><div class='row blogPost'><a href='index.php' class='title'><h3 class='title col-xs-12'>" . $row['blog_title'] . "</h3></a><p class='post col-xs-12'>". $row['blog_post'] . "</p><div class=' likes-and-comments'><p class='text-right col-xs-10 likes-and-comments'><span class='total-likes'>" . $likes . " Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-dislikes'>" . $dislikes . "  Dislikes</span> &nbsp;&nbsp;&nbsp;<span class='total-comments'>" . $total_comments . "  Comments</span></p></div></div>";*/
		
		
		
		echo "<div class='blog_title row'><div class='col-xs-8'><a href='#' class='avatar '><img class='" . $class . "' src='images/user_profile_images/" . $avatar . "'/></a><a href='#' class='name' ><h4 class='user_name '>" . $name . "</h4></a></div>";
			
		if(isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id']) {
			echo "<div class='date_and_settings col-xs-4'><p class='settings row'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-lg'><small class='glyphicon glyphicon-chevron-down down-arrow'></small></button></p><a href='index.php?date=" . $row['date_created'] . "' class='date row'><p class='date_posted'>". $row['date_created'] . "</p></a></div>";
		} else {
			echo "<div class='date col-xs-4'><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div>";
		}
				
		echo "</div><div class='row blogPost'><a href='index.php' class='title'><h3 class='title col-xs-12'>" . $row['blog_title'] . "</h3></a><p class='post col-xs-12'>". $row['blog_post'] . "</p><div class=' likes-and-comments'><p class='text-right col-xs-10 likes-and-comments'><span class='total-likes'>" . $like_count . " Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-dislikes'>" . $dislike_count . "  Dislikes</span> &nbsp;&nbsp;&nbsp;<span class='total-comments'>" . $total_comments . "  Comments</span></p></div></div>";
		
		if(isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id']) {
			echo "<div class='row blog-footer-row'> <form class='blog_footer' action='./includes/ajax.php' method='POST'><p class='col-xs-7'><span class='sr-only'>Like this blog</span><button type='submit' class='btn like-btn' name='like' title='Like this post'><span class='glyphicon";
			if(mysqli_num_rows($likes) > 0) {
				echo ' glyphicon-heart liked';
			} else {
				echo ' glyphicon-heart-empty';
			}
			
			echo "'></span> Like</button><span class='sr-only'>Favorite this blog</span><button type='submit' class='btn favorite-btn' name='favorite' title='Favorite this post'><span class='glyphicon";
			// If the blog has been favorited, add class to change color
//			if(isset($row['favorite']) && $row['favorite'] > 0) {
			if(mysqli_num_rows($favorites) > 0) {
				echo " glyphicon-star favorite";
			} else {
				echo " glyphicon-star-empty";
			}
			
			echo "'></span> Favorite</button><button type='submit' class='comment-btn btn' name='comment' title='Comment on this post'><span class=' glyphicon glyphicon-comment'></span> Comment</button></p><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'><input type='text' value='" . $row['blog_category'] . "' class='blog_category hidden'><p class='text-right col-xs-5'><span class='sr-only'>Edit this blog</span><button type='submit' class='glyphicon glyphicon-pencil btn' name='edit' title='Edit this post'></button><span class='sr-only'>Delete this blog</span><button type='button' class='glyphicon glyphicon-trash btn id='" . $row['id'] . "'  name='deletePost' data-toggle='modal' data-target='#deleteBlogModal' title='Delete this post'></button></p></form></div>";
			echo "</article>";
		} else {
			echo "<div class='row blog-footer-row'> <form class='blog_footer' action='./includes/ajax.php' method='POST'><p class='col-xs-12'><span class='sr-only'>Like this blog</span><button type='submit' class='btn like-btn' name='like'><span class='glyphicon";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($likes) > 0) {
				echo ' glyphicon-heart liked';
			} else {
				echo ' glyphicon-heart-empty';
			}
			
			echo "'></span> Like</button><span class='sr-only'>Dislike this blog</span><button type='submit' class='btn dislike-btn' name='dislike'><span class='glyphicon glyphicon-thumbs-down ";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($dislikes) > 0) {
				echo 'disliked';
			}
			
			echo "'></span> Dislike</button><span class='sr-only'>Favorite this blog</span><button type='submit' class='btn favorite-btn' name='favorite' title='Favorite this post'><span class='glyphicon";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($favorites) > 0) {
			// If the blog has been favorited, add class to change color
//			if(isset($row['favorite']) && $row['favorite'] > 0) {
				echo " glyphicon-star favorite";
			} else {
				echo " glyphicon-star-empty";
			}
					
			echo "'></span> Favorite</button><button type='submit' class='comment-link btn' name='comment'><span class=' glyphicon glyphicon-comment'></span> Comment</button></p><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'><input type='text' value='" . $row['blog_category'] . "' class='blog_category hidden'></form></div>";
			echo "</article>";	
		}		
	}
}

function user_blogs($data) {
	
}
?>

	<!-- <div class='row'> </div> -->
<!--<p class='text-right'><span class='total-likes'>5 Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-likes'>5 Comments</span></p>-->