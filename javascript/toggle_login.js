/* jQuery document */


/* This function shows/hides the login options */
$(document).ready(function(){
	$("#login_icon").on("click", function (e) {
	    $("#login_options").fadeToggle(200);
	    e.stopImmediatePropagation();
	});

	$(document).on("click", function (e) {
	    if($("#login_options").is(":visible") && !$("#login_options").is(e.target)) {
	        $("#login_options").fadeOut(200);
	    }
	});

});