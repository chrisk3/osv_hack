$(document).ready(function(){
	// Cache the Window object
	$window = $(window);

	$('div[data-type="background"]').each(function(){
		var $bgobj = $(this); // assigning the object

		$(window).scroll(function() {

		// Scroll the background at var speed
		// the yPos is a negative value because we're scrolling it UP!								
		var yPos = -($window.scrollTop() / $bgobj.data('speed'));
		// console.log(yPos);

		// Put together our final background position
		var coords = '50% '+ yPos + 'px';

		// Move the background
		$bgobj.css({ backgroundPosition: coords });
		console.log($bgobj.css({ backgroundPosition: coords }));

		}); // window scroll Ends

	});

	var slide = 1
	$('button').on('click', function() {
		if ($(this).attr('class') == 'prev') {
			slide -= 1;
			$('html, body').animate({
        		scrollTop: $("#" + slide).offset().top
    		}, 1500);
		} else {
			slide += 1;
			$('html, body').animate({
        		scrollTop: $("#" + slide).offset().top
    		}, 1500);
		}
	});

});