<?php include('connection.php'); ?>
<?php include('functions.php'); ?>

<?php
//session_start();
$avatar = 'userAvatarDefault.png';

if(isset($_GET['search'])) {
	$search_query 	= $_GET['search'];
	/*$query			= "SELECT blog_title, blog_post, blog_category,
					   date_format(date_created, '%m/%d/%Y') date_created
					   FROM blog_posts 
					   WHERE public = 'public'
					   AND (blog_title = '$search_query'
					   OR blog_post = '$search_query'
					   OR blog_category = '$search_query')
					   ORDER BY date_created DESC";*/
	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND (blog_title = '$search_query'
			   OR blog_post = '$search_query'
			   OR blog_category = '$search_query')
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


if(isset($_GET['topic'])) {
	$topic = $_GET['topic'];
	//$query 		= "SELECT * FROM blog_posts WHERE blog_category = '$topic'";
	/*$query 	= "SELECT blog_title, blog_post, blog_category,
			   date_format(date_created, '%m/%d/%Y') date_created
			   FROM blog_posts 
			   WHERE public = 'public'
			   AND blog_category = '$topic'
			   ORDER BY date_created DESC";*/
	
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
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
		echo "<span>" . $row['blog_post'] . "</span>";
	}	
}


if(isset($_GET['username'])) {
	$username = $_GET['username'];
	$query 	= "SELECT blog_posts.blog_title, blog_posts.blog_post,
			   date_format(blog_posts.date_created, '%m/%d/%Y') date_created,
			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
			   users.email, users.user_name
			   FROM blog_posts
			   LEFT JOIN users ON blog_posts.user_id = users.id
			   WHERE public = 'public'
			   AND (users.user_name = '$username'
			   OR users.email = '$username')";
	queryCaller($conn, $query);
	
}












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
			   blog_posts.blog_category, blog_posts.id AS blog_id,  blog_posts.user_id, users.avatar, users.id,
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