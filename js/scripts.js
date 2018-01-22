$(document).ready(function() {

	$('.homeLink').not('.navbar-brand').parent().addClass('activeLink');
	$('p.settings').removeClass('hidden');	
	$('.footerSettings').addClass('hidden');
	$('.blogComments').css('display', 'none');
//	$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
	$('[data-toggle="tooltip"]').tooltip();
	
	if(document.title.includes('Home')) {
		$('ul.navbar-right').children('li').removeClass('activeLink');
		$('.homeLink').not('.navbar-brand').parent().addClass('activeLink');
	} else if(document.title.includes('User blogs')) {
		$('ul.navbar-right').children('li').removeClass('activeLink');
		$('.blogsLink').parent().addClass('activeLink');
	} else if(document.title.includes('Account') || document.title.includes('Manage') || document.title.includes('Edit') || document.title.includes('Profile')) {
		$('ul.navbar-right').children('li').removeClass('activeLink');
		$('.account').addClass('activeLink');
	}	
	
	// User login conformation animation
	setTimeout(function() {
		$('.alert-success').slideUp();
	}, 3000);
	
	// If the main content is less than 500px, fix the navbar to bottom of page
//	$('.body-container').trigger('resize');
	if( $('.body-container').height() < 650 ) {
		$('footer').css({ 
			top: '80%',
			position: "absolute",
			bottom: 0,
			left: 0
		});	
	}
	
	$('.body-container').bind('resize', function() {
		console.log('resized');
		if( $('.body-container').height() > 650 ) {
			$('footer').css({
				position: "relative",
				bottom: 0,
				left: 0
			});	
		} else if( $('.body-container').height() < 650 ) {
			$('footer').css({ 
				top: '80%',
				position: "absolute",
				bottom: 0,
				left: 0
			});	
		}
	});
	
	// Fade "Most recent blogs" text up over 10 seconds
	$('.fade-text').fadeTo(10000, 0.0);
	
	// If there are no user blogs, then hide the "most recent blogs" text
	if( $('#blogSection').has('div.alert') ) {
		$('.no-blogs').hide();
	}
		
	$('.blogsLink').click(function(e) {
//		e.preventDefault();
		$('.body-container').trigger('resize');
		$('ul.navbar-right').children('li').removeClass('activeLink');
		$(this).parent().addClass('activeLink');
		
		$.ajax({
			url: './includes/ajax.php?user_blogs=all',
			method: 'GET',
			success: function(res) {
				$('.body-container').html(res);
				$('p.settings').removeClass('hidden');
			}
		})
	});
	
	$('.homeLink').click(function(e) {
//		e.preventDefault();
		$('.body-container').trigger('resize');
		$('ul.navbar-right').children('li').removeClass('activeLink');
		
		if(!$(this).hasClass('navbar-brand')) {
			$(this).parent().addClass('activeLink');
		}
		
		$.ajax({
			url: './includes/ajax.php?index=home',
			method: 'GET',
			success: function(res) {
				$('.body-container').html(res);
//				if($('.settings').length) {
				$('p.settings').removeClass('hidden');
				$('.fade-text').fadeTo(10000, 0.0);
//				}
			}
		})
	});

	// Show only the first 300 characters of the blog post on load
	$.each($('.post'), function() {
		var post = $(this).text();
		if(post.length > 300 && !$('.post').hasClass('activeText')) {
			post = post.substr(0, 300) + ".... <a href='#' role='button' class='showMore'>(click for more)</a>";
			$(this).html(post);
		}
	}); // End of .each function for each post
	
	/** On scroll of window, when blog topics are displayed make them sticky **/
	$(window).scroll(function() {
		if($('body').has('aside#blogTopics')) {
			var aside = $('aside#blogTopics');
			var mainOffset = $('main.row').offset().top;
			var navHeight = $('nav.navbar').height();

			if(window.pageYOffset < navHeight + 10) {
				aside.css({
					'position': 'relative',
					'top': 0
				});
			}
			
			if(window.pageYOffset > navHeight) {
				aside.css({
					'position': 'fixed',
					'top': mainOffset - 90 //95 110
				});
			}
		}
		
		if($(window).scrollTop() == $(document).height() - $(window).height()) {
           // ajax call get data from server and append to the div
			console.log('bottom');
			var lastBlog = $('.blog').last().children('article').attr('id');
			console.log($('.blog'));
			console.log(lastBlog);
			
			if(document.title.includes('Home')) {
//				$.get('./includes/ajax.php', 'GET')
				
				$.ajax({
					method: 'POST',
					datetype: 'text',
					url: './includes/ajax.php',			
					contentType: 'application/x-www-form-urlencoded',
					data: {
//						update_comment_post: newComment,
//						comment_id: commentId,
						load_blogs: lastBlog
					},
					success: function(res) {
						res = $.parseHTML(res);
						$('section#blogSection').append(res);
						$('.blogComments').css('display', 'none');
						console.log(res);
					}
				})
			}
			
    	}
	});
	
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
	
		 // Adding a new blog post
	$('#newBlog').click(function(e) {
		var $blog_title = $('#blogTitle');
		var $blog_topic = $('#blogTopic');
		var $blog		= $('#blog');
		var public		= $('input[name="public"]');
		 		
		if( $blog_title.val() === '' ) {
			e.preventDefault();
			console.log('line 17');
			$($blog_title).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.titleError').show();
		} else {
			$($blog_title).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.titleError').hide();
		}
		if( $blog_topic.val() === '' ) {
			e.preventDefault();
			console.log('line 181');
			$($blog_topic).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.topicError').show();
		} else {
			$($blog_topic).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.topicError').hide();
		}
		if( $blog.val() === '' ) {
			e.preventDefault();
			console.log('line 188');
			$($blog).parent().removeClass('has-success has-feedback').addClass('has-error has-feedback');
			$('.blogError').show();
		} else {
			$($blog).parent().removeClass('has-error has-feedback').addClass('has-success has-feedback');
			$('.blogError').hide();
		}
	});
	
	// Search button clicked
	$('#searchButton').click(function(e) {
		e.preventDefault();
		var searchQuery = $('#search').val();
		$.ajax({
			url: "./includes/ajax.php?search="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
//				$('main.row').append(res);
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
		$('.search-list').slideDown(5000);
		
		if($('#search').val() == '') {
			$('.search-list').html('');	
		}		
	}); // End of search bar focus
	
	// When user has left search bar, hide search result short list
	$('#search').blur(function() {
		$('.search-list').addClass('hidden');
		
		if($('#search').val() == '') {
			$('.search-list').html('');	
		}
	}); // End of search bar blur
	
	// On keyup in search bar
	$('#search').keyup(function() {
		$('.search-list').html('');
		var searchQuery = $('#search').val();
		$('.search-list').slideDown(5000);
		$.ajax({
			url: "./includes/ajax.php?search="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
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
				
//					console.log($('li.list-group-item'));
					
					$.each(Array.from($('li.list-group-item')), function() {
						console.log($(this));
						$(this).hover(function() {
							$(this).css('cursor', 'pointer');
							$('#search').val($(this).text());
						});
					});
					
					if($('#search').val() == '') {
						$('.search-list').html('');	
					}
			} // End of AJAX success function
		}); // End of AJAX call
	}); // End of Search keyup	
	
	// Blog topics link clicked, show public blogs with same topic
	$('#blogTopics a').click(function(e) {
		e.preventDefault();
		var topic = $(this).html();
		console.log(topic);
		
		if(document.title.includes('Home')) {

			$.ajax({
				method: 'POST',
				datetype: 'text',
				url: './includes/ajax.php',			
				contentType: 'application/x-www-form-urlencoded',
				data: {
					public_topic: topic
				},
				success: function(res) {
					res = $.parseHTML(res);
					$('section#blogSection').append(res);
					$('.blogComments').css('display', 'none');
					console.log(res);
				}
			});
		} else if(document.title.includes('User blogs')) {

			$.ajax({
				method: 'POST',
				datetype: 'text',
				url: './includes/ajax.php',			
				contentType: 'application/x-www-form-urlencoded',
				data: {
					user_topic: topic
				},
				success: function(res) {
					res = $.parseHTML(res);
					$('section#blogSection').append(res);
					$('.blogComments').css('display', 'none');
					console.log(res);
				}
			});
		}
		
		
		$.ajax({
			url: "./includes/ajax.php?topic="+topic,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
				$('.body-container').trigger('resize');
			}
		}); // End of AJAX call
	}); // End of Blog topic link click
	
	// User image clicked, show users public blogs
	$('#blogSection a.avatar').click(function(e) {
		$('.body-container').trigger('resize');
		e.preventDefault();
		var user_name = $(this).next().text();
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
			}
		}); // End of AJAX call
	}); // End of user avatar click
	
	// User name clicked, show users public blogs
	$('#blogSection a.name').click(function(e) {
		$('.body-container').trigger('resize');
		e.preventDefault();
		var user_name = $(this).text();
		$.ajax({
			url: "./includes/ajax.php?username="+ user_name,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
			}
		}); // End of AJAX call
	}); // End of user name click
	
	// On click of title, show only this blog post
	$('#blogSection a.title').click(function(e) {
		$('.body-container').trigger('resize');
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
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
			}
		}); // End of AJAX call
	}); // End of title click
	
	// On click of blog date, show all blogs with same date
	$('#blogSection a.date').click(function(e) {
		$('.body-container').trigger('resize');
		e.preventDefault();
		var searchQuery = $(this).children('.date_posted').text();
		$.ajax({
			url: "./includes/ajax.php?date="+searchQuery,
			method: "GET",
			success: function(res) {
				$('#blogSection').html(res);
				$('.blogComments').css('display', 'none');
				$('div.likes-and-comments span.comment-btn').css('cursor', 'pointer');
			}
		}); // End of AJAX call
	}); // End of date click
	
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
	
	$('input#username, input#email').keyup(function() {
		console.log($(this).val());
	})
	
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

	/** On upload of image, show image before actual upload **/
	$('input[name="avatar"]').change(function() {
		var user_avatar_preview = $('.user_avatar_preview');
		if(this.files && this.files[0].size < 5242880 && (this.files[0].type == 'image/jpg' || this.files[0].type == 'image/jpeg' || this.files[0].type == 'image/png' || this.files[0].type == 'image/gif')) {
			var render = new FileReader();
			render.onload = function(e) {
				user_avatar_preview.attr('src', e.target.result)
					.addClass('image-border');
				$('.imageTypeError').addClass('hidden');
				$('.imageSizeError').addClass('hidden');
			}
			
			render.readAsDataURL(this.files[0]);
		} else if(this.files && !(this.files[0].type == 'image/jpg' || this.files[0].type == 'image/jpeg' || this.files[0].type == 'image/png' || this.files[0].type == 'image/gif')) {
			$('.imageTypeError').removeClass('hidden');
			console.log("Wrong file type!");
			console.log(this.files);
		} else if(this.files[0].size > 5242881){
			$('.imageSizeError').removeClass('hidden');
		}
	});
		
	$('body').on('click', 'button.glyphicon-cog', function() {
		var settingsMenu = $(this).parent().next().find('ul.settingsList'); //.find('ul');
		var top = $(this).height() + 20;
		var right = $(this).width() / 2;
		settingsMenu.toggleClass('hidden').css({
//			'background-color': '#f40',
			'top': top, //'-10px',
			'right': right, //'-20px'
		});
	});
	
	// On delete blog post click, add the blog id to the modal
	$('body').on('click', 'button.delete', function(e) {
		e.preventDefault();
//		var blog_id = $(this).parents().next().val();
		var comment_or_blog_id = $(this).attr('id');
		var blogID = $(this).parents().find('article').attr('id');
		
		$('#comment_or_blog_id').val(comment_or_blog_id);
		$('#blogID').val(blogID);
		$('#comment_or_blog').val($(this).attr('name'));
//		console.log(blogID);
		
//		console.log($(this).parents());
//		
//		if($(this).parents('.comment').parent('.comment-list')) {
////		} else {
//			$('#comment_or_blog').val('comment');
//			console.log('comment');
//		} else if($(this).parents('.date_and_settings').parent('.blog_title')) {
//			$('#comment_or_blog').val('blog');
//			console.log('blog');
//		}
		
		
	}); // End of delete blog post click
	
	// On confirm of delete blog post, delete blog through ajax
	$('body').on('click', '#deleteBlogModal .modal-footer button[name="delete"]', function() {
		$('form.modal-dialog').submit(function(e) {
			e.preventDefault();
			var comment_or_blog_id = $('#comment_or_blog_id').val();
			var comment_or_blog = $('#comment_or_blog').val();
			var blogID = $('#blogID').val();

			$.ajax({
				url: './includes/ajax.php?delete='+comment_or_blog_id+'&comment_or_blog='+comment_or_blog+'&blogID='+blogID,
				method: 'GET',
				success: function(res) {
					if(comment_or_blog == 'delete_post') {
						if($('artice#'+comment_or_blog_id).length) {
							$('article#'+comment_or_blog_id).parent('.blog').remove();
							$('div.'+comment_or_blog_id).remove();
						} else if($('table').length) {
							$('tr.'+comment_or_blog_id).remove();
							$.each($('tr td.blog_id'), function() {
								$(this).text(parseInt($(this).text(), 10) - 1);
							})
//							$('tr td.blog_id').text(parseInt($('tbody tr td.blog_id').text(), 10) - 1);
							
						}
					} else {
						var comment_count_text = $('article#'+blogID).find('span.total-comments');
						console.log(comment_count_text.text());
						var comment_total = parseInt(comment_count_text.text());
						$('li.'+comment_or_blog_id).remove();
						comment_count_text.text(comment_total - 1);
						
					}
					$('#deleteBlogModal').modal('hide');
					console.log(res);
				}
			});
		});		
	});
	
	// On delete blog post click, add the blog id to the modal
	$('body').on('click', 'button.glyphicon-trash', function(e) {
		var $blog_id = $(this).parent().next().val();
		console.log($blog_id);
		$('#blogID').val($blog_id);
	}); // End of delete blog post click
		
	// Show all of the blog post when only partial is visible
	$('body').on('click', '#blogSection a.showMore', function(e) {
		e.preventDefault();
		var blog_id = $(this).parent().parent().next().children('form').children('.blog_id').val(); //children('form').
		var post = $(this).parent();
		console.log(blog_id);
		console.log(post);
		console.log($(this).parent().parent().next());
		$.ajax({
			url: "./includes/ajax.php?full_post=" + blog_id,
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
	$('body').on('click', '.comment-btn', function(e) {
		var welcomeMessage = $('p.navbar-text').text();
//		console.log(welcomeMessage);
		if(welcomeMessage != '') {
			e.preventDefault();
//			var blog_id = $(this).parent().next().val();
			var blog_id = $(this).parents('article').attr('id');
			
//			if($('main.row').css('margin-bottom') == '0px') {
//				$('main.row').css({'margin-bottom': '50px'});
//			} else {
//				$('main.row').css({'margin-bottom': '0px'});
//			}

			if($(this).parents('.blog').next().css('margin-top') == '100px') {
				$(this).parents('.blog').next().css({'margin-top': '200px'});
				$('#blogSection article').css('border-radius', '10px 10px 10px 10px');
				$('#blogSection .blog_footer').css('border-radius', '0 0 10px 10px');
			} 
			else {
				$(this).parents('.blog').next().css({'margin-top': '100px'});
				$('#blogSection article').css('border-radius', '10px 10px 0 0');
				$('#blogSection .blog_footer').css('border-radius', '0 0 0 0');
			}
			
			
			$('.blogComments.'+blog_id).toggle();
			
			$('.blogComments.'+blog_id + ' .commentInput').focus();
			$('.body-container').trigger('resize');
			
			
//			if($('.blogComments.'+blog_id).css('display') == 'none') {
//				$('.blogComments.'+blog_id).slideDown('slow');
//			} else {
//				$('.blogComments.'+blog_id).slideUp('slow');
//			}
			
//			$(this).parents('article').toggleClass('blogCommentsMargin');

			
//			$('.blogComments.'+blog_id).toggle(
//				function() {
//					
//				},
//				function() {
//					
//				}
//			);
			
		}
	}); // End of clicking on comment button
	
	
	$('body').on('click', '.comment-post-btn', function(e) {
		e.preventDefault();
		var blog_id = $(this).parent().prev().val();
		var totalCommentsText = $(this).parents('.blogComments').prev().children('.blogPost').find('span.total-comments');
		var totalComments = parseInt(totalCommentsText.text());
		var userCommentInput = $(this).parent().prev().prev();
		var userComment	= userCommentInput.val();
		
		
		var commentList = $(this).parent().parent().parent().next();
//		console.log(commentList);
		
//		console.log(userComment.val());
//		userComment.val('');
		if(userComment != '') {
			$.ajax({
				method: 'POST',
				datetype: 'text',
				url: './includes/ajax.php',
				contentType: 'application/x-www-form-urlencoded',
				data: 'commentInput='+userComment+'&blog_id='+blog_id,  //$('#commentForm').serialize(),
				success: function(res) {
					totalCommentsText.text((totalComments += 1));
					userCommentInput.val('');
					console.log(res);
					var comment = $.parseHTML(res);
					console.log(comment);

					commentList.prepend(comment);
					commentList.find('.settings').removeClass('hidden');
	//				res.appendTo($('.comment.list'));
				}
			});
		} else {
			$('.blogComments.'+blog_id + ' .commentInput').focus();
		}
		
//		if(window.XMLHttpRequest) {
//			xhr = new XMLHttpRequest();
//		} else { 
//			xhr = new ActiveXObject("Microsoft.XMLHTTP");
//		}
//var xhr = new XMLHttpRequest();
//		xhr.open(method, file, async);
//
//		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//		xhr.onreadystatechange = function() {
//			if(this.readyState === 4 && this.status === 200) {
//				
//				
//			}
//		}
//		xhr.send();	
		
//		console.log(totalComments);
//		console.log(commentCount);
		
//		$.ajax({
//			url: './includes/ajax.php?comment='+blog_id,
//			method: 'GET',
//			success: function() {
//				totalComments.text((commentCount += 1));
//			}
//		});
	}); // End of clicking on comment button

		
	$('body').on('dblclick', 'p.comment', function(e) {
		e.preventDefault();
		console.log(e.target.tagName);
		
		function sendComment(userComment) {
			if(userComment != '') {
				$.ajax({
					method: 'POST',
					datetype: 'text',
					url: './includes/ajax.php',
					contentType: 'application/x-www-form-urlencoded',
					data: 'newCommentInput='+comment+'&comment_id='+commentId, 
					success: function(res) {
						res = $.parseHTML(res);
						el_holder.html(res).css('margin', 0);
						$('.newCommentInput').focus(); //.css('outline', 'none')
						$('.newCommentInput').blur(function(e) {
							e.preventDefault();
							var newComment = $(this).val();
							var commentId = $(this).attr('id');
							var el_holder = $(this).parents('p.comment');
							console.log(newComment);
							console.log(commentId);
							console.log(el_holder);
							el_holder.html("<span class='comment-text'>"+newComment+"</span>")
									.css('padding-left', '9%');
						});						
					}
				});
			}
		}
		
//		if(e.target.tagName == "SPAN") {
//			var commentId = $(this).parents('li.comment').attr('id');
//			var el_holder = $(this);
//			var el_to_replace = el_holder.find('span.comment-text');
//			var comment = el_to_replace.text();
//			sendComment(comment);
//			console.log($('.comment'+commentId));
//		}
//		
//		if(e.target.tagName == "P") {
			var commentId = $(this).parents('li.comment').attr('id');
			var el_holder = $(this);
			var el_to_replace = el_holder.find('span.comment-text');
			var comment = el_to_replace.text();
			sendComment(comment);
//		}
	});
	
	$('body').on('click', '.edit_comment', 'p.comment', function(e) {
		e.preventDefault();
//		console.log(e.target.tagName);
		
		if(e.target.tagName == "BUTTON") {
			var settingsMenu = $(this).parents('ul.settingsList');
			settingsMenu.toggleClass('hidden');
			var commentId = $(this).parents('li.comment').attr('id');
			var el_holder = $(this).parents('form').siblings('p.comment');
			var el_to_replace = el_holder.find('span.comment-text');
			var comment = el_to_replace.text();
		}
		
		if(comment != '') {
			$.ajax({
				method: 'POST',
				datetype: 'text',
				url: './includes/ajax.php',
				contentType: 'application/x-www-form-urlencoded',
				data: 'newCommentInput='+comment+'&comment_id='+commentId, 
				success: function(res) {
					res = $.parseHTML(res);
					el_holder.html(res).css('margin', 0);
//					console.log(res);
					$('.newCommentInput').focus();
					$('.newCommentInput').blur(function(e) {
						e.preventDefault();
						var newComment = $(this).val();
						var commentId = $(this).attr('id');
						var el_holder = $(this).parents('p.comment');
						console.log(newComment);
						console.log(commentId);
						console.log(el_holder);
						el_holder.html("<span class='comment-text'>"+newComment+"</span>")
								.css('padding-left', '9%');
					});
				}
			});
		}
//		
//		
////		var comment = el_holder.text();
//		var new_el = "<form class='hidden' id='commentForm' action='./includes/ajax.php' method='post'><div class='form-group col-xs-12 input-group'><label class='sr-only'>Leave a comment</label><input type='text' value='" + comment + "' placeholder='" + comment + "' name='commentInput' class='form-control input-group commentInput' placeholder='Leave a comment...'><input type='number' value='" + commentId + "' name='commentId' class='hidden commentId'><span class='input-group-btn'><span class='sr-only'>Post comment</span><button type='submit' class='btn btn-default update-comment-post-btn' name='update_comment_post'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></button></span></div></form>";
//		//$(this).parents('form').siblings('p.comment').find('span.comment-text').text();
////		console.log(blog_id);
////		console.log(el_holder);
////		console.log(el_to_replace);
////		console.log(comment);
//		
//		el_holder.html(new_el).css('margin', 0);
	});
	
	$('body').on('click', '.update-comment-post-btn', function(e) {
		e.preventDefault();
		var newComment = $(this).parent().prev().prev().val();
		var commentId = $(this).parents('li.comment').attr('id');
		var el_holder = $(this).parents('p.comment');
		
//		var 
//		
//		var dateTime = "<small clas='date-posted><em>&nbsp;" . $current_date . "&nbsp;&nbsp;" . $current_time . "</em></small>
		
		$.ajax({
			method: 'POST',
			datetype: 'text',
			url: './includes/ajax.php',			
			contentType: 'application/x-www-form-urlencoded',
			data: {
				update_comment_post: newComment,
				comment_id: commentId
			},
//				'update_comment_post='+newComment+'&comment_id='+commentId, 
			success: function(res) {
				res = $.parseHTML(res);
				el_holder.html(res).css('padding-left', '9%');
//				el_holder.html(res);
//				console.log(res);
			}
		});
	});
	
	/* On click of favorite-btn, update DB with ajax */
	$('body').on('click', '.favorite-btn', function(e) {
		var welcomeMessage = $('p.navbar-text').text();
		if(welcomeMessage != '') {
			e.preventDefault();
			var selfIcon = $(this).find('span');
			var blog_id = $(this).parent().next().val();
			selfIcon.toggleClass('glyphicon-star-empty glyphicon-star favorited');
			$.ajax({
				url: './includes/ajax.php?favorite='+blog_id,
				method: 'GET'
			});
		}
	});
	
	/* On click of like-btn, update DB with ajax */
	$('body').on('click', '.like-btn', function(e) {
		var welcomeMessage = $('p.navbar-text').text();
		if(welcomeMessage != '') {
			e.preventDefault();
			var selfIcon = $(this).find('span');
			var blog_id = $(this).parent().next().val();
			var likeSpan = $(this).parent().parent().parent().prev().find('span.total-likes');
			var likeCount = parseInt(likeSpan.text());
			selfIcon.toggleClass('glyphicon-heart-empty glyphicon-heart liked');
			$.ajax({
				url: './includes/ajax.php?like='+blog_id,
				method: 'GET',
				success: function() {
					if(selfIcon.hasClass('liked')) {
						likeSpan.text(likeCount += 1);
					} else {
						likeSpan.text(likeCount -= 1);
					}
				}
			});
		}
	});
	
	/* On click of dislike-btn, update DB with ajax */
	$('body').on('click', '.dislike-btn', function(e) {
		var welcomeMessage = $('p.navbar-text').text();
		if(welcomeMessage != '') {
			e.preventDefault();
			var selfIcon = $(this).find('span');
			var blog_id = $(this).parent().next().val();
			var dislikeSpan = $(this).parent().parent().parent().prev().find('span.total-dislikes');
			var dislikeCount = parseInt(dislikeSpan.text());
			selfIcon.toggleClass('disliked');			
			$.ajax({
				url: './includes/ajax.php?dislike='+blog_id,
				method: 'GET',
				success: function() {
					if(selfIcon.hasClass('disliked')) {
						dislikeSpan.text(dislikeCount += 1);
					} else {
						dislikeSpan.text(dislikeCount -= 1);
					}
				}
			});
		}
	});
	
	//========================================================//
	
	// Test for favorite click with ajax
//	$('body').on('click', '.favorite-btn', function(e) {
//			var selfIcon = $(this).find('span');
//			var blog_id = $(this).parent().next().val();
//			selfIcon.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
//		$('.blog_footer').submit(function(e) {
//			e.preventDefault();
//			
//			$.ajax({
//				url: './includes/ajax.php',
//				type: 'POST',
//				data: {
//					'favorite': blog_id
//				},
//				success: function(res) {
////					console.log('success');
////					console.log($(this));
////					console.log(res);
//					$(selfIcon).css({'color': 'red'});
//				}
//			});
//			
////			$.post('./includes/ajax.php', function() {
////				$(this).css('color', 'red');
////				console.log('success');
////			});
//		});
//	});
	
	
	
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