/* jQuery document */


/* These functions control the behaviour of the gallery */
$(document).ready(function(){

    /* This function loads the big images when thumbnail is clicked,
    and creates the controls of the gallery */
	$(".thumbnail").click(function() {
		var full = $(this).attr("id");
		full += "full";
		$("#lightbox").removeClass("invisible");
		$("#lightbox").addClass("visible");
		$("#" + full).removeClass("invisible");
		$("#" + full).addClass("visible");

		if($("#" + full).next("img").length) {
			$("#next").removeClass("invisible");
			$("#next").addClass("visible");
		}

		if($("#" + full).prev("img").length) {
			$("#previous").removeClass("invisible");
			$("#previous").addClass("visible");
		}
	});

    /* This function hides the big images */
	$("#lightbox").click(function() {
		$(".visible").addClass("invisible");
		$(".visible").removeClass("visible");
	});

    /* Those next two functions are the controls of the gallery.
    When clicked, they check if there is another picture (either 
    before or after the current one) and display it if there is. 
    They also check if the new photo has a previous and next photo 
    so the correct controls are displayed. */
    
    $("#next").click(function(){
    	var $image = $("img.visible");
    	if($image.next("img").length) {
    		$image.removeClass("visible");
    		$image.addClass("invisible");
    		var $next_image = $image.next();
    		$next_image.removeClass("invisible");
    		$next_image.addClass("visible");
    		if(!$next_image.next("img").length) {
    			$("#next").removeClass("visible");
    			$("#next").addClass("invisible");
    		}

    		if($("#previous").hasClass("invisible")) {
    				$("#previous").removeClass("invisible");
    				$("#previous").addClass("visible");
    			}
    	}
    });

    $("#previous").click(function(){
    	var $image = $("img.visible");
    	if($image.prev("img").length) {
    		$image.removeClass("visible");
    		$image.addClass("invisible");
    		var $prev_image = $image.prev();
    		$prev_image.removeClass("invisible");
    		$prev_image.addClass("visible");
    		if(!$prev_image.prev("img").length) {
    			$("#previous").removeClass("visible");
    			$("#previous").addClass("invisible");
    		}

    		if($("#next").hasClass("invisible")) {
    				$("#next").removeClass("invisible");
    				$("#next").addClass("visible");
    			}
    	}
    });
  });