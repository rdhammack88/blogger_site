<?php
$page_title = 'Manage user blogs';
include('includes/connection.php');
include('includes/functions.php');

session_start();

if(!isset($_SESSION['loggedInUser']) || !isset($_SESSION['user_id'])) { 
	header("Location: login.php");
}

include('includes/header.php');

if(isset($_SESSION['loggedInUser'])) {
	$user_id = $_SESSION['user_id'];
	
	$query = "SELECT * FROM blog_posts
			  WHERE user_id = $user_id
			  ORDER BY date_created DESC";
	$result = mysqli_query($conn, $query);
}
modalCaller();
//echo $_SERVER['HTTP_REFERER'];
//echo substr(strrchr($_SERVER['HTTP_REFERER'], '/'), 1 );
?>
<div class="container-fluid">
	<div class="row text-right">
		<span class="sr-only">Add new blog</span><a href="add_blog.php" class="btn btn-primary add-btn"><span class="glyphicon glyphicon-plus"> </span> New</a>
	</div>
	<br>
</div>
<div class="table-responsive dashboard">
<table class="table table-bordered table-hover"> <!-- table-striped -->
	<thead>
		<tr class="text-center">
<!--			<td style="visibility: hidden;"></td>-->
			<td>ID</td>
			<td>TITLE</td>
			<td>CATEGORY</td>
			<td>PUBLIC</td>
			<td>LIKES</td>
			<td>DISLIKES</td>
			<td>COMMENTS</td>
			<td>DATE CREATED</td>
<!--
			<td></td>
			<td></td>
-->
		</tr>
	</thead>
	<tbody class="">
	
	<?php if(mysqli_num_rows($result) > 0):
		$x = 1; 
		while($row = mysqli_fetch_assoc($result)) :		
			$likes = $row['likes'] ? $row['likes'] : 0;
			$dislikes = $row['dislikes'] ? $row['dislikes'] : 0;
			$comments = $row['total_comments'] ? $row['total_comments'] : 0;
	//		$bg_color = $x % 2 == 1 ? 'bg-danger' : NULL;

			$date_from_server = strtotime($row['date_created']);
			$date = date('M d, Y', $date_from_server);
			$time = date('g:ia', $date_from_server);
	?>

		<tr class="table-hover <?= $row['id']; ?>"> 
			<th class="blog_id"><?= $x; ?></th>
			<td><?= ucfirst($row['blog_title']); ?></td>
			<td><?= $row['blog_category']; ?></td>
			<td><?= $row['public']; ?></td>
			<td><?= $likes; ?></td>
			<td><?= $dislikes; ?></td>
			<td><?= $comments; ?></td>
			<td><?= $date . ' &nbsp;&nbsp; ' . $time; ?></td>
			<form method='post' action='./includes/ajax.php'>
			<td class="text-center"><span class='sr-only'>Edit this blog</span><button type='submit' name='edit' class="btn btn-primary btn-sm" title='Edit this post' data-toggle='tooltip' data-placement='top'><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>
			<td class="text-center" data-toggle='tooltip'><span class='sr-only'>Delete this blog</span><button type='button' name='delete_post'  title='Delete this post' data-placement='top' class="btn btn-danger btn-sm delete" id="<?= $row['id']; ?>" data-toggle='modal' data-target='#deleteBlogModal'><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
			<td class="hidden"><input type="text" value="<?= $row['id']; ?>" name="blog_id"/></td>
			</form>
		</tr>
	
	<?php $x++; endwhile; ?>
		</tbody>
	</table>
</div>
<?php else: ?>
		</tbody>
	</table>
</div>
<div>
	<p class="text-danger" colspan="10">You currently have no blog posts</p>
</div>
<?php endif; ?>

<?php include('includes/footer.php');