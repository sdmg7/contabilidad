$(function() {


// select all desired input fields and attach tooltips to them
$("#PaginaDatos :input").tooltip({

	// place tooltip on the right edge
	position: "top center",

	// a little tweaking of the position
	offset: [0, 80],

	// use the built-in fadeIn/fadeOut effect
	effect: "fade",

	// custom opacity setting
	opacity: 1

});
});

