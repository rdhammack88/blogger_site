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
			
			
			$('.passwordError').show();
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
	
	// Delete blog post click
	$('button.glyphicon-trash').click(function() {
		var $blog_id = $(this).next().next().next().val();
		$('#blogID').val($blog_id);
	}); // End of delete blog post click
	
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
	});

	// User login conformation animation
	setTimeout(function() {
		$('.alert-success').slideUp();
	}, 2000);

	if( $('body').height() < 550 ) {
		$('footer').css({ 
			position: "absolute",
			bottom: 0,
			left: 0
		});	
	}	
	
	// Slide "Most recent blogs" text up after 5 seconds
//	$('.slide_text').slideUp(5000);
	$('.slide_text').fadeTo(10000, 0.0);
		
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
	
	// Search button clicked
	$('#searchButton').click(function(e) {
		e.preventDefault();
		var searchQuery = $('#search').val();
		$.ajax({
			url: "./includes/ajax.php?search="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		}); // End of AJAX call
	}); // End of Search button click
	
	// If user presses the Enter or Return key while in focus 
	// of Search field, then hide the search result short list
	$('#search').keydown(function(e) {
		if(e.keyCode === 13) {
			$('.search-list').addClass('hidden');
		}
	});
	
	// On focus of search bar, show search result short list
	$('#search').focusin(function(e) {
		e.preventDefault();
		$('.search-list').removeClass('hidden');
		
		
	}); // End of search bar focus
	
	// When user has left search bar, hide search result short list
	$('#search').blur(function() {
		$('.search-list').addClass('hidden');
	}); // End of search bar blur
	
	// On keyup in search bar
	$('#search').keyup(function() {
		$('.search-list').html('');
		var searchQuery = $('#search').val();
		$.ajax({
			url: "./includes/ajax.php?search="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				var blogInfo = $.parseHTML(res);
//				console.log(blogInfo[1].children);
				$.each(blogInfo, function() {
					var name = $(this).find('.name').text();
					var title = $(this).find('.title').text();
//					var post = $(this).find('.post').text();
					var category = $(this).find('.blog_category').val();
					
					if(name != undefined && title != undefined && category != undefined) {
						$('.search-list').append('<li class="list-group-item">' + name + '</li>');
						$('.search-list').append('<li class="list-group-item">' + title + '</li>');
						$('.search-list').append('<li class="list-group-item">' + category + '</li>');
					}
					
//					console.log(name);
//					console.log(title);
//					console.log(category);					
				}); // End of $.each function
			} // End of AJAX success function
		}); // End of AJAX call
	}); // End of Search keyup	
	
	// Blog topics link clicked, show public blogs with same topic
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
		}); // End of AJAX call
	}); // End of Blog topic link click
	
	// User image clicked, show users public blogs
	$('#blogSection a.avatar').click(function(e) {
		e.preventDefault();
		var user_name = $(this).next().text();
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		}); // End of AJAX call
	}); // End of user avatar click
	
	// User name clicked, show users public blogs
	$('#blogSection a.name').click(function(e) {
		e.preventDefault();
		var user_name = $(this).text();
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		}); // End of AJAX call
	}); // End of user name click
	
	// On click of title, show only this blog post
	$('#blogSection a.title').click(function(e) {
		e.preventDefault();
		var searchQuery = $(this).text();
		var user_name = $(this).prev().prev().text();
		console.log(searchQuery);
		console.log(user_name);
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name + "&title="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		}); // End of AJAX call
	}); // End of title click
	
	// On click of blog date, show all blogs with same date
	$('#blogSection a.date').click(function(e) {
		e.preventDefault();
		var searchQuery = $(this).children('.date_posted').text();
		$.ajax({
			url: "./includes/ajax.php?date="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
			}
		}); // End of AJAX call
	}); // End of date click
	
	// Show only the first 300 characters of the blog post on load
	$.each($('.post'), function() {
		var post = $(this).text();
		if(post.length > 300 && !$('.post').hasClass('activeText')) {
			post = post.substr(0, 300) + ".... <a href='#' role='button' class='showMore'>(click for more)</a>";
			$(this).html(post);
		}
	}); // End of .each function for each post
	
	// Show all of the blog post when only partial is visible
	$('body').on('click', '#blogSection a.showMore', function(e) {
		e.preventDefault();
		var blog_id = $(this).parent().parent().next().children('form').children('.blog_id').val(); //children('form').
		var post = $(this).parent();
		console.log(blog_id);
		console.log(post);
		console.log($(this).parent().parent().next());
		$.ajax({
			url: "./includes/ajax.php?blog_id=" + blog_id,
			method: "GET",
			success: function(res) {
				post.html(res + " &nbsp;<a href='#' role='button' class='showLess'>(click for less)</a>");
			}
		}); // End of AJAX call
	}); // End of a.showMore click
	
	// Show less of the blog post when all is visible
	$('body').on('click', '#blogSection a.showLess', function(e) {
		e.preventDefault();
		var post = $(this).parent().text();
		console.log(post);
		if(post.length > 300) {
			post = post.substr(0, 300) + ".... &nbsp;<a href='#' role='button' class='showMore'>(click for more)</a>";
			$(this).parent().html(post);
		}
	}); // End of a.showLess click
	
	// Clicking comment button, show blog comments
	$('body').on('click', '.comment-link', function(e) {
		e.preventDefault();
	}); // End of clicking on comment button
	
	// Test for favorite click with ajax
	$('body').on('click', '#favorite', function(e) {
//		e.preventDefault();
		$.post('./includes/ajax.php?favoritejs=');
	});
	
//	$.ajax({
//			url: "./includes/ajax.php?blog_id=" + blog_id,
//			method: "POST",
//			success: function(res) {
//				
//			}
//		})
	

//		console.log("keyup");
//		var searchField = $('#search').val();
//		var regEx = new RegExp(searchField, 'i');
//		
//		$.ajax({
//			url: ".includes/ajax.php?search=" + searchField,
//			method: "GET",
//			success: function(res) {
//				$('#blogSection').html(res);
//			}
//		})
//
//		$.getJSON('../data.json', function(data) {
//			var output = '<ul class="searchresults">';
//			$.each(data, function(key, val) {
//				if((val.name.search(regEx) != -1) || (val.bio.search(regEx) != -1)) {
//					output += '<li>';
//					output += '<h2>' + val.name + '</h2>';
//					output += '<img src="../images/artists/' + val.shortname + '_tn.jpg" alt="' + val.name + '" />';
//					output += '<p>' + val.bio + '</p>';
//					output += '</li>';
//		//			console.log(val.shortname);
//				}
//			});
//			output += '</ul>';
//
//			$('#update').html(output);
//		}); // get JSON
//	});
	
	
	
});