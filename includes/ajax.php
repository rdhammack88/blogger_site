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
if(isset($_GET['blog_id'])) {

	$blog_id = $_GET['blog_id'];
	$query = "SELECT blog_post
			  FROM blog_posts
			  WHERE id = '$blog_id'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)) {
		echo $row['blog_post'];
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

/* If user clicks the like, update likes in DB */
//if(isset($_POST['like'])) {
////	echo $_SESSION['loggedInUser'];
//	if(isset($_SESSION['loggedInUser'])) {
//		$blog_id = $_POST['blog_id'];
//		$user_id = $_SESSION['user_id'];
//		$query 	 = "INSERT INTO blog_post_likes
//				    (id, blog_id, user_id)
//				    VALUES (NULL, '$blog_id', '$user_id')";
//		$result  = mysqli_query( $conn, $query );
//		$query 	 = "SELECT likes 
//				    FROM blog_posts
//				    WHERE id='$blog_id'";
//		$result  = mysqli_query( $conn, $query );
//
//		if( $result ) {
//			$row	 	= mysqli_fetch_assoc($result);
//			$likes	 	= $row['likes'];
//			// Add 1 to likes
//			$likes += 1;
//			// update blog likes 
//			$query = "UPDATE blog_posts 
//					  SET likes = '$likes'
//					  WHERE id = '$blog_id'";
//			$result = mysqli_query( $conn, $query );
//		}
//		header("Location: ../index.php");
//	} else {
//		header("Location: ../login.php");
//	}
//}

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



if(isset($_GET['like'])) {
//if(isset($_POST['like'])) {
	echo $_SESSION['loggedInUser'];
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_GET['like'];
//		$blog_id = $_POST['like'];
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
//		$row	 	= mysqli_fetch_assoc($favorite_count);
		$likes		= $row['likes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_likes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			// Add 1 to likes
			$likes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_likes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$likes = $likes <= 1 ? 0 : $likes -= 1;
		}
		// update blog likes 
		$query = "UPDATE blog_posts 
				  SET likes = '$likes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
//		header("Location: ../index.php");
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
//		$row	 		= mysqli_fetch_assoc($dislike_count);
		$dislikes			= $row['dislikes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_dislikes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			// Add 1 to likes
			$dislikes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_dislikes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$dislikes = $dislikes <= 1 ? 0 : $dislikes -= 1;
		}
		// update blog likes 
		$query = "UPDATE blog_posts 
				  SET dislikes = '$dislikes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
	} else {
		header("Location: ../login.php");
	}
}

if(isset($_GET['favorite'])) {
	
}


/* Fall code for users that have javascript disabled */
/* If user clicks to comment but is not logged in, redirect to login */
if(isset($_POST['comment'])) {
	if(isset($_SESSION['loggedInUser'])) {
		header("Location: ../index.php");
	} else {
		header("Location: ../login.php");
	}
}


if(isset($_POST['like'])) {
//	echo $_SESSION['loggedInUser'];
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
		$row	 	= mysqli_fetch_assoc($favorite_count);
		$likes		= $row['likes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_likes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			// Add 1 to likes
			$likes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_likes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$likes = $likes <= 1 ? 0 : $likes -= 1;
		}
		// update blog likes 
		$query = "UPDATE blog_posts 
				  SET likes = '$likes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		header("Location: ../index.php#$blog_id");
	} else {
		header("Location: ../login.php");
	}
}


if(isset($_POST['dislike'])) {
//	echo $_SESSION['loggedInUser'];
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
//		$row	 		= mysqli_fetch_assoc($dislike_count);
		$dislikes			= $row['dislikes'];

		if( !$row_count ) {
			$query 	 = "INSERT INTO blog_post_dislikes
						(id, blog_id, user_id)
						VALUES (NULL, '$blog_id', '$user_id')";
			$result  = mysqli_query( $conn, $query );

			// Add 1 to likes
			$dislikes += 1;
		} else {
			$query 	= "DELETE FROM blog_post_dislikes
					   WHERE blog_id = '$blog_id'
					   AND user_id = '$user_id'";
			$result = mysqli_query( $conn, $query );

			$dislikes = $dislikes <= 1 ? 0 : $dislikes -= 1;
		}
		// update blog likes 
		$query = "UPDATE blog_posts 
				  SET dislikes = '$dislikes'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		header("Location: ../index.php#$blog_id");
	} else {
		header("Location: ../login.php");
	}
}

