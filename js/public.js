;(function($) {
	'use strict';
	var $body    = $('html, body'),
		content = $('#primary').smoothState({
		onStart: {
			duration: 500, // Duration of our animation
			render: function (url, $container) {
				content.toggleAnimationClass('is-exiting'); // restarts css animations with class
			}
		},
		prefetch: true,
		pageCacheSize: 20
	}).data('smoothState'); // makes public methods available
})(jQuery);