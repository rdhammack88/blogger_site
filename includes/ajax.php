<?php include('connection.php'); ?>
<?php include('functions.php'); ?>

<?php
session_start();
$avatar = 'userAvatarDefault.png';

//if(isset($_GET['search'])) {
//	$search_query 	= $_GET['search'];
//	/*$query			= "SELECT blog_title, blog_post, blog_category,
//					   date_format(date_created, '%m/%d/%Y') date_created
//					   FROM blog_posts 
//					   WHERE public = 'public'
//					   AND (blog_title = '$search_query'
//					   OR blog_post = '$search_query'
//					   OR blog_category = '$search_query')
//					   ORDER BY date_created DESC";*/
//	
//	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
//			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
//			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
//			   users.email, users.user_name
//			   FROM blog_posts
//			   LEFT JOIN users ON blog_posts.user_id = users.id
//			   WHERE public = 'public'
//			   AND (blog_title = '$search_query'
//			   OR blog_post = '$search_query'
//			   OR blog_category = '$search_query'
//			   OR user_name = '$search_query')
//			   ORDER BY blog_posts.date_created DESC";
//	queryCaller($conn, $query);
//		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
	/*$blogs 	= mysqli_query($conn, $query);


	while( $row = mysqli_fetch_assoc($blogs) ) {
		echo "<article>";
		echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
		echo "</article>";			
	}*/
//}

if(isset($_GET['user_blogs'])) {
	$user_id = $_SESSION['user_id'];
	$_SERVER['SCRIPT_NAME'] = '/fullSiteProjects/blogger/blogs.php';
	sidebarCaller($conn);
	$query = "SELECT blog_posts.blog_title, blog_posts.blog_post,
		      date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
		      blog_posts.blog_category, blog_posts.id AS blog_id,
		      blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
		      blog_posts.total_comments, users.avatar, users.id,
		      users.email, users.user_name
		      FROM blog_posts
		      LEFT JOIN users ON blog_posts.user_id = users.id
			  WHERE user_id='$user_id'
			  ORDER BY blog_posts.date_created DESC"; 
	
	queryCaller($conn, $query);
}

if(isset($_GET['index'])) {
	sidebarCaller($conn);
//	$user_id = $_SESSION['user_id'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   ORDER BY blog_posts.date_created DESC
			   LIMIT 10;";
	
		//. "$_SESSION[" . 'id' . "]"		// %W 
		
	queryCaller($conn, $query);
}


if(isset($_GET['search'])) {
	$search_query 	= $_GET['search'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND (blog_title LIKE '%$search_query%'
			   OR blog_post LIKE '%$search_query%'
			   OR blog_category LIKE '%$search_query%'
			   OR user_name LIKE '%$search_query%')
			   ORDER BY blog_posts.date_created DESC";

	queryCaller($conn, $query);
}
//SELECT blog_posts.blog_title, blog_posts.blog_post,
//			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
//			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
//			   users.email, users.user_name
//			   FROM blog_posts
//			   LEFT JOIN users ON blog_posts.user_id = users.id
//			   WHERE public = 'public'
//			   AND (blog_title LIKE '% dogs%'
//			   OR blog_post LIKE '% lorem%';




if(isset($_GET['topic'])) {
	$topic = $_GET['topic'];
	//$query 		= "SELECT * FROM blog_posts WHERE blog_category = '$topic'";
	/*$query 	= "SELECT blog_title, blog_post, blog_category,
			   date_format(date_created, '%m/%d/%Y') date_created
			   FROM blog_posts 
			   WHERE public = 'public'
			   AND blog_category = '$topic'
			   ORDER BY date_created DESC";*/
	
//	if($_SERVER[])
	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND blog_category = '$topic'
			   ORDER BY blog_posts.date_created DESC";
	queryCaller($conn, $query);
		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
	/*$blogs 	= mysqli_query($conn, $query);


	while( $row = mysqli_fetch_assoc($blogs) ) {
		echo "<article>";
		echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
		echo "</article>";			
	}*/
}  
//else {
//	echo "<p class='text-danger'>No results found!</p>";
//}





//if(isset($_GET['username']) && isset($_GET['title'])) {
//	$username = $_GET['username'];
//	$title = $_GET['title'];
//	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
//			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
//			   blog_posts.blog_category, blog_posts.id,  blog_posts.user_id, users.avatar, users.id,
//			   users.email, users.user_name
//			   FROM blog_posts
//			   LEFT JOIN users ON blog_posts.user_id = users.id
//			   WHERE public = 'public'
//			   AND blog_posts.blog_title = '$title'
//			   AND (users.user_name = '$username'
//			   OR users.email = '$username')";
	
//	echo "welcome home";
//}
if(isset($_GET['full_post'])) {

	$blog_id = $_GET['full_post'];
	$query = "SELECT blog_post
			  FROM blog_posts
			  WHERE id = '$blog_id'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)) {
	echo strip_tags($row['blog_post']);
	}	
}

