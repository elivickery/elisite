(function($){
	// Options
	var submenuHasBackButton = false;

			//STICKY NAVIGATION
		function sticky_relocate() {
			var window_top = $(window).scrollTop();
			// var distance = $('.top-section').outerHeight();
			// var bannerheight = $('.banner').outerHeight();
			// distance ? distance = distance : distance = 45;

			var distance = 50;

			// if ( $("body").hasClass("page-template-template-info-boxes-php") ) {
			// 	distance = 45;
			// }

			if (window_top > distance) {
				$('#header .upper').addClass('sticky');
			} else {
				$('#header .upper').removeClass('sticky');
			}
		}


	    $(window).scroll(sticky_relocate);
	    sticky_relocate();

	$(document).ready(function() {
		$('.hamburger').click(function(event){
			$('body').toggleClass('fullscreen-menu');
		});

		// Detect if dropdown menu will go off screen
		$('.sub-menu').parent().hover(function() {
			var menu = $(this).find('ul');
			var menupos = $(menu).offset();

			if (menupos.left + menu.width() > $(window).width()) {
				$(menu).addClass('reverse');
			}
		});

		// Add parent menu item's link to the top of its submenu
		$('.sub-menu').each(function(i, el) {
			var $parentLink = $(el).closest('li');
			var parentURL = $parentLink.children('a').attr('href');
			var	parentLinkClasses = $parentLink.attr('class').replace('menu-item-has-children', 'menu-item-has-children-link');
			var parentLinkContent = $parentLink.html();

			jQuery(this).prepend('<li class="duplicate-link"><a href="' + parentURL + '">' + $parentLink.children('a').html() + '</a></li>');

			/*
			if(/http/i.test(parentURL)) {
				// Add a 'back' navigation button
				var backEl = '';

				if (submenuHasBackButton) {
					backEl = '<li class="fullscreen-only menu-item menu-item-back"><a href="#">Back</a></li>';
				}

				var parentLinkEl = '<li class="fullscreen-only ' + parentLinkClasses + '">' + parentLinkContent + '</li>';

				$(el).prepend(backEl + parentLinkEl);
			}
			*/
		});

		// Drill down
		$('#header .menu-item-has-children > a').click(function(event) {
			if($('body').hasClass('fullscreen-menu')) {
				event.preventDefault();
				
				$(this).siblings('.sub-menu').toggleClass('open');
			}
		});
		// Go back
		$('#header .menu-item-back > a').click(function(event) {
			event.preventDefault();

			$ancestorMenus = $(this).parents('ul');
			$parentMenu = $($ancestorMenus[0]);

			$parentMenu.toggleClass('open');
		});
	});
}(jQuery));