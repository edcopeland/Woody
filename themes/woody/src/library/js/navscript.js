
var ww = document.body.clientWidth;

$(document).ready(function() {

	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$("#main-nav ul").slideToggle(40);
		$(".header-image").slideToggle(40);
		$(".toggleMenu").toggleClass('toggle-white toggle-green');

	});
})
//
$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww > 779) {
		$(".toggleMenu").css("display", "none");
		$("#main-nav ul").show();
		$(".header-image").show();

	}
	else if (ww < 779) {
		$(".toggleMenu").css("display", "inline-block");
		$("#main-nav ul").hide();
	}

}
