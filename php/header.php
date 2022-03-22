<?php 
/* This is the header that is included in the main pages of the website */
?>

<header>
	<div class="container clearfix">
		<?php
		/* Here we check if a user is logged in and if he is what user role he has in order 
		to display the correct options. The user's information if they are logged in are saved 
		in session variables. The script that handles them is 'login.php'. */

		if(isset($_SESSION["login_id"])) {
			echo "<div id=\"login_icon\" class=\"logged_in\"></div>";

			if($_SESSION["role"] == 1) {
				/* User role is administrator */
				echo "<div id=\"login_options\" class=\"logged_in\">
						<p class=\"hello\">Hello ". $_SESSION['firstname'] ."!</p>
						<p><a href=\"admin.php\">Go to the control panel</a></p>
						<p><a href=\"logout.php\">Logout</a></p>
						<div id=\"social_icons\" class=\"clearfix\">
							<div id=\"facebook\">
								<p>Find us on Facebook</p>
								<a href=\"https://en-gb.facebook.com/\"></a>
							</div>
							<div id=\"twitter\">
								<p>Find us on Twitter</p>
								<a href=\"https://twitter.com/?lang=en\"></a>
							</div>
						</div>
					</div>";
			} elseif ($_SESSION["role"] == 2) {
				/* User role is registered user */
				echo "<div id=\"login_options\" class=\"logged_in\">
						<p class=\"hello\">Hello ". $_SESSION['firstname'] ."!</p>
						<p><a href=\"profile.php\">Go to your profile</a></p>
						<p><a href=\"logout.php\">Logout</a></p>
						<div id=\"social_icons\" class=\"clearfix\">
							<div id=\"facebook\">
								<p>Find us on Facebook</p>
								<a href=\"https://en-gb.facebook.com/\"></a>
							</div>
							<div id=\"twitter\">
								<p>Find us on Twitter</p>
								<a href=\"https://twitter.com/?lang=en\"></a>
							</div>
						</div>
					</div>";
			} 

		} else {
			/* User is not logged in or just a visitor */
			echo "<div id=\"login_icon\" class=\"logged_out\"></div>";
			echo "<div id=\"login_options\" class=\"logged_out\">
 				  <p class=\"hello\">Hi there!</p>
				  <p><a href=\"login.php\">Login</a></p>
				  <div id=\"social_icons\" class=\"clearfix\">
							<div id=\"facebook\">
								<p>Find us on Facebook</p>
								<a href=\"https://en-gb.facebook.com/\"></a>
							</div>
							<div id=\"twitter\">
								<p>Find us on Twitter</p>
								<a href=\"https://twitter.com/?lang=en\"></a>
							</div>
						</div>
				  </div>";
		}
		?>
	</div>

	<div id="logo_header">
		<div class="container clearfix">
			<div id="logo"><a href="index.php"></a></div>
		</div>
	</div>

	<div id="nav_header">
		<nav class="main_navigation container clearfix">
			<ul class="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="#activities">Activities</a>
					<ul class="sub_menu">
						<?php
						/* The variables and arrays we use are defined in 'find_resources.php' */
						for($i=0; $i < $res_number; $i++) { 
							echo "<li>
								<a href=\"resource.php?resource=". $resources_id[$i] ."\">". $resources_name[$i] ."</a>
							</li>";
						}
						?>
					</ul>
				</li>
				<li><a href="facilities.php">Facilities</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
	<div class="container">
	</div>
</header>