/* If user clicks the post username, show posts from said user */
if(isset($_GET['username'])) {
	$username = $_GET['username'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND (users.user_name = '$username'
			   OR users.email = '$username')";
	queryCaller($conn, $query);
}

/* If user clicks on blog post date, show other posts from same date */
if(isset($_GET['date'])) {
	$date = $_GET['date'];
//	$query = "SELECT blog_title, blog_post, blog_category,
//		      date_format(date_created, '%m/%d/%Y') date_created
//		      FROM blog_posts 
//		      WHERE public = 'public'
//		      AND INSTR(`date_created`, '$date') > 0
//			  ORDER BY id DESC";
	/*$query = "SELECT blog_title, blog_post, blog_category,
		      date_format(date_created, '%m/%d/%Y') date_created
		      FROM blog_posts
		      WHERE public = 'public'
		      AND date_format(date_created, '%m/%d/%Y')  = '$date'
			  ORDER BY id DESC";*/
	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE blog_posts.public = 'public'
			   AND date_format(blog_posts.date_created, '%m/%d/%Y') = '$date'
			   ORDER BY blog_posts.id DESC";
	queryCaller($conn, $query);
		
		
		//////////////////////////////
			/*PROPERLY WORKS BELOW*/
		/////////////////////////////
//	$blogs 	= mysqli_query($conn, $query);
//
//	
//	while( $row = mysqli_fetch_assoc($blogs) ) {
//		
////		if (!$row['avatar']) {
////			$avatar = 'userAvatarDefault.png';
////		} else {
////			$avatar = $row['avatar'];
////		}
//		
//		echo "<article>";
//		echo "<div class='blog_title'><img src='images/user_profile_images/" . $avatar . "'/><h2 class='title'>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "' class='date'><p class='date_posted'>". $row['date_created'] . "</p></a></div><p class='post'>". $row['blog_post'] . "</p>";
//		echo "</article>";			
//	}
}

/* Set HTTP GET variables as long as user has JS enabled */
/* Delete user Blog */
if( isset( $_GET['delete'] ) ) {
	$comment_or_blog = $_GET['comment_or_blog'];
	
	if($comment_or_blog == 'delete_post') {
		$blog_id = $_GET['delete'];

		$query 	= "DELETE
				   FROM blog_post_dislikes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM blog_post_likes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM comments
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM comment_likes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM user_favorites
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM blog_posts
				   WHERE id='$blog_id'";
		$result = mysqli_query( $conn, $query );
		//$comment_or_blog = $_POST['comment_or_blog'];
	} elseif( $comment_or_blog == 'delete_comment') {
		$comment_id = $_GET['delete'];
		$query 	= "DELETE
				   FROM comments
				   WHERE id = $comment_id";
		$result = mysqli_query($conn, $query);
		
		$blog_id	= $_GET['blogID'];
		$query = "SELECT total_comments FROM blog_posts WHERE id = $blog_id";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$comment_count = $row['total_comments'];
		$comment_count = $comment_count <= 1 ? 0 : $comment_count -= 1;

//		$comment_count -= 1;
		/* Update blog comment count */
		$query = "UPDATE blog_posts 
				  SET total_comments = '$comment_count'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
	}
	
//	if(!$result) {
//		echo "The query is failing";
//	} else {
//		echo $comment_or_blog_id . ' SHOULD HAVE BEEN DELETED';
//	}
}

/* If user clicks the like, update likes in DB */
if(isset($_GET['like'])) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_GET['like'];
		$user_id = $_SESSION['user_id'];
		
		$query	= "SELECT *
				   FROM blog_post_likes
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);
		
		$query 		= "SELECT likes 
					   FROM blog_posts
					   WHERE id='$blog_id'";
		$like_count = mysqli_query( $conn, $query );
		$row	 	= mysqli_fetch_assoc($like_count);
		$likes		= $row['likes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_likes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			/* Add 1 to likes */
			$likes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_likes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$likes = $likes <= 1 ? 0 : $likes -= 1;
		}
		/* Update blog likes */
		$query = "UPDATE blog_posts 
				  SET likes = '$likes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks the dislike, update dislikes in DB */
