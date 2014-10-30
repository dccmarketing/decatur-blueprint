;(function($) {
	'use strict';
	var content = $('#primary').smoothState({
		// Runs when a link has been activated
		onStart: {
			duration: 250, // Duration of our animation
			render: function (url, $container) {
				// toggleAnimationClass() is a public method
				// for restarting css animations with a class
				content.toggleAnimationClass('is-exiting');
			}
		}
	}).data('smoothState'); // makes public methods available
})(jQuery);