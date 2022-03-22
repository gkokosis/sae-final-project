<?php
		/* ---------------------------------------  Start ----------------------------------------------- */
		
		/* In this section we create and display a 5-day rolling booking system, starting from tomorrow for
		 each current day. The code breaks down in these steps: 

			1. We create the timestamps and the names of the next 5 days, and save them in arrays. We also
			get the current day's timestamp.

			2. We get from the database the days that are fully booked so we can disable the option to
			book them. We save the timestamps for those days in an array.

			3. We create the html for the form that holds the booking system, checking for days that are 
			fully booked and therefore not available.

			4. This is the script that handles the submitted form. It displays error messages if the 
			checks fail. If everything is successful, it creates a booking in the database, and redirects
			to a thank you page.

		 */
			date_default_timezone_set("Europe/London");

			/* --------------------------------------------- 1 ------------------------------------------ */

			/* 1. We create the timestamps and the names of the next 5 days, and save them in arrays. We also
			get the current day's timestamp. */

			$dates = new DateTime("today");

			$days="+1 days";

			for ($v=0; $v < 5; $v++) {
				$dates->modify($days); // For each iteration the datetime object becomes the next day
				$next_five_days_names[$v] = $dates->format("l j\/n");
				$next_five_days_timestamps[$v] = $dates->format("U");
			}

			/* We create a timestamp for the current day */
			$new_datetime = new DateTime("today");
			$today = $new_datetime->format("U");

			$error = "";

			/* --------------------------------------------- 2 ------------------------------------------ */

			/* 2. We get from the database the days that are fully booked so we can disable the option to
			book them. We save the timestamps for those days in an array. */

			/* We query the database to get the days that have no available spots */
			$bookings_query = "SELECT booking_day, COUNT(*) AS patata FROM bookings  WHERE booking_day > '$today' AND resource_id = '$resource_id' GROUP BY booking_day HAVING patata > 3"; 

			$bookings_result= $connection->query($bookings_query);

			$booked_days = array();

			/* We save the results in array */
			if ($bookings_result->num_rows > 0) {
			    while($brow = $bookings_result->fetch_assoc()) {
			        $booked_days[] = $brow["booking_day"];        
			    }
			}

			/* --------------------------------------------- 3 ------------------------------------------ */

			/* 3. We create the html for the form that holds the booking system, checking for days that are 
			fully booked and therefore not available. */

			/* This array holds the id's of the radio buttons and the text in the labels element */
			$labels = array("tomorrow", "in_two_days", "in_three_days", "in_four_days", "in_five_days");

			/* We start to create the form */
			echo "<form id=\"booking_system\" action=\"\" method=\"post\"><div class=\"clearfix\">";

			/* Here we create the labels and radio buttons */
			for ($z=0; $z < 5; $z++) { 

				$disabled = "";
				$class = "available";

				/* Checking if there are any bookings for the next 5 days for this resource */
				for ($i=0; $i < count($booked_days); $i++) { 
					if ($next_five_days_timestamps[$z] == $booked_days[$i]) {
						$disabled = "disabled";  	// When there is a booking this variable will disable the radio button
						$class = "unavailable";     // And this will change the class helping us style the disabled items
					}
				}
				
				/* This is the actual html of the radio buttons and the labels */
				echo "<div class=\"day\"><input type=\"radio\" name=\"booking\" id=\"". $labels[$z] ."\" value=\"". $next_five_days_timestamps[$z] ."\" ". $disabled ." />";
				echo "<label for=\"". $labels[$z] ."\" class=\"". $class ."\">". $next_five_days_names[$z] ."</label></div>";

			}

			/* We create the submit box and complete the form */
			echo "</div><div id=\"booking_submit\"><input type=\"submit\" value=\"Book now!\" name=\"book\" /></div></form>";

			/* --------------------------------------------- 4 ------------------------------------------ */

			/* 4. This is the script that handles the submitted form. It displays error messages if the 
			checks fail. If everything is successful, it creates a booking in the database, and redirects
			to a thank you page. */

			/* We check if the user submitted the form (tried to book a resource) and write the booking in the database */		
			if (isset($_POST["book"])) {

				/* We get the value of the submitted form */
				$booking = $_POST["booking"];  
				$user_id = $_SESSION["user_id"];

				/* We create the timestamp for the given value */
				$another_timestamp = new DateTime;
				$another_timestamp->setTimestamp($booking);
				$selected_day = $another_timestamp->format("l");

				/* Checking if the form had a selected value when submitted */
				if (is_null($booking)) {
					$error = "You have to select one of the days to book";
				} else {

					/* Here we check if the user has another booking for the day he picked */
					$check_query = "SELECT * FROM bookings WHERE user_id = '$user_id' AND booking_day = '$booking'"; 

					$check_result = $connection->query($check_query);

					if($check_result->num_rows > 0) {
						$error = "You have another active booking for ". $selected_day .". Please choose a different day";
					} else {

						/* Everything checks out so we write the booking in the database */
						$insert_query= "INSERT INTO bookings (resource_id, user_id, booking_day) VALUES ('$resource_id', '$user_id', '$booking')";

						$insert_result= $connection->query($insert_query);

						if($insert_result == true){
							// Data inserted succesfully to the database
							header("location: thanks.php");
						} else {
							echo "failure";
						}
					}
				}
			}

			if($error == "") {
				echo "<p>". $error . "</p>";
			} else {
				echo "<div class=\"error_box\"><p class=\"error\">". $error ."</p></div>";
			}
				
		/* -----------------------------------------   End  --------------------------------------------- */	
?>