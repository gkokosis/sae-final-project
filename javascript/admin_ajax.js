/* jQuery document */

$(document).ready(function(){

	/* User live search */
    $("#searchbox").on("change paste keyup", function(){         //Assigning a keyup event to the search box
		var s= $(this).val();                                    //and getting its value
		$("#user_details_container").html("");
		if(s==""){
			$("#results_container").html("");  //Checking and resetting the value of the search box
		} 
		else {
			$.ajax({                          //Ajax call with callback functions
				url: "php/ajax.php",		  //for success and failure	
				data: {input: s},
				type: "POST",
				dataType: "html"
			})
		    .done(function(data){
		    	console.log("success");
		    	$("#results_container").html(data);
		    })
		    .fail(function(jqXHR, textStatus, errorThrown){
		  		console.log(jqXHR);
		  		console.log(textStatus);
		  		console.log(errorThrown);
		  		$("#results_container").html("<div class=\"error\"><p>The server didn't respond because the universe hates you</p></div>")
		    });
		}
	});

    /* User details and active bookings */
	$(document).on("click", "tr.user_row", function(){
    	var d = $(this).children("td.id").html();
    	var f = $(this).children("td.fname").html();
    	var l = $(this).children("td.lname").html();
    	$.ajax({                         
				url: "php/ajax.php",	
				data: {id: d,
					   fname: f,
					   lname: l},
				type: "POST",
				dataType: "html"
			})
		    .done(function(data){
		    	console.log("success");
		    	$("#user_details_container").html(data);
		        $("#results_container").html("");
    			$("#searchbox").val("");
		    })
		    .fail(function(jqXHR, textStatus, errorThrown){
		  		console.log(jqXHR);
		  		console.log(textStatus);
		  		console.log(errorThrown);
		  		$("#user_details_container").html("<div class=\"error\"><p>The server didn't respond because the universe hates you</p></div>")
		    });    
	});

	/* Active bookings per activity */
	$(document).on("click", "p.admin_activity", function(){
    	var a = $(this).children("span.admin_activity_id").html();
    	var n = $(this).children("span.admin_activity_name").html();
    	$.ajax({                      
				url: "php/ajax.php",
				data: {act: a,
						n: n},
				type: "POST",
				dataType: "html"
			})
		    .done(function(data){
		    	console.log("success");
		    	$("#activity_details_container").html(data);
		    })
		    .fail(function(jqXHR, textStatus, errorThrown){
		  		console.log(jqXHR);
		  		console.log(textStatus);
		  		console.log(errorThrown);
		  		$("#activity_details_container").html("<div class=\"error\"><p>The server didn't respond because the universe hates you</p></div>")
		    });    
	});

  });