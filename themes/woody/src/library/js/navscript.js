
var ww = document.body.clientWidth;

$(document).ready(function() {
	$("#main-nav ul li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$("#main-nav ul").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 750) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
                    $("#main-nav ul").hide();
                    
		} else {
                    $("#main-nav ul").show();
                    
		}
		$("#main-nav ul li").unbind('mouseenter mouseleave');
//		$("#main-nav ul li a.parent").unbind('click').bind('click', function(e) {
//			// must be attached to anchor element to prevent bubbling
//			e.preventDefault();
//			$(this).parent("li").toggleClass("hover");
//		});
	} 
	else if (ww >= 728) {
		$(".toggleMenu").css("display", "none");
		$("#main-nav ul").show();
		$("#main-nav ul li").removeClass("hover");
		$("#main-nav ul li a").unbind('click');
		$("#main-nav ul li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
                    $(this).toggleClass('hover');
		});
	}
}

