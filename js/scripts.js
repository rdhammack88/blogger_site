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
	
	
	
	
	if( $('#mainNav > div').hasClass('col-xs-12') ) {
		$('#mainNav > div').toggle();
	}
	
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
	
	
});