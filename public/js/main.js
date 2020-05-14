$(document).ready(function() {
	$('.set-bg').each(function(index) {
		var background = $(this).data('bg');
		$(this).css('background-image', 'url("' + background + '")');
	});
});