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

function modalCaller() {
	echo '<!-- Modal -->
		  <div id="deleteBlogModal" class="modal fade" role="dialog">
		  <form class="modal-dialog" method="post" action="includes/ajax.php">
		  <!-- Modal content-->
		  <div class="modal-content">
		  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;  </button>
		  <h4 class="modal-title"><span class="glyphicon glyphicon-alert text-danger" aria-hidden="true"></span> &nbsp; &nbsp; Confirm deletion of blog post</h4>
		  </div>
		  <div class="modal-body">
		  <p>Are you sure you want to delete this blog post? <strong class="text-danger">This cannot be undone!</strong></p>
		  <input type="number" value="" id="comment_or_blog_id" name="comment_or_blog_id" class="hidden"><!-- hidden -->
		  <input type="number" value="" id="blogID" name="blogID" class="hidden"><!-- hidden -->
		  <input type="text" value="" id="comment_or_blog" name="comment_or_blog" class="hidden"><!-- hidden -->
		  </div>
		  <div class="modal-footer">
		  <button type="submit" class="btn btn-danger" name="delete">Confirm Delete</button>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div></div></form></div>';
}

function sidebarCaller($conn) {
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
	echo '<br/><div class="row text-right">';
	
	
//	echo strrpos($_SERVER['SCRIPT_NAME'], '/') + 1;
//	echo strpos($_SERVER['SCRIPT_NAME'], '.') - 1;
	$start_of_script_name = strrpos($_SERVER['SCRIPT_NAME'], '/') + 1;
	$page = substr($_SERVER['SCRIPT_NAME'], $start_of_script_name, -4);
//	echo "<br>";
//	echo $_SERVER['SCRIPT_NAME'];
	
//	$page = substr($_SERVER['SCRIPT_NAME'], -9, -4);	
	if($page == 'blogs') {
		echo '<span class="sr-only">Add new blog</span><a href="add_blog.php" class="glyphicon glyphicon-plus btn btn-primary add-btn" aria-hidden="true"> New</a>';
		$header = "Your most written topics";
		$query = "SELECT blog_category 
				  FROM blog_posts
				  WHERE user_id='$user_id'
				  GROUP BY blog_category
				  HAVING COUNT(*) >= 1";
	} else { //if($page == 'index') {
		echo '<small class="text-danger fade-text">Most Recent Blog Posts...</small>';
		$header = "Popular Topics";
		$query = "SELECT blog_category 
				  FROM blog_posts
				  WHERE public = 'public'
				  GROUP BY blog_category
				  HAVING COUNT(*) > 1";
	}
	
	echo '</div><br/>';
	modalCaller();
	echo '<main class="row">';
	echo '<aside id="blogTopics" class="col-md-3 hidden-sm"><nav>';
	echo '<h4 class="text-center">' . $header . '</h4>';
	
		$result = mysqli_query( $conn, $query );
		if( mysqli_num_rows( $result ) > 0 ) {
			echo "<ul>";
			while( $row = mysqli_fetch_assoc($result) ) {
				
				echo "<li><a href='index.php?topic=" . $row['blog_category'] . "'>" . $row['blog_category'] . "</a></li>";

			}
			echo "</ul>";
			mysqli_free_result( $result );
		}

	echo '</nav></aside>'; /* End of Blog Topics Section */
} /* End of sidebarCaller() */

