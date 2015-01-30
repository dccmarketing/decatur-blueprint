/*$(function() {
    var $body = $('html, body'),
    content = $('#page').smoothState({
        prefetch: true,
        pageCacheSize: 4,
        // blacklist anything you dont want targeted
        blacklist : '',
        development : false,
        // Runs when a link has been activated
        onStart: {
            duration: 250, // Duration of our animation
            render: function (url, $container) {
                // toggleAnimationClass() is a public method
                // for restarting css animations with a class
                content.toggleAnimationClass('is-exiting');
                // Scroll user to the top
                $body.animate({
                    scrollTop: 0
                });
            }
        },
        onEnd : {
            duration: 0, // Duration of the animations, if any.
            render: function (url, $container, $content) {
                $body.css('cursor', 'auto');
                $body.find('a').css('cursor', 'auto');
                $container.html($content);
                // Trigger document.ready and window.load
                $(document).ready();
                $(window).trigger('load');
            }
        },
        onAfter : function(url, $container, $content) {

        }
    }).data('smoothState'); // makes public methods available
});

(function($, undefined) {
    var isFired = false;
    var oldReady = jQuery.fn.ready;
    $(function() {
        isFired = true;
        $(document).ready();
    });
    jQuery.fn.ready = function(fn) {
        if(fn === undefined) {
            $(document).trigger('_is_ready');
            return;
        }
        if(isFired) {
            window.setTimeout(fn, 1);
        }
        $(document).bind('_is_ready', fn);
    };
})(jQuery);*/

jQuery(document).ready(function($){

	$('.image_for_viewbox').click(function() {

		var url = $(this).data('image');
		var title = $(this).data('title');
		var caption = $(this).data('caption');

		var viewbox = $('.viewbox');
		var titlebox = $('.view_title');
		var captionbox = $('.view_caption');

		viewbox.fadeOut(250, function() {
			viewbox.attr('src', url );
			viewbox.fadeIn(250);
		});
		titlebox.fadeOut(250, function() {
			titlebox.text( title ).html();
			titlebox.fadeIn(250);
		});
		captionbox.fadeOut(250, function() {
			captionbox.text( caption );
			captionbox.fadeIn(250);
		});

	});

});

var video = document.getElementById( "bgvideo" );
var playButton = document.getElementById( "playpause" );

playButton.addEventListener("click", function() {
	if (video.paused) {
		video.play();
		playButton.innerHTML = "&#10073; &#10073;";
	} else {
		video.pause();
		playButton.innerHTML = "&#9658";
	}
});