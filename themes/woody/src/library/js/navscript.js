
var ww = document.body.clientWidth;

$(document).ready(function() {

	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$("#menu-main-menu").slideToggle(40);
		$(".header-image").slideToggle(40);
		$(".toggleMenu").toggleClass('toggle-white toggle-green');
		$(".sub-menu").css("display", "block");
		$(".custom-logo").toggleClass('toggle-small');

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
		$("#menu-main-menu").css("display", "inline-block");
		$(".sub-menu").removeAttr( 'style' );
		$(".header-image").show();

	}
	else if (ww < 779) {
		$(".toggleMenu").css("display", "inline-block");
		$("#menu-main-menu").hide();
	}

}
