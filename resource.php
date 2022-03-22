<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Activity</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
<script>
$(document).ready(function(){
	/* This function scrolls the page to the error message, 
	if there is one when trying to book. */
	if($(".error_box").length) {
		$('html, body').animate({
		    scrollTop: $(".error_box").offset().top
	    }, 500);
	}
});
</script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<?php require "php/load_resource.php"; ?>
	</section>
			<?php
			/* Here we check if a visitor is logged in, and what is their user role. We display different 
			options for visitors, registered users or administrators */
			if(isset($_SESSION["login_id"])) {
				if($_SESSION["role"] == 1) {
					/* User role is administrator */
					echo "<section id=\"admin_panel\"><div class=\"container clearfix\">";
					echo "<div>";
				 	echo "<p>As an administrator you can check availability and active bookings for this activity in the control panel.</p>";
				 	echo "<div class=\"admin_options\"><p><a href=\"admin.php\">Go to the control panel</a></p></div>";
				 	echo "</div>";
				 	echo "</div></section>";
				 } elseif($_SESSION["role"] == 2) {
				 	/* User role is registered user */
				 	echo "<section><div class=\"container clearfix\">";
				 	echo "<h2 class=\"title\">How to book</h2>";
				 	echo "<p>Booking is very simple! Just select the day you want to book and then click \"Book now\". Booking is limited to one activity per day.</p>";

				 	require "php/booking_process.php";

				 	echo "</div></section>"; 
				 }
			} else {
				/* User is not logged in or just a visitor */
				echo "<section><div class=\"container clearfix\">";
				echo "<div>
						<h2 class=\"title\">How to book</h2>
						<p>Booking is only available to registered users. If you are a registered user, Login to check availability and book. If you are not a registered user, registration is free and it only takes a minute!</p>
					</div>
					<div class=\"user_options\">
						<p><a href=\"login.php?from=". $resource_id ."\">Login</a></p>
						<p><a href=\"register.php\">Register</a></p>
				</div";
				echo "</div></section>";
			}	 	
			?>
	<section></section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>