<?php
/* This script handles the ajax requests that are made in 'admin.php'. There are three ajax requests, for 
each one we get the information, query the database and return some html with the data. */

require "connection.php";


/* User live search */
if(isset($_POST["input"])) {
	$input= $_POST["input"];   //Getting user input

	$find_users_sql= "SELECT * FROM users WHERE (firstname LIKE '". $input. "%' OR lastname LIKE '". $input ."%') ORDER BY id";   //SQL query

	$find_users_result= $connection->query($find_users_sql);	  //Getting the result of the query

	if($find_users_result->num_rows > 0){                   //Checking if the database returned any results

		echo "<table id=\"find_users\">
					<tr>
						<th>id</th>
						<th>First name</th>
						<th>Last name</th>
					</tr>";

		while($find_users_row = $find_users_result->fetch_assoc()){	

			echo "<tr onclick=\"\" class=\"user_row\">";
				echo "<td class=\"id\">". $find_users_row["id"] . "</td>";
				echo "<td class=\"fname\">". $find_users_row["firstname"] ."</td>"; 
				echo "<td class=\"lname\">". $find_users_row["lastname"] ."</td>"; 
				echo "</tr>";    
		}

		echo "</table>";

	} else {
		echo "<div class=\"noResult\"><p>There is no user with this name</p></div>";
	}
}



/* Display the details for the selected user and their active bookings. */
date_default_timezone_set("Europe/London");

$timestamp = new DateTime("today");
$today = $timestamp->format("U");

$new_timestamp = new DateTime;

if(isset($_POST["id"])) {
	$get_id = $_POST["id"];

	/* First we get the details of the user */
	$fetch_user_info_sql = "SELECT username, firstname, lastname, email, role_name FROM users INNER JOIN roles ON users.role = roles.id WHERE users.id = '$get_id'";

	$fetch_user_info_result = $connection->query($fetch_user_info_sql);

	if($fetch_user_info_result->num_rows == 1){

		$fetch_user_info_row = $fetch_user_info_result->fetch_assoc();

		echo "<div class=\"container clearfix\"><div>";
		echo "<h3 class=\"title\">User details</h3>";
		echo "<p>Name: <span>". $fetch_user_info_row["firstname"] ." ". $fetch_user_info_row["lastname"] ."</span></p>";
		echo "<p>Username: <span>". $fetch_user_info_row["username"] ."</span></p>";
		echo "<p>Email: <span>". $fetch_user_info_row["email"] ."</span></p>";
		echo "<p class=\"last\">Role: <span>". $fetch_user_info_row["role_name"] ."</span></p>";


		/* Then we get their active bookings */
		$fetch_user_bookings_sql = "SELECT booking_day, name FROM bookings INNER JOIN resources ON bookings.resource_id = resources.id WHERE bookings.user_id = '$get_id' AND bookings.booking_day >= '$today' ORDER BY bookings.booking_day";

		$fetch_user_bookings_result = $connection->query($fetch_user_bookings_sql);

		if($fetch_user_bookings_result->num_rows > 0) {
			echo "<h4 class=\"title\">Active bookings:</h4>";
			echo "<table>
						<tr>
							<th>Day</th>
							<th>Activity</th>
						</tr>";

			while($fetch_user_bookings_row = $fetch_user_bookings_result->fetch_assoc()) {
				$new_timestamp = $new_timestamp->setTimestamp($fetch_user_bookings_row["booking_day"]);
				$day = $new_timestamp->format("l j\/n");
				echo "<tr>";
				echo "<td>". $day. "</td>";
				echo "<td>". $fetch_user_bookings_row["name"] ."</td>";
				echo "</tr>";
			}

			echo "</table>";
		} else {
			echo "<h4 class=\"title\">User ". $fetch_user_info_row["firstname"] ." ". $fetch_user_info_row["lastname"] ." has no active bookings</h4>";
		}

		echo "</div></div>";
				

	} else {
		echo "<div class=\"noResult\"><p>Something went wrong :(</p></div>";
	}
	
}


/* Display the active bookings for the selected activity, including the current day's bookings */
$another_timestamp = new DateTime;

if(isset($_POST["act"])) {
	$act_id = $_POST["act"];
	$act_name = $_POST["n"];

	$admin_activity_sql = "SELECT booking_day, COUNT(*) AS patata FROM bookings  WHERE booking_day >= '$today' AND resource_id = '$act_id' GROUP BY booking_day";

	$admin_activity_result = $connection->query($admin_activity_sql);

	echo "<div class=\"container clearfix\"><div>";
	echo "<p></p>";

	if($admin_activity_result->num_rows > 0) {

			echo "<h4 class=\"title\">For ". $act_name . " we have the following bookings: </h4>";

		while($admin_activity_row = $admin_activity_result->fetch_assoc()) {
			$another_timestamp = $another_timestamp->setTimestamp($admin_activity_row["booking_day"]);
			$another_day = $another_timestamp->format("l j\/n");

			if($admin_activity_row["patata"] == 1) {
				$term = "booking";
			} else {
				$term = "bookings";
			}

		 	echo "<p>";
		 	echo $another_day . " - " . $admin_activity_row["patata"]." ". $term . ".";
		 	echo "</p>";
	 	}

	} else {
		echo "<p>No active bookings</p>";
	}
	
	echo "</div></div>";

}

?>