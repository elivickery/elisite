(function($){

	function applyBackstretch() {
		jQuery('.backstretchable').each(function() {
			var image = jQuery(this).attr('data-bg');
			jQuery(this).backstretch(image, {fade: 1000});
		});
	}

	jQuery(document).ready(function() {

		smoothScroll.init();
	
		applyBackstretch();

	});

	jQuery(window).load(function() {
	});
	
	jQuery(window).resize(function() {
	});
}(jQuery));