if(isset($_GET['dislike'])) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_GET['dislike'];
		$user_id = $_SESSION['user_id'];
		
		$query	= "SELECT *
				   FROM blog_post_dislikes
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);
		
		$query 			= "SELECT dislikes 
						   FROM blog_posts
						   WHERE id='$blog_id'";
		$dislike_count 	= mysqli_query( $conn, $query );
		$row	 		= mysqli_fetch_assoc($dislike_count);
		$dislikes		= $row['dislikes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_dislikes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			/* Add 1 to likes */
			$dislikes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_dislikes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$dislikes = $dislikes <= 1 ? 0 : $dislikes -= 1;
		}
		/* Update blog likes */
		$query = "UPDATE blog_posts 
				  SET dislikes = '$dislikes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks the favorite, update favorites in DB */
if(isset($_GET['favorite'])) {	
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_GET['favorite'];
		$user_id = $_SESSION['user_id'];
		
		$query	= "SELECT *
				   FROM user_favorites
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);
		
		$query 	= "SELECT favorite 
				  FROM blog_posts
				  WHERE id='$blog_id'";
		$favorite_count = mysqli_query( $conn, $query );
		$row	 	= mysqli_fetch_assoc($favorite_count);
		$favorite 	= $row['favorite'];

		if( !$row_count ) {
			$query 	= "INSERT INTO user_favorites
					   (id, blog_id, user_id)
					   VALUES
					   (NULL, '$blog_id', '$user_id')";
			$result = mysqli_query( $conn, $query );

			if( !$favorite ) {
				$favorite = 1;
			} elseif( $favorite >= 1 ) {
				$favorite += 1;			
			} else {
				$favorite = 0;
			}

		} else {
			$query 	= "DELETE FROM user_favorites
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$favorite = $favorite <= 1 ? 0 : $favorite -= 1;
		}
		/* Update blog favorite */
		$query = "UPDATE blog_posts 
				  SET favorite = '$favorite'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
	} else {
		header("Location: ../login.php");
	}
}

