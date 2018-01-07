$(document).ready(function() {

	/*var $searchForm = $('.searchForm');
	var $searchBox = $('#search');
	var searchWidth = $($searchBox).width();
	
	$searchBox.focus(function() {
		
		$(this).toggleClass('input-lg').width(searchWidth * 1.7);
		$searchForm.toggleClass('col-sm-4 col-sm-5 col-sm-offset-2');
		
		//.toggleClass('btn-sm btn-lg');
		$('.input-group .btn').toggleClass('btn-lg');
		
	});

	$searchBox.blur(function() {
		$(this).toggleClass('input-lg').width(searchWidth);
		$searchForm.toggleClass('col-sm-4 col-sm-5 col-sm-offset-2 ');
		$('.input-group .btn').toggleClass('btn-lg');
	});*/
	
	/*-----------------------------------------------------------------------------
	function inputError( event, $firstError, $secondError, $thirdError ) {
		
		if( $firstError.val() === '' ) {
			event.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
		
		if( $secondError.val() === '' ) {
			event.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
		
		if( $thirdError.val() === '' ) {
			event.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
	}
	
	
	$('input[name="signup"]').on( "click", inputError( $('#first_name'), $('#email'), $('#password') ) );
	$('#newBlog').on(inputError( "click", $('#blogTitle'), $('#blogTopic'), $('#blog') ) );
	$('#saveInfo').on(inputError( "click", $('#first_name'), $('#email'), $('#password') ) );

	*///-------------------------------------------------------------------------------------------
	
	
	$('input[name="signup"]').click(function(e) {
		var $first_name = $('#first_name');
		var $email = $('#email');
		var $password = $('#password');
		
		if( $first_name.val() === '' ) {
			e.preventDefault();
			$('.nameError').show();
			$($first_name).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
		} else {
			$('.nameError').hide();
			$($first_name).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
		}
		
		if( $email.val() === '' ) {
			e.preventDefault();
			$('.emailError').show();
			$($email).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
		} else {
			$('.emailError').hide();
			$($email).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
		}
		
		if( $password.val() === '' ) {
			e.preventDefault();
			$('.passwordError').show();
			$($password).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
		} else {
			$('.passwordError').hide();
			$($password).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
		}
		
	});
	
	$('input[name="save"]').click(function(e) {
		var $first_name = $('#first_name_edit');
		var $email = $('#email_edit');
		var $newpassword = $('#new_password');
		
		if( $first_name.val() === '' ) {
			e.preventDefault();
			$('.nameEditError').show();
			$($first_name).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
		} else {
			$('.nameEditError').hide();
			$($first_name).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
		}
		
		if( $email.val() === '' ) {
			e.preventDefault();
			$('.emailEditError').show();
			$($email).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
		} else {
			$('.emailEditError').hide();
			$($email).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
		}
		
		/*if( $newpassword.val() ) {
			e.preventDefault();
			var $currentPassword 		= $('#current_password');
			var $currentPasswordRepeat 	= $('#current_password_repeat');
			
			if( $currentPassword.val() === '' && $currentPasswordRepeat.val() === '' ) {
				$('.passwordError, .passwordErrorRepeat').hide();
				$('.passwordErrorBoth').show();
				$($currentPassword).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
				$($currentPasswordRepeat).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			} else if( $currentPassword.val() === '' ) {
				$('.passwordErrorRepeat, .passwordErrorBoth').hide();
				$('.passwordError').show();
				$($currentPassword).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			} else if( $currentPasswordRepeat.val() === '' ) {
				$('.passwordError, .passwordErrorBoth').hide();
				$('.passwordErrorRepeat').show();
				$($currentPasswordRepeat).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			} else {
				$('.passwordError, .passwordErrorRepeat').hide();
				$($currentPassword, $currentPasswordRepeat).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			}
			
//			
//			$('.passwordError').show();
		} else {
			$('.passwordError, .passwordErrorRepeat, .passwordErrorBoth').hide();
		}*/
		
	});
	
/*	$('button[name="delete"]').click(function(e) {
//	function delete() {
		e.stopImmediatePropagation();
		$confirmDelete = confirm("Are you sure you want to delete your profile account? This cannot be undone!"), e.stopImmediatePropagation();;
//		"Are you sure you want to delete your profile account? This cannot be undone!"
//		e.stopImmediatePropagation();
		//console.log($confirmDelete);
		console.log(event.eventPhase);
		//return $confirmDelete;
		
		if( !$confirmDelete ) {
			//console.log($confirmDelete);
			e.stopPropagation;
			//e.preventDefault();
			$.post( "blogs.php");
		} /*else {
			e.stopPropagation;
		}
		
	});*/
	
	
	
	$('button.glyphicon-trash').click(function() {
		//$('#deleteBlogModal > form > div.modal-body > input[type="number"]').val() === 23;
		var $blog_id = $(this).next().next().next().val();
		$('#blogID').val($blog_id);
		
		//console.log($(this).next().next().next().val());
		console.log($blog_id);
		//console.log('clicked');
	});
	
	
	
	
	
	
	
	 // Adding a new blog post
	$('#newBlog').click(function(e) {
		var $blog_title = $('#blogTitle');
		var $blog_topic = $('#blogTopic');
		var $blog		= $('#blog');
		var public		= $('input[name="public"]');
		 		
		if( $blog_title.val() === '' ) {
			e.preventDefault();
			$($blog_title).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.titleError').show();
		} else {
			$($blog_title).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.titleError').hide();
		}
		 
		  /*if( $blog_title.val()) {
****			$blog_title.addClass('has-success, has-feedback');
****			$('.titleError').hide();			
****		}else {
****			e.preventDefault();
****			$('.inputError').show();
****		}*/
		
		if( $blog_topic.val() === '' ) {
			e.preventDefault();
			$($blog_topic).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.topicError').show();
		} else {
			$($blog_topic).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.topicError').hide();
		}
		
		if( $blog.val() === '' ) {
			e.preventDefault();
			$($blog).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.blogError').show();
		} else {
			$($blog).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.blogError').hide();
		}
		 
		/*if( !public.valueOf ) {
****			public.value = 'public';
****		}*/
		
	});
	
	
	
	
//	if( $('#mainNav > div').hasClass('col-xs-12') ) {
//		$('#mainNav > div').toggle();
//	}
	
	// User login conformation animation
	setTimeout(function() {
		$('.alert-success').slideUp();
	}, 2000);
	
	// If page is login or signup, make the footer bottom-fixed
	/*if( document.title.includes('Login') ) {
		$('footer').css({ 
			position: "absolute",
			bottom: 0,
			left: 0
		});		//.addClass('navbar-fixed-bottom');
	}*/
	
	if( $('body').height() < 550 ) {
		$('footer').css({ 
			position: "absolute",
			bottom: 0,
			left: 0
		});	
	}
	
	// If the main content is less than 500px, fix the navbar to bottom of page
	/*if( $('main').height() < 500 ) {
		$('footer').css({ 
			position: "absolute",
			bottom: 0,
			left: 0
		});		//.addClass('navbar-fixed-bottom');
	}*/
	
	// If there are no user blogs, then hide the "most recent blogs" text
	if( $('#blogSection').has('div.alert') ) {
		$('.no-blogs').hide();
	}
	
	$('.glyphicon-bookmark').click(function() {
		$(this).color = 'red';
	})
	
	
	$('#searchButton').click(function(e) {
		e.preventDefault();
		var searchQuery = $('#search').val();
		$.ajax({
			url: "./includes/ajax.php?search="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		});
	});
	
	$('#blogTopics a').click(function(e) {
		e.preventDefault();
		var topic = $(this).html();
		console.log(topic);
		$.ajax({
			url: "./includes/ajax.php?topic="+topic,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		});
	});
	
	
	$('#blogSection a.avatar').click(function(e) {
		e.preventDefault();
//		var searchQuery = $(this).text();
		var user_name = $(this).next().text();
			//this.previousElementSibling.previousElementSibling.innerHTML;
//		console.log(searchQuery);
		console.log(user_name);
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		})
	});
	
	$('#blogSection a.name').click(function(e) {
		e.preventDefault();
//		var searchQuery = $(this).text();
		var user_name = $(this).text();
			//this.previousElementSibling.previousElementSibling.innerHTML;
//		console.log(searchQuery);
		console.log(user_name);
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		})
	});
	
	$('#blogSection a.title').click(function(e) {
		e.preventDefault();
		var searchQuery = $(this).text();
		var user_name = $(this).prev().prev().text();
			//this.previousElementSibling.previousElementSibling.innerHTML;
		console.log(searchQuery);
		console.log(user_name);
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name + "&title="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		})
	});
	
	
	$('#blogSection a.date').click(function(e) {
		e.preventDefault();
//		console.log(this.text);
		var searchQuery = $(this).children('.date_posted').text();
//		console.log(searchQuery);
		console.log(searchQuery);
//		console.log(user_name);
		$.ajax({
			url: "./includes/ajax.php?date="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
//				console.log(res);
			}
		});
	});
	
	
	
	
	$('.slide_text').slideUp(5000);
	
	// Click for more on blog posts
	$.each($('.post'), function() {
		var post = $(this).text();
//		var postCopy = post;
//		console.log(post.length);
		if(post.length > 300 && !$('.post').hasClass('activeText')) {
//			post = post.substr(0, 300) + "....(click for more)";
			post = post.substr(0, 300) + ".... <a href='#' role='button' class='postLink'>(click for more)</a>";
			//		console.log(post);
			$(this).html(post);
		}
//		$(this).html("<a href='#' class='post'>"+post+"</a>");
//		$(this).html(post);
	});
	
