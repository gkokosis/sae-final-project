<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";

/* Check if user role is correct for displaying this page, and redirect him
accordingly if not */
if(isset($_SESSION["login_id"])) {
	if($_SESSION["role"] == 2) {
		header("location: profile.php");
	}
} else {
	header("location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
<script src="javascript/admin_ajax.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<div class="container clearfix">
			<h1 class="title">Control panel</h1>
			<h2 class="title">Hello <?php echo $_SESSION["firstname"]; ?> !</h2>
			<h3 class="title">Find user</h3>
			<p>Search for a user to see their active bookings</p>
			<div id="search_box_container">
				<input type="text" id="searchbox" autocomplete="off" placeholder="Search user by name" />
				<div id="results_container">

				</div>
			</div>
		</div>
	</section>

	<section id="user_details_container" class="details">
		
	</section>

	<section>
		<div class="container clearfix">
			<h3 class="title">Manage activities</h3>
			<p>Select an activity to see availability</p>
			<div id="admin_activities">
				<?php
				/* We get that info from 'header.php' which is included in the page */
				for($i=0; $i < $res_number; $i++) { 
					echo "<p onclick=\"\" class=\"admin_activity\"><span class=\"admin_activity_id\">". $resources_id[$i] ."</span> <span class=\"admin_activity_name\">". $resources_name[$i] ."</span></p>";
				}
				?>
			</div>
		</div>
	</section>
	<section id="activity_details_container" class="details">

	</section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>