if(isset($_POST['load_blogs'])) {
	$last_blog_id = $_POST['load_blogs'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND blog_posts.id < $last_blog_id
			   ORDER BY blog_posts.date_created DESC
			   LIMIT 10;";

	//. "$_SESSION[" . 'id' . "]"		// %W 

	queryCaller($conn, $query);
}

if(isset($_POST['public_topic'])) {
	$topic = $_POST['public_topic'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,
			   blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
			   blog_posts.total_comments, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND blog_posts.blog_category = '$topic'
			   ORDER BY blog_posts.date_created DESC
			   LIMIT 10;";

	//. "$_SESSION[" . 'id' . "]"		// %W 

	queryCaller($conn, $query);
}

if(isset($_POST['user_topic'])) {
	$topic = $_POST['user_topic'];
	$user_id = $_SESSION['user_id'];
	$query = "SELECT blog_posts.blog_title, blog_posts.blog_post,
		      date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
		      blog_posts.blog_category, blog_posts.id AS blog_id,
		      blog_posts.user_id, blog_posts.favorite, blog_posts.likes, blog_posts.dislikes,
		      blog_posts.total_comments, users.avatar, users.id,
		      users.email, users.user_name
		      FROM blog_posts
		      LEFT JOIN users ON blog_posts.user_id = users.id
			  WHERE blog_posts.user_id='$user_id'
			  AND blog_posts.blog_category = '$topic'
			  ORDER BY blog_posts.date_created DESC"; 

	//. "$_SESSION[" . 'id' . "]"		// %W 

	queryCaller($conn, $query);
}

if(isset($_POST['comment'])) {
	if(!isset($_SESSION['loggedInUser'])) {
		header("Location ../login.php");
	}
}

/* If user clicks to comment but is not logged in, redirect to login */
/* If not, then add comment to DB and echo comment to comment section */
if(isset($_POST['commentInput']) && $_POST['commentInput'] != '') {
	if(isset($_SESSION['loggedInUser'])) {
//		$data		= $_POST['serialize'];
		$blog_id 	= $_POST['blog_id'];
		$comment	= validateFormData($_POST['commentInput']);
		$user_id	= $_SESSION['user_id'];
		$current_date = date('M d, Y');
		$current_time = date('g:ma');
		
//		echo 'blog id '.$blog_id . '<br/>';
//		echo 'comment '.$comment . '<br/>';
//		echo 'user id '.$user_id . '<br/>';
		
		$query 			= "SELECT total_comments 
						   FROM blog_posts
						   WHERE id=$blog_id";
	 	$comments		= mysqli_query( $conn, $query );
		
//		echo '$comment =<pre>';
//		print_r($comments);
//		echo '</pre><br/>';		
				
		$row	 		= mysqli_fetch_assoc($comments);
		$comment_count	= $row['total_comments'];
//		echo '$comment_count = ' . $comment_count . '<br/>';
		$comment_count += 1;
//		echo '$comment_count = ' . $comment_count . '<br/>';
		
		$query		= "INSERT INTO comments 
					   (id, blog_id, user_id, comment, date_entered)
					   VALUES (NULL, '$blog_id', '$user_id', '$comment', CURRENT_TIMESTAMP)";
		$result		= mysqli_query($conn, $query);
		
		$query		= "UPDATE blog_posts
					   SET total_comments = $comment_count
					   WHERE id = $blog_id";
		$result		= mysqli_query($conn, $query);

		// Return info for jquery to append to dom
		if($result) {
			
			/*$query = "SELECT users.id, users.email,
					  users.user_name, users.avatar
					  FROM users
					  WHERE id = $user_id";*/
			$query = "SELECT comments.id AS comment_id, comments.user_id,
					  users.id, users.email,
					  users.user_name, users.avatar
					  FROM comments
					  LEFT JOIN users ON comments.user_id = users.id
					  WHERE user_id = $user_id
					  AND comment = '$comment'";
//					  AND user_id = (SELECT MAX(id) FROM comments
//					  WHERE user_id = $user_id)";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			
			
		  /*LEFT JOIN comments on users.id = 
		  (SELECT MAX(id) FROM comments
		  WHERE comments.user_id = $user_id)*/
			
			
//			if($image) {
//				echo $image . ' Image found';
//			} else {
//				echo ' NO IMAGE FOUND ';
//			}
			
			if ($row['avatar'] == null) {
				$avatar = 'userAvatarDefault.png';
				$class 	= '';
			} else {
				$avatar = $row['avatar'];
				$class 	= 'image-border';
			}
			
			if($row['user_name'] == null) {
				$user_name = $row['email'];
			} else {
				$user_name = $row['user_name'];
			}
			
			$comment_post = "<li class='comment list-group-item'><p class='col-xs-8'>";
			$comment_post .= "<a href='user_profile.php?user=".$user_id;
			$comment_post .= "'><img src='images/user_profile_images/" . $avatar;
			$comment_post .= "' alt='User " . $user_name;
			$comment_post .= "s profile photo' class='comment_user_avatar ";
			$comment_post .= $class . "'/>";
			$comment_post .= "<span class='user-name'>";
			$comment_post .= $user_name . "</span></a></p>";
			
			if(isset($_SESSION['user_id']) && $row['id'] == $_SESSION['user_id']) {
				$comment_post .= "<p class='settings row hidden col-xs-4'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-sm'><small class='glyphicon glyphicon-chevron-down down-arrow'></small></button></p><form method='post' action='./includes/ajax.php'><ul class='hidden settingsList'><span class='sr-only'>Edit this comment</span><li><button type='submit' class='btn edit_comment' name='edit_comment' title='Edit this comment'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> &nbsp;&nbsp; Edit comment</button></li><span class='sr-only'>Delete this comment</span><li><button type='button' class='btn delete' id='" . $row['comment_id'] . "'  name='delete_comment' data-toggle='modal' data-target='#deleteBlogModal' title='Delete this comment'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> &nbsp;&nbsp; Delete comment</button></li><input type='number' value='" . $row['comment_id'] . "' name='comment_id' class='hidden comment_id'></ul></form>";
			}

			$comment_post .= "<hr/><p class='comment'><span class='comment-text'>";
			$comment_post .= strip_tags($comment);
			$comment_post .= "</span><p class='comment'><small class='date-posted'>";
			$comment_post .= "<em>&nbsp;";
			$comment_post .= $current_date . '&nbsp;&nbsp;' . $current_time;
			$comment_post .= "</em></small>";
			$comment_post .= "</p></li>";
			
			echo $comment_post;
		}
				
//		header("Location: ../index.php");
	} else {
		header("Location: ../login.php");
	}
}

// && $_POST['newCommentInput'] != ''

/* User clicks Edit Comment Button or clicks on the comment itself */
if(isset($_POST['newCommentInput']) && isset($_POST['comment_id']) && $_POST['newCommentInput'] != '') {
	$comment = $_POST['newCommentInput'];
	$comment_id = $_POST['comment_id'];
	
	echo "<form class='' id='commentForm' action='./includes/ajax.php' method='post'><div class='form-group col-xs-12 input-group'><label class='sr-only'>Leave a comment</label><input type='text' value='$comment' placeholder='$comment' name='newCommentInput' class='form-control input-group newCommentInput' id='comment$comment_id' placeholder='Leave a comment...'><input type='number' value='$comment_id' name='commentId' class='hidden commentId'><span class='input-group-btn'><span class='sr-only'>Post comment</span><button type='submit' class='btn btn-default update-comment-post-btn' name='update_comment_post_btn'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></button></span></div></form>";
	
//	echo $edit_comment;
}

/* User submits Editted Comment */
if(isset($_POST['update_comment_post']) && isset($_POST['comment_id'])) {
	$comment = validateFormData($_POST['update_comment_post']);
	$comment_id = $_POST['comment_id'];
//	echo $current_date . "<br>". $current_time;
	
	$query = "UPDATE comments
			  SET comment = '$comment'
			  WHERE id = $comment_id";
	$result = mysqli_query($conn, $query);
	
	if($result) {
		$query = "SELECT comment,
				  date_format(date_entered, '%M %d, %Y g:ma')
				  date_entered
				  FROM comments
				  WHERE id = $comment_id";
		$result = mysqli_query($conn, $query);
		
		if($result) {
			$row = mysqli_fetch_assoc($result);
			$comment = $row['comment'];
			$date_time = $row['date_entered'];
//			$current_date = date('M d, Y');
//			$current_time = date('g:ma');
			
			echo "<span class='comment-text'>" . ucfirst(strip_tags($comment)) . "</span>";
			//<small class='date-posted><em>$date_time</em></small>";
//			<em>&nbsp;$current_date&nbsp;&nbsp;$current_time</em></small>";
		}
	}
}

if(isset($_POST['load_more_comments'])) {
	$blog_id			= $_POST['blog_id'];
	$last_comment_shown	= $_POST['load_more_comments'];
//	echo $blog_id . "<br>";
//	echo $last_comment_shown . "<br>";
//	exit();
	$query = "SELECT comments.id, comments.comment, comments.blog_id,
			  comments.user_id, comments.date_entered, 
			  users.email, users.user_name, users.avatar
			  FROM comments
			  LEFT JOIN users ON comments.user_id = users.id
			  WHERE comments.blog_id = '$blog_id'
			  AND comments.id < '$last_comment_shown'
			  ORDER BY date_entered DESC
			  LIMIT 5";
	$comments = mysqli_query($conn, $query);
	
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
				echo "<p class='settings row hidden col-xs-4'><span class='sr-only'>Settings</span><button class='glyphicon glyphicon-cog btn btn-lg' aria-hidden='true'><small class='glyphicon glyphicon-chevron-down down-arrow' aria-hidden='true'></small></button></p><form method='post' action='./includes/ajax.php'><ul class='hidden settingsList'><span class='sr-only'>Edit this comment</span><li><button type='submit' class='btn edit_comment' name='edit_comment' title='Edit this comment'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> &nbsp;&nbsp; Edit comment</button></li><span class='sr-only'>Delete this comment</span><li><button type='button' class='btn delete' id='" . $comment_row['id'] . "'  name='delete_comment' data-toggle='modal' data-target='#deleteBlogModal' title='Delete this comment'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> &nbsp;&nbsp; Delete comment</button></li><input type='number' value='" . $comment_row['id'] . "' name='comment_id' class='hidden comment_id'></ul></form>";
			}

			echo "<hr/>";
			echo "<p class='comment'><span class='comment-text'>";
			echo htmlspecialchars($comment_row['comment']);
			echo "</span></p><p class='comment-date'><small class='date-posted'>";
			echo "<em>";
			echo $date . '&nbsp;&nbsp;' . $time;
			echo "</em></small></p>";
			echo "</li>";
			
				
			$query = "SELECT COUNT(*)
					  FROM comments
					  WHERE blog_id = '$blog_id'";
			$result = mysqli_query($conn, $query);
			$comment_count = mysqli_fetch_row($result);
			echo "<input type='number' class='comment-count hidden' value='$comment_count[0]'/>";
		}
	}
}