function queryCaller($conn, $query) {
	$blogs 	= mysqli_query($conn, $query);
//	$avatar = 'userAvatarDefault.png';
//	echo '<section id="blogSection" class="col-sm-12 col-md-8 col-md-offset-1">';

	while( $row = mysqli_fetch_assoc($blogs) ) {
		
		$blog_id = $row['blog_id'];
		$date_created = $row['date_created'];
		$cursor_class = isset($_SESSION['loggedInUser']) ? 'cursor-pointer' : NULL;
		
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
		
		$query = "SELECT comments.id, comments.comment, comments.blog_id,
				  comments.user_id, comments.date_entered, 
				  users.email, users.user_name, users.avatar
				  FROM comments
				  LEFT JOIN users ON comments.user_id = users.id
				  WHERE blog_id = $blog_id
				  ORDER BY date_entered DESC";
		$comments = mysqli_query($conn, $query);
		
		
//		      FROM blog_posts
//		      LEFT JOIN users ON blog_posts.user_id = users.id
//			  WHERE user_id='$user_id'
		
//		if (!isset($row['avatar'])) {
		if ($row['avatar'] == null) {
			$avatar = 'userAvatarDefault.png';
			$class 	= '';
		} else {
			$avatar = $row['avatar'];
			$class 	= 'image-border';
		}
		
		if ($row['user_name'] == null) {
			$name = $row['email'];
		} else {
			$name = $row['user_name'];
		}
		
		if ($row['likes'] == null) {
			$like_count = 0;
		} else {
			$like_count = $row['likes'];
		}
		
		if ($row['dislikes'] == null) {
			$dislike_count = 0;
		} else {
			$dislike_count = $row['dislikes'];
		}
		
		if ($row['total_comments'] == null) {
			$total_comments = 0;
		} else {
			$total_comments = $row['total_comments'];
		}
		
		echo "<div class='blog'><article id='" . $row['blog_id'] . "'>"; //<div class='col-xs-10'></div><div class='col-xs-2'></div>
		//col-xs-3 col-xs-4  col-xs-5
		/*echo "<div class='blog_title row'><div class='col-xs-8'><a href='#' class='avatar '><img class='" . $class . "' src='images/user_profile_images/" . $avatar . "'/></a><a href='#' class='name' ><h4 class='user_name '>" . $name . "</h4></a></div><div class='date_and_settings col-xs-4'><p class='settings row'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-lg'><small class='glyphicon glyphicon-chevron-down down-arrow'></small></button></p><a href='index.php?date=" . $row['date_created'] . "' class='date row'><p class='date_posted'>". $row['date_created'] . "</p></a></div></div><div class='row blogPost'><a href='index.php' class='title'><h3 class='title col-xs-12'>" . $row['blog_title'] . "</h3></a><p class='post col-xs-12'>". $row['blog_post'] . "</p><div class=' likes-and-comments'><p class='text-right col-xs-10 likes-and-comments'><span class='total-likes'>" . $likes . " Likes</span> &nbsp;&nbsp;&nbsp;<span class='total-dislikes'>" . $dislikes . "  Dislikes</span> &nbsp;&nbsp;&nbsp;<span class='total-comments'>" . $total_comments . "  Comments</span></p></div></div>";*/
		
		
		
		echo "<div class='blog_title row'><div class='col-xs-8'><a href='#' class='avatar '><img class='" . $class . "' src='images/user_profile_images/" . $avatar . "' alt='User " . $row['user_name'] . "s profile photo' /></a><a href='#' class='name' ><h4 class='user_name '>" . $name . "</h4></a></div>";
			
		if(isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id']) { // form  class='hidden'
			echo "<div class='date_and_settings col-xs-4'><p class='settings row hidden'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-lg' aria-hidden='true'><small class='glyphicon glyphicon-chevron-down down-arrow' aria-hidden='true'></small></button></p><form method='post' action='./includes/ajax.php'><ul class='hidden settingsList'><span class='sr-only'>Edit this blog</span><li><button type='submit' class='btn' name='edit' title='Edit this post'  data-toggle='tooltip' data-placement='top'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> &nbsp;&nbsp; Edit blog</button></li><span class='sr-only'>Delete this blog</span><li><button type='button' class='btn delete' id='" . $row['blog_id'] . "'  name='delete_post' data-toggle='modal' data-target='#deleteBlogModal' title='Delete this post'  data-toggle='tooltip' data-placement='top'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> &nbsp;&nbsp; Delete blog</button></li><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'></ul></form><a href='index.php?date=" . $row['date_created'] . "' class='date row'><p class='date_posted'>". $row['date_created'] . "</p></a></div>";
		} else {
			echo "<div class='date col-xs-4'><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div>";
		}
				
		echo "</div><div class='row blogPost'><a href='index.php' class='title'><h3 class='title col-xs-12'>" . $row['blog_title'] . "</h3></a><p class='post col-xs-12'>". strip_tags($row['blog_post']) . "</p><div class=' likes-and-comments'><p class='text-right col-xs-10 likes-and-comments'><span class='total-likes'>" . $like_count . " </span> Likes &nbsp;&nbsp;&nbsp;<span class='total-dislikes'>" . $dislike_count . "  </span> Dislikes &nbsp;&nbsp;&nbsp;<span class='comment-btn " . $cursor_class . " " . $row['blog_id'] . "' title='Comment on this post' data-toggle='tooltip' data-placement='top'><span class='total-comments'>" . $total_comments . "</span> Comments</span></p></div></div>";
		
		if(isset($_SESSION['user_id']) && $row['user_id'] == $_SESSION['user_id']) {
			echo "<div class='row blog-footer-row'> <form class='blog_footer' action='./includes/ajax.php' method='POST'><p class='col-xs-9'><span class='sr-only'>Like this blog</span><button type='submit' class='btn like-btn' name='like' title='Like this post' data-toggle='tooltip' data-placement='top'><span class='glyphicon";
			if(mysqli_num_rows($likes) > 0) {
				echo ' glyphicon-heart liked';
			} else {
				echo ' glyphicon-heart-empty';
			}
			
			echo "' aria-hidden='true'></span> Like</button><span class='sr-only'>Favorite this blog</span><button type='submit' class='btn favorite-btn' name='favorite' title='Favorite this post' data-toggle='tooltip' data-placement='top'><span class='glyphicon";
			// If the blog has been favorited, add class to change color
//			if(isset($row['favorite']) && $row['favorite'] > 0) {
			if(mysqli_num_rows($favorites) > 0) {
				echo " glyphicon-star favorited";
			} else {
				echo " glyphicon-star-empty";
			}
			
			echo "' aria-hidden='true'></span> Favorite</button><button type='submit' class='comment-btn btn '" . $row['blog_id'] . "' name='comment' title='Comment on this post' data-toggle='tooltip' data-placement='top'><span class=' glyphicon glyphicon-comment' aria-hidden='true'></span> Comment</button></p><input type='number' value='" . $row['blog_id'] . "' name='blogid' class='hidden blog_id'><input type='text' value='" . $row['blog_category'] . "' class='blog_category hidden'><p class='text-right col-xs-3 footerSettings'><span class='sr-only'>Edit this blog</span><button type='submit' class='glyphicon glyphicon-pencil btn' aria-hidden='true' name='edit' title='Edit this post' data-toggle='tooltip' data-placement='top'></button><span class='sr-only'>Delete this blog</span><button type='submit' class='glyphicon glyphicon-trash btn' aria-hidden='true' id='" . $row['id'] . "'  name='delete' title='Delete this post' data-toggle='tooltip' data-placement='top'></button></p></form></div>";
//			echo "</article>";
		} else {
			echo "<div class='row blog-footer-row'> <form class='blog_footer' action='./includes/ajax.php' method='POST'><p class='col-xs-12'><span class='sr-only'>Like this blog</span><button type='submit' class='btn like-btn' name='like' title='Like this post'  data-toggle='tooltip' data-placement='top'><span class='glyphicon";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($likes) > 0) {
				echo ' glyphicon-heart liked';
			} else {
				echo ' glyphicon-heart-empty';
			}
			
			echo "' aria-hidden='true'></span> Like</button><span class='sr-only'>Dislike this blog</span><button type='submit' class='btn dislike-btn' name='dislike' title='Disike this post'  data-toggle='tooltip' data-placement='bottom'><span class='glyphicon glyphicon-thumbs-down ";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($dislikes) > 0) {
				echo 'disliked';
			}
			
			echo "' aria-hidden='true'></span> Dislike</button><span class='sr-only'>Favorite this blog</span><button type='submit' class='btn favorite-btn' name='favorite' title='Favorite this post'  data-toggle='tooltip' data-placement='top'><span class='glyphicon";
			
			if(isset($_SESSION['user_id']) && mysqli_num_rows($favorites) > 0) {
			// If the blog has been favorited, add class to change color
//			if(isset($row['favorite']) && $row['favorite'] > 0) {
				echo " glyphicon-star favorited";
			} else {
				echo " glyphicon-star-empty";
			}
					
			echo "' aria-hidden='true'></span> Favorite</button><button type='submit' class='comment-btn btn '" . $row['blog_id'] . "' name='comment' title='Comment on this post' data-toggle='tooltip' data-placement='bottom'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span> Comment</button></p><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'><input type='text' value='" . $row['blog_category'] . "' class='blog_category hidden'></form></div>";
		}
	
		echo "</article><div class='blogComments " . $row['blog_id'] . "'>";
		echo "<form class='' id='commentForm' action='./includes/ajax.php' method='post'>
    	<div class='form-group col-xs-12 input-group'>
        <label class='sr-only'>Leave a comment</label>			
		<input type='text' name='commentInput' class='form-control input-lg input-group commentInput' placeholder='Leave a comment...'><input type='number' value='" . $row['blog_id'] . "' name='blog_id' class='hidden blog_id'><span class='input-group-btn'><span class='sr-only'>Post comment</span><button type='submit' class='btn btn-default btn-lg comment-post-btn' name='commentPost'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></button></span></div></form>";
		
		echo "<ul class='list-group comment-list'>";
		
		if(mysqli_num_rows($comments) >= 1) {
			while($comment_row = mysqli_fetch_assoc($comments)) {
				$date_from_server = strtotime($comment_row['date_entered']);
//				$date = date('M-d-Y  h:i:s a', $date);
				$date = date('M d, Y', $date_from_server);
				$time = date('g:ia', $date_from_server);
				
				if ($comment_row['avatar'] == null) {
					$avatar = 'userAvatarDefault.png';
					$class 	= '';
				} else {
					$avatar = $comment_row['avatar'];
					$class 	= 'image-border';
				}
				if ($comment_row['user_name'] == null) {
					$user_name = $comment_row['email'];
				} else {
					$user_name = $comment_row['user_name'];
				}
				
				echo "<li class='comment list-group-item' id='" . $comment_row['id'] . "'><p class='col-xs-8'>";
				echo "<a href='user_profile.php?user=".$comment_row['user_id']."'>";
				echo "<img src='images/user_profile_images/" . $avatar;
				echo "' alt='User " . $user_name;
				echo "s profile photo' class='comment_user_avatar ";
				echo $class . "'/>";
				echo "<span class='user-name comment-user-name'>";
				echo $user_name . "</span></a></p>";
				
				if(isset($_SESSION['user_id']) && $comment_row['user_id'] == $_SESSION['user_id']) {
				echo "<p class='settings row hidden col-xs-4'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-sm' aria-hidden='true'><small class='glyphicon glyphicon-chevron-down down-arrow' aria-hidden='true'></small></button></p><form method='post' action='./includes/ajax.php'><ul class='hidden settingsList'><span class='sr-only'>Edit this comment</span><li><button type='submit' class='btn edit_comment' name='edit_comment' title='Edit this comment'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> &nbsp;&nbsp; Edit comment</button></li><span class='sr-only'>Delete this comment</span><li><button type='button' class='btn delete' id='" . $comment_row['id'] . "'  name='delete_comment' data-toggle='modal' data-target='#deleteBlogModal' title='Delete this comment'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> &nbsp;&nbsp; Delete comment</button></li><input type='number' value='" . $comment_row['id'] . "' name='comment_id' class='hidden comment_id'></ul></form>";
				}
				
				echo "<hr/>";
				echo "<p class='comment'><span class='comment-text'>";
				echo htmlspecialchars($comment_row['comment']);
				echo "</span></p><p class='comment-date'><small class='date-posted'>";
				echo "<em>";
				echo $date . '&nbsp;&nbsp;' . $time;
				echo "</em></small></p>";
				echo "</li>";
			}
		}
		echo "</ul>";
		echo '</div></div>';
	}
//	echo '</section></main>';
} /* End of queryCaller() */

function user_blogs($data) {
	
}
?>