//	$('#blogSection a.postLink').click(function(e) {
//		console.log("Line 404");
//		e.preventDefault();
//	});
	
	$('#blogSection a.postLink').click(function(e) {
//		console.log("Line 394");
		e.preventDefault();
//		var remove = $('p.post').hasClass('activeText');
//		remove.removeClass('activeText');
		
		$.each($('.post'), function() {
			console.log($(this));
			if($(this).hasClass('activeLink')) {
				$(this).removeClass('activeLink');
			}
			
		})
		
		$(this).parent().addClass('activeText');
//		var searchQuery = $(this).parent().prev().children('.title').text();
//		var user_name = $(this).parent().prev().children('.name').text();
		var blog_id = $(this).parent().next().children('.blog_id').val();
		var post = $(this).parent();
//		console.log(blog_id);
			//this.previousElementSibling.previousElementSibling.innerHTML;
//		console.log(searchQuery);
//		console.log(user_name);
//		console.log($(this).parent());
		$.ajax({
			//url: "./includes/ajax.php?username="+ user_name + "&title="+searchQuery,
			url: "./includes/ajax.php?blog_id=" + blog_id,
			method: "GET",
			success: function(res) {
//				$(this).parent().addClass('activeText');
//				$('#blogSection').html(res);
//				$(this).parent().html(res);
//				$('.activeText').html(res);
				post.html(res);
				console.log(res);
			}
		})
	});
	
});