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

	$('input[name="signup"]').click(function(e) {
		var $first_name = $('#first_name');
		var $email = $('#email');
		var $password = $('#password');
		
		if( $first_name.val() === '' ) {
			e.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
		
		if( $email.val() === '' ) {
			e.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
		
		if( $password.val() === '' ) {
			e.preventDefault();
			$('.inputError').show();
		} else {
			$('.inputError').hide();
		}
		
	});
	
	 
	 $('#newBlog').click(function(e) {
		var $blog_title = $('#blogTitle');
		var $blog_topic = $('#blogTopic');
		var $blog = $('#blog');
		 		
		if( $blog_title.val() === '' ) {
			e.preventDefault();
			$('.titleError').show();
		} else {
			$blog_title.addClass('has-success has-feedback');
			$('.titleError').hide();
		}
		 
		  /*if( $blog_title.val()) {
			$blog_title.addClass('has-success, has-feedback');
			$('.titleError').hide();			
		}else {
			e.preventDefault();
			$('.inputError').show();
		}*/
		
		if( $blog_topic.val() === '' ) {
			e.preventDefault();
			$('.topicError').show();
		} else {
			$('.topicError').hide();
		}
		
		if( $blog.val() === '' ) {
			e.preventDefault();
			$('.blogError').show();
		} else {
			$('.blogError').hide();
		}
		
	});
	
	if( $('#mainNav > div').hasClass('col-xs-12') ) {
		$('#mainNav > div').toggle();
	}
	
	// User login conformation animation
	setTimeout(function() {
		$('.alert-success').slideUp();
	}, 2000);
	
	// If page is login or signup, make the footer bottom-fixed
	if( document.title.includes('Login') ) {
		$('footer').css({ 
			position: "relative",
			bottom: 0,
			left: 0
		});		//.addClass('navbar-fixed-bottom');
	}
	
	// If the main content is less than 500px, fix the navbar to bottom of page
	/*if( $('main').height() < 500 ) {
		$('footer').css({ 
			position: "relative",
			bottom: 0,
			left: 0
		});		//.addClass('navbar-fixed-bottom');
	}*/
	
	// If there are no user blogs, then hide the "most recent blogs" text
	if( $('#blogSection').has('div.alert') ) {
		$('.no-blogs').hide();
	}
	
	
});