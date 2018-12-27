$(document).ready(function() {
	
	$('#principais-noticias > div > div').hover(
	function() {
		$(this).animate({
			backgroundSize: "130%"
		}, 450);
		$(this).clearQueue();

	},
	function() {
		$(this).animate({
			backgroundSize: "100%"
		}, 450);
		$(this).clearQueue();
		
	});

});