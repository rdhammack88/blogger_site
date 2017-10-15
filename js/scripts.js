$(document).ready(function() {

	var $searchBox = $('#search');
	
	$searchBox.focus(function() {
//		$(this).toggleClass('input-sm input-lg').toggleClass('btn-sm btn-lg');
//		$('.input-group .btn').toggleClass('btn-sm btn-lg');
		
	});

	$searchBox.blur(function() {
		$(this).toggleClass('input-sm input-lg');
		
		$('.input-group .btn').toggleClass('btn-sm btn-lg');
	});

	
	
	
	
	
	
	
	
	
	
});