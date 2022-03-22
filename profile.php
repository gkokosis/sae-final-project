<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";

require "php/profile_functions.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
<script>
$(document).ready(function(){
	/* This function scrolls the page to the displayed error, 
	if there is one when the user is trying to edit their details. */
	if($(".error_box").length) {
		$('html, body').animate({
		    scrollTop: $("#edit_details_section").offset().top
	    }, 500);
	}
});
</script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<section>
		<div class="container clearfix">
			<h1 class="title">My profile</h1>
			<h2 class="title">Hello <?php echo $_SESSION["firstname"]; ?>!</h2>
			<div>
			<?php
			/* Here we display the user's bookings */
			if($user_info_result->num_rows > 0) {
				echo "<h4 class=\"title\">You have the following bookings: </h4>";
				echo "<table>
					<tr>
						<th>Day</th>
						<th>Activity</th>
					</tr>";
				while($row = $user_info_result->fetch_assoc()) {
					$new_timestamp = $new_timestamp->setTimestamp($row["booking_day"]);
					$day = $new_timestamp->format("l j\/n");
					echo "<tr>";
					echo "<td>". $day. "</td>";
					echo "<td>". $row["name"] ."</td>";
					echo "</tr>";
				}
					
				echo "</table>";
			} else {
				echo "<h4 class=\"title\">You don't have any active bookings</h4>";
			}
			?>
			</div>
		</div>
	</section>

	<section id="edit_details_section">

		<!-- *********************** Change email ************************** -->
		<div class="container clearfix">
			<h3 class="title">Edit your details</h3>
			<div id="change_email_container" class="left">
				<h4 class="title">Change my email</h4>
				<p class="outcome"><?php echo $email_outcome; ?></p>
				<form action="" method="post">
					<div class="field">
						<label for="email">New email</label>
						<input type="email" name="email" id="email" value="<?php echo $email; ?>" />
						<p class="error">
						<?php
						if($email_error == "") {
							echo $email_error;
						} else {
							echo "<span class=\"error_box\">". $email_error . "</span>"; 
						}
						?>
						 </p>
					</div>
					<div class="field">
						<label for="email2">Repeat email</label>
						<input type="email" name="email2" id="email2" value="<?php echo $email2; ?>" />
						<p class="error">
						<?php
						if($email2_error == "") {
							echo $email2_error; 
						} else {
							echo "<span class=\"error_box\">". $email2_error . "</span>";
						}
						?>
						</p>
					</div>
					<div id="change_email_submit" class="field">
						<input type="submit" name="change_email" id="change_email" value="Change email" />
					</div>
				</form>
			</div>

			<!-- *********************** Change password ************************** -->
			<div id="change_password_container" class="left">
				<h4 class="title">Change my password</h4>
				<p class="outcome"><?php echo $password_outcome; ?></p>
				<form action="" method="post">
					<div class="field">
						<label for="old_password">Old password</label>
						<input type="password" name="old_password" id="old_password" />
						<p class="error">
						<?php
						if($old_password_error == ""){
							echo $old_password_error;
						} else {
							echo "<span class=\"error_box\">". $old_password_error . "</span>";
						}
						?>
						</p>
					</div>
					<div class="field">
						<label for="password">New password</label>
						<input type="password" name="password" id="password" />
						<p class="error">
						<?php
						if($password_error == "") {
							echo $password_error;
						} else {
							echo "<span class=\"error_box\">". $password_error . "</span>";
						}
						?>
						</p>
					</div>
					<div class="field">
						<label for="password2">Repeat password</label>
						<input type="password" name="password2" id="password2" />
						<p class="error">
						<?php
						if($password2_error == "") {
							echo $password2_error;
						} else {
							echo "<span class=\"error_box\">". $password2_error . "</span>";
						}
						?>		
						</p>
					</div>
					<div id="change_password_submit" class="field">
						<input type="submit" name="change_password" id="change_password" value="Change password" />
					</div>
				</form>
			</div>
		</div>
	</section>

	<section></section>
</main>

<?php require "php/footer.php"; ?>

</body>
</html>