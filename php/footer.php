<?php

/* This is the footer that is included in the main pages of the website */

?>

<footer>
	<div class="container clearfix">
		<div class="footer_menu left">
			<h5 class="title">Menu</h5>
			<ul class="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="facilities.php">Facilities</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<div class="footer_menu left">
			<h5 class="title">Activities</h5>
			<ul class="menu">
				<?php
				/* The variables and arrays we use are defined in 'find_resources.php' */
				for($i=0; $i < $res_number; $i++) { 
					echo "<li>
						<a href=\"resource.php?resource=". $resources_id[$i] ."\">". $resources_name[$i] ."</a>
						</li>";
				}
				?>
			</ul>
		</div>
		<div class="footer_menu left">
			<h5 class="title">More info</h5>
			<ul class="menu">
				<li><a href="index.php#booking_info">Booking info</a></li>
				<li><a href="index.php#hours_info">Opening hours</a></li>
				<li><a href="facilities.php#gallery">Gallery</a></li>
				<li><a href="contact.php#map_container">Find us</a></li>
			</ul>
		</div>
	</div>
	<div class="container clearfix">
		<div id="footer_social_icons">
			<p><a href="https://en-gb.facebook.com"><img src="assets/facebook_grey_40.png" /> Find us on facebook</a></p> 
			<p><a href="https://twitter.com/?lang=en"><img src="assets/twitter_grey_40.png" /> Find us on Twitter</a></p>
		</div>
	</div>
	<div class="container clearfix">
		<div id="credentials">
			<p>WDD 1013 - Final Project</p>
			<p>Design by: <span id="designer">Georgios Kokosis Papathanasiou</span></p>
		</div>
	</div>
</footer>