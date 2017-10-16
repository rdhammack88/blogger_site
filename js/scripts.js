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
	
	
	setTimeout(function() {
		$('.alert').slideUp();
	}, 2000);
	
	
	
	
});