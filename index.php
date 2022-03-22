<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<div class="container clearfix">
			<h1 class="title">Community Sports Center</h1>
			<p>Welcome to the Community Sports Center website! Our center, in cooperation with private centers and sports clubs, can offer a combination of indoor and outdoor sports courts for free booking, indoor changing facilities and free parking. Everyday we have available four 7-a-side Football pitches, four Tennis courts, four Basketball courts and four indoor Badminton courts.</p>
		</div>
	</section>
	<section id="activities">
		<div class="container clearfix">
			<h2 class="title">Activities</h2>
			<p>The community sports center is a great place to meet and play Tennis, Basketball, Football or Badminton. Select one of the activities to learn more.</p>
			<?php
			/* Here we display the activities we got from the database. The variables and arrays we use are 
			defined in php/find_resources.php which is included in the start of the page. */
			for ($z=0; $z < $res_number; $z++) { 
				echo "<div class=\"resource\">
						<h3 class=\"title\">". $resources_name[$z] ."</h3>
						<div><a href=\"resource.php?resource=". $resources_id[$z] ."\"><img src=\"assets/". $resources_images[$z] ."\" alt=\"\" /></a></div>
					</div>";
				}
			?>
		</div>
	</section>
	<section>
		<div class="container clearfix">
			<h2 class="title">More info</h2>
			<p>As part of the Government plan to offer more opportunities for sports and outdoor activities, to people who live in the city, the Community Sports Center in cooperation with Private Sports Club, is offering free use of the facilities for limited time every day.</p>
			<div id="booking_info">
				<h3 class="title">Booking</h3>
				<p>To book a court you have to be a registered user. Booking is available until midnight the previous day, and for five days in advance. Since we have limited use of the facilities, it is not permitted to book more than one activity per day.</p>
			</div>
			<div id="hours_info">
				<h3 class="title">Opening hours</h3>
				<p>Our offices are open everyday 17:00 - 20:00. Booking times can be seen for each activity in the following table:</p>
				<table id="opening_hours">
					<tr>
						<th>Activity</th>
						<th>Weekdays</th>
						<th>Weekends</th>
					</tr>
					<tr>
						<td>Tennis</td>
						<td class="weekdays">18:00 - 19:20</td>
						<td class="weekends">17:00 - 18:20</td>
					</tr>
					<tr>
						<td>Basketball</td>
						<td class="weekdays">18:00 - 19:20</td>
						<td class="weekends">17:00 - 18:20</td>
					</tr>
					<tr>
						<td>Football</td>
						<td class="weekdays">18:30 - 20:00</td>
						<td class="weekends">18:30 - 20:00</td>
					</tr>
					<tr>
						<td>Badminton</td>
						<td class="weekdays">17:00 - 18:20</td>
						<td class="weekends">17:00 - 17:50</td>
					</tr>
				</table>
				<p>Please note that if you have booked an activity you have to be at the center at least 15 minutes before the booking time.</p>
			</div>
		</div>
	</section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>