/* If user clicks the dislike, update dislikes in DB */
/*if(isset($_POST['dislike'])) {
	if(isset($_SESSION['loggedInUser'])) {
		$blog_id = $_POST['blog_id'];
		$query 	= "SELECT dislikes 
				  FROM blog_posts
				  WHERE id='$blog_id'";
		$result = mysqli_query( $conn, $query );

		if( $result ) {
			$row	 	= mysqli_fetch_assoc($result);
			$dislikes	 	= $row['dislikes'];
			// Add 1 to likes
			$dislikes += 1;
			// update blog likes 
			$query = "UPDATE blog_posts 
					  SET dislikes = '$dislikes'
					  WHERE id = '$blog_id'";
			$result = mysqli_query( $conn, $query );
		}
		header("Location: ../index.php");
	} else {
		header("Location: ../login.php");
	}
}*/

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
	$blog_id = $_POST['blogid'];
	
	$query 	= "DELETE
			   FROM blog_posts
			   WHERE id='$blog_id'";
	$result = mysqli_query( $conn, $query );
	
//	echo "Post $blog_id has been deleted!";
}

/* Favorite user Blog */
if( isset( $_POST['favorite'] ) ) {
	if(isset($_SESSION['loggedInUser'])) {
//		$blog_id = $_POST['blog_id'];
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
		// update blog favorite 
		$query = "UPDATE blog_posts 
				  SET favorite = '$favorite'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );
		
//		if($_SERVER['SCRIPT_FILENAME'] == '../index.php') {
			header("Location: ../index.php");
//		} elseif($_SERVER['SCRIPT_FILENAME'] == '../blogs.php') {
//			header("Location: ../blogs.php");
//		}
	} else {
		header("Location: ../login.php");
	}
	
	////// WORKS BELOW HERE, JUST FOR UPDATING blog_post favorite COLUMN
/*	$query 	= "SELECT favorite 
			  FROM blog_posts
			  WHERE id='$blog_id'";
	$result = mysqli_query( $conn, $query );
	
	if( $result ) {
		$row	 	= mysqli_fetch_assoc($result);
		$favorite 	= $row['favorite'];
		
		if( !$favorite ) {
			$favorite = 1;
		} else {
//			$favorite = 0;
			$favorite += 1;
		}
		// update blog favorite 
		$query = "UPDATE blog_posts 
				  SET favorite = '$favorite'
				  WHERE id = '$blog_id'";
		$result = mysqli_query( $conn, $query );

		if(!$result ) { printf(mysqli_error($conn)); }

		header("Location: ../blogs.php");
//		echo "Post $blog_id has been favorited!";
	}*/
}



/*
$query = "SELECT questions.question_number, questions.question, questions.question_category, choices.id, choices.is_correct, choices.answers 
FROM questions 
LEFT JOIN choices ON questions.question_number = choices.question_number 
WHERE questions.question_category = '" . $_SESSION['category'] . "' AND questions.question_number IN (" . implode(", ", $_SESSION["used_questions"]) .")
ORDER BY field(questions.question_number, " . implode(", ", $_SESSION["used_questions"]) ."), field(id, " . implode(", ", $_SESSION["answer_order"]) .")";*/





/*$query			= "SELECT blog_title, blog_post, blog_category,
					   date_format(date_created, '%m/%d/%Y') date_created
					   FROM blog_posts 
					   WHERE public = 'public'
					   AND INSTR(blog_title, '$search_query')
					   OR INSTR(blog_post, '$search_query')
					   OR INSTR(blog_category, '$search_query')
					   ORDER BY date_created DESC";*/

//DATE(STR_TO_DATE(`date_created`, '%m/%d/%Y'))


/*$queries = {
	SELECT blog_title, blog_post, blog_category,
		      date_created
		      FROM blog_posts 
		      WHERE INSTR(date_created, 10/19/2017) > 0
			  
              
              SELECT blog_title, blog_post, blog_category,
		      date_format(date_created, '%m/%d/%Y') date_created
		      FROM blog_posts 
		      WHERE public = 'public'
		      AND INSTR(`date_created`, '10/19/2017') > 0
			  ORDER BY id DESC
}*/





///////////////////////////////


/*
$query = "SELECT blog_posts.blog_title, blog_posts.blog_post,
			  blog_posts.blog_category,
		      blog_posts.date_format(date_created, '%m/%d/%Y') date_created, users.avatar
		      FROM blog_posts
			  LEFT JOIN users ON blog_posts.user_id = users.id
		      WHERE public = 'public'
		      AND date_format(date_created, '%m/%d/%Y')  = '$date'
			  ORDER BY id DESC";*/

//	$blogs 	= mysqli_query($conn, $query);
//
//
//	while( $row = mysqli_fetch_assoc($blogs) ) {
//		echo "<article>";
//		echo "<div class='blog_title'><h2>" . $row['blog_title'] . "</h2><a href='index.php?date=" . $row['date_created'] . "'><img src='". $row['avatar'] ."'/><p class='date_posted'>". $row['date_created'] . "</p></a></div><p>". $row['blog_post'] . "</p>";
//		echo "</article>";			
//	}



//////////////////////////

?>