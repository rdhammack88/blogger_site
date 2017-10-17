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

	$('#signupForm input[type="submit"]').click(function(e) {
		var $first_name = $('#first_name');
		var $email = $('#email');
		var $password = $('#password');
		
		if( $first_name === '' ) {
			e.preventDefault();
			console.log('no-name');
		}
		if( $email === '' ) {
			e.preventDefault();
			console.log('no-email');
		}
		if( $password === '' ) {
			e.preventDefault();
			console.log('no-password');
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
	if( document.title.includes('Login') || document.title.includes('Signup') ) {
		$('footer').addClass('navbar-fixed-bottom');
	}
	
	// If the main content is less than 500px, fix the navbar to bottom of page
	if( $('main').height() < 500 ) {
		$('footer').addClass('navbar-fixed-bottom');
	}
	
	// If there are no user blogs, then hide the "most recent blogs" text
	if( $('#blogSection').has('div.alert') ) {
		$('.no-blogs').hide();
	}
	
	
});