/* Fall back code for users that have javascript disabled */
/* If user clicks the like, update likes in DB */
if(isset($_POST['like'])) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_POST['blog_id'];
		$user_id = $_SESSION['user_id'];
		
		$query	= "SELECT *
				   FROM blog_post_likes
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);
		
		$query 		= "SELECT likes 
					   FROM blog_posts
					   WHERE id='$blog_id'";
		$like_count = mysqli_query( $conn, $query );
		$row	 	= mysqli_fetch_assoc($like_count);
		$likes		= $row['likes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_likes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			/* Add 1 to likes */
			$likes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_likes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$likes = $likes <= 1 ? 0 : $likes -= 1;
		}
		/* Update blog likes */
		$query = "UPDATE blog_posts 
				  SET likes = '$likes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		header("Location: ../index.php#$blog_id");
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks the dislike, update dislikes in DB */
if(isset($_POST['dislike'])) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_POST['blog_id'];
		$user_id = $_SESSION['user_id'];
		
		$query	= "SELECT *
				   FROM blog_post_dislikes
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);
		
		$query 			= "SELECT dislikes 
						   FROM blog_posts
						   WHERE id='$blog_id'";
		$dislike_count 	= mysqli_query( $conn, $query );
		$dislikes			= $row['dislikes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_dislikes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );
			
			/* Add 1 to likes */
			$dislikes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_dislikes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$dislikes = $dislikes <= 1 ? 0 : $dislikes -= 1;
		}
		/* update blog likes */
		$query = "UPDATE blog_posts 
				  SET dislikes = '$dislikes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		header("Location: ../index.php#$blog_id");
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks the favorite, update favorites in DB */
if( isset( $_POST['favorite'] ) ) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_POST['favorite'];
		$user_id = $_SESSION['user_id'];

		$query	= "SELECT *
				   FROM user_favorites
				   WHERE blog_id = '$blog_id'
				   AND user_id = '$user_id'";
		$result = mysqli_query( $conn, $query );
		$row_count = mysqli_num_rows($result);

		$query 	= "SELECT favorite 
				  FROM blog_posts
				  WHERE id='$blog_id'";
		$favorite_count = mysqli_query( $conn, $query );
		$row	 	= mysqli_fetch_assoc($favorite_count);
		$favorite 	= $row['favorite'];

		if( !$row_count ) {
			$query 	= "INSERT INTO user_favorites
					   (id, blog_id, user_id)
					   VALUES
					   (NULL, '$blog_id', '$user_id')";
			$result = mysqli_query( $conn, $query );

			if( !$favorite ) {
				$favorite = 1;
			} elseif( $favorite >= 1 ) {
				$favorite += 1;			
			} else {
				$favorite = 0;
			}

		} else {
			$query 	= "DELETE FROM user_favorites
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$favorite = $favorite <= 1 ? 0 : $favorite -= 1;
		}
		/* Update blog favorite */
		$query = "UPDATE blog_posts 
				  SET favorite = '$favorite'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		header("Location: ../index.php#$blog_id");
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks to comment but is not logged in, redirect to login */
if(isset($_POST['comment'])) {
	if(isset($_SESSION['loggedInUser'])) {
		header("Location: ../index.php");
	} else {
		header("Location: ../login.php");
	}
}

/* Edit user Blog */
if( isset( $_POST['edit'] ) ) {
	$blog_id = $_POST['blog_id'];
	header("Location: ../edit_blog.php?id=$blog_id");
}

/* Delete user Blog */
if( isset( $_POST['delete'] ) ) {
	$comment_or_blog = $_POST['comment_or_blog'];
	
	if($comment_or_blog == 'delete_post') {
		$blog_id = $_POST['blogid'];
		$query 	= "DELETE
				   FROM blog_post_dislikes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM blog_post_likes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM comments
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM comment_likes
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM user_favorites
				   WHERE blog_id='$blog_id";
		$result = mysqli_query($conn, $query);

		$query 	= "DELETE
				   FROM blog_posts
				   WHERE id='$blog_id'";
		$result = mysqli_query( $conn, $query );
	} elseif( $comment_or_blog == 'delete_comment') {
		$comment_id = $_POST['comment_id'];
		$query 	= "DELETE
				   FROM comments
				   WHERE id = $comment_id";
		$result = mysqli_query($conn, $query);
	}
	
	header('Location: ../blogs.php');